function showProprties() {
	
	if ($(".editPoint-popup").length) $(".editPoint-popup").remove();
	
	str = '<div class="editPoint-popup">' +
		'<div class="header-popup">' +
		'<i class="floating-left"></i>' +
		'<label class="floating-left">Properties</label>' +
		'</div>' +
		'<div class="tools-container">' +
		'<div class="line-row opacity">' +
		'<div class="icon-tools floating-left"></div>' +
		'<div class="toolsContainer floating-left">' +
		'<label>Add Text like A ,B , ....</label>' +
		'<i class="floating-left"></i>' +
		'<input onkeyup="updatetext()" type="text" class="floating-left" placeholder="type ..." value="' + ActiveElement.text + '" id="ObjectText">' +
		'</div>' +
		'</div>' +
		'<div class="editPoint-popup-footer">' +
		
		'<a class="btn remove" onclick="removeFile(this)"><i></i></a>' +
		'</div>' +
		'</div>' +
		'</div>'
	// str = '<div class="proprties">' +
	//     '' +
	//     '<div class="proprtiesContainer">' +
	//     '' +
	//     '<div class="headProprties">' +
	//     '<label>Proprties</label>' +
	//     '<img class="closePng" onclick="closeProprties()" src="images/close.png">' +
	//     '</div>' +
	//     '' +
	//     '<div class="bodyProprties">' +
	//     '' +
	//         //'<section class="section">' +
	//         //'<label>Thumb</label>' +
	//         //'<input type="text" value="../games/' + config.rootPath + "/" + ActiveElement.src + '" id="ObjectImage">' +
	//         //
	//         //'<img  class="thumb" src="../games/' + config.rootPath + "/" + ActiveElement.src + '">' +
	//         //'</section>' +
	//     '' +
	//     '<section class="section ">' +
	//     '<label>Text</label>' +
	//     '<input type="text" value="' + ActiveElement.text + '" id="ObjectText">' +
	//     '<button type="button" onclick="updatetext()" id="saveEdit">saveEdit</button>' +
	//     '</section>' +
	//     '' +
	//         //'<section class="section">' +
	//         //'<label>sound</label>' +
	//         //'<input type="text" value="' + ActiveElement.sound + '" id="ObjectSound">' +
	//         //'<button type="button" onclick="soundEdit()" id="sound">sound</button>' +
	//         //'<audio id="audioPreview" controls>' +
	//         //'<source src="' + ActiveElement.sound + '">' +
	//         //'</audio>' +
	//         //'</section>' +
	//     '' +
	//     '' +
	//     '' +
	//     '</div>' +
	//     '' +
	//     '<div class="footerProprties">' +
	//
	//     '</div>' +
	//     '' +
	//     '</div>' +
	//
	//     '</div>'
	
	$(str).appendTo('.ContainerEditor')
}

