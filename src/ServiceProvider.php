<?php

namespace J2Nlab\SimpleVersion;

use Illuminate\Support\ServiceProvider as SP;
use Illuminate\Support\Facades\Blade;

use J2Nlab\SimpleVersion\Commands\Version;
use J2Nlab\SimpleVersion\Commands\VersionMajor;
use J2Nlab\SimpleVersion\Commands\VersionMinor;
use J2Nlab\SimpleVersion\Commands\VersionPatch;
use J2Nlab\SimpleVersion\Commands\VersionBuild;
use J2Nlab\SimpleVersion\Commands\VersionCommit;

class ServiceProvider extends SP
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * All console commands.
     *
     * @var array
     */
    protected $allCommands = [
        'command.simple-version.version' => Version::class,
        'command.simple-version.version.major' => VersionMajor::class,
        'command.simple-version.version.minor' => VersionMinor::class,
        'command.simple-version.version.patch' => VersionPatch::class,
        'command.simple-version.version.build' => VersionBuild::class,
        'command.simple-version.version.commit' => VersionCommit::class,
    ];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        /* Publish configuratin file */
        $this->publishes([ __DIR__.'/../config/version.php' => config_path('version.php') ]);

        /* Register Blade directives */
        Blade::directive('version', function ($format = 'compact') {
            return "<?php echo version($format); ?>";
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /* Register Artisan commands */
        foreach ($this->allCommands as $command => $class) {
            $this->app->singleton($command, function () use ($class) {
                return new $class();
            });
            $this->commands($command);
        };
    }
}
// vim: tabstop=4 shiftwidth=4 expandtab
