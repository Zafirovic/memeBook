function ShowSpinnerInButton(button) {
    var loadingText = '<i class="spinner-border spinner-border-sm fa-spin"></i> Processing...';
    if (button.html() !== loadingText) {
        button.data('original-text', button.html());
        button.html(loadingText);
      }
      setTimeout(function() {
        button.html(button.data('original-text'));
      }, 10000);
}

function ScreenLoaderGlobal() {
    $('<div class="loader-mask"><div class="loader"></div></div>').appendTo('body');
}

function RemoveScreenLoaderGlobal() {
    setTimeout(function() {
        $('.loader-mask').remove();
    }, 10000);
}

export { ShowSpinnerInButton, ScreenLoaderGlobal, RemoveScreenLoaderGlobal };