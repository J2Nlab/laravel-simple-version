<?php

namespace J2Nlab\SimpleVersion\Commands;

use Illuminate\Console\Command;

class VersionCommit extends Version
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:commit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get last app commit number';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $current = config('version.commit');
        if ($current === false) {
            $this->info("No commit number!");
        } else {
            $number = exec('git rev-parse --verify HEAD | cut -c-6');
            $this->info("New commit number: {$number}");

            config([ 'version.commit' => $number ]);
            $this->save();

            $this->info("New version: ".version('compact'));
        }
    }
}
// vim: tabstop=4 shiftwidth=4 expandtab
