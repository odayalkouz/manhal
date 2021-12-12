<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh .
 * User: Hussam Abu Khadijeh
 * Date: 2/10/2016
 * Time: 10:26 AM
 */
?>
<script type="text/javascript" src="../js/jscolor.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $("#isPopup").click(function(){
           if($(this).prop("checked")==true){
               $(".hide-content").slideDown();
           } else{
               $(".hide-content").slideUp();


           }
        });
        colors=$("#<?=$_GET['id'];?>").find(".doaction").attr("colors").split(",");
        console.log("a",colors);
        colors.forEach(function(color){
            id="color_"+randomString(4);
            $("#color_container").append('<div class="section-check-a floating-left"> <ul> <li class="floating-left"><label class="input-control checkbox floating-left"> <input class="jq_trace_color" color="'+color+'" type="checkbox" id="'+id+'" value="1" checked> <span class="check" style="background-color:'+color+';"></span> </label> <label for="'+id+'" class="trace-color text floating-left"></label> </li> </ul> </div>');
        });
        $("#addcolor").click(function(){
            id="color_"+randomString(4);
            color="#"+$(".jscolor").val();
            var numItems = $('.trace-color').length;
            if(numItems < 7)
            {
                $("#color_container").append('<div class="section-check-a floating-left"> <ul> <li class="floating-left"><label class="input-control checkbox floating-left"> <input class="jq_trace_color" color="'+color+'" type="checkbox" id="'+id+'" value="1" checked> <span class="check" style="background-color:'+color+';"></span> </label> <label for="'+id+'" class="trace-color text floating-left"></label> </li> </ul> </div>');
            }
            else
            {

            }
        });
        $("#update_trace_color").click(function(){
            colors="";
            $(".jq_trace_color:checked").each(function(){
                colors+=","+$(this).attr("color");
            });
            colors=colors.substring(1);
            $("#<?=$_GET['id'];?>").find(".doaction").attr("colors",colors);
            //$("#popup_action").fadeOut();
        });
    });
</script>
<form id="trace_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">


<div class="line-row-b">
    <label class="lbl-data-a floating-left"  for="isPopup">Popup</label>
    <div class="section-check">
        <ul>
            <li class="floating-left">
                <label class="input-control checkbox floating-left">
                    <input type="checkbox" checked name="isPopup" id="isPopup" value="1">
                    <span class="check"></span>
                </label>
                <label for="isPopup" class="text floating-left"></label>
            </li>
        </ul>
    </div>
</div>
<div class="hide-content">
    <div class="line-row-b clear-both">
        <label class="lbl-data-a floating-left">Title</label>
        <input id="trace_title" name="trace_title" class="floating-left txt-a" placeholder="Thump">
    </div>
    <div class="line-row-b clear-both">
        <label class="lbl-data-a floating-left">Word</label>
        <input id="trace_word" name="trace_word" class="floating-left txt-a" placeholder="Word">
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left">Upload Thump</label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="label-b floating-left" id="lbltracethump"></label>
            <input id="tracethump" type="file" name="tracethump">
        </div>
    </div>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left">Upload picture</label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="label-b floating-left" id="lbltracepicture"></label>
            <input  id="tracepicture" type="file" name="tracepicture">
        </div>
    </div>
</div>
<div class="line-row-b">
    <label class="lbl-data-a floating-left">colors</label>
    <div id="color_container"></div>
</div>
<div class="line-row-b clear-both">
    <label class="lbl-data-a floating-left">add color</label>
    <input class="jscolor floating-left txt-a" id="temp_color">
    <a id="addcolor" class="flaticon-add64 floating-left addcolor" value=""></a>
</div>
<input type="button" value="Update" id="update_trace_color" class="btn-default floating-right">
    <input name="widget_id" type="hidden" value="<?=$_GET['id'];?>">
    <input name="tracepicture_id" type="hidden" value="<?="trace_".uniqid();?>">
    <input name="tracethump_id" type="hidden" value="<?="tracethumb_".uniqid();?>">
</form>

