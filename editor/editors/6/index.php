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
    <script src="js/data.js"></script>
    <script src="js/js.js"></script>
    <script type="text/javascript" src="js/TouchPunch.js"></script>
</head>

<script>
    window.addEventListener("touchmove", function(event) {event.preventDefault();}, {passive: false} );

    window.defaultItem=JSON.stringify({
        mainTitle:'أَخْتارُ الإِجابَةَ الصَّحيحَةَ فيما يَأْتي:',
        image:'(اليَومِ الْمَوعودِ) يَعْني يَومُ:',
        correct:[{word:"القيامَةِ",type:"1"}],
        incorrect:[{word:"الْعيدِ",type:"0"},{word:"الرُّجوعِ",type:"0"}],
        title:"السؤال الثالث"
    });

    $(window).load(function () {
        setTimeout(function () {
            $(".jq_editable").attr("contenteditable",'true');
        },1000);



        $(document).on("click",".jq_addanswer",function () {
            $(".drag-container").append('<div class="drag-item" ><a class="jq_deleteanswer"></a><span data="0" class="jq_editable" contenteditable="true">اجابة</span></div>');
        });
        $(document).on("click",".jq_deleteanswer",function () {
            $(this).closest('.drag-item').remove();
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
                    $(".jq_editable").attr("contenteditable",'true');
                },150);
            }
        });
    });

    function loadQuestion(e){
        var data=$.parseJSON(e.attr('data'));
        console.log('data',data);
        window.AllData=data;
        $("#jq_title").html(data['mainTitle']);
        $(".question-text .jq_editable").html(data['title']);
        $(".text-question .jq_editable").html(data['image']);

        $(".drag-container").html('');
        $(".drag-container").append('<div class="drag-item jq_true" ><div class="trueanswer"></div><span data="1" class="jq_editable">'+data['correct'][0]['word']+'</span></div>');
        for(i=0;i<data['incorrect'].length;i++){
            $(".drag-container").append('<div class="drag-item" ><a class="jq_deleteanswer"></a><span data="0" class="jq_editable">'+data['incorrect'][i]['word']+'</span></div>');
        }
    }

    function saveCurrentQuestion(){
        var data={};
        var itemList=[];
        var drags=[];
        var wrongs=[];

        var i=0;
        $(".drag-item").each(function () {
            if($(this).hasClass('jq_true')){
                drags[0]={word:$(this).find(".jq_editable").html(),type:1};
            }else{
                wrongs[i]={word:$(this).find(".jq_editable").html(),type:0};
                i++;
            }
        });

        setTimeout(function () {
            var  item={
                mainTitle:$("#jq_title").html(),
                image:$(".text-question .jq_editable").html(),
                correct:drags,
                incorrect:wrongs,
                title:$(".question-text .jq_editable").html()
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
            mainTitle:'أَخْتارُ الإِجابَةَ الصَّحيحَةَ فيما يَأْتي:',
            image:'(اليَومِ الْمَوعودِ) يَعْني يَومُ:',
            correct:[{word:"القيامَةِ",type:"1"}],
            incorrect:[{word:"الْعيدِ",type:"0"},{word:"الرُّجوعِ",type:"0"}],
            title:"السؤال الثالث"
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
<div class="main-bg-container">
    <div id="main-container" class="main-container">
        <div id="inner-container" class="inner-container">
            <div class="header">
                <i class="title-icon"></i>
                <div class="title">
                    <i></i>
                    <div class="title-text">
                        <span id="jq_title" class="jq_editable"></span>
                    </div>
                </div></div>

            <div class="stage-container">
                <div class="question-text"><span class="jq_editable"></span></div>
                <div class="main-question-text">
                    <div class="inner-main-question">
                        <div class="dot"></div>
                        <div class="text-question">
                            <span class="jq_editable"></span>
                        </div>
                    </div>
                </div>
                <div class="line"></div>
                <a class="jq_addanswer"></a>
                <div class="drag-container"></div>
            </div>

            <div class="true-false-container">
                <a class="jq_addquestion" title="Add Question"></a>
            </div>
            <div class="help-main-popup">
                <a class="close"></a>
                <div class="inner-help-popup">
                    <iframe></iframe>
                </div>
            </div>
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
</html>
