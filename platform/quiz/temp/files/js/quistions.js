/**
 * Created by khalid alomiri on 1/13/2016.
 */
function Reset() {
    quistion_correct=false;
    switch (parseInt(arguments[0])) {
        case 1:
        case 2:
            var lopping = ("'input[type=radio][name=question_" + index + "]'")
            $(eval(lopping)).each(function (i) {
                this.checked=''
                $(this).prop("disabled",false);
                $(this).removeProp("disabled");
            });
            break;
        case 3:
            var lopping = ("'input[type=checkbox][name=question_" + index + "]'")
            $(eval(lopping)).each(function (i) {
                this.checked=''
                $(this).prop("disabled",false);
                $(this).removeProp("disabled");
            });
            break;
        case 4:
            $("#answer"+index).val('');
            $("#answer"+index).prop("disabled",false);
            $("#answer"+index).removeProp("disabled");
            break;
        case 5:
            eval("object_match" + index).linesArray=[];
            eval("object_match" + index).ctxCanvas.clearRect(0, 0, eval("object_match" + index).canvas.width, eval("object_match" + index).canvas.height);
            eval("object_match" + index).activ=true;
            break;
        case 6:
            $("#droppable_"+index).attr("att",'');
            $("#dvSource"+index).append($("#droppable_"+index).children()[0])
            for (var i = 0; i < 10; i++) {
                $("#Answer_" + index + "_draggable_" + i).draggable({ disabled: false });
            }
            break;
        case 7:

            $("#ContainerMap"+question_NUm).off()
            $("#ContainerMap"+question_NUm).click(function (){clickaddpointmap (event)});
            while ($("#errormap"+index).children().length>0){
                $("#errormap"+index).children()[0].remove();
            }
            for(var i=0;i<$("#Question"+index).children().length;i++){

                $($("#Question"+index).children()[i]).removeClass('red');
            }
            break;
        case 8:

            $("#textarea"+index).val("");
            break;
        case 9:
            for(var i=0;i<$("#sortable"+index).children().length;i++){
                $($("#sortable"+index)).append($("#sortable"+index).children()[i]);
            }
            $("#sortable" + index).sortable('enable');
            break;
        case 10:

            for(var i=0;i<$("#sortable"+index).children().length;i++){
                $($("#sortable"+index)).append($("#sortable"+index).children()[i]);
            }

            $("#sentences-list" + index +" span").each(function (i) {
                $(this).html('....');
                $(this).attr('correct','')

            });
            $('#sortable' + index + ' li').draggable({
                disabled: false
            })
            break;
    }
}


function essatydraggable(index) {
    $('#sortable' + index + ' li').draggable({
        placeholder: 'ui-sortable-placeholder',
        containment: '#answer-content-container',
        stack: '#sentences-list .item-container span',
        cursor: 'move',
        revert: true,
        drag: function (event, ui) {
            //  console.log($(this).attr("id"))
            /* if($(this).hasClass("delete-word")){
             word = $(this).attr("data-alias");
             }else{
             word = $(this).html();
             }*/

        }
    });



    $('#sentences-list' + index + ' span').droppable({
        accept: '#sortable' + index + ' li',
        drop: function (event, ui) {
            ///  console.log($(ui.draggable).attr("id"), $(this).attr("id"))
            $(this).attr("correct", $(ui.draggable).attr("id"))
            $(this).html($(ui.draggable).html());
        }
    });
}


function draggablefun() {



    if(arguments[2]!=undefined){
        //$("#droppable_"+arguments[0]).append($("#Answer_" + arguments[0] + "_draggable_" + arguments[2]));
    }




    for (var i = 0; i < 10; i++) {
        $("#Answer_" + arguments[0] + "_draggable_" + i).draggable({
            revert: "invalid",
            refreshPositions: true,
            drag: function (event, ui) {
                ui.helper.addClass("draggable");
            },
            stop: function (event, ui) {
                ui.helper.removeClass("draggable");
            }
        });
        $("#droppable_" + arguments[0]).droppable({
            drop: function (event, ui) {
                ui.draggable.addClass("dropped");
                $(this).append(ui.draggable);
                $(this).attr("checkedanswer", ($(ui.draggable).attr('id')).split("draggable_")[1])
                $(this).attr("att", $(ui.draggable).attr('index'));
                $($(this).children('div').get(0)).css("left", "0px ");
                $($(this).children('div').get(0)).css("top", "0px ");
                if ($(this).children('div').get(1) != undefined) {
                    $($(this).children('div').get(0)).removeClass("dropped")
                    $($(this).children('div').get(1)).css("left", "0px ");
                    $($(this).children('div').get(1)).css("top", "0px ");

                    var indx = $(this).attr('id').split('droppable_').join('');
                    $("#dvSource" + indx).append($(this).children('div').get(0))
                }
            }
        });
    }


}

