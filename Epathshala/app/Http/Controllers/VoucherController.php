<?php

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



class VoucherController extends Controller
{
    //
    function voucher_list(){
        
        $allOffer_list= Offer::all();

        return view('voucher_list',['voucher_list'=>$allOffer_list]);
    }
    function voucher(){
        return view('voucher');
    
    }

    function addvoucher(Request $request){
        // HERE
        $userId=Session::get('user')['id'];
        $order= new Coupon();
        $order->coupon_code=$request->input('coupon');
        $order->user_id=$userId;
        $order->save();
        return redirect('/');
    
    }
    function offer_push(){
        return view('offer_push');
    }
    
    function publish_offer(Request $request){
        // HERE
        $order= new Offer();
        $order->coupon_code=$request->input('coupon');
        $order->amount=$request->input('amount');
        $order->save();
    
        return redirect('/');
    }
}
