<?php
    $cash = "?5";
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>flip card</title>
    <link data-type="favicon" href="https://www.manhal.com/themes/main-Light-green-En/images/favicon.ico?99"
          type="image/x-icon" rel="icon">
    <link rel="stylesheet" href="css/style.css<?= $cash; ?>">
    <link rel="stylesheet" href="css/manhalloader.css">
    <link rel="stylesheet" href="css/animate.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">

    <script type="text/javascript">
        config = {};
        //config.location = parseURLParams(location.href);
        config.id =<?=$_GET["id"];?>;
        config.srcLink = "../../../games/" + config.id + "/all/js/game.js?v=" + Date.now();
        var stringLink = "<script type='text/javascript' src='" + config.srcLink + "'><\/script>"
        document.write(stringLink);
        config.baseUrl = "../../../games/" + config.id + "/all/"
        langStory = "ar"

        console.log(stringLink)
    </script>
    <script src="js/jquery.js"></script>
    <script src="js/howler.core.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/easytimer.min.js"></script>
    <script src="js/game.js<?= $cash; ?>"></script>
    <script src="js/manhalLoader.js"></script>
    <script src="https://www.manhal.com/js/scorm.js"></script>


    <script type="text/javascript">




        flipGameA1 = [
            {id: "1", index: "1", background: "img/A1.svg", sound: "sound/main/A.mp3"},
            {id: "2", index: "2", background: "img/B1.svg", sound: "sound/main/B.mp3"},
            {id: "3", index: "3", background: "img/C1.svg", sound: "sound/main/B.mp3"},
            {id: "4", index: "4", background: "img/D1.svg", sound: "sound/main/F.mp3"},
            {id: "5", index: "5", background: "img/E1.svg", sound: "sound/main/E.mp3"},
            {id: "6", index: "6", background: "img/F1.svg", sound: "sound/main/F.mp3"},
            {id: "7", index: "7", background: "img/G1.svg", sound: "sound/main/G.mp3"},
            {id: "8", index: "8", background: "img/H1.svg", sound: "sound/main/H.mp3"},
            {id: "9", index: "9", background: "img/I1.svg", sound: "sound/main/I.mp3"},
            {id: "10", index: "10", background: "img/J1.svg", sound: "sound/main/J.mp3"},
            {id: "11", index: "11", background: "img/K1.svg", sound: "sound/main/K.mp3"},
            {id: "12", index: "12", background: "img/L1.svg", sound: "sound/main/L.mp3"},
            {id: "13", index: "13", background: "img/M1.svg", sound: "sound/main/M.mp3"}
        ];
        flipGameA2 = [
            {id: "1", index: "1", background: "img/A2.svg", sound: "sound/main/A.mp3"},
            {id: "2", index: "2", background: "img/B2.svg", sound: "sound/main/B.mp3"},
            {id: "3", index: "3", background: "img/C2.svg", sound: "sound/main/B.mp3"},
            {id: "4", index: "4", background: "img/D2.svg", sound: "sound/main/F.mp3"},
            {id: "5", index: "5", background: "img/E2.svg", sound: "sound/main/E.mp3"},
            {id: "6", index: "6", background: "img/F2.svg", sound: "sound/main/F.mp3"},
            {id: "7", index: "7", background: "img/G2.svg", sound: "sound/main/G.mp3"},
            {id: "8", index: "8", background: "img/H2.svg", sound: "sound/main/H.mp3"},
            {id: "9", index: "9", background: "img/I2.svg", sound: "sound/main/I.mp3"},
            {id: "10", index: "10", background: "img/J2.svg", sound: "sound/main/J.mp3"},
            {id: "11", index: "11", background: "img/K2.svg", sound: "sound/main/K.mp3"},
            {id: "12", index: "12", background: "img/L2.svg", sound: "sound/main/L.mp3"},
            {id: "13", index: "13", background: "img/M2.svg", sound: "sound/main/M.mp3"}
        ];


        var games = game[0]
        flipGameA1 = []
        flipGameA2 = []

        for (i = 0; i < games.objects.length; i++) {


            var element = games.objects[i]

            if (element[0] != "removed") {

                if (element.matching.column == "top") {

                    flipGameA1.push({
                        identifire: element.id,
                        hint: element.id,
                        id: flipGameA1.length,
                        background: config.baseUrl + element.src,
                        sound: config.baseUrl + element.sound,
                        index: -1,
                        linkWith: element.matching.linkWith[0]

                    })


                } else { // bottom

                    flipGameA2.push({
                        identifire: element.id,
                        hint: element.id,
                        id: flipGameA2.length,
                        background: config.baseUrl + element.src,
                        sound: config.baseUrl + element.sound,
                        index: -1,
                        linkWith: element.matching.linkWith[0]

                    })

                }


            }
        }


        // get valid answer index
        for (j = 0; j < flipGameA1.length; j++) {

            console.log(i)
            searchForAnswer(j, flipGameA1[j].identifire, function (index) {
                //  console.log( i+" -- Get It " + index)
                flipGameA1[j].index = index
                flipGameA1[i].hint=flipGameA1[j].identifire+"=="+flipGameA2[index].identifire

            }, function (index) { // fail
                //console.log(i+" -- Fail Get It " + index)
            })

        }


        function searchForAnswer(indexBase, identifire, callback, fail) {

            // get valid answer index
            for (i = 0; i < flipGameA2.length; i++) {

                console.log(identifire + " " + flipGameA2[i].linkWith)

                if (identifire === flipGameA2[i].linkWith) {

                    flipGameA2[i].index = indexBase
                    flipGameA2[i].hint=identifire+"=="+flipGameA2[i].identifire
                    callback(i)
                } else {

                    fail(i)


                }

            }


        }

        // flipGameA2 = flipGameA2.filter(obj => obj.index );

        function compare(a, b) {
            // Use toUpperCase() to ignore character casing
            const bandA = a.id;
            const bandB = b.id;

            let comparison = 0;
            if (bandA > bandB) {
                comparison = 1;
            } else if (bandA < bandB) {
                comparison = -1;
            }
            return comparison;
        }


        flipGameA1=   flipGameA1.sort(compare);
        //
         flipGameA2=   flipGameA2.sort(compare);




    </script>


    <script>
        window.addEventListener("touchmove", function (event) {
            event.preventDefault();
        }, {passive: false});
    </script>
