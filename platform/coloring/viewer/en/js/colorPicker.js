var colorsCollection = ['#FFFFFF', '#8E53A1', '#6ABD46', '#71CCDC', '#F7ED45', '#F7DAAF', '#EC2527',
	'#F16824', '#CECCCC', '#5A499E', '#06753D', '#024259', '#FDD209', '#7D4829', '#931B1E',
	'#B44426', '#979797', '#C296C5', '#54B948', '#3C75BB', '#F7ED45', '#E89D5E', '#F26F68',
	'#F37123', '#676868', '#9060A8', '#169E49', '#3CBEB7', '#FFCD37', '#E5B07D', '#EF3C46',
	'#FDBE17', '#4E4D4E', '#6B449B', '#BACD3F', '#1890CA', '#FCD55A', '#D8C077', '#A62E32',
	'#F16A2D', '#343433', '#583E98', '#BA539F', '#9D2482', '#DD64A5',
	'#DB778D', '#EC4394', '#E0398C', '#68AF46', '#4455A4', '#FBEE34', '#AD732A', '#D91E36', '#F99B2A', '#F99B2A']


aColor = ["#B52930", "#D02A31", "#F12A35", "#F58465", "#008449", "#00B363", "#58C68F", "#92D3AB", "#61262F", "#814F33", "#A97736", "#D6A230", "#FEE203", "#FFF663", "#FEF894", "#FFFBCC", "#89147C", "#B2339E", "#C869AD", "#DAA1CB", "#E15B6E", "#EC8F92", "#EEB1AB", "#FDDBD4", "#0A5399", "#006DB7", "#4888C8", "#78A9DA", "#F5822F", "#F79430", "#FCB327", "#FFD461", "#353031", "#6D6B71", "#8F9497", "#B3B6B9", "#D7DBDE", "#FFFFFF"]
var colorMe = []

function loadColor() {
	var strColor = ""
	strSwiper = '<div class="swiper-container">' +
		'<div class="swiper-wrapper swiper-wrapper1">' +
		
		
		'</div>' +
		'<!-- Add Pagination -->' +
		
		'<div class="swiper-button-next hvr-wobble-horizontal"></div>' +
		'<div class="swiper-button-prev hvr-wobble-horizontal"></div>' +
		'</div>'
	
	$(strSwiper).appendTo('#colorContainer');
	
	arrayLength = colorsCollection.length
	for (i = 0; i < aColor.length; i++) {
		
		strColor = '<div class="colorBox2 swiper-slide " style="background-image: url(images/pencil.png) ;background-color:' + aColor[i] + '" onclick="getColor(this.id)" id="' + aColor[i] + '"  title="' + aColor[i] + '"  ><label class=""></label></div>'
		$(strColor).appendTo('.swiper-wrapper1');
		
	}
	strColor = ""
	for (i = 1; i < colorsCollection.length; i++) {
		
		//  strColor+='<div class="colorBox " onmouseenter="oldColor=colorChoose" onmouseleave="setCustomColor(colorChoose)" onmouseover="setCustomColor(this.id)" onclick="getColor(this.id);setCustomColor(this.id)" id="'+colorsCollection[i]+'"  title="'+colorsCollection[i]+'" style="background:'+colorsCollection[i]+'" ></div>'
		
	}
	
	
	$(strColor).appendTo('#colorPickerCont');
	
	
	var swiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
		slidesPerView: 20,
		
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		freeMode: true
	});
	
}


function getColor(id) {
	event.stopPropagation();
	event.preventDefault();
	// floodFillAction(canvas)
	
	DrawMode = 'pen'
	fillArea()
	
	
	colorChoose = id
	toggleShow()
	//  $('#colorPicker').toggle('fast')
	$('.logotext').html(colorChoose)
	$(".sizeCtx").css('background', colorChoose);
}


var colorChoose = ""
var oldColor = colorChoose
function colorPicker() {
	
	//showColor()
	$('#colorPicker').show()
	
	startColorPicker()
}

function setCustomColor(color) {
	
	$('.customColor').css('background-color', color)
}
canvasPicker = ""


