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

    window.defaultItem=JSON.stringify({
        question:'أُحلِّلُ الْكَلِماتِ إِلى مَقاطِعَ:',
        word:'الْمَدْرَسَةُ',
        drag:[{img:"الْ",type:"1"},{img:"مَدْ",type:"2"},{img:"رَ",type:"3"},{img:"سَـ",type:"4"},{img:"ـةُ",type:"5"}],
        dropStyle:[
            {w:"90.557%",h:"44.98%",wordW:"16.455%",wordH:"67.97%",arrow:"9.27%",arrowH:"28.16%",arrowR:"20.51%",dropW:"65.354%",
                dropH:"100%",dropItemW:"17.376%",dropItemH:"100%",dropItemL:"3%"}],
        wrongItem:["دْ","درَ","ا","لمَـ","سَةُ","رَسَ"]
    });
    $(window).load(function () {
        setTimeout(function () {
                $(".jq_editable").attr("contenteditable",'true');
        },1000);

        $(".jq_addsquare").click(function () {
            var i=$(".drop-item-container .drop-item").length+1
            $(".drop-item-container").append('<div data="'+i+'" class="drop-item" style="width: 17.376%;margin-right: 3%"><a class="jq_removesquare" title="Delete"></a><span class="jq_editable" data="'+i+'" contenteditable="true"></span></div>');
          // $(".drag-item .jq_editable").eq($(".drop-item-container .drop-item").length).attr("")
        });

        $(document).on("click",".jq_removesquare",function () {
            $(this).closest(".drop-item").remove();
        });


        $(document).on("click",".jq_addquestion",function () {
            console.log("start");
            window.parent.showloader();
            saveCurrentQuestion();
            setTimeout(function () {
                var jqclass='item-'+($(".question-item").length+1).toString();
                $('<span class="question-item jq_selected '+jqclass+'"><a class="jq_removequestion"></a></span>').insertBefore(".jq_addquestion");
                $(".question-item").removeClass('selected');
                $(".question-item.jq_selected").attr('data',window.defaultItem);
                $(".question-item.jq_selected").removeClass("jq_selected").click();
                window.parent.hideloader();
            },250);
        });

        $(document).on("click",".jq_removequestion",function () {
           $(this).closest(".question-item").remove();
        });

        $(document).on("click",".question-item",function () {
            if(!$(this).hasClass('selected')){
                saveCurrentQuestion();
                a=$(this);
                setTimeout(function () {
                    loadQuestion(a);
                    $(".question-item").removeClass('selected');
                    a.addClass('selected');
                },150);
            }
        });
    });

    function loadQuestion(e){
        var data=$.parseJSON(e.attr('data'));
        $(".jq_title").html(data['question']);
        $(".word .jq_editable").html(data['word']);

        $(".drop-item-container").html('');
        for(i=0;i<data['drag'].length;i++){
            $(".drop-item-container").append('<div data="'+data['drag'][i]['type']+'" class="drop-item" style="width: 17.376%;margin-right: 3%"><a class="jq_removesquare" title="Delete"></a><span class="jq_editable" data="'+data['drag'][i]['type']+'" contenteditable="true">'+data['drag'][i]['img']+'</span></div>');
        }
        setTimeout(function () {
            for(x=0;x<data['wrongItem'].length;x++){
                $(".drag-item").eq(x).find('.jq_editable').html(data['wrongItem'][x]);
            }
        },100);
    }

    function saveCurrentQuestion(){
        var data={};
        var itemList=[];
        var drags=[];
        var wrongs=[];

        var i=0;
        $(".drop-item").each(function () {
            drags[i]={img:$(this).find(".jq_editable").html(),type:(i+1).toString()};
            i++;
        });

        var x=0;
        $(".drag-item").each(function () {
            if(parseInt($(this).find(".jq_editable").attr("data"))<1){
                wrongs[x]=$(this).find(".jq_editable").html();
                x++;
            }


        });
        setTimeout(function () {
            var  item={
                question:$(".jq_title").html(),
                word:$(".word .jq_editable").html(),
                drag:drags,
                dropStyle:[
                    {w:"90.557%",h:"44.98%",wordW:"16.455%",wordH:"67.97%",arrow:"9.27%",arrowH:"28.16%",arrowR:"20.51%",dropW:"65.354%",
                        dropH:"100%",dropItemW:"17.376%",dropItemH:"100%",dropItemL:"3%"}
                ],
                wrongItem:wrongs
            }
            $(".question-item.selected").attr('data',JSON.stringify(item));
        },100);
    }
    function saveGame() {
        var itemList=[];
        saveCurrentQuestion();
            setTimeout(function () {
               var i=0;
                $(".question-item").each(function () {
                    itemList[i]=$.parseJSON($(this).attr('data'));
                    i++;
                });
            },300);
            setTimeout(function () {
                window.parent.saveGameData(itemList);
            },500)
    }

    <?php
    if(isset($_SESSION["gameData"][$_GET["id"]]) && $_SESSION["gameData"][$_GET["id"]]!=''){
    ?>
    var itemList=$.parseJSON('<?=str_replace('\"','\\\\"',$_SESSION["gameData"][$_GET["id"]]);?>');
    console.log('gameData',itemList);


    <?php
    }else{
    ?>
    var itemList=[
        {
            question:'أُحلِّلُ الْكَلِماتِ إِلى مَقاطِعَ:',
            word:'الْمَدْرَسَةُ',
            drag:[{img:"الْ",type:"1"},{img:"مَدْ",type:"2"},{img:"رَ",type:"3"},{img:"سَـ",type:"4"},{img:"ـةُ",type:"5"}],
            dropStyle:[
                {w:"90.557%",h:"44.98%",wordW:"16.455%",wordH:"67.97%",arrow:"9.27%",arrowH:"28.16%",arrowR:"20.51%",dropW:"65.354%",
                    dropH:"100%",dropItemW:"17.376%",dropItemH:"100%",dropItemL:"3%"}],
            wrongItem:["دْ","درَ","ا","لمَـ","سَةُ","رَسَ"]
        }
    ]

    var jqclass='item-1';
    $('<span class="question-item jq_selected '+jqclass+'" data="'+JSON.stringify(itemList[0])+'"></span>').insertBefore(".jq_addquestion");
    <?php
    }
    ?>

    $(window).load(function () {
        for(i=0;i<itemList.length;i++){
            var jqclass='item-'+(i+1).toString();
            $('<span class="question-item jq_selected '+jqclass+'"><a class="jq_removequestion"></a></span>').insertBefore(".jq_addquestion");
            $(".question-item.jq_selected").attr("data",JSON.stringify(itemList[i])).removeClass('jq_selected');
        }
        setTimeout(function () {
            $(".question-item").removeClass("selected");
            $(".question-item").first().click();
        },550);

    });



