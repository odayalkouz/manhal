/*Text element*/
function activeText(elem) {
	
	
	event.stopPropagation();
	miniEdittor.activeIndex = $(elem).attr("index")
	parent = $(elem).closest(".editControlData")
	if (parent.hasClass("lefttCol")) {
		miniEdittor.dir = "left"
		contain = "#contentMachL" + miniEdittor.activeIndex
		$(contain).html("")
		if (parent.parent().find("textarea").length > 0) {
			
			return
		}
		$("#UploadcontentMachL" + miniEdittor.activeIndex).hide()
		game.matching[miniEdittor.activeIndex].type = "text"
		game.matching[miniEdittor.activeIndex].content = ""
		$("<textarea dir='left' class='textareaLeft' onkeyup='updateTextInJsonArray(this)'>Enter text</textarea>").appendTo(contain)
			.val(game.matching[miniEdittor.activeIndex].content)
		
		
		
	} else {
		miniEdittor.dir = "right"
		contain = "#contentMachR" + miniEdittor.activeIndex
		$(contain).html("")
		if (parent.parent().find(".textarea").length > 0) {
			return
		}
		game.matching[miniEdittor.activeIndex].answer.type = "text"
		game.matching[miniEdittor.activeIndex].answer.content = ""
		$("#UploadcontentMachR" + miniEdittor.activeIndex).hide()
		
		$("<textarea dir='right' class='textareaRight' onkeyup='updateTextInJsonArray(this)'>Enter text</textarea>").appendTo(contain)
			.val(game.matching[miniEdittor.activeIndex].answer.content)
		
	}
	$(".editControlData").hide("fast")
}


function updateTextInJsonArray(object) {
	value = $(object).val()
	miniEdittor.dir = $(object).attr('dir')
	
	if (miniEdittor.dir == "left") {
		game.matching[miniEdittor.activeIndex].type = "text"
		game.matching[miniEdittor.activeIndex].content = value
		
	} else {
		game.matching[miniEdittor.activeIndex].answer.type = "text"
		game.matching[miniEdittor.activeIndex].answer.content = value
	}
}


/*sound element*/

function activeSound(elem) {
	event.stopPropagation();
	miniEdittor.activeIndex = $(elem).attr("index")
	parent = $(elem).closest(".editControlData")
	if (parent.hasClass("lefttCol")) {
		miniEdittor.dir = "left"
		contain = "#UploadcontentMachL" + miniEdittor.activeIndex
		$("#contentMachL" + miniEdittor.activeIndex).html("")
		$("#UploadcontentMachL" + miniEdittor.activeIndex).show()
		$(contain).html("")
		if (parent.parent().find(".MatchingObjectSound").length > 0) {
			
			return
		}
		
		strElem =
			'<div onclick="simulateUploadJquery(\'soundMatchUplaodL' + miniEdittor.activeIndex + '\',\'left\')"' +
			' class="uploadMatching">' +
			'<label for="file-input">' +
			'<img src="images/upSound.png"/>' +
			'</label>' +
			'' +
			'<input id="soundMatchUplaodL' + miniEdittor.activeIndex + '" type="file"' +
			' class="MatchingObjectSound"' +
			' id="uploadsoundObjectMatching' + index + '"' +
			' UploadType="uploadsoundObjectMatching"' +
			'onchange="UploadType=\'uploadsoundObject\';getImageLocal(this)"' +
			' name="upload" accept="audio/*">' +
			'<audio></audio>' +
			'</div>'
		$(strElem).appendTo(contain)
		miniEdittor.dir = "left"
		
	} else {
		miniEdittor.dir = "right"
		contain = "#UploadcontentMachR" + miniEdittor.activeIndex
		$("#UploadcontentMachR" + miniEdittor.activeIndex).show()
		$("#contentMachR" + miniEdittor.activeIndex).html("")
		$(contain).html("")
		if (parent.parent().find(".MatchingObjectSound").length > 0) {
			return
		}
		
		strElem =
			'<div onclick="simulateUploadJquery(\'soundMatchUplaodR' + miniEdittor.activeIndex + '\',\'right\')"' +
			' class="uploadMatching">' +
			'<label for="file-input">' +
			'<img src="images/upSound.png"/>' +
			'</label>' +
			'' +
			'<input id="soundMatchUplaodR' + miniEdittor.activeIndex + '" type="file"' +
			' class="MatchingObjectSound "' +
			' id="uploadsoundObjectMatching' + index + '"' +
			' UploadType="uploadsoundObjectMatching"' +
			'onchange="UploadType=\'uploadsoundObject\';getImageLocal(this)"' +
			' name="upload" accept="audio/*">' +
			'<audio></audio>' +
			'</div>'
		$(strElem).appendTo(contain)
		miniEdittor.dir = "right"
	}
	$(".editControlData").hide("fast")
}


