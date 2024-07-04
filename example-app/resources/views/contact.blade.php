@extends('layouts.app')

@section('content')

<h1>contact page</h1>

@foreach ($people as $person)

<h6>{{$person}}</h6>
    
@endforeach

@endsection