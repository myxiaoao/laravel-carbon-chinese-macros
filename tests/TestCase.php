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

    public function tearDown() : void
    {
        parent::tearDown();
    }
}
