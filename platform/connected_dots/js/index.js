var game = {
		element: $(".gameContainer"),
		width: 1280,
		height: 800,
		safeWidth: 1024,
		safeHeight: 720,
		backgroundImage: "images/bg.png",
		backgroundSound: "sound/bg.mp3",
		WinSound: "sound/WinSound.mp3",
		titleText: "",
		option: {
			LetterOrNumber: true,
			ShowImage: true,
			hidePointsWhenWin: true,
			visible: true,
			orderValue: 0,
			drawing: false,
			color: ["#333399", "#ff0000", "#3366ff"],
			widthLine: 2,
			colorLine: "black",
			circleColor: "blue",
			textColor: "black",
			widthCircle: "1.5",
			fontSize: "1.5",
			bgColor: "#ffffff",
			format_arabic: true
			
		},
		objects: [
			//{
			//    //id:"",
			//    //top:"",
			//    //left:"",
			//    //sound:"",
			//    //element:"",
			//    //text:"",
			//    //type:"image/sound/text",
			//    //animation:"",
			//    //click:"",
			//    //mouseup:"",
			//    // style:"",
			//       opacity:"",
			//     zIndex:"",
			//     flip:""
			//}
		]
	},
	UploadType = "",
	ActiveElement = ""

var lang = "ar"

resizeGame = function () {
	
	
	var gameArea = document.getElementById('gameContainer');
	var widthToHeight = 4 / 3;
	var newWidth = window.innerWidth;
	var newHeight = window.innerHeight;
	var newWidthToHeight = newWidth / newHeight;
	
	if (newWidthToHeight > widthToHeight) {
		newWidth = newHeight * widthToHeight;
		gameArea.style.height = newHeight / 1.09 + 'px';
		gameArea.style.width = newWidth / 1.09 + 'px';
	} else {
		newHeight = newWidth / widthToHeight;
		gameArea.style.width = newWidth / 1.09 + 'px';
		gameArea.style.height = newHeight / 1.09 + 'px';
	}
	
	
};

var config = {
	
	GameID: GameID,
	UserId: UserId,
	rootPath: rootPath
	
}
var resizeGame = function () {
	
	
	resizeGameCustome(".gameContainer", ".gameContent", (4 / 3), 1)
	$(".dot_container").each(function () { //if container is a class
		$('.dot_number', $(this)).css(
			{
				'font-size': $(this).height() + "px",
				'font-weight': 'bold'
			}); //you should only have 1 #text in your document, instead, use class
	});
	// resizeGameInner(".gameContent", ".titleContainer", (4 / 3), 3)
};
function resizeGameInner(container, inner, aspectRatio) {
	
	gameArea = $(container)
	var widthToHeight = aspectRatio;
	var newWidth = gameArea.width();
	var newHeight = gameArea.height();
	var newWidthToHeight = newWidth / newHeight;
	if (newWidthToHeight > widthToHeight) {
		newWidth = newHeight * widthToHeight;
	} else {
		newHeight = newWidth / widthToHeight;
		
	}
	var gameCanvas = $(inner)
	gameCanvas.css({
		width: newWidth / 2 + "px",
		height: newHeight / 2 + "px"
	})
	
	console.log({
		width: newWidth,
		height: newHeight
	})
	
	
}


