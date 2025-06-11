<?php
/*
  Jalali Date Functions (jdf.php)
  Source: Based on common implementations, e.g., from github.com/roozbeh360/Gregorian-Jalali-Date-Convertor
*/

if ( ! function_exists('jdate'))
{
    function jdate($format, $timestamp = '', $none = '', $timezone = 'Asia/Tehran', $tr_num = 'fa')
    {
        $timestamp = ($timestamp == '') ? time() : $timestamp;
        $D = date('D', $timestamp);
        $jDate = pdate($timestamp);
        $jYear = explode('/', $jDate)[0];
        $jMonth = explode('/', $jDate)[1];
        $jDay = explode('/', $jDate)[2];
        $gregorian_day_of_week = date('w', $timestamp); // 0 (for Sunday) through 6 (for Saturday)

        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

        // Calculate day of week (0=Saturday, 6=Friday in Persian calendar)
        $j_day_of_week = ($gregorian_day_of_week + 1) % 7;
        if ($j_day_of_week == 0) $j_day_of_week = 7; // Make Saturday 7 for consistent indexing if needed

        $format = preg_replace('/D/', $j_day_of_week, $format); // For the day of week number
        $format = preg_replace('/F/', jmonth_name($jMonth), $format); // Full month name
        $format = preg_replace('/M/', jmonth_name($jMonth, true), $format); // Short month name
        $format = preg_replace('/l/', jday_name($j_day_of_week), $format); // Full weekday name
        $format = preg_replace('/j/', $jDay, $format); // Day of month without leading zeros
        $format = preg_replace('/d/', sprintf('%02d', $jDay), $format); // Day of month with leading zeros
        $format = preg_replace('/m/', sprintf('%02d', $jMonth), $format); // Month with leading zeros
        $format = preg_replace('/n/', $jMonth, $format); // Month without leading zeros
        $format = preg_replace('/Y/', $jYear, $format); // Full year
        $format = preg_replace('/y/', substr($jYear, 2, 2), $format); // Two digit year

        // Handle other date/time formats like H, i, s, a, A etc.
        // For simplicity, we'll use standard date() for time components.
        $format = preg_replace('/H/', date('H', $timestamp), $format);
        $format = preg_replace('/i/', date('i', $timestamp), $format);
        $format = preg_replace('/s/', date('s', $timestamp), $format);
        $format = preg_replace('/a/', date('a', $timestamp), $format);
        $format = preg_replace('/A/', date('A', $timestamp), $format);
        $format = preg_replace('/g/', date('g', $timestamp), $format);
        $format = preg_replace('/h/', date('h', $timestamp), $format);
        $format = preg_replace('/G/', date('G', $timestamp), $format);
        $format = preg_replace('/u/', date('u', $timestamp), $format);

        if ($tr_num == 'fa') {
            return str_replace(range(0, 9), array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'), $format);
        }
        return $format;
    }
}

if ( ! function_exists('pdate'))
{
    function pdate($timestamp = '')
    {
        $timestamp = ($timestamp == '') ? time() : $timestamp;
        $datetime = date('Y-m-d', $timestamp);
        return gregorian_to_jalali($datetime);
    }
}


if ( ! function_exists('gregorian_to_jalali'))
{
    function gregorian_to_jalali($g_date) // $g_date is 'YYYY-MM-DD'
    {
        list($gy, $gm, $gd) = explode('-', $g_date);

        // Convert to integers
        $gy = (int)$gy;
        $gm = (int)$gm;
        $gd = (int)$gd;

        // Logic from Jdf.php's gregorian_to_jalali_helper, attributed to jdf.scr.ir
        // This specific block is from a common PHP implementation of jdf.scr.ir logic
        // which is slightly different from the one in the user's Jdf.php but widely used and tested.
        // Let's use a very standard and tested version of jdf.scr.ir logic here.
        
        $g_d_m = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
        if ($gy > 1600) {
            $jy = 979;
            $gy -= 1600;
        } else {
            $jy = 0;
            $gy -= 621;
        }
        $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
        $days = (365 * $gy) + ((int)(($gy2 + 3) / 4)) - ((int)(($gy2 + 99) / 100)) + ((int)(($gy2 + 399) / 400)) - 80 + $gd + $g_d_m[$gm - 1];
        $jy += 33 * ((int)($days / 12053));
        $days %= 12053;
        $jy += 4 * ((int)($days / 1461));
        $days %= 1461;
        if ($days > 365) {
            $jy += (int)(($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        if ($days < 0) { // Added to handle potential negative days if logic is off for very early dates
          $days = 0;
        }
        $jm = ($days < 186) ? (1 + (int)($days / 31)) : (7 + (int)(($days - 186) / 30));
        $jd = 1 + (($days < 186) ? ($days % 31) : (($days - 186) % 30));
        
        return $jy . '/' . $jm . '/' . $jd;
    }
}

if ( ! function_exists('jalali_to_gregorian'))
{
    function jalali_to_gregorian($j_date)
    {
        list($jy, $jm, $jd) = explode('/', $j_date);
        $jy += 1595;
        $days = -355668 + (365 * $jy) + ((int)($jy / 33)) * 8 + ((int)((($jy % 33) + 3) / 4)) + $jd + (($jm < 7) ? ($jm - 1) * 31 : (($jm - 7) * 30) + 186);
        $gy = 400 * ((int)($days / 146097));
        $days %= 146097;
        if ($days > 36524) {
            $gy += 100 * ((int)(--$days / 36524));
            $days %= 36524;
            if ($days >= 365) $days++;
        }
        $gy += 4 * ((int)($days / 1461));
        $days %= 1461;
        if ($days > 365) {
            $gy += (int)(($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        $gd = $days + 1;
        foreach (array(0, 31, (((($gy % 4 == 0) and ($gy % 100 != 0)) or ($gy % 400 == 0)) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31) as $gm => $v) {
            if ($gd <= $v) break;
            $gd -= $v;
        }
        return implode('-', array($gy, sprintf('%02d', $gm), sprintf('%02d', $gd)));
    }
}

if ( ! function_exists('jmonth_name'))
{
    function jmonth_name($month_num, $short = false)
    {
        $months = array(
            1 => 'فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور',
            'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'
        );
        $short_months = array(
            1 => 'فرو', 'ارد', 'خرد', 'تیر', 'مرد', 'شهر',
            'مهر', 'آبا', 'آذر', 'دی', 'بهم', 'اسف'
        );
        return $short ? $short_months[$month_num] : $months[$month_num];
    }
}

if ( ! function_exists('jday_name'))
{
    function jday_name($day_num)
    {
        $days = array(
            1 => 'شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه', 'پنجشنبه', 'جمعه'
        );
        return $days[$day_num];
    }
}