<?php

namespace App\Console\Commands;

use App\Models\DictionaryUpload;
use App\Models\Language;
use Illuminate\Console\Command;
use Illuminated\Console\WithoutOverlapping;

class CsvTOJsonCommand extends Command
{
    use WithoutOverlapping;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:json_dictionary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Json to Dictionary';

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
        self::cronStart($this);

    }

    protected static function cronStart($thiss):bool{
        $thiss->info('START  '.date('H:i:s'));
        $dictionary     =   DictionaryUpload::where('status','completed')
            ->where('is_current',1)
            ->where('status','completed')
            ->where('is_json_completed',0)
            ->orderBy('id','DESC')
            ->first();
        if ($dictionary)
        {
            $dictionary_id              =   $dictionary->id;
            $thiss->info('START D#ID '.$dictionary_id);
            $language_id                =   $dictionary->language_id;
            $json_file                  =   '';
            $page                       =   $dictionary->page;
            $data                       =   [];
            $fileName                   =   '';
            if (empty($dictionary->json_file)){
                $fileName               =   'uploads/json/'.$dictionary_id."_dictionary_".strtotime(date('Y-m-d H:i:s')).'.json';
                $dictionary->update([
                    'json_file'         =>  $fileName
                ]);
                $json_file              =   public_path($fileName);
                file_put_contents($json_file,json_encode($data));
            }
            else
            {
                $fileName               =   $dictionary->json_file;
                $json_file              =   public_path($fileName);
                $inp = file_get_contents($json_file);
                $data = json_decode($inp);
            }
            $language                   =   Language::find($language_id);
            if ($language){
                $table_name             =   $language->table_name;
                $dictionary             =   DictionaryUpload::find($dictionary_id);
                $request                    =   request();
                $request['page']            =   $page;
                $dictionaries_data      =   ($table_name)::paginate(500);
                $is_json_completed      =   0;
                if (count($dictionaries_data->items())>0){
                    foreach ($dictionaries_data as $row){
                        $data[]             =   [
                            'id'               =>  $row->ids,
                            'entryword'         =>  $row->entryword,
                            'inflactedform'     =>  $row->inflactedform,
                            'topic'             =>  $row->topic,
                            'pos'               =>  $row->pos,
                            'pos_1'             =>  $row->pos_1,
                            'entryword_1'       =>  $row->entryword_1,
                            'inflactedform_1'   =>  $row->inflactedform_1,
                            'dn_type'           =>  $row->dn_type,
                            'l1_sentence'       =>  $row->l1_sentence,
                            'l2_sentence'       =>  $row->l2_sentence,
                        ];
                    }
                    $is_json_completed  =   0;
                    $thiss->info($dictionary_id.' Page  : '.$page);
                    $newData        =   [
                        'page'                  =>  ($page+1),
                        'total_page'            =>  ceil(($dictionaries_data->total()/$dictionaries_data->perPage())),
                        'is_json_completed'     =>  $is_json_completed
                    ];
                    $dictionary->update($newData);
                    file_put_contents($json_file,json_encode($data));
                }
                else
                {
                    $is_json_completed  =   1;
                    $newData        =   [
                        'json_file'             =>  $fileName,
                        'page'                  =>  ($page),
                        'total_page'            =>  ceil(($dictionaries_data->total()/$dictionaries_data->perPage())),
                        'is_json_completed'     =>  $is_json_completed
                    ];
                    $dictionary->update($newData);
                    $thiss->info('END D#ID '.$dictionary_id);
                }
            }
            return self::cronStart($thiss);
        }
        $thiss->info('END  '.date('H:i:s'));
        return true;
    }
}
