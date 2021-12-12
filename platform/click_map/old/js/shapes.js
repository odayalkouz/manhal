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
    resizeGameInner(".gameContent", ".titleContainer", (4 / 3), 3)
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
        splashVPos: '50%',
        loaderVPos: '80%',
        addFiles: [





        ],
        splashFunction: function () {


            resizeGame();
            $('<div class="loder-bg">').appendTo('#manhalpreOverlay');

        },
        onLoading: function (per) {


        },
    }, function () {



    });





    $(".gameContent").click(function () {
        event.stopPropagation()
        $(".elementResizable").css('border', "none")
        $(".notcontainOmage").css('border', "1px dashed red")
        $(".control").hide()
        $(".corner").remove();
        ActiveElement = ""
        $(".setting-popup").hide();
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


});


function loadJsonData() {

    setdatafunction(
        {
            TypeProcesses: 'getdatagames',
            id: config.GameID
        });
}


function DrawObjects() {

    length = game.objects.length;
    objects = game.objects


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
                i
            )


        }


    }

    $("#NoSound").prop('checked', game.noSound);
    $("#NoHelp").prop('checked', game.noHelp);

}


function pushNewObject(src, idObject, name, top, left, width, height, opacity, zIndex, flip, setAsTrue, index) {


    if (flip) {
        flipValue = -1
    }
    else {
        flipValue = 1
    }

    if (src != "") {
        src = config.rootPath + "images/" + name
        strImage = '<img id="img' + idObject + '" class="allElem hvr-glow" src="' + src + '">'
        classNAme = "containOmage"
    } else {
        strImage = ""
        classNAme = "notcontainOmage"

    }


    rezie = ' <div class="ui-resizable-handle ui-resizable-nw corner" id="nwgrip"></div>' +
        ' <div class="ui-resizable-handle ui-resizable-ne corner" id="negrip"></div>' +
        '<div class="ui-resizable-handle ui-resizable-sw corner" id="swgrip"></div>' +
        '<div class="ui-resizable-handle ui-resizable-se corner" id="segrip"></div>'

    str = '<div name="' + name + '" class="elementResizable ' + classNAme + '" id="' + idObject + '">' +
        strImage +
        // '<button class="control" name="' + name + '" onclick="removeFile(this)" type="button">R</button>' +
        // '<button class="control" type="button" onclick="showProprties()">E</button>' +
        rezie +
        '</div>'
    $(str).appendTo('.gameContent')
        .draggable(
            {
                containment: "parent",
                opacity: 0.35,
                start: function () {
                    ActiveObject(this)
                    addresizeCorner(this)
                    $(this).css('border', "1px solid black")
                    $(this).find(".ui-resizable-handle").show()
                },
                stop: function () {
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
        //  event.stopPropagation()
        $(".gameContent").click()
        addresizeCorner(this)
        $(this).css('border', "1px solid black")
        $(this).find(".ui-resizable-handle").show()
        $(this).find(".control").show()

        ActiveObject(this)

        getCssValue()
        $(".setting-popup").show();
        if(ActiveElement.Element.opacity==""){
            ActiveElement.Element.opacity=1
            $(".rang-number span").html(1)
            $("#opacityObject").val(1)
        }
        $(".rang-number span").html(ActiveElement.Element.opacity)
        $("#opacityObject").val(ActiveElement.Element.opacity)

    });

    $("#img" + idObject).css('opacity', opacity)
    $(".rang-number span" ).html(opacity)
    $("#img" + idObject).css({
        '-moz-transform': 'scaleX(' + flipValue + ')',
        '-o-transform': 'scaleX(' + flipValue + ')',
        '-webkit-transform': 'scaleX(' + flipValue + ')',
        'transform': 'scaleX(' + flipValue + ')'
    })


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
        stop: function () {
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


function pushToJsonArray(src, id, name) {

    game.objects.push({

        id: id,
        top: "0%",
        left: "0%",
        src: src,
        sound: "",
        element: "",
        text: "",
        type: "image/sound/text",
        animation: "",
        opacity: "",
        zIndex: "",
        flip: false,
        name: name,
        setAsTrue: false,
        click: function () {
        },
        mouseup: function () {
        },
        style: ""


    })
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
                sound: e.sound,
                text: e.text,
                setAsTrue: e.setAsTrue


            }

        }
        ;
    });

}

