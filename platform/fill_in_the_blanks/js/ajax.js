/**
 * Created by khalid alomiri on 21/3/2016.
 */
var lastAddId = ""


function setdatafunction() {

    casetype = arguments[0].TypeProcesses;
    $.ajax({
        url: "../ajax/function.php",
        type: "POST",
        data: arguments[0],
        cache: false,
        dataType: 'html',
        casetype: casetype,
        success: function (html) {

          //  console.log(casetype);

            switch (casetype) {
                case "login":
                    if (html == 1) {
                        window.location = 'index.php'
                    } else {
                        swal(window.Lang['SignInError'], window.Lang['SignInErrorMsg'], 'error');
                    }
                    break;
                case "creategame":
                    SetStoryData(html)
                    break;
                case "updateGames":
                  //  saveMessage()
                    break;
                case "RemoveGames":
                    location.reload()
                    break;
                case "split_site":
                    window.location = "story/" + html;
                    removeLoader()
                    break;
                case "getdatagames":
                    data = $.parseJSON('' + html + '')

                    if (data.data == "" || data.data == null) {

                        game = {
                            level: [],
                            levelTitle:[],
                            images:[],
                            backgroundLevel: [],
                            title:"",
                            option:{
                                noBackgrondSound:false
                            },
                            levelIndex: 0,
                            activePointer: 0

                        }//push new level  when array is empty from database
                        game.levelIndex = 0
                        game.level.push([])
                        game.levelTitle.push({title: ""})
                        game.backgroundLevel.push([{full: " ", short: ""}])
                        $("#level-thumb" + 0).click()
                        addLevelLoaded(game.levelIndex);



                    } else {
                        game = $.parseJSON(data.data);
                        drawGame(game.level)
                        game.levelIndex = 0
                        $("#level-thumb" + game.levelIndex).click()
                        //  DrawObjects();
                        // changeBackground("../games/" + config.rootPath + "/images/bg.png")
                        $(".gameContent").click()
                        if ($(".elementResizable ").length) {
                            $(".elementResizable ")[0].click()
                        }
                        if(game.option.fillOff){
                            $(".poent").css({
                                background:"rgba(0,0,0,0)",
                                width:game.option.dotSize+"vw",
                                height:game.option.dotSize+"vw",
                                border:"1px solid "+game.option.colorDots
                            })
                        }else{
                            $(".poent").css({
                                background:game.option.colorDots,
                                width:game.option.dotSize+"vw",
                                height:game.option.dotSize+"vw",
                            })
                        }
                        resizeGame();

                    }

                    $(".activeElementDot").css({
                        background:game.option.colorDots
                    })
                  //  $(".swiper-wrapper").children().first().click()

                    break;
            }
        }

    });
}

function drawGame(arrayOflevel) {
    $("#slider").html("")
    $("#gameContent").html("")
    drawLevels(arrayOflevel)
    //  drawPoints(arrayOflevel)
}

function drawLevels(arrayOflevel) {
    if (typeof arrayOflevel == 'undefined') {
        game.level = []
        addLevel()
        changeBackground(config.rootPath + "/images/" + "bg_" + 0 + ".png?" + Math.random())
        return
    } else {

        for (var a = 0; a < arrayOflevel.length; a++) {


          if(arrayOflevel[a]=="removed")
          {

          }else{
           //   console.log("data draw")

             // console.log(game.backgroundLevel[a].full)
              game.levelIndex = a
              addLevelLoaded(a);
              drawPoints(arrayOflevel[a], a)
              changeBackground(game.backgroundLevel[a].full+"?" + Math.random())
          }


        }

    }

    $("#slider").children(":first").click()
}
counterINdex=1
function drawPoints(arrayOflevel) {
counterINdex=1

    for (var a = 0; a < arrayOflevel.length; a++) {
        if (arrayOflevel[a] == "removed") {

        }
        else {
            counterINdex++
            addobjectLoaded(arrayOflevel[a], a)


        }
    }

}

