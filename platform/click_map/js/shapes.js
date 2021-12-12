var game = {
        element: $(".gameContainer"),
        width: 1280,
        height: 800,
        safeWidth: 1024,
        safeHeight: 720,
        backgroundImage: "images/bg.png",
        backgroundSound: "sound/bg.mp3",
        noSound: false,
        noHelp: false,
        titleText: "",
        noTries: "4",
        typeEdit: "withSound",
        subType: "line",
        isRandom: false,
        isdragReplace: false,
        matchingDirection: "",
        resultType: "counting",
        css: "",
        font:"DroidKufi Bold",
        inputType:"0",
        fillType:'0',
        addBackgroundFill:"0",
        allElemWidth:false,
        allFillElemRandom:true,
        allFillElemDirection:false,
        langauge:"ar",
        percentContainerSize:{
            w:100,
            h:100
        },
        group: [],
        trueFalseControl: {
            top: "0",
            left: "0",
            width: "30",
            height: "10",
        },

        objects: [
            //{
            //    //id:"",
            //    //top:"",
            //    //left:"",
            //    //sound:"",
            //    //element:"",
            //    //text:"",
            //    //type:"image/sound/text",
            //    //animation:"",
            //    //click:"",
            //    //mouseup:"",
            //    // style:"",
            //       opacity:"",
            //     zIndex:"",
            //     flip:""
            //}
        ]
    },
    UploadType = "",
    ActiveElement = ""

resizeGame = function () {


    resizeGameCustome(".gameContainer", ".gameContent", (4 / 3), 1)
    // resizeGameInner(".gameContent", ".titleContainer", (4 / 3), 3)
    resizeCanvas()
};


function resizeGameCustome(container, inner, aspectRatio, cut) {

    gameArea = $(container)
    var widthToHeight = aspectRatio;
    var newWidth = gameArea.width();
    var newHeight = gameArea.height();
    var newWidthToHeight = newWidth / newHeight;
    if (newWidthToHeight > widthToHeight) {
        newWidth = newHeight * widthToHeight;
    } else {
        newHeight = newWidth / widthToHeight;

    }
    var gameCanvas = $(inner)
    gameCanvas.css({
        width: newWidth / cut + "px",
        height: newHeight / cut + "px"
    })

}


var config = {

    GameID: GameID,
    UserId: UserId,
    rootPath: rootPath

}
//config.rootPath = "gamesUser/" + config.UserId + "/" + config.GameID
$(document).ready(function () {

    $("#userID").html("userID :" + config.UserId + " ---- ")
    $("#gameID").html("GameID :" + config.GameID + " ---- ")
    $("#root").html("root: " + config.rootPath)


    window.addEventListener("resize", resizeGame);
    loadJsonData()
    resizeGame();
    ///  DrawObjects()
    // pushNewObject()

    $('body').manhalLoader({

        splashID: "#jSplash",
        addFiles: [],
        splashFunction: function () {


            resizeGame();
            $('<div class="manhal-main-loader"><div class="loader-effect"><div class="checkmark draw"></div>' +
                '</div><div class="logo-loader"></div></div>').appendTo('#manhalpreOverlay');

        },
        onLoading: function (per) {


        },
    }, function () {
        $("#manhalpreOverlay").fadeOut(0);

    });


    $(".gameContent").click(function () {
        event.stopPropagation()
        $(".elementResizable").css('border', "none")
        $(".notcontainOmage").css('border', "1px dashed red")
        $(".control").hide()
        $(".corner").remove();
        ActiveElement = ""
        $(".setting-elemnt").hide();
        $(".trueAndFalseContainer").hide();
        $(".setting-popup-group").hide();
        hideFillControle()
    })

    $('#NoHelp').on('change', function () {
        var val = this.checked
        NoHelp(val)
    });

    $('#NoSound').on('change', function () {
        var val = this.checked
        NoSound(val)

    });

    drop()

    // uploadMultipleImages()



    $(".fontDrop select").change(function () {
        var fontDropText=$(this).val();
        if(fontDropText=="DroidKufi Bold"){
            game.font="DroidKufi Bold";
        }else if(fontDropText=="opensans"){
            game.font="opensans";
        }
    })

    $(".inputType select").change(function () {
        var inputType=$(this).val();
        if(inputType=="input text"){
            game.inputType="0";
        }else if(inputType=="text area"){
            game.inputType="1";
        }
    });
    $(".addBackgroundFill select").change(function () {
        var addBackgroundFills=$(this).val();
        if(addBackgroundFills=="Remove Background"){
            game.addBackgroundFill="0";
        }else if(addBackgroundFills=="Add Background"){
            game.addBackgroundFill="1";
        }
        // saveData();
    })
    // $(".fillType select").change(function () {
    //     var fillType=$(this).val();
    //     if(fillType=="Word or Number"){
    //         game.fillType="0";
    //     }else if(fillType=="Sentence"){
    //         game.fillType="1";
    //     }
    // })
});


function loadJsonData() {

    setdatafunction(
        {
            TypeProcesses: 'getdatagames',
            id: config.GameID
        });
}


