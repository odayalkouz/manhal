




var randomAudio=0;
var player=[];
var controls =['play','progress','duration','mute', 'volume', 'download'];
$(document).ready(function(){

	$('.slider').on('beforeChange', function(event, slick, direction){
		$('.real-content audio').each(function(){
			this.pause();
		});
		$('.play-button').each(function(){
			$(this).removeClass("pause");
		});
	});

	$(".jq_player").each(function () {
		initPlayers($(this));
	});
	if(window.location.href.search("scorm")!=-1){
		$(".coloring-main-container").hide();
	}

	window.player = player;
	$(".plyer-control").each(function () {
		player[randomAudio] = new Plyr(this,{controls});
		randomAudio++;
	});

	$(document).on("click",".jq_recordsound",function () {
		if($(this).hasClass("recording")){
			$(this).removeClass("recording");
			stopRecording($(this).closest(".element"));
		}else{
			$(this).addClass("recording");
			startRecording($(this).closest(".element"));
		}
	});


	$(document).on("click",".element",function(){
		if($(this).attr("voice")!="undefined" && $(this).attr("voice")!=undefined && $(this).attr("voice")!="" && !$(this)[0].hasAttribute("sync")){
			if(!($(this).attr("id") in soundsArr)){
				soundsArr[$(this).attr("id")]=new Howl({	src:$(this).attr("voice")});
				soundsArr[$(this).attr("id")].load();
				stopAllSubtitles();
				soundsArr[$(this).attr("id")].play();
			}else{
				if(soundsArr[$(this).attr("id")].playing()){
					stopAllSubtitles();
				}else{
					stopAllSubtitles();
					soundsArr[$(this).attr("id")].play();
				}
			}
		}else{
			playSubtitle($(this));
		}
	});

	$(document).on("click", "#activation .close-info-popup", function () {
		$("#activation").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated").fadeOut();
		$(".activation-popup-main-container").fadeOut();
		$(".block-mainContainer").fadeOut();
	});
	$(document).on("click", "#message-container .close-info-popup", function () {
		$("#message-container").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated").fadeOut();
		$(".message-main-container").fadeOut();
	});


	$(document).on("click","#signup_button",function(){
		if(!isEmail($("#signup_email").val())){
			showMsg("error",Lang.SignUp,Lang.InvalidEmail);
		}else if($("#signup_pass").val().trim().length<3){
			showMsg("error",Lang.SignUp,Lang.PassTooShort);
		}else if($("#signup_pass").val().trim()!=$("#signup_cpass").val().trim()){
			showMsg("error",Lang.SignUp,Lang.PassNotMatch);
		}else if($("#signup_code").val().trim().length<3){
			showMsg("error",Lang.SignUp,Lang.InvalidActCode);
		}else{
			showLoader();
			var data={};
			data["secret"]=getSecret();
			data["process"]="signup";
			data["lang"]="ar";
			data["email"]=$("#signup_email").val().trim();
			data["pass"]=$("#signup_pass").val().trim();
			data["code"]=$("#signup_code").val().trim();
			data["bookid"]=window.bookid;
			$.ajax({
				url: window.SITE_URL+window.language+"/api/stories",
				type: "POST",
				data: data,
				cache: false,
				dataType:'json',
				success: function(jsonResult){
					console.log("signup",jsonResult);
					hideLoader();
					if(jsonResult.result==1){//success
						// localStorage.userData=JSON.stringify(jsonResult.userData);
						window.location.reload();
					}else if(jsonResult.result==-1){//invalide Code
						showMsg("error",Lang.SignUp,Lang.InvalidActCode);
					}else if(jsonResult.result==-2){//email already exisit
						showMsg("error",Lang.SignUp,Lang.EmailExisit);
					}else{//unexpected
						showMsg("error",Lang.SignUp,jsonResult.msg);
					}
				}
			});
		}
	});
	$(document).on("click","#activate",function(){
		if($("#activate_code").val().trim().length<3){
			showMsg("error",Lang.SignUp,Lang.InvalidActCode);
		}else{
			showLoader();
			var data={};
			data["secret"]=getSecret();
			data["process"]="activateuser";
			data["lang"]=window.language;
			data["code"]=$("#activate_code").val().trim();
			data["bookid"]=window.bookid;
			$.ajax({
				url: window.SITE_URL+window.language+"/api/stories",
				type: "POST",
				data: data,
				cache: false,
				dataType:'json',
				success: function(jsonResult){
					console.log("activation",jsonResult);
					hideLoader();
					if(jsonResult.result==1){//success
						window.location.reload();
					}else{//unexpected
						showMsg("error",Lang.Activation,jsonResult.msg);
					}
				}
			});
		}
	});
	$(document).on("click","#login_button",function(){

		if($("#login_pass").val().trim().length<3){
			showMsg("error",Lang.LogIn,Lang.PassTooShort);
		}else{
			showLoader();
			var data={};
			data["secret"]=getSecret();
			data["process"]="login";
			data["lang"]=window.language;
			data["email"]=$("#login_email").val().trim();
			data["pass"]=$("#login_pass").val().trim();
			data["bookid"]=window.bookid;
			$.ajax({
				url: window.SITE_URL+window.language+"/api/stories",
				type: "POST",
				data: data,
				cache: false,
				dataType:'json',
				success: function(jsonResult){
					console.log("login",jsonResult);
					hideLoader();
					if(jsonResult.result==1){//success
						//userData.user=jsonResult.user;
						//localStorage.userData=JSON.stringify(userData);
						window.location.reload();
					}else if(jsonResult.result==-1){//invalide Code
						showMsg("error",Lang.LogIn,Lang.InvalidUserOrPass);
					}else if(jsonResult.result==-2){//InvalidPermession
						// showMsg("error",Lang.LogIn,Lang.InvalidPermession);
						$(".sign-popup-container .close-info-popup").click();
						setTimeout(function () {
							Openactivation();
						},10)

					}else{//unexpected
						showMsg("error",Lang.SignUp,jsonResult.msg);
					}
				}
			});
		}
	});
	$(document).on("click","#forget_button",function(){
		if(!isEmail($("#forget_email").val())){
			showMsg("error",Lang.error,Lang.InvalidEmail);
		}else{
			showLoader();
			var data={};
			data["secret"]=getSecret();
			data["process"]="forgetpass";
			data["lang"]=window.language;
			data["email"]=$("#forget_email").val().trim();
			$.ajax({
				url: window.SITE_URL+window.language+"/api/stories",
				type: "POST",
				data: data,
				cache: false,
				dataType:'json',
				success: function(jsonResult){
					console.log("forget",jsonResult);
					hideLoader();
					if(jsonResult.result==1){//success
						showMsg("success",Lang.password,Lang.msgSent);
					}else if(jsonResult.result==-1){//invalide Code
						showMsg("error",Lang.password,Lang.cannotSendMsg);
					}else if(jsonResult.result==0){//invalide Code
						showMsg("error",Lang.password,Lang.emailNotRegi);
					}else{//unexpected
						showMsg("error",Lang.password,jsonResult.msg);
					}
				}
			});
		}
	});
});
function showBookMsg(title,msg,iframeID){
	swal({
		title:title,
		text: msg,
		html: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: 'Ok',
		closeOnConfirm: true,
		closeOnCancel: false
	}, function (isConfirm) {
		$("#"+iframeID).find("iframe")[0].contentWindow.replyGame();
	});
}
function getSecret(){
	return "asdjh787AJH23djHFGB6672399GUJHGBnkjgh123fghgasd67HJKV8asbqlga345Fyhasd2343";
}
function addPage(page, book) {
	//
	if (!$(".magazine").turn('hasPage', page)) {
		// Create an element for this page
		var element = $('<div />').html('Loading…');
		// Add the page
		$(".magazine").turn('addPage', element, page);
		//pName=getPagename(page-1);
		pName=getPagename(stoyPages[page-1]);
		console.log("load",pName);
		$.ajax({url: pName+"?v="+window.cacheid,async:true})
			.done(function(data) {

				//setTimeout(function(){
				element.html(data);

				if($('.magazine').turn("display")=="single"){
					element.find(".story-content-container").width(window.realWidth).height(window.realHeight);
				}else{
					element.find(".story-content-container").width(window.realWidth/2).height(window.realHeight);
				}

				element.find(".story-content-container").first().prepend('<div class="gradient"></div>');
				//element.find(".page_container").attr("page_number",page);
				reScale();

				player=[];
				randomAudio=0;
				$(".plyer-control").each(function () {
					player[randomAudio] = new Plyr(this,{controls});
					randomAudio++;
				});
				interactions();
				$(".jq_player").each(function () {
					initPlayers($(this));
				});
			});
	}

}
function gotoPage(actionData) {
	switch(window.contetnType){
		case "story":
			// if($('.magazine').turn("display")=="double"){
				$('.magazine').turn('page', parseInt(actionData["target"])-1);
			// }else{
			// 	$('.magazine').turn('page', parseInt(actionData["target"])+1);
			// }
			break;
		case "slider":
			$('.slider').slick("slickGoTo",parseInt(actionData["target"])-2)
			//console.log("slickGoTo",parseInt(actionData["target"])-2);
			break;
	}
}
function gotoURL(actionData) {
	window.open(actionData["url"]);
}
function gotoNextPage(actionData) {
	switch(window.contetnType){
		case "story":
			$('.magazine').turn('next');
			break;
		case "slider":
			$('.slider').slickNext();
			break;
	}
}
function gotoPreviousPage(actionData) {
	switch(window.contetnType){
		case "story":
			$('.magazine').turn('previous');
			break;
		case "slider":
			$('.slider').slickPrev();
			break;
	}
}
function playObject(actionData) {

}
function showObject(actionData) {

}
function animateObject(actionData) {

}
function showMesg(actionData) {

}
function  openPopUp(actionData) {
	switch(window.contetnType){
		case "story":
			// if($('.magazine').turn("display")=="double"){
			$('.magazine').turn('page', parseInt(actionData["target"])-1);
			// }else{
			// 	$('.magazine').turn('page', parseInt(actionData["target"])+1);
			// }
			break;
		case "slider":
			// $('.slider').slick("slickGoTo",parseInt(actionData["target"])-2);
			$(".Jq_content-action").load(SITE_URL+storyPath+"/pages/"+actionData["target"]+".str");
			OpenActionPopup();
			//console.log("slickGoTo",parseInt(actionData["target"])-2);
			break;
	}

}

