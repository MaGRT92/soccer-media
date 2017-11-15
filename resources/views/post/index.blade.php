@extends('master')

@section('main_title', 'Latest News')

@section('content')

@foreach($posts as $post)
<div class="w3-row w3-margin-top">
    <div class="w3-col s12">
        <div class="w3-card w3-round">
            <div class="w3-container w3-green">
                <h5><a href="{{ route('post.show', [ 'post' => $post->id ]) }}">{{ $post->title }}</a></h5>
            </div>
            <div class="w3-container w3-padding-12">
                {{ strip_tags(substr($post->body, 0, 130)) . '...' }}
            </div>
            
        </div>
        <div class="w3-container w3-padding w3-border-bottom">
          
            <span class="w3-small">{{ $post->created_at->diffForHumans() . ' by '}}</span>
            </div>
    </div>
</div>
@endforeach

@endsection