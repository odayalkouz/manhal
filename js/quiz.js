/**
 * Created by Hussam Abu Khaidejh on 1/26/2016.
 */
$(document).ready(function ()
{
    showAddAnswer();
    $(document).on("click", ".dropable", function () {
        $(".dropable").removeClass("selected_dropable");
        $(this).addClass("selected_dropable");
    });

    $(document).on("click", ".delete_answer", function () {
        if($(this).attr("tolabel")!=""){
            $("#"+$(this).attr("tolabel")).replaceWith($(this).closest(".ans").find("label").first().html());
        }
        $(this).closest(".ans").remove();
    });
    $("#add_answer").click(function (e) {
        $(".vresizable ").resizable("destroy");
        $(".resizable ").resizable("destroy");
        html = "";
        switch (window.questionType) {
            case "2":
            case "6":
                newid = "ans" + randomString(3);
                id = $("#answer_container").find("input:radio").first().attr("name");
                html = '<div class="answer-container"> <div class="section-radio"> <ul><label for="' + newid + '_' + id + '" class="ans floating-left content-list"> <div class="dropable vresizable  "> <label class="answer1   input-control radio floating-left"> <input type="hidden"> <input type="radio" name="' + id + '" id="' + newid + '_' + id + '"  class="level_radio"> <span class="check"></span> </label> <label contenteditable="true" for="' + newid + '_' + id + '" class="poplinable font-text text-left floating-left">New Answer</label> <div class="delete_answer floating-right flaticon-x"></div></div> </label> </ul> </div> </div>';

                $("#answer_container").append(html);
                break;
            case "3":
                newid = "ans" + randomString(3);
                id = $("#answer_container").find("input:checkbox").first().attr("name");
                html = '<div class="answer-container"> <div class="section-check"> <ul><label for="' + newid + '_' + id + '" class="answer_multiple ans floating-left content-list">  <div class="vresizable dropable "> <label class="input-control checkbox new floating-left"> <input type="hidden"> <input type="checkbox" name="' + id + '" id="' + newid + '_' + id + '"  class="level_check"> <span class="check"></span> </label> <label contenteditable="true" for="' + newid + '_' + id + '"  class="poplinable font-text text-left floating-left">New Answer</label> <div class="delete_answer floating-right flaticon-x"></div></div> </label> </ul> </div> </div>';
                $("#answer_container").append(html);
                break;
            case "4":
                newid = "ans" + randomString(3);
                html = '<div class="fill-in-the-blank ans "><label id="' + newid + '" contenteditable="true" class="poplinable font-text text-left floating-left fill_answer">Your Answer</label><div class="delete_answer floating-right flaticon-x"></div></div>';
                $("#answer_container").append(html);
                break;
            case "5":
                html = '<div class="answer-container ans"> <div class="matcing-content "> <div class="matching-line-row"> <div class="floating-left match-box  leftbox"> <div class="vresizable dropable"> <div id="dl" class="resizable draggable element" style="width:150px;height:60px;position: absolute;top: 15px;left: 15px;"> <div class="delete_widget floating-right flaticon-x"></div> <div class="move_handler flaticon-more9"></div> <div class="real-content"><span class="poplinable" contenteditable="true">Text</span></div> </div> </div> </div> <div class="delete_answer floating-right flaticon-x"></div> <div class="floating-right match-box  rightbox"> <div class="vresizable dropable"> <div id="dr" class="resizable draggable element" style="width:150px;height:60px;position: absolute;top: 15px;left: 15px;"> <div class="delete_widget floating-right flaticon-x"></div> <div class="move_handler flaticon-more9"></div> <div class="real-content"><span class="poplinable" contenteditable="true">Text</span></div> </div> </div> </div> </div></div></div>';
                $("#answer_container").append(html);
                break;
            case "7":
                html = '<div class="real-content remove-margin ans"><div class="draggable resizable circle-container" style="position: absolute;top:50px;width:50px;height:50px;"> <div class="delete_answer floating-right flaticon-x"></div><div class="move_handler flaticon-more9 circle-handle"></div> <div class="circle-map"></div> </div> ';
                $("#map_container").append(html);
                break;
            case "9":
                html = '<li class="ui-state-default ans"> <div class="delete_answer floating-right flaticon-x"></div> <a class="handle floating-right"><i class="flaticon-left3"></i></a> <label class="poplinable" contenteditable="true">New Item</label> </li>';
                $("#sequance").append(html);
                break;
            case "10":
                $("#word_container").append("<div class='ans'><div class='delete_answer floating-left flaticon-x'></div><label class='poplinable' contenteditable='true'>New Word</label></div>");
                break;
        }
        refreshElement();
        $(".close").trigger("click");
    });
    $(document).on("click", ".jq_changetype", function () {
        window.questionType = $(this).attr("qtype");
        showAddAnswer();
        id = "answer_" + randomString(7);
        $(".vresizable ").resizable("destroy");
        html = "";
        switch (window.questionType) {
            case "1":
                //html = '<div class="answer-container"><div class="section-radio"> <ul> <label for="t_' + id + '" class="floating-left content-list"> <label class="answer1 ans dropable vresizable input-control radio floating-left"> <input type="hidden"> <input type="radio" name="' + id + '" id="t_' + id + '" class="level_radio" > <span class="check"></span> </label> <label contenteditable="true" for="t_' + id + '" class="poplinable font-text text-left floating-left">True</label> </label> <label for="f_' + id + '" class="floating-left content-list"> <label class="answer2 ans dropable vresizable input-control radio floating-left"> <input type="hidden"> <input type="radio" name="' + id + '" id="f_' + id + '" class="level_radio" > <span class="check"></span> </label> <label contenteditable="true" for="f_' + id + '" class="poplinable font-text text-left floating-left">False</label> </label> </ul> </div> </div>';
                html = '<div class="answer-container"> <div class="section-radio"> <ul><label for="t_' + id + '" class="floating-left answer1 ans content-list"> <div class="dropable vresizable"> <label class="input-control radio floating-left"> <input type="hidden"> <input  type="radio" name="' + id + '" id="t_' + id + '" class="level_radio"> <span class="check"></span> </label> <label contenteditable="true" for="t_' + id + '" class="poplinable font-text text-left floating-left">True</label> </div> </label> <label for="f_' + id + '" class="floating-left answer2 ans content-list"> <div class="dropable vresizable"> <label class="input-control radio floating-left"> <input type="hidden"> <input type="radio" name="' + id + '" id="f_' + id + '" class="level_radio"> <span class="check"></span> </label> <label contenteditable="true" for="f_' + id + '" class="poplinable font-text text-left floating-left">False</label> </div> </label> </ul> </div> </div>';
                break;
            case "2":
            case "6":
                //html = '<div class="answer-container"> <div class="section-radio"> <ul><label for="one_' + id + '" class="dropable ans vresizable  floating-left content-list"> <label class="answer1   input-control radio floating-left"> <input type="hidden"> <input type="radio" name="' + id + '" id="one_' + id + '" class="level_radio"> <span class="check"></span> </label> <label contenteditable="true" for="one_' + id + '" class="poplinable font-text text-left floating-left">One</label> <div class="delete_answer floating-right flaticon-x"></div> </label> <label for="two_' + id + '" class="dropable ans vresizable  floating-left content-list"> <label class="answer2   input-control radio floating-left"> <input type="hidden"> <input type="radio" name="' + id + '" id="two_' + id + '" class="level_radio"> <span class="check"></span> </label> <label contenteditable="true" for="two_' + id + '" class="poplinable font-text text-left floating-left">Two</label> <div class="delete_answer floating-right flaticon-x"></div> </label> <label for="three_' + id + '" class="answer3 ans dropable vresizable floating-left content-list"> <label class=" input-control radio floating-left"> <input type="hidden"> <input type="radio" name="' + id + '" id="three_' + id + '" class="level_radio"> <span class="check"></span> </label> <label contenteditable="true" for="three_' + id + '" class="poplinable font-text text-left floating-left">Three</label> <div class="delete_answer floating-right flaticon-x"></div> </label> <label for="four_' + id + '" class="dropable ans vresizable floating-left content-list"> <label class="answer4 input-control radio floating-left"> <input type="hidden"> <input type="radio" name="' + id + '" id="four_' + id + '" class="level_radio"> <span class="check"></span> </label> <label contenteditable="true" for="four_' + id + '" class="poplinable font-text text-left floating-left">Four</label> <div class="delete_answer floating-right flaticon-x"></div> </label></ul> </div> </div>';
                html = '<div class="answer-container"> <div class="section-radio"> <ul><label for="one_' + id + '" class="ans floating-left content-list"> <div class="dropable vresizable  "> <label class="answer1   input-control radio floating-left"> <input type="hidden"> <input type="radio" name="' + id + '" id="one_' + id + '" class="level_radio"> <span class="check"></span> </label> <label contenteditable="true" for="one_' + id + '" class="poplinable font-text text-left floating-left">One</label> <div class="delete_answer floating-right flaticon-x"></div> </div> </label> <label for="two_' + id + '" class="ans floating-left content-list"> <div class="dropable vresizable  "> <label class="answer2   input-control radio floating-left"> <input type="hidden"> <input type="radio" name="' + id + '"id="two_' + id + '" class="level_radio"> <span class="check"></span> </label> <label contenteditable="true" for="two_' + id + '" class="poplinable font-text text-left floating-left">Two</label> <div class="delete_answer floating-right flaticon-x"></div> </div> </label> <label for="three_' + id + '" class="ans floating-left content-list"> <div class="dropable vresizable  "> <label class="answer3 input-control radio floating-left"> <input type="hidden"> <input type="radio" name="' + id + '" id="three_' + id + '" class="level_radio"> <span class="check"></span> </label> <label contenteditable="true" for="three_' + id + '" class="poplinable font-text text-left floating-left">Three</label> <div class="delete_answer floating-right flaticon-x"></div> </div> </label> <label for="four_' + id + '" class="ans floating-left content-list"> <div class="dropable  vresizable  "> <label class="answer4 input-control radio floating-left"> <input type="hidden"> <input type="radio" name="' + id + '" id="four_' + id + '" class="level_radio"> <span class="check"></span> </label> <label contenteditable="true" for="four_' + id + '" class="poplinable font-text text-left floating-left">Four</label> <div class="delete_answer floating-right flaticon-x"></div> </div> </label> </ul> </div> </div>';
                break;
            case "3":
                //html = '<div class="answer-container"> <div class="section-check"> <ul><label for="one_' + id + '" class="dropable ans vresizable  floating-left content-list"> <label class="answer1   input-control checkbox new floating-left"> <input type="checkbox" name="' + id + '"  id="one_' + id + '"> <span class="check"></span> </label> <label contenteditable="true" for="one_' + id + '" class="poplinable font-text text-left floating-left">One</label> <div class="delete_answer floating-right flaticon-x"></div> </label> <label for="two_' + id + '" class="dropable ans vresizable  floating-left content-list"> <label class="answer2 input-control checkbox new floating-left"> <input type="hidden"> <input type="checkbox" name="' + id + '" id="two_' + id + '" class="level_check"> <span class="check"></span> </label> <label contenteditable="true" for="two_' + id + '" class="poplinable font-text text-left floating-left">Two</label> <div class="delete_answer floating-right flaticon-x"></div> </label> <label for="three_' + id + '" class="answer3 ans dropable vresizable floating-left content-list"> <label class=" input-control checkbox new floating-left"> <input type="hidden"> <input type="checkbox" name="' + id + '" id="three_' + id + '" class="level_check"> <span class="check"></span> </label> <label contenteditable="true" for="three_' + id + '" class="poplinable font-text text-left floating-left">Three</label> <div class="delete_answer floating-right flaticon-x"></div> </label> <label for="four_' + id + '" class="dropable ans vresizable floating-left content-list"> <label class="answer4 input-control checkbox new floating-left"> <input type="hidden"> <input type="checkbox" name="' + id + '" id="four_' + id + '" class="level_check"> <span class="check"></span> </label> <label contenteditable="true" for="four_' + id + '" class="poplinable font-text text-left floating-left">Four</label> <div class="delete_answer floating-right flaticon-x"></div> </label> </ul> </div> </div>';
                html = '<div class="answer-container"> <div class="section-check"> <ul><label for="one_' + id + '" class="ans answer1 floating-left content-list"> <div class="vresizable dropable "> <label class="input-control checkbox new floating-left"> <input type="checkbox" name="' + id + '" id="one_' + id + '"> <span class="check"></span> </label> <label contenteditable="true" for="one_' + id + '" class="poplinable font-text text-left floating-left">One</label> <div class="delete_answer floating-right flaticon-x"></div> </div> </label> <label for="two_' + id + '" class=" ans answer2 floating-left content-list"> <div class="vresizable dropable "> <label class=" input-control checkbox new floating-left"> <input type="hidden"> <input type="checkbox" name="' + id + '" id="two_' + id + '" class="level_check"> <span class="check"></span> </label> <label contenteditable="true" for="two_' + id + '" class="poplinable font-text text-left floating-left">Two</label> <div class="delete_answer floating-right flaticon-x"></div> </div> </label> <label for="three_' + id + '" class="answer3 ans floating-left content-list"> <div class="vresizable dropable "> <label class=" input-control checkbox new floating-left"> <input type="hidden"> <input type="checkbox"  name="' + id + '" id="three_' + id + '" class="level_check"> <span class="check"></span> </label> <label contenteditable="true" for="three_' + id + '" class="poplinable font-text text-left floating-left">Three</label> <div class="delete_answer floating-right flaticon-x"></div> </div> </label> <label for="four_' + id + '" class="answer4 ans floating-left content-list"> <div class="vresizable dropable "> <label class=" input-control checkbox new floating-left"> <input type="hidden"> <input type="checkbox" name="' + id + '" id="four_' + id + '" class="level_check"> <span class="check"></span> </label> <label contenteditable="true" for="four_' + id + '" class="poplinable font-text text-left floating-left">Four</label> <div class="delete_answer floating-right flaticon-x"></div> </div> </label> </ul> </div> </div>';
                break;
            case "4":
                html = '<div class="fill-in-the-blank ans"><label id="answers_' + id + '" contenteditable="true" class="poplinable font-text text-left floating-left fill_answer">Your Answer</label><div class="delete_answer floating-right flaticon-x"></div></div>';
                break;
            case "5":
                //html = '<div class="answer-container ans"> <div class="matcing-content "> <div class="matching-line-row"> <div class="floating-left match-box  dropable vresizable leftbox"> <div id="dl" class="resizable draggable element" style="width:150px;height:60px;position: absolute;top: 15px;left: 15px;"> <div class="delete_widget floating-right flaticon-x"></div> <div class="move_handler flaticon-more9"></div><div class="real-content"><span class="poplinable" contenteditable="true">Text</span></div> </div> </div> <div class="delete_answer floating-right flaticon-x"></div> <div class="floating-right match-box dropable vresizable rightbox"> <div id="dr" class="resizable draggable element" style="width:150px;height:60px;position: absolute;top: 15px;left: 15px;"> <div class="delete_widget floating-right flaticon-x"></div> <div class="move_handler flaticon-more9"></div> <div class="real-content"><span class="poplinable" contenteditable="true">Text</span></div> </div> </div> </div> </div> </div>';
                html = '<div class="answer-container ans"> <div class="matcing-content "> <div class="matching-line-row"> <div class="floating-left match-box  leftbox"> <div class="vresizable dropable"> <div id="dl" class="resizable draggable element" style="width:150px;height:60px;position: absolute;top: 15px;left: 15px;"> <div class="delete_widget floating-right flaticon-x"></div> <div class="move_handler flaticon-more9"></div> <div class="real-content"><span class="poplinable" contenteditable="true">Text</span></div> </div> </div> </div> <div class="delete_answer floating-right flaticon-x"></div> <div class="floating-right match-box  rightbox"> <div class="vresizable dropable"> <div id="dr" class="resizable draggable element" style="width:150px;height:60px;position: absolute;top: 15px;left: 15px;"> <div class="delete_widget floating-right flaticon-x"></div> <div class="move_handler flaticon-more9"></div> <div class="real-content"><span class="poplinable" contenteditable="true">Text</span></div> </div> </div> </div> </div> </div> </div>';
                break;
            case "7":
                html = '<div class="answer-container"> <div id="map_container" class="element resizable" style="width:100%;height:100%;position: relative;top: 0px;left: 0px;"> <div class="edit_widget edit_widget-a flaticon-pencil43" widget_type="image"></div> <div class="real-content remove-margin"><img id="map_image" src="image.jpg" style="width:100%;height: 100%"> <div class="draggable resizable circle-container ans" style="position: absolute;top:50px;width:50px;height:50px;"><div class="delete_answer floating-right flaticon-x"></div><div class="move_handler flaticon-more9 circle-handle"></div> <div class="circle-map"></div> </div> </div> </div> </div>';
                break;
            case "8":
                html = '<div class="short-essay ans"><label id="answers_' + id + '" contenteditable="true" class="poplinable font-text text-left floating-left essay_answer">Your Referrence</label></div>';
                break;
            case "9":
                html = '<div class="answer-container"> <ul id="sequance" class="ui-sortable"> <li class="ui-state-default ans"> <div class="delete_answer floating-right flaticon-x"></div> <a class="handle floating-right "><i class="flaticon-left3"></i></a> <label class="poplinable" contenteditable="true">Item 0</label> </li> <li class="ui-state-default ans"> <div class="delete_answer floating-right flaticon-x"></div> <a class="handle floating-right"><i class="flaticon-left3"></i></a> <label class="poplinable" contenteditable="true">Item 1</label> </li> <li class="ui-state-default ans"> <div class="delete_answer floating-right flaticon-x"></div> <a class="handle floating-right"><i class="flaticon-left3"></i></a> <label class="poplinable" contenteditable="true">Item 2</label> </li> <li class="ui-state-default ans"> <div class="delete_answer floating-right flaticon-x"></div> <a class="handle floating-right"><i class="flaticon-left3"></i></a> <label class="poplinable" contenteditable="true">Item 3</label> </li> </ul> </div>';
                break;
            case "10":
                html = '<div class="answer-container"><div class="poplinable" contenteditable="true" id="jq_fill_paragraph">Type your Paragraph</div><div id="word_container" class="words-container"></div> </div>';
                break;
        }
        $("#answer_container").html(html);
        refreshElement();
        $(".close").trigger("click");
    });
    $(".close").click(function () {
        $("#action_container").html("");
        $("#popup").fadeOut();

        $("#action_containerb").html("");
        $("#popup_action").fadeOut();
    });
    $(".poplinable").attr("contenteditable", "true");
    $(".jq_multi_file").each(function () {
        $(this).attr("src", $(this).attr("editor"));
        $(this).attr("data_src", $(this).attr("editor"));
    });
    hideLoading();
    $(document).on("change", "#goto", function () {
        savePage($(this).val()); //HIA26012016
    });
    $(document).on("change", "select", function () {
        conID = $(this).attr("id");
        $("#lbl" + conID).html($("#" + conID + " option:selected").text());
    });
    $(document).on("change", "input[type=file]", function () {
        conID = $(this).attr("id");
        $("#lbl" + conID).html($("#" + conID).val());
    });
    refreshElement();
    $(document).on("click", ".delete_widget", function () {
        $(this).closest(".element").remove();
    });
    $(".widget").click(function () {
        position = $(".selected_dropable").position();
        // Itop= (parseInt($(window).height()/6)+parseInt($(window).scrollTop())).toString();
        Itop = (parseInt($(".selected_dropable").height() / 2)).toString();
        //   Ileft=(parseInt($(window).width()/4)+parseInt($(window).scrollLeft())).toString();
        //Ileft = (parseInt($(".selected_dropable").width() / 2)).toString();
        Ileft = "25px";
        id = "widget_" + randomString(7);
        switch ($(this).attr("id")) {
            case "wtext":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:200px;height:100px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="delete_widget floating-right flaticon-x"></div><div class="move_handler flaticon-more9"></div><div class="real-content"><span class="poplinable" contenteditable="true">' + window.Lang.Text + '</span></div><div>';
                break;
            case "wvideo":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:420px;height: 315px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="delete_widget floating-right flaticon-x"></div><div class="edit_widget flaticon-pencil43" widget_type="video"></div><div class="real-content remove-margin"><iframe width="100%" height="100%" src="https://www.youtube.com/embed/sxUQsKxcOYM" frameborder="0" allowfullscreen></iframe></div><div>';
                break;
            case "wsound":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:400px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="delete_widget floating-right flaticon-x"></div><div class="edit_widget flaticon-pencil43" widget_type="audio"></div><div class="real-content"><audio controls><source src="sound.mp3" type="audio/mpeg"></audio></div><div>';
                break;
            case "wimage":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:200px;height:200px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="delete_widget floating-right flaticon-x"></div><div class="edit_widget flaticon-pencil43" widget_type="image"></div><div class="real-content remove-margin"><img src="image.jpg" style="width:100%;height: 100%"></div><div>';
                break;
        }
        // $(".question").append(html);
        $(".selected_dropable").append(html);
        refreshElement();
    });
    //Editors
    $(document).on("click", "#update_video", function () {
        if ($("#youtube").val().trim() != "") {
            youtubeID = youtube_getID($("#youtube").val());
            selector = "#" + $("#video_id").val();
            $(selector).find(".real-content").first().html('<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' + youtubeID + '" frameborder="0" allowfullscreen></iframe>');
            $("#action_containerb").html("");
            $("#popup_action").fadeOut();
        }else{
            $("#video_form").attr("action", "ajax/editor.php?process=quiz_updatevideo&quizid=" + window.quizid);
            $("#video_form").submit();
            showLoading();
        }
    });
    $("#qtype").click(function () {
        $("#action_container").html($("#types").html());
        $("#popup").fadeIn();

    });
    $(document).on("click", "#update_sound ", function () {
        $("#sound_form").attr("action", "ajax/editor.php?process=updatesound&quizid=" + window.quizid);
        $("#sound_form").submit();
        showLoading();
    });
    $(document).on("click", "#update_image", function () {
        $("#image_form").attr("action", "ajax/editor.php?process=quiz_updateimage&quizid=" + window.quizid);
        $("#image_form").submit();
        showLoading();
    });
    $(document).on("click", ".edit_widget", function () {
        switch ($(this).attr("widget_type")) {
            case "video":
                $("#action_containerb").load("quiz_video.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "audio":
                $("#action_containerb").load("quiz_sound.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "image":
                $("#action_containerb").load("quiz_image.php?id=" + $(this).closest(".element").attr("id"));
                break;
        }
        $("#popup_action").fadeIn();
    });

    $("#newquestion").click(function () {
        savePage(-2);//HIA26012016
    });
    $("#deletequestion").click(function () {//HIA26012016
        swal({
            title: window.Lang.DeleteQuestion,
            text: window.Lang.AreyousureDeleteQuestion,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: window.Lang.YesDeletePage,
            closeOnConfirm: false
        }, function () {
            $.ajax({
                method: "POST",
                url: "ajax/editor.php?process=deletequistion&questionid=" + window.questionid + "&quizid=" + window.quizid,
                success: function (data) {
                    window.location.href = "quiz_editor.php?quizid=" + window.quizid;
                }
            });
        });

    });
    $("#save").click(function () {//HIA26012016
        savePage(-1);
    });

});

function refreshElement() {
    $("#sequance").sortable({
        axis: 'y',
        handle:".handle"
    });
    $(".resizable").resizable();
    $(".vresizable").resizable({
        handles: 's'
    });

    $(".draggable").draggable({
        handle: ".move_handler",
        stop: function () {
            var l = ( 100 * parseFloat($(this).css("left")) / parseFloat($(".selected_dropable").css("width")) ) + "%";
            var t = ( 100 * parseFloat($(this).css("top")) / parseFloat($(".selected_dropable").css("height")) ) + "%";
            $(this).css("left", l);
            $(this).css("top", t);
        }
    });
    document.execCommand('defaultParagraphSeparator', false, 'p');
    $(".poplinable").popline({position: "fixed"});
    $("input[name='position']").click(function () {
        $(".editor").popline("setPosition", this.id);
    });
}
function youtube_getID(url) {
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    return (match && match[7].length == 11) ? match[7] : false;
}
function randomString(len) {
    charSet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var randomString = '';
    for (var i = 0; i < len; i++) {
        var randomPoz = Math.floor(Math.random() * charSet.length);
        randomString += charSet.substring(randomPoz, randomPoz + 1);
    }
    return randomString;
}
function closePopup() {
    $("#action_container").html("");
    $("#popup").fadeOut();
    $("#action_containerb").html("");
    $("#popup_action").fadeOut();
}
function showMsg(type, title, message) {
    switch (type) {
        case "error":
            sweetAlert(title, message, "error");
            break;
    }
}
function showLoading() {
    $(".loader-table").fadeIn();
}
function hideLoading() {
    $(".loader-table").fadeOut();
}
function savePage(goTO) {

    showLoading();
    hideEditorElement();
    showEditorElement();
    $(".resizable").resizable("destroy");
    $(".vresizable ").resizable("destroy");
    $(".ui-resizable-handle").remove();

    $(".draggable").draggable("destroy");

    $(".poplinable").attr("contenteditable", "false");
    $(".jq_multi_file").each(function () {
        $(this).attr("src", $(this).attr("publish"));
        $(this).attr("data_src", $(this).attr("publish"));
    });
    q = goTO;

    var question = $('#question_container').wrap('<div></div>').parent().html();
    var answer_html = $('#answer_container').wrap('<div></div>').parent().html();
    var cfeedback = $("#correctfeedback").val();
    var ifeedback = $("#incorrectfeedback").val();
    var cpoints = $("#correctpoints").val();
    var ipoints = $("#incorrectpoints").val();
    var data;



    switch (window.questionType.toString()) {
        case "1"://true & false
            answer1 = $(".answer1").html();
            answer2 = $(".answer2").html();
            correct = $("radio:checked").closest(".dropable").first();
            if (correct.hasClass("answer1")) {
                correct1 = 0;
                correct2 = 1;
            } else {
                correct1 = 1;
                correct2 = 0;
            }
            data = {
                'question': question,
                "answer1": answer1,
                "answer2": answer2,
                "correct1": correct1,
                "correct2": correct2,
                "type": 1,
                "cfeedback": cfeedback,
                "ifeedback": ifeedback,
                "cpoints": cpoints,
                "ipoints": ipoints,
                "answer_html": answer_html
            };

            break;
        case "2"://Multible Choice
        case "6":
            answers = '';
            i = 0;
            $(".ans").each(function () {
                ahtml = $(this).clone();
                ahtml.find("input:radio").remove();
                ahtml.find(".delete_answer").remove();
                if ($(this).find("input:radio").first().is(":checked")) {
                    c = "1";
                } else {
                    c = "0";
                }
                answers += 'manhal@answer@seperatorAmanhal@bair@seperator' + ahtml.html() + 'manhal@item@seperatorCmanhal@bair@seperator' + c;
                i++;
            });
            answer = JSON.stringify(answers.substr(23));
            console.log("aa", answer);
            data = {
                'question': question,
                "answer": answer,
                "type": window.questionType,
                "cfeedback": cfeedback,
                "ifeedback": ifeedback,
                "cpoints": cpoints,
                "ipoints": ipoints,
                "answer_html": answer_html
            };
            break;
        case "3"://Multible Response
            answers = '';
            i = 0;
            $(".ans").each(function () {
                ahtml = $(this).clone();
                ahtml.find("input:checkbox").remove();
                ahtml.find(".delete_answer").remove();
                if ($(this).find("input:checkbox").first().is(":checked")) {
                    c = "1";
                } else {
                    c = "0";
                }
                answers += 'manhal@answer@seperatorAmanhal@bair@seperator' + ahtml.html() + 'manhal@item@seperatorCmanhal@bair@seperator' + c;
                i++;
            });
            answer = JSON.stringify(answers.substr(23));
            data = {
                'question': question,
                "answer": answer,
                "type": 3,
                "cfeedback": cfeedback,
                "ifeedback": ifeedback,
                "cpoints": cpoints,
                "ipoints": ipoints,
                "answer_html": answer_html
            };
            break;
        case "4":
            answers ="";
            $(".ans").each(function () {
                answers +='manhal@answer@seperator' + $(this).find("label").first().html();
            });
            answer = JSON.stringify(answers.substr(23));
            data = {
                "question": question,
                "answer": answer,
                "type": 4,
                "cfeedback": cfeedback,
                "ifeedback": ifeedback,
                "cpoints": cpoints,
                "ipoints": ipoints,
                "answer_html": answer_html
            };
            break;
        case "5":
            answers = '';
            $(".ans").each(function () {
                answers += 'manhal@answer@seperator' + $(this).find(".leftbox").first().html()+'manhal@column@seperator'+$(this).find(".rightbox").first().html();
            });

            answer = JSON.stringify(answers.substr(23));
            data = {
                'question': question,
                "answer": answer,
                "type": 5,
                "cfeedback": cfeedback,
                "ifeedback": ifeedback,
                "cpoints": cpoints,
                "ipoints": ipoints,
                "answer_html": answer_html
            };
            break;
        case "7":
        answers = '';
        $(".circle-map").each(function () {
            answers += 'manhal@answer@seperator' + $(this).width()+'manhal@parameter@seperator'+$(this).height()+'manhal@parameter@seperator'+$(this).closest(".circle-container").css("top")+'manhal@parameter@seperator'+$(this).closest(".circle-container").css("left");
        });

        answer = JSON.stringify(answers.substr(23));
        data = {
            'question': question,
            "answer": answer,
            "type": 7,
            "image":$("#map_image").attr("publish"),
            "cfeedback": cfeedback,
            "ifeedback": ifeedback,
            "cpoints": cpoints,
            "ipoints": ipoints,
            "answer_html": answer_html
        };
        break;
        case "8":
            data = {
                'question': question,
                "answer": $(".essay_answer").first().html(),
                "type": 8,
                "image":$("#map_image").attr("publish"),
                "cfeedback": cfeedback,
                "ifeedback": ifeedback,
                "cpoints": cpoints,
                "ipoints": ipoints,
                "answer_html": answer_html
            };
            break;
        case "9":
            answers = '';
            i=1;
            $(".ans").each(function () {
                answers += 'manhal@answer@seperator' + $(this).find(".poplinable").first().html()+'manhal@parameter@seperator'+i;
                i++;
            });

            answer = JSON.stringify(answers.substr(23));
            data = {
                'question': question,
                "answer": answer,
                "type": 9,
                "image":$("#map_image").attr("publish"),
                "cfeedback": cfeedback,
                "ifeedback": ifeedback,
                "cpoints": cpoints,
                "ipoints": ipoints,
                "answer_html": answer_html
            };
            break;
        case "10":
            answers = '';
            $(".ans").each(function () {
                if($(this).find(".delete_answer").first().attr("tolabel")!=""){
                    ansID=$(this).find(".delete_answer").first().attr("tolabel");
                }else{
                    ansID="error_"+randomString(5);
                }
                answers += 'manhal@answer@seperator' + ansID+'manhal@parameter@seperator'+$(this).find("label").first().html();
            });

            answer = JSON.stringify(answers.substr(23));
            data = {
                'question': question,
                "answer": answer,
                "paragraph":$("#jq_fill_paragraph").html(),
                "type": 10,
                "cfeedback": cfeedback,
                "ifeedback": ifeedback,
                "cpoints": cpoints,
                "ipoints": ipoints,
                "answer_html": answer_html
            };
            break;

    }


    $.ajax({
        method: "POST",
        url: "ajax/editor.php?process=savequestion&quizid=" + window.quizid + "&questionid=" + window.questionid,
        data: data,
        success: function (data) {
            console.log(data);
            $(".jq_multi_file").each(function () {
                $(this).attr("src", $(this).attr("editor"));
                $(this).attr("data_src", $(this).attr("editor"));
            });
            ///$("#question_container").attr("style",containerstyle);
            $(".poplinable").attr("contenteditable", "true");

            refreshElement();
            hideLoading();
            if (q == -2) {//newPage
                window.location.href = "quiz_editor.php?type=new&quizid=" + window.quizid;
            } else if (q != -1) {
                window.location.href = "quiz_editor.php?quizid=" + window.quizid + "&questionid=" + q;
            }
        }
    });
}
function hideEditorElement() {
    $(".delete_widget").hide();
    $(".edit_widget").hide();
    $(".move_handler").hide();
    $(".ui-resizable-handle").hide();
    $(".element ").css("border", "none");
}
function showEditorElement() {
    $(".delete_widget").show();
    $(".edit_widget").show();
    $(".move_handler").show();
    $(".ui-resizable-handle").show();
    $(".element ").css("border", "dashed 1px red");
}
function showAddAnswer(){
    switch (window.questionType){
        case "2":
        case "3":
        case "4":
        case "5":
        case "6":
        case "7":
        case "9":
        case "10":
            $("#add_answer").show();
            break;
        default :
            $("#add_answer").hide();
            break;
    }
}

function CutText(){
    id="fill_"+randomString(5);
    data=insertTextAtCursor(" .... ");
    $("#word_container").append("<div class='ans'><div class='delete_answer floating-right flaticon-x' tolabel='"+data['id']+"' ></div><label class='poplinable' contenteditable='true'>"+data['word']+"</label></div>");
    refreshElement();
}


function insertTextAtCursor(text) {
    var sel, range, textNode,selectedText,id;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0).cloneRange();
            selectedText=range.cloneContents().textContent;
            range.deleteContents();
          //  textNode = document.createTextNode(text);
            textNode = document.createElement("span");
            id="fill_"+randomString(5);
            textNode.id=id;
            textNode.textContent=text;
            range.insertNode(textNode);

            // Move caret to the end of the newly inserted text node
            range.setStart(textNode, textNode.length);
            range.setEnd(textNode, textNode.length);
            sel.removeAllRanges();
            sel.addRange(range);
        }
    } else if (document.selection && document.selection.createRange) {
        range = document.selection.createRange();
        range.pasteHTML(text);
    }
    return {id:id,word:selectedText};
}