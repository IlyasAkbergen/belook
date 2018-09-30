<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = [
    	'title','description','category', 'price', 'oldprice', 'isvip', 'sn'
    ];


    public function snExists(){

        $result = false;

        if( Good::where('sn', $this->sn)->get()->first() !== null){
            $result = true;
        }

        return $result;
    }
}
