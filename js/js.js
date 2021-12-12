jQuery(document).ready(function () {
    $('.container').on('mousedown',createMouseMoveFunction);
});
rotY = 0;
rotX = 0;
function createMouseMoveFunction(e) {
    firstX = e.pageX;
    firstY = e.pageY;
    firstRY = parseInt($('.cube').css('rotateY'));
    firstRX = parseInt($('.cube').css('rotateX'));
    CubeMove = true;
    $('.container').off('mousedown',createMouseMoveFunction);
    $(document).on('mousemove',MouseMove);
    $(document).on('mouseup',removeMouseMoveFunction);
    $('.container').removeClass("animate");
    $('.cover-image-container .bookface_bottom').css("-webkit-filter","none");
}
function MouseMove(el) {
    if(CubeMove){

        $('.cube').css({
            rotateY: firstRY + (el.pageX - firstX),
            rotateX: firstRX + (firstY - el.pageY)
        });
    }
};
function removeMouseMoveFunction() {
    CubeMove = false;
    $(document).off('mousemove',MouseMove);
    $(document).off('mouseup',removeMouseMoveFunction);
    $('.container').on('mousedown',createMouseMoveFunction);
    $('.container').addClass("animate");
    $('.cover-image-container .bookface_bottom').css("-webkit-filter","drop-shadow(0 0 30px rgba(0, 0, 0, 0.75))");

}