function startColorPicker() {
	
	$('#colorPickerType').attr('src', 'images/black-white.png')
	$('#colorPickerType').attr('onclick', 'blackAndWhiteColors()')
	canvasPicker = document.getElementById('canvas_picker')
	canvasPickerCtx = document.getElementById('canvas_picker').getContext('2d');
	
	
	canvasPicker.width = $(".colorPicker-inner-container").width();
	canvasPicker.height = $(".colorPicker-inner-container").height();
// create an image object and get it’s source
	var imgP = new Image();
	imgP.src = 'images/colorP.png';

// copy the image to the canvas
	$(imgP).load(function () {
		
		canvasPickerCtx.drawImage(imgP, 0, 0, canvasPicker.width, canvasPicker.height);
		//canvasPickerCtx.fillRect(canvasPicker.width/2,canvasPicker.height/2,5,5);
	});

// http://www.javascripter.net/faq/rgbtohex.htm
	function rgbToHex(R, G, B) {
		return toHex(R) + toHex(G) + toHex(B)
	}
	
	function toHex(n) {
		n = parseInt(n, 10);
		if (isNaN(n)) return "00";
		n = Math.max(0, Math.min(n, 255));
		return "0123456789ABCDEF".charAt((n - n % 16) / 16) + "0123456789ABCDEF".charAt(n % 16);
	}
	
	/*
	 canvasPicker.onclick=function(event){
	 mouseMove()
	 colorMe.push(colorChoose)
	 console.log(colorMe)
	 
	 }*/
	canvasPicker.onmousedown = function (event) {
		
		canvasPicker.onmousemove = function (event) {
			mouseMove(event)
		};
	}
	
	canvasPicker.onmouseup = function (event) {
		
		canvasPicker.onmousemove = function (event) {
		
		};
	}
	canvasPicker.ontouchstart = function (event) {
		
		canvasPicker.ontouchmove = function (event) {
			mouseMove(event)
		};
	}
	
	document.getElementById('circlePciker').onmouseup = function (event) {
		
		canvasPicker.onmousemove = function (event) {
		
		};
	}
	newX = newY = 0
	function mouseMove() {
		radius = $(canvasPicker).width() / 2
		distance = 9
		
		cx = canvasPicker.width / 2 - distance
		cy = canvasPicker.height / 2 - distance - 5
		event.preventDefault()
		// getting user coordinates
		var x = getPosition(event).x;
		var y = getPosition(event).y;
		
		
		if (pointInCircle(x, y, cx, cy, radius)) {
			$('#circlePciker').css('top', y + 'px')
			$('#circlePciker').css('left', x + 'px')
			newX = x
			newY = y
		}
		else {
			var dx = x - cx;
			var dy = y - cy;
			rad = Math.atan2(dy, dx);
			newX = cx + (radius * Math.cos(rad))
			newY = cy + (radius * Math.sin(rad))
			$('#circlePciker').css('top', newY + 'px')
			$('#circlePciker').css('left', newX + 'px')
		}
		
		newX = newX + 17 / 2
		newY = newY + 17 / 2
		
		console.log(x)
		// getting image data and RGB values
		var img_data = canvasPickerCtx.getImageData(newX, newY, 1, 1).data;
		var R = img_data[0];
		var G = img_data[1];
		var B = img_data[2];
		var rgb = R + ',' + G + ',' + B;
		// convert RGB to HEX
		var hex = rgbToHex(R, G, B);
		console.log(hex)
		setCustomColor("#" + hex)
		colorChoose = "#" + hex
		$(".sizeCtx").css('background', colorChoose);
		$(".colorPickerThumnail").css('background-color', colorChoose);
		$('#logotext').html(colorChoose)
		// making the color the value of the input
		// $('#rgb input').val(rgb);
		//  $('#hex input').val('#' + hex);
	}
	resizeGameInner("#inner-colorPicker", ".background-colorPicker", (4 / 3), 3)
	
}


function blackAndWhiteColors() {
	
	$('#colorPickerType').attr('src', 'images/colorP.png')
	$('#colorPickerType').attr('onclick',
		'startColorPicker()')
	
	var imageData = canvasPickerCtx.getImageData(0, 0, canvas.width, canvas.height);
	var data = imageData.data;
	
	// iterate over all pixels
	for (var i = 0, n = data.length; i < n; i += 4) {
		
		
		var r = data[i];
		var g = data[i + 1];
		var b = data[i + 2];
		
		
		var v = 0.2126 * r + 0.7152 * g + 0.0722 * b;
		data[i] = data[i + 1] = data[i + 2] = v
	}
	
	canvasPickerCtx.putImageData(imageData, 0, 0);
}


function rotate_point(pointX, pointY, originX, originY, angle) {/* rotate point around specific point*/
	//angle = angle * Math.PI / 180.0;
	return {
		x: Math.cos(angle) * (pointX - originX) - Math.sin(angle) * (pointY - originY) + originX,
		y: Math.sin(angle) * (pointX - originX) + Math.cos(angle) * (pointY - originY) + originY
	};
}