function DrawObjects() {

    game.langauge = langStory

    length = game.objects.length;
    objects = game.objects

    if (typeof game.resultType == "undefined") {

        game.resultType = "counting"
    }
    if (typeof game.allFillElemRandom == "undefined") {

        game.allFillElemRandom = true;
    }
    if (typeof game.allFillElemDirection == "undefined") {

        game.allFillElemDirection = false;
    }
    if (typeof game.inputType == "undefined") {

        game.inputType = "0";
    }
    if (typeof game.addBackgroundFill == "undefined") {

        game.addBackgroundFill = "0";
    }
    // }else if( game.addBackgroundFill=="0"){
    //     $(".addBackgroundFill select").val("Remove Background")
    // }else if(game.addBackgroundFill=="1"){
    //     $(".addBackgroundFill select").val("Add Background")
    // }
    // if (typeof game.fillType == "undefined") {
    //
    //     game.fillType = "0";
    // }

    if (game.typeEdit == "matching" || game.typeEdit=="memory") {


        if (typeof game.subType == "undefined") {
            game.subType = "line"
        }


        if (typeof game.isdragReplace == "undefined") {
            game.isdragReplace = false
        }


        if (typeof game.matchingDirection == "undefined") {
            game.matchingDirection = ""
        }


        initMatching()


    }


    if (game.typeEdit == "TrueAndFalse") {
        appendTrueOrFalseControl()
    }
    if (game.typeEdit == "fillBox") {
        $(".addBackgroundFill").show();
        $(".leftPanelTools .btn.add-text").show();
    }

    for (i = 0; i < length; i++) {

        //$(objects[i].element).appendTo(".gameContent")
        //    .css({
        //        top: objects[i].top,
        //        left: objects[i].left
        //    })
        //    .attr("id", objects[i].id)
        //    .addClass("allElem")
        //    .attr("sound", objects[i].sound)

        if (objects[i] == "" || objects[i] == "removed") {


        } else {
            pushNewObject(
                objects[i].src,
                objects[i].id,
                objects[i].name,
                objects[i].top,
                objects[i].left,
                objects[i].width,
                objects[i].height,
                objects[i].opacity,
                objects[i].zIndex,
                objects[i].flip,
                objects[i].setAsTrue,
                i,
                objects[i].trueOrFalse,
                objects[i].textBoxConfig,
                objects[i],
            )


        }


    }

    $("#NoSound").prop('checked', game.noSound);
    $("#NoHelp").prop('checked', game.noHelp);


    drawElementInGroupBox()
    if(game.allElemWidth){

        $(".allElem").css({width:"100%",height:"100%"});
    }else {
        $(".allElem").css({width:"auto"});
    }

}

function hintLines(ui) {
    var inst = $(this).data("draggable")
    var o = inst.options;
    var d = o.tolerance;
    $(".objectx").css({"display": "none"});
    $(".objecty").css({"display": "none"});
    var x1 = ui.offset.left, x2 = x1 + inst.helperProportions.width,
        y1 = ui.offset.top, y2 = y1 + inst.helperProportions.height,
        xc = (x1 + x2) / 2, yc = (y1 + y2) / 2;
    for (var i = inst.elements.length - 1; i >= 0; i--) {
        var l = inst.elements[i].left, r = l + inst.elements[i].width,
            t = inst.elements[i].top, b = t + inst.elements[i].height,
            hc = (l + r) / 2, vc = (t + b) / 2;
        var lss = Math.abs(l - x1) <= d;
        var ls = Math.abs(l - x2) <= d;
        var rss = Math.abs(r - x2) <= d;
        var rs = Math.abs(r - x1) <= d;
        var tss = Math.abs(t - y1) <= d;
        var ts = Math.abs(t - y2) <= d;
        var bss = Math.abs(b - y2) <= d;
        var bs = Math.abs(b - y1) <= d;
        var hs = Math.abs(hc - xc) <= d;
        var vs = Math.abs(vc - yc) <= d;
        if (lss) {
            ui.position.left = inst._convertPositionTo("relative", {top: 0, left: l}).left - inst.margins.left;
            $(".objectx").css({"left": ui.position.left, "display": "block"});
        }
        if (rss) {
            ui.position.left = inst._convertPositionTo("relative", {
                top: 0,
                left: r - inst.helperProportions.width
            }).left - inst.margins.left;
            $(".objectx").css({"left": ui.position.left + ui.helper.width(), "display": "block"});
        }
        if (ls) {
            ui.position.left = inst._convertPositionTo("relative", {
                top: 0,
                left: l - inst.helperProportions.width
            }).left - inst.margins.left;
            $(".objectx").css({"left": ui.position.left + ui.helper.width(), "display": "block"});
        }
        if (rs) {
            ui.position.left = inst._convertPositionTo("relative", {top: 0, left: r}).left - inst.margins.left;
            $(".objectx").css({"left": ui.position.left, "display": "block"});
        }
        if (tss) {
            ui.position.top = inst._convertPositionTo("relative", {top: t, left: 0}).top - inst.margins.top;
            $(".objecty").css({"top": ui.position.top, "display": "block"});
        }
        if (ts) {
            ui.position.top = inst._convertPositionTo("relative", {
                top: t - inst.helperProportions.height,
                left: 0
            }).top - inst.margins.top;
            $(".objecty").css({"top": ui.position.top + ui.helper.height(), "display": "block"});
        }
        if (bss) {
            ui.position.top = inst._convertPositionTo("relative", {
                top: b - inst.helperProportions.height,
                left: 0
            }).top - inst.margins.top;
            $(".objecty").css({"top": ui.position.top + ui.helper.height(), "display": "block"});
        }
        if (bs) {
            ui.position.top = inst._convertPositionTo("relative", {top: b, left: 0}).top - inst.margins.top;
            $(".objecty").css({"top": ui.position.top, "display": "block"});
        }
        if (hs) {
            ui.position.left = inst._convertPositionTo("relative", {
                top: 0,
                left: hc - inst.helperProportions.width / 2
            }).left - inst.margins.left;
            $(".objectx").css({"left": ui.position.left + (ui.helper.width() / 2), "display": "block"});
        }
        if (vs) {
            ui.position.top = inst._convertPositionTo("relative", {
                top: vc - inst.helperProportions.height / 2,
                left: 0
            }).top - inst.margins.top;
            $(".objecty").css({"top": ui.position.top + (ui.helper.height() / 2), "display": "block"});
        }


    }
}

$.ui.plugin.add("draggable", "smartguides", {
    start: function (event, ui) {
        var i = $(this).data("draggable")
        var o = i.options;
        i.elements = [];
        $(o.smartguides.constructor != String ? (o.smartguides.items || ':data(draggable)') : o.smartguides).each(function () {
            var $t = $(this);
            var $o = $t.offset();
            if (this != i.element[0]) i.elements.push({
                item: this,
                width: $t.outerWidth(), height: $t.outerHeight(),
                top: $o.top, left: $o.left
            });
        });
    },
    stop: function (event, ui) {
        $(".objectx").css({"display": "none"});
        $(".objecty").css({"display": "none"});
    },
    drag: function (event, ui) {
        hintLines.call(this, ui);

    }
});