function resizeGameCustome(container, inner, aspectRatio, cut) {
	
	gameArea = $(container)
	var widthToHeight = aspectRatio;
	var newWidth = gameArea.width();
	var newHeight = gameArea.height();
	var newWidthToHeight = newWidth / newHeight;
	if (newWidthToHeight > widthToHeight) {
		newWidth = newHeight * widthToHeight;
	} else {
		newHeight = newWidth / widthToHeight;
		
	}
	var gameCanvas = $(inner)
	gameCanvas.css({
		width: newWidth / cut + "px",
		height: newHeight / cut + "px"
	})
	
}
//config.rootPath = "gamesUser/" + config.UserId + "/" + config.GameID
orderValue = 0
$(document).ready(function () {
	
	$('body').manhalLoader({
		
		splashID: "#jSplash",
		splashVPos: '50%',
		loaderVPos: '80%',
		addFiles: [
			// {type: "image", src:  "../games/"+config.id+"/"+langStory+"/images/bg.png?"+Math.random()},
			// {type: "image", src:  "../games/"+config.id+"/"+langStory+"/images/bg1.png?"+Math.random()}
		
		
		],
		splashFunction: function () {
			
			
			resizeGame();
			$(".main-container").hide()
			$('<div class="loder-bg">').appendTo('#manhalpreOverlay');
			
		},
		onLoading: function (per) {
		
		
		},
	}, function () {
		
		$(".main-container").show()
		orderValue = Number(game.option.orderValue)
		
		
		window.addEventListener("resize", resizeGame);
		loadJsonData()
		resizeGame();
		
		
		$(".gameContent,.gameContainer").click(function () {
			event.stopPropagation()
			if (game.option.visible) {
				$("#visiblePointes").prop("checked", true);
				
				$(".dot_container").css({
					background: "transparent",
					border: "1px solid red"
				})
			} else {
				
				$(".elementResizable").css({
					background: game.option.circleColor
				})
			}
			$(".control").hide()
			$(".proprties").hide()
			$(".proprtiesContainer,.editPoint-popup").hide();
			$(".leftPanelTools .btn").removeClass("selected")
			$(".corner").remove();
			ActiveElement = ""
		})
		
		$(".elementResizable").css({
			width: game.option.widthCircle + "vw",
			height: game.option.widthCircle + "vw",
		})
	});
	
	
	// $('#lineWidthColor').colorPicker()
	//     .change(function (value) {
	//       game.option.colorLine=value.target.value
	//         });
	
	// $('#TextColor').colorPicker()
	//     .change(function (value) {
	//       game.option.textColor=value.target.value
	//         });
	
	
	drop()
	$(".dot_container").each(function () { //if container is a class
		$('.dot_number', $(this)).css(
			{
				'font-size': $(this).height() + "px",
				'font-weight': 'bold'
			}); //you should only have 1 #text in your document, instead, use class
	});
	Arabicletters()
	
});
function refresh(){
	if (game.option.visible) {
		$("#visiblePointes").prop("checked", true);
		
		$(".dot_container").css({
			background: "transparent",
			border: "1px solid red"
		})
	} else {
		
		$(".elementResizable").css({
			background: game.option.circleColor
		})
	}

	$(".leftPanelTools .btn").removeClass("selected")
	$(".corner").remove();
	ActiveElement = ""
	$(".dot_container").each(function () { //if container is a class
		$('.dot_number', $(this)).css(
			{
				'font-size': $(this).height() + "px",
				'font-weight': 'bold'
			}); //you should only have 1 #text in your document, instead, use class
	});
}

function addDot() {
	
	idObject = "dot_container_" + orderValue
	pushToJsonArray("", idObject, "", orderValue)
	
	pushNewObject("", idObject, "", 0, 0, 10, 10, 1, 0, 1, orderValue)
	orderValue++
	Lobibox.notify("success", {
msg:"Add dots "	});
	//Arabicletters()
	
	$(".dot_container").each(function () { //if container is a class
		$('.dot_number', $(this)).css(
			{
				'font-size': $(this).height() + "px",
				'font-weight': 'bold',
				color: game.option.textColor
			}); //you should only have 1 #text in your document, instead, use class
	});
}


function loadJsonData() {
	
	setdatafunction(
		{
			TypeProcesses: 'getdatagames',
			id: config.GameID
		});
}


function DrawObjects() {
	orderValue = Number(game.option.orderValue)
	if ($(".elementResizable").length) {
		$(".elementResizable").remove();
		orderValue = Number(game.option.orderValue)
	}
	
	
	length = game.objects.length;
	objects = game.objects
	
	
	for (i = 0; i < length; i++) {
		if (game.option.LetterOrNumber) {
			TextValue = orderValue
		} else {
			TextValue = objects[i].text
		}
		orderValue++
		//$(objects[i].element).appendTo(".gameContent")
		//    .css({
		//        top: objects[i].top,
		//        left: objects[i].left
		//    })
		//    .attr("id", objects[i].id)
		//    .addClass("allElem")
		//    .attr("sound", objects[i].sound)
		
		pushNewObject(
			objects[i].src,
			objects[i].id,
			objects[i].name,
			objects[i].top,
			objects[i].left,
			objects[i].width,
			objects[i].height,
			objects[i].opacity,
			objects[i].zIndex,
			objects[i].flip,
			TextValue
		)
		//console.log(objects[i])
	}
	
	
	loadOption()
}

