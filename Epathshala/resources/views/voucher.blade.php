@extends('master')
@section('content')


<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form action="/addvoucher" method="POST">
            <div class="form-group">
                    @csrf
                <label for="exampleInputEmail1">Code</label>
                <input type="text" name="coupon" class="form-control" placeholder="Enter Coupon Code" id="exampleInputEmail1">
            </div>
            <button type="submit" class=btn btn-default>
                Add Voucher
            </button>
            </form>

        </div>
    </div>
</div>

@endsection 
