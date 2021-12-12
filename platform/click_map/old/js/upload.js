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
            setTimeout(removeLoader, 10)


            console.log(data)
            if (typeof data.error === 'undefined') {
                if (objectType == "uploadImageObject") {
                    idObject = randomString(6, "Aa")
                    pushToJsonArray("images/" + name, idObject, name)

                    pushNewObject(url, idObject, name, 0, 0,10,10,1,0)

                }
                if (objectType == "Library") {
                    idObject = randomString(6, "Aa")
                    pushToJsonArray("images/" + name, idObject, name)
                    pushNewObject(url, idObject, name, 0, 0,10,10,1,0)
                }

                if (objectType == "uploadBackground") {
                    $('.thumb').attr('src', config.rootPath + "images/bg.png?" + Math.random())
                    $('#bgImage').attr('value', config.rootPath + "images/bg.png")
                    changeBackground(config.rootPath + "images/bg.png?"+Math.random())

                }
                if (objectType == "uploadBackgroundSound") {

                    $('#audioPreview').attr('src', config.rootPath + "sound/bg.mp3")
                    $('#ObjectSound').attr('value',config.rootPath + "sound/bg.mp3")
                }
                if (objectType == "uploadsoundObject") {
                    game.objects[ActiveElement.index].sound = "sound/" + name

                    if ($('#audioPreview').length) {
                        $('#audioPreview').attr('src', config.rootPath + "sound/" + name)
                        $('#ObjectSound').attr('value',config.rootPath + "sound/" + name)
                    }
                }
                if (objectType == "uploadIconTitle") {
                    $(".iconTitle").attr('src', config.rootPath + "images/titleIcon.png?"+Math.random())


                }
                if (objectType == "remove") {
                    $('#' + ActiveElement.id).remove();
                    game.objects[ActiveElement.index] = ["removed"]
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
                alert(config.rootPath + "images/")
                ajaxPHP( config.rootPath + "images/", dataFile, "image", randomeName + ".png", objectType)


            }
            if (objectType == "uploadBackground") {

                type = ""


                canvasOFtemp = document.createElement('canvas');
                canvasOFtemp.width = 1024;
                canvasOFtemp.height = 768;


                var image = new Image();
                image.src = dataFile;
                image.onload = function () {
                    aspect = calculateAspectRatioFit(image.width, image.height, 1024, 768)

                    var cxt = canvasOFtemp.getContext('2d');

                    var x = (canvasOFtemp.width - aspect.width) * 0.5,   // this = image loaded
                        y = (canvasOFtemp.height - aspect.height) * 0.5;

                    cxt.drawImage(image, x, y, aspect.width, aspect.height);

                    ajaxPHP(config.rootPath + "/images/", canvasOFtemp.toDataURL(), "image", "bg.png", objectType)

                };



            }

            if (objectType == "uploadsoundObject") {
                type = ""
                ajaxPHP(config.rootPath + "sound/", dataFile, "sound", randomeName + ".mp3", objectType)


            }
            if (objectType == "uploadIconTitle") {
                type = ""
                ajaxPHP(config.rootPath + "images/", dataFile, "image", "titleIcon.png", objectType)


            }

            if (objectType == "BackgroundSound") {
                type = ""
                ajaxPHP(config.rootPath + "sound/", dataFile, "sound", "bg.mp3", objectType)


            }


        };
        reader.readAsDataURL(input.files[0]);
    }

}

function removeFile(object) {
    event.stopPropagation()
    name = $(object).attr('name')
    ajaxPHP(config.rootPath + "images/" + name, "", "removeFile", "", "remove", "")
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
    ajaxPHP(config.rootPath + "/js/", "", "JsonFile", "game.js", "saveJson", "");


}

function showSettingPopup(){

}

function saveMessage() {
    str ='<div class="message-mine-container">' +
        '<div class="message-inner-container">' +
        '<div class="header">' +
        '<a onclick="removeMsg()" class="CloseButtonMSg"><i></i></a>' +
        '<label>Save</label>' +
        '</div>' +
        '<div class="message-body">' +
        '<div class="message-icon floating-left"></div>' +
        '<label class="message-lbl floating-left">Saving successfully completed.</label>' +
        '</div>' +
        '</div>' +
        '</div>'
    $(str).appendTo('body')
}



