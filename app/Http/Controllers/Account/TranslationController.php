<?php

namespace App\Http\Controllers\Account;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\Translation\Translation;

class TranslationController extends Controller
{
    public function getPageTranslations(Request $request) {
        $sourceLang = $request->get('source_language');
        $targetLang = $request->get('target_language');
        $fullKeys = $request->get('keys');

        $translations = [];

        foreach ($fullKeys as $fullKey) {
            $parts = explode('.', $fullKey);
            $group = $parts[0];

            unset($parts[0]);
            $key = implode('.', $parts);

            $translationSource = Translation::
                                where('locale', $sourceLang)
                                ->where('group', $group)
                                ->where('key', $key)
                                ->select('value', 'group', 'key')
                                ->first();

            $translationTarget = Translation::
                                where('locale', $targetLang)
                                    ->where('group', $group)
                                    ->where('key', $key)
                                    ->select('id', 'value')
                                    ->first();

            $newKey = "{$translationSource->group}.{$translationSource->key}";

            if (isset($translations[$newKey])) {
                continue;
            }

            $translations[$newKey] = [
                'key' => $newKey,
                'value' => $translationTarget == null ? $translationSource->value : $translationTarget->value,
                'status' => $translationTarget == null ? 'pending' : 'done'
            ];
        }

        $progress = Translation::getGlobalProgress($sourceLang, $targetLang);

        return [
            'translations' => $translations,
            'progress' => "{$progress['targetCount']} / {$progress['sourceCount']}",
            'words' => $progress['words']
        ];
    }

    public function getOrphanTranslations(Request $request) {
        $sourceLang = $request->get('source_language');
        $targetLang = $request->get('target_language');

        $orphanTranslations =
            Translation::leftJoin('translations AS target', function ($join) use ($targetLang) {
                $join->on('translations.group', '=', 'target.group')
                    ->on('translations.key', '=', 'target.key')
                    ->on('target.locale', '=', DB::raw("'$targetLang'"));
            })
            ->where('translations.locale', $sourceLang)
            ->select('translations.group', 'translations.key', 'translations.value')
            ->get();

        $translations = [];

        foreach ($orphanTranslations as $trans) {
            $translations[] = [
                'key' => "{$trans->group}.{$trans->key}",
                'value' => $trans->value,
                'status' => 'pending'
            ];
        }

        $progress = Translation::getGlobalProgress($sourceLang, $targetLang);

        return [
            'translations' => $translations,
            'progress' => "{$progress['targetCount']} / {$progress['sourceCount']}",
            'words' => $progress['words']
        ];
    }

    public function saveTranslation(Request $request) {
        $sourceLang = $request->get('source_language');
        $targetLang = $request->get('target_language');

        $parts = explode('.', $request->get('key'));
        $group = $parts[0];
        unset($parts[0]);
        $key = implode('.', $parts);

        $value = $request->get('value');

        $sourceTranslation = Translation::where('locale', $sourceLang)
            ->where('group', $group)
            ->where('key', $key)
            ->first();

        // Sanity check
        if ($sourceTranslation == null) {
            return [
                'status' => 'error',
                'msg' => 'This translation does not exist',
            ];
        }

        $translation = Translation::where('locale', $targetLang)
            ->where('group', $group)
            ->where('key', $key)
            ->first();

        if ($translation == null) {
            Translation::create([
                'locale' => $targetLang,
                'group' => $group,
                'key' => $key,
                'value' => $value,
                'user_id' => \Auth::user()->id
            ]);
        } else {
            $translation->value = $value;
            $translation->user_id = \Auth::user()->id;
            $translation->save();
        }

        $progress = Translation::getGlobalProgress($sourceLang, $targetLang);

        return [
            'status' => 'success',
            'msg' => '',
            'progress' => "{$progress['targetCount']} / {$progress['sourceCount']}"
        ];
    }
}