function loadOption() {
	if (game.option.hidePointsWhenWin) {
		
		$("#hidePointsWhenWin").prop("checked", true);
	}
	
	if (game.option.ShowImage) {
		
		$("#ShowImageOption").prop("checked", true);
	}
	
	if (game.option.LetterOrNumber) {
		$("#LetterOrNumber").prop("checked", true);
		
	}
	
	if (game.option.drawing) {
		$("#DrawingImage").prop("checked", true);
		
	}
	
	if (game.option.visible) {
		$("#visiblePointes").prop("checked", true);
		
		$(".dot_container").css({
			background: "transparent",
			border: "1px solid red"
		})
	}
	
	
	$("#lineWidthColor").val(game.option.circleColor);
	$("#lineWidthColor").change();
	
	$("#TextColor").val(game.option.textColor);
	$("#TextColor").change();
	
	$("#changeWidthLine").val(game.option.widthLine);
	$("#changeWidthLine").change();
	$("#startnumber").val(Number(game.option.orderValue));
	
	
}


function pushNewObject(src, idObject, name, top, left, width, height, opacity, zIndex, flip, orderValue) {
	
	
	if (flip) {
		flipValue = -1
	}
	else {
		flipValue = 1
	}
	src = config.rootPath + "/images/" + name
	
	rezie = ' <div class="ui-resizable-handle ui-resizable-nw corner" id="nwgrip"></div>' +
		' <div class="ui-resizable-handle ui-resizable-ne corner" id="negrip"></div>' +
		'<div class="ui-resizable-handle ui-resizable-sw corner" id="swgrip"></div>' +
		'<div class="ui-resizable-handle ui-resizable-se corner" id="segrip"></div>'
	
	str = '<div name="' + name + '" class="elementResizable dot_container" order_value="' + orderValue + '" id="' + idObject + '" ondblclick="showProprties()">' +
		'<div class="dot">' +
		'<div class="dot_number">' + orderValue + '</div>' +
		//'<img id="img' + idObject + '" class="allElem hvr-glow" src="' + src + '">' +
		// '<button class="control" name="' + name + '" onclick="removeFile(this)" type="button">R</button>' +
		// '<button class="control" type="button" onclick="showProprties()">E</button>' +
		//rezie +
		'</div></div>'
	$(str).appendTo('.gameContent')
		.draggable(
			{
				containment: "parent",
				opacity: 0.35,
				start: function () {
					ActiveObject(this)
					//   addresizeCorner(this)
					
					$(this).find(".ui-resizable-handle").show()
					if (game.option.visible) {
						$("#visiblePointes").prop("checked", true);
						
						$(".dot_container").css({
							background: "transparent",
							
						})
					} else {
						
						$(".elementResizable").css({
							background: game.option.circleColor
						})
					
					}
					$(this).css({
						background: "orange"
					})
				},
				stop: function () {
					var wrapper = $('.gameContent');
					
					leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
					topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
					// widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
					widthObject = game.option.widthCircle
					//  heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)
					heightObject = game.option.widthCircle
					
					$(this).css("left", leftObject + "%");
					$(this).css("top", topObject + "%");
					$(this).css("width", widthObject + "vw");
					$(this).css("height", heightObject + "vw");
					updateBasic({
						left: leftObject,
						top: topObject,
						width: widthObject,
						height: heightObject,
						
					})
				}
				
			}).css({
			width: game.option.widthCircle + "vw",
			height: game.option.widthCircle + "vw",
			
			position: 'absolute',
			top: top + "%",
			left: left + "%",
			'z-index': zIndex,
			
			
		})
		
		//.resizable({
		//    //handles: {
		//    //    'ne': '#negrip',
		//    //    'se': '#segrip',
		//    //    'sw': '#swgrip',
		//    //    'nw': '#nwgrip'
		//    //}
		//})
		.click(function () {
			//  event.stopPropagation()
			$(".gameContent").click()
			//  addresizeCorner(this)
			
			$(this).find(".ui-resizable-handle").show()
			$(this).find(".control").show()
			if (game.option.visible) {
				$("#visiblePointes").prop("checked", true);
				
				$(".dot_container").css({
					background: "transparent",
				})
			} else {
				
				$(".elementResizable").css({
					background: game.option.circleColor
				})
			}
			$(this).css({
				background: "#ff9c00"
			})
			
			ActiveObject(this)
			
			getCssValue()
		});
	
	
}