function pushNewObject(src, idObject, name, top, left, width, height, opacity, zIndex, flip, setAsTrue, index, trueOrFalse,fillBoxAnswer,textBoxConfig) {

    if (typeof zIndex == "undefined" || zIndex == "" || typeof zIndex == undefined) {

        zIndex = game.objects.length-1
    }


    if (flip) {
        flipValue = -1
    }
    else {
        flipValue = 1
    }
    strImage = ""
    if (src != "") {
        src = config.rootPath + "/all/images/" + name

        if (game.typeEdit == "matching" || game.typeEdit=="memory") {
            strImage += '<button onclick="" id="imgUpload' + idObject + '" class="uploadBtn hvr-glow uploadGroup-button"></button>'
            strImage += '<button onclick="" id="imgView' + idObject + '" class=" hvr-glow viewGroup-button" src="images/icons8-gallery-64.png">view</button>'
        }

        strImage += '<img id="img' + idObject + '" class="imageelement allElem " src="' + src + '">'
        classNAme = "containOmage"
    } else {
        strImage = ""
        classNAme = "notcontainOmage"

    }


    rezie = '<div class="ui-resizable-handle ui-resizable-nw corner" id="nwgrip"></div>' +
            '<div class="ui-resizable-handle ui-resizable-ne corner" id="negrip"></div>' +
            '<div class="ui-resizable-handle ui-resizable-sw corner" id="swgrip"></div>' +
            '<div class="ui-resizable-handle ui-resizable-se corner" id="segrip"></div>'

    str = '<div name="' + name + '" class=" draggable elementResizable hvr-glow ' + classNAme + '" id="' + idObject + '">' +
        strImage +
        // '<button class="control" name="' + name + '" onclick="removeFile(this)" type="button">R</button>' +
        // '<button class="control" type="button" onclick="showProprties()">E</button>' +
        rezie +
        '</div>'


    $(str).appendTo('.gameContent')
        .draggable(
            {
                snap: ".x-guide, .y-guide",
                snapMode: "inner",
                cancel: ".connectedCircle,.uploadGroup-button,.trueAndFalseContainer,٫ui-resizable-handle",

                containment: "parent",
                smartguides: ".draggable",
                tolerance: 5,
                opacity: 0.35,

                drag: function (event, ui) {
                    if (game.typeEdit == "matching" || game.typeEdit=="memory") {
                        var targ = document.getElementById("canvasColumn");
                    }
                    $(targ).css({opacity: 0})

                    $('.x-guide').css({
                        top: $(this).css("top"),
                        height: $(this).css("height"),
                        display: "block"

                    });
                    $('.y-guide').css({
                        left: $(this).css("left"),
                        width: $(this).css("width"),
                        display: "block"
                    });


                    if (game.typeEdit == "matching" || game.typeEdit=="memory") {
                        var wrapper = $('.gameContent');

                        leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
                        topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
                        widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
                        heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)

                        // $(this).css("left", leftObject + "%");
                        // $(this).css("top", topObject + "%");
                        // $(this).css("width", widthObject + "%");
                        // $(this).css("height", heightObject + "%");

                        var isDisabled = $("#" + idObject).draggable('option', 'revert');

                        if (isDisabled == "false" || isDisabled == false) {

                            updateBasic({
                                left: leftObject,
                                top: topObject,
                                width: widthObject,
                                height: heightObject,

                            })

                        }


                        // $(ui.droppable).css("background", "#4e4e4e")

                        refeshCanvas()
                    }

                    $(".draggable").css({
                        border: "1px dashed blue"
                    })
                },

                start: function (event, ui) {
                    ActiveObject(this)
                    addresizeCorner(this)
                    $(this).css('border', "1px solid black")
                    $(this).find(".ui-resizable-handle").show()
                },
                stop: function (event, ui) {
                    if (game.typeEdit == "matching" || game.typeEdit=="memory") {
                        var targ = document.getElementById("canvasColumn");
                        $(targ).css({opacity: 1})
                    }
                    var wrapper = $('.gameContent');

                    leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
                    topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
                    widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
                    heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)

                    $(this).css("left", leftObject + "%");
                    $(this).css("top", topObject + "%");
                    $(this).css("width", widthObject + "%");
                    $(this).css("height", heightObject + "%");

                    var isDisabled = $("#" + idObject).draggable('option', 'revert');

                    if (isDisabled == "false" || isDisabled == false) {

                        updateBasic({
                            left: leftObject,
                            top: topObject,
                            width: widthObject,
                            height: heightObject,

                        })

                    }


                    $(ui.droppable).css("background", "#4e4e4e")

                    $('.x-guide').css({
                        top: $(this).css("top"),
                        height: $(this).css("height"),
                        display: "none"

                    });
                    $('.y-guide').css({
                        left: $(this).css("left"),
                        width: $(this).css("width"),
                        display: "none"
                    });


                    $(".draggable").css({
                        border: "none"
                    })
                }

            }).css({
        width: width + "%",
        height: height + "%",
        border: "1px solid black",
        position: 'absolute',
        top: top + "%",
        left: left + "%",
        'z-index': zIndex,


    })

        .resizable({
            handles: {
                'ne': '#negrip',
                'se': '#segrip',
                'sw': '#swgrip',
                'nw': '#nwgrip'
            }
        }).click(function () {

        //   $("#"+idObject).draggable({ revert: false });
        event.stopPropagation()
        event.stopPropagation()
        $(".gameContent").click()
        addresizeCorner(this)
        $(this).css('border', "1px solid black")
        $(this).find(".ui-resizable-handle").show()
        $(this).find(".control").show()

        ActiveObject(this)

        getCssValue()

        $(".setting-elemnt").show();
        $(".setting-elemnt").show();
        if (ActiveElement.Element.opacity == "") {
            ActiveElement.Element.opacity = 1
            $(".rang-number span").html(1)
            $("#opacityObject").val(1)
        }
        $(".rang-number span").html(ActiveElement.Element.opacity)
        $("#opacityObject").val(ActiveElement.Element.opacity)


        /*

        SELECT OBJECT AS ITEM IN GROUP

        */


        if (game.typeEdit != "matching" || game.typeEdit!="memory") {
            if (calledGroup == true) {

                elmentID = $(this).attr("id")
                name = $(this).attr("name")
                if (name == "" && !game.objects[index].type == "text") return

                if (NewGroup.includes(elmentID)) {

                    indexEl = NewGroup.indexOf(elmentID)
                    NewGroup.splice(indexEl, 1)
                    $(this).removeClass("ObjectsSelected")
                    $(this).removeClass("anim-border")

                    $(this).attr("isGrouping", "false")
                } else {

                    if ($(this).attr("isGrouping") == "true") {

                    } else {

                        NewGroup.push(elmentID)
                        $(this).addClass("ObjectsSelected")
                        $(this).addClass("anim-border")
                        $(this).attr("isGrouping", "true")
                    }
                }

            }
        }

        if (game.typeEdit == "fillBox") {

            showFillControle(idObject)
            // $(".fontDrop").show();
            // $(".inputType").show();
            $(".addBackgroundFill").show();
            // $(".fillType").show();
            $(".leftPanelTools .btn.add-text").show();


        }

    })

    $("#" + idObject).bind("contextmenu", function (e) {

        var isDisabled = $("#" + idObject).draggable('option', 'revert');

        if (isDisabled == "false" || isDisabled == false) {

            $("#" + idObject).draggable({revert: true, helper: "clone", cursor: "move"});
        } else {
            $("#" + idObject).draggable({revert: false, helper: "orginal", cursor: "move"});


        }
        $("#" + idObject).click()
        return false;
    });


    $("#img" + idObject).css('opacity', opacity)
    $(".rang-number span").html(opacity)
    $("#img" + idObject).css({
        '-moz-transform': 'scaleX(' + flipValue + ')',
        '-o-transform': 'scaleX(' + flipValue + ')',
        '-webkit-transform': 'scaleX(' + flipValue + ')',
        'transform': 'scaleX(' + flipValue + ')'
    })

    if (game.typeEdit == "TrueAndFalse") {

        appendTrueOrFalseBox(document.getElementById(idObject))

    }


    if (game.typeEdit == "matching" || game.typeEdit=="memory") {


        if (typeof index == "undefined") {
            index = game.objects.length - 1
        }

        if (typeof game.objects[index].matching.column == "undefined") {

            game.objects[index].matching.column = "top"
        }

        if (game.objects != "removed") {
            if (game.objects[index].matching.column == "top" || game.objects[index].matching.column == "") {
                $("#" + idObject).attr("columnType", "top")
                appendCirclePoint(document.getElementById(idObject))
            } else {
                appendCirclePoint(document.getElementById(idObject))

                $("#" + idObject).attr("columnType", "bottom")
            }
        }
    }


    if (game.objects != "removed") {

        if (game.typeEdit == "fillBox") {
            if (game.objects[index].type == "text") {

                if (typeof game.objects[index].textBoxConfig == "undefined") {

                    game.objects[index].textBoxConfig = {
                        text: "",
                        allowedKeyboard: [],
                        style: {
                            color: "#000",
                            size: "30",


                        }
                    }
                }

                textBox = '<textarea  contenteditable="true" type="text" onclick="" id="textBox' + idObject + '" style="background: transparent" class="hvr-glow textAreaBox" val="' + game.objects[index].textBoxConfig.text + '">' + game.objects[index].textBoxConfig.text + '</textarea>'

                $(textBox).appendTo("#" + idObject).css({
                    color: game.objects[index].textBoxConfig.style.color,
                    "font-size": game.objects[index].textBoxConfig.style.size + "px",

                })

                $("#textBox" + idObject).change(function () {

                    game.objects[index].textBoxConfig.text = $("#textBox" + idObject).val()

                }).keyboard({
                    layout: 'arabic-qwerty-1',
                    // Added here as an example on how to add combos
                    combos: {
                        'a': {e: '\u00e6'},
                        'A': {E: '\u00c6'}
                    },
                    // example callback function
                    accepted: function (e, keyboard, el) {
                        // alert('The content "' + el.value + '" was accepted!');
                    }
                })


                appendFillBoxControl(idObject)
            }
        }
    }

}


