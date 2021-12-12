var timerInstance = new easytimer.Timer();

var inter = setInterval(dd, 10);


$(".go-to-home").click(function () {
    if (!$(this).hasClass("active")) {
        $(".go-to-home-container").addClass("animated pulse").fadeIn();
        $(this).addClass("active")
    }
    else {
        $(".go-to-home-container").removeClass("animated pulse").fadeOut();
        $(this).removeClass("active")
    }
});
var percentage1 = "";
var percentage = "";
var result1 = "";
var result2 = "";
var result3 = "";
$(document).ready(function () {
    $(document).on("click", ".reload2", function () {
        // nextgamelevel();
    });

    const checkPlatform = mobileDetect();

    if (checkPlatform.isMac) {
        // $("body").append('<style>.flip-box.flip .flip-box-inner {transform: rotateY(180deg);-webkit-transform: rotateY(180deg);-moz-transform: rotateY(180deg);-webkit-perspective: 1000px;perspective: 1000px;backface-visibility: hidden;-moz-backface-visibility: hidden;-webkit-backface-visibility: hidden;}\n</style>')
    }
    else {
    }
    switch (flipGameA1.length * 2) {
        case 4:
            setTimeout(function () {
                $(".go-to-home-container").html("<div class='check levelA-home level-open active' level='4'><div class='text-a'>4</div></div>");
                $(".go-to-home").show();
            }, 1000);
            break;
        case 6:
            $(".go-to-home").show();
            $(".go-to-home-container").html("<div class='check levelA-home level-open active' level='4'><div class='text-a'>4</div></div><div class='check levelB-home level-closed' level='6'><div class='text-a'>6</div></div>");
            break;
        case 8:
            //execute code block 2
            $(".go-to-home").show();
            $(".go-to-home-container").html("<div class='check levelA-home level-open active' level='4'><div class='text-a'>4</div></div><div class='check levelB-home level-closed' level='8'><div class='text-a'>8</div></div>");
            break;
        case 10:
            //execute code block 2
            $(".go-to-home").show();
            $(".go-to-home-container").html("<div class='check levelA-home level-open active' level='4'><div class='text-a'>4</div></div><div class='check levelB-home level-closed' level='8'><div class='text-a'>8</div></div><div class='check levelC-home level-closed' level='10'><div class='text-a'>10</div></div>");
            break;
        case 12:
            //execute code block 2
            $(".go-to-home").show();
            $(".go-to-home-container").html("<div class='check levelA-home level-open active' level='4'><div class='text-a'>4</div></div><div class='check levelB-home level-closed' level='8'><div class='text-a'>8</div></div><div class='check levelC-home level-closed' level='12'><div class='text-a'>12</div></div>");
            break;
        case 14:
            //execute code block 2
            $(".go-to-home").show();
            $(".go-to-home-container").html("<div class='check levelA-home level-open active' level='4'><div class='text-a'>4</div></div><div class='check levelB-home level-closed' level='8'><div class='text-a'>8</div></div><div class='check levelC-home level-closed' level='14'><div class='text-a'>14</div></div>");
            break;
        case 16:
            //execute code block 2
            $(".go-to-home").show();
            $(".go-to-home-container").html("<div class='check levelA-home level-open active' level='4'><div class='text-a'>4</div></div><div class='check levelB-home level-closed' level='8'><div class='text-a'>8</div></div><div class='check levelC-home level-closed' level='16'><div class='text-a'>16</div></div>");
            break;
        case 18:
            //execute code block 2
            $(".go-to-home").show();
            $(".go-to-home-container").html("<div class='check levelA-home level-open active' level='4'><div class='text-a'>4</div></div><div class='check levelB-home level-closed' level='8'><div class='text-a'>8</div></div><div class='check levelC-home level-closed' level='18'><div class='text-a'>18</div></div>");
            break;
        default:
        // code to be executed if n is different from case 1 and 2
    }
    $(".drop-aria").click(function () {
        $(".go-to-home-container").removeClass("animated pulse").fadeOut();
        $(".go-to-home").removeClass("active");
    });
    GetAPI(window);
    if (API != null) {
        if (API.Initialize("")) {
            LMSStatus = true;
            API.SetValue("cmi.score.min", 0);//to set min score in the game
            API.SetValue("cmi.score.max", 100);//to set max score in the game
        }
    }
    $('body').manhalLoader({
        splashID: "#jSplash",
        splashVPos: '50%',
        loaderVPos: '90%',
        splashFunction: function () {
            resizeGame();
            setTimeout(function () {
                $(".start-button").addClass("rollIn animated").fadeIn();
                setTimeout(function () {
                    $(".image-start").addClass("fadeIn animated").fadeIn();
                }, 250);
            }, 550);
            // BackgroundSound("sound/win.mp3")
            $('<div class="manhal-main-loader"><div class="loader-effect"><div class="checkmark draw"></div>' +
                '</div><div class="logo-loader"></div></div>').appendTo('#manhalpreOverlay');
        },
        onLoading: function (per) {
        },
    }, function () {
        $("#manhalpreOverlay").fadeOut("fast");
    });
    $(".start-button").click(function () {
        soundEffect("sound/addnote.mp3", "", "");
        $(".start-screen-container").hide();
        $(".drop-aria-container").fadeIn();
        resizeGame();
        $(".start-button").removeClass("rollIn animated").hide();
        $(".image-start").removeClass("fadeIn animated").hide();


        $("body").css("pointer-events", "none");
        setTimeout(function () {
            $(".go-to-home").click();
            $(".go-to-home-container .active").addClass("animated jello");
            setTimeout(function () {
                $(".levelA").click();
                $("body").css("pointer-events", "auto");
                $(".opacity-layer").addClass("animated rollOut");
                setTimeout(function () {
                    $(".opacity-layer").hide();
                }, 1300);
                $(".go-to-home-container .active").removeClass("animated jello");
            }, 1000);
        }, 500);

    });

    $(".start-button,.go-to-home,.levelC-home,.levelB-home,.levelA-home").mouseover(function () {
        $(this).removeClass("rollIn");
        $(this).addClass("animated jello ")
    });
    $(".start-button,.go-to-home,.levelC-home,.levelB-home,.levelA-home").mouseleave(function () {
        $(this).removeClass("animated jello")
    });
    $(".levelA,.levelB,.levelC").mouseover(function () {
        // $(this).removeClass("rollIn")
        $(this).addClass("animated pulse")
    });
    $(".levelA,.levelB,.levelC,.levelC-home,.levelB-home,.levelA-home").mouseleave(function () {
        $(this).removeClass("animated pulse")
    });
    $(".go-to-home").click(function () {
        if (!$(this).hasClass("active")) {
            $(".go-to-home-container").addClass("animated pulse").fadeIn();
            $(this).addClass("active");
        }
        else {
            $(".go-to-home-container").removeClass("animated pulse").fadeOut();
            $(this).removeClass("active")
        }
    });
    $(document).on("click", ".levelA-home", function () {
        $(this).addClass("active");
        $(".levelB-home").removeClass("active");
        $(".levelC-home").removeClass("active");

        replyGame1();
        $(".levelA").click();
        $(".go-to-home-container").removeClass("animated pulse").fadeOut();
        $(".go-to-home").removeClass("active");
    });
    $(document).on("click", ".levelA", function () {
        setTimeout(function () {
            timerInstance.start();
            timerInstance.addEventListener('secondsUpdated', function (e) {
                $('.Timer span').html(timerInstance.getTimeValues().minutes.toString() + ":" + timerInstance.getTimeValues().seconds.toString());
            });
        }, 300);
        $(".num-of-tries span").html("0");
        $(".num-of-score span").html("0");
        soundEffect("sound/addnote.mp3", "", "");
        $(".secound-screen-container").hide();
        $(".drop-aria-container").fadeIn();
        drowitemslevelA($(".levelA-home").attr("level"));

        resizeGame();
        setTimeout(function () {
            $(".flip-box").addClass("bounceInUp animated").fadeIn();
            setTimeout(function () {
                $(".flip-box").removeClass("bounceInUp animated").fadeIn();
            }, 600);
        }, 50);

        FlipBoxPress();
        x = -1;
        y = -1;
        var correct = 0;
        var incorrect = 0;
        setTimeout(function () {
            $(".qustion-title").addClass("fadeIn animated").fadeIn();
        }, 250);
    });


    $(document).on("click", ".levelB-home", function () {
        $(this).addClass("active");
        $(".levelA-home").removeClass("active");
        $(".levelC-home").removeClass("active");
        replyGame1();
        $(".levelB").click();
        $(".go-to-home-container").removeClass("animated pulse").fadeOut();
        $(".go-to-home").removeClass("active");
    });
    $(document).on("click", ".levelB", function () {
        setTimeout(function () {
            timerInstance.start();
            timerInstance.addEventListener('secondsUpdated', function (e) {
                $('.Timer span').html(timerInstance.getTimeValues().minutes.toString() + ":" + timerInstance.getTimeValues().seconds.toString());
            });
        }, 300);
        $(".num-of-tries span").html("0");
        $(".num-of-score span").html("0");
        soundEffect("sound/addnote.mp3", "", "");
        $(".secound-screen-container").hide();
        $(".drop-aria-container").fadeIn();
        drowitemslevelA($(".levelB-home").attr("level"));
        resizeGame();
        setTimeout(function () {
            $(".flip-box").addClass("bounceInUp animated").fadeIn();
            setTimeout(function () {
                $(".flip-box").removeClass("bounceInUp animated").fadeIn();
            }, 600);
        }, 50);

        FlipBoxPress();
        x = -1;
        y = -1;
        var correct = 0;
        var incorrect = 0;
        setTimeout(function () {
            $(".qustion-title").addClass("fadeIn animated").fadeIn();
        }, 250);
    });


    $(document).on("click", ".levelC-home", function () {
        $(this).addClass("active");
        $(".levelA-home").removeClass("active");
        $(".levelB-home").removeClass("active");
        replyGame1();
        $(".levelC").click();
        $(".go-to-home-container").removeClass("animated pulse").fadeOut();
        $(".go-to-home").removeClass("active");
    });
    $(document).on("click", ".levelC", function () {
        setTimeout(function () {
            timerInstance.start();
            timerInstance.addEventListener('secondsUpdated', function (e) {
                $('.Timer span').html(timerInstance.getTimeValues().minutes.toString() + ":" + timerInstance.getTimeValues().seconds.toString());
            });
        }, 300);
        $(".num-of-tries span").html("0");
        $(".num-of-score span").html("0");
        soundEffect("sound/addnote.mp3", "", "");
        $(".secound-screen-container").hide();
        $(".drop-aria-container").fadeIn();
        drowitemslevelA($(".levelC-home").attr("level"));
        resizeGame();
        setTimeout(function () {
            $(".flip-box").addClass("bounceInUp animated").fadeIn();
            setTimeout(function () {
                $(".flip-box").removeClass("bounceInUp animated").fadeIn();
            }, 600);
        }, 50);

        FlipBoxPress();
        x = -1;
        y = -1;
        var correct = 0;
        var incorrect = 0;
        setTimeout(function () {
            $(".qustion-title").addClass("fadeIn animated").fadeIn();
        }, 250);
    });
});


