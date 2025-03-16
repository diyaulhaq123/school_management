<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $guarded = [];


    public static function activateTerm($id)
    {
        self::where('status', 1)->update(['status' => 0]);

        self::where('id', $id)->update(['status' => 1]);
    }

}
