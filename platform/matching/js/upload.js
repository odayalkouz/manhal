function ajaxPHP(url, data, type, name, objectType, dest) {
	if (typeof dest == "undefined") {
		dest = ""
	}
	loaderGif()
	$.ajax({
		url: '../ajax/upload.php',
		type: 'POST',
		data: {
			FileData: JSON.stringify(data),
			urlUpload: url,
			Type: type,
			FileName: name,
			dest: dest,
			game: "[" + JSON.stringify(game) + "]"
		},
		cache: false,
		
		
		success: function (data, textStatus, jqXHR) {
			setTimeout(removeLoader, 10)
			
			
			console.log(data)
			if (typeof data.error === 'undefined') {
				
				if (objectType == "Library") {
					if (miniEdittor.dir == "left") {
						game.matching[miniEdittor.activeIndex].type = "image"
						game.matching[miniEdittor.activeIndex].content = "images/" + name
						
					} else {
						game.matching[miniEdittor.activeIndex].answer.type = "image"
						game.matching[miniEdittor.activeIndex].answer.content = "images/" + name
					}
					drawObject("image", "images/" + name, miniEdittor.activeIndex, miniEdittor.dir)
					
					
				}
				
				
				if (objectType == "uploadBackgroundSound") {
					
					$('#audioPreview').attr('src', config.rootPath + "/all" + "/sound/bg.mp3")
					$('#ObjectSound').attr('value', config.rootPath + "/all" + "/sound/bg.mp3")
				}
				
				
				///////////////////Matching////////////////
				if (objectType == "uploadsoundObjectMatching") {
					
					
					if (miniEdittor.dir == "left") {
						game.matching[miniEdittor.activeIndex].type = "sound"
						game.matching[miniEdittor.activeIndex].content = "sound/" + name
						
						
					} else {
						game.matching[miniEdittor.activeIndex].answer.type = "sound"
						game.matching[miniEdittor.activeIndex].answer.content = "sound/" + name
					}
					drawObject("sound", "sound/" + name, miniEdittor.activeIndex, miniEdittor.dir)
				}
				
				if (objectType == "uploadimageObjectMatching") {
					if (miniEdittor.dir == "left") {
						game.matching[miniEdittor.activeIndex].type = "image"
						game.matching[miniEdittor.activeIndex].content = "images/" + name
						
					} else {
						game.matching[miniEdittor.activeIndex].answer.type = "image"
						game.matching[miniEdittor.activeIndex].answer.content = "images/" + name
					}
					drawObject("image", "images/" + name, miniEdittor.activeIndex, miniEdittor.dir)
				}
				
				
				if (objectType == "uploadvedioObjectMatching") {
					if (miniEdittor.dir == "left") {
						game.matching[miniEdittor.activeIndex].type = "video"
						game.matching[miniEdittor.activeIndex].content = "video/" + name
						
					} else {
						game.matching[miniEdittor.activeIndex].answer.type = "video"
						game.matching[miniEdittor.activeIndex].answer.content = "video/" + name
					}
					drawObject("video", "video/" + name, miniEdittor.activeIndex, miniEdittor.dir)
				}
				
				if (objectType == "soundEdittitle") {
				
					$("#ObjectSoundtitle").val(config.rootPath + "all" + "/sound/title.mp3")
					$("#soundTitleMatch").attr("src",config.rootPath + "all" + "/sound/title.mp3?"+Math.random())
					
				}
				
				
				if (objectType == "remove") {
					$('#' + ActiveElement.id).remove();
					game.objects[ActiveElement.index] = ["removed"]
				}
				if (objectType == "saveJson") {
					if (saveType == "preview") {
						readyToPreview()
					}
					else {
						
						setdatafunction(
							{
								TypeProcesses: 'updateGames',
								id: config.GameID,
								data: JSON.stringify(game)
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

function getImageLocal(input, id, fileName) {
	
	objectType = $(input).attr('UploadType')
	
	
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			
			dataFile = e.target.result;
			value = input.files[0].name;
			extension="."+getExtension(value)
			miniEdittor.mimeType=getExtension(value)
			randomeName = randomString(5, 'aA')
			if (objectType == "uploadImageObject") {
				
				type = "local"
				
				ajaxPHP(config.rootPath + "/all" + "/images/", dataFile, "image", randomeName + ".png", objectType)
				
				
			}
			
			
			if (objectType == "uploadBackground") {
				
				type = ""
				
				
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
					
					ajaxPHP(config.rootPath + "/all" + "/images/", canvasOFtemp.toDataURL(), "image", "bg.png", objectType)
					
				};
				
				
			}
			
			if (objectType == "uploadsoundObject") {
				type = ""
				ajaxPHP(config.rootPath + "/all" + "/sound/", dataFile, "sound", randomeName + ".mp3", objectType)
				
				
			}
			
			
			if (objectType == "uploadIconTitle") {
				type = ""
				ajaxPHP(config.rootPath + "/all" + "/images/", dataFile, "image", "titleIcon.png", objectType)
				
				
			}
			
			if (objectType == "BackgroundSound") {
				type = ""
				ajaxPHP(config.rootPath + "/all" + "/sound/", dataFile, "sound", "bg.mp3", objectType)
				
				
			}
			
			
			/////////////////////////Matching Upload////////////////////////////////
			
			if (objectType == "uploadsoundObjectMatching") {
				type = ""
				
			
				ajaxPHP(config.rootPath + "/all" + "/sound/", dataFile, "sound", "col_" +miniEdittor.dir+miniEdittor.activeIndex+ extension, objectType)
				
				
			}
			
			if (objectType == "soundEdittitle") {
				type = ""
				
		
				ajaxPHP(config.rootPath + "/all" + "/sound/", dataFile, "sound", "title.mp3", objectType)
				
				
			}
			if (objectType == "uploadimageObjectMatching") {
				
				type = "local"
				
				ajaxPHP(config.rootPath + "/all" + "/images/", dataFile, "image", "col_" +miniEdittor.dir+miniEdittor.activeIndex+ extension, objectType)
				
				
			}
			if (objectType == "uploadvedioObjectMatching") {
				
				type = "local"
				
				ajaxPHP(config.rootPath + "/all" + "/video/", dataFile, "video", "col_" +miniEdittor.dir+miniEdittor.activeIndex+ extension, objectType)
				
				
			}
			
			
		};
		reader.readAsDataURL(input.files[0]);
	}
	
}

function getExtension(fname){
	return fname.slice((Math.max(0, fname.lastIndexOf(".")) || Infinity) + 1);
}

function removeFile(object) {
	event.stopPropagation()
	name = $(object).attr('name')
	ajaxPHP(config.rootPath + "/all/images/" + name, "", "removeFile", "", "remove", "")
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

function simulateUploadJquery(id, dir) {
	
	// $("#"+id).click()
	miniEdittor.dir = dir
}

function saveData() {
	saveType = "save"
	ajaxPHP(config.rootPath + "/all/js/", "", "JsonFile", "game.js", "saveJson", "");
	
	
}

function showSettingPopup() {

}

function saveMessage() {
	str = '<div class="message-mine-container">' +
		'<div class="message-inner-container">' +
		'<div class="header">' +
		
		'<label>Save</label>' +
		'</div>' +
		'<div class="message-body">' +
		'<div class="message-icon floating-left"></div>' +
		'<label class="message-lbl floating-left">Saving successfully completed.</label>' +
		'</div>' +
		'</div>' +
		'</div>'
	$(str).appendTo('body')
	
	setTimeout(function () {
		removeMsg()
	}, 500)
}



