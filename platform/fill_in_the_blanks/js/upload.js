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
            console.log("---",data)
            setTimeout(removeLoader, 10)



            if (typeof data.error === 'undefined') {
                if (objectType == "uploadImageObject") {
                    idObject = randomString(6, "Aa")
                    pushToJsonArray("images/" + name, idObject, name)

                    pushNewObject(url, idObject, name, 0, 0, 10, 10, 1, 0)

                }

                if (objectType == "sound") {
                    $("#audioPreview").attr('src',config.rootPath + 'all/sound/' + name + '?v='+GenrateID());

                }
                if (objectType == "remove") {
                    $('#' + ActiveElement.id).remove();
                    game.objects[ActiveElement.index] = []

                }
                if (objectType == "images") {
                    if(name=='exercise_title'){

                    }else{

                    }
                      $('#iconimages').attr("src", config.rootPath + "all/images/" +  name + "?v=" + GenrateID());

                }
                if (objectType == "thumb") {
                    $('#level-thumb' + game.levelIndex).attr("src", config.rootPath + "/images/" + "thumb_" + game.levelIndex + ".png?" + Math.random());
                }
                if (objectType == "saveJson") {


                    if (saveType == "preview") {

                        readyToPreviewNew()
                    }
                    else {

                        setdatafunction(
                            {
                                TypeProcesses: 'updateGames',
                                id: config.GameID,
                                data:  JSON.stringify(game)


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
var canvasOFtemp

function getImageLocal(input, id,fileName) {

    objectType = $(input).attr('UploadType');
    filename=$('.addTitle').attr('index');

            if(objectType=='sound'){
                    if(filename=='exercise_title'){
                        if($('#exercise_title').attr('sound')!='undefined'&&$('#exercise_title').attr('sound')!=""){
                            filename='exercise_title';
                            $("#audioPreview").attr("src",config.rootPath + "all/sound/"+filename+".mp3?v="+GenrateID());
                        }
                    }else{
                        if($('#question_'+filename).attr('sound')!='undefined'&&$('#question_'+filename).attr('sound')!=""){
                            filename=$('#question_'+filename).attr('sound');
                            $("#audioPreview").attr("src",config.rootPath + "all/sound/"+filename+".mp3?v="+GenrateID());
                        }
                    }

            }
        if(objectType=='images'){
            if(filename=='exercise_title'){
                if($('#exercise_title').attr('images')!='undefined'&&$('#exercise_title').attr('images')!=""){
                    filename='exercise_title';
                    $("#iconimages").attr("src",config.rootPath + "all/images/"+filename+".png");

                }
            }else{
                if($('#question_'+filename).attr('images')!='undefined'&&$('#question_'+filename).attr('images')!=""){
                    filename=$('#question_'+filename).attr('images');
                    $("#iconimages").attr("src",config.rootPath + "all/images/"+filename+".png");

                }
            }

        }

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            if(filename=='exercise_title'){
                if(objectType=='sound') {
                    $("#exercise_title").attr("sound", 'exercise_title');
                }else if(objectType=='images'){
                    $("#exercise_title").attr("images", 'exercise_title');
                }
            }else{
                if(objectType=='sound') {
                    $("#question_" + $('.addTitle').attr('index')).attr("sound", $('.addTitle').attr('index'));
                }else if(objectType=='images'){
                    $("#question_" + $('.addTitle').attr('index')).attr("images", $('.addTitle').attr('index'));
                }
            }

            dataFile = e.target.result;
            value = input.files[0].name;
             type = ""
            if(objectType=='sound') {
                ajaxPHP(config.rootPath + "all/sound/", dataFile, "sound", filename + ".mp3", objectType);
            }else if(objectType=='images'){

                ajaxPHP(config.rootPath + "all/images/",dataFile,"image",filename + ".png", objectType);
            }
            $(input).val("");

        };
        reader.readAsDataURL(input.files[0]);
    }

}

function removeFile(object) {
    event.stopPropagation();

    index = ActiveElement.index

    if (index > -1) {
        game.objects.splice(index, 1);
        DrawObjects()
        $(".gameContent").click()
    }
    // name = $(object).attr('name')
    //alert("../games/gamesUser/" + IdUser + "/"+name)
    // ajaxPHP("../games/" + config.rootPath + "/images/" + name, "", "removeFile", "", "remove", "")
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

function saveData() {

    console.log("rootPath", config.rootPath);
    saveType = "save"

    ajaxPHP(config.rootPath + "all/js/",game, "JsonFile", "game.js", "saveJson", "");
}

function saveMessage() {
    str ='<div class="message-mine-container">' +
        '<div class="message-inner-container">' +
        '<div class="header">' +
        '<label>Save</label>' +
        '</div>' +
        '<div class="message-body">' +
        '<div class="message-icon floating-left"></div>' +
        '<label class="message-lbl floating-left">Successfully saved.</label>' +
        '</div>' +
        '</div>' +
        '</div>'
    $(str).appendTo('body')

    setTimeout(function(){
        removeMsg()
    },1000)
}






