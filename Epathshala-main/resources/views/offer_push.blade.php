@extends('master')
@section('content')



<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form action="/publish_offer" method="POST">
            <div class="form-group">
                    @csrf
                <label for="exampleInputEmail1">Coupon</label>
                <input type="text" name="coupon" class="form-control" placeholder="Enter Coupon Code" id="exampleInputEmail1">
            </div>

            <div class="form-group">
                <label for="exampleInputpassword1">Amount</label>
                <input type="text" name="amount" class="form-control" placeholder="Enter Amount" id="exampleInputpassword1">
            </div>
            <button type="submit" class=btn btn-default>
                Submit
            </button>
            </form>

        </div>
    </div>
</div>
<!--
<label for="basic-url">Your vanity URL</label>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon3">https://example.com/users/</span>
  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
</div> -->
@endsection 
