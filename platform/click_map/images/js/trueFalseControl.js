




function appendTrueOrFalseControl(){


    if(typeof game.trueFalseControl == "undefined"){
        game.trueFalseControl={
            top:"0",
            left:"0",
            width:"30",
            height:"10",
            trueShow:true,
            falseShow:true
        }
    }



    rezie = '<div class="ui-resizable-handle ui-resizable-se corner" id="segrip"></div>'

    // ' <div class="ui-resizable-handle ui-resizable-nw corner" id="nwgrip"></div>' +
        // ' <div class="ui-resizable-handle ui-resizable-ne corner" id="negrip"></div>' +
        // '<div class="ui-resizable-handle ui-resizable-sw corner" id="swgrip"></div>' +

    text='<div id="box_gcrFyJ" class="trueAndFalseContainer-control" style="display: block;"><div>' +
        '' +
        '<img id="" flag="true" class="setTrue activeTrue" src="images/correct.png">' +
        '<img id="" flag="false" class="setfalse activeFalse" src="images/false.png">' +

        '' +
        rezie +
        '</div>'



    $(text).appendTo('.gameContent')
        .draggable(
            {
                cancel: ".connectedCircle,.uploadGroup-button,٫ui-resizable-handle",
                smartguides:".trueAndFalseContainer-control",
                tolerance:5,
                containment: "parent",

                opacity: 0.35,

                drag:function(){
                    if(game.typeEdit=="trueOrFalse")
                    {
                        var wrapper = $('.gameContent');

                        leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
                        topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
                        widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
                        heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)

                        $(this).css("left", leftObject + "%");
                        $(this).css("top", topObject + "%");
                        $(this).css("width", widthObject + "%");
                        $(this).css("height", heightObject + "%");

                        var isDisabled = $(this).draggable('option', 'revert');

                        if( isDisabled=="false" || isDisabled==false ) {

                            updateBasicControleInfo({
                                left: leftObject,
                                top: topObject,
                                width: widthObject,
                                height: heightObject,

                            })

                        }





                    }
                },

                start: function () {


                    addresizeCornerTrueOrFalse(this)
                    $(this).css('border', "1px solid black")
                    $(this).find(".ui-resizable-handle").show()

                },
                stop: function (event,ui) {
                    var wrapper = $('.gameContent');

                    leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
                    topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
                    widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
                    heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)

                    $(this).css("left", leftObject + "%");
                    $(this).css("top", topObject + "%");
                    $(this).css("width", widthObject + "%");
                    $(this).css("height", heightObject + "%");

                    var isDisabled = $(this).draggable('option', 'revert');

                    if( isDisabled=="false" || isDisabled==false ) {

                        updateBasicControleInfo({
                            left: leftObject,
                            top: topObject,
                            width: widthObject,
                            height: heightObject,

                        })

                    }


                    $(ui.droppable).css("background", "#4e4e4e")



                }

            }).css({
        width: game.trueFalseControl.width + "%",
        height: game.trueFalseControl.height + "%",
        border: "1px solid black",
        position: 'absolute',
        top: game.trueFalseControl.top + "%",
        left: game.trueFalseControl.left + "%",
        'z-index': 999,


    })

        .resizable({
            handles: {
                // 'ne': '#negrip',
                'se': '#segrip',
                // 'sw': '#swgrip',
                // 'nw': '#nwgrip'
            }
        }).click(function () {

        addresizeCornerTrueOrFalse(this)
    })


    $(".activeTrue").click(function(){
event.stopPropagation()
        if(  game.trueFalseControl.trueShow=="true"){
            game.trueFalseControl.trueShow="false"
            $(".activeTrue").css({
                opacity:0.1
            })
        }else{
            game.trueFalseControl.trueShow="true"
            $(".activeTrue").css({
                opacity:1
            })
        }

    })

    $(".activeFalse").click(function(){
        event.stopPropagation()
        if(  game.trueFalseControl.falseShow=="true"){
            game.trueFalseControl.falseShow="false"
            $(".activeFalse").css({
                opacity:0.1
            })
        }else{
            game.trueFalseControl.falseShow="true"
            $(".activeFalse").css({
                opacity:1
            })
        }
    })




    if(  game.trueFalseControl.trueShow=="true"){

        $(".activeTrue").css({
            opacity:1
        })
    }else{

        $(".activeTrue").css({
            opacity:0.1
        })
    }


    if(  game.trueFalseControl.falseShow=="true"){

        $(".activeFalse").css({
            opacity:1
        })
    }else{

        $(".activeFalse").css({
            opacity:0.5
        })
    }

}


function addresizeCornerTrueOrFalse(object) {

    if ($('.ui-resizable-handle').length) $('.ui-resizable-handle').remove()
    $(object).resizable("destroy")
    str =  '<div class="ui-resizable-handle ui-resizable-se corner" id="segrip"></div>'
        // '<div class="ui-resizable-handle ui-resizable-nw corner" id="nwgrip"></div>' +
        // '<div class="ui-resizable-handle ui-resizable-ne corner" id="negrip"></div>' +
        // '<div class="ui-resizable-handle ui-resizable-sw corner" id="swgrip"></div>' +

    $(str).appendTo(object)

    $(object).resizable({
        handles: {
            // 'ne': '#negrip',
            'se': '#segrip',
            // 'sw': '#swgrip',
            // 'nw': '#nwgrip'
        },

        start:function(){
            var wrapper = $('.gameContent');

            leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
            topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
            widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
            heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)

            $(this).css("left", leftObject + "%");
            $(this).css("top", topObject + "%");
            $(this).css("width", widthObject + "%");
            $(this).css("height", heightObject + "%");


            updateBasicControleInfo({
                left: leftObject,
                top: topObject,
                width: widthObject,
                height: heightObject,

            })



        },
        resize:function(){
            var wrapper = $('.gameContent');

            leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
            topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
            widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
            heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)

            $(this).css("width", widthObject + "%");
            $(this).css("height", heightObject + "%");



            game.trueFalseControl.width = widthObject
            game.trueFalseControl.height = heightObject

        }
        ,
        stop: function () {
            var wrapper = $('.gameContent');

            leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
            topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
            widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
            heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)

            $(this).css("left", leftObject + "%");
            $(this).css("top", topObject + "%");
            $(this).css("width", widthObject + "%");
            $(this).css("height", heightObject + "%");
            updateBasicControleInfo({
                left: leftObject,
                top: topObject,
                width: widthObject,
                height: heightObject,

            })

        }
    })
}

function updateBasicControleInfo(data){

    game.trueFalseControl.left = data.left
    game.trueFalseControl.top = data.top
    game.trueFalseControl.width = data.width
    game.trueFalseControl.height = data.height
}