function showSetting() {
	
	if ($(".proprties").length) $(".proprties").remove();
	
	str = '<div class="setting proprties">' +
		'' +
		'<div class="proprtiesContainer" style="height: 645px;">' +
		'' +
		'<div class="headProprties">' +
		'<label>Proprties</label>' +
		'<a class="closePng" onclick="closeProprties()"><i></i></a>' +
		'</div>' +
		'' +
		'' +
		'' +
		'' +
		
		'<div class="bodyProprties" style="height: 542px">' +
		'' +
		'<section class="section settingSection backgroundSound">' +
		'<div class="title-icon floating-left"></div>' +
		'<div class="title-container floating-left"><span class="main-title">Background sound</span><span class="sub-title">Add backgroud sound to this file</span></div>' +
		'<div class="check-container-onOf floating-right">' +
		'<input type="checkbox" id="backgroundSoundCheck"  >' +
		'<div class="check">' +
		'</div></div>' +
		'<div class="line-black"></div>' +
		'<div class="sound-upload-container">' +
		'<input  readonly style="margin-top: 9px;width: 406px" class="text-fild-upload floating-left" type="text" value="' + config.rootPath + lang + "/" + game.backgroundSound + '" id="ObjectSound">' +
		'<a style="margin: 9px 0 0 33px" class="soundUpload floating-left" onclick="soundEditBackground()" id="sound"><i></i></a>' +
		'<div id="wrapper" class="audio-container">' +
		'<audio id="audioPreview" controls>' +
		'<source src="' + config.rootPath + lang + "/" + game.backgroundSound + '">' +
		'</audio>' +
		'</div>' +
		'</div>' +
		'</section>' +
		'' +
		'' +
		'' +
		'<section class="section settingSection backgroundImage">' +
		'<div class="title-icon floating-left"></div>' +
		'<div class="title-container floating-left">' +
		'<span class="main-title">Background </span>' +
		'<span class="sub-title">Add backgroud to this file</span>' +
		'<input readonly style="margin-top: 20px" class="text-fild-upload" type="text" value="' + config.rootPath + lang + "/" + game.backgroundImage + '" id="bgImage">' +
		'</div>' +
		'<div class="upload-icon floating-right" style="margin-top: 10px">' +
		'<a class="upload-btn" onclick="bgEditBackground()" id="bgEditt"><i></i></a>' +
		'<div class="iconContainerTitle"><img class="thumb iconTitle" src="' + config.rootPath + lang + "/" + game.backgroundImage + "?" + Math.random() + '">' +
		'<a class="imageName">Empty Image</a>' +
		'</div>' +
		'</div>' +
		
		'<div class="upload-icon floating-right" style="margin-top: 10px">' +
		'<a class="upload-btn" onclick="bgEditBackgroundFull()" id="bgEdittFull"><i></i></a>' +
		'<div class="iconContainerTitle2"><img class="thumb iconTitle" src="' + config.rootPath + lang + "/images/bg1.png?" + Math.random() + '">' +
		'<a class="imageName">Full Image</a>' +
		'</div>' +
		'</div>' +
		'</section>' +
		'' +
		'' +
		'<section class="section settingSection backgroundColorPage">' +
		'<div class="title-icon floating-left"></div>' +
		'<div class="title-container floating-left">' +
		'<span class="main-title">Background </span>' +
		'<span class="sub-title">Add backgroud to this file</span>' +
		
		'</div>' +
		'<div class="coloringbg floating-left">' +
		'<input id="colorPic_background" name="colorPic_background" type="text" value="' + game.option.bgColor + '"/>' +
		'</div>' +
		'<div class="coloringbg floating-left">' +
		'<button type="button" id="noneBG"></button>' +
		'<div class="hr"></div>' +
		'</div>' +
		'</section>' +
		'' +
		'' +
		
		'' +
		
		'<section class="section settingSection backgroundSoundWin">' +
		'<div class="title-icon floating-left"></div>' +
		'<div class="title-container floating-left"><span class="main-title">win sound</span><span class="sub-title">Add win sound to this file</span></div>' +
		'<div class="check-container-onOf floating-right">' +
		'<input type="checkbox" id="WinSoundCheck"  >' +
		'<div class="check"></div></div>' +
		'<div class="line-black"></div>' +
		'<div class="sound-upload-container">' +
		'<input readonly style="margin-top: 9px;width: 406px" class="text-fild-upload floating-left" type="text" value="' + config.rootPath + lang + "/" + game.WinSound + '" id="SoundWinVal">' +
		'<a style="margin: 9px 0 0 33px" class="soundUpload floating-left" onclick="uploadsoundWin()" id="sound"><i></i></a>' +
		'<div id="wrapper" class="audio-container">' +
		'<audio id="audioPreviewWin" controls>' +
		'<source src="' + config.rootPath + lang + "/sound/win.mp3" + '">' +
		'</audio>' +
		'</div>' +
		'</div>' +
		'</section>' +
		'' +
		'' +
		'' +
		'</div>' +
		'' +
		'<div class="footerProprties">' +
		'<a onclick="closeProprties()" class="ok-btn floating-right" id="bgEditt"><i></i></a>' +
		'</div>' +
		'' +
		'</div>' +
		
		'</div>'
	
	$(str).appendTo('body')
	// $(function () {
	//     $("audio").audioPlayer();
	// });
	
	$('#backgroundSoundCheck').prop('checked', game.option.noBackgrondSound);
	$("#WinSoundCheck").prop('checked', game.option.noWinSound);
	
	$('#backgroundSoundCheck').on('change', function () {
		var val = this.checked
		setBackgroundSoundActive(val)
	});
	
	$("#colorPic_background")
		.colorPicker()
		.val(game.option.bgColor)
		.change()
		.change(function (value) {
			console.log(value)
			game.option.bgColor = value.target.value
			$(".gameContainer").css({
				background: game.option.bgColor
			})
		})
	
	$('#WinSoundCheck').on('change', function () {
		var val = this.checked
		setWinSoundActive(val)
		
	});
	$('#noneBG').on('click', function () {
		$(".gameContainer").css({
			background: "#ffffff"
		})
		$("#colorPic_background").val("#ffffff").change()
	});
}

