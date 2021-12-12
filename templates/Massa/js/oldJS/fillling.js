fillingSrcImage = ""




function createIframe(src) {
    $.ajaxSetup({
        cache: false,
        async:false,
        type:'GET',


        success:function(){

        },

    });



    parent.soundEffect("sound/click.mp3")
    storyStart = true;
    $('.titleSound').trigger('pause')
    $('.site-container').fadeOut();
    $('.Games').show();


    if (src == "games.html" || src == "night-mode.html") {
        $('.bgsound').trigger('pause')
    }


    str = '<div style="z-index:99999999999;" id="iframeContainer" class="iframeContainer">' +
        '<div align="center" class="cssload-fond">' +
        '<div class="cssload-container-general">' +
        '<div class="cssload-internal"><div class="cssload-ballcolor cssload-ball_1"> </div></div>' +
        '<div class="cssload-internal"><div class="cssload-ballcolor cssload-ball_2"> </div></div>' +
        '<div class="cssload-internal"><div class="cssload-ballcolor cssload-ball_3"> </div></div>' +
        '<div class="cssload-internal"><div class="cssload-ballcolor cssload-ball_4"> </div></div>' +
        '</div>' +
        '</div>' +

        '<iframe style="display:none" src="' + src + '" class="iframeData">' +
        '</iframe>' +
        '' +
        '' +
        '</div>'

    closeIframe();


    $(str).appendTo('.main-template');

    $(".home-container").hide()
}

function onLoadIframeShow(){

   object= $(".iframeData")
    object.show()
}

function closeIframe() {

    if ($('.iframeContainer').length>0) {
    }
    $('.iframeContainer').remove();

};


function hideLoader() {
    if ($('.cssload-fond').length) {
    }
    $('.cssload-fond').remove();

}

function showContainer() {

    $(".home-container").show()
    $('.bgsound').trigger('play')
    //$('.main-container').show();
    //$('.site-container').show();
    $('.Games').hide();
    allowSleep();
    // playSoundbg("sound/bgstory.mp3")
}


function puzzleGame() {
    createIframe("games/puzzle/index.html")

}
function fillingColor() {
    createIframe("color-book.html")

}
function fillingColorPages() {
    createIframe("games/filling/index.html")

}
function sorting() {

    createIframe("games/sort/index.html")

}
function gamesHome(){

    createIframe("games.html")

}
function AboutUs() {

    createIframe("aboutus.html")

}
function Help() {

    createIframe("help.html")

}
function night_mode() {

    createIframe("night-mode.html")

}
function showLoaderGif() {
    if ($(".iframeContainer").length)$(".iframeContainer").remove()


    str = '<div id="iframeContainer" class="iframeContainer">' +
        '<div align="center" class="cssload-fond">' +
        '<div class="cssload-container-general">' +
        '<div class="cssload-internal"><div class="cssload-ballcolor cssload-ball_1"> </div></div>' +
        '<div class="cssload-internal"><div class="cssload-ballcolor cssload-ball_2"> </div></div>' +
        '<div class="cssload-internal"><div class="cssload-ballcolor cssload-ball_3"> </div></div>' +
        '<div class="cssload-internal"><div class="cssload-ballcolor cssload-ball_4"> </div></div>' +
        '</div>' +
        '</div>' +


        '' +
        '' +
        '</div>'

    closeIframe();


    $(str).appendTo('body');
}

function hideLoaderGif() {

    if ($(".iframeContainer").length)$(".iframeContainer").remove()
}
