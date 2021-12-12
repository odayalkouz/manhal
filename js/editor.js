/**
 * Created by Hussam Abu Khaidejh on 1/5/2016.
 */
//window.bookid=1;//ToDo save book id in this variable
//window.pageid=1;//ToDo save book id in this variable
window.BookLang = "En";//ToDo save book id in this variable
arabic_harakat = ["ُ", "ْ", "َ", "ِ", "ّ", "~", "ً", "ٍ", "ٌ"];
arabic_conn_char = ["و", "ا", "د", "ذ", "ر", "ز", "لإ", "لأ", "إ", "أ", "آ", "لآ"];
arabic_l_char = ["ا", "ع", "غ", "ة", "أ", "إ"];
function spillWord(word1) {
    clickWord1 = "";
    charIndex = 0;

    if (window.BookLang == "Ar") {
        for (var i = 0, len = word1.length; i < len; i++) {
            if ($.inArray(word1[i], arabic_harakat) == -1) {
                fixA = "";
                if (word1[i] != "ـ") {
                    if ($.inArray(word1[i], arabic_conn_char) == -1 && i < word1.length - 1) {
                        temp_word = word1[i] + "ـ";
                    } else {
                        if ($.inArray(word1[i], arabic_l_char) != -1 && i > 0) {
                            if ($.inArray(word1[i - 1], arabic_conn_char) == -1) {
                                fixA = "ـ";
                            }
                        }
                        temp_word = fixA + word1[i];
                    }

                    clickWord1 += '<span class="jq_char" id="word1_' + i + '" char-index="' + charIndex + '">' + temp_word + '</span>';
                    charIndex++;
                    if (i < word1.length - 1 && $.inArray(word1[i], arabic_conn_char) == -1) {
                        clickWord1 += "ـ";
                    }
                } else {
                    //clickWord1+="ـ";
                }
            } else {
                clickWord1 += '<span class="jq_char" id="word1_' + i + '" char-index="-1">' + temp_word + '</span>';
            }

        }

        return clickWord1;
    } else {
        for (var i = 0, len = word1.length; i < len; i++) {
            clickWord1 += '<span class="jq_char" id="word1_' + i + '" char-index="' + charIndex + '">' + word1[i] + '</span>';
            charIndex++;
        }
        return clickWord1;
    }

}
function uploadEffectSound() {
    $("#effect_sound_form").attr("action", "ajax/editor.php?process=uploadSoundEffect&bookid=" + window.bookid + "&pageid=" + realPageNumber(window.pageid));
    $("#effect_sound_form").submit();
}
function UpdateSoundEffect(sound) {

    soundID = getSoundID(sound);
    publishPath = sound.replace("books/" + window.bookid + "/", "");
    if ($("#" + soundID)[0] == undefined) {
        $("#demoImageAnimation").closest("div").append('<audio style="display: none;" id="' + soundID + '"><source class="jq_multi_file" editor="' + sound + '" publish="' + publishPath + '"  src="' + sound + '" type="audio/mpeg"></audio>');
    } else {
        $("#" + soundID).find('<source>').attr("src", sound);
        $("#" + soundID).find('<source>').attr("editor", sound);
        $("#" + soundID).find('<source>').attr("publish", publishPath);
    }
    $(".jq_animation.selected").attr("data-sound", sound);
    updateAnimation();
}
function getSoundID(path) {

    exp = path.split("/");
    names = exp[exp.length - 1];

    nameArr = names.split(".");

    return nameArr[0];

}
function updateAnimation() {
    $("#demoImageAnimation").attr("class", "animated");
    $("#demoImageAnimation").attr("data-animation", "");
    $("#demoImageAnimation").attr("data-animation-timer", "");
    $(".jq_animation").each(function () {
        switch ($(this).attr("data-animation-type")) {
            case "default":
                $("#demoImageAnimation").addClass($(this).attr("data-animation"));
                $("#demoImageAnimation").attr("default-animation", $(this).attr("data-animation"));
                if ($(this).hasClass("jq_infinite")) {
                    $("#demoImageAnimation").addClass("infinite");
                }
                break;
            case "click":
                $("#demoImageAnimation").addClass("jq_click");

                if ($("#demoImageAnimation").attr("data-animation") == undefined) {
                    oldAnimation = "";
                } else {
                    oldAnimation = $("#demoImageAnimation").attr("data-animation");
                }
                $("#demoImageAnimation").attr("data-animation", oldAnimation + $(this).attr("data-animation") + "@" + $(this).hasClass("jq_infinite") + "@" + $(this).attr("data-sound") + ",");
                break;
            case "timer":
                $("#demoImageAnimation").addClass("jq_timer");
                if ($("#demoImageAnimation").attr("data-animation-timer") == undefined) {
                    oldAnimation = "";
                } else {
                    oldAnimation = $("#demoImageAnimation").attr("data-animation-timer");
                }
                $("#demoImageAnimation").attr("data-animation-timer", oldAnimation + $(this).attr("data-animation") + "@" + $(this).attr("data-time") + "@" + $(this).hasClass(".jq_infinite") + "@" + $(this).attr("data-sound") + ",");
                break;
        }
    });
}
function timerAnimate(obj, animation, time, infinite, sound) {
    setTimeout(function () {
        if (infinite == "true") {
            obj.addClass("infinite");
        } else {
            obj.removeClass("infinite");
        }
        obj.attr("class", "animated jq_timer");
        obj.addClass(animation);
        if (sound !== "" && sound != undefined && sound != "undefined") {
            soundID = getSoundID(sound);
            $("#" + soundID)[0].play();
        }

    }, time);
}

