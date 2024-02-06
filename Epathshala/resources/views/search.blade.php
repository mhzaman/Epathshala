@extends('master')
@section('content')
<div class="custom-product">

<div class="trending-wrapper">
  <h4>Search Results</h4>
  @foreach($products as $item)
  <div class="search-item">
  <a href="detail/{{ $item['id'] }}">
      <img class="trending-image" src=" {{$item['cover']}} ">
      <div class="">
        <h2>{{$item['name']}}</h2>
        <h5>{{$item['discription']}}</h5>
      </div>
      </a>
    </div>
      @endforeach

</div>

</div>
@endsection
