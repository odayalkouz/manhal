/**
 * Created by khalid alomiri on 5/16/2017.
 */
function addquestion(val) {
    var id = GenrateID();


    var question = '<div id="question_' + id + '" space="false" title_="أدخل النص " wrong="" sound="" class="question-row floating-right">';
    question += '<i class="add-question  floating-right" id="addquestionicon" onclick="$(this).remove();addquestion();"></i>';
    question += '<span class="qustion-number floating-right">-' + ($("#gameContent").children().length + 1) + '</span>';
    question += '<div id="word_' + id + '" class="qustion-text floating-right"><span class="floating-right">أدخل النص </span></div>';
    question += '<i class="delete-question floating-right" onclick="DeleteQuestion(' + String.fromCharCode('39') + id + String.fromCharCode('39') + ')"></i>';
    question += '<i onclick="editText(' + String.fromCharCode('39') + id + String.fromCharCode('39') + ')" class="sound-question floating-right"></i>';
    question += '<div id="selected-word_' + id + '" class="selected-word-container"></div></div>';
    $("#gameContent").append(question);
    renumberquestion()
}

function donEdit() {
    var id = $('.addTitle').attr('index');
    var str = $("#titleText").val().trim();
    if (id == 'exercise_title') {
        $("#" + id).attr('title_', str);
        $("#" + id).html(str);
    } else {

        $("#question_" + id).attr('space',new Boolean($("#spaces").prop('checked')));

        if($("#iconimages").attr('src')!=''  ) {
            $("#question_" + id).attr('images', id);
        }else{
            $("#question_" + id).attr('images', '');
        }
        if($("#audioPreview").attr('src')!=''  ) {
            $("#question_" + id).attr('sound', id);
        }else{
            $("#question_" + id).attr('sound', '');
        }
        if($("#wrong_chr").val()!='' && $("#wrong_chr").val()!= undefined  ) {
            $("#question_" + id).attr('wrong', $("#wrong_chr").val());
        }else{
            $("#question_" + id).attr('wrong', '');
        }
        splitquestion(id, str);
        $("#selected-word_" + id).html('');
    }
    $('.addTitle').hide();
}
function splitquestion(id, str) {
    $("#question_" + id).attr('title_', str);


    str = str.split("  ").join(" ").split(" ");
    var data = '';
    var j = 0;
    for (var i = 0; i < str.length; i++) {
        if (str[i] != "") {
            data += '<span onclick="selectword(this)" attid="' + id + '" id="word_' + id + '_' + j + '" class="floating-right">' + str[i] + '</span>'
            j++
        }
    }
    $("#word_" + id).html(data);


}
function selectword(val) {
    var id = $(val).attr('id');
    var idparent = $(val).attr('attid');
    if ($('#S' + id).html() == undefined) {
        $(val).addClass('selected');
        $("#selected-word_" + idparent).append('<span onclick="removewordselect(' + String.fromCharCode('39') + id + String.fromCharCode('39') + ')" id="S' + id + '" class="floating-right">' + $(val).html() + '</span>')
    } else {
        $(val).removeClass('selected');
        $('#S' + id).remove();
    }
}
function removewordselect(id) {
    $("#S" + id).remove();
    $("#" + id).removeClass('selected');
}
function editText(val) {

    $('.addTitle').attr('index', val);


    if (val == 'exercise_title') {
        $(".checkbox-container").hide();
        $("#wrong_chr").hide();
        if( $('#exercise_title').attr('images')!=""&&$('#exercise_title').attr('images')!=undefined) {
            $("#iconimages").attr('src',config.rootPath + 'all/images/' + $('#exercise_title').attr('images') + '.png?v='+GenrateID());
            $('#uploadImage').attr('filename',$('#exercise_title').attr('images'));
        }else{

            $('#uploadImage').attr('filename','');
            $("#iconimages").attr("src", "");
        }
        if( $('#exercise_title').attr('sound')!=""&&$('#exercise_title').attr('sound')!=undefined) {
            $("#audioPreview").attr('src',config.rootPath + 'all/sound/' + $('#exercise_title').attr('sound') + '.mp3?v='+GenrateID());

        }else{
            $("#audioPreview").attr("src", "");
        }
    }else{
        $("#wrong_chr").show();
        $(".checkbox-container").show();
        if( $('#question_'+val).attr('images')!=""&&$('#question_'+val).attr('images')!=undefined) {
            $("#iconimages").attr('src',config.rootPath + 'all/images/' + $('#question_'+val).attr('images') + '.png?v='+GenrateID());
            $('#uploadImage').attr('filename',$('#question_'+val).attr('id'));
        }else{
            $('#uploadImage').attr('filename','');
            $("#iconimages").attr("src", "");
        }
        if( $('#question_'+val).attr('sound')!=""&&$('#question_'+val).attr('sound')!=undefined) {
            $("#audioPreview").attr('src',config.rootPath + 'all/sound/' + $('#question_'+val).attr('id').split('question_').join('') + '.mp3?v='+GenrateID());
        }else{
            $("#audioPreview").attr("src", "");
        }

        if( $('#question_'+val).attr('wrong')!=""&&$('#question_'+val).attr('wrong')!=undefined&&$('#question_'+val).attr('wrong')!='undefined') {
            $("#wrong_chr").val($('#question_'+val).attr('wrong'))
        }else{
            $("#wrong_chr").val("")
        }
    }


    if (val == 'exercise_title') {
        $("#titleText").val($("#exercise_title").attr('title_'));
    } else {
        $("#titleText").val($("#question_" + val).attr('title_'));
    }

    $("#spaces").prop('checked',true);
    if($("#question_" + val).attr('space')=="false"){
        $("#spaces").prop('checked',false);
    }
    $('.addTitle').show();

}
function removeimage(){
    ajaxPHP($("#iconimages").attr("src").split("?")[0], "", "removeFile", "", "remove", "");
    $("#iconimages").attr("src","");
}
function removesound(){
    ajaxPHP($("#audioPreview").attr("src").split("?")[0], "", "removeFile", "", "remove", "");
    $("#audioPreview").attr("src","");
}
function DeleteQuestion(val) {


    ajaxPHP("../games/" + config.rootPath + "/all/images/" + $("#question_" + val).attr('images')+".png", "", "removeFile", "", "remove", "");
    ajaxPHP("../games/" + config.rootPath + "/all/sound/" + $("#question_" + val).attr('sound')+".mp3", "", "removeFile", "", "remove", "");
    $("#question_" + val).remove();
    $("#addquestionicon").remove();
    // if ($("#gameContent").children().length == 1) {
    //  $("#question_0").prepend('<i class="add-question  floating-right" id="addquestionicon"  onclick="$(this).remove();addquestion(this);"></i>');
    // } else {
    $("#" + $($("#gameContent").children().last()).attr('id')).prepend('<i class="add-question  floating-right" id="addquestionicon" onclick="$(this).remove();addquestion();"></i>');
    // }
    renumberquestion()
}
function renumberquestion() {
    for (var i = 0; i < $("#gameContent").children().length; i++) {
        if ($($($("#gameContent").children()[i]).children()[0]).hasClass('qustion-number')) {
            $($($("#gameContent").children()[i]).children()[0]).html('-' + (i + 1))
        } else {
            $($($("#gameContent").children()[i]).children()[1]).html('-' + (i + 1))
        }
    }
}
function GenrateID() {
    var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
    var uniqid = randLetter + Date.now();
    return uniqid;
}
function drowdata() {

    // game=$.parseJSON(game);

    if (game != '') {
        $("#exercise_title").attr("title_", game.title.q);
        $("#exercise_title").attr("sound", game.title.sound);
        $("#exercise_title").attr("images", game.title.image_title);
        $("#exercise_title").html(game.title.q);

        for (var i = 0; i < game.question.length; i++) {

            if(i==0){
                addquestiondata(game.question[i],true);
            }else{
                addquestiondata(game.question[i]);
            }

        }
    } else {
        addquestiondata({qtitle: 'ادخل النص', q: 'ادخل النص', a: '', sound: '',images:'',spaces:"false"}, true)
    }
    $("#" + $($("#gameContent").children().last()).attr('id')).prepend('<i class="add-question  floating-right" id="addquestionicon" onclick="$(this).remove();addquestion();"></i>');
}
function  savedata() {

    var title=$("#exercise_title").attr("title_");
    var sound_title=$("#exercise_title").attr("sound");
    var image_title=$("#exercise_title").attr("images");
    if(sound_title==undefined){
        sound_title="";
    }
    var Allquestion=[];
    var data="";

    for(var i=0;i<$("#gameContent").children().length;i++){

        var Qtitle=$($($("#gameContent").children()[i])).attr("title_").split("'").join("").split('"').join("");
        var Qwrong=$($($("#gameContent").children()[i])).attr("wrong");
        if(Qwrong=='undefined'||Qwrong==undefined){
            Qwrong='';
        }
        var Qsound=$($($("#gameContent").children()[i])).attr("sound");
        var Qimages=$($($("#gameContent").children()[i])).attr("images");
        var Qspace=$($($("#gameContent").children()[i])).attr("space");
        var id=$($($("#gameContent").children()[i])).attr("id").split('question_').join('');
        var idv=$($($("#gameContent").children()[i])).attr("id").split('question_').join('');
        var Qtitle2=Qtitle;





       Qtitle2=Qtitle2.split(" ,").join(" <$>");
        Qtitle2=Qtitle2.split(", ").join("<$> ");
        Qtitle2=Qtitle2.split(" , ").join(" <$> ");
        Qtitle2=Qtitle2.split(",").join(" <$> ");

        var Qtitle_arry=Qtitle.split(" ");
        if(i==9) {
            var new_ = '';
            for (var j = 0; j < Qtitle_arry.length; j++) {
                if (Qtitle_arry[j] != '') {
                    console.log(Qtitle_arry[j])
                    new_ += Qtitle_arry[j];
                }

            }

            Qtitle_arry = new_;
            var Qtitle_arry = Qtitle_arry.split(" ");
        }
        var Word_array=[];
        kkk=[]
        for(var j=0;j<$("#selected-word_"+id).children().length;j++){
            var word=($($("#selected-word_"+id).children()[j]).html());
            var pp=$($("#selected-word_"+id).children()[j]).attr("id").split("_")[2]
            kkk.push(pp)
            var endWord_array=[];

            Word_array[j]=word;
       }
        Qtitle2=Qtitle2.trim();
        Qtitle2=Qtitle2.split('  ').join(' ');
        Qtitle2=Qtitle2.split(" ")
        for(var n=0;n<kkk.length;n++){
            Qtitle2[kkk[n]]= '..........'

            endWord_array[n]={w:Word_array[n],i:kkk[n]}
        }

        Qtitle2=Qtitle2.toString();

        Qtitle2=Qtitle2.split(',').join(' ');
        Qtitle2= Qtitle2.split("<$>").join(",");




        Allquestion.push({qtitle:Qtitle,q: Qtitle2,a:endWord_array,sound: Qsound,images:Qimages,space:Qspace,idv:idv,wrong:Qwrong.trim()});
    }




    game={title:{q:title, sound:sound_title,image_title:image_title},question:Allquestion};

    saveData()
}
function addquestiondata(data, flag) {

    val=data;

    var id = GenrateID();
    if(val.idv!=''&&val.idv!=undefined){
        id =val.idv;

    }
    var space=val.space;
    if(space==undefined||space==''){
        space=false;
    }
    var question = '<div id="question_' + id + '" idv="'+id+'" space="'+ space+'" title_="' + val.qtitle + '"  wrong="'+val.wrong+'" sound="' + val.sound + '" images="' + val.images + '" class="question-row floating-right">';
    question += '<span class="qustion-number floating-right">-' + ($("#gameContent").children().length + 1) + '</span>';
    question += '<div id="word_' + id + '" class="qustion-text floating-right"><span class="floating-right">' + val.qtitle + '</span></div>';

    if (!flag) {
        question += '<i class="delete-question floating-right" onclick="DeleteQuestion(' + String.fromCharCode('39') + id + String.fromCharCode('39') + ')"></i>';
    }
    question += '<i onclick="editText(' + String.fromCharCode('39') + id + String.fromCharCode('39') + ')" class="sound-question floating-right"></i>';
    question += '<div id="selected-word_' + id + '" class="selected-word-container"></div></div>';
    $("#gameContent").append(question);





    splitquestion(id,val.qtitle);

    if(val.a!=undefined){
        for (var i = 0; i < val.a.length   ; i++) {
            var idw = $($("#word_" + id).children()[val.a[i].i]).attr('id');
            $($("#word_" + id).children()[val.a[i].i]).addClass("selected");
            $("#selected-word_" + id).append('<span onclick="removewordselect(' + String.fromCharCode('39') + idw + String.fromCharCode('39') + ')" id="S' + idw + '" class="floating-right">' + val.a[i].w + '</span>')
        }
    }

}

