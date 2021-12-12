<?php
include_once "../config.php";

if(session_status()==PHP_SESSION_NONE){
    session_start();
}


if(isset($_GET['lang']) && $_GET['lang']=="En"){
    $langURL="lang=En";
    setcookie("lang","En");
    $_SESSION["lang"]="En";
}elseif(isset($_GET['lang']) && $_GET['lang']=="Ar"){
    $langURL="lang=Ar";
    setcookie("lang","Ar");
    $_SESSION["lang"]="Ar";
}else{
    if(isset($_COOKIE['lang']) && $_COOKIE['lang']=="Ar") {
        $langURL="lang=Ar";
        setcookie("lang","Ar");
        $_SESSION["lang"]="Ar";
    }else{
        $langURL="lang=En";
        setcookie("lang","En");
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


        window.StoryPages={"sound":"../books/<?=$_GET["bookid"];?>/<?=$_GET["id"];?>.mp3","text":"asdas asd ad a das as ",textAligner:$("#<?=$_GET["id"];?>").find(".doaction").first().attr("text-align"),"pageid":window.pageid};
        //StoryPages.textAligner=JSON.parse('[{"start":0.3,"end":0.5,"attributes":[],"data":{"note":"\u0647\u064e\u0644\u0652 "},"color":"rgba(85,237,8,0.5)","id":"0"},{"start":0.5,"end":0.7,"attributes":[],"data":{"note":"\u0623\u064e\u0646\u0652\u062a\u064e "},"color":"rgba(203,89,228,0.5)","id":"1"},{"start":0.8,"end":1.3,"attributes":[],"data":{"note":"\u0645\u064f\u0633\u0652\u062a\u064e\u0639\u0650\u062f\u0651\u064c "},"color":"rgba(191,161,214,0.5)","id":"2"},{"start":1.5,"end":2.2,"attributes":[],"data":{"note":"\u0644\u0650\u0644\u0652\u0645\u064f\u0646\u0627\u0641\u064e\u0633\u064e\u0629\u0650 "},"color":"rgba(182,135,93,0.5)","id":"3"},{"start":2.4,"end":2.7,"attributes":[],"data":{"note":"\u0623\u064e\u064a\u0651\u064f\u0647\u0627 "},"color":"rgba(227,72,253,0.5)","id":"4"},{"start":2.8,"end":3.3,"attributes":[],"data":{"note":"\u0627\u0644\u0623\u064e\u0631\u0652\u0646\u064e\u0628\u064f "},"color":"rgba(3,48,140,0.5)","id":"5"},{"start":3.3,"end":4,"attributes":[],"data":{"note":"\u0627\u0644\u0635\u0651\u064e\u063a\u064a\u0631\u064f\u061f "},"color":"rgba(90,162,127,0.5)","id":"6"},{"start":4.6,"end":5,"attributes":[],"data":{"note":"\u0633\u064e\u0623\u064e\u0644\u064e "},"color":"rgba(19,159,141,0.5)","id":"7"},{"start":5.1,"end":5.5,"attributes":[],"data":{"note":"\u0627\u0644\u0652\u0639\u064e\u0645\u0651\u064f "},"color":"rgba(70,47,69,0.5)","id":"8"},{"start":5.5,"end":6.2,"attributes":[],"data":{"note":"\u0645\u0627\u0639\u0650\u0632\u064f\u060c "},"color":"rgba(156,167,161,0.5)","id":"9"},{"start":6.6,"end":7.1,"attributes":[],"data":{"note":"\u0648\u064e\u0631\u064e\u0628\u0651\u064e\u062a\u064e "},"color":"rgba(228,60,233,0.5)","id":"10"},{"start":7.2,"end":7.5,"attributes":[],"data":{"note":"\u0639\u064e\u0644\u0649 "},"color":"rgba(39,77,142,0.5)","id":"11"},{"start":7.5,"end":7.9,"attributes":[],"data":{"note":"\u0631\u064e\u0623\u0652\u0633\u0650 "},"color":"rgba(21,154,202,0.5)","id":"12"},{"start":7.9,"end":8.6,"attributes":[],"data":{"note":"\u0631\u064e\u0646\u0651\u064f\u0648\u0634. "},"color":"rgba(57,31,143,0.5)","id":"13"},{"start":9.8,"end":10.2,"attributes":[],"data":{"note":"\u0644\u0627 "},"color":"rgba(132,156,27,0.5)","id":"14"},{"start":10.2,"end":10.9,"attributes":[],"data":{"note":"\u0623\u064e\u0639\u0652\u0644\u064e\u0645\u064f\u060c "},"color":"rgba(124,152,252,0.5)","id":"15"},{"start":11,"end":11.8,"attributes":[],"data":{"note":"\u0648\u064e\u0644\u0643\u0650\u0646\u0652 "},"color":"rgba(83,89,126,0.5)","id":"16"},{"start":11.9,"end":12.6,"attributes":[],"data":{"note":"\u0633\u064e\u0623\u064e\u0628\u0652\u0630\u064f\u0644\u064f "},"color":"rgba(55,136,122,0.5)","id":"17"},{"start":12.6,"end":13.1,"attributes":[],"data":{"note":"\u0642\u064f\u0635\u0627\u0631\u0649 "},"color":"rgba(11,23,110,0.5)","id":"18"},{"start":13.1,"end":13.7,"attributes":[],"data":{"note":"\u062c\u064f\u0647\u0652\u062f\u064a. "},"color":"rgba(209,81,148,0.5)","id":"19"},{"start":14,"end":14.4,"attributes":[],"data":{"note":"\u0623\u064e\u0646\u0627 "},"color":"rgba(167,69,115,0.5)","id":"20"},{"start":14.4,"end":15,"attributes":[],"data":{"note":"\u0639\u0627\u0632\u0650\u0645\u064c "},"color":"rgba(137,177,141,0.5)","id":"21"},{"start":15,"end":15.2,"attributes":[],"data":{"note":"\u0639\u064e\u0644\u0649 "},"color":"rgba(187,179,220,0.5)","id":"22"},{"start":15.2,"end":15.6,"attributes":[],"data":{"note":"\u0627\u0644\u0652\u0641\u064e\u0648\u0652\u0632\u0650 "},"color":"rgba(28,153,141,0.5)","id":"23"},{"start":15.7,"end":15.9,"attributes":[],"data":{"note":"\u0628\u0650\u0647\u0650. "},"color":"rgba(121,11,169,0.5)","id":"24"}]');
       
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
                    <button class="btn btn-backround" type="button" onclick="ExportToCurrentStory()">
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
