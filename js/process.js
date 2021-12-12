/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh D on 17/05/2016.
 */



function ControlQuestion(value) {
    $(value).parent().hide();
    var data = {
        'TypeProcesses':'ControlQuestion',
        'type':$(value).attr("con"),
        'qtype':$(value).attr("type"),
        'id':$(value).attr("att")
    };

    if($(value).attr("con")=='delete') {
        Lobibox.confirm({
            msg: window.Lang.Areyousureyouwanttodeletethisquestion,
            callback: function ($this, type, ev) {
                if (type == 'yes') {
                    sendprocess(data);
                }
            }
        });
    }else if($(value).attr("con")=='edit'){
        $('.bottom').attr('contenteditable','false');
        $('#text_'+$(value).attr("att")).attr('contenteditable','true');
        $('#text_'+$(value).attr("att")).focus();
        $("#buttnsavetxtQ_"+$(value).attr("att")).show();

    }else{
        sendprocess(data);
    }
}
function updateDiscussions(id){
    if( $('#text_'+id).html()==""){
        Lobibox.notify("error", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: window.Lang.Pleaseentervalidemail
            });
    }else {
        $('#text_'+id).attr('contenteditable','false');
        $("#buttnsavetxtQ_"+id).hide();
        Lobibox.confirm({
            msg: window.Lang.Areyousureyouwanttoupdatethisquestion,
            callback: function ($this, type, ev) {
                if (type == 'yes') {

                    var data = {
                        'TypeProcesses':'updateDiscussionsAnswer',
                        'txt':$('#text_'+id).html().trim(),
                        'id':id.split('_')[1]
                    };
                    sendprocess(data);

                }
            }
        });
    }



}
function addSubscribing() {
    if ($('#txtMailSubscribe').val() == '' || validateEmail($('#txtMailSubscribe').val()) == false) {
        Lobibox.notify("error", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: window.Lang.Pleaseentervalidemail
            });
       // swal('email address', 'Please enter a valid email address.', 'error');
        return;
    }
    var data = {
        'TypeProcesses': 'addSubscribing',
        'email': $("#txtMailSubscribe").val()
    };
    sendprocess(data);
}
function resetfeedback() {
    $(".txt-username-a").val('');
    $(".txt-email-a").val('');
    $(".txt-area-a").val('');
    $("#typefeedback")[0].selectedIndex = 0;
}
function sendfeedback() {
    if ($(".txt-username-a").val() == '') {
       // swal('user name', 'Please enter a valid user name.', 'error');
        Lobibox.alert("error", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: window.Lang.Pleaseentervaliduser
            });
        return;
    } else if ($(".txt-area-a").val() == '') {
       // swal('message', 'Please enter a valid message.', 'error');
        Lobibox.alert("error", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: window.Lang.Pleaseentervalidmessage
            });
        return;
    } else if (validateEmail($(".txt-email-a").val()) == false) {
        //swal('email address', 'Please enter a valid email address.', 'error');
        Lobibox.alert("error", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: window.Lang.Pleaseentervalidemail
            });
        return;
    }
    var data = {
        'TypeProcesses': 'Feedback',
        'name': $(".txt-username-a").val(),
        'email': $(".txt-email-a").val(),
        'type': $("#typefeedback").val(),
        'message': $(".txt-area-a").val()
    };
    sendprocess(data);
}
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function  sendprocess(value) {
   // console.log(value)

    $.ajax({
        url: window.SITE_URL+"platform/ajax/process.php",
        type: "POST",
        data: value,
        success: function (data) {
            console.log("rr",data);
            if(value['TypeProcesses']=='Addacomment'){
                var array=JSON.parse(data)
                var comment='';
                for(var i=0;i<array.length;i++){

                    comment+='<div class="view-comment-container">';
                    comment+='<div class="right-content floating-left">';
                    comment+='<label class="floating-right">'+array[i]['cdate']+'</label>';
                    comment+='<div class="left-side floating-left">';
                    comment+='<h2>'+array[i]['fullname']+'</h2>';
                    comment+=' <p>'+array[i]['comment']+'</p>';
                    comment+=' </div></div></div>';
                }
                $("#comment").html(comment);
            }else{
                switch (data) {
                    case 'sendmailFeedback':
                       // swal('Send  email', 'Send an email has been successfully');
                        Lobibox.notify('success', {
                            msg: 'Send an email has been successfully'
                        });
                        resetfeedback();
                        break;
                    case 'emailalready':
                       // swal('email already', 'email already registered');
                        Lobibox.notify('warning', {
                            msg: 'email already registered'
                        });
                        break;
                    case 'registeredemail':
                      //  swal('Successfully', 'Successfully been registered email');
                        Lobibox.notify('success', {
                            msg: 'Successfully been registered email'
                        });
                        break;
                    case 'errorregisteredemail':
                       // swal('error', 'An error has occurred in the registry');
                        Lobibox.alert("error", //AVAILABLE TYPES: "error", "info", "success", "warning"
                            {
                                msg: "An error has occurred in the registry"
                            });

                        break;
                    case 'addfavorit':
                        $(".fav-details-image").addClass('selected');
                        $("#"+value['type']+value['id']+"_"+value['random']).addClass('active');
                        break;
                    case 'deletefavorit':
                        $(".fav-details-image").removeClass('selected');
                        $("#"+value['type']+value['id']+"_"+value['random']).removeClass('active');
                        break;
                    case 'downloadworksheet':
                        var num=$(".download-view_span"+value['id']).html();
                        num=parseInt(num)+1;
                        $(".download-view_span"+value['id']).html(num);
                        break;

                    case 'updateControlQuestion':
                        window.location=window.location;

                        break;
                    case 'deleteControlQuestion':

                    window.location=window.SITE_URL+window.Lang.Lang+'/educationalinquiries';

                    break;
                }
            }

        }
    });

}