function appendFillBoxControl(idObject) {

    id = idObject

    var txt1 = "<div id='fillBoxControl_" + id + "'  class='fillBoxControl'>" +
        "<div>" +
        "<img   onclick='showFillBoxEditorAnswer()' index='" + id + "'  f class='setTrue flagTrueAndFalse' src='images/fill.png'>" +
        "<input   onclick='' index='" + id + "'  id='Color" + id + "' style='width: 20px; height: 23px;' class='setTrue flagTrueAndFalse' '>" +

        "</div>" +
        "</div>";


    $("#" + id).append(txt1)

    $('#Color' + id).ColorPicker({
        color: '#404e52',
        onShow: function (colpkr) {
            $(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            $(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            console.log("#textBox" + id)
            $("#textBox" + idObject).css('color', '#' + hex);
            index = ActiveElement.index
            game.objects[index].textBoxConfig.style.color = '#' + hex
        },

    });


}

function showFillControle(id) {
    $(".fillBoxControl").parent().css("z-index","33");
    $("#fillBoxControl_" + id).show().parent().css("z-index","9999");
}

function hideFillControle() {
    $(".fillBoxControl").hide()
}

function saveFillDataBox(index) {

    var text = $(".textAreaAnswer").val()
    // alert(text)
    text = text.replace(/\n/g, '\n');

    game.objects[index].fillBoxAnswer = text

    saveData()
    closeProprties()
}

function showFillBoxEditorAnswer() {


    index = ActiveElement.index
    if ($(".proprties").length) $(".proprties").remove();

    textValue = ""
    if (typeof game.objects[index].fillBoxAnswer != "undefined") {
        textValue = game.objects[index].fillBoxAnswer
    }


    str = '<div class="proprties">' +
        '' +
        '<div class="proprtiesContainer" style="height: 323px;">' +
        '' +
        '<div class="headProprties">' +
        '<label>'+langRes.addfillAnswer+'</label>' +
        '<a class="closePng" onclick="closeProprties()"><i></i></a>' +
        '</div>' +
        '<div class="bodyProprties" style="height: 166px;">' +
        '<section class="section settingSection text">' +
        '<textarea class="titleText textAreaAnswer" placeholder="'+langRes.Entertexthere+'" type="text" value="' + textValue + '" id="">' + textValue + '</textarea>' +
        '</section>' +
        '' +


        '</div>' +
        '<div class="footerProprties">' +
        '<div class="btn-save-container floating-right"> <a class="ok-btn " onclick="saveFillDataBox(' + index + ')" id="bgEditt"><label>'+langRes.Save+'</label></a></div>' +
        '</div>' +
        '</div>' +
        '' +

        '' +
        '</div>' +

        '</div>'

    $(str).appendTo('body')


    $(".textAreaAnswer").keyboard({
        layout: 'arabic-qwerty-1',
        // Added here as an example on how to add combos
        combos: {
            'a': {e: '\u00e6'},
            'A': {E: '\u00c6'}
        },
        // example callback function
        accepted: function (e, keyboard, el) {
            // alert('The content "' + el.value + '" was accepted!');
        }
    })


}

function appendCirclePoint(container) {
    idObject = $(container).attr('id')

    text2 = "<div class='connectedCircle circle' target='" + idObject + "' id='circle_" + idObject + "' >" +
        "<span>" +

        "</span>" +
        "</div>"

    $(container).append(text2)


    assignEventToCircleMatching("circle_" + idObject)


    $("#" + idObject).dblclick(function () {
        var txt;
        var r = confirm("Are you sure you want to disconnect Line from parent ?");

        if (r == true) {
            deconnectLine(idObject)

        } else {
            // txt = "You pressed Cancel!";
        }
    });


    $("#imgUpload" + idObject).click(function () {
        event.stopPropagation()
        uploadMultipleImages(this)
    });


    $("#imgView" + idObject).click(function () {
        event.stopPropagation()
        viewMultipleImages(this)
    });


}


function appendTrueOrFalseBox(container) {

    idTrue = "box_true" + container.id
    idFlse = "box_false" + container.id
    idnone = "box_none" + container.id


    id = "box_" + container.id
    var txt1 = "<div  id='" + id + "' class='trueAndFalseContainer'>" +
        "<div>" +
        "<img id='" + idTrue + "' flag='true'  class='setTrue flagTrueAndFalse'  src='images/correct.png'>" +
        "<img id='" + idFlse + "' flag='false' class='setfalse flagTrueAndFalse' src='images/false.png'>" +
        "<img id='" + idnone + "' flag='none'  class='setnone flagTrueAndFalse'  src='images/none.png'>" +
        "</div>" +
        "</div>";


    var txt2 = "<div  id='" + id + "' class='trueAndFalseContainerTop'>" +
        "<div>" +
        "<img flag='true' class='setTrueTop flagTrueAndFalseTop' src='images/correct.png'>" +
        "</div>" +
        "</div>";

    $(container).append(txt1)

    $(container).append(txt2)

    infoElement = null
    idObject = $(container).attr('id')
    $.grep(game.objects, function (e) {
        if (e.id == idObject) {
            //console.log(game.objects.indexOf(e))
            infoElement = {
                Element: e,
                index: game.objects.indexOf(e),
                id: e.id,
                src: e.src,
                sound: e.sound,
                text: e.text,
                setAsTrue: e.setAsTrue,
                trueOrFalse: e.trueOrFalse,
                matching: e.matching,
                fillBoxAnswer: e.fillBoxAnswer
            }
        };
    });


    $("#" + idTrue).click(function (e) {

        event.stopPropagation()
        event.preventDefault()
        flagCheck = $(this).attr("flag")

        SetTrueOrFalse(container.id, this, flagCheck)
    })


    $("#" + idFlse).click(function (e) {

        event.stopPropagation()
        event.preventDefault()
        flagCheck = $(this).attr("flag")

        SetTrueOrFalse(container.id, this, flagCheck)
    })


    $("#" + idnone).click(function (e) {

        event.stopPropagation()
        event.preventDefault()
        flagCheck = $(this).attr("flag")

        SetTrueOrFalse(container.id, this, flagCheck)
    })


    $("#" + container.id).find(".flagTrueAndFalse").removeClass("select-true-false")


    if (game.objects[infoElement.index].trueOrFalse == "true"
        && typeof game.objects[infoElement.index].trueOrFalse != "undefined"
        && typeof game.objects[infoElement.index].trueOrFalse != undefined
        && typeof game.objects[infoElement.index].trueOrFalse != ""

    ) {

        $(container).find(".flagTrueAndFalse").removeClass("select-true-false")
        game.objects[infoElement.index].trueOrFalse = "true"
        $("#" + idTrue).addClass("select-true-false")
        $(container).find(".setTrueTop").attr("src", "images/correct.png?" + Math.random())

    } else if (game.objects[infoElement.index].trueOrFalse == "false"
        && typeof game.objects[infoElement.index].trueOrFalse != "undefined"
        && typeof game.objects[infoElement.index].trueOrFalse != undefined
        && typeof game.objects[infoElement.index].trueOrFalse != "") {

        $(container).find(".flagTrueAndFalse").removeClass("select-true-false")
        game.objects[infoElement.index].trueOrFalse = "false"
        $("#" + idFlse).addClass("select-true-false")
        $(container).find(".setTrueTop").attr("src", "images/false.png?" + Math.random())
    } else {

        $(container).find(".flagTrueAndFalse").removeClass("select-true-false")
        game.objects[infoElement.index].trueOrFalse = "none"
        $("#" + idnone).addClass("select-true-false")
        $(container).find(".setTrueTop").attr("src", "images/none.png?" + Math.random())

    }


}


function SetTrueOrFalse(container, object, trueOrFalse) {
    containerObject = document.getElementById(container)

    $(containerObject).find(".flagTrueAndFalse").removeClass("select-true-false")
    game.objects[ActiveElement.index].trueOrFalse = trueOrFalse
    $(object).addClass("select-true-false")


    if (trueOrFalse == "true") {
        $(containerObject).find(".setTrueTop").attr("src", "images/correct.png?" + Math.random())

    } else if (trueOrFalse == "false") {
        $(containerObject).find(".setTrueTop").attr("src", "images/false.png?" + Math.random())

    } else {
        $(containerObject).find(".setTrueTop").attr("src", "images/none.png?" + Math.random())

    }

}


function randomString(length, chars) {
    var mask = '';
    if (chars.indexOf('a') > -1) mask += 'abcdefghijklmnopqrstuvwxyz';
    if (chars.indexOf('A') > -1) mask += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if (chars.indexOf('#') > -1) mask += '0123456789';
    if (chars.indexOf('!') > -1) mask += '~`!@#$%^&*()_+-={}[]:";\'<>?,./|\\';
    var result = '';
    for (var i = length; i > 0; --i) result += mask[Math.round(Math.random() * (mask.length - 1))];
    return result;
}


function addresizeCorner(object) {

    if ($('.ui-resizable-handle').length) $('.ui-resizable-handle').remove()
    $(object).resizable("destroy")
    str = '<div class="ui-resizable-handle ui-resizable-nw corner" id="nwgrip"></div>' +
        '<div class="ui-resizable-handle ui-resizable-ne corner" id="negrip"></div>' +
        '<div class="ui-resizable-handle ui-resizable-sw corner" id="swgrip"></div>' +
        '<div class="ui-resizable-handle ui-resizable-se corner" id="segrip"></div>'
    $(str).appendTo(object)

    $(object).resizable({
        handles: {
            'ne': '#negrip',
            'se': '#segrip',
            'sw': '#swgrip',
            'nw': '#nwgrip'
        },

        start: function () {
            var wrapper = $('.gameContent');

            leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
            topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
            widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
            heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)

            $(this).css("left", leftObject + "%");
            $(this).css("top", topObject + "%");
            $(this).css("width", widthObject + "%");
            $(this).css("height", heightObject + "%");
            updateBasic({
                left: leftObject,
                top: topObject,
                width: widthObject,
                height: heightObject,

            })


            refeshCanvas()
        },
        resize: function () {
            if (game.typeEdit == "matching" || game.typeEdit=="memory") {
                var targ = document.getElementById("canvasColumn");
                $(targ).css({opacity: 0})
            }
            var wrapper = $('.gameContent');

            leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
            topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
            widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
            heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)

            $(this).css("width", widthObject + "%");
            $(this).css("height", heightObject + "%");
            game.objects[ActiveElement.index].width = widthObject
            game.objects[ActiveElement.index].height = heightObject
            refeshCanvas()

            $('.x-guide').css({
                top: $(this).css("top"),
                height: $(this).css("height"),
                display: "block"

            });
            $('.y-guide').css({
                left: $(this).css("left"),
                width: $(this).css("width"),
                display: "block"
            });


            $(".draggable").css({
                border: "1px dashed blue"
            })

        }
        ,
        stop: function () {
            if (game.typeEdit == "matching" || game.typeEdit=="memory") {
                var targ = document.getElementById("canvasColumn");
                $(targ).css({opacity: 1})
            }
            var wrapper = $('.gameContent');

            leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
            topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
            widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
            heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)

            $(this).css("left", leftObject + "%");
            $(this).css("top", topObject + "%");
            $(this).css("width", widthObject + "%");
            $(this).css("height", heightObject + "%");
            updateBasic({
                left: leftObject,
                top: topObject,
                width: widthObject,
                height: heightObject,

            })
            refeshCanvas()

            $('.x-guide').css({
                top: $(this).css("top"),
                height: $(this).css("height"),
                display: "none"

            });
            $('.y-guide').css({
                left: $(this).css("left"),
                width: $(this).css("width"),
                display: "none"
            });


            $(".draggable").css({
                border: "none"
            })

        }
    })
}


