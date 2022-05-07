#!/usr/bin/env php
<?php

use Cooper\CarbonChineseMacros\Command\GenerateIdeHelpers;
use Illuminate\Console\Application;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;

include './vendor/autoload.php';

$container = new Container();
$app = new Application($container, new Dispatcher($container), '1.0');
$app->add(new GenerateIdeHelpers);
$app->run();
