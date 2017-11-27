@extends('admin.master_admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<div class="w3-row">
    <div class="w3-col m9 w3-padding-right">
        <div class="w3-card-4 w3-margin-top w3-round">
            <div class="w3-container w3-teal">
                <h2>Edit Post</h2>
            </div>
            <form class="w3-container w3-padding-12" method="POST" action="{{ route('admin_post.update', ['post' => $post->id] ) }}" enctype="multipart/form-data" data-parsley-validate>
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <label class="w3-text-teal"><b>Title</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" name="title" value="{{ $post->title }}" data-parsley-required="true" data-parsley-minlength="3">

                <label class="w3-text-teal"><b>Slug</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" name="slug" value="{{ $post->slug }}" data-parsley-required="true" data-parsley-minlength="3">
                
                <div class="w3-margin-bottom">
                    <label class="w3-text-teal"><b>Tags</b></label>
                    <select name="tags[]" multiple="multiple" class="w3-input w3-border js-example-basic-multiple">
                        @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <label class="w3-text-teal"><b>Body</b></label>
                <textarea class="w3-input w3-border" name="body" rows="10" data-parsley-required="true" data-parsley-minlength="10">{{ $post->body }}</textarea>

                <input type="file" name="post_img" id="post_img" style="display: none" />

                <button class="w3-btn w3-blue-grey w3-margin-top w3-right">Save Changes</button>
            </form>

            @include('admin.partials.error')
        </div>
    </div>

    <div class="w3-col m3">
      
        @include('admin_post._create_edit_sidebar', compact('post_img'))

    </div>
</div>
<a href="{{ route('admin_post.index') }}" class="w3-btn w3-blue-grey w3-margin-top"><i class="fa fa-long-arrow-left"></i> Back to Posts</a>
@endsection

@section('js')
<script src="{{ asset('js/parsley.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    $('.js-example-basic-multiple').select2().val({!! json_encode($post->tags()->allRelatedIds()) !!}).trigger('change');
    });
</script>
@endsection