function setBackgroundSoundActive(val) {
	
	game.option.noBackgrondSound = val
}

function setWinSoundActive(val) {
	
	game.option.noWinSound = val
}

function addTitle() {
	if ($(".proprties.addTitle").length) $(".proprties.addTitle").remove();
	str = '<div class="proprties addTitle">' +
		'<div class="proprtiesContainer" style="height: 435px;">' +
		'<div class="headProprties">' +
		'<label>Add Title</label>' +
		'<a class="closePng" onclick="closeProprties()"><i></i></a>' +
		'</div>' +
		'<div class="bodyProprties">' +
		'<section class="section settingSection text">' +
		'<textarea onkeyup="savetitle()" class="titleText" placeholder="Enter title text" type="text" value="" id=""></textarea>' +
		'</section>' +
		'<section class="section settingSection icon">' +
		'<div class="title-icon floating-left"></div>' +
		'<div class="title-container floating-left">' +
		'<span class="main-title">Icon</span>' +
		'<span class="sub-title">Add icon for the title </span>' +
		'<input class="text-fild-upload" readonly="" type="text" value="' + config.rootPath + lang + '/images/titleIcon.png"  id="ObjectSound">' +
		'</div>' +
		'<div class="upload-icon floating-right">' +
		'<a class="upload-btn" type="button" onclick="uploadIconTitle()" id="sound"><i></i></a>' +
		'<div class="iconContainerTitle"><img class="iconTitle" src="' + config.rootPath + lang + '/images/titleIcon.png?0.73892472067836"></div>' +
		'</div>' +
		'</section>' +
		'</div>' +
		'<div class="footerProprties">' +
		'<a class="ok-btn floating-right" onclick="savetitle(); $(\'.addTitle\').hide()" id="bgEditt"><i></i></a>' +
		'</div>' +
		'</div>' +
		'</div>'
	
	$(str).appendTo('body')
	loadTitleTobox()
}


function loadTitleTobox() {
	$(".titleText").val(game.titleText)
}

function uploadIconTitle() {
	simulateUpload($('#uploadIconTitle'))
}


function savetitle() {
	game.titleText = $(".titleText").val()
	Lobibox.notify("success", {
		msg: "Title Change"
	});
	
}
function closeProprties() {
	if ($(".proprties").length) $(".proprties").remove();
	
}
function soundEdit() {
	simulateUpload($('#uploadsoundObject'))
}
function soundEditBackground() {
	simulateUpload($('#uploadBackgroundSound'))
}

function uploadsoundWin() {
	simulateUpload($('#uploadsoundWin'))
}

function bgEditBackground() {
	simulateUpload($('#uploadBackground'))
}
function bgEditBackgroundFull() {
	simulateUpload($('#uploadBackgroundFull'))
}


function getCssValue() {
	
	$("#opacityObject").val(game.objects[ActiveElement.index].opacity)
}

function onOpacityChange(object) {
	
	$("#" + ActiveElement.id).find('img').css('opacity', $(object).val());
	
	updateOpacity($(object).val())
}

function changeWidthLine(object) {
	
	value = $(object).val();
	$("#outputchangeWidthLine").html(value)
	game.option.widthLine = value
}


