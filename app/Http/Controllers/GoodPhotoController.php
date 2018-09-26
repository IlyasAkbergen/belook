<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\GoodPhoto;
use App\Good;
// use Illuminate\Support\Facades\Input;
// use Illuminate\Support\Facades\Storage;
// use Validator;
class GoodPhotoController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');   
  }

 	public function store(Request $request){
   		
    $good_id = $request->goodID;

    $destinationPath = public_path() . '/resources/images' . '/' . $good_id;

    if($request->hasFile('file')){
      $file = $request->file('file');
      if($file->isValid()) {
        $file->move($destinationPath,$file->getClientOriginalName());
        $goodPhoto = new GoodPhoto;
        $goodPhoto->good_id = $good_id;
        $goodPhoto->filename = $file->getClientOriginalName();
        $goodPhoto->save();
        // добаить error handler
        return 'done ' . $destinationPath;           
      }else{
        return 'error';
      }
    }else{
      return 'error';
    }
  }

  public function delete(Request $request){

    GoodPhoto::where('good_id', $request->good_id)->where('filename', $request->filename)->delete();

    unlink(public_path() . '/resources/images' . '/' . $request->good_id . '/' . $request->filename);

    return redirect('/editGoodForm' . '/' . $request->good_id);
  }
}
