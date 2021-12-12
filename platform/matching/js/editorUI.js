function showProprties() {

    if ($(".proprties").length) $(".proprties").remove();

    str = '<div class="proprties">' +
        '' +
        '<div class="proprtiesContainer" style="height: 594px">' +
        '' +
        '<div class="headProprties">' +
        '<label>Proprties</label>' +
        '<a class="closePng" onclick="closeProprties()"><i></i></a>' +
        '</div>' +
        '' +
        '<div class="bodyProprties" style="height: 489px">' +
        '' +
        '<section class="section thumb">' +
        '<div class="thumb-container floating-left"><img  class="thumb" src="' + config.rootPath + "/" + ActiveElement.src + '"></div>' +
        '<input class="text-fild-upload floating-left" readonly type="text" value="' + config.rootPath + ActiveElement.src + '" id="ObjectImage" style="width: 376px">' +
        '<div class="setAsTrue-container floating-left">' +
        '<input id="setAsTrue" class="setAsTrue" type="checkbox" name="trueAnswer" value="set as true Answer">' +
        '<div class="checkbox-container floating-left"></div>' +
        '<label for="setAsTrue" class="floating-left">set as true Answer</label>' +
        '</div>' +
        '</section>' +
        '' +
        '<div class="header-item"><label>Add Item</label></div>' +
        '<section class="section add-item">' +
        '<label>Add Label</label>' +
        '<textarea value="' + ActiveElement.text + '" id="ObjectText" onkeyup="updatetext()"></textarea>' +
        // '<button type="button" onclick="updatetext()" id="saveEdit">saveEdit</button>' +
        '</section>' +
        '' +
        '<section class="section sound">' +
        '<label>sound</label>' +
        '<input readonly class="soundInput floating-left" type="text" value="' + config.rootPath + game.objects[ActiveElement.index].sound + '" id="ObjectSound">' +
        '<a class="soundUpload floating-left" onclick="soundEdit()" id="sound"><i></i></a>' +
        '<div id="wrapper" class="audio-container" style="margin-left: 35px">' +
        // '<audio id="audioPreview" controls>' +
        // '<source src="' + config.rootPath  +ActiveElement.sound + '">' +
        // '</audio>' +
        // '</div>' +

        '<audio id="Audio_' + ActiveElement.id + '" preload="auto" controls>' +
        '<source src="' + config.rootPath + game.objects[ActiveElement.index].sound + '">' +
        '</audio>' +


        '</div>' +
        '</section>' +
        '' +
        '' +
        '' +
        '</div>' +
        '' +
        '<div class="footerProprties">' +
        '<a onclick="closeProprties()" class="ok-btn floating-right"><i></i></a>' +

        '</div>' +
        '' +
        '</div>' +

        '</div>'

    $(str).appendTo('body')

    $("#ObjectText").html(game.objects[ActiveElement.index].text)

    $(".setAsTrue").prop('checked', game.objects[ActiveElement.index].setAsTrue);
    $('.setAsTrue').change(function () {
        if ($(this).is(':checked')) {
            game.objects[ActiveElement.index].setAsTrue = true
            return
        }
        game.objects[ActiveElement.index].setAsTrue = false
    })
if(game.objects[ActiveElement.index].sound != ""){

    $("audio").audioPlayer()

}
else{
    $("#Audio_"+ ActiveElement.id  ).hide()
    $(".audio-container").html("No Audio to view").css({
        "text-align": "center",
    "color": "wheat",
    "padding":" 2%"
    })
}


    if(game.objects[ActiveElement.index].src==""){

        $(".thumb-container .thumb").hide()
        $(".thumb-container").css({
           "border": "3px dashed #8f928f"
        })

    }


}

