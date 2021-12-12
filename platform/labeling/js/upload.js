function ajaxPHP(url, data, type, name, objectType, dest,compress) {
	
	
	if (typeof dest == "undefined") {
		dest = ""
	}
	
	loaderGif()
	$.ajax({
		url: '../ajax/uploadLabaling.php',
		type: 'POST',
		data: {
			FileData: JSON.stringify(data),
			urlUpload: url,
			Type: type,
			FileName: name,
			dest: dest,
			game: "[" + JSON.stringify(game) + "]",
			saveImageType:compress
		},
		cache: false,
		
		
		success: function (data, textStatus, jqXHR) {
			setTimeout(removeLoader, 10)
			
			
			console.log(data)
			if (typeof data.error === 'undefined') {
				if (objectType == "uploadImageObject") {
					idObject = randomString(6, "Aa")
					pushToJsonArray("images/" + name, idObject, name)
					
					pushNewObject(url, idObject, name, 0, 0, 10, 10, 1, 0)
					
				}
				if (objectType == "Library") {
					idObject = randomString(6, "Aa")
					pushToJsonArray("images/" + name, idObject, name)
					pushNewObject(url, idObject, name, 0, 0, 10, 10, 1, 0)
				}
				
				if (objectType == "uploadBackgroundTop") {
					
					changeBackground(config.rootPath + lang + "/images/" + "bg_" + game.levelIndex + ".png?" + Math.random())
					$("#imageThumb" + game.levelIndex).attr("src", config.rootPath + lang + "/images/" + "bg_" + game.levelIndex + ".png?" + Math.random())
					game.backgroundLevel[game.levelIndex] = {
						full: config.rootPath + lang + "/images/" + "bg_" + game.levelIndex + ".png",
						short: "/images/" + "bg_" + game.levelIndex + ".png"
					}
					
				}
				if (objectType == "uploadBackgroundBack") {
					
					changeBackground(config.rootPath + lang + "/images/" + "bg_BackLayer" + game.levelIndex + ".jpg?" + Math.random())
					$("#imageThumb" + game.levelIndex).attr("src", config.rootPath + lang + "/images/" + "bg_BackLayer" + game.levelIndex + ".jpg?" + Math.random())
					game.backgroundLevel[game.levelIndex] = {
						full: config.rootPath + lang + "/images/" + "bg_BackLayer" + game.levelIndex + ".jpg",
						short: "/images/" + "bg_BackLayer" + game.levelIndex + ".jpg"
					}
					
				}
				if (objectType == "uploadBackgroundSound") {
					
					$('#audioPreview').attr('src', config.rootPath + lang + "/sound/bg.mp3")
					$('#ObjectSound').attr('value', config.rootPath + lang + "/sound/bg.mp3")
				}
				
				
				if (objectType == "uploadsoundWin") {
					
					$('#audioPreviewWin').attr('src', config.rootPath + lang + "/sound/WinSound.mp3")
					$('#SoundWinVal').attr('value', config.rootPath + lang + "/sound/WinSound.mp3")
				}
				if (objectType == "uploadsoundObject") {
					game.objects[ActiveElement.index].sound = "sound/" + name
					
					if ($('#audioPreview').length) {
						$('#audioPreview').attr('src', config.rootPath + lang + "/sound/" + name)
						$('#ObjectSound').attr('value', config.rootPath + lang + "/sound/" + name)
					}
				}
				if (objectType == "remove") {
					$('#' + ActiveElement.id).remove();
					game.objects[ActiveElement.index] = []
					
				}
				
				if (objectType == "thumb") {
					$('#level-thumb' + game.levelIndex).attr("src", config.rootPath + lang + "/images/" + "thumb_" + game.levelIndex + ".png?" + Math.random());
					
					
				}
				if (objectType == "saveJson") {
					
					
					if (saveType == "preview") {
						
						readyToPreviewNew()
					}
					else {
						
						setdatafunction(
							{
								TypeProcesses: 'updateGames',
								id: config.GameID,
								data: "" + JSON.stringify(game) + ""
								
								
							});
					}
					
					
				}
			}
			else {
				// Handle errors here
				console.log('ERRORS: ' + data.error);
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			// Handle errors here
			console.log('ERRORS: ' + textStatus);
			// STOP LOADING SPINNER
		}
	});
}


objectType = ""
var canvasOFtemp
// function getImageLocal(input, id, fileName) {
//
//     objectType = $(input).attr('UploadType')
//
//
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//
//             dataFile = e.target.result;
//             value = input.files[0].name;
//             randomeName = randomString(5, 'aA')
//
//             canvasOFtemp = document.createElement('canvas');
//             canvasOFtemp.width = 1024;
//             canvasOFtemp.height = 768;
//
//
//             var image = new Image();
//             image.src = dataFile;
//             image.onload = function () {
//                 aspect = calculateAspectRatioFit(image.width, image.height, 1024, 768)
//
//                 var cxt = canvasOFtemp.getContext('2d');
//
//                 var x = (canvasOFtemp.width - aspect.width) * 0.5,   // this = image loaded
//                     y = (canvasOFtemp.height - aspect.height) * 0.5;
//
//                 cxt.drawImage(image, x, y, aspect.width, aspect.height);
//
//                 ajaxPHP(config.rootPath + lang + "/images/", canvasOFtemp.toDataURL(), "image", "bg_" + game.levelIndex + ".png", objectType)
//
//             };
//
//
//         };
//         reader.readAsDataURL(input.files[0]);
//     }
//
// }
function getImageLocal(input, id, fileName) {
	
	objectType = $(input).attr('UploadType')
	
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			
			dataFile = e.target.result;
			value = input.files[0].name;
			randomeName = randomString(5, 'aA')
			
			if (objectType == "uploadBackground") {
				
				type = ""
				dataFile = e.target.result;
				value = input.files[0].name;
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
							
							ajaxPHP(config.rootPath + lang + "/images/", canvasOFtemp.toDataURL(), "image", "bg_BackLayer" + game.levelIndex + ".png", "uploadBackgroundBack",0,"compress")
							
						}
					}
					
				};
				
				
			}
			
			if (objectType == "uploadsoundWin") {
				
				type = ""
				ajaxPHP(config.rootPath + lang + "/sound/", dataFile, "image", "win.mp3", objectType)
				
				
			}
			
			
			if (objectType == "BackgroundSound") {
				
				type = ""
				ajaxPHP(config.rootPath + lang + "/sound/", dataFile, "sound", "bg.mp3", objectType)
				
				
			}
			
			
		};
		reader.readAsDataURL(input.files[0]);
	}
	
}

