@extends('master')
@section('content')
<div class="container">
   <div class="row">
   <div class="col-sm-6">
       <img class="detail-img" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="">
       </div>
       <div class="col-sm-6">
           <a href="/">Go Back</a>
       <h2>{{$userProfile['name']}}</h2>
       <h5>{{$userProfile['email']}}</h5>

    </div>
   </div>
</div>    
@endsection
