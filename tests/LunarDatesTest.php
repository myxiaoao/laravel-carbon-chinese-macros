<?php

namespace Cooper\CarbonChineseMacros\Test;

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

    /**
     * @dataProvider provideChineseNewYearEveData
     */
    public function test_is_chinese_new_year_eve($date, $validity): void
    {
        $date = Carbon::parse($date);

        $this->assertSame($validity, $date->isChineseNewYearEve());
    }

    public function provideChineseNewYearEveData(): array
    {
        return [
            '2022-01-31' => ['2022-01-31', true],
            '2021-02-11' => ['2021-02-11', true],
            '2018-02-15' => ['2018-02-15', true],
            '1986-02-08' => ['1986-02-08', true],
            '1949-01-28' => ['1949-01-28', true],
        ];
    }
}