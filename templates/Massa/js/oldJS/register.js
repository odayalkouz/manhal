var registerObject={
    timeReg:"",
    id:"",
    name:"",
    Email:"",update:""

}

function registerDevice(update){

    var fileSource = applicationPathRoot + "files/files/register.json"
    window.resolveLocalFileSystemURL(fileSource, fileExists, fileDoesNotExist);
    function fileExists(fileEntry) {
     //   alert('تم التسجيل مسبقا')

        fileEntry.file(function (file) {
            var reader = new FileReader();

            reader.onloadend = function (e) {




                registerObject=JSON.parse(this.result)
                console.log(registerObject)
                checkForUpdate()
            }

            reader.readAsText(file);
        });
    }

    function fileDoesNotExist() {
      // alert("لم يتم التسجيل جاري التسجيل الان")

        pushDevice()

    }
}

function pushDevice(update){
    window.FirebasePlugin.getInstanceId(function(token) {
        // save this server-side and use it to push notifications to this device
        pushToServer(token)
      //alert(token);
    }, function(error) {
        alert(error);
    });

    window.FirebasePlugin.onNotificationOpen(function(notification) {
       // alert(notification);
    }, function(error) {
        alert(error);
    });

    //var push = PushNotification.init({
    //    android: {
    //        senderID: "798881066342"
    //    },
    //    ios: {
    //        alert: "true",
    //        badge: "true",
    //        sound: "true"
    //    },
    //    windows: {}
    //});
    //
    //push.on('registration', function(data) {
    //
    //  //  alert(data.registrationId);
    //
    //    pushToServer(data.registrationId,update)
    //});
    //
    //push.on('notification', function(data) {
    //  //  alert(data.message)
    //  //  alert(data.image)
    //    // data.message,
    //    // data.title,
    //    // data.count,
    //    // data.sound,
    //    // data.image,
    //    // data.additionalData
    //});
    //
    //push.on('error', function(e) {
    // //   alert(e.message)
    //    // e.message
    //});

}


urlSqlServer="http://162.144.51.202/~story/gcm/register.php"
function pushToServer(id,update){

    name="test user"
    email="alghraibeh@gmail.com"

  //  alert('الاتصال بالسيرفر')
    $.ajax({
        url: urlSqlServer,
        type: 'POST',
        data: {
            name:name,
            email:email,
            regId:id
        },

        success: function (data, status)
        {
          //  alert("register done")
          //  alert(JSON.stringify(data))
           // writeFile(name,email,id,update)
        },
        error: function (xhr, desc, err)
        {
          //  alert("خطأ بالكتابة على السيرفر")

        }
    });
}


function writeFile(name,email,id,update){

    var fileSource = applicationPathRoot
    window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, gotFS, fail);

    function gotFS(fileSystem) {

        var directoryEntry = fileSystem.root; // to get root path of directory

        directoryEntry.nativeURL = applicationPathRoot

        directoryEntry.getFile("register.json", {create: true, exclusive: false}, gotFileEntry, fail);
    }


    function gotFileEntry(fileEntry) {

        fileEntry.createWriter(gotFileWriter, fail);

    }

    function gotFileWriter(writer) {
        writer.onwriteend = function (evt) {
            writeJsonControlFile()

        };
        var d = new Date();
        var t = d.toLocaleString();
        registerObject={
            timeReg:t,
            id:id,
            name:name,
            Email:email,
            update:update

        }





        writer.write(JSON.stringify(registerObject));
    }




    function fail(error) {
        console.log(error.code);
    }



}


function checkForUpdate(){

    if (navigator.network.connection.type == Connection.NONE) {
        return
    }
    fileName="update/update.json"
    updateLink=urlTst+fileName
    console.log("البحث عن تحديثات جديده")
    $.getJSON( updateLink, {
            tags: "mount rainier",
            tagmode: "any",
            format: "json"
        })
        .done(function(data) {
            loadDataFromJson(data)



        })
        .fail(function() {
            console.log( "error" );
        })
        .always(function() {
            console.log( "complete" );
        });




}


function loadDataFromJson(data){



    console.log("version:"+data.update[0].version)
    if(registerObject.update!=data.update[0].version){

        console.log('يتوفر تحديث جديد')
        onUpdateFininsh(data.update[0].version)
    }

}

function onUpdateFininsh(updateV){
    writeFile(
        registerObject.name,
        registerObject.Email,
        registerObject.id,
        updateV)

}

