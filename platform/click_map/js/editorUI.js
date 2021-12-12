function showProprties() {

    if ($(".proprties").length) $(".proprties").remove();

    str = '<div class="proprties">' +
        '' +
        '<div class="proprtiesContainer" style="height: 666px">' +
        '' +
        '<div class="headProprties">' +
        '<label>' + langRes.Properties + '</label>' +
        '<a class="closePng" onclick="closeProprties()"><i></i></a>' +
        '</div>' +
        '' +
        '<div class="bodyProprties" style="height: 509px">' +
        '' +
        '<section class="section thumb">' +
        '<div class="thumb-container floating-left"><img  class="thumb" src="' + config.rootPath + "all/" + ActiveElement.src + '"></div>' +
        '<input class="text-fild-upload floating-left" readonly type="text" value="' + config.rootPath + "all/" + ActiveElement.src + '" id="ObjectImage" style="width: 376px">' +
        '<div class="setAsTrue-container floating-left">' +
        '<input id="setAsTrue" class="setAsTrue" type="checkbox" name="trueAnswer" value="set as true Answer">' +
        '<div class="checkbox-container floating-left"></div>' +
        '<label for="setAsTrue" class="floating-left">' + langRes.Setastrueanswer + '</label>' +
        '</div>' +
        '</section>' +
        '' +
        '<div class="header-item"><label>Add Item</label></div>' +
        '<section class="section add-item">' +
        '<label>' + langRes.Addtext + '</label>' +
        '<textarea value="' + ActiveElement.text + '" id="ObjectText" onkeyup="updatetext()"></textarea>' +
        // '<button type="button" onclick="updatetext()" id="saveEdit">saveEdit</button>' +
        '</section>' +
        '' +
        '<section class="section sound">' +
        '<label>' + langRes.Addsound + '</label>' +
        '<img src="images/unlink.png" class="removeAudio">' +
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
        '' +



        '</div>' +
        '</section>' +
        '' +
        '' +
        '' +
        '</div>' +
        '' +
        '<div class="footerProprties">' +
        '<div class="btn-save-container floating-right"><a onclick="closeProprties()" class="ok-btn"><label>' + langRes.Save + '</label></a></div> ' +

        '</div>' +
        '' +
        '</div>' +

        '</div>'

    $(str).appendTo('body')


    if (game.objects[ActiveElement.index].sound == "") {

        $(".removeFile").hide()
       // $(".removeAudio").hide()
    }



    $(".removeAudio").click(function () {

            var txt;
            var r = confirm("Are you sure you want to remove sound file from selected item ?");
            if (r == true) {
                game.objects[ActiveElement.index].sound=""
            } else {

            }


    })


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
        $(".audio-container").html(langRes.Nosound).css({
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

    str = '<div id="proprties"  class="proprties">' +
        '' +
        '<div class="proprtiesContainer" style="height: 660px">' +
        '' +
        '<div class="headProprties">' +
        '<label>' + langRes.Settings + '</label>' +
        '<a class="closePng" onclick="closeProprties()"><i></i></a>' +
        '</div>' +
        '' +
        '<div class="bodyProprties" style="height: 502px;overflow-y: scroll">' +
        '' +


        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">Language</span>' +
        '<span class="sub-title">Select game language</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right" style="margin-top: 11px;">' +

        '' +
        '<select class="selectContainer" id="languagesEx">\n' +

        '  <option  value="ar">Ar</option>\n' +
        '  <option value="en">En</option>\n' +
        '  <option value="fr">Fr</option>\n' +
        '</select>'+

        '</div>' +

        '</section>' +



        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Help + '</span>' +
        '<span class="sub-title">' + langRes.Addhelpbox + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="saveCheckedDataHelp(this)" id="helpChecked" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +

        '<section class="matching-tools" style="display: none">' +

        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Random + '</span>' +
        '<span class="sub-title">' + langRes.Showelementsrandomly + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="randomeElement(this)" id="randomeElment" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Draganddrop + '</span>' +
        '<span class="sub-title">' + langRes.Applydraganddropfeaturetothepractice + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setDragDrop(this)" id="setDragDrop" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Random + '</span>' +
        '<span class="sub-title">' + langRes.DisplayAelementsrandomly + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setRandomX(this)" id="setRandomlyX" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Random + '</span>' +
        '<span class="sub-title">' + langRes.DisplayDelementsrandomly + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setRandomY(this)" id="setRandomlyY" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Random + '</span>' +
        '<span class="sub-title">' + langRes.DisplayAelementsrandomly + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setRandomA(this)" id="setRandomlyA" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Random + '</span>' +
        '<span class="sub-title">' + langRes.DisplayBelementsrandomly + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setRandomB(this)" id="setRandomlyB" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Replace + '</span>' +
        '<span class="sub-title">' + langRes.Replaceelementwhendrop + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setReplaceDragDrop(this)" id="setReplcaeDragDrop" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +

        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Direction + '</span>' +
        '<span class="sub-title">' + langRes.BtoA + '</span>' +
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
        '<span class="main-title">' + langRes.Direction + '</span>' +
        '<span class="sub-title">' + langRes.CtoD + '</span>' +
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
        '<span class="main-title">' + langRes.Direction + '</span>' +
        '<span class="sub-title">' + langRes.DtoC + '</span>' +
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
        '' +




        '</section>' +




        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Setelementwidthto100 + '</span>' +
        '<span class="sub-title">' + langRes.Setelementwidthto100 + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setWidth100(this)" id="setWidth" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +






        //*******************







        '<section class="section settingSection help">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Hidethestars + '</span>' +
        '<span class="sub-title">' + langRes.Hidethestars + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setHideStar(this)" id="sethidestart" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +


        '' +
        '' + '' +

        '' +
        '' +
        '' + '' +

        '' +
        '' +
        '' +

        '<section class="fillBox-tools" style="display: none">' +
        '<section class="section settingSection help fillRandom">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Random + '</span>' +
        '<span class="sub-title">' + langRes.Random + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setRandomFill(this)" id="setFillRandom" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +
        '' +
        '' +
        '' +
        '' +
        '<section class="section settingSection help fillDirection">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Setdirectionfromrighttoleft + '</span>' +
        '<span class="sub-title">' + langRes.Setdirectionfromrighttoleft + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="setDirectionFill(this)" id="setFillDirection" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +

        '</section>' +

        '</section>' +



        '<section class="section settingSection backgroundSound">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Backgroundsound + '</span>' +
        '<span class="sub-title">' + langRes.addBackgroundSound + '</span>' +
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
        '<span class="main-title">' + langRes.BackgroundImg + '</span>' +
        '<span class="sub-title">' + langRes.addBackgroundhint + '</span>' +
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
        '<span class="main-title">' + langRes.Attempts + '</span>' +
        '<span class="sub-title">' + langRes.Attempts + '</span>' +
        '</div>' +
        '<div>' +
        '<input onkeyup="createValidator(this)"  max="10" min="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="triesNumber floating-left" value="' + game.noTries + '" placeholder="">' +
        '' +
        '</div>' +
        '</section>' +


        '</section>' +
        '' +
        '<section class="section settingSection attempts">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Displayresultaspercent + '</span>' +
        '<span class="sub-title">' + langRes.Displayresultaspercent + '</span>' +
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
        '<span class="main-title">' + langRes.Displayresultasnumber + '</span>' +
        '<span class="sub-title">' + langRes.Displayresultasnumber + '</span>' +
        '</div>' +
        '<div class="check-container-onOf floating-right">' +
        '<input onchange="select_counting(this)" id="Select_counting" type="checkbox">' +
        '<div class="check"></div>' +
        '</div>' +
        '</section>' +

        '<section class="section settingSection help" style="height:65px">' +
        '<div style="cursor: pointer" onclick="opeinStyle()"><div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title">' + langRes.Customizethestyle + '</span>' +
        '<span class="sub-title">' + langRes.Customizethestyle + '</span>' +

        '</div>' +
        '</div>' +


        '</section>' +

        '</div>' +
        '' +
        '<div class="footerProprties">' +
        '<div class="btn-save-container floating-right"><a class="ok-btn" onclick="closeProprties()" id="bgEditt"><label>' + langRes.Save + '</label></a></div>' +
        '</div>' +
        '' +
        '</div>' +
        '<div id="stylePage" class="proprtiesContainer" style="height: 545px;opacity:0;width: 800px;z-index: -999999999999;">' +
        '<div class="headProprties"><label>' + langRes.styletitle + '</label><a class="closePng" onclick="closeStyle()"><i></i></a></div>' +
        '<div class="bodyProprties" style="height: 90%;overflow-y: scroll;width: 100%">' +
        '<div class="cssStyle">' +
        `<textarea onchange="updateCssChange(this)" class="customeStyle" id="customeStyle" >${game.css}</textarea>` +
        '<div class="check"></div>' +
        '</div>' +
        '</div> ' +
        '</div>'
        '</div>'
    $(str).appendTo('body');
    $("#helpChecked").attr('checked', game.noHelp);
     // $("#proprties").append(str2);
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

        font_size: "12",

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

    if(game.langauge== undefined){

        game.langauge=langStory
    }

    $("#languagesEx").val(game.langauge).change();




    $("#languagesEx").change(function() {
        game.langauge = $(this).val()
    });

    if (game.isRandom) {

        $("#randomeElment").prop('checked', true)
        game.isRandom = true
    } else {
        $("#randomeElment").prop('checked', false)
        game.isRandom = false
    }

    if (game.allElemWidth) {

        $("#setWidth").prop('checked', true)
    } else {
        $("#setWidth").prop('checked', false)
    }
    if (game.allFillElemRandom) {

        $("#setFillRandom").prop('checked', true)
    } else {
        $("#setFillRandom").prop('checked', false)
    }
    if (game.allFillElemDirection) {

        $("#setFillDirection").prop('checked', true)
    } else {
        $("#setFillDirection").prop('checked', false)
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
    if (game.addBackgroundFill == "0") {

        $(".addBackgroundFill select").val("Remove Background");
        game.addBackgroundFill = "0"
    } else {
        $(".addBackgroundFill select").val("Add Background");
        game.addBackgroundFill = "1"
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

        $("#sethidestart").prop('checked', false)
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

        $("#Select_counting").prop('checked', true);

        // $("#Select_percent").prop('checked', true)


    } else {

        // $("#Select_counting").prop('checked', true)

        $("#Select_percent").prop('checked', true)


    }
    if (game.typeEdit == "matching" || game.typeEdit == "memory") {
        $(".matching-tools").show();
    }
    if (game.typeEdit == "fillBox") {
        $(".fillBox-tools").show();
        $("#setFillRandom").prop('checked', true);
    }


}

function opeinStyle() {
    $("#stylePage").css({"opacity": "1", "zIndex": "999999999999"});

}

function closeStyle() {
    $("#stylePage").css({"opacity": "0", "zIndex": "-999999999999"});
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

        $(".matching-top").addClass("coloumnTopToRight");
        $(".matching-bottom").addClass("coloumnBottomToLeft");
        $(".coloumnTopToRight span").html(langRes.C);
        $(".coloumnBottomToLeft span").html(langRes.D);
    }
    else if (direction == "leftToRight") {
        $(".matching-top").addClass("coloumnTopToLeft");
        $(".matching-bottom").addClass("coloumnBottomToRight");
        $(".coloumnTopToRight span").html(langRes.C);
        $(".coloumnBottomToLeft span").html(langRes.D);
    } else {

        $(".matching-top").addClass("coloumnTop")
        $(".matching-bottom").addClass("coloumnBottom")

    }

}

function setTopToRight(object) {
    matchingDirection = $(object).prop('checked')
    console.log(matchingDirection)

    if (matchingDirection) {
        game.matchingDirection = "rightToLeft";

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

function setWidth100(object) {
    allElemWidth = $(object).prop('checked');
    if (allElemWidth) {

        $(".allElem").css({width: "100%", height: "100%"});
    } else {
        $(".allElem").css({width: "auto", height: "auto"});
    }
    game.allElemWidth = allElemWidth;
}

function setRandomFill(object) {
    allFillElemRandom = $(object).prop('checked');
    game.allFillElemRandom = allFillElemRandom;
}

function setDirectionFill(object) {
    allFillElemDirection = $(object).prop('checked');
    game.allFillElemDirection = allFillElemDirection;
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

    if (minValue == 0) {
        minValue = 0
    } else {
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
    if (value == 0) {
        value = 1
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

    if (game.typeEdit == "memory") {

        var FilterArray = game.objects.filter(item => item != "removed")


        for (i = 0; i < FilterArray.length; i++) {

                if (FilterArray[i].matching.linkWith.length == 0) {

                    alert("Please check your items to be connect with valid answer")

                    return
                }


        }


        if (FilterArray.length % 2 != 0) {

            alert("Please check the count of items, it must be 'even' count")

            return

        }

        if (FilterArray.length > 4 && FilterArray.length < 18 ) {

            var a = document.createElement("a");
            a.target = "_blank";

            // a.href = "mviewer/" + lang1.toLowerCase() + "/index.php?id=" + config.GameID;
            a.href = `mviewer/${game.langauge}/index.php?id=` + config.GameID;

            a.click();
            a.remove();

        }else{

            alert("The count of items allowed to be added is not less than 4 and not greater than 18 ")

            return
        }






    } else {

        var a = document.createElement("a");
        a.target = "_blank";
        a.href = "viewer/" + lang1.toLowerCase() + "/index.php?id=" + config.GameID;
        a.click();
        a.remove();
    }

}

function closeIframeGameP() {
    parent.$(".closeBtn").show()
    if ($('.iframeContainerP').length) $('.iframeContainerP').remove()
}

function addtitle() {
    if ($(".proprties").length) $(".proprties").remove();

    str = '<div class="proprties">' +
        '' +
        '<div class="proprtiesContainer" style="height: 321px;">' +
        '' +
        '<div class="headProprties">' +
        '<label>' + langRes.Addquestion + '</label>' +
        '<a class="closePng" onclick="closeProprties()"><i></i></a>' +
        '</div>' +
        '<div class="bodyProprties" style="height: 166px">' +
        '<section class="section settingSection text">' +
        '<textarea class="titleText" placeholder="' + langRes.Entertexthere + '" type="text" value="' + game.titleText + '" id=""></textarea>' +
        '</section>' +
        '' +
        '<section class="section settingSection icon" style="display: none">' +
        '<div class="title-icon floating-left"></div>' +
        '<div class="title-container floating-left">' +
        '<span class="main-title"></span>' +
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
        '<div class="btn-save-container floating-right"><a class="ok-btn" onclick="savetitle()" id="bgEditt"><label>Save</label></a></div>' +
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