function addAction($e,actionType,actionData){
	var cls=makeClass(10);
	$e.addClass(cls);
	console.log("action","$(document).on("+actionType+',.'+cls+',function ()' );
	$(document).on(actionType,"."+cls,function () {
		switch (actionData["do"]) {
			case "Goto_Specific_Page":
				gotoPage(actionData);
				break;
			case "Open_popup":
				openPopUp(actionData);
				break;
			case "Goto_URL":
				gotoURL(actionData);
				break;
			case "Goto_Next_Page":
				gotoNextPage();
				break;
			case "Goto_Previous_Page":
				gotoPreviousPage();
				break;
			case "Play_Object":
				playObject(actionData);
				break;
			case "Show_Object":
				showObject(actionData);
				break;
			case "Hide_Object":
				hideObject(actionData);
				break;
			case "ِAnimate_Object":
				animateObject(actionData);
				break;
			case "Show_message":
				showMesg(actionData);
				break;
		}
	});
}
function removeActionsClass($e){
	var classList;
	// var $e;
	// $(".element").each(function () {
		classList = $e.attr('class').split(/\s+/);
		// $e=$(this);
		$.each(classList, function(index, cls) {
			if (cls.startsWith('action_')) {
				$e.removeClass(cls);
			}
		});
	// });
}
function interactions(){
	var arr=[];
	var acttion_temp={};
	var html="";
	var $temp_li;
	var $e;
	$(".element").each(function () {
		$e=$(this);
		if($e[0].hasAttribute("action")){
			removeActionsClass($e);
			// setTimeout(function ($e) {
				arr=jQuery.parseJSON($e.attr("action"));
				// arr=$e.attr("action");
				console.log("arr "+$e.attr("id"),arr);
				for(var i=0;i<arr.length;i++){
					acttion_temp=arr[i];
					switch (acttion_temp["on"]) {
						case "click":
							addAction($e,"click",acttion_temp);
							break;
						case "doubleclick":
							addAction($e,"dblclick",acttion_temp);
							break;
						case "mouseover":
							addAction($e,"mouseover",acttion_temp);
							break;
						case "startanimate":
							addAction($e,"mouseover",acttion_temp);
							break;
						case "endanimate":
							addAction($e,"mouseover",acttion_temp);
							break;
					}
				}
			// },250,$e);

		}else{
			console.log("no action",$e.attr("id"));
		}
	});

	$temp_li=$(".jq_interaction_container").find("li").last();
	$temp_li.find(".jq_actionon").val(acttion_temp["on"]);
	$temp_li.find(".jq_action_do").val(acttion_temp["do"]);
	$temp_li.find(".Jq_target_Specific_page").attr("target-id",acttion_temp["target"]);
	$temp_li.find(".jq_url_action").val(acttion_temp["url"]);
	$temp_li.find(".jq_sound_effect").val(acttion_temp["sound"]);
	$temp_li.find(".jq_select_object").val(acttion_temp["object"]);
	$temp_li.find(".jq_action_msg").val(acttion_temp["msg"]);
}

