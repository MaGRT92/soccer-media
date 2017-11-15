@extends('admin.master_admin')

@section('content')

    <h2>{{ $post->title}}</h2>

    <p>{{ $post->body }}</p>

    <a href="{{ route('admin_post.index') }}" class="w3-btn w3-blue-gray"><i class="fa fa-long-arrow-left"></i> Back to Posts</a>
@endsection
