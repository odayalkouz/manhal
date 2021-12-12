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
    <script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>
<!--    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>-->
</head>
<style>

    .mark{
        width: 100%;
    }
</style>
<script>
    window.addEventListener("touchmove", function(event) {event.preventDefault();}, {passive: false} );
    $(window).load(function () {
        setTimeout(function () {
            $(".jq_cell").attr("contenteditable",'true');
        },500);

        $(document).on('keyup','.jq_cell',function () {
            console.log('row',$(this).closest('.drop-item').index());
            $(".drag-item[data='"+$(this).closest('.drop-container').attr('data')+"'][row='"+($(this).closest('.drop-item').index()+1).toString()+"']").find('span').html($(this).html());
        });

        $(document).on('click','.jq_removewanswer',function () {
            $(this).closest('.drag-item').remove();
        });
        $(document).on('click','.jq_add_wanswer',function () {
            $('<div class="drag-item" data="0" row="0" style="height: 30.64%;"><a class="jq_removewanswer"></a><div class="inner-drag-item"><span class="ui-draggable ui-draggable-handle" contenteditable="true">Wrong</span></div></div>').insertBefore('.jq_add_wanswer');
            //drag();
        });

        ck=CKEDITOR.replace('help_editor', {
            width: '100%',
            height: '100%',
            toolbar: [ 'bold', 'italic', 'link', 'undo', 'redo', 'numberedList', 'bulletedList' ]

        });
        // ClassicEditor
        //     .create( document.querySelector( '#help_editor' ), {
        //         toolbar: {
        //             items: [
        //                 'heading', '|',
        //                 'alignment', '|',
        //                 'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
        //                 'link', '|',
        //                 'bulletedList', 'numberedList', 'todoList',
        //                 '-', // break point
        //                 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', '|',
        //                 'code', 'codeBlock', '|',
        //                 'insertTable', '|',
        //                 'outdent', 'indent', '|',
        //                 'imageUpload', 'blockQuote', '|',
        //                 'undo', 'redo'
        //             ],
        //             shouldNotGroupWhenFull: true
        //         },
        //         width: '100%',
        //         height: '100%',
        //     } )
        //     .catch( error => {
        //         console.log( error );
        //     } );

    });
    $(document).ready(function () {
        $(document).on('click','.jq_remove_column',function () {
            $('.drop-container-'+$(this).attr('no')).remove();
            $(".drag-item[data='"+$(this).attr('no')+"']").remove();
            $(this).closest('div').remove();
            setTimeout(function () {
                reArrangAll();
            },150)
        });

        $('.jq_add_cloumn').click(function () {
            if($('.drop-container').length<4) {
                var no = ($('.drop-container').length + 1).toString();
                var html = '';
                var tempid = '';
                var rows = $('.drop-container-1 .drop-item').length;
                $('.title-table-container').append('<div class="title-table-' + no + '" style="display: block"><a class="jq_remove_column" no="' + no + '"></a><span contenteditable="true">cloumn</span></div>');

                html = '<div class="drop-container drop-container-' + no + '" data="' + no + '">';
                for (var i = 1; i <= rows; i++) {

                    tempid='drag'+(no).toString()+'_'+(i).toString();
                    html += '<div class="drop-item drop-' + i + ' ui-droppable" style="margin-bottom: 2.7%;"  rel-id="'+tempid+'"><div class="mark" ></div><span class="jq_cell" contenteditable="true"></span></div>';
                    $('<div class="drag-item" data="'+no+'" row="'+i+'" id="'+tempid+'"><div class="inner-drag-item"><span class="ui-draggable ui-draggable-handle"></span></div></div>').insertBefore('.jq_add_wanswer');
                }
                html += '</div>';
                $('.drop-main-container').append(html);
            }
        });

        $('.jq_add_row').click(function () {
            if($('.drop-container-1 .drop-item').length<5){
                var rowNO=$('.drop-container-1 .drop-item').length+1;
                var i=1;
                var tempid='';
                $(".drop-container").each(function () {
                    tempid='drag'+(i).toString()+'_'+(rowNO).toString();
                    if($(this).attr('data')==1){
                        $(this).append('<div class="drop-item drop-'+rowNO+' ui-droppable" rel-id="'+tempid+'" ><a class="jq_remove_row" data-row="'+rowNO+'"></a><div class="mark"></div><span class="jq_cell"  contenteditable="true"></span></div>');
                    }else{
                        $(this).append('<div class="drop-item drop-'+rowNO+' ui-droppable" rel-id="'+tempid+'" ><div class="mark"></div><span class="jq_cell"  contenteditable="true"></span></div>');
                    }

                    $('<div class="drag-item" id="'+tempid+'" data="'+i+'" row="'+rowNO+'" style="height: 30.64%;"><div class="inner-drag-item"><span class="ui-draggable ui-draggable-handle"></span></div></div>').insertBefore('.jq_add_wanswer');
                    i++;
                });
                setTimeout(function () {
                    drag();
                },100);
            }
        });

        $(document).on('click','.jq_remove_row',function () {
            if($(this).parent().parent().find(".drop-item").length>1){
                $('.drop-'+$(this).attr('data-row')).remove();
                $(".drag-item[row='"+$(this).attr('data-row')+"']").remove();
                setTimeout(function () {
                    reArrangAll();
                },20)
            }

        });
    });

    function reArrangAll() {
        var i=1;
        var x=1;
        var y=1;
        $(".title-table-container div").each(function () {
            $(this).attr('class','title-table-'+(i).toString());
            i++;
        });

        $('.drop-container').each(function () {
            $(this).attr('class','drop-container drop-container-'+(x).toString());
            $(this).attr('data',x);
            y=1;
            $(this).find('.drop-item').each(function () {
                $(this).attr('class','drop-item ui-droppable drop-'+(y).toString());
                oldid=$(this).attr('rel-id');
                newid='drag'+(x).toString()+'_'+(y).toString();

                $('#'+oldid).attr('data',x);
                $('#'+oldid).attr('row',y);
                $('#'+oldid).attr('id',newid);
                $(this).attr('rel-id',newid);
                if(x==1){
                    $(this).find('.jq_remove_row').attr('data-row',y);
                }
                y++;
            })
            x++;
        });
    }

    function saveGame() {
        var itemList=[];
        var drags=[];
        var dropsize=[];
        var worngList=[];
        var cloumns=[];
        var i=0;
        var title='';

        $('.title-table-container div').each(function () {
            if($.trim($(this).find('span').text()) != "") {
                cloumns[cloumns.length]={'title':$(this).find('span').html()};
            }

        });

        $('.drag-item').each(function () {
            if($(this).attr('row')=='0'){
                worngList[worngList.length]= {text:$(this).find('span').html(),type:$(this).attr('data'),row:$(this).attr('row')};
            }else{
                itemList[itemList.length]= {text:$(this).find('span').html(),type:$(this).attr('data'),row:$(this).attr('row')};
            }
        });
        title=$('.header-container span').html();


        setTimeout(function () {
            var data={};
            data['title']=title;
            data['worngList']=worngList;
            data['itemList']=itemList;
            data['cloumns']=cloumns;
            window.parent.saveGameData(data);
        },500)
    }

    <?php
    if(isset($_SESSION["gameData"][$_GET["id"]]) && $_SESSION["gameData"][$_GET["id"]]!=''){
    ?>
    var data=$.parseJSON('<?=str_replace('\"','\\\\"',$_SESSION["gameData"][$_GET["id"]]);?>');
    var itemList=data['itemList'];
    var worngList=data['worngList'];
    var title=data['title'];
    var cloumns=data['cloumns'];
    console.log('gameData',data);
    <?php
    }else{
    ?>
    var itemList=[
        {text:'الصِّدْقُ',type:'1',row:1},
        {text:'الأَمانَةُ',type:'1',row:2},
        {text:'التَّعاوُنُ',type:'1',row:3},
        {text:'التَّسامُحُ',type:'4',row:1},
        {text:'حُبُّ الْخَيْرِ',type:'4',row:2},
        {text:'حُبُّ الْخَيْرِ',type:'4',row:3},
        {text:'الْحِقْدُ',type:'3',row:1},
        {text:'3',type:'3',row:2},
        {text:'3',type:'3',row:3},
        {text:'الْغِشُّ',type:'2',row:1},
        {text:'الْغِشُّ',type:'2',row:2},
        {text:'الْغِشُّ',type:'2',row:3},
    ];
    var worngList=[
        {text:'Wrong1',type:'0',row:0},
        {text:'Wrong2',type:'0',row:0},
        {text:'Wrong3',type:'0',row:0},
    ]
    var title='أُصَنِّفُ الصِّفات';
    var cloumns=[
        {'title':'الصَّديقُ الصِّالحُ'},
        {'title':'الصَّديقُ السّوْء'},
        {'title':'cloumn3'},
        {'title':'cloumn4'},
    ];
    <?php
    }
    ?>
</script>
<body onunload="disconnetLMS();">
<div class="main-container" id="gameConainer">
    <div id="inner-gameContainer" class="inner-gameContainer">
        <div class="header-container">
            <i class="qus-icon"></i>
            <div class="header-title"><span contenteditable="true"></span></div>
            <a class="title-icon"></a>
        </div>
        <a class="jq_add_cloumn"></a>
        <div class="drop-main-container">
            <div class="title-table-container"></div>
            <div class="drop-container drop-container-1" data="1"></div>
            <div class="drop-container drop-container-2" data="2"></div>
            <div class="drop-container drop-container-3" data="3"></div>
            <div class="drop-container drop-container-4" data="4"></div>
        </div>
        <a class="jq_add_row"></a>
        <div class="drag-container"></div>
        <div class="help-main-popup">
            <a class="close"></a>
            <div class="inner-help-popup">
                <div id="help_editor" style="width: 100%;height: 100%"></div>
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
    </div>
</div>
</body>
</html>
