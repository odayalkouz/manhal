function playSoundConnect(src) {
if($(".conectline").length)
{
    $(".conectline").remove()
}
    $("<audio class='conectline' ></audio>").attr({
        'src': src,
        'autoplay': 'autoplay'
    }).appendTo("body");





    $('.conectline').on('ended', function() {
        $(this).remove()
    });




}


function playSoundslideAnimiation(src) {
if($(".slideAnimiation").length)
{
    $(".slideAnimiation").remove()
}
    $("<audio class='slideAnimiation' ></audio>").attr({
        'src': src,
        'autoplay': 'autoplay'
    }).appendTo("body");





    $('.slideAnimiation').on('ended', function() {
        $(this).remove()
    });




}
