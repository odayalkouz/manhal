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
    // alert();
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
        for(var i=0;i<$(".row1 .card").length;i++){
            itemList[i]={img1:$(".row1 .card span").eq(i).html(),img2:$(".row2 .card span").eq(i).html(),type:(i+1).toString()};
        }
        data["title"]=$("#game_title").html();
        setTimeout(function () {
            data["itemList"]=itemList;
            window.parent.saveGameData(data);
        },200);
    }
    <?php
        if(isset($_SESSION["gameData"][$_GET["id"]]) && $_SESSION["gameData"][$_GET["id"]]!=''){
            ?>
    var gameData=$.parseJSON('<?=str_replace('\"','\\\\"',$_SESSION["gameData"][$_GET["id"]]);?>');
    var itemList=gameData['itemList'];
    $(window).load(function () {
        $("#game_title").html(gameData['title']);
    });
    <?php
        }else{
            ?>
    var itemList=[
        {img1:"النِّظامُ",img2:"الْفَوْضى",type:"1"},
        {img1:"الصِّحَّةُ",img2:"الْمَرَضُ",type:"2"},
        {img1:"أُحِبُّ",img2:"أَكْرَهُ",type:"3"},
        {img1:"الجَديدُ",img2:"الْقَديمُ",type:"4"},
    ]
    <?php
    }
    ?>

    $(document).on("mouseup mousedown keydown", ".card span", function () {
        $(".card span").each(function(){
            var len=$(this).text().length;
            if(len>=10) {
                $(".card span").addClass("small-font");
            }
        });
    });
</script>
<body onunload="disconnetLMS();">
<div id="main-container" class="main-container">
    <div id="inner-container" class="inner-container">
        <i class="title-icon"></i>
        <div class="title"><span id="game_title" contenteditable="true">أضغط على كل من المفردات والمعنى المقابل لها</span></div>
        <div class="card-main-container">
            <div class="row row1"></div>
            <div class="row row2"></div>
        </div>
        <div class="help-main-popup">
            <a class="close"></a>
            <div class="inner-help-popup">
                <iframe></iframe>
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
