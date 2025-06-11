<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jdf {
    public function gregorian_to_jalali($date = null) {
        $date = $date ? strtotime($date) : time();
        $gregorian = date('Y-m-d', $date);
        list($gy, $gm, $gd) = explode('-', $gregorian);

        return $this->gregorian_to_jalali_helper($gy, $gm, $gd);
    }

    private function gregorian_to_jalali_helper($gy, $gm, $gd) {
        // منبع تابع تبدیل تاریخ میلادی به شمسی
        // منبع: https://jdf.scr.ir 
        $g_d_m = [0,31,59,90,120,151,181,212,242,273,303,334];
        $de = 226894 + (int)(($gy - 1979)*365.25) + $g_d_m[(int)$gm - 1] + $gd;
        $mod = $de % 12843; 
        $m = (int)($mod / 6420);
        $mod = $mod % 6420;
        $n = (int)(($mod / 1284) * 2 + 29);
        $mod = $mod % 1284;
        $d = (int)(($mod / 367) * 2 + 1);
        $mod = $mod % 367;
        $y = 979 + 33 * (int)(($de - 12843)/4827) + 4 * (int)(($mod)/1284) + (int)(($mod)/367) + 2;

        $months = [ '', 'فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند' ];
        $month = $n;
        $day = $d;
        $year = $y;

        return [$year, $month, $day];
    }

    public function jalali_to_gregorian($jy, $jm, $jd) {
        // تابع تبدیل تاریخ شمسی به میلادی
        // منبع: https://jdf.scr.ir 
        if ($jy > 979) {
            $jy -= 979;
            $jm += 1;
            $jd += 1;
        }
        $jy += 1;
        $days = -355668 + (int)(($jy < 1) ? 0 : ($jy * 365)) + (int)(($jm < 13) ? ($jm * 30.6001) : 0) + $jd + ((int)(($jy / 33) * 0.0301));
        return date('Y-m-d', $days * 86400);
    }
}