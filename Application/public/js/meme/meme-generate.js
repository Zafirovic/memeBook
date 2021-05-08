import { fonts } from '../fonts/fonts.js';
import { Render, AddNewText, UnselectAllItems, ExportImageData } from '../canvas/canvas.js';
import { ShowSpinnerInButton, ScreenLoaderGlobal, RemoveScreenLoaderGlobal } from '../animations/animation.js'

setTimeout(OnCanvasLoad, 50);
let imageTitle;

//prefill font select options
var fontsSelect = $("select.fonts");
$.each(fonts, function() {
    fontsSelect.append($("<option />")
               .val(this)
               .text(this)
               .css("font-family", this));
});

//on radio btn change
$("input[name='chooseMemeType']").on('change', function() {
    if ($("#image-spinner").length)
        $("#image-spinner").remove();

    let selectedOption = $(this).val();
    let selectionContainer = $(".preview-container");

    if (selectedOption == 1) {
        //replace file input with canvas
        $(".meme-select-option").show();
        selectionContainer.find(".meme-upload-option").hide();
        selectionContainer.find("#image-canvas").show();

        let image = OnCanvasLoad();
        Render(image);
    }
    else if (selectedOption == 2) {
        //replace canvas with file input
        $(".meme-select-option").hide();
        selectionContainer.find(".meme-upload-option").show();
        selectionContainer.find("#image-canvas").hide();
    }
});

//generate meme form submission
$('form[name="create-meme-form"').on('submit', e => {
    e.preventDefault();
    //clear selected texts from image 
    UnselectAllItems();
    
    var imageData = ExportImageData();

    let form = e.currentTarget;
    let img = document.getElementById('image-canvas');
    let category = $(form).find("select[name='category_id'] option:selected").val();
    let requestData = {
        image: img.toDataURL(),
        category_id: category
    };
    let actionUrl = $('form[name="create-meme-form"').attr('action');
    let submitButton = $(form).find(":submit");
    //show spinner in button
    ShowSpinnerInButton(submitButton);
    ScreenLoaderGlobal();

    $.ajax({
        type: "POST",
        url: actionUrl,
        data: requestData,
        dataType: 'JSON',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(response) {
            window.location = response.data.url;
        },    
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            console.log(xhr.responseText);
            //TODO[Laza]: Handle error
        }
    });
    RemoveScreenLoaderGlobal();
});

function OnCanvasLoad() {
    let img = $("#slide").find(":first");
    Render($(img).attr("src"));
    SaveSelectedImageTitle($(img).attr("title"));
}

$("body").on("click", '#slide > img', (e) => {
    let selectedImg = e.target;
    Render(selectedImg);
});

$("#slide > img").on({
    mouseenter: (e) => {
        let hoveredImg = e.target;
        $(".meme-title").html($(hoveredImg).attr("title"));
    },
    mouseleave: () => {
        $(".meme-title").html(imageTitle);
    },
    click: (e) => {
        SaveSelectedImageTitle($(e.target).attr("title"));
    }
});

function SaveSelectedImageTitle(title) {
    let boldTitle = `<b>${title}</b>`;
    $(".meme-title").html(boldTitle);
    imageTitle = boldTitle;
}

$('#add-new-text').on('click', e => {
    AddNewText();
});