function makeItResizable(object) {
    //$(".Editable_").attr('contenteditable', 'false');
    // container = $(object).parent().parent()
    object.addEventListener('click', function init() {
        // container = $(object).parent().parent()
        object.removeEventListener('click', init, false);
        object.className = object.className + ' resizable';
        var resizer = document.createElement('div');
        resizer.className = 'resizer';
        object.appendChild(resizer);
        resizer.addEventListener('mousedown', initDrag, false);
    }, false);

    var startX, startY, startWidth, startHeight;

    function initDrag(e) {
        // container = $(object).parent().parent()
        startX = e.clientX;
        startY = e.clientY;
        startWidth = parseInt(document.defaultView.getComputedStyle(object).width, 10);
        startHeight = parseInt(document.defaultView.getComputedStyle(object).height, 10);
        document.documentElement.addEventListener('mousemove', doDrag, false);
        document.documentElement.addEventListener('mouseup', stopDrag, false);
    }

    function doDrag(e) {
        // container = $(object)
        object.style.width = (startWidth + e.clientX - startX) + 'px';
        object.style.height = (startHeight + e.clientY - startY) + 'px';

        // container.css({"width": (startWidth + e.clientX - startX) + 'px'})
        // container.css({"height": (startHeight + e.clientY - startY) + 'px'})


    }

    function stopDrag(e) {
        //  container = $(object)
        document.documentElement.removeEventListener('mousemove', doDrag, false);
        document.documentElement.removeEventListener('mouseup', stopDrag, false);

    }

}

