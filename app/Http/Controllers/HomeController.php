<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Good;
use App\Review;
use App\User;
use App\Category;

class HomeController extends Controller
{
    public function index()
    {
        $date = Carbon::now();
        $date->subWeek();
        $news = Good::where('created_at', '>', $date->toDateTimeString())->orderBy('created_at', 'desc')->get();
        $sales = Good::where('sale', '>', 0)->orderBy('sale', 'desk')->get();
        $bestGoods = Good::where('rating', '>', 4.0)->orderBy('rating', 'desk')->get();
        $categories = Category::all();
        $i = 0;
        $bGoods = array();
        foreach ($bestGoods as $bestGood) {
        	if(count(Review::where('good_id', $bestGood->id)->get()) >= 5){
        		$bGoods[$i] = $bestGood;
        		$i++;
        	}
        }

        $sellers = User::all();

        return view('home', compact('news', 'sales', "bGoods", "sellers", 'categories'));
    }
}
