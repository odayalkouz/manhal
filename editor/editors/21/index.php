<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arabic letter forms</title>
    <link data-type="favicon" href="https://www.manhal.com/themes/main-Light-green-En/images/favicon.ico?99" type="image/x-icon" rel="icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/manhalloader.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://www.manhal.com/js/scorm.js"></script>
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/manhalLoader.js"></script>
</head>

<script>
    window.addEventListener("touchmove", function(event) {event.preventDefault();}, {passive: false} );
    data= {
        itemList: [
            {
                image: 'It is better to advise your brother late than to leave him in error.',
                drag: [{word: "advise", type: "1.1"}],
                id: 'id123'
            }
        ]
        ,
        wrongWordsList: [],
        titleText: 'fill in the blank with the appropriate word'
    };

    window.defaultItem=JSON.stringify(data);

    $(window).load(function () {
        setTimeout(function () {
            $(".jq_editable").attr("contenteditable",'true');
            $(".item-container .jq_itemc").attr("contenteditable",'false');
            $(".item-container .jq_itemc").css("cursor",'crosshair');
            // $(this).closest(".item-container").find(".jq_itemc").css("cursor",'crosshair');
        },1000);

        $(document).on("click",".jq_editi",function () {
            $(this).hide();
            $(this).closest(".item-container").find(".jq_savei").show();
            var iclass='jq_itemc_'+$(this).closest(".item-container").attr('temp-id');
             $('.'+iclass).remove();
            $(this).closest(".item-container").find(".all-sentence").css("display","table-cell");
            $(this).closest(".item-container").find(".inner-item-text").css("display","none").find(".drop-item").remove();
            // $(this).closest(".item-container").find(".drop-item").remove();
            $(this).closest(".item-container").find(".jq_itemc").attr("contenteditable",'true');
            $(this).closest(".item-container").find(".jq_itemc").focus();
            $(this).closest(".item-container").find(".jq_itemc").css("cursor",'text');
        });

        $(document).on("click",".jq_savei",function () {
            $(this).hide();
            $(this).closest(".item-container").find(".jq_editi").show();
            var newSentence=$(this).closest(".item-container").find(".jq_itemc").text();
            $(this).closest(".item-container").find(".jq_itemc").attr("contenteditable",'false');
            $(this).closest(".item-container").find(".jq_itemc").css("cursor",'crosshair');
            // canvasBox($(this).closest(".item-container"));
            console.log("newSentence<<<>>>"+newSentence)
            var newSentenceSplit=newSentence.split(" ");
            console.log("newSentenceSplit<<<>>>>"+newSentenceSplit);
            var newWord='';
            for(var i=0;i<newSentenceSplit.length;i++){
                newWord+='<div class="drop-item drag-'+(i+1)+'"><div class="line-doted"></div><span>'+newSentenceSplit[i]+'</span></div>'
            }
            $(this).closest(".item-container").find(".inner-item-text").html(newWord);
            $(this).closest(".item-container").find(".all-sentence").css("display","none");
            $(this).closest(".item-container").find(".inner-item-text").css("display","table-cell");
        });
        $(document).on("click",".drop-item" ,function () {
            var wordLength=$(this).parent().length;
            var count=0;
            if($(this).hasClass("selected")){
                var iclass='jq_itemc_'+$(this).closest('.item-container').attr('temp-id');
                $('.'+iclass).remove();
                $(this).removeClass("selected");
                }else {
                var iclass='jq_itemc_'+$(this).closest('.item-container').attr('temp-id');
                $(this).addClass("selected");
                console.log("this<<<>>>"+$(this).find("span").html)
                $(".drag-container").append('<div class="drag-item '+iclass+'" style="margin: 0 1.7% 13.9% 0; width: 46.8%; height: 10%; float: none;"><div class="drag-item-inner"><span data="0" class="ui-draggable ui-draggable-handle" style="position: relative;">'+$(this).find("span").html()+'</span><div class="trueanswer" title="true answer"></div></div></div>');
            }
        });

        $(document).on("click",".jq_addanswer",function () {
            $(".drag-container").append('<div class="drag-item" data="" style="margin: 0 1.7% 13.9% 0; width: 46.8%; height: 10%; float: none;"><div class="drag-item-inner"><a class="jq_deleteanswer"><a/><span data="0" class="ui-draggable ui-draggable-handle jq_editable" contenteditable="true">اجابة</span></div></div>');
        });

        $(document).on("click",".jq_deleteanswer",function () {
            $(this).closest('.drag-item').remove();
        });

        $(document).on("click",".jq_deletei",function () {
            var iclass='jq_itemc_'+$(this).closest(".item-container").attr('temp-id');
            $('.'+iclass).remove();
            $(this).closest('.item-container').remove();
            reNumber();
        });

        $(document).on("click",".jq_addquestion",function () {
            var count=($('.item-container').length+1).toString();
            var temp_id='item_'+randomString(10);
            var sentence='one has to preserve his environment.';
            var sentenceSplit=sentence.split(" ");
            var htmlAdd1='';
            var htmlAdd2='';
            // $(".drop-main-container").append('<div class="item-container" temp-id="'+temp_id+'"><div class="inner-item-container"><a class="jq_editi"></a><a class="jq_savei"></a><a class="jq_deletei"></a><div class="item-text"><span class="jq_itemc">عَلَى الْمَرْءِ أَنْ يُحافِظَ عَلى بيئَتهِ.</span></div> </div><div class="number-container"><span>'+count+'</span></div> <div class="drop-item ui-droppable" data="1.1" style="width: 9.6%;height: 46%;top: 31%;left: 61.2%"><span></span></div></div>');
            htmlAdd1='<div class="item-container item-'+count+'" temp-id="'+temp_id+'"><div class="number-container"><span>'+count+'</span></div><div class="inner-item-container"><a class="jq_editi"></a><a class="jq_savei"></a><a class="jq_deletei"></a><div class="item-text"><div class="all-sentence"><span class="jq_itemc">'+sentence+'</span></div> <div class="inner-item-text"></div></div></div></div>';
            for(var i=0;i<sentenceSplit.length;i++){
                // if(i==1){
                //     htmlAdd2+='<div class="drop-item drag-'+(i+1)+' selected" type="1.1"><div class="line-doted"></div><span>'+sentenceSplit[i]+'</span></div>'
                // }else {
                //     htmlAdd2+='<div class="drop-item drag-'+(i+1)+'"><div class="line-doted"></div><span>'+sentenceSplit[i]+'</span></div>'
                // }
                htmlAdd2+='<div class="drop-item drag-'+(i+1)+'"><div class="line-doted"></div><span>'+sentenceSplit[i]+'</span></div>'
            }
            $(".drop-main-container").append(htmlAdd1);
            $(".item-"+count).find(".inner-item-text").html(htmlAdd2);
        });

        $(document).on("click",".jq_removequestion",function () {
            $(this).closest(".question-item").remove();
        });
    });

    function randomString(len){
        charSet ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var randomString = '';
        for (var i = 0; i < len; i++) {
            var randomPoz = Math.floor(Math.random() * charSet.length);
            randomString += charSet.substring(randomPoz,randomPoz+1);
        }
        return randomString;
    }

    function reNumber() {
        $(".number-container").each(function () {
            $(this).find('span').html($(this).closest('.item-container').index()+1);
        });
    }

    function saveGame() {
        var itemList=[];
        var drags=[];
        var wrongs=[];
        var i=0;
        var x=0;
        var temploc='';
        $(".item-container").each(function () {
            var iclass='jq_itemc_'+$(this).attr('temp-id');
            drags=[];
            x=0;
            $(".drag-item."+iclass).each(function () {
                console.log("drag Item<<<>>>"+$(this).find("span").html());
                temploc=(i+1).toString()+'.'+(x+1).toString();
                drags[x]={word:$(this).find("span").html(),type:temploc};
                x++;
            });
            itemList[i]={image:$(this).find(".jq_itemc").html(),drag:drags,id:$(this).attr('temp-id')};
            console.log('saving', itemList[i]);
            i++;
        });

        i=0;
        $('.jq_deleteanswer').each(function () {
            wrongs[i]={word:$(this).closest('.drag-item').find(".jq_editable").html(),type:0};
            i++;
        });

        var data={};
        data['itemList']=itemList;
        data['wrongs']=wrongs;
        data['mainTitle']=$(".main_title").html();
        setTimeout(function () {
            window.parent.saveGameData(data);
        },500)
    }

    <?php
    if(isset($_SESSION["gameData"][$_GET["id"]]) && $_SESSION["gameData"][$_GET["id"]]!=''){
    ?>
    var data=$.parseJSON('<?=str_replace('\"','\\\\"',$_SESSION["gameData"][$_GET["id"]]);?>');
    var itemList=data['itemList'];
    var wrongWordsList=data['wrongs'];
    var titleText=data['mainTitle'];
    console.log('gameData',data);
    <?php
    }else{
    ?>
    var itemList=[
        {
            image: 'It is better to advise your brother late than to leave him in error.',
            drag: [{word: "advise", type: "1.1"}],
            id: 'id123'
        }
    ]
    var wrongWordsList=[];
    var titleText='fill in the blank with the appropriate word';
    console.log('default data',itemList);
    <?php
    }
    ?>
</script>
<body onunload="disconnetLMS();">
<div class="main-bg-container">
    <div id="main-container" class="main-container">
        <div id="inner-container" class="inner-container">
            <div class="header">
                <div class="inner-header-container"></div>
                <div class="header-img"></div>
                <i class="title-icon"></i>
                <div class="title"><span class="jq_editable main_title"></span></div>
            </div>
            <a class="jq_addanswer" title="Add Answer"></a>
            <div class="game-container">
                <div class="drop-main-container"></div>
                <div class="drag-container"></div>
            </div>
            <a class="jq_addquestion" title="Add Qusetion"></a>
            <a class="poweredBy"></a>
            <div class="main-message-container">
                <div class="inner-message-container">
                    <span id="message-icone" class=""></span>
                    <span id="feedback" class=""></span>
                    <span class="result-text"></span>
                    <div class="result-container">
                        <span></span>
                    </div>
                    <a class="reload"></a>
                </div>
            </div>
            <div class="footer"></div>
        </div>
    </div>
</div>

</body>
<script src="js/data.js"></script>
<script src="js/js.js"></script>
<script type="text/javascript" src="js/TouchPunch.js"></script>
</html>
