<?php namespace Models\Translation;

use Cache;
use DB;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem;
use Lang;
use LaravelLocalization;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class TranslationManager
{

    const DEFAULT_CACHE_DURATION_IN_MINUTES = 60; // One hour
    protected static $excludedGroups;
    protected static $defaultContentPaths;
    protected static $defaultLocale;
    protected static $findPattern;
    protected static $usedImplicitly;
    protected static $locales;

    protected $importedCount = 0;
    protected $found = 0;
    protected $imported = 0;
    protected $exported = 0;
    protected $deleted = 0;
    protected $pretendData = [];
    /**
     * @type Filesystem
     */
    private $file;


    public function __construct(Config $config, Filesystem $file)
    {
        static::$defaultContentPaths = [app_path(), resource_path()];
        static::$excludedGroups = $config->get('translation.exclude_groups');
        static::$defaultLocale = LaravelLocalization::getDefaultLocale();
        static::$usedImplicitly = $config->get('translation.implicitly_used');
        static::$locales = array_keys(LaravelLocalization::getSupportedLocales());
        $this->file = $file;
    }


    public static function clearCache($locale = null)
    {
        if ($locale == null) {
            foreach (static::$locales as $locale) {
                static::clearCache($locale);
            }

            return;
        }
        Cache::forget("translations.{$locale}.total_count");
        Cache::forget("translations.{$locale}.translated_count");
        Cache::forget("translations.{$locale}.word_count");
    }

    public function totalCount($locale)
    {
        return Cache::remember("translations.{$locale}.total_count", static::DEFAULT_CACHE_DURATION_IN_MINUTES, function () use ($locale) {
            return Translation::whereLocale($locale)->count();
        });
    }

    public function translatedCount($locale)
    {
        return Cache::remember("translations.{$locale}.translated_count", static::DEFAULT_CACHE_DURATION_IN_MINUTES, function () use ($locale) {
            return Translation::whereLocale($locale)->whereNotNull('value')->count();
        });
    }

    public function wordsCount($locale)
    {
        return Cache::remember("translations.{$locale}.word_count", static::DEFAULT_CACHE_DURATION_IN_MINUTES, function () use ($locale) {
            $count = $this->translatedCount($locale);
            if ($count) {
                return Translation::whereLocale($locale)->wordsCount();
            }

            return 0;
        });
    }

    public function translatedRatio($locale)
    {
        $totalCount = $this->totalCount($locale);

        return $totalCount ? intval(round(100 * $this->translatedCount($locale) / $totalCount)) : 0;
    }

    public function importTranslations($implicitlyUsedOnly = false)
    {
        DB::beginTransaction();
        foreach ($this->file->directories(resource_path('lang')) as $langPath) {
            $locale = basename($langPath);
            if ($locale == 'vendor') {
                continue;
            }
            $this->importDirectory($langPath, '', $locale, $implicitlyUsedOnly);
            $this->clearCache($locale);
        }
        DB::commit();

        return $this;
    }

    private function importDirectory($path, $group, $locale, $implicitlyUsedOnly)
    {
        foreach ($this->file->directories($path) as $directory) {
            $newGroup = $group ? $group . "/" . basename($directory) : basename($directory);
            $this->importDirectory($directory, $newGroup, $locale, $implicitlyUsedOnly);
        }

        if ($this->isExcludedGroup($group)) {
            return;
        }

        foreach ($this->file->files($path) as $file) {
            $fileGroup = $group ? $group . "/" . basename($file, ".php") : basename($file, ".php");
            $this->importGroup($fileGroup, $locale, $implicitlyUsedOnly);
        }
    }

    private function importGroup($group, $locale, $implicitlyUsedOnly)
    {
        if ($implicitlyUsedOnly && ! $this->isUsedImplicitly($group)) {
            return;
        }
        $translations = \Lang::getLoader()->load($locale, $group);
        foreach (array_dot($translations) as $key => $value) {

            $translation = $this->insertTranslation($group, $key, $value, $locale);
            if ($translation !== null && $translation->wasRecentlyCreated) {
                $this->imported++;
            }
        }
    }

    public function importedCount()
    {
        return $this->imported;
    }


    public function findTranslations($paths = [], $locale = null)
    {
        $locale = $locale ?: static::$defaultLocale;
        $entries = $this->getEntriesFromPaths($paths);

        DB::beginTransaction();
        foreach ($entries as $group => $keys) {

            array_map(function ($key) use ($group, $locale) {

                $value = $this->getTranslationFromFile($key, $group, $locale);
                $translation = $this->insertTranslation($group, $key, $value, $locale);
                if ($translation !== null && $translation->wasRecentlyCreated) {
                    $this->found++;
                }
            }, $keys);

        }
        DB::commit();
        $this->clearCache($locale);

        return $this;
    }

    public function foundCount()
    {
        return $this->found;
    }

    private function buildFindPattern()
    {
        if (! static::$findPattern) {
            $functions = [
                'trans',
                'trans_choice',
                'Lang::get',
                'Lang::choice',
                'Lang::trans',
                'Lang::transChoice',
                '@lang',
                '@choice'
            ];

            static::$findPattern =                      // See http://regexr.com/3d21f
                "(" . implode('|', $functions) . ")" .  // Must start with one of the functions
                "\s*" .                                 // Optional Spaces
                "\(" .                                  // Opening parentheses
                "\s*" .                                 // Optional Spaces
                "([\'\"])" .                            // Opening Quote " or '
                "([\w\-\/]+)" .                         // Translation Group
                "[\.]" .                                // Group.Key Separator
                "([\w\.\-]+)" .                          // Translation Key
                "\\2" .                                 // Closing quote
                "\s*" .                                 // Optional Spaces
                "[\),]";                                // Closing parentheses or Optional Function Parameters
        }
    }


    private function getTranslationKeys(SplFileInfo $file, &$entries, $includeExcludedGroups = false)
    {
        if (preg_match_all("/" . static::$findPattern . "/siU", $file->getContents(), $matches)) {

            for ($i = 0; $i < count($matches[1]); $i++) {
                $group = $matches[3][$i];
                if (! $includeExcludedGroups && $this->isExcludedGroup($group)) {
                    continue;
                }
                $key = $matches[4][$i];
                $entries[$group][] = $key;
            }
        }
    }

    private function insertTranslation($group, $key, $value, $locale)
    {
        if ($this->isExcludedGroup($group)) {
            return null;
        }

        $translation = Translation::firstOrNew(compact('locale', 'group', 'key'));
        //if (! $translation->exists) {
            //Translation::disableActivityLogging();
            $translation->value = $value;
            $translation->save();
            //Translation::enableActivityLogging();
        //}

        return $translation;
    }

    private function isExcludedGroup($group)
    {
        foreach (static::$excludedGroups as $excludedGroupPattern) {
            if (str_is($excludedGroupPattern, $group)) {
                return true;
            }
        }

        return false;
    }

    public function clearEmpty($pretend = false)
    {
        $query = Translation::whereNull('value');

        if ($pretend) {
            $this->pretendData = $query->get()->toArray();
        } else {
            $this->deleted += $query->delete();
        }

        $this->clearCache();

        return $this;
    }

    public function clearAll($pretend = false)
    {
        if ($pretend) {
            $this->pretendData = Translation::all()->toArray();
        } else {
            $this->deleted += Translation::count();
            Translation::truncate();
        }
        $this->clearCache();

        return $this;
    }

    public function clearUnused($pretend = false, $paths = [])
    {
        $fileEntries = $this->getEntriesFromPaths($paths, true);
        $DBEntries = Translation::entries()->get();

        DB::beginTransaction();
        foreach ($DBEntries as $entry) {
            if ($this->isUsedImplicitly($entry->group)) {
                continue;
            }
            if (! isset($fileEntries[$entry->group]) || ! in_array($entry->key, $fileEntries[$entry->group])) {
                if ($pretend) {
                    $this->pretendData[] = $entry->toArray();
                } else {
                    Translation::whereKey($entry->key)->whereGroup($entry->group)->delete();
                    $this->deleted++;
                }
            }
        }

        DB::commit();
        $this->clearCache();

        return $this;
    }

    public function deletedCount()
    {
        return $this->deleted;
    }

    private function getEntriesFromPaths($paths = [], $includeExcludedGroups = false)
    {
        $paths = $paths ?: static::$defaultContentPaths;
        $this->buildFindPattern();

        $finder = new Finder();
        $files = $finder->in($paths)->name('*.php')->files();

        $entries = [];
        foreach ($files as $file) {
            $this->getTranslationKeys($file, $entries, $includeExcludedGroups);
        }

        foreach ($entries as $group => $keys) {
            $entries[$group] = array_unique($keys);
        }

        return $entries;
    }


    public function exportTranslations()
    {
        foreach ($this->locales() as $locale) {
            $this->exportLocale($locale);
        }
    }

    private function exportLocale($locale)
    {
        $this->createRootLocaleDirectory($locale);

        foreach ($this->getGroups($locale) as $group) {
            $this->exportLocalizedGroup($group, $locale);
        }
    }

    public function locales()
    {
        return Translation::locales()->get(['locale'])->pluck('locale');
    }

    public function exportedCount()
    {
        return $this->exported;
    }

    private function getGroups($locale)
    {
        return Translation::whereLocale($locale)->groups()->get(['group'])->pluck('group');
    }

    private function exportLocalizedGroup($group, $locale)
    {
        if ($this->isExcludedGroup($group)) {
            return;
        }

        $groupPath = resource_path("lang/{$locale}/{$group}.php");
        $this->createDirectory(dirname($groupPath));

        $translations = [];
        foreach ($this->getTranslations($locale, $group) as $translation) {
            array_set($translations, $translation->key, $translation->value);
            $this->exported++;
        }

        $this->saveGroupFile($translations, $groupPath);
    }

    private function createRootLocaleDirectory($locale)
    {
        return $this->createDirectory(resource_path("lang/{$locale}"));
    }

    private function createDirectory($path)
    {
        if (! $this->file->exists($path)) {
            return $this->file->makeDirectory($path, 0755, true);
        }

        return true;
    }

    private function getTranslations($locale, $group)
    {
        return Translation::whereLocale($locale)->whereGroup($group)->get();
    }

    private function isUsedImplicitly($group)
    {
        foreach (static::$usedImplicitly as $pattern) {
            if (str_is($pattern, $group)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $translations
     * @param $groupPath
     */
    private function saveGroupFile($translations, $groupPath)
    {
        $output = "<?php\n\nreturn " . var_export($translations, true) . ";\n";
        $this->file->put($groupPath, $output);
    }


    /**
     * @param $key
     * @param $group
     * @param $locale
     * @return array|null|string
     */
    function getTranslationFromFile($key, $group, $locale)
    {
        if (Lang::has("{$group}.{$key}", $locale, false)) {
            return Lang::get("{$group}.{$key}", [], $locale, false);
        }

        return null;
    }


    public function pretendData()
    {
        return $this->pretendData;
    }

    public function copyTranslations($locale)
    {
        $translations = Translation::whereLocale(static::$defaultLocale)->get(['group', 'key'])->toArray();
        DB::beginTransaction();
        $lastRecord = null;
        foreach ($translations as $translation) {
            $lastRecord = $this->insertTranslation($translation['group'], $translation['key'], null, $locale);
        }
        $this->clearCache($locale);
        $lastRecord->recordActivity('copied');
        DB::commit();
    }

    public function publishTranslations($locale)
    {
        $this->exportLocale($locale);
        $this->clearCache($locale);
    }
}

