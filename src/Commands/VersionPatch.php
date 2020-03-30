<?php

namespace J2Nlab\SimpleVersion\Commands;

use Illuminate\Console\Command;

class VersionPatch extends Version
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:patch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment app patch number version';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $current = config('version.patch');
        $number = $current + 1;
        $this->info("New patch version: {$number}");

        config([ 'version.patch' => $number ]);
        $this->save();

        $this->info("New version: ".version('compact'));
    }
}
// vim: tabstop=4 shiftwidth=4 expandtab
