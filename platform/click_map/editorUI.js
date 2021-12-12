function showProprties() {

    if ($(".proprties").length) $(".proprties").remove();

    str = '<div class="proprties">' +
        '' +
        '<div class="proprtiesContainer" style="height: 761px">' +
        '' +
        '<div class="headProprties">' +
        '<label>Proprties</label>' +
        '<a class="closePng" onclick="closeProprties()"><i></i></a>' +
        '</div>' +
        '' +
        '<div class="bodyProprties" style="height: 637px">' +
        '' +
        '<section class="section thumb">' +
        '<div class="thumb-container floating-left"><img  class="thumb" src="' + config.rootPath + "all/" + ActiveElement.src + '"></div>' +
        '<input class="text-fild-upload floating-left" readonly type="text" value="' + config.rootPath + "all/" + ActiveElement.src + '" id="ObjectImage" style="width: 376px">' +
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
        '<input readonly class="soundInput floating-left" type="text" value="' + config.rootPath + "all/" + game.objects[ActiveElement.index].sound + '" id="ObjectSound">' +
        '<a class="soundUpload floating-left" onclick="soundEdit()" id="sound"><i></i></a>' +
        '<a class="removeFile"  onclick="removeSound()"><i><img style="position: absolute; width: 16px; top: 76px; left: 6px" src="images/cancel-normal.svg"></img></a>' +
        '<div id="wrapper" class="audio-container" style="margin-left: 35px">' +
        // '<audio id="audioPreview" controls>' +
        // '<source src="' + config.rootPath  +ActiveElement.sound + '">' +
        // '</audio>' +
        // '</div>' +

        '<audio id="Audio_' + ActiveElement.id + '" preload="auto" controls>' +
        '<source src="' + config.rootPath + "all/" + game.objects[ActiveElement.index].sound + '">' +
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


    if (game.objects[ActiveElement.index].sound == "") {

        $(".removeFile").hide()
    }

    $("#ObjectText").html(game.objects[ActiveElement.index].text)

    $(".setAsTrue").prop('checked', game.objects[ActiveElement.index].setAsTrue);
    $('.setAsTrue').change(function () {
        if ($(this).is(':checked')) {
            game.objects[ActiveElement.index].setAsTrue = true
            return
        }
        game.objects[ActiveElement.index].setAsTrue = false
    })
    if (game.objects[ActiveElement.index].sound != "") {

        //  $("audio").audioPlayer()

    }
    else {
        $("#Audio_" + ActiveElement.id).hide()
        $(".audio-container").html("No Audio to view").css({
            "text-align": "center",
            "color": "wheat",
            "padding": " 2%"
        })
    }


    if (game.objects[ActiveElement.index].src == "") {

        $(".thumb-container .thumb").hide()
        $(".thumb-container").css({
            "border": "3px dashed #8f928f"
        })

    }


}

