<?php

namespace Tests;

use Orchestra\Testbench\TestCase;
use J2Nlab\SimpleVersion\ServiceProvider as VersionServiceProvider;

abstract class VersionTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [VersionServiceProvider::class];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('version', require __DIR__.'/../config/version.php');
    }
}
// vim: tabstop=4 shiftwidth=4 expandtab
