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
    $(window).load(function () {
        setTimeout(function () {
            $(".card").each(function () {
                $(this).find("span").attr("contenteditable",'true');
            });
        },1000);

    });
    function saveGame() {
        var data={};
        var itemList=[];
        var mainTitle=''
        var supTitle=''
        for(var i=0;i<$(".col1 .card").length;i++){
            itemList[i]={img1:$(".col1 .card span").eq(i).html(),img2:$(".col2 .card span").eq(i).html(),type:(i+1).toString()};
        }
        mainTitle=$("#maintitle").html();
        supTitle=$("#suptitle").html();
        setTimeout(function () {
            data["itemList"]=itemList;
            data['mainTitle']=mainTitle;
            data['supTitle']=supTitle;
            window.parent.saveGameData(data);
        },200);
    }
    <?php
    if(isset($_SESSION["gameData"][$_GET["id"]]) && $_SESSION["gameData"][$_GET["id"]]!=''){
    ?>
    var gameData=$.parseJSON('<?=str_replace('\"','\\\\"',$_SESSION["gameData"][$_GET["id"]]);?>');
    var itemList=gameData['itemList'];
    var mainTitle=gameData['mainTitle'];
    var supTitle=gameData['supTitle'];

    <?php
    }else{
    ?>
    var itemList=[
        {img1:"تَهْتَزُّ بِشِدَّةٍ",img2:"تَمورُ",type:"1"},
        {img1:"حِجارَةً صَغيْرَةً",img2:"حاصِبًا",type:"2"},
        {img1:"طُرُقِها",img2:"مَناكِبِها",type:"3"},
        {img1:"عَذابٍ",img2:"نَكيْرِ",type:"4"},
        {img1:"يَسَّرَها لَكُمْ لِلِانْتِفاعِ بِها",img2:"جَعَلَ لَكُمُ الْأَرْضَ ذَلولًا",type:"5"},
    ]
    var mainTitle='سورَةُ الْمُلْكِ (1-12)';
    var supTitle='أَخْتارُ كُلًا مٍنَ المُفْرَداتٍ وَمايُقَارٍبُهَا في المَعْنَى:';
    <?php
    }
    ?>

    $(document).on("click", ".jq_add_row", function () {
        var cardlength=$(".col1 .card").length;
        $('<div onclick="choseCorrect(this)" class="card card-row'+(cardlength+1)+'" data="'+(cardlength+1)+'"><span contenteditable="true">اكتب هنا</span></div>').appendTo(".col1");
        $('<div onclick="choseCorrect(this)" class="card card-row'+(cardlength+1)+'" data="'+(cardlength+1)+'"><a class="jq_remove_row"></a><span contenteditable="true">اكتب هنا</span></div>').appendTo(".col2");
    });
    $(document).on('click','.jq_remove_row',function () {
        var data=$(this).parent().attr("data");
        console.log("length1<<<>>>>"+$(".col1 .card").length)
        if($(".col1 .card").length>3){
            console.log("length<<<>>>>"+$(".col1 .card").length)
            $(".card-row"+data).remove();
        }
        reArrangAll();

    });
    function reArrangAll(){
        var i=1;

        for(i=1;i<=$(".col1 div").length;i++){
            $(".col1 div").eq(i-1).attr('data',i);
            $(".col2 div").eq(i-1).attr('data',i);
        }
    }
</script>
<body onunload="disconnetLMS();">
<div id="main-container" class="main-container">
    <div id="inner-container" class="inner-container">
        <a class="title-icon"></a>
        <div class="title-container">
            <div class="title">
                <span id="maintitle" contenteditable="true"></span>
            </div>

        </div>
        <div class="card-main-container">
            <div class="sup-title">
                <div class="dot"></div>
                <div class="inner-sup-title">
                    <span id="suptitle" contenteditable="true"></span>
                </div>
            </div>
            <a class="jq_add_row"></a>
            <div class="inner-card-container">
                <div class="col col1"></div>
                <div class="col col2"></div>
            </div>
        </div>
        <a class="poweredBy" href="https://www.manhal.com/"></a>
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
