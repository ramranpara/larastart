@extends('layouts.app')

@section('content')
    <p>this is from show php</p>  
        <a href="/laravel/public/posts" class="btn btn-default">Go Back</a>    

        <h1>{{$post->title}}</h1>

        <div> {{$post->body}} </div>

        <hr>
        <small>written on {{$post->created_at}}</small>
        <hr>
        
        <a href="/laravel/public/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!! Form::close()!!}
@endsection