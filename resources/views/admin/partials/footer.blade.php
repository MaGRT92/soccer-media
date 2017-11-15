<!-- Footer -->
<footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<!-- End page content -->
</div>

<script src="{{ asset('js/jquery.js') }}"></script>

<script>
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
    
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#post_img_preview').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#post_img").change(function(){
    readURL(this);
});
    
// Get the Sidebar
    var mySidebar = $("#mySidebar");
// Get the DIV with overlay effect
    var overlayBg = $("#myOverlay");
// Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_open() {
        if (mySidebar.css('display') === 'block') {
            mySidebar.hide();
            overlayBg.hide();
        } else {
            mySidebar.show();
            overlayBg.show();
        }
    }

// Close the sidebar with the close button
    function w3_close() {
        mySidebar.hide();
        overlayBg.hide();
    }
</script>