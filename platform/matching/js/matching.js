miniEdittor = {
	activeIndex: 0,
	dir: ""
}

function addNewElementMatch(index) {
	
	str = '   <div id="item' + index + '" index="' + index + '" class="items itemsanswer item' + index + '">' +
		'<div id="contentMachL'+index+'" class="contentMach"></div>' +
		'<div id="UploadcontentMachL'+index+'" class="UploadcontentMach"></div>' +
		'</div>'
	str2 = '   <div id="answerItem' + index + '" index="' + index + '" class="items itemsanswer2 item' + index + '">' +
		'<div id="contentMachR'+index+'" class="contentMach"></div>' +
		'<div id="UploadcontentMachR'+index+'" class="UploadcontentMach"></div>' +
		'</div>'
	$(str).insertBefore($(".addNewItem"))
	$(str2).insertBefore($(".addNewItem2"))
	
	$('.itemsanswer').on('click', function (e) {
		e.stopPropagation();
		clickAndEditMatchContent(this)
		miniEdittor.activeIndex=$(this).attr("index")
		miniEdittor.dir="left"
		
	}).click();
	
	$('.itemsanswer2').on('click', function (e) {
		e.stopPropagation();
		obj = document.getElementById("item" + $(this).attr("index"))
		$(obj).click()
		miniEdittor.dir="right"
	})
	
}

function pushNewObjectMatch() {
	if (typeof game.matching === "undefined") {
		game.matching = []
	}
	index = game.matching.length
	
	if(getlengthMatching()>=5){
		$(".addNewItem,.addNewItem2").hide()
		return
	}
	
	game.matching.push({
		type: "empty",
		index: index,
		content: "",
		answer: {
			type: "empty",
			content: ""
		}
		
	})
	
	
	addNewElementMatch(index)
	
}

function clickAndEditMatchContent(obj) {
	index = $(obj).attr('index')
	$(".editControl,.editControlData").remove()
	str1 = '<div class="editControl editData">' +
		'<img src="images/editDataMatc.png">' +
		'</div>'
	
	
	str2 = '<div class="editControl editDataRemove">' +
		'<img src="images/Remove%20.png">' +
		'</div>'
	changeContentMenu(obj, index)
	
	$(str1).appendTo(obj).show().attr('index', index).click(function () {
	
	
	})
	$(str2).appendTo(obj).show().attr('index', index).click(function () {
		removeMatchElement(index)
	})
	
	$(".editControl").click(function (e) {
		e.preventDefault()
		e.stopPropagation()
		if ($(".editControlData").css('display') == 'none') {
			$(".editControlData").show("fast")
		} else {
			$(".editControlData").hide("fast")
		}
		
	})
	
}

function removeMatchElement(index) {
	game.matching[index] = "removed"
	
	$('.item' + index).remove()
	setOrientation()
	if(getlengthMatching()<=5){
		$(".addNewItem,.addNewItem2").show()
		return
	}
	
}


function changeContentMenu(obj, index) {
	str = '<div index="' + index + '" class="editControlData">' +
		'<div class="editControlDatainner">' +
		'<div index="' + index + '" class="iconsEditData" onclick="activeSound(this)"><img' +
		' src="images/speack.png"></div>' +
		'<div index="' + index + '" class="iconsEditData" onclick="activeImage(this)""><img' +
		' src="images/uploadImg.png"></div>' +
		'<div index="' + index + '" class="iconsEditData" onclick="activeText(this)"><img' +
		' src="images/edittext.png"></div>' +
		'<div index="' + index + '" class="iconsEditData" onclick="activevedio(this)"><img' +
		' src="images/vedioIcon.png"></div>'
		+'<div index="' + index + '" class="iconsEditData" onclick="createThumbs()"><img' +
		' src="images/libraryPng.png"></div>' +
		'<div index="' + index + '" class="iconsEditData" onclick="removeDataFromCol(this)"><img' +
		' src="images/fileEmpty.png"></div>' +
		'</div>' +
		'</div>'
	
	$(str).appendTo(obj).addClass("lefttCol ").attr("parent", "itemsanswer").hide()
	$(str).appendTo("#answerItem" + index).addClass("rightCol ").attr("parent", "itemsanswer2").hide()
}


function checkIfSetAnswer() {
	check = false
	$.each(game.matching, function (index, value) {
		//console.log( index + ": " + value.answer.type );
		console.log(typeof value + " :" + value)
		if (typeof value == 'object') {
			if (value.type != "empty" || value.content != "" && value.answer.content == "") {
				
				check = true
				return
			}
		}
	});
	
	return check
}



