<?php

namespace Tests;

use Orchestra\Testbench\TestCase;
use J2Nlab\SimpleVersion\ServiceProvider as VersionServiceProvider;

abstract class VersionTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        copy(
            __DIR__.'/../config/version.php',
            config_path('version.php')
        );

        return [VersionServiceProvider::class];
    }
}
// vim: tabstop=4 shiftwidth=4 expandtab
