<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BuildClientAppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:client-build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build client client for production';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->warn('Compiling client files');
        $this->info(shell_exec ('cd client && yarn build'));
        $this->info('Client files compiled');

        $this->warn('Moving compiled filed to laravel public fold');
        $basepath = base_path('client/dist');
        $destpath = "$basepath/_nuxt";
        foreach(scandir($basepath) as $file) {
            if (!in_array($file, ['.', '..'])) {
                $full_file_path = "$basepath/$file";
                if (is_file($full_file_path)) {
                    File::copy($full_file_path, "$destpath/$file");
                }

            }
        }
        @File::deleteDirectory(public_path('_nuxt'));
        File::copyDirectory( $destpath, public_path('_nuxt'));
        $this->info('Laravel app is ready for production');

    }
}
