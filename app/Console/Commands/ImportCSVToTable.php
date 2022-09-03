<?php

namespace App\Console\Commands;

use App\Models\CsvSpilt;
use App\Models\DictionaryUpload;
use App\Models\Language;
use Illuminate\Console\Command;
use Illuminated\Console\WithoutOverlapping;


class ImportCSVToTable extends Command
{
    use WithoutOverlapping;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:import_csv_table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CSV to TABLE';

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
        $this->info('CRON START '.date('H:i:s'));
        $dictionary     =   DictionaryUpload::where('status','pending')
            ->where('is_split',1)
            ->orderBy('id','DESC')
            ->first();
        if ($dictionary){
            $language_id                =   $dictionary->language_id;
            $language                   =   Language::find($language_id);
            if ($language){
                $table_name            =    $language->table_name;
                ($table_name)::query()->truncate();
            }
        }
        self::startUploading($this);
    }

    private static function startUploading($thiss):bool{
        $dictionary     =   DictionaryUpload::where('status','pending')
            ->where('is_split',1)
            ->first();
        if ($dictionary){
            $upload_id  =   $dictionary->id;
            $csv_split_upload  =   CsvSpilt::where("upload_id",$upload_id)
                ->where('is_done',0)
                ->first();
            /* changing the status of uploaded csv */
            if (!$csv_split_upload){
                $dic_upload     =   DictionaryUpload::find($upload_id);
                if ($dic_upload){
                    $language_id    =   $dic_upload->language_id;
                    $all_dicts      =   DictionaryUpload::where('language_id',$language_id)
                        ->where('is_current',1)
                        ->get();
                    foreach ($all_dicts as $row){
                        $row->update([
                            'is_current'    =>  0
                        ]);
                    }
                    $dic_upload->update([
                        'status'        =>  'completed',
                        'is_current'    =>  1
                    ]);
                    $thiss->info($upload_id.' completed');
                }
            }
            $csv_split_upload  =   CsvSpilt::where("upload_id",$upload_id)
                ->where('is_done',0)
                ->first();
            if ($csv_split_upload){
               return  self::readCSV($upload_id,$thiss);
            }
        }
        $thiss->info('CRON  STOP '.date('H:i:s'));
        return true;
    }

    private static function readCSV($upload_id,$thiss):bool{
        $csv_data       =   CsvSpilt::from('csv_parts as p')
            ->join('dictionary_uploads as du','du.id','=','p.upload_id')
            ->select('du.language_id','p.*')
            ->where('p.upload_id',$upload_id)
            ->where('p.is_done',0)
            ->first();
        if ($csv_data){
            $csv_path           =   public_path($csv_data->csv_path);
            $language_id        =   $csv_data->language_id;
            $upload_id          =   $csv_data->upload_id;
            $language           =   Language::find($language_id);
            if ($language)
            {
                $page_db            =   $csv_data->page;
                $split_id           =   $csv_data->id;
                $limits             =   200;
                $page               =   $page_db-1;
                $count              =   0;
                $start              =   $page * $limits;
                $end                =   ($page + 1) * $limits;

                $file = fopen($csv_path,"r");
                $file1 = fopen($csv_path,"r");
                $totalRows  =   array();
                $header     =   [
                    'ids',
                    'entryword',
                    'inflactedform',
                    'topic',
                    'pos',
                    'pos_1',
                    'entryword_1',
                    'inflactedform_1',
                    'dn_type',
                    'l1_sentence',
                    'l2_sentence',
                ];
                $flag       =   false;
                while ($line = fgetcsv($file1)){
                    if ($count>0 && $count<$start){

                    }elseif ($count < $end && $count >= $start) {
                        $line    =   explode(';',$line[0]);
                        foreach ($header as $key  =>  $column){
                            $totalRows[$count][$header[$key]]=$line[$key]??'';
                        }
                        $flag       =   true;
                    }
                    else if($count>$end){
                        break;
                    }
                    $count++;
                }
                fclose($file);
                fclose($file1);
                self::uploadData($totalRows,$split_id,$language,$upload_id,$page_db,$thiss);
            }
        }
        return true;
    }

    private static function uploadData($totalRows,$split_id,$language,$upload_id,$page_db,$thiss){
        $csv_split  =   CsvSpilt::find($split_id);
        $import_records     =   $csv_split->import_records??0;
        if (count($totalRows)>0){
            foreach ($totalRows as $row){
                $row['language_id']    =   $language->id;
                $table_name            =    $language->table_name;
                ($table_name)::create($row);
            }
            $csv_split->update([
                'page'              =>  ($page_db+1),
                'import_records'    =>  ($import_records+count($totalRows))
            ]);
            $thiss->info($split_id.' '.$csv_split->csv_path.'   updated to page '.($page_db));
        }
        if (count($totalRows) ===0)
        {
            $csv_path   =   $csv_split->csv_path;
            $csv_split->update([
                'is_done'   =>  1
            ]);
            $thiss->info($split_id.' '.$csv_split->csv_path.' updated to 1');
            try{
                @unlink(public_path($csv_path));
            }
            catch (\Exception $exception){

            }
        }
        return self::startUploading($thiss);
    }
}
