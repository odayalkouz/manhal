var tmpArrayAudio = []
var Audiointerval
function playSound(src) {
    stopAll()
    if ($('.titleSound').length)$('.titleSound').remove();

    $("<audio class='media'></audio>").attr({
        'src': applicationPath + storyArray[0].desc.folderName + "/" + src,

        'id': "soundplug",
        'autoplay': 'autoplay'
    }).appendTo("body");
    tmpArrayAudio.length = 0

    if (typeof StoryPages[activePage].textAligner != 'undefined') {
        tmpArrayAudio = StoryPages[activePage].textAligner.slice()
    }
    else {


    }
    $(".media").prop("volume", localStorage['readerSound'] );


    $('.media').on('ended', function () {
        $(".textAll ").css('color', 'white').removeClass("textClassNeon")
        if (localStorage['autoFlip']==true || localStorage['autoFlip']=="true") {
            nextPage();
        }
        else {


            if (endSlide) {
                onEndStory()
            }
            else {
                $(".swiper-button-next").addClass('animated shake');

                setTimeout(function () {
                    $(".swiper-button-next").removeClass('animated shake');
                }, 1500)
            }
        }


        changeAllVolumeSoundOFbg()
    });


    $('.media').bind('pause', function () { //should trigger once on every pause event
        clearInterval(Audiointerval)
    });
    $('.media').bind('play', function () { //should trigger once on every pause event

        clearInterval(Audiointerval)

        Audiointerval = setInterval(function () {
            if ($('.titleSound').length)$('.titleSound').remove();
            myAudio = document.getElementById('soundplug')
            if ($("#soundplug").length) {
                currentTime = myAudio.currentTime
                if (myAudio.duration > 0 && !myAudio.paused) {
                    for (var i = 0, len = tmpArrayAudio.length; i < len; i++) {

                        var start = tmpArrayAudio[i].start
                        var end = tmpArrayAudio[i].end
                        var idObject = tmpArrayAudio[i].id
                        if (myAudio.currentTime >= start && myAudio.currentTime <= end && $("#" + idObject).text() != $(".textClassNeon").text()) {
                            $(".textAll ").css('color', 'rgba(255,255,255,1)').removeClass("textClassNeon")
                            $("#" + idObject).css({
                                color: 'yellow',
                                'overflow': 'visible',
                            }).addClass('textClassNeon')

                        }
                    }

                } else {

                    //Not playing...maybe paused, stopped or never played.


                }
            }
        }, 0);
    });

    document.getElementById("soundplug").addEventListener("timeupdate", function (e) {
        currentTime = this.currentTime

        var thisPlayer = $(this);

        //for (var i = 0, len = tmpArrayAudio.length; i < len; i++) {
        //
        //    var start = tmpArrayAudio[i].start
        //    var idObject = tmpArrayAudio[i].id
        //    if (currentTime >= start) {
        //
        //
        //        $(".textAll ").css('color', 'white')
        //        $("#" + idObject).css({
        //            opacity: 1,
        //            color: 'yellow'
        //        })
        //
        //
        //    }
        //}

        //$.map( StoryPages[activePage].textAligner, function( val, i ) {
        //    var start = val.start
        //        var idObject = val.id
        //        if (currentTime >= start) {
        //
        //
        //            $(".textAll ").css('color', 'white')
        //            $("#" + idObject).css({
        //                opacity: 1,
        //                color: 'yellow'
        //            })
        //        }
        //});


        //StoryPages[activePage].textAligner.forEach(function (element, index, array) {
        //
        //
        //    if (currentTime >= element.start ) {
        //
        //
        //        $(".textAll ").css('color', 'white')
        //        $("#" + element.id).css({
        //                opacity:1,
        //                color:'yellow'
        //        })
        //
        //
        //
        //
        //    }
        //
        //});


    });


}
function stopAll() {

    if ($('.media').length)$('.media').remove()
}


function puaseHtmlAudio() {


    $('.media').trigger('pause')
    pageFlip = 'currentPage';
};


function resumeHtmlAudio() {

    if (PlayMode == 1) {
        $('.media').trigger('play')
    }


}

function changeAllVolumeSoundOFReader(obj) {


        $('.media').prop("volume", $(obj).val());
        localStorage['readerSound'] = $(obj).val()

}


