<?php

use Carbon\Carbon;

if (!function_exists('format_date')) {
    function format_date(string $date)
    {
        return Carbon::parse($date, config('app.timezone'))->format('Y-m-d\TH:i:s');
    }
}
