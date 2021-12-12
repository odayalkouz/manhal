
var Orginal=""
function showOrginalImage(src){
    UiMouseDown.hideOnMouseDown()
    if($('.orginalContainer'))$('.orginalContainer').remove()
    str=arrayOfImages[0]
    base =  arrayOfImages[0].slice(-4)
    str=  arrayOfImages[0].slice(0,-4)
    src=str +"O"+base


    $('<div class="orginalContainer hideAll" onclick="hidePobUpJus()"><img src="'+src+'"></div>').appendTo('#canvasContainer').hide().show('fast')

}