function removeFile(object) {
	event.stopPropagation();
	
	index = ActiveElement.index
	
	if (index > -1) {
		game.objects.splice(index, 1);
		DrawObjects()
		$(".gameContent").click()
	}
	// name = $(object).attr('name')
	//alert("../games/gamesUser/" + IdUser + "/"+name)
	// ajaxPHP("../games/" + config.rootPath + lang + "/images/" + name, "", "removeFile", "", "remove", "")
}


function loaderGif() {
	if ($('.loaderGif').length) $('.loaderGif').remove()
	
	str = "<div class='loaderGif'" +
		" style='background:rgba(0,0,0,.5);" +
		"background: url(cube.gif) rgba(0,0,0,.5);" +
		"background-position: 50% 50%;" +
		"position: absolute;width: 100%;" +
		"height: 100%;" +
		"top:0;" +
		"left:0;" +
		"    background-repeat: no-repeat;" +
		"z-index: 9999999999999999'></div>"
	
	
	$(str).appendTo(document.body)
}

function removeLoader() {
	if ($('.loaderGif').length) $('.loaderGif').remove()
}


function simulateUpload(target) {
	
	target.click()
	
}

function saveData() {
	console.log("rootPath", config.rootPath + lang);
	saveType = "save"
	ajaxPHP("../games/" + GameID + "/all/js/", game, "JsonFile", "game.js", "saveJson", "");
}

function saveMessage() {
	str = '<div class="message-mine-container">' +
		'<div class="message-inner-container">' +
		'<div class="header">' +
		'<label>Save</label>' +
		'</div>' +
		'<div class="message-body">' +
		'<div class="message-icon floating-left"></div>' +
		'<label class="message-lbl floating-left">Successfully saved.</label>' +
		'</div>' +
		'</div>' +
		'</div>'
	$(str).appendTo('body')
	
	setTimeout(function () {
		removeMsg()
	}, 1000)
}






