<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Good;
use App\GoodPhoto;
use App\Review;
class OfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');   
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function mygoods()
    {
        if(Auth::user()->role == 'seller'){
            return redirect()->route('myProfile');
        }else if(Auth::user()->token != null){
            return view('activateAccount');
        }else{
           return redirect()->route('office');
        }
    }

    public function mysettings(){
        if(Auth::user()->role == 'seller' || Auth::user()->role == 'candidate'){
            return view('mysettings');
        }else if(Auth::user()->token != null){
            return view('activateAccount');
        }else{
            return redirect('/');
        }
    }

    public function myreviews(){
    
        if(Auth::user()->role == 'seller'){
            return view('myreviews');
        }else if(Auth::user()->token != null){
            return view('activateAccount');
        }else{
            return redirect()->route('office');
        }
    }

    public function editGoodForm($good_id){
        if(Auth::user()->id == Good::find($good_id)->seller_id){
            $good = Good::find($good_id);
            $photos = GoodPhoto::where('good_id', $good_id)->get();
            $reviews = Review::where('good_id', $good_id)->get();
            return view('editGoodForm', compact('good', 'photos', 'reviews'));
        }else{
            return redirect('/');
        }
    }
}
