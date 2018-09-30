<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Good;
use App\Review;
use App\User;
use App\Category;
use App\Profile;
use DB;
use Auth;
class ProfileController extends Controller
{   
    public function myProfile(){
        return redirect('profile/' . Auth::user()->id);
    }
    
    public function profile($id)
    {
        $user = User::find($id);
        if($user->role != 'seller'){
            return redirect('/');
        }else{
            $goods = Good::where('seller_id', $id)->get();
            $categories = DB::table('categories')
        		->join('goods','goods.category', '=', 'categories.id')
        		->where('seller_id', $id)
        		->select('categories.id', 'categories.title')
        		->get()->unique();

            $profile = Profile::find($id);

            if(!Auth::guest() && Auth::user()->id == $id){
                return view('myProfile', compact('user', 'categories', 'goods', 'profile'));            
            }else{
                return view('profile', compact('user', 'categories', 'goods', 'profile'));
            }
        }
    }

    public function editName(Request $request){
        if( Auth::user()->id == $request->pk){
            $user = User::find($request->pk);
            $user->name = $request->value;
            $user->save();
        }else{
            return redirect('profile/' . $request->pk);
        }
    }

    public function editAddress(Request $request){
        if( Auth::user()->id == $request->pk){
            $profile = Profile::find($request->pk)->first();
            $profile->address = $request->value;
            $profile->save();
        }else{
            return redirect('profile/' . $request->pk);
        }
    }

    public function uploadAva(Request $request){
        if(Auth::user()->id == $request->seller_id){
            $destinationPath = public_path() . '/resources/avatars' . '/' . $request->seller_id;
            $destinationPathWall = public_path() . '/resources/wallpapers' . '/' . $request->seller_id;
            $user = User::find($request->seller_id);
            
            if($request->hasFile('ava')){
                $ava = $request->file('ava');
                if($ava->isValid()) {
                    if($user->avatar != NULL){
                        unlink($destinationPath . '/' . $user->avatar);
                    }
                    $ava->move($destinationPath, $ava->getClientOriginalName());
                    $user->avatar = $ava->getClientOriginalName();
                }else{
                    return 'Неподдерживаемый файл';
                }    
            }

            if($request->hasFile('wallpaper')){
                $wallpaper = $request->file('wallpaper');
                if($wallpaper->isValid()){
                    if($user->wallpaper != NULL){
                        unlink($destinationPathWall . '/' . $user->wallpaper);   
                    }
                    $wallpaper->move($destinationPathWall, $wallpaper->getClientOriginalName());
                    $user->wallpaper = $wallpaper->getClientOriginalName();
                }else{
                    return 'Неподдерживаемый файл';
                }    
            }

            $user->save();

            return redirect(url('profile/' . $request->seller_id));
        }else{
            return redirect('/');
        }
    }
}