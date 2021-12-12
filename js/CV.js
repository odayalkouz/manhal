/**
 * Created by khalid alomiri on 24/07/2017.
 */

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function telephoneCheck(str) {
    var patt = new RegExp(/^\+?1?\s*?\(?\d{3}(?:\)|[-|\s])?\s*?\d{3}[-|\s]?\d{4}$/);
    return patt.test(str);
}

function reset(){
    $("#firstname").val('') ;
    $("#lastname").val('');
    $('#emailaddress').val('');
    $("#phone").val('');
}
function sendCV() {

    if ($("#firstname").val() == '' || $("#firstname").val().length < 3) {

        Lobibox.alert("error",
            {
                msg: window.Lang.pleaseInsertFirstName
            });
        return;
    } else if ($("#lastname").val() == '' || $("#lastname").val().length < 3) {
        Lobibox.alert("error",
            {
                msg: window.Lang.pleaseInsertLastName
            });
        return;
    } else if (!validateEmail($('#emailaddress').val().trim()) || $('#emailaddress').val() == '') {
        Lobibox.alert("error",
            {
                msg: window.Lang.Pleaseentervalidemail
            });
        return;
    } else if (!telephoneCheck($("#phone").val())) {
        Lobibox.alert("error",
            {
                msg: window.Lang.Pleaseenterphone
            });
        return;
    } else if ($("#Filemedia").val()=='') {
        Lobibox.alert("error",
            {
                msg: window.Lang.uploadFile
            });
        return;
    }
$("#lastname_").val($("#lastname").val());
    $("#firstname_").val($("#firstname").val());
    $("#emailaddress_").val($("#emailaddress").val());
    $("#Phone_").val($("#phone").val());
    $("#media_form").submit();
    Lobibox.notify('success',
        {
            msg: window.Lang["SentSuccessfullyCV"]
        });
    reset();
}
