<?php

namespace Cooper\CarbonChineseMacros;

use Illuminate\Support\Carbon;

class Lunar
{
    /**
     * 阴历 1900-2100 的润大小信息
     *
     * @var array
     */
    private const LUNAR_ARR = [
        0x04bd8, 0x04ae0, 0x0a570, 0x054d5, 0x0d260, 0x0d950, 0x16554, 0x056a0, 0x09ad0, 0x055d2, // 1900-1909
        0x04ae0, 0x0a5b6, 0x0a4d0, 0x0d250, 0x1d255, 0x0b540, 0x0d6a0, 0x0ada2, 0x095b0, 0x14977, // 1910-1919
        0x04970, 0x0a4b0, 0x0b4b5, 0x06a50, 0x06d40, 0x1ab54, 0x02b60, 0x09570, 0x052f2, 0x04970, // 1920-1929
        0x06566, 0x0d4a0, 0x0ea50, 0x06e95, 0x05ad0, 0x02b60, 0x186e3, 0x092e0, 0x1c8d7, 0x0c950, // 1930-1939
        0x0d4a0, 0x1d8a6, 0x0b550, 0x056a0, 0x1a5b4, 0x025d0, 0x092d0, 0x0d2b2, 0x0a950, 0x0b557, // 1940-1949
        0x06ca0, 0x0b550, 0x15355, 0x04da0, 0x0a5b0, 0x14573, 0x052b0, 0x0a9a8, 0x0e950, 0x06aa0, // 1950-1959
        0x0aea6, 0x0ab50, 0x04b60, 0x0aae4, 0x0a570, 0x05260, 0x0f263, 0x0d950, 0x05b57, 0x056a0, // 1960-1969
        0x096d0, 0x04dd5, 0x04ad0, 0x0a4d0, 0x0d4d4, 0x0d250, 0x0d558, 0x0b540, 0x0b6a0, 0x195a6, // 1970-1979
        0x095b0, 0x049b0, 0x0a974, 0x0a4b0, 0x0b27a, 0x06a50, 0x06d40, 0x0af46, 0x0ab60, 0x09570, // 1980-1989
        0x04af5, 0x04970, 0x064b0, 0x074a3, 0x0ea50, 0x06b58, 0x055c0, 0x0ab60, 0x096d5, 0x092e0, // 1990-1999
        0x0c960, 0x0d954, 0x0d4a0, 0x0da50, 0x07552, 0x056a0, 0x0abb7, 0x025d0, 0x092d0, 0x0cab5, // 2000-2009
        0x0a950, 0x0b4a0, 0x0baa4, 0x0ad50, 0x055d9, 0x04ba0, 0x0a5b0, 0x15176, 0x052b0, 0x0a930, // 2010-2019
        0x07954, 0x06aa0, 0x0ad50, 0x05b52, 0x04b60, 0x0a6e6, 0x0a4e0, 0x0d260, 0x0ea65, 0x0d530, // 2020-2029
        0x05aa0, 0x076a3, 0x096d0, 0x04afb, 0x04ad0, 0x0a4d0, 0x1d0b6, 0x0d250, 0x0d520, 0x0dd45, // 2030-2039
        0x0b5a0, 0x056d0, 0x055b2, 0x049b0, 0x0a577, 0x0a4b0, 0x0aa50, 0x1b255, 0x06d20, 0x0ada0, // 2040-2049
        0x14b63, 0x09370, 0x049f8, 0x04970, 0x064b0, 0x168a6, 0x0ea50, 0x06b20, 0x1a6c4, 0x0aae0, // 2050-2059
        0x0a2e0, 0x0d2e3, 0x0c960, 0x0d557, 0x0d4a0, 0x0da50, 0x05d55, 0x056a0, 0x0a6d0, 0x055d4, // 2060-2069
        0x052d0, 0x0a9b8, 0x0a950, 0x0b4a0, 0x0b6a6, 0x0ad50, 0x055a0, 0x0aba4, 0x0a5b0, 0x052b0, // 2070-2079
        0x0b273, 0x06930, 0x07337, 0x06aa0, 0x0ad50, 0x14b55, 0x04b60, 0x0a570, 0x054e4, 0x0d160, // 2080-2089
        0x0e968, 0x0d520, 0x0daa0, 0x16aa6, 0x056d0, 0x04ae0, 0x0a9d4, 0x0a2d0, 0x0d150, 0x0f252, // 2090-2099
        0x0d520, // 2100
    ];
    private const SKY = ['庚', '辛', '壬', '癸', '甲', '乙', '丙', '丁', '戊', '己'];
    private const EARTH = ['申', '酉', '戌', '亥', '子', '丑', '寅', '卯', '辰', '巳', '午', '未'];
    private const ZODIAC = ['猴', '鸡', '狗', '猪', '鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊'];

