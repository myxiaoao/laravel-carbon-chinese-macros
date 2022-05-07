<?php

namespace Cooper\CarbonChineseMacros\Test;

use Cooper\CarbonChineseMacros\CarbonChineseMacrosServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    protected function getPackageProviders($app): array
    {
        return [
            CarbonChineseMacrosServiceProvider::class
        ];
    }

    protected function getApplicationTimezone($app): string
    {
        return 'Asia/Shanghai';
    }
}