function animatePopOutImage(){
    $('.image-popup-no-margins').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });
}
$(document).ready(function () {


    $(document).on("click",".jq_layer",function(){
       if($(this).prop("checked")){
           $("#"+$(this).attr("data-id")).show();
       }else{
           $("#"+$(this).attr("data-id")).hide();
       }

    });

    $(document).on("click",".row-layer",function(){
        $(".element").removeClass("selected");
        $("#"+$(this).attr("data-id")).addClass("selected");
        zindex = 1;
        $(".element").each(function () {
            if (parseInt($(this).css("z-index")) > zindex) {
                zindex = parseInt($(this).css("z-index"));
            }
        });
        zindex += 1;
        $("#"+$(this).attr("data-id")).css("z-index", zindex);
    });

    $("#hide_widget").click(function(){
        $(".element").hide();
    });
    $("#show_widget").click(function(){
        $(".element").show();
    });


    $(document).on("click", ".jq_updateunit", function () {
        page = realPageNumber()-1;
        id= $("#jq_unittitle").attr("data-id");
        $.ajax({
            url: "ajax/editor.php?process=updateunit&unitid="+(id).toString()+"&bookid=" + window.bookid + "&unitname=" + $("#jq_unittitle").val() + "&pagenumber=" + page,
            type: "POST",
            cache: false,
            dataType: 'html',
            success: function (html) {
                console.log("html=",html);
                $(".close").click();
            }
        });
    });

    $(document).on("click", ".jq_updateindex", function () {
        page=-1;
        if($("#lessons").val()!=-1){
            page=parseInt($('option:selected',$("#lessons")[0]).attr('pageid'))+3;
        }else if($("#units").val()!=-1){
            page=parseInt($('option:selected',$("#units")[0]).attr('pageid'))+3;
        }else{
            showMsg("error","No Selection","Please Select unit or lesson")
        }
        if(page!=-1){
            selector="#"+$(this).attr("widgetid");
            $(selector).find(".real-content").addClass("goto");
            $(selector).find(".real-content").attr("goto",page);
            $("#popup_action").fadeOut();
        }
    });
    $(document).on("click", ".jq_updatelesson", function () {
        page = realPageNumber()-1;
        id= $("#jq_lessontitle").attr("data-id");
        $.ajax({
            url: "ajax/editor.php?process=updatelesson&lessonid="+(id).toString()+"&bookid=" + window.bookid + "&lessonname=" + $("#jq_lessontitle").val() + "&pagenumber=" + page + "&unitid=" + $("#units").val(),
            type: "POST",
            cache: false,
            dataType: 'html',
            success: function (html) {
                console.log("html=",html);
                $(".close").click();
            }
        });
    });
    $(document).on("click", ".jq_addunit", function () {
        $("#jq_lessondiv").hide();
        $("#jq_unitdiv").fadeIn();
        $("#jq_unittitle").val("");
        $("#jq_unittitle").attr("data-id","new");
    });
    $(document).on("click", ".jq_addlesson", function () {
        $("#jq_unitdiv").hide();
        $("#jq_lessondiv").fadeIn();
        $("#jq_lessontitle").val("");
        $("#jq_lessontitle").attr("data-id","new");
    });
    $(document).on("click",".jq_editeunit", function () {
        $("#jq_lessondiv").hide();
        $("#jq_unitdiv").fadeIn();
        $("#jq_unittitle").val($("#units option:selected").text());
        $("#jq_unittitle").attr("data-id",$("#units").val());
    });
    $(document).on("click",".jq_editelesson", function () {
        $("#jq_unitdiv").hide();
        $("#jq_lessondiv").fadeIn();
        $("#jq_lessontitle").val($("#lessons option:selected").text());
        $("#jq_lessontitle").attr("data-id",$("#lessons").val());
    });

    $(document).on("click",".jq_deleteunit", function () {
        swal({
            title: window.Lang.RUSure,
            text: window.Lang.DoYouWantDeleteUnit,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: window.Lang.Yesdeleteit,
            closeOnConfirm: false
        }, function () {
            $.ajax({
                method: "POST",
                url: "ajax/editor.php?process=deleteunit&unitid=" + $("#units").val() + "&bookid=" + window.bookid,
                success: function (data) {
                    console.log(data);
                    $("#booklessons").click();
                    swal(window.Lang['Deleted'],window.Lang['unitdeletedsuccess'],'success');
                }
            });
        });

    });

    $(document).on("click",".jq_deletelesson", function () {
        swal({
            title: window.Lang.RUSure,
            text: window.Lang.DoYouWantDeleteLesson,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: window.Lang.Yesdeleteit,
            closeOnConfirm: false
        }, function () {
            $.ajax({
                method: "POST",
                url: "ajax/editor.php?process=deletelesson&lessonid=" + $("#lessons").val() + "&bookid=" + window.bookid,
                success: function (data) {
                    console.log(data);
                    $("#booklessons").click();
                    swal(window.Lang['Deleted'],window.Lang['Lessondeletedsuccess'],'success');
                }
            });
        });
    });

    $("#fix_element").click(function () {
        $(".element").each(function(){
            if($(this).find(".index_widget").length==0){
                $(this).prepend('<div class="index_widget  flaticon-list6" widget_type="index"></div>');
            }
        });
    });

    $(document).on("change", "#gametype", function () {
        id = $("#update_game").attr("widget_id");
        $("#action_containerb").load("games_widget.php?id=" + id + "&gametype=" + $("#gametype").val() + "&grade=" + $("#gamegrade").val());
    });
    $(document).on("change", "#gamegrade", function () {
        id = $("#update_game").attr("widget_id");
        $("#action_containerb").load("games_widget.php?id=" + id + "&gametype=" + $("#gametype").val() + "&grade=" + $("#gamegrade").val());
    });
    $(document).on("click", "#update_quiz", function () {
        $("#" + $("#update_quiz").attr("widget_id")).find(".doaction").attr("quiz_path", SITE_URL+"platform/quiz/view/"+($("#select_quiz option:selected").attr("lang")).toLowerCase()+"/index.php?id="+$("#select_quiz ").val());
        $("#popup_action").fadeOut();
    });
    $(document).on("click", "#update_game", function () {
        $.ajax({
            url: "ajax/editor.php?process=copygame&gameid=" + $("#select_game").val() + "&bookid=" + window.bookid,
            type: "POST",
            cache: false,
            dataType: 'html',
            success: function (html) {
                $("#" + $("#update_game").attr("widget_id")).find(".doaction").attr("game_path", html);
                $("#" + $("#update_game").attr("widget_id")).find(".doaction").attr("title", $("#select_game option:selected").text());
                $("#popup_action").fadeOut();
            }
        });
    });
    setTimeout(function () {
        $(".page_container").css("background", "");
    }, 500);
    $(document).on("click", ".delete-animation", function () {
        $(this).closest(".jq_animation").remove();
        updateAnimation();
    });
    $(document).on("click", ".jq_click", function () {
        $(this).attr("class", "animated jq_click");
        clickedAnchor = $(this);
        setTimeout(function () {
            animations = clickedAnchor.attr("data-animation").split(",");
            for (i = 0; i < animations.length; i++) {
                if (animations[i] != "" && animations[i] != undefined) {
                    options = animations[i].split("@");
                    if (options[1] == "true") {
                        clickedAnchor.addClass("infinite");
                    } else {
                        clickedAnchor.removeClass("infinite");
                    }

                    if (options[2] != "" && options[2] != undefined && typeof options[2] != 'undefined' && options[2] != "undefined") {
                        //console.log("asdasdasd",options[2]);
                        soundID = getSoundID(options[2]);
                        $("#" + soundID)[0].play();
                    }
                    clickedAnchor.addClass(options[0]);
                }
            }
        }, 5);

    });
    $(document).on("click", ".jq_timer", function () {
        $(this).attr("class", "animated jq_timer");
        clickedAnchor = $(this);
        setTimeout(function () {
            animations = clickedAnchor.attr("data-animation-timer").split(",");
            for (i = 0; i < animations.length; i++) {
                if (animations[i] != "" && animations[i] != undefined) {
                    options = animations[i].split("@");
                    timerAnimate(clickedAnchor, options[0], parseInt(options[1]), options[2], options[3]);
                }
            }
        }, 5);

    });
    $(document).on("click", "#update_animation", function () {
        updateAnimation();
        if ($("#animation_" + window.widgetID)[0] == undefined) {
            $("#" + window.widgetID).find(".real-content").wrap('<div id="animation_' + window.widgetID + '"></div>');
        }
        el = $("#animation_" + window.widgetID);
        el.attr("data-animation", $("#demoImageAnimation").attr("data-animation"));
        el.attr("default-animation", $("#demoImageAnimation").attr("default-animation"));
        el.attr("data-animation-timer", $("#demoImageAnimation").attr("data-animation-timer"));
        el.attr("class", $("#demoImageAnimation").attr("class"));
        el.find("audio").remove();
        $("#demoImageAnimation").closest("div").find("audio").each(function () {
            el.append($(this).clone());
        });
        $("#popup_action").fadeOut();
    });
    $(document).on("change", "#animation_time", function () {
        $(".jq_animation.selected").attr("data-time", $("#animation_time").val());
        updateAnimation();
    });
    $(document).on("click", ".jq_animation", function () {
        $("#animation_action").val($(this).attr("data-animation"));

        $(this).addClass("selected").siblings().removeClass("selected");
        if ($(this).hasClass("jq_infinite")) {
            $("#infinite").prop("checked", true);
        } else {
            $("#infinite").prop("checked", false);
        }
    });
    $(document).on("click", "#infinite", function () {
        if ($(this).prop("checked")) {
            $(".jq_animation.selected").addClass("jq_infinite");
        } else {
            $(".jq_animation.selected").removeClass("jq_infinite");
        }
        updateAnimation();
    });
    $(document).on("change", ".jq_animation_type", function () {
        $(this).closest(".jq_animation").attr("data-animation-type", $(this).val());
        updateAnimation();
    });
    $(document).on("change", "#animation_action", function () {
        $(".jq_animation.selected").attr("data-animation", $(this).val());
        updateAnimation();
    });
    $(document).on("change", ".jq_animation_type", function () {
        if ($(this).val() == "timer") {
            $("#jq_timer").slideDown();
        } else {
            $("#jq_timer").slideUp();
        }
        updateAnimation();
    });
    $(document).on("click", ".add-animation-btn", function () {
        $(".jq_animation").removeClass("selected");
        $("#jq_timer").hide();
        html = '<a class="line-row-d jq_animation selected" data-animation-type="default" data-animation="bounce" data-time="1000"> <div class="delete-animation"><i class="flaticon-delete96"></i></div> <label class="floating-left lbl-data-a">Animation</label> <select class="ddl-animation-action txt-a jq_animation_type"> <option value="default">Default</option> <option value="click">On Click</option> <option value="timer">Timer</option> </select> </a>';
        $("#animation_container").append(html);
    });
    $(document).on("click", ".animate_widget", function () {
        window.widgetID = $(this).closest(".element").attr("id");
        $("#action_containerb").load("animationimage.php?id=" + $(this).closest(".element").attr("id"));
        $("#popup_action").fadeIn();
    });
    $(document).on("click", ".index_widget", function () {
        window.widgetID = $(this).closest(".element").attr("id");
        $("#action_containerb").load("indexwidget.php?bookid="+bookid+"&id=" + $(this).closest(".element").attr("id"));
        $("#popup_action").fadeIn();
    });
    $(document).on("click", "#update_circle", function () {
        main = $(this);
        showLoading();
        i = 0;
        data_thumbs = [];
        data_word = "";
        data_true = "";
        $("#circlecontainer .right-container").each(function () {
            data_word += $(this).find(".word-a").attr("data-text") + ",";
            data_thumbs[i] = $(this).find(".background").attr("style");
            temp_true = "";
            $(this).find(".colored").each(function () {
                temp_true += $(this).attr("char-index") + "@";
            });
            data_true += temp_true + ",";
            i++;
        });


        thumbs = JSON.stringify(data_thumbs);
        page = realPageNumber();
        $.ajax({
            url: "ajax/editor.php?process=savecircle&bookid=" + bookid + "&pageid=" + page,
            type: "POST",
            data: {"thumbs": thumbs},
            cache: false,
            dataType: 'html',
            success: function (html) {

                thumbs = html.split("@manhal@seperator@");
                doaction = $("#" + main.attr("widget_id")).find(".doaction").first();
                for (i = 0; i < thumbs.length; i++) {
                    r = i + 1;
                    doaction.attr("data-thumb" + r, thumbs[i]);
                }
                //console.log("data-word",data_true);
                doaction.attr("data-word", data_word);
                doaction.attr("data-true", data_true);
                doaction.attr("title", $("#circle_title").val());
                hideLoading();
                closePopup();

            }
        });
    });
    $(document).on("click", ".jq_char", function () {
        if ($(this).hasClass("colored") == true) {
            $(this).removeClass("colored");
        } else {
            $(this).addClass("colored");
        }
    });
    $(document).on("click", ".save-circle-word", function () {
        $(".word-a").show();
        $(".word-b").hide();
        $(this).closest(".right-container").find(".word-a").attr("data-text", $("#word_text").val());
        $(this).closest(".right-container").find(".word-a").find("label").html(spillWord($("#word_text").val()));
        $("#word_text").remove();
        $(this).closest(".right-container").find("label").show();
        $(this).closest(".right-container").find(".edit-circle").show();
        $(this).hide();
    });
    $(document).on("click", ".edit-circle", function () {
        $(this).closest(".word-a").hide();
        $(".word-b").show();
        $(this).closest(".word").find("label").hide();
        $(this).hide();
        $(this).closest(".right-container").find(".word-b").append('<input class="word-input-a" id="word_text" type="text" value="' + $(this).closest(".word").attr("data-text") + '">');
        $(this).closest(".right-container").find('.save-circle-word').css("display", "block");
    });
    $(document).on("click", "#addcircle", function () {
        //console.log("rrrr");
        if ($("#circlecontainer .right-container").length < 6) {
            html = '<div class="right-container"> <div class="background" style="background:url(img/Garaafe.png) no-repeat;"> <a><i class="flaticon-delete96 jq_deletecircle floating-right"></i></a> <div class="fu-container-b-container"><div class="fu-container-b floating-left"> <label class="floating-left flaticon-cloud148 label-a"></label> <label class="floating-left label-b" id="lblimage"></label> <input type="file" class="word_file" onchange="readURLWord(this);"> </div></div> </div> <div class="word word-a" data-text="Text"> <label><span class="jq_char" id="word1_0" char-index="0">T</span><span class="jq_char" id="word1_1" char-index="1">e</span><span class="jq_char" id="word1_2" char-index="2">x</span><span class="jq_char" id="word1_3" char-index="3">t</span></label> <a class="edit-circle"><i class="flaticon-pencil43"></i></a> </div> <div class="word-input word-b" data-text="Text"> <a class="floating-left save-circle-word" ><i class="flaticon-save31"></i></a> </div> </div>';
            $("#circlecontainer").append(html);
            $("#circle_maincontainer").attr("class", "").addClass("circle-container-" + $("#circlecontainer .right-container").length);
        } else {
            //error
        }
    });
    $(document).on("click", ".jq_deletecircle", function () {
        $(this).closest(".right-container").remove();

        c = $("#circlecontainer .right-container").length;
        if (c == 0) {
            c = 1;
        }
        $("#circle_maincontainer").attr("class", "").addClass("circle-container-" + c);
    });
    var context = $('.page_container')
        .nuContextMenu({
            hideAfterClick: true,
            items: '.move_handler',
            callback: function (key, element) {
                switch (key) {
                    case "Copy":
                        c = $(element).closest(".element").clone();
                        id = "widget_" + randomString(7);
                        c.attr("id", id);
                        Itop = (parseInt($(window).height() / 6) + parseInt($(window).scrollTop()) - 100).toString();
                        c.css("top", Itop);
                        c.find(".ui-resizable-handle").remove();
                        $("#copier").append(c);
                        localStorage.copywidget = $("#copier").html();
                        break;
                    case "Paste":
                        $(".resizable").resizable("destroy");
                        $(".page").append(localStorage.copywidget);
                        refreshElement();
                        break;
                    case "Bringtofront":
                        zindex = 1;
                        $(".element").each(function () {
                            if (parseInt($(this).css("z-index")) > zindex) {
                                zindex = parseInt($(this).css("z-index"));
                            }
                        });
                        zindex += 1;
                        $(element).closest(".element").css("z-index", zindex);

                        break;
                    case "Sendtoback":

                        zindex = -1;
                        $(".element").each(function () {
                            if (parseInt($(this).css("z-index")) < zindex) {
                                zindex = parseInt($(this).css("z-index"));
                            }
                        });
                        zindex -= 1;
                        $(element).closest(".element").css("z-index", zindex);
                        break;
                }
            },
            menu: [
                {
                    name: 'Copy',
                    title: 'Copy',
                    icon: 'copy',
                },
                {
                    name: 'Paste',
                    title: 'Paste',
                    icon: 'paste',
                },
                {
                    name: 'void'
                },
                {
                    name: 'delete',
                    title: 'Delete',
                    icon: 'trash',
                },
                {
                    name: 'void'
                },
                {
                    name: 'Bringtofront',
                    title: 'Bring to front',
                    icon: 'Bringtofront',
                },
                {
                    name: 'Sendtoback',
                    title: 'Send to back',
                    icon: 'Sendtoback',
                },
            ]

        });


    $(".poplinable").attr("contenteditable", "true");

    $(".jq_multi_file").each(function () {
        $(this).attr("src", $(this).attr("editor"));
        $(this).attr("data_src", $(this).attr("editor"));
    });
    hideLoading();

    $(document).on("change", "#goto", function () {
        savePage($(this).val());
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
    editorBackground();


    $(document).on("click", ".site-container,.action-content", function () {
        $("#action").removeClass("open");
        $(".action-content").slideUp();
    });
    $(document).on("click", ".delete_widget", function () {
        $(this).closest(".element").remove();
    });
    $(document).on("click", "#update_font", function () {
        $.ajax({
            method: "POST",
            url: "ajax/editor.php?process=updatefont&bookid=" + window.bookid,
            data: $("#fonts_form").serialize(),
            success: function (data) {
                window.location.reload();
            }
        });
    });

    $(document).on("click", ".dir_right", function () {
        $(this).closest(".element").find(".real-content").first().css("direction", "rtl");
        $(this).removeClass("dir_right");
        $(this).addClass("dir_left");
        $(this).removeClass("flaticon-bars7");
        $(this).addClass("flaticon-textformat37");
        $(this).attr("title", "Direction left");

    });
    $(document).on("click", ".custom_size", function () {
        $("#action_containerb").html('<input type="text" id="custom_size_text"><button targetid="' + $(this).closest(".element").attr("id") + '" id="custom_size_update" value="update">Update</button>');
        $("#popup_action").fadeIn();
    });
    $(document).on("click", "#custom_size_update", function () {
        $("#" + $(this).attr("targetid")).find(".poplinable").css("font-size", $("#custom_size_text").val() + "px");
        $("#" + $(this).attr("targetid")).find("span").css("font-size", $("#custom_size_text").val() + "px");
        $("#popup_action").fadeOut();
        $("#action_containerb").html('');

    });

    $(document).on("click", ".dir_left", function () {
        $(this).closest(".element").find(".real-content").first().css("direction", "ltr");
        $(this).removeClass("dir_left");
        $(this).addClass("dir_right");
        $(this).removeClass("flaticon-textformat37");
        $(this).addClass("flaticon-bars7");
        $(this).attr("title", "Direction right");
    });

    $(document).on("click", ".copy_widget,.copy_widget-a", function () {
        c = $(this).closest(".element").clone();
        id = "widget_" + randomString(7);
        c.attr("id", id);
        Itop = (parseInt($(window).height() / 6) + parseInt($(window).scrollTop()) - 100).toString();
        c.css("top", Itop);
        c.find(".ui-resizable-handle").remove();
        $(".resizable").resizable("destroy");
        $(".page").append(c);
        // setTimeout(function(){
        refreshElement();
        // },1);
    });


    $(".widget").click(function () {
        // alert("window-h="+$(window).height()+)
        Itop = parseInt(($(window).height()) / 2) + parseInt($(window).scrollTop()) - 78;
        Ileft = parseInt($(".page_container").width() / 2) + parseInt($(".page_container").scrollLeft());
        Ileft = ( 100 * parseFloat(Ileft) / parseFloat($(".page_container").width())) + "%";
        Itop = ( 100 * parseFloat(Itop) / parseFloat($(".page_container").height())) + "%";
        id = "widget_" + randomString(7);
        id2 = "widget2_" + randomString(7);
        switch ($(this).attr("id")) {
            case "wtext":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:200px;height:100px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="delete_widget floating-right flaticon-x"></div><div class="move_handler flaticon-more9"></div><div class="copy_widget flaticon-copy20" widget_type="text"></div><div class="dir_right flaticon-bars7" widget_type="text"></div><div class="custom_size flaticon-fon font-big-size" widget_type="text"></div><div class="index_widget  flaticon-list6" widget_type="index"></div><div class="animate_widget animate_widget-text flaticon-interface-1" widget_type="image"></div><div class="real-content" style="direction: rtl;"><span class="poplinable" contenteditable="true">' + window.Lang.Text + '</span></div><div>';
                break;
            case "wvideo":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:420px;height: 315px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="video"></div><div class="index_widget  flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content remove-margin"><iframe width="100%" height="100%" src="https://www.youtube.com/embed/sxUQsKxcOYM" frameborder="0" allowfullscreen></iframe></div><div>';
                break;
            case "wsound":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:400px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="audio"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content"><audio controls><source src="sound.mp3" type="audio/mpeg"></audio></div><div>';
                break;
            case "wimage":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:200px;height:200px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="delete_widget floating-right flaticon-x"></div><div class="edit_widget flaticon-pencil43" widget_type="image"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content remove-margin"><img src="image.jpg" style="width:100%;height: 100%"></div><div>';
                break;
            case "animationImage":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:200px;height:200px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="animationImage"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content remove-margin"><img src="image.jpg" style="width:100%;height: 100%"></div><div>';
                break;
            case "iframewidget":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:200px;height:200px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="iframewidget"></div><div class="index_widget flaticon-list6" widget_type="iframewidget"></div><div class="animate_widget flaticon-interface-1" widget_type="iframewidget"></div><div class="real-content remove-margin"><iframe src="" style="width:100%;height: 100%;border:0;"></iframe></div><div>';
                break;
            case "sliderwidget":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:200px;height:200px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="sliderwidget"></div><div class="index_widget flaticon-list6" widget_type="sliderwidget"></div><div class="animate_widget flaticon-interface-1" widget_type="sliderwidget"></div><div class="real-content remove-margin"><iframe class="jq_multi_file" src="" style="width:100%;height: 100%;border:0;"></iframe></div><div>';
                break;
            case "image360":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:200px;height:200px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="image360"></div><div class="index_widget flaticon-list6" widget_type="image360"></div><div class="animate_widget flaticon-interface-1" widget_type="image360"></div><div class="real-content remove-margin"><div class="jq_manhal360" id="'+id2+'"></div></div><div>';
                break;
            case "scratcherwidget":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:200px;height:200px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="scratcherwidget"></div><div class="index_widget flaticon-list6" widget_type="scratcherwidget"></div><div class="animate_widget flaticon-interface-1" widget_type="scratcherwidget"></div><div class="real-content remove-margin"> <iframe class="jq_multi_file" src="" style="width:100%;height: 100%;border:0;"></iframe></div><div>';
                break;
            case "popoutimage":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:200px;height:200px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="popoutimage"></div><div class="index_widget flaticon-list6" widget_type="popoutimage"></div><div class="animate_widget flaticon-interface-1" widget_type="popoutimage"></div><div class="real-content remove-margin"><a class="image-popup-no-margins" style="width: 100%;height: 100%" href=""> <img src="" class="manhal-popoutimage"  style="width: 100%;height: 100%" width="100%" height="100%"><img src="" class="manhal-popoutimage-fg"  style="width: 0%;height: 0%;display: none;" width="0%" height="0%"></a></div><div>';
                break;
            case "videotransparent":
                html = '<div id="' + id + '" class="resizable draggable element" style="width:200px;height:200px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="videotransparent"></div><div class="index_widget flaticon-list6" widget_type="videotransparent"></div><div class="animate_widget flaticon-interface-1" widget_type="videotransparent"></div><div class="real-content remove-margin"><video class="jq_transparentvideo" id="'+id2+'" autoplay="" loop="" style="display: none;"><source class="manhal_videosrc" src="" type="video/mp4"></video></div><div>';
                break;
            case "avideo":
                html = '<div id="' + id + '" class="resizable draggable element action"  style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="action-video"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content"><a class="doaction" actiontype="youtube" data_src="sxUQsKxcOYM"><i class="aicon resizable background-icon flaticon-youtube1 "></i></a><p class="poplinable" contenteditable="true">' + window.Lang.Text + '</p></div><div>';
                break;
            case "circle":
                html = '<div id="' + id + '" class="resizable draggable element action" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="action-circle"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content"><a class="doaction" actiontype="circle" data-word="word1,word2" data-thumb1="" data-thumb2=""  data-true="0,0" title="' + window.Lang.Title + '"><i class="aicon resizable background-icon flaticon-icon-581"></i></a></div><div>';
                break;
            case "asound":
                html = '<div id="' + id + '" class="resizable draggable element action" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9 "></div><div class="copy_widget-a flaticon-copy20" widget_type="action-sound"></div><div class="delete_widget floating-right flaticon-x"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="edit_widget flaticon-pencil43" widget_type="action-sound"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content"><a class="doaction" actiontype="sound" data_src="sound.mp3"><i class="aicon resizable background-icon flaticon-sound"></i></a><p class="poplinable" contenteditable="true">' + window.Lang.Text + '</p></div><div>';
                break;
            case "aimage":
                html = '<div id="' + id + '" class="resizable draggable element action" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="action-image"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content"><a class="doaction" actiontype="image" data_src="image.jpg"><i class="aicon resizable background-icon flaticon-picture62"></i></a><p class="poplinable" contenteditable="true">' + window.Lang.Text + '</p></div><div>';
                break;
            case "aurl":
                html = '<div id="' + id + '" class="resizable draggable element action" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="action-url"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content"><a class="doaction" actiontype="url" data_src="http://www.manhal.com/"><i class="aicon resizable background-icon flaticon-links12"></i></a><p class="poplinable" contenteditable="true">' + window.Lang.Text + '</p></div><div>';
                break;
            case "aurltext":
                html = '<div id="' + id + '" class="resizable draggable element action" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="action-texturl"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content"><a class="doaction" actiontype="urltext" data_src="http://www.manhal.com/"><p class="poplinable" contenteditable="true">' + window.Lang.Text + '</p></a></div><div>';
                break;
            case "textlink":
                html = '<div id="' + id + '" class="resizable draggable element action" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="action-textlink"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content"><a class="doaction" actiontype="textlink" target="_blank" href="http://www.manhal.com/"><p class="poplinable" contenteditable="true">' + window.Lang.Text + '</p></a></div><div>';
                break;
            case "aurlimage":
                html = '<div id="' + id + '" class="resizable draggable element action" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="action-imageurl"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content"><a class="doaction" actiontype="urlimage" data_src="http://www.manhal.com/"><img src="image.jpg" style="width:100%;height: 100%"></a></div><div>';
                break;
            case "imagelink":
                html = '<div id="' + id + '" class="resizable draggable element action" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="action-imagelink"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content"><a class="doaction" actiontype="imagelink" target="_blank" href="http://www.manhal.com/"><img src="image.jpg" style="width:100%;height: 100%"></a></div><div>';
                break;
            case "aquiz":
                html = '<div id="' + id + '" class="resizable draggable element action" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left:' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="action-quiz"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content"><a class="doaction" actiontype="quiz" data_src="quiz/"><i class="aicon resizable background-icon flaticon-check7"></i></a></div><div>';
                break;
            case "atrace":
                html = '<div id="' + id + '" class="resizable draggable element action trace" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left:' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="action-trace"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content trace-content"><div class="draggable jq_internal_drag" style="position: absolute;left:10%;top:10%; width:50px;height: 50px;"><div class="move_handler move_handler-inner flaticon-more9"></div><a class="doaction" actiontype="trace" data_src="" colors="#E7FF19,#FF0000,#0AD404,#007EFF,#FF00F5,#87FFD0,#000000"><i class="aicon resizable background-icon flaticon-paint81"></i></a></div></div><div>';
                break;
            case "sound_text":
                html = '<div id="' + id + '" class="resizable draggable element action sound_text" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left:' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="sound_text"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="sound_text"></div><div class="real-content"><div class="draggable jq_internal_drag" style="position: absolute;left:10%;top:10%; width:50px;height: 50px;"><div class="move_handler move_handler-inner flaticon-more9"></div><a class="doaction" actiontype="sound_text" text-align="[]" ><i class="aicon resizable background-icon flaticon-sound"></i></a></div><span class="poplinable" contenteditable="true">Text</span></div><div>';
                break;
            case "game":
                html = '<div id="' + id + '" class="resizable draggable element action game" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left:' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="game"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="game"></div><div class="real-content"><a class="doaction" actiontype="game" data_src="game.jpg"><i class="aicon resizable background-icon flaticon-picture62"></i></a><p class="poplinable" contenteditable="true">' + window.Lang.Game + '</p></div><div>';
                break;
            case "numberbox":
                html = '<div id="' + id + '" class="resizable draggable element action numberbox" style="width:50;height:50px;position: absolute;top: ' + Itop + ';left:' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="copy_widget flaticon-copy20"></div><div class="delete_widget floating-right flaticon-x"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="image"></div><div class="real-content remove-margin"><input type="number" class="box-number" step="0.01" style="width: 100%;height: 100%" /></div><div>';
                break;
            case "douknow":
                html = '<div id="' + id + '" class="resizable draggable element action" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:62px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="action-douknow"></div><div class="index_widget flaticon-list6" widget_type="index"></div><div class="animate_widget flaticon-interface-1" widget_type="douknow"></div><div class="real-content"><a class="doaction" actiontype="douknow" data_src="http://www.manhal.com/"><i class="aicon background-icon flaticon-info27"></i><label class="enr-data" style="display: none"></label></a><p class="poplinable" contenteditable="true">' + window.Lang.Text + '</p></div><div>';
                break;
                case "symbols":
                html = '<div id="' + id + '" class="resizable draggable element action" style="width:200px;height:70px;position: absolute;top: ' + Itop + ';left: ' + Ileft + ';"><div class="move_handler flaticon-more9"></div><div class="delete_widget floating-right flaticon-x"></div><div class="copy_widget flaticon-copy20" style="right:42px;" widget_type="image"></div><div class="edit_widget flaticon-pencil43" widget_type="symbols"></div><div  right: 64px; class="custom_size flaticon-fon font-big-size" widget_type="text"></div><div style="right:42px;" class="index_widget flaticon-list6" widget_type="index"></div><div class="real-content"><p contenteditable="true"  class="poplinable symbol_font" style="font-size: 50px">0</p></div><div>';
                    refreshElement();
                setTimeout(function () {
                    $("#"+id).find('.edit_widget').click();},
                    10);
                    $(document).on("click", ".symbols-container .symbols-item", function () {
                        $(this).addClass("active").siblings().removeClass("active");
                        var vals=$(".symbols-container .symbols-item.active").html();
                        $("#"+ id).find(".poplinable").html(vals);
                        $(".admin-login .popup-container .close-container i").click();
                    });
                break;

        }
        $(".page").append(html);
        refreshElement();
    });


    //Editors
    $(document).on("click", "#update_video", function () {
        $("#video_form").attr("action", "ajax/editor.php?process=uploadvideo&bookid=" + window.bookid + "&pageid=" + realPageNumber(window.pageid));
        $("#video_form").submit();
    });
    $(document).on("click", "#update_slider", function () {
        $("#slider_form").attr("action", "ajax/editor.php?process=uploadslider&bookid=" + window.bookid + "&pageid=" + realPageNumber(window.pageid));
        $("#slider_form").submit();
    });
    $(document).on("click", "#update_image360", function () {
        $("#image360_form").attr("action", "ajax/editor.php?process=updateimage360&bookid=" + window.bookid + "&pageid=" + realPageNumber(window.pageid));
        $("#image360_form").submit();
    });
    $(document).on("click", "#update_scratcher", function () {
        $("#slider_form").attr("action", "ajax/editor.php?process=updatescrathcer&bookid=" + window.bookid + "&pageid=" + realPageNumber(window.pageid));
        $("#slider_form").submit();
    });
    $(document).on("click", "#update_popout", function () {
        $("#popout_form").attr("action", "ajax/editor.php?process=updatepopout&bookid=" + window.bookid + "&pageid=" + realPageNumber(window.pageid));
        $("#popout_form").submit();
    });
    $(document).on("click", "#update_vt", function () {
        $("#vt_form").attr("action", "ajax/editor.php?process=updatevt&bookid=" + window.bookid + "&pageid=" + realPageNumber(window.pageid));
        $("#vt_form").submit();
    });
 $(document).on("click", "#update_iframev", function () {
        selector = "#" + $("#iframe_id").val();
        $(selector).find("iframe").first().attr("src", $("#iframev").val());
        $("#action_containerb").html("");
        $("#popup_action").fadeOut();
    });

    $(document).on("click", "#update_avideo", function () {
        $("#ayoutube").val(youtube_getID($("#ayoutube").val()));
        $("#avideo_form").attr("action", "ajax/editor.php?process=updateavideo&bookid=" + window.bookid);
        $("#avideo_form").submit();
        showLoading();

        //youtubeID=youtube_getID($("#ayoutube").val());
        //selector="#"+$("#avideo_id").val();
        //$(selector).find(".doaction").first().attr("data_src",youtubeID);
        //$("#action_containerb").html("");
        //$("#popup_action").fadeOut();

    });

    $(document).on("click", "#update_aurl", function () {
        $("#aurl_form").attr("action", "ajax/editor.php?process=updateaurl&bookid=" + window.bookid);
        $("#aurl_form").submit();
        showLoading();
    });

    $(document).on("click", "#update_textlink", function () {
        $("#textlink_form").attr("action", "ajax/editor.php?process=updatetextlink&bookid=" + window.bookid);
        $("#textlink_form").submit();
        showLoading();
    });

    $(document).on("click", "#update_sound", function () {
        $("#sound_form").attr("action", "ajax/editor.php?process=updatesound&bookid=" + window.bookid);
        $("#sound_form").submit();
        showLoading();
    });
    $(document).on("click", "#update_image", function () {
        $("#image_form").attr("action", "ajax/editor.php?process=updateimage&bookid=" + window.bookid);
        $("#image_form").submit();
        showLoading();
    });
    $(document).on("click", "#update_aimage", function () {
        $("#aimage_form").attr("action", "ajax/editor.php?process=updateaimage&bookid=" + window.bookid);
        $("#aimage_form").submit();
        showLoading();
    });
    $(document).on("click", "#update_aurlimage", function () {
        $("#aimage_form").attr("action", "ajax/editor.php?process=updateaurlimage&bookid=" + window.bookid);
        $("#aimage_form").submit();
        showLoading();
    });

    $(document).on("click", "#update_imagelink", function () {
        $("#imagelink_form").attr("action", "ajax/editor.php?process=updateimagelink&bookid=" + window.bookid);
        $("#imagelink_form").submit();
        showLoading();
    });
    $(document).on("click", "#update_douknow", function () {
        $("#doyouknow_form").attr("action", "ajax/editor.php?process=updatedouknow&bookid=" + window.bookid);
        $("#doyouknow_form").submit();
        if($("#doyouknowdesc").val()!=""){
            $("#"+$("#douknowimage_id").val()).find(".enr-data").first().html($("#doyouknowdesc").val());
        }
        showLoading();
    });
    $(document).on("click", "#update_asound", function () {
        $("#asound_form").attr("action", "ajax/editor.php?process=updateasound&bookid=" + window.bookid);
        $("#asound_form").submit();
        showLoading();
    });


    $(document).on("click", "#update_trace_color", function () {
        page = realPageNumber();
        $("#trace_form").attr("action", "ajax/editor.php?process=updatetrace&bookid=" + window.bookid + "&pageid=" + page);
        $("#trace_form").submit();
        showLoading();
    });


    $(document).on("click", ".edit_widget", function () {
        switch ($(this).attr("widget_type")) {
            case "video":
                $("#action_containerb").load("video.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "audio":
                $("#action_containerb").load("sound.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "image":
                $("#action_containerb").load("image.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "animationImage":
                $("#action_containerb").load("animationimage.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "iframewidget":
                $("#action_containerb").load("iframewidget.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "sliderwidget":
                $("#action_containerb").load("sliderwidget.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "image360":
                $("#action_containerb").load("image360.php?id=" + $(this).closest(".element").attr("id")+"&id2="+$(this).closest(".element").find(".jq_manhal360").attr("id"));
                break;
            case "scratcherwidget":
                $("#action_containerb").load("scratcherwidget.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "popoutimage":
                $("#action_containerb").load("popoutimage.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "videotransparent":
                $("#action_containerb").load("videotransparent.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "action-video":
                $("#action_containerb").load("avideo.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "action-circle":
                $("#action_containerb").load("circle.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "action-sound":
                $("#action_containerb").load("asound.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "action-image":
                $("#action_containerb").load("aimage.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "action-url":
                 ahref=$(this).closest(".element").find(".doaction").first().attr("data_src");
                 atitle=$(this).closest(".element").find(".doaction").first().attr("title");
                $("#action_containerb").load("aurl.php?id=" + $(this).closest(".element").attr("id"),function(){
                    $("#aurlvalue").val(ahref);
                    $("#aurltitle").val(atitle);
                });
                break;
            case "action-texturl":
                 ahref=$(this).closest(".element").find(".doaction").first().attr("data_src");
                 atitle=$(this).closest(".element").find(".doaction").first().attr("title");
                $("#action_containerb").load("aurltext.php?id=" + $(this).closest(".element").attr("id"),function(){
                    $("#aurlvalue").val(ahref);
                    $("#aurltitle").val(atitle);
                });
                break;
            case "action-textlink":
                 ahref=$(this).closest(".element").find(".doaction").first().attr("data_src");
                 atitle=$(this).closest(".element").find(".doaction").first().attr("title");
                $("#action_containerb").load("textlink.php?id=" + $(this).closest(".element").attr("id"),function(){
                    $("#aurlvalue").val(ahref);
                    $("#aurltitle").val(atitle);
                });
                break;
            case "action-imageurl":
                ahref=$(this).closest(".element").find(".doaction").first().attr("data_src");
                atitle=$(this).closest(".element").find(".doaction").first().attr("title");
                $("#action_containerb").load("aurlimage.php?id=" + $(this).closest(".element").attr("id"),function(){
                    $("#aurlvalue").val(ahref);
                    $("#aimagetitle").val(atitle);
                });
                break;
            case "action-imagelink":
                ahref=$(this).closest(".element").find(".doaction").first().attr("data_src");
                atitle=$(this).closest(".element").find(".doaction").first().attr("title");
                $("#action_containerb").load("imagelink.php?id=" + $(this).closest(".element").attr("id"),function(){
                    $("#aurlvalue").val(ahref);
                    $("#aimagetitle").val(atitle);
                });
                break;
            case "action-quiz":
                $("#action_containerb").load("external_widget.php?widget=quiz&id=" + $(this).closest(".element").attr("id"));
                break;
            case "action-trace":
                $("#action_containerb").load("trace.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "sound_text":
                $("#action_containerb").html('<iframe style="width:1028px;height:800px;" src="highlight/index.php?id=' + $(this).closest(".element").attr("id") + '&bookid=' + window.bookid + '"></iframe>');
                //console.log("highlight/index.php?id="+$(this).closest(".element").attr("id")+"&bookid="+window.bookid);
                break;
            case "game":
                $("#action_containerb").load("games_widget.php?id=" + $(this).closest(".element").attr("id"));
                break;
            case "action-douknow":
                $("#action_containerb").load("douknow.php?id=" + $(this).closest(".element").attr("id"),function(){
                    refreshElement();
                });
                case "symbols":
                $("#action_containerb").load("symbols.php?id=" + $(this).closest(".element").attr("id"),function(){
                    // refreshElement();
                });
                break;

        }
        $("#popup_action").fadeIn();
    });

    $("#setting").click(function () {
        $("#action_containerb").load("page_setting.php?pageid=" + window.pageid + "&bookid=" + window.bookid);
        $("#popup_action").fadeIn();
    });
    $("#font").click(function () {
        $("#action_containerb").load("book_fonts.php?bookid=" + window.bookid);
        $("#popup_action").fadeIn();
    });
    $("#newpage").click(function () {
        savePage(-2);//newPage
    });

    $("#dplicatepage").click(function () {
        savePage(-3);//newPage
    });
    $("#deletepage").click(function () {
        swal({
            title: window.Lang.AreYouSure,
            text: window.Lang.DoYouWantDeletePage,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: window.Lang.YesDeletePage,
            closeOnConfirm: false
        }, function () {
            $.ajax({
                method: "POST",
                url: "ajax/editor.php?process=deletepage&pageid=" + window.pageid + "&bookid=" + window.bookid,
                success: function (data) {
                    window.location.href = "editor.php?bookid=" + window.bookid;
                }
            });
        });
    });
    $("#save").click(function () {
        savePage(-1);
    });

    $("#addindex").click(function () {
        $("#action_containerb").load("indexbook.php?pageid=" + window.pageid + "&bookid=" + window.bookid);
        $("#popup_action").fadeIn();
    });

    $("#booklessons").click(function () {
        $("#action_containerb").load("indexlessons.php?pageid=" + window.pageid + "&bookid=" + window.bookid);
        $("#popup_action").fadeIn();
    });


    $("#action_containerb").on("click", ".jq_index", function () {
        id = "widget_" + randomString(7);
        top = 200;
        left = 200;
        $(".page").append('<div id="' + id + '" class="resizable poplinable draggable element" contenteditable="true" style="width:200px;height:100px;position: absolute;top: ' + top + ';left: ' + left + ';"><div class="delete_widget floating-right flaticon-x"></div><div class="move_handler flaticon-more9"></div><div class="real-content"><a class="jq_index" data-href="' + $(this).attr('page_name') + '">' + $(this).html() + '</a></div><div>');
        id = "widget_" + randomString(7);
        left = left - 150;
        $(".page").append('<div id="' + id + '" class="resizable poplinable draggable element" contenteditable="true" style="width:200px;height:100px;position: absolute;top: ' + top + ';left: ' + left + ';"><div class="delete_widget floating-right flaticon-x"></div><div class="move_handler flaticon-more9"></div><div class="real-content"><a class="jq_index" data-href="' + $(this).attr('page_name') + '">' + $(this).attr("subtitle") + '</a></div><div>');
        refreshElement();
    });

    $(document).on("keydown", ".real-content", function (event) {
        var arabicNumber = [];
        arabicNumber[96] = "٠";
        arabicNumber[97] = "١";
        arabicNumber[98] = "٢";
        arabicNumber[99] = "٣";
        arabicNumber[100] = "٤";
        arabicNumber[101] = "٥";
        arabicNumber[102] = "٦";
        arabicNumber[103] = "٧";
        arabicNumber[104] = "٨";
        arabicNumber[105] = "٩";
        if (event.which >= 96 && event.which <= 109) {
            event.preventDefault();
            insertTextAtCursor(arabicNumber[event.which]);
        }
        //console.log(event.which);
    });
    $(document).on("click", "#romve_bg", function (event) {
        if(typeof $(".page_container").attr("publish")!="undefined"){
                    $.ajax({
                    method: "POST",
                    url: "ajax/editor.php?process=removebg&bookid="+ window.bookid,
                    data: {'img': $("#page_container").attr("publish")},
                    success: function (data) {
                        $(".page_container").css("background","").attr("data_src","").attr("editor","").attr("publish","").attr("src","");
                    }
                });
        }
        $("#popup_action").fadeOut();
    });
});

function insertTextAtCursor(text) {
    var sel, range, textNode;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0).cloneRange();
            range.deleteContents();
            textNode = document.createTextNode(text);
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
}


function refreshElement() {

    $(".resizable").resizable({
        stop: function () {
            console.log($(this).width());
            $(this).width($(this).width()/$(".negative-container").width()*100 +"%");
            $(this).height($(this).height()/$(".negative-container").height()*100+"%");
        }
    });
    $(".draggable").draggable({
        handle: ".move_handler",
        stop: function () {
            if ($(this).hasClass("jq_internal_drag")) {
                var l = ( 100 * parseFloat($(this).css("left")) / parseFloat($(this).closest(".real-content").css("width")) ) + "%";
                var t = ( 100 * parseFloat($(this).css("top")) / parseFloat($(this).closest(".real-content").css("height")) ) + "%";
            } else {
                var l = ( 100 * parseFloat($(this).css("left")) / parseFloat($(".page_container").css("width")) ) + "%";
                var t = ( 100 * parseFloat($(this).css("top")) / parseFloat($(".page_container").css("height")) ) + "%";
            }

            $(this).css("left", l);
            $(this).css("top", t);
            $(this).width($(this).width()/$(".negative-container").width()*100 +"%");
            $(this).height($(this).height()/$(".negative-container").height()*100+"%");
        }
    });
    document.execCommand('defaultParagraphSeparator', false, 'p');
    $(".poplinable").popline({position: "fixed"});
    $("input[name='position']").click(function () {
        $(".editor").popline("setPosition", this.id);
    });

    refreshRotate();



}
function refreshRotate() {


    $(".draggable").each(function () {
        rotateValue=0;
        x=$(this).attr("style");
        arr=x.split(";");
        arr.forEach(function(attr) {
            pair=attr.split(":");
            if((pair[0]).trim()=="transform"){
                if((pair[1]).indexOf("rotate")!=-1){
                    rotateValue=((pair[1]).replace("rotate","").replace("(","").replace("rad)","")).trim();
                }
            }
        });
        rotateValue=parseFloat(rotateValue)*57.2957795785523;
        $(this).rotatable({degrees: rotateValue,wheelRotate: false});
    });


}

function UpdateVideo(video,publish) {
    videoid="video_"+$("#video_id").val();
    selector = "#" + $("#video_id").val();
    $(selector).find("iframe").remove();
    $(selector).find("video").remove();
    $(selector).find(".real-content").prepend('<video title="'+ $("#videotitle").val()+'" crossorigin="" id="'+videoid+'"><source class="jq_multi_file" editor="'+video+'" publish="'+publish+'" src="'+video+'" type="video/mp4"></video><script>$(document).ready(function(){p'+videoid+' = new Plyr("#'+videoid+'");});</script>');
    //player = new Plyr('#'+videoid);
    $("#action_containerb").html("");
    $("#popup_action").fadeOut();

}
function UpdateSlider(editor,publish) {
    selector = "#" + $("#slider_id").val();
    $(selector).find("iframe").attr("src",editor);
    $(selector).find("iframe").attr("editor",editor);
    $(selector).find("iframe").attr("publish",publish);
    $("#action_containerb").html("");
    $("#popup_action").fadeOut();
}
function UpdateScratcher(editor,publish) {
    selector = "#" + $("#scratcher_id").val();
    $(selector).find("iframe").attr("src",editor);
    $(selector).find("iframe").attr("editor",editor);
    $(selector).find("iframe").attr("publish",publish);
    $("#action_containerb").html("");
    $("#popup_action").fadeOut();
}
function updatePopup(editor,publish) {
    selector = "#" + $("#scratcher_id").val();
    $(selector).find("iframe").attr("src",editor);
    $(selector).find("iframe").attr("editor",editor);
    $(selector).find("iframe").attr("publish",publish);
    $("#action_containerb").html("");
    $("#popup_action").fadeOut();
}
function updateYoutube(){
    youtubeID = youtube_getID($("#youtube").val());
    selector = "#" + $("#video_id").val();
    $(selector).find("iframe").remove();
    $(selector).find("video").remove();
    $(selector).find(".real-content").prepend('<iframe title="'+$("#videotitle").val()+'" width="100%" height="100%" src="https://www.youtube.com/embed/'+youtubeID+'" frameborder="0" allowfullscreen></iframe>');
    $("#action_containerb").html("");
    $("#popup_action").fadeOut();
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
    $("#popup").fadeOut();
    $("#popup_action").fadeOut();
    setTimeout(function () {
        $("#action_container").html("");
        $("#action_containerb").html("");
    }, 300);


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
function editorBackground() {
    $(".page_container").css("background", $(".page_container").attr("editor"));
}
function savePage(goTO) {
    $(".element").each(function () {
        $(this).attr('istyle', $(this).attr('style'))
    });

    $(".element").show();
    $(".element").removeClass("selected");
    $("#Layer_menu").trigger("click");
    showLoading();
    var videoScripts='';
    $(".plyr").each(function(){
        videoScripts+=$(this).closest(".real-content").find("script").first().html();
        $(this).replaceWith($(this).find(".plyr__video-wrapper").first().html());

    });

    $(".element").show();
    hideEditorElement();
    showEditorElement();
    $(".resizable").resizable("destroy");
    $(".draggable").draggable("destroy");
   $(".draggable").rotatable("destroy");
    containerstyle = $(".page_container").attr("style");
    $(".page_container").css("background", "url('" + $(".page_container").attr("publish") + "') no-repeat");

    $(".poplinable").attr("contenteditable", "false");
    $(".jq_multi_file").each(function () {
        $(this).attr("src", $(this).attr("publish"));
        $(this).attr("data_src", $(this).attr("publish"));
    });
    page = goTO;
    $.ajax({
        method: "POST",
        url: "ajax/editor.php?process=savepage&pageid=" + window.pageid + "&bookid=" + window.bookid,
        data: {'contents': $(".page_container").clone().wrap('<p>').parent().html()},
        success: function (data) {
            $(".jq_multi_file").each(function () {
                $(this).attr("src", $(this).attr("editor"));
                $(this).attr("data_src", $(this).attr("editor"));
            });
            $(".page_container").attr("style", containerstyle);
            $(".poplinable").attr("contenteditable", "true");
            refreshElement();
            hideLoading();
            if (page == -2) {//newPage
                window.location.href = "editor.php?type=new&bookid=" + window.bookid;
            }else if(page == -3){
                window.location.href = "editor.php?type=new&dpage="+window.pageid+"&bookid=" + window.bookid;
            } else if (page != -1) {
                window.location.href = "editor.php?bookid=" + window.bookid + "&pageid=" + page;
            }

            $("#copier").html("<script>setTimeout(function(){"+videoScripts+"},500);</script>");
            console.log("videoScripts",videoScripts);
            setTimeout(function(){
                $("#copier").html();
            },500);
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

function realPageNumber() {
    return $("#goto").find("option[selected='selected']").first().html() - 1;
}
function readURLWord(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(input).closest(".right-container").find(".background").attr('style', "background:url(" + e.target.result + ") no-repeat;");
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function playTransVideo(){
     transparentVideos=[];
    var i=0;
    $(".jq_transparentvideo").each(function(){
         transparentVideos[i] = seeThru.create('#'+$(this).attr("id"),{ start: 'clicktoplay'});
        i++;
    });
}