function playSoundbg(src) {
    // stopAll()

    $("<audio class='bgsound' loop></audio>").attr({
        'src': src,


        'autoplay': 'autoplay'
    }).appendTo("body");
    $(".bgsound").prop("loop", true);

    $(".bgsound").prop("volume", localStorage['musicSound'] );


    //$('.media').on('ended', function() {
    //    if(!next)return
    //    $(".swiper-button-next").addClass('animated shake');
    //    nextPage()
    //});


    //$('.media').bind('pause', function () { //should trigger once on every pause event
    //
    //});


    $('.bgsound').on('ended', function () {

        $(this).trigger('play')
    })

}


function playSoundTitle(src) {
    // stopAll()
    // if (storyStart)return

    if ($('.titleSound').length)$('.titleSound').remove();
    $("<audio class='titleSound'></audio>").attr({
        'src': src,


        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".titleSound").prop("loop", false);
    $(".titleSound").prop("volume", localStorage['readerSound'] );


    //$('.media').on('ended', function() {
    //    if(!next)return
    //    $(".swiper-button-next").addClass('animated shake');
    //    nextPage()
    //});


    //$('.media').bind('pause', function () { //should trigger once on every pause event
    //
    //});

}


function changeAllVolumeSoundOFbg(obj) {


        $('.bgsound').prop("volume", localStorage['musicSound']);
        localStorage['musicSound'] = localStorage['musicSound']


}


function playSoundParentAdvice(src) {
    $('.titleSound').trigger('pause')

    storyStart = true

    if ($('.adviceSound').length)
        $('.adviceSound').remove();
    // stopAll()

    $("<audio class='adviceSound'></audio>").attr({
        'src': src,


        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".adviceSound").prop("loop", false);
    $(".adviceSound").prop("volume", localStorage['readerSound'] );


    //$('.media').on('ended', function() {
    //    if(!next)return
    //    $(".swiper-button-next").addClass('animated shake');
    //    nextPage()
    //});


    //$('.media').bind('pause', function () { //should trigger once on every pause event
    //
    //});

}

function playSoundChildAdvice(src) {
    $('.titleSound').trigger('pause')
    if ($('.titleSound').length)$('.titleSound').remove();
    storyStart = true

    if ($('.adviceSound').length)
        $('.adviceSound').remove();
    // stopAll()

    $("<audio class='adviceSound'></audio>").attr({
        'src': src,
        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".adviceSound").prop("loop", false);
    $(".adviceSound").prop("volume", localStorage['readerSound'] );


    //$('.media').on('ended', function() {
    //    if(!next)return
    //    $(".swiper-button-next").addClass('animated shake');
    //    nextPage()
    //});


    //$('.media').bind('pause', function () { //should trigger once on every pause event
    //
    //});

}

function stopAdviceSound() {
    if ($('.titleSound').length)$('.titleSound').remove();
    if ($('.adviceSound').length)$('.adviceSound').remove()
}


function soundEffect(src) {

    if ($('.SoundEffect').length)
        $('.SoundEffect').remove();
    // stopAll()

    $("<audio class='SoundEffect'></audio>").attr({
        'src': src,


        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".SoundEffect").prop("loop", false);
      $(".SoundEffect").prop("volume",localStorage['musicSound']);


}


function BackgroundSound(src) {

    if ($('.BackgroundSound').length)
        $('.BackgroundSound').remove();
    // stopAll()

    $("<audio class='BackgroundSound'></audio>").attr({
        'src': src,


        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".BackgroundSound").prop("loop", false);
    $(".BackgroundSound").prop("volume", localStorage['musicSound'] );

    $('.BackgroundSound').on('ended', function () {

        $(this).trigger('play')
    })
}


function stopBackgroundMusic() {

    if ($('.BackgroundSound').length)
        $('.BackgroundSound').remove();
    // stopAll()
}

function speachSound(src) {
    if ($('.titleSound').length)$('.titleSound').remove();
    if ($('.speachSound').length)
        $('.speachSound').remove();
    // stopAll()

    $("<audio class='speachSound'></audio>").attr({
        'src': src,


        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".speachSound").prop("loop", false);
    $(".speachSound").prop("volume", localStorage['readerSound'] );


}
