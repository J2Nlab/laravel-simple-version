<?php

namespace J2Nlab\SimpleVersion\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ExceptionInterface;
use Symfony\Component\Process\Process;

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
            return Command::SUCCESS;
        }

        $process = new Process(['git', 'rev-parse', '--verify', 'HEAD']);
        try {
            $process->run();
        } catch (ExceptionInterface $e) {
            $this->error("Cannot run git: {$e->getMessage()}");
            return Command::FAILURE;
        }

        if (!$process->isSuccessful()) {
            $this->error("git rev-parse failed: ".trim($process->getErrorOutput()));
            return Command::FAILURE;
        }

        $number = substr(trim($process->getOutput()), 0, 6);
        if ($number === '') {
            $this->error("git returned an empty commit hash");
            return Command::FAILURE;
        }

        $this->info("New commit number: {$number}");

        config([ 'version.commit' => $number ]);
        $this->save();

        $this->info("New version: ".version('compact'));

        return Command::SUCCESS;
    }
}
// vim: tabstop=4 shiftwidth=4 expandtab
