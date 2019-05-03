@extends('layouts.app')

@section('content')
       <h1>Posts</h1>
       @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="well">
                <a href="/laravel/public/posts/{{$post->id}}"><h3>{{$post->title}}</h3></a>
                <small>written on {{$post->created_at}}</small>
                </div>
            @endforeach

            {{$posts->links()}}
       @else 
            <p>No posts found</p>
       @endif 
@endsection