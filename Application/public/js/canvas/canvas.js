import { fonts, fontSize } from '../fonts/fonts.js';
import MemeTextBuilder from '../meme/MemeText.js';

var canvas = document.getElementById('image-canvas');
//var ctx = canvas.getContext('2d');

//useful for rerender
var selectedImage;
var defaultContent = "Custom text content";
var selectedFontFamily = fonts[0];
var selectedFontSize = fontSize;
var textStartPosition = 0;

//canvas variables
var canvasOffset = $(canvas).offset();
var offsetX = canvasOffset.left;
var offsetY = canvasOffset.top;
var canvasRightBorder = offsetX + canvas.getBoundingClientRect().width; 
var canvasBottomBorder = offsetY + canvas.getBoundingClientRect().height;

//text array
var memeTexts = Array();
//paper texts array
var memeItemTexts = Array();

function CreateDefaultText() {
    return new MemeTextBuilder().withContent(defaultContent)
                                .withFontFamily(selectedFontFamily)
                                .withFontSize(selectedFontSize)
                                .withTextShadow(false)
                                .build();
}

//draw image with texts
function Render(image) {
    selectedImage = image;
    //setup canvas for paper API
    setupPaperCanvas();
    //setup and fill image
    setupPaperImage();
    //setup and fill texts
    setupPaperTexts();
}

function setupPaperCanvas() {
    paper.setup(canvas);
    //sets the selection box corners size
    paper.settings.handleSize = 12;
    textStartPosition = paper.view.center;
}

function setupPaperImage() {
    var image =  new paper.Raster(selectedImage, paper.view.center);
    image.crossOrigin = "*";
    image.onLoad = function() {
        FillCanvasWithImage(image);
    }
}

function setupPaperTexts() {
    var inputs = $('.text-content');
    inputs.each(function(index) {
        GenerateTextField(inputs[index], index);
    });
}

function GenerateTextField(textInput, index) {
    //generate default text
    var textInstance = CreateDefaultText();
    // create item
    var item = new paper.PointText({
        content: textInstance.content,
        point: textStartPosition.add(new paper.Point(0, index * 30)),
        justification: 'center',
        font: textInstance.fontFamily,
        fontSize: textInstance.fontSize,
        selected: false,
        strokeColor: new paper.Color(1, 0, 0),
        fillColor: new paper.Color(1, 0, 0),
    });
    memeTexts.push(textInstance);
    memeItemTexts.push(item);

    $(textInput).find('textarea.text-input').text(defaultContent);

    canvas.addEventListener('click', (e) => {
        var canvasHit = new paper.Point(e.x - offsetX, e.y - offsetY);
        var cornerHit = item.hitTest(canvasHit, {
            bounds: true,
            tolerance: 10
        });

        if (cornerHit == null && !IsCornerHitOnItem(cornerHit) && !item.hitTest(canvasHit, { fill: true })) {
            item.selected = false;
        } 
    });

    // init variables so they can be shared by event handlers
    var resizeVector;
    var moving;

    item.onResize = event => {
        paper.view.scrollBy(last_point.subtract(paper.view.center));
        last_point = paper.view.center;
        resizeImg();
    }
    
    // on mouse down...
    item.onMouseDown = event => {
        // ...do a hit test on item bounds with a small tolerance for better UX
        var cornerHit = item.hitTest(event.point, {
            bounds: true,
            tolerance: 10
        });
        item.selected = true;

        // if a hit is detected on one of the corners...
        if (cornerHit && IsCornerHitOnItem(cornerHit)) {
            // ...store current vector from item center to point
            resizeVector = event.point.subtract(item.bounds.center);
            // ...else if hit is detected inside item...
        } else if (item.hitTest(event.point, { fill: true })) {
            // ...store moving state
            moving = true;
        }
    }

    // on mouse drag...
    item.onMouseDrag = (e) => {
        e.stopPropagation();
        // ...if a corner was previously hit...
        if (resizeVector) {
            // ...calculate new vector from item center to point
            var newVector = e.point.subtract(item.bounds.center);
            // scale item so current mouse position is corner position
            item.scale(newVector.divide(resizeVector));
            // store vector for next event
            resizeVector = newVector;
            // ...if item fill was previously hit...
        } else {
            // ...move item
            if (!HittingCanvasBorders(item, e)) {
                item.position = item.position.add(e.delta);
            }
        }
    }

    // on mouse up...
    item.onMouseUp = () => {
        // ... reset state
        resizeVector = null;
        moving = null;
    }

    $(textInput).find('input.text-color').on('change', e => {
        let selectedColor = e.target.value;
        item.strokeColor = selectedColor;
        item.fillColor = selectedColor;
    });

    $(textInput).find('textarea.text-input').on('input', e => {
        item.content = e.target.value;
    });

    $(textInput).find('select.fonts').on('change', e => {
        item.font = $(e.target).val();
    });

    $(textInput).find('input.fontSize').val(fontSize);

    $(textInput).find('input.fontSize').on('change', e => {
        item.fontSize = $(e.target).val();
    });

    $(textInput).find('input.fontShadow').on('change', e => {
        if (e.target.checked) {
            //shadow color
            var shadowColor = $(textInput).find('div.text-shadow-color');
            shadowColor.show();
            item.shadowColor = shadowColor.val();
            // Set the shadow blur radius to 12:
            item.shadowBlur = 12;
            // Offset the shadow by { x: 5, y: 5 }
            item.shadowOffset = new paper.Point(5, 5)

            //event for shadow color change
            shadowColor.on('change', e => {
                item.shadowColor = e.target.value;
            });
        }
        else {
            item.shadowColor = null;
            item.shadowBlur = 0;
            item.shadowOffset = null;

            $(textInput).find('div.text-shadow-color').hide();
        }
    });
}

function FillCanvasWithImage(image) {
    paper.view.onFrame = () => {
        image.fitBounds(paper.view.bounds);
    }
}

function AddNewText() {
    $('.text-content').first().clone().appendTo('.input-container');
    //rerender with new text
    GenerateTextField($('.text-content').last(), $('.text-content').length - 1);
    //disable adding new text on 5 texts
    if ($('.text-content').length == 5) {
        let addText = $('#add-new-text');
        addText.addClass('disabled-tag');
        addText.removeAttr('href');
    }
}

function IsCornerHitOnItem(cornerHit) {
    if (cornerHit == null) {
        return false;
    }
    return ['top-left', 'top-right', 'bottom-left', 'bottom-right'].indexOf(cornerHit.name) >= 0;
}

function HittingCanvasBorders(textInput, event) {
    var movedPosition = textInput.position.add(event.delta);
     movedPosition.x += offsetX;
     movedPosition.y += offsetY;

    var hitResult = HittingUpperBorder(movedPosition) || HittingBottomBorder(movedPosition) ||
                    HittingLeftBorder(movedPosition) || HittingRightBorder(movedPosition);
    return hitResult;
}

function HittingUpperBorder(movedPosition) {
    var hit = movedPosition.y <= offsetY;
    return hit;
}

function HittingBottomBorder(movedPosition) {
    var hit = movedPosition.y >= canvasBottomBorder;
    return hit;
}

function HittingLeftBorder(movedPosition) {
    var hit = movedPosition.x <= offsetX;
    return hit;
}

function HittingRightBorder(movedPosition) {
    var hit = movedPosition.x >= canvasRightBorder;
    return hit;
}

function UnselectAllItems() {
    memeItemTexts.forEach((value, index) => value.selected = false);
}

function ExportImageData() {
    return memeItemTexts;
}

export { Render, AddNewText, UnselectAllItems, ExportImageData };
