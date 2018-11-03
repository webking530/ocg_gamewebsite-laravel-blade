<?php

namespace Models\Setting;

class SettingsManager {

    private static $defaults = [
        'admin_email' => 'admin@ocg.casino',
        'admin_name' => 'OCG Admin',
        'admin_locale' => 'en',
        'developer_email' => 'temporal@domain.com',
        'developer_name' => 'Temporal',
        'developer_locale' => 'en',
        'no_reply_email' => 'noreply@ocg.casino',
        'no_reply_name' => 'No Reply',
    ];

    public function get($key, $fresh = false) {
        $value = Setting::where('key', $key)->first();
        if ($value) {
            return $value->value;
        } else {
            return 0;
        }
    }

    public function setArray(array $settings) {
        foreach ($settings as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function set($key, $value) {
        $record = Setting::firstOrNew(['key' => $key]);
        $record->value = $value;
        $record->save();
        //        Cache::put('settings_' . $key, $value, static::DEFAULT_CACHE_DURATION_IN_MINUTES);
    }

    public function persistDefaults() {
        $this->setArray($this->defaults());
    }

    public function flush() {
        Setting::truncate();
    }

    private function defaults() {
        return static::$defaults;
    }

}
