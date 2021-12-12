/**
 * Created by khalid alomiri on 21/3/2016.
 */
var lastAddId = ""


function setdatafunction() {
	casetype = arguments[0].TypeProcesses;
	$.ajax({
		url: "../ajax/function.php",
		type: "POST",
		data: arguments[0],
		cache: false,
		dataType: 'html',
		casetype: casetype,
		success: function (html) {
			//  console.clear();
			console.log(casetype);
			// console.log(html);
			switch (casetype) {
				case "login":
					if (html == 1) {
						window.location = 'index.php'
					} else {
						swal(window.Lang['SignInError'], window.Lang['SignInErrorMsg'], 'error');
					}
					break;
				case "creategame":
					SetStoryData(html)
					break;
				case "updateGames":
					saveMessage()
					break;
				case "RemoveGames":
					location.reload()
					break;
				case "split_site":
					window.location = "story/" + html;
					removeLoader()
					break;
				case "getdatagames":
					
					
					data = $.parseJSON('[' + html + ']')
					if (data[0].data === undefined || data[0].data === null) {
						game.objects = [];
					} else {
						game = $.parseJSON(data[0].data)
					}
					
					
					DrawObjects();
					
					changeBackground(config.rootPath + lang + "/images/bg.png?" + Math.random())
					$(".gameContent").click()
					if ($(".elementResizable ").length) {
						$(".elementResizable ")[0].click()
						$(".elementResizable").css({
							width: game.option.widthCircle + "vw",
							height: game.option.widthCircle + "vw",
						})
						$(".gameContainer").css({
							background: game.option.bgColor
						})
						$(".dot_number").css({
							'font-size': game.option.fontSize + "vw",
							color: game.option.textColor
						})
						$(".elementResizable").css({
							background: game.option.circleColor
						})
					}
					Lobibox.notify("success", {
						
						size: 'mini',
					
					delayIndicator: false,
					msg: 'Loaded complete.'
			});
					
					//console.log(data)
					//   console.log($.parseJSON(data[0].data))
					$(".dot_container").each(function () { //if container is a class
						$('.dot_number', $(this)).css(
							{
								'font-size': $(this).height() + "px",
								'font-weight': 'bold'
							}); //you should only have 1 #text in your document, instead, use class
					});
					refresh()
					Arabicletters()
					//
					//console.log(html);
					break;
			}
		}
		
	});
}
/*setdatafunction(
 {
 TypeProcesses: 'creategame',
 name:'new games1',
 description: 'description',
 thumb: 'images/Thumb.png',
 data:'',
 Category: 0,
 type:1
 });*/



/*
 setdatafunction(
 {TypeProcesses:'RemoveGames',
 gameid:currentGameID
 
 });
 */


/*
 setdatafunction(
 {TypeProcesses:'updateGames',
 id:30,
 name:'updategames new',
 category:'1',
 description:'description new ',
 thumb:'themb new .jpg',
 type:'2',
 delete:0
 
 });*/


/*setdatafunction(
 {TypeProcesses:'getdatagames',
 id:1
 
 
 });*/