<?php

namespace CarbonChineseMacros;

use Illuminate\Support\Carbon;

class LunarDatesTest extends TestCase
{
    /**
     * @dataProvider provideLeapYearsDayData
     */
    public function test_it_knows_leap_years_day($date, $validity): void
    {
        $date = Carbon::parse($date);

        $this->assertSame($validity, $date->isLeapYear());
    }

    public function provideLeapYearsDayData(): array
    {
        return [
            '1900-10-10' => ['1900-10-10', false],
            '2000-10-10' => ['2000-10-10', true],
            '2010-10-10' => ['2010-10-10', false],
            '2020-10-10' => ['2020-10-10', true],
        ];
    }

    public function test_it_get_lunar_day(): void
    {
        $date = Carbon::parse('2022-02-10 23:10');
        $this->assertEquals('壬寅', $date->lunarYearName);
    }


}