function sleep(time,fun) {
	setTimeout(fun,time);
}
function stopAllVideos() {
	$("video").each(function(){
		$(this)[0].pause();
	});
}
function playBgSound(page) {
	console.log("play bg sound",page);
	if(bgSound.playing()){
		bgSound.stop();
	}

	if(!$(".music-button").first().hasClass("active")){
		var thumb_class="";
		switch (contetnType) {
			case "slider":
				if($(".slick-current")[0].hasAttribute("bg_sound") && $(".slick-current").attr("bg_sound")!=""){
					bgSound._src=[window.SITE_URL+window.storyPath+'/sound/'+$(".slick-current").attr("bg_sound")];
					bgSound.load();
				}
				break;
			case "story":
				if($(".magazine").turn("display")=="single"){
					thumb_class=".page-"+page.toString();
				}else{
					if(page==1){
						p2=page-1;
						thumb_class=".page-"+p2.toString();
					}else if(page % 2==0){
						p2=page-1;
						thumb_class=".page-"+p2.toString();
					}else{
						p2=page-1;
						thumb_class=".page-"+p2.toString();
					}

				}

				console.log("play bg thumb",thumb_class);
				if($(thumb_class)[0].hasAttribute("bg_sound") && $(thumb_class).attr("bg_sound")!=""){
					bgSound._src=[window.SITE_URL+window.storyPath+'/sound/'+$(thumb_class).attr("bg_sound")];
					bgSound.load();
				}

				break;

		}


	}
}