function showSetting() {



    if(typeof game.css=="undefined"){
        game.css=""

    }


    if ($(".proprties").length) $(".proprties").remove();

    str = '<div class="proprties">' +
        '' +
        '<div class="proprtiesContainer" style="height: 639px">' +
        '' +
        '<div class="headProprties">' +
        '<label>Setting</label>' +
        '<a class="closePng" onclick="closeProprties()"><i></i></a>' +
        '</div>' +
        '' +
        '<div class="bodyProprties" style="height: 509px;overflow-y: scroll">' +
        '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Help</span>' +
        '<span class="sub-title">Add help box to this file</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="saveCheckedDataHelp(this)" id="helpChecked" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' + '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Matching Random</span>' +
        '<span class="sub-title">Show Matching Element Randomly</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="randomeElement(this)" id="randomeElment" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +


        '</section>' + '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Matching as Draggable</span>' +
        '<span class="sub-title">Set matching as drag and drop pratice</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setDragDrop(this)" id="setDragDrop" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +


        '</section>' + '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">fix Randomly   Top</span>' +
        '<span class="sub-title">Set Randomly  Top</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setRandomX(this)" id="setRandomlyX" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '</section>' + '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">fix Randomly   left</span>' +
        '<span class="sub-title">Set Randomly  left</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setRandomY(this)" id="setRandomlyY" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +





        //*******************
        '</section>' + '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Randomly  column top</span>' +
        '<span class="sub-title">Set Randomly column top</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setRandomA(this)" id="setRandomlyA" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +


        '</section>' + '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Randomly  column bottom</span>' +
        '<span class="sub-title">Set Randomly column bottom</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setRandomB(this)" id="setRandomlyB" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +


        '</section>' + '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Hide star</span>' +
        '<span class="sub-title">Hide star on book pages</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setHideStar(this)" id="sethidestart" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +


        '</section>' +
        '' +
        '' + '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">ٍReplace when Drag</span>' +
        '<span class="sub-title">Replaace image when drag elnement</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setReplaceDragDrop(this)" id="setReplcaeDragDrop" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '' +
        '' +
        '' + '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Set direction from bottom to top</span>' +
        '<span class="sub-title">Set direction from bottom to top</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setTopToBottom(this)" id="setTopToBottom" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '' +
        '' +

        '' + '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Set direction from right to left</span>' +
        '<span class="sub-title">Set direction from right to left</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setTopToRight(this)" id="setTopToRight" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '' +
        '' +

        '' + '' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Set direction from left to right</span>' +
        '<span class="sub-title">Set direction from left to right</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setTopToLeft(this)" id="setTopToLeft" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '' +
        '' +
        '' +
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
        '<input readonly style="margin-top: 9px;width: 406px" class="text-fild-upload floating-left" type="text" value="' + config.rootPath + "all/" + game.backgroundSound + '" id="ObjectSound">' +
        '<a style="margin: 9px 0 0 33px" class="soundUpload floating-left" onclick="soundEditBackground()" id="sound"><i></i></a>' +
        // '<div class="audio-container" style="margin-left: 0">' +
        // '<audio id="audioPreview" controls>' +
        // '<source src="' + config.rootPath + "/" + game.backgroundSound + '">' +
        // '</audio>' +
        // '</div>' +

        '<div id="wrapper" class="audio-container">' +
        '<audio preload="auto" controls>' +
        '<source src="' + config.rootPath + "all/" + game.backgroundSound + '">' +
        '</audio>' +


        '</div>' +


        '</div>' +
        '</section>' +
        '' +
        '<section class="section settingSection backgroundImage">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Background </span>' +
        '<span class="sub-title">Add backgroud to this file</span>' +
        '<input readonly style="margin-top: 20px" class="text-fild-upload" type="text" value="' + config.rootPath + "all/" + game.backgroundImage + '" id="bgImage">' +
        '</div>' +
        '<div class="upload-icon floating-right" style="margin-top: 10px">' +
        '<a class="upload-btn" onclick="bgEditBackground()" id="bgEditt"><i></i></a>' +
        '<div class="iconContainerTitle">' +
        '<img  class="thumb iconTitle" src="' + config.rootPath + "all/" + game.backgroundImage + '">' +
        '</div>' +
        '</div>' +


        '</section>' +
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


        '</section>' +
        '' +
        '<section class="section settingSection attempts">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Result as percent Ex:66% </span>' +
        '<span class="sub-title">Select result as percent</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="select_percent(this)" id="Select_percent" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +
        '</section>' +

        '</section>' +
        '' +
        '<section class="section settingSection attempts">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Result as number Counting Ex:(5/10) </span>' +
        '<span class="sub-title">Select result as number Counting</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="select_counting(this)" id="Select_counting" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +
        '</section>' +


        '' + '' +
        '<section class="section settingSection help" style="height:300px">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Set custom style</span>' +

        '</div>' +
        '<div class="cssStyle">' +
        `<textarea onchange="updateCssChange(this)" class="customeStyle" id="customeStyle" >${game.css}</textarea>` +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '' +
        '' +


        '' +
        '</div>' +
        '' +
        '<div class="footerProprties">' +
        '<a class="ok-btn floating-right" onclick="closeProprties()" id="bgEditt"><i></i></a>' +
        '</div>' +
        '' +
        '</div>' +

        '</div>'


    $(str).appendTo('body')
    $("#helpChecked").attr('checked', game.noHelp)
    $("#soundChecked").attr('checked', game.noSound)
    // $("audio").audioPlayer();
    createValidator()

    editAreaLoader.init({
        id: "customeStyle"	// id of the textarea to transform
        ,
        start_highlight: true
        ,
        allow_toggle: false
        ,
        language: "en"
        ,
        syntax: "css"
        ,
        syntax_selection_allow: "css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck"
        ,
        is_multi_files: true
        ,
        EA_load_callback: "loadcss"
        ,
        show_line_colors: true,
        text: game.css


        ,
        toolbar: " save, |, charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight, |, help"
        ,
        save_callback: "my_save"
        ,
        plugins: "charmap"
        ,
        charmap_default: "arrows"


    });


    if (game.isRandom) {

        $("#randomeElment").prop('checked', true)
        game.isRandom = true
    } else {
        $("#randomeElment").prop('checked', false)
        game.isRandom = false
    }


    if (game.isRandomX) {

        $("#setRandomlyX").prop('checked', true)
        game.isRandomX = true
    } else {
        $("#setRandomlyX").prop('checked', false)
        game.isRandomX = false
    }

    if (game.isRandomY) {

        $("#setRandomlyY").prop('checked', true)
        game.isRandomY = true
    } else {
        $("#setRandomlyY").prop('checked', false)
        game.isRandomY = false
    }


    if (game.isRandomB) {

        $("#setRandomlyB").prop('checked', true)
        game.isRandomB = true
    } else {
        $("#setRandomlyB").prop('checked', false)
        game.isRandomB = false
    }

    if (game.isRandomA) {

        $("#setRandomlyA").prop('checked', true)
        game.isRandomA = true
    } else {
        $("#setRandomlyA").prop('checked', false)
        game.isRandomA = false
    }

    checkDrag = game.subType
    if (checkDrag == "drag") {

        $("#setDragDrop").prop('checked', true)

        game.subType = "drag"
    } else {

        $("#setDragDrop").prop('checked', false)
        game.subType = "line"
    }

    checkstar = game.hideStar
    if (checkstar) {

        $("#sethidestart").prop('checked', true)

        game.hideStar = true
    } else {

        $("#setDragDrop").prop('checked', false)
        game.hideStar = false
    }

    isdragReplace = game.isdragReplace
    if (game.isdragReplace) {

        $("#setReplcaeDragDrop").prop('checked', true)
        game.isdragReplace = true
    } else {
        $("#setReplcaeDragDrop").prop('checked', false)
        game.isdragReplace = false
    }


    direction = game.matchingDirection

    if (direction == "bottomToTop") {

        $("#setTopToBottom").prop('checked', true)

    } else if (direction == "rightToLeft") {
        $("#setTopToRight").prop('checked', true)

    }
    else if (direction == "leftToRight") {
        $("#setTopToLeft").prop('checked', true)

    } else {

    }


    resultType = game.resultType
    if (resultType == "counting") {

        $("#Select_counting").prop('checked', true)

        // $("#Select_percent").prop('checked', true)


    } else {

        // $("#Select_counting").prop('checked', true)

        $("#Select_percent").prop('checked', true)


    }


}

