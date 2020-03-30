<?php

namespace J2Nlab\SimpleVersion\Commands;

use Illuminate\Console\Command;

class VersionMinor extends Version
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:minor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment app minor number version';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $current = config('version.minor');
        $number = $current + 1;
        $this->info("New minor version: {$number}");

        config([ 'version.minor' => $number ]);
        config([ 'version.patch' => 0 ]);
        $this->save();

        $this->info("New version: ".version('compact'));
    }
}
// vim: tabstop=4 shiftwidth=4 expandtab
