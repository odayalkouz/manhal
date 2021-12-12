$(document).ready(function() {
	$('#media_upload').change(function(e) {
		var file = e.currentTarget.files[0];
		var objectUrl = URL.createObjectURL(file);
		$(".gallery").hide();
		var ext = $(this).val().split('.').pop();
		var view="";
		switch(ext) {
			case "mp3":
				view='<div class="gallery type1" style="display: none"><div class="item-container col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="audio-player jq_player"><div id="play-btn" class="play-button"></div><div class="audio-wrapper" id="player-container" href="javascript:;"><audio id="player" ontimeupdate="initProgressBar(this)"><source src="http://localhost/manhal/medias/audios/2020SG00000001.mp3" type="audio/mp3"></audio></div><div class="player-controls scrubber"><span id="seekObjContainer"><progress id="seekObj" class="seekObj" value="0" max="1" style=""></progress></span><br><small style="float: left; position: relative; left: 15px;color: #00ad68;" class="start-time"></small><small style="float: right; position: relative; right: 20px;color: #00ad68;" class="end-time"></small></div><div class="album-image"><div class="numbers pull-right"><i>1</i></div><p class="title pull-right"> ثوم</p></div></div></div></div>';
				$(".gallery-container").html(view);
				$(".gallery.type1").show();
				$(".gallery audio").prop("src", objectUrl);
				break;
			case "mp4":
				view='<div class="gallery type4"  style="display: none"><div class="item-container"><a href="https://medialibrary.manhal.com/medias/videos/7a77b872f4140520cc4b359263ee78097fd2c4f4b34da2605398a6a1121c1e76.mp4" data-fancybox="gallery" class="fancybox-media" data-caption="Ducks"><div class="typeandtime"><i class="lnr lnr-camera-video pull-left"></i><span class="pull-left"></span></div><div class="mediatitle-video">title</div><video data-play="hover" muted="muted" class="video-time" id="attr3951" loop=""><source src="https://medialibrary.manhal.com/medias/videos/7a77b872f4140520cc4b359263ee78097fd2c4f4b34da2605398a6a1121c1e76.mp4" type="video/mp4"></video></a></div></div>';
				$(".gallery-container").html(view);
				$(".gallery video").prop("src", objectUrl);
				$(".gallery.type4").show();
				$(".gallery video").parent().prop("href", objectUrl);
				$(".gallery video").parent().children($(".mediatitle-video").html($("#title_ar").val()));
				break;
			default:
				view='<div class="gallery type2"  style="display: none"><div class="item-container"><a href="https://medialibrary.manhal.com/medias/images/73c395f95d10e7d0f87dac1ee9475c34ee64a3b988eecc546746d69fc510ffde.jpg" data-fancybox="gallery" class="fancybox-media" data-caption="carrot"><div class="mediatitle">title</div><img src="https://medialibrary.manhal.com/medias/images/imagethumb_4146.jpg" class="single-image"></a></div></div>';
				$(".gallery-container").html(view);
				$(".gallery.type2").show();
				$(".gallery img").prop("src", objectUrl);
				$(".gallery img").parent().prop("href", objectUrl);
				$(".gallery img").parent().children($(".mediatitle").html($("#title_ar").val()));
				break;
		}
	});

	Tagsarray = Array();
	function add_element_to_array()
	{
		if(jQuery.inArray(document.getElementById("tags-input").value, Tagsarray) == -1)
		{
			Tagsarray.push( document.getElementById("tags-input").value)
		}
			document.getElementById("tags-input").value = "";
		drowingTages();
	}
	function drowingTages(){
		$(".tags-container-admin").html('');
		for(var i=0;i<Tagsarray.length;i++){
			$(".tags-container-admin").show().append('<a class="col-lg-3 col-md-3 col-sm-3 col-xs-3">'+ Tagsarray[i] +'<i class="lnr lnr-trash"></i></a>')
		}

	}




	$('#tags-input').on('change ', function() {
		add_element_to_array()
	});
	$(document).on("click", ".tags-container-admin a i", function (e) {
		$(this).parent().remove();
	});

    if($(".gallery").hasClass("type1"))
    {
        $(".tile-list-container").parent().show();
        $('.tile-list-container .tile').click(function() {
            $(this).addClass("active").siblings().removeClass("active");
            $(".gallery .item-container").removeClass("col-lg-12 col-md-12 col-sm-12 col-xs-12").addClass("col-lg-4 col-md-4 col-sm-12 col-xs-12 marg");
        });
        $('.tile-list-container .list').click(function() {
            $(this).addClass("active").siblings().removeClass("active");
            $(".gallery .item-container").removeClass("col-lg-4 col-md-4 col-sm-12 col-xs-12 marg").addClass("col-lg-12 col-md-12 col-sm-12 col-xs-12");
        });
    }
	//start video duration and play on hover
		$(".fancybox-media video").each(function () {
			var vid = document.getElementById($(this).attr("id"));
			vid.onloadeddata = function() {
				if(vid.readyState > 0) {
					var minutes = parseInt(vid.duration / 60, 10);
					var seconds = Math.round(vid.duration) % 60;
					$(this).parent().children(".typeandtime").children("span").html(minutes+":"+seconds)
				}
			}
		});
	//end video duration and play on hover


	//start tags activate
	$('.filters-main-container .tags-container a').click(function() {
		$(this).toggleClass("active");
	});
	//end tags activate

    //start info popup open from right
    $('.gallery .item-container .hover-menu .anchor-container.information').on('click', function()
    {
    	$("#jq_path").remove();
        var imagesA="";
        var imagepath=$(this).parent().parent().attr("path");
        $("#jq_title_ar").html($(this).parent().parent().attr("title_ar"));
        $("#jq_descraption").html($(this).parent().parent().attr("descraption"));
        $("#jq_category").html($(this).parent().parent().attr("category"));
        $("#jq_types").html($(this).parent().parent().attr("types"));
        $("#jq_extension").html($(this).parent().parent().attr("extension"));

        if($(this).parent().parent().parent().hasClass("type1"))
        {
             imagesA='<img class="img-responsive thumbnail" style="width: 272px; height: 162px; object-fit: contain;" id="jq_path" src="themes/en/img/default/sound.png" alt="media type">';
            $(".appendimage").prepend(imagesA)
        }
        else if($(this).parent().parent().parent().hasClass("type4"))
        {
             imagesA='<img class="img-responsive thumbnail" style="width: 272px; height: 162px; object-fit: contain;" id="jq_path" src="themes/en/img/default/vedio.png" alt="media type">';
            $(".appendimage").prepend(imagesA)
        }
        else
        {
             imagesA='<img class="img-responsive thumbnail" style="width: 272px; height: 162px; object-fit: contain;" id="jq_path" src="'+imagepath+'" alt="media type">';
            $(".appendimage").prepend(imagesA)
        }


        if(!$('body').hasClass('layout-fullwidth-right')) {
            $('body').addClass('layout-fullwidth-right');
        }
        // else
        // {
        //     $('body').removeClass('layout-fullwidth-right');
        //     $('body').removeClass('layout-default');
        //     // also remove default behaviour if set
        // }


    });
	$(document).on("touchmove click touchstart", "html", function (e) {
		if (typeof $(e.target).closest(".sidebar-nav-right,.gallery .item-container .hover-menu .anchor-container.information")[0] == "undefined") {
			$('body').removeClass('layout-fullwidth-right');
			$('body').removeClass('layout-default');
		}
	});
	//end info popup open from right

	//start delete active filter headers like tags
	$('.category-filters-addition .nav .nav-link i').click(function() {
		$(this).parent().remove();
	});
	//end delete active filter headers like tags
	//start clear all in header
	$('.category-filters-addition .nav .nav-link.clear-all').click(function() {
		$(this).siblings().remove();
		$(this).remove();

	});
	//end clear all in header

	//start multiple select ddl
	if($("#multiple_select_menu").length !=0)
	{
		if($(window).width()<768)
		{
			$('#multiple_select_menu').multiselect({
				includeSelectAllOption: false,
				buttonWidth: '50px',
			});
		}
		else {
			$('#multiple_select_menu').multiselect({
				includeSelectAllOption: false,
				buttonWidth: '130px',
			});
		}
	}

	//end multiple select ddl

	//start media viewer sound,video,doc,images....
	$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		// type: 'iframe',

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
	//end media viewer sound,video,doc,images....
    function checkSiblings(el) {
        var parent = el.parent().parent(),
            all = true;
        el.siblings().each(function() {
            let returnValue = all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
            return returnValue;
        });
        if (all && checked) {
            parent.children('input[type="checkbox"]').prop({
                indeterminate: false,
                checked: checked
            });
            checkSiblings(parent);
        } else if (all && !checked) {
            parent.children('input[type="checkbox"]').prop("checked", checked);
            parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
            checkSiblings(parent);
        } else {
            el.parents("li").children('input[type="checkbox"]').prop({
                indeterminate: true,
                checked: false
            });
        }
    }
	//start checkbox multiple level
	$('.caregoies-checkboxes input[type="checkbox"]').change(function(e) {
		var checked = $(this).prop("checked"),
			container = $(this).parent().parent(),
			siblings = container.siblings();
		container.find('input[type="checkbox"]').prop({
			indeterminate: false,
			checked: checked
		});
		//checkSiblings(container);
		CallAjaxGetMedia();
	});
	//end checkbox multiple level

	//start add to favorite
	$('.gallery .item-container .hover-menu .anchor-container.heart').on('click', function() {
		$(this).toggleClass("active");
	});
	//end add to favorite

	//start open filters menu
	$('.btn-toggle-fullwidth').on('click', function()
	{
		if(!$('body').hasClass('layout-fullwidth')) {
			$('body').addClass('layout-fullwidth');
		}
		else
			{
			$('body').removeClass('layout-fullwidth');
			$('body').removeClass('layout-default');
			// also remove default behaviour if set
		}
		$(this).find('.lnr').toggleClass('active');
		if($(window).innerWidth() < 1025) {
			if(!$('body').hasClass('offcanvas-active')) {
				$('body').addClass('offcanvas-active');
			} else {
				$('body').removeClass('offcanvas-active');
			}
		}
	});
	$(window).on('load', function() {
		if($(window).innerWidth() < 1025) {
			$('.btn-toggle-fullwidth').find('.icon-arrows')
			.removeClass('icon-arrows-move-left')
			.addClass('icon-arrows-move-right');
		}

		// adjust right sidebar top position
		$('.right-sidebar').css('top', $('.navbar').innerHeight());

		// if page has content-menu, set top padding of main-content
		if($('.has-content-menu').length > 0) {
			$('.navbar + .main-content').css('padding-top', $('.navbar').innerHeight());
		}

		// for shorter main content
		if($('.main').height() < $('#sidebar-nav').height()) {
			$('.main').css('min-height', $('#sidebar-nav').height());
		}
	});

	$('.sidebar a[data-toggle="collapse"]').on('click', function() {
		if($(this).hasClass('collapsed')) {
			$(this).addClass('active');
		} else {
			$(this).removeClass('active');
		}
	});

	if( $('.sidebar-scroll').length > 0 ) {
		$('.sidebar-scroll').slimScroll({
			height: '95%',
			wheelStep: 2,
		});
	}
	//end open filters menu
// panel remove
	// panel collapse/expand

	if( $('.panel-scrolling').length > 0) {
		$('.panel-scrolling .panel-body').slimScroll({
			height: '430px',
			wheelStep: 2,
		});
	}

	if( $('#panel-scrolling-demo').length > 0) {
		$('#panel-scrolling-demo .panel-body').slimScroll({
			height: '175px',
			wheelStep: 2,
		});
	}

	//start current-year
	$("#current-year").html(new Date().getFullYear());
	$(".pagination li").click(function () {
		$(this).addClass("active").siblings().removeClass("active");
	});
	//end current-year
	/*-----------------------------------/
	/* TOASTR NOTIFICATION
	/*----------------------------------*/
	// panel remove
	$('.panel .btn-remove').click(function(e){

		// e.preventDefault();
		$(this).parents('.panel').fadeOut(300, function(){
			$(this).remove();
		});
	});

	// panel collapse/expand
	var affectedElement = $('.panel-body');

	$('.panel .btn-toggle-collapse').clickToggle(
		function(e) {
			// e.preventDefault();

			// if has scroll
			if( $(this).parents('.panel').find('.slimScrollDiv').length > 0 ) {
				affectedElement = $('.slimScrollDiv');
			}

			$(this).parents('.panel').find(affectedElement).slideUp(300);
			$(this).find('i.lnr-chevron-up').toggleClass('lnr-chevron-down');
		},
		function(e) {
			// e.preventDefault();

			// if has scroll
			if( $(this).parents('.panel').find('.slimScrollDiv').length > 0 ) {
				affectedElement = $('.slimScrollDiv');
			}

			$(this).parents('.panel').find(affectedElement).slideDown(300);
			$(this).find('i.lnr-chevron-up').toggleClass('lnr-chevron-down');
		}
	);


});
$.fn.clickToggle = function( f1, f2 ) {
	return this.each( function() {
		var clicked = false;
		$(this).bind('click', function() {
			if(clicked) {
				clicked = false;
				return f2.apply(this, arguments);
			}

			clicked = true;
			return f1.apply(this, arguments);
		});
	});

}








