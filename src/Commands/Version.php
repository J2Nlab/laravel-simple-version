<?php

namespace J2Nlab\SimpleVersion\Commands;

use Illuminate\Console\Command;

class Version extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show current app version';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Version (compact): ".version('compact'));
        $this->info("Version (full): ".version('full'));
    }

    protected function save()
    {
        $text = "<?php\n\nreturn " .
            var_export(config('version'), true) .
            ";\n// vim: tabstop=4 shiftwidth=4 expandtab\n";

        file_put_contents(config_path('version.php'), $text);
    }
}
// vim: tabstop=4 shiftwidth=4 expandtab