function changeBackground(src) {


    $(".gameContent").css(
        {
            'background-image': 'url(' + src + ')',
            'background-size': '100% 100%',
            'background-repeat': 'no-repeat'


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

function copyObject() {

    if (ActiveElement == "") {
        alert("Select object!")
        return
    }
    object = game.objects[ActiveElement.index]

    id = randomString(5, 'aA')


    pushToJsonArray(
        object.src,
        id,
        object.name
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
        object.flip
    )


    $("#" + id).click()


}


function addTransparentLayer() {
    idObject = randomString(6, "Aa")
    pushToJsonArray("", idObject, "")
    pushNewObject("", idObject, "", 0, 0, 10, 10, 1, 0)
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

    document.body.ondragover = function () {
        $(".gameContent").addClass('hoverDrop');
        return false;
    };
    document.body.ondragend = function () {
        $(".gameContent").addClass('hoverDrop');
        return false;
    };
    document.body.ondragleave = function () {
        $(".gameContent").addClass('hoverDrop');
        return false;
    };
    document.body.ondrop = function (e) {
        this.className = '';
        e.preventDefault();

        var file = e.dataTransfer.files[0],
            reader = new FileReader();
        reader.onerror = function () {
            alert('invalid Image Type')
        };
        reader.onload = function (event) {
            imgDrag = new Image()
            imgDrag.src = event.target.result
            var fileName = file.name


            extension = file.name.split(".")[1]


            if ((extension == "png")
                || (extension == "PNG")
                || (extension == "jpg")
                || (extension == "jpeg")
                || (extension == "gif")
            ) {


                dataFile = event.target.result;
                //value = input.files[0].name;
                randomeName = randomString(5, 'aA')

                canvasOFtemp = document.createElement('canvas');
                canvasOFtemp.width = 1024;
                canvasOFtemp.height = 768;


                var image = new Image();
                image.src = dataFile;
                image.onload = function () {
                    aspect = calculateAspectRatioFit(image.width, image.height, 1024, 768)

                    var cxt = canvasOFtemp.getContext('2d');

                    var x = (canvasOFtemp.width - aspect.width) * 0.5,   // this = image loaded
                        y = (canvasOFtemp.height - aspect.height) * 0.5;

                    cxt.drawImage(image, x, y, aspect.width, aspect.height);

                    ajaxPHP(config.rootPath + "/images/", canvasOFtemp.toDataURL(), "image", "bg.png", "uploadBackground")

                };

                $(".gameContent").removeClass('hoverDrop')
                // setTimeout(Edit(),200)


            }
            else {
                alert('Invalid Image type')
                $(".gameContent").removeClass('hoverDrop')
            }
        };
        reader.readAsDataURL(file);

        return false;


    }


}


function addTitleQustion() {

    getText = ""


    removeMsg()
    string = '<div class="titleContainerHiehgtlight">' +


        '<div class="titleContainer">' +
        '<div class="titleManeContainer">' +
        '<div class="headerTitle">' +
        '<label>Select Type</label>' +
        // '<a onclick="removeMsg()" class="CloseButtonMSg closePng"><i></i></a>' +
        '</div>' +
        '<div class="innerTitle">' +
        '<div class="sub-logo"></div>' +
        '<div class="container">' +
        '<ul>' +
        '<li>' +
        '<input class="selctedTypeEditor"  datType="WithSound" type="radio" id="f-option" name="selector">' +
        '<label for="f-option">With Sound</label>' +

        '   <div class="check"></div>' +
        '   </li>' +

        '   <li>' +
        '   <input class="selctedTypeEditor" datType="justText" type="radio" id="s-option" name="selector">' +
        '<label for="s-option">Just Text</label>' +

        '   <div class="check"><div class="inside"></div></div>' +
        '   </li>' +

        '<li>' +
        '   <input class="selctedTypeEditor" datType="correctChoose" type="radio" id="t-option" name="selector">' +
        '<label for="t-option">choose correct</label>' +

        '   <div class="check"><div class="inside"></div></div>' +
        '   </li>' +
        '   </ul>' +
        '</div>' +
        ' </form>' +


        '</div>' +
        '<div class="msgFotterTitle">' +
        '<a onclick="removeMsg()"  class="saveTitle floating-right"><i></i></a>' +
        '</div>' +
        '</div>' +


        '</div>' +
        '</div>'

    $(string).appendTo('.ContainerEditor')
    $("#f-option").prop("checked", true)
    resizeGameInner(".gameContent", ".titleContainer", (4 / 3), 3)

    $(".selctedTypeEditor").change(function () {
        dataTypeEditore = ($(this).attr("datType"))
        game.typeEdit = dataTypeEditore
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

