<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    public function create($user_id){

    	$info = new User_info();
    	$info->seller_id = $user_id;
    	// ...
    	$info->save();

    }
}
