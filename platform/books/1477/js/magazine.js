/*
 * Magazine sample
 */

function addPage(page){
    // Check if the page is not in the book
    if (!$(".magazine").turn('hasPage', page)) {
        // Create an element for this page
        var element = $('<div />').html('Loading…');
        // Add the page
        $(".magazine").turn('addPage', element, page);
        pName=getPagename(page-1);
        $.ajax({url: pName,async:true})
            .done(function(data) {
                //setTimeout(function(){
                element.html(data);
                element.find(".page_container").first().prepend('<div class="gradient"></div>');
                element.find(".page_container").attr("page_number",page);
                if(userData.showEnrichment=="false"){
                    element.find(".doaction").css("display","none");
                }

                getNotes(page);
                //refreshElements();
                reScale();
                animatePopOutImage();
                playTransVideo();
                //	},1500);
                if (navigator.userAgent.indexOf('Mac OS X') != -1) {
                    $("body").addClass("safari-browsers");
                    $(".safari-browsers *").css("font-weight","100");
                    $(".safari-browsers .goto-full-container-footer").css("height","3vh");
                }


                setTimeout(function () {
                    $(".element").each(function () {
                        if($(this)[0].hasAttribute('istyle')){
                            style=$(this).attr('istyle');
                            stylearr=style.split(';');
                            inset='';
                            i=0;
                            for(i=0;i<stylearr.length;i++){
                                if((stylearr[i]).search('inset')!=-1){
                                    arr=((stylearr[i]).trim()).split(' ');
                                    if(arr.length==5){
                                        $(this).css('top',arr[1]);
                                        $(this).css('right',arr[2]);
                                        $(this).css('bottom',arr[3]);
                                        $(this).css('left',arr[4]);
                                    }
                                }
                            }
                        }
                    });
                },150);




            });
    }
}
//function addPage(page){
//	// Check if the page is not in the book
//	if (!$(".magazine").turn('hasPage', page)) {
//		// Create an element for this page
//		var element = $('<div />').html('Loading…');
//		// Add the page
//		$(".magazine").turn('addPage', element, page);
//		pName=getPagename(page-1);
//
//		$.ajax({
//			url:pName,
//			type: "POST",
//			data: data,
//			cache: false,
//			dataType:'json',
//			success: function(jsonResult){
//				console.log("signup",jsonResult);
//				hideLoader();
//				if(jsonResult.result==1){//success
//					localStorage.user=JSON.stringify(jsonResult.user);
//					window.location.reload();
//				}else if(jsonResult.result==-1){//invalide Code
//					showMsg("error",Lang.SignUp,Lang.InvalidActCode);
//				}else if(jsonResult.result==-2){//email already exisit
//					showMsg("error",Lang.SignUp,Lang.EmailExisit);
//				}else{//unexpected
//					showMsg("error",Lang.SignUp,jsonResult.msg);
//				}
//			}
//		});
//
//		$.ajax({url: pName,async:true})
//			.done(function(data) {
//				element.html(data);
//				element.find(".page_container").first().prepend('<div class="gradient"></div>');
//				element.find(".page_container").attr("page_number",page);
//				if(localStorage.showEnrichment=="false"){
//					element.find(".doaction").css("display","none");
//				}
//				getNotes(page);
//				refreshElements();
//				reScale();
//			});
//	}
//}
function reScale(){
    if($('.magazine').turn("display")=="single"){
        //scale=$('.magazine').width()/980;
        //scale=$('.magazine').width()/980;
        if(window.bookSize=="width"){
            scale=$('.magazine').height()/980;
        }else{
            scale=$('.magazine').height()/1300;
        }
        $(".page_container").css("transform","scale("+scale+")");
    }else{
        scale=$('.magazine').width()/2/980;
        $(".page_container").css("transform","scale("+scale+")");
    }
    if(isMobile){
        //var top=($(window).height()-$(".page_container").height()*scale)/2;
        //$(".page_container").css("top",top-$("header").height());

        //(($(window).height()-($("header").height()+$("footer").height()))-$(".page_container").height()*scale)/2
        //$(".page_container").css("top",top-$("header").height());

        var left=($(window).width()-$(".page_container").width()*scale)/2;
        $(".page_container").css("left",left);
    }
}


