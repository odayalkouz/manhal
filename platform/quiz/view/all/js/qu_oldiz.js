/**
 * Created by khalid on 09/10/2017.
 */
lang_ar = {
    "start": "ابدأ",
    "copyrights": "جميع الحقوق محفوظة لدار المنهل ناشرون ©",
    "fullscore": "العلامة الكاملة",
    "passingrate": "معدل النجاح",
    "passingscore": "علامة النجاح",
    "elapsed": "وقت الحل",
    "yourscore": "نتيجتك",
    "Takethequiz": "رجوع",
    "Takethequizagain": "أعد الاختبار",
    "Takethequizview": "استعرض الاختبار",
    "qustiontext": "الأسئلة",
    "Title": "العنوان:",
    "dragyouranswer": "اسحب الإجابة",
    "loading": "جاري التحميل ...."
};
lang_en = {
    "start": "Start",
    "copyrights": "All Rights Reserved for Dar Al-Manhal Publishers ©",
    "fullscore": "Full Score",
    "passingrate": "Pass Rate",
    "passingscore": "Passing Score",
    "elapsed": "Elapsed",
    "yourscore": "Your Score",
    "Takethequiz": "Back",
    "Takethequizagain": "Take the Quiz Again",
    "Takethequizview": "view the Quiz",
    "qustiontext": "Question(s)",
    "Title": "Title:",
    "dragyouranswer": "Drag your answer:",
    "loading": "Loading ......"
};
var userlogin = '';
function sendresult() {
    userlogin = $(".username").html();
    if (userlogin == '') {
        userlogin = 'guest'
    }

    $.ajax({
        url: "../../../ajax/editor.php?process=setresult",
        type: "POST",
        cache: false,
        dataType: 'html',
        data: {
            'id': quizid,
            "username": userlogin,
            "result": JSON.stringify(AjaxResult),
            "quiz_time": $("#timerCount").html(),
            "quiz_q_result": (correctsum + "/" + quiz_data.question.fullscore)
        },
        success: function (html) {
        }
    });
}
$(document).on("change","select.text-box",function() {

    // console.log('#B'+$(this).attr('q')+"_"+$(this).attr('point'))



    drawLine('#B'+$(this).attr('q')+"_"+$(this).attr('point'),'#A'+$(this).attr('q')+"_"+(parseInt($(this).val())+1),$(this).attr('q')+"_"+$(this).attr('point'));

    //var ValueOfSelect= parseInt($(this).attr("att"))+1;
    // var ValueOfOption= parseInt($(this).val())+1;
    //  alert(ValueOfSelect);
    //  alert(ValueOfOption);
    // if($(this).attr(id)){
    //alert($(this).attr("id"));
    // var idAA =;
    // var mainid=  parseInt($(this).attr("id").replace("Quastion0columC", ""))+1;
    // if($(mainid)==$(".questions-main-container .question-answer-container .answer .matching .center-container .right .item .button").attr("id"))
    // {
    //     alert();
    // }
    // }

    //
});
$(document).ready(function () {



    $(".login-button").click(function () {
        $(".username").html($("#login").val());
        $(".popup-login-container").fadeOut();
    });

    $("#starts").html(language.start);
    $(".copyrights").html(language.copyrights);
    $("#fullscore").html(language.fullscore);
    $("#passingrate").html(language.passingrate);
    $("#passingscore").html(language.passingscore);
    $("#elapsed").html(language.elapsed);
    $("#yourscore").html(language.yourscore);
    $("#Takethequiz").html(language.Takethequiz);
    $("#qustiontext").html(language.qustiontext);
    $(".titlelang").html(language.Title);
    dragyouranswer = eval('lang_' + language + '.dragyouranswer');
    xmlDoc = loadXMLDoc(path + "quiz.xml?v=" + GenrateID());
    $("#viewquiz").click(function () {
        $(".result-page-container").removeClass("zoomIn").addClass("zoomOut").fadeOut();
        $(".questions-main-container").removeClass("zoomOut").addClass("animated zoomIn").fadeIn();
        $(".questions-main-container .question-answer-container .correction-btn .image").addClass("back");
        // $(".questions-main-container .correction-btn").fadeOut();
    });
    $(".questions-main-container .question-answer-container .correction-btn .image").click(function () {
        $(this).removeClass("back");
    });
    initialize();
    getyear();
});
var quistion_correct = false;
var quiz_data = {'properties': {}, 'question': {}};
var random_question;
var correctsum = 0;
var incorrectsum = 0;
function initialize() {
    var Object_quizinfo = xmlDoc.getElementsByTagName("properties")[0].getElementsByTagName("quizinfo")[0];
    quiz_data.properties.QuizTitle = Object_quizinfo.getElementsByTagName("title")[0].childNodes[0].nodeValue;
    quiz_data.properties.Instructions = Object_quizinfo.getElementsByTagName("instructions")[0].childNodes[0].nodeValue;
    quiz_data.properties.Bttoncreect = Object_quizinfo.getElementsByTagName("buttoncorrect")[0].childNodes[0].nodeValue;
    quiz_data.properties.BttonReset = Object_quizinfo.getElementsByTagName("buttonreset")[0].childNodes[0].nodeValue;
    quiz_data.properties.Type_quiz = Object_quizinfo.getElementsByTagName("type")[0].childNodes[0].nodeValue;
    quiz_data.properties.totalquestion = Object_quizinfo.getElementsByTagName("totalquestion")[0].childNodes[0].nodeValue;
    quiz_data.properties.fullscore = Object_quizinfo.getElementsByTagName("fullscore")[0].childNodes[0].nodeValue;
    quiz_data.properties.passingrate = Object_quizinfo.getElementsByTagName("passingrate")[0].childNodes[0].nodeValue;
    quiz_data.properties.passingscore = Object_quizinfo.getElementsByTagName("passingscore")[0].childNodes[0].nodeValue;
    quiz_data.properties.yourscore = Object_quizinfo.getElementsByTagName("yourscore")[0].childNodes[0].nodeValue;
    quiz_data.properties.elapsed = Object_quizinfo.getElementsByTagName("elapsed")[0].childNodes[0].nodeValue;
    quiz_data.properties.time = Object_quizinfo.getElementsByTagName("time")[0].childNodes[0].nodeValue;
    var Object_quizsettings = xmlDoc.getElementsByTagName("properties")[0].getElementsByTagName("quizsettings")[0];
    quiz_data.properties.Age = Object_quizsettings.getAttribute('age');
    var Object_passset = xmlDoc.getElementsByTagName("properties")[0].getElementsByTagName("passset")[0];
    quiz_data.properties.PassingRatenum = 50;// Object_passset.getAttribute('value');
    quiz_data.properties.Pass = Object_passset.getElementsByTagName("pass")[0].childNodes[0].nodeValue;
    quiz_data.properties.Fail = Object_passset.getElementsByTagName("fail")[0].childNodes[0].nodeValue;


    switch (String(quiz_data.properties.Type_quiz)) {
        case "quiz":
            if (String(quiz_data.properties.QuizTitle) != '') {
                $("#QuizTitle").html(quiz_data.properties.QuizTitle);
                $("#title").html(quiz_data.properties.QuizTitle);

            }
            if (String(quiz_data.properties.fullscore) != '') {
                $("#fullscore").html(quiz_data.properties.fullscore);
            }
            if (String(quiz_data.properties.passingrate) != '') {
                $("#passingrate").html(quiz_data.properties.passingrate);
            }
            if (String(quiz_data.properties.passingscore) != '') {
                $("#passingscore").html(quiz_data.properties.passingscore);
            }
            if (String(quiz_data.properties.elapsed) != '') {
                $("#elapsed").html(quiz_data.properties.elapsed);
            }
            if (String(quiz_data.properties.yourscore) != '') {
                $("#yourscore").html(quiz_data.properties.yourscore);
            }
            quiz_data.question.num = $(xmlDoc.getElementsByTagName("items")[0]).find('item').each(function () {
            }).length;
            quiz_data.question.fullscore = 0;
            quiz_data.question.quiz = [];
            $(xmlDoc.getElementsByTagName("items")[0]).find('item').each(function () {
                var point_correct = $(this).attr('point_correct')
                var point_incorrect = $(this).attr('point_incorrect');
                var type = $(this).attr('type');
                var quistion = $(this).find('question').text();
                var background = '';
                var width = '';
                var height = '';
                var left = '';
                var aitems = [];
                if (type == 7) {
                    background = $(this).find('aitems').attr('background');
                    width = $(this).find('aitems').attr('width');
                    height = $(this).find('aitems').attr('height');
                    left = $(this).find('aitems').attr('left');

                    var answer = [];
                    $(this).find('answer').each(function () {
                        var L = $(this).attr('L');
                        var T = $(this).attr('T');
                        var W = $(this).attr('W');
                        var H = $(this).attr('H');
                        answer.push({'L': L, 'T': T, 'W': W, 'H': H});
                    })
                    aitems.push({
                        'background': background,
                        'answer': answer,
                        'width': width,
                        'height': height,
                        'left': left
                    })
                }
                $(this).find('aitem').each(function () {

                    if (type == 5) {
                        var A = $(this).find('columA').text();
                        var B = $(this).find('columB').text();
                        aitems.push({'answer': {'A': A, 'B': B}});
                    } else if (type == 4) {
                        aitems.push({'answer': strip($(this).text())})
                    } else if (type != 7) {
                        aitems.push({'correct': $(this).attr('correct'), 'answer': $(this).text()})
                    }
                });
                var feedback = [];
                $(this).find('feedback').each(function () {
                    feedback.push({
                        'correct': $(this).find('correct').text(),
                        'incorrect': $(this).find('incorrect').text()
                    })
                });
                quiz_data.question.fullscore += parseInt(point_correct);
                quiz_data.question.quiz.push({
                    'point_correct': point_correct,
                    'point_incorrect': point_incorrect,
                    'type': type,
                    'quistion': quistion,
                    'answer': aitems,
                    'feedback': feedback
                })
            });
            startquiz();
            break;
        case "question":
            alert('لم يتم انشاءه');
            break;
    }
}
function startquiz() {
    correctsum = 0;
    incorrectsum = 0;
    quistion_correct = false;
    $("#yourscorenum").html("0/" + quiz_data.question.fullscore);
    $("#viewquiz").hide();

    if (typeof swiper !== 'undefined') {
        swiper.slideTo(0, 300, false);
    }
    random_question = randomarray(quiz_data.question.quiz.length);
    $(".swiper-wrapper").empty()
    for (var i = 0; i < random_question.length; i++) {
        $(".swiper-wrapper").append(typeqyiz(i));
        var typeQ = quiz_data.question.quiz[random_question[i]].type;
        switch (typeQ) {
            case '5':
                //Matching
                var answer = quiz_data.question.quiz[random_question[i]].answer;
                for (var j = 0; j < answer.length; j++) {
                    $("#Quastion" + i + "columC" + j).val($("#target option:first").val());
                }


                break;
            case '6':
                //Word Bank;
                var answer = quiz_data.question.quiz[random_question[i]].answer;
                for (var j = 0; j < answer.length; j++) {
                    dragable('Quastion' + i + '_' + j, 'Quastion_Drop' + i);
                }
                break;
            case '7':
                //Click Map
                $("#ClickMap" + i).off();
                $("#ClickMap" + i).click(function () {
                    clickaddpointmap(event)
                });
                break;
            case '9':
                //Sequence;
                $("#sortable" + i).sortable();
                $("#sortable" + i).disableSelection();
                break;

        }
    }
    $(".real-content img").addClass("image-link-popup");
    $(".image-link-popup").click(function(){
        $(".image-link-popup").attr('href',$(this).attr('src'));

    })

    $("#SQuastion" + (random_question.length - 1) + ' .question-answer-container').append('');
    $("#fullscorenum").html(quiz_data.question.fullscore);
    $("#qustionnum").html(quiz_data.question.num);
    $("#passingRatenum").html(quiz_data.properties.PassingRatenum + "%");
    $("#PassingScorenum").html((quiz_data.question.fullscore * quiz_data.properties.PassingRatenum) / 100);
    $("#yourscorenum").html("0/" + quiz_data.question.fullscore);
    timerStart({min: quiz_data.properties.time, sec: 0}, true);


}
function strip(html) {
    var tmp = document.implementation.createHTMLDocument("New").body;
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
}


