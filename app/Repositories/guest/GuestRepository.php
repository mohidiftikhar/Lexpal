<?php

namespace App\Repositories\guest;

use App\Models\GuestModel;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Request;
class GuestRepository extends BaseRepository implements GuestInterface
{
    public function __construct(GuestModel $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    public function get_client_info($update = false)
    {
//        $ip_address = Request::getClientIp(true);
        $ip_address = exec('getmac');
        $ip_address = strtok($ip_address, ' ');
//        dd($ip_address);
        $date = now()->format('Y-m-d');
        $guest = $this->createIfNotExist(['ip_address' => $ip_address, 'date' => $date]);
//        dd($guest);
        if ($guest) {
            if ($update === true and $guest->tries > 0) {
                $this->update($guest->id, ['tries' => $guest->tries - 1]);
//                $guest->save();
                $updatedGuest = $this->findById($guest->id);
                //dd($guest1);
                return $updatedGuest;
            }
            else{
                return $guest;
            }
        } else {
            return false;
        }
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
}
