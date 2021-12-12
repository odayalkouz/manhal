<?php
include_once "../config.php";

if(session_status()==PHP_SESSION_NONE){
    session_start();
}


if(isset($_GET['lang']) && $_GET['lang']=="En"){
    $langURL="lang=En";
    setcookie("lang","En",time()+COOKIE_EXPIRE,"/");
    $_SESSION["lang"]="En";
}elseif(isset($_GET['lang']) && $_GET['lang']=="Ar"){
    $langURL="lang=Ar";
    setcookie("lang","Ar",time()+COOKIE_EXPIRE,"/");
    $_SESSION["lang"]="Ar";
}else{
    if(isset($_COOKIE['lang']) && $_COOKIE['lang']=="Ar") {
        $langURL="lang=Ar";
        setcookie("lang","Ar",time()+COOKIE_EXPIRE,"/");
        $_SESSION["lang"]="Ar";
    }else{
        $langURL="lang=En";
        setcookie("lang","En",time()+COOKIE_EXPIRE,"/");
        $_SESSION["lang"]="En";
    }
}
$Lang = simplexml_load_file("../../language/".$_SESSION["lang"].".xml");
?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="<?=SITE_URL;?>platform/highlight/js/jquery.js"></script>
    <script type="text/javascript" src="<?=SITE_URL;?>platform/highlight/js/jquery-ui.js"></script>
    <?php
    $sound="";
    ?>
    <script>


        window.StoryPages={"sound":"../books/<?=$_GET["bookid"];?>/<?=$_GET["id"];?>.mp3","text":parent.$("#<?=$_GET["id"];?>").find(".poplinable").text(),textAligner:parent.$("#<?=$_GET["id"];?>").find(".doaction").first().attr("text-align"),"pageid":window.pageid};
        StoryPages.textAligner=JSON.parse(StoryPages.textAligner);
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>برنامج دمج الصوت مع النص</title>
    <link href="data:image/gif;" rel="icon" type="image/x-icon" />

    <!-- Bootstrap -->
    <link href="<?=SITE_URL;?>platform/highlight/css/bootstrap.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=SITE_URL;?>platform/highlight/css/style.css" />
    <link rel="stylesheet" href="<?=SITE_URL;?>platform/highlight/css/ribbon.css" />

    <script type="text/javascript" src="<?=SITE_URL;?>platform/highlight/js/sweetalert.min.js"></script>
    <link href="<?=SITE_URL;?>platform/highlight/css/sweetalert.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?=SITE_URL;?>platform/highlight/css/flaticon.css">

    <style>
        .sorting-popup-main
        {
            display: none;
            overflow: hidden;
            position: absolute;
            left: 0;
            right: 0;
            margin: auto;
            height: 100%;
            top: 0;
            bottom: 0;
            width: 100%;
            /*background: rgba(0,0,0,0.5);*/
            z-index: 1000000;
        }
        .sorting-popup
        {
            display: block;
            overflow: hidden;
            height: 50%;
            background: #fff;
            color: #00AB67;
            z-index: 999999;
            width: 80%;
            border: 1px solid #000;
            box-shadow: 0px 0px 5px #000;
            text-align: center;
            margin: auto;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }
        .sorting
        {
            list-style-type: none;
            margin: 0;
            padding: 15px 7px;
            width: 100%;
            /*position: absolute;*/
            display: block;
            overflow: hidden;
        }
        .sorting li
        {
            margin: 0 3px 3px 3px;
            /* padding: 0.4em; */
            /* padding-left: 1.5em; */
            font-size: 1.4em;
            height: 40px;
            cursor: pointer;
        <?php
        if($row["language"]=="Ar"){
        ?>
            float: right;
        <?php
        }else{
        ?>
            float: left;
        <?php
        }
        ?>

            /* text-align: justify; */
            width: 100px;
            border: 1px solid #00AB67;
            display: inline-block;
            text-align: center;
            direction: rtl;
            line-height: 40px;
            position: relative;
        }
        .sorting li span { position: absolute; margin-left: -1.3em; }
        .save
        {
            display: inline-block;
            overflow: hidden;
            width: 70px;
            height: 35px;
            color: #fff;
            background: #00AB67;
            border-radius: 10px;
            margin: 0 auto 10px;
        }
        .save:hover {
            background: #187D55;
            text-decoration: none;
        }
        .save i:hover {
            color: #fff;
        }
        .save i
        {
            display: block;
            overflow: hidden;
            height: 35px;
            line-height: 35px;
            text-align: center;
        }
        .popup-containt
        {
            display: block;
            overflow-x: hidden;
            overflow-y: auto;
            width: 100%;
            height: calc(100% - 100px);
        }
    </style>
    <!-- wavesurfer.js -->
    <script src="<?=SITE_URL;?>platform/highlight/js/wavsurfer.js"></script>

    <!-- regions plugin -->
    <script src="<?=SITE_URL;?>platform/highlight/js/getData.js"></script>
    <script src="<?=SITE_URL;?>platform/highlight/js/wavesurfer.regions.js"></script>
    <script src="<?=SITE_URL;?>platform/highlight/js/timeline.js"></script>


    <!-- Demo -->
    <script src="<?=SITE_URL;?>platform/highlight/js/main.js"></script>
    <script src="<?=SITE_URL;?>platform/highlight/js/trivia.js"></script>

    <script>
        function saveSound(data){
            parent.$("#<?=$_GET["id"];?>").find(".doaction").first().attr("text-align",JSON.stringify(data.textAligner));
            parent.$("#popup_action").fadeOut();
        }

        $(document).on("click","#update_asound_highlight",function(){
            $("#a_highlighted_sound_form").attr("action","../ajax/editor.php?process=updateasoundhighlight&bookid="+parent.bookid);
            $("#a_highlighted_sound_form").submit();
            parent.showLoading();
        });
    </script>
