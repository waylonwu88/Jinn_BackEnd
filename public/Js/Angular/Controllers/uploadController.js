$(document).ready(function() {
 
  //Dropzone.js Options - Upload an image via AJAX.
  Dropzone.options.myDropzone = {
    uploadMultiple: false,
    // previewTemplate: '',
    addRemoveLinks: false,
    // maxFiles: 1,
    dictDefaultMessage: '',
    init: function() {
      this.on("addedfile", function(file) {
        // console.log('addedfile...');
      });
      this.on("thumbnail", function(file, dataUrl) {
        // console.log('thumbnail...');
        $('.dz-image-preview').hide();
        $('.dz-file-preview').hide();
      });
      this.on("success", function(file, res) {
        console.log('upload success...');
        $('#img-thumb').attr('src', res.path);
        $('input[name="pic_url"]').val(res.path);
      });
    }
  };
  var myDropzone = new Dropzone("div#my-dropzone");
 
  $('#upload-submit').on('click', function(e) {
    e.preventDefault();
    //trigger file upload select
    $("#my-dropzone").trigger('click');
  });
 
});
 
//we want to manually init the dropzone.
Dropzone.autoDiscover = false;