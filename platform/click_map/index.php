<?php
header("Access-Control-Allow-Origin: *");
session_start();
/*
 * Created by Dar Almanhal - Hussam Abu Khadijeh .
 * User: Hussam Abu Khadijeh
 * Date: 18/12/2016
 * Time: 3:30 AM
 */

// for Imanhal
//include_once "../../config.php";


//for Admin manhal
include_once "../config.php";
include_once "../includes/function.php";


$sql = "SELECT * FROM `editors` WHERE `editors`.`gameid`=" . $_GET["id"];

$result = $con->query($sql);
if (mysqli_num_rows($result) < 1) {
    exit("Incorrect game id");
}
$row = mysqli_fetch_assoc($result);
//if(!canEditGame($row)){
//    exit("You don not have permesiion to edit this game");
//}

if (!is_dir("../games/" . $_GET["id"])) {
    @mkdir("../games/" . $_GET["id"]);
}
if (!is_dir("../games/" . $_GET["id"] . "/all")) {
    copyDirectory("temp", "../games/" . $_GET["id"]);
}

if (isset($row["language"]) && $row["language"] != "") {
    if (file_exists('./language/' . $row["language"] . ".xml")) {
        $Localizations = simplexml_load_file('./language/' . $row["language"] . ".xml");
    } else {
        $Localizations = simplexml_load_file('./language/' . "En.xml");
    }
} else {
    $Localizations = simplexml_load_file('./language/' . "En.xml");
}

if (isset($row["language"]) && $row["language"] != "") {
    if (file_exists('themes/' . $row["language"])) {
        $Localizations1 = 'themes/' . $row["language"];
    } else {
        $Localizations1 = 'themes/En';
    }
} else {
    $Localizations1 = 'themes/En';
}

?>
<html>
<script>
    UserId =<?=$row["userid"];?>;

    GameID =<?=$_GET["id"];?>;
    rootPath = "../games/<?=$_GET["id"];?>/";
    lang = '<?=$row["language"];?>'
    var lang1 = '<?=$row["language"];?>'
    langStory = '<?=$row["language"];?>'
    langStory = langStory.toLowerCase()

    var langRes = JSON.parse('<?= json_encode($Localizations); ?>');
    Subtype = '<?//=$row["subtype"];?>//';
</script>


<head>

 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="<?= $Localizations1; ?>/css/shapes.css" rel="stylesheet" type="text/css">
    <link href="css/jquerycss.css" rel="stylesheet" type="text/css">
    <link href="css/manhalloader.css" rel="stylesheet" type="text/css">
    <link href="css/animate.css" rel="stylesheet" type="text/css">
    <link href="css/hover.css" rel="stylesheet" type="text/css">
    <link href="css/keyboard.min.css" rel="stylesheet" type="text/css">
    <link href="css/keyboard.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css"/>
    <script type="text/javascript" src="js/colorpicker.js"></script>
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/manhalLoader.js"></script>
    <script type="text/javascript" src="js/matching.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="js/jquery.keyboard.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript"
            src="js/jquery.keyboard.extension-all.min.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="js/arabic.min.js?random=<?php echo uniqid(); ?>"></script>

    <script type="text/javascript" src="js/shapes.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="js/library.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="js/upload.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="js/grouped.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="js/edit_area/edit_area_full.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="js/trueFalseControl.js?random=<?php echo uniqid(); ?>"></script>

    <script type="text/javascript" src="js/ajax.js"></script>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/audioplayer.css"/>

    <script src="js/audioplayer.js"></script>
    <script>






        (function (doc) {
            var addEvent = 'addEventListener', type = 'gesturestart', qsa = 'querySelectorAll', scales = [1, 1],
                meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

            function fix() {
                meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
                doc.removeEventListener(type, fix, true);
            }

            if ((meta = meta[meta.length - 1]) && addEvent in doc) {
                fix();
                scales = [.25, 1.6];
                doc[addEvent](type, fix, true);
            }
        }(document));
    </script>
    <script type="text/javascript" src="js/editorUI.js"></script>
