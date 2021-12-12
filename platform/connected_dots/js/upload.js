function ajaxPHP(url, data, type, name, objectType, dest) {
    if (typeof dest == "undefined") {
        dest = ""
    }
    loaderGif();
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
            setTimeout(removeLoader, 10)


            console.log(data)
            if (typeof data.error === 'undefined') {
                if (objectType == "uploadImageObject") {
                    idObject = randomString(6, "Aa")
                    pushToJsonArray("images/" + name, idObject, name)

                    pushNewObject(url, idObject, name, 0, 0, 10, 10, 1, 0)

                }
                if (objectType == "Library") {
                    idObject = randomString(6, "Aa")
                    pushToJsonArray("images/" + name, idObject, name)
                    pushNewObject(url, idObject, name, 0, 0, 10, 10, 1, 0)
                }

                if (objectType == "uploadBackground") {
	
	                $('.iconContainerTitle').find(".thumb").attr('src', config.rootPath + lang+"/images/bg.png?" + Math.random())
	                $('.iconContainerTitle').find("#bgImage").attr('value',config.rootPath +lang+ "/images/bg.png?"+ Math.random())
                    changeBackground(config.rootPath +lang+"/images/bg.png?"+Math.random())

                }
                
                if (objectType == "uploadBackgroundFull") {

                    $('.iconContainerTitle2').find(".thumb").attr('src', config.rootPath + lang+"/images/bg1.png?" + Math.random())
                    $('.iconContainerTitle2').find("#bgImage").attr('value',config.rootPath +lang+ "/images/bg1.png?"+ Math.random())
                    // changeBackground(config.rootPath +lang+"/images/bg.png?"+Math.random())

                }
                if (objectType == "uploadBackgroundSound") {

                    $('#audioPreview').attr('src', config.rootPath +lang+ "/sound/bg.mp3")
                    $('#ObjectSound').attr('value', config.rootPath +lang+ "/sound/bg.mp3")
                }
                if (objectType == "uploadIconTitle") {
                    $(".iconTitle").attr('src', config.rootPath +lang+"/images/titleIcon.png?"+Math.random())


                }

                if (objectType == "uploadsoundWin") {

                    $('#audioPreviewWin').attr('src', config.rootPath +lang+ "/sound/WinSound.mp3")
                    $('#SoundWinVal').attr('value', config.rootPath +lang+ "/sound/WinSound.mp3")
                }
                if (objectType == "uploadsoundObject") {
                    game.objects[ActiveElement.index].sound = "sound/" + name

                    if ($('#audioPreview').length) {
                        $('#audioPreview').attr('src',  config.rootPath +lang+ "/sound/" + name)
                        $('#ObjectSound').attr('value', config.rootPath +lang+ "/sound/" + name)
                    }
                }
                if (objectType == "remove") {
                    $('#' + ActiveElement.id).remove();
                    game.objects[ActiveElement.index] = []

                }
                if (objectType == "saveJson") {


                    if (saveType == "preview") {

                        readyToPreview()
                    }
                    else {

                        setdatafunction(
                            {
                                TypeProcesses: 'updateGames',
                                id: config.GameID,
                                data: JSON.stringify(game)


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

function getImageLocal(input, id, fileName) {

    objectType = $(input).attr('UploadType')


    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            dataFile = e.target.result;
            value = input.files[0].name;
            randomeName = randomString(5, 'aA')
            if (objectType == "uploadImageObject") {

                type = "local"
                ajaxPHP( config.rootPath +lang+ "/images/", dataFile, "image", randomeName + ".png", objectType)


            }
            if (objectType == "uploadBackground") {

                type = ""
                ajaxPHP( config.rootPath + lang+"/images/", dataFile, "image", "bg.png", objectType)


            }
            if (objectType == "uploadBackgroundFull") {

                type = ""
                ajaxPHP( config.rootPath + lang+"/images/", dataFile, "image", "bg1.png", objectType)


            }

            if (objectType == "uploadsoundWin") {

                type = ""
                ajaxPHP( config.rootPath + lang+"/sound/", dataFile, "image", "win.mp3", objectType)


            }
            if (objectType == "uploadIconTitle") {
                type = ""
                ajaxPHP(config.rootPath +lang+ "/images/", dataFile, "image", "titleIcon.png", objectType)


            }

            if (objectType == "uploadsoundObject") {
                type = ""
                ajaxPHP(config.rootPath +lang+ "/sound/", dataFile, "sound", randomeName + ".mp3", objectType)


            }

            if (objectType == "BackgroundSound") {
                type = ""
                ajaxPHP( config.rootPath +lang+ "/sound/", dataFile, "sound", "bg.mp3", objectType)


            }


        };
        reader.readAsDataURL(input.files[0]);
    }

}

function removeFile(object) {
    event.stopPropagation();
if(ActiveElement.index=="" || typeof  ActiveElement.index=="undefined"){
	Lobibox.notify("error", {
		msg: 'select point to remove.'
	});
    return
}
    index = ActiveElement.index

    if (index > -1) {
        game.objects.splice(index, 1);
        DrawObjects()
        $(".gameContent").click()
    }
	
	Lobibox.notify("success", {
		msg: 'Remove point done'
	});
    // name = $(object).attr('name')
    //alert("../games/gamesUser/" + IdUser + "/"+name)
    // ajaxPHP("../games/" + config.rootPath + "/images/" + name, "", "removeFile", "", "remove", "")
}


function loaderGif() {
    if ($('.loaderGif').length)$('.loaderGif').remove()

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
    if ($('.loaderGif').length)$('.loaderGif').remove()
}


function simulateUpload(target) {

    target.click()

}

function saveData() {
    saveType = "save"
    ajaxPHP(config.rootPath + "/all/js/", "", "JsonFile", "game.js", "saveJson", "");

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