function activeImage(elem) {
	event.stopPropagation();
	miniEdittor.activeIndex = $(elem).attr("index")
	parent = $(elem).closest(".editControlData")
	if (parent.hasClass("lefttCol")) {
		miniEdittor.dir = "left"
		contain = "#UploadcontentMachL" + miniEdittor.activeIndex
		$("#contentMachL" + miniEdittor.activeIndex).html("")
		$("#UploadcontentMachL" + miniEdittor.activeIndex).show()
		$(contain).html("")
		if (parent.parent().find(".MatchingObjectImage").length > 0) {
			
			return
		}
		
		strElem =
			'<div onclick="simulateUploadJquery(\'imageMatchUplaodL' + miniEdittor.activeIndex + '\',\'left\')" class="uploadMatching">' +
			'<label for="file-input">' +
			'<img src="images/upImage.png"/>' +
			'</label>' +
			'' +
			'<input id="imageMatchUplaodL' + miniEdittor.activeIndex + '" type="file"' +
			' class="MatchingObjectImage "' +
			' id="uploadimageObjectMatching' + index + '"' +
			' UploadType="uploadimageObjectMatching"' +
			'onchange="UploadType=\'uploadsoundObject\';getImageLocal(this)"' +
			' name="upload" accept="image/*">' +
			'<audio></audio>' +
			'</div>'
		$(strElem).appendTo(contain)
		
		miniEdittor.dir = "left"
	} else {
		miniEdittor.dir = "right"
		contain = "#UploadcontentMachR" + miniEdittor.activeIndex
		$("#contentMachR" + miniEdittor.activeIndex).html("")
		$("#UploadcontentMachR" + miniEdittor.activeIndex).show()
		$(contain).html("")
		if (parent.parent().find(".MatchingObjectImage").length > 0) {
			return
		}
		
		strElem =
			'<div onclick="simulateUploadJquery(\'imageMatchUplaodR' + miniEdittor.activeIndex + '\',\'right\')"' +
			' class="uploadMatching">' +
			'<label for="file-input">' +
			'<img src="images/upImage.png"/>' +
			'</label>' +
			'' +
			'<input id="imageMatchUplaodR' + miniEdittor.activeIndex + '" type="file"' +
			' class="MatchingObjectImage"' +
			' id="uploadimageObjectMatching' + index + '"' +
			' UploadType="uploadimageObjectMatching"' +
			'onchange="UploadType=\'uploadsoundObject\';getImageLocal(this)"' +
			' name="upload" accept="image/*">' +
			'<audio></audio>' +
			'</div>'
		$(strElem).appendTo(contain)
		miniEdittor.dir = "right"
		
	}
	$(".editControlData").hide("fast")
}


function activevedio(elem) {
	event.stopPropagation();
	miniEdittor.activeIndex = $(elem).attr("index")
	parent = $(elem).closest(".editControlData")
	if (parent.hasClass("lefttCol")) {
		miniEdittor.dir = "left"
		contain = "#UploadcontentMachL" + miniEdittor.activeIndex
		$("#contentMachL" + miniEdittor.activeIndex).html("")
		$("#UploadcontentMachL" + miniEdittor.activeIndex).show()
		$(contain).html("")
		if (parent.parent().find(".MatchingObjectImage").length > 0) {
			
			return
		}
		
		strElem =
			'<div onclick="simulateUploadJquery(\'vedioMatchUplaodL' + miniEdittor.activeIndex + '\',\'left\')" class="uploadMatching">' +
			'<label for="file-input">' +
			'<img src="images/upVedio.png"/>' +
			'</label>' +
			'' +
			'<input id="vedioMatchUplaodL' + miniEdittor.activeIndex + '" type="file"' +
			' class="MatchingObjectvedio "' +
			' id="uploadvedioObjectMatching' + index + '"' +
			' UploadType="uploadvedioObjectMatching"' +
			'onchange="UploadType=\'uploadvedioObject\';getImageLocal(this)"' +
			' name="upload" accept="video/*">' +
			'<audio></audio>' +
			'</div>'
		$(strElem).appendTo(contain)
		
		
	} else {
		
		miniEdittor.dir = "right"
		contain = "#UploadcontentMachR" + miniEdittor.activeIndex
		$("#contentMachR" + miniEdittor.activeIndex).html("")
		$("#UploadcontentMachR" + miniEdittor.activeIndex).show()
		$(contain).html("")
		if (parent.parent().find(".MatchingObjectvedio").length > 0) {
			return
		}
		
		strElem =
			'<div onclick="simulateUploadJquery(\'vedioMatchUplaodR' + miniEdittor.activeIndex + '\',\'right\')"' +
			' class="uploadMatching">' +
			'<label for="file-input">' +
			'<img src="images/upVedio.png"/>' +
			'</label>' +
			'' +
			'<input id="vedioMatchUplaodR' + miniEdittor.activeIndex + '" type="file"' +
			' class="MatchingObjectvedio"' +
			' id="uploadvedioObjectMatching' + index + '"' +
			' UploadType="uploadvedioObjectMatching"' +
			'onchange="UploadType=\'uploadvedioObject\';getImageLocal(this)"' +
			' name="upload" accept="video/*">' +
			'<audio></audio>' +
			'</div>'
		$(strElem).appendTo(contain)
		
		
	}
	$(".editControlData").hide("fast")
}

