/**
 * Created by Hussam Abu Khaidejh on 12/26/2017.
 */
// window.SITE_URL="https://www.manhal.com/";
window.SITE_URL="http://localhost/Manhal/";
window.edittype="new";
window.selectedtype=1;
destroyed=true;
window.disableNavigation=false;
window.disableElement=false;
$.ajax({
    url: window.SITE_URL+"language/getVariable.php",
    type: "POST",
    cache: false,
    dataType:'html',
    async:false,
    success: function(html) {
        window.Lang=JSON.parse(html);
    }
});
function updateOrder() {
    window.order=0;
    $(".content-of-index").each(function () {
        if(parseInt($(this).val())>parseInt(window.order)){
            window.order=$(this).val();
        }
    });
}
function refresh() {
    $(".story-container .ui-droppable").droppable("destroy");
    $(".story-container .ui-resizable").resizable("destroy");
    $(".story-container .ui-draggable").draggable("destroy");
    refreshElement();
}
function updateAnimation() {
    $("#demoImageAnimation").attr("class", "animated");
    $("#demoImageAnimation").attr("data-animation", "");
    $("#demoImageAnimation").attr("data-animation-timer", "");
    $("#demoImageAnimation").attr("default-animation", "");
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
function closePopup(){
    $(".popup-edit-video-container").fadeOut();
    $(".popup-edit-video-container .edit-video-container").removeClass("slideInDown").addClass("slideOutUp").fadeOut();
    $(".popup-edit-sound-container").fadeOut();
    $(".popup-edit-sound-container .edit-sound-container").removeClass("slideInDown").addClass("slideOutUp").fadeOut();
    $(".popup-edit-image-container").fadeOut();
    $(".popup-edit-image-container .edit-image-container").removeClass("slideInDown").addClass("slideOutUp").fadeOut();
}
function youtube_getID(url) {
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    return (match && match[7].length == 11) ? match[7] : false;
}
function refreshPageSlider() {
    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').outerWidth() + 8;
    var slideHeight = $('#slider ul li').height();
    var sliderUlWidth = slideCount * slideWidth;
    $('#slider').css({width: sliderUlWidth, height: slideHeight + 9});
    if (sliderUlWidth < $('#slider').width() && slideCount >=18) {
        $(".control_next").fadeIn();
        $(".control_prev").fadeOut();
        $("#slider").css('width', '100vw');
    }
}
function loadPage(pageid){
    $(".jq_questioni").removeClass("active");
    $(".jq_questioni[pageid='"+pageid+"']").addClass("active");
    $.ajax({
        method: "POST",
        url: window.SITE_URL+"platform/ajax/storyeditor.php?process=getpage",
        data: {pageid:pageid,storyid: window.storyid,storypath:window.storyPath},
        dataType: "json",
        success: function (data) {
            updateOrder();
             console.log(data);
            if(data.result==1){
                $(".content-container").html(data.html);
                destroyed=true;
                a=$(".jq_questioni[pageid='"+pageid+"']");
                if(a.attr("negative")!=""&& a.attr("negative")!="undefined" && a.attr("negative")!=undefined){
                    $(".story-content-container").css("background","#fff url("+SITE_URL+storyPath+"/images/"+a.attr("negative")+") no-repeat");
                }else{
                    $(".story-content-container").css("background","#fff url("+SITE_URL+storyPath+"/images/"+$(".jq_questioni[pageid='"+pageid+"']").attr("bg_image")+") no-repeat");
                }

                // if($(".jq_questioni[pageid='"+pageid+"']").attr("bg_image")!=""){


                // }
                drawLaers();
                setTimeout(function () {
                    hideLoader();
                    refreshElement();
                },50);
            }else{
                showMsg("error",data.msg);
            }
        }
    });
}
function deletePage(){
    showLoader();
    var data={};
    data["storyid"]=window.storyid;
    data["pageid"]=$("#delete_question").attr("pageid");
    data["storypath"]=window.storyPath;
    $.ajax({
        method: "POST",
        url:"../platform/ajax/storyeditor.php?process=deletepage",
        data: data,
        dataType: "json",
        success: function (result) {
            console.log(result);
            if(result.result==1){
                $(".jq_questioni[pageid='"+data["pageid"]+"']").remove();
                $(".jq_questioni").last().click();
                refreshPageSlider();
                hideLoader();
            }else{
                showMsg("error",result.msg);
            }
        }
    }); 
}
function sortPriority(){
    var data=curren;
    $(".content-of-index").each(function () {
        data[$(this).val()]=$(this);
    });

    var orderedData = {};
    Object.keys(data).sort().forEach(function(key) {
        orderedData[key] = data[key];
    });

    var pr=parseInt($(this).val());
    var a=$(this);

}
function drawLaers(){
    html="";
    i=0;
    $(".element").each(function(){
        if($(this).find(".poplinable").length > 0){
            title="Layer "+$(this).find(".content-of-index").val()+" ("+$(this).find(".poplinable").first().html()+")";
        }else{
            i++;
            title="Layer "+$(this).find(".content-of-index").val();
        }
        if($(this).css("display")=="none"){
            checked="";
        }else{
            checked='checked="checked"';
        }
        html+='<div class="row-layer" data-id="'+$(this).attr("id")+'">';
        html+='<a class="floating-left checkbox"><input type="checkbox" class="jq_layer" data-id="'+$(this).attr("id")+'" '+checked+'></a>';
        html+='<a class="floating-left title">'+title+'</a>';
        html+=' </div>';
    });

    $(".content.layers").html(html);
}
function drawInteration(widget){
    var arr=[];
    var acttion_temp={};
    var $temp_li;
   $(".jq_interaction_container").html("");
    if(widget[0].hasAttribute("action")){
        arr=jQuery.parseJSON((widget.attr("action")));
        for(var i=0;i<arr.length;i++){
            acttion_temp=arr[i];
            $("#interaction_html .jq_li_no").html("#"+($(".jq_interaction_container li").length+1).toString());
            $(".jq_interaction_container").append($("#interaction_html").html());
            $temp_li=$(".jq_interaction_container").find("li").last();
            $temp_li.find(".jq_actionon").val(acttion_temp["on"]);
            $temp_li.find(".jq_action_do").val(acttion_temp["do"]);
            $temp_li.find(".Jq_target_Specific_page").attr("target-id",acttion_temp["target"]);
            $temp_li.find(".jq_url_action").val(acttion_temp["url"]);
            $temp_li.find(".jq_sound_effect").val(acttion_temp["sound"]);
            $temp_li.find(".jq_select_object").val(acttion_temp["object"]);
            $temp_li.find(".jq_action_msg").val(acttion_temp["msg"]);
            $temp_li.find(".Jq_target_Specific_page,.jq_Goto_URL,.select-object,.Jq_select_object-thumb,.Jq_next_prev_page,.Jq_show_message,.Jq_select_object-thumb1").hide();
            switch (acttion_temp["do"]) {
                case "Goto_Specific_Page":
                    $temp_li.find(".Jq_target_Specific_page").show();
                    $temp_li.find(".select-object").show();
                    break;
                case "Open_popup":
                    $temp_li.find(".Jq_target_Specific_page").show();
                    $temp_li.find(".select-object").show();
                    $temp_li.find(".jq_Goto_URL").show();
                    break;
                case "Goto_URL":
                    $temp_li.find(".jq_Goto_URL").show();
                    break;
                case "Goto_Next_Page":
                    $temp_li.find(".Jq_next_prev_page").show();
                    break;
                case "Goto_Previous_Page":
                    $temp_li.find(".Jq_next_prev_page").show();
                    break;
                case "Play_Object":
                case "Show_Object":
                case "Hide_Object":
                case "ِAnimate_Object":
                    $temp_li.find(".Jq_select_object-thumb1").show();
                    temp=$(this).closest("li").find(".jq_select_object");
                    temp.html("");
                    $(".element").each(function () {
                        temp.append('<option value="'+$(this).attr("id")+'">#'+$(this).find(".content-of-index").val()+'</option>');
                    });
                    break;
                case "Show_Message":
                    $temp_li.find(".Jq_show_message").show();
                    break;
            }

        }
    }
}

function drawPageThumbs($container){
    var html="";
    var thumb="";
    var style="";
    $container.html("");
    $(".jq_questioni").each(function () {
        if($(this).attr("thumb")==undefined || $(this).attr("thumb")=="undefined" || $(this).attr("thumb")==""){
            thumb=SITE_URL+"storyeditor/thems/En/images/folder.svg";
            style="background: #fff url("+thumb+") no-repeat;"
            html='<a class="item-thumb" data-id="'+$(this).attr("pageid")+'" thumbsrc="'+thumb+'" style="'+style+'"></a>';
        }else{
            thumb=SITE_URL+storyPath+"/images/"+$(this).attr("thumb");
            style=$(this).attr("style");
            html='<a class="item-thumb" data-id="'+$(this).attr("pageid")+'" thumbsrc="'+thumb+'" style="'+$(this).attr("style")+'"></a>';
        }
        $container.append(html);
    });
}
$(document).ready(function () {
    $(document).on("click",".doublcate_action",function () {
        $(".jq_interaction_container").append('<li class="accordion-item">'+$(this).closest("li").html()+'</li>');
       setTimeout(function () {
           $(".jq_interaction_container li").last().find(".accordion-panel").hide();
           $(".jq_interaction_container li").last().removeClass("is-active");
           $(".jq_interaction_container li").last().find(".jq_li_no").html("#"+($(".jq_interaction_container li").length).toString());
       },10);

    });
    $(document).on("click",".add-action",function () {
        $("#interaction_html .jq_li_no").html("#"+($(".jq_interaction_container li").length+1).toString());
        $(".jq_interaction_container").append($("#interaction_html").html());
    });


    $(document).on("click",".jq_update_interaction",function () {
        var actionarr=[];
        var action={};
        var i=0;
        $(".jq_interaction_container li").each(function () {
            action={};
            action["on"]=$(this).find(".jq_actionon").val();
            action["do"]=$(this).find(".jq_action_do").val();
            action["target"]=$(this).find(".Jq_target_Specific_page").attr("target-id");
            action["url"]=$(this).find(".jq_url_action").val();
            action["sound"]=$(this).find(".jq_sound_effect").val();
            action["object"]=$(this).find(".jq_select_object").val();
            action["msg"]=$(this).find(".jq_action_msg").val();
            actionarr[i]=action;
            i++;
        });

        setTimeout(function () {
            $(".element.selected").attr("action",JSON.stringify(actionarr));
        },50);
    });



    $(document).on("click",".jq_record_sound",function () {
        if($(this).hasClass("recording")){
            $(this).removeClass("recording");
            $(this).removeClass("selected");
            stopRecording($("#jq_record_cont"));
        }else{
            $(this).addClass("recording");
            $(this).addClass("selected");

            startRecording($("#jq_record_cont"));
        }

    });



    // accordion-item

    $(document).on("click",".element",function () {
        if(window.disableElement){
            $(".Jq_select_object-thumb.selected").closest("li").find(".jq_select_object").val($(this).attr("id"));
            $(".closeA").click();
        }else{
            $(".element").removeClass("selected");
            $(this).addClass("selected");
            drawInteration($(this));
        }
    });
    $("#fix_sound").click(function () {
        $(".real-content audio").each(function (e) {
            var NewHtml='';
            if($(this).closest(".type1").length==0){
                NewHtml='<div class="gallery type1"><div class="item-container"><a><div class="audio-player jq_player"><div id="play-btn" class="play-button"></div><div class="audio-wrapper" id="player-container" href="javascript:;"><audio id="player" ontimeupdate="initProgressBar(this)"><source src="'+$(this).children("source").attr("src")+'" type="audio/mp3"></audio></div><div class="player-controls scrubber"><span id="seekObjContainer"><progress id="seekObj" class="seekObj" value="0" max="1" style=""></progress></span><br><small style="float: left; position: relative; left: 10px;color: #00ad68;font-size: 12px;display: none;" class="start-time"></small><small style="float: right; position: relative; right: 10px;color: #00ad68;font-size: 12px; display: none" class="end-time"></small></div><div class="album-image"></div></div></a></div></div>';
                $(this).replaceWith(NewHtml);
            }
        });
    });
    $("#fix_font").click(function () {
        var font="";
        var newfont="";
        var $realContent;
        var size="";

        $(".element").each(function () {
            $realContent=$(this).find(".real-content").first();
            font=$realContent.css("font-size");
            $realContent.css("font-size", font);
            $realContent.find(".poplinable").css("font-size",font);
            $realContent.find("font").css("font-size",font);
            console.log("font",font);

            // $realContent=$(this).find(".real-content").first();
            // font=$realContent.css("style");
            // console.log("font",font);
            // if(font.search("vw")!=-1){
            //     size=parseFloat(font.replace("vh",""));
            //     newfont=(($(window).width()*size)/100).toString()+"px";
            //     $realContent.css("font-size",newfont);
            //     $realContent.find(".poplinable").css("font-size",newfont);
            //     $realContent.find("font").css("font-size",newfont);
            // }
        });
    });

    $(document).on("click",".jq_delete_sound",function(){
        showLoader();
        var data={};
        data["storyid"]=window.storyid;
        data["storypath"]=window.storyPath;
        data["widgetid"]= widgetID;
        $.ajax({
            method: "POST",
            url: "../platform/ajax/storyeditor.php?process=deletewidgetsound",
            data: data,
            dataType: "html",
            success: function (result) {
                $("#audio_form").find("audio").attr("src","");
                $("#audio_form").find("audio")[0].load();
                $("#"+widgetID).attr("voice","");
                $('.jq_questioni[pageid="'+$("#page_settings_page").val()+'"]').removeAttr("bg_sound");
                hideLoader();
            }
        });
    });


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

    $(document).on("click", ".dir_right", function () {
        $(this).closest(".element").find(".real-content").first().css("direction", "rtl");
        $(this).removeClass("dir_right");
        $(this).addClass("dir_left");
        $(this).removeClass("flaticon-bars7");
        $(this).addClass("flaticon-textformat37");
        $(this).attr("title", "Direction left");

    });

    $(document).on("click", ".dir_left", function () {
        $(this).closest(".element").find(".real-content").first().css("direction", "ltr");
        $(this).removeClass("dir_left");
        $(this).addClass("dir_right");
        $(this).removeClass("flaticon-textformat37");
        $(this).addClass("flaticon-bars7");
        $(this).attr("title", "Direction right");
    });



    $(document).on("click", "#update_animation", function () {
        updateAnimation();
        if ($("#animation_" + window.widgetID)[0] == undefined) {
            $("#" + window.widgetID).find(".real-content").wrap('<div id="animation_' + window.widgetID + '" style="width:100%;height:100%;"></div>');
        }
        el = $("#animation_" + window.widgetID);
        el.attr("data-animation", $("#demoImageAnimation").attr("data-animation"));
        el.attr("default-animation", $("#demoImageAnimation").attr("default-animation"));
        el.attr("data-animation-timer", $("#demoImageAnimation").attr("data-animation-timer"));
        el.attr("class", $("#demoImageAnimation").attr("class"));
        // el.find("audio").remove();
        // $("#demoImageAnimation").closest("div").find("audio").each(function () {
        //     el.append($(this).clone());
        // });
        closeAnimationPopup();
    });

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
        if($(this).attr("data-animation-type")=="timer"){
            $("#jq_timer").slideDown();
            $("#animation_time").val($(this).attr("data-time"));
        }else{
            $("#jq_timer").slideUp();
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

    $(document).on("change",".content-of-index",function () {
        $(".content-of-index").attr("current",0);
        $(this).attr("current",1);
        var jqthis=$(this);
        setTimeout(function () {
            var pr=parseInt(jqthis.val());
            $(".content-of-index").each(function () {
                if(pr==parseInt($(this).val()) &&  $(this).attr("current")!=1){
                    $(this).val(parseInt($(this).val())+1);
                   var sec_this=$(this);
                    setTimeout(function () {
                        sec_this.change();
                        updateOrder();
                    },1);
                }
            });
        },1);
    });
    $("#update_fontsize_widget").click(function () {
        $(".popup-edit-image-container .edit-image-container .close").click();

        $("#"+window.widgetID).find("font").find("*").removeAttr("style");
        var fonttype1= $('.Jq_font-family:checked').attr("fonttype");
        $("#"+window.widgetID).find(".poplinable").css("font-family",fonttype1);
        $("#"+window.widgetID).find(".real-content").css("font-family",fonttype1);
        $("#"+window.widgetID).find("font").css("font-family",fonttype1);
        if($("#"+window.widgetID).find(".poplinable").attr("style")!="undefined" && $("#"+window.widgetID).find(".poplinable").attr("style")!=undefined){
            // $("#"+window.widgetID).find(".poplinable").removeAttr("style");
            $("#"+window.widgetID).find(".poplinable").attr("style",$("#"+window.widgetID).find(".poplinable").attr("style").toString()+";font-size:"+$("#font_size").val().toString()+"px !important");
            $("#"+window.widgetID).find(".poplinable").attr("style",$("#"+window.widgetID).find(".poplinable").attr("style").toString()+";line-height:"+$("#line_height").val().toString()+"px !important");
        }else{
            $("#"+window.widgetID).find(".poplinable").attr("style","font-size:"+$("#font_size").val().toString()+"px !important");
            $("#"+window.widgetID).find(".poplinable").attr("style","line-height:"+$("#line-height").val().toString()+"px !important");
        }
        if($("#"+window.widgetID).find("font").attr("style")!="undefined" && $("#"+window.widgetID).find("font").attr("style")!=undefined){
            $("#"+window.widgetID).find("font").removeAttr("style");
            $("#"+window.widgetID).find("font").attr("style",$("#"+window.widgetID).find("font").attr("style").toString()+";font-size:"+$("#font_size").val().toString()+"px !important");
            $("#"+window.widgetID).find("font").attr("style",$("#"+window.widgetID).find("font").attr("style").toString()+";line-height:"+$("#line-height").val().toString()+"px !important");
        }else{
            $("#"+window.widgetID).find("font").attr("style","font-size:"+$("#font_size").val().toString()+"px !important");
            $("#"+window.widgetID).find("font").attr("style","line-height:"+$("#line-height").val().toString()+"px !important");
        }

        if($("#"+window.widgetID).find(".real-content").attr("style")!="undefined" && $("#"+window.widgetID).find(".real-content").attr("style")!=undefined){
            // $("#"+window.widgetID).find(".real-content").removeAttr("style");
            $("#"+window.widgetID).find(".real-content").attr("style",$("#"+window.widgetID).find(".real-content").attr("style").toString()+";font-size:"+$("#font_size").val().toString()+"px !important");
            $("#"+window.widgetID).find(".real-content").attr("style",$("#"+window.widgetID).find(".real-content").attr("style").toString()+";line-height:"+$("#line-height").val().toString()+"px !important");
        }else{
            $("#"+window.widgetID).find(".real-content").attr("style","font-size:"+$("#font_size").val().toString()+"px !important");
            $("#"+window.widgetID).find(".real-content").attr("style","line-height:"+$("#line-height").val().toString()+"px !important");
        }
    });


    $(document).on("focus",'.poplinable', function(e) {
        window.setTimeout(function() {
            $(e.target).closest(".element").find(".delete_widget,.setting_widget,.audio_widget").css("top","-28px");
        }, 100);
    });
    $(document).on("focusout",'.poplinable', function(e) {
        window.setTimeout(function() {
            $(e.target).closest(".element").find(".delete_widget,.setting_widget,.audio_widget").css("top","2px");
        }, 100);
    });
    $(document).on("click",'.flip_widget', function(e) {
        window.setTimeout(function() {
            $(e.target).closest(".element").find("img").toggleClass("flip-style");
        }, 100);
    });

    $(document).on("change",".content-of-index",function () {
       $(this).attr("value",$(this).val());
    });


    $(document).on("click",".jq_douknow",function(){
        window.widgetID = $(this).closest(".element").attr("id");
        $("#douknow_img_view").attr("src",$(this).closest(".element").attr("img"));
        $("#douknow_txt_view").html($(this).closest(".element").attr("txt"));
        $("#do-you-know-view").fadeIn();
        $("#do-you-know-view .storytype-container").removeClass("slideOutUp").addClass("animated slideInDown").fadeIn();
    });
    $(document).on("click",".popup-storytype-container .storytype-container .close",function(){
        $("#do-you-know-view").fadeOut();
        $("#do-you-know-view .storytype-container").addClass("slideOutUp").removeClass("animated slideInDown").fadeOut();
    });

    $("#backgroundvalue2").click(function () {
        $("#backgroundp").click();
    });
    $("#backgroundvalue2_buttons").click(function () {
        $("#backgroundp_buttons").click();
    });
    $(".popup-storytype-container .storytype-container .close").click(function () {
        // $(".close").click();
        hideeditpopup();
    });
    $("#bordersize1,.jq_borderstyle2,#bordervalue2").click(function () {
        $("#with_border2").click();
    });
    $("#delay_item").change(function () {
        $("#no_Appearance2").attr("checked",false);
    });
    
    $("#save_item_settings").click(function () {
        var edg_color='';
        if($("#no_backgroundp").prop("checked")){
            bgcolor="";
        }else{
            bgcolor=$("#bg_color2").attr("color");
            edg_color=$("#bg_color2").attr("color");
        }

        if($("#no_border2").prop("checked")){
            border_color="";
            border_style="";
            border_size=0;
        }else{
            border_color=$("#bordervalue2").attr("color");
            border_style=$(".jq_borderstyle2").val();
            border_size=$("#bordersize1").val();
            edg_color=$("#bordervalue2").attr("color");
        }
        if($("#no_Appearance2").prop("checked")){
            timeDelay=-1;
        }else{
            timeDelay=$("#delay_item").val();
        }
        $("#"+window.widgetID).attr({
            "bgcolor":bgcolor,
            "border_color":border_color,
            "border_style":border_style,
            "border_size":border_size,
            "timeDelay":timeDelay
        });
        $("#"+window.widgetID).find(".real-content").css({
            "background-color" : "#"+bgcolor,
            "border-color" : "#"+border_color,
            "border-style" : border_style,
            "border-width" : (border_size).toString()+"px",
        });
        $("#"+window.widgetID).find(".box1").attr("style","--my-color-var:#"+edg_color);

        // $(".close").click();
        hideeditpopup();
    });

    $("#save_item_settings_buttons").click(function () {
        var edg_color='';
        if($("#no_backgroundp_buttons").prop("checked")){
            bgcolor="";
        }else{
            bgcolor=$("#bg_color2_buttons").attr("color");
            edg_color=$("#bg_color2_buttons").attr("color");
        }
        $("#"+window.widgetID).attr({
            "bgcolor":bgcolor
        });
        $("#"+window.widgetID).find(".real-content").children("button").css({
            "background-color" : "#"+bgcolor,
        });
        // $(".close").click();
        hideeditpopup();
    });

    $("#save_page_settings").click(function () {
        showLoader();
        $("#page_settings_form")[0].submit();
    });

    $("#update_image_widget").click(function () {
        showLoader();
        $(".jq_storypath").val(window.storyPath);
        $(".jq_widgetid").val(window.widgetID);
        $("#image_form")[0].submit();
    });
    
    $("#save_iframe").click(function () {
        $("#"+window.widgetID).find("iframe").attr("src",$("#iframe_widget").val());
        // $(".close").click();
        hideeditpopup();
    });
    $("#jq_savedouknow").click(function () {
        showLoader();
        $(".jq_storypath").val(window.storyPath);
        $(".jq_widgetid").val(window.widgetID);
        $("#douknow_form")[0].submit();
    });
    $("#update_audio_widget").click(function () {
        $(".jq_player").each(function () {
            initPlayers($(this));
        });

        showLoader();
        if($("#audio_form").find(".audio-sound-setting").find("source").attr("src").toString().search("blob")==-1){
            $(".jq_storypath").val(window.storyPath);
            $(".jq_widgetid").val(window.widgetID);
            $("#audio_form")[0].submit();
        }else{
            window.fd = new FormData();
            window.fd.append('audio_file',recorderBlob,"record.mp3");
            window.fd.append("storypath",storyPath);
            window.fd.append("widgetid",widgetID);
            $.ajax({
                method: "POST",
                url: SITE_URL+"platform/ajax/storyeditor.php?process=audiowidget&ajax=1",
                data: window.fd,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (result) {
                    console.log(result);
                   if(result.status==1){
                       console.log("status",result.status);
                       $("#"+widgetID).attr("sound",result.file);
                       $("#"+widgetID).find("source").attr("src",result.source);
                       $("#"+widgetID).find("audio")[0].load();
                      // $(".close").click();
                   }
                    window.parent.hideLoader();
                }
            });
        }
    });
    $("#update_video_widget").click(function () {
        showLoader();
        $(".jq_storypath").val(window.storyPath);
        $(".jq_widgetid").val(window.widgetID);
        $("#video_form")[0].submit();
    });
    $(document).on("click",".jq_deletequestion",function () {
        if($(".jq_questioni").length>1){
            $("#delete_question").attr("pageid",$(this).closest(".jq_questioni").attr("pageid"));
            showdeletemessage();
        }else{
            showMsg("error",window.Lang.atLeastOnePage);
        }
    });
    $("#delete_question").click(function () {
        deletePage();
    });

    $(document).on("click",".jq_questioni",function (e) {
        if(!window.disableNavigation){
            if ($(e.target).hasClass("jq_questioni")){
                if(!$(this).hasClass("active")){
                    showLoader();
                    savePage($(this).attr("pageid"));
                }
            }
        }else{
            var srcattr =SITE_URL+storyPath+"/images/"+$(this).attr("thumb");
            $(".select-object.selected").closest(".accordion-panel").find(".Jq_target_Specific_page .select-thumb img").attr("src",srcattr);
            $(".select-object.selected").closest(".accordion-panel").find(".Jq_target_Specific_page").attr("target-id",$(this).attr("pageid"));
            window.disableNavigation=false;
            $(".closeA").click();
        }
    });

    
    $(document).on("change","[name='viewtype']",function() {
        if($("#Onepage").prop("checked")){
            $("#slider_option_show").slideUp();
        }else if($("#Towpage").prop("checked")){
            $("#slider_option_show").slideUp();
        }else if($("#sliderview").prop("checked")) {
            $("#slider_option_show").slideDown();
        }
    });



    refreshElement();
    // $("#questions_slider li").tooltip({
    //     tooltipClass: "custom-tooltip-styling"
    // });
    $(document).on("click",".jq_mainquestiontext",function(){
        if($(this).attr("default")=="0"){
            $(this).html("");
            $(this).keydown(function(){
                $(this).attr("default","1");
            });
        }
    });
    $(document).on("click",function(e){
        if(typeof $(e.target).closest(".jq_mainquestiontext").attr("class")==undefined || typeof $(e.target).closest(".jq_mainquestiontext").attr("class")=="undefined"){
            $(".jq_mainquestiontext").each(function(){
                if($(this).attr("default")=="0"){
                    $(this).html(Lang.writeYourquestion);
                }
            });
        }
    });
    $(document).on("click", ".additem", function () {
        var id='id_' + Math.random().toString(36).substr(2, 9);
        html='<li class="line-row ans"><div class="floating-right action-hover"><i class="save floating-left"></i><i class="edit floating-left"></i><i class="delete floating-left"></i></div><label class="box-number floating-left">0</label><span class="floating-left"> Item 0</span><textarea></textarea></li>';
        $(".sequence .ui-sortable").append(html);
        refreshElement();
    });
    $(document).on("click", "#update_sound", function () {
        $("#sound_form").attr("action", SITE_URL+"platform/ajax/editor.php?process=updatequizsound&quizid=" + window.quizid+"&sound_id="+window.widgetID);
        $("#sound_form").submit();
        showLoader();
    });




    $(document).on("click", "#update_video", function () {
        youtubeID = youtube_getID($("#youtube").val());
        selector = "#" + window.widgetID;
        if(youtubeID)
        {
            $(selector).find("iframe").first().attr("src", "https://www.youtube.com/embed/" + youtubeID);
            // $(selector).find("iframe").first().attr("title", $("#videotitle").val());
            $("#youtube").val("");
        }
        else {
            urlID=$("#youtube").val();
            $(selector).find("iframe").first().attr("src",urlID);
        }
        closePopup();
    });
    $(document).on("click", "#update_image", function () {
        $("#image_form").attr("action",  SITE_URL+"platform/ajax/editor.php?process=updatequizimage&quizid=" + window.quizid+"&image_id="+window.widgetID);
        $("#image_form").submit();
        showLoader();
    });
    $(document).on("click", "#update_imagec", function () {
        $("#image_formc").attr("action",  SITE_URL+"platform/ajax/editor.php?process=updatequizimagec&quizid=" + window.quizid+"&image_id=image_"+window.quizid+window.questionid);
        $("#image_formc").submit();
        showLoader();
    });

    $(".jq_delete_page_sound").click(function () {
        showLoader();
        var data={};
        data["storyid"]=window.storyid;
        data["storypath"]=window.storyPath;
        data["pageid"]= $("#page_settings_page").val();
        $.ajax({
            method: "POST",
            url: "../platform/ajax/storyeditor.php?process=deletebgsound",
            data: data,
            dataType: "html",
            success: function (result) {
                console.log(result);
                $("#source-a").attr("src","");
                $("#audio-a")[0].load();
               $('.jq_questioni[pageid="'+$("#page_settings_page").val()+'"]').removeAttr("bg_sound");
                hideLoader();
            }
        });

    });
    $(document).on("click",".jq_delete_screenshot",function () {

        var data={};
        data["storyid"]=window.storyid;
        data["storypath"]=window.storyPath;
        data["img"]=$(this).attr("img");
        $(this).closest("div").remove();
        $.ajax({
            method: "POST",
            url: "../platform/ajax/storyeditor.php?process=deletescreenshoot",
            data: data,
            dataType: "html",
            success: function (result) {

            }
        });

    });

    $(".jq_delete_pagebg").click(function () {
        showLoader();
        var data={};
        data["storyid"]=window.storyid;
        data["storypath"]=window.storyPath;
        data["pageid"]= $("#page_settings_page").val();
        data["img"]=$('.jq_questioni[pageid="'+$("#page_settings_page").val()+'"]').attr("bg_image");
        $.ajax({
            method: "POST",
            url: "../platform/ajax/storyeditor.php?process=deletepagebg",
            data: data,
            dataType: "html",
            success: function (result) {
                console.log(result);
               $('.jq_questioni[pageid="'+$("#page_settings_page").val()+'"]').removeAttr("bg_image");
               $(".story-content-container").css("background","");
               $("#default-image-edit-page").attr("src",SITE_URL+"storyeditor/thems/En/images/imagedef.svg");
                hideLoader();
            }
        });

    });

    $(".jq_delete_pagethumb").click(function () {
        showLoader();
        var data={};
        data["storyid"]=window.storyid;
        data["storypath"]=window.storyPath;
        data["pageid"]= $("#page_settings_page").val();
        data["img"]=$('.jq_questioni[pageid="'+$("#page_settings_page").val()+'"]').attr("thumb");
        $.ajax({
            method: "POST",
            url: "../platform/ajax/storyeditor.php?process=deletepagethumb",
            data: data,
            dataType: "html",
            success: function (result) {
                console.log(result);
                $('.jq_questioni[pageid="'+$("#page_settings_page").val()+'"]').removeAttr("thumb");
                $('.jq_questioni[pageid="'+$("#page_settings_page").val()+'"]').removeAttr("style");
                $("#default-thump-edit-page").attr("src",SITE_URL+"storyeditor/thems/En/images/folder.svg");

                hideLoader();
            }
        });

    });



    //
    // $("#save_question").click(function(){
    //     showLoader();
    //     setTimeout(function () {
    //         hideLoader();
    //     });
    // });
    $(document).on("click",".jq_editquestion",function(){
        $(this).closest(".jq_questioni").click();
        $("#page_settings_page").val($(this).closest(".jq_questioni").attr("pageid"));
        $("#page_settings_storypath").val(window.storyPath);
       // if($(this).closest(".jq_questioni").attr("bg_sound")!=""){
        var audio_src=$(this).closest(".jq_questioni").attr("bg_sound");
        if(audio_src=="" || audio_src==undefined || audio_src=="undefined"){
            audio_src="";
        }else{
            audio_src=SITE_URL+storyPath+"/sound/"+audio_src;
        }
            $("#audio-a").prop("src", audio_src);
            $("#source-a").attr("src",audio_src);
            $("#audio-a")[0].load();

        if($(this).closest(".jq_questioni").attr("bg_image")!="" && $(this).closest(".jq_questioni").attr("bg_image")!="undefined" && $(this).closest(".jq_questioni").attr("bg_image")!=undefined){
            $("#default-image-edit-page").attr("src",SITE_URL+storyPath+"/images/"+$(this).closest(".jq_questioni").attr("bg_image"));
        }else{
            $("#default-image-edit-page").attr("src",SITE_URL+"storyeditor/thems/En/images/imagedef.svg");
        }

        if($(this).closest(".jq_questioni").attr("thumb")!=""&& $(this).closest(".jq_questioni").attr("thumb")!="undefined" && $(this).closest(".jq_questioni").attr("thumb")!=undefined){
            $("#default-thump-edit-page").attr("src",SITE_URL+storyPath+"/images/"+$(this).closest(".jq_questioni").attr("thumb"));
        }else{
            $("#default-thump-edit-page").attr("src",SITE_URL+"storyeditor/thems/En/images/folder.svg");
        }

        if($(this).closest(".jq_questioni").attr("negative")!=""&& $(this).closest(".jq_questioni").attr("negative")!="undefined" && $(this).closest(".jq_questioni").attr("negative")!=undefined){
            $("#default-negative-edit-page").attr("src",SITE_URL+storyPath+"/images/"+$(this).closest(".jq_questioni").attr("negative"));
        }else{
            $("#default-negative-edit-page").attr("src",SITE_URL+"storyeditor/thems/En/images/folder.svg");
        }

        showeditpopup();
        $("#page_settings_form")[0].reset();
    });

    $(".jq_topsave,#topview").click(function () {
        $("#answer_container").find(".save").each(function(){
            if($(this).css("display")!="none"){
                $(this).trigger("click");
            }
        });
        window.questionid=$(".jq_questioni.active").attr("questionid");
        showLoader();
        savePage(-1);
    });
    $('#jq_questionindex').keydown(function(e) {

        if (e.keyCode == 13) {
            var x=parseInt($('#jq_questionindex').val());
            if(x<=$(".jq_questioni").length){
                $(".jq_questioni").eq(x-1).trigger("click");
            }
        }else{
            $(".jq_questioni").first().click();
        }
    });
});
function showMsg(err,msg){
    $(".popup-confirm-container .confirm-container p").html(msg);
    $(".popup-confirm-container").fadeIn();
    $(".popup-confirm-container .confirm-container").removeClass("slideOutUp").addClass("animated slideInDown").fadeIn();
}
function showLoader(){
    $(".loader-main-container").show();
}
function hideLoader(){
    $(".loader-main-container").hide();
}
function hideEditorElement() {
    $(".delete_widget").hide();
    $(".edit_widget").hide();
    $(".move_handler").hide();
    $(".ui-resizable-handle").hide();
    $(".element").css("border", "none");


}
function showEditorElement() {
    $(".delete_widget").show();
    $(".edit_widget").show();
    $(".move_handler").show();
    $(".ui-resizable-handle").show();
    $(".element").css("border", "dashed 1px red");
}
function copyWidget(e) {
    window.copied = $(e).closest(".element").attr("id");
}
function pasteWidget() {
    refresh();
    var widget=$("#"+ window.copied).clone();

   widget.attr("id","widget_" + randomString(7));
   widget.find(".ui-resizable-handle").remove();
   widget.removeClass("ui-draggable");
   widget.removeClass("ui-resizable");
   widget.find(".ui-draggable-handle").removeClass("ui-draggable-handle");
    //widget.resizable();
    console.log(widget.attr("id"));

    var top=($("#story-content-container").height()/2).toString()+"px";
    var left=($("#story-content-container").width()/2).toString()+"px";
   widget.css("top",top);
   widget.css("left",left);
    $("#story-content-container").append(widget);
    setTimeout(function () {
        refreshElement();
    },50);
}
function duplicateWidget(e) {
    copyWidget(e);
    setTimeout(function () {
        pasteWidget();
        $(".content-of-index").change()
    },10);
}
function refreshElement() {
    recordingStyle();
    if($("#Onepage").prop("checked")){
        $(".story-content-container").width($(".story-content-container").height()*2);
    }else{
        $(".story-content-container").width($(".story-content-container").height()*0.666);
    }
    if(parseInt(window.selectedtype)==5){
        $("#answer_contents").removeClass("droppable");
    }else{
        $("#answer_contents").addClass("droppable");
    }
    $(".poplinable").attr("contenteditable", "true");
    if(!destroyed){
        //$(".droppable").droppable("destroy");
        //$(".resizable").resizable("destroy");
        //$(".vresizable").resizable("destroy");
        // $(".draggable").draggable("destroy");
        $(".story-container .ui-droppable").droppable("destroy");
        $(".story-container .ui-resizable").resizable("destroy");
        $(".story-container .ui-draggable").draggable("destroy");
        $(".story-container .ui-resizable-handle").remove();
        destroyed=true;
    }



    destroyed=false;
    var iframelink="";
    var iframes="";
    var imagelink="";

    refreshRotate();
    updateOrder();
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
function refreshRotate() {


    $(".draggable.element").each(function () {
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
function replaceRcorder() {
    $(".plyr").each(function () {
        $(this).closest(".real-content").html('<audio class="plyer-control" controls><source src="sound.mp3" type="audio/mp3"></audio><a class="record-sound floating-left jq_recordsound"><span class="toolbar-button-state recording floating-left"></span><i class="floating-left"></i></a>');
    });
}
function savePage(goTO) {
    $(".element").show();
    $(".story-content-container").css("background","#fff url("+SITE_URL+storyPath+"/images/"+$(".jq_questioni.active").attr("bg_image")+") no-repeat");

    drawLaers();

    // hideEditorElement();
    // showEditorElement();
    replaceRcorder();
    if(!destroyed){
        $(".story-container .ui-droppable").droppable("destroy");
        $(".story-container .ui-resizable").resizable("destroy");
        $(".story-container .ui-draggable").draggable("destroy");
        $(".story-container .ui-resizable-handle").remove();
        destroyed=true;
    }


    $(".poplinable").attr("contenteditable", "false");
    $(".jq_multi_file").each(function () {
        $(this).attr("src", $(this).attr("publish"));
        $(this).attr("data_src", $(this).attr("publish"));
    });
    q = goTO;

    var pagehtml = $('.content-container').html();
    $.ajax({
        method: "POST",
        url:"../platform/ajax/storyeditor.php?process=savepage",
        data: {html:pagehtml,pageid:$(".jq_questioni.active").attr("pageid"),storyid: window.storyid,storypath:window.storyPath},
        dataType: "html",
        success: function (data) {
             console.log("finish",data);
            $(".jq_multi_file").each(function () {
                $(this).attr("src", $(this).attr("editor"));
                $(this).attr("data_src", $(this).attr("editor"));
            });
            ///$("#question_container").attr("style",containerstyle);
            $(".poplinable").attr("contenteditable", "true");
//alert(0)
            if (q == -2) {//newPage
                $("#jq_questionindex").val(parseInt($("#questions_slider .jq_questioni").length)+1);
            } else if (q != -1) {
                loadPage(goTO)
                $("#jq_questionindex").val(parseInt(goTO)+1);
            }else{
                if($(".jq_questioni.active").attr("negative")!=""&& $(".jq_questioni.active").attr("negative")!="undefined" && $(".jq_questioni.active").attr("negative")!=undefined){
                    $(".story-content-container").css("background","#fff url("+SITE_URL+storyPath+"/images/"+$(".jq_questioni.active").attr("negative")+") no-repeat");
                }else{
                    $(".story-content-container").css("background","#fff url("+SITE_URL+storyPath+"/images/"+$(".jq_questioni.active").attr("bg_image")+") no-repeat");
                }

                refreshElement();
                hideLoader();

            }

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
function recordingStyle() {
    // var controls =
    //     [
    //         'play',
    //         'progress',
    //         'duration',
    //         'mute',
    //         'volume',
    //         'download',
    //     ];
    // player=[];
    // randomAudio=0;
    // $(".plyer-control").each(function () {
    //     player[randomAudio] = new Plyr(this,{controls});
    //     randomAudio++;
    // });
}



