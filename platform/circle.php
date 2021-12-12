<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh .
 * User: Hussam Abu Khadijeh
 * Date: 2/10/2016
 * Time: 10:26 AM
 */

include_once "includes/language.php";

?>
<div class="line-row">
    <label class="lbl-data-a floating-left""><?=$Lang->Title;?></label>
    <input type="text" id="circle_title" class="floating-left txt-b" placeholder="<?=$Lang->Title;?>">
</div>
<form id="circle_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
    <div class="circle-container-1" id="circle_maincontainer">
        <div class="circle-content clear-both" id="circlecontainer">
<!--            <div class="right-container">-->
<!--                <div class="background" style="background:url(img/Garaafe.png) no-repeat;">-->
<!--                    <a><i class="flaticon-delete96 jq_deletecircle floating-right"></i></a>-->
<!--                    <a class="fu-container-b-container"><div class="fu-container-b floating-left">-->
<!--                        <label class="floating-left flaticon-cloud148 label-a"></label>-->
<!--                        <label class="floating-left label-b" id="lblimage"></label>-->
<!--                        <input type="file" class="word_file" onchange="readURLWord(this);">-->
<!--                    </div></a>-->
<!--                </div>-->
<!--                <div class="word word-a" data-text="Text">-->
<!--                    <label><span class="jq_char" id="word1_0" char-index="0">T</span><span class="jq_char" id="word1_1" char-index="1">e</span><span class="jq_char" id="word1_2" char-index="2">x</span><span class="jq_char" id="word1_3" char-index="3">t</span></label>-->
<!--                    <a class="edit-circle"><i class="flaticon-pencil43"></i></a>-->
<!--                </div>-->
<!--                <div class="word-input word-b" data-text="Text">-->
<!--                    <a class="floating-left save-circle-word" ><i class="flaticon-save31"></i></a>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>

    <div class="line-row">
        <input type="button" value="Update" id="update_circle" widget_id="<?=$_GET['id'];?>" class="btn-default floating-right">
        <div class="btn-addCircle floating-right" id="addcircle"><?=$Lang->Add;?></div>
    </div>
</form>
<script>
    $(document).ready(function(){
        doaction=$("#<?=$_GET['id'];?>").find(".doaction").first();
        words=doaction.attr("data-word").split(",");
        for(i=0;i<words.length;i++){
         if(words[i]!=""){
             r=i+1;
             html='<div class="right-container">';
             html+='<div class="background" style="background:url(books/'+window.bookid+"/"+doaction.attr("data-thumb"+r)+') no-repeat;">';
             html+='<a><i class="flaticon-delete96 jq_deletecircle floating-right"></i></a>';
             html+='<div class="fu-container-b-container"><div class="fu-container-b floating-left">';
             html+='<label class="floating-left flaticon-cloud148 label-a"></label>';
             html+='<label class="floating-left label-b" id="lblimage"></label>';
             html+='<input type="file" class="word_file" onchange="readURLWord(this);">';
             html+='</div></div></div>';
             html+='<div class="word word-a" data-text="'+words[i]+'">';
             html+='<label>'+spillWord(words[i])+'</label>';
             html+='<a class="edit-circle"><i class="flaticon-pencil43"></i></a>';
             html+='</div>';
             html+='<div class="word-input word-b" data-text="'+words[i]+'">';
             html+='<a class="floating-left save-circle-word"><i class="flaticon-save31"></i></a>';
             html+='</div></div>';
             $("#circlecontainer").append(html);
             console.log("doThis",words[i]);
         }
        }
        $("#circle_title").val(doaction.attr("title"));
        $("#circle_maincontainer").attr("class","").addClass("circle-container-"+$("#circlecontainer .right-container").length);
    });
</script>


