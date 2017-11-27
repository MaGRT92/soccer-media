<div class="w3-card-4 w3-margin-top w3-round">
    <div class="w3-container w3-teal">
        <h2>Add Image</h2>
    </div>
    <div class="w3-container w3-padding-12">
        <div class="w3-margin-bottom">
            <img id="post_img_preview" src="{{ asset($post_img) }}" height="300px" width="100%" />
        </div>
        <div class="w3-center">
            <label for="post_img" class="w3-btn w3-blue-grey" >Choose Image</label>
        </div>
    </div>

</div>

@section('js')
@parent
<script>
    // post img
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#post_img_preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#post_img").change(function () {
        readURL(this);
    });

</script>
@endsection