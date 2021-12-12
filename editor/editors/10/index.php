<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clothe Line</title>
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
            $(".item-container .jq_itemc").attr("contenteditable",'false');
            $(".item-container .jq_itemc").css("cursor",'crosshair');
            // $(this).closest(".item-container").find(".jq_itemc").css("cursor",'crosshair');
        },1000);
    });
    var itemList=[
            {
                text:'الصِّدْقُ فَضيلَةٌ',
                answer:[
                    {word:'الصِّدْقُ',type:'1'},
                    {word:'فَضيلَةٌ',type:'2'},
                    // {word:'فَضيلَةٌ',type:'3'}
                ]
            },
            {
                text:'الْبَحْرُ هادِئٌ',
                answer:[
                    {word:'الْبَحْرُ',type:'1'},
                    {word:'هادِئٌ',type:'2'},
                    // {word:'هادِئٌ',type:'2'}
                ]
            },
            {
                text:'الْفَلّاحُ نَشيطٌ في عَمَلِهِ',
                answer:[
                    {word:'الْفَلّاحُ',type:'1'},
                    {word:'نَشيطٌ',type:'2'},
                    // {word:'نَشيطٌ',type:'2'}
                ]
            },
            {
                text:'عُصْفورٌ في الْيَدِ خَيْرٌ مِنْ عَشْرَةٍ عَلى الشَّجَرَةِ',
                answer:[
                    {word:'عُصْفورٌ',type:'1'},
                    {word:'خَيْرٌ',type:'2'},
                    // {word:'خَيْرٌ',type:'2'}
                ]
            },
            {
                text:'اللَّوحَةُ التي رَسَمَها أَخي جَميلَةٌ',
                answer:[
                    {word:'اللَّوحَةُ',type:'1'},
                    {word:'جَميلَةٌ',type:'2'},
                    // {word:'جَميلَةٌ',type:'2'}
                ]
            }
        ];
    var cloumnsList=[
            {title:'الْمُبْتَدَأُ'},
            {title:'الْخَبَرُ'}
            // {title:'الْخَبَر 2ُ'}
        ];
    // var answer=[
    //     {word:'الصِّدْقُ',type:'1',sentence:'1'},
    //     {word:'فَضيلَةٌ',type:'2',sentence:'1'},
    //     {word:'الْبَحْرُ',type:'1',sentence:'2'},
    //     {word:'هادِئٌ',type:'2',sentence:'2'},
    //     {word:'الْفَلّاحُ',type:'1',sentence:'3'},
    //     {word:'نَشيطٌ',type:'2',sentence:'3'},
    //     {word:'عُصْفورٌ',type:'1',sentence:'4'},
    //     {word:'خَيْرٌ',type:'2',sentence:'4'},
    //     {word:'اللَّوحَةُ',type:'1',sentence:'5'},
    //     {word:'جَميلَةٌ',type:'2',sentence:'5'},
    // ]
    var mainTitle="أُعَيِّنُ الْمُبْتَدَأَ وَالْخَبَرَ في الْجُمَلِ التّاليَةِ:";
    var subTitle="الجمل";

    $(document).on('click','.jq_editi',function () {
        $(this).hide();
        $(this).closest(".text-container").find(".jq_savei").show();
        $(this).closest(".text-container").find(".text-inner-item").hide();
        $(this).closest(".text-container").find(".all-text").css("display","table");
    });
    $(document).on('click','.jq_savei',function () {
        $(this).hide();
        $(this).closest(".text-container").find(".jq_editi").show();
        $(this).closest(".text-container").find(".all-text").hide();
        $(this).closest(".text-container").find(".text-inner-item").show();
        var splitText=$(this).closest(".text-container").find(".all-text span").text().split(" ");
        var html='';
        $(this).closest(".text-container").find(".text-inner-item").html(" ");
        for(var i=0;i<splitText.length;i++){
            html+='<div class="drag-item drag-'+(i+1)+'" data=""><span data="'+splitText[i]+'" class="jq_editable">'+splitText[i]+'</span></div>'
        }
        $(this).closest(".text-container").find(".text-inner-item").html(html);
        drag();
    });
    $(document).on('click','.jq_deletei',function () {
        var sentence=$(".text-item").length;
        if(sentence>3){
            $(this).closest(".text-item").remove();
            reArrangAll()
        }
    })
    $(document).on('click','.jq_add_sentence',function () {
        var sentence=$(".text-item").length;
        var dropNu=$(".table-title").length;
        var html2='';
        var text='أكتب هنا';
        var html='<div class="text-item item-'+(sentence+1)+'"><a class="jq_deletei"></a><div class="text-container"><div class="dot"></div>' +
                 '<a class="jq_editi"></a><a class="jq_savei"></a><div class="all-text"><span class="jq_editable">أكتب هنا</span></div>' +
                 '<div class="text-inner-item" data="'+(sentence+1)+'">';
        var sentenceSplit=text.split(" ");
        console.log("sentenceSplit<<<>>>"+sentenceSplit)
        for(var i=0;i<sentenceSplit.length;i++){
            html2+='<div class="drag-item drag-'+(i+1)+'" data=""><span data="'+sentenceSplit[i]+'">'+sentenceSplit[i]+'</span></div>';
        }
        var htmldrop='';
        html=html+html2;
        $(".text-main-container").append(html);
        if(dropNu==1){
                htmldrop='';
                htmldrop='<div class="drop-container">';
                htmldrop+='<div class="drop-item drop-1" no="1" data=""><span></span></div></div>';
                $(".item-"+(sentence+1)).append(htmldrop);
        }else if(dropNu==2){
                htmldrop='';
                htmldrop='<div class="drop-container">';
                htmldrop+='<div class="drop-item drop-1" no="1" data=""><span></span></div>' +
                    '<div class="drop-item drop-2" no="2" data=""><span></span></div></div>';
            $(".item-"+(sentence+1)).append(htmldrop);
        }else if(dropNu==3){
                htmldrop='';
                htmldrop='<div class="drop-container">';
                htmldrop+='<div class="drop-item drop-1" no="1" data=""><span></span></div>' +
                    '<div class="drop-item drop-2" no="2" data=""><span></span></div>'+
                    '<div class="drop-item drop-3" no="3" data=""><span></span></div></div>';
            $(".item-"+(sentence+1)).append(htmldrop);
        }
        reArrangAll()
        drag();

    })
    $(document).on('click','.jq_deletei_col',function () {
        var tableTitle=$(".table-title").length;
        if(tableTitle>1){
            $(".title-"+$(this).attr("no")).remove();
            $(".drop-item[no='"+$(this).attr('no')+"']").remove();
            reArrangAll();
        }

    })
    
    $(document).on('click','.jq_add_cloumn',function () {
        var tableTitle=$(".table-title").length;
        if(tableTitle<3){
            $(".table-header").append('<div class="table-title title-'+(tableTitle+1)+'"><a class="jq_deletei_col" no="'+(tableTitle+1)+'"></a><span class="jq_editable">أكتب هنا</span></div>');
            $(".drop-container").append('<div class="drop-item drop-1 ui-droppable" no="'+(tableTitle+1)+'" data=""><span></span></div>');
        }

        switch ($(".table-title").length) {
            case 1:
                $(".main-drop-container").css({"width":"21.2%","left":"2.59%"});
                $(".sub-title-container").css("width","73.9%");
                $(".table-title").css({"width":"100%"});
                $(".text-container").css("width","77.8%");
                $(".drop-container").css("width","22.2%");
                $(".drop-item").css("width","100%");
                break;
            case 2:
                $(".main-drop-container").css({"width":"42.2%","left":"2.69%"});
                $(".sub-title-container").css("width","52.8%");
                $(".table-title").css({"width":"50%"});
                $(".text-container").css("width","55.3%");
                $(".drop-container").css("width","44.4%");
                $(".drop-item").css("width","50%");
                break;
            case 3:
                $(".main-drop-container").css({"width":"54.7%","left":"2.59%"});
                $(".sub-title-container").css("width","40.4%");
                $(".table-title").css({"width":"33.3%"});
                $(".text-container").css("width","42.6%");
                $(".drop-container").css("width","57.4%");
                $(".drop-item").css("width","33.33%");
                $(".drop-item span").css("font-size","3.3vmin");
                $(".table-title:nth-child(2)").css("border-left","0.5px solid #ffffff");
                break;
        }
    });
    function reArrangAll()  {
        var i=1;
        var x=1;
        var y=1;
        $(".table-title").each(function () {
            $(this).attr('class','table-title title-'+(i).toString());
            $(this).find(".jq_deletei_col").attr("no",i)
            i++;
        });
        $(".text-item").each(function () {
            $(this).attr('class','text-item item-'+(x).toString());
            x++;
        })
        $(".text-item").each(function () {
            var dropLength=$(this).find(".drop-item").length;
            switch (dropLength){
                case 1:
                    $(this).find(".drop-item").attr("no",1);
                    break;
                case 2:
                    $(this).find(".drop-item:nth-child(1)").attr("no",1);
                    $(this).find(".drop-item:nth-child(2)").attr("no",2);
                    break;
                case 3:
                    $(this).find(".drop-item:nth-child(1)").attr("no",1);
                    $(this).find(".drop-item:nth-child(2)").attr("no",2);
                    $(this).find(".drop-item:nth-child(3)").attr("no",3);
                    break;
            }
        });
        switch ($(".table-title").length) {
            case 1:
                $(".main-drop-container").css({"width":"21.2%","left":"2.59%"});
                $(".sub-title-container").css("width","73.9%");
                $(".table-title").css({"width":"100%"});
                $(".text-container").css("width","77.8%");
                $(".drop-container").css("width","22.2%");
                $(".drop-item").css("width","100%");
                break;
            case 2:
                $(".main-drop-container").css({"width":"42.2%","left":"2.69%"});
                $(".sub-title-container").css("width","52.8%");
                $(".table-title").css({"width":"50%"});
                $(".text-container").css("width","55.3%");
                $(".drop-container").css("width","44.4%");
                $(".drop-item").css("width","50%");
                break;
            case 3:
                $(".main-drop-container").css({"width":"54.7%","left":"2.59%"});
                $(".sub-title-container").css("width","40.4%");
                $(".table-title").css({"width":"33.3%"});
                $(".text-container").css("width","42.6%");
                $(".drop-container").css("width","57.4%");
                $(".drop-item").css("width","33.33%");
                $(".drop-item span").css("font-size","3.3vmin");
                $(".table-title:nth-child(2)").css("border-left","0.5px solid #ffffff");
                break;
        }

    }

    function saveGame() {
        var data={};
        var itemList=[];
        var cloumnsList=[];
        // var answer=[];
        var mainTitle='';
        var subTitle='';
        setTimeout(function () {
            var i=0;
            var z=0;
            for (var t=0;t<$(".text-item").length;t++){
                itemList[t]={'text':$(".text-item:nth-child("+(t+1)+")").find(".all-text").text(),'sentence':t+1,
                    for(var x=0;x<$(".text-item:nth-child("+(t+1)+")").find(".drop-item").length;x++){
                    answer[x]={'word':$(".text-item:nth-child("+(t+1)+")").find(".drop-item:nth-child("+(x+1)+") span").text(),'type':x+1,'sentence':t+1};
                }

                };
                // for(var x=0;x<$(".text-item:nth-child("+(t+1)+")").find(".drop-item").length;x++){
                //     answer[x]={'word':$(".text-item:nth-child("+(t+1)+")").find(".drop-item:nth-child("+(x+1)+") span").text(),'type':x+1,'sentence':t+1};
                // }
            }
            $(".table-title").each(function () {
                cloumnsList[cloumnsList.length]={'title':$(this).find("span").text()};
                z++;
            })
        },300);
        mainTitle= $(".title span").text();
        subTitle= $(".sub-title-container span").text();
        setTimeout(function () {
            data["itemList"]=itemList;
            data["cloumnsList"]=cloumnsList;
            data["answer"]=answer;
            data['mainTitle']=mainTitle;
            data['subTitle']=subTitle;
            window.parent.saveGameData(data);
        },500)
    }

    <?php
    if(isset($_SESSION["gameData"][$_GET["id"]]) && $_SESSION["gameData"][$_GET["id"]]!=''){
    ?>
    var data=$.parseJSON('<?=str_replace('\"','\\\\"',$_SESSION["gameData"][$_GET["id"]]);?>');
    var itemList=data['itemList'];
    var cloumnsList=data['cloumnsList'];
    // var answer=data['answer'];
    var mainTitle=data['mainTitle'];
    var subTitle=data['subTitle'];
    console.log('gameData',data);
    <?php
    }else{
    ?>
    var itemList=[
        {
            text:'الصِّدْقُ فَضيلَةٌ',
            answer:[
                {word:'الصِّدْقُ',type:'1'},
                {word:'فَضيلَةٌ',type:'2'},
                // {word:'فَضيلَةٌ',type:'3'}
            ]
        },
        {
            text:'الْبَحْرُ هادِئٌ',
            answer:[
                {word:'الْبَحْرُ',type:'1'},
                {word:'هادِئٌ',type:'2'},
                // {word:'هادِئٌ',type:'2'}
            ]
        },
        {
            text:'الْفَلّاحُ نَشيطٌ في عَمَلِهِ',
            answer:[
                {word:'الْفَلّاحُ',type:'1'},
                {word:'نَشيطٌ',type:'2'},
                // {word:'نَشيطٌ',type:'2'}
            ]
        },
        {
            text:'عُصْفورٌ في الْيَدِ خَيْرٌ مِنْ عَشْرَةٍ عَلى الشَّجَرَةِ',
            answer:[
                {word:'عُصْفورٌ',type:'1'},
                {word:'خَيْرٌ',type:'2'},
                // {word:'خَيْرٌ',type:'2'}
            ]
        },
        {
            text:'اللَّوحَةُ التي رَسَمَها أَخي جَميلَةٌ',
            answer:[
                {word:'اللَّوحَةُ',type:'1'},
                {word:'جَميلَةٌ',type:'2'},
                // {word:'جَميلَةٌ',type:'2'}
            ]
        }
    ];
    var cloumnsList=[
        {title:'الْمُبْتَدَأُ'},
        {title:'الْخَبَرُ'}
        // {title:'الْخَبَر 2ُ'}
    ];
    // var answer=[
    //     {word:'الصِّدْقُ',type:'1',sentence:'1'},
    //     {word:'فَضيلَةٌ',type:'2',sentence:'1'},
    //     {word:'الْبَحْرُ',type:'1',sentence:'2'},
    //     {word:'هادِئٌ',type:'2',sentence:'2'},
    //     {word:'الْفَلّاحُ',type:'1',sentence:'3'},
    //     {word:'نَشيطٌ',type:'2',sentence:'3'},
    //     {word:'عُصْفورٌ',type:'1',sentence:'4'},
    //     {word:'خَيْرٌ',type:'2',sentence:'4'},
    //     {word:'اللَّوحَةُ',type:'1',sentence:'5'},
    //     {word:'جَميلَةٌ',type:'2',sentence:'5'},
    // ]
    var mainTitle="أُعَيِّنُ الْمُبْتَدَأَ وَالْخَبَرَ في الْجُمَلِ التّاليَةِ:";
    var subTitle="الجمل";
    <?php
    }
    ?>

</script>
<body onunload="disconnetLMS();">
<div class="main-container" id="gameConainer">
    <div id="inner-gameContainer" class="inner-gameContainer">
        <div class="header-container">
            <i class="header-img"></i>
            <a class="title-icon"></a>
            <div class="title">
                <span class="jq_editable"></span>
            </div>
        </div>
        <div class="game-container">
            <a class="jq_add_cloumn"></a>
            <div class="main-drop-container">
                <div class="table-header">
                    <!--                <div class="table-title title-1">-->
                    <!--                    <span></span>-->
                    <!--                </div>-->
                    <!--                <div class="table-title title-2">-->
                    <!--                    <span></span>-->
                    <!--                </div>-->
                </div>
                <!--<div class="inner-drop-container">-->
                <!--<div class="left-drop"></div>-->
                <!--<div class="right-drop"></div>-->
                <!--</div>-->
            </div>
            <div class="sub-title-container"><span class="jq_editable"></span></div>
            <div class="text-main-container"></div>
            <a class="jq_add_sentence"></a>
        </div>
        <div class="footer"></div>
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
</html>