function loadcss(css) {
    var new_file = {id: "customeStyle", text: game.css, syntax: 'css'};
    editAreaLoader.openFile('customeStyle', new_file);

}

function my_save(id, content) {

    val = editAreaLoader.getValue("customeStyle")
    console.log(val)

    game.css = val
}


function updateCssChange(object) {

    val = editAreaLoader.getValue("customeStyle")
    console.log(val)

    game.css = val

}


function select_counting(object) {

    resultType = $(object).prop('checked')

    if (resultType == false) {
        //$("#Select_counting").prop('checked', true)
        $("#Select_percent").prop('checked', true)
        game.resultType = "percent"
    } else {
        //$("#Select_counting").prop('checked', false)
        $("#Select_percent").prop('checked', false)
        game.resultType = "counting"


    }


}


function select_percent(object) {

    resultType = $(object).prop('checked')

    if (resultType == false) {
        $("#Select_counting").prop('checked', true)
        //$("#Select_percent").prop('checked', false)
        game.resultType = "counting"
    } else {
        $("#Select_counting").prop('checked', false)
        // $("#Select_percent").prop('checked', true)
        game.resultType = "percent"


    }

}

function saveCheckedDataHelp(object) {

    game.noHelp = $(object).prop('checked')

}

function randomeElement(object) {

    game.isRandom = $(object).prop('checked')


}

function setDragDrop(object) {

    subMatch = $(object).prop('checked')

    if (subMatch) {
        game.subType = "drag"
    } else {
        game.subType = "line"

    }


}
function setRandomX(object) {

    subMatch = $(object).prop('checked')

    if (subMatch) {
        game.isRandomX = true
    } else {
        game.isRandomX = false

    }


}

