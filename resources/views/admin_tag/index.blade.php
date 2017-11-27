@extends('admin.master_admin')

@section('css')
 <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection

@section('content')
<button id="btn_show_create_new_tag_modal" class="w3-btn w3-green w3-margin-top w3-right">Create New Tag</button>
<h2>All Tags</h2>

<ul class="w3-ul w3-card-4 w3-white w3-margin-bottom">
    @foreach($tags as $tag)
    <li class="w3-padding-32">
        {{ $tag->name }}
        <button class="btn-delete-tag-show-modal w3-right w3-margin-right w3-btn w3-red" data-delete-form-number="{{ $tag->id }}">
            <i class="fa fa-trash-o"></i> Delete
        </button>
        <form id="delete-tag-form-{{ $tag->id }}" action="{{ route('admin_tag.destroy', ['tag' => $tag->id]) }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
        <button class="w3-right w3-margin-right w3-btn w3-amber btn_show_edit_tag_modal" data-tag_name="{{ $tag->name }}" data-tag_id="{{ $tag->id }}">
            <i class="fa fa-pencil-square-o"></i> Edit
        </button>
    </li>
    @endforeach
</ul>

<div id="modal_delete_tag_confirm" class="w3-modal">
    <div class="w3-modal-content">
        <header class="w3-container w3-blue-gray"> 
            <h2>Deleting Tag</h2>
        </header>
        <div class="w3-container">
            <p>Are you sure you want to delete tag?</p>
        </div>
        <footer class="w3-container w3-padding w3-blue-gray">
            <button id="btn_delete_confirm_yes" class="w3-btn w3-red">Yes</button>
            <button id="btn_delete_confirm_no" class="w3-btn w3-green w3-right">No</button>
        </footer>
    </div>
</div>

<div id="modal_create_new_tag" class="w3-modal">
    <div class="w3-container w3-padding-12 w3-margin-top">
        <div class="w3-modal-content">
            <header class=" w3-container w3-blue-gray"> 
                <h2>Creating Tag</h2>
            </header>
            <div class="w3-container w3-margin-top w3-margin-bottom" style="height: 70px;">
                <form method="POST" action="{{ route('admin_tag.store') }}" data-parsley-validate>
                    {{ csrf_field() }}
                    <div class="w3-row-padding">
                        <div class="w3-col m7">
                            <input type="text" class="w3-input w3-border" name="name" data-parsley-required="true" data-parsley-minlength="3" data-parsley-maxlength="15"/>
                        </div>
                        <div class="w3-col m5">
                            <input type="submit" class="w3-btn w3-btn-block w3-green" value="Save" style="margin-top: 2px;" />
                        </div>
                    </div>
                </form>
            </div>
            <footer class="w3-container w3-padding w3-blue-gray">
                <button class="w3-btn w3-red w3-right" onclick="$('#modal_create_new_tag').hide()">Cancel</button>
        </footer>
        </div>
    </div>
</div>

<div id="modal_edit_tag" class="w3-modal">
    <div class="w3-container w3-padding-12 w3-margin-top">
        <div class="w3-modal-content">
            <header class=" w3-container w3-blue-gray"> 
                <h2>Editing Tag</h2>
            </header>
            <div class="w3-container w3-margin-top w3-margin-bottom" style="height: 70px;">
                <form method="POST" action="{{ route('admin_tag.update') }}" data-parsley-validate>
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="w3-row-padding">
                        <div class="w3-col m7">
                            <input type="text" class="w3-input w3-border" id="modal_tag_name" name="name" data-parsley-required="true" data-parsley-minlength="3" data-parsley-maxlength="15"/>
                            <input type="hidden" name="id" id="modal_tag_id" />
                        </div>
                        <div class="w3-col m5">
                            <input type="submit" class="w3-btn w3-btn-block w3-green" value="Update" style="margin-top: 2px;" />
                        </div>
                    </div>
                </form>
            </div>
            <footer class="w3-container w3-padding w3-blue-gray">
                <button class="w3-btn w3-red w3-right" onclick="$('#modal_edit_tag').hide()">Cancel</button>
        </footer>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/parsley.min.js') }}"></script>
<script>
    // delete post confirmation
    var delete_form_number = 0;
    var btn_delete_confirm_no = $('#btn_delete_confirm_no');
    var btn_delete_confirm_yes = $('#btn_delete_confirm_yes');
    var btn_delete_tag_show_modal = $('.btn-delete-tag-show-modal');
    btn_delete_confirm_no.off('click');
    btn_delete_confirm_yes.off('click');
    btn_delete_tag_show_modal.off('click');

    btn_delete_confirm_no.on('click', function (e) {
        e.preventDefault();
        $('#modal_delete_tag_confirm').hide();
    });
    btn_delete_confirm_yes.on('click', function (e) {
        e.preventDefault();
        if (delete_form_number > 0) {
            $('#delete-tag-form-' + delete_form_number).submit();
        }
    });

    btn_delete_tag_show_modal.on('click', function (e) {
        e.preventDefault();
        delete_form_number = $(this).data('delete-form-number');
        $('#modal_delete_tag_confirm').show();
    });

    var btn_show_create_new_tag_modal = $('#btn_show_create_new_tag_modal');
    btn_show_create_new_tag_modal.off('click');
    btn_show_create_new_tag_modal.on('click', function (e) {
        e.preventDefault();
        $('#modal_create_new_tag').show();
    });
    
    var btn_show_edit_tag_modal = $('.btn_show_edit_tag_modal');
    btn_show_edit_tag_modal.off('click');
    btn_show_edit_tag_modal.on('click', function (e) {
        e.preventDefault();
        $('#modal_tag_id').val($(this).data('tag_id'));
        $('#modal_tag_name').val($(this).data('tag_name'));
        $('#modal_edit_tag').show();
    });
</script>
@endsection