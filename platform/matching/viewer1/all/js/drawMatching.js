
function drawColumn(){

var dta=game[0]
	count=0
	matchingArray=[]
	$.each(dta.matching, function (index, column) {

		if (typeof column == 'object') {
			count++
			matchingArray.push({
				col1:{
					Element:column.content,
					type:column.type,
					index:column.index
				},
				col2:{
					Element:column.answer.content,
					type:column.answer.type,
					index:column.index
				}
			})

		}
		
	});





function StartDraw(){
	$('.coloumn1Element').html("")
	$('.coloumn2Element').html("")
	$.each(matchingArray, function (index, column) {
		console.log(column)
		if (typeof column == 'object' || typeof column != 'undefined') {
		
			$(elementContainer(column.col1,1,column.col1.type)).appendTo('.coloumn1Element');
			$(elementContainer(column.col2,2,column.col2.type)).appendTo('.coloumn2Element');
			
		}
		
	});
}


var expandArray = function () {
	
	lengthDiv = matchingArray.length;
	heightDiv = parseInt($('.coloumn1Element').css('height')) / lengthDiv;
	
	for (var i = 0; i < matchingArray.length; i++) {
		if (matchingArray[i].col1.type == 'text')
			var str = '<div attrindex="' + i + '"  ' +
				'answer="' + matchingArray[i].col1.Element + ' " ' +
				'id="col1' + i + '" class="elemMatch colEl1"><label ' +
				'class="lbl-data-matching">' + matchingArray[i].col1.Element + '' +
				'</label></div>'
		
		if (matchingArray[i].col1.type == 'image')
			var str = '<div attrindex="' + i + '"  ' +
				'answer="' + matchingArray[i].col1.Element + ' " ' +
				'id="col1' + i + '" ' +
				'class="elemMatch colEl1">' +
				'<img class="imageElem" src="' + matchingArray[i].col1.Element + '">' +
				'</div>'
		
		if (matchingArray[i].col1.type == 'sound')
			var str = '<div attrindex="' + i + '"  ' +
				'answer="' + matchingArray[i].col1.Element + ' " id="col1' + i + '" ' +
				'class="elemMatch colEl1 ">' +
				' <audio id="audio' + i + '" src="' + matchingArray[i].col1.Element + '" class="media" preload="auto"  ></audio>' +
				'<div class="btn-container">' +
				'<button class="audio-btn flaticon-stop48" indexAudio="' + i + '" id="stop' + i + '">' +
				'</button>' +
				'<button class="audio-btn flaticon-start4" indexAudio="' + i + '" id="play' + i + '">' +
				'</button></div>' +
				'</div>'
		
		
		if (matchingArray[i].col1.type == 'html')
			var str = '<div attrindex="' + i + '"  answer="' + matchingArray[i].col1.Element + ' " id="col1' + i + '" class="elemMatch colEl1 ">' +
				matchingArray[i].col1.Element +
				'</div>'
		$(str).appendTo('.coloumn1Element');
		
		
		
		$('#play' + i).click(function () {
			stopAllMedia()
			event.preventDefault();
			event.stopPropagation();
			event.stopImmediatePropagation();
			index = $(this).attr('indexAudio')
			$('#audio' + index).trigger('play')
		})
		$('#stop' + i).click(function () {
			stopAllMedia()
			event.preventDefault();
			event.stopPropagation();
			event.stopImmediatePropagation();
			index = $(this).attr('indexAudio')
			$('#audio' + index).trigger('pause');
		})
		
		
		//***********************************************
		if (matchingArray[i].col2.type == 'text') {
			var str = '<div  attrindex="' + i + '"  answer="' + matchingArray[i].col2.Element + ' " ' +
				'id="col2' + i + '" class="elemMatch colEl2">' +
				'<label class="lbl-data-matching">' + matchingArray[i].col2.Element + '</label> </div>'
			
		}
		
		if (matchingArray[i].col2.type == 'image') {
			var str = '<div  attrindex="' + i + '"  ' +
				'answer="' + matchingArray[i].col2.Element + ' " ' +
				'id="col2' + i + '" class="elemMatch colEl2">' +
				'<img class="imageElem" src="' + matchingArray[i].col2.Element + '"></div>'
			
		}
		
		
		if (matchingArray[i].col2.type == 'sound') {
			var str = '<div  attrindex="' + i + '"  answer="' + matchingArray[i].col2.Element + ' " id="col2' + i + '" class="elemMatch colEl2">' +
				' <audio id="audio2' + i + '" src="' + matchingArray[i].col1.Element + '" class="media" preload="auto"  ></audio>' +
				'<button class="audio-btn" indexAudio="' + i + '" id="stop2' + i + '">Stop</button>' +
				'<button class="audio-btn" indexAudio="' + i + '" id="play2' + i + '">Play</button>' +
				'</div>'
		}
		
		if (matchingArray[i].col2.type == 'html')
			var str = '<div  attrindex="' + i + '"  answer="' + matchingArray[i].col2.Element + ' " id="col2' + i + '" class="elemMatch colEl2">' +
				matchingArray[i].col2.Element +
				'</div>'
		
		
		$(str).appendTo('.coloumn2Element');
		
		
		$('#play2' + i).click(function () {
			stopAllMedia()
			event.preventDefault();
			event.stopPropagation();
			event.stopImmediatePropagation();
			index = $(this).attr('indexAudio')
			$('#audio2' + index).trigger('play')
			
			
		})
		$('#stop2' + i).click(function () {
			stopAllMedia()
			event.preventDefault();
			event.stopPropagation();
			event.stopImmediatePropagation();
			index = $(this).attr('indexAudio')
			$('#audio2' + index).trigger('pause');
			
			
		})
		
		$('.elemMatch').css('height', eval(heightDiv) + 'px')
		
	}
	
	
}










function stopAllMedia() {
	var media = document.getElementsByClassName('media'),
		i = media.length;
	
	while (i--) {
		media[i].pause();
	}
}

function elementContainer(coloumn,colNumber,type){
	dotContainerClass="dot-container"
	
	if(colNumber==2){
		dotContainerClass="dot-container-b"
	}
	
	
	str=""
	if(type=="image"){
		
			path=config.root+'/'+coloumn.Element
		
		str='<div object_match="object_match" class="element-container">'+
			'<div class="display-table-row">'+
			'<div class="'+dotContainerClass+' button-animation">'+
			'<div style="cursor:pointer ; " object_match="object_match" activ="true"'+
			'attrindex="'+coloumn.index+'" answer="a" name="col'+1+'A" id="col'+colNumber+coloumn.index+'"'+
			'class="dot-class colEl'+colNumber+' floating-right object_match-dot"></div>'+
			'</div>'+
			'<div dot="col'+colNumber+coloumn.index+'" class="floating-right main-image   animated zoomIn" '+
			'style="background: url('+path+');background-repeat: no-repeat;background-size:100% 100%"></div>'+
			'</div>'+
			'</div>'
	}
	else if(type=="text"){
		text=coloumn.Element
		str='<div object_match="object_match" class="element-container">'+
			'<div class="display-table-row">'+
			'<div class="'+dotContainerClass+' button-animation">'+
			'<div style="cursor:pointer ; " object_match="object_match" activ="true"'+
			'attrindex="'+coloumn.index+'" answer="a" name="col'+1+'A" id="col'+colNumber+coloumn.index+'"'+
			'class="dot-class colEl'+colNumber+' floating-right object_match-dot"></div>'+
			'</div>'+
			'<div dot="col'+colNumber+coloumn.index+'" class="floating-right main-image   animated zoomIn"'+
			'style="background: url();background-repeat: no-repeat;background-size:100% 100%">' +
			'<span>'+text+'</span>' +
			'</div>'+
			'</div>'+
			'</div>'
	}
	else if(type=="video"){
		path=config.root+'/'+coloumn.Element
	
		str='<div object_match="object_match" class="element-container">'+
			'<div class="display-table-row">'+
			'<div class="'+dotContainerClass+' button-animation">'+
			'<div style="cursor:pointer ; " object_match="object_match" activ="true"'+
			'attrindex="'+coloumn.index+'" answer="a" name="col'+1+'A" id="col'+colNumber+coloumn.index+'"'+
			'class="dot-class colEl'+colNumber+' floating-right object_match-dot"></div>'+
			'</div>'+
			'<div dot="col'+colNumber+coloumn.index+'" class="floating-right main-image   animated zoomIn"'+
			'style="background: url();background-repeat: no-repeat;background-size:100% 100%">'+
			'<video controls>'+
			'<source src="'+path+'" type="audio/mp4">'+
			'</video>' +
			'</div>' +
			
			'</div>'+
			'</div>'
	}
	else if(type=="sound"){
		path=config.root+'/'+coloumn.Element
		str='<div object_match="object_match" class="element-container">'+
			'<div class="display-table-row">'+
			'<div class="'+dotContainerClass+' button-animation">'+
			'<div style="cursor:pointer ; " object_match="object_match" activ="true"'+
			'attrindex="'+coloumn.index+'" answer="a" name="col'+1+'A" id="col'+colNumber+coloumn.index+'"'+
			'class="dot-class colEl'+colNumber+' floating-right object_match-dot"></div>'+
			'</div>'+
			'<div dot="col'+colNumber+coloumn.index+'" class="floating-right main-image   animated zoomIn"'+
			'style="background: url();background-repeat: no-repeat;background-size:100% 100%">' +
			'<audio controls="false">'+
			'<source src="'+path+'" type="audio/mp3">'+
		    '</audio>' +
			'</div>'+
			'</div>'+
			'</div>'
	}
return str
}
	
	
	
	
	StartDraw()
	shuffleDivs()
	allobject_array = new Array();
	object_match = new MatchingOOP('object_match', '1', 'col1A', 3, 'sound/question1.mp3');
	allobject_array.push(object_match);
	//fix width-height//
	var conHeight = ($(window).height() - ($(".admin-login .popup-container .close-container").height() + 10));
	var conWidth = ($(window).width() - ($(".admin-login .popup-container .close-container").width() + 10));

	directionOrientation=game[0].oriPage
    if(directionOrientation=="verticle") {
        height = 100 / count;
        $(".matching-content").width(conWidth);
        $(".element-container").height(height + "%");
        $("#canvas1").attr("width", conWidth);
    }
    else
	{
        width = (100 / count) - 5;
        $(".matching-content").height(conHeight);
        $(".element-container").width(width + "%");
        $(".element-container").css("margin","0 2.31% 0 0");
        $("#canvas1").attr("height", conHeight);

	}
	resizeGame();
}

function shuffleDivs() {
	var parent = $(".coloumn1Element");
	var divs = parent.children();
	while (divs.length) {
		parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
	}
	
	
	
	var parent = $(".coloumn2Element");
	var divs = parent.children();
	while (divs.length) {
		parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
	}
}