x = -1;
y = -1;
var correct = 0;
var incorrect = 0;
var lengthA = 0;
var score = 0;

function dd() {
    setInterval(function () {
        var TimetakenSeconds = timerInstance.getTimeValues().seconds.toString();
        var TimetakenMinutes = timerInstance.getTimeValues().minutes.toString();
        if ($(".drop-aria").hasClass("items-4") || $(".drop-aria").hasClass("items-6")) {
            if (TimetakenSeconds <= 5 && TimetakenSeconds > 0) {
                percentage1 = "100%";
                clearInterval(inter);
            }
            else if (TimetakenSeconds <= 10 && TimetakenSeconds >= 6) {
                percentage1 = "80%";
                $(".red span").addClass("case1");
                $(".stars-container .star:nth-child(1)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(1)").addClass("animated zoomIn");
                }, 300);
                clearInterval(inter);
            }
            else if (TimetakenSeconds <= 15 && TimetakenSeconds >= 11) {
                percentage1 = "60%";
                $(".red span").removeClass("case1");
                $(".red span").addClass("case2");
                $(".stars-container .star:nth-child(1)").addClass("active");
                $(".stars-container .star:nth-child(2)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(2)").addClass("animated zoomIn");
                }, 300);
                clearInterval(inter);
            }
            else if (TimetakenSeconds <= 20 && TimetakenSeconds >= 16) {
                percentage1 = "40%";
                $(".red span").removeClass("case2");
                $(".red span").addClass("case3");
                $(".stars-container .star:nth-child(1)").addClass("active");
                $(".stars-container .star:nth-child(2)").addClass("active");
                $(".stars-container .star:nth-child(3)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(3)").addClass("animated zoomIn");
                }, 300);
                clearInterval(inter);
            }
            else if (TimetakenSeconds <= 25 && TimetakenSeconds >= 21) {
                percentage1 = "20%";
                $(".red span").removeClass("case3");
                $(".red span").addClass("case4");
                $(".stars-container .star:nth-child(1)").addClass("active");
                $(".stars-container .star:nth-child(2)").addClass("active");
                $(".stars-container .star:nth-child(3)").addClass("active");
                $(".stars-container .star:nth-child(4)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(4)").addClass("animated zoomIn");
                }, 300);
                clearInterval(inter);
            }
            else if (TimetakenSeconds <= 30 && TimetakenSeconds >= 26 && $(".red span").hasClass("case4")) {
                timerInstance.stop();
                percentage1 = "0%";
                $(".red span").removeClass("case4");
                $(".red span").addClass("case5");
                $(".stars-container .star:nth-child(1)").addClass("active");
                $(".stars-container .star:nth-child(2)").addClass("active");
                $(".stars-container .star:nth-child(3)").addClass("active");
                $(".stars-container .star:nth-child(4)").addClass("active");
                $(".stars-container .star:nth-child(5)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(5)").addClass("animated zoomIn");
                }, 300);
                $("#feedback").addClass("notime");
                $("#message-icone").addClass("notime-icon");
                setTimeout(function () {
                    soundEffect("sound/2wrong.mp3", "", "");
                }, 1500);
                Result = 'failed';
                setTimeout(function () {
                    $(".result-container,.result-text").css("display", "none");
                    $(".main-message-container").fadeIn();
                }, 1000);
                clearInterval(inter);
            }
            TimetakenSeconds = 0;
            TimetakenMinutes = 0;
        }
        if ($(".drop-aria").hasClass("items-8") || $(".drop-aria").hasClass("items-10") || $(".drop-aria").hasClass("items-12")) {
            if (TimetakenSeconds <= 10) {
                console.log("oday1")
                percentage1 = "100%";
                clearInterval(inter);
            }
            else if (TimetakenSeconds <= 20 && TimetakenSeconds >= 11) {
                console.log("<= 10")
                percentage1 = "80%";
                $(".red span").addClass("case1");
                $(".stars-container .star:nth-child(1)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(1)").addClass("animated zoomIn");
                    $(".transparency-container").fadeOut();
                }, 300);
                clearInterval(inter);
            }
            else if (TimetakenSeconds <= 30 && TimetakenSeconds >= 21) {
                console.log("21-30")
                percentage1 = "60%";
                $(".red span").removeClass("case1");
                $(".red span").addClass("case2");
                $(".stars-container .star:nth-child(1)").addClass("active");
                $(".stars-container .star:nth-child(2)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(2)").addClass("animated zoomIn");
                    $(".transparency-container").fadeOut();
                }, 300);
                clearInterval(inter);
            }
            else if (TimetakenSeconds <= 40 && TimetakenSeconds >= 31) {
                console.log("31-40");
                percentage1 = "40%";
                $(".red span").removeClass("case2");
                $(".red span").addClass("case3");
                $(".stars-container .star:nth-child(1)").addClass("active");
                $(".stars-container .star:nth-child(2)").addClass("active");
                $(".stars-container .star:nth-child(3)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(3)").addClass("animated zoomIn");
                    $(".transparency-container").fadeOut();
                }, 300);
                clearInterval(inter);
            }
            else if (TimetakenSeconds <= 50 && TimetakenSeconds >= 41) {
                console.log("41-50");
                percentage1 = "20%";
                $(".red span").removeClass("case3");
                $(".red span").addClass("case4");
                $(".stars-container .star:nth-child(1)").addClass("active");
                $(".stars-container .star:nth-child(2)").addClass("active");
                $(".stars-container .star:nth-child(3)").addClass("active");
                $(".stars-container .star:nth-child(4)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(4)").addClass("animated zoomIn");
                }, 300);
                clearInterval(inter);
            }
            else if (TimetakenSeconds <= 60 && TimetakenSeconds >= 51 && $(".red span").hasClass("case4")) {
                timerInstance.stop();
                percentage1 = "0%";
                $(".red span").removeClass("case4");
                $(".red span").addClass("case5");
                $(".stars-container .star:nth-child(1)").addClass("active");
                $(".stars-container .star:nth-child(2)").addClass("active");
                $(".stars-container .star:nth-child(3)").addClass("active");
                $(".stars-container .star:nth-child(4)").addClass("active");
                $(".stars-container .star:nth-child(5)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(5)").addClass("animated zoomIn");
                }, 300);
                $("#feedback").addClass("notime");
                $("#message-icone").addClass("notime-icon");
                setTimeout(function () {
                    soundEffect("sound/2wrong.mp3", "", "");
                }, 1500);
                Result = 'failed';
                setTimeout(function () {
                    $(".result-container,.result-text").css("display", "none");
                    $(".main-message-container").fadeIn();
                }, 1000);
                clearInterval(inter);
                console.log("else");
            }

            // TimetakenSeconds = 0;
            // TimetakenMinutes = 0;
            // $(".reload3").hide();
        }
        if ($(".drop-aria").hasClass("items-14") || $(".drop-aria").hasClass("items-16") || $(".drop-aria").hasClass("items-18")) {
            if (TimetakenSeconds <= 20 && TimetakenMinutes == 0) {
                // clearInterval(inter);
                percentage1 = "100%";
                // console.log(percentage1);
                // console.log(TimetakenMinutes + ":" + TimetakenSeconds);
            }
            else if (TimetakenSeconds <= 40 && TimetakenSeconds >= 21 && TimetakenMinutes == 0) {
                percentage1 = "80%";
                $(".red span").addClass("case1");
                $(".stars-container .star:nth-child(1)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(1)").addClass("animated zoomIn");
                }, 300);
                clearInterval(inter);
                // console.log(percentage1);
                // console.log(TimetakenMinutes + ":" + TimetakenSeconds);
            }
            else if (TimetakenSeconds <= 60 && TimetakenSeconds >= 41 && TimetakenMinutes == 0) {
                percentage1 = "60%";
                $(".red span").removeClass("case1");
                $(".red span").addClass("case2");
                $(".stars-container .star:nth-child(1)").addClass("active");
                $(".stars-container .star:nth-child(2)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(2)").addClass("animated zoomIn");
                }, 300);
                clearInterval(inter);
                // console.log(percentage1);
                // console.log(TimetakenMinutes + ":" + TimetakenSeconds);
            }
            else if (TimetakenMinutes >= 1 && TimetakenSeconds <= 20) {
                percentage1 = "40%";
                $(".red span").removeClass("case2");
                $(".red span").addClass("case3");
                $(".stars-container .star:nth-child(1)").addClass("active");
                $(".stars-container .star:nth-child(2)").addClass("active");
                $(".stars-container .star:nth-child(3)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(3)").addClass("animated zoomIn");
                }, 300);
                clearInterval(inter);
                // console.log(percentage1);
                // console.log(TimetakenMinutes + ":" + TimetakenSeconds);
            }
            else if (TimetakenMinutes == 1 && TimetakenSeconds <= 40 && TimetakenSeconds >= 21) {
                percentage1 = "20%";
                $(".red span").removeClass("case3");
                $(".red span").addClass("case4");
                $(".stars-container .star:nth-child(1)").addClass("active");
                $(".stars-container .star:nth-child(2)").addClass("active");
                $(".stars-container .star:nth-child(3)").addClass("active");
                $(".stars-container .star:nth-child(4)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(4)").addClass("animated zoomIn");
                }, 300);
                clearInterval(inter);
                // console.log(percentage1);
                // console.log(TimetakenMinutes + ":" + TimetakenSeconds);
            }
            else if (TimetakenMinutes == 1 && TimetakenSeconds == 59 && TimetakenSeconds > 58 && $(".red span").hasClass("case4")) {
                timerInstance.stop();
                percentage1 = "0%";
                $(".red span").removeClass("case4");
                $(".red span").addClass("case5");
                $(".stars-container .star:nth-child(1)").addClass("active");
                $(".stars-container .star:nth-child(2)").addClass("active");
                $(".stars-container .star:nth-child(3)").addClass("active");
                $(".stars-container .star:nth-child(4)").addClass("active");
                $(".stars-container .star:nth-child(5)").addClass("active");
                setTimeout(function () {
                    $(".stars-container .star:nth-child(5)").addClass("animated zoomIn");
                }, 300);
                $("#feedback").addClass("notime");
                $("#message-icone").addClass("notime-icon");
                setTimeout(function () {
                    soundEffect("sound/2wrong.mp3", "", "");
                }, 1500);
                Result = 'failed';
                setTimeout(function () {
                    $(".result-container,.result-text").css("display", "none");
                    $(".main-message-container").fadeIn();
                }, 1000);
                clearInterval(inter);
                // console.log(percentage1);
                // console.log(TimetakenMinutes + ":" + TimetakenSeconds);
            }
            // TimetakenSeconds=0;
            // TimetakenMinutes=0;
        }
    });
    clearInterval(inter);
}