window.onbeforeunload = function () {
    return 'Are you sure you want to leave?';
};

function pushToJsonArray(src, id, name, type,fillBoxAnswer,textBoxConfig) {

    game.objects.push({

        id: id,
        top: "0%",
        left: "0%",
        src: src,
        srcGroup: [],
        sound: "",
        element: "",
        text: "",
        type: type,
        animation: "",
        opacity: "",
        zIndex: "",
        flip: false,
        name: name,
        setAsTrue: false,
        trueOrFalse: false,
        isdragReplace: false,
        matchingDirection: "",
        subType: "line",
        fillBoxAnswer: fillBoxAnswer,
        textBoxConfig:textBoxConfig,

        matching: {
            linkWith: [],

            column: "top" //top=bottom
        },
        click: function () {
        },
        mouseup: function () {
        },
        style: ""


    })

    if (type == "text") {
        game.objects[game.objects.length - 1].type = "text"
    }

    return game.objects.length - 1
}

function ActiveObject(object) {
    idObject = $(object).attr('id')
    $.grep(game.objects, function (e) {
        if (e.id == idObject) {
            //console.log(game.objects.indexOf(e))
            ActiveElement = {
                Element: e,
                index: game.objects.indexOf(e),
                id: e.id,
                src: e.src,
                srcGroup: e.srcGroup,
                sound: e.sound,
                text: e.text,
                setAsTrue: e.setAsTrue,
                trueOrFalse: e.trueOrFalse,
                textBoxConfig: e.textBoxConfig,
                matching: e.matching,
                fillBoxAnswer: e.fillBoxAnswer
            }

        }
        ;
    });


    id = "box_" + idObject

    $(".trueAndFalseContainer").hide()
    $("#" + id).show()

}


