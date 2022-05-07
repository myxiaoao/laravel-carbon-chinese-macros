<?php

namespace Cooper\CarbonChineseMacros\Traits;

use Illuminate\Support\Carbon;

trait SolarDates
{
    public function registerSolarDates(): void
    {
        if (!Carbon::hasMacro('isNewYearsDay')) {
            // 元旦
            Carbon::macro('isNewYearsDay', function () {
                return $this->month === 1 && $this->day === 1;
            });
        }

        if (!Carbon::hasMacro('isValentinesDay')) {
            // 情人节
            Carbon::macro('isValentinesDay', function () {
                return $this->month === 2 && $this->day === 14;
            });
        }

        if (!Carbon::hasMacro('isWomenDay')) {
            // 妇女节
            Carbon::macro('isWomenDay', function () {
                return $this->month === 3 && $this->day === 8;
            });
        }

        if (!Carbon::hasMacro('isArborDay')) {
            // 植树节
            Carbon::macro('isArborDay', function () {
                return $this->month === 3 && $this->day === 12;
            });
        }

        if (!Carbon::hasMacro('isAprilFoolsDay')) {
            // 愚人节
            Carbon::macro('isAprilFoolsDay', function () {
                return $this->month === 4 && $this->day === 1;
            });
        }

        if (!Carbon::hasMacro('isLabourDay')) {
            // 劳动节
            Carbon::macro('isLabourDay', function () {
                return $this->month === 5 && $this->day === 1;
            });
        }

        if (!Carbon::hasMacro('isYouthDay')) {
            // 青年节
            Carbon::macro('isYouthDay', function () {
                return $this->month === 5 && $this->day === 4;
            });
        }

        if (!Carbon::hasMacro('isChildrenDay')) {
            // 儿童节
            Carbon::macro('isChildrenDay', function () {
                return $this->month === 6 && $this->day === 1;
            });
        }

        if (!Carbon::hasMacro('isNationalDay')) {
            // 国庆节
            Carbon::macro('isNationalDay', function () {
                return $this->month === 10 && $this->day === 1;
            });
        }

        if (!Carbon::hasMacro('isHalloween')) {
            // 万圣节
            Carbon::macro('isHalloween', function () {
                return $this->month === 10 && $this->day === 31;
            });
        }

        if (!Carbon::hasMacro('isChristmasEve')) {
            // 平安夜
            Carbon::macro('isChristmasEve', function () {
                return $this->month === 12 && $this->day === 24;
            });
        }

        if (!Carbon::hasMacro('isChristmasDay')) {
            // 圣诞节
            Carbon::macro('isChristmasDay', function () {
                return $this->month === 12 && $this->day === 25;
            });
        }
    }
}