function FlipBoxPress() {
    x = -1;
    y = -1;
    var correct = 0;
    var incorrect = 0;
    $(".flip-box").click(function () {
        $(this).addClass("flip");
        var sound = $(this).attr("sound");
        soundEffect("sound/menu5.mp3");
        $(this).css("pointerEvents", "none");
        if (x == -1) {
            xid = $(this).attr("id");
            x = $(this).attr("att");
            soundEffect(sound);
        }
        else {
            yid = $(this).attr("id");
            y = $(this).attr("att");
        }
        if (x != -1 && y != -1) {
            if (x != y) {
                $(".flip-box").css("pointerEvents", "none");
                $("#" + xid).css("pointerEvents", "none");
                $("#" + yid).css("pointerEvents", "none");
                setTimeout(function () {
                    $("#" + xid).removeClass("flip");
                    $("#" + yid).removeClass("flip");
                    setTimeout(function () {
                        $("#" + xid).css("pointerEvents", "auto");
                        $("#" + yid).css("pointerEvents", "auto");
                        $(".flip-box").css("pointerEvents", "auto");
                    }, 50);
                }, 700);
                incorrect++;
                if (score > 0) {
                    score -= 10;
                }
                soundEffect("sound/2wrong.mp3", "", "");
                x = -1;
                y = -1;
            }
            else {
                setTimeout(function () {
                    $("#" + xid).addClass("noevent");
                    $("#" + yid).addClass("noevent");
                },10)

                correct++;
                score += 20;
                soundEffect("sound/correct.mp3", sound);
                $("#" + xid).css("pointerEvents", "none");
                $("#" + yid).css("pointerEvents", "none");



                var gamelevelcount = $(".go-to-home-container .check").length;
                var activelevel = $(".level-open").attr("level");
                var nextlevel = $(".level-open").next().attr("level");

                console.log("gamelevelcount: " + gamelevelcount);
                console.log("activelevel: " + activelevel);
                console.log("nextlevel: " + nextlevel);
                if (correct == lengthA) {
                    $(".again-container").fadeIn();
                    timerInstance.stop();
                    percentage = percentage1.replace("%", "");
                    //scorm befor show result
                    clearInterval(SetTimerScorm);
                    SetTimerScorm = null;
                    Result = 'unknown';

                    $("#feedback").attr("class", "");
                    $("#message-icone").attr("class", "");
                    $(".result-container span").html(percentage+"%");
                    $(".result-container,.result-text").hide();




                    switch (gamelevelcount) {
                        case 1:
                            setTimeout(function () {
                                $(".reload3").hide();
                                $(".reload").show();
                            }, 500)
                            result1=percentage1;
                            // alert("result1="+result1);
                            result1 = result1.replace("%", "");
                            setTimeout(function () {
                                $(".main-message-container").show();
                                $(".result-text,.result-container").show();
                            }, 1000);

                            break;
                        case 2:
                            if ($(".levelA-home").hasClass("active")) {
                                result1=percentage1;
                                result1 = result1.replace("%", "");
                                $(".reload3").show();
                                $(".reload").hide();
                                // alert("activelevelA");
                                // alert("nextactivelevelB");
                                $(".levelB-home").removeClass("level-closed");
                                $(".reload3").click(function () {
                                    $(".main-message-container").hide();
                                    $("body").css("pointer-events", "none");
                                    setTimeout(function () {
                                        $(".go-to-home").click();
                                        $(".levelB-home").addClass("animated jello");
                                        $(".opacity-layer").removeClass("animated rollOut").show();

                                        setTimeout(function () {
                                            $(".levelB-home").click();
                                            $("body").css("pointer-events", "auto");
                                            $(".opacity-layer").addClass("animated rollOut");
                                            setTimeout(function () {
                                                $(".opacity-layer").hide();
                                            }, 1500);
                                            $(".levelB-home").removeClass("animated jello");
                                        }, 1200);
                                    }, 600);
                                });
                                setTimeout(function () {
                                    $(".main-message-container").show();
                                    $(".result-text,.result-container").hide();
                                }, 1000);
                            }
                            else if ($(".levelB-home").hasClass("active")) {
                                setTimeout(function () {
                                    result2=$(".result-container span").html();
                                    result2 = result2.replace("%", "");
                                    percentage=(parseInt(result1)+parseInt(result2))/2;
                                    var after= Math.round(percentage * 100) / 100;
                                    $(".result-container span").html(after+"%");

                                    $(".reload3,.reload").hide();
                                    $(".reload-notime").show();
                                }, 1000);
                                // alert("activelevelB");
                                // alert("nextactivelevelA");
                                $(".levelB-home").addClass("level-closed");
                                $(".reload-notime").click(function () {
                                    $(".main-message-container").hide();
                                    $("body").css("pointer-events", "none");
                                    setTimeout(function () {
                                        $(".go-to-home").click();
                                        $(".levelA-home").addClass("animated jello");
                                        $(".opacity-layer").removeClass("animated rollOut").show();

                                        // setTimeout(function () {
                                        // },1300);

                                        setTimeout(function () {
                                            $(".levelA-home").click();
                                            $("body").css("pointer-events", "auto");
                                            $(".opacity-layer").addClass("animated rollOut");
                                            setTimeout(function () {
                                                $(".opacity-layer").hide();
                                            }, 1500);
                                            $(".levelA-home").removeClass("animated jello");
                                        }, 1200);
                                    }, 600);
                                });
                                setTimeout(function () {
                                    $(".main-message-container").show();
                                    $(".result-text,.result-container").show();
                                }, 1000);
                            }
                            break;
                        case 3:
                            // alert("case 3_New");
                            if ($(".levelA-home").hasClass("active")) {
                                result1=percentage1;
                                result1 = result1.replace("%", "");
                                $(".reload3").show();
                                $(".reload").hide();
                                $(".levelB-home").removeClass("level-closed");
                                $(".reload3").click(function () {
                                    $(".main-message-container").hide();
                                    $("body").css("pointer-events", "none");
                                    setTimeout(function () {
                                        $(".go-to-home").click();
                                        $(".levelB-home").addClass("animated jello");
                                        $(".opacity-layer").removeClass("animated rollOut").show();

                                        setTimeout(function () {
                                            $(".levelB-home").click();
                                            $("body").css("pointer-events", "auto");
                                            $(".opacity-layer").addClass("animated rollOut");
                                            setTimeout(function () {
                                                $(".opacity-layer").hide();
                                            }, 1500);
                                            $(".levelB-home").removeClass("animated jello");
                                        }, 1200);
                                    }, 600);
                                });
                                setTimeout(function () {
                                    $(".main-message-container").show();
                                    $(".result-text,.result-container").hide();
                                }, 1000);
                            }
                            else if ($(".levelB-home").hasClass("active")) {
                                result2=percentage1;
                                result2 = result2.replace("%", "");
                                $(".reload3").show();
                                $(".reload").hide();
                                $(".levelC-home").removeClass("level-closed");
                                $(".reload3").click(function () {
                                    $(".main-message-container").hide();
                                    $("body").css("pointer-events", "none");
                                    setTimeout(function () {
                                        $(".go-to-home").click();
                                        $(".levelB-home").removeClass("animated jello");
                                        $(".levelC-home").addClass("animated jello");
                                        $(".opacity-layer").removeClass("animated rollOut").show();
                                        setTimeout(function () {
                                            $(".levelC-home").click();
                                            $("body").css("pointer-events", "auto");
                                            $(".opacity-layer").addClass("animated rollOut");
                                            setTimeout(function () {
                                                $(".opacity-layer").hide();
                                            }, 1500);
                                            $(".levelC-home").removeClass("animated jello");
                                        }, 1200);
                                    }, 600);
                                });
                                setTimeout(function () {
                                    $(".main-message-container").show();
                                    $(".result-text,.result-container").hide();
                                }, 1000);
                            }
                            else if ($(".levelC-home").hasClass("active")) {
                                setTimeout(function () {
                                    result3=$(".result-container span").html();
                                    result3 = result3.replace("%", "");
                                    percentage=(parseInt(result1)+parseInt(result2)+parseInt(result3))/3;

                                    var after= Math.round(percentage * 100) / 100;
                                    $(".result-container span").html(after+"%");
                                    // $(".result-container,.result-text").show();
                                    $(".reload3,.reload").hide();
                                    $(".reload-notime").show();
                                }, 1000);
                                $(".levelB-home").addClass("level-closed");
                                $(".reload-notime").click(function () {
                                    $(".levelC-home").addClass("level-closed");
                                    $(".main-message-container").hide();
                                    $("body").css("pointer-events", "none");
                                    setTimeout(function () {
                                        $(".go-to-home").click();
                                        $(".levelA-home").addClass("animated jello");
                                        $(".opacity-layer").removeClass("animated rollOut").show();
                                        // setTimeout(function () {
                                        //
                                        // },1300);
                                        setTimeout(function () {
                                            $(".levelA-home").click();
                                            $("body").css("pointer-events", "auto");
                                            $(".opacity-layer").addClass("animated rollOut");
                                            setTimeout(function () {
                                                $(".opacity-layer").hide();
                                            }, 1500);
                                            $(".levelA-home").removeClass("animated jello");
                                        }, 1200);
                                    }, 600);
                                });
                                setTimeout(function () {
                                    $(".main-message-container").show();
                                    $(".result-text,.result-container").show();
                                }, 1000);
                            }
                            break;
                        default:
                    }

                    if (percentage <= 100 && percentage >= 81) {
                        $(".result-container,.result-text").fadeIn();
                        $("#feedback").addClass("greate");
                        $("#message-icone").addClass("greate-icon");
                        setTimeout(function () {
                            soundEffect("sound/correct.mp3", "", "");
                        }, 1500);
                        Result = 'passed';


                    } else if (percentage <= 80 && percentage >= 61) {
                        $(".reload3").fadeIn();
                        $(".reload").fadeOut();

                        $(".result-container,.result-text").fadeIn();
                        $("#feedback").addClass("wellDonw");
                        $("#message-icone").addClass("wellDonw-icon");
                        setTimeout(function () {
                            soundEffect("sound/correct.mp3", "", "");
                        }, 1500);
                        Result = 'passed';
                        setTimeout(function () {
                            $(".main-message-container").fadeIn();
                        }, 1000);
                    }
                    else if (percentage <= 60 && percentage >= 41) {
                        $(".reload3").fadeIn();
                        $(".reload").fadeOut();
                        $(".result-container,.result-text").fadeIn();
                        $("#feedback").addClass("good");
                        $("#message-icone").addClass("good-icon");
                        setTimeout(function () {
                            soundEffect("sound/correct.mp3", "", "");
                        }, 1000);
                        Result = 'passed';

                    }
                    else if (percentage <= 40 && percentage >= 21) {
                        $(".reload3").fadeIn();
                        $(".reload").fadeOut();
                        $(".result-container,.result-text").fadeIn();
                        $("#feedback").addClass("good");
                        $("#message-icone").addClass("tryAgain-icon-1");
                        setTimeout(function () {
                            soundEffect("sound/correct.mp3", "", "");
                        }, 1000);
                        Result = 'passed';

                    }
                    else if (percentage <= 20 && percentage > 0) {

                        $(".result-container,.result-text").fadeIn();
                        $("#feedback").addClass("tryAgain");
                        $("#message-icone").addClass("tryAgain-icon");
                        setTimeout(function () {
                            soundEffect("sound/2wrong.mp3", "", "");
                        }, 1000);
                        Result = 'failed';
                        $(".reload3").hide();
                        $(".reload").show();

                    }
                    else if (percentage = 0) {
                        $("#feedback").addClass("notime");
                        $(".result-container,.result-text").fadeOut();
                        $("#message-icone").attr("class", "");
                        setTimeout(function () {
                            soundEffect("sound/2wrong.mp3", "", "");
                        }, 1500);
                        Result = 'failed';
                        $(".reload3").hide();
                        $(".reload").show();

                    }
                    if (LMSStatus) {
                        API.SetValue("cmi.score.raw", parseFloat(percentage).toFixed(2));//return text true or false | to set student mark
                        API.SetValue("cmi.completion_status", "completed");//when complete game
                        API.SetValue("cmi.success_status", Result);//when complete game set value to one of ("passed","failed","unknown")
                        API.SetValue("cmi.session_time", TimeScorm);//to set Amount of seconds that the learner has spent
                        API.Commit("");//return text true or false | to save student mark to DB
                    }
                    TimeScorm = 0;
                }
                x = -1;
                y = -1;
            }
            $(".num-of-tries span").html(correct + incorrect);
            $(".num-of-score span").html(score);
        }
    });
}


