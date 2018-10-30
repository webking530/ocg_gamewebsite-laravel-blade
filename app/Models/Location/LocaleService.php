<?php
namespace Models\Location;

use Mcamara\LaravelLocalization\LaravelLocalization;
use Models\Utility\UTF8Sorter;

class LocaleService
{

    /** @type array */
    protected $config;

    /**
     * @type LaravelLocalization
     */
    private $localization;

    public function __construct(LaravelLocalization $localization)
    {
        $this->localization = $localization;
        $this->config = $this->localization->getConfigRepository()->get('laravellocalization');
    }

    public function languages()
    {
        $ret = [];
        foreach ($this->localization->getSupportedLocales() as $locale => $options) {
            $ret[$locale] = $options['name'];
        }

        UTF8Sorter::sort($ret, $this->defaultLocale());

        return $ret;
    }

    public function nativeLanguages()
    {
        $ret = [];
        foreach ($this->localization->getSupportedLocales() as $locale => $options) {
            $ret[$locale] = $options['native'];
        }

        return $ret;
    }

    public function name($locale)
    {
        return s($this->config['supportedLocales'][$locale]['name'], $locale);
    }

    public function defaultLocale()
    {
        return $this->localization->getDefaultLocale();
    }


    public function isSupported($locale)
    {
        return isset($this->config['supportedLocales'][$locale]);
    }
    
}