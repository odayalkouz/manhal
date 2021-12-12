document.addEventListener('deviceready', onDeviceReady, false);
var endSlide = ""
if ('addEventListener' in document) {
    document.addEventListener('DOMContentLoaded', function () {
        FastClick.attach(document.body);
    }, false);
}


$(document).ajaxStart(function () {
    showLoaderGif()
});
$(document).ajaxStop(function () {
    hideLoaderGif()
});

animationCss = ["bounce",
    "flash",
    "pulse",
    "rubberBand",
    "shake",
    "headShake",
    "swing",
    "bounceIn",
    "bounceInDown",
    "bounceInLeft",
    "bounceInRight",
    "bounceInUp",
    "fadeIn",
    "fadeInDown",
    "fadeInDownBig",
    "fadeInLeft",
    "fadeInRightfadeInLeftBig",
    "fadeInRightBig",
    "fadeInUp",
    "fadeInUpBig",
    "flipInX",
    "flipInY",
    "zoomIn",
    "zoomInLeft",
    "zoomInRight",
    "zoomInUp",

    "slideInUp",
    "slideInRight",]
var PlayMode = localStorage['PlayMode']

var configpage = {
    soundSrc: "",
    index: ""
}
textFlag = true

if ('addEventListener' in document) {
    document.addEventListener('DOMContentLoaded', function () {
        // FastClick.attach(document.body);

    }, false);
}

function checkIFPc() {


    if (navigator.userAgent.match(/Android/i) ||
        navigator.userAgent.match(/webOS/i) ||
        navigator.userAgent.match(/iPhone/i) ||
        navigator.userAgent.match(/iPad/i) ||
        navigator.userAgent.match(/iPod/i) ||
        navigator.userAgent.match(/BlackBerry/) ||
        navigator.userAgent.match(/Windows Phone/i) ||
        navigator.userAgent.match(/ZuneWP7/i)
    ) {
        return false

    } else {
        return true

    }
}
$(document).ready(function () {

    //onDeviceReady()
    if (checkIFPc()) {
        onDeviceReady()
    }


});

