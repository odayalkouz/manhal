/**
 * Created by Work on 5/10/2015.
 */
function hideColor(){
    event.stopPropagation();
    event.preventDefault();
    $('#colorContainer').addClass('colorContainerDown')
    $('#colorContainer').css('opacity','.5')

    showT=false
}

function showColor(){
    event.stopPropagation();
    event.preventDefault();
    $('#colorContainer').removeClass('colorContainerDown')
    $('#colorContainer').css('opacity','1')

    showT=true
}

showT=true
function toggleShow(){
    parent.soundEffect("sound/slidemenu.mp3")
    event.stopPropagation();
    event.preventDefault();
    if( $('#colorContainer').css('bottom')=='0px'){

        hideColor()
        showT=false
    }

    else if($('#colorContainer').css('bottom')=='-160px'){
        showColor()
        showT=true
    }


}


function hideSideMenu(){
    $('#controlPanel').css('transform','translate(110%)')

    showTSideMenu=false
}

function showSideMenu(){
    $('#controlPanel').css('transform','translate(0px)')

    showTSideMenu=true
}

showTSideMenu=true
function toggleShowSideMenu(){
    if(showTSideMenu){

        hideSideMenu()
        showTSideMenu=false
    }

    else{
        showSideMenu()
        showTSideMenu=true
    }


}


showTSidesize=true
function toggleShowSideSize(){
    if(showTSidesize){

        hideSizeMenu()
        showTSidesize=false
    }

    else{
        showSizeMenu()
        showTSidesize=true
    }


}

function hideSizeMenu(){

    $('.sizes').css('opacity','.2')
    showTSidesize=false
}

function showSizeMenu(){

    $('.sizes').css('opacity','1')
    showTSidesize=true
}


function flipSound(){
    /*   $('#flipSound').trigger("stop");
     $('#flipSound').trigger("play");*/
}


function showHideAll(){

    // toggleShow();
    $('#penselect').click()
    toggleShowSideMenu()
    toggleShowSideSize()
    $('#morePenCont').hide()
    if($('.downloadBox'))$('.downloadBox').remove()
    $('#morePenCont').hide()
    $('#colorPicker').hide();
}


function hideAllPobup(){
    if($('.downloadBox'))$('.downloadBox').remove()
    hideSizeMenu()
    hideSideMenu()
    $('#colorContainer').addClass('colorContainerDown')
    $('#colorContainer').css('opacity','.5')
    $('#colorPicker').hide();
    showT=false
    $('#morePenCont').hide()
}


function hidePobUpJus(colorP){
    if($('.orginalContainer'))$('.orginalContainer').remove()
    console.log('red')
    if($('.downloadBox'))$('.downloadBox').remove()
    $('#morePenCont').hide()
    $('#colorPicker').hide();
    if(!colorP) {
        $('#colorContainer').addClass('colorContainerDown')
        $('#colorContainer').css('opacity','.5')
    }

}

var mouseDownUi=function(){

    this.hideOnMouseDown=function(){
        $('.hideAll').hide()
        if($('.orginalContainer'))$('.orginalContainer').remove()
    }
    this.ShowOnMouseDown=function(){
        $('.hideAll').show()
    }

}


UiMouseDown = new mouseDownUi;