function calculateTotalValue(length) {
	var minutes = Math.floor(length / 60),
		seconds_int = length - minutes * 60,
		seconds_str = seconds_int.toString(),
		seconds = seconds_str.substr(0, 2),
		time = minutes + ':' + seconds

	return time;
}

function calculateCurrentValue(currentTime) {
	var current_hour = parseInt(currentTime / 3600) % 24,
		current_minute = parseInt(currentTime / 60) % 60,
		current_seconds_long = currentTime % 60,
		current_seconds = current_seconds_long.toFixed(),
		current_time = (current_minute < 10 ? "0" + current_minute : current_minute) + ":" + (current_seconds < 10 ? "0" + current_seconds : current_seconds);

	return current_time;
}

$(".jq_player").each(function () {
	initPlayers($(this));
});

function initProgressBar(pl) {
	var player = pl;
	console.log("player",pl);
	var length = player.duration;
	var current_time = player.currentTime;

	// calculate total length of value
	var totalLength = calculateTotalValue(length);
	$(pl).closest(".audio-player").find(".end-time").html(totalLength);

	// calculate current value time
	var currentTime = calculateCurrentValue(current_time);

	$(pl).closest(".audio-player").find(".start-time").html(currentTime);

	var progressbar = $(pl).closest(".audio-player").find('.seekObj')[0];
	progressbar.value = (player.currentTime / player.duration);
	progressbar.addEventListener("click", seek);

	if (player.currentTime == player.duration) {
		$(pl).closest(".audio-player").find(".play-button").removeClass('pause');
	}

	function seek(evt) {
		var percent = evt.offsetX / this.offsetWidth;
		player.currentTime = percent * player.duration;
		progressbar.value = percent / 100;
	}
};

