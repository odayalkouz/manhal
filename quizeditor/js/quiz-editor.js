/**
 * Created by Hussam Abu Khaidejh on 12/26/2017.
 */
window.SITE_URL="https://www.manhal.com/";
  // window.SITE_URL="http://localhost/Manhal/";
window.edittype="new";
window.selectedtype=1;
destroyed=true;

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
function getQuestionName(type){
    var title='';
    switch (window.selectedtype.toString()) {
        case "1":
            title=Lang.Trueorfalse;
            break;
        case "2":
            title=Lang.MultipleChoice;
            break;
        case "3":
            title=Lang.MultipleResponse;
            break;
        case "4":
            title=Lang.Fillintheblank;
            break;
        case "5":
            title=Lang.Matching;
            break;
        case "6":
            title=Lang.DragAnswer;
            break;
        case "7":
            title=Lang.ClickMap;
            break;
        case "8":
            title=Lang.ShortEssay;
            break;
        case "9":
            title=Lang.Sequence;
            break;
        case "10":
            title=Lang.WordBank;
            break;
        case "11":
            title=Lang.Fillintheblank;
            break;
    }
    return title;
}
function updateAnswerHTMl(){
    var id='id_' + Math.random().toString(36).substr(2, 9);
    var id2='id_' + Math.random().toString(36).substr(2, 9);
    var id3='id_' + Math.random().toString(36).substr(2, 9);
    var id4='id_' + Math.random().toString(36).substr(2, 9);
    var name='name_' + Math.random().toString(36).substr(2, 9);
    switch (window.selectedtype.toString()){
        case "1"://true & false
            html='<div class="true-false floating-left">';
            html+='<ul>';
            html+='<li class="answer1">';
            html+='<input att="1" type="radio" name="'+name+'" id="'+id+'" checked>';
            html+='<label for="'+id+'">';
            html+='<div class="image-true"></div>';
            html+='</label>';
            html+='<div class="bullet">';
            html+='<div class="line zero"></div>';
            html+='<div class="line one"></div>';
            html+='<div class="line two"></div>';
            html+='<div class="line three"></div>';
            html+='<div class="line four"></div>';
            html+='<div +=class="line five"></div>';
            html+='<div class="line six"></div>';
            html+='<div class="line seven"></div>';
            html+='</div>';
            html+='</li>';
            html+='<li class="answer2">';
            html+='<input att="0" type="radio" name="'+name+'" id="'+id2+'">';
            html+='<label for="'+id2+'">';
            html+='<div class="image-false"></div>';
            html+='</label>';
            html+='<div class="bullet">';
            html+='<div class="line zero"></div>';
            html+='<div class="line one"></div>';
            html+='<div class="line two"></div>';
            html+='<div class="line three"></div>';
            html+='<div class="line four"></div>';
            html+='<div class="line five"></div>';
            html+='<div class="line six"></div>';
            html+='<div class="line seven"></div>';
            html+='</div>';
            html+='</li>';
            html+='</ul>';
            html+='</div>';
            break;
        case "2":
            // Multiple Choice
            html='<div class="multible-choises floating-left">';
            html+='<ul>';
            html+='<li class="ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<input type="radio" name="Quastion0" id="'+id+'">';
            html+='<label for="'+id+'">';
            html+='<div><span>'+Lang.One+'</span></div>';
            html+='<textarea></textarea>';
            html+='</label>';
            html+='<div class="bullet">';
            html+='<div class="line zero"></div>';
            html+='<div class="line one"></div>';
            html+='<div class="line two"></div>';
            html+='<div class="line three"></div>';
            html+='<div class="line four"></div>';
            html+='<div class="line five"></div>';
            html+='<div class="line six"></div>';
            html+='<div class="line seven"></div>';
            html+='</div>';
            html+='</li>';


            html+='<li class="ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<input type="radio" name="Quastion0" id="'+id2+'">';
            html+='<label for="'+id2+'">';
            html+='<div><span>'+Lang.Tow+'</span></div>';
            html+='<textarea></textarea>';
            html+='</label>';
            html+='<div class="bullet">';
            html+='<div class="line zero"></div>';
            html+='<div class="line one"></div>';
            html+='<div class="line two"></div>';
            html+='<div class="line three"></div>';
            html+='<div class="line four"></div>';
            html+='<div class="line five"></div>';
            html+='<div class="line six"></div>';
            html+='<div class="line seven"></div>';
            html+='</div>';
            html+='</li>';


            html+='<li class="ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<input type="radio" name="Quastion0" id="'+id3+'">';
            html+='<label for="'+id3+'">';
            html+='<div><span>'+Lang.Three+'</span></div>';
            html+='<textarea></textarea>';
            html+='</label>';
            html+='<div class="bullet">';
            html+='<div class="line zero"></div>';
            html+='<div class="line one"></div>';
            html+='<div class="line two"></div>';
            html+='<div class="line three"></div>';
            html+='<div class="line four"></div>';
            html+='<div class="line five"></div>';
            html+='<div class="line six"></div>';
            html+='<div class="line seven"></div>';
            html+='</div>';
            html+='</li>';


            html+='</ul>';
            html+='<div class="additem tooltip" data-balloon-length="large1" data-balloon-pos="up" data-balloon="'+Lang.helpadditem+'"></div>';
            html+='</div>';
            break;
        case "3"://multiple response
            html='<div class="display-block"><div class="multiple-response floating-left ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'">';
            html+='<div class="line-row">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<input att="0" type="checkbox" id="'+id+'">';
            html+='<label for="'+id+'" class="check-box v3 floating-left"></label>';
            html+='<label for="'+id+'" class="floating-left option-text">';
            html+='<div class="vresizable dropable selected_dropable"><label>'+Lang.Three+'</label></div>';
            html+='</label>';
            html+='<textarea></textarea>';
            html+='</div>';
            html+='</div>';
            html+='<div class="multiple-response floating-left ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'">';
            html+='<div class="line-row">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<input att="0" type="checkbox" id="'+id2+'">';
            html+='<label for="'+id2+'" class="check-box v3 floating-left"></label>';
            html+='<label for="'+id2+'" class="floating-left option-text">';
            html+='<div class="vresizable dropable"><label>'+Lang.Four+'</label></div>';
            html+='</label>';
            html+='<textarea></textarea>';
            html+='</div>';
            html+='</div>';
            html+='<div class="multiple-response floating-left ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'">';
            html+='<div class="line-row">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<input att="0" type="checkbox" id="'+id3+'">';
            html+='<label for="'+id3+'" class="check-box v3 floating-left"></label>';
            html+='<label for="'+id3+'" class="floating-left option-text">';
            html+='<div class="vresizable dropable"><label>'+Lang.One+'</label></div>';
            html+='</label>';
            html+='<textarea></textarea>';
            html+='</div>';
            html+='</div>';
            html+='<div class="multiple-response floating-left ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'">';
            html+='<div class="line-row">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<input att="0" type="checkbox" id="'+id4+'">';
            html+='<label for="'+id4+'" class="check-box v3 floating-left"></label>';
            html+='<label for="'+id4+'" class="floating-left option-text">';
            html+='<div class="vresizable dropable"><label>'+Lang.Two+'</label></div>';
            html+='</label>';
            html+='<textarea></textarea>';
            html+='</div>';
            html+='</div></div>';
            html+='<div class="additem tooltip" data-balloon-length="large1" data-balloon-pos="up" data-balloon="'+Lang.helpadditem+'"></div>';
            break;
        case "4"://fill in the blank
            html='<div class="fill-in-the-blank floating-left ">';
            html+='<div class="display-block"><div class="title" placeholder="'+Lang.EnteryourAnswer+'">'+Lang.EnteryourAnswer+'</div>';
            html+='<div class="box-text ans">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<span></span>';
            html+='<input id="inputtextQuastion3" type="text" value=" ">';
            html+='</div>';
            html+='';
            html+='</div><div class="additem tooltip" data-balloon-length="large1" data-balloon-pos="up" data-balloon="'+Lang.helpadditem+'"></div></div>';
            break;
        case "5"://matching
            html='<div class="matching floating-left">';
            html+='<div class="left-container floating-left">';
            html+='<div class="box-container droppable ans_left">';
            html+='</div>';
            html+='<div class="box-container droppable ans_left">';
            html+='</div>';
            html+='<div class="box-container droppable ans_left">';
            html+='</div>';
            html+='</div>';
            html+='<div class="center-container floating-left">';
            html+='<div class="left floating-right">';
            html+='<div class="item">';
            html+='<div class="button">1</div>';
            html+='</div>';
            html+='<div class="item">';
            html+='<div class="button">2</div>';
            html+='</div>';
            html+='<div class="item">';
            html+='<div class="button">3</div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="right floating-left">';
            html+='<div class="item">';
            html+='<select class="text-box" disabled>';
            html+='<option value="0">1</option>';
            html+='<option value="1">2</option>';
            html+='<option value="2">3</option>';
            html+='</select>';
            html+='</div>';
            html+='<div class="item">';
            html+='<select class="text-box" disabled>';
            html+='<option value="0">1</option>';
            html+='<option value="1">2</option>';
            html+='<option value="2">3</option>';
            html+='</select>';
            html+='</div>';
            html+='<div class="item">';
            html+='<select class="text-box" disabled>';
            html+='<option value="0">1</option>';
            html+='<option value="1">2</option>';
            html+='<option value="2">3</option>';
            html+='</select>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="left-container floating-right">';
            html+='<div class="box-container droppable ans_right">';
            html+='</div>';
            html+='<div class="box-container droppable ans_right">';
            html+='</div>';
            html+='<div class="box-container droppable ans_right">';
            html+='</div>';
            html+='</div>';
            html+='<div class="additem tooltip" data-balloon-length="large1" data-balloon-pos="up" data-balloon="'+Lang.helpadditem+'"></div>';
            html+='</div>';
            break;
        case "6":
            html='<div class="word-bank floating-left">';
            html+='<div class="box-drag-in">'+Lang.Dragyouranswer+'</div>';
            html+='<ul>';
            html+='<li class="ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<input type="radio" name="Quastion0" id="'+id+'">';
            html+='<label for="'+id+'">';
            html+='<div>'+Lang.One+'</div>';
            html+='<textarea></textarea>';
            html+='</label>';
            html+='<div class="bullet">';
            html+='<div class="line zero"></div>';
            html+='<div class="line one"></div>';
            html+='<div class="line two"></div>';
            html+='<div class="line three"></div>';
            html+='<div class="line four"></div>';
            html+='<div class="line five"></div>';
            html+='<div class="line six"></div>';
            html+='<div class="line seven"></div>';
            html+='</div>';
            html+='</li>';

            html+='<li class="ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<input type="radio" name="Quastion0" id="'+id2+'">';
            html+='<label for="'+id2+'">';
            html+='<div>'+Lang.Tow+'</div>';
            html+='<textarea></textarea>';
            html+='</label>';
            html+='<div class="bullet">';
            html+='<div class="line zero"></div>';
            html+='<div class="line one"></div>';
            html+='<div class="line two"></div>';
            html+='<div class="line three"></div>';
            html+='<div class="line four"></div>';
            html+='<div class="line five"></div>';
            html+='<div class="line six"></div>';
            html+='<div class="line seven"></div>';
            html+='</div>';
            html+='</li>';

            html+='<li class="ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<input type="radio" name="Quastion0" id="'+id3+'">';
            html+='<label for="'+id3+'">';
            html+='<div>'+Lang.Three+'</div>';
            html+='<textarea></textarea>';
            html+='</label>';
            html+='<div class="bullet">';
            html+='<div class="line zero"></div>';
            html+='<div class="line one"></div>';
            html+='<div class="line two"></div>';
            html+='<div class="line three"></div>';
            html+='<div class="line four"></div>';
            html+='<div class="line five"></div>';
            html+='<div class="line six"></div>';
            html+='<div class="line seven"></div>';
            html+='</div>';
            html+='</li>';


            html+='</ul>';
            html+='<div class="additem tooltip" data-balloon-length="large1" data-balloon-pos="up" data-balloon="'+Lang.helpadditem+'"></div>';
            html+='</div>';
            break;
        case "7"://click map
            html='<div class="click-map floating-left">';
            html+='<div class="pointer-click"></div>';
            html+='<div class="box-map-main">';
            html+='<div class="box-map-inner" id="ClickMap6">';
            html+='<div id="ErrorClickMap6"></div>';
            html+='<div class="resizable xdraggable" style="width: 50%;height: 50%;position: absolute;left: 25%;"><div class="noclose  move_handler flaticon-more9 tooltip" data-balloon-pos="down" data-balloon="'+Lang.helpmovethecircle+'"></div><img id="map_image" style="height: 100%;width:100%;" att="6" src="https://www.manhal.com/quizeditor/thems/En/images/image.png" publish="https://www.manhal.com/quizeditor/thems/En/images/image.png">';
            html+='<div class="red circle-map resizable cdraggable" style="width:50px; height:50px;position:absolute; left:10%; top: 10%; z-index: 9">';
            html+='<div class="delete_widget floating-left"></div>';
            html+='<div class="noclose  move_handler flaticon-more9 tooltip" data-balloon-pos="down" data-balloon="'+Lang.helpmovethecircle+'"></div>';
            html+='<div class="bullet">';
            html+='</div>';
            html+='</div>';
            html+='</div></div>';
            html+='</div>';
            html+='<div class="additem tooltip" data-balloon-length="large1" data-balloon-pos="up" data-balloon="'+Lang.helpadditem+'"></div><div class="edit-image tooltip" data-balloon-pos="'+window.right+'" data-balloon="'+Lang.uploadImage+'"></div>';
            html+='</div>';
            break;
        case "8"://short Essay
            titles="short Essay";
            html='<div class="short-essay floating-left">';
            html+='<div class="paper-background ">';
            html+='<section contenteditable="true" class="paper-content essay_answer"></section>';
            html+='</div>';
            html+='</div>';
            break;
        case "9"://sequence
            html='<div class="sequence floating-left">';
            html+='<ul class="ui-sortable">';

            html+='<li class="line-row ans">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<label class="box-number floating-left">0</label>';
            html+='<span class="floating-left">'+Lang.Item0+'</span>';
            html+='<textarea></textarea>';
            html+='</li>';

            html+='<li class="line-row ans">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<label class="box-number floating-left">1</label>';
            html+='<span class="floating-left">'+Lang.Item1+'</span>';
            html+='<textarea></textarea>';
            html+='</li>';

            html+='<li class="line-row ans">';
            html+='<div class="floating-right action-hover">';
            html+='<i class="save floating-left"></i>';
            html+='<i class="edit floating-left"></i>';
            html+='<i class="delete floating-left"></i>';
            html+='</div>';
            html+='<label class="box-number floating-left">2</label>';
            html+='<span class="floating-left">'+Lang.Item2+'</span>';
            html+='<textarea></textarea>';
            html+='</li>';


            html+='</ul>';
            html+='<div class="additem tooltip" data-balloon-length="large1" data-balloon-pos="up" data-balloon="'+Lang.helpadditem+'"></div>';
            html+='</div>';
            break;
    }
    // console.log("case ",window.selectedtype);
    $("#answer_contents").html(html);
    $("#question_contents").html('<div class="text floating-left"><div class="question"><span><div class="text-left"><div class=" vresizable jq_multi_file dropable poplinable jq_mainquestiontext" contenteditable="true" publish="" editor=""  src="" data_src="" default="0">'+Lang.writeYourquestion+'</div></div></div></span></div>');
}
$(document).ready(function () {

    var context = $('.question-view')
        .nuContextMenu({
            hideAfterClick: true,
            items: '.move_handler',
            callback: function (key, item) {
                switch (key) {
                    case "Bringtofront":
                        zindex = 1;
                        $(".element.draggable").each(function () {
                            if (parseInt($(this).css("z-index")) > zindex) {
                                zindex = parseInt($(this).css("z-index"));
                            }
                        });
                        zindex += 1;
                        $(item).closest(".element").css("z-index", zindex);
                        break;
                    case "Sendtoback":
                        zindex = -1;
                        $(".element.draggable").each(function () {
                            if (parseInt($(this).css("z-index")) < zindex) {
                                zindex = parseInt($(this).css("z-index"));
                            }
                        });
                        zindex -= 1;
                        $(item).closest(".element").css("z-index", zindex);
                        break;
                }
            },
            menu: [
                {
                    name: 'Bringtofront',
                    title: 'Bring to front'

                },
                {
                    name: 'Sendtoback',
                    title: 'Send to back'
                },
            ]

        });

    var evt         = new Event(),
        dragdrop    = new Dragdrop(evt),
        rg          = new RulersGuides(evt, dragdrop,document.getElementById('content-container1'));
    $("#questions_slider li").tooltip({
        tooltipClass: "custom-tooltip-styling"
    });

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

    $(document).on("click",".save",function(){
      //  setTimeout(function(){
            //savePage(-1);
        //},50);
    });

    $(document).on("click",".multible-choises li",function(e){
        if($(e.target).attr("type")=="radio"){
            $(".multible-choises input").removeAttr("checked");
            $(".multible-choises input").prop("checked",false);
            $(this).find('input').prop("checked",true);
            $(this).find('input').attr("checked","checked");
        }

    });
    $(document).on("click",".true-false li",function(e){
        if($(e.target).attr("type")=="radio") {
            $(".true-false input").removeAttr("checked");
            $(".true-false input").prop("checked", false);
            $(this).find('input').attr("checked", "checked");
            $(this).find('input').prop("checked", true);
        }
    });
    $(document).on("click",".word-bank li",function(e){
        if($(e.target).attr("type")=="radio") {
            $(".word-bank input").removeAttr("checked");
            $(".word-bank input").prop("checked", false);
            $(this).find('input').attr("checked", "checked");
            $(this).find('input').prop("checked", true);
        }
    });
    $(document).on("click",".multiple-response.ans",function(e){
        if($(e.target).attr("type")=="checkbox" || $(e.target).hasClass("check-box")) {
            var i= $(this).find('input').first();
            if(i.prop("checked")){
                i.prop("checked",false);
                i.removeAttr("checked");
            }else{
                i.prop("checked",true);
                i.attr("checked","checked");
            }
        }
    });

    $(document).on("change",".matching select",function () {
        var v=$(this).val();
       $(this).find('option').removeAttr("selected");
        $(this).val(v);
       $(this).find('option[value="'+v+'"]').attr("selected","selected");
    });



    setTimeout(function(){
        $(".jq_questioni").first().click();
    },300);
    //setTimeout(function(){
    //    refreshElement();
    //},600);

    $(document).on("click", ".delete", function () {
        $(this).closest(".ans").remove();
    });
    $(document).on("click", ".additem", function () {
        var id='id_' + Math.random().toString(36).substr(2, 9);
        switch (parseInt(window.selectedtype)){
            case 2:
                html='<li class="ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'"><div class="floating-right action-hover"><i class="save floating-left"></i><i class="edit floating-left"></i><i class="delete floating-left"></i></div><input type="radio" name="Quastion0" id="'+id+'"><label for="'+id+'"><div style="width: 100%;height: 100%" class="vresizable droppable"><span>One</span></div><textarea></textarea></label><div class="bullet"><div class="line zero"></div><div class="line one"></div><div class="line two"></div><div class="line three"></div><div class="line four"></div><div class="line five"></div><div class="line six"></div><div class="line seven"></div></div></li></li>';
                $("#answer_contents ul").append(html);
                break;
            case 3:
                html='<div class="multiple-response floating-left ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'"><div class="line-row"><div class="floating-right action-hover"><i class="save floating-left"></i><i class="edit floating-left"></i><i class="delete floating-left"></i></div><input att="0" type="checkbox" id="'+id+'"><label for="'+id+'" class="check-box v3 floating-left"></label><label for="'+id+'" class="floating-left option-text"><div class="vresizable dropable">One</div></label><textarea></textarea></div></div>';
                $("#answer_contents .display-block").append(html);
                break;
            case 4:
                html='<div class="box-text ans"><div class="floating-right action-hover"><i class="save floating-left"></i><i class="edit floating-left"></i><i class="delete floating-left"></i></div><span></span><input id="'+id+'" type="text" value=" "></div>';
                $(".fill-in-the-blank div.display-block").append(html);
                break;
            case 5:
                $(".matching .left-container.floating-left").append('<div class="box-container droppable ans_left"></div>');
                $(".matching .center-container .left").append('<div class="item"><div class="button">'+($(".matching .center-container .left .item").length+1).toString()+'</div></div>');
                $(".matching .center-container .right").append('<div class="item"><select class="text-box" disabled><option value="0">1</option><option value="1">2</option><option value="2">3</option></select></div>');
                $(".matching .left-container.floating-right").append('<div class="box-container droppable ans_right"></div>');
                break;
            case 6:
                html='<li class="ans" data-balloon-pos="down" data-balloon="'+Lang.helpselecttheanswer+'"><div class="floating-right action-hover"><i class="save floating-left"></i><i class="edit floating-left"></i><i class="delete floating-left"></i></div><input type="radio" name="Quastion0" id="'+id+'"><label for="'+id+'"><div>One</div><textarea></textarea></label><div class="bullet"><div class="line zero"></div><div class="line one"></div><div class="line two"></div><div class="line three"></div><div class="line four"></div><div class="line five"></div><div class="line six"></div><div class="line seven"></div></div></li>';
                $("#answer_contents ul").append(html);
                break;
            case 7:
                html='<div class="red circle-map ans resizable cdraggable"  style="width:50px; height:50px;position:absolute; left:10%; top: 10%; z-index: 9"><div class="delete_widget floating-left"></div><div class="noclose  move_handler flaticon-more9 tooltip" data-balloon-pos="down" data-balloon="'+Lang.helpmovethecircle+'"></div><div class="bullet"></div></div>';
                $("#answer_contents .xdraggable").append(html);
                break;
            case 9:
                html='<li class="line-row ans"><div class="floating-right action-hover"><i class="save floating-left"></i><i class="edit floating-left"></i><i class="delete floating-left"></i></div><label class="box-number floating-left">0</label><span class="floating-left"> Item 0</span><textarea></textarea></li>';
                $(".sequence .ui-sortable").append(html);
                break;
        }
        refreshElement();
       // setTimeout(function(){
            //savePage(-1);
        //},50);
    });
    $(document).on("click", "#update_sound ", function () {
        $("#sound_form").attr("action", SITE_URL+"platform/ajax/editor.php?process=updatequizsound&quizid=" + window.quizid+"&sound_id="+window.widgetID);
        $("#sound_form").submit();
        showLoader();
    });
    $(document).on("click", "#update_asound ", function () {
        $("#asound_form").attr("action", SITE_URL+"platform/ajax/editor.php?process=updatequizasound&quizid=" + window.quizid+"&sound_id="+window.widgetID);
        $("#asound_form").submit();
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

    $("#questions_slider").sortable({
        handle: ".jq_movequestion",
        change: function( event, ui ) {
            setTimeout(function(){
                var data={};
                var q={};
                var i=0;
                $(".jq_questioni").each(function(){
                    q[i]=$(this).attr("questionid");
                    i++;
                });
                data["order"]=q;
                data["quizid"]=window.quizid;
                $.ajax({
                    method: "POST",
                    url: window.SITE_URL+"platform/ajax/editor.php?process=sortquestions",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        // console.log(data);
                    }
                });

            },500);
        }
    });

    $(".addQuestion").click(function(){
       // setTimeout(function(){
            //savePage(-1);
   //     },50);
        window.edittype="new";
        showeditpopup();
        $(".popup-questiontype-container .questiontype-container .items-container .item-container").removeClass("active");
        $('.popup-questiontype-container .questiontype-container .items-container .item-container[qtype="'+window.selectedtype+'"]').addClass("active");

    });

    $("#save_question").click(function(){
        showLoader();
        updateAnswerHTMl();
        $(".question-title").html(getQuestionName(window.selectedtype));
        setTimeout(function () {
            if(window.edittype=="new"){
                var data={};
                data["quizid"]=window.quizid;
                data["type"]=window.selectedtype;
                $(".question-title").remove();
                var question = $('#question_container').html();
                $("#question_container").append('<div class="question-title"></div>');
                $(".question-title").html(getQuestionName(window.selectedtype));

                data["question"] = question;
                data["answer_html"] = $('#answer_container').html();
                $.ajax({
                    method: "POST",
                    url: window.SITE_URL+"platform/ajax/editor.php?process=addquesttion",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        hideLoader();

                        // console.log(data);
                        if(data.result==1){
                            $(".jq_questioni").removeClass("active");
                            var qnumber=$(".jq_questioni").length+1;
                            $("#questions_slider").append('<li title="'+getQuestionName(window.selectedtype)+'" class="jq_questioni active" questionid="'+data.id+'"><a>Q'+qnumber+'</a><label class="floating-right"><i class="edit jq_editquestion floating-left" title="'+Lang.Edit+'"></i><i class="delete jq_deletequestion floating-left" title="'+Lang.Delete+'"></i><i class="jq_movequestion floating-left" title="'+Lang.Move+'"></i></label></li>');

                            $("#questions_slider li").tooltip({
                                tooltipClass: "custom-tooltip-styling"
                            });
                            //$(".jq_multi_file").each(function () {
                            //    $(this).attr("src", $(this).attr("editor"));
                            //    $(this).attr("data_src", $(this).attr("editor"));
                            //});
                            ///$("#question_container").attr("style",containerstyle);
                            $(".poplinable").attr("contenteditable", "true");
                            $("#question_contents").css("height","100%");
                            $("#jq_questionindex").val($(".jq_questioni").length);
                            $("#correctpoints").val(10);
                            $(".editor-main-container footer .content .num-of-question label:nth-child(1)").html($(".jq_questioni").length);
                            refreshElement();
                            var slideCount = $('#slider ul li').length+8;
                            var slideWidth = $('#slider ul li').width();
                            var slideHeight = $('#slider ul li').height();
                            var sliderUlWidth = slideCount * slideWidth + 100;
                            $('#slider').css({width: sliderUlWidth, height: slideHeight});
                            $('#slider ul').css({width: sliderUlWidth});
                            $("#incorrectfeedback").val("");
                            $("#correctfeedback").val("");
                            $("#correctpoints").val(10);
                             slideCount = $('#slider ul li').length;
                             slideWidth = $('#slider ul li').width() + 8;
                             slideHeight = $('#slider ul li').height();
                             sliderUlWidth = slideCount * slideWidth;
                            if (sliderUlWidth < $('#slider').width() && slideCount >=18) {
                                $(".control_next").fadeIn();
                                $(".control_prev").fadeOut();
                                $("#slider").css('width', '100%');
                            }
                        }else{
                            showMsg();
                        }
                    }
                });
            }else{
                savePage(-1);
            }
        },500);

    });

    $("#quiz_update").click(function(){
        showLoader();
        var data={};
        data["quizid"]=window.quizid;
        data["title"]=$("#quiz_title").val();
        data["introduction"] = $('#quiz_introduction').val();
        data["language"] = $('#quiz_language').val();
        data["age"] = $('#quiz_age').val();
        if($("#private").prop("checked")){
            data["is_public"] = 0;
        }else{
            data["is_public"] = 1;
        }
        data["passed"] = $('#quiz_passed').val();
        data["failed"] = $('#quiz_failed').val();
        data["Category"] = $('#quiz_category').val();
        data["passing_rate"] = $('#passing_rate').val();
        data["quiz_passedj"] = $('#quiz_passedj').val();
        data["quiz_failedj"] = $('#quiz_failedj').val();
        data["quiz_time"] = $('#quiz_time').val();
        $("#quiz_top_title").html(data["title"]);
        $.ajax({
            method: "POST",
            url: window.SITE_URL+"platform/ajax/editor.php?process=updatequiz",
            data: data,
            dataType: "json",
            success: function (data) {
                hideLoader();
                // console.log(data);
                if(data.result==1){
                    hidesettingpopup();
                }else{
                    showMsg();
                }
            }
        });
    });

    $(document).on("click",".jq_editquestion",function(){
        window.edittype=$(this).closest(".jq_questioni").attr("questionid");
        $(".popup-questiontype-container .questiontype-container .items-container .item-container").removeClass("active");
        $('.popup-questiontype-container .questiontype-container .items-container .item-container[qtype="'+window.selectedtype+'"]').addClass("active");
        showeditpopup();
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
    $("#delete_question").click(function(){
        var data={};
        data["quizid"]=window.quizid;
        data["questionid"]=$(".jq_questioni.active").attr("questionid");
        $.ajax({
            method: "POST",
            url: window.SITE_URL+"platform/ajax/editor.php?process=deletequistion",
            data: data,
            dataType: "html",
            success: function (data) {
                hideLoader();
                // console.log(data);
                if(data==1){
                    $(".jq_questioni.active").remove();
                    $(".jq_questioni").first().click();
                }else{
                    showMsg("error",data);
                }
            }
        });
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

    $(document).on("click",".jq_questioni", function () {
        if(!$(this).hasClass("active")){
            showLoader();
            $("#jq_questionindex").val($(this).index()+1);
            $(".jq_questioni").removeClass("active");
            $(this).addClass("active");
            var data={};
            data["question"] = $('#question_container').html();
            data["answer_html"] = $('#answer_container').html();
            data["quizid"]=window.quizid;
            data["questionid"]=$(this).attr("questionid");
            window.questionid=$(this).attr("questionid");
            $.ajax({
                method: "POST",
                url: window.SITE_URL+"platform/ajax/editor.php?process=getquesttion",
                data: data,
                dataType: "json",
                success: function (data) {
                    hideLoader();
                    // console.log(data);
                    if(data.result==1){
                        $("#question_container").html(data.question);
                        $("#question_container").append('<div class="question-title"></div>');
                        $("#answer_container").html(data.answer_html);
                        $("#answer_container").append('<div class="answer-title">'+Lang.AnswerQusetion+'</div>');
                        window.selectedtype=data.type;
                        $("#incorrectfeedback").val(data.feedback_incorrect);
                        $("#correctfeedback").val(data.feedback_correct);
                        $("#correctpoints").val(data.point_correct);
                        $("#incorrectpoints").val(data.point_incorrect);

                        destroyed=true;
                        refreshElement();
                        $(".question-title").html(getQuestionName(window.selectedtype));
                    }else{
                        showMsg("error",data.msg);
                    }
                }
            });
        }
    });



});
function showMsg(err,msg){
   // alert(msg);
}
function savePage(goTO) {
    hideEditorElement();
    showEditorElement();

    if(!destroyed){
        $(".ui-droppable").droppable("destroy");
        $(".ui-resizable").resizable("destroy");
        $(".ui-draggable").draggable("destroy");
        $(".ui-resizable-handle").remove();
        destroyed=true;
    }


    $(".poplinable").attr("contenteditable", "false");
    $(".jq_multi_file").each(function () {
        $(this).attr("src", $(this).attr("publish"));
        $(this).attr("data_src", $(this).attr("publish"));
    });
    q = goTO;
    $(".question-title").remove();
    var question = $('#question_container').html();
    $("#question_container").append('<div class="question-title"></div>');
    $(".question-title").html(getQuestionName(window.selectedtype));
    var answer_html = $('#answer_container').html();
    var cfeedback = $("#correctfeedback").val();
    var ifeedback = $("#incorrectfeedback").val();
    var cpoints = $("#correctpoints").val();
    var ipoints = $("#incorrectpoints").val();
    var data;

    switch (window.selectedtype.toString()) {
        case "1"://true & false
            answer1 = $(".answer1").html();
            answer2 = $(".answer2").html();
            correct = $("#answer_container").find('input[type="radio"]:checked').closest("li").first();
            if (correct.hasClass("answer1")) {
                correct1 = 1;
                correct2 = 0;
            } else {
                correct1 = 0;
                correct2 = 1;
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
                //ahtml.find(".delete_answer").remove();
                ahtml.find(".action-hover").remove();
                if ($(this).find("input:radio").first().is(":checked")) {
                    c = "1";
                } else {
                    c = "0";
                }
                answers += 'manhal@answer@seperatorAmanhal@bair@seperator' + ahtml.html() + 'manhal@item@seperatorCmanhal@bair@seperator' + c;
                i++;
            });
            answer =answers.substr(23);
            // console.log("aa", answer);
            data = {
                'question': question,
                "answer": answer,
                "type": window.selectedtype,
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
                ahtml.find(".action-hover").remove();
                if ($(this).find("input:checkbox").first().is(":checked")) {
                    c = "1";
                } else {
                    c = "0";
                }
                answers += 'manhal@answer@seperatorAmanhal@bair@seperator' + ahtml.html() + 'manhal@item@seperatorCmanhal@bair@seperator' + c;
                i++;
            });
            answer = answers.substr(23);
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
        case "4"://fill in the blank
            answers ="";
            $(".ans").each(function () {
                answers +='manhal@answer@seperator' + $(this).find("span").first().html();
            });
            answer = answers.substr(23);
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
        case "5"://matching
            answers = '';
            var i=0;
            $(".ans_left").each(function () {
                answers += 'manhal@answer@seperator' + $(".ans_left").eq(i).html()+'manhal@column@seperator'+$(".ans_right").eq(i).html();
                i++;
            });

            answer = answers.substr(23);
            // console.log("ansers",answer);
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
        case "7"://click map
            answers = '';
            $(".circle-map").each(function () {
                answers += 'manhal@answer@seperator' + $(this).width()+'manhal@parameter@seperator'+$(this).height()+'manhal@parameter@seperator'+$(this).css("top")+'manhal@parameter@seperator'+$(this).css("left");
            });

            answer = answers.substr(23);
            data = {
                'question': question,
                "answer": answer,
                "type": 7,
                "image":$("#map_image").attr("src"),
                "image_width":$("#map_image").closest(".xdraggable").width(),
                "image_height":$("#map_image").closest(".xdraggable").height(),
                "image_left":$("#map_image").closest(".xdraggable").css("left"),
                "cfeedback": cfeedback,
                "ifeedback": ifeedback,
                "cpoints": cpoints,
                "ipoints": ipoints,
                "answer_html": answer_html
            };
            break;
        case "8"://short essay
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
        case "9"://sequence
            answers = '';
            i=1;
            $(".ans").each(function () {
                answers += 'manhal@answer@seperator' + $(this).find("span").first().html()+'manhal@parameter@seperator'+i;
                i++;
            });

            answer =answers.substr(23);
            data = {
                'question': question,
                "answer": answer,
                "type": 9,
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

            answer = answers.substr(23);
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
        url: window.SITE_URL+"platform/ajax/editor.php?process=savequestion&quizid=" + window.quizid + "&questionid=" + window.questionid,
        data: data,
        dataType: "html",
        success: function (data) {
            // console.log("finish",data);
            $(".jq_multi_file").each(function () {
                $(this).attr("src", $(this).attr("editor"));
                $(this).attr("data_src", $(this).attr("editor"));
            });
            ///$("#question_container").attr("style",containerstyle);
            $(".poplinable").attr("contenteditable", "true");
            refreshElement();
            hideLoader();
            if (q == -2) {//newPage
                window.location.href = "quiz_editor.php?type=new&quizid=" + window.quizid;
            } else if (q != -1) {
                window.location.href = "quiz_editor.php?quizid=" + window.quizid + "&questionid=" + q;
            }
        }
    });
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
function refreshElement() {


    // $('.questions-main-container .content-container').ruler({
    //     vRuleSize: 18,
    //     hRuleSize: 18,
    //     showCrosshair : true,
    //     showMousePos: false
    // });
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
        $(".ui-droppable").droppable("destroy");
        $(".ui-resizable").resizable("destroy");
        $(".ui-draggable").draggable("destroy");
        // $('.selector').ruler('refresh');
        $(".ui-resizable-handle").remove();
        destroyed=true;
    }
    $("#answer_contents .ui-sortable").sortable({
        axis: 'y'
    });


    destroyed=false;
    $(".draggable-w").draggable({
            revert: true, revertDuration: 0,
            start: function (event, ui) {
                $(".editor-main-menu-container .nav-content .content .row").css("z-index","0");
                $(this).css("z-index","9");
                event.stopPropagation()
            }
        }
    );

    $("#sequance").sortable({
        axis: 'y',
        handle:".handle"
    });

    $(".resizable").resizable({
        stop: function () {
            //console.log($(this).width());
            // $(this).outerWidth($(this).outerWidth()/($("#question_contents").outerWidth())*100 +"%");
            // $(this).outerHeight($(this).outerHeight()/($("#question_contents").outerHeight())*100+"%");
            console.log($(this).outerWidth(),$(this).outerHeight(),$(this).closest("div").outerHeight(),$(this).closest("div").outerWidth());
            console.log($(this).closest("div").closest("div").attr("class"),($(this).closest("div").closest("div").attr("id")));

            $(this).outerWidth($(this).outerWidth()/($(this).parent().outerWidth())*100 +"%");
            $(this).outerHeight($(this).outerHeight()/($(this).parent().outerHeight())*100+"%");

            if($(this).offset().top-$(this).parent().offset().top+$(this).outerHeight()>$(this).parent().outerHeight()){
                $(this).outerHeight((($(this).parent().outerHeight()-($(this).offset().top-$(this).parent().offset().top))/$(this).parent().outerHeight()) *100+"%");
            }
            if($(this).offset().left-$(this).parent().offset().left+$(this).outerWidth()>$(this).parent().outerWidth()){
                $(this).outerWidth((($(this).parent().outerWidth()-($(this).offset().left-$(this).parent().offset().left))/$(this).parent().outerWidth()) *100+"%");
            }
        }
    });
    $(".vresizable").resizable({
        handles: 's',
        stop: function () {
            //console.log($(this).width());
            // $(this).width($(this).width()/$("#question_contents").width()*100 +"%");
            // $(this).height($(this).height()/$("#question_contents").height()*100+"%");
        }
    });
    $(".draggable").draggable({
        handle: ".move_handler",
        stop: function () {
            var stageWidth=parseFloat($(this).closest(".droppable").css("width"));
            var stageheight=parseFloat($(this).closest(".droppable").css("height"));
            var widgetWidth=100 * parseFloat($(this).width())/stageWidth;
            var widgetheight=100 * parseFloat($(this).height())/stageheight;
            var widgetLeft = 100 * parseFloat($(this).css("left")) / stageWidth;
            var widgetTop = 100 * parseFloat($(this).css("top")) /stageheight;


            if(widgetLeft<0){
                widgetLeft=0;
            }

            if(widgetLeft+widgetWidth>100){
                var l = (100-widgetWidth)  + "%";
            }else{
                var l = widgetLeft + "%";
            }


            if(widgetTop<0){
                widgetTop=0;
            }
            if(widgetTop+widgetheight>100){
                var t = (98-widgetheight) + "%";
            }else{
                var t = widgetTop  + "%";
            }
            $(this).css("left", l);
            $(this).css("top", t);
            //refreshElement();
        }
    });
    $(".xdraggable").draggable({
        axis: 'x',
        handle: ".move_handler",
        stop: function () {
            var l = ( 100 * parseFloat($(this).css("left")) / parseFloat($(this).closest(".droppable").css("width")) ) + "%";
            $(this).css("left", l);
            // alert($(this).attr("class"));
            //refreshElement();
        }
    });
    $(".cdraggable").draggable({
        handle: ".move_handler",
        stop: function () {
            console.log($(this).outerWidth(),$(this).outerHeight(),$(this).closest("div").outerHeight(),$(this).closest("div").outerWidth());
            console.log($(this).closest("div").closest("div").attr("class"),($(this).closest("div").closest("div").attr("id")));

            var l = ( 100 * parseFloat($(this).css("left")) / parseFloat($(this).parent().css("width")) ) + "%";
            var t = ( 100 * parseFloat($(this).css("top")) / parseFloat($(this).parent().css("height")) ) + "%";
            $(this).css("left", l);
            $(this).css("top", t);
            //refreshElement();
        }
    });
    document.execCommand('defaultParagraphSeparator', false, 'p');
    $(".poplinable").popline({position: "fixed"});
    $("input[name='position']").click(function () {
        $(".editor").popline("setPosition", this.id);
    });

    //$(".droppable").droppable({
    $("#question_contents.droppable,.matching .droppable").droppable({
        drop: function (event, ui) {
            $(".ui-droppable").droppable("destroy");
            $(".ui-resizable").resizable("destroy");
            $(".ui-draggable").draggable("destroy");
            $(".ui-resizable-handle").remove();
            ui.position.left = Math.min( 0, ui.position.left );
            ui.position.right = Math.min( 0, ui.position.right );
            ui.position.top = Math.min( 0, ui.position.top );
            ui.position.bottom = Math.min( 100, ui.position.bottom );
            destroyed=true;
            var itemTypeID = ui.draggable.attr("id");
            newID="widget_" + randomString(7);
            var offset=ui.draggable.offset();
            var left=(event.pageX-offset.left)/ui.draggable.width();
            var top=(event.pageY-offset.top)/ui.draggable.height();
            switch (itemTypeID) {
                case 'text':
                    $(this).append('<div id="'+newID+'" class="resizable draggable element" style="width: 235px; height: 109px; position: absolute; top: '+top+'%; left: '+left+'%; right: auto; bottom: auto;"><div class="noclose delete_widget floating-right flaticon-x"></div><div class="noclose move_handler flaticon-more9"></div><div class="noclose edit_sound " widget_type="text"></div><div class="real-content"><span class="poplinable" contenteditable="true">' + window.Lang.Text + '</span></div></div>');
                    document.execCommand('defaultParagraphSeparator', false, 'p');
                    $(".poplinable").popline({position: "fixed"});
                    break;
                case 'video':
                    $(this).append('<div id="' + newID + '" class="resizable draggable element" style="width:235px;height: 109px;position: absolute;top: '+top+'%; left: '+left+'%;"><div class="noclose move_handler flaticon-more9"></div><div class="noclose delete_widget floating-right flaticon-x"></div><div class="noclose edit_widget flaticon-pencil43" widget_type="video"></div><div class="noclose edit_sound" widget_type="video"></div><div class="real-content remove-margin"><iframe width="100%" height="100%" src="https://www.youtube.com/embed/sxUQsKxcOYM" frameborder="0" allowfullscreen=""></iframe></div></div>');
                    break;
                case 'sound':
                    $(this).append('<div id="' + newID + '" class="resizable draggable element" style="width:303px;height:54px;position: absolute;top: '+top+'%; left: '+left+'%;"><div class="noclose move_handler flaticon-more9"></div><div class="noclose delete_widget floating-right flaticon-x"></div><div class="noclose edit_widget flaticon-pencil43" widget_type="audio"></div><div class="real-content"><audio controls=""><source src="sound.mp3" type="audio/mp3"></audio></div><div>');
                    break;
                case 'image':
                    $(this).append('<div id="' + newID + '" class="resizable draggable element image" style="width:200px;height:100px;position: absolute;top: '+top+'%; left: '+left+'%;"><div class="noclose  move_handler flaticon-more9"></div><div class="noclose delete_widget floating-right flaticon-x"></div><div class="noclose edit_widget flaticon-pencil43" widget_type="image"></div><div class="noclose edit_sound" widget_type="image"></div><div class="real-content remove-margin"><img src="https://www.manhal.com/quizeditor/thems/En/images/1.jpg" style="width:100%;height: 100%"></div><div></div>');
                    break;
            }
            setTimeout(function () {
               // destroyed=false;
                refreshElement();
            },50);
        }
    });

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