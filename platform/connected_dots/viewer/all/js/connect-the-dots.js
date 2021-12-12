var revealImage = function () {

    setTimeout(function(){
       
        if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
        str = '<div class="hintContainerWin"><div class="hintWin animated bounce" >' +
            '<label class="labelWin main-lbl win" style="top: 50%"></label>' +
            '<label class="labelWin sub-lbl" ></label>' +
            '<div class="imgShapes animated tada"></div>' +
            '<a class="relodeImg" onclick="closeBox()"><i></i></a>' +

            '</div>' +

            '</div>'

        $(str).appendTo(".main-container")
	    $(".gameContent").css(
		    {
			    'background-image': 'url(' + "../../../games/"+config.id+"/"+langStory+"/images/bg1.png" + ')',
			    'background-size': '100% 100%',
			    'background-repeat': 'no-repeat'
			
			
		    })
	    $("<audio class='SoundEffect'></audio>").attr({
		    'src': "../all/sound/good.mp3",
		    'autoplay': 'autoplay'
	    }).appendTo("body");
	    $('#goodFinl')[0].play();
    },2000)

    if (game.option.drawing && !autoConnect) {
        setTimeout(function(){
           $("#helpIcon").css("pointer-events","none")
            $(".gameContent ").ShowDrawing('0', game.option.color)
        },1500)
    }

    $('<audio controls autoplay>' +
        '<source src="' + game.WinSound + '" type="audio/ogg">' +
        '</audio>').appendTo("body").hide()
        .on('ended', function () {
            $(this).remove()
        });


    //fade out all the dots & lines

    if (game.option.hidePointsWhenWin) {
        opacityValue = 0
    }
    else {
        opacityValue = 1
    }

    $('.dot_container,.line').animate({
        opacity: opacityValue
    }, 1000, "linear", function () {

        //then fade in the image
 



    });


};
