



function msg(){

	str='<div id="MessegeContainer"><div class="MSGConfirm">' +
		'<div class="line-row-message"><label>Are you sure you want to clear drawing ?<label></div>'+
		'<div class="line-row-message">' +
		'<a type="button" class="ok-btn" onclick="flipSound();hidePobUpJus(false);resetCanvas();fillArea();removeMessege()"><i class="flaticon-sign27"></i></a>' +
		'<a type="button" class="colse-btn" onclick="removeMessege();flipSound();hidePobUpJus(false);"><i class="flaticon-delete30"></i></a>' +
		'</div>' +
		'' +
		'' +
		'' +
		'' +
		'</div><div>'

		$(str).appendTo('#canvasContainer')

}


function removeMessege(){

	if($('#MessegeContainer'))$('#MessegeContainer').remove()
}