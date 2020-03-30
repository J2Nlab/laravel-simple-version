<?php

namespace J2Nlab\SimpleVersion\Commands;

use Illuminate\Console\Command;

class VersionBuild extends Version
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment app build number';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $current = config('version.build');

        if ($current === false) {
            $this->info("No build number!");
        } else {
            $number = $current + 1;
            $this->info("New build number: {$number}");

            config([ 'version.build' => $number ]);
            $this->save();

            $this->info("New version: ".version('compact'));
        }
    }
}
// vim: tabstop=4 shiftwidth=4 expandtab
