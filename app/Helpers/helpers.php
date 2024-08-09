<?php

use App\Models\Setting;

if (!function_exists('maleOrFemaleForAdmin')) {
    function maleOrFemaleForAdmin() {
        return auth()->guard('admin')->user()->male_or_female;
    }
}

if (!function_exists('getYearSetting')) {
    function getYearSetting() {
        return $Setting = Setting::first();
     
    }
}

