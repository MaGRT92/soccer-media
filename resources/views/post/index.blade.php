@extends('master')

@section('main_title', 'Latest News')

@section('content')

<div class="row">
    @foreach($posts as $post)

    <div class="col-s-12 col-md-6 col-lg-4">
        <h2 class="post_index_title">{{ $post->title }}</h2>
        <p class="">{{ $post->created_at->diffForHumans() . ' by ' . $post->user->name }}</p>
        <p>{{ str_limit($post->body, $limit = 130, $end = '...') }}</p>
        <p><a class="btn btn-default" href="{{ route('post.show', [ 'friendly_slug' => str_slug($post->slug) ]) }}" role="button">View details &raquo;</a></p>
     
    </div><!--/.col-xs-6.col-lg-4-->

    @endforeach
</div>

{{ $posts->links() }}

@endsection
