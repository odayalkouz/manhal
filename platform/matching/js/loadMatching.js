function loadMatchingFromJson() {
	$(".items").remove()
	$.each(game.matching, function (index, column) {
		//console.log( index + ": " + value.answer.type );
		console.log(typeof value + " :" + column)
		if (typeof column == 'object') {
			
			addNewElementMatch(column.index)
			
			
			drawObject(column.type, column.content, column.index, "left")
			drawObject(column.answer.type, column.answer.content, column.index, "right")
		}
		
	});
	
}

function getlengthMatching() {
	count = 0
	$.each(game.matching, function (index, column) {
		if (typeof column == 'object') {
			count++
		}
		
	});
	return count
}


function setOrientation() {
	if (game.oriPage == "verticle") {
		height = 88 / getlengthMatching();
		$(".items ").css({
			width: "100%",
			height: height + "%",
			"float": "none"
		})
		$(".headMatching ").css({
			"min-height": "6%"
			
		})
		$(".section1 ").css({
			width: "45%",
			height: "100%",
			left: '0px',
			top: '0'
		})
		$(".section2 ").css({
			width: "45%",
			height: "100%",
			left: '50%',
			top: '0'
		})
		
		$(".addNewItem, .addNewItem2 ").css({
			width: "100%",
			height: "6%",
			position: "relative",
			"float": "none"
		})
		$(".uploadMatching input ").css({
			'width': 'auto',
			'height': 'auto',
			'max-width': '100 % ',
			'max-height': '100 % ',
			'top': '-66 % ',
			'left': '0',
			'cursor': 'pointer',
			'opacity': '0',
			
			
		})
		$(".UploadcontentMach ").css({
			width: "17%",
			height: "16%",
			
			
		})
		
		
	} else {
		width = 94 / getlengthMatching();
		$(".items ").css({
			width: width + "%",
			height: "88%",
			"float": "left"
		})
		
		$(".headMatching ").css({
			"min-height": "12%"
			
		})
		
		$(".section1 ").css({
			width: "100%",
			height: "48%",
			left: '0px',
			top: '0'
		})
		$(".section2 ").css({
			width: "100%",
			height: "50%",
			left: '0%',
			top: '50%'
		})
		$(".addNewItem, .addNewItem2 ").css({
			width: "6%",
			height: "88%",
			position: "relative",
			"float": "left"
			
		})
		$(".editControlData ").css({
			width: "73%",
			height: "13%",
			
			
		})
		
		$(".UploadcontentMach ").css({
			width: "23%",
			height: "15%",
			
			
		})
		$(".editData ").css({
			left: "8%",
			top: "4%",
			width: "18%",
			height: "49%",
			
			
		})
		
		$(".uploadMatching input ").css({
			'width': 'auto',
			'height': 'auto',
			'max-width': '100 % ',
			'max-height': '100 % ',
			'top': '-44 % ',
			'left': '0',
			'cursor': 'pointer',
			'opacity': '0',
			
			
		})
	}
	
}