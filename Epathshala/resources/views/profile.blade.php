@extends('master')
@section('content')
<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\MyCourses;
use App\Models\Product;

$user = session('user'); // Get the logged-in user
$userId = $user['id'];

?> 
<div class="container">
   <div class="row">
       <div class="col-sm-6">
       <img class="detail-img" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="">
       </div>
       <div class="col-sm-6">
           <a href="/">Go Back</a>
       <h2>{{$profile_data['name']}}</h2>
       <h5>{{$profile_data['email']}}</h5>


       <form action="/addfriend" method="POST">
           @csrf
           <input type="hidden" name="email" value= {{ $profile_data['email'] }}>
       <button class="btn btn-primary">Add as Friend</button>
       </form>
       <br><br>
    </div>
   </div>
</div>  
<div class="custom-product">
     <div class="col-sm-10">
        <div class="trending-wrapper">
            <h4>Purchased Courses: </h4>
           @foreach($course as $item)
           <?php
                $Course_details = Product::where('id', $item['product_id'])->first(); // Use first() instead of get()
            ?>
            <div class=" row searched-item cart-list-devider">
             <div class="col-sm-3">
                <a href="/detail/{{$item['product_id']}}">
                    <img class="trending-image" src="{{$Course_details->cover}}">
                  
             </div>
             <div class="col-sm-4">
                    <div class="">
                      <h2>{{$Course_details->name}}</h2></a>
                      <h5>{{$Course_details->discription}}</h5>
                    </div>
             </div>
            </div>
            @endforeach
          </div>

     </div>
</div>  
@endsection
