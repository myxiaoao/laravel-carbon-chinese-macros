#!/usr/bin/env php
<?php

use CarbonChineseMacros\Command\GenerateIdeHelpers;
use Illuminate\Console\Application;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;

include './vendor/autoload.php';

if (!function_exists('cmd_path')) {
    function cmd_path(string $path = null): string
    {
        return $path ? __DIR__."/$path" : __DIR__;
    }
}

$container = new Container();
$app = new Application($container, new Dispatcher($container), '1.0');
$app->add(new GenerateIdeHelpers);
$app->run();
