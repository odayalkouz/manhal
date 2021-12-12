//vibrate plugin
// navigator.vibrate(100);


urlTst = "http://162.144.51.202/~story/althakaalmot3dd/"

function downloadFileFromTo(UrlToDownload, folderNameCreator,indexData) {

    $("#story-card-close").click()


//DOWNLOAD fILE  METHOD1
    // var folderNameCreator = 'zipFileTest';
    var fileName;
    var DirUrl = ""
    var fileUrl = ""

    function downloadFile(URL) {


        if (navigator.network.connection.type == Connection.NONE) {
            //alert("لا يوجد اتصال بالانترنت");
            $(document.body).msgBox({
                type:'download',
                msgText1: "لا يوجد اتصال ",
                msgText2: "بالانترنت",
                imgSrc: "images/error.svg"
            })
            $('#messageContainer img').css({"top":"-2%","height":"51%",width:"30%",right:"0%"});
            $("#messageData").css("top","25%");
            setTimeout(function () {
                $("#messageContainer").hide()
            },3000)
        } else {
            // alert(navigator.network.connection.type);
        }
        //step to request a file system
        window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, fileSystemSuccess, fileSystemFail);

        function fileSystemSuccess(fileSystem) {


            var download_link = encodeURI(URL);
            fileName = download_link.substr(download_link.lastIndexOf('/') + 1); //Get filename of URL
            var directoryEntry = fileSystem.root; // to get root path of directory

            directoryEntry.nativeURL = applicationPathRoot
            //alert(JSON.stringify(directoryEntry))
            directoryEntry.getDirectory(folderNameCreator, {
                create: true,
                exclusive: false
            }, onDirectorySuccess, onDirectoryFail); // creating folder in sdcard

//
            var rootdir = applicationPathRoot;
            var fp = applicationPathRoot; // Returns Fullpath of local directory
            var folderPath = applicationPathRoot + "/" + folderNameCreator;
            fp = fp + "/" + folderNameCreator + "/" + fileName; // fullpath and name of the file which we want to give
            // download function call

            filetransfer(download_link, fp, fileName, folderPath);
        }

        function onDirectorySuccess(parent) {

            DirUrl = applicationPathRoot +  folderNameCreator
        }

        function onDirectoryFail(error) {
            //Error while creating directory
            //  alert("Unable to create new directory: " + error.code);

        }

        function fileSystemFail(evt) {
            //Unable to access file system
            //  alert(evt.target.error.code);
        }
    }

    function filetransfer(download_link, fp, fileName, folderPath) {

        loaderCanvasVariable=indexData


        arrayStoryDesc[indexData-1].downloading=true
        $("#lockSt"+indexData).css({
            height:"100%"
        })
        objectContainer=$("#lockSt"+indexData).parent()
        objectContainer.attr("downloading","YES")
        $('<span id="loadertext'+indexData+'" class="loaderText" style="">جاري الاتصال</span>').appendTo(objectContainer)
        //$('#loaderCanvas'+indexData).ClassyLoader({
        //    percentage: 0,
        //    speed: 0,
        //    fontSize: '100px',
        //    diameter: 60,
        //    lineColor: 'green',
        //    remainingLineColor: 'rgba(226,188,128,.5)',
        //    lineWidth: 10,	fontColor: 'rgba(226,188,128,.5)',
        //    animate: false, // whether to animate the loader or not,
        //    showStatus:true,
        //    textStatus:"X"
        //
        //});



        var fileTransfer = new FileTransfer();
        // File download function with URL and local path
        $('.close-card').click()


        fileTransfer.indexCanvas=indexData


        obj= $('#lockSt' +fileTransfer.indexCanvas).find('.lock-container')
        obj.css({
            background:"url(../images/book.svg) no-repeat center",
            'background-size': '30%'
        })

        //$('#loaderCanvas'+fileTransfer.indexCanvas).click(function(){
        //    arrayStoryDesc[$(this).attr("indexattr")-1].downloading=false
        //    fileTransfer.abort();
        //    lockFunction();
        //    fileJsonWrite()
        //})


        fileTransfer.download(download_link, fp,
            function (entry) {


                ExtractZipFile(entry.fullPath, fileName, fp, folderPath,fileTransfer.indexCanvas)
            },
            function (error) {
                arrayStoryDesc[fileTransfer.indexCanvas-1].downloading=false

                // Download abort errors or download failed errors

                //$('#loaderCanvas'+fileTransfer.indexCanvas).ClassyLoader({destroy:true});
                console.log("upload error code" + error.code);
                if (error.code == 1) {
                    //alert("ملف التحميل غير موجود")
                    $(document.body).msgBox({
                        type:'download',
                        msgText1: "ملف التحميل",
                        msgText2: "غير موجود",
                        imgSrc: "images/noFile.svg"
                    })
                    $('#messageContainer img').css({"top":"-2%","height":"51%",width:"22%",right:"7%"});
                    $("#messageData").css("top","25%");
                    setTimeout(function () {
                        $("#messageContainer").hide()
                    },3000)
                }
                if (error.code == 2) {
                    //alert("خطأ برابط التحميل")
                    $(document.body).msgBox({
                        type:'download',
                        msgText1: "خطأ برابط",
                        msgText2: "التحميل",
                        imgSrc: "images/noFile.svg"
                    })
                    $('#messageContainer img').css({"top":"-2%","height":"51%",width:"22%",right:"7%"});
                    $("#messageData").css("top","25%");
                    setTimeout(function () {
                        $("#messageContainer").hide()
                    },3000)
                }
                if (error.code == 3) {
                   //alert("تم فقدان الاتصال بالانترنت يرجى معاودة التحميل مرة أخرى")
                    $(document.body).msgBox({
                        type:'download',
                        msgText1: "تم فقدان الاتصال بالانترنت",
                        msgText2: "يرجى معاودة التحميل مرة أخرى",
                        imgSrc: "images/error.svg"
                    })
                    $('#messageContainer img').css({"top":"-2%","height":"51%",width:"30%",right:"0%"});
                    $("#messageData").css("top","25%");
                    $(".lbl-data-message span").css("line-height","1em");
                    setTimeout(function () {
                        $("#messageContainer").hide()
                    },3000)
                }
                if (error.code == 4) {
                    //alert("تم ايقاف التحميل")
                    $(document.body).msgBox({
                        type:'download',
                        msgText1:"تم ايقاف ",
                        msgText2: "التحميل",
                        imgSrc: "images/noFile.svg"
                    })
                    $('#messageContainer img').css({"top":"-2%","height":"51%",width:"22%",right:"7%"});
                    $("#messageData").css("top","25%");
                    setTimeout(function () {
                        $("#messageContainer").hide()
                    },3000)
                }
                if (error.code == 5) {
                    //alert("NOT_MODIFIED_ERR")
                    $(document.body).msgBox({
                        type:'download',
                        msgText1:"NOT_MODIFIED_ERR",
                        msgText2: "",
                        imgSrc: "images/error.svg"
                    })
                    $('#messageContainer img').css({"top":"-2%","height":"51%",width:"30%",right:"0%"});
                    $("#messageData").css({"top":"39%","width":"74%","right":"16%"});
                    setTimeout(function () {
                        $("#messageContainer").hide()
                    },3000)
                }


                endDownload(indexData,"error")

            }
        );

        fileTransfer.onprogress = function (progressEvent) {

            if (progressEvent.lengthComputable) {
                var perc = Math.floor(progressEvent.loaded / progressEvent.total * 100);


                $("#lockSt"+indexData).css({
                    height:(100-perc)+"%"
                })

                $("#loadertext"+indexData).html((perc)+"%")
                //$('#loaderCanvas'+this.indexCanvas).ClassyLoader({
                //    percentage: perc,
                //    speed: 0,
                //    fontSize: '100px',
                //    fontSize: '100px',
                //    diameter: 60,
                //    lineColor: 'green',
                //    remainingLineColor: 'rgba(226,188,128,.5)',
                //    lineWidth: 10,	fontColor: 'rgba(226,188,128,.5)',
                //    animate: false, // whether to animate the loader or not,
                //    showStatus:true,
                //    textStatus:"X"
                //
                //});
                //product.set({
                //    progress: perc,
                //    state: store.DOWNLOADING
                //});
                //product.stateChanged();
            } else {
                //product.set("state", store.DOWNLOADING);

            }
        }


        //setTimeout(function(){
        //    fileTransfer.abort();
        //},2000)
    }


    //"http://www.colorado.edu/conflict/peace/download/peace_essay.ZIP"
    downloadFile(UrlToDownload)

    function ExtractZipFile(sourcePath, fileName, fb, folderPath,index) {



        fileUrl = DirUrl + "/" + fileName
        $("#loadertext"+indexData).html("فك ضغط الملفات")

        zip.unzip(fileUrl, DirUrl,
            function (result) {

                if(result == 0){



                    arrayStoryDesc[index-1].lock=false
                    $('#series-btn').click()
                    //CurrentStory();
                   removeFileZip(fileUrl)
                   //product.set("state", store.DOWNLOADED);
                   if($('.frontLayer').length) $('.frontLayer').remove()

                }else{
                    if($('.frontLayer').length) $('.frontLayer').remove()
                }
                endDownload(indexData,"success")


            },
            function (progressEvent) {

                percent = Math.round((progressEvent.loaded / progressEvent.total) * 100)
              //  statusDom.innerHTML = percent + "% Now Extract";
              //  statusDom.style.width = percent + "%"
                $("#lockSt"+indexData).css({
                    height:(100-percent)+"%"
                })
                $("#loadertext"+indexData).html((percent)+"%")
                //$('#loaderCanvas'+indexData).ClassyLoader({
                //    percentage: percent,
                //    speed: 0,
                //    fontSize: '100px',
                //    diameter: 60,
                //    lineColor: 'green',
                //    remainingLineColor: 'rgba(226,188,128,.5)',
                //    lineWidth: 10,	fontColor: 'rgba(226,188,128,.5)',
                //    animate: false, // whether to animate the loader or not,
                //    showStatus:true,
                //    textStatus:"X"
                //
                //});



            },index);

    }
}



function removeFileZip(path) {


    window.resolveLocalFileSystemURL(path, fileExists, fileDoesNotExist);

    function fileExists(entry) {

        entry.remove(success, fileDoesNotExist);
    }

    function success() {
        console.log('remove done')

    }

    function fileDoesNotExist(error) {
        console.log("Error removing file: " + error.code);
    }
}

function endDownload(index,state){
    if(state=="error"){


return
    }

    {
        $("#loadertext"+index).remove()
        objectContainer=$("#lockSt"+index).parent()
        objectContainer.attr("downloading","NO")
        //$('#loaderCanvas'+index).ClassyLoader({destroy:true});
        $('#loaderCanvas'+index).parent().parent().hide();

    }
    fileJsonWrite()
    lockFunction()

    $( ".thumb" ).each(function() {
       if($(this).attr("downloading")=="YES"){


           obj= $(this).find('.lock-container');
           obj.css({
               background:"url()",

           })
       }
    });

}



function putFrontLayer(){

    //if($('.frontLayer').length) $('.frontLayer').remove()
    //
    //$('<div class="frontLayer" style="width:100%;height:100%;position: absolute;top:0px;left:0px;z-index:999999999;background:rgba(0,0,0,.5)"></div>').appendTo('.site-container')

}

