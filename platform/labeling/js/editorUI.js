function showProprties() {

    if ($(".proprties").length) $(".proprties").remove();

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
        //'<section class="section">' +
        //'<label>Thumb</label>' +
        //'<input type="text" value="../games/' + config.rootPath + "/" + ActiveElement.src + '" id="ObjectImage">' +
        //
        //'<img  class="thumb" src="../games/' + config.rootPath + "/" + ActiveElement.src + '">' +
        //'</section>' +
        '' +
        '<section class="section ">' +
        '<label>Text</label>' +
        '<input type="text" value="' + ActiveElement.text + '" id="ObjectText">' +
        '<button type="button" onclick="updatetext()" id="saveEdit">saveEdit</button>' +
        '</section>' +
        '' +
        //'<section class="section">' +
        //'<label>sound</label>' +
        //'<input type="text" value="' + ActiveElement.sound + '" id="ObjectSound">' +
        //'<button type="button" onclick="soundEdit()" id="sound">sound</button>' +
        //'<audio id="audioPreview" controls>' +
        //'<source src="' + ActiveElement.sound + '">' +
        //'</audio>' +
        //'</section>' +
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

    if ($(".proprties").length) $(".proprties").remove();

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
        '<input type="text" value="../games/' + config.rootPath + "/" + game.backgroundImage + '" id="bgImage">' +
        '<img  class="thumb" src="../games/' + config.rootPath + "/" + game.backgroundImage + '">' +
        '<button type="button" onclick="bgEditBackground()" id="bgEditt">bg Edit</button>' +

        '</section>' +
        '' +

        '' +
        '<section class="section settingSection">' +
        '<label>bg sound</label>' +
        '<input type="text" value="../games/' + config.rootPath + "/sound/bg.mp3"+ '" id="ObjectSound">' +
        '<button type="button" onclick="soundEditBackground()" id="sound">bg sound</button>' +
        '<audio id="audioPreview" controls>' +
        '<source src="../games/' + config.rootPath + "/" + game.backgroundSound + '">' +
        '</audio>' +
        '</section>' +
        '' +
        '' +
        '' +
        '<section class="section settingSection">' +
        '<label>sound Win</label>' +
        '<input type="text" value="../games/' + config.rootPath + "/" + game.WinSound + '" id="SoundWinVal">' +
        '<button type="button" onclick="uploadsoundWin()" id="sound">Win sound</button>' +
        '<audio id="audioPreviewWin" controls>' +
        '<source src="../games/' + config.rootPath + "/" + game.WinSound + '">' +
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
    if ($(".proprties").length) $(".proprties").remove();

}
function soundEdit() {
    simulateUpload($('#uploadsoundObject'))
}
function soundEditBackground() {

    simulateUpload($('#uploadBackgroundSound'))
}