$(document).ready(function () {
    drowdata();
    resizeGame()
});
function resizeGame() {
    var gameArea = document.getElementById('gameContent');
    var widthToHeight = 4 / 3;
    var newWidth = $(".gameContainer").width();
    var newHeight = $(".gameContainer").height();
    var newWidthToHeight = newWidth / newHeight;

    if (newWidthToHeight > widthToHeight) {
        newWidth = newHeight * widthToHeight;
        gameArea.style.height = newHeight + 'px';
        gameArea.style.width = newWidth + 'px';
    } else {
        newHeight = newWidth / widthToHeight;
        gameArea.style.width = newWidth + 'px';
        gameArea.style.height = newHeight + 'px';
    }
    //gameArea.style.marginTop = (-newHeight / 2) + 'px';
    //gameArea.style.marginLeft = (-newWidth / 2) + 'px';

    var gameCanvas = document.getElementById('gameContent');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';

    resizeGameCustome("body", ".gameContainer", (4 / 3), 1)
    resizeGameCustome(".gameContainer", ".gameContent", (4 / 3), 1.3)
    // reCalculatePoints()
}
function resizeGameCustome(container, inner, aspectRatio, cut) {

    gameArea = $(container)
    var widthToHeight = aspectRatio;
    var newWidth = gameArea.width();
    var newHeight = gameArea.height();
    var newWidthToHeight = newWidth / newHeight;
    if (newWidthToHeight > widthToHeight) {
        newWidth = newHeight * widthToHeight;
    } else {
        newHeight = newWidth / widthToHeight;

    }
    $('#gameContainer').css({'width': '100%', 'height': '100%'});
    var gameCanvas = $(inner)
    gameCanvas.css({
        width: newWidth / cut + "px",
        height: newHeight / cut + "px"
    })
}
function parseURLParams(url) {
    var queryStart = url.indexOf("?") + 1,
        queryEnd   = url.indexOf("#") + 1 || url.length + 1,
        query = url.slice(queryStart, queryEnd - 1),
        pairs = query.replace(/\+/g, " ").split("&"),
        parms = {}, i, n, v, nv;

    if (query === url || query === "") return;

    for (i = 0; i < pairs.length; i++) {
        nv = pairs[i].split("=", 2);
        n = decodeURIComponent(nv[0]);
        v = decodeURIComponent(nv[1]);

        if (!parms.hasOwnProperty(n)) parms[n] = [];
        parms[n].push(nv.length === 2 ? v : null);
    }
    return parms;
}