function randomString(length, chars) {
	var mask = '';
	if (chars.indexOf('a') > -1) mask += 'abcdefghijklmnopqrstuvwxyz';
	if (chars.indexOf('A') > -1) mask += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	if (chars.indexOf('#') > -1) mask += '0123456789';
	if (chars.indexOf('!') > -1) mask += '~`!@#$%^&*()_+-={}[]:";\'<>?,./|\\';
	var result = '';
	for (var i = length; i > 0; --i) result += mask[Math.round(Math.random() * (mask.length - 1))];
	return result;
}


function addresizeCorner(object) {
	
	if ($('.ui-resizable-handle').length) $('.ui-resizable-handle').remove()
	$(object).resizable("destroy")
	str = '<div class="ui-resizable-handle ui-resizable-nw corner" id="nwgrip"></div>' +
		'<div class="ui-resizable-handle ui-resizable-ne corner" id="negrip"></div>' +
		'<div class="ui-resizable-handle ui-resizable-sw corner" id="swgrip"></div>' +
		'<div class="ui-resizable-handle ui-resizable-se corner" id="segrip"></div>'
	$(str).appendTo(object)
	
	$(object).resizable({
		handles: {
			'ne': '#negrip',
			'se': '#segrip',
			'sw': '#swgrip',
			'nw': '#nwgrip'
		},
		stop: function () {
			var wrapper = $('.gameContent');
			
			leftObject = parseInt($(this).css("left")) / (wrapper.width() / 100)
			topObject = parseInt($(this).css("top")) / (wrapper.height() / 100)
			widthObject = parseInt($(this).css("width")) / (wrapper.width() / 100)
			heightObject = parseInt($(this).css("height")) / (wrapper.height() / 100)
			
			$(this).css("left", leftObject + "%");
			$(this).css("top", topObject + "%");
			$(this).css("width", widthObject + "%");
			$(this).css("height", heightObject + "%");
			updateBasic({
				left: leftObject,
				top: topObject,
				width: widthObject,
				height: heightObject,
				
			})
			
		}
	})
}


function makeItResizable(object) {
	//$(".Editable_").attr('contenteditable', 'false');
	// container = $(object).parent().parent()
	object.addEventListener('click', function init() {
		// container = $(object).parent().parent()
		object.removeEventListener('click', init, false);
		object.className = object.className + ' resizable';
		var resizer = document.createElement('div');
		resizer.className = 'resizer';
		object.appendChild(resizer);
		resizer.addEventListener('mousedown', initDrag, false);
	}, false);
	
	var startX, startY, startWidth, startHeight;
	
	function initDrag(e) {
		// container = $(object).parent().parent()
		startX = e.clientX;
		startY = e.clientY;
		startWidth = parseInt(document.defaultView.getComputedStyle(object).width, 10);
		startHeight = parseInt(document.defaultView.getComputedStyle(object).height, 10);
		document.documentElement.addEventListener('mousemove', doDrag, false);
		document.documentElement.addEventListener('mouseup', stopDrag, false);
	}
	
	function doDrag(e) {
		// container = $(object)
		object.style.width = (startWidth + e.clientX - startX) + 'px';
		object.style.height = (startHeight + e.clientY - startY) + 'px';
		
		// container.css({"width": (startWidth + e.clientX - startX) + 'px'})
		// container.css({"height": (startHeight + e.clientY - startY) + 'px'})
		
		
	}
	
	function stopDrag(e) {
		//  container = $(object)
		document.documentElement.removeEventListener('mousemove', doDrag, false);
		document.documentElement.removeEventListener('mouseup', stopDrag, false);
		
	}
	
}


function pushToJsonArray(src, id, name, index) {
	
	game.objects.push({
		
		id: id,
		top: "0%",
		left: "0%",
		src: src,
		index: index,
		sound: "",
		element: "",
		text: "",
		type: "image/sound/text",
		animation: "",
		opacity: "",
		zIndex: "",
		flip: false,
		name: name,
		click: function () {
		},
		mouseup: function () {
		},
		style: ""
		
		
	})
}

function ActiveObject(object) {
	idObject = $(object).attr('id')
	$.grep(game.objects, function (e) {
		if (e.id == idObject) {
			//console.log(game.objects.indexOf(e))
			ActiveElement = {
				Element: e,
				index: game.objects.indexOf(e),
				id: e.id,
				src: e.src,
				sound: e.sound,
				text: e.text,
				
				
			}
			
		}
		;
	});
	
	
}

