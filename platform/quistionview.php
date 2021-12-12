<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
    header('Location: login.php');

}
include_once('config.php');
include_once('includes/language.php');
include_once('includes/function.php');

function removeQuizRabish($data){
    $data = preg_replace('/<label\b[^>]*>/', '', $data);
    $data = preg_replace('/<\/label\b[^>]*>/', '', $data);
    $data = preg_replace('/<input type="radio" \b[^>]*>/', '', $data);
    $data=str_replace('<input type="hidden">',"",$data);
    $data=str_replace('id="dr"' ,"",$data);
    $data=str_replace('id="dl"',"",$data);
    $data=str_replace('class="resizable draggable element"',"",$data);
    $data=str_replace('<span class="check"></span>',"",$data);
    return $data;
}
$sql = "Select   * From   questions  where quizid='" . $_GET['id'] . "' and quistionid='" . $_GET['qid'] . "'";
$result = $con->query($sql);
if (mysqli_num_rows($result) > 0) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($result))
    {
        $data = " <div class='line-row'><label class='question-label floating-left'>" . $row['question'] . "</label>";
        $data_array = "";
        switch ($row['type']) {
            case 1:
                $a = json_decode($row['answer'], true);
                $data .= "<div class='answer-container'><div class='section-radio'><ul>";
                for ($x = 0; $x < count($a); $x++) {
//                    $data .= "<label for='answer_" . $x . "' class='floating-left content-list'><label class='input-control radio floating-left' >";
//                    $data .= "<input type='hidden' value='" . $a[$x]['C'] . "'>";
//                    $data .= "<input type='radio' name='question' id='answer_" . $x . "' checked='checked' class='level_radio' value='" . $a[$x]['C'] . "'>";
//                    $data .= "<span class='check'></span>";
//                    $data .= "</label>";
                    $data .= "<label for='answer_" . $x . "' class='font-text text-left floating-left content-list' >" . $a[$x]['A'] . "</label>";
                    $data .= '<script>$(document).ready(function(){$("#viewquistion_container").css("height", "auto") });</script>';
                }
                $data .= "</div><input type='button' id='submit' onclick='correct(" . $row['type'] . ")' value='" . $Lang->Correct . "' >";
                break;
            case 2:
                $a = json_decode($row['answer'], true);
                $data .= "<div class='answer-container'><div class='section-radio'><ul>";
                for ($x = 0; $x < count($a); $x++) {
                    $data .= "<label for='answer_" . $x . "' class='floating-left content-list'><label class='input-control radio floating-left' >";
                    $data .= "<input type='hidden' value='" . $a[$x]['C'] . "'>";
                    $data .= "<input type='radio' name='question' id='answer_" . $x . "' checked='checked' class='level_radio' value='" . $a[$x]['C'] . "'>";
                    $data .= "<span class='check'></span>";
                    $data .= "</label>";
                    $data .= "<label for='answer_" . $x . "' class='font-text text-left floating-left' >" . $a[$x]['A'] . "</label></label>";
                    $data .= '<script>$(document).ready(function(){$("#viewquistion_container").css("height", "auto") });</script>';
                }
                $data .= "</div><input type='button' id='submit' onclick='correct(" . $row['type'] . ")' value='" . $Lang->Correct . "' >";
                break;
            case 3:
                $a = json_decode($row['answer'], true);
                $data .= "<div class='answer-container'><div class='section-check'><ul>";
                for ($x = 0; $x < count($a); $x++) {
                    $data .= "<label  class='floating-left content-list'>";
                    $data .= "<label class='input-control checkbox floating-left' >";
                    $data .= "<input type='checkbox' value='" . $a[$x]['C'] . "' id='answer_" . $x . "' name='question'>";
                    $data .= "<span class='check'></span>";
                    $data .= "</label>";
                    $data .= "<label for='answer_" . $x . "' class='font-text floating-left' >" . $a[$x]['A'] . "</label></label>";
                    $data .= '<script>$(document).ready(function(){$("#viewquistion_container").css("height", "auto") });</script>';
                }
                $data .= "</ul></div><input type='button' id='submit' onclick='correct(" . $row['type'] . ")' value='" . $Lang->Correct . "' >";
                break;
            case 4:
                $a = json_decode($row['answer'], true);
                $data .= "<div class='answer-container'>";
                $data .= " <div class='line-row floating-left'>";
                $data .= " <input type='text'  id='answer' class='input-answer floating-left'></div>";
                $data .= "</div><input type='button' id='submit' onclick='correct(" . $row['type'] . "," . $row['answer'] . ")' value='" . $Lang->Correct . "' >";
                $data .= '<script>$(document).ready(function(){$("#viewquistion_container").css("height", "auto") });</script>';
                break;
            case 5:

               /* $data .= "<div class='matching-container' style='height:450px'><div class='gameConainer'> <div class='insideDiv'><canvas id='canvas'></canvas><div class='coloumn1'><div class='coloumn1Element'></div></div><div class='coloumn2'><div class='coloumn2Element'></div></div></div></div></div>";
                $data_array = "var matchingArray=[" . $row['answer'] . "]";;
                $data .= "<input class='matching-input' type='button' id='submit' onclick='correct(" . $row['type'] . ")' value='" . $Lang->Correct . "'/>";
                $data .= '<script>$(document).ready(function(){$("#viewquistion_container").css("height", "530px");object_match=new MatchingOOP("object_match",1,"col1A",2);});</script>';

*/

                $data = " <label class='question-label floating-left'>" . $row['question'] . "</label>";

                $data .= "<div class='answer-content-container'>";
                $data .= " <div class='answer-container'><div class='matching-container' style='height:640px;'><div class='gameConainer'><div class='insideDiv'>";

                $colum1="<div object_match='object_match'  id='column1'  class='coloumn1'><div class='coloumn1Element'>";
                $colum2="<div object_match='object_match'   class='coloumn2'><div class='coloumn2Element'>";


                $answer=json_decode(str_replace('""','"',$row['answer']),1);
                $x=0;

                foreach  ($answer as $value) {

                         $ClmA =removeQuizRabish($value['col1']);
                         $ClmB = removeQuizRabish($value['col2']);
                    $colum1.="<div  attrindex='".$x."' answer='' name='col1A' id='col1".$x."' class='elemMatch colEl1' style='height: 143.4px;'>";
                    $colum1.="<label class='lbl-data-matching' style='pointer-events: none;'>".$ClmA."</label> </div>";
                    $colum2.="<div  attrindex='".$x."' answer='' name='col1A' id='col2".$x."' class='elemMatch colEl2' style='height: 143.4px;'>";
                    $colum2.="<label class='lbl-data-matching' style='pointer-events: none;'>".$ClmB."</label> </div>";
                    $x++;
                }

                $data .= "<canvas id='canvas' width='694' height='777' style='width: 100%; height: 100%;'></canvas>";
                $data .=$colum1;
                $data .="</div></div>";
                $data .=$colum2;
                $data .="</div></div></div>";
                $data .= "</ul></div></div>";
                $data .= '<script>$(document).ready(function(){object_match=new MatchingOOP("object_match","","col1A",'.$x.');});</script>';

                $data .= "<input type='button' id='submit' onclick='checkmatch()' value='" . $Lang->Correct . "' >";

                break;
            case 6:
                $a = json_decode($row['answer'], true);
                $data .= "<div class='answer-container'>";
                $data .= "<div class='dvDest' att='' id='Question'></div>";
                $data .= "<div id='dvSource'>";
                $data .= '<script>$(document).ready(function(){$("#viewquistion_container").css("height", "auto") });</script>';
                for ($x = 0; $x < count($a); $x++) {
                    $data .= " <label class='D dvDest1' id='A" . $x . "' index='" . $a[$x]['C'] . "' > " . $a[$x]['A'] . "</label>";
                }
                $data .= "</div></div><input type='button' id='submit' onclick='correct(" . $row['type'] . ")' value='" . $Lang->Correct . "' >";
                break;
            case 7:
                $a = json_decode($row['answer'], true);
                $data .= "<div id='Question'>";
                for ($x = 1; $x < count($a); $x++) {
                    $data .= "<div  onclick='shopoint(this.id)' id='map_" . $x . "' map='false' style='z-index:9999;width:" . $a[$x]['W'] . "px; height:" . $a[$x]['H'] . "px;position:absolute;left:" . $a[$x]['L'] . "; top:" . $a[$x]['T'] . "'></div>";
                }
                $data .= "</div>";
                $data .= "<div class='mapp-container floating-left'><div  id='ContainerMap' style='background-image:url(" . chr(34) . $a[0]['B'] . chr(34) . "); height: 100%;'></div></div>";
                $data .= "<input class='click-mape-btn' type='button' id='submit' onclick='correct(" . $row['type'] . ")' value='" . $Lang->Correct . "' />";
                $data .= '<script>$(document).ready(function(){$("#viewquistion_container").css("height", "auto") });</script>';
                break;
            case 8:
                $a = json_decode($row['answer'], true);
                $data .= "<div class='answer-container floating-left'>";
                $data .= " <textarea type='text'  id='answer' class='short-essay-text floating-left'> </textarea>";
                $data .= "</div><input type='button' id='submit' onclick='correct(" . $row['type'] . "," . $row['answer'] . ")' value='" . $Lang->Correct . "' >";
                $data .= '<script>$(document).ready(function(){$("#viewquistion_container").css("height", "auto") });</script>';
                break;
            case 9:
                $random = array_shuffle(json_decode($row['answer'], true));
                $data .= "<div class='answer-container'><ul id='sortable'>";
                for ($x = 0; $x < count($random); $x++) {
                    $data .= "<li sort='" . $random[$x]["C"] . "' class='ui-state-default'>" . $random[$x]["A"] . "</i>";
                }
                $data .= "</ul></div><input type='button' id='submit' onclick='correct(" . $row['type'] . ")' value='" . $Lang->Correct . "' >";
                $data .= '<script>$(document).ready(function(){$("#viewquistion_container").css("height", "auto") });</script>';
                break;
        }
        $data .= " </div>";
        $data .= "</div>";
        echo $data;
        $i++;
    }
}
?>
<script type="text/javascript" src="../js/lang.js"></script>

