@extends('master')

@section('main_title', $post->title)

@section('content')

@if(trim($post->post_img) !== '')
<img src="{{ asset('uploads') . '/' . $post->post_img}}" width="100%" />
@endif

<p>{{ $post->body }}</p>

<div class="w3-padding">
    @foreach($post->tags as $tag)
    <div class="w3-tag w3-round w3-green" style="padding:3px">
        <div class="w3-tag w3-round w3-green w3-border w3-border-white">
            <a href="{{ route('post.index_tag', ['tag' => $tag->name] ) }}" class="tag_link">{{ $tag->name }}</a>
        </div>  
    </div>
    @endforeach
</div>

<a href="{{ route('home') }}" class="w3-btn w3-green w3-margin-top"><i class="fa fa-long-arrow-left"></i> Back to Posts List</a>

<div class="w3-margin-top">
    <h3>Latest Comments</h3>
    <ul class="w3-ul">
        @foreach($post->comments as $comment)
        <li class="w3-panel w3-border w3-round">
            <div class="w3-right w3-tiny w3-padding">{{ $comment->created_at->diffForHumans() . ' by ' . $comment->user->name }}</div>
            <div>{{ $comment->body }}</div>
        </li>
        @endforeach
    </ul>
</div>

<div class="w3-margin-top">
    @guest
    <div class="w3-red w3-padding">
        <h6>You must be logged in to add comments!</h6>
    </div>
    @else
    <h3>Add Comment</h3>
    <form method="POST" action="{{ route('comments.store', ['post' => $post->id] ) }}">
        {{ csrf_field() }}
        <textarea placeholder="Comment" class="w3-input w3-border w3-margin-bottom" name="body"></textarea>
        <input type="submit" value="Add Comment" class="w3-btn w3-blue w3-right" />
    </form>
    @endguest
</div>

@endsection