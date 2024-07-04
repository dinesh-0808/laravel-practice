@extends('layouts.app')

@section('content')
    <h3>create post</h3>
    <div class="form-group">
        <form action="/posts" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" placeholder="enter the title" class="form-control"><br>
            <input type="text" name="content" placeholder="content" class="form-control"><br>
            <input type="file" class="form-control-file" name="fileToUpload" id="exampleInputFile">
            <input type="submit" name="submit" class="btn btn-primary">
        </form>
    </div>

    @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection