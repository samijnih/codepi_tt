<?php

namespace App\Console\Commands;

use DB;
use Exception;

use App\Models\User;
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
        ////////////////////////////////////////
        // Duplicate `.env.example` to `.env` //
        ////////////////////////////////////////
        exec("php -r \"copy('.env.example', '.env');\"");

        ////////////////////////////////////////////////////
        // STDIN to update the .env's database connection //
        ////////////////////////////////////////////////////
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

            sleep(1);

            /////////////////////////////////////////////
            // Create the database if it doesn't exist //
            /////////////////////////////////////////////
            DB::connection('tmp')->statement("CREATE DATABASE IF NOT EXISTS `{$info['database']}`");

            $this->info('Everything is ok, running migrations now.');
            $this->call('migrate');

            $this->info('Importing artists.');
            $this->call('import:artists');

            $this->info('Importing shows.');
            $this->call('import:shows');

            /////////////////////////////////////
            // Get or create the admin account //
            /////////////////////////////////////
            if (!$user = User::where('email', 'user@codepi.com')->first()) {
                $user = User::create([
                    'email'    => 'user@codepi.com',
                    'password' => bcrypt('pwd2015'),
                ]);
            }

            $headers = ['email','password'];

            $this->info('This is your credentials:');
            $this->table($headers, [[$user->email, 'pwd2015']]);

            $this->info('You can now login into the admin on:');
            $this->info(route('admin::auth::login'));
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
            '/APP_KEY=(.+)/',
            '/DB_DATABASE=(.+)/',
            '/DB_USERNAME=(.+)/',
            '/DB_PASSWORD=(.+)/'
        ], [
            'APP_KEY=Pvlx3t7GjQNPyuUXWP94RXCbwDMv0JtP',
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
