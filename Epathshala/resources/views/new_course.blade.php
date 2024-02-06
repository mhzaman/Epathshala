@extends('master')
@section('content')


<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form action="/publish_course" method="POST">
            <div class="form-group">
                    @csrf
                <label for="exampleInputEmail1">Course Title </label>
                <input type="text" name="title" class="form-control" placeholder="Enter Course Title" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputpassword1">Catagory</label>
                <input type="text" name="catagory" class="form-control" placeholder="What is the Catagory" id="exampleInputpassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputpassword1">Discription</label>
                <input type="text" name="discription" class="form-control" placeholder="Describe The content" id="exampleInputpassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputpassword1">Difficulty Level</label>
                <input type="text" name="difficulty" class="form-control" placeholder="Enter 1,2,3 as level" id="exampleInputpassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputpassword1">Cover</label>
                <input type="text" name="cover" class="form-control" placeholder="Enter Cover link" id="exampleInputpassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputpassword1">Price</label>
                <input type="text" name="price" class="form-control" placeholder="Enter Price in $" id="exampleInputpassword1">
            </div>
            <button type="submit" class=btn btn-default>
                Publish Course
            </button>
            </form>

        </div>
    </div>
</div>


@endsection