// Zoom in / Zoom out
function zoomTo(event) {
    setTimeout(function() {
        if($('.magazine-viewport').data().regionClicked) {
            $('.magazine-viewport').data().regionClicked = false;
        } else {
            if ($('.magazine-viewport').zoom('value')==1) {
                $('.magazine-viewport').zoom('zoomIn', event);
                $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.zoom").addClass("zoom1");
            } else {
                $('.magazine-viewport').zoom('zoomOut');
                $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.zoom").removeClass("zoom1");
            }
        }
    }, 1);
}

// Process click on a region

function regionClick(event) {
    var region = $(event.target);
    if (region.hasClass('region')) {
        $('.magazine-viewport').data().regionClicked = true;
        setTimeout(function() {
            $('.magazine-viewport').data().regionClicked = false;
        }, 100);
        var regionType = $.trim(region.attr('class').replace('region', ''));
        return processRegion(region, regionType);
    }
}

// Process the data of every region

function processRegion(region, regionType) {
    data = decodeParams(region.attr('region-data'));
    switch (regionType) {
        case 'link' :
            window.open(data.url);
            break;
        case 'zoom' :
            var regionOffset = region.offset(),
                viewportOffset = $('.magazine-viewport').offset(),
                pos = {
                    x: regionOffset.left-viewportOffset.left,
                    y: regionOffset.top-viewportOffset.top
                };
            $('.magazine-viewport').zoom('zoomIn', pos);

            break;
        case 'to-page' :

            $('.magazine').turn('page', data.page);

            break;
    }

}
function isChrome() {
    return navigator.userAgent.indexOf('Chrome')!=-1;
}
function disableControls(page) {
    if (page==1)
        $('.previous-button').hide();
    else
        $('.previous-button').show();

    if (page==$('.magazine').turn('pages'))
        $('.next-button').hide();
    else
        $('.next-button').show();
}

function resizeViewport() {
    if(!window.fullScreen){


    var width = $(window).width(),
        height = $(window).height(),
        options = $('.magazine').turn('options');

    $('.magazine').removeClass('animated');


    $('.magazine-viewport').css({
        width: width,
        height: height
    }).
    zoom('resize');


    if ($('.magazine').turn('zoom')==1) {
        var bound = calculateBound({
            width: options.width,
            height: options.height,
            boundWidth: Math.min(options.width, width),
            boundHeight: Math.min(options.height+500, height)
        });

        if (bound.width%2!==0)
            bound.width-=1;


        if (bound.width!=$('.magazine').width() || bound.height!=$('.magazine').height()) {

            $('.magazine').turn('size', bound.width, bound.height);

            if ($('.magazine').turn('page')==1)
                $('.magazine').turn('peel', 'br');

            $('.next-button').css({height: bound.height, backgroundPosition: '-38px '+(bound.height/2-32/2)+'px'});
            $('.previous-button').css({height: bound.height, backgroundPosition: '-4px '+(bound.height/2-32/2)+'px'});
        }
        $('.magazine').css({top:($(".container").offset().top-$("header.mobile_noclose").height())*-1, left: -bound.width/2});
        //if(window.isMobile){
        //    $('.magazine').css({top:($(".container").offset().top-$("header.mobile_noclose").height())*-1, left: -bound.width/2});
        //    //if(window.bookSize=="width"){
        //    //    $('.magazine').css({top: -bound.height/2+$(window).height()*0.011+0.0001*$(window).width(), left: -bound.width/2});
        //    //}else{
        //    //    $('.magazine').css({top: -bound.height/2+$(window).height()*0.011+0.064*$(window).height(), left: -bound.width/2});
        //    //}
        //}else{
        //    $('.magazine').css({top: -bound.height/2+$(window).height()*0.011, left: -bound.width/2});
        //}

        //$('.magazine').css({top: (window.bookHeight/2+($("header").height()-$('.goto-full-container-footer').height()))*-1, left: -bound.width/2});
        //$(".magazine").css("top",($(window).height()-$(".magazine").height())/2-$(".container").offset().top);
        //$(".container").offset().top
        //$('.goto-full-container-footer').height();
        //x=$(".container").height()-$('.goto-full-container-footer').height();
        //console.log("resizeViewport",bound);
        //window.bookHeight/2+($("header").height()-$('.goto-full-container-footer').height())
    }

    var magazineOffset = $('.magazine').offset(),
        boundH = height - magazineOffset.top - $('.magazine').height(),
        marginTop = (boundH - $('.thumbnails > div').height()) / 2;

    $('.magazine').addClass('animated');

    if($(".magazine").turn("display")=="single"){
        $('.hard').hide();
        if($(window).width()<=1400){
            if(window.bookWidth>=window.pageWidth*2){
                newWidth=window.bookWidth/2;
            }else{
                newWidth=window.bookWidth;
            }
            p=newWidth/window.bookWidth*2;
            $(".magazine").width(newWidth);

            $(".magazine").css("left",($(window).width()-$(".magazine").width())/2-$(".container").offset().left);

            $('.magazine').css({top:($(".container").offset().top-$("header.mobile_noclose").height())*-1, left: -bound.width/2});
            //if(window.bookSize=="width"){
            //$('.magazine').css({top: -bound.height/2+$(window).height()*0.011+0.0001*$(window).width(), left: -bound.width/2});
            //}else{
            //    $('.magazine').css({top: -bound.height/2+$(window).height()*0.011+0.064*$(window).height(), left: -bound.width/2});
            //}
            //    $('.magazine').css({top: -bound.height/2+$(window).height()*0.011+0.0001*$(window).width(), left: -bound.width/2});
            setTimeout(function(){
                //reScale();
            },500);
        }else{
            // if(window.bookWidth>window.pageWidth){
            //     newWidth=window.bookWidth/2;
            // }else{
            //     newWidth=window.bookWidth;
            // }
            newWidth=window.bookWidth;
            p=newWidth/window.bookWidth*2;
            $(".magazine").width(newWidth);

            $(".magazine").css("left",($(window).width()-$(".magazine").width())/2-$(".container").offset().left);
            setTimeout(function(){
                //reScale();
            },500);
        }

    }

    }
}