function changeBackground(src) {
	
	
	$(".gameContent").css(
		{
			'background-image': 'url(' + src + ')',
			'background-size': '100% 100%',
			'background-repeat': 'no-repeat'
			
			
		})
}


function updateBasic(data) {
	
	game.objects[ActiveElement.index].left = data.left
	game.objects[ActiveElement.index].top = data.top
	game.objects[ActiveElement.index].width = data.width
	game.objects[ActiveElement.index].height = data.height
	
}

function updateOpacity(val) {
	game.objects[ActiveElement.index].opacity = val
}


function AddText() {
	
	if ($(".hintContainer").length) $(".hintContainer").remove()
	str = '<div class="hintContainer"><div class="hint" >' +
		'<input id="textShape" type="text" >' +
		'</div>' +
		'<button type="button" onclick="closeBox()">close</button>' +
		'<button type="button" onclick="updatetext()">Save</button>'
	'</div>'
	$(str).appendTo("body")
}


function updatetext() {
	value = $('#ObjectText').val();
	game.objects[ActiveElement.index].text = value
	DrawObjects()
	Arabicletters()
	
}

function copyObject() {
	
	if (ActiveElement == "") {
		alert("Select object!")
		return
	}
	object = game.objects[ActiveElement.index]
	
	id = randomString(5, 'aA')
	
	
	pushToJsonArray(
		object.src,
		id,
		object.name
	)
	
	
	pushNewObject(
		object.src,
		id,
		object.name,
		object.top + .5,
		object.left + .5,
		object.width,
		object.height,
		object.opacity,
		object.zIndex,
		object.flip
	)
	$("#" + id).click()
}


function LetterOrNumber(object) {
	
	if ($(object).is(':checked')) {
		game.option.LetterOrNumber = true
		
	}
	else {
		game.option.LetterOrNumber = false
		
	}
	DrawObjects()
	refresh()
	// $(".gameContent").click()
}

function ShowImageOption(object) {
	
	if ($(object).is(':checked')) {
		game.option.ShowImage = true
		
	}
	else {
		game.option.ShowImage = false
		
	}
	
}


function hidePointsWhenWin(object) {
	
	if ($(object).is(':checked')) {
		game.option.hidePointsWhenWin = true
		
	}
	else {
		game.option.hidePointsWhenWin = false
		
	}
	
}

function DrawingImage(object) {
	
	if ($(object).is(':checked')) {
		game.option.drawing = true
		
	}
	else {
		game.option.drawing = false
		
	}
	
}

function visiblePointes(object) {
	
	if ($(object).is(':checked')) {
		game.option.visible = true
		$(".dot_container").css({
			background: "transparent",
			border: "1px solid red"
		})
	}
	else {
		game.option.visible = false
		$(".dot_container").css({
			background: game.option.circleColor,
			
		})
	}

}


function startCounter(object) {
	
	orderValue = $("#startnumber").val()
	game.option.orderValue = orderValue
	DrawObjects()
	
	// $(".gameContent").click()
}

function loadstartCounter() {
	
	
	DrawObjects()
	
	// $(".gameContent").click()
}


function setGameDataDefualt() {
	game = {
		element: $(".gameContainer"),
		width: 1280,
		height: 800,
		safeWidth: 1024,
		safeHeight: 720,
		backgroundImage: "images/bg.png",
		backgroundSound: "sound/bg.mp3",
		WinSound: "sound/WinSound.mp3",
		option: {
			LetterOrNumber: true,
			ShowImage: true,
			hidePointsWhenWin: true,
			visible: true,
			orderValue: 0,
			drawing: true,
			color: ["#333399", "#ff0000", "#3366ff"],
			widthLine: 2,
			colorLine: "black",
			textColor: "black",
			fontSize: 2,
			widthCircle: 2
			
			
		},
		objects: [
			//{
			//    //id:"",
			//    //top:"",
			//    //left:"",
			//    //sound:"",
			//    //element:"",
			//    //text:"",
			//    //type:"image/sound/text",
			//    //animation:"",
			//    //click:"",
			//    //mouseup:"",
			//    // style:"",
			//       opacity:"",
			//     zIndex:"",
			//     flip:""
			//}
		]
	}
}

