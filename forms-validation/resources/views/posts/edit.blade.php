@extends('layouts.app')


@section('content')
<h3>edit post</h3>
<form action="/posts/{{$post->id}}" method="post">
    @csrf
    @method('PATCH')
    <input type="text" name="title" placeholder="enter the title" value="{{$post->title}}"><br>
    
    <input type="text" name="content" placeholder="content" class="form-control" value="{{$post->content}}"><br>

    <input type="submit" name="submit">
</form>

@endsection