// Number of views in a flipbook

function numberOfViews(book) {
    return book.turn('pages') / 2 + 1;
}

// Current view in a flipbook

function getViewNumber(book, page) {
    return parseInt((page || book.turn('page'))/2 + 1, 10);
}

function moveBar(yes) {
    if (Modernizr && Modernizr.csstransforms) {
        $('#slider .ui-slider-handle').css({zIndex: yes ? -1 : 10000});
    }
}

function setPreview(view) {

    var previewWidth = 112,
        previewHeight = 73,
        previewSrc = 'pages/preview.jpg',
        preview = $(_thumbPreview.children(':first')),
        numPages = (view==1 || view==$('#slider').slider('option', 'max')) ? 1 : 2,
        width = (numPages==1) ? previewWidth/2 : previewWidth;

    _thumbPreview.
    addClass('no-transition').
    css({width: width + 15,
        height: previewHeight + 15,
        top: -previewHeight - 30,
        left: ($($('#slider').children(':first')).width() - width - 15)/2
    });

    preview.css({
        width: width,
        height: previewHeight
    });

    if (preview.css('background-image')==='' ||
        preview.css('background-image')=='none') {

        preview.css({backgroundImage: 'url(' + previewSrc + ')'});

        setTimeout(function(){
            _thumbPreview.removeClass('no-transition');
        }, 0);

    }

    preview.css({backgroundPosition:
    '0px -'+((view-1)*previewHeight)+'px'
    });
}

// Width of the flipbook when zoomed in

function largeMagazineWidth() {
    if($(".magazine").turn("display")=="single"){
        return window.bookWidth;
    }else{
        return window.bookWidth*2;
    }
}

// decode URL Parameters

function decodeParams(data) {

    var parts = data.split('&'), d, obj = {};

    for (var i =0; i<parts.length; i++) {
        d = parts[i].split('=');
        obj[decodeURIComponent(d[0])] = decodeURIComponent(d[1]);
    }

    return obj;
}

// Calculate the width and height of a square within another square

function calculateBound(d) {

    var bound = {width: d.width, height: d.height};

    if (bound.width>d.boundWidth || bound.height>d.boundHeight) {

        var rel = bound.width/bound.height;

        if (d.boundWidth/rel>d.boundHeight && d.boundHeight*rel<=d.boundWidth) {

            bound.width = Math.round(d.boundHeight*rel);
            bound.height = d.boundHeight;

        } else {

            bound.width = d.boundWidth;
            bound.height = Math.round(d.boundWidth/rel);

        }
    }

    return bound;
}

function Mobilepen() {
    if (pen == 1) {
        if (window.sound) {
            $("#sound_menu")[0].play();
        }
        pen = 0;
        if ($("#ccanvas").length < 1) {
            $(".magazine").turn("disable", true);
            drawing();
        }

        $(".doaction").hide();
    }
}