function callfunctionCorrection() {
    if (timerPause) {
        showdeletemessage()
    } else {
        showcorret();
    }
    if (quistion_correct) {
        showcorret();
        return;
    }
    swiper.slideTo(0, 300, false);
    timerPause = false;
    puaseTimer();
    $("#elapsedTim").html($("#timerCount").html());
    quistion_correct = true;

    AjaxResult = [];


    for (var i = 0; i < random_question.length; i++) {
        var typeQ = quiz_data.question.quiz[random_question[i]].type;
        var answer = quiz_data.question.quiz[random_question[i]].answer;
        var point_correct = quiz_data.question.quiz[random_question[i]].point_correct;
        var point_incorrect = quiz_data.question.quiz[random_question[i]].point_incorrect;
        var FeddbackCorrect = quiz_data.question.quiz[random_question[i]].feedback[0].correct
        var FeddbackIncorrect = quiz_data.question.quiz[random_question[i]].feedback[0].incorrect;
        var flag = true;
        var Mark = 0;
        switch (typeQ) {
            case '1':
            case '2':
            case '3':
                //True / False
                //Multiple Choice
                //Multiple Response
                for (var j = 0; j < answer.length; j++) {
                    $("#Quastion" + i + "_" + j).attr('disabled', true);
                    if ($("#Quastion" + i + "_" + j).attr('att') == 0 && $("#Quastion" + i + "_" + j).is(':checked')) {
                        flag = false;
                    } else if ($("#Quastion" + i + "_" + j).attr('att') == 1 && !$("#Quastion" + i + "_" + j).is(':checked')) {
                        flag = false;
                    }
                }

                break;
            case '4':
                //fill in the blank
                $("#inputtextQuastion" + i).attr('readonly', true);
                flag = false;
                for (var j = 0; j < answer.length; j++) {
                    if ($.trim($("#inputtextQuastion" + i).val()) == $.trim(answer[j].answer)) {
                        flag = true;
                    }
                }
                break;
            case '5':
                //Matching
                var corrected = 0;
                var uncorrected = 0;
                answerLength = answer.length;
                for (var j = 0; j < answer.length; j++) {
                    $("#Quastion" + i + "columC" + j).attr('disabled', true);
                    if (parseInt($("#Quastion" + i + "columC" + j).val()) != parseInt($("#Quastion" + i + "columB" + j).index())) {
                        uncorrected++;
                        flag = false;
                    } else {
                        corrected++;
                    }
                }
                if (uncorrected > 0 && corrected > 0) {
                    flag = '3';


                }
                break;
            case '6':
                //Word Bank
                for (var j = 0; j < answer.length; j++) {
                    $("#Quastion" + i + "_" + j).draggable('disable');
                }
                if ($("#Quastion_Drop" + i).attr("correct") != 1) {
                    flag = false;
                }
                break;
            case '7':
                //Click Map
                var corrected = 0;
                var uncorrected = 0;
                if ($("#ErrorClickMap" + i + " div").length > 0) {
                    flag = false;
                    uncorrected = parseInt($("#ErrorClickMap" + i + " div").length) / 10;
                }
                answerLength = answer[0].answer.length;
                for (var j = 0; j < answer[0].answer.length; j++) {
                    if (!$("#map_" + i + "_" + j).hasClass('red')) {
                        flag = false;
                        uncorrected++;

                    } else {
                        corrected++;

                    }

                }
                //  console.log("answer=",answer,"   corrected=",corrected+"  uncorrected="+uncorrected)
                if ((uncorrected > 0 && corrected) > 0) {
                    flag = '3';
                }
                break;
            case '8':
                //Short Essay
                $('#shortEssayQuastion' + i).attr('contenteditable', "false");
                break;
            case '9':
                //Sequence

                $("#sortable" + i).sortable('disable');

                $("#sortable" + i).find('li').each(function () {
                    var innerDivId = $(this).attr('att');

                    if (innerDivId != $(this).index()) {
                        flag = false;

                    }

                });


                break;
        }
        if (flag == true) {
            correctsum += parseInt(point_correct);
            $("#CorQuastion" + i + " .marknum").html(point_correct + '/' + point_correct);
            AjaxResult.push({"Type": typequiz(typeQ), "YourScore": point_correct, "QustionScore": point_correct});
            $("#CorQuastion" + i).addClass("true");
            $("#CorQuastion" + i).show();
            $("#CorQuastion" + i).attr("feddback", FeddbackCorrect);

        } else if (flag == false) {

            incorrectsum += parseInt(point_incorrect);
            $("#CorQuastion" + i + " .marknum").html(0 + '/' + point_correct);
            AjaxResult.push({"Type": typequiz(typeQ), "YourScore": point_incorrect, "QustionScore": point_correct});
            $("#CorQuastion" + i).addClass("false");
            $("#CorQuastion" + i).show();
            $("#CorQuastion" + i).attr("feddback", FeddbackIncorrect);
        } else if (flag == '3') {
            // per= Math.round((corrected/(corrected + uncorrected)) * (100/1));
            var k = (point_correct) / ((answerLength));
            if (typeQ == 7) {
                var point = k * (corrected - uncorrected);
                if (point < 0) {
                    point = 0;
                }

            } else {
                var point = k * corrected;
            }

            if (point > 0) {
                $("#CorQuastion" + i).addClass("true1");
            } else {
                $("#CorQuastion" + i).addClass("false");
            }
            AjaxResult.push({"Type": typequiz(typeQ), "YourScore": point.toFixed(1), "QustionScore": point_correct});
            $("#CorQuastion" + i).show();
            $("#CorQuastion" + i).attr("feddback", FeddbackIncorrect);
            $("#CorQuastion" + i + " .marknum").html(point.toFixed(1) + '/' + point_correct);
            incorrectsum += (point);
           // console.log('corrected=', corrected, '  uncorrected=', uncorrected, '  k=', k, '  point=', point + " point_correct=", point_correct)

        } else if (flag == '4') {
            
        }

    }
    showcorret();
    sendresult();
    hidedeletemessage();
}

