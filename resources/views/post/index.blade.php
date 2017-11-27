@extends('master')

@section('main_title', 'Latest News')

@section('content')

<div class="row">
    @foreach($posts as $post)

    <div class="col-sm-12 container">

        <div class="blog-post">
            <h2 class="blog-post-title">{{ $post->title }}</h2>
            <p class="blog-post-meta">{{ $post->created_at->diffForHumans() . ' by ' . $post->user->name }}</p>
            <p>{{ str_limit($post->body, $limit = 130, $end = '...') }}</p>
            <p><a class="btn btn-default" href="{{ route('post.show', [ 'friendly_slug' => str_slug($post->slug) ]) }}" role="button">View details &raquo;</a></p>

        </div><!-- /.blog-post -->
    </div><!--/.col-xs-6.col-lg-4-->

    @endforeach
</div>

{{ $posts->links() }}

@endsection
