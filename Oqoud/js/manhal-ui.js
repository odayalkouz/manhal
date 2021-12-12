/**
 * Created by PhpStorm.
 * User: oday alkouz
 * Date: 17/06/2020
 * Time: 09:00 ص
 */
$( document ).ready(function() {

    $('.fancybox-media').fancybox({
        openEffect  : 'none',
        closeEffect : 'none',
        buttons : [
            "zoom",
            "slideShow",
            "fullScreen",
            "thumbs",
            "close",
        ],
        infobar: true,
        allowfullscreen   : 'true',
        title: {
            type: 'outside'
        },
        helpers : {
            media : {}
        },
        data: {
            fancybox: true
        }
    });
    $('.fancybox-media1').fancybox({
        openEffect  : 'none',
        closeEffect : 'none',
        buttons : [
            "zoom",
            "slideShow",
            "fullScreen",
            "thumbs",
            "close",
        ],
        allowfullscreen   : 'true',
        title: {
            type: 'outside'
        },
        helpers : {
            media : {}
        }
    });
    $('.upload-input').change(function(){
        $(this).parent().children(".image-upload-wrap").show();
    });


    $("#current-year").html(new Date().getFullYear())
    $(".pagination li").click(function () {
        $(this).addClass("active").siblings().removeClass("active")
    })


function infomessage(){
    Lobibox.notify('info', {
        showClass: 'fadeInDown',
        hideClass: 'fadeUpDown',
        icon: false,
        msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
    });
}
function warningmessage(){
    Lobibox.notify('warning', {
        showClass: 'bounceIn',
        hideClass: 'bounceOut',
        icon: false,
        msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
    });
}
function errormessage(){
    Lobibox.notify('error', {
        showClass: 'zoomInUp',
        hideClass: 'zoomOutDown',
        icon: false,
        msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
    });
}
function successmessage(){

    Lobibox.notify(msgjavascript.update.Title, {
        showClass: 'rollIn',
        hideClass: 'rollOut',
        icon: false,
        msg: msgjavascript.update.Des
    });
}
function confirmmessage(){
    Lobibox.confirm({
        title: 'Confirm',
        msg: "Are you sure you want to delete this user?",
    });
}
    $('#basicInfoAnimation').click(function () {
        infomessage();
    });
    $('#basicWarningAnimation').click(function () {
        warningmessage();
    });
    $('#basicErrorAnimation').click(function () {
        errormessage();
    });
    $('#basicSuccessAnimation').click(function () {
        successmessage()
    });
    $('#confirmAnimation').click(function () {
        confirmmessage()
    });
});


function loadPicker() {
    $( ".selector" ).datepicker( "refresh" );
    $('.datepicker').datepicker({
        dateFormat: "yy-mm-dd",
        changeYear: true,
        changeMonth: true,
        yearRange: "1960:2022"
    });
}
