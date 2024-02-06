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


class ProductController extends Controller
{
    //
    function index(){
        return "WELCOME to Product page";
    }
    function home(){
        $data = Product::all();

        return view('product',['products'=>$data]);
    }
    function detail($id){
        $data =  Product::find($id);
        return view('details',['product'=>$data]);
    }

    function profile($id){
        $data =  User::find($id);
        $courses = MyCourses::where('user_id', $data['id'])->get();
        return view('profile',['profile_data'=>$data,'course'=>$courses]);
    }
    function userProfile($id){
        $data =  User::find($id);
        return view('userProfile',['userProfile'=>$data]);
    }
    function search(Request $request){
        
        $query = $request->input('query');
        $data = Product::where('name', 'like', '%' . $query . '%')->get();
    
        return view('search',['products'=>$data]);
    }

    function cartList(){
        
        $userId=Session::get('user')['id'];
        $products= DB::table('saved_tale')
        ->join('products','saved_tale.product_id','=','products.id')
        ->where('saved_tale.user_id',$userId)
        ->select('products.*','saved_tale.id as cart_id')
        ->get();

        return view('cart',['products'=>$products]);
    }

    function bookmark(){
        
        $userId=Session::get('user')['id'];
        $products= DB::table('bookmark')
        ->join('products','bookmark.product_id','=','products.id')
        ->where('bookmark.user_id',$userId)
        ->select('products.*','bookmark.id as cart_id')
        ->get();

        return view('bookmark',['products'=>$products]);
    }
    function removeCart($id)
    {
        cart::destroy($id);
        return redirect('cartlist');
    }
    
    function removebookmark($id)
    {
        bookmark::destroy($id);
        return redirect('bookmark');
    }

    function orderNow()
    {
        $userId=Session::get('user')['id'];
        $orderAll = cart::where('user_id',$userId)->first();
        if (isset($orderAll)) {
            $total= $products= DB::table('saved_tale')
         ->join('products','saved_tale.product_id','=','products.id')
         ->where('saved_tale.user_id',$userId)
         ->sum('products.price');
 
         return view('ordernow',['total'=>$total]);
        } else {
            return redirect('/');
        }
        
        
    }
    

    function Addcart(Request $request){
        if($request->session()->has('user')){
            $user = session('user'); // Get the logged-in user
            $userId = $user['id'];
            $f = cart::where('user_id', $userId)->get();
            $myCou = MyCourses::where('user_id', $userId)->get();
            $key = $request->input('product_id');
            foreach($myCou as $cou)
         {
            if ($cou['product_id'] == $key ){
                return redirect('myCourse');
            } 
         }
            foreach($f as $one)
         {
            if ($one['product_id'] == $key ){
                return redirect('cartlist');   
            } 
         }
            $cart = new cart();
            $cart->user_id = $request->session()->get('user')['id'];
            $cart->product_id = $request->input('product_id');
            $cart->save();
            return redirect('/');
        }
        else{
            return redirect('/login');
        }
    
        
    }
    function Addbookmark(Request $request){
        
        if($request->session()->has('user')){
            $user = session('user'); // Get the logged-in user
            $userId = $user['id'];
            $f = bookmark::where('user_id', $userId)->get();
            $key = $request->input('product_id');
            foreach($f as $one)
         {
            if ($one['product_id'] == $key ){
                return redirect('bookmark');
                
                
                
                
            }
             
         }
            $cart = new bookmark();
            $cart->user_id = $request->session()->get('user')['id'];
            $cart->product_id = $request->input('product_id');
            $cart->save();

            return redirect('/');
        }
        else{
            return redirect('/login');
        }
    
        
    }

    public static function cart_item($userId) {
        $cartItemCount = cart::where('user_id', $userId)->count();
        return $cartItemCount;
    }
    

function paynow(){
    return view('payment');
}

function new_course(){
    return view('new_course');
}



function payment(Request $request){
    // HERE
    $userId=Session::get('user')['id'];
    $allOrder= Order::where('user_id',$userId)->get();
         foreach($allOrder as $cart)
         {
             $order= new MyCourses();
             $order->product_id=$cart['product_id'];
             $order->user_id=$cart['user_id'];
             $order->save();
         }

    
    $request->input();
    return redirect('/complete_payment');
}





function complete_payment(){
    return view('complete_payment');

}
function showpdf(){
    return view('billing_invoice');

}






function orderplace(Request $request)
    {
        $userId=Session::get('user')['id'];
        $allCart= cart::where('user_id',$userId)->get();
         foreach($allCart as $cart)
         {
             $order= new Order();
             $order->product_id=$cart['product_id'];
             $order->user_id=$cart['user_id'];
             $order->status="pending";
             $order->payment_method=$request->payment;
             $order->payment_status="pending";
             $order->address=$request->address;
             $order->save();
             cart::where('user_id',$userId)->delete(); 
         }
         $request->input();
         return redirect('/paynow');
    }


    function myOrders()
    {
        $userId=Session::get('user')['id'];
        $orders= DB::table('orders')
         ->join('products','orders.product_id','=','products.id')
         ->where('orders.user_id',$userId)
         ->get();
 
         return view('myorders',['orders'=>$orders]);
    }

    function myCourse(){
        
        $userId=Session::get('user')['id'];
        $products= DB::table('my_course')
        ->join('products','my_course.product_id','=','products.id')
        ->where('my_course.user_id',$userId)
        ->select('products.*','my_course.id as cart_id')
        ->get();

        return view('mycourses',['products'=>$products]);
    }

    function publish_course(Request $request){
        if($request->session()->has('user')){
            $cart = new Product();
            $cart->name = $request->input('title');
            $cart->catagory = $request->input('catagory');
            $cart->discription = $request->input('discription');
            $cart->difficulty = $request->input('difficulty');
            $cart->cover = $request->input('cover');
            $cart->price = $request->input('price');

            $cart->views = 0;
            $cart->save();

            return redirect('/');
        }
        else{
            return redirect('/login');
        }
    
        
    }
    
    
}
