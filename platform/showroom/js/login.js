function Login_failedmessage(){
    Lobibox.notify('error', {
        showClass: 'zoomInUp',
        hideClass: 'zoomOutDown',
        icon: false,
        msg: lang_getmassage.Login_failed.Des
    });
}
var token='';
function login(){
    var username=$("input[name ='username']").val();
    var password=$("input[name ='password']").val();
    if(username.length<1 || password.length<1) {
        Login_failedmessage();
        return;
    }
    var form = new FormData();
    form.append("process", "signin");
    form.append("username", username);
    form.append("pass", password);
    form.append("webtocken",  $("#web_token").val());
    var settings = {
        "url": $url+'/includes/store.php',
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Cookie": "PHPSESSID=v0pk9jhltgo717eab4tcrjil47"
        },
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };
    $.ajax(settings).done(function (response) {

        console.log(response)

        if(response==1){
            window.location.assign('index.php');
        }else{
            Login_failedmessage();
        }
    });
}


