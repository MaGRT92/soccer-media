@extends('admin.master_admin')

@section('content')
<div class="w3-row">
    <div class="w3-col m9 w3-padding-right">
        <div class="w3-card-4 w3-margin-top w3-round">
            <div class="w3-container w3-teal">
                <h2>Create Post</h2>
            </div>
            <form class="w3-container w3-padding-12" method="POST" action="{{ route('admin_post.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label class="w3-text-teal"><b>Title</b></label>
                <input class="w3-input w3-border w3-light-grey w3-margin-bottom" type="text" name="title" value="{{ old('title') }}">

                <label class="w3-text-teal"><b>Body</b></label>
                <textarea class="w3-input w3-border w3-light-grey" name="body" rows="10">{{ old('body') }}</textarea>

                <input type="file" name="post_img" id="post_img" style="display: none" />
                <input type="hidden" name="post_tags" id="post_tags" />

                <button class="w3-btn w3-blue-grey w3-margin-top w3-right">Publish</button>
            </form>

            @include('admin.partials.error')
        </div>
    </div>
    <div class="w3-col m3">
        <div class="w3-card-4 w3-margin-top w3-round">
            <div class="w3-container w3-teal">
                <h2>Add Image</h2>
            </div>
            <div class="w3-container w3-padding-12">
                <div class="w3-margin-bottom">
                    <img id="post_img_preview" src="{{ asset('images/no_image.png') }}" height="300px" width="100%" />
                </div>
                <div class="w3-center">
                    <label for="post_img" class="w3-btn w3-blue-grey" >Choose Image</label>
                </div>
            </div>

        </div>

        <div class="w3-card-4 w3-margin-top w3-round">
            <div class="w3-container w3-teal">
                <h2>Tags</h2>
            </div>
            <div class="w3-container w3-padding-12">
                <div class="w3-center">
                    <button id="btn_show_tags_modal" class="w3-button w3-blue-grey">Choose Tags</button>
                </div>
            </div>

            <div id="tags_modal" class="w3-modal">
                <div class="w3-modal-content w3-animate-right">
                    <header class="w3-container w3-teal"> 
                        <span onclick="document.getElementById('tags_modal').style.display = 'none'" 
                              class="w3-button w3-display-topright">&times;</span>
                        <h2>Choose Tag</h2>
                    </header>
                    <div class="w3-container">
                        <ul id="admin_tags_list" class="w3-ul w3-padding">
                            {!! $tags_list !!}
                        </ul>
                    </div>
                    <footer class="w3-container w3-teal w3-padding">
                        <input type="button" id="btn_add_tags_to_form" class="w3-btn w3-white w3-right" value="OK" />
                    </footer>
                </div>
            </div>
        </div>

    </div>

</div>
<a href="{{ route('admin_post.index') }}" class="w3-btn w3-blue-grey w3-margin-top"><i class="fa fa-long-arrow-left"></i> Back to Posts</a>



@endsection