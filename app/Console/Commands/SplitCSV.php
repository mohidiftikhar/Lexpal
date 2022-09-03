<?php

namespace App\Console\Commands;

use App\Models\CsvSpilt;
use App\Models\DictionaryUpload;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminated\Console\WithoutOverlapping;

class SplitCSV extends Command
{
    use WithoutOverlapping;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:split_csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Split CSV';

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
        $this->info("CSV SPLIT START");
        $dictonary_csv  =   DictionaryUpload::where('is_split',0)->get();
        foreach ($dictonary_csv as $row){
            $language_id    =   $row->language_id;
            $inputFile   =   public_path($row->csv_path);
            $outputFile = 'uploads/'.basename($row->csv_path,".csv")."_";
            $splitSize = 1000;
            $in = fopen($inputFile, 'r');
            $rowCount = 0;
            $fileCount = 1;
            $headers    =   '';
            $out=   '';
            while (!feof($in)) {
                if ($rowCount ==0){
                    $headers = fgetcsv($in);
                }
                if (($rowCount % $splitSize) == 0) {
                    if ($rowCount > 0) {
                        fclose($out);
                    }
                    $fileName   =   $outputFile . $fileCount++ . '.csv';
                    $out = fopen(public_path($fileName), 'w');
                    fputcsv($out, $headers);
                    $files[]    =   $fileName;
                }
                $data = fgetcsv($in);
                if ($data){
                    fputcsv($out, $data);
                }
                $rowCount++;
            }
            fclose($out);
            foreach ($files as $key => $file){

                $totalCountsROws    =   0;
                $newFile = fopen(public_path($file), 'r');
                while (($record = fgetcsv($newFile)) !== FALSE) {
                    $totalCountsROws++;
                }
                $data = [
                    'upload_id'     =>  $row->id,
                    'csv_path'      =>  $file,
                    'page'          =>  1,
                    'import_records'=>  0,
                    'total_records' =>  $totalCountsROws
                ];
                fclose($newFile);
                $CsvSpilt   =   CsvSpilt::where('upload_id',$row->id)
                    ->where('csv_path',$file)->first();
                if (!$CsvSpilt){
                    CsvSpilt::create($data);
                }
                if ((count($files)-1) ===$key){
                    $dic_upload     =   DictionaryUpload::find($row->id);
                    if ($dic_upload){
                        $dic_upload->update([
                            'is_split'  =>  1
                        ]);
                    }
                }
            }
            $this->info($row->id." done");
           /* try{
                @unlink($inputFile);
            }
            catch(\Exception $ex){

            }*/
        }
        $this->info("CSV SPLIT END");
    }
}