function sortaple_fun(index) {

    $("#sortable" + index).sortable({
        placeholder: 'ui-state-default-placeholder'
    });
    $("#sortable" + index).disableSelection();
}
function clickmap() {

    $("#ContainerMap"+currentQuestion).off();
    $("#ContainerMap"+currentQuestion).click(function (){clickaddpointmap (event)});
}
function clickaddpointmap(event){

    var mapwidth = 50;
    $("#errormap"+currentQuestion).append('<div onmouseup="javascriot:if(!quistion_correct){$(this).remove()}" class="red" onclick="shopoint(this.id)" id="map_1" map="false" style="width:' + mapwidth + 'px; height:' + mapwidth + 'px;position:absolute; left:' + (event.pageX - (mapwidth / 2)) + 'px; top: ' + (event.pageY - (mapwidth / 2) - mapwidth) + 'px; "></div>')
}
function shopoint(value) {

    if(quistion_correct){
        return
    }

    if ($("#" + value).hasClass('red')) {
        $("#" + value).removeClass('red')
    } else {
        $("#" + value).addClass('red')
    }
}


function correctquiz() {

    saveQuiz(window.currentQuestion);

    sum_quiz = 0;
    for (var i = 0; i < quiz_array.length; i++) {

        if (quiz_array[i] == undefined) {
            break;
        }

        switch (quiz_array[i].type) {
            case "1":
            case "2":

                if (parseInt(quiz_array[i].correct) == 1) {
                    sum_quiz += parseInt(quiz_array[i].point_correct);
                } else {
                    sum_quiz -= parseInt(quiz_array[i].point_incorrect);
                }

                break;
            case "3":
                var correct = true;
                for (var a = 0; a < quiz_array[i].correct; a++) {
                    if (quiz_array[i].correct[a] != quiz_array[i].checkedanswer[a]) {
                        correct = false;
                    }
                }
                if (correct) {
                    sum_quiz += parseInt(quiz_array[i].point_correct);
                } else {
                    sum_quiz -= parseInt(quiz_array[i].point_incorrect);
                }
                break;
            case "4":
                var correct = false;
                for (var a = 0; a < quiz_array[i].correct; a++) {
                    if (Base64.decode(quiz_array[i].correct[a]) == quiz_array[i].checkedanswer) {
                        correct = true;
                    }
                }
                if (correct) {
                    sum_quiz += parseInt(quiz_array[i].point_correct);
                } else {
                    sum_quiz -= parseInt(quiz_array[i].point_incorrect);
                }
                break;
            case "5":


                var Object_avr=checkAnswer(eval("object_match" + i));
                if (Object_avr.count==Object_avr.total) {
                    sum_quiz += parseInt(quiz_array[i].point_correct);
                } else {
                    sum_quiz -= parseInt(quiz_array[i].point_incorrect);
                }

                break
            case "6":
                if (quiz_array[i].correct == 1) {
                    sum_quiz += parseInt(quiz_array[i].point_correct);
                } else {
                    sum_quiz -= parseInt(quiz_array[i].point_incorrect);
                }
                break
            case "7":
                correct = true;
                for (var a = 0; a < quiz_array[i].correct; a++) {
                    if (quiz_array[i].correct[a] == false) {
                        correct = false;
                    }
                }
                if (quiz_array[i].checkedanswer.length < 1 && correct) {
                    sum_quiz += parseInt(quiz_array[i].point_correct);
                } else {
                    sum_quiz -= parseInt(quiz_array[i].point_incorrect);
                }
                break
            case "9":
                correct = true;
                for (var a = 0; a < quiz_array[i].correct; a++) {
                    if (quiz_array[i].correct[a].sort != (a + 1)) {
                        correct = false;
                    }
                }
                if (quiz_array[i].checkedanswer.length < 1 && correct) {
                    sum_quiz += parseInt(quiz_array[i].point_correct);
                } else {
                    sum_quiz -= parseInt(quiz_array[i].point_incorrect);
                }
                break;
            case "10":
                correct = true;
                for (var a = 0; a < quiz_array[i].correct; a++) {
                    if (quiz_array[i].correct[a].id != quiz_array[i].correct[a].correct) {
                        correct = false;
                    }
                }
                if (correct) {
                    sum_quiz += parseInt(quiz_array[i].point_correct);
                } else {
                    sum_quiz -= parseInt(quiz_array[i].point_incorrect);
                }
                break;
        }
    }

    $("#instructions_page").show();
    $("#quiz_setting").show();
    $("#start").hide();
    $(".bookNext").hide();
    $(".bookPrev").hide();
    $(".goto-container").hide();
    $("#correct").hide();
    clearInterval(myClock);
    $("#elapsed").show();
    $("#YourScore_title").html(yourscore_title);
    $("#elapsed_title").html(elapsed_title);
    $("#YourScore").html(sum_quiz);
    $("#elapsed").html(calcTime());
    $("#instructions_page").show();
    $(".sub-container").hide();
}

