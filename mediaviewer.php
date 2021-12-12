<script src="https://www.manhal.com/js/jquery.js"></script>
<script src="https://www.manhal.com/js/scorm.js"></script>
<script src="https://www.manhal.com/viedoplayer/dist/plyr.js"></script>

<link rel="stylesheet" type="text/css" href="https://www.manhal.com/viedoplayer/dist/plyr.css">

<!--<script src="https://www.manhal.com/js/jquery.js"></script>-->
<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 07/03/2019
 * Time: 11:11 ص
 */
if(isset($_GET["path"]) && $_GET["path"]!=''){
    if($_GET["type"]=='video'){
        ?>
        <video controls autoplay crossorigin id="media_video" width="100%" height="98%">
            <source src="<?=$_GET["path"];?>" type="video/mp4">
        </video>
        <script>
            $(document).ready(function(){
                var vid = document.getElementById("media_video");
                //vid.css("height","98%");
                player = new Plyr(vid);
                vid.onended = function() {
                    setScormValue();
                };
            });

        </script>
<?php
    }elseif($_GET["type"]=='audio'){
        ?>
        <audio id="media_audio" controls>
            <source src="<?=$_GET["path"];?>" type="audio/mp3">
        </audio>
        <script>
            var vid = document.getElementById("media_audio");
          //  vid.css("height","98%");
            player = new Plyr(vid);
            vid.onended = function() {
                    setScormValue();
                };
        </script>
<?php
    }elseif($_GET["type"]=='story'){
        $_GET["id"]=$_GET["path"];
        $_GET["storyid"]=$_GET["path"];
        $scorm=true;
        include_once "platform/config.php";
        if($_GET["id"]>800){//new viewer
            include "platform/stories/demo/index.php";
        }else{//old viewer
            include "platform/stories/demo/index.php";
        }
        ?>
        <script>
            $(document).ready(function(){
                setScormValue();
                $(document).on("click",".swiper-button-next",function(){
                   setTimeout(function(){
                       if($(".swiper-button-next").hasClass("swiper-button-disabled")){
                      //     setScormValue();
                       }
                   },600);
                });
            });
        </script>
<?php
    }
}
?>
<script>
    //scorm
    GetAPI(window);
    if(API!=null){
        if(API.Initialize("")){
            LMSStatus=true;
            API.SetValue("cmi.score.min",0);//to set min score in the game
            API.SetValue("cmi.score.max",100);//to set max score in the game
        }
    }
function setScormValue(){
    if(LMSStatus){
        API.SetValue("cmi.score.raw",100);//return text true or false | to set student mark
        API.SetValue("cmi.completion_status","completed");//when complete game
        API.SetValue("cmi.success_status",100);//when complete game set value to one of ("passed","failed","unknown")
        API.SetValue("cmi.session_time",0);//to set Amount of seconds that the learner has spent
        API.Commit("");//return text true or false | to save student mark to DB
    }
}
</script>