function correction() {
    if (timerPause) {
        showdeletemessage()
    } else {
        showcorret();
    }
    $("#delete_question").click(function () {
        callfunctionCorrection();

    });
    $(".popup-delete-container .delete-container a.no").click(function () {
        hidedeletemessage();
    });
}
function typequiz(type) {
    var namesA = '';
    var namesE = '';
    switch (type) {
        case '1':
            namesE = 'True / False';
            namesA = 'صح / خطأ';
            break;
        case '2':
            namesE = 'Multiple Choice';
            namesA = 'الاختيار من متعدد';
            break;
        case '3':
            namesE = 'Multiple Response';
            namesA = 'متعددة الإجابات';
            break;
        case '4':
            namesE = 'Drag Answer';
            namesA = 'اسحب الاجابة';
            break;
        case '5':
            namesE = 'Matching';
            namesA = 'صل الإجابة';
            break;
        case '6':
            namesE = 'Short Answer';
            namesA = 'إجابة قصيرة';
            break;
        case '7':
            namesE = 'Click Map';
            namesA = 'تحديد الموضع';
            break;
        case '8':
            namesE = 'Short Essay';
            namesA = 'مقال';
            break;
        case '9':
            namesE = 'Sequence';
            namesA = 'الترتيب';
            break;
    }
    if (language == 'ar') {
        return namesA;
    } else {
        return namesE;
    }
}
function showcorret() {

    correctsum = Math.round(correctsum - incorrectsum);

    if (correctsum < 0) {
        correctsum = 0;
    }
    if (correctsum > (quiz_data.question.fullscore / 2)) {
        $("#feedbackquiz").html(quiz_data.properties.Pass);
    } else {
        $("#feedbackquiz").html(quiz_data.properties.Fail);
    }


    feedbackQuestion(0);
    $("#yourscorenum").html(correctsum + "/" + quiz_data.question.fullscore);
    $("#viewquiz").show();
    $(".questions-main-container").removeClass("zoomIn").addClass("zoomOut").fadeOut();
    $(".result-page-container").removeClass("zoomOut").addClass("animated zoomIn").fadeIn();
    $(".result-page-container .content-container .btn-start-container").hide();
    $(".result-page-container .content-container .btn-again-container").show();
    $(".result-page-container .content-container .content .bottom-content .right-container .box-white .bottom").removeClass("opacity");

}
function clickaddpointmap(event) {
    if (quistion_correct) {
        return;
    }
    var mapwidth = 50;
    var mapheight = 50;
    var Left = ((event.pageX - (mapwidth / 2)) - $(event.target).parent().offset().left);
    var Top = ((event.pageY - (mapheight / 2)) - $(event.target).parent().offset().top);
    var id = $(event.target).attr("att");
    $("#ErrorClickMap" + id).append('<div onmouseup="javascriot:if(!quistion_correct){$(this).remove()}" class="red" onclick="shopoint()"  map="false" style="width:' + mapwidth + 'px; height:' + mapheight + 'px;position:absolute; left:' + Left + 'px; top: ' + Top + 'px; "><div class="bullet"> <div class="line zero"></div> <div class="line one"></div> <div class="line two"></div> <div class="line three"></div> <div class="line four"></div> <div class="line five"></div> <div class="line six"></div> <div class="line seven"></div> </div></div>')
}
function dragable(i, drop) {
    $("#" + i).draggable({
        revert: true,
        drag: function (event, ui) {
        },
        start: function () {
            $(this).css('z-index', '9999');
        },
        stop: function () {
            $(this).css('z-index', '2');
        }
    });
    $("#" + drop).droppable({
        drop: function (event, ui) {
            if ($(event.target).attr("attold") != null && $(event.target).attr("attold") != undefined) {
                var element = $(event.target).attr("attold");
                $("#" + element).draggable('enable');
                $("#" + element).css({opacity: 1})
            }
            $(event.target).attr("attold", $(ui.draggable).attr('id'));
            $(event.target).attr("correct", $(ui.draggable).attr('att'));
            var clones = $(ui.draggable).clone('a');
            clones.css('left', '0');
            clones.css('right', '0');
            clones.css('top', '0');
            clones.css('margin', 'auto');
            $(event.target).html(clones);
            $(ui.draggable).draggable('disable');
            $(ui.draggable).css({opacity: 0.5});
            $(ui.draggable).siblings().css({opacity: 1})
        }
    });
}
function shopoint(value) {
    if (quistion_correct) {
        return;
    }
    if ($("#" + value).hasClass('red')) {
        $("#" + value).removeClass('red')
    } else {
        $("#" + value).addClass('red')
    }
}
function typeqyiz(i) {
    var data = "";
    var typeQ = quiz_data.question.quiz[random_question[i]].type;
    var Quastion = quiz_data.question.quiz[random_question[i]].quistion;
    var answer = quiz_data.question.quiz[random_question[i]].answer;
    switch (String(typeQ)) {
        case '1':
            //True / False
            var answerRandom = (answer.length);
            data += '<div id="SQuastion' + i + '" class="swiper-slide ' + i + '"> <div class="question-answer-container"> <div class="question-view"><div class="display-none1" id="CorQuastion' + i + '" ><div class="marknum">1/10</div></div> <div class="num floating-left">' + (i + 1) + '</div> <div class="text floating-left">' + Quastion + ' </div> </div>';
            data += '<div class="answer overflow" ><div class="true-false floating-left"><ul>';
            var class1 = '<div class="image-true"></div>';
            var class2 = '<div class="image-false"></div>';
            var classs = class1;
            for (var j = 0; j < answer.length; j++) {
                if (j == 1) {
                    classs = class2;
                }
                data += '<li class="swiper-no-swiping"><input att="' + answer[j].correct + '"  type="radio" name="Quastion' + i + '" att="' + j + '" id="Quastion' + i + '_' + j + '">';
                data += ' <label for="Quastion' + i + '_' + j + '">' + classs + '</label> <div class="bullet"> <div class="line zero"></div> <div class="line one"></div> <div class="line two"></div> <div class="line three"></div> <div class="line four"></div> <div class="line five"></div> <div class="line six"></div> <div class="line seven"></div> </div> </li>';
            }
            data += '</ul></div></div></div></div> ';
            break;
        case '2':
            //Multiple Choice
            var answerRandom = randomarray(answer.length);
            data += '<div id="SQuastion' + i + '" class="swiper-slide ' + i + '"> <div class="question-answer-container"> <div class="question-view"><div class="display-none1" id="CorQuastion' + i + '" ><div class="marknum">1/10</div></div> <div class="num floating-left">' + (i + 1) + '</div> <div class="text floating-left">' + Quastion + ' </div> </div>';
            data += '<div class="answer overflow" ><div class="multible-choises floating-left"><ul>';
            for (var j = 0; j < answer.length; j++) {
                data += '<li class="swiper-no-swiping"><input att="' + answer[answerRandom[j]].correct + '"  type="radio" name="Quastion' + i + '" att="' + answerRandom[j] + '" id="Quastion' + i + '_' + j + '">';
                data += ' <label for="Quastion' + i + '_' + j + '">' + answer[answerRandom[j]].answer + '</label> <div class="bullet"> <div class="line zero"></div> <div class="line one"></div> <div class="line two"></div> <div class="line three"></div> <div class="line four"></div> <div class="line five"></div> <div class="line six"></div> <div class="line seven"></div> </div> </li>';
            }
            data +='</ul></div></div></div></div> ';
            break;
        case '3':
            //Multiple Response
            data += '  <div id="SQuastion' + i + '" class="swiper-slide ' + i + '"> <div class="question-answer-container"> <div class="question-view"><div class="display-none1" id="CorQuastion' + i + '" ><div class="marknum">1/10</div></div> <div class="num floating-left">' + (i + 1) + '</div> <div class="text floating-left">';
            data += Quastion + ' </div> </div><div class="answer swiper-no-swiping">';
            var answerRandom = randomarray(answer.length);
            for (var j = 0; j < answer.length; j++) {
                data += '  <div class="multiple-response floating-left"> <div class="line-row swiper-no-swiping"> <input att="' + answer[answerRandom[j]].correct + '" type="checkbox"  att="' + answerRandom[j] + '"  id="Quastion' + i + '_' + j + '"/> <label for="Quastion' + i + '_' + j + '" class="check-box v3 floating-left"></label> <label  for="Quastion' + i + '_' + j + '" class="floating-left option-text">' + answer[answerRandom[j]].answer + '</label> </div></div>  ';
            }
            data += '</div> </div></div> ';
            break;
        case '4':
            //fill in the blank
            data += '<div id="SQuastion' + i + '" class="swiper-slide ' + i + '"> <div class="question-answer-container"> <div class="question-view"> <div class="display-none1" id="CorQuastion' + i + '" ><div class="marknum">1/10</div></div><div class="num floating-left">' + (i + 1) + '</div> <div class="text floating-left">';
            data += Quastion + ' </div> </div>';
            data += '<div class="answer swiper-no-swiping"> <div class="fill-in-the-blank floating-left swiper-no-swiping"> <div class="title" placeholder="Enter your Answer"></div> <div class="box-text"> <input id="inputtextQuastion' + i + '" type="text" value=" "/> </div> </div> </div> </div> </div>';
            break;
        case '5':
            //Matching
            data += '<div id="SQuastion' + i + '" class="swiper-slide ' + i + '"> <div class="question-answer-container"> <div class="question-view"> <div class="display-none1" id="CorQuastion' + i + '" ><div class="marknum">1/10</div></div><div class="num floating-left">' + (i + 1) + '</div> <div class="text floating-left">';
            data += Quastion + ' </div> </div>';
            data += ' <div class="answer swiper-no-swiping"><div class="matching floating-left"><div class="left-container floating-left">';

            for (var j = 0; j < answer.length; j++) {
                data += '<div class="box-container swiper-no-swiping"> <div class="image">' + answer[j].answer.A + ' </div> </div>';
            }
            data += '</div>';
            data += '<div class="center-container floating-left">';

            var centercircleLeft = '<div class="left floating-right">';
            var centercircleRight = '<div class="right floating-left">';
            for (var j = 0; j < answer.length; j++) {
                centercircleLeft += '<div class="item swiper-no-swiping"><div class="button leftpoint" id="A'+i+"_" + (j + 1) + '">' + (j + 1) + '</div></div>';
                centercircleRight += '<div class="item"><div class="button rightpoint" id="B' +i+"_"+ (j + 1) + '"></div></div>';
            }
            data += centercircleLeft + "</div>";
            data += centercircleRight + "</div>";

            var centerContainerRight = '<div class="right floating-right">';
            var answerRandom = randomarray(answer.length);
            for (var j = 0; j < answer.length; j++) {
                centerContainerRight += '<div class="item"><select point="'+(j+1)+'" q="'+i+'" class="text-box" att="' + answerRandom[j] + '" id="Quastion' + i + 'columC' + j + '">';

                for (k = 0; k < answer.length; k++) {
                    centerContainerRight += ' <option  value="' + k + '">' + (k + 1) + '</option>';
                }
                centerContainerRight += '</select></div>';
            }
            data += centerContainerRight + "</div></div>";



            data += '<div class="left-container floating-right">';


            for (var j = 0; j < answer.length; j++) {

                data += '<div att="' + answerRandom[j] + '" id="Quastion' + i + 'columB' + answerRandom[j] + '" class="box-container swiper-no-swiping"> <div class="image">' + answer[answerRandom[j]].answer.B + '</div> </div>';
            }
            data += '</div> </div></div>';

            break;
        case '6':
            //Word Bank
            data += '<div id="SQuastion' + i + '" class="swiper-slide ' + i + '"> <div class="question-answer-container"> <div class="question-view"><div class="display-none1" id="CorQuastion' + i + '" ><div class="marknum">1/10</div></div> <div class="num floating-left">' + (i + 1) + '</div> <div class="text floating-left">';
            data += Quastion + ' </div> </div><div class="answer swiper-no-swiping">';

            data += ' <div class="word-bank floating-left"><div id="Quastion_Drop' + i + '" class = "box-drag-in swiper-no-swiping">' + dragyouranswer + '</div> <ul>';
            var answerRandom = randomarray(answer.length);
            for (var j = 0; j < answer.length; j++) {
                data += '<li id="Quastion' + i + '_' + j + '" att="' + answer[answerRandom[j]].correct + '" class="swiper-no-swiping"> <a >' + answer[answerRandom[j]].answer + '</a> </li>';
            }
            data += '</ul></div></div></div> ';
            break;
        case '7':
            //Click Map
            data += '<div id="SQuastion' + i + '" class="swiper-slide ' + i + '"> <div class="question-answer-container"> <div class="question-view"><div class="display-none1" id="CorQuastion' + i + '" ><div class="marknum">1/10</div></div> <div class="num floating-left">' + (i + 1) + '</div> <div class="text floating-left">';
            data += Quastion + ' </div> </div><div id="AnswerQuastion' + i + '" class="answer swiper-no-swiping">';

            data += ' <div class="click-map floating-left swiper-no-swiping"> <div class="pointer-click"></div> <div class="box-map-main"   > <div  class="box-map-inner" id="ClickMap' + i + '"> <div  style="float:left;overflow: hidden;position: relative;width:' + answer[0].width + 'px; height:' + answer[0].height + 'px; left:' + answer[0].left + ';"><div id="ErrorClickMap' + i + '"></div>';

            for (var j = 0; j < answer[0].answer.length; j++) {
                data += "<div   onclick='shopoint(this.id)'  id='map_" + i + '_' + j + "' map='false' style='z-index:9999;width:" + answer[0].answer[j].W + "px; height:" + answer[0].answer[j].H + "px;position:absolute;left:" + answer[0].answer[j].L + "px; top:" + answer[0].answer[j].T + "px'><div class='bullet'> <div class='line zero'></div> <div class='line one'></div> <div class='line two'></div> <div class='line three'></div> <div class='line four'></div> <div class='line five'></div> <div class='line six'></div> <div class='line seven'></div></div></div>";
            }
            data += '<img style="height: 100%; width: 100%;"  att="' + i + '" src="' + answer[0].background + '"></div></div> </div> </div> </div> </div> </div>';
            break;
        case '8':
            //Short Essay
            data += '<div id="SQuastion' + i + '" class="swiper-slide ' + i + '"> <div class="question-answer-container"> <div class="question-view"> <div class="display-none1" id="CorQuastion' + i + '" ><div class="marknum">1/10</div></div><div class="num floating-left">' + (i + 1) + '</div> <div class="text floating-left">';
            data += Quastion + ' </div> </div><div class="answer swiper-no-swiping"><div class="short-essay floating-left"><div class="paper-background swiper-no-swiping"><section id="shortEssayQuastion' + i + '" contenteditable="true" class="paper-content">   </section> </div> </div> </div > </div > </div>';
            break;
        case '9':
            //Sequence
            data += '<div id="SQuastion' + i + '" class="swiper-slide ' + i + '"> <div class="question-answer-container"> <div class="question-view"><div class="display-none1" id="CorQuastion' + i + '" ><div class="marknum">1/10</div></div> <div class="num floating-left">' + (i + 1) + '</div> <div class="text floating-left">';
            data += Quastion + ' </div> </div><div class="answer swiper-no-swiping"><div  class="sequence floating-left"><ul id="sortable' + i + '" > ';
            var answerRandom = randomarray(answer.length);
            for (var j = 0; j < answer.length; j++) {
                data += '<li class="line-row swiper-no-swiping ui-state-default" id="Quastion' + i + '_' + j + '" att="' + answerRandom[j] + '"> <label class="box-number floating-left">' + j + '</label> <span class="floating-left">' + answer[answerRandom[j]].answer + '</span> </li>';
            }
            data += '</ul></div> </div></div> ';
            break;
    }
    return data;
}
function GenrateID() {
    var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
    var uniqid = randLetter + Date.now();
    return uniqid;
}
function loadXMLDoc(dname) {
    if (window.XMLHttpRequest) {
        xhttp = new XMLHttpRequest();
    }
    else {
        xhttp = new ActiveXObject("Microsoft.XMLDOM");
    }
    xhttp.open("GET", dname, false);
    xhttp.send();
    return xhttp.responseXML;
}
function randomarray(Length) {
    var shuffle_Array = [];
    for ($x = 0; $x < Length; $x++) {
        shuffle_Array.push($x);
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
function getyear() {
    var d = new Date();
    var n = d.getFullYear();
    $(".year").html(n)
}
function feedbackQuestion(id) {

    $(".questions-main-container .question-answer-container").scrollTop(0);
    if (!quistion_correct || id == undefined) {
        return;
    }
    $(".feedback-question-container").hide();
    $(".hamburger").removeClass("is-active");
    $(".feedback-question-container").addClass("active");
    if ($("#CorQuastion" + id).attr("feddback") != '') {
        $(".feedback-question-container").show();
        setTimeout(function () {
            $("#feedbackquestion").val($("#CorQuastion" + id).attr("feddback"))
            $(".hamburger").addClass("is-active");
            $(".feedback-question-container").removeClass("active");
        }, 1000)
    }
}
function lineDistance(x, y, x0, y0) {
    return Math.sqrt((x -= x0) * x + (y -= y0) * y);
};
function drawLine(a, b, line) {
// console.log(line)
    $("#line_" + line).remove();$("#line_" + line).remove();$("#line_" + line).remove();$("#line_" + line).remove();
    $("#SQuastion"+line.split("_")[0]+" .center-container").append('<div id="line_' + line + '" class="line" style="height: 0;"></div>');
    var pointA = $(a).offset();
    var pointB = $(b).offset();
    if (pointA.top > pointB.top) {
        pointA = $(b).offset();
        pointB = $(a).offset();
    }
    var pointAcenterX = $(a).width() / 2;
    var pointAcenterY = $(a).height() / 2;
    var pointBcenterX = $(b).width() / 2;
    var pointBcenterY = $(b).height() / 2;
    var angle = Math.atan2(pointB.top - pointA.top, pointB.left - pointA.left) * 180 / Math.PI;
    var distance = lineDistance(pointA.left, pointA.top, pointB.left, pointB.top);

    $("#line_" + line).css('transform', 'rotate(' + angle + 'deg)');

    $("#line_" + line).css('width', distance + 'px');
    var id=a.split("_")[1];
    $("#line_" + line).addClass('color'+id);

    if (pointB.left < pointA.left) {

        $("#line_" + line).offset({top: pointA.top + pointAcenterY, left: pointB.left + pointBcenterX});
        $("#line_" + line).animate({
            height: "2"
        }, 600, function () {
        });
    } else
        {
        // $("#line_" + line).removeClass('color'+id);
        // $(b).removeClass('color'+id);
        $("#line_" + line).offset({top: pointA.top + pointAcenterY, left: pointA.left + pointAcenterX});
        $("#line_" + line).animate({
            height: "2"
        }, 600, function () {
        });
    }
}

