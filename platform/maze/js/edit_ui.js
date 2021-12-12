$(document).ready(function(){
    $('.save').on('click',function(){save()});
    $('.preview ').on('click',function(){
        window.open("viewer/"+config.lang.toLowerCase()+"/index.php?id="+config.GameID+"&v="+randomString(6, "Aa"),'_blank');
    });
    $('#add-image-1').attr('src',config.rootPath+'images/maze.png?v='+randomString(6, "Aa"));

    $('.URL_').val(config.rootPath);
    $('input[type=file]').change(function(e){
        $in=$(e.target);
        console.log($(e.target).attr('class'));
        var objedt=$('#add-image-2').attr('src',config.rootPath+'images/face.png?v='+randomString(6, "Aa"));
        if($(e.target).attr('class')=='add-image-1'){
            $("#hidden_iframe").contents().find("div.kh_maze").html('');




            $("#image_maze").submit();
            $(".add-image-1").val('');
            mazeimages = setInterval(refreashmazeimag,100);
        }else if($(e.target).attr('class')=='add-image-2'){
            $("#hidden_iframe").contents().find("div.kh_face").html('');

            ReadArea();
            $(".Face_width").val(game[0][0].w);
            $(".Face_height").val(game[0][0].h);
            $("#image_face").submit();
            $(".add-image-2").val('');
            faceimages = setInterval(refreashfaceimag, 100);



        }
    });
    BuildUpJason();
});

//<summery>
// A function that check paremeter compleated upload image and refreash load image
// </summary>

var mazeimages;
function refreashmazeimag(){
    if($("#hidden_iframe").contents().find("div.kh_maze").html()=='maze'){
        $('#add-image-1').attr('src',config.rootPath+'images/maze.png?v='+randomString(6, "Aa"));
        $("#hidden_iframe").contents().find("div.kh_maze").html('');
        clearInterval(mazeimages);
        mazeimages=null;
    }
}
//<summery>
// A function that check paremeter compleated upload image and refreash load image
// </summary>
var faceimages;
function refreashfaceimag(){
    if($("#hidden_iframe").contents().find("div.kh_face").html()=='face'){
        $('#add-image-2').attr('src',config.rootPath+'images/face.png?v='+randomString(6, "Aa"));
        $("#hidden_iframe").contents().find("div.kh_face").html('');
        clearInterval(faceimages);
        faceimages=null;
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
    console.log(game)
if(game[0]==undefined){
    var  idObject = randomString(6, "Aa");
    pushNewObject("AreaDifference",idObject,"",0,0,100,100, 1, 0)
}else{
    for(var i=0;i<game[0].length;i++){
        var  idObject = randomString(6, "Aa");
        pushNewObject("AreaDifference",idObject,"",game[0][i].top,game[0][i].left,game[0][i].width,game[0][i].height, 1, 0)
    }
}
    $('#add-image-2').attr('src',config.rootPath+'images/face.png?v='+randomString(6, "Aa"));
}

//<summer>
// A function save data in databasse and export file through ajax code
//<form name='image_face'>create imag name face to type jpg</form>
//<form name='image_maze'>create imag name maze to type jpg</form>
// </summer>
function save(){
    var json=ReadArea();
    console.log(json)
    $.ajax({
        url: "creatfilejs.php",
        type: "POST",
        cache: false,
        data: {
            id:config.GameID,
            url: config.rootPath,
            FileName: 'games.js',
            json: "[" + JSON.stringify(json) + "];var title='"+$("#question").val()+"'"
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
    $('.elementResizable').each(function () {
        if (this.id != undefined) {

            var object_left=parseInt($(this).css("left")) / (wrapper.width() / 100);
            var object_top=parseInt($(this).css("top"))/ (wrapper.height() / 100);
            var object_leftp=$(this).css("left");
            var object_topp=$(this).css("top");

            var object_width=parseInt($(this).css("width"))/ (wrapper.width() / 100);
            var object_height=parseInt($(this).css("height")) / (wrapper.height() / 100);
            var object_wp=$(this).css("width");
            var object_hp=$(this).css("height");
            position={left:object_left,top:object_top,width:object_width,leftp:object_leftp,topp:object_topp,width:object_width,height:object_height,w:object_wp,h:object_hp};
            game.push(position);
        }
    });
 return game;
}