function animateWidgets(page) {

	var container1,container2="";
	if($(".magazine").turn("display")=="single"){
		container2=false;
		if(page==1){
			container1=".p1";
		}else if(page % 2==0){
			container1=".p"+page.toString();
		}else{
			container1=".p"+page.toString();
		}

	}else{
		if(page==1){
			container1=".p1";
			container2=".pxxx";
		}else if(page % 2==0){
			p2=page+1;
			container1=".p"+page.toString();
			container2=".p"+p2.toString();
		}else{
			p2=page-1;
			container1=".p"+p2.toString();
			container2=".p"+page.toString();
		}

	}

	console.log(container1,container2);
	animateContainer(container1,container2)

}
function timerAnimate(obj, animation, time, infinite, sound) {
	setTimeout(function () {
		if (infinite == "true") {
			obj.addClass("infinite");
		} else {
			obj.removeClass("infinite");
		}
		obj.addClass("animated jq_timer");
		obj.addClass(animation);
		console.log("animated",animation);
	}, time);
}
function animateContainer(container,next) {
	$(container).find("video").each(function(){
		if($(this).prop("autoplay")){
			$(this)[0].play();
		}
	});
	console.log("animate",container);
	var widgets={};
	var ordered_widget={};
	var widgetLength=0;
	$(container).find(".element").each(function () {
		widgets[$(this).find(".content-of-index").val()]=$(this).attr("id");
		widgetLength++;
	});

	$(container).find(".animated").each(function () {
		if($(this)[0].hasAttribute("data-animation-timer") && $(this).attr("data-animation-timer")!=""){
			var animations = $(this).attr("data-animation-timer").split(",");
			for (i = 0; i < animations.length; i++) {
				if (animations[i] != "" && animations[i] != undefined) {
					options = animations[i].split("@");
					timerAnimate($(this), options[0], parseInt(options[1]), options[2], options[3]);
				}
			}
		}
	});

	console.log(widgets);
var i=0;
	Object.keys(widgets).sort().forEach(function(key) {
		i++;
		ordered_widget[key] = widgets[key];
		console.log(key,widgets[key]);
		if($("#"+widgets[key])[0].hasAttribute("timedelay") && $("#"+widgets[key])[0].hasAttribute("timedelay")!="-1" && $("#"+widgets[key])[0].hasAttribute("timedelay")!=-1){
			console.log(widgets[key]," is delay");
			millSeconds=parseFloat($("#"+widgets[key]).attr("timedelay"))*1000;
			sleep(millSeconds,function () {
				//playSubtitle($("#"+widgets[key]));
				$("#"+widgets[key]).show();
				if(next!==false && i==widgetLength){
					animateContainer(next,false);
				}
			});
		}else{
			console.log(widgets[key]," no delay");
			//playSubtitle($("#"+widgets[key]));
			$("#"+widgets[key]).show();
			console.log(widgets[key]," after show");
			if(next!==false && i==widgetLength){
				animateContainer(next,false);
			}
		}
	});

		if(next!==false && widgetLength==0){
				animateContainer(next,false);
		}
}
function pauseAllSubtitles() {
	for (var key in soundsArr) {
		if(key.indexOf("Interval")==-1){
			if(soundsArr[key].playing()){
				soundsArr[key].pause();
			}
		}
	}
}

