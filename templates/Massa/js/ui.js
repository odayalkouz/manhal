/**
 * Created by  osaid zalloum Manhal on 8/22/2016.
 */






$(window).on("resize", function () {
    resizeGame();
    resizelibrary();
    $(".library-lbl").css("lineHeight", $(".library-lbl").height() - 10 + "px");
    $(".game-lbl").css("lineHeight", $(".game-lbl").height() - 10 + "px");
    //$(".btn-main").css("lineHeight", $(".btn-main").height() - 10 + "px");
    //$(".seres-title").css("lineHeight", $(".seres-title").height() +10+ "px");
    //$(".main-title-card").css("lineHeight", $(".main-title-card").height() + "px");
    //$(".story-number-lbl span").css("lineHeight", $(".story-number-lbl span").height() - 10 + "px");
})
function soundEffect(src) {

    if ($('.SoundEffect').length)
        $('.SoundEffect').remove();
    // stopAll()

    $("<audio class='SoundEffect'></audio>").attr({
        'src': src,


        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".SoundEffect").prop("loop", false);
    $(".SoundEffect").prop("volume", localStorage['musicSound']);


}
$(document).ready(function () {
    $(".info").click(function () {
        soundEffect("sound/click.mp3");
        AboutUs()

    });

    $(".btn-game").click(function () {
        soundEffect("sound/click.mp3");
        gamesHome()

    });
    $(".help").click(function () {
        soundEffect("sound/click.mp3");
        Help()

    });
    $('.btn-library').click(function () {

        soundEffect('sound/click.mp3')


        $(".home-container").hide();
        $(".library-main-container").show();


    });

    $(".btn-main").click(function () {
        $(".library-main-container").hide();
        $(".home-container").show();
    })


    $('.nightRead').click(function () {
        soundEffect('sound/click.mp3')
        readMode = 'nightRead'
        localStorage['readMode'] = 'nightRead'

    });


    $('.readingStory').click(function () {
        soundEffect('sound/click.mp3')
        localStorage['readMode'] = 'normal'

        readMode = 'normal'
        if (this.id == "r1") {
            localStorage['PlayMode'] = 0
            PlayMode = 0;

        }
        if (this.id == "r2") {
            localStorage['PlayMode'] = 1
            PlayMode = 1;

        }

    });


    switch (localStorage['fontType']) {
        case "Droid Arabic Naskh":

            $(".fontNaskh").click()
            break;
        case "Droid Arabic Kufi":

            $(".fontKufi").click()

            break;
        case "Amiri":

            $(".fontAmiri").click()

            break;
        default:
            return false
    }
    $(".setting").click(function () {
        $(".setting-popup").show();
    });
    $(".btn-icon-setting").click(function () {
        $(".setting-popup").show();
    });

    $(".headdabdooob").click(function () {
        $(".headdabdooob").removeClass("tossing");
        $(".headdabdooob").parent().removeClass("jamp");
        $(this).addClass('tossing').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(".headdabdooob").removeClass("tossing");
            //  $(".head").addClass('flip');
            $(".headdabdooob").parent().addClass("jamp");
            $(".headdabdooob").parent().addClass("count-3");
        });

    });

    $(".headRanoosh").click(function () {
        $(".headRanoosh").removeClass("tossing");
        $(".headRanoosh").parent().removeClass("jamp");
        $(this).addClass('tossing').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {

            //  $(".head").addClass('flip');
            $(".headRanoosh").removeClass("tossing");

            $(".headRanoosh").parent().addClass("jamp");
            $(".headRanoosh").parent().addClass("count-3");
        });

    });
    resizeGame();
    resizelibrary();
    $(".library-lbl").css("lineHeight", $(".library-lbl").height() + 10 + "px");
    $(".game-lbl").css("lineHeight", $(".game-lbl").height() + 10 + "px");
    //$(".btn-main").css("lineHeight", $(".btn-main").height() + 50 + "px");
    $(".seres-title").css("lineHeight", $(".seres-title").height() + 10 + "px");
    //$(".main-title-card").css("lineHeight", $(".main-title-card").height() + "px");
    //$(".story-number-lbl span").css("lineHeight", ($(".story-number-lbl span").outerHeight()) - 10 + "px");

    $(".btn-icon").click(function () {
        soundEffect("sound/click.mp3");
        $(".btn-icon").removeClass("swing");
        $(this).addClass("swing");
        setTimeout(function () {
            $(".btn-icon").removeClass("swing");
        }, 2000)
    });
    $(".bird").click(function () {
        $(this).removeClass("active");
        $(this).addClass("active");
        setTimeout(function () {
            $(".bird").removeClass("active");
        }, 500)
    });

    $(".mashroom i").click(function () {
        $(".mashroom i").removeClass("zoomInMashroom");
        $(this).addClass("zoomInMashroom")
        setTimeout(function () {
            $(".mashroom i").removeClass("zoomInMashroom");
        }, 1000)
    })


    $("#story-card-close").click(function () {
        $(".library-container").show();
        soundEffect("sound/click.mp3");
        $(".popup-inner-container").addClass("zoomOut");
        $(".popup-inner-container").removeClass("zoomIn");
        $(".popup-inner-container").css("display", "none");
        stopAdviceSound()
        setTimeout(function () {
            $("#card").removeClass("zoomIn");
        }, 1000);
    })

    $('.parents').click(function () {
        $("#card").hide();

        soundEffect('sound/slidemenu.mp3')
        data = ""

        srcSound = applicationPath + storyArrayTmp[0].folderName + "/sound/" + arrayStoryDesc[storyArrayTmp[0].index - 1].Parent.sound

        TextData = arrayStoryDesc[storyArray[0].index - 1].Parent.text


        $('#title-popup').text(TextData[0].text).css("color", "green");
        data += '<p class="story-information-adv">' + TextData[1].text + '</p>'
        data += '<p class="story-information-adv">' + TextData[2].text + '</p>'
        data += '<p class="story-information-adv">' + TextData[3].text + '</p>'
        data += '<p class="story-information-adv">' + TextData[4].text + '</p>'
        data += '<p class="story-information-adv">' + TextData[5].text + '</p>'

        $('#inner-adv').html(data);
        playSoundParentAdvice(srcSound)
        $("#adv").removeClass("zoomOut");
        $("#adv").addClass("zoomIn");

        $("#adv").addClass("b   ");
        $("#adv").css("display", "block");
        $("#adv").css("opacity", "1");
        setTimeout(function () {
            $("#adv").removeClass("zoomOut");
        }, 1000);
    });


    $('.child').click(function () {

        $("#card").hide();


        $('#title-popup').text("عزيزي الطفل").css("color", "green");
        data = '<p style="margin-right: 0;" class="story-information-adv">عِنْدَما تَفْتَحُ صَفَحاتِ هذا الْكِتابِ، سَيَأْخُذُكَ الأَصْدِقاءُ الثَّلاثَةُ؛ الأَرْنَبُ رَنُّوشُ الْمُفْعَمُ بِالْحَيَوِيَّةِ، وَالدُّبُّ الطَّيِّبُ، وَالْخَروفُ الظَّريفُ، إِلى وادي الْفَراوِلَةِ، وَسَتَسْنَحُ لَكَ فُرْصَةٌ عَظيمَةٌ لِلْمُشارَكَةِ في مُغامَراتٍ مُثيرَةٍ وَمُتَنَوِّعَةٍ. إِذَنْ، ماذا تَنْتَظرُ؟ هَيَّا !! افْتَحِ الْكِتابَ !!</p>';
        $('#inner-adv').html(data);
        playSoundChildAdvice("sound/child.mp3")


        soundEffect("sound/slidemenu.mp3");
        $("#adv").removeClass("zoomOut");
        $("#adv").addClass("zoomIn");
        ;
        $("#adv").addClass("b   ");
        $("#adv").css("display", "block");
        $("#adv").css("opacity", "1");
        setTimeout(function () {
            $("#adv").removeClass("zoomOut");
        }, 1000);
        $("#inner-adv").css({height: "63%", width: "74%"})
    });
    //$(".parents").click(function(){
    //    $("#card").hide();
    //    data='';
    //    soundEffect("sound/slidemenu.mp3");
    //    $("#adv").removeClass("zoomOut");
    //    $("#adv").addClass("zoomIn");;
    //    $("#adv").addClass("b   ");
    //    $("#adv").css("display", "block");
    //    $("#adv").css("opacity", "1");
    //    setTimeout(function () {
    //        $("#adv").removeClass("zoomOut");
    //    }, 1000);
    //
    //    data = '<p class="story-information-adv">عِنْدَما تَفْتَحُ صَفَحاتِ هذا الْكِتابِ، سَيَأْخُذُكَ الأَصْدِقاءُ الثَّلاثَةُ؛ الأَرْنَبُ رَنُّوشُ الْمُفْعَمُ بِالْحَيَوِيَّةِ، وَالدُّبُّ الطَّيِّبُ، وَالْخَروفُ الظَّريفُ، إِلى وادي الْفَراوِلَةِ، وَسَتَسْنَحُ لَكَ فُرْصَةٌ عَظيمَةٌ لِلْمُشارَكَةِ في مُغامَراتٍ مُثيرَةٍ وَمُتَنَوِّعَةٍ. إِذَنْ، ماذا تَنْتَظرُ؟ هَيَّا !! افْتَحِ الْكِتابَ !!</p>';
    //    $('#inner-adv').html(data);
    //})
    //$(".child").click(function(){
    //    $("#card").hide();
    //    data='';
    //    soundEffect("sound/slidemenu.mp3");
    //    $("#adv").removeClass("zoomOut");
    //    $("#adv").addClass("zoomIn");;
    //    $("#adv").addClass("b   ");
    //    $("#adv").css("display", "block");
    //    $("#adv").css("opacity", "1");
    //    setTimeout(function () {
    //        $("#adv").removeClass("zoomOut");
    //    }, 1000);
    //    $("#inner-adv").css({height: "63%",width: "74%"})
    //    data = '<p style="margin: 2% 2% 0 0;width: 91%;" class="story-information-adv">هذه السّلسلةُ من الكتبِ المُصوّرةِ تعرضُ حكاياتٍ عن الأرنبِ رنوش تمكِّنك وطفلَك من مشاركةِ متعةِ النُّموِّ معهُ، حيث تَعرضُ عِدَّةَ جوانبَ للمعرفةِ، وما عليكَ إلاّ أن تدعَ طفلكَ يستمتعُ ويحسِّنُ قدراتِهِ من خلالِها</p><p style="margin: 2% 2% 0 0;width: 91%;" class="story-information-adv">الذكاءُ هو ما يضبطُ حياةَ الفردِ، ومقدرتَهُ على حلِّ المشكلاتِ أو ابتكارِ أشياءَ جديدةٍ. ولدى كلِّ فردٍ ذكاءاتٌ متعدِّدةٌ ذاتُ تركيبةٍ فريدةٍ ومتميِّزةٍ. يحتاجُ الطِّفلُ إلى اهتمامٍ خاصٍّ لتنميةِ قدراتِهِ الطَّبيعيةِ وذكاءاتِهِ المتعدِّدةِ لينموَ نموَّاً متوازناً</p><p style="margin: 2% 2% 0 0;width: 91%;" class="story-information-adv">الذَّكاءُ الْجَسَدِيُّ: يَعْني القدرةَ على التّعبيرِ عن الأفكارِ والمشاعرِ من خلالِ حركاتِ الجسمِ وصُنْعِ أشياءَ جديدةٍ. ويضمُّ هذا النَّوعُ من الذَّكاءِ مهاراتٍ كالتَّوازنِ والتَّعاونِ والقوةِ والمرونةِ والسّرعةِ، والتّنسيقِ بينَ حركةِ اليدِ والعينِ والتَّفكيرِ، وَتُنَشِّطُ الجسمَ والعقلَ معاً، ويتمّ تدريبُ الطِّفلِ عليها تحت إشرافٍ مناسبٍ</p><p style="margin: 2% 2% 0 0;width: 91%;" class="story-information-adv">هَلْ يُحبُّ طفلُكَ المشاركةَ في النّشاطاتِ الرّياضيَّةِ؟ هل لديْهِ توازنٌ جيِّدٌ؟</p><p style="margin: 2% 2% 0 0;width: 91%;" class="story-information-adv">أعزائي المربِّيين، عليكم تَنْمِيَةُ قدراتِ أطفالِكم، فَهُم عُلماءُ الْمُسْتَقْبَلِ</p>';        $('#inner-adv').html(data);
    //})

    $("#advClose").click(function () {

        soundEffect("sound/click.mp3");

        $("#adv").addClass("zoomOut");
        $("#adv").css("display", "none");
        $("#card").show();
        stopAdviceSound()
        setTimeout(function () {
            $("#card").removeClass("zoomOut");
            $("#card").addClass("zoomIn");
        }, 1000);
    })
    $(".masa").click(function () {
        $(this).velocity({
            opacity: "1",
            translateZ: 0, // Force HA by animating a 3D property
            rotateY: "-=720deg",

        }, {
            duration: "slow", complete: function () {
                $(".masa").addClass("wobble")
            }
        })
    })

    //$(".flower").click(function () {
    //    $(this).css("-webkit-animation-fill-mode","backwards");
    //    $(this).css("animation-fill-mode","backwards");
    //    $(this).velocity('transition.flipYIn', {duration: "slow"}).velocity('transition.shrinkOut')
    //})


    $(".view-btn").click(function () {
        $(".view-btn span label").css("background-image", "none");
        $(this).find("span label").css("background-image", "url('images/True.svg')")
    });


    //$().velocity({
    //    translateX: "200px",
    //    rotateZ: "45deg"
    //});


    if (localStorage['readMode'] == "nightRead") {

        $('.nightRead').click()
    }
    else {
        if (localStorage['PlayMode'] == 0 || localStorage['PlayMode'] == "0") {

            $("#r1").click()
        } else {
            $("#r2").click()

        }


    }

    if (localStorage['autoFlip'] == true || localStorage['autoFlip'] == "true") {
        $("#autoFlip").click()
    }


})

