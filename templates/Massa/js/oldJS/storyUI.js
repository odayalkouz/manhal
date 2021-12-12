var arrayDesc = [
    'شاركَ الأصدقاء في مسابقات مهرجان تل التّوت البرّيّ. ترى من سيفوز؟ وكيف استخدم الأصدقاء ذكاءهم الجسديّ لنيل كؤوس العمّ ثعلب؟',
    'الجميع يستعدّ للشّتاء، والسّيّدة قطّة مشغولة مع صغارها بترميم المنزل. قرّر الأصدقاء مساعدتهم... ترى كيف استخدم الأصدقاء ذكاءهم المكانيّ؟ وهل كانت النّتيجة مرضية؟',
    'الذّكاء العاطفيّ يعني القدرة على التّفاعل والتّعاطف مع الآخرين؛ لذا عندما اشتدّ المطر في الخارج وتعرّضت عائلة رنّوش لمواقف مفاجئة، قاموا....',
    'باستخدام مهارتك وذكائك اللّغويّ، اقرأ ماذا وجد رنّوش في الصّندوق؟ وكيف انشغل عنه جميع الأصدقاء؟',
    'الطّبيعة دائمًا تفاجئنا بتقلّباتها، وبذكائنا الطّبيعيّ نستطيع التّعامل مع كافّة تقلّباتها. ترى، ماذا فعل رنّوش وأصدقاؤه عندما خرجوا للّعب في النّهر؟ وهل أجادوا التّعامل مع تقلّبات الطّبيعة؟',
    'قرّر رنّوش تغيير نفسه، ولكن هل وصل لمبتغاه؟ وهل استخدم ذكاءه الذّاتيّ الّذي يساعده على تقييم ذاته ومعرفة قدراته بالطّريقة الصّحيحة؟ اقرأ معنا لتعرف ما جرى مع رنّوش.',
    'بعد أن ساعد رنّوش وإخوته والدهم في زراعة الحبوب وأحسّوا بالجوع، راحوا يستخدمون ذكاءهم الرّياضيّ في تخيّل أطايب الطّعام، ولكن...',
    'كبر رنّوش وحان الوقت لينام في غرفة وحده، ولكنّ الأصوات لم تتركه وحيداً. ترى، هل نجح رنّوش بالنّوم وحيداً؟ أم أنّ ذكاءه الموسيقيّ قد خانه؟',
];


function goToHomePage() {
    removePages()
    if ($('.heighlighonendEnd'))$('.heighlighonendEnd').remove()

    $('.main-container').show();
    $('.home-container').show();
    $('.library-container').show();
    $('.main-containerPage').hide();
    $('.library-main-container').hide();
    $('#card').hide();
    if ($('.media').length)$('.media').remove()
    $('.Games').hide()


    allowSleep()
    if ($('.swiper-container').length)$('.swiper-container').remove();
    closeIframe();

}
function goTolibraryPage() {
    if ($('.heighlighonendEnd'))$('.heighlighonendEnd').remove()

    $('.main-container').show();
    $('.library-main-container').show();
    $('.library-container').show();
    $('.main-containerPage').hide();
    $('#card').hide();
    $('.home-container').hide();
    if ($('.media').length)$('.media').remove()
    $('.Games').hide()


    allowSleep()
    if ($('.swiper-container').length)$('.swiper-container').remove();
    closeIframe();

}

