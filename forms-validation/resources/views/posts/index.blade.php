@extends('layouts.app')


@section('content')
<h1>POSTS</h1>
<ul>
    @foreach ($posts as $post)
        <li><a href="{{route('posts.show',$post->id)}}">{{$post->title}}</a></li>
    @endforeach
</ul>

<form action="/posts/create">
    <input type="submit" name="add post" value="add post">
</form>

@endsection