function massContainerAnimiation() {
    $(".masa").velocity({
        opacity: "1",
        translateZ: 0, // Force HA by animating a 3D property
        rotateY: "-=720deg",
        scale: 2

    }, {duration: "slow"}).velocity({
            translateZ: 0, // Force HA by animating a 3D property
            translateY: "-=2%",
            width: "23%",
            height: "21%",
            top: "1%",
            left: "33.8%",
            rotateY: "+=720deg",
            scale: 1

        },
        {
            duration: "slow", complete: function () {

            $(".masa-title").velocity({
                opacity: "1",
                translateZ: 0, // Force HA by animating a 3D property
                //rotateY: "+=360deg",
                width: "67%",
                height: "47%",
                top: "3%",
                scale: 1.2,
                left: "17%",
                rotateY: "-=720deg",

            }, {duration: "slow"}).addClass("flipInY animated").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                $(this).removeClass("flipInY animated");
                $(".masa-title").addClass("rubberBand animated").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $(this).removeClass("rubberBand animated");
                })
            }).velocity({

                opacity: "1",
                translateZ: 0, // Force HA by animating a 3D property
                //rotateY: "+=360deg",
                width: "56%",
                height: "37%",
                top: "7%",
                left: "22%",
                scale: 1

            }, {
                duration: "slow", complete: function () {

                    setTimeout(function () {
                        $(".seres-title").velocity({translateY: "150%", opacity: "1"}, {
                            duration: 1150,
                            complete: function () {

                            },
                            easing: [300, 8]
                        })
                    }, 100)

                }
            })
        },
        });

    setInterval(function () {
        $(".masa").removeClass("wobble")
        $(".masa").click()

    }, 5000)

    setInterval(function () {

        $(".bird").click()

    }, 7000)

    setInterval(function () {

       // $(".headRanoosh").addClass("mirrorHead")
        setTimeout(function () {

          //  $(".headRanoosh").removeClass("mirrorHead")
        },3000)
    },6000)
    setInterval(function () {
        $(".headRanoosh").click()

    },8000)
    setInterval(function () {
        $(".headdabdooob").click()

    },10000)
}
window.addEventListener('resize', resizeGame, false);
window.addEventListener('orientationchange', resizeGame, false);
function resizeGame() {
    var gameArea = document.getElementById('main-title');
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

    //gameArea.style.marginTop = (-newHeight / 2) + 'px';
    //gameArea.style.marginLeft = (-newWidth / 2) + 'px';

    var gameCanvas = document.getElementById('innertitle');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
    //autoSizeText
}

