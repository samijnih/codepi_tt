<?php

namespace App\Console\Commands;

use DB;
use Exception;

use App\Models\Artist;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ImportArtists extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:artists';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all artists in the given CSV file.';

    /**
     * The filesystem service
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
        //////////////////////////
        // Prevent for the path //
        //////////////////////////
        $this->info('Please check that your CSV file is located in `[base]/resources/assets/`.');
        $this->info('There is no need to specify the extension.');

        /////////////////////////////////////////////////////////
        // Retrieve the file's name and generate the full path //
        /////////////////////////////////////////////////////////
        $file     = $this->anticipate('What is the name of the CSV file ?', ['artistes']);
        $resource = base_path("resources/assets/{$file}.csv");

        try {
            if (!$this->filesystem->exists($resource)) {
                throw new Exception("`{$file}` doesn't exist.");
            }

            $csv = array_map('str_getcsv', file($resource));

            if (!count($csv)) {
                $this->info('The file is empty.');

                return;
            }
            
            die(var_dump($csv));
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
