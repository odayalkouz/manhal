<?php
if(isset($_GET["voice"]) && $_GET["voice"]!="" && $_GET["voice"]!="0"){

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Annotate the playlist with timed text segments. Drag boundries to adjust timing. Enhance the annotation editing process with custom user defined functionality. Aeneas support.">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/main.css">
  <link rel="canonical" href="https://naomiaro.github.io/waveform-playlist/annotations.html">
  <link rel="alternate" type="application/rss+xml" title="Waveform Playlist" href="https://naomiaro.github.io/waveform-playlist/feed.xml">
  <link rel="stylesheet" type="text/css" href="css/layout.css">
  <script type="text/javascript" src="js/jscolor.js"></script>

  <style>
    .playlist .annotations .annotations-text .annotation:nth-child(odd){
        background-color: #e0eff19c;
    }
    .playlist .annotations .annotation-box .id{
        line-height: 30px;
    }
    .playlist .annotations .annotation-box .resize-handle{
        background: transparent;
        /*width: auto !important;*/
        /*height: auto !important;*/
    }
    .fa {
        color: #7dbf4f;
    }
    .btn {
        color: #7dbf4f !important;
        background-color: #fff !important;
        border-color: #ccc !important;
    }
    .playlist .annotations .annotations-text{
        height: 229px;
    }
    .annotation-box::before {
        content: '';
        position: absolute;
        bottom: 0;
        width: 1px;
        background: #76c0ff;
        height: 100%;
        min-height: 172px;
        left: -2px;
        z-index: 999;
    }
    .annotation-box::after {
        content: '';
        position: absolute;
        bottom: 0;
        width: 1px;
        background: #76c0ff;
        height: 100%;
        min-height: 172px;
        right: -2px;
        z-index: 999;
    }
    /*.playlist .annotations .annotations-boxes {*/
    /*    height: 30px !important;*/
    /*    position: absolute!important;*/
    /*    bottom: 0!important;*/
    /*    z-index: 999999!important;*/
    /*}*/
    /*.annotations-boxes-wrapper*/
    /*{*/
    /*    overflow-x: auto!important;*/
    /*    position: relative!important;*/
    /*    height: 190px!important;*/
    /*}*/
    /*  .annotations*/
    /*  {*/
    /*      margin:  -150px 0 0 0!important;*/
    /*  }*/
</style>

  </head>
  <body>
    <div class="container" style="width: 100%!important;padding: 20px">
  <div class="wrapper">
    <article class="post">
      <div class="post-content">
<div id="top-bar" class="playlist-top-bar">
  <div class="playlist-toolbar">
    <div class="btn-group">
      <span class="btn-pause btn btn-warning"><i class="fa fa-pause"></i></span>
      <span class="btn-play btn btn-success"><i class="fa fa-play"></i></span>
      <span class="btn-stop btn btn-danger"><i class="fa fa-stop"></i></span>
      <span class="btn-rewind btn btn-success"><i class="fa fa-fast-backward"></i></span>
      <span class="btn-fast-forward btn btn-success"><i class="fa fa-fast-forward"></i></span>
    </div>
    <div class="btn-group">
      <span title="zoom in" class="btn-zoom-in btn btn-default"><i class="fa fa-search-plus"></i></span>
      <span title="zoom out" class="btn-zoom-out btn btn-default"><i class="fa fa-search-minus"></i></span>
      <span title="Download the annotations as json" class="btn-annotations-download btn btn-default">Save</span>
    </div>
      <div class="btn-group">
          <div class="form-group">
              <div class="form-line">
                  <div class="col-form col-lg-3 col-md-3 col-sm-3 col-xs-12 float-left">
                      <label>Hightlight</label>
                  </div>
                  <div class="col-form col-lg-9 col-md-9 col-sm-9 col-xs-12 float-left">
                      <input class="backgroundvalue2 target jscolor jscolor-active" id="bg_Text_hightlight" style="background-color: rgb(255, 255, 255); background-image: none; color: rgb(0, 0, 0);" color="7dc04d" autocomplete="off">
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<div id="playlist"></div>
      </div>
    </article>
  </div>
</div>
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/waveform-playlist.var.js"></script>
    <script type="text/javascript">
        function replaceNbsps(str) {
            var re = new RegExp(String.fromCharCode(160), "g");
            return str.replace(re, " ");
        }


        function saveJsonData(output){
            $widget.attr("sync",JSON.stringify(output));
            window.parent.$(".close").click();
        }
        $widget=window.parent.$("#<?=$_GET["id"];?>");
        if($widget.attr("sync")!="undefined" && $widget.attr("sync")!=undefined && $widget.attr("sync")!=""){
            var notes=JSON.parse($widget.attr("sync"));
        }else{
            $txt=replaceNbsps($widget.find(".real-content").text());
            $arr=$txt.split(" ");
            if($arr.length>0){
                var notes=[];
                for (var i=0;i<$arr.length;i++){

                    notes[i]={
                        "begin": (i).toString()+".000",
                        "children": [],
                        "end": (i+1).toString()+".000",
                        "id": "word"+(i).toString(),
                        "language": "eng",
                        "lines": [
                            $arr[i]
                        ]
                    };
                }
            }else{
                var notes = [
                    {
                        "begin": "0.000",
                        "children": [],
                        "end": "2.680",
                        "id": "word1",
                        "language": "eng",
                        "lines": [
                            "-----"
                        ]
                    }]
            }
        }

        var actions = [
            {
                class: 'fa.fa-minus',
                title: 'Reduce annotation end by 0.010s',
                action: (annotation, i, annotations, opts) => {
                var next;
        var delta = 0.010;
        annotation.end -= delta;

        if (opts.linkEndpoints) {
            next = annotations[i + 1];
            next && (next.start -= delta);
        }
        }
        },
        {
        class: 'fa.fa-plus',
            title: 'Increase annotation end by 0.010s',
            action: (annotation, i, annotations, opts) => {
            var next;
            var delta = 0.010;
            annotation.end += delta;

            if (opts.linkEndpoints) {
                next = annotations[i + 1];
                next && (next.start += delta);
            }
        }
        },
        {
        class: 'fa.fa-scissors',
            title: 'Split annotation in half',
            action: (annotation, i, annotations) => {
            const halfDuration = (annotation.end - annotation.start) / 2;

            annotations.splice(i + 1, 0, {
                id: 'test',
                start: annotation.end - halfDuration,
                end: annotation.end,
                lines: ['----'],
                lang: 'en',
            });

            annotation.end = annotation.start + halfDuration;
        }
        },
        {
        class: 'fa.fa-trash',
            title: 'Delete annotation',
            action: (annotation, i, annotations) => {
            annotations.splice(i, 1);
        }
        }
        ];

        var playlist = WaveformPlaylist.init({
            container: document.getElementById("playlist"),
            timescale: true,
            state: 'select',
            samplesPerPixel: 1024,
            colors: {
                waveOutlineColor: '#E0EFF1',
                timeColor: 'grey',
                fadeColor: 'black'
            },
            annotationList: {
                annotations: notes,
                controls: actions,
                editable: true,
                isContinuousPlay: false,
                linkEndpoints: false
            }
        });

        playlist.load([
            {
                src: "<?=$_GET["voice"];?>"
            }
        ]).then(function() {
            //can do stuff with the playlist.
        });

    </script>
<script type="text/javascript" src="js/emitter.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
           window.parent.hideLoader();





        });
    </script>
  </body>

