<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use PDO;

class InitAppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->warn('Creating database');
        $driver = config('database.default');
        $database = config("database.connections.$driver.database");
        $username = config("database.connections.$driver.username");
        $password = config("database.connections.$driver.password");
        $host = config("database.connections.$driver.host");
        $port = config("database.connections.$driver.port");
        $connection = $dbh = new PDO("mysql:host=$host:$port", $username, $password);
        $connection->exec("DROP DATABASE IF EXISTS ".$database);
        $connection->exec("CREATE DATABASE ".$database);
        $this->info("Database created");

        $this->warn('Installing passport');
        Artisan::call('migrate:refresh');
        Artisan::call('passport:install');
        $this->info('Passport installed');

        $this->warn('Run seeder');
        Artisan::call('db:seed');
        $this->info('App is ready');
    }
}