</head>
<body onunload="disconnetLMS();">
<div class="main-container" id="gameConainer">
    <div id="inner-gameContainer">
        <div class="start-screen-container">
            <a class="start-button" style="display:none"></a>
            <div class="image-start" style="display:none"></div>
        </div>
        <div class="secound-screen-container" style="display:none">
            <a class="levelA"></a>
            <a class="levelB"></a>
            <a class="levelC"></a>
            <div class="logo-secound"></div>
        </div>
        <div class="main-message-container">
            <div class="inner-message-container">
                <span id="message-icone" class=""></span>
                <span id="feedback" class=""></span>
                <span class="result-text"></span>
                <div class="result-container">
                    <span></span>
                </div>
                <a class="reload" onclick="replyGame()"></a>
                <a class="reload-notime" style="display: none"></a>
                <a class="reload3" style="display:none;"></a>
            </div>
        </div>
        <div class="main-message-container1">
        <div class="inner-message-container1">
            <span id="feedback1" class="wellDonw1"></span>
            <a class="reload2" style="display: inline;"></a>
        </div>
        </div>
        <div class="drop-aria-container" style="display:none">
            <div class="opacity-layer"></div>
            <div class="image-last-logo"></div>
            <div class="transparency-container">
                <div class="top"></div>
                <div class="left"></div>
                <div class="right"></div>
            </div>
            <a class="go-to-home"></a>
            <div class="go-to-home-container">
               <div class='check levelA-home level-open active' level='4'><div class='text-a'>4</div></div>
<!--                <div class="levelA-home"></div>-->
<!--                <div class="levelB-home"></div>-->
<!--                <div class="levelC-home"></div>-->
            </div>
            <div class="num-of-tries"><span>0</span></div>
            <div class="num-of-score"><span>0</span></div>
            <div class="stars-container"></div>
            <div class="meter red">
                <label style="width:100%">
                    <span></span>
                </label>
            </div>
            <div class="Timer"><span>0</span></div>
            <div class="qustion-title">أتعرف إلى أفراد عائلتي!</div>
            <div class="drop-aria" id="drop-aria"></div>
        </div>
    </div>
</div>

<script>


    if(games.titleText == "" || typeof games.titleText == undefined){

        $(".qustion-title").html("لم يتم ادخال عنوان ")

    }else{
        $(".qustion-title").html(games.titleText)

    }



</script>
</body>
</html>
