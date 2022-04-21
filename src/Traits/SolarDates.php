<?php

namespace CarbonChineseMacros\Traits;

use Illuminate\Support\Carbon;

trait SolarDates
{
    public function registerSolarDates(): void
    {
        // 元旦
        Carbon::macro('isNewYearsDay', function () {
            return $this->month === 1 && $this->day === 1;
        });

        // 情人节
        Carbon::macro('isValentinesDay', function () {
            return $this->month === 2 && $this->day === 14;
        });

        // 妇女节
        Carbon::macro('isWomenDay',function (){
            return $this->month === 3 && $this->day === 8;
        });

        // 植树节
        Carbon::macro('isArborDay', function () {
            return $this->month === 3 && $this->day === 12;
        });

        // 愚人节
        Carbon::macro('isAprilFoolsDay', function () {
            return $this->month === 4 && $this->day === 1;
        });

        // 劳动节
        Carbon::macro('isLabourDay',function (){
            return $this->month === 5 && $this->day === 1;
        });

        // 青年节
        Carbon::macro('isYouthDay',function (){
            return $this->month === 5 && $this->day === 4;
        });

        // 儿童节
        Carbon::macro('isChildrenDay',function (){
            return $this->month === 6 && $this->day === 1;
        });

        // 国庆节
        Carbon::macro('isNationalDay', function () {
            return $this->month === 10 && $this->day === 1;
        });

        // 万圣节
        Carbon::macro('isHalloween',function (){
            return $this->month === 10 && $this->day === 31;
        });

        // 平安夜
        Carbon::macro('isChristmasEve', function () {
            return $this->month === 12 && $this->day === 24;
        });

        // 圣诞节
        Carbon::macro('isChristmasDay', function () {
            return $this->month === 12 && $this->day === 25;
        });
    }
}
