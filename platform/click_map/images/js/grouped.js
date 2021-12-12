var interval;
var calledGroup = false;
var NewGroup = []

var lastEvent;
var heldKeys = {};


function isMacintosh() {
    return navigator.platform.indexOf('Mac') > -1
}

function isWindows() {
    return navigator.platform.indexOf('Win') > -1
}

$(document).on('keydown', function (e) {
    calledGroup = true;
    $( "[isgrouping='true']" ).css({
        opacity:0.2
    })


    if (lastEvent && lastEvent.keyCode == e.keyCode) {
        return;
    }

    lastEvent = e;
    heldKeys[e.keyCode] = true;


    console.log("keydown ")

    NewGroup = []

    if (game.typeEdit != "matching") {

        if (e.ctrlKey) {
            if (interval == null) {
                console.log('keydown');
                calledGroup = false;

                if (isMacintosh()) {
                    interval = setInterval(function () {
                        // PushToGroup(e.keyCode);
                        $("[isgrouping='true']").addClass("anim-border")
                        calledGroup = true;
                    }, 100);
                }else{

                    $("[isgrouping='true']").addClass("anim-border")
                    calledGroup = true;

                }
            }
        }
    }


}).on('keyup', function (e) {

    lastEvent;
    heldKeys = {};

    if (game.typeEdit != "matching") {

        console.log('keyup');
        $("[isgrouping='true']").removeClass("anim-border")

        clearInterval(interval);
        interval = null;
        PushToGroup(e.keyCode);
        NewGroup = []


        $(".gameContent").click()
        calledGroup = false;
    }




});


function PushToGroup(keyCode) {
    if (NewGroup.length>0) {

        game.group.push(NewGroup)

        drawElementInGroupBox()

    }
    $( "[isgrouping='true']" ).css({
        opacity:1
    })
    $( ".elementResizable" ).removeClass("ObjectsSelected")
}


function drawElementInGroupBox() {


    $(".group-container").html("")


    if(game.group=="" || typeof game.group == "undefined"){
        game.group=[]
    }
    if( game.group.length>0) {


        game.group.forEach(function (obj, indexCont) {

            console.log(obj)
            textString = ""

            textString += '<div index="' + indexCont + '" class="line-row opacity group-line-container">\n' +
                '                <div class="icon-tools floating-left"></div>' +
                '                <div class="toolsContainer floating-left">' +
                '' +
                ''


            obj.forEach(function (elment, index) {

                idElmentJquery = "#" + elment

                srcImageSource = $(idElmentJquery).find("img").attr("src")

                if(srcImageSource != "" || typeof srcImageSource != "undefined") {
                    nameImageArray = srcImageSource.split(".")[2].split("/")

                    nameimage = nameImageArray[nameImageArray.length - 1]


                    ext = srcImageSource.split(".")[3]
                    srcImage = config.rootPath + "/all/images/" + nameimage + "." + ext
                    console.log(srcImage)
                    textString += '<div parentIndex="' + indexCont + '"  index="' + index + '" targetID="' + elment + '" class="image-group-container">' +
                        '' +
                        '<img targetID="' + elment + '" src="' + srcImage + '">' +
                        '' +
                        '</div>'

                    $("#" + elment).attr("isGrouping", "true")
                }
            });

            textString += '' +
                '                </div>' +
                '            </div>'


            console.log(textString)

            $(textString).appendTo(".group-container")

        });

    }
        mouseOverElemnt()

}

function mouseOverElemnt(){

    $( ".image-group-container" ).hover(

        function() {
            event.stopPropagation()
            targetID=$(this).attr("targetID")
            $( "#"+targetID ).addClass( "anim-border" );
        }, function() {
            event.stopPropagation()
            $( "#"+targetID ).removeClass( "anim-border" );
        }
    );


    $( ".image-group-container" ).mouseout(function() {
        event.stopPropagation()
        targetID=$(this).attr("targetID")
        $( "#"+targetID ).removeClass( "anim-border" );
    });




    $( ".image-group-container" ).dblclick(function() {
        event.stopPropagation()

        var r = confirm("Are you sure you want to remove from group ?");
        if (r == true) {

            targetID=$(this).attr("targetID")
            index=$(this).attr("index")

            parentIndex = $(this).attr("parentIndex")
            game.group[parentIndex].splice(index, 1)

            $("#"+targetID).removeClass("ObjectsSelected")
            $("#"+targetID).removeClass("anim-border")

            $("#"+targetID).attr("isGrouping", "false")


            drawElementInGroupBox()

            if(game.group[parentIndex].length==0){

                game.group.splice(parentIndex, 1)
                drawElementInGroupBox()

            }

        } else {

        }

    });



    $( ".group-line-container" ).hover(

        function() {
            event.stopPropagation()
            index = $(this).attr("index")
            game.group[index].forEach(function (obj,indexCont) {

                $("#" + obj).addClass("anim-border");
            })
        }, function() {
            event.stopPropagation()
            index = $(this).attr("index")
            game.group[index].forEach(function (obj,indexCont) {

                $("#" + obj).removeClass("anim-border");
            })
        }
    );


    $( ".group-line-container" ).mouseout(function() {
        event.stopPropagation()
        index = $(this).attr("index")
        game.group[index].forEach(function (obj,indexCont) {

            $("#" + obj).removeClass("anim-border");
        })
    });



    $( ".group-line-container" ).dblclick(function() {
        event.stopPropagation()


        var r = confirm("Are you sure you want to ungroup elments ?");
        if (r == true) {

            index = $(this).attr("index")
            parentIndex = $(this).attr("parentIndex")
            game.group[index].forEach(function (obj,indexCont) {

                $("#"+obj).removeClass("ObjectsSelected")
                $("#"+obj).removeClass("anim-border")

                $("#"+obj).attr("isGrouping", "false")
            })


            game.group.splice(index, 1)

            drawElementInGroupBox()

        } else {

        }


    });


}


function showGroup(){

    $(".gameContent").click()

    $(".setting-popup-group").toggle()
}



