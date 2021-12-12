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
        matching:[],
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

    $('.addNewItem,.addNewItem2').on('click', function () {

        pushNewObjectMatch()
    });






});


function loadJsonData() {

    setdatafunction(
        {
            TypeProcesses: 'getdatagames',
            id: config.GameID
        });
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