    /**
     * 阳历转阴历.
     *
     * @param  int       $year
     * @param  int       $month
     * @param  int       $day
     * @param  int|null  $hour
     *
     * @return object
     */
    public static function solar2lunar(int $year, int $month, int $day, int $hour = null): object
    {
        // 参数区间 1900.1.31 ~ 2100.12.31
        if ($year < 1900 || $year > 2100) {
            throw new \InvalidArgumentException("不支持的年份:{$year}");
        }
        // 年份限定、上限
        if (1900 === $year && 1 === $month && $day < 31) {
            throw new \InvalidArgumentException("不支持的日期:{$year}-{$month}-{$day}");
        }

        $day = 23 === $hour ? $day + 1 : $day; // 23 点过后算子时，阴历以子时为一天的起始
        $offset = Carbon::parse("{$year}-{$month}-{$day}")->diffInDays('1900-01-31');

        // 阴历年
        $lunarYear = static::getLunarYear($offset);

        // 阴历月
        $isLeapMouth = false;
        $lunarMonth = static::getLunarMonth($lunarYear, $isLeapMouth, $offset);

        // 阴历日
        $lunarDay = $offset + 1;

        return (object) [
            'year' => $lunarYear,  // 阴历年
            'month' => $lunarMonth,  // 阴历月
            'day' => $lunarDay,  // 阴历日
            'isLeapMonth' => $isLeapMouth,  // 是否闰月
        ];
    }

    /**
     * @param  int  $offset
     *
     * @return int
     */
    private static function getLunarYear(int &$offset): int
    {
        $daysOfYear = 0;
        for ($lunarYear = 1900; $lunarYear < 2101 && $offset > 0; ++$lunarYear) {
            $daysOfYear = static::daysOfYear($lunarYear);
            $offset -= $daysOfYear;
        }
        if ($offset < 0) {
            $offset += $daysOfYear;
            --$lunarYear;
        }

        return $lunarYear;
    }

    /**
     * 返回阴历指定年的总天数.
     *
     * @param  int  $year
     *
     * @return int
     */
    private static function daysOfYear(int $year): int
    {
        $sum = 348;

        for ($i = 0x8000; $i > 0x8; $i >>= 1) {
            $sum += (static::LUNAR_ARR[$year - 1900] & $i) ? 1 : 0;
        }

        return $sum + static::leapDays($year);
    }

    /**
     * 返回阴历 y 年闰月的天数 若该年没有闰月则返回 0
     *
     * @param  int  $year
     *
     * @return int
     */
    private static function leapDays(int $year): int
    {
        if (static::leapMonth($year)) {
            return (static::LUNAR_ARR[$year - 1900] & 0x10000) ? 30 : 29;
        }

        return 0;
    }

    /**
     * 返回阴历 y 年闰月是哪个月；若 y 年没有闰月 则返回 0
     *
     * @param  int  $year
     *
     * @return int
     */
    private static function leapMonth(int $year): int
    {
        // 闰字编码 \u95f0
        return static::LUNAR_ARR[$year - 1900] & 0xf;
    }

    /**
     * @param  int   $lunarYear
     * @param  bool  $isLeapMouth
     * @param  int   $offset
     *
     * @return int
     */
    private static function getLunarMonth(int $lunarYear, bool &$isLeapMouth, int &$offset): int
    {
        $daysOfMonth = 0;
        $leap = static::leapMonth($lunarYear); // 闰哪个月
        // 用当年的天数 offset,逐个减去每月（阴历）的天数，求出当天是本月的第几天
        for ($lunarMonth = 1; $lunarMonth < 13 && $offset > 0; ++$lunarMonth) {
            // 闰月
            if ($leap > 0 && $lunarMonth === ($leap + 1) && !$isLeapMouth) {
                --$lunarMonth;
                $isLeapMouth = true;
                $daysOfMonth = static::leapDays($lunarYear); // 计算阴历月天数
            } else {
                $daysOfMonth = static::lunarDays($lunarYear, $lunarMonth); // 计算阴历普通月天数
            }

            // 解除闰月
            if (true === $isLeapMouth && $lunarMonth === ($leap + 1)) {
                $isLeapMouth = false;
            }

            $offset -= $daysOfMonth;
        }

        // offset 为 0 时，并且刚才计算的月份是闰月，要校正
        if (0 === $offset && $leap > 0 && $lunarMonth === $leap + 1) {
            if ($isLeapMouth) {
                $isLeapMouth = false;
            } else {
                $isLeapMouth = true;
                --$lunarMonth;
            }
        }

        if ($offset < 0) {
            $offset += $daysOfMonth;
            --$lunarMonth;
        }

        return $lunarMonth;
    }

    /**
     * 返回阴历 y 年 m 月（非闰月）的总天数，计算 m 为闰月时的天数请使用 leapDays 方法
     *
     * @param  int  $year
     * @param  int  $month
     *
     * @return int
     */
    private static function lunarDays(int $year, int $month): int
    {
        // 月份参数从 1 至 12，参数错误返回 -1
        if ($month > 12 || $month < 1) {
            return -1;
        }

        return (static::LUNAR_ARR[$year - 1900] & (0x10000 >> $month)) ? 30 : 29;
    }

    /**
     * @param  int  $year
     *
     * @return string
     */
    public static function getYearZodiac(int $year): string
    {
        return static::ZODIAC[$year % 12];
    }

    /**
     * @param  int  $year
     *
     * @return string
     */
    public static function getLunarYearName(int $year): string
    {
        return static::SKY[((string) $year)[3]].static::EARTH[$year % 12];
    }
}