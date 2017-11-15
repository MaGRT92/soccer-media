@extends('admin.master_admin')

@section('content')
<div class="w3-card-4 w3-margin-top">
    <div class="w3-container w3-teal">
        <h2>Edit Post</h2>
    </div>
    <form class="w3-container w3-padding-12" method="POST" action="{{ route('admin_post.update', ['post' => $post->id] ) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <label class="w3-text-teal"><b>Title</b></label>
        <input class="w3-input w3-border w3-light-grey w3-margin-bottom" type="text" name="title" value="{{ $post->title }}">

        <label class="w3-text-teal"><b>Body</b></label>
        <textarea class="w3-input w3-border w3-light-grey" name="body" rows="10">{{ $post->body }}</textarea>

        <button class="w3-btn w3-blue-grey w3-margin-top w3-right">Save Changes</button>
    </form>

    @include('admin.partials.error')
</div>
<a href="{{ route('admin_post.index') }}" class="w3-btn w3-blue-grey w3-margin-top"><i class="fa fa-long-arrow-left"></i> Back to Posts</a>
@endsection