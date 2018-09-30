<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function create($user_id){

    	$profile = new Profile();
    	$profile->seller_id = $user_id;
    	$profile->save();


	    // $table->increments('id');
     //    $table->integer('seller_id');
     //    $table->text('about')->nullable();
     //    $table->string('address')->nullable();
     //    $table->string('tel')->nullable();
     //    $table->string('vk')->nullable();
     //    $table->string('instagram')->nullable();
     //    $table->string('facebook')->nullable();
     //    $table->string('google')->nullable();

    }
}