function setRandomY(object) {

    subMatch = $(object).prop('checked')

    if (subMatch) {
        game.isRandomY = true
    } else {
        game.isRandomY = false

    }


}
function setRandomB(object) {

    subMatch = $(object).prop('checked')

    if (subMatch) {
        game.isRandomB = true
    } else {
        game.isRandomB = false

    }


}

function setRandomA(object) {

    subMatch = $(object).prop('checked')

    if (subMatch) {
        game.isRandomA = true
    } else {
        game.isRandomA = false

    }


}

function setHideStar(object) {

    subMatch = $(object).prop('checked')

    if (subMatch) {
        game.hideStar = true
    } else {
        game.hideStar = false

    }


}

function setReplaceDragDrop(object) {

    isdragReplace = $(object).prop('checked')

    console.log(isdragReplace)


    game.isdragReplace = isdragReplace


}


function setupMatchingDirection() {

    direction = game.matchingDirection

    $(".matching-top").removeClass("coloumnTop coloumnTopToBottom coloumnTopToRight coloumnTopToLeft")
    $(".matching-bottom").removeClass("coloumnBottom coloumnBottomToTop coloumnBottomToLeft coloumnBottomToRight")


    if (direction == "bottomToTop") {

        $(".matching-top").addClass("coloumnTopToBottom")
        $(".matching-bottom").addClass("coloumnBottomToTop")
    }
    else if (direction == "rightToLeft") {

        $(".matching-top").addClass("coloumnTopToRight")
        $(".matching-bottom").addClass("coloumnBottomToLeft")
    }
    else if (direction == "leftToRight") {
        $(".matching-top").addClass("coloumnTopToLeft")
        $(".matching-bottom").addClass("coloumnBottomToRight")
    } else {

            $(".matching-top").addClass("coloumnTop")
            $(".matching-bottom").addClass("coloumnBottom")

        }

    }

    function setTopToRight(object) {
        matchingDirection = $(object).prop('checked')
        console.log(matchingDirection)

        if (matchingDirection) {
            game.matchingDirection = "rightToLeft"
        } else {
            game.matchingDirection = ""
        }

        $("#setTopToBottom").prop('checked', false)
        $("#setTopToLeft").prop('checked', false)


        setupMatchingDirection()

        drawLineFromColumnToElement()
        drawConnected()

    }

    function setTopToLeft(object) {
        matchingDirection = $(object).prop('checked')
        console.log(matchingDirection)
        if (matchingDirection) {
            game.matchingDirection = "leftToRight"
        } else {
            game.matchingDirection = ""
        }
        $("#setTopToBottom").prop('checked', false)
        $("#setTopToRight").prop('checked', false)


        setupMatchingDirection()

        drawLineFromColumnToElement()
        drawConnected()


    }

    function setTopToBottom(object) {
        matchingDirection = $(object).prop('checked')
        console.log(matchingDirection)


        if (matchingDirection) {
            game.matchingDirection = "bottomToTop"
        } else {
            game.matchingDirection = ""
        }

        $("#setTopToRight").prop('checked', false)
        $("#setTopToLeft").prop('checked', false)

        setupMatchingDirection()

        drawLineFromColumnToElement()
        drawConnected()


    }


    function saveCheckedDataSound(object) {

        game.noSound = $(object).prop('checked')

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

        if(minValue==0){
            minValue=0
        }else{
            minValue = eval(minValue - 1)
        }


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
        if(value==0){
            value=1
        }
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
        var a = document.createElement("a");
        a.target = "_blank";
        a.href = "viewer/" + lang1.toLowerCase() + "/index.php?id=" + config.GameID;
        a.click();
        a.remove();
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
            '<section class="section settingSection icon">' +
            '<div class="title-icon floating-left"></div>' +
            '<div class="title-container floating-left">' +
            '<span class="main-title">Icon</span>' +
            '<span class="sub-title">Add icon for the title </span>' +
            '<input class="text-fild-upload" readonly type="text" value="' + config.rootPath + 'images/titleIcon.png" id="ObjectSound">' +
            '</div>' +
            '<div class="upload-icon floating-right">' +
            '<a class="upload-btn" type="button" onclick="uploadIconTitle()" id="sound"><i></i></a>' +
            '<div class="iconContainerTitle">' +
            '<img class="iconTitle"  src="' + config.rootPath + 'images/titleIcon.png?' + Math.random() + '">' +
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
    }


    function NoSound(value) {
        game.noSound = value


    }

    function NoHelp(value) {


        game.noHelp = value

    }




