@extends('admin.master_admin')

@section('content')


<a href="{{ route('admin_post.create') }}" class="w3-btn w3-green w3-margin-top w3-right">Create New Post</a>
<h2>All Posts</h2>

<ul class="w3-ul w3-card-4 w3-white w3-margin-bottom">
    @foreach($posts as $post)
    <li class="w3-padding-32">
        <a href="{{ route('admin_post.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
        <button class="btn-delete-post-show-modal w3-right w3-margin-right w3-btn w3-red" data-delete-form-number="{{ $post->id }}">
            <i class="fa fa-trash-o"></i> Delete
        </button>
        <form id="delete-post-form-{{ $post->id }}" action="{{ route('admin_post.destroy', ['post' => $post->id]) }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
        <a href="{{ route('admin_post.edit', ['post' => $post->id]) }}" class="w3-right w3-margin-right w3-btn w3-amber">
            <i class="fa fa-pencil-square-o"></i> Edit
        </a>
    </li>
    @endforeach
</ul>

<div id="modal_delete_post_confirm" class="w3-modal">
    <div class="w3-modal-content">
        <header class="w3-container w3-blue-gray"> 
            <h2>Deleting Post</h2>
        </header>
        <div class="w3-container">
            <p>Are you sure you want to delete post?</p>
        </div>
        <footer class="w3-container w3-padding w3-blue-gray">
            <button id="btn_delete_confirm_yes" class="w3-btn w3-red">Yes</button>
            <button id="btn_delete_confirm_no" class="w3-btn w3-green w3-right">No</button>
        </footer>
    </div>
</div>

@endsection

@section('js')
<script>
    // delete post confirmation
    var delete_form_number = 0;
    var btn_delete_confirm_no = $('#btn_delete_confirm_no');
    var btn_delete_confirm_yes = $('#btn_delete_confirm_yes');
    var btn_delete_post_show_modal = $('.btn-delete-post-show-modal');
    btn_delete_confirm_no.off('click');
    btn_delete_confirm_yes.off('click');
    btn_delete_post_show_modal.off('click');

    btn_delete_confirm_no.on('click', function (e) {
        e.preventDefault();
        $('#modal_delete_post_confirm').hide();
    });
    btn_delete_confirm_yes.on('click', function (e) {
        e.preventDefault();
        if (delete_form_number > 0) {
            $('#delete-post-form-' + delete_form_number).submit();
        }
    });

    btn_delete_post_show_modal.on('click', function (e) {
        e.preventDefault();
        delete_form_number = $(this).data('delete-form-number');
        $('#modal_delete_post_confirm').show();
    });
</script>
@endsection