function BringToFront() {
	
	if (ActiveElement == "") {
		alert("Select object!")
		return
	}
	maxValus = 0
	length = game.objects.length;
	objects = game.objects
	
	
	for (i = 0; i < length; i++) {
		
		if (maxValus < objects[i].zIndex) {
			
			maxValus = objects[i].zIndex
		}
		
	}
	maxValus = eval(maxValus + 1)
	
	setZindex(maxValus)
}

function SendToBack() {
	if (ActiveElement == "") {
		alert("Select object!")
		return
	}
	minValue = 0
	length = game.objects.length;
	objects = game.objects
	
	
	for (i = 0; i < length; i++) {
		if (minValue < objects[i].zIndex) {
			
			minValue = objects[i].zIndex
		}
		
	}
	minValue = eval(minValue - 1)
	
	setZindex(minValue)
}

function BringForward() {
	if (ActiveElement == "") {
		alert("Select object!")
		return
	}
	value = game.objects[ActiveElement.index].zIndex;
	value = eval(value + 1)
	setZindex(value)
}

function SendBackward() {
	if (ActiveElement == "") {
		alert("Select object!")
		return
	}
	value = game.objects[ActiveElement.index].zIndex;
	value = eval(value - 1)
	setZindex(value)
	
}


function setZindex(value) {
	if (ActiveElement == "") {
		alert("Select object!")
		return
	}
	game.objects[ActiveElement.index].zIndex = value;
	//alert(value)
	$("#" + ActiveElement.id).css('z-index', value);
	
}

function flipObject() {
	
	if (ActiveElement == "") {
		alert("Select object!")
		return
	}
	
	flip = game.objects[ActiveElement.index].flip
	
	if (flip) {
		flipValue = 1
		game.objects[ActiveElement.index].flip = false
	}
	else {
		flipValue = -1
		game.objects[ActiveElement.index].flip = true
	}
	
	
	$("#" + ActiveElement.id).find('img').css({
		'-moz-transform': 'scaleX(' + flipValue + ')',
		'-o-transform': 'scaleX(' + flipValue + ')',
		'-webkit-transform': 'scaleX(' + flipValue + ')',
		'transform': 'scaleX(' + flipValue + ')',
		
	});
}


function saveEditObjectproprties() {
	AddText()
}

saveType = "save"
function previewGame() {
	saveType = "preview"
	
	ajaxPHP(config.rootPath + "/js/", "", "JsonFile", "game.js", "saveJson", "");
	
	
}

function readyToPreview() {
	
	// if ($('.iframeContainerP').length)$('.iframeContainerP').remove()
	// str = '<div class="iframeContainerP">' +
	//     '<div class="iframeWrapper">' +
	//     '<iframe class="iframeEditor" src="' + config.rootPath + '/index.html?' + Math.random() + '"></iframe>' +
	//     '</div>' +
	//     '<img class="closeBtn" onclick="closeIframeGameP()" src="images/close.png">' +
	//     '</div>'
	//
	// $(str).appendTo('body');
	// parent.$(".closeBtn").hide()
	
	
	var a = document.createElement("a");
	a.target = "_blank";
	a.href = "viewer/" + lang + "/index.php?id=" + config.GameID;
	a.click();
	a.remove();
}

function closeIframeGameP() {
	parent.$(".closeBtn").show()
	if ($('.iframeContainerP').length) $('.iframeContainerP').remove()
}
/////////////////////////////////////////////////////color


