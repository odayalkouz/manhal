function showProprties() {

    if ($(".proprties").length)$(".proprties").remove();

    str = '<div class="proprties">' +
        '' +
        '<div class="proprtiesContainer">' +
        '' +
        '<div class="headProprties">' +
        '<label>Proprties</label>' +
        '<img class="closePng" onclick="closeProprties()" src="images/close.png">' +
        '</div>' +
        '' +
        '<div class="bodyProprties">' +
        '' +
        '<section class="section">' +
        '<label>Thumb</label>' +
        '<input type="text" value="' + config.rootPath + "/" + ActiveElement.src + '" id="ObjectImage">' +

        '<img  class="thumb" src="' + config.rootPath + "/" + ActiveElement.src + '">' +
        '</section>' +
        '' +
        '<section class="section ">' +
        '<label>Text</label>' +
        '<input type="text" value="' + ActiveElement.text + '" id="ObjectText">' +
        '<button type="button" onclick="updatetext()" id="saveEdit">saveEdit</button>' +
        '</section>' +
        '' +
        '<section class="section">' +
        '<label>sound</label>' +
        '<input type="text" value="' + ActiveElement.sound + '" id="ObjectSound">' +
        '<button type="button" onclick="soundEdit()" id="sound">sound</button>' +
        '<audio id="audioPreview" controls>' +
        '<source src="' + ActiveElement.sound + '">' +
        '</audio>' +
        '</section>' +
        '' +
        '' +
        '' +
        '</div>' +
        '' +
        '<div class="footerProprties">' +

        '</div>' +
        '' +
        '</div>' +

        '</div>'

    $(str).appendTo('body')
}

function showSetting() {

    if ($(".proprties").length)$(".proprties").remove();

    str = '<div class="proprties">' +
        '' +
        '<div class="proprtiesContainer">' +
        '' +
        '<div class="headProprties">' +
        '<label>Proprties</label>' +
        '<img class="closePng" onclick="closeProprties()" src="images/close.png">' +
        '</div>' +
        '' +
        '<div class="bodyProprties">' +
        '' +
        '<section class="section settingSection">' +
        '<label>Bg image</label>' +
        '<input type="text" value="' + config.rootPath + "/" + game.backgroundImage + '" id="bgImage">' +
        '<img  class="thumb" src="' + config.rootPath + "/" + game.backgroundImage + '">' +
        '<button type="button" onclick="bgEditBackground()" id="bgEditt">bg Edit</button>' +

        '</section>' +
        '' +

        '' +
        '<section class="section settingSection">' +
        '<label>sound</label>' +
        '<input type="text" value="../games/gamesUser/' + game.backgroundSound + '" id="ObjectSound">' +
        '<button type="button" onclick="soundEditBackground()" id="sound">bg sound</button>' +
        '<audio id="audioPreview" controls>' +
        '<source src="' + config.rootPath + "/" + game.backgroundSound + '">' +
        '</audio>' +
        '</section>' +
        '' +
        '' +
        '' +
        '</div>' +
        '' +
        '<div class="footerProprties">' +

        '</div>' +
        '' +
        '</div>' +

        '</div>'

    $(str).appendTo('body')
}

function closeProprties() {
    if ($(".proprties").length)$(".proprties").remove();

}
function soundEdit() {
    simulateUpload($('#uploadsoundObject'))
}
function soundEditBackground() {
    simulateUpload($('#uploadBackgroundSound'))
}

function bgEditBackground() {
    simulateUpload($('#uploadBackground'))
}


function getCssValue() {

    $("#opacityObject").val(game.objects[ActiveElement.index].opacity)
}

function onOpacityChange(object) {

    $("#" + ActiveElement.id).find('img').css('opacity', $(object).val());

    updateOpacity($(object).val())
}


function BringToFront() {

    if (ActiveElement == "") {
        alert("Select object!")
        return
    }
    maxValus = 0
    length = game.objects.length;
    objects = game.objects


    for (i = 0; i < length; i++) {

        if (maxValus < objects[i].zIndex) {

            maxValus = objects[i].zIndex
        }

    }
    maxValus = eval(maxValus + 1)

    setZindex(maxValus)
}

function SendToBack() {
    if (ActiveElement == "") {
        alert("Select object!")
        return
    }
    minValue = 0
    length = game.objects.length;
    objects = game.objects


    for (i = 0; i < length; i++) {
        if (minValue < objects[i].zIndex) {

            minValue = objects[i].zIndex
        }

    }
    minValue = eval(minValue - 1)

    setZindex(minValue)
}

function BringForward() {
    if (ActiveElement == "") {
        alert("Select object!")
        return
    }
    value = game.objects[ActiveElement.index].zIndex;
    value = eval(value + 1)
    setZindex(value)
}

function SendBackward() {
    if (ActiveElement == "") {
        alert("Select object!")
        return
    }
    value = game.objects[ActiveElement.index].zIndex;
    value = eval(value - 1)
    setZindex(value)

}


function setZindex(value) {
    if (ActiveElement == "") {
        alert("Select object!")
        return
    }
    game.objects[ActiveElement.index].zIndex = value;
    //alert(value)
    $("#" + ActiveElement.id).css('z-index', value);

}

function flipObject() {

    if (ActiveElement == "") {
        alert("Select object!")
        return
    }

    flip = game.objects[ActiveElement.index].flip

    if (flip) {
        flipValue = 1
        game.objects[ActiveElement.index].flip = false
    }
    else {
        flipValue = -1
        game.objects[ActiveElement.index].flip = true
    }


    $("#" + ActiveElement.id).find('img').css({
        '-moz-transform': 'scaleX(' + flipValue + ')',
        '-o-transform': 'scaleX(' + flipValue + ')',
        '-webkit-transform': 'scaleX(' + flipValue + ')',
        'transform': 'scaleX(' + flipValue + ')',

    });
}


function saveEditObjectproprties() {
    AddText()
}

saveType = "save"
function previewGame() {
    saveType = "preview"

    ajaxPHP("" + config.rootPath + "/js/", "", "JsonFile", "game.js", "saveJson", "");


}

function readyToPreview() {

    // if ($('.iframeContainerP').length)$('.iframeContainerP').remove()
    // str = '<div class="iframeContainerP">' +
    //     '<div class="iframeWrapper">' +
    //     '<iframe class="iframeEditor" src="' + config.rootPath + '/index.html?' + Math.random() + '"></iframe>' +
    //     '</div>' +
    //     '<img class="closeBtn" onclick="closeIframeGameP()" src="images/close.png">' +
    //     '</div>'
    //
    // $(str).appendTo('body');
    // parent.$(".closeBtn").hide()

    window.open(config.rootPath +"index.html");
}

function closeIframeGameP() {
    parent.$(".closeBtn").show()
    if ($('.iframeContainerP').length)$('.iframeContainerP').remove()
}
