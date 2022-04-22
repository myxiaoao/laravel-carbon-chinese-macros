# Laravel Carbon Chinese Macros

`Illuminate\Support\Carbon` 中文拓展包

## 使用方法

### 阳历节日

- isNewYearsDay `元旦`
- isValentinesDay `情人节`
- isWomenDay `妇女节`
- isArborDay `植树节`
- isAprilFoolsDay `愚人节`
- isLabourDay `劳动节`
- isYouthDay `青年节`
- isChildrenDay `儿童节`
- isNationalDay `国庆节`
- isHalloween `万圣节`
- isChristmasEve `平安夜`
- isChristmasDay `圣诞节`

### 阴历节日

- isChineseNewYearDay `春节`
- isFirstFullMoonDay `元宵节`
- isDragonBoatDay `端午节`
- isDoubleSeventhDay `七夕`
- isMidAutumnDay `中秋节`
- isDoubleNinthDay `重阳节`
- isLabaDay `腊八节`
- isNorthLittleNewYearDay `北方小年`
- isSouthLittleNewYearDay `南方小年`
- isChineseNewYearEve `除夕`

### 其他

- getYearZodiac `获取生肖`
- getLunarYearName `获取干支纪年`
- getLunar `获取阴历日期`

## 安装

#### 使用 Composer 安装

```
composer require cooper/laravel-carbon-chinese-macros
```

## 例子

```php
<?php

use Illuminate\Support\Carbon;

$day = Carbon::parse('2022-12-25');

$day->isChristmasDay();
// true

$day->isNewYearsDay();
// false
```