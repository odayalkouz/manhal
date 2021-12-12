window.SITE_URL="http://localhost/Manhal/";
// window.SITE_URL="https://www.manhal.com/";
function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
$(document).ready(function () {
    if(selectedTemplate==0){
        openchoosethumb();
    }
    $(".jq_edit_template").click(function () {
        if(selectedTemplate==""){
            window.selectedTemplate=$(this).attr("templateid");
            var str=$("#default-thumb-big").attr("src");
            if (str.indexOf("tempid") >= 0) {
                var new_path = str.replace('tempid', window.selectedTemplate);
                $("#default-thumb-big").attr("src",new_path);
            }
            var str1=$("#default-thumb").attr("src");
            if (str1.indexOf("tempid") >= 0) {
                var new_path1 = str1.replace('tempid', window.selectedTemplate);
                $("#default-thumb").attr("src",new_path1);
            }
        }
    });
    $(".save-settings").click(function () {
        console.log("start");
        showloader();
        var data={};
        data["arabic_title"]=$("#arabic_title").val();
        data["english_title"]=$("#english_title").val();
        data["arabic_desc"]=$("#seodescription_ar").val();
        data["english_desc"]=$("#seodescription_en").val();
        data["level"]=$("#level").val();
        data["category"]=$("#category").val();
        data["language"]=$("#language").val();
        if($("#isPublished").prop("checked")){
            data["publish"]=1;
        }else{
            data["publish"]=0;
        }

        data["thumb"]=$("#default-thumb-big").attr("src");
        data["thumb_small"]=$("#default-thumb").attr("src");
        data["help"]=$("#help").val();
        data["template"]=window.selectedTemplate;
        data["id"]=window.id;
        $.ajax({
            method: "POST",
            url: window.SITE_URL+"platform/ajax/template_editor.php?process=updatesettings",
            data: data,
            dataType: "json",
            success: function (data) {
                // console.log("data",data);
                // hideloader();
                console.log(data);
                if(data.status==1){
                    window.location.reload();
                    closechoosethumb();
                    closetemplatesettings();
                }else{
                    showMsg();
                }
            }
        });
    });

    $("#jq_preview").click(function () {
        console.log("start");
        showloader();
        var data={};
        data["template"]=window.selectedTemplate;
        data["id"]=window.id;
       // data["help"]=$("#help").val();
        data["help"]=CKEDITOR.instances.ckeditor.getData();
        data["color"]=$(".jq_color").attr('color').replace('#','');
        console.log("data",data);
        $.ajax({
            method: "POST",
            url: window.SITE_URL+"platform/ajax/template_editor.php?process=publish",
            data: data,
            dataType: "json",
            success: function (data) {
                console.log("data",data);
                hideloader();
                // console.log(data);
                if(data.status==1){
                    window.open(window.SITE_URL+"platform/media/"+window.id+"/index.html?"+makeid(5));
                }else{
                    showMsg();
                }
            }
        });
    });

    $(".save-settings-help").click(function () {
        showloader();
        var data={};
        data["template"]=window.selectedTemplate;
        data["id"]=window.id;
        data["help"]=$("#help").val();
       // data["help"]=CKEDITOR.instances.ckeditor.getData();
        data["color"]=$(".jq_color").attr('color').replace('#','');
        console.log("data",data);
        $.ajax({
            method: "POST",
            url: window.SITE_URL+"platform/ajax/template_editor.php?process=publish",
            data: data,
            dataType: "json",
            success: function (data) {
                hideloader();
            }
        });
    });

    $("#save_temp").click(function () {
        showloader();
        iframe=$("#iframe_template")[0].contentWindow;
        iframe.saveGame();
    });

    $(".save-settings-help").click(function () {
        showloader();
        var html = CKEDITOR.instances.ckeditor.getData();
        var data={};
        data["id"]=window.id;
        data["html"]=html;
        $.ajax({
            method: "POST",
            url: window.SITE_URL+"platform/ajax/template_editor.php?process=savehelp",
            data: data,
            dataType: "json",
            success: function (data) {
                console.log("data",data);
                hideloader();
                // $('.index-page-popup .close').click();
            }
        });
    });
});

function saveGameData(gameData) {
    console.log(gameData);
    var data={};
    data["data"]= JSON.stringify(gameData);
    data["id"]=window.id;
    data["color"]=$(".jq_color").attr('color');
    console.log('saving',data);
    $.ajax({
        method: "POST",
        url: window.SITE_URL+"platform/ajax/template_editor.php?process=savegamedata",
        data: data,
        dataType: "json",
        success: function (data) {
            console.log("data",data);
            hideloader();
        }
    });
}
