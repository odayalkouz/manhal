$(document).ready(function(){
    $('.save').on('click',function(){save()});
    $('.preview ').on('click',function(){
        window.open("viewer/"+config.lang.toLowerCase()+"/index.php?id="+config.GameID+"&v="+randomString(6, "Aa"),'_blank');
    });
    $('#add-image-1').attr('src',config.rootPath+'images/left.jpg?v='+randomString(6, "Aa"));
    $('#add-image-2').attr('src',config.rootPath+'images/right.jpg?v='+randomString(6, "Aa"));
    $('.URL_').val(config.rootPath);
    $('input[type=file]').change(function(e){
        $in=$(e.target);
        console.log($(e.target).attr('class'));
        var objedt=$('#add-image-2').attr('src',config.rootPath+'images/right.jpg?v='+randomString(6, "Aa"));
        if($(e.target).attr('class')=='add-image-1'){
            $("#hidden_iframe").contents().find("div.kh_left").html('');

            $("#image_left").submit();
            leftimages = setInterval(refreashleftimag,100);
        }else if($(e.target).attr('class')=='add-image-2'){
            $("#hidden_iframe").contents().find("div.kh_right").html('')
            $("#image_right").submit();
            rightimages = setInterval(refreashrightimag, 100);
        }
    });
    BuildUpJason();
});

//<summery>
// A function that check paremeter compleated upload image and refreash load image
// </summary>

var leftimages;
function refreashleftimag(){
    if($("#hidden_iframe").contents().find("div.kh_left").html()=='left'){
        $('#add-image-1').attr('src',config.rootPath+'images/left.jpg?v='+randomString(6, "Aa"));
        $("#hidden_iframe").contents().find("div.kh_left").html('');
        clearInterval(leftimages);
        leftimages=null;
    }
}
//<summery>
// A function that check paremeter compleated upload image and refreash load image
// </summary>
var rightimages;
function refreashrightimag(){
    if($("#hidden_iframe").contents().find("div.kh_right").html()=='right'){
        $('#add-image-2').attr('src',config.rootPath+'images/right.jpg?v='+randomString(6, "Aa"));
        $("#hidden_iframe").contents().find("div.kh_right").html('');
        clearInterval(rightimages);
        rightimages=null;
    }
}
// <summary>
// A function that a read upload file to image base64 and view in  tag image
//</summary>
//<parm name='file'>tag input and type = file </parm>
function encodeImageFileAsURL(element) {
    var file = element.files[0];
    var reader = new FileReader();
    reader.onloadend = function () {
        $(".add-image-1").attr("src", reader.result)
        $('#' + $(element).attr('class')).attr('src', reader.result);
    }
    reader.readAsDataURL(file);
}
//<summery>
// A function read all data from json and build positions difference
// </summary>
//<parm name='game'> read json file and build objects</parm>
function BuildUpJason() {
    if(signImg==false){
        $('#iconFalse').prop( "checked", true );
    };
    if(viewerType==false){
        $('#layoutV').prop( "checked", true );
    };


for(var i=0;i<game[0].length;i++){
        var  idObject = randomString(6, "Aa");
    pushNewObject("AreaDifference",idObject,"",game[0][i].top,game[0][i].left,game[0][i].width,game[0][i].height, 1, 0)
}
}

//<summer>
// A function save data in databasse and export file through ajax code
//<form name='image_right'>create imag name right to type jpg</form>
//<form name='image_left'>create imag name left to type jpg</form>
// </summer>
function save(){



    var json=ReadArea();
    $.ajax({
        url: "creatfilejs.php",
        type: "POST",
        cache: false,
        data: {
            id:config.GameID,
            url: config.rootPath,
            FileName: 'games.js',
            json: "[" + JSON.stringify(json) + "];var signImg="+signImg+";var viewerType="+viewerType+";"
    },
        dataType:'html',
        async:false,
        success: function(html) {
            ;
        }
    });

}

// <summary >
// A function that a read each while position in area difference between image
//</summary>
//<parm name='_arry'>continer save all position to each area</parm>
//<returns>json data all position</returns>
function ReadArea() {
    var game=[];
    var position={};
    var wrapper = $('.AreaDifference');

    if($('#iconTrue').prop('checked')) {
        signImg = true;
    }else{
        signImg=false
    }
    if($('#layoutH').prop('checked')) {
        viewerType = true;
    }else{
        viewerType=false
    }
    $('.elementResizable').each(function () {
        if (this.id != undefined) {
            var object_left=parseInt($(this).css("left")) / (wrapper.width() / 100);
            var object_top=parseInt($(this).css("top"))/ (wrapper.height() / 100);
            var object_width=parseInt($(this).css("width"))/ (wrapper.width() / 100);
            var object_height=parseInt($(this).css("height")) / (wrapper.height() / 100);
            position={left:object_left,top:object_top,width:object_width,height:object_height};
            game.push(position);
        }
    });
 return game;
}

