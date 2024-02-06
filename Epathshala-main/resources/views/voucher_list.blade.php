@extends('master')
@section('content')
<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\MyCourses;
$user = session('user'); // Get the logged-in user
$userId = $user['id'];

?> 


@foreach ($voucher_list as $item)
    <div class="row">
        <div class="column" style="background-color:#aaa;"><p>
        <a href="">
        <h2>Code: {{$item["coupon_code"]}} </h2> </a><br>
        <h2>${{$item["amount"]}} </h2>
        </p>
        
        </div>
        <div class="col-sm-3">
                <a href="/voucher" class="btn btn-warning" >Add Voucher</a>
             </div>
             </div>
    <hr style="height:1px">
    
@endforeach




@endsection
