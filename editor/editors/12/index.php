<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link href="css/animate.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/manhalloader.css" rel="stylesheet" type="text/css">
    <script src="https://www.manhal.com/js/scorm.js"></script>
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/data.js"></script>
    <script src="js/js.js"></script>
    <script src="js/manhalLoader.js"></script>
    <script type="text/javascript" src="js/TouchPunch.js"></script>
</head>
<script>
    window.addEventListener("touchmove", function(event) {event.preventDefault();}, {passive: false} );
    $(window).load(function () {

        setTimeout(function () {
            $(".jq_editable").attr("contenteditable",'true');
        },1000);
        $(document).on("click", ".jq_addquestion", function () {
            var count = ($('.text-container').length + 1).toString();
            var temp_id = 'item_' + randomString(10);
            $(".text-inner-container").append('<div class="text-container" temp-id="' + temp_id + '"><a class="jq_deletei"></a><div class="number-question"><span>' + count + '</span></div> <div class="text-bg-container"><p class="jq_editable" contenteditable="true">شَهِدَ سَميرٌ بِشَيءٍ لا يَعْرِفُهُ إِرْضاءً لِصَديقِهِ سَعيدٍ.</p></div> <div class="trueFalse"><a class="true-btn jq_true-btn" data="1" onclick="choseCorrect(this)"><span contenteditable="true">صح</span></a><a class="false-btn jq_false-btn" data="0" onclick="choseCorrect(this)"><span contenteditable="true">خطأ</span></a></div></div>');
        });
        $(document).on("click", ".jq_deletei", function () {
            var iclass = 'jq_itemc_' + $(this).closest(".text-container").attr('temp-id');
            $('.' + iclass).remove();
            $(this).closest('.text-container').remove();
            reNumber();
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
        $(".number-question").each(function () {
            $(this).find('span').html($(this).closest('.text-container').index()+1);
        });
    }




    function saveGame() {
        var itemList=[];
        var data={};
        data['title']=$(".title .jq_editable").html();
        var i=0;
        var tempSelected="0";
        $(".text-container").each(function () {

            if($(this).find(".trueFalse .true-btn").hasClass('selected')){
                tempSelected="1";
            }else{
                tempSelected="0";
            }
            itemList[i]={word:$(this).find(".jq_editable").html(),type:tempSelected,true:$(this).find(".jq_true-btn span").html(),false:$(this).find(".jq_false-btn span").html()};
            i++;
        });

        setTimeout(function () {
            data['itemList']=itemList;
            window.parent.saveGameData(data);
        },500)
    }
    <?php
    if(isset($_SESSION["gameData"][$_GET["id"]]) && $_SESSION["gameData"][$_GET["id"]]!=''){
    ?>
    var Data=$.parseJSON('<?=str_replace('\"','\\\\"',$_SESSION["gameData"][$_GET["id"]]);?>');
    var itemList = Data['itemList'];
    var title=Data['title'];

    <?php
    }else{
    ?>
        var itemList=[
            {word:"شَهِدَ سَميرٌ بِشَيءٍ لا يَعْرِفُهُ إِرْضاءً لِصَديقِهِ سَعيدٍ.",type:"1",true:'صح',false:'خطأ'}
        ];
        var title='صفات المنافق';
    <?php
    }
    ?>
</script>
<body onunload="disconnetLMS();">
<div class="main-container" id="gameConainer">
    <div id="inner-gameContainer" class="inner-gameContainer">
        <div class="header-container">
            <div class="inner-header"></div>
            <a class="title-icon"></a>
            <div class="title">
                <span class="jq_editable" contenteditable="true"></span>
            </div>
        </div>
        <div class="text-main-container">
            <div class="text-inner-container"></div>
        </div>
        <div class="footer"></div>
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
            </div>
        </div>
        <div class="main-message-container_nextMessage">
            <div class="inner-message-container">
                <span id="feedback1" class="wellDonw"></span>
                <a class="next-scene" onclick="nextSceneClick()"></a>
            </div>
        </div>
        <a class="jq_addquestion" title="Add Qusetion"></a>

    </div>
</div>
</body>
</html>