function changeBackground(src) {

    if (game.backgroundImage == "") {

        return
    }
    src3 = config.rootPath + "/all" + "/images/bg.svg?" + Math.random();

    src1 = config.rootPath + "/all" + "/images/bg.jpg?" + Math.random();
    src2 = config.rootPath + "/all" + "/images/bg.png?" + Math.random();

    $(".gameContent").css(
        {
            'background': 'url(' + src3 + ')100% 100% no-repeat ,url(' + src2 + ')100% 100% no-repeat, url(' + src1 + ')100% 100% no-repeat',
            'background-size': '100% 100%',
            'background-repeat': 'no-repeat',


        })
    resizeGame()
}


function updateBasic(data) {

    game.objects[ActiveElement.index].left = data.left
    game.objects[ActiveElement.index].top = data.top
    game.objects[ActiveElement.index].width = data.width
    game.objects[ActiveElement.index].height = data.height

}

function updateOpacity(val) {
    game.objects[ActiveElement.index].opacity = val
    $(".rang-number span").html(val)
}


function AddText() {

    if ($(".hintContainer").length) $(".hintContainer").remove()
    str = '<div class="hintContainer"><div class="hint" >' +
        '<input id="textShape" type="text" >' +
        '</div>' +
        '<button type="button" onclick="closeBox()">close</button>' +
        '<button type="button" onclick="updatetext()">Save</button>'
    '</div>'

    $(str).appendTo("body")
}


function updatetext() {
    value = $('#ObjectText').val();

    game.objects[ActiveElement.index].text = value


}

function newvalue(val){
    var s={'style':{'color':val.style.color,'size':val.style.size},'text':val.text};
    return s;
    }
function newvalue2(val){
    var s=val.text

    return s;
}
function copyObject() {

    if (ActiveElement == "") {
        alert("Select object!")
        return
    }
    object = game.objects[ActiveElement.index];

    id = randomString(5, 'aA')


    ActiveElement.index=game.objects.length

    if(game.typeEdit=='fillBox'){
        pushToJsonArray(
            object.src,
            id,
            object.name,
            object.type,
            newvalue2(object.fillBoxAnswer),
            newvalue(object.textBoxConfig)
        )
        pushNewObject(
            object.src,
            id,
            object.name,
            object.top + .5,
            object.left + .5,
            object.width,
            object.height,
            object.opacity,
            object.zIndex,
            object.flip,
            "",
            ActiveElement.index,
            newvalue2(object.fillBoxAnswer),
            newvalue(object.textBoxConfig)
        )
    }else {
        pushToJsonArray(
            object.src,
            id,
            object.name,
            object.type,
            object.fillBoxAnswer,
            object.textBoxConfig
        )
        pushNewObject(
            object.src,
            id,
            object.name,
            object.top + .5,
            object.left + .5,
            object.width,
            object.height,
            object.opacity,
            object.zIndex,
            object.flip,
            "",
            ActiveElement.index,
            object.fillBoxAnswer,
            object.textBoxConfig
        )
    }



    ActiveElement.index=null;
    $("#" + id).click();
    if(game.allElemWidth){

        $(".allElem").css({width:"100%",height:"100%"});
    }else {
        $(".allElem").css({width:"auto"});
    }

}


function addTransparentLayer() {
    idObject = randomString(6, "Aa")
    indexAdded = pushToJsonArray("", idObject, "")
    pushNewObject("", idObject, "", 0, 0, 10, 10, 1, 0, 0, 0, indexAdded, 0)
}


function addTextBox() {
    idObject = randomString(6, "Aa")
    indexAdded = pushToJsonArray("", idObject, "", "text")

    pushNewObject("", idObject, "", 0, 0, 10, 10, 1, 0, 0, 0, indexAdded, 0)
}

function loadTitleTobox() {
    $(".titleText").val(game.titleText)
}


function savetitle() {
    game.titleText = $(".titleText").val()
    closeProprties()

}

function calculateAspectRatioFit(srcWidth, srcHeight, maxWidth, maxHeight) {

    var ratio = Math.min(maxWidth / srcWidth, maxHeight / srcHeight);

    return {width: srcWidth * ratio, height: srcHeight * ratio};
}

function drop() {

    // document.body.ondragover = function () {
    //     $(".gameContent").addClass('hoverDrop');
    //     return false;
    // };
    // document.body.ondragend = function () {
    //     $(".gameContent").addClass('hoverDrop');
    //     return false;
    // };
    // document.body.ondragleave = function () {
    //     $(".gameContent").addClass('hoverDrop');
    //     return false;
    // };
    // document.body.ondrop = function (e) {
    //     this.className = '';
    //     e.preventDefault();
    //
    //     var file = e.dataTransfer.files[0],
    //         reader = new FileReader();
    //     reader.onerror = function () {
    //         alert('invalid Image Type')
    //     };
    //     reader.onload = function (event) {
    //         imgDrag = new Image()
    //         imgDrag.src = event.target.result
    //         var fileName = file.name
    //
    //
    //         extension = file.name.split(".")[1]
    //
    //
    //         if ((extension == "png")
    //             || (extension == "PNG")
    //             || (extension == "jpg")
    //             || (extension == "jpeg")
    //             || (extension == "gif")
    //         ) {
    //
    //
    //             dataFile = event.target.result;
    //             //value = input.files[0].name;
    //             randomeName = randomString(5, 'aA')
    //
    //             canvasOFtemp = document.createElement('canvas');
    //             canvasOFtemp.width = 1024;
    //             canvasOFtemp.height = 768;
    //
    //
    //             var image = new Image();
    //             image.src = dataFile;
    //             image.onload = function () {
    //                 aspect = calculateAspectRatioFit(image.width, image.height, 1024, 768)
    //
    //                 var cxt = canvasOFtemp.getContext('2d');
    //
    //                 var x = (canvasOFtemp.width - aspect.width) * 0.5,   // this = image loaded
    //                     y = (canvasOFtemp.height - aspect.height) * 0.5;
    //
    //                 cxt.drawImage(image, x, y, aspect.width, aspect.height);
    //
    //                 ajaxPHP(config.rootPath + "/images/", canvasOFtemp.toDataURL(), "image", "bg.png", "uploadBackground")
    //
    //             };
    //
    //             $(".gameContent").removeClass('hoverDrop')
    //             // setTimeout(Edit(),200)
    //
    //
    //         }
    //         else {
    //             alert('Invalid Image type')
    //             $(".gameContent").removeClass('hoverDrop')
    //         }
    //     };
    //     reader.readAsDataURL(file);
    //
    //     return false;
    //
    //
    // }


}