function uploadsoundWin() {
    simulateUpload($('#uploadsoundWin'))
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

function changeWidthLine(object) {

    value = $(object).val();
    $("#outputchangeWidthLine").html(value)
    game.option.widthLine = value
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

    ajaxPHP(config.rootPath + "/js/", "", "JsonFile", "game.js", "saveJson", "");


}

function readyToPreviewNew() {

    // if ($('.iframeContainerP').length)$('.iframeContainerP').remove()
    // str = '<div class="iframeContainerP">' +
    //     '<div class="iframeWrapper">' +
    //     '<iframe class="iframeEditor" src="' + config.rootPath + 'index.html?'+Math.random()+ '"></iframe>' +
    //     '</div>' +
    //     '<img class="closeBtn" onclick="closeIframeGameP()" src="images/close.png">' +
    //     '</div>'
    //
    // $(str).appendTo('body');
    //window.open(config.rootPath + 'index.html?' + Math.random(), '_blank')


    window.open( 'viewer/'+langStory+'/index.php?id=' + config.GameID, '_blank')


}

function closeIframeGameP() {
    $(".closeBtn").show()
    if ($('.iframeContainerP').length) $('.iframeContainerP').remove()
}
/////////////////////////////////////////////////////color


function DrawingColorsBox() {

    strColors = ""

    length = game.option.color.length
    colors = game.option.color

    if ($(".DrawingColorsBox").length) {
        $(".DrawingColorsBox").remove()
    }


    str = '<div class="DrawingColorsBox proprties">' +
        '<div class="proprtiesContainer">' +
        '' +
        '<div class="headProprties ">' +
        '<label>Drawing Color</label>' +
        '<img class="closePng" onclick="closeProprties()" src="images/close.png">' +
        '</div>' +
        '<div class="bodyProprties">' +
        '' +


        '</div>' +
        '<div class="footerProprties">' +
        '<button type="button" onclick="addNewColor()">add</button>' +
        '<button type="button" onclick="removeColor()">remove</button>' +
        '</div>' +
        '</div>' +
        '</div>'

    $(str).appendTo('body')


    for (i = 0; i < length; i++) {

        strColors = '<div index="' + i + '" class="coloring">' +
            '<label for="colorDrawingPallete_' + i + '">Color_' + i + ' </label>' +
            '<input  index="' + i + '" id="colorDrawingPallete_' + i + '" name="colorDrawingPallete_' + i + '" type="text" value="' + colors[i] + '" /></div>'

        $(strColors).appendTo('.bodyProprties').click(function () {
            $(".coloring").removeClass('activeColor')
            $(this).addClass('activeColor')
        })

        $("#colorDrawingPallete_" + i)
            .colorPicker()
            .val(colors[i])
            .change()
            .change(function (value) {
                index = $(this).attr('index');
                game.option.color[index] = value.target.value
            })

    }
}


function addNewColor() {

    if (game.option.color.length >= 15) {
        alert("you can not add more than 15 colors>")
        return
    }
    game.option.color.push("#0000ff")
    DrawingColorsBox()
}


function removeColor() {

    if (game.option.color.length == 0) {

        alert('There is no color.')
        return
    }

    if ($(".activeColor").length) {
        index = $(".activeColor").attr('index')
        if (index > -1) {
            game.option.color.splice(index, 1);
        }
        DrawingColorsBox()
    }
    else {
        alert('select Color')
    }

}


function addTitleQustion() {

        getText=game.levelTitle[game.levelIndex].title




    removeMsg()
    string = '<div class="titleContainerHiehgtlight">' +
        '<div class="titleContainer" style="height:321px;">' +
        '<div class="headerTitle">' +
        '<a onclick="removeMsg()" class="CloseButtonMSg"></a>' +
        '<label>Add question</label>' +
        '</div>' +
        '<div class="innerTitle" >' +
        '<div class="settingSectiontext"> <textarea class="textAreaTitle" placeholder="Enter text  ..">' +
        getText +
        '</textarea></div>' +
        '</div>' +
        '<div class="msgFotterTitle">' +
        '<div class="btn-save-container floating-right"><a onclick="saveTitleQustion()"  class="saveTitle"><label>Save</label></a></div>' +
        '</div>' +
        '</div>' +
        '</div>'

    $(string).appendTo('body')

    // resizeGameInner(".gameContent", ".titleContainer", (4/3))

}

function removeMsg(){
    $(".titleContainerHiehgtlight").remove()
    $(".message-mine-container").remove();
}

function saveTitleQustion() {

    game.levelTitle[game.levelIndex].title=$('.textAreaTitle').val()
	Lobibox.notify("success", {
		
		size: 'mini',
		
		delayIndicator: false,
		msg: 'save complete.'
	});
    saveData()

}


function takeScreenShootThumb(){
    objectType="thumb"
    html2canvas(document.getElementById("gameContainer"), {
        onrendered: function(canvas) {

            ajaxPHP(config.rootPath + "/images/", canvas.toDataURL(), "image", "thumb_"+game.levelIndex+".png", objectType)

        },
     
    });
}



function setting() {

    if ($(".proprties").length) $(".proprties").remove();

    str = '<div class="setting proprties">' +
        '' +
        '<div class="proprtiesContainer" style="height: 660px;">' +
        '' +
        '<div class="headProprties">' +
        '<label>Proprties</label>' +
        '<a class="closePng" onclick="closeProprties()"><i></i></a>' +
        '</div>' +
        '' +
        '<div class="bodyProprties" style="height: 502px;overflow-y: scroll;">' +
        '' +
        '<section class="section settingSection backgroundSound">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left"><span class="main-title">Background sound</span><span class="sub-title">Add backgroud sound to this file</span></div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input type="checkbox" id="backgroundSoundCheck"  >' +
        '<div class="check">' +
        '</div></div>' +
        '<div class="line-black"></div>' +
        '<div class="sound-upload-container">' +
        '<input  readonly style="margin-top: 9px;width: 406px" class="text-fild-upload floating-left" type="text"' +
        ' value="' + config.rootPath +langStory+  '/sound/bg.mp3" id="ObjectSound">' +
        '<a style="margin: 9px 0 0 33px" class="soundUpload floating-left" onclick="soundEditBackground()" id="sound"><i></i></a>' +
        '<div id="wrapper" class="audio-container">' +
        '<audio id="audioPreview" controls>' +
        '<source src="' + config.rootPath + langStory+ '/sound/bg.mp3">' +
        '</audio>' +
        '</div>' +
        '</div>' +
        '</section>' +
        '' +
        '<section class="section settingSection point-propats">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left"><span class="main-title">Point Properties</span><span class="sub-title">Set point properties</span></div>' +
        '<div class="line-black"></div>' +
        '<div class="porparts-container">' +
        '<div class="left-container-proparts floating-left">' +
        '<div class="line-row">' +
        '<div class="icon-tools point-shape floating-left"></div>' +
        '<div class="toolsContainer floating-left">' +
        '<div class="check-container-onOf floating-left" style="margin: 10px 0 0 13px;">' +
        '<input onchange="changeFillOpacity(this)" oninput="changeFillOpacity(this)" type="checkbox" id="visiblePointes" name="NorL">' +
        '<div class="check">' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="line-row">' +
        '<div class="icon-tools color-palt floating-left"></div>' +
        '<div class="toolsContainer floating-left">' +
        '<div class="color-label floating-left"></div>' +
        '<div class="coloring">' +
        '<input id="colorDots" name="colorDots" type="text" value="#333399"/>' +
        '</div> ' +

        '</div>' +
        '</div>' +
        '<div class="line-row">' +
        '<div class="icon-tools dont-size floating-left"></div>' +
        '<div class="toolsContainer floating-left">' +
        '<input id="dotSize" class="floating-left" onchange="changeSizeDots(this)" oninput="changeSizeDots(this)"' +
        ' type="range" min="0" max="5" step=".1" value="1.2">' +
        '<div class="rang-number floating-left"><span><output name="x" id="outputchangeWidthDots">2</output></span></div>' +
        '</div>'+
        '</div>' +
        '</div>' +
        '<div class="right-container-proparts floating-left">' +
        '<label class="preview-title">Preview</label>' +
        '<div class="preview-container"><div class="preview-inner-container">' +
        '<div class="point" style="top: 50%;left: 30%"></div> ' +
        '</div></div>' +
        '</div>' +
        '</div> ' +
        '</section>' +
	    '' +
	    '<section class="section settingSection backgroundSound typecr">' +
	    '<div class="title-icon floating-left"></div>' +
	    '<div class="title-container floating-left"><span class="main-title">Select type</span><span' +
        ' class="sub-title">choose type of exercise</span></div>' +
        '<div class="typeExercise" >' +
        '<div class="exerLetter exerciseSelectType" attrType="letter" ></div>' +
        '<div class="exerNumber exerciseSelectType" attrType="Number" ></div>' +
        '</div>' +
	    '</section>' +
        '' +
        '</div>' +
        '' +
        '<div class="footerProprties">' +
        '<div class="btn-save-container floating-right"><a onclick="closeProprties()" class="ok-btn" id="bgEditt"><label>Save</label></a></div>' +
        '</div>' +
        '' +
        '</div>' +
        '</div>'

    $(str).appendTo('body')
    // $(function () {
    //     $("audio").audioPlayer();
    // });

    $('#backgroundSoundCheck').prop('checked', game.option.noBackgrondSound);
    $('#backgroundSoundCheck').on('change', function () {
        var val = this.checked
        setBackgroundSoundActive(val)
    });

    $('#colorDots').colorPicker()
        .change(function (value) {
            game.option.colorDots = value.target.value
            $(".poent").css({
                background:game.option.colorDots
            })

        });

    $("#colorDots").val(game.option.colorDots);
    $("#colorDots").change();

    $("#dotSize").val(game.option.dotSize);
    $("#dotSize").change();


    $('#visiblePointes').prop('checked', game.option.fillOff);
    $("#visiblePointes").change();

if(game.option.typeViewr=="Number"){
	$(".exerNumber").addClass("selectTypeExercise")
}else{
	$(".exerLetter").addClass("selectTypeExercise")
}

}

function setBackgroundSoundActive(val) {

    game.option.noBackgrondSound = val
}


function changeFillOpacity(obj){
    val=$(obj).is(":checked")

    game.option.fillOff = val

    if(game.option.fillOff){
        $(".poent").css({
            background:"rgba(0,0,0,0)",
            border:"1px solid black"
        })
    }
    else{

        $(".poent").css({
            background:$("#colorDots").val(),
            border:"1px solid black"
        })
    }



}




function changeSizeDots(object){

    val=$(object).val()
    game.option.dotSize = val
    $(".poent").css({
        width:val+"vw",
        height:val+"vw",

    })
    $("#outputchangeWidthDots").html(val)
    reCalculatePoints()
}

