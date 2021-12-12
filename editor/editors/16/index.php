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
    function readURL(input)
    {
        if (input.files && input.files[0])
        {

            var reader = new FileReader();
            reader.onload = function (e) {
                // document.getElementById(id).src=e.target.result;
                console.log('file',e.target.result);
                resizedataURL(e.target.result, 200, 200,input);
                // $("#"+id).attr("updated","1");
            }
            reader.readAsDataURL(input.files[0]);
            $(input).closest(".tool-container").find(".jq_remove_img").show();
        }
    }

    function resizedataURL(datas, wantedWidth, wantedHeight,id)
    {
        // We create an image to receive the Data URI
        var img = document.createElement('img');
        // When the event "onload" is triggered we can resize the image.
        img.onload = function()
        {
            // We create a canvas and get its context.
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            // We set the dimensions at the wanted size.
            canvas.width = wantedWidth;
            canvas.height = wantedHeight;
            // We resize the image with the canvas method drawImage();
            ctx.drawImage(this, 0, 0, wantedWidth, wantedHeight);
            var dataURI = canvas.toDataURL();
            $(id).closest('.card').find('img').attr('src',dataURI);
            // document.getElementById(id).src=dataURI
            /////////////////////////////////////////
            // Use and treat your Data URI here !! //
            /////////////////////////////////////////
            console.log('data',dataURI);
            $.ajax({
                url: "../../../platform/ajax/template_editor.php?process=uploadimg64",
                type: "POST",
                cache: false,
                dataType: 'json',
                data:{"id":<?=$_GET["id"];?>,"data":dataURI},
                success: function (jsonData) {
                    console.log(jsonData);
                    if(jsonData.status==1){
                        $(id).closest('.card').find('img').attr('src',jsonData.path);
                    }else{
                        console.log('error',jsonData);
                    }
                }
            });
        };
        // We put the Data URI in the image's src attribute
        img.src = datas;
    }


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
        var mainTitle='';
        var supTitle='';
        for(var i=0;i<$(".col1 .card").length;i++){
            if($(".col1 .card .image-container img").eq(i).attr("src")==""){
                $(".col1 .card .image-container img").eq(i).attr("imgShow",false);
            }else {
                console.log("1111111111111");
                $(".col1 .card .image-container img").eq(i).attr("imgShow",true);
            }
            if($(".col2 .card .image-container img").eq(i).attr("src")==""){
                console.log("asssssssssss");
                $(".col2 .card .image-container img").eq(i).attr("imgShow",false);
            }else {
                $(".col2 .card .image-container img").eq(i).attr("imgShow",true);
            }
            itemList[i]={card1:{imag:$(".col1 .card .image-container img").eq(i).attr("src"),title:$(".col1 .card .img-title span").eq(i).html(),text:$(".col1 .card .inner-card span").eq(i).html(),cat:'1',imgShow:$(".col1 .card .image-container img").eq(i).attr("imgShow")},
                         card2:{imag:$(".col2 .card .image-container img").eq(i).attr("src"),title:$(".col2 .card .img-title span").eq(i).html(),text:$(".col2 .card .inner-card span").eq(i).html(),cat:'0',imgShow:$(".col2 .card .image-container img").eq(i).attr("imgShow")},type:(i+1).toString()};
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
        {
            card1:{imag:"images/im01.svg",title:"صَباحُ الْخَيْر",text:"اكتب هنا",cat:'1',imgShow:true},
            card2:{imag:"",title:"اكتب هنا",text:"صَباحُ الْخَيْر" ,cat:'0',imgShow:false},
            type:'1',
        },
        {
            card1:{imag:"images/im02.svg",title:"خُطوطُ الْمُشاة",text:"اكتب هنا",cat:'1',imgShow:true},
            card2:{imag:"",title:"اكتب هنا",text:"خُطوطُ الْمُشاة",cat:'0',imgShow:false},
            type:'2',
        },
        {
            card1:{imag:"images/im03.svg",title:"إِشارَةُ الْمُرور",text:"اكتب هنا",cat:'1',imgShow:true},
            card2:{imag:"",title:"اكتب هنا",text:"إِشارَةُ الْمُرور",cat:'0',imgShow:false},
            type:'3',
        },
        {
            card1:{imag:"images/im04.svg",title:"حافِلَةُ الْمَدْرَسَة",text:"اكتب هنا",cat:'1',imgShow:true},
            card2:{imag:"",title:"اكتب هنا",text:"حافِلَةُ الْمَدْرَسَة",cat:'0',imgShow:false},
            type:'4',
        }
    ];
    var mainTitle='خُطوطُ الْمُشاة';
    var supTitle='أَقْرَأُ وَأَصِلُُ بِالصُّورَةِ الْمُناسِبَةِ :';
    <?php
    }
    ?>

    // $(document).on("mouseup mousedown keydown", ".card span", function () {
    //     $(".card span").each(function(){
    //         var len=$(this).text().length;
    //         if(len>=10) {
    //             $(".card span").addClass("small-font");
    //         }
    //     });
    // });
    $(document).on("click", ".jq_add_row", function () {
        var cardlength=$(".col1 .card").length;
        $('<div class="card cardClick card-row'+(cardlength+1)+'" data="'+(cardlength+1)+'"><div class="tool-container"><a class="jq_remove_row"></a><div class="upload_container"><i></i><input type="file" class="jq_upload_img" onchange="readURL(this);"></input></div><a class="jq_remove_img"></a></div><div class="image-container" cat=""><img src=""></div>' +
            '<div class="img-title"><span contenteditable="true">اكتب هنا</span></div><div class="inner-card"><span class="textSpan" contenteditable="true">اكتب هنا</span></div></div>').appendTo(".col1");
        $('<div class="card cardClick card-row'+(cardlength+1)+'" data="'+(cardlength+1)+'"><div class="tool-container"><div class="upload_container"><i></i><input type="file" class="jq_upload_img" onchange="readURL(this);"></input></div><a class="jq_remove_img"></a></div><div class="image-container" cat=""><img src=""></div>' +
            '<div class="img-title"><span contenteditable="true">اكتب هنا</span></div><div class="inner-card"><span class="textSpan" contenteditable="true">اكتب هنا</span></div></div>').appendTo(".col2");
        // $('<div onclick="choseCorrect(this)" class="card card-row'+(cardlength+1)+'" data="'+(cardlength+1)+'"><span contenteditable="true">اكتب هنا</span></div>').appendTo(".col1");
        // $('<div onclick="choseCorrect(this)" class="card card-row'+(cardlength+1)+'" data="'+(cardlength+1)+'"><a class="jq_remove_row"></a><span contenteditable="true">اكتب هنا</span></div>').appendTo(".col2");
        reArrangAll()
    });
    $(document).on('click','.jq_remove_row',function () {
        var data=$(this).parent().parent().attr("data");
        console.log("length1<<<>>>>"+$(".col1 .card").length)
        if($(".col1 .card").length>3){
            console.log("length<<<>>>>"+$(".col1 .card").length)
            $(".card-row"+data).remove();
        }
        reArrangAll()
    });
    $(document).on('click','.jq_remove_img',function () {
        $(this).closest(".card").find(".image-container").hide();
        $(this).closest(".card").find(".image-container img").attr({"src":"","imgshow":false});
        $(this).hide();
    })
    function reArrangAll() {
        var i=1;
        var x=1;
        $(".col1 .card").each(function () {
            $(this).attr('data',i);
            $(this).attr("class","");
            $(this).attr("class","card cardClick card-row"+i);
            i++;
        });
        $(".col2 .card").each(function () {
            $(this).attr('data',x);
            $(this).attr("class","");
            $(this).attr("class","card cardClick card-row"+x);
            x++;
        });
    }
</script>
<body onunload="disconnetLMS();">
<div id="main-container" class="main-container">
    <div id="inner-container" class="inner-container">
        <div class="header-container">
            <div class="inner-header">
                <div class="title-container">
                    <span id="maintitle" class="title"  contenteditable="true"></span>
                </div>
                <a class="help-icon"></a>
            </div>
        </div>
        <a class="title-icon"></a>
        <div class="card-main-container">
            <div class="sup-title">
                <i></i>
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
        <div class="footer-line"></div>
        <div class="footer-container"></div>
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