</head>
<body oncontextmenu="return false;">
<title>Find Object</title>
<div class="ContainerEditor">
    <div class="headerEditor">
        <span class="title-editor floating-left"></span>
        <span class="line-title"></span>
        <div class="game-type floating-left"><span></span></div>
        <div class="top-tools-container floating-right">
            <a class="setting floating-left" onclick="showSetting()" title="<?= $Localizations->Settings ?>"><i></i></a>
            <!--            <div class="separator floating-left"></div>-->
            <a class="lines floating-left" style="display: none" onclick="hideRootLine()"
               title="<?= $Localizations->Showandhiderootline ?>"><i></i></a>
            <!--            <div class="separator floating-left"></div>-->
            <a class="save floating-left" onclick="saveData()" title="<?= $Localizations->Save ?>"><i></i></a>
            <!--            <div class="separator floating-left"></div>-->
            <a class="preview floating-left" onclick="previewGame()" title="<?= $Localizations->Preview ?>"><i></i></a>
            <a title="<?= $Localizations->Addquestion ?>" class="add-title floating-left"
               onclick="addtitle()"><i></i></a>
            <a title="<?= $Localizations->Addbackground ?>" class="background-image floating-left"
               onclick="bgEditBackground()"><i></i></a>
            <a title="<?= $Localizations->Removebackground ?>" class="transparent-image floating-left"
               onclick="removebackground()"><i></i></a>
        </div>
        <div class="fontDrop">
            <select>
                <option selected>select font</option>
                <option id="fontA">DroidKufi Bold</option>
                <option id="fontB">opensans</option>
            </select>
        </div>
        <div class="inputType">
            <select>
                <option selected>select Input Type</option>
                <option id="inputTypeA">input text</option>
                <option id="inputTypeB">text area</option>
            </select>
        </div>
        <div class="addBackgroundFill">
            <select>
                <option selected><?= $Localizations->AddorRemoveBackground ?></option>
                <option id="addBackgroundFillA"><?= $Localizations->Removebackground ?></option>
                <option id="addBackgroundFillB"><?= $Localizations->AddBackground ?></option>
            </select>
        </div>
        <div class="fillType">
            <select>
                <option selected>select Fill Type</option>
                <option id="fillTypeA">Word or Number</option>
                <option id="fillTypeB">Sentence</option>
            </select>
        </div>
    </div>


    <div class="setting-popup setting-popup-group">
        <div class="header-popup">
            <i class="floating-left"></i>
            <label class="floating-left"><?= $Localizations->Groups ?></label>
        </div>
        <div class="tools-container group-container">
            <div class="line-row opacity">
                <div class="icon-tools floating-left"></div>
                <div class="toolsContainer floating-left">

                </div>
            </div>


            <div class="setting-popup-footer">
                <a class="btn dub" onclick="copyObject()" title="<?= $Localizations->Duplicate ?>"><i></i></a>

            </div>
            <!--            <input type="checkbox" onclick="NoSound()" id="NoSound" name="NoSound" value="sound"> No sound<br>-->
            <!--            <input type="checkbox" onclick="NoHelp()"  id="NoHelp" name="NoHelp" value="help" checked> No help<br>-->

        </div>
    </div>

    <div class="setting-popup setting-elemnt">
        <div class="header-popup">
            <i class="floating-left"></i>
            <label class="floating-left"><?= $Localizations->Properties ?></label>
        </div>
        <div class="tools-container">
            <div class="line-row opacity">
                <div class="icon-tools floating-left"></div>
                <div class="toolsContainer floating-left">
                    <input class="floating-left" type="range" id="opacityObject" min="0" max="1" step=".1"
                           onchange="onOpacityChange(this)" oninput="onOpacityChange(this)">
                    <div class="rang-number floating-left"><span>35%</span></div>
                </div>
            </div>
            <div class="line-row front-back">
                <div class="icon-tools floating-left"></div>
                <div class="toolsContainer floating-left toolsContainer-b">
                    <div class="btn-container"><a class="btn bringTo-front floating-left" onclick="BringToFront()"
                                                  title="<?= $Localizations->BringtoFront ?>"><i></i></a><label
                                class="floating-left"><?= $Localizations->BringtoFront ?></label></div>
                    <div class="btn-container"><a class="btn bringTo-forward floating-left" onclick="BringForward()"
                                                  title="<?= $Localizations->BringForward ?>"><i></i></a><label
                                class="floating-left"><?= $Localizations->BringForward ?></label></div>
                    <div class="btn-container"><a class="btn sendTo-back floating-left" onclick="SendToBack()"
                                                  title="<?= $Localizations->SendtoBack ?>"><i></i></a><label
                                class="floating-left"><?= $Localizations->SendtoBack ?></label></div>
                    <div class="btn-container"><a class="btn send-backward floating-left" onclick="SendBackward()"
                                                  title="<?= $Localizations->SendBackward ?>"><i></i></a><label
                                class="floating-left"><?= $Localizations->SendBackward ?></label></div>
                    <div class="btn-container"><a class="btn flip-object-horizontal floating-left"
                                                  onclick="flipObject()" title="<?= $Localizations->Flip ?>"><i></i></a><label
                                class="floating-left"><?= $Localizations->Flip ?></label></div>
                </div>
            </div>
            <div class="setting-popup-footer">
                <a class="btn dub" onclick="copyObject()" title="<?= $Localizations->Duplicate ?>"><i></i></a>
                <a class="btn remove" onclick="removeFile(this)" title="<?= $Localizations->Remove ?>"><i></i></a>
                <a class="btn setting" onclick="showProprties()"
                   title="<?= $Localizations->ElmentSetting ?>"><i></i></a>
            </div>
            <!--            <input type="checkbox" onclick="NoSound()" id="NoSound" name="NoSound" value="sound"> No sound<br>-->
            <!--            <input type="checkbox" onclick="NoHelp()"  id="NoHelp" name="NoHelp" value="help" checked> No help<br>-->

        </div>
    </div>


    <div class="work-area">
        <div class="leftPanelTools">
            <!--            <div class="tools-header">-->
            <!--                <span>Tools</span>-->
            <!--            </div>-->
            <!--            <div class="dash-top"></div>-->

            <a title="<?= $Localizations->Upload ?>" class="btn upload-image"
               onclick="simulateUpload($('#uploadImageObject'))"><i></i></a>
            <a title="<?= $Localizations->Addemptyelement ?>" class="btn add-area"
               onclick="addTransparentLayer()"><i></i></a>
            <a title="<?= $Localizations->Addanswerbox ?>" class="btn add-text" onclick="addTextBox()"
               style="display: none"><i></i></a>
            <a title="<?= $Localizations->Library ?>" class="btn library" onclick="createThumbs()"><i></i></a>
            <a title="<?= $Localizations->Groups ?>" class="btn group" onclick="showGroup()"><i></i></a>
            <!--            <textarea id="ipad" ></textarea>-->

        </div>
        <div id="gameContainer" class="gameContainer">
            <div class="gameContent">
                <div class="x-guide"></div>
                <div class="y-guide"></div>

                <div class="objectx"></div>
                <div class="objecty"></div>
            </div>
            <div id="guide-h" class="guide"></div>
            <div id="guide-v" class="guide"></div>
        </div>
        <span class="logo clear floating-right"></span>
    </div>

    <div class="inputContainer">


        <input type="file" class="inputHide" id="uploadBackground" UploadType="uploadBackground"
               onchange="UploadType='uploadBackground';getImageLocal(this)" name="upload" accept="image/*">
        <input type="file" class="inputHide" id="uploadImageObject" UploadType="uploadImageObject"
               onchange="UploadType='uploadImageObject';getImageLocal(this)" name="upload" accept="image/*">
        <input type="file" class="inputHide" id="uploadIconTitle" UploadType="uploadIconTitle"
               onchange="UploadType='uploadIconTitle';getImageLocal(this)" name="upload" accept="image/*">
        <input type="file" class="inputHide" id="uploadBackgroundSound" UploadType="BackgroundSound"
               onchange="UploadType='BackgroundSound';getImageLocal(this)" name="upload" accept="audio/*">
        <input type="file" class="inputHide" id="uploadsoundObject" UploadType="uploadsoundObject"
               onchange="UploadType='uploadsoundObject';getImageLocal(this)" name="upload" accept="audio/*">
    </div>
</div>
</body>
</html>

<script>
    if(game.langauge == "" || typeof game.langauge == undefined){
        game.langauge=langStory
    }


    $('#ipad')
        .keyboard({
            layout: {layout: 'arabic-azerty'},
            customLayout: {
                'normal': [
                    // "n(a):title_or_tooltip"; n = new key, (a) = actual key, ":label" = title_or_tooltip (use an underscore "_" in place of a space " ")
                    'is are',
                    '{accept} {cancel} {bksp}'
                ]
            },
            usePreview: false // no preveiw
        });
</script>
