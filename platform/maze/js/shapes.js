resizeGame = function () {
    var gameArea = document.getElementById('gameContainer');
    var widthToHeight = 4 / 3;
    var newWidth = window.innerWidth;
    var newHeight = window.innerHeight;
    var newWidthToHeight = newWidth / newHeight;

    if (newWidthToHeight > widthToHeight) {
        newWidth = newHeight * widthToHeight;
        gameArea.style.height = newHeight + 'px';
        gameArea.style.width = newWidth + 'px';
    } else {
        newHeight = newWidth / widthToHeight;
        gameArea.style.width = newWidth + 'px';
        gameArea.style.height = newHeight + 'px';
    }
};
$(document).ready(function () {
    window.addEventListener("resize", resizeGame);
    resizeGame();
    $(".AreaDifference").click(function () {
        event.stopPropagation();
        $(".elementResizable").css('border', "none");
        $(".notcontainOmage").css('border', "1px dashed red");
        $(".control").hide();
        $(".corner").remove();
        ActiveElement = "";
    })
});
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
    str ='<div class="ui-resizable-handle ui-resizable-nw corner" id="nwgrip"></div>' +
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
            var wrapper = $('.AreaDifference');
            leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
            topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
            widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
            heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)
            $(this).css("left", leftObject + "%");
            $(this).css("top", topObject + "%");
            $(this).css("width", widthObject + "%");
            $(this).css("height", heightObject + "%");

        }
    })
}
function makeItResizable(object) {
        object.addEventListener('click', function init() {
        object.removeEventListener('click', init, false);
        object.className = object.className + ' resizable';
        var resizer = document.createElement('div');
        resizer.className = 'resizer';
        object.appendChild(resizer);
        resizer.addEventListener('mousedown', initDrag, false);
    }, false);
    var startX, startY, startWidth, startHeight;
    function initDrag(e) {
        startX = e.clientX;
        startY = e.clientY;
        startWidth = parseInt(document.defaultView.getComputedStyle(object).width, 10);
        startHeight = parseInt(document.defaultView.getComputedStyle(object).height, 10);
        document.documentElement.addEventListener('mousemove', doDrag, false);
        document.documentElement.addEventListener('mouseup', stopDrag, false);
    }
    function doDrag(e) {
        object.style.width = (startWidth + e.clientX - startX) + 'px';
        object.style.height = (startHeight + e.clientY - startY) + 'px';
    }
    function stopDrag(e) {
        document.documentElement.removeEventListener('mousemove', doDrag, false);
        document.documentElement.removeEventListener('mouseup', stopDrag, false);
    }
}
function pushNewObject(src, idObject, name, top, left, width, height, opacity, zIndex, flip) {
    if (flip) {
        flipValue = -1
    }
    else {
        flipValue = 1
    }
    strImage = ""
    classNAme = "notcontainOmage"
    rezie = ' <div class="ui-resizable-handle ui-resizable-nw corner" id="nwgrip"></div>' +
        ' <div class="ui-resizable-handle ui-resizable-ne corner" id="negrip"></div>' +
        '<div class="ui-resizable-handle ui-resizable-sw corner" id="swgrip"></div>' +
        '<div class="ui-resizable-handle ui-resizable-se corner" id="segrip"></div>'

    str = '<div name="' + name + '" class="resiz-container elementResizable ' + classNAme + '" id="' + idObject + '">' +
        strImage +
       // '<button class="control" name="' + name + '" onclick="javscript:$(this).parent().remove()" type="button">R</button>' +


        '<img style="width: 100%;height: 100%;" id="add-image-2" class="img-container" >'+





        rezie +
        '</div>'
    $(str).appendTo('.AreaDifference')
        .draggable(
            {
                containment: "parent",
                opacity: 0.35,
                start: function () {

                    addresizeCorner(this);
                    $(this).css('border', "1px solid black");
                    $(this).find(".ui-resizable-handle").show();
                },
                stop: function () {
                    var wrapper = $('.AreaDifference');
                    leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100);
                    topObject = parseInt($(this).css("top")) / (wrapper.height() / 100);
                    widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100);
                    heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100);
                    $(this).css("left", leftObject + "%");
                    $(this).css("top", topObject + "%");
                    $(this).css("width", widthObject + "%");
                    $(this).css("height", heightObject + "%");
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
        $(".AreaDifference").click()
        addresizeCorner(this)
        $(this).css('border', "1px solid black")
        $(this).find(".ui-resizable-handle").show()
        $(this).find(".control").show()
    });

    $("#img" + idObject).css('opacity', opacity)
    $("#img" + idObject).css({
        '-moz-transform': 'scaleX(' + flipValue + ')',
        '-o-transform': 'scaleX(' + flipValue + ')',
        '-webkit-transform': 'scaleX(' + flipValue + ')',
        'transform': 'scaleX(' + flipValue + ')'
    })
}
function addTransparentLayer() {
    idObject = randomString(6, "Aa")
    pushNewObject("", idObject,"", 0,0,10,10,1,0)
}