var setFontSize = function () {
    //var viewportWidth = $(window).width();
    //var fontSize = Math.sqrt(viewportWidth/250);
    //$('.text-containerSlide').css('font-size',fontSize+'em');
    //
    ////var viewportWidth = $('.titel-container').width();
    ////var fontSize = Math.sqrt(viewportWidth/250);
    //
    //$('.titel-container label').css('font-size',fontSize+'em');
};
//if(!Hammer.HAS_TOUCHEVENTS && !Hammer.HAS_POINTEREVENTS) {
//    Hammer.plugins.showTouches();
//}
//
//if(!Hammer.HAS_TOUCHEVENTS && !Hammer.HAS_POINTEREVENTS) {
//    Hammer.plugins.fakeMultitouch();
//}
$(window).resize(function () {
    setFontSize();
    resizeCanvasToScreenLoader()
});
var activePage = 2
var applicationPath = ""
firstRun = true
function onDeviceReady() {

    if (!checkIFPc()) {
        window.plugins.DeviceAccounts.getEmail(function(accounts){
            // accounts is an array with objects containing name and type attributes
            console.log('account registered on this device:', accounts);

        }, function(error){
            console.log('Fail to retrieve accounts, details on exception:', error);
        });


        var deviceInfo = cordova.require("cordova/plugin/DeviceInformation");
        deviceInfo.get(function(result) {
            console.log("result = " + result);
        }, function() {
            console.log ("error");
        });
    }
    setTimeout(function () {
        $(".masa-container ").addClass("zoomInDown animated23").show()
        setTimeout(function () {
            massContainerAnimiation()
        }, 500)

    }, 1000)

    if (!checkIFPc()) {
        StatusBar.hide();
        applicationPathRoot = cordova.file.applicationStorageDirectory
    }

    if (firstRun) {
        applicationPath = "story/"

        storyArrayTmp[0] = {
            folderName: "st1",
            storyName: "موسم الحصاد",
            desc: arrayStoryDesc[0],
            index: 1,
            charge: "free"
        }

        // CurrentStory()
        firstRun = false
    }


    setTimeout(function () {
        if (!checkIFPc()) {
            navigator.splashscreen.hide();
        }
    }, 1000);
    //playSoundbg("sound/bgstory.mp3")
    setTimeout(function () {
        $('.start-btn').addClass('animated tada');
    }, 1500)

    $('.thumb-btn-story').click(function () {
        soundEffect('sound/click.mp3')
        if ($('.gallery-thumbs-container').hasClass('slideThumbUp')) {
            $('.gallery-thumbs-container').velocity({translateY: "150%", opacity: "0"}, {
                duration: 1500,
                easing: [50, 8]
            })
            $('.gallery-thumbs-container').removeClass("slideThumbUp")
            $('.controlPage').fadeIn();
        }
        else {

            $('.gallery-thumbs-container').velocity({translateY: "-150%", opacity: "1"}, {
                duration: 800,
                easing: [50, 8]
            })
            //  $('.gallery-thumbs-container').addClass("slideThumbUp")
            $('.controlPage').fadeOut();
        }

    });


    $('.home-btn-story').click(function () {

        soundEffect('sound/click.mp3')
        removePages()
        storyStart = false
        $(".bgsound").prop("volume", localStorage['musicSound']);
        goToHomePage();

    });
    $('.library-icon').click(function () {
        soundEffect('sound/click.mp3')
        removePages()
        storyStart = false
        $(".bgsound").prop("volume", localStorage['musicSound']);
        goTolibraryPage()

    });
    $('.game-icon').click(function () {
        $(".home-btn-story").click();
        $(".btn-game").click()
    });
    $('.controlPage').click(function (e) {
        soundEffect('sound/click.mp3')
        e.stopPropagation();

    });


    $('.sound-btn-story').click(function () {
        soundEffect('sound/click.mp3')

        if ($('.media').length == 0) {

            IamRead = "true"

            playSound(configpage.soundSrc);
            PlayMode = 1;
            //$('.sound-btn-story i').removeClass("flaticon-volume50");
            //$('.sound-btn-story i').addClass("flaticon-speakers9");
            $('.sound-btn-story i').css("background-image", "none");
            $('.sound-btn-story i').css("background-image", "url('images/face-mesh-talk.svg')");
            //$(".sound-btn-story i").css("width","28%");
            return 0;
        }


        else {

            if (!$('.media')[0].paused) {
                $('.sound-btn-story i').css("background-image", "none");
                $('.sound-btn-story i').css("background-image", "url('images/face-mesh-talk.svg')");
                //$(".sound-btn-story i").css("width","28%");
                PlayMode = 0;

                $('.media').trigger('pause')
            } else {
                $('.sound-btn-story i').css("background-image", "none");
                $('.sound-btn-story i').css("background-image", "url('images/face-talk.svg')");
                //$(".sound-btn-story i").css("width","43%");
                PlayMode = 1;

                $('.media').trigger('play')
            }


        }


    });


    $('.flaticon-play106').click(function () {
        soundEffect('sound/click.mp3')
        avoidSleeep()

        if (localStorage['readMode'] == 'nightRead') {

            createIframe("sleep.html");

            return;
        }


        $('.main-container').fadeOut()
        $('.main-containerPage').fadeIn()
        if ($('.swiper-container').length)$('.swiper-container').remove()
        str = ' <div class="swiper-container gallery-top" dir="rtl">' +
            '<div class="swiper-wrapper wrapperGallery-top">' +


            '</div>' +
            ' <div class="swiper-button-next controlPage"><i class="flaticon-left226 shadow-setting-green"></i></div>' +
            ' <div class="swiper-button-prev controlPage"><i class="flaticon-left226 shadow-setting-green"></i></div>' +
            '</div>'

        $(str).appendTo(".main-containerPage")


        str = '<div class="swiper-container gallery-thumbs hackCssSpeedAnimation" dir="rtl">' +
            '<div class="swiper-wrapper wrapperGallery-thumb">' +


            '</div>' +
                //' <div class="swiper-button-next"></div>'+
                //' <div class="swiper-button-prev"></div>'+
            '</div></div>'

        $(str).appendTo(".main-containerPage");


        StoryPages.length = 0;
        $.getScript(applicationPath + storyArray[0].desc.folderName + "/js/data.js")
            .done(function (script, textStatus) {
                showLoaderGif()
                createPages()
            })
            .fail(function (jqxhr, settings, exception) {
                $("div.log").text("Triggered ajaxError handler.");
            });


    });


    $('#GamesBtn').click(function () {
        soundEffect('sound/click.mp3')
        if ($('.media').length)$('.media').remove()
        // createIframe("filling/index.html")

        createIframe("puzzle/index.html")

    });
    $('.textSetting').click(function (e) {
        soundEffect('sound/click.mp3')
        e.stopPropagation();
        if (textFlag) {

            textFlag = false;


            $('.text-containerSlide').fadeOut();
            //$(".textSetting img").attr("src", "images/02-i.svg");
            $(".textSetting i").css("background-image", "none");
            $(".textSetting i").css("background-image", "url('images/text_of.svg')");
            $(".textSetting i").css("width", "62%");
        }
        else {
            $('.text-containerSlide').fadeIn();
            $(".textSetting i").css("background-image", "none");
            $(".textSetting i").css("background-image", "url('images/text_on.svg')")
            $(".textSetting i").css("width", "48%");
            //$(".textSetting img").attr("src", "images/01-i.svg");
            textFlag = true
        }


    });


    $('#fontFamily').on("change input", function () {
        soundEffect('sound/click.mp3')
        $('.fontFamilylabel').html($("#fontFamily option:selected").html())
        $('.fontFamilylabel').css('font-family', $("#fontFamily option:selected").val())
    });

    setFontSize();


    document.addEventListener("backbutton", function (e) {

        window.location = "#exitDialog";
        exitAppPopup();

    });

    document.addEventListener("pause", function () {
        soundEffect('sound/click.mp3')
        $('.bgsound').trigger('pause')
        if ($('.media').length) {
            puaseHtmlAudio()
        }
    });
    document.addEventListener("resume", function () {
        soundEffect('sound/click.mp3')
        $('.bgsound').trigger('play')
        if ($('.media').length) {
            resumeHtmlAudio()

        }
        //fnOpenNormalDialog()
    });


    patchScroll();
    writeJsonControlFile()

    if (!checkIFPc()) {
        store.error(function (error) {
            // alert('ERROR ' + error.code + ': ' + error.message);
        });

        registerDevice(false)


    }

    resizeCanvasToScreenLoader()
}

