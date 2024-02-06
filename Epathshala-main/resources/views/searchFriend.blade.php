@extends('master')
@section('content')
<div class="custom-product">

<div class="trending-wrapper">
  <h4>Search Results</h4>
  @foreach($searchFriend as $item)
  <div class="search-item">
  <a href="profile/{{ $item['id'] }}">
      
      <div class="">
        <h2>{{$item['name']}}</h2></a>
        <h5>{{$item['email']}}</h5>

      </div>
      
    </div>
      @endforeach

</div>

</div>
@endsection