$(window).on("orientationchange", function (event) {
    resizeGame();
});

function generateRandomIndexes(size, sizeResult) {
    var exists = [],
        randomNumber;
    var list = [];
    for (var l = 0; l < size; l++) {
        do {
            randomNumber = Math.floor(Math.random() * size);
        } while (exists[randomNumber]);
        exists[randomNumber] = true;
        list.push(randomNumber)
    }
    var result = []
    for (var l = 0; l < sizeResult; l++) {
        result.push(list[l])
    }
    // alert(result)
    return result
}

var lengthA = 0;

function drowitemslevelA(Cardcount) {
    $(".drop-aria").html("");
    var flip = "";
    var randomeIndexArr = generateRandomIndexes(flipGameA1.length, Cardcount / 2);
    var createListArrayofA = []
    var createListArrayofB = []


    for (i = 0; i < randomeIndexArr.length; i++) {

        var tareget = randomeIndexArr[i]

        var eleme=flipGameA1[tareget]
        eleme.answer=""
        createListArrayofA.push(flipGameA1[tareget])

        for (j = 0; j < flipGameA2.length; j++) {

            if(flipGameA1[tareget].linkWith === flipGameA2[j].identifire){

                var elemb=flipGameA2[j]
                elemb.answer=flipGameA1[tareget].linkWith

                eleme.answer=flipGameA1[tareget].linkWith
                createListArrayofB.push(flipGameA2[j])
            }

        }


    }

    // console.log("=======")
    // console.log(createListArrayofA)
    // console.log(createListArrayofB)


    var FinalArray = createListArrayofA.concat(createListArrayofB)// merge tow array
    randomitem = shuffleArray(FinalArray);


    $(".drop-aria").removeClass();
    $("#drop-aria").addClass("items-" + Cardcount + " drop-aria");

    for (i = 0; i < randomitem.length; i++) {
        flip = '<div sound="' + randomitem[i].sound + '" class="flip-box" ' +
            'style="display:none" id="flip-box' + i + '" att="' + randomitem[i].answer + '">' +
            '<div class="flip-box-inner"><div class="flip-box-front"> ' +
            ' </div><div class="flip-box-back" ' +
            'style="background:url(' + randomitem[i].background + ')">' +
            '</div></div>'
        $(flip).appendTo(".drop-aria");
    }


    $(".red").html('<label style="width:100%"><span></span></label>');
    $(".stars-container").html('<div class="star"></div> <div class="star"></div> <div class="star"></div> <div class="star"></div><div class="star"></div>');
    lengthA = Cardcount / 2;
}


