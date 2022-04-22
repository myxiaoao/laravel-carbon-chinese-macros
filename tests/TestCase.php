<?php

namespace CarbonChineseMacros;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    public function setUp() : void
    {
        parent::setUp();
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

    public function tearDown() : void
    {
        parent::tearDown();
    }
}