function resizelibrary() {
    var gameArea = document.getElementById('main-title-b');
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

    //gameArea.style.marginTop = (-newHeight / 2) + 'px';
    //gameArea.style.marginLeft = (-newWidth / 2) + 'px';

    var gameCanvas = document.getElementById('innertitle-b');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
    //autoSizeText
}
autoSizeText = function () {
    var el, elements, i, len, _results;
    elements = $('.text');
    console.log(elements);
    if (elements.length < 0) {
        return;
    }
    _results = [];
    for (i = 0, len = elements.length; i < len; _i++) {
        el = elements[_i];
        _results.push((function (el) {
            var resizeText, _results1;
            resizeText = function () {
                var elNewFontSize;
                elNewFontSize = (parseInt($(el).css('font-size').slice(0, -2)) - 1) + 'px';
                return $(el).css('font-size', elNewFontSize);
            };
            _results1 = [];
            while (el.scrollHeight > el.offsetHeight) {
                _results1.push(resizeText());
            }
            return _results1;
        })(el));
    }
    return _results;
};


function soundEffect(src) {

    if ($('.SoundEffect').length)
        $('.SoundEffect').remove();
    // stopAll()
    $("<audio class='SoundEffect'></audio>").attr({
        'src': src,
        'autoplay': 'autoplay'
    }).appendTo("body");
    $(".SoundEffect").prop("loop", false);
}



