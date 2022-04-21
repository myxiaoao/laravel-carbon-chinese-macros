<?php

namespace CarbonChineseMacros\Traits;

use CarbonChineseMacros\Lunar;
use Illuminate\Support\Carbon;

trait LunarDates
{
    public function registerLunarDates(): void
    {
        // 阳历转换为阴历
        Carbon::macro('getLunar', function () {
            return Lunar::solar2lunar($this->year, $this->month, $this->day, $this->hour);
        });

        // 获取生肖
        Carbon::macro('getYearZodiac', function () {
            return Lunar::getYearZodiac($this->lunar->year);
        });

        // 获取干支纪年
        Carbon::macro('getLunarYearName', function () {
            return Lunar::getLunarYearName($this->lunar->year);
        });

        // 春节
        Carbon::macro('isChineseNewYearDay', function () {
            if ($this->lunar->isLeapMonth) {
                return false;
            }

            return $this->lunar->month === 1 && $this->lunar->day === 1;
        });
    }
}
