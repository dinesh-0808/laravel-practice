@extends('layouts.app')


@section('content')

<div class="image-container">
    <img src="{{$post->path}}" alt="not found" height="500">
</div>

<h3>{{$post->title}}</h3>
<p>{{$post->content}}</p>
<a href="{{route('posts.edit',$post->id)}}">edit</a>
<form method="post" action="/posts/{{$post->id}}">
@csrf
@method('DELETE')
<input type="submit" name="delete" value="delete">
</form>
@endsection