function stopAllSubtitles() {
	for (var key in soundsArr) {
		if(key.indexOf("Interval")==-1){
			if(soundsArr[key].playing()){
				soundsArr[key].stop();
				clearInterval(soundsArr[key+"Interval"]);
			}
		}
	}
}

function playAllSubtitles() {
	for (var key in soundsArr) {
		if(key.indexOf("Interval")==-1){
			if(!soundsArr[key].playing()){
				soundsArr[key].play();
			}
		}
	}
}

function playSubtitle(widget) {
	window.widgetID = widget.attr("id");
	var Asize1= parseFloat($("#"+window.widgetID).find(".real-content").children("span").css('font-size'));
	var Alineheight1= parseFloat($("#"+window.widgetID).find(".real-content").children("span").css('line-height'));

	if(widget.attr("sync")!="undefined" && widget.attr("sync")!=undefined && widget.attr("sync")!=""){
		setTimeout(function () {
			if($("#"+window.widgetID).find(".real-content").children("b")) {
				$("#"+window.widgetID).find(".real-content").children("span").css('font-weight',"bold")
			}
			$("#"+window.widgetID).find(".real-content").children("span").css('font-size',Asize1)
			$("#"+window.widgetID).find(".real-content").children("span").css('line-height',Alineheight1+"px")
		},5);
		stopAllSubtitles();
		widget.find(".highlight").removeClass("highlight");
		var data= $.parseJSON(widget.attr("sync"));
		var html='';
		for(var i=0; i < data.length; i++){
			html+='<span start="'+parseFloat(data[i].begin).toFixed(1)+'" end="'+parseFloat(data[i].end).toFixed(1)+'" id="'+data[i].id+'" class="jq_word">'+data[i].lines[0]+' </span>';
		}
		widget.find(".real-content").html(html);

	if(!($(this).attr("id") in soundsArr)) {
		soundsArr[widget.attr("id")]=new Howl({	src:widget.attr("voice")});
		soundsArr[widget.attr("id")].load();
	}else{
		if(soundsArr[widget.attr("id")].playing()){
			stopAllSubtitles();
			widget.find(".highlight").removeClass("highlight");
			return;
		}else{
			stopAllSubtitles();
			$(".highlight").removeClass("highlight");
			//soundsArr[$(this).attr("id")].play();
		}
	}
		soundsArr[widget.attr("id")].play();
		soundsArr[widget.attr("id")].on('end', function(){
			//soundsArr[widget.attr("id")].unload();
			clearInterval(soundsArr[widget.attr("id")+"Interval"]);
		});

		// Fires when the sound finishes playing.
		soundsArr[widget.attr("id")].on('play', function(){
			var Interval=0.0;
			soundsArr[widget.attr("id")+"Interval"]=setInterval(function(){
				if(!SpeakPause){
					Interval=Interval.toFixed(1);
					console.log("span[start='"+Interval+"']");
					widget.find("span[end='"+Interval+"']").removeClass("highlight");
					widget.find("span[start='"+Interval+"']").addClass("highlight");
					Interval= Math.round( Interval * 10 ) / 10+0.1;
					Interval=parseFloat(Interval.toFixed(1));
				}
			}, 100);
		});


	}
}