</html>
<?php

}else{
    ?>
    <script src="js/jquery.js"></script>
    <script src="js/WebAudioRecorder.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#update_audio_widget").click(function () {
                window.parent.showLoader();
                if($("#audio_form").find(".audio-sound-setting").find("source").attr("src").toString().search("blob")==-1){
                    $(".jq_storypath").val(window.parent.storyPath);
                    $(".jq_widgetid").val(window.parent.widgetID);
                    $("#audio_form")[0].submit();
                }else{
                    window.fd = new FormData();
                    window.fd.append('audio_file',recorderBlob,"record.mp3");
                    window.fd.append("storypath",window.parent.storyPath);
                    window.fd.append("widgetid",window.parent.widgetID);
                    $.ajax({
                        method: "POST",
                        url: window.parent.SITE_URL+"platform/ajax/storyeditor.php?process=syncupload&ajax=1",
                        data: window.fd,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function (result) {
                            console.log(result);
                            if(result.status==1){
                                console.log("status",result.status);
                                // $("#"+window.parent.widgetID).attr("sound",result.file);
                                // $("#"+window.parent.widgetID).find("source").attr("src",result.source);
                                // $("#"+window.parent.widgetID).find("audio")[0].load();
                                // $(".close").click();

                                window.parent.$("#"+window.parent.widgetID).attr("voice", window.parent.SITE_URL+window.parent.storyPath+"/sound/"+result.sound+'?v=1');
                                showEditor(window.parent.SITE_URL+window.parent.storyPath+"/sound/"+result.sound+'?v=1');
                            }

                            window.parent.hideLoader();
                        }
                    });
                }


            });
            $(".input-file-sound").change(function(e){
                var file = e.currentTarget.files[0];
                var objectUrl = URL.createObjectURL(file);
                var sourceid = $(this).parent().parent().children("audio");
                $(sourceid).prop("src", objectUrl);
            });

            $(document).on("click",".jq_record_sound",function () {

                if($(this).hasClass("recording")){
                    $(this).removeClass("recording");
                    $(this).removeClass("selected");
                    stopRecording($("#jq_record_cont"));
                }else{
                    $(this).addClass("recording");
                    $(this).addClass("selected");

                    startRecording($("#jq_record_cont"));
                }

            });
        });
        function showEditor(voice) {
            window.parent.$("#sync_iframe").attr("src",window.parent.SITE_URL+"storyeditor/sync.php?id=<?=$_GET["id"];?>&voice="+voice);
        }
    </script>

    <form id="audio_form" method="post" enctype="multipart/form-data" action="../platform/ajax/storyeditor.php?process=syncupload" target="hidden_iframe">
        <style>
            .line-row {
                display: block;
                overflow: hidden;
                margin: 20px 0 0 0;
            }
            .line-row label.lbl-data {
                display: inline-block;
                overflow: hidden;
                height: 60px;
                margin: 0 10px 0 20px;
                color: #7dc04d;
                font-size: 17px;
                line-height: 57px;
                font-weight: 700;
                width: 160px;
            }
            .line-row .right-container {
                display: inline-block;
                overflow: hidden;
                min-width: 210px;
                margin: 10px 0 0 0;
            }
            .line-row .radio-container.with-out-width {
                width: auto;
                margin: 0;
            }
            .line-row .radio-container {
                display: inline-block;
                overflow: hidden;
                line-height: 60px;
                margin: 0 10px 0 0;
                width: 25%;
            }
            .floating-left {
                float: left;
            }
            .line-row .delete-image {
                display: inline-block;
                overflow: hidden;
                font-size: 16px;
                color: #fff;
                height: 29px;
                line-height: 29px;
                width: 36px;
                background: #a5a5a5 url(thems/En/images/delete-button-white.svg) no-repeat;
                background-size: 55%;
                background-position: center;
                border-radius: 4px;
                margin: 5px 0 0 10px;
                webkit-transition: all .5s;
                transition: all .5s;
            }
            .line-row .fu-container-a {
                display: inline-block;
                overflow: hidden;
                width: 36px;
                height: 29px;
                line-height: 29px;
                position: relative;
                border-radius: 4px;
                background-image: -moz-linear-gradient(90deg, #d6d6d6 0, #dedede 100%);
                background-image: -ms-linear-gradient(90deg, #d6d6d6 0, #dedede 100%);
                font-size: 16px;
                text-overflow: ellipsis;
                white-space: nowrap;
                margin: 5px 0 0 15px;
                cursor: pointer;
                webkit-transition: all .5s;
                transition: all .5s;
            }
            .line-row .fu-container-a .label-a {
                display: inline-block;
                overflow: hidden;
                font-size: 16px;
                color: #fff;
                height: 29px;
                line-height: 29px;
                margin: 0;
                width: 36px;
                background: #a5a5a5 url(thems/En/images/upload.svg) no-repeat;
                background-size: 53%;
                background-position: 50.6% 43%;
                cursor: pointer;
            }
            .line-row .fu-container-a .label-b {
                display: inline-block;
                overflow: hidden;
                font-size: 16px;
                color: #464646;
                height: 28px;
                line-height: 29px;
                margin: 0;
                text-align: left;
                width: 39px;
                text-overflow: ellipsis;
                white-space: nowrap;
                border-radius: 10px;
            }
            .line-row .fu-container-a input[type=file] {
                display: block;
                overflow: hidden;
                width: 36px;
                height: 29px;
                opacity: 0;
                position: absolute;
                z-index: 1;
                top: -1px;
                left: 0;
                cursor: pointer;
                border: 1px solid #c2c2c2;
                border-radius: 5px;
                cursor: pointer;
            }
            .line-row .radio-container input {
                display: inline-block;
                overflow: hidden;
                height: 60px;
                line-height: 60px;
                margin: 0;
                padding: 0;
                width: 18px;
                cursor: pointer;
            }


            .save {
                display: inline-block;
                overflow: hidden;
                border: solid 1px #62af53;
                border-radius: 8px;
                background-image: -moz-linear-gradient(90deg, #53b035 0, #7ed043 99%);
                background-image: -ms-linear-gradient(90deg, #53b035 0, #7ed043 99%);
                background: #58b436;
                position: relative;
                width: 81px;
                height: 32px;
                z-index: 67;
                line-height: 31px;
                left: 0;
                right: 0;
                top: 0;
                bottom: 0;
                cursor: pointer;
                margin: 12px 10px 0 10px;
                text-align: center;
            }
            .save label {
                display: inline-block;
                overflow: hidden;
                font-size: 18px;
                color: rgba(128, 128, 128, 0);
                text-align: center;
                color: #fff;
                cursor: pointer;
            }

            .record-sound
            {
                display: inline-block;
                overflow: hidden;
                font-size: 16px;
                color: #fff;
                height: 29px;
                width: 36px;
                line-height: 29px;
                background: #a5a5a5 url(thems/En/images/recording-symbol.svg) no-repeat;
                background-size: 55%;
                background-position: center;
                border-radius: 4px;
                margin: 5px 0 0 10px;
                webkit-transition: all 0.7s;
                transition: all 0.7s;
            }
            .record-sound:hover
            {
                background-color: #58b436;
            }
            .record-sound.selected
            {
                background: #a5a5a5 ;
                width: 60px;
            }
            .record-sound .toolbar-button-state {
                color: white;
                display: none;
                height: 30px;
                float: left;
                position: relative;
                width: 21px;
            }


            .toolbar-button-state.recording:after {
                content: '';
                display: block;
                position: absolute;
                top: 50%;
                left: 50%;
                margin: -6px 0 0 -9px;
                width: 12px;
                height: 12px;
                background: #cc0000;
                -moz-border-radius: 7px;
                -webkit-border-radius: 7px;
                border-radius: 7px;
                -webkit-animation: recording 1s infinite linear;
                -moz-box-shadow: inset 0 2px 5px 3px rgba(255, 255, 255, 0.1), inset 0 -2px 5px 3px rgba(0, 0, 0, 0.2), 0 1px 0 rgba(255, 255, 255, 0.2), 0 -1px 0 rgba(0, 0, 0, 0.4);
                -webkit-box-shadow: inset 0 2px 5px 3px rgba(255, 255, 255, 0.1), inset 0 -2px 5px 3px rgba(0, 0, 0, 0.2), 0 1px 0 rgba(255, 255, 255, 0.2), 0 -1px 0 rgba(0, 0, 0, 0.4);
                box-shadow: inset 0 2px 5px 3px rgba(255, 255, 255, 0.1), inset 0 -2px 5px 3px rgba(0, 0, 0, 0.2), 0 1px 0 rgba(255, 255, 255, 0.2), 0 -1px 0 rgba(0, 0, 0, 0.4);
            }
            @-webkit-keyframes recording {
                0%, 49% {
                    background: red;
                }
                50%, 100% {
                    background: darken(red, 15%);
                }
            }
            .record-sound .stop-word
            {
                display: none;
            }
            .record-sound.selected
            {
                padding: 0 5px;
            }
            .record-sound.selected .toolbar-button-state,.record-sound.selected .stop-word
            {
                display: block;
                font-weight: normal;
                font-size: 14px;
            }
            .real-content .record-sound
            {
                display: inline-block;
                overflow: hidden;
                font-size: 16px;
                color: #fff;
                height: 29px;
                line-height: 29px;
                background: url(../images/microphone.svg) no-repeat;
                background-size: 55%;
                background-position: center;
                border-radius: 4px;
                margin: 10px 10px 10px 10px;
                webkit-transition: all 0.7s;
                transition: all 0.7s;
                padding: 16px;
                float: right;
            }
            .real-content .record-sound:hover
            {
                background: #58b436 url(../images/recording-symbol.svg) no-repeat;
                background-size: 55%;
                background-position: center;
            }
            .real-content .record-sound.selected
            {
                background: #a5a5a5;
            }
            .real-content .record-sound .toolbar-button-state {
                color: white;
                display: none;
                height: 30px;
                position: relative;
                width: 21px;
                margin: auto;
                margin: 0 0 0 4px;
            }
            .real-content .toolbar-button-state.recording:after {
                content: '';
                display: block;
                position: absolute;
                top: 50%;
                left: 50%;
                margin: -6px 0 0 -9px;
                width: 12px;
                height: 12px;
                background: #cc0000;
                -moz-border-radius: 7px;
                -webkit-border-radius: 7px;
                border-radius: 7px;
                -webkit-animation: recording 1s infinite linear;
                -moz-box-shadow: inset 0 2px 5px 3px rgba(255, 255, 255, 0.1), inset 0 -2px 5px 3px rgba(0, 0, 0, 0.2), 0 1px 0 rgba(255, 255, 255, 0.2), 0 -1px 0 rgba(0, 0, 0, 0.4);
                -webkit-box-shadow: inset 0 2px 5px 3px rgba(255, 255, 255, 0.1), inset 0 -2px 5px 3px rgba(0, 0, 0, 0.2), 0 1px 0 rgba(255, 255, 255, 0.2), 0 -1px 0 rgba(0, 0, 0, 0.4);
                box-shadow: inset 0 2px 5px 3px rgba(255, 255, 255, 0.1), inset 0 -2px 5px 3px rgba(0, 0, 0, 0.2), 0 1px 0 rgba(255, 255, 255, 0.2), 0 -1px 0 rgba(0, 0, 0, 0.4);
            }
            @-webkit-keyframes recording {
                0%, 49% {
                    background: red;
                }
                50%, 100% {
                    background: darken(red, 15%);
                }
            }
            .real-content .record-sound .stop-word
            {
                display: none;
            }
            .real-content .record-sound.selected
            {
                padding: 0 5px;
            }
            .real-content .record-sound.selected .toolbar-button-state,.real-content .record-sound.selected .stop-word
            {
                display: block;
                font-weight: normal;
                font-size: 14px;
            }



        </style>

        <input type="hidden" class="jq_storypath" name="storypath" value="">
                <input type="hidden" class="jq_widgetid" name="widgetid" value="">
                <input type="hidden" class="jq_is_splitter" name="splitter" value="1">
                <div class="line-row">
                    <label class="lbl-data floating-left text-left big-width">Sound</label>
                    <div class="right-container">
                        <div class="radio-container floating-left with-out-width" id="jq_record_cont">
                            <audio controls="" class="floating-left audio-sound-setting">
                                <source src="" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <div class="fu-container-a floating-left">
                                <label class="floating-left flaticon-cloud148 label-a"></label>
                                <label class="floating-left label-b" id="lblthump_txt"></label>
                                <input class="input-file-sound" type="file" name="audio_file" id="audio_file">
                            </div>
                            <a class="delete-image floating-left jq_delete_sound"></a>
                            <a class="record-sound floating-left jq_record_sound">
                                <span class="toolbar-button-state recording floating-left"></span><span class="floating-left stop-word">stop</span><i class="floating-left"></i>
                            </a>

                        </div>
                    </div>
                </div>
                <a id="update_audio_widget" class="save floating-right"><label>Save</label></a>
            </form>
    <iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;border: 0"></iframe>
<?php
}

?>