quistion_correct=false;
function correct() {
    quistion_correct=true;

    switch (parseInt(arguments[0])) {
        case 1:
        case 2:
            for (var i = 0; i < 9; i++) {
                $("#answer" + question_NUm + "_" + i).attr("disabled", true);
            }
            var object = eval("$('input[type=radio][name=question_" + question_NUm + "]:checked')").val();
        
            if (object == 1) {
                quiz_sum += parseInt(arguments[1]);
                correct = true;
            } else {
                quiz_sum -= parseInt(arguments[2]);
                correct = false;
            }

            feddbackmsg(correct);
            break;
        case 3:
            var sum = 0;
            var sign = 0;
            var lopping = ("'input[name=question_" + question_NUm + "]'")
            $(eval(lopping)).each(function () {
                sign += parseInt($(this).attr('value'));
                $(this).prop("disabled",true);

            });
            $(eval(lopping)).each(function () {
                if (this.checked && $(this).attr('value') == 1) {
                    sum += parseInt($(this).attr('value'));
                } else if (this.checked && $(this).attr('value') == 0) {
                    sum -= 1;
                }
            });
            if (sign == sum) {
                correct = true;
                quiz_sum += parseInt(arguments[1]);
            } else {
                correct = false;
                quiz_sum -= parseInt(arguments[2]);
            }
            feddbackmsg(correct);
            break;
        case 4:
            var correct = false;
            var answer = $('#answer' + question_NUm).val();
            $("#answer"+question_NUm).prop("disabled",true);
            answer = $.trim(answer);
            while (answer.indexOf('  ') > -1) {
                var Rep = new RegExp('  ', 'g');
                answer = answer.replace(Rep, ' ');
            }
            $('#answer').val(answer);
            object_answer = $('#answer' + question_NUm).attr('object').split(",");

            jQuery.each(object_answer, function (index, item) {

                if (answer == Base64.decode(item)) {
                    correct = true;
                }
            });
            feddbackmsg(correct);
            break;
        case 5:
            var Object_avr=checkAnswer(eval("object_match" + index));
            if (Object_avr.count==Object_avr.total) {
                correct = true;
            } else {
                correct = false;
            }
            eval("object_match" + index).activ=false;
            feddbackmsg(correct);
            break;
        case 6:
            for (var i = 0; i < 10; i++) {
                $("#Answer_" + index + "_draggable_" + i).draggable({ disabled: true });
            }
            if ($("#droppable_"+index).attr("att") == 1) {
                correct = true;
            } else {
                correct = false;
            }
            feddbackmsg(correct);
            break;
        case 7:
            $("#ContainerMap"+question_NUm).off();
            correct = true;
            var ContainerMapchildren = $("#errormap"+question_NUm).children().length;



            for (var i = 0; i < $("#Question"+question_NUm).children().length; i++) {
                if ($("#map_" + i).hasClass("red") == false) {
                    correct = false;
                }
            }
            if (correct && ContainerMapchildren < 1) {
                correct = true;
            } else {
                correct = false;
            }
            feddbackmsg(correct);
            break;
        case 8:

            break;
        case 9:
            $("#sortable" + index).sortable('disable');
            var correct = true;
            $('#sortable'+index+' li').each(function (n, v) {
                if ($(this).attr("sort") != new String(n + 1)) {
                    correct = false;
                }
            });
            feddbackmsg(correct)
            break;
        case 10:

            $('#sortable' + index + ' li').draggable({
                disabled: true
            })

            var correct = true;

            $("#sentences-list" + index +" span").each(function (i) {
                // console.log($(this).attr('id'),$(this).attr('correct'))
                if($(this).attr('id')!=$(this).attr('correct')){
                    correct=false;
                }

            });
            feddbackmsg(correct)

            break;



    }

}
function feddbackmsg(correct) {

    if (Type_quiz == 'question' || index < totalquestion_num - 1) {
        if (correct) {
            swal('Correct answer', "success");
        } else {
            swal('Wrong Answer');
        }
    } else {
        if (correct) {
            swal({title: "Correct answer "}, function (isConfirm) {
                if (isConfirm) {
                    reportquiz()
                }
            });
        } else {
            swal({title: "Wrong Answer "}, function (isConfirm) {
                if (isConfirm) {
                    reportquiz()
                }
            });
        }
    }

}
function GenrateID() {
    var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
    var uniqid = randLetter + Date.now();
    return uniqid;
}
