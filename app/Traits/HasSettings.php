<?php
namespace App\Traits;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

trait HasSettings
{
    public function getSettings()
    {
        return Cache::rememberForever('settings', function () {
            return Setting::first();
        });
    }
}
