<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Session;

if (Session::has('user'))  {
    $user = session('user'); // Get the logged-in user
    $total = ProductController::cart_item($user['id']);
} else {
    $total = 696969; // Default value if user is not logged in
}
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand"  href="/">
      E-Pathshala
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="/">Home</a></li>
        @if(Session::has('user'))
     @if($user['role'] == 'admin')
         <li class=""><a href="/offer_push">Post Voucher</a></li>
         @else
         <li class=""><a href="/voucher_list">Available Vouchers</a></li>
    @endif
    @if($user['role'] == 'teacher')
         <li class=""><a href="/new_course">Upload Course</a></li>
    @endif
    @endif
        
        <li class=""><a href="/friends">Friends</a></li>

      </ul>
      <form action="/search" class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" name="query" class="form-control search-box" placeholder="Search">
        </div>
        <button type="search" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
      @if(Session::has('user'))
        <li><a href="/bookmark"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span><br>Watch Later</a></li>
        <li><a href="/cartlist"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><br>Cart ({{$total}}) </a></li>
          
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="/userProfile/{{session('user')['id']}}">{{Session::get('user')['name']}}
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <li class=""><a href="/userProfile/{{session('user')['id']}}">{{ session('user')['name'] }}</a></li>
            <li class=""><a href="/myCourse">My Courses</a></li>
            <li class=""><a href="/voucher">Add a Voucher</a></li>


              <li><a href="/logout">Logout</a></li>
            </ul>
          </li>
          @else
          <li><a href="/login">Login</a></li>
          @endif

      </ul>
    </div>
  </div>
</nav>