function showSetting() {

    if ($(".proprties").length) $(".proprties").remove();

    str = '<div class="proprties">' +
        '' +
        '<div class="proprtiesContainer" style="height: 533px">' +
        '' +
        '<div class="headProprties">' +
        '<label>Setting</label>' +
        '<a class="closePng" onclick="closeProprties()"><i></i></a>' +
        '</div>' +
        '' +
        '<div class="bodyProprties" style="height: 426px">' +
        '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Page Orientation</span>' +
        '<span class="sub-title">set Orientation</span>' +
        '</div>' +
        '<div class="orientation">' +
        '<div oriPage="verticle" class="oriPage verticlOrientation"><span>Verticle</span></div>' +
        '<div oriPage="horizontal" class="oriPage horizontalOrintation"><span>Horizontal</span></div>' +
        '</div>' +
        // '<div class="check-container-onOf floating-right">' +
        // '<input onchange="saveCheckedDataHelp(this)" id="helpChecked" type="checkbox">' +
        // '<div class="check"></div>' +
        // '</div>' +
        '</section>' +
        '' +
        '<section class="section settingSection backgroundSound">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Background sound</span>' +
        '<span class="sub-title">Add backgroud sound to this file</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input id="soundChecked" onchange="saveCheckedDataSound(this)" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +
        '<div class="line-black"></div>' +
        '<div class="sound-upload-container">' +
        '<input readonly style="margin-top: 9px;width: 406px" class="text-fild-upload floating-left" type="text"' +
        ' value="'+config.rootPath + "all" + "/sound/bg.mp3" + '" id="ObjectSound">' +
        '<a style="margin: 9px 0 0 33px" class="soundUpload floating-left" onclick="soundEditBackground()" id="sound"><i></i></a>' +
        // '<div class="audio-container" style="margin-left: 0">' +
        // '<audio id="audioPreview" controls>' +
        // '<source src="' + config.rootPath + "/" + game.backgroundSound + '">' +
        // '</audio>' +
        // '</div>' +

        '<div id="wrapper" class="audio-container">' +
        '<audio preload="auto" controls>' +
        '<source src="'+config.rootPath + "all" + "/sound/bg.mp3" + '">' +
        '</audio>' +


        '</div>' +


        '</div>' +
        '</section>' +
        '' +
        // '<section class="section settingSection backgroundImage">' +
        // '<div class="title-icon floating-left"></div>' +
        // '<div class="title-container floating-left">' +
        // '<span class="main-title">Background </span>' +
        // '<span class="sub-title">Add backgroud to this file</span>' +
        // '<input readonly style="margin-top: 20px" class="text-fild-upload" type="text" value="' + config.rootPath + "/" + game.backgroundImage + '" id="bgImage">' +
        // '</div>' +
        // '<div class="upload-icon floating-right" style="margin-top: 10px">' +
        // '<a class="upload-btn" onclick="bgEditBackground()" id="bgEditt"><i></i></a>' +
        // '<div class="iconContainerTitle">' +
        // '<img  class="thumb iconTitle" src="' + config.rootPath + "/" + game.backgroundImage + '">' +
        // '</div>' +
        // '</div>' +
        //
        //
        // '</section>' +
        '' +
        '<section class="section settingSection attempts">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Attempts</span>' +
        '<span class="sub-title">Number of attempts for answer</span>' +
        '</div>' +
        '<div>' +
        '<input onkeyup="createValidator(this)"  max="10" min="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="triesNumber floating-left" value="' + game.noTries + '" placeholder="enter Numbers">' +
        '' +
        '</div>' +
        '</section>' +

        '' +
        '</div>' +
        '' +
        '<div class="footerProprties">' +
        '<a class="ok-btn floating-right" onclick="savetitle(),closeProprties()" id="bgEditt"><i></i></a>' +
        '</div>' +
        '' +
        '</div>' +

        '</div>'


    $(str).appendTo('body')
    $("#helpChecked").attr('checked', game.noHelp)
    $("#soundChecked").attr('checked', game.noSound)
    $(".oriPage").click(function(){
	    oriPage=$(this).attr("oriPage")
        game.oriPage=oriPage
	    $(".oriPage").removeClass("selectOri")
	
	    $(this).addClass("selectOri")
	    setOrientation()
    })
    
    if(game.oriPage=="verticle")
    {
	    $(".verticlOrientation").click()
    }else{
	    $(".horizontalOrintation").click()
    }
   // $("audio").audioPlayer();
    createValidator()
}


function saveCheckedDataHelp(object){

    game.noHelp=$(object).prop('checked')

}

function saveCheckedDataSound(object){

    game.noSound=$(object).prop('checked')

}
function createValidator(element) {
    if (element) {

        var min = parseInt(element.getAttribute("min")) || 0;
        var max = parseInt(element.getAttribute("max")) || 0;

        var value = parseInt(element.value) || min;
        element.value = value; // make sure we got an int

        if (value < min) element.value = min;
        if (value > max) element.value = max;

        game.noTries = parseInt(element.value)
    }
}


