<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;

class VersionTest extends VersionTestCase
{
    public function testExecuteCommandVersion()
    {
        $exitCode = Artisan::call('version');
        $this->assertEquals(0, $exitCode);
        $this->assertEquals(
            "Version (compact): 0.0.0\nVersion (full): version 0.0.0\n",
            Artisan::output()
        );
    }

    public function testExecuteCommandVersionPatchFalse()
    {
        config([ 'version.patch' => false ]);
        $exitCode = Artisan::call('version:patch');
        $this->assertEquals(0, $exitCode);
        $this->assertEquals(
            "No patch number!\n",
            Artisan::output()
        );
    }

    public function testExecuteCommandVersionPatch()
    {
        $exitCode = Artisan::call('version:patch');
        $this->assertEquals(0, $exitCode);
        $this->assertEquals(
            "New patch version: 1\nNew version: 0.0.1\n",
            Artisan::output()
        );
    }

    public function testExecuteCommandVersionMinor()
    {
        $exitCode = Artisan::call('version:minor');
        $this->assertEquals(0, $exitCode);
        $this->assertEquals(
            "New minor version: 1\nNew version: 0.1.0\n",
            Artisan::output()
        );
    }

    public function testExecuteCommandVersionMajor()
    {
        $exitCode = Artisan::call('version:major');
        $this->assertEquals(0, $exitCode);
        $this->assertEquals(
            "New major version: 1\nNew version: 1.0.0\n",
            Artisan::output()
        );
    }

    public function testExecuteCommandVersionBuildFalse()
    {
        $exitCode = Artisan::call('version:build');
        $this->assertEquals(0, $exitCode);
        $this->assertEquals(
            "No build number!\n",
            Artisan::output()
        );
    }

    public function testExecuteCommandVersionBuild()
    {
        config([ 'version.build' => '0' ]);
        $exitCode = Artisan::call('version:build');
        $this->assertEquals(0, $exitCode);
        $this->assertEquals(
            "New build number: 1\nNew version: 0.0.0-1\n",
            Artisan::output()
        );
    }

    public function testExecuteCommandVersionCommitFalse()
    {
        $exitCode = Artisan::call('version:commit');
        $this->assertEquals(0, $exitCode);
        $this->assertEquals(
            "No commit number!\n",
            Artisan::output()
        );
    }

    public function testHelperFunction()
    {

        $result = version();
        $this->assertEquals("0.0.0", $result);

        $result = version('compact');
        $this->assertEquals("0.0.0", $result);

        $result = version('full');
        $this->assertEquals("version 0.0.0", $result);
    }

    public function testBladeVersion()
    {
        $result = $this->render(Blade::compileString('@version'));
        $this->assertEquals("0.0.0", $result);

        $result = $this->render(Blade::compileString("@version('compact')"));
        $this->assertEquals("0.0.0", $result);

        $result = $this->render(Blade::compileString("@version('full')"));
        $this->assertEquals("version 0.0.0", $result);
    }

    public function render($view)
    {
        ob_get_level();
        ob_start();
        eval('?'.'>'.$view);
        return ob_get_clean();
    }

}
// vim: tabstop=4 shiftwidth=4 expandtab
