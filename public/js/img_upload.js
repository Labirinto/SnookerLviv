function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imgPreview').css('background-image', 'url('+e.target.result +')');
            $('#imgPreview').hide();
            $('#imgPreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imgUpload").change(function() {
    readURL(this);
});
