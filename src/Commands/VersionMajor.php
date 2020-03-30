<?php

namespace J2Nlab\SimpleVersion\Commands;

use Illuminate\Console\Command;

class VersionMajor extends Version
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:major';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment app major number version';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $current = config('version.major');
        $number = $current + 1;
        $this->info("New major version: {$number}");

        config([ 'version.major' => $number ]);
        config([ 'version.minor' => 0 ]);
        config([ 'version.patch' => 0 ]);
        $this->save();

        $this->info("New version: ".version('compact'));
    }
}
// vim: tabstop=4 shiftwidth=4 expandtab