function initPlayers(pl) {
	// pass num in if there are multiple audio players e.g 'player' + i
		(function() {
			// Variables
			// ----------------------------------------------------------
			// audio embed object
			var playerContainer =pl.find(".audio-wrapper")[0],
				player =pl.find("audio")[0],
				isPlaying = false,
				playBtn =pl.find(".play-button")[0];

			// Controls Listeners
			// ----------------------------------------------------------
			if (playBtn != null) {
				playBtn.addEventListener('click', function() {
					togglePlay()
				});
			}
			// Controls & Sounds Methods
			// ----------------------------------------------------------
			function togglePlay() {
				if (player.paused === false) {
					player.pause();
					isPlaying = false;
					$(playBtn).removeClass('pause');

				} else {
					player.play();
					$(playBtn).addClass('pause');
					isPlaying = true;
				}
			}
		}());
}




//start autoplay video on hover
;(function($) {
	$.hoverPlay = {};
	$.fn.hoverPlay = function(options) {
		if (!this.length) { return this; }
		var opts = $.extend(true, {}, $.hoverPlay.defaults, options);
		this.each(function() {
			var el = $(this),
				video = el.get(0);
			if (typeof video['play'] === 'function') {
				video.controls = false;
				video.loop = true;
				el.on('mouseover', function() {
					var timeout = el.data('hoverPlayTimeout');
					if (!timeout) {
						timeout = setTimeout(function() {
							el.data('hoverPlayTimeout', null);
							opts.callbacks.play(el, video);
							el.trigger('hoverPlay');
						}, opts.playDelay);
						el.data('hoverPlayTimeout', timeout);
					}
				}).on('mouseout', function() {
					var timeout = el.data('hoverPlayTimeout');
					if (timeout) {
						clearTimeout(timeout);
						el.data('hoverPlayTimeout', null);
					}
					setTimeout(function() {
						opts.callbacks.pause(el, video);
						el.trigger('hoverPause');
					},  opts.pauseDelay);
				});
			}
		});
		return this;
	};
	$.hoverPlay.defaults = {
		playDelay: 50,
		pauseDelay: 0,
		callbacks: {
			play: function(el,  video) {
				video.play();
			},
			pause: function(el,  video) {
				video.pause();
			}
		}
	};
	jQuery(document).ready(function($) {
		$('[data-play=hover]').hoverPlay();
	});
})(jQuery);
//end autoplay video on hover
