<?php

namespace Cooper\CarbonChineseMacros\Test;

use Illuminate\Support\Carbon;

class SolarDatesTest extends TestCase {
    /**
     * @dataProvider provideNewYearsDayData
     */
    public function test_it_knows_new_years_day($date, $validity): void
    {
        $date = Carbon::parse($date);

        $this->assertSame($validity, $date->isNewYearsDay());
    }

    public function provideNewYearsDayData(): array
    {
        return [
            '1963-11-22' => ['1963-11-22', false],
            '1970-01-01' => ['1970-01-01', true],
            '1982-01-01' => ['1982-01-01', true],
            '1999-12-31' => ['1999-12-31', false],
            '2020-01-01' => ['2020-01-01', true],
            '2020-01-02' => ['2020-01-02', false],
            '2050-01-01' => ['2050-01-01', true],
            '2038-01-19' => ['2038-01-19', false],
        ];
    }
}