var galleryTop = ""
var myScroll
var galleryThumbs
timeOut = ""
timeOutAutoPlay = ""
timeOutEmptyPage = ""
function createPages() {

    removePages()
    $('.titleSound').trigger('pause')
    avoidSleeep()
    folderName = applicationPath + storyArray[0].desc.folderName + "/"


    for (i = 0; i < StoryPages.length; i++) {
        strImage = '<div  id="image' + i + '" class="main-containerSlide" style="background-image:url(' + folderName + StoryPages[i].image + ')"></div>'
        strText = ""
        strSound = ""

        if (StoryPages[i].text == "") {
            strText = ""
        } else {


            {
                strText = '<div id="text' + i + '" class="text-containerSlide animated noSwipingClass" >    <div class="scroller' + i + '" id="scroller"></div></div>'
            }
        }


        $("<div indexId='" + i + "' sound='" + StoryPages[i].sound + "' class='swiper-slide' style=''>" +
            strImage +
            strText +
            '</div>' +
            "" +
            "" +

            "</div>").appendTo('.wrapperGallery-top')

        strImage = '<div indexId=' + i + ' id="imageThumb' + i + '" class="main-containerSlidethumb" style="background-image:url(' + folderName + StoryPages[i].image + ')"></div>'
        $("<div indexId='" + i + "' sound='" + StoryPages[i].sound + "' class='swiper-slide' style=''>" +
            strImage +
            '<label class="pageNumber">' + eval(i + 1) + '</label>' +
            '</div>' +
            "" +
            "" +

            "</div>").appendTo('.wrapperGallery-thumb')

        if (typeof StoryPages[i].textAligner == 'undefined') {

            $('#text' + i).find('div').html(StoryPages[i].text)
        }
        else {
            createSubtitle(StoryPages[i].textAligner, $('#text' + i).find('div'))

        }


        $('#imageThumb' + i).click(function () {

            goToSlide(this)
        })


        animiationEvent('image' + i)

        if ($('#' + 'text' + i).length) {
            scroll('text' + i)
        }
    }
    //$(".textAll ").css('opacity', '.5')
    $('.main-containerSlide').click(function () {
        $('.controlPage').fadeIn();
        //if ($('.gallery-thumbs').hasClass('slideThumbUp')) {
        //    $('.gallery-thumbs').removeClass('slideThumbUp');
        //}
        $(".gallery-thumbs-container").velocity({translateY: "150%", opacity: "0"}, {duration: 1150, easing: [300, 8]})
    })

    galleryTop = new Swiper('.gallery-top', {

        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        //autoplay:true,
        spaceBetween: 5,
        speed: 500,
        grabCursor: true,
        touchMoveStopPropagation: true,
        centeredSlides: true,
        mousewheelInvert: true,
        pagination: '.swiper-pagination',
        paginationClickable: true,
        scrollContainer: true,
        noSwipingClass: "noSwipingClass",


        //effect: 'flip',
        //effect: 'fade'

    });


    galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        centeredSlides: true,
        slidesPerView: '5'


    });

    //galleryTop.params.control = galleryThumbs;
    //   galleryThumbs.params.control = galleryTop;


    $("#imageThumb" + 0).addClass('activeSlide')
    galleryTop.on('onSliderMove', function () {

        console.log(configpage.index)

        // $('.media').trigger('pause')
        if ($('.gallery-thumbs').hasClass('slideThumbUp')) {
            $('.gallery-thumbs').removeClass('slideThumbUp');
        }

        $('.text-containerSlide').hide();
        //$('.main-containerSlide').addClass('ScaleStart')


    });


    galleryTop.on('onTouchEnd', function () {
        if (textFlag) {
            $('.text-containerSlide').fadeIn();
        }
        if (PlayMode == 1) {
            //   $('.media').trigger('play')
        }

        $('.controlPage').fadeIn();
    });


    galleryTop.on('onReachEnd', function () {

        setTimeout(function () {

            endSlide = true
            console.log(endSlide)
        }, 2000)

        //$('.text-containerSlide').show();
        //$('.media').trigger('play')

    });
    galleryTop.on('onTouchStart', function () {
        event.stopPropagation();
        $('.text-containerSlide').hide();
        $('.controlPage').fadeOut();

    });


    galleryTop.on('slideChangeStart', function () {
        pageFlip = 'newPage'
        if ($('.gallery-thumbs').hasClass('slideThumbUp')) {
            $('.controlPage').fadeIn();
            $('.gallery-thumbs').removeClass('slideThumbUp');
        }
        // flipPageSound()
        $('.text-containerSlide').hide();
        $('.main-containerSlide').addClass('ScaleStart')
        $('.activeSlide').css('z-index', 9999999999)
        $(".reload-icon").hide();
    })


    galleryTop.on('slideChangeEnd', function () {
        soundEffect('sound/paperFlip.mp3')
        endSlide = false
        console.log(endSlide)
        if ($('.media').length)$('.media').remove()


        index = $('.swiper-slide-active').attr('indexId')
        activePage = index
        clearTimeout(timeOut);
        galleryThumbs.slideTo(index, 100, function (obj) {


        });
        $(".main-containerSlidethumb").removeClass('activeSlide')

        $("#imageThumb" + index).addClass('activeSlide')
        timeOut = setTimeout(function () {
            if (textFlag) {
                $('.text-containerSlide').show()
                $('.text-containerSlide #scroller').scrollTop(0);
                $('#text' + getActivePage()).addClass('animated fadeInDown');
            }
        }, 1000)


        var endAnimation = function () {

        }
        timeOut2 = setTimeout(function () {
            $('.main-containerSlide').removeClass('ScaleStart')
            $('#image' + index).removeClass('scaleAnimation');

            anim = animationCss[Math.floor(Math.random() * animationCss.length)];
        }, 950)
        $('#image' + index).addClass('scaleAnimation')

        stopAudio()
        source = $('.swiper-slide-active').attr('sound')
        clearTimeout(timeOutAutoPlay)
        if (source == "") {
            if ($('#cb6').is(':checked')) {
                timeOutAutoPlay = setTimeout(function () {

                    if (endSlide) {
                        onEndStory()
                    }
                    else {
                        nextPage();
                    }
                    // playAudio(getBaseUrl()+'sound/'+source);
                }, 10000);

            }
            return 0;
        }

        //   play first page

        setTimeout(function () {
            if (PlayMode == 1) {
                if ($('.bgsound').prop("volume") <= .4) {

                }
                else {

                    $('.bgsound').prop("volume", .4);
                }

                playSound('sound/' + source)
            }


            // playAudio(getBaseUrl()+'sound/'+source);
        }, 400);

        configpage = {
            soundSrc: 'sound/' + source,
            index: activePage
        }

    });


    $('.scroller').css({
        'font-family': "'" + localStorage['fontType'] + "' !important"
    });
    $('.text-containerSlide').css({
        'font-family': "'" + localStorage['fontType'] + "'"
    });


    //  playSound('sound/03.mp3')
    setFontSize();


    playFirstPage()
    if (!textFlag) {
        $('.text-containerSlide').hide()
    }

    hideLoaderGif()
}