function replyGame() {
    levelcounter = 0
    $(".red label span").removeClass("case1,case2,case3,case4,case5").css("width", "100%");
    $(".stars-container .star:nth-child(1)").removeClass("active");
    $(".stars-container .star:nth-child(2)").removeClass("active");
    $(".stars-container .star:nth-child(3)").removeClass("active");
    $(".stars-container .star:nth-child(4)").removeClass("active");
    if ($(".drop-aria").hasClass("items-4") || $(".drop-aria").hasClass("items-6")) {
        $(".main-message-container").hide();
        $("#feedback").attr("class", "");
        $("#message-icone").attr("class", "");
        Result = "unknown";
        score = 0;
        timerInstance.reset();
        $(".levelA").click();
        $(".levelA").click();
        timerInstance.reset();
    }
    else if ($(".drop-aria").hasClass("items-8") || $(".drop-aria").hasClass("items-10") || $(".drop-aria").hasClass("items-14")) {
        $(".main-message-container").hide();
        $("#feedback").attr("class", "");
        $("#message-icone").attr("class", "");
        Result = "unknown";
        score = 0;
        timerInstance.reset();
        $(".levelB").click();
        timerInstance.reset();
    }
    else if ($(".drop-aria").hasClass("items-14") || $(".drop-aria").hasClass("items-16") || $(".drop-aria").hasClass("items-18")) {
        $(".main-message-container").hide();
        $("#feedback").attr("class", "");
        $("#message-icone").attr("class", "");
        Result = "unknown";
        score = 0;
        timerInstance.reset();
        $(".levelC").click();
        timerInstance.reset();
    }
}

