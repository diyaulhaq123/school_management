<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $guarded = [];


    public static function toogleStatus($id){
        $data = self::where('id', $id)->first();
        if($data->status == 1){
            $data->update(['status' => 0]);
        }else{
            $data->update(['status' => 1]);
        }
    }

}