<link rel="stylesheet" href="css/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/sweetalert.css">
<link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/style.css">
<link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/icons.css">
<link rel="stylesheet" type="text/css" href="css/matching_.css">
<style type="text/css">
    .ui-state-default-placeholder {
        overflow: visible;
        height: 40px;
        border: dashed 2px #fff !important;
    }
    #sortable li {
        display: block;
        padding: 2px;
        min-height: 20px;
        width: 100%;
        color: #fff;
        line-height: 28px;
        background: #00AB67;
        border: 1px solid #fff;
        cursor: move;
        font-size: 20px;
        font-weight: bold;
    }
</style>
<script>
    <?php echo $data_array . ";";?>



    function feddbackmsg(correct) {


            if (correct) {
                swal({title: "Correct answer "}, function (isConfirm) {
                    if (isConfirm) {

                    }
                });
            } else {
                swal({title: "Wrong Answer "}, function (isConfirm) {
                    if (isConfirm) {

                    }
                });
            }

    }


    function checkmatch(){

        var Object_avr=checkAnswer(object_match);
        if (Object_avr.count==Object_avr.total) {
            correct = true;
        } else {
            correct = false;
        }
        object_match.activ=false;
        feddbackmsg(correct);
    }
    $(document).ready(function () {

        //$(".input-control").hide();



        $('.jq_multi_file').each(function(){
            console.log( $(this).attr("editor"));
            $(this).attr("src",$(this).attr("editor"));
        });


        var mapwidth = 50;
        var mapwidthhalf=mapwidth/2
        $("#ContainerMap").click(function (event) {
            $("#ContainerMap").append('<div onmouseup="javascriot:$(this).remove()" class="red" onclick="shopoint(this.id)" id="map_1" map="false" style="width:' + mapwidth + 'px; height:' + mapwidth + 'px;position:absolute; left:' + eval((event.pageX ) - $('#ContainerMap').offset().left-mapwidthhalf) + 'px; top: ' + eval((event.pageY  ) - ($('#ContainerMap').offset().top)-mapwidthhalf) + 'px; "></div>')
        });
    });
    function shopoint(value) {
        if ($("#" + value).hasClass('red')) {
            $("#" + value).removeClass('red')
        }
        else {
            $("#" + value).addClass('red')
        }
    }
    $(function () {
        $("#sortable").sortable({
            placeholder: 'ui-state-default-placeholder'
        });
        $("#sortable").disableSelection();
    });
    $(function () {
        $("#dvSource .D").draggable({
            revert: "invalid",
            refreshPositions: true,
            drag: function (event, ui) {
                ui.helper.addClass("draggable");
            },
            stop: function (event, ui) {
                ui.helper.removeClass("draggable");
            }
        });
        $("#Question").droppable({
            drop: function (event, ui) {
                ui.draggable.addClass("dropped");
                $(this).append(ui.draggable);
                $(this).attr('att', $(ui.draggable).attr("index"))
                if ($(this).children('label').get(1) != undefined) {
                    $($(this).children('label').get(0)).removeClass("dropped")
                    $($(this).children('label').get(0)).css("left", "0px")
                    $($(this).children('label').get(0)).css("top", "0px")
                    $("#dvSource").append($(this).children('label').get(0))
                }
            }
        });
    });
</script>
<style>
    video#backgroundvid {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        z-index: -100;
        background: url(polina.jpg) no-repeat;
        background-size: cover;
    }
</style>