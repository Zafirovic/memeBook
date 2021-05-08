import { Render } from '../canvas/canvas.js';

$(".file-upload-btn").on('click', () => {
  $('.file-upload-input').trigger('click');
});

$(".file-upload-input").on('change', (e) => {
    let uploading = e.target;
    if (uploading.files && uploading.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function(e) {
        $('.image-upload-wrap').hide();
        $('.file-upload-btn').hide();
        $('.image-title').html(uploading.files[0].name);
        Render(e.target.result);
        $("#image-canvas").show();
        $('.file-upload-content').show();
      };
      reader.readAsDataURL(uploading.files[0]);
    }
    else {
      removeUpload();
    }
});
  
$(".remove-image").on('click', (e) => {
    removeUpload();
});

function removeUpload() {
    $('.file-upload-input').val(null);
    $('.file-upload-content').hide();
    $("#image-canvas").hide();
    $('.image-upload-wrap').show();
    $('.file-upload-btn').show();
}

$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
});

$('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});
  