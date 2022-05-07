<?php

namespace Cooper\CarbonChineseMacros;

use Cooper\CarbonChineseMacros\Traits\SolarDates;
use Cooper\CarbonChineseMacros\Traits\LunarDates;
use Illuminate\Support\ServiceProvider;

class CarbonChineseMacrosServiceProvider extends ServiceProvider
{
    use SolarDates;
    use LunarDates;

    public function register(): void
    {
        // 阳历节日
        $this->registerSolarDates();

        // 阴历节日
        $this->registerLunarDates();
    }
}