</head>
<body  >
<div class="popup-container">
    <div class="popup-title-container">
        <label class="floating-right">Audio text aligner</label>
        <a class="floating-left" onclick="parent.closeIframe()"><i class="flaticon-technology"></i></a>
    </div>


    <div class="sortingArrayShow">
        <div class="headerbox">الكلمات المربوطه من النص مع الترتيب
            <button class="btn btn-backround" type="button" onclick="resortArray()">
                <i class="glyphicon flaticon-arrows-4"></i>
            </button>
        </div>
        <div class="sortingArrayShowinner"></div>

    </div>

    <div class="container">



        <div class="container">

            <div id="demo">
                <div id="waveform">
                    <div class="waveformGrid"></div>
                    <div class="progress progress-striped active" id="progress-bar">
                        <div class="progress-bar progress-bar-info"></div>
                    </div>

                    <!-- Here be the waveform -->
                </div>
                <div id="wave-timeline"></div>
                <p id="subtitle" class="text-center text-info">&nbsp;</p>

                <div class="controls">
                    <div class="slider-container">
                        <input data-action="zoom" id="slider" type="range" min="20" max="500" value="0" style="width: 100%">
                    </div>
                    <button class="btn btn-backround" data-action="back">
                        <i class="glyphicon glyphicon-step-backward"></i>
                    </button>
                    <button class="btn btn-backround" data-action="play">
                        <i class="glyphicon glyphicon-play"></i>
                        /
                        <i class="glyphicon glyphicon-pause"></i>
                    </button>
                    <button class="btn btn-backround" data-action="forth">
                        <i class="glyphicon glyphicon-step-forward"></i>
                    </button>
                    <button class="btn btn-backround" data-action="toggle-mute">
                        <i class="glyphicon glyphicon-volume-off"></i>
                    </button>
                    <button class="btn btn-backround" type="button" onclick="ExportToCurrentStory2();">
                        <i class="glyphicon glyphicon-export"></i>
                    </button>
                    <button type="submit" class="btn btn-backround" onclick="removeAllRegions()">
                        <i class="glyphicon flaticon-delete"></i>
                    </button>
                    <div class="nav-pills">
                        <a class="btn btn-backround" href="?fill">Fill</a>
                        <a class="btn btn-backround" href="?scroll">Scroll</a>
                        <a class="btn btn-backround" href="?normalize">Normalize</a>
                    </div>
                    <button class="btn btn-backround" type="button" onclick="resortArray()">
                        <i class="glyphicon flaticon-arrows-4"></i>
                    </button>
                </div>

            </div>

            <div id="textContainer" class="textContainer form-control">
                <div class="headerbox">النص الاصلي</div>
            </div>
            <iframe style="border:0px;width:0px;height:0px;" id="upload_target" name="upload_target"></iframe>

            <form id="a_highlighted_sound_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
                <div class="line-row-b">
                    <label class="lbl-data-a floating-left"><?=$Lang->uploadSound;?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b floating-left" id="lblasoundf"></label>
                        <input id="asoundf" type="file" name="asound">
                    </div>
                </div>
                <div class="line-row-b">
                    <input type="button" class="btn-default floating-right" id="update_asound_highlight" value="<?=$Lang->Update;?>">
                    <input type="hidden" id="asound_id" name="asound_id" value="<?=$_GET['id'];?>">
                </div>
            </form>
            <form role="form" name="edit" style="opacity: 0; transition: opacity 300ms linear; margin: 30px 0;">
                <div class="infoBoxes">
                    <label for="start">Start</label>
                    <input class="" id="start" name="start">
                </div>

                <div class="infoBoxes">
                    <label for="end">End</label>
                    <input class="" id="end" name="end">
                </div>

                <div class="infoBoxes">
                    <label for="note">word</label>
                    <input id="note" class="" rows="3" name="note">
                </div>
                <div>
                    <button type="submit" class="btn btn-backround ">
                        <i class="glyphicon flaticon-diskette"></i>
                    </button>

                    <button type="button" class="btn btn-backround " onclick="removeRegions()" data-action="delete-region">
                        <i class="glyphicon flaticon-delete"></i>
                    </button>
                </div>
            </form>

        </div>
        <p class="lead pull-center" style="display: none" id="drop">
            Drag voice here
            <i class="glyphicon glyphicon-music"></i>-file
            here!
        </p>
    </div>


</div>
<div class="sorting-popup-main">
    <div class="sorting-popup">
        <div class="popup-title-container">
            <label class="floating-right">Audio text aligner</label>
            <a class="floating-left" onclick="closeSortWord()"><i class="flaticon-technology"></i></a>
        </div>
        <div class="popup-containt">
            <div class="sorting"></div>
        </div>
        <a class="save" onclick="SortingNow()"><i class="flaticon-diskette"></i></a>
    </div>
</div>

</body>
</html>
