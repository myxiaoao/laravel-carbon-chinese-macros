<?php

namespace Cooper\CarbonChineseMacros\Traits;

use Cooper\CarbonChineseMacros\Lunar;
use Illuminate\Support\Carbon;

trait LunarDates
{
    public function registerLunarDates(): void
    {
        if (!Carbon::hasMacro('getLunar')) {
            // 阳历转换为阴历
            Carbon::macro('getLunar', function () {
                return Lunar::solar2lunar($this->year, $this->month, $this->day, $this->hour);
            });
        }

        if (!Carbon::hasMacro('getYearZodiac')) {
            // 获取生肖
            Carbon::macro('getYearZodiac', function () {
                return Lunar::getYearZodiac($this->lunar->year);
            });
        }

        if (!Carbon::hasMacro('getLunarYearName')) {
            // 获取干支纪年
            Carbon::macro('getLunarYearName', function () {
                return Lunar::getLunarYearName($this->lunar->year);
            });
        }

        if (!Carbon::hasMacro('isChineseNewYearDay')) {
            // 春节
            Carbon::macro('isChineseNewYearDay', function () {
                if ($this->lunar->isLeapMonth) {
                    return false;
                }

                return $this->lunar->month === 1 && $this->lunar->day === 1;
            });
        }

        if (!Carbon::hasMacro('isFirstFullMoonDay')) {
            // 元宵节
            Carbon::macro('isFirstFullMoonDay', function () {
                if ($this->lunar->isLeapMonth) {
                    return false;
                }

                return $this->lunar->month === 1 && $this->lunar->day === 15;
            });
        }

        if (!Carbon::hasMacro('isDragonBoatDay')) {
            // 端午节
            Carbon::macro('isDragonBoatDay', function () {
                if ($this->lunar->isLeapMonth) {
                    return false;
                }

                return $this->lunar->month === 5 && $this->lunar->day === 5;
            });
        }

        if (!Carbon::hasMacro('isDoubleSeventhDay')) {
            // 七夕
            Carbon::macro('isDoubleSeventhDay', function () {
                if ($this->lunar->isLeapMonth) {
                    return false;
                }

                return $this->lunar->month === 7 && $this->lunar->day === 7;
            });
        }

        if (!Carbon::hasMacro('isMidAutumnDay')) {
            // 中秋节
            Carbon::macro('isMidAutumnDay', function () {
                if ($this->lunar->isLeapMonth) {
                    return false;
                }

                return $this->lunar->month === 8 && $this->lunar->day === 15;
            });
        }

        if (!Carbon::hasMacro('isDoubleNinthDay')) {
            // 重阳节
            Carbon::macro('isDoubleNinthDay', function () {
                if ($this->lunar->isLeapMonth) {
                    return false;
                }

                return $this->lunar->month === 9 && $this->lunar->day === 9;
            });
        }

        if (!Carbon::hasMacro('isLabaDay')) {
            // 腊八节
            Carbon::macro('isLabaDay', function () {
                if ($this->lunar->isLeapMonth) {
                    return false;
                }

                return $this->lunar->month === 12 && $this->lunar->day === 8;
            });
        }

        if (!Carbon::hasMacro('isNorthLittleNewYearDay')) {
            // 北方小年
            Carbon::macro('isNorthLittleNewYearDay', function () {
                if ($this->lunar->isLeapMonth) {
                    return false;
                }

                return $this->lunar->month === 12 && $this->lunar->day === 23;
            });
        }

        if (!Carbon::hasMacro('isSouthLittleNewYearDay')) {
            // 南方小年
            Carbon::macro('isSouthLittleNewYearDay', function () {
                if ($this->lunar->isLeapMonth) {
                    return false;
                }

                return $this->lunar->month === 12 && $this->lunar->day === 24;
            });
        }

        if (!Carbon::hasMacro('isChineseNewYearEve')) {
            // 除夕
            Carbon::macro('isChineseNewYearEve', function () {
                return $this->addDay()->isChineseNewYearDay();
            });
        }
    }
}