function replyGame1() {
    levelcounter = 0
    $(".stars-container .star:nth-child(1)").removeClass("active");
    $(".stars-container .star:nth-child(2)").removeClass("active");
    $(".stars-container .star:nth-child(3)").removeClass("active");
    $(".stars-container .star:nth-child(4)").removeClass("active");
    $(".main-message-container").hide();
    $("#feedback").attr("class", "");
    $("#message-icone").attr("class", "");
    Result = "unknown";
    score = 0;
    timerInstance.reset();
    $(".red label span").removeClass("case1,case2,case3,case4,case5").css("width", "100%");
}

$(window).resize(function () {
    resizeGame();
});

function randomarray(Length) {
    var shuffle_Array = [];
    for ($ray = 0; $ray < Length; $ray++) {
        shuffle_Array.push($ray);
    }
    return shuffleArray(shuffle_Array);
}

function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}

function resizeGame() {
    var gameArea = document.getElementById('gameConainer');
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
    var gameCanvas = document.getElementById('inner-gameContainer');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
}

function soundEffect(src1, src2, src3) {

    var sound = new Howl({
        src: [src1, src2, src3],
        autoplay: true,
        loop: false,
        volume: 0.5,
        onend: function () {
            if (src2 != "") {
                if (src3 != "") {
                    soundEffect(src2, src3, "");
                } else {
                    soundEffect(src2, "", "");
                }
            }
        }
    });
    // $(".SoundEffect").prop("loop", false);
}

