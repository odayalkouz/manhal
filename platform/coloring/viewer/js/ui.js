/**
 * Created by Work on 5/10/2015.
 */
function hideColor(){
    event.stopPropagation();
    event.preventDefault();
    $('#colorContainer').addClass('colorContainerDown')
    $('#colorContainer').css('opacity','.5')

    showT=false
}

function showColor(){
    event.stopPropagation();
    event.preventDefault();
    $('#colorContainer').removeClass('colorContainerDown')
    $('#colorContainer').css('opacity','1')

    showT=true
}

showT=true
function toggleShow(){
    soundEffect("../../../sound/slidemenu.mp3")
    event.stopPropagation();
    event.preventDefault();
    if( $('#colorContainer').css('bottom')=='0px'){

        hideColor()
        showT=false
    }

    else if($('#colorContainer').css('bottom')=='-160px'){
        showColor()
        showT=true
    }


}


function hideSideMenu(){
    $('#controlPanel').css('transform','translate(110%)')

    showTSideMenu=false
}

function showSideMenu(){
    $('#controlPanel').css('transform','translate(0px)')

    showTSideMenu=true
}

showTSideMenu=true
function toggleShowSideMenu(){
    if(showTSideMenu){

        hideSideMenu()
        showTSideMenu=false
    }

    else{
        showSideMenu()
        showTSideMenu=true
    }


}


showTSidesize=true
function toggleShowSideSize(){
    if(showTSidesize){

        hideSizeMenu()
        showTSidesize=false
    }

    else{
        showSizeMenu()
        showTSidesize=true
    }


}

function hideSizeMenu(){

    $('.sizes').css('opacity','.2')
    showTSidesize=false
}

function showSizeMenu(){

    $('.sizes').css('opacity','1')
    showTSidesize=true
}


function flipSound(){
    /*   $('#flipSound').trigger("stop");
     $('#flipSound').trigger("play");*/
}


function showHideAll(){

    // toggleShow();
    $('#penselect').click()
    toggleShowSideMenu()
    toggleShowSideSize()
    $('#morePenCont').hide()
    if($('.downloadBox'))$('.downloadBox').remove()
    $('#morePenCont').hide()
    $('#colorPicker').hide();
}


function hideAllPobup(){
    if($('.downloadBox'))$('.downloadBox').remove()
    hideSizeMenu()
    hideSideMenu()
    $('#colorContainer').addClass('colorContainerDown')
    $('#colorContainer').css('opacity','.5')
    $('#colorPicker').hide();
    showT=false
    $('#morePenCont').hide()
}


function hidePobUpJus(colorP){
    if($('.orginalContainer'))$('.orginalContainer').remove()
  
    if($('.downloadBox'))$('.downloadBox').remove()
    $('#morePenCont').hide()
    $('#colorPicker').hide();
    if(!colorP) {
        $('#colorContainer').addClass('colorContainerDown')
        $('#colorContainer').css('opacity','.5')
    }

}

var mouseDownUi=function(){

    this.hideOnMouseDown=function(){
        $('.hideAll').hide()
        if($('.orginalContainer'))$('.orginalContainer').remove()
    }
    this.ShowOnMouseDown=function(){
        $('.hideAll').show()
    }

}


