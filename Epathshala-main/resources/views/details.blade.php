@extends('master')
@section('content')
<div class="container">
   <div class="row">
       <div class="col-sm-6">
       <img class="detail-img" src="{{$product['cover']}}" alt="">
       </div>
       <div class="col-sm-6">
           <a href="/">Go Back</a>
       <h2>{{$product['name']}}</h2>
       <h3>views : {{$product['views']}}</h3>
       <h4>Details: {{$product['discription']}}</h4>
       <h4>Category: {{$product['catagory']}}</h4>
       <h4>Difficulty Level: {{$product['difficulty']}}</h4>
       <h4>Price: ${{$product['price']}}</h4>


       <br><br>
       <form action="/add_to_cart" method="POST">
           @csrf
           <input type="hidden" name="product_id" value= {{ $product['id'] }}>
       <button class="btn btn-success">Add to cart</button>
       </form>
       <br><br>
       <form action="/add_to_bookmark" method="POST">
           @csrf
           <input type="hidden" name="product_id" value= {{ $product['id'] }}>
       <button class="btn btn-primary">Watch Later</button>
       </form>
       <br><br>
       <br><br>
    </div>
   </div>
</div>    
@endsection