function BackgroundSound(src) {

    if ($('.BackgroundSound').length)
        $('.BackgroundSound').remove();
    $("<audio class='BackgroundSound'></audio>").attr({
        'src': src,
        'autoplay': 'autoplay'
    }).appendTo("body");
    $(".BackgroundSound").prop("loop", false);
    $(".BackgroundSound").prop("volume", 0.5);
    $('.BackgroundSound').on('ended', function () {
        $(this).trigger('play')
    })
}

function mobileDetect() {


    var agent = window.navigator.userAgent;
    var d = document;
    var e = d.documentElement;
    var g = d.getElementsByTagName('body')[0];
    var deviceWidth = window.innerWidth || e.clientWidth || g.clientWidth;

// Chrome
    IsChromeApp = window.chrome && chrome.app && chrome.app.runtime;

// iPhone
    IsIPhone = agent.match(/iPhone/i) != null;

// iPad up to IOS12
    IsIPad = (agent.match(/iPad/i) != null) || ((agent.match(/iPhone/i) != null) && (deviceWidth > 750)); // iPadPro when run with no launch screen can have error in userAgent reporting as an iPhone rather than an iPad. iPadPro width portrait 768, iPhone6 plus 414x736 but would probably always report 414 on app startup

    if (IsIPad) IsIPhone = false;

// iPad from IOS13
    var macApp = agent.match(/Macintosh/i) != null;
    if (macApp) {
        // need to distinguish between Macbook and iPad
        var canvas = document.createElement("canvas");
        if (canvas != null) {
            var context = canvas.getContext("webgl") || canvas.getContext("experimental-webgl");
            if (context) {
                var info = context.getExtension("WEBGL_debug_renderer_info");
                if (info) {
                    var renderer = context.getParameter(info.UNMASKED_RENDERER_WEBGL);
                    if (renderer.indexOf("Apple") != -1) IsIPad = true;
                }
                ;
            }
            ;
        }
        ;
    }
    ;

// IOS
    IsIOSApp = IsIPad || IsIPhone;


// Android


    IsAndroid = agent.match(/Android/i) != null;
    IsAndroidPhone = IsAndroid && deviceWidth <= 960;
    IsAndroidTablet = IsAndroid && !IsAndroidPhone;


    message = ""


    if (IsIPhone) {


        message = "Device is IsIPhone"


    }
    else if (IsIPad) {

        message = "Device is ipad"

    } else if (IsAndroidTablet || IsAndroidPhone || IsAndroid) {

        message = "Device is Android"


    } else {

        message = "Device is Mac ||  Windows Desktop"

    }

    var mac = /(Mac|iPhone|iPod|iPad)/i.test(navigator.platform);

    return {

        message: message,
        isMac: mac,

        isTrue: IsIOSApp || IsAndroid || IsAndroidTablet || IsAndroidPhone

    }
}