$(document).ready(function () {
    if (/Mobi/.test(navigator.userAgent)) {
        $('#menu-container').addClass("mobile");
        $(".popup-header h2").css("font-size", "4vmin");
    } else {
        $('#menu-container').addClass("pc");
        $(".popup-header h2").css("font-size", "3vmin");
    }
    $('#menu-btn').click(function () {

        event.stopPropagation();
        if ($(".main-menu-container").hasClass("fadeInLeft1")) {
            $(".main-menu-container").removeClass("fadeInLeft1");
            $(".main-menu-container").addClass("fadeInRight1");
        }
        else {
            $(".main-menu-container").removeClass("fadeInRight1");
            $(".main-menu-container").addClass("fadeInLeft1");
            $(".main-menu-container").css("display", "block");
        }

        setTimeout(function () {
            soundEffect('sound/slidemenu.mp3')
        }, 200)
    });
    $(".main-menu-container").click(function () {
        soundEffect('sound/click.mp3')
        event.stopPropagation();
        event.stopImmediatePropagation();
        if ($(".main-menu-container").hasClass("fadeInLeft1")) {
            $(".main-menu-container").removeClass("fadeInLeft1");
            $(".main-menu-container").addClass("fadeInRight1");
        }

    });
    $(".menu-container").click(function () {
        soundEffect('sound/click.mp3')
        event.stopPropagation();
        event.stopImmediatePropagation();


    });
    //$('#series-btn').click(function(){
    //    event.stopPropagation();
    //    if($(".series-container").hasClass("rotateInDownRight")){
    //        $(".series-container").removeClass("rotateInDownRight");
    //        $(".series-container").addClass("fadeOut");
    //    }
    //    else
    //    {
    //        $(".series-container").removeClass("rotateoutDownRight");
    //        $(".series-container").addClass("rotateInDownRight");
    //        $(".series-container").css("display","block");
    //    }
    //});
    //$('#series-btn-back').click(function(){
    //    event.stopPropagation();
    //    if($(".series-container").hasClass("rotateoutDownRight")){
    //        $(".series-container").removeClass("rotateoutDownRight");
    //        $(".series-container").addClass("rotateInDownRight");
    //        setTimeout(function(){$(".series-container").css("display","none");},1000)
    //    }
    //    else
    //    {
    //        $(".series-container").removeClass("rotateInDownRight");
    //        $(".series-container").addClass("rotateoutDownRight");
    //        $(".series-container").css("display","block");
    //    }
    //});

    var currentStoryThumb = {
        src: "",
        title: "",
        text: ""
    }

    $('#series-btn').click(function () {
        showLoaderGif()
        soundEffect('sound/slidemenu.mp3')
        $('#popup-mainSeries').show()


        resizeCanvasToScreenLoader();

        hideLoaderGif()
    });

    $(".thumb-container a").click(function (event) {

        event.stopPropagation()

        soundEffect('sound/slidemenu.mp3')

        if ($(this).attr("downloading") == "YES") {
            //alert("downloading Now , do  you want to stop downloading ?")
            //$(document.body).msgBox({
            //    msgText1: "هل ترغب في ايقاف التحميل ؟",
            //    msgText2:"",
            //    imgSrc: "images/error.svg",
            //    confirmFn: function () {
            //
            //        $(".message-container").removeClass("tada");
            //        $(".message-container").removeClass("animated-1");
            //        $(".message-container").addClass("zoomOutDown");
            //        $(".message-container").addClass("animated-haf");
            //        setTimeout(function () {
            //            $("#messageContainer").css("display","none")
            //        }, 500);
            //    },
            //    cancelFn: function () {
            //        $(".message-container").removeClass("tada");
            //        $(".message-container").removeClass("animated-1");
            //        $(".message-container").addClass("zoomOutDown");
            //        $(".message-container").addClass("animated-haf");
            //        setTimeout(function () {
            //            $("#messageContainer").css("display","none")
            //        }, 500);
            //    }
            //})
            //$('#messageContainer img').css({"top":"-2%","height":"51%",width:"43%",right:"-13%"});
            //$("#messageData").css({"top":"38%","right":"8%","width":"91%","height":"32%"});
            //$(".lbl-data-message span").css("line-height","1.5em");

        } else {

            style = this.currentStyle || window.getComputedStyle(this, false),
                bi = style.backgroundImage.slice(4, -1);
            bi = style.backgroundImage.slice(4, -1).replace(/"/g, "");
            currentStoryThumb.src = url = bi

            indexData = $(this).attr('attrindex')
            typeData = $(this).attr('typeCleaver')
            storyArray[0].index = indexData
            currentStoryThumb.text = arrayDesc[indexData - 1]
            $('.thumb-story').css("background", $(this).css("background"))
            $('.thumb-story').css("background-repeat", 'no-repeat')
            $('.thumb-story').css("background-size", '100% 100%')
            $('.main-title-card').html($(this).attr('attrName'))

            $('.popup-title').html(typeData)
            $('.story-information').html(currentStoryThumb.text)
            $('.story-number').html(eval(Number(indexData)))
            // $('#thumb-main-card').css("display", "block");


            storyArrayTmp[0] = {
                folderName: "st" + eval(Number($(this).attr('attrindex'))),
                storyName: $(this).attr('attrName'),
                desc: arrayStoryDesc[$(this).attr('attrindex') - 1],
                index: eval(Number($(this).attr('attrindex'))),
                charge: $(this).attr('charge')
            }

            localStorage['storyStatus'] = $(this).attr('charge')
            if (arrayStoryDesc[storyArrayTmp[0].index - 1].lock) {

                $('#readBtn i').css("background-image", "url('images/download.svg')");
                $('#readBtn i').css("margin", "18% 24% auto auto");
                $(".statusLock").show()
            }
            else {
                $('#readBtn i').css("background-image", "url('images/play.svg')");
                $('#readBtn i').css({margin: "15% auto auto 32%", width: "48%"});
                $(".statusLock").hide()
            }

            $(".library-container").hide();
            soundEffect("sound/slidemenu.mp3");
            $("#card").removeClass("zoomOut");
            $("#card").addClass("zoomIn");
            $("#card").addClass("b   ");
            $("#card").css("display", "block");
            $("#card").css("opacity", "1");
            setTimeout(function () {
                $("#card").removeClass("zoomOut");
            }, 1000);
            setNewCover()
        }


    });


    $('#close-card').click(function () {

        soundEffect('sound/click.mp3');
        $('#thumb-main-card').css("display", "none");
    });

    $('#readBtn').click(function () {

        soundEffect('sound/slidemenu.mp3')
        // $('.close-card').click()
        //  $('#close-btn').click()
        if (storyArrayTmp[0].charge == "free") {

            applicationPath = "story/"
            CurrentStory()
            //  goToHomePage()

        }


        else if (!checkIFPc()) {

            applicationPath = cordova.file.applicationStorageDirectory + 'story/'
            var fileSource = applicationPathRoot + "story/" + storyArrayTmp[0].folderName + "/js/data.js"
            window.resolveLocalFileSystemURL(fileSource, fileExists, fileDoesNotExist);
            function fileExists(fileEntry) {
                //  alert('الملف موجود جاري القراءه')

                CurrentStory()

            }

            function fileDoesNotExist() {
                //     alert('الملف غير موجود جاري التحميل')

                requestItemsToBuy(urlTst + storyArrayTmp[0].folderName + ".zip", 'story', storyArrayTmp[0].index)

            }


        }
        else {

            CurrentStory();
            $('.close-card').click()
            $('#close-btn').click()
        }

    })
    $('#share').click(function () {
        if (checkIFPc()) {

        } else {
            showLoaderGif()
            soundEffect('sound/slidemenu.mp3')
            //alert(currentStoryThumb.src)
            //alert( currentStoryThumb.text)
            convertToDataURLviaCanvas(currentStoryThumb.src, function (base64Img) {
                window.plugins.socialsharing.share(
                    "دار المنهل ناشرون" + "_" + currentStoryThumb.text + "_" + "قم بتحميل القصه ",
                    "Dar almanhal app",
                    base64Img,
                    "www.manhal.com")
                if ($(".iframeContainer").length)$(".iframeContainer").remove()
            });
        }


    })
    $('#close-btn').click(function () {

        soundEffect('sound/click.mp3')
        $('#popup-main').css("display", "none");
        $('#popupContent').html('');
        $('#title-popup').text('');
        stopAdviceSound()
    });
    $('#close-btnSeries').click(function () {
        soundEffect('sound/click.mp3')
        $('#popup-mainSeries').css("display", "none");
    });


    $('#aboutUs-btn').click(function () {
        soundEffect('sound/click.mp3')
        createIframe("aboutUs.html")
    });
    $('#help-btn').click(function () {
        soundEffect('sound/click.mp3')
        createIframe("help.html")
    });
    $('#game-page-btn').click(function () {
        if ($('.titleSound').length)$('.titleSound').remove();
        soundEffect('sound/click.mp3')
        createIframe("game-page.html")
    });
    $(function () {
        // $("#accordion").accordion();
    });
    $(".title").click(function () {
        soundEffect('sound/click.mp3')
        event.stopPropagation();
        event.stopImmediatePropagation();
        $(".ccordion-section-content").animate({height: '0px'}, 300);
        var chld = $(this).parent().children('.ccordion-section-content');
        chld.animate({height: chld.attr('dataheight') + 'px'}, 300);
    })
});


function convertToDataURLviaCanvas(url, callback, outputFormat) {
    var img = new Image();
    img.crossOrigin = 'Anonymous';
    img.onload = function () {
        var canvas = document.createElement('CANVAS');
        var ctx = canvas.getContext('2d');
        var dataURL;
        canvas.height = this.height;
        canvas.width = this.width;
        ctx.drawImage(this, 0, 0);
        dataURL = canvas.toDataURL(outputFormat);
        callback(dataURL);
        canvas = null;
    };
    img.src = url;
}


function setNewCover() {
    //$(".mainTitle").html(arrayStoryDesc[storyArray[0].index - 1].storyName)
    //$(".subTitle").html(arrayStoryDesc[storyArray[0].index - 1].storyType)
    //cover = applicationPath + storyArray[0].desc.folderName + "/images/pic.jpg"
    //$(".image").css({
    //    "background-image": "url(" + cover + ")",
    //    "background-repeat": "no-repeat",
    //    "background-size": "100% 100%",
    //    opacity: .2
    //}).animate({opacity: 1}, 1000);
    //
    //$('.close-card').click()
    //$('#close-btn').click();
    //

    setTimeout(function () {

        src = applicationPath + storyArrayTmp[0].desc.folderName + "/sound/" + arrayStoryDesc[storyArray[0].index - 1].titleSound

        playSoundTitle(src);
    }, 1500)


}


function setNewCoverinit() {


    patchScroll();
    writeJsonControlFile()

    if (!checkIFPc()) {
        store.error(function (error) {
            // alert('ERROR ' + error.code + ': ' + error.message);
        });

        registerDevice()


    }


    cover = applicationPath + storyArray[0].desc.folderName + "/images/pic.jpg"
    $(".image").css({
        "background-image": "url(" + cover + ")",
        "background-repeat": "no-repeat",
        "background-size": "100% 100%",
        opacity: .2
    }).animate({opacity: 1}, 1000);

    $('.close-card').click()
    $('#close-btn').click();


    setTimeout(function () {

        src = applicationPath + storyArray[0].desc.folderName + "/sound/" + arrayStoryDesc[storyArray[0].index - 1].titleSound

        playSoundTitle(src);
    }, 1500)


}


function startStory() {


    soundEffect('sound/click.mp3')
    avoidSleeep()


    {

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


        str = '<div class="gallery-thumbs-container"> <div class="swiper-container gallery-thumbs hackCssSpeedAnimation" dir="rtl">' +
            '<div class="swiper-wrapper wrapperGallery-thumb">' +


            '</div>' +
                //' <div class="swiper-button-next"></div>'+
                //' <div class="swiper-button-prev"></div>'+
            '</div></div>'

        $(str).appendTo(".main-containerPage");

        createPages()

    }


}


