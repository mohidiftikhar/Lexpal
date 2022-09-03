<?php

namespace App\Console\Commands;

use App\Models\DictionaryUpload;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminated\Console\WithoutOverlapping;

class CsvDeleteCommand extends Command
{
    use WithoutOverlapping;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:csv-delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Unwanted CSV From SERVER';

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
     * @return int
     */
    public function handle()
    {
        $dictonary_csv  =   DictionaryUpload::where('status','completed')
            ->where('created_at','<=',Carbon::now()->subHours(2)->format('Y-m-d H:i:s'))
            ->where('is_current',0)
            ->get();
        if (count($dictonary_csv)>0){
            foreach ($dictonary_csv as $row){
                $inputFile   =   public_path($row->csv_path);
                if (File::exists($inputFile)){
                    File::delete($inputFile);
                    $this->info('CSV DELETED : '.$dictonary_csv->id);
                }
            }
        }
    }
}