function addLevelLoaded(index) {

    if ($(".page-thumb").length + 1 > 7) {
        $('#slider').width(135 * ($(".page-thumb").length + 1) + (($(".page-thumb").length + 1) * 10));
    }


    $(".level-inner-container").each(function () {
        $(this).css("display", "none");
    });

    $("<div id='level-" + game.levelIndex + "' class='level-inner-container floating-left'><div class='image-container'><label class='level-number'>"+  +"</label></div></div>").appendTo(".gameContent");

    $("#level-thumb" + game.levelIndex + "").css("display", "block");



    $("<div id='level-" + game.levelIndex + "' class='level-inner-container floating-left'><div class='image-container'></div></div>").appendTo('#level-container');



    $("<div  id='level-thumb" + game.levelIndex + "' onclick='selectLevel(" + game.levelIndex + ")' class='page-thumb floating-left swiper-slide' >"+

        "<img id='imageThumb"+game.levelIndex+"' class='innerThumb' src='"+game.backgroundLevel[index].full+"'>" +
        // "<div>Level "+counterINdex+"</div>"+
        "</div>").appendTo('.swiper-wrapper');



    if(typeof game.backgroundLevel[index].full=="undefined"){
        $("#level-" + index).css(
            {
                'background-image': 'url(images/image.jpg)',
                'background-size': '100% 100%',
                'background-repeat': 'no-repeat'


            })

        $("#imageThumb"+index).attr("src","images/image.jpg")
    }else{

    }


    $("#level-" + index).click()
     swiperThumbs  = new Swiper('.swiper-container', {

        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 10,
         // centeredSlides: true,
         paginationClickable: true,
        spaceBetween: 5,
    });
}
function reinitSwiper() {
    swiperThumbs.resizeFix(true)
}
function addobjectLoaded(arrayOfobject, index) {

    pointnum = index;

    $("<span class='LAbelText'  data-index='" + pointnum + "' data-div='" + pointnum + "' id='span-" + pointnum + "-L" + game.levelIndex + "'></span>")
        .appendTo("#level-" + game.levelIndex).css({
        top: arrayOfobject.top + "%",
        left: arrayOfobject.left + "%"
    }).html(arrayOfobject.word);

    $("<div class='poent'  data-index='" + pointnum + "' data-point='" + pointnum + "' id='point-" + pointnum + "-L" + game.levelIndex + "' >" +
        "<a class='delete-point' onclick='deletePoint(this)'>Delete</a></div>")
        .appendTo("#level-" + game.levelIndex).css({
        top: arrayOfobject.p.y + "%",
        left: arrayOfobject.p.x + "%"
    });
    ;

    $(".image-container span").css("lineHeight", $(".image-container span").height() + "px");

    svgText = '<svg class="svgGroup" xmlns="http://www.w3.org/2000/svg" version="1.1" height="' + $(".level-inner-container").height() + '" width="' + $(".level-inner-container").width() + '">';
    innerSvg = "";
    var parentPos = $(".gameContent").offset();
    var spanPos = $("#span-" + pointnum + "-L" + game.levelIndex).offset();
    var pointPos = $("#point-" + pointnum + "-L" + game.levelIndex).offset();

    objectPosition = {
        x1: spanPos.left - parentPos.left,
        x2: pointPos.left - parentPos.left,
        y1: spanPos.top - parentPos.top,
        y2: pointPos.top - parentPos.top
    };
    xx = "M" + objectPosition.x1 + " " + (objectPosition.y1) + " " + objectPosition.x2 + " " + (objectPosition.y2);
    innerSvg += '<path id="svg-' + pointnum + "-L" + game.levelIndex + '" data-index="' + pointnum + '" data-indexLevel="' + game.levelIndex + '" data-svg="' + pointnum + '" d="' + xx + '" stroke="#959595" stroke-width="2" fill="none" stroke-linecap="round"/>'
    svgText = svgText + innerSvg + "</svg>";
    $(svgText).appendTo("#level-" + game.levelIndex);


    $("#point-" + pointnum + "-L" + game.levelIndex).draggable({
        start: function (event, ui) {
            $(".LAbelText,.poent").removeClass("activeElementDot")
            $(this).addClass("activeElementDot")
            game.activePointer = $(this).data("index")
        },
        containment: "#level-" + game.levelIndex,

        drag: function (event, ui) {
            $(".LAbelText,.poent").removeClass("activeElementDot")
            $(this).addClass("activeElementDot")
            game.activePointer = $(this).data("index")
            reCalculatePoints()

        },
        stop: function (event, ui) {
            game.activePointer = $(this).data("index")
            updateCurrentpointDataP(ui.position)
            object = game.level[game.levelIndex][game.activePointer]
            $(this).css({
                top: object.p.y + "%",
                left: object.p.x + "%",
            })
        }

    }).click(function () {
        event.stopPropagation()
        $(".LAbelText,.poent").removeClass("activeElementDot")
        $(this).addClass("activeElementDot")
        game.activePointer = $(this).data("index")
    })

    $("#span-" + pointnum + "-L" + game.levelIndex).draggable({
        containment: "#level-" + game.levelIndex,
        drag: function (event, ui) {
            $(".LAbelText,.poent").removeClass("activeElementDot")
            $(this).addClass("activeElementDot")
            game.activePointer = $(this).data("div")
            reCalculatePoints()
        },
        stop: function (event, ui) {

            game.activePointer = $(this).data("div")
            updateCurrentpointDataTOPLEFT(ui.position)
            object = game.level[game.levelIndex][game.activePointer]
            $(this).css({
                top: object.top + "%",
                left: object.left + "%",
            })
        }
    })
        .click(function () {
            $(".LAbelText,poent").removeClass("activeElementDot")
            $(this).addClass("activeElementDot")
            event.stopPropagation()
            event.preventDefault()
            game.activePointer = $(this).data("div")
        })
        .dblclick(function () {
            $(".LAbelText,poent").removeClass("activeElementDot")
            $(this).addClass("activeElementDot")
            event.stopPropagation()
            event.preventDefault()
            if ($(this).is('.ui-draggable-dragging')) {
                return;
            }
            $(this).draggable("option", "disabled", true);
            $(this).attr('contenteditable', 'true');
        })
        .keyup(function () {

            updateCurrentpointDataWord($(this).text())

        })


    //$("#level-thumb-"+game.activePointer).click()
}


/*setdatafunction(
 {
 TypeProcesses: 'creategame',
 name:'new games1',
 description: 'description',
 thumb: 'images/Thumb.png',
 data:'',
 Category: 0,
 type:1
 });*/



/*
 setdatafunction(
 {TypeProcesses:'RemoveGames',
 gameid:currentGameID

 });
 */


/*
 setdatafunction(
 {TypeProcesses:'updateGames',
 id:30,
 name:'updategames new',
 category:'1',
 description:'description new ',
 thumb:'themb new .jpg',
 type:'2',
 delete:0

 });*/


/*setdatafunction(
 {TypeProcesses:'getdatagames',
 id:1


 });*/