function DrawingColorsBox() {
	
	strColors = ""
	$(".colorPicker-palette").remove()
	length = game.option.color.length
	colors = game.option.color
	$(".btn").removeClass("selected");
	$(".btn.draw").addClass("selected");
	if ($(".proprties").length) {
		$(".proprties").remove()
	}
	
	var poTop = $(".btn.draw");
	var offset = poTop.offset()
	
	
	str = '<div class="DrawingColorsBox proprties" style="top: ' + (offset.top - 70) + '">' +
		'<div class="proprtiesContainer">' +
		'' +
		'<div class="headProprties ">' +
		'<label>Drawing Color</label>' +
		'</div>' +
		'<div class="bodyProprties">' +
		'<div class="line-row">' +
		'<p class="drawing-text">Allow drawing and painting after end  the game</p>' +
		'</div>' +
		'<div class="line-row">' +
		'<div class="icon-tools paint floating-left"></div>' +
		'<div class="toolsContainer floating-left">' +
		'<div class="check-container-onOf floating-left"><input type="checkbox" id="DrawingImage" name="NorL" onchange="DrawingImage(this)" oninput="DrawingImage(this)"><div class="check"></div></div>' +
		'</div>' +
		'</div>' +
		'<div class="line-row color" style="border-top: 4px solid #343434;height: 147px">' +
		'<div class="icon-tools color-palt floating-left"></div>' +
		'<div class="toolsContainer floating-left">' +
		'<div class="color-container-paint"></div>' +
		'<a class="btn-add-color" onclick="addNewColor()"><i></i></a>' +
		'<a class="btn-remove-color" onclick="removeColor()"><i></i></a>' +
		'</div>' +
		'</div>' +
		'</div>' +
		'</div>' +
		'</div>'
	
	$(str).appendTo('.work-area')
	
	
	for (i = 0; i < length; i++) {
		
		strColors = '<div index="' + i + '" class="coloring">' +
			// '<label for="colorDrawingPallete_' + i + '">Color_' + i + ' </label>' +
			'<input  index="' + i + '" id="colorDrawingPallete_' + i + '" name="colorDrawingPallete_' + i + '" type="text" value="' + colors[i] + '" /></div>'
		
		$(strColors).appendTo('.bodyProprties .line-row.color .toolsContainer .color-container-paint').click(function () {
			$(".coloring").removeClass('activeColor')
			$(this).addClass('activeColor')
		})
		
		$("#colorDrawingPallete_" + i)
			.colorPicker()
			.val(colors[i])
			.change()
			.change(function (value) {
				index = $(this).attr('index');
				game.option.color[index] = value.target.value
			})
		
	}
	
	loadOption()
}
function lineOpction() {
	$(".btn").removeClass("selected");
	$(".btn.line-option").addClass("selected");
	if ($(".proprties").length) {
		$(".proprties").remove()
	}
	var poTop = $(".btn.line-option");
	var offset = poTop.offset()
	str = '<div class="line-opction proprties" style="top: ' + (offset.top - 70) + '">' +
		'<div class="proprtiesContainer">' +
		'' +
		'<div class="headProprties ">' +
		'<label>Line setting</label>' +
		'</div>' +
		'<div class="bodyProprties">' +
		'<div class="line-row">' +
		'<div class="icon-tools line-width floating-left"></div>' +
		'<div class="toolsContainer floating-left">' +
		'<input class="floating-left" type="range" id="changeWidthLine" min="1" max="25" step="1" value="2" onchange="changeWidthLine(this)" oninput="changeWidthLine(this)">' +
		'<div class="rang-number floating-left"><span><output name="x" id="outputchangeWidthLine"></output></span></div>' +
		'</div>' +
		'</div>' +
		'<div class="line-row color" style="border-top: 4px solid #343434;">' +
		'<div class="icon-tools color-palt floating-left"></div>' +
		'<div class="toolsContainer floating-left">' +
		'<div class="color-icon floating-left">' +
		'<input id="lineColor" name="TextColor" type="text" value="' + game.option.colorLine + '"/>' +
		'</div>' +
		'</div>' +
		'</div>' +
		'</div>' +
		'</div>' +
		'</div>'
	
	$(str).appendTo('.work-area')
	$('#lineColor').colorPicker()
		.val(game.option.colorLine)
		.change(function (value) {
			game.option.colorLine = value.target.value
		});
	
	loadOption()
}
function pointOpction() {
	
	$(".btn").removeClass("selected");
	$(".btn.point-opction").addClass("selected");
	if ($(".proprties").length) {
		$(".proprties").remove()
	}
	var poTop = $(".btn.point-opction");
	var offset = poTop.offset()
	str = '<div class="point-opction proprties" style="top: ' + (offset.top - 70) + '">' +
		'<div class="proprtiesContainer">' +
		'' +
		'<div class="headProprties ">' +
		'<label>Point setting</label>' +
		'</div>' +
		'<div class="bodyProprties">' +
		'<div class="left-container floating-left">' +
		'<div class="line-row">' +
		'<div class="icon-tools point-shape floating-left"></div>' +
		'<div class="toolsContainer floating-left">' +
		'<div class="check-container-onOf floating-left"><input type="checkbox" id="visiblePointes" name="NorL" onchange="visiblePointes(this)" oninput="visiblePointes(this)"><div class="check"></div></div>' +
		'</div>' +
		'</div>' +
		'<div class="line-row color">' +
		'<div class="icon-tools color-palt floating-left"></div>' +
		'<div class="toolsContainer floating-left">' +
		'<div class="color-label-2 floating-left"></div>' +
		'<div class="coloring floating-left">' +
		'<input id="TextColor" name="TextColor" type="text" value="#333399"/>' +
		'</div>' +
		'<div class="color-label-1 floating-left"></div>' +
		'<div class="coloring floating-left">' +
		'<input id="lineWidthColor" name="lineWidthColor" type="text" value="#333399"/>' +
		'</div>' +
		'</div>' +
		'</div>' +
		// '<div class="line-row color">' +
		// '<div class="icon-tools point-number-start floating-left"></div>' +
		// '<div class="toolsContainer floating-left">' +
		// '<label class="floating-left">Start Number</label><input class="start-number-input floating-left" type="text" id="startnumber" name="NorL" onchange="startCounter(this)" oninput="startCounter(this)" value="0" placeholder="type ...">' +
		// '</div>' +
		// '</div>' +
		'<div class="line-row color">' +
		'<div class="icon-tools point-show-number floating-left"></div>' +
		'<div class="toolsContainer floating-left">' +
		'<div class="check-container-onOf floating-left"><input type="checkbox" id="LetterOrNumber" name="NorL" onchange="LetterOrNumber(this)" oninput="LetterOrNumber(this)"><div class="check"></div></div>' +
		'</div>' +
		'</div>' +
		// '<div class="line-row">' +
		// '<div class="icon-tools font-size floating-left"></div>' +
		// '<div class="toolsContainer floating-left">' +
		// '<input id="fontSizeChange" onchange="resizeFonts(this)" oninput="resizeFonts(this)" class="floating-left" type="range" min="1" max="5" step=".1" value="' + game.option.fontSize + '">' +
		// '<div class="rang-number floating-left">' +
		// '<span><output id="sizefonts" name="x" id="outputchangeWidthLine">2</output></span>' +
		// '</div>' +
		// '</div>' +
		// '</div>' +
		'<div class="line-row">' +
		'<div class="icon-tools dont-size floating-left"></div>' +
		'<div class="toolsContainer floating-left">' +
		'<input id="sizeDots"  class="floating-left" onchange="resizeDots(this)" oninput="resizeDots(this)" name="sizedots" type="range" min="1" max="5" step="0.1" value="' + game.option.widthCircle + '">' +
		'<div class="rang-number floating-left">' +
		'<span><output id="sizedots" name="x" id="outputchangeWidthLine">2</output></span>' +
		'</div>' +
		'</div>' +
		'</div>' +
		'</div>' +
		'<div class="right-container floating-left">' +
		'<label class="preview-title">Preview</label>' +
		'<div class="preview-container">' +
		'<div class="preview-inner-container">' +
		'<div class="elementResizableoption" style="top: 13.6054%; left: 58.0782%;"><div class="dot"></div><div class="dot_number" style="font-size: 2vw;margin-top: 86%;">1</div></div>' +
		'<div class="elementResizableoption" style="top: 61.6054%; left: 35.0782%;"><div class="dot"></div><div class="dot_number" style="font-size: 2vw;margin-top: 86%;">2</div></div>' +
		'</div> ' +
		'</div>' +
		'<a class="btn cancel-btn floating-right"><i></i></a>' +
		'<a class="btn ok-btn floating-right"><i></i></a>' +
		'</div> ' +
		'</div>' +
		'</div>' +
		'</div>'
	
	$(str).appendTo('.work-area')
	$('#TextColor').colorPicker()
		.change(function (value) {
			game.option.textColor = value.target.value
			$(".dot_number").css({
				color: value.target.value
			})
		});
	$("#sizeDots").change()
	$("#fontSizeChange").change()
	loadOption()
	if (game.option.visible) {
		$("#visiblePointes").prop("checked", true);
		
		$('#lineWidthColor').colorPicker()
			.change(function (value) {
				game.option.circleColor = value.target.value
				$(".dot_container").css({
					background: "transparent",
					border: "1px solid red"
				})
				refresh()
			});
		
	} else {
		
		$('#lineWidthColor').colorPicker()
			.change(function (value) {
				game.option.circleColor = value.target.value
				$(".dot_container").css({
					background: value.target.value
				})
				refresh()
			});
	}
	
	
}

