<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Good;
use App\GoodPhoto;
use App\Review;
use App\Category;
use App\User;
use App\Cart;
use Auth;
use File;
use Excel;

class GoodController extends Controller
{
    public function store(Request $request){
    	if( !Auth::guest() && User::find(Auth::user()->id)->role == 'seller' ){
            $good = new Good;
            $good->title = $request->title;
            $good->description = $request->description;
            $good->seller_id = Auth::user()->id;
            $good->price = $request->price;
            $good->category = $request->category;
            $good->save();

            return redirect('/profile/' . Auth::user()->id);
        }else{
            return redirect('/');
        }
    }

    public function editTitle(Request $request){
        if( Auth::user()->id == Good::find($request->pk)->seller_id ){
            $good = Good::find($request->pk);
            $good->title = $request->value;
            $good->save();
        }else{
            return redirect('/');
        }
    }

    public function editPrice(Request $request){
        if( Auth::user()->id == Good::find($request->pk)->seller_id ){
            $good = Good::find($request->pk);
            $good->oldprice = $good->price; 
            $good->price = $request->value;
            $diff = $good->oldprice - $good->price;
            $good->sale = ($diff * 100) / $good->oldprice;
            $good->save();
        }else{
            return redirect('/');
        }
    }

    public function editDescription(Request $request){
        if( Auth::user()->id == Good::find($request->pk)->seller_id ){
            $good = Good::find($request->pk);
            $good->description = $request->value;
            $good->save();
        }else{
            return redirect('/');
        }
    }

     public function editCategory(Request $request){
        if( Auth::user()->id == Good::find($request->pk)->seller_id ){
            $good = Good::find($request->pk);
            $good->category = $request->value;
            $good->save();
        }else{
            return redirect('/');
        }
    }

    public function show($good_id){
        $good = Good::find($good_id);
        $photos = GoodPhoto::where('good_id', $good_id)->get();
        $reviews = Review::where('good_id', $good_id)->get();
        $categories = array();
        $index = 0;
        for($i=0;$i<strlen(Category::find($good->category)->code);$i++){
            $categories[$index] = substr(Category::find($good->category)->code, 0, $i+1);
            $index++;
        }

        return view('good', compact('good', 'photos', 'reviews', 'categories'));
    }

    public function delete($good_id){

        Good::find($good_id)->delete();
        $photos = GoodPhoto::where('good_id', $good_id)->get();

        // foreach ($photos as $photo) {
        //     unlink(public_path() . '/resources/images' . '/' . $good_id . '/' . $photo->filename);
        //     $photo->delete();
        // }

        File::deleteDirectory(public_path() . '/resources/images' . '/' . $good_id);

        $reviews = Review::where('good_id', $good_id)->get();
        foreach ($reviews as $review) {
            $review->delete();
        }

        $carts = Cart::where('good_id', $good_id)->get();
        foreach ($carts as $cart) {
            $cart->delete();
        }        
        return redirect(route('myProfile'));
    }

    public function shop(Request $request){
        $goods = Good::all();
        $sellers = User::where('role', 'seller')->get();
        $searchgood = '';
        return view('shop', compact('goods', 'sellers', 'searchgood'));
    }

    public function search(Request $request){
        $searchgood = $request->searchgood;
        if(empty($request->currentCat)){
            $currentCat = "";
            $goods = Good::where('title', 'like', '%' . $searchgood . '%')->get();
            $sellers = User::where('role', 'seller')->where('name', 'like', '%' . $searchgood . '%')->get();
        }else{
            $currentCat = Category::find($request->currentCat);
            $goods = Good::where('title', 'like', '%' . $searchgood . '%')->where('category', $request->currentCat)->get();
            $allCats = Category::all();

            foreach ($allCats as $cat) {
                if($currentCat->code == substr($cat->code, 0, $currentCat->data_level + 1) && $currentCat->id != $cat->id){
                    $goods = $goods->merge(Good::where('title', 'like', '%' . $searchgood . '%')->where('category', $cat->id)->get());
                }
            }
            $sellers = NULL;
        }

        // $firstsellers = array_slice($sellers, 0, count($sellers) / 2);
        // $secondsellers = array_slice($sellers, count($sellers) / 2);

        return view('shop', compact('goods', 'sellers', 'searchgood', 'currentCat'));
    }

    public function category($id){
        $goods = Good::where('category', $id)->get();
        $searchgood = '';

        $currentCat = Category::find($id);

        $allCats = Category::all();

        foreach ($allCats as $cat) {
            if($currentCat->code == substr($cat->code, 0, $currentCat->data_level + 1) && $currentCat->id != $cat->id){
                $goods = $goods->merge(Good::where('category', $cat->id)->get());
            }
        }

        return view('shop', compact('goods', 'searchgood', 'currentCat'));
    }
    
    public function uploadFromExcel(Request $request){ // PASS HERE USER ID FROM BLADE 
        if(User::find($request->user_id)->role == 'seller' ){

            try {
                $dataFromFile = Excel::load($request->file('excelfile'))->get();
                // $sheet = $objPHPExcel->getSheet(0);
                
                // foreach ($sheet->getRowIterator() as $i => $row) {


                //     $row = $sheet->rangeToArray("B{$i}:G{$i}", null, true, false)[0];
                //     $dataFromFile[$row[0]] = $row;
                // }

                // Excel::load($request->file('excelfile'))->getRealPath(), function ($reader) {
                //     foreach ($reader->toArray() as $key => $row) {
                          
                //         // for headers
                //         // if ($key <= 1) {
                //         //     continue;
                //         // }
                        
                //         $good = new Good;
                //         $good->title = $row[2];
                //         $good->description = $row[3];
                //         $good->seller_id = $request->user_id;
                //         $good->price = $row[5];
                //         $good->category = 1; // no category in excel file
                        
                //         // add serial numbers to table
                //         $good->save();

                //         // $data['title'] = $row['title'];
                //         // $data['description'] = $row['description'];
                //     }
                // });

                foreach ($dataFromFile as $key => $row) {

                    if($row['sn'] == null || $row['title'] == null || $row['description'] == null || $row['price'] == null){
                        continue;
                    }

                    $good = new Good;
                    $good->title = $row['title'];
                    $good->description = $row['description'];
                    $good->seller_id = $request->user_id;
                    $good->price = $row['price'];
                    $good->category = 1; // no category in excel file
                    $good->sn = $row['sn'];
                    
                    if(!$good->snExists()){
                        $good->save();    
                    }

                }
                
                return redirect(route('myProfile'));   
            
            } catch (Exception $e) {
                return $e;
            }
        }else{
            return redirect('/');
        }
    }
}