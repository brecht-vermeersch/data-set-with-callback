<?php

namespace Lurza\ArrMacros\Tests;

use Lurza\ArrMacros\ArrMacrosServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            ArrMacrosServiceProvider::class,
        ];
    }
}