function getPagename(page){
	pageName=window.SITE_URL+window.storyPath+"/pages/"+page+".str";
	return pageName;
}

/*
 * Magazine sample
 */


function reScale(){

	if($('.magazine').turn("display")=="single"){
		scale=$('.magazine').height()/window.realHeight;
		$(".story-content-container").css("transform","scale("+scale+")");
	}else{
		scale=$('.magazine').width()/window.realWidth;
		// $(".story-content-container").width(window.realWidth/2);
		// $(".story-content-container").height(window.realHeight);
		$(".story-content-container").css("transform","scale("+scale+")");
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
		$('.slick-prev').hide();
	else
		$('.slick-prev').show();

	if (page==$('.magazine').turn('pages'))
		$('.slick-next').hide();
	else
		$('.slick-next').show();
}
function resizeViewport() {
	// if(!window.fullScreen){
		var width = $(window).width(),
			height = $(window).height(),
			options = $('.magazine').turn('options');

		$('.magazine').removeClass('animated');


		// $('.magazine-viewport').css({
		// 	width: width,
		// 	height: height
		// }).
		// zoom('resize');


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

				// $('.next-button').css({height: bound.height, backgroundPosition: '-38px '+(bound.height/2-32/2)+'px'});
				// $('.previous-button').css({height: bound.height, backgroundPosition: '-4px '+(bound.height/2-32/2)+'px'});
			}
			$('.magazine').css({top:($(".container").offset().top)*-1, left: -bound.width/2});
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

				$('.magazine').css({top:($(".container").offset().top)*-1, left: -bound.width/2});

			}else{
				newWidth=window.bookWidth;
				p=newWidth/window.bookWidth*2;
				$(".magazine").width(newWidth);

				// $(".magazine").css("left",($(window).width()-$(".magazine").width()/2-$(".container").offset().left));
			}
			$('.magazine').css({top:($(".container").offset().top-$(window).height()*0.03)*-1, left: -bound.width/2});

			$(".magazine").css("left",($(window).width()-$(".magazine").width())/2-$(".container").offset().left);


		}else{
			$('.magazine').css({top:($(".container").offset().top-($(window).height()-$(".magazine").height()-$(".footer-main-container").height())/2)*-1, left: -bound.width/2});
			$(".magazine").css("left",($(window).width()-$(".magazine").width())/2-$(".container").offset().left);
		}
	// }
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
		return window.bookWidth;
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
function makeClass(length) {
	var result           = 'action_';
	var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	var charactersLength = characters.length;
	for ( var i = 0; i < length; i++ ) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
	}
	return result;
}
