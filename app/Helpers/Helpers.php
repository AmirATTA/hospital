<?php
namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class Helpers
{
    public static function removeComma(string $value): string
    {
        return str_replace(',', '', $value);
    }

    public static function setting(string $key, string $default = '')
    {
        $settings = Cache::rememberForever('settings', function () {
                return Setting::query()
                    ->select(['id', 'name', 'value'])
                    ->get();
        });
        $setting = $settings->where('name', $key)->first();

        return $setting ? $setting->value : $default;
    }
}