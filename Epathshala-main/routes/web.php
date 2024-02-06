<?php

use App\Http\Controllers\Friends;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use Illuminate\Contracts\Session\Session;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
if (\Illuminate\Support\Facades\Session::has('user')) {
    \Illuminate\Support\Facades\Session::forget('user');
    }
    
    return redirect('login');
});

// Route::post('/', [UserController::class, 'login']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/', [ProductController::class, 'home']);
Route::get('/detail/{id}', [ProductController::class, 'detail']);
Route::get('/profile/{id}', [ProductController::class, 'profile']);
Route::get('/userProfile/{id}', [ProductController::class, 'userProfile']);


Route::get('/search', [ProductController::class, 'search']);
Route::get('/new_course', [ProductController::class, 'new_course']);
Route::post("/publish_course",[ProductController::class,'publish_course']);





// Route::get('/cart', [ProductController::class, 'cart']);


Route::post('/add_to_bookmark', [ProductController::class, 'Addbookmark']);
Route::get("removebookmark/{id}",[ProductController::class,'removebookmark']);
Route::get("/bookmark",[ProductController::class,'bookmark']);



Route::get('/searchFriend', [Friends::class, 'searchFriends']);
Route::get('/friends', [Friends::class, 'friends']);
Route::get("removefriend/{id}",[Friends::class,'removefriend']);
Route::post('/addfriend', [Friends::class, 'Addfriend']);



Route::get("/voucher",[VoucherController::class,'voucher']);
Route::post("/addvoucher",[VoucherController::class,'addvoucher']);
Route::get('/voucher_list', [VoucherController::class, 'voucher_list']);
Route::get('/offer_push', [VoucherController::class, 'offer_push']);
Route::post("/publish_offer",[VoucherController::class,'publish_offer']);




Route::get("/cartlist",[ProductController::class,'cartList']);
Route::post('/add_to_cart', [ProductController::class, 'Addcart']);
Route::get("removecart/{id}",[ProductController::class,'removeCart']);



Route::get("/myCourse",[ProductController::class,'myCourse']);


Route::get("/ordernow",[ProductController::class,'orderNow']);
Route::get("/paynow",[ProductController::class,'paynow']);

Route::post("/orderplace",[ProductController::class,'orderplace']);
Route::post("/payment",[ProductController::class,'payment']);

Route::get("/generatePdf",[PdfController::class,'generatePdf']);
Route::get("/complete_payment",[ProductController::class,'complete_payment']);
Route::get("/showpdf",[ProductController::class,'showpdf']);

















// Route::get('/home', [ProductController::class, 'home']);


// Route::match(['GET', 'POST'], '/', [UserController::class, 'login']);




