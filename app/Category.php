<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function create($title, $code){
	    $category = new Category;
	    $category->title = $title;
	    $category->code = $code;
	    $category->save();

	    return redirect('/');
	}
}
