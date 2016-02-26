<?php

namespace App\Console\Commands;

use Exception;

use App\Models\Artist;
use App\Models\Show;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ImportShows extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:shows';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all shows in the given CSV file.';

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
        //////////////////////////
        // Prevent for the path //
        //////////////////////////
        $this->info('Please check that your CSV file is located in `[base]/resources/assets/`.');
        $this->info('There is no need to specify the extension.');

        /////////////////////////////////////////////////////////
        // Retrieve the file's name and generate the full path //
        /////////////////////////////////////////////////////////
        $file     = $this->anticipate('What is the name of the CSV file?', ['concerts']);
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
 
            $header = array_map('strtolower', $csv[0]);
            unset($csv[0]);

            //////////////////
            // Progress Bar //
            //////////////////
            $bar = $this->output->createProgressBar(count($csv));

            foreach ($csv as $row => $show) {
                ////////////////////////////////////
                // Sanitize data                  //
                // Combine CSV's columns and data //
                ////////////////////////////////////
                $data = array_map('trim', array_combine($header, $show));

                ////////////////////////////
                // Separate date and time //
                ////////////////////////////
                $dateTime = explode(' ', $data['date']);

                //////////////////////////////////////////////////
                // Format the french date to the english format //
                //////////////////////////////////////////////////
                $data['date'] = Carbon::createFromFormat('d/m/Y', $dateTime[0])->toDateString();
                $data['time'] = $dateTime[1];

                $show = new Show($data);

                if ($artist = Artist::findByName($data['artist'])) {
                    //////////////////////////////////////
                    // Associate the show to the artist //
                    //////////////////////////////////////
                    $artist->shows()->save($show);
                    $show->save();
                }

                $bar->advance();
            }

            $bar->finish();

            $this->info("\nShows imported.");
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
