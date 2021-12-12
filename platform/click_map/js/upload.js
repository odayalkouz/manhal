function ajaxPHP(url, data, type, name, objectType, dest, compress) {
    if (typeof dest == "undefined") {
        dest = ""
    }
    loaderGif()
    $.ajax({
        url: '../ajax/uploadLabaling.php',
        type: 'POST',
        data: {
            FileData: JSON.stringify(data),
            urlUpload: url,
            Type: type,
            FileName: name,
            dest: dest,
            game: "[" + JSON.stringify(game) + "]",
            saveImageType: compress
        },
        cache: false,


        success: function (data, textStatus, jqXHR) {
            setTimeout(removeLoader, 10)


            console.log(data)
            if (typeof data.error === 'undefined') {


                if (objectType == "BackgroundSound") {

                }
                if (objectType == "uploadImageObject") {

                    idObject = randomString(6, "Aa")
                    indexAdded = pushToJsonArray("images/" + name, idObject, name)

                    pushNewObject(url, idObject, name, 0, 0, 10, 10, 1, 0, 0, 0, indexAdded, 0)

                }

                if (objectType == "localGroup") {
                    console.log(name)
                    index = ActiveElement.index
                    idEl = name.split(".")[0]
                    game.objects[index].srcGroup.push({image: name, sound: ""})

                    saveData()


                }

                if (objectType == "uploadsoundObjectImage") {


                    nameImage = name.split(".")[0]

                    var index = -1
                    game.objects[ActiveElement.index].srcGroup.some(function (elem, i) {
                        if (elem.image.split(".")[0] == nameImage) {
                            index = i
                            game.objects[ActiveElement.index].srcGroup[index].sound = nameImage + ".mp3"
                        }


                    });


                }

                if (objectType == "Library") {
                    idObject = randomString(6, "Aa")
                    indexAdded = pushToJsonArray("images/" + name, idObject, name)
                    pushNewObject(url, idObject, name, 0, 0, 10, 10, 1, 0, 0, 0, indexAdded, 0)

                }

                if (objectType == "uploadBackground") {

                    $('.thumb').attr('src', config.rootPath + "/all" + "/images/"+game.backgroundImage+"?" + Math.random())
                    $('#bgImage').attr('value', config.rootPath + "/all" + "/images/"+game.backgroundImage)
                   // game.backgroundImage="images/bg.jpg"
                    changeBackground(config.rootPath + "/all" + "/images/"+game.backgroundImage+"?" + Math.random())
                    saveData()


                }


                if (objectType == "uploadBackgroundSound") {

                    $('#audioPreview').attr('src', config.rootPath + "/all" + "/sound/bg.mp3")
                    $('#ObjectSound').attr('value', config.rootPath + "/all" + "/sound/bg.mp3")
                }

                if (objectType == "uploadsoundObject") {
                    game.objects[ActiveElement.index].sound = "sound/" + name

                    if ($('#audioPreview').length) {
                        $('#audioPreview').attr('src', config.rootPath + "/all" + "/sound/" + name)
                        $('#ObjectSound').attr('value', config.rootPath + "/all" + "/sound/" + name)
                    }

                    saveData()
                    showProprties()
                }
                if (objectType == "uploadIconTitle") {
                    $(".iconTitle").attr('src', config.rootPath + "/all" + "/images/titleIcon.png?" + Math.random())


                }

                if (objectType == "remove") {
                    if (game.typeEdit == "matching" || game.typeEdit=="memory") {

                        game.objects[ActiveElement.index].srcGroup.some(function (elem, i) {

                            ajaxPHP(config.rootPath + "all/sound/" + elem.image.split(".")[0] + ".mp3", "", "removeFileImage", "", "removeFileImage", "")

                        });
                        refeshCanvas()
                    }


                    $('#' + ActiveElement.id).remove();
                    game.objects[ActiveElement.index] = ["removed"]
                    saveData()

                }


                if (objectType == "removeFile") {

                    applyRemoveFile()
                }

                if (data == "removeFileDone") {


                    nameImage = name.split(".")[0]

                    var index = -1
                    if (game.objects[ActiveElement.index].srcGroup == undefined || game.objects[ActiveElement.index].srcGroup == "" || typeof game.objects[ActiveElement.index].srcGroup == "undefined") {
                        return
                    }
                    game.objects[ActiveElement.index].srcGroup.some(function (elem, i) {
                        console.log("is " + elem.image.split(".")[0] + " == " + nameImage)
                        if (elem.image.split(".")[0] == nameImage) {

                            index = i
                            game.objects[ActiveElement.index].srcGroup.splice(index, 1);

                            saveData()

                            refeshCanvas()
                            ajaxPHP(config.rootPath + "all/sound/" + nameImage + ".mp3", "", "removeFileImageSound", "", "removeFileImageSound", "")


                        }


                    });


                }

                if (data == "removeSound") {

                    //   game.objects[ActiveElement.index] = ["removed"]


                    game.objects[ActiveElement.index].sound = ""


                    saveData()
                    refeshCanvas()
                    showProprties()
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
    uploadCustomeName = $(input).attr('soundName')


    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

            dataFile = e.target.result;
            value = input.files[0].name;
            ext = (value.split(".")[1])
            //  ext = input.files[0].filepa;

            randomeName = randomString(5, 'aA')


            if (objectType == "uploadImageObject") {

                type = "local"

                ajaxPHP(config.rootPath + "/all/images/", dataFile, "image", randomeName + "." + ext, objectType, "notcompress")


            }


            if (objectType == "uploadBackground") {

                type = ""


                canvasOFtemp = document.createElement('canvas');
                canvasOFtemp.width = 1024;
                canvasOFtemp.height = 768;


                var image = new Image();
                image.src = dataFile;
                image.onload = function () {
                    {
                        canvasOFtemp.width = image.width;
                        canvasOFtemp.height = image.height;
                        aspect = calculateAspectRatioFit(image.width, image.height, image.width, image.height)

                    }


                    var cxt = canvasOFtemp.getContext('2d');

                    var x = (canvasOFtemp.width - aspect.width) * 0.5,   // this = image loaded
                        y = (canvasOFtemp.height - aspect.height) * 0.5;

                    cxt.drawImage(image, x, y, aspect.width, aspect.height);

                    ajaxPHP(config.rootPath + "/all" + "/images/", dataFile, "image", "bg." + ext, objectType, 0, "notcompress")


                    game.backgroundImage= "images/bg."+ext
                   // ajaxPHP(config.rootPath + "/all" + "/images/", dataFile, "image", "bg.png", objectType, 0, "notcompress")


                };


            }

            if (objectType == "uploadsoundObject") {
                type = ""
                ajaxPHP(config.rootPath + "/all" + "/sound/", dataFile, "sound", randomeName + ".mp3", objectType)


            }
            if (objectType == "uploadsoundObjectImage") {
                type = ""


                ajaxPHP(config.rootPath + "/all" + "/sound/", dataFile, "sound", uploadCustomeName + ".mp3", objectType)


            }
            if (objectType == "uploadIconTitle") {
                type = ""
                ajaxPHP(config.rootPath + "/all" + "/images/", dataFile, "image", "titleIcon." + ext, objectType)


            }

            if (objectType == "BackgroundSound") {
                type = ""
                ajaxPHP(config.rootPath + "/all" + "/sound/", dataFile, "sound", "bg.mp3", objectType)


            }

            $(input).val("")
        };
        reader.readAsDataURL(input.files[0]);
    }


}

function removeFile(object) {
    // prevent click on tow elemnt at same time
    event.stopPropagation()

    //fetch information from active object
    name = $("#" + ActiveElement.id).attr('name')
    currentSrc = ActiveElement.src
    currentIndex = ActiveElement.index


    // remove element from group
    if (game.group.length > 0) {

        for (var i = 0; i < game.group.length; i++) {

            for (var j = 0; j < game.group[i].length; j++) {

                if (ActiveElement.id == game.group[i][j]) {

                    game.group[i].splice(j, 1)
                    drawElementInGroupBox()
                }

            }

        }
    }

// apply remove from group
    if (game.typeEdit == "matching" || game.typeEdit=="memory") {
        deconnectLine(ActiveElement.id)
        drawLineFromColumnToElement()
        drawConnected()
    }


    //check if any elment clone from this object to keep image life
    for (var i = 0; i < game.objects.length; i++) {

        // check if same elment and jump to loop again
        if (currentIndex == i) {
            continue
        }

        else if (currentSrc == game.objects[i].src) {

            // remove any related elment or option to object without remove image
            applyRemoveFile()
            return
        }


    }


    ajaxPHP(config.rootPath + "all/images/" + name, "", "removeFile", "", "remove", "")


}


function applyRemoveFile() {

    // remove any related object like sound and images

    if (game.typeEdit == "matching" || game.typeEdit=="memory") {

        game.objects[ActiveElement.index].srcGroup.some(function (elem, i) {

            ajaxPHP(config.rootPath + "all/sound/" + elem.image.split(".")[0] + ".mp3", "", "removeFileImage", "", "removeFileImage", "")
            ajaxPHP(config.rootPath + "all/sound/" + nameImage + ".mp3", "", "removeFileImageSound", "", "removeFileImageSound", "")

        });

    }

// remove elment from game array
    $('#' + ActiveElement.id).remove();
    game.objects[ActiveElement.index] = ["removed"]

    // save game data to server
    saveData()

    // redraw matching and canvas information
    refeshCanvas()
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
        "background-repeat: no-repeat;" +
        "z-index: 9999999999999999'></div>"
    $(str).appendTo(document.body)
}

function removeLoader() {
    if ($('.loaderGif').length) $('.loaderGif').remove()
}


function simulateUpload(target) {
    calledGroup = false
    target.click()

}

function saveData() {
    saveType = "save"
    ajaxPHP(config.rootPath + "/all/js/", "", "JsonFile", "game.js", "saveJson", "");


}

function showSettingPopup() {

}

function saveMessage() {
    str = '<div class="message-mine-container">' +
        '<div class="message-inner-container">' +
        '<div class="header">' +
        '<label>'+langRes.Save+'</label>' +
        '</div>' +
        '<div class="message-body">' +
        '<div class="message-icon floating-left"></div>' +
        '<label class="message-lbl floating-left">'+langRes.Savedsuccessfully+'</label>' +
        '</div>' +
        '</div>' +
        '</div>'
    $(str).appendTo('body')

    setTimeout(function () {
        removeMsg()
    }, 500)
}


function uploadMultipleImages(object) {
    text =
        str = '<div class="message-mine-container">' +
            '<div class="message-inner-container message-inner-containerUpload" style="height:529px">' +
            '<div class="header">' +
            '<a target="' + object.id + '" id="" class="closePng" value="remove"><i></i></a>' +
            '<div class="message-icon floating-left"></div>' +
            '<label>Upload multiple images</label>' +
            '</div>' +
            '<div class="message-body">' +
            '<label for="files">Select multiple files: </label>\n' +
            '<input target="' + object.id + '" id="filesMul' + object.id + '" type="file" name="multiple" multiple/>\n' +
            '<output id="result" />' +
            '</div>' +
            '<div class="footerProprties">' +
            '<a target="' + object.id + '" id="upload_' + object.id + '" class="ok-btn ok-btn-multi floating-right" >' +
            '<i>' +
            '</i>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div>'
    $(str).appendTo('body')

    $(".closePng").click(function () {

        $(".message-mine-container").remove()
    })
    var fileArray
    //Check File API support
    if (window.File && window.FileList && window.FileReader) {
        var filesInput = document.getElementById("filesMul" + object.id);

        filesInput.addEventListener("change", function (event) {

            var files = event.target.files; //FileList object
            fileArray = Array.from(files);
            var output = document.getElementById("result");

            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                //Only pics
                if (!file.type.match('image'))
                    continue;

                var picReader = new FileReader();

                picReader.addEventListener("load", function (event) {

                    var picFile = event.target;

                    var div = document.createElement("div");

                    div.innerHTML = "" +
                        // "<button  onclick='' index='"+i+"' class='center btn-transparent RemoveThumb'>X</button>" +
                        "" +
                        "<img class='thumbnail' src='" + picFile.result + "'" +
                        "title='" + picFile.name + "'/>";

                    // output.insertBefore(div,null);
                    $(output).append(div)


                });

                //Read the image
                picReader.readAsDataURL(file);
            }

            $(".RemoveThumb").click(function () {
                index = $(this).attr("index")

                fileArray.splice(index, 1);
            })


            $("#upload_" + object.id).click(function () {

                idTarget = $(this).attr("target")
                uploadMultiple(idTarget)
            })


        });
    }
    else {
        console.log("Your browser does not support File API");
    }


}


function uploadMultiple(id) {

    var formData
    formData = []
    var input = document.getElementById('filesMul' + id);


    console.log("&# " + i)
    var files = input.files; //FileList object
    fileArray = Array.from(files);

    count = fileArray.length
    for (i = 0; i < count; i++) {
        console.log("# " + i)
        var file = files[i];
        //Only pics


        var picReader = new FileReader();

        picReader.addEventListener("load", function (event) {

            var picFileData = event.target.result;
            value = file.name;
            ext = (value.split(".")[1])
            //  alert(ext)
            UploadobjectGroup(picFileData, ext)
        });

        //Read the image
        picReader.readAsDataURL(file);

    }


}


function UploadobjectGroup(dataFile, ext) {


    type = "localGroup"

    randomeName = randomString(5, 'aA')
    ajaxPHP(config.rootPath + "/all" + "/images/", dataFile, "image", randomeName + "." + ext, type)
}


function viewMultipleImages() {


    if (ActiveElement.id == undefined) {
        return
    }

    text =

        str = '<div class="message-mine-container">' +
            '<div class="message-inner-container message-inner-containerUpload" style="height:529px">' +
            '<div class="header">' +
            '<a target="' + ActiveElement.id + '" id="" class="closePng" value="remove"><i></i></a>' +

            '<div class="message-icon floating-left"></div>' +
            '<label>Upload multiple images</label>' +
            '</div>' +
            '<div class="message-body result">' +


            '</div>' +
            '<div class="footerProprties">' +

            '<i>' +
            '</i>' +
            '</a>' +
            '</div>' +
            '</div>' +
            '</div>'


    $(str).appendTo('body')

    $(".closePng").click(function () {

        $(".message-mine-container").remove()
    })


    str = ""
    count = ActiveElement.srcGroup.length
    for (i = 0; i < count; i++) {

        src = config.rootPath + "/all/images/" + ActiveElement.srcGroup[i].image
        var div = document.createElement("div");
        spliteid = ActiveElement.srcGroup[i].image.split(".")[0]
        div.id = "view_" + spliteid

        var imageData = ActiveElement.srcGroup[i].image


        soundsrc = config.rootPath + "all/sound/" + spliteid + ".mp3"


        div.innerHTML = "" +
            "<div>" +
            "<button id='' file='" + imageData + "' onclick='' index='" + i + "' class='remove" + ActiveElement.id + " btn-transparent center '>X</button>" +

            "<button id='upload_' file='" + imageData + "' targetInput='" + spliteid + "' onclick='' index='" + i + "' class='upload" + ActiveElement.id + " btn-transparent center '>↑</button>" +

            '<input style="display:none" soundName="' + spliteid + '"  id="filesMul_' + spliteid + '" type="file" name=""  id="uploadsoundObjectImage" UploadType="uploadsoundObjectImage"onchange="UploadType=\'uploadsoundObjectImage\';getImageLocal(this)" name="upload" accept="audio/*"/>' +
            '</div>' +
            "<img  file='" + imageData + "' class='thumbnail' src='" + src + "'>" +

            "" +
            "" +

            '<audio id="Audio_' + spliteid + '" preload="auto" controls>' +
            '<source src="' + soundsrc + '">' +
            '</audio>'


        $(".message-body").append(div)


    }

    $(".remove" + ActiveElement.id).click(function () {

        fileName = $(this).attr("file")

        removeFileImage(fileName)


        $(this).parent().remove()

    })


    $(".upload" + ActiveElement.id).click(function () {

        fileName = $(this).attr("file")
        targetInput = $(this).attr("targetInput")


        simulateUpload(document.getElementById("filesMul_" + targetInput))

    })


}

function removeFileImage(fileName) {
    event.stopPropagation()

    ajaxPHP(config.rootPath + "all/images/" + fileName, "", "removeFileImage", fileName, "removeFileImage", "")


    refeshCanvas()
}


function removeSound() {
    event.stopPropagation()

    fileName = ActiveElement.sound
    ajaxPHP(config.rootPath + "all/" + fileName, "", "removeSound", "", "removeSound", "")

    refeshCanvas()
}


function removebackground() {

    game.backgroundImage = ""

    $(".gameContent").css(
        {
            'background': 'url(' + "" + ')100% 100% no-repeat ,url(' + "" + ')100% 100% no-repeat',
            'background-size': '100% 100%',
            'background-repeat': 'no-repeat'


        })

    removeFileImage("bg.png")
    removeFileImage("bg.jpg")
    removeFileImage("bg.svg")


}