function calculateAspectRatioFit(srcWidth, srcHeight, maxWidth, maxHeight) {
	
	var ratio = Math.min(maxWidth / srcWidth, maxHeight / srcHeight);
	
	return {width: srcWidth * ratio, height: srcHeight * ratio};
}

function drop() {
	
	document.body.ondragover = function () {
		$(".gameContent").addClass('hoverDrop');
		return false;
	};
	document.body.ondragend = function () {
		$(".gameContent").addClass('hoverDrop');
		return false;
	};
	document.body.ondragleave = function () {
		$(".gameContent").addClass('hoverDrop');
		return false;
	};
	document.body.ondrop = function (e) {
		this.className = '';
		e.preventDefault();
		
		var file = e.dataTransfer.files[0],
			reader = new FileReader();
		reader.onerror = function () {
			errorMessage()
			
		};
		reader.onload = function (event) {
			imgDrag = new Image()
			imgDrag.src = event.target.result
			var fileName = file.name
			
			
			extension = file.name.split(".")[1]
			
			
			if ((extension == "png")
				|| (extension == "PNG")
				|| (extension == "jpg")
				|| (extension == "jpeg")
				|| (extension == "gif")
			) {
				
				
				dataFile = event.target.result;
				//value = input.files[0].name;
				randomeName = randomString(5, 'aA')
				
				canvasOFtemp = document.createElement('canvas');
				canvasOFtemp.width = 1024;
				canvasOFtemp.height = 768;
				
				
				var image = new Image();
				image.src = dataFile;
				image.onload = function () {
					aspect = calculateAspectRatioFit(image.width, image.height, 1024, 768)
					
					var cxt = canvasOFtemp.getContext('2d');
					
					var x = (canvasOFtemp.width - aspect.width) * 0.5,   // this = image loaded
						y = (canvasOFtemp.height - aspect.height) * 0.5;
					
					cxt.drawImage(image, x, y, aspect.width, aspect.height);
					
					ajaxPHP(config.rootPath + lang + "/images/", canvasOFtemp.toDataURL(), "image", "bg.png", "uploadBackground")
					
				};
				
				$(".gameContent").removeClass('hoverDrop')
				// setTimeout(Edit(),200)
				
				
			}
			else {
				errorMessage()
				$(".gameContent").removeClass('hoverDrop')
			}
		};
		reader.readAsDataURL(file);
		
		return false;
		
		
	}
	
	
}

function removeAllDots() {
	Lobibox.confirm({
		title: "Remove All points?",
		msg: "Are you sure you want to Remove All points?",
		callback: function ($this, type, ev) {
			if (type == "yes") {
				removeAllDotsConfirm()
			} else {
			
			}
		}
	});
}

function removeAllDotsConfirm() {
	$(".dot_container").remove()
	game.objects = [];
	DrawObjects()
	$(".gameContent").click()
	Lobibox.notify("success", {
		msg: "All points removed"
	});
}


function Arabicletters() {
	var map_format_arabic = ["&\#1632;", "&\#1633;", "&\#1634;", "&\#1635;", "&\#1636;", "&\#1637;", "&\#1638;", "&\#1639;", "&\#1640;", "&\#1641;"];
	var map_format_english = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
	$(".dot_number,#ObjectText").addClass("format_arabic")
	
	if (typeof game.option.format_arabic == "undefined") game.option.format_arabic = true
	
	if (game.option.format_arabic == true || typeof game.option.format_arabic=="undefined") {
		
		$.each($('.format_arabic'), function () {
			
			var n = $(this).text().replace(/\d(?=[^<>]*(<|$))/g, function ($0) {
				console.log($0)
				return map_format_arabic[$0]
			});
			$(this).html(n);
		});
		
		game.option.format_arabic = false
		
		Lobibox.notify("success", {
			msg: "Change number to arabic"
		});
	} else {
		
		$.each($('.format_arabic'), function () {
			
			var n = $(this).text().replace(/\d(?=[^<>]*(<|$))/g, function ($0) {
				
				return map_format_english[$0]
			});
			$(this).html(n);
		});
		game.option.format_arabic = true
		console.log("en")
		Lobibox.notify("success", {
			msg: "Change number to English"
		});
	}
	
	
	$(".dot_container").each(function () { //if container is a class
		$('.dot_number', $(this)).css(
			{
				'font-size': $(this).height() + "px",
				'font-weight': 'bold'
			}); //you should only have 1 #text in your document, instead, use class
	});
}

