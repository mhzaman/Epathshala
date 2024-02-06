@extends('master')
@section("content")
<div class="custom-product">
     <div class="col-sm-10">
        <div class="trending-wrapper">
            <h4>Purchased Courses: </h4>
            @foreach($products as $item)
            <div class=" row searched-item cart-list-devider">
             <div class="col-sm-3">
                <a href="detail/{{$item->id}}">
                    <img class="trending-image" src="{{$item->cover}}">
                  
             </div>
             <div class="col-sm-4">
                    <div class="">
                      <h2>{{$item->name}}</h2></a>
                      <h5>{{$item->discription}}</h5>
                    </div>
             </div>
          
            </div>
            @endforeach
          </div>

     </div>
</div>
@endsection 

