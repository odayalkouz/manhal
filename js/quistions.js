/**
 * Created by khalid alomiri on 1/13/2016.
 */

function correct() {

    switch (arguments[0]) {
        case 1:
        case 2:
            if ($('input[name="question"]:checked').val() == 1) {
                swal(window.Lang['Correctanswer']);
            } else {
                swal(window.Lang['WrongAnswer']);
            }
            break;
        case 3:
            var sum = 0;
            var sign = 0;
            $('input[name="question"]').each(function () {
                sign += parseInt($(this).attr('value'));
            });
            $('input[name="question"]').each(function () {
                if (this.checked && $(this).attr('value') == 1) {
                    sum += parseInt($(this).attr('value'));
                } else if (this.checked && $(this).attr('value') == 0) {
                    sum -= 1;
                }
            });
            if (sign == sum) {
                swal(window.Lang['Correctanswer']);
            } else {
                swal(window.Lang['WrongAnswer']);
            }
            break;
        case 4:
            var correct = false;
            var answer = $('#answer').val();
            answer = $.trim(answer);
            while (answer.indexOf('  ') > -1) {
                var Rep = new RegExp('  ', 'g');
                answer = answer.replace(Rep, ' ');
            }
            $('#answer').val(answer)
            jQuery.each(arguments[1], function (index, item) {
                if (answer == item) {
                    correct = true;
                }
            });
            if (correct) {
                swal(window.Lang['Correctanswer']);
            } else {
                swal(window.Lang['WrongAnswer']);
            }
            break;
        case 5:

            if (checkAnswer()) {
                swal(window.Lang['Correctanswer']);
            } else {
                swal(window.Lang['WrongAnswer']);
            }

            break;
        case 6:
            if ($("#Question").attr("att") == 1) {
                swal(window.Lang['Correctanswer']);
            } else {
                swal(window.Lang['WrongAnswer']);
            }
            break;
        case 7:
            correct=true;
           var  ContainerMapchildren=$("#ContainerMap").children().length;
            for(var i=1;i<=$("#Question").children().length;i++){
                if($("#map_"+i).hasClass("red")==false){
                    correct=false;
                }
            }
            if (correct&&ContainerMapchildren <1) {
                swal(window.Lang['Correctanswer']);
            } else {
                swal(window.Lang['WrongAnswer']);
            }
            break;
        case 8:
            var correct = false;
            var answer = $('#answer').val();
            answer = $.trim(answer);
            while (answer.indexOf('  ') > -1) {
                var Rep = new RegExp('  ', 'g');
                answer = answer.replace(Rep, ' ');
            }

            $('#answer').text(answer)
            jQuery.each(arguments[1], function (index, item) {

                if (answer == item["A"]) {
                    correct = true;
                }
            });
            if (correct) {
                swal(window.Lang['Correctanswer']);
            } else {
                swal(window.Lang['WrongAnswer']);
            }
            break;
        case 9:
            var correct = true;
            $('#sortable li').each(function (n, v) {
                if ($(this).attr("sort") != new String(n + 1)) {
                    correct = false;
                }
            });
            if (correct) {
                swal(window.Lang['Correctanswer']);
            } else {
                swal(window.Lang['WrongAnswer']);
            }
            break;
    }

}
function viewImag() {
    $("#viewImage").attr('src', arguments[0]);
    $(".view-container").show();
    window.parent.$("#back_icon").show();
}
function viewVideo() {
    alert(youtube_getID(arguments[0]))

}
function youtube_getID(url) {
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    return (match && match[7].length == 11) ? match[7] : false;
}
function GenrateID() {
    var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
    var uniqid = randLetter + Date.now();
    return uniqid;
}
var soundObject = null;
var soundplay = false;
var iconOld = null;

function playsounds(sound, icon) {
    //play class=flaticon-start4
    //stop class=flaticon-stop48

    if (window.HTMLAudioElement && soundplay == false) {
        if (iconOld != null) {
            $("#" + iconOld).attr('class', 'flaticon-start4');
        }
        Stop(icon);

        soundObject = new Audio((sound + "?" + GenrateID()));
        soundObject.addEventListener('error', errorSound, false);
        soundObject.addEventListener('loadeddata', isAppLoaded, true);
        soundObject.addEventListener('ended', CompleteSound, false);
        soundObject.Icon = icon;

    } else if (soundplay == true) {
        $("#" + icon).attr('class', 'flaticon-start4');
        Stop(icon);
    }
}
function isAppLoaded(e) {
    soundObject.play();
    soundplay = true;
    $("#" + e.target.Icon).attr('class', 'flaticon-stop48')
    iconOld = e.target.Icon;
    soundObject.removeEventListener('loadeddata', isAppLoaded);
}
function errorSound(e) {
    soundObject = null;
}
function CompleteSound(e) {
    if (soundObject != null) {
        soundObject = null;
        soundplay = false;
        $("#" + e.target.Icon).attr('class', 'flaticon-start4');
        iconOld = null;
    }
}
function Stop(Icon) {
    if (soundObject != null) {
        $("#" + Icon).attr('class', 'flaticon-start4');
        soundObject.pause();
        soundObject.currentTime = 0;
        soundplay = false;
    }
}