function removeDataFromCol(elem) {
	event.stopPropagation();
	miniEdittor.activeIndex = $(elem).attr("index")
	parent = $(elem).closest(".editControlData")
	if (parent.hasClass("lefttCol")) {
		miniEdittor.dir = "left"
		contain = "#contentMachL" + miniEdittor.activeIndex
		$(contain).html("")
		if (parent.parent().find("textarea").length > 0) {
			
			return
		}
		$("#UploadcontentMachL" + miniEdittor.activeIndex).hide()
		
		// $("<textarea dir='left' class='textareaLeft' onkeyup='updateTextInJsonArray(this)'>Enter text</textarea>").appendTo(contain)
		// 	.val(game.matching[miniEdittor.activeIndex].content)
		
		game.matching[miniEdittor.activeIndex].type = "empty"
		game.matching[miniEdittor.activeIndex].content = ""
		miniEdittor.dir = "left"
	} else {
		miniEdittor.dir = "right"
		contain = "#contentMachR" + miniEdittor.activeIndex
		$(contain).html("")
		if (parent.parent().find(".textarea").length > 0) {
			return
		}
		$("#UploadcontentMachR" + miniEdittor.activeIndex).hide()
		
		// $("<textarea dir='right' class='textareaRight' onkeyup='updateTextInJsonArray(this)'>Enter text</textarea>").appendTo(contain)
		// 	.val(game.matching[miniEdittor.activeIndex].answer.content)
		game.matching[miniEdittor.activeIndex].answer.type = "empty"
		game.matching[miniEdittor.activeIndex].answer.content = ""
		miniEdittor.dir = "right"
	}
	$(".editControlData").hide("fast")
	
	
}


function drawObject(type, content, index, dir) {
	
	path = config.rootPath
	classImage=""
	if(getExtension(content)=="svg"){
		classImage="svgImage"
		
	}

	if (type == "image") {
		
		if (dir == "left") {
			container = $("#contentMachL" + index)
			container.html("")
			$("<img class='"+classImage+"' src='" + path + "all/" + content +"?"+ Math.random()+ "'>").appendTo("#contentMachL" + index)
		} else {
			container = $("#contentMachR" + index)
			container.html("")
			$("<img class='"+classImage+"' src='" + path + "all/" + content +"?"+ Math.random()+"'>").appendTo("#contentMachR" + index)
			
		}
		
	}
	else if (type == "sound") {
		if (dir == "left") {
			container = $("#contentMachL" + index)
			container.html("")
			strAudio='<audio controls>'+
			"<source src='" + path + "all/" + content +"?"+ Math.random()+ "' type='audio/mp3'> " +
			"</audio>"
			$(strAudio).appendTo("#contentMachL" + index)
		} else {
			container = $("#contentMachR" + index)
			container.html("")
			strAudio='<audio controls>'+
			"<source src='" + path + "all/" + content +"?"+ Math.random()+ "' type='audio/mp3'> </audio>"
			$(strAudio).appendTo("#contentMachR" + index)
		}
		
	}
	else if (type == "video") {
		if (dir == "left") {
			container = $("#contentMachL" + index)
			container.html("")
			strVedio='<video controls>'+
				"<source src='" + path + "all/" + content +"?"+ Math.random()+ "' type='video/mp4'> </video>"
			$(strVedio).appendTo("#contentMachL" + index)
		} else {
			container = $("#contentMachR" + index)
			container.html("")
			strVedio='<video controls>'+
				"<source src='" + path + "all/" + content +"?"+ Math.random()+ "' type='video/mp4'> </video>"
			$(strVedio).appendTo("#contentMachR" + index)
		}
		
	} else if(type=="text") {
		
		if (dir == "left") {
			container = $("#contentMachL" + index)
			container.html("")
			$("<textarea dir='left' class='textareaLeft' onkeyup='updateTextInJsonArray(this)'>Enter text</textarea>").appendTo("#contentMachL" + index)
				.val(content)
			
		} else {
			container = $("#contentMachR" + index)
			container.html("")
			$("<textarea dir='left' class='textareaRight' onkeyup='updateTextInJsonArray(this)'>Enter" +
				" text</textarea>").appendTo("#contentMachR" + index)
				.val(content)
		}
	
	
		
	}
	
	
}