function closeProprties() {
    if ($(".proprties").length) $(".proprties").remove();

}
function soundEdit() {
    simulateUpload($('#uploadsoundObject'))
}
function soundEditBackground() {
    simulateUpload($('#uploadBackgroundSound'))
}

function soundEdittitle() {
    simulateUpload($('#soundEdittitle'))
}

function uploadIconTitle() {
    simulateUpload($('#uploadIconTitle'))
}

function bgEditBackground() {
    simulateUpload($('#uploadBackground'))
}


function getCssValue() {

    $("#opacityObject").val(game.objects[ActiveElement.index].opacity)
}

function onOpacityChange(object) {

    $("#" + ActiveElement.id).find('img').css('opacity', $(object).val());
    $(".rang-number span").html($(object).val())
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

    // window.open(config.rootPath + "index.html");
   
    // if(checkIfSetAnswer()){
	 //   alert("الرجاء تعيين اجابات للخيارات الفارغه.")
    // }else{
	 //
	
	    var a = document.createElement("a");
	    a.target = "_blank";
	    a.href = "viewer/" + lang + "/index.php?id=" + config.GameID;
	    a.click();
	    a.remove();
    // }
 
}

function closeIframeGameP() {
    parent.$(".closeBtn").show()
    if ($('.iframeContainerP').length) $('.iframeContainerP').remove()
}

function addtitle() {
    if ($(".proprties").length) $(".proprties").remove();

    str = '<div class="proprties">' +
        '' +
        '<div class="proprtiesContainer" style="height: 435px;">' +
        '' +
        '<div class="headProprties">' +
        '<label>Add Title</label>' +
        '<a class="closePng" onclick="closeProprties()"><i></i></a>' +
        '</div>' +
        '<div class="bodyProprties">' +
        '<section class="section settingSection text">' +
        '<textarea class="titleText" placeholder="Enter title text" type="text" value="' + game.titleText + '" id=""></textarea>' +
        '</section>' +
        '' +
	    '<section class="section settingSection titleSound">' +
	    '<div class="title-icon floating-left"></div>' +
	    '<div class="title-container floating-left">' +
	    '<span class="main-title">Title sound</span>' +
	    '<span class="sub-title">Add sound to this title</span>' +
	    '</div>' +
	    // '<div class="check-container-onOf floating-right">' +
	    // '<input id="soundCheckedtitle" onchange="saveCheckedDataSound(this)" type="checkbox">' +
	    // '<div class="check"></div>' +
	    // '</div>' +
	    '<div class="line-black"></div>' +
	    '<div class="sound-upload-container">' +
	    '<input readonly style="margin-top: 9px;width: 406px" class="text-fild-upload floating-left" type="text"' +
        ' value="'+config.rootPath + "all" + "/sound/title.mp3" + '" id="ObjectSoundtitle">' +
	    '<a style="margin: 9px 0 0 33px" class="soundUpload floating-left" onclick="soundEdittitle()" id="sound"><i></i></a>' +
	    // '<div class="audio-container" style="margin-left: 0">' +
	    // '<audio id="audioPreview" controls>' +
	    // '<source src="' + config.rootPath + "/" + game.backgroundSound + '">' +
	    // '</audio>' +
	    // '</div>' +
	
	    '<div id="wrapper" class="audio-container">' +
	    '<audio id="soundTitleMatch" preload="auto" controls>' +
	    '<source src="'+config.rootPath + "all" + "/sound/title.mp3?" + Math.random()+ '">' +
	    '</audio>' +
	
	
	    '</div>' +
	
	
	    '</div>' +
	    '</section>' +

        '</div>' +
        '<div class="footerProprties">' +
        '<a class="ok-btn floating-right" onclick="savetitle()" id="bgEditt"><i></i></a>' +
        '</div>' +
        '</div>' +
        '' +

        '' +
        '</div>' +

        '</div>'

    $(str).appendTo('body')
    loadTitleTobox()

    $(".titleText").keyup(function(){
        game.titleText = $(".titleText").val()
    });

    $(".titleText").change(function(){
        game.titleText = $(".titleText").val()
    });
}


function NoSound(value) {
    game.noSound = value


}
function NoHelp(value) {


    game.noHelp = value

}