function removePages() {
    if ($(".main-containerSlide").length > 0)$(".main-containerSlide").remove()
}

function getActivePage() {

    return activePage

}
function nextPage() {


    galleryTop.slideNext();
    setTimeout(function () {

    }, 3000)
    $(".swiper-button-next").removeClass('animated');
}

function previosPage() {

    galleryTop.slidePrev();
}


function autoPlaymode() {


}

function getBaseUrl() {
    var re = new RegExp(/^.*\//);
    return re.exec(window.location.href);
}

function exitAppPopup() {
    navigator.notification.confirm(
        "هل تريد الخروج من التطبيق؟",
        function (buttonIndex) {
            ConfirmExit(buttonIndex);
        },
        "تأكيد الخروج",
        "نعم,لا"
    );

    //return false;
};

function ConfirmExit(stat) {

    if (stat == "1") {
        navigator.app.exitApp();
    } else {
        return;
    }
    ;
};


function scroll(id, i) {

    //var myScroll = new IScroll('#'+id, {
    //    mouseWheel: true
    //
    //});
}

function avoidSleeep() {
    if (!checkIFPc()) {
        window.plugins.insomnia.keepAwake()
    }


}

function allowSleep() {
    if (!checkIFPc()) {
        window.plugins.insomnia.allowSleepAgain()
    }

}


function fnOpenNormalDialog() {
    if ($('#dialog-confirm').length)$('#dialog-confirm').remove()
    $('<div id="dialog-confirm"></div>').appendTo('.main-containerPage')
    $("#dialog-confirm").html("انقر على زر 'استمرار'  لمتابعة  القراءة؟");


    // Define the Dialog and its properties.
    $("#dialog-confirm").dialog({
        resizable: false,
        modal: true,
        title: "موسم الحصاد",
        height: 150,
        width: 200,
        buttons: {
            "استمرار": function () {
                $(this).dialog('close');
                my_media.play();
                callback(true);
            }
        }
    });
}

function animiationEvent(id) {
    var e = document.getElementById(id);
    e.addEventListener("animationstart", listener, false);
    e.addEventListener("animationend", listener, false);
    e.addEventListener("animationiteration", listener, false);


    function listener(e) {

        switch (e.type) {
            case "animationstart":

                break;
            case "animationend":


                break;
            case "animationiteration":

                break;
        }

    }
}


function patchScroll() {

    (function (document, window) {

        // set scrollingElQuery to a class included on all your overflow-scrolling elements

        var scrollingElQuery = '.scroller',
            timeout,

            resetScrollPanes = function (e) {

                var scrollingElements = document.querySelectorAll(scrollingElQuery),
                    i = 0;

                /**
                 * Clear timeout so we do not have overlap if user changes orientations
                 * back and forth quickly.
                 */

                clearTimeout(timeout);

                for (; i < scrollingElements.length; i++) {

                    scrollingElements[i].setAttribute('style',
                        '-webkit-overflow-scrolling:auto;overflow:hidden;');
                }

                timeout = setTimeout(function () {

                    for (i = 0; i < scrollingElements.length; i++) {

                        scrollingElements[i].setAttribute('style',
                            '-webkit-overflow-scrolling:touch;overflow:auto;');
                    }
                }, 10);
            };

        window.addEventListener('orientationchange', resetScrollPanes);

    }(document, window));
}


function goToSlide(obj) {
    index = $(obj).attr('indexId')

    galleryTop.slideTo(index, 10, function () {


    });


}

function sendEmail() {
    cordova.plugins.email.isAvailable(
        function (isAvailable) {
            // alert('Service is not available') unless isAvailable;

            cordova.plugins.email.addAlias('gmail', 'com.google.android.gm');

// Specify app by name or alias
            cordova.plugins.email.open({
                app: 'gmail',
                to: 'apps@manhal.com',
                subject: 'تطبيقات دار المنهل - ماسة - موسم الحصاد',

            });
        }
    );
}


var storyStart = false
function playFirstPage() {
    $('.titleSound').trigger('pause')
    storyStart = true
    activePage = galleryTop.activeIndex
    source = $('div[indexid=0]').attr('sound')

    if (PlayMode == 1) {

        if ($('.bgsound').prop("volume") <= .4) {

        }
        else {

            $('.bgsound').prop("volume", .4);
        }
        playSound('sound/' + source)
    }

    configpage = {
        soundSrc: 'sound/' + source,
        index: activePage
    }
}


function resizeCanvasToScreenLoader() {


    for (var i = 1; i <= 8; i++) {

        canvasResize = document.getElementById("loaderCanvas" + i)
        canvasResize.style.width = '100%'
        canvasResize.style.height = '100%'
        canvasResize.width = canvasResize.offsetWidth;
        canvasResize.height = canvasResize.offsetHeight;

    }

}


function createSubtitle(textData, container) {


    for (var i = 0; i < textData.length; i++) {

        idRandom = makeid()
        if (typeof textData[i].data.note == 'undefined') {

        }
        else {
            textData[i].id = idRandom
            element = document.createElement('span');
            element.setAttribute("id", idRandom);
            element.setAttribute("startTime", textData[i].start);
            element.setAttribute("EndTime", textData[i].end);
            element.setAttribute("class", "textAll textClass");
            element.innerText = textData[i].data.note + " ";
            $(element).appendTo(container)
        }


    }


    // //var syncData = text.split(" ");
    //// syncData=text
    // var element;
    // for (var i = 0; i < text.length; i++) {
    //     element = document.createElement('span');
    //     element.setAttribute("id", "c_" + i);
    //     element.setAttribute("class", "textAll");
    //     element.innerText = text[i] + " ";
    //     $(element).appendTo(container)
    //
    // }


}


function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}


