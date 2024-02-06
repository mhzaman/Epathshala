<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\cart;
use App\Models\friend;
use App\Models\bookmark;
use App\Models\Order;
use App\Models\MyCourses;
use App\Models\Coupon;
use App\Models\Offer;





use App\Models\User;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Friends extends Controller
{
    //
    function removefriend($id)
    {
        friend::destroy($id);
        return redirect('friends');
    }

    function friends(){
        if (Session::has('user'))  {
            $user = session('user'); // Get the logged-in user
            $userId = $user['id'];
            // $userId=Session::get('user')['id'];
            $data = friend::where('user_id', $userId)->get();
            return view('friend_list',['friend_list'=>$data]);
    }
    else{
        return "Login First....";
    }
}

function Addfriend(Request $request){
    $user = session('user'); // Get the logged-in user
    $userId = $user['id'];
    $f = friend::where('user_id', $userId)->get();
    $key = $request->input('email');
    foreach($f as $one)
         {
            if ($one['email'] == $key ){
                return redirect('friends');
                
                
            }
             
         }
    if($request->session()->has('user')){
        $friend = new friend();
        $friend->user_id = $request->session()->get('user')['id'];
        $friend->email = $request->input('email');
        $friend->save();

        return redirect('/');
    }
    else{
        return redirect('/login');
    }

    
}
function searchFriends(Request $request){
        
    $query = $request->input('query');
    $data = User::where('email', 'like', '%' . $query . '%')->get();

    return view('searchFriend',['searchFriend'=>$data]);
}
}
