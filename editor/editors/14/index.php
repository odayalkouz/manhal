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
    function saveGame() {
        var data={};
        var itemList=[];
        var wrongAnswer=[];
        var supTitle='';
        var title='';
        var i=0;
        var x=0;
        $(".drop-item").each(function () {
            var drop='';
            var iclass='jq_itemc_'+$(this).attr('temp-id');
            $(this).find(".word-container").each(function () {
                console.log("sssss"+$(this));
                if($(this).hasClass("selected")){
                     drop=$(this).find(".inner-word span").html();
                     console.log("drop<<<>>"+drop);
                }
            });

            itemList[i]={img1:$(this).find(".all-sentence span").html(),answer:drop,id:iclass};
            console.log('saving', itemList[i]);
            i++;
        });
        $(".drag-item").each(function () {
            if($(this).attr("data")==0){
                console.log("data<<>>>")
                wrongAnswer.push($(this).find(".inner-drag-item span").html());
            }
        })
        title=$("#maintitle").html();
        supTitle=$("#suptitle").html();
        setTimeout(function () {
            data["itemList"]=itemList;
            data['title']=title;
            data['supTitle']=supTitle;
            data['wrongAnswer']=wrongAnswer;
            window.parent.saveGameData(data);
        },200);
    }
    <?php
    if(isset($_SESSION["gameData"][$_GET["id"]]) && $_SESSION["gameData"][$_GET["id"]]!=''){
    ?>
    var gameData=$.parseJSON('<?=str_replace('\"','\\\\"',$_SESSION["gameData"][$_GET["id"]]);?>');
    var itemList=gameData['itemList'];
    var title=gameData['title'];
    var supTitle=gameData['supTitle'];
    var wrongAnswer=gameData['wrongAnswer'];

    <?php
    }else{
    ?>
    var itemList=[
        {img1:'ساحَةُ الْمَدْرَسَةِ',answer:'الْمَدْرَسَةِ',id:'id123'},
        {img1:'سورُ الْحِديقَةِ',answer:'الْحِديقَةِ',id:'id124'},
        {img1:'مِفْتاحُ الْبابِ',answer:'الْبابِ',id:'id125'},
        {img1:'شاشَةُ الْحاسوبِ',answer:'الْحاسوبِ',id:'id126'},
        {img1:'نورُ الشَّمْسِ',answer:'الشَّمْسِ',id:'id127'},
        {img1:'عَلَمُ بِلادي',answer:'بِلادي',id:'id128'}
    ];
    var wrongAnswer=[];
    var title="أُكْمِلُ النَّمَطَ,ثُمَّ أَقْرَأُ";
    var supTitle="أَمْلَأُ الْفَراغَ بِما هوَ مُناسِبٌ:";
    <?php
    }
    ?>
    $(document).on("click", ".jq_addquestion", function () {
        var cardlength=$(".drop-item").length;
        var temp_id='item_'+randomString(10);
        $('<div class="drop-item drop-'+(cardlength+1)+'" temp-id="'+temp_id+'"><a class="jq_editi"></a><a class="jq_savei"></a><a class="jq_deletei"></a><div class="all-sentence" style="display: table"><span contenteditable="true">اكتب هنا</span></div><div class="inner-drop-item"></div></div>').appendTo(".drop-inner-container");
    });
    $(document).on("click",".jq_deleteanswer",function () {
        $(this).closest('.drag-item').remove();
    });
    $(document).on("click",".jq_addAnswer",function () {
        $('<div class="drag-item" data="0"><a class="jq_deleteanswer"></a><div class="inner-drag-item"><span data="" contenteditable="true">اكتب هنا</span></div></div>').appendTo(".drag-container");
    });
    $(document).on("click",".word-container" ,function () {
        var wordLength=$(this).parent().length;
        var count=0;
        if(!($(this).hasClass("selected"))){
            if(wordLength>2){

            }else {
                var iclass='jq_itemc_'+$(this).closest('.drop-item').attr('temp-id');
                $('.'+iclass).remove();
                $(this).parent().find(".word-container").removeClass("selected");
                $(this).addClass("selected");
                $('<div class="drag-item '+iclass+'"><div class="inner-drag-item"><span data="'+$(this).find('.inner-word span').html()+'">'+$(this).find('.inner-word span').html()+'</span></div></div>').appendTo(".drag-container");
                // $(this).parent().find(".word-container").each(function () {
                //     if($(this).hasClass("selected")){
                //         count++;
                //     }
                // })
                // if(count==0){
                //
                // }
            }
        }

    })
    $(document).on('click','.jq_deletei',function () {
        var cardlength=$(".drop-item").length;
        if(cardlength>2){
            $(this).closest('.drop-item').remove();
        }

    });
    $(document).on("click",".jq_editi",function () {
        $(this).hide();
        $(this).closest(".drop-item").find(".jq_savei").show();
        $(this).closest(".drop-item").find(".all-sentence").css("display","table");
        $(this).closest(".drop-item").find(".inner-drop-item").hide();
        // $(this).closest('.drop-item').find("");
        var iclass='jq_itemc_'+$(this).closest('.drop-item').attr('temp-id');
        $('.'+iclass).remove();
    });
    $(document).on("click",".jq_savei",function () {
        $(this).hide();
        $(this).closest(".drop-item").find(".jq_editi").show();
        $(this).closest(".drop-item").find(".all-sentence").hide();
        $(this).closest(".drop-item").find(".inner-drop-item").html("");
        var sentence=$(this).closest(".drop-item").find(".all-sentence span").html();
        var splitSentence=sentence.split(" ");
        var html='';
        for(var i=0;i<splitSentence.length;i++){
            html+='<div class="word-container"  data="'+splitSentence[i]+'"><div class="dott"><span></span></div><div class="inner-word"><span>'+splitSentence[i]+'</span></div></div>';
        }
        $(this).closest(".drop-item").find(".inner-drop-item").html(html).show();
    })
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

</script>
<body onunload="disconnetLMS();">
<div class="main-bg-container">
    <div id="main-container" class="main-container">
        <div id="inner-container" class="inner-container">
            <div class="header-container">
                <div class="inner-header-container"></div>
                <a class="help-icon"></a>
            </div>
            <div class="title"><span id="maintitle" contenteditable="true"></span></div>
            <div class="game-container">
                <div class="sup-title">
                    <i></i>
                    <span id="suptitle" contenteditable="true"></span>
                </div>
                <div class="drop-main-container">
                    <div class="drop-inner-container"></div>

                </div>
                <div class="drag-container"></div>
                <a class="jq_addquestion" title="Add Qusetion"></a>
                <a class="jq_addAnswer" title="Add Answer"></a>
            </div>

            <a class="poweredBy"></a>
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
        </div>
    </div>
</div>

</body>
<script src="js/data.js"></script>
<script src="js/js.js"></script>
<script type="text/javascript" src="js/TouchPunch.js"></script>
</html>

