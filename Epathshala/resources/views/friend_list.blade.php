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
<div class="container">
<form action="/searchFriend" class="navbar-form navbar-left">
        <div class="topnav">
          <input type="text" name="query" class="topnav" placeholder="Search Friends Via Email">
        </div>
        <button type="search" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      </form>
      </div>



@foreach ($friend_list as $item)
    <?php
     $data = User::where('email', $item['email'])->first(); // Use first() instead of get()
    ?>
    <div class="row">
        <div class="column" style="background-color:#aaa;"><p>
        <a href="profile/{{$data->id}}">
        <h2>{{$data["name"]}} </h2> </a>
        <h2>{{$data["email"]}} </h2>
        </p>
        
        </div>
        
    
    <div class="col-sm-3">
                <a href="/removefriend/{{$item->id}}" class="btn btn-warning" >Remove Friend</a>
             </div>
             </div>
    <hr style="height:1px">
@endforeach




@endsection
