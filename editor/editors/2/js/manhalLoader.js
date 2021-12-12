langStory="ar";
(function ($) {
    var items = new Array(),
        errors = new Array(),
        onComplete = function () {

        },
        current = 0;

    var manhalLoaderOption = {
        splashVPos: '50%',
        loaderVPos: '50%',
        splashID: '#jpreContent',
        addFiles: [],
        showSplash: true,
        showPercentage: true,
        debugMode: false,
        splashFunction: function () {
        },
        onLoading:function(){

        }
    }

    browser={
        isAndroid: /Android/.test(navigator.userAgent),
        isCordova: !!window.cordova,
        isEdge: /Edge/.test(navigator.userAgent),
        isFirefox: /Firefox/.test(navigator.userAgent),
        isChrome: /Google Inc/.test(navigator.vendor),
        isChromeIOS: /CriOS/.test(navigator.userAgent),
        isChromiumBased: !!window.chrome && !/Edge/.test(navigator.userAgent),
        isIE: /Trident/.test(navigator.userAgent),
        isIOS: /(iPhone|iPad|iPod)/.test(navigator.platform),
        isOpera: /OPR/.test(navigator.userAgent),
        isSafari: /Safari/.test(navigator.userAgent) && !/Chrome/.test(navigator.userAgent),
        isTouchScreen: ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch,
        isWebComponentsSupported: 'registerElement' in document && 'import' in document.createElement('link') && 'content' in document.createElement('template')
    }
    var getImages = function (element) {
        $(element).find('*:not(script)').each(function () {
            var url = "";
            var urlSound = "";

            if ($(this).css('background-image').indexOf('none') == -1) {
                url = $(this).css('background-image');
                if (url.indexOf('url') != -1) {
                    var temp = url.match(/url\((.*?)\)/);
                    url = temp[1].replace(/\"/g, '');
                }
            } else if ($(this).get(0).nodeName.toLowerCase() == 'img' && typeof($(this).attr('src')) != 'undefined') {
                url = $(this).attr('src');
            }
            else if ($(this).get(0).nodeName.toLowerCase() == 'audio' && typeof($(this).attr('src')) != 'undefined') {
                urlSound = $(this).attr('src');
            }

            if (url.length > 0) {
                items.push({type:"image",url:url});
            }
            if (urlSound.length > 0) {
                items.push({type:"audio",url:urlSound});
            }



        });
        if (manhalLoaderOption.addFiles.length > 0) {

            for (var i = 0; i < manhalLoaderOption.addFiles.length; i++) {
                items.push(manhalLoaderOption.addFiles[i]);
            }

        }
        //console.log(items)
    }

    var preloading = function () {
        for (var i = 0; i < items.length; i++) {
            if(items[i].type=="image"){
                loadImg(items[i].url);
            }
            else if(items[i].type=="audio"){
                loadAudio(items[i].url);
            }

        }
    }

    var loadImg = function (url) {

        var imgLoad = new Image();
        if(browser.isEdge || browser.isIE){
            completeLoading()
        }
        else{
            $(imgLoad)
                .load(function () {

                    completeLoading();
                })
                .error(function () {
                    errors.push($(this).attr('src'));
                    completeLoading();
                })
                .attr('src', url);
        }

    }

    var loadAudio=function(url){

        var audio = new Audio();
        // once this file loads, it will call loadedAudio()
        // the file will be kept by the browser as cache
        audio.addEventListener('canplaythrough',  completeLoading(), false);

        audio.addEventListener('error', function(e){
            completeLoading()
        }, false);
        audio.src = url;
    }

    var completeLoading = function () {


        // return
        current++;

        var per = Math.round((current / items.length) * 100);
        $(jBar).stop().animate({
            width: per + '%'
        }, 500, 'linear');

        if (manhalLoaderOption.showPercentage) {
            if (langStory == "ar") {
                $(jPer).text("جاري التحميل ....").css({
                    direction:"rtl"
                });;
            } else {

                $(jPer).text("Loading ......").css({
                    direction:"ltr"
                });
            }

            manhalLoaderOption.onLoading(per)
        }

        if (current >= items.length) {

            current = items.length;

            if (manhalLoaderOption.debugMode) {
                var error = debug();

            }
            loadComplete();
        }
    }

    var loadComplete = function () {

        $(jBar).stop().animate({
            width: '99%'
        }, 500, 'linear', function () {
            // $(jOverlay).fadeOut(50, function () {
            //     $(jOverlay).remove();
            onComplete();
            // });
            $("#manhalloader").fadeOut("slow");
        });
    }

    var debug = function () {
        if (errors.length > 0) {
            var str = 'ERROR - IMAGE FILES MISSING!!!\n\r'
            str += errors.length + ' image files cound not be found. \n\r';
            str += 'Please check your image paths and filenames:\n\r';
            for (var i = 0; i < errors.length; i++) {
                str += '- ' + errors[i] + '\n\r';
            }
            return true;
        } else {
            return false;
        }
    }

    var createContainer = function (tar) {

        jOverlay = $('<div></div>')
            .attr('id', 'manhalpreOverlay')
            .css({
                position: "fixed",
                top: 0,
                left: 0,
                width: '100%',
                height: '100%',
                zIndex: 9999999
            })
            .appendTo('body');

        if (manhalLoaderOption.showSplash) {
            jContent = $('<div></div>')
                .attr('id', 'manhalpreSlide')
                .appendTo(jOverlay);

            var conWidth = $(window).width() - $(jContent).width();
            $(jContent).css({
                position: "absolute",
                top: manhalLoaderOption.splashVPos,
                left: Math.round((50 / $(window).width()) * conWidth) + '%'
            });
            $(jContent).html($(manhalLoaderOption.splashID).wrap('<div/>').parent().html());
            $(manhalLoaderOption.splashID).remove();
            manhalLoaderOption.splashFunction()
        }

        jLoader = $('<div></div>')
        // .attr('id', 'manhalloader')
        // .appendTo(jOverlay);

        var posWidth = $(window).width() - $(jLoader).width();
        $(jLoader).css({
            position: 'absolute',
            top: manhalLoaderOption.loaderVPos,
            left: Math.round((50 / $(window).width()) * posWidth) + '%'
        });

        jBar = $('<div></div>')
            .attr('id', 'manhalpreBar')
            .css({
                width: '0%',
                height: '100%'
            })
            .appendTo(jLoader);

        if (manhalLoaderOption.showPercentage) {
            jPer = $('<div></div>')
                .attr('id', 'manhalprePercentage')
                .css({
                    position: 'relative',
                    height: '100%'
                })
                .appendTo(jLoader)
                .html('Loading...');
        }
    };

    $.fn.manhalLoader = function (options, callback) {
        if (options) {
            //console.log(options)
            $.extend(manhalLoaderOption, options);
        }
        if (typeof callback == 'function') {
            onComplete = callback;
        }

        createContainer(this);
        getImages(this);
        preloading();
        return this;
    };

})(jQuery);