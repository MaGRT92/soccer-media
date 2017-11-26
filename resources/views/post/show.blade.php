@extends('master')

@section('main_title', $post->title)

@section('content')

@if(trim($post->post_img) !== '')
<img src="{{ asset('uploads') . '/' . $post->post_img}}" width="100%" />
@endif

<div id="post_body">
    <p>{{ $post->body }}</p>
</div>


<div id="post_tags_panel">
    @foreach($post->tags as $tag)
    <a href="{{ route('post.index_tag', ['tag' => $tag->name] ) }}" class="tag_link label label-success larger_text">{{ $tag->name }}</a>
    @endforeach
</div>

<a href="{{ route('home') }}" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Back to Posts List</a>

<div id="post_comments_panel">
    <h3>Latest Comments</h3>
    <hr>
    @foreach($post->comments as $comment)
    <div class="list-group comment_panel">
        <h4 class="list-group-item-heading">{{ $comment->body }}</h4>
        <p class="list-group-item-text">{{ $comment->created_at->diffForHumans() . ' by ' . $comment->user->name }}</p>
    </div>
    @endforeach

</div>

<div id="post_add_comment_panel">
    @guest
    <div class="alert alert-danger">
        <h6>You must be logged in to add comments!</h6>
    </div>
    @else
    <hr>
    <h3>Add Comment</h3>
    <form method="POST" action="{{ route('comments.store', ['post' => $post->id] ) }}">
        {{ csrf_field() }}
        <div class="form-group">
            <textarea placeholder="Comment" class="form-control" name="body"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Add Comment" class="btn btn-primary pull-right" />
        </div>
    </form>
    @endguest
</div>

@endsection