function onEndStory() {
    if ($('.heighlighonendEnd'))$('.heighlighonendEnd').remove();
    $(".reload-icon").show().addClass('wobble animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
        $(this).removeClass("wobble animated");
    });
    ;
    //str = '<div class="heighlighonendEnd">' +
    //    '<div class="heighlighonendContainerEnd">' +
    //    //'<div class="wrapperClassEnd">' +
    //    '<a class="RelodeStory floating-right"></a>' +
    //    '<a class="series-btnStory floating-right"></a>' +
    //    '<a  class="HomePage floating-right"></a>' +
    //    '<div class="cloudContainer">'+
    //    '<div class="cloud1"></div>'+
    //    '<div class="cloud2"></div>'+
    //    '<div class="cloud3"></div>'+
    //    '</div>' +
    //    '</div>' +
    //
    //    '</div>'
    //
    //$(str).appendTo('body').hide().fadeIn();

    //$('.RelodeStory').click(function () {
    //
    //    goToSlideFirat()
    //})
    //
    //$('.HomePage').click(function () {
    //
    //    goToHomePage();
    //
    //})
    //
    //$('.series-btnStory').click(function () {
    //
    //    $('#series-btn').click();
    //
    //})


}

function goToSlideFirat() {


    galleryTop.slideTo(0, 10, function () {


    });
    if ($('.heighlighonendEnd'))$('.heighlighonendEnd').remove()

}
//
//function resizeGame() {
//
//    var gameArea = document.getElementById('main-template');
//    var widthToHeight = 16/9
//
//    var newWidth = window.innerWidth;
//    var newHeight = window.innerHeight;
//    var newWidthToHeight = newWidth / newHeight;
//
//    if (newWidthToHeight > widthToHeight) {
//        newWidth = newHeight * widthToHeight;
//        gameArea.style.height = newHeight + 'px';
//        gameArea.style.width = newWidth + 'px';
//    } else {
//        newHeight = newWidth / widthToHeight;
//        gameArea.style.width = newWidth + 'px';
//        gameArea.style.height = newHeight + 'px';
//    }
//
//
//}
//
//function getAspectRatio(width, height) {
//    var ratio = width / height;
//    return ( Math.abs( ratio - 4 / 3 ) < Math.abs( ratio - 16 / 9 ) ) ? (4/3) : (16/9);
//}                              