</script>
<body onunload="disconnetLMS();">
<div id="main-container" class="main-container">
    <div id="inner-container" class="inner-container">
        <i class="title-icon"></i>
        <div class="title"><i></i>
            <div class="title-text">
                <span class="jq_editable jq_title">أُحلِّلُ الْكَلِماتِ إِلى مَقاطِعَ:</span>
            </div>
        </div>
        <div class="drop-main-container">
            <div class="drop-inner-container">
                <a class="jq_addsquare" title="Add"></a>
                <div class="word-container">
                    <div class="word"><span class="jq_editable"></span></div>
                    <div class="arrow"></div>
                    <div class="drop-item-container"></div>
                </div>
            </div>
        </div>
        <div class="drag-container"></div>
        <div class="img-1"></div>
        <div class="img-2"></div>
        <div class="img-3"></div>
        <div class="img-4"></div>
        <div class="image-object"></div>
        <div class="true-false-container">
            <a class="jq_addquestion" title="Add Question"></a>
        </div>
        <!--<a class="sound-all-btn"></a>-->
        <!--<a class="poweredBy" href="https://www.manhal.com/"></a>-->
        <div class="help-main-popup">
            <a class="close"></a>
            <div class="inner-help-popup">
                <iframe></iframe>
            </div>
        </div>
        <div class="main-message-container">
            <div class="inner-message-container">
                <span id="message-icone" class=""></span>
                <span id="feedback" class=""></span>
                <span class="result-text"></span>
                <div class="result-container">
                    <span></span>
                </div>
                <a class="reload"></a>
                <a class="home"></a>
            </div>
        </div>
        <div class="main-message-container_nextMessage">
            <div class="inner-message-container">
                <span id="feedback1" class="wellDonw"></span>
                <a class="next-scene" onclick="nextSceneClick(this)"></a>
            </div>
        </div>
    </div>
</div>

</body>
<script src="js/data.js"></script>
<script src="js/js.js"></script>
<script type="text/javascript" src="js/TouchPunch.js"></script>
</html>