function addTitleQustion() {

    getText = ""


    removeMsg()
    string = '<div class="titleContainerHiehgtlight">' +


        '<div class="titleContainer">' +
        '<div class="titleManeContainer">' +
        '<div class="headerTitle">' +
        '<label>'+langRes.SelectType+'</label>' +
        // '<a onclick="removeMsg()" class="CloseButtonMSg closePng"><i></i></a>' +
        '</div>' +
        '<div class="innerTitle">' +
        '<div class="sub-logo"></div>' +
        '<div class="container">' +
        '<ul>' +
        '<li class="click-map-sound">' +
        '<input class="selctedTypeEditor"  datType="withSound" type="radio" id="f-option" name="selector">' +
        '<label for="f-option"></label>' +

        '<div class="check"></div>' +
        '</li>' +

        '<li class="click-map-text" style="display: none">' +
        '<input class="selctedTypeEditor" datType="justText" type="radio" id="s-option" name="selector">' +
        '<label for="s-option"></label>' +

        '<div class="check"><div class="inside"></div></div>' +
        '</li>' +

        '<li class="correctChoose">' +
        '<input class="selctedTypeEditor" datType="correctChoose" type="radio" id="t-option" name="selector">' +
        '<label for="t-option"></label>' +

        '<div class="check"><div class="inside"></div></div>' +
        '</li>' +

        '<li class="putCircle">' +
        '<input class="selctedTypeEditor" datType="putCircle" type="radio" id="cir-option" name="selector">' +
        '<label for="cir-option"></label>' +

        '<div class="check"><div class="inside"></div></div>' +
        '</li>' +

        '<li class="TrueAndFalse">' +
        '<input class="selctedTypeEditor" datType="TrueAndFalse" type="radio" id="cir-option-truefalse" name="selector">' +
        '<label for="cir-option-truefalse"></label>' +

        '<div class="check"><div class="inside"></div></div>' +
        '</li>' +

        '<li class="matching">' +
        '<input class="selctedTypeEditor" datType="matching" type="radio" id="cir-option-matching" name="selector">' +
        '<label for="cir-option-matching"></label>' +
        '<div class="check"><div class="inside"></div></div>' +
        '</li>' +

        '<li class="memory">' +
        '<input class="selctedTypeEditor" datType="memory" type="radio" id="cir-option-memory" name="selector">' +
        '<label for="cir-option-memory"></label>' +


        '<div class="check"><div class="inside"></div></div>' +
        '</li>' +

        '<li class="fillBox">' +
        '<input class="selctedTypeEditor" datType="fillBox" type="radio" id="cir-option-fillText" name="selector">' +
        '<label for="cir-option-fillText"></label>' +

        '<div class="check"><div class="inside"></div></div>' +
        '</li>' +

        '</ul>' +
        '</div>' +
        '</form>' +


        '</div>' +
        '<div class="msgFotterTitle" style="height: 70px">' +
        '<div class="btn-save-container floating-right"><a onclick=""  class="initGame saveTitle"><label>'+langRes.OK+'</label></a></div>' +
        '</div>' +
        '</div>' +


        '</div>' +
        '</div>'

    $(string).appendTo('.ContainerEditor')
    $("#f-option").prop("checked", true)
    // resizeGameInner(".gameContent", ".titleContainer", (4 / 3), 3)

    $(".selctedTypeEditor").change(function () {
        dataTypeEditore = ($(this).attr("datType"))
        game.typeEdit = dataTypeEditore

    })
    $(".selctedTypeEditor").click(function () {
        dataTypeEditore = ($(this).attr("datType"))
        console.log("dataTypeEditore<<<<<<>>>>>>>>"+dataTypeEditore)
        game.typeEdit = dataTypeEditore
    })

    $(".initGame").click(function () {
        removeMsg()
        switch (game.typeEdit) {
            case "matching":
                initMatching()
                break;
            case "memory":
                initMatching()
                break;
            case "TrueAndFalse":
                appendTrueOrFalseControl()
                break;
            case "fillBox":
                // alert("fillBox")
                // showFillControle(idObject)
                // $(".fontDrop").show();
                // $(".inputType").show();
                $(".addBackgroundFill").show();
                $(".leftPanelTools .btn.add-text").show();
                break;
            default:
                console.log("load")

        }
    })


}

function removeMsg() {
    $(".titleContainerHiehgtlight").remove();
    $(".message-mine-container").remove()
}

function saveTitleQustion() {

    // game.levelTitle[game.levelIndex].title=$('.textAreaTitle').val()
    //
    // saveData()

}

function resizeGameInner(container, inner, aspectRatio) {

    gameArea = $(container)
    var widthToHeight = aspectRatio;
    var newWidth = gameArea.width();
    var newHeight = gameArea.height();
    var newWidthToHeight = newWidth / newHeight;
    if (newWidthToHeight > widthToHeight) {
        newWidth = newHeight * widthToHeight;
    } else {
        newHeight = newWidth / widthToHeight;

    }
    var gameCanvas = $(inner)
    gameCanvas.css({
        width: newWidth / 2 + "px",
        height: newHeight / 2 + "px"
    })

    console.log({
        width: newWidth,
        height: newHeight
    })

}

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
