<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Review;
use App\Good;

class ReviewController extends Controller
{
    public function rate(Request $request){

    	if(Auth::guest()){
    		$review = new Review;
    		$review->seller_id = $request->seller_id;
    		$review->good_id = $request->good_id;
    		$review->text = $request->reviewText;
    		$review->points = $request->points;
    		$review->save();	

            $reviews = Review::where('good_id', $request->good_id)->get();
            if(count($reviews) > 0){
                $i = 0;
                $sum = 0;
                foreach ($reviews as $review) {
                    $sum = $sum + $review->points;
                    $i++;
                }
                $avg_points = $sum/$i;
            }else{
                $avg_points = 0;
            }

            $good = Good::find($request->good_id);
            $good->rating = ceil($avg_points/0.5)*0.5;
            $good->save();

    		return redirect('good/' . $request->good_id);
    	}else{
    		return redirect('/');
    	}

    }
}