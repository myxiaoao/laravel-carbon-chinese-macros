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

        // 元宵节
        Carbon::macro('isFirstFullMoonDay', function () {
            if ($this->lunar->isLeapMonth) {
                return false;
            }

            return $this->lunar->month === 1 && $this->lunar->day === 15;
        });

        // 端午节
        Carbon::macro('isDragonBoatDay', function () {
            if ($this->lunar->isLeapMonth) {
                return false;
            }

            return $this->lunar->month === 5 && $this->lunar->day === 5;
        });

        // 七夕
        Carbon::macro('isDoubleSeventhDay', function () {
            if ($this->lunar->isLeapMonth) {
                return false;
            }

            return $this->lunar->month === 7 && $this->lunar->day === 7;
        });

        // 中秋节
        Carbon::macro('isMidAutumnDay', function () {
            if ($this->lunar->isLeapMonth) {
                return false;
            }

            return $this->lunar->month === 8 && $this->lunar->day === 15;
        });

        // 重阳节
        Carbon::macro('isDoubleNinthDay', function () {
            if ($this->lunar->isLeapMonth) {
                return false;
            }

            return $this->lunar->month === 9 && $this->lunar->day === 9;
        });

        // 腊八节
        Carbon::macro('isLabaDay', function () {
            if ($this->lunar->isLeapMonth) {
                return false;
            }

            return $this->lunar->month === 12 && $this->lunar->day === 8;
        });

        // 北方小年
        Carbon::macro('isNorthLittleNewYearDay', function () {
            if ($this->lunar->isLeapMonth) {
                return false;
            }

            return $this->lunar->month === 12 && $this->lunar->day === 23;
        });

        // 南方小年
        Carbon::macro('isSouthLittleNewYearDay', function () {
            if ($this->lunar->isLeapMonth) {
                return false;
            }

            return $this->lunar->month === 12 && $this->lunar->day === 24;
        });

        // 除夕
        Carbon::macro('isChineseNewYearEve', function () {
            return $this->addDay()->isChineseNewYearDay();
        });
    }
}
