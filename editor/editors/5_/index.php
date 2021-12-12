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
                image: 'أَنْ تَنْصَحَ أَخاكَ مُتَأَخِّرًا خَيْرٌ مِنْ تَرْكِهِ عَلى الْخَطَأ.',
                drag: [{word: "تَنْصَحَ", type: "1.1"}],
                dropSiz: [{w: '9.1%', h: '42%', t: '33%', r: '78%', type: '1.1'}],
                id: 'id123'
            }
        ]
        ,
        wrongWordsList: [],
        titleText: 'أَمْلَأُ الْفَراغَ بِالكَلِمَةِ الْمُناسِبَةِ، وَأُلاحِظُ حَرَكَةَ الْفَتْحَةِ عَلى آخِرِها'
    };

    window.defaultItem=JSON.stringify(data);

    $(window).load(function () {
        setTimeout(function () {
            $(".jq_editable").attr("contenteditable",'true');
        },1000);

        $(document).on("click",".jq_editi",function () {
            $(this).hide();
            $(this).closest(".item-container").find(".jq_savei").show();
            var iclass='jq_itemc_'+$(this).closest(".item-container").attr('temp-id');
            $('.'+iclass).remove();
            $(this).closest(".item-container").find(".drop-item").remove();
            $(this).closest(".item-container").find(".jq_itemc").attr("contenteditable",'true');
            $(this).closest(".item-container").find(".jq_itemc").focus();
            $(this).closest(".item-container").find(".jq_itemc").css("cursor",'text');
        });

        $(document).on("click",".jq_savei",function () {
            $(this).hide();
            $(this).closest(".item-container").find(".jq_editi").show();
            $(this).closest(".item-container").find(".jq_itemc").attr("contenteditable",'false');
            $(this).closest(".item-container").find(".jq_itemc").css("cursor",'crosshair');
            // canvasBox($(this).closest(".item-container"));
        });

        $(document).on("mousedown",".jq_itemc",function (e) {
            window.mousedown=e.pageX;
        });

        $(document).on("mouseup",".jq_itemc",function (e) {
            if($(this).attr("contenteditable")=='false' || $(this).attr("contenteditable")==false){
                s = window.getSelection();
                var range = s.getRangeAt(0);
                var node = s.anchorNode;
                var width=window.mousedown-e.pageX;
                console.log('width',width);

                if(width>0){
                    var left=(((e.pageX-$(this).closest('.item-container').offset().left)/$(this).closest('.item-container').width()*100)-1).toFixed(2);
                }else{
                    var left=(((window.mousedown-$(this).closest('.item-container').offset().left)/$(this).closest('.item-container').width()*100)-1).toFixed(2);
                }
                while (range.toString().indexOf(' ') != 0) {
                    range.setStart(node, (range.startOffset - 1));
                }
                range.setStart(node, range.startOffset + 1);
                do{
                    range.setEnd(node, range.endOffset + 1);
                }
                while (range.toString().indexOf(' ') == -1 && range.toString().trim() != '');
                var str = range.toString().trim();
                var rwidth=((Math.abs(width)/$(this).closest('.item-container').width()*100)+1.2).toFixed(2);
                var index=($(this).closest('.item-container').index()+1).toString()+'.'+($(this).closest('.item-container').find('.drop-item').length).toString()

                $(this).closest('.item-container').append('<div class="drop-item ui-droppable" data="'+index+'" style="width: '+rwidth+'%;height: 42%;top: 33%;left: '+left+'%"><span></span></div>')
                var iclass='jq_itemc_'+$(this).closest('.item-container').attr('temp-id');
                $(".drag-container").append('<div class="drag-item '+iclass+'" iw="'+rwidth+'" il="'+left+'" style="margin: 10.94% 1.7% 13.9% 2.3%; width: 46.8%; height: 10%; float: none;"><span data="0" class="ui-draggable ui-draggable-handle" style="position: relative;">'+str+'</span><div class="trueanswer" title="true answer"></div></div>');
            }
        });

        $(document).on("click",".jq_addanswer",function () {
            $(".drag-container").append('<div class="drag-item" data="" style="margin: 10.94% 1.7% 13.9% 2.3%; width: 46.8%; height: 10%; float: none;"><a class="jq_deleteanswer"><a/><span data="0" class="ui-draggable ui-draggable-handle jq_editable" contenteditable="true">اجابة</span></div>');
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
            $(".drop-main-container").append('<div class="item-container" temp-id="'+temp_id+'"><a class="jq_editi"></a><a class="jq_savei"></a><a class="jq_deletei"></a><div class="item-text"><span class="jq_itemc">عَلَى الْمَرْءِ أَنْ يُحافِظَ عَلى بيئَتهِ.</span></div> <div class="number-container"><span>'+count+'</span></div> <div class="drop-item ui-droppable" data="1.1" style="width: 9.6%;height: 46%;top: 31%;right: 29.2%"><span></span></div></div>');
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
        var data={};
        var itemList=[];
        var drags=[];
        var dropsize=[];
        var wrongs=[];

        // itemList=[
        //     {
        //         image:"أَنْ تَنْصَحَ أَخاكَ مُتَأَخِّرًا خَيْرٌ مِنْ تَرْكِهِ عَلى الْخَطَأ.",
        //         drag:[{word:"تَنْصَحَ",type:'1.1'},{word:"تَرْكِهِ",type:'1.2'}],
        //         dropSiz:[{w:'9.1%',h:'42%',t:'33%',r:'12.8%',type:'1.1'},{w:'9.1%',h:'42%',t:'33%',r:'12.8%',type:'1.2'}]
        //     }
        var i=0;
        var x=0;
        var temploc='';
        $(".item-container").each(function () {
            var iclass='jq_itemc_'+$(this).attr('temp-id');
            drags=[];
            dropsize=[];
            x=0;
            $(".drag-item."+iclass).each(function () {
                temploc=(i+1).toString()+'.'+(x+1).toString();
                drags[x]={word:$(this).find("span").html(),type:temploc};
                dropsize[x]={w:$(this).attr('iw')+'%',h:'42%',t:'33%',r:$(this).attr('il')+'%',type:temploc};
                x++;
            });
            itemList[i]={image:$(this).find(".jq_itemc").html(),drag:drags,dropSiz:dropsize,id:$(this).attr('temp-id')};
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
    var data=$.parseJSON('<?=$_SESSION["gameData"][$_GET["id"]];?>');
    var itemList=data['itemList'];
    var wrongWordsList=data['wrongs'];
    var titleText=data['mainTitle'];
    console.log('gameData',data);
    <?php
    }else{
    ?>
        var itemList=[
            {
                image:'أَنْ تَنْصَحَ أَخاكَ مُتَأَخِّرًا خَيْرٌ مِنْ تَرْكِهِ عَلى الْخَطَأ.',
                drag:[{word:"تَنْصَحَ",type:"1.1"}],
                dropSiz:[{w:'9.1%',h:'42%',t:'33%',r:'78%',type:'1.1'}],
                id:'id123'
            }
        ]
    var wrongWordsList=[];
    var titleText='أَمْلَأُ الْفَراغَ بِالكَلِمَةِ الْمُناسِبَةِ، وَأُلاحِظُ حَرَكَةَ الْفَتْحَةِ عَلى آخِرِها';
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
                <div class="title"><span class="jq_editable main_title"></span></div>
            </div>
            <a class="jq_addanswer" title="Add Answer"></a>

            <div class="game-container">
                <div class="drop-main-container"></div>
                <div class="drag-container"></div>

            </div>
            <a class="jq_addquestion" title="Add Qusetion"></a>

            <!--<div class="true-false-container">-->
                <!--<span class="question-item item-1"></span>-->
                <!--<span class="question-item item-2"></span>-->
                <!--<span class="question-item item-3"></span>-->
            <!--</div>-->
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
