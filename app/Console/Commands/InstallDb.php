<?php

namespace App\Console\Commands;

use DB;
use Exception;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the database and run migrations';

    /**
     * The filesystem service.
     * 
     * @var Filesystem
     */
    protected $filesystem;


    /**
     * Create a new command instance.
     *
     * @param Filesystem $filesystem
     * 
     * @return void
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        ///////////////////////////////////
        // Inject the filesystem service //
        ///////////////////////////////////
        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        do {
            $info['database'] = $this->ask('How would you like to name your database?');
            $info['username'] = $this->anticipate('What is your MySQL username?', ['root']);
            $info['password'] = $this->secret('What is your MySQL password?');

            $headers = ['Database', 'Username', 'Password'];
            $data    = [[$info['database'], $info['username'], 'The password you chose']];

            $this->table($headers, $data);
        } while (!$this->confirm('Is it correct?'));

        try {
            $this->updateEnv($info);

            /////////////////////////////////////////////////////////////
            // Create the database if don't exists with the given name //
            /////////////////////////////////////////////////////////////
            DB::connection('tmp')->statement("CREATE DATABASE IF NOT EXISTS `{$info['database']}`");

            $this->info('Everything is ok, running migrations now.');

            $this->call('migrate');
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Update the .env file with user's input.
     * 
     * @param array $info
     */
    private function updateEnv(array $info)
    {
        $file = base_path('.env');

        if (!$this->filesystem->exists($file)) {
            throw new Exception("`.env` file doesn't exist.");
        }

        ////////////////////////////
        // Add permission to .env //
        ////////////////////////////
        chmod($file, 0755);

        $env = file_get_contents($file);

        $newEnv = preg_replace([
            '/DB_DATABASE=(.+)/',
            '/DB_USERNAME=(.+)/',
            '/DB_PASSWORD=(.+)/'
        ], [
            "DB_DATABASE={$info['database']}",
            "DB_USERNAME={$info['username']}",
            "DB_PASSWORD={$info['password']}"
        ], $env);

        if (($bytes = file_put_contents($file, $newEnv)) === false) {
            throw new Exception('Failed to update the `.env`');
        }

        $this->info("`.env` updated, {$bytes} bytes written.");
    }
}