UiMouseDown = new mouseDownUi;
/*=======================cod in php=============*/
function BackgroundSound(src) {

    if ($('.BackgroundSound').length)
        $('.BackgroundSound').remove();
    // stopAll()

    $("<audio class='BackgroundSound'></audio>").attr({
        'src':  src,


        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".BackgroundSound").prop("loop", false);
    $(".BackgroundSound").prop("volume", .5);

    $('.BackgroundSound').on('ended', function () {

        $(this).trigger('play')
    })
    $('.BackgroundSound').prop("volume", Number(localStorage['musicSound']));
}
function speachSound(src) {
    if ($('.titleSound').length) $('.titleSound').remove();
    if ($('.speachSound').length)
        $('.speachSound').remove();
    // stopAll()

    $("<audio class='speachSound'></audio>").attr({
        'src':  src,


        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".speachSound").prop("loop", false);


}

function soundEffect(src) {

    if ($('.SoundEffect').length)
        $('.SoundEffect').remove();
    // stopAll()

    $("<audio class='SoundEffect'></audio>").attr({
        'src':  src,


        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".SoundEffect").prop("loop", false);
    //  $(".SoundEffect").prop("volume", $("#musicSound").val());
}


function soundEffectLoop(src) {

    if ($('.SoundEffect').length > 0)
        $('.SoundEffect').remove();
    // stopAll()

    $("<audio class='SoundEffect'></audio>").attr({
        'src':  src,

        loop: true,
        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".SoundEffect").prop("loop", true);
    $(".SoundEffect").prop("volume", .8);
    //  $(".SoundEffect").prop("volume", $("#musicSound").val());
}
$(window).on("resize", function () {
    if(!( /|iPad/i.test(navigator.userAgent) )) {
        resizecolorPicker()
    }

    resizefilling()
})
$(document).ready(function () {
    $(".filing-btn").click(function () {
        $(".filing-btn").removeClass("selected");
        $(this).addClass("selected");
    })

    $('body').manhalLoader({

        splashID: "#jSplash",
        splashVPos: '50%',
        loaderVPos: '80%',
        addFiles: [
//                {type:'audio',url: 'sounds/1click.mp3' },
        ],
        splashFunction: function () {

            //passing Splash Screen script to jPreLoader
            if(!( /|iPad/i.test(navigator.userAgent) )) {
                resizecolorPicker()
            }
            resizefilling()
            // $('<div class="logo-game"></div>').appendTo('body')
//                $('<a class="play button-animation"></a>').appendTo('body');
            $('<div class="loder-bg">').appendTo('#manhalpreOverlay');

            //console.log('here')
            //soundEffectBG("sound/bg.wav", true, 0.4)
        },
        onLoading: function (per) {

            //console.log(per)
        },
    }, function () {

        //jPreLoader callback function
//            $('#jSplash').children('section').not('.selected').hide();
//            $('#jSplash').hide().fadeIn(800);
//            $(".game").fadeIn()
//         setTimeout(function () {
//             $(".logo-game").fadeOut("fast")
//             $("#manhalpreOverlay").fadeOut();
//         },3000)
        $("#manhalpreOverlay").fadeOut();

    });
    $(".play").click(function () {
        $(".logo-game").fadeOut("fast")
        $(".play").fadeOut("fast");
        $("#manhalpreOverlay").fadeOut();

        //  BackgroundSound('sound/drawing.mp3');
    });

    $(".cssload-fond").remove();
    $(".loading").remove();
    $(".sound-btn-story").click(function () {
        if($(this).attr("data")==0){
            $(this).attr("data","1")
            $(this).addClass("sound-off");
            pauseBg()
        }else {
            $(this).attr("data","0")
            $(this).removeClass("sound-off");
            resumeBg()
        }
    })
    $(".button-animation").mouseover(function ()
    {
        $(this).addClass("animated pulse");
    });
    $(".button-animation").mouseleave(function ()
    {
        $(this).removeClass("animated pulse");
    });
    $(".button-animation-2").mouseover(function ()
    {
        $(this).addClass("animated headShake");
    });
    $(".button-animation-2").mouseleave(function ()
    {
        $(this).removeClass("animated headShake");
    });
    $(".print").click(function () {
        soundEffect("sound/slidemenu.mp3")
    })
    $(".help-back-icon").click(function () {
        $(".help-main-container").fadeIn();
    })
    $(".close").click(function ()
    {
        $(".help-main-container").fadeOut();
    });
    $(".color-item")[0].click()
})
function pauseBg() {
    $(".BackgroundSound").trigger('pause')
}
function resumeBg() {
    $(".BackgroundSound").trigger('play')
}




