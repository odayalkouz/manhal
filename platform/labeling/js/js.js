function addLevel() {
	index = game.level.length
	
	// if ($(".page-thumb").length + 1 > 7) {
	//     $('#slider').width(135 * ($(".page-thumb").length + 1) + (($(".page-thumb").length + 1) * 10));
	// }
	// $(".level-inner-container").each(function () {
	//     $(this).css("display", "none");
	// });
	// $("<div id='level-" + index + "' class='level-inner-container floating-left'><div class='image-container'><label class='level-number'>"+index +"</label></div></div>").appendTo(".gameContent");
	//
	// $("#level-thumb-" + index).css("display", "block");
	// $("<div id='level-thumb" + index + "' onclick='selectLevel(" + index + ")' class='page-thumb floating-left swiper-slide'>" +
	//
	//     "<img id='imageThumb" + index + "' class='innerThumb' src='images/image.jpg'>" +
	//     // "<div>Level "+counterINdex+"</div>"+
	//     "</div>").appendTo('.swiper-wrapper');
	// $("<div id='level-" + index + "' class='level-inner-container floating-left'><div class='image-container'></div></div>").appendTo('#level-container');
	// //if ($(".svgGroup-"+game.levelIndex+"").length)$(".svgGroup").remove();
	// //draw(game.level[game.levelIndex], game.levelIndex)
	// //console.log(draw(game.level[game.levelIndex], game.levelIndex))
	// //$(".level-inner-container").css("width", $('#level-container').width() / game.level.length + "px");
	
	game.level.push([])
	game.levelTitle.push({title: ""})
	game.backgroundLevel.push([{full: " ", short: ""}])
	$(".swiper-wrapper").html("")
	drawGame(game.level)
	$("#level-thumb" + index).click()
	
	Lobibox.notify("success", {
		
		size: 'mini',
		
		delayIndicator: false,
		msg: 'add new level complete'
	});
	
}

function selectLevel(r) {
	$(".level-inner-container").each(function () {
		$(this).css("display", "none");
	})
	$(".page-thumb").removeClass("selected");
	$("#level-" + r).css("display", "block");
	$("#level-thumb" + r).addClass("selected");
	game.levelIndex = r
	
	
	if (typeof game.backgroundLevel[r].full == "undefined") {
		$("#level-" + r).css(
			{
				'background-image': 'url(images/image.jpg)',
				'background-size': '100% 100%',
				'background-repeat': 'no-repeat'
				
				
			})
		
		$("#imageThumb" + r).attr("src", "images/image.jpg")
	} else {
		changeBackground(config.rootPath + langStory + "/images/" + "bg_" + game.levelIndex + ".png?" + Math.random())
	}
	
	//$("#imageThumb"+r).attr("src","images/addPhoto.png")
	reCalculatePoints()
	
	
}
//function addWord(){
//    $("<span contenteditable='true'></span>").appendTo("#level-" + game.levelIndex + " .image-container");
//    $(".image-container span").css("lineHeight", $(".image-container span").height() + "px");
//}
function deleteLevel() {
	if (game.levelIndex != 0) {
	
	}
}

function changeBackground(src) {
// stringImage='<img class="imgObjectLabeling" src="'+src+'">'
//     $(".imgObjectLabeling").remove()
//     $(stringImage).appendTo("#level-"+game.levelIndex)
	src1=config.rootPath + langStory + "/images/" + "bg_BackLayer" + game.levelIndex + ".jpg?" + Math.random()
	src2=config.rootPath + langStory + "/images/" + "bg_" + game.levelIndex + ".png?" + Math.random()
	$("#level-" + game.levelIndex).css(
		{
			'background': 'url(' + src2 + ')100% 100% no-repeat ,url(' + src1 + ')100% 100% no-repeat',
			backgroundPosition:"center",
			backgroundSize: "100% 100%"

			
			
		})
}

function calculateAspectRatioFit(srcWidth, srcHeight, maxWidth, maxHeight) {
	
	var ratio = Math.min(maxWidth / srcWidth, maxHeight / srcHeight);
	
	return {width: srcWidth * ratio, height: srcHeight * ratio};
}


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
	
	
	swiperThumbs.updateContainerSize()
	swiperThumbs.updateSlidesSize()
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
	$('#gameContainer').css({'width': '100%', 'height': '100%'});
	var gameCanvas = $(inner)
	gameCanvas.css({
		width: newWidth / cut + "px",
		height: newHeight / cut + "px"
	})
	
	
}


function drop() {
	
	document.body.ondragover = function () {
		$(".gameContent").addClass('hoverDrop');
		return false;
	};
	document.getElementById("gameContent").ondragend = function () {
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
			alert('invalid Image Type')
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
				
				
				var image = new Image();
				image.src = dataFile;
				image.onload = function () {
					Lobibox.confirm({
						msg: "choose background layer ",
						buttons: {
							
							top: {
								'class': 'btn btn-default',
								text: 'Top layer',
								closeOnClick: 'yes'
							},
							back: {
								'class': 'btn btn-default',
								text: 'Back layer',
								closeOnClick: 'yes'
							}
						},
						callback: function ($this, type, ev) {
							
							if (type == "top") {
								
								drawImageData("topLayer")
							} else {
								
								drawImageData("backLayer")
							}
						}
					});
					
					function drawImageData(bgType) {
						if (bgType == "topLayer") {
							canvasOFtemp.width = 1024;
							canvasOFtemp.height = 768;
							aspect = calculateAspectRatioFit(image.width, image.height, 1024, 768)
						} else {
							canvasOFtemp.width = image.width;
							canvasOFtemp.height = image.height;
							aspect = calculateAspectRatioFit(image.width, image.height, image.width, image.height)
							
						}
						
						
						var cxt = canvasOFtemp.getContext('2d');
						
						var x = (canvasOFtemp.width - aspect.width) * 0.5,   // this = image loaded
							y = (canvasOFtemp.height - aspect.height) * 0.5;
						
						cxt.drawImage(image, x, y, aspect.width, aspect.height);
						if (bgType == "topLayer") {
							ajaxPHP(config.rootPath + lang + "/images/", canvasOFtemp.toDataURL(), "image", "bg_" + game.levelIndex + ".png", "uploadBackgroundTop")
						} else {
							
							ajaxPHP(config.rootPath + lang + "/images/", canvasOFtemp.toDataURL(), "image", "bg_BackLayer" + game.levelIndex + ".png", "uploadBackgroundBack")
							
						}
					}
				};
				
				$(".gameContent").removeClass('hoverDrop')
				// setTimeout(Edit(),200)
				
				
			}
			else {
				alert('Invalid Image type')
				$(".gameContent").removeClass('hoverDrop')
			}
		};
		reader.readAsDataURL(file);
		
		return false;
		
		
	}
	
	
}

