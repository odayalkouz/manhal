$(document).ready(function () {
    //start ckeditor initialize
    setTimeout(function () {
        window.CKEDITOR.replace('ckeditor',{
            toolbar:null,
            toolbarGroups : [
                { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                { name: 'forms', groups: [ 'forms' ] },
                { name: 'insert', groups: [ 'insert' ] },
                { name: 'tools', groups: [ 'tools' ] },
                { name: 'links', groups: [ 'links' ] },
                { name: 'colors', groups: [ 'colors' ] },
                { name: 'paragraph', groups: [ 'bidi', 'list', 'indent', 'blocks', 'align', 'paragraph' ] },
                '/',
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'styles', groups: [ 'styles' ] },
                { name: 'others', groups: [ 'others' ] },
                { name: 'about', groups: [ 'about' ] }
            ],
            height:350,
            language:'en',
           uiColor:'#f8f8f8'
        });
        $(".ckeditor").show();



        var data={};
        data["id"]=window.id;
        $.ajax({
            method: "POST",
            url: window.SITE_URL+"platform/ajax/template_editor.php?process=gethelp",
            data: data,
            dataType: "json",
            success: function (data) {
                if(data.status==1){
                    CKEDITOR.instances.ckeditor.setData(data.html);
                }else{
                    console.log('cannot get help data');
                }
            }
        });

    },1000)
    //end ckeditor initialize


    $('.slider-single').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        adaptiveHeight: true,
        infinite: false,
        useTransform: true,
        speed: 400,
        cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)'
        // cssEase:'linear'
    });
    //slider-nav
    $('.slider-nav').on('init', function(event, slick) {
        $('.slider-nav .slick-slide.slick-current').addClass('is-active');
    })
        .slick({
            slidesToShow: 15,
            slidesToScroll: 3,
            dots: false,
            focusOnSelect: false,
            infinite: false,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 3
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2
                }
            }, {
                breakpoint: 420,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }]
        });
    $(document).on("click", ".slider-nav .slider-item", function (e) {
        $(this).addClass("is-active").siblings().removeClass("is-active");
    });



    $('.hide-tools-button').click(function () {
       $(this).toggleClass("hidden");
       $("body").toggleClass("full-view");

    });
    $('.jq_choose_color').click(function () {
        $(".choose-color-container").slideToggle();
    });
    $('.choose-color-container .colors-in').click(function () {
        $(this).addClass("active").siblings().removeClass("active");
       var colorbg= $(this).attr("color");
       $(".jq_color").css("background",colorbg);
       $(".jq_color").attr("color",colorbg)
    });
    $('.jq_edit_template').click(function () {
        window.selectedTemplate=$(this).attr("templateid");
        closechoosethumb();
        opentemplatesettings();
        $(".wrapper-settings").show()
    });

    $('.absolute-index-page-popup .index-page-popup .head a.close').click(function () {
        closechoosethumb();
        closetemplatesettings();
    });

    $('.save-settings').click(function () {


        setTimeout(function (){
            // hideloader();
        },3000)

    });
    $('.jq_help').click(function () {
        openhelp();
        $(".wrapper-settings").show();
        $(".wrapper").hide();
    });

    $('.jq_setting').click(function () {
        openchoosethumb();
        $(".wrapper-settings").show();
        $(".wrapper").hide();
    });

    $('.jq_edittemplate').click(function () {
        openchoosethumb();
        $(".wrapper-settings").show()

    });
    $('#addtemplate').click(function () {
        openchoosethumb();
        $(".wrapper").show()
    });

    $('.hamburger').click(function () {
        if (!$(this).hasClass("is-active")) {
            $(this).addClass("is-active");
            $(".editor-main-container footer").addClass("active");
            $(".editor-main-container footer .content .num-of-question").fadeIn(300);
            $(".story-main-container .content-container").removeClass("active");
        }
        else {
            $(this).removeClass("is-active");
            $(".editor-main-container footer").removeClass("active");
            $(".editor-main-container footer .content .num-of-question").fadeOut(300);
            $(".story-main-container .content-container").css("height", "calc(100%-90px)");
            $(".story-main-container .content-container").addClass("active");
        }
    });
});
function readURL(input,id)
{
    if (input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) {
            // document.getElementById(id).src=e.target.result;
            if(id=='default-thumb'){
                var w=272;
                var h=162;
            }else{
                var w=651;
                var h=336;
            }
            resizedataURL(e.target.result, w, h,id);
            $("#"+id).attr("updated","1");
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function resizedataURL(datas, wantedWidth, wantedHeight,id)
{
    // We create an image to receive the Data URI
    var img = document.createElement('img');
    // When the event "onload" is triggered we can resize the image.
    img.onload = function()
    {
        // We create a canvas and get its context.
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        // We set the dimensions at the wanted size.
        canvas.width = wantedWidth;
        canvas.height = wantedHeight;
        // We resize the image with the canvas method drawImage();
        ctx.drawImage(this, 0, 0, wantedWidth, wantedHeight);
        var dataURI = canvas.toDataURL();
        document.getElementById(id).src=dataURI
        /////////////////////////////////////////
        // Use and treat your Data URI here !! //
        /////////////////////////////////////////
    };
    // We put the Data URI in the image's src attribute
    img.src = datas;
}
function openhelp() {
    $(".wrapper").removeClass("fade-bottom");
    $(".wrapper").addClass("slideInDown animated").show();
    $(".absolute-index-page-popup.help").show();
}
function closehelp() {
    $(".wrapper").removeClass("fade-bottom slideInDown slideOutUp").hide();
    // $(".absolute-index-page-popup").hide();
    $(".wrapper").removeClass("slideInDown animated");
}
/////////////////////////////////*******************************///////////////////////////////
function openchoosethumb() {
    $(".wrapper").removeClass("fade-bottom");
    $(".wrapper").addClass("slideInDown animated").show();
    $(".absolute-index-page-popup.setting").show();
}
function closechoosethumb() {
    $(".wrapper").removeClass("fade-bottom slideInDown slideOutUp").hide();
    // $(".absolute-index-page-popup").hide();
    $(".wrapper").removeClass("slideInDown animated");
}

function opentemplatesettings() {
    $(".wrapper-settings").removeClass("fade-bottom");
    $(".wrapper-settings").addClass("slideInDown animated");
    // $(".index-page-popup").removeClass("fade-bottom slideInDown slideOutUp");
    // $(".index-page-popup").addClass("slideInDown animated");
    // $(".absolute-index-page-popup").show();
}
function closetemplatesettings() {
    $(".wrapper-settings").removeClass("fade-bottom slideInDown slideOutUp").hide();
    $(".absolute-index-page-popup").hide();
    $(".wrapper-settings").removeClass("slideInDown animated");
}

function showloader(){
    $(".loader-main-container").show();
}
function hideloader(){
    $(".loader-main-container").hide();
}