function resizeDots(object) {
	
	val = $(object).val();
	$("#sizedots").val(val)
	$(".elementResizable").css({
		width: val + "vw",
		height: val + "vw",
	})
	// $(".elementResizable").each(function(index){
	//
	//     y=game.objects[index].top
	//     x=parseInt($(this).css("left"))
	//
	//     $(this).css({
	//         left:x-val+"px",
	//         top:y-val+"px",
	//     })
	// })
	game.option.widthCircle = val
	resizeGame()
}

function resizeFonts(object) {
	val = $(object).val();
	$("#sizefonts").val(val)
	game.option.fontSize = val
	$(".dot_number").css({
		'font-size': val + "vw"
	})
	
}

function settingsImage() {
	$(".btn").removeClass("selected");
	$(".btn.settings-image").addClass("selected");
	if ($(".proprties").length) {
		$(".proprties").remove()
	}
	var poTop = $(".btn.settings-image");
	var offset = poTop.offset()
	str = '<div class="settings-image proprties" style="top: ' + (offset.top - 70) + '">' +
		'<div class="proprtiesContainer">' +
		'' +
		'<div class="headProprties ">' +
		'<label>Image setting</label>' +
		'</div>' +
		'<div class="bodyProprties">' +
		'<div class="line-row">' +
		'<label class="settings-image-lbl">Allow See the image after end the game</label>' +
		'</div>' +
		'<div class="line-row">' +
		'<div class="icon-tools image-view floating-left"></div>' +
		'<div class="toolsContainer floating-left">' +
		'<div class="check-container-onOf floating-left"><input type="checkbox" id="ShowImageOption" name="NorL" onchange="ShowImageOption(this)" oninput="ShowImageOption(this)"><div class="check"></div></div>' +
		'</div>' +
		'</div>' +
		'<div class="line-row">' +
		'<div class="icon-tools line-view floating-left"></div>' +
		'<div class="toolsContainer floating-left">' +
		'<div class="check-container-onOf floating-left"><input type="checkbox" id="hidePointsWhenWin" name="NorL" onchange="hidePointsWhenWin(this)" oninput="hidePointsWhenWin(this)"><div class="check"></div></div>' +
		'</div>' +
		'</div>' +
		'</div>' +
		'</div>' +
		'</div>'
	
	$(str).appendTo('.work-area')
	loadOption()
}
function addNewColor() {
	
	if (game.option.color.length >= 12) {
		alert("you can not add more than 15 colors>")
		return
	}
	game.option.color.push("#0000ff")
	DrawingColorsBox()
}


function removeColor() {
	
	if (game.option.color.length == 0) {
		
		alert('There is no color.')
		return
	}
	
	if ($(".activeColor").length) {
		index = $(".activeColor").attr('index')
		if (index > -1) {
			game.option.color.splice(index, 1);
		}
		DrawingColorsBox()
	}
	else {
		alert('select Color')
	}
	
}

function removeMsg() {
	$(".message-mine-container").remove();
}


function errorMessage() {
	str = '<div class="message-mine-container">' +
		'<div class="message-inner-container">' +
		'<div class="header">' +
		'<a onclick="removeMsg()" class="CloseButtonMSg"><i></i></a>' +
		'<label>Error</label>' +
		'</div>' +
		'<div class="message-body">' +
		'<div class="message-icon FileError floating-left"></div>' +
		'<label class="message-lbl floating-left">invalid Image Type.</label>' +
		'</div>' +
		'</div>' +
		'</div>'
	$(str).appendTo('body')
}