@extends('master')
@section("content")
<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\MyCourses;
use App\Models\Coupon;
use App\Models\Offer;



$user = session('user'); // Get the logged-in user
$userId = $user['id'];
$allCoupon= Coupon::where('user_id',$userId)->get();
$offer = 0;
foreach($allCoupon as $item)
         {
          $temp= Offer::where('coupon_code',$item['coupon_code'])->first();
          $offer = $offer + $temp['amount'];

         }


?> 
<div class="custom-product">
     <div class="col-sm-10">
        <table class="table">
         
            <tbody>
              <tr>
                <td>Amount</td>
              <td>$ {{$total}}</td>
              </tr>
              <tr>
                <td>Tax</td>
                <td>$ 0</td>
              </tr>
              <tr>
                <td>Delivery </td>
                <td>$ 0</td>
              </tr>
              <tr>
                <td>Coupon </td>
                <td>$ {{$offer}}</td>
              </tr>
              <tr><b>
                <td>Total Amount</td>
              <td>$ {{$total-$offer}}</td>
              </b>
              </tr>
            </tbody>
          </table>
          <div>
            <form action="/orderplace" method="POST" >
              @csrf
                <div class="form-group">
                  <textarea name="address" placeholder="enter your address" class="form-control" ></textarea>
                </div>
                <div class="form-group">
                  <label for="pwd">Payment Method</label> <br> <br>
                  <input type="radio" value="cash" name="payment"> <span>Card payment</span> <br> <br>
                  <input type="radio" value="cash" name="payment"> <span>Mobile Banking payment</span> <br><br>
                  <input type="radio" value="cash" name="payment"> <span>Payment on Delivery</span> <br> <br>

                </div>
                <button type="submit" class="btn btn-default">Order Now</button>
              </form>
          </div>
     </div>
</div>
@endsection 