<?php

use Carbon\Carbon;

/**
 * Function to create Carbon instance
 *
 * @param int|null $year
 * @param int|null $month
 * @param int|null $day
 *
 * @return Carbon|null
 */
if (!function_exists('collectMysqlDateFormat')) {
    function collectMysqlDateFormat($year, $month, $day): Carbon|null
    {
        if ($year && $month && $day) {
            return Carbon::createFromDate($year, $month, $day)->startOfDay();
        }
        return null;
    }
}
