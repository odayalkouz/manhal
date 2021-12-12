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
        console.log("saasas")
        if (input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function (e) {
                // document.getElementById(id).src=e.target.result;
                resizedataURL(e.target.result, 200, 200,input);
                // $("#"+id).attr("updated","1");
            }
            reader.readAsDataURL(input.files[0]);
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
            $(id).closest('.img-container').find('img').attr('src',dataURI);
            // document.getElementById(id).src=dataURI
            /////////////////////////////////////////
            // Use and treat your Data URI here !! //
            /////////////////////////////////////////
            $.ajax({
                url: "../../../platform/ajax/template_editor.php?process=uploadimg64",
                type: "POST",
                cache: false,
                dataType: 'json',
                data:{"id":<?=$_GET["id"];?>,"data":dataURI},
                success: function (jsonData) {
                    console.log(jsonData);
                    if(jsonData.status==1){
                        $(id).closest('.img-container').find('img').attr('src',jsonData.path);
                    }else{
                        console.log('error',jsonData);
                    }
                }
            });
        };
        // We put the Data URI in the image's src attribute
        img.src = datas;
    }
    window.defaultItem=JSON.stringify({
        question:'أَسْتَخْرِجُ مِنَ الْفَقَرَةِ ما يَلي:',
        qus:"ضِدَّ كَلِمَةِ <font>(عامٌّ)</font>:",
        img:'images/image.svg',
        ans:['خاصٍّ'],
        text:'أَنْتُمْ يا شَبابَنا الْأُرْدَنيُّ تواجِهونَ مَسْؤوليّاتٍ وَتَحَدياتٍ مِنْ نَوْعٍ خاصٍّ، فَأَنْتُمْ ابْتِداءً الْقِطاعُ الْأَوْسَعُ في الْمُجْتَمَعِ، وَأَنْتُمْ ثانيًا مَنْ سَيَجْني عَوائِدَ الْعَمَليَّةِ التَّنْمِويَّةِ الَّتي يَمُرُّ بِها الْأُرْدُنُّ الْيَوْمَ، وَالَّتي نُؤَمِّلُ وَنَعْمَلُ لِتَكونَ مُخْرَجاتُها إيجابيَّةً بِعَوْنِ اللهِ تَعالى.',
        imgShow:true,
    });
    $(window).load(function () {

        setTimeout(function () {
            $(".jq_editable").attr("contenteditable", 'true');
        }, 1000);
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

    $(document).on("click",".jq_editi",function () {
        $(".all-text").show();
        $(".text-container").hide();
        $(this).hide();
        $('.jq_savei').show();
    });
    $(document).on("click",".jq_savei",function () {
        $(".all-text").hide();
        $(".text-container").show();
        $(this).hide();
        $('.jq_editi').show();
        var splitText=$(".all-text p").text().split(" ",".");
        var html='';
        for(var i=0;i<splitText.length;i++){
            console.log("splitText<<<>>>"+splitText);
            html+='<div class="drag-item"><span>'+splitText[i]+'</span></div>'
        }
        $(".text-container").html(html);
        // for(var x=0;x<$(".text-container .drag-item").length;x++){
        //     // var htmlSplit=$(".text-container .drag-item:nth-child("+(x+1)+")").find("span").text().split(".");
        //     // console.log("htmlSplit"+htmlSplit);
        //     if($( ".text-container .drag-item:nth-child("+(x+1)+")" ).find("span:contains('.')")){
        //         console.log("osaid");
        //         $( ".text-container .drag-item:nth-child("+(x+1)+")" ).find("span").text().replace(".","&nbsp . &nbsp")
        //         // $( ".text-container .drag-item:nth-child("+(x+1)+")" ).find("span").text().split(" ");
        //     }
        // }
        drag();

    });

    $(document).on("click",".jq_addsquare",function () {
      var i=$(".ans-box").length;
      if(i<3){
          $('<div class="ans-box" data=""><a class="jq_removesquare" title="Delete"></a>' +
              '<div class="qus-mark"></div><div class="dot-container"></div>' +
              '<div class="ans-text"><span></span></div></div>').appendTo(".ans-container");
          if(i==2){
              $(".ans-box").css({"width":"32.3%","margin-left":"1%"})
          }
      }
        drag();

    });
    $(document).on("click",".jq_removesquare",function () {
        var i=$(".ans-box").length;
        if(i>1){
            // console.log("i<<<>>>"+i);
            $(this).closest(".ans-box").remove();
        }
        setTimeout(function () {
            var x=$(".ans-box").length;
            if(x<3){
                $(".ans-box").css({"width":"44.264%","margin-left":"1%"})
            }
        },50)


    });
    $(document).on("click",".jq_removequestion",function () {
        var i=$(".question-item").length;
        if(i>1){
            $(this).closest(".question-item").remove();
            $(".question-item").removeClass("selected");
            console.log("i<<<>>>"+(i-1));

        }

        var x=$(".question-item").length;
        $(".question-item:nth-child("+x+")").addClass("selected")
        loadQuestion($(".question-item:nth-child("+x+")"));

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
    $(document).on("click",".jq_deleteImage",function () {
        $(this).closest(".img-container").removeClass("show");
        $(".jq_addImage").show();
        $(".text-container").css("width","100%");
        $(".all-text").css("width","100%");
        $(".jq_editi").css("left","1%");
        $(".jq_savei").css("left","1%");
    });
    $(document).on("click",".jq_addImage",function () {
        $(".img-container").addClass("show");
        $(".text-container").css("width","65.238%");
        $(".all-text").css("width","65.238%");
        $(".jq_editi").css("left","36%");
        $(".jq_savei").css("left","36%");
        $(this).hide();
    })
    function loadQuestion(e){
        var data=$.parseJSON(e.attr('data'));
        console.log("imgShowasdasdasd<<<<>>>>"+data['imgShow']);
        $(".jq_qusText").html(data['question']);
        $(".qus-item-text span").html(data['qus']);
        if(data['imgShow']==true){
            $(".text-container").css("width","65.238%");
            $(".all-text").css("width","65.238%");
            $(".jq_editi").css("left","36%");
            $(".jq_savei").css("left","36%");
            $(".jq_addImage").hide();
            $(".img-container").addClass("show");
        }else {
            $(".img-container").removeClass("show");
            $(".jq_addImage").show();
            $(".text-container").css("width","100%");
            $(".all-text").css("width","100%");
            $(".jq_editi").css("left","1%");
            $(".jq_savei").css("left","1%");

        }

        $(".all-text p").html(data['text']);
        var splitText=$(".all-text p").text().split(" ");
        var html='';
        for(var i=0;i<splitText.length;i++){
            html+='<div class="drag-item"><span>'+splitText[i]+'</span></div>'
        }
        $(".text-container").html(html);
        $(".ans-container").html('');
        for(i=0;i<data['ans'].length;i++){
            $(".ans-container").append('<div class="ans-box" data="'+data['ans'][i]+'"><a class="jq_removesquare" title="Delete"></a><div class="ans-text"><span>'+data['ans'][i]+'</span></div></div>')
        }
        drag();
    }
    function saveCurrentQuestion(){
        var answer=[];

        var x=0;
        $(".ans-box").each(function () {
            answer[x]=$(this).find(".ans-text span").html();
            x++;
        });
        setTimeout(function () {
            var imgShowVal=true;
            if($(".img-container").hasClass("show")){
                imgShowVal=true;
            }else {
                imgShowVal=false;
            }
            console.log("imgShowVal<<<>>>>"+imgShowVal)
            var  item={
                question:$(".jq_qusText").html(),
                qus:$('.qus-item-text span').html(),
                img:$(".img-container img").attr("src"),
                text:$(".all-text p").text(),
                ans:answer,
                imgShow:imgShowVal
            }
            $(".question-item.selected").attr('data',JSON.stringify(item));
        },100);
    }


    function saveGame() {
        var data={};
        var itemList=[];
        var text='';
        var title='';
        var imag=true;
        saveCurrentQuestion();
        setTimeout(function () {
            var i=0;
            $(".question-item").each(function () {
                itemList[i]=$.parseJSON($(this).attr('data'));
                i++;
            });
        },300);
        text=$(".all-text p").text();
        title= $(".title span").html();
        if($(".img-container").hasClass("show")){
            imag=true;
        }else {
            imag=false;
        }
        setTimeout(function () {
            data["itemList"]=itemList;
            data['text']=text;
            data['title']=title;
            data['imag']=imag;
            window.parent.saveGameData(data);
        },500)
    }

    <?php
    if(isset($_SESSION["gameData"][$_GET["id"]]) && $_SESSION["gameData"][$_GET["id"]]!=''){
    ?>
    var gameData=$.parseJSON('<?=str_replace('\"','\\\\"',$_SESSION["gameData"][$_GET["id"]]);?>');
    var itemList=gameData['itemList'];
    var text=gameData['text'];
    var title=gameData['title'];
    var imag=gameData['imag'];
    <?php
    }else{
    ?>
    var title='الأَضْدادُ';
    var text='أَنْتُمْ يا شَبابَنا الْأُرْدَنيُّ تواجِهونَ مَسْؤوليّاتٍ وَتَحَدياتٍ مِنْ نَوْعٍ خاصٍّ، فَأَنْتُمْ ابْتِداءً الْقِطاعُ الْأَوْسَعُ في الْمُجْتَمَعِ، وَأَنْتُمْ ثانيًا مَنْ سَيَجْني عَوائِدَ الْعَمَليَّةِ التَّنْمِويَّةِ الَّتي يَمُرُّ بِها الْأُرْدُنُّ الْيَوْمَ، وَالَّتي نُؤَمِّلُ وَنَعْمَلُ لِتَكونَ مُخْرَجاتُها إيجابيَّةً بِعَوْنِ اللهِ تَعالى.'
    var imag=true;
    $(".img-container").hasClass("show")
    var itemList=[
        {
            question:'أَسْتَخْرِجُ مِنَ الْفَقَرَةِ ما يَلي:',
            qus:"ضِدَّ كَلِمَةِ <font>(عامٌّ)</font>:",
            img:'images/image.svg',
            ans:['خاصٍّ'],
            text:'أَنْتُمْ يا شَبابَنا الْأُرْدَنيُّ تواجِهونَ مَسْؤوليّاتٍ وَتَحَدياتٍ مِنْ نَوْعٍ خاصٍّ، فَأَنْتُمْ ابْتِداءً الْقِطاعُ الْأَوْسَعُ في الْمُجْتَمَعِ، وَأَنْتُمْ ثانيًا مَنْ سَيَجْني عَوائِدَ الْعَمَليَّةِ التَّنْمِويَّةِ الَّتي يَمُرُّ بِها الْأُرْدُنُّ الْيَوْمَ، وَالَّتي نُؤَمِّلُ وَنَعْمَلُ لِتَكونَ مُخْرَجاتُها إيجابيَّةً بِعَوْنِ اللهِ تَعالى.',
            imgShow:true
        },
    ];

    var jqclass='item-1';
    $('<span class="question-item jq_selected '+jqclass+'" data="'+JSON.stringify(itemList[0])+'"></span>').insertBefore(".jq_addquestion");
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
                <span class="jq_editable jq_title"></span>
            </div>
        </div>

        <div class="main-drag-container">
            <a class="jq_editi"></a>
            <a class="jq_savei"></a>
            <div class="all-text">
                <p class="jq_editable"></p>
            </div>
            <div class="text-container"></div>
            <a class="jq_addImage"></a>
            <div class="img-container">
                <a class="jq_deleteImage" title="delete Image"></a>
                <div class="upload_container"><i></i><input type="file" class="jq_upload_img" onchange="readURL(this);"></input></div>
                <img src="images/image.svg">
            </div>
        </div>
        <div class="stag-container">
            <a class="jq_addsquare" title="Add"></a>
            <div class="qus-main">
                <i class="qus-icon"></i>
                <div class="qus-text"><span class="jq_editable jq_qusText"></span></div>
            </div>
            <div class="sup-qus">
                <div class="qus-item"></div>
            </div>
            <div class="ans-container"></div>
        </div>
        <!--<div class="clones"><span>إيجابيَّةً</span></div>-->
        <div class="footer"></div>
        <div class="true-false-container">
<!--            <span class="question-item item-1 selected"><a class="jq_removequestion"></a></span>-->
            <a class="jq_addquestion" title="Add Question"></a>
        </div>
        <div class="help-main-popup">
            <a class="close"></a>
            <div class="inner-help-popup">
                <iframe></iframe>
            </div>
        </div>
        <!--<a class="poweredBy" href="https://www.manhal.com/"></a>-->
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
    </div>
</div>
</body>
<script src="js/data.js"></script>
<script src="js/js.js"></script>
<script type="text/javascript" src="js/TouchPunch.js"></script>
</html>
