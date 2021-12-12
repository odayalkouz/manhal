$(document).ready(function () {
    $(".search-icon").click(function () {
       if($('.search-wrapper').hasClass('active')){
           var value = $('.search-input').val().toLowerCase();
           search(value);
       }
    });
    $(".search-input").on('keypress', function (e) {
        if (e.which == 13) {
            var value = $(this).val().toLowerCase();
            search(value);
        }
    });

    $("#saveCat").click(function () {
        var data = {process: 'updatecategory',id:$('.app-main__inner').attr('att'),name_ar:$('#cat_ar').val(),name_en:$('#cat_en').val()}

        $.ajax({
            url: "api.php",
            type: "POST",
            cache: false,
            dataType: "html",
            data: data,
            success: function (response) {
                success_MSG();


            },
            error: function (response) {
                errorMSG();
            }
        });

    });

    $(".delete").click(function () {
        var File = $(this).attr('att');
        Lobibox.confirm({
            title: msgjavascript.deleteFile.Title,
            msg: msgjavascript.deleteFile.Des,
            callback: function ($this, type, ev) {
                //Your code goes here
                var data1 = {process: 'DeleteFile', file: File}
                switch (type) {
                    case 'yes':
                        console.log(Image);
                        $.ajax({
                            url: "api.php",
                            type: "POST",
                            cache: false,
                            dataType: "html",
                            data: data1,
                            success: function (response) {
                                window.location = window.location;
                            },
                            error: function (response) {
                                console.log(response);
                            }
                        });
                        break;
                }
            }
        });
    });
    $(".download").click(function () {
        var File = $(this).attr('att');

    });
    $("#information_save").click(function () {
        var data = {process: 'information_save',fullname:$("#firstname").val(),pass:$("#Password").val(),email:$("#email").val()};

                console.log(data);
                $.ajax({
                    url: "api.php",
                    type: "POST",
                    cache: false,
                    dataType: "html",
                    data: data,
                    success: function (response) {
                       // window.location = window.location;
                        console.log(response);
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });


    });

    $(".delete-contract").click(function () {
        var ID = $(this).attr('att');
        Lobibox.confirm({
            title: msgjavascript.DeleteContract.Title,
            msg: msgjavascript.DeleteContract.Des,
            callback: function ($this, type, ev) {
                //Your code goes here
                var data1 = {process: 'deletecontract', id: ID}
                switch (type) {
                    case 'yes':
                        console.log(Image);
                        $.ajax({
                            url: "api.php",
                            type: "POST",
                            cache: false,
                            dataType: "html",
                            data: data1,
                            success: function (response) {
                                window.location = window.location;
                            },
                            error: function (response) {
                                console.log(response);
                            }
                        });
                        break;
                }
            }
        });
        console.log(File);
    });
    $(".delete-cate").click(function () {
        var ID = $(this).attr('att');
        Lobibox.confirm({
            title: msgjavascript.DeleteCategory.Title,
            msg: msgjavascript.DeleteCategory.Des,
            callback: function ($this, type, ev) {
                //Your code goes here
                var data = {process: 'deletecategory', id: ID}
                switch (type) {
                    case 'yes':

                        $.ajax({
                            url: "api.php",
                            type: "POST",
                            cache: false,
                            dataType: "html",
                            data: data,
                            success: function (response) {
                                window.location = window.location;
                            },
                            error: function (response) {
                                console.log(response);
                            }
                        });
                        break;
                }
            }
        });
        console.log(File);
    });

    $("#save").click(function () {
        var t_contract = 0;
        if ($('#t_contract').is(':checked')) {
            t_contract = 1
        }
        var data1 = {
            process: 'edit',
            id: $("#id").val(),
            num: $("#num").val(),
            act: $("#type").val(),
            name: $("#name").val(),
            email: $("#email").val(),
            country: $("#country").val(),
            city: $("#city").val(),
            address: $("#address").val(),
            IBAN: $("#IBAN").val(),
            type: $("#type").val(),
            t_contract: t_contract,
            d_contract: $("#d_contract").val(),
            s_date: $("#s_date").val(),
            e_date: $("#e_date").val(),
            v_contract: $("#v_contract").val(),
            currency: $("#currency").val(),
            status: $("#status").val(),
            monthlyamount: $("#monthlyamount").val(),
            p_date: $("#p_date").val(),
            alarm: $("#alarm").val(),
            email_to: $("#email_to").val(),
            email_cc: $("#email_cc").val(),
            email_t: $("#email_t").val(),
            action: $("#action").find(":selected").val(),
            phone: $("#phone").val()
        };
        $.ajax({
            url: "api.php",
            type: "POST",
            cache: false,
            dataType: "html",
            data: data1,
            success: function (response) {
                window.location = window.location;
            },
            error: function (response) {
                console.log(response);
            }
        });
    });
    $("#change_lang").click(function () {
        $.ajax({
            url: "api.php?process=lang",
            type: "GET",
            cache: false,
            dataType: 'html',
            data: '',
            success: function (html) {
                window.location = URL__ + 'Oqoud/index.php?lan=' + html.toLowerCase() + '&cat=' + Cat + _page() + _Keywords();
            }
        });
    });
    $("#Category").change(function () {
        Cat = $(this).children("option:selected").val();
        window.location = URL__ + '/Oqoud/index.php?lan=' + lan + '&cat=' + Cat;
    });


});
function search(val){
    var queryParams = new URLSearchParams(window.location.search);
    // Set new or modify existing parameter value.
    queryParams.set("keyword", val);
    // Replace current querystring with the new one.
    history.replaceState(null, null, "?" + queryParams.toString());
    window.location.reload();
}
function uploadfiles(contener, $file, IdFolder, oqoud) {
    var fileSelect = document.getElementById($file);
    // Get the selected files from the input
    var files = fileSelect.files;
    // Create a new FormData object
    var formData = new FormData();
    // Loop through each of the selected files.
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        formData.append($file + '[]', file, file.name);
    }
    formData.append('process', 'uploadoqoud');
    formData.append('IdFolder', IdFolder);
    formData.append('oqoud', oqoud);
    $.ajax({
        url: 'api.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response != 0) {
                console.log(1)
                $("#" + contener).html(response);
            } else {
                alert('file not uploaded');
            }
        },
    });
}

function GotoPage(page) {

    $.ajax({
        url: "api.php?process=oqoud",
        type: "GET",
        cache: false,
        dataType: 'html',
        data: {'keyword': '', 'type': '', 'd_contract': '', 'status': '', 'action': '', 'category': '', 'page': page},
        success: function (html) {
            window.location = URL__ + '/Oqoud/index.php?lan=' + lan + '&cat=' + Cat + '&page=' + page + _Keywords();
        }
    });
}

_Keywords = function () {
    var result = '';
    if (Keyword != null && Keyword != undefined && Keyword != 'undefined' && Keyword != "") {
        result = '&keyword=' + Keyword;
    }
    return result;
}
_page = function () {
    var result = '';
    if (Page != null && Page != "" && Page != '0') {
        result = '&page=' + Page;
    }
    return result;
}
function success_MSG(){
    Lobibox.notify(msgjavascript.update.Title, {
        showClass: 'rollIn',
        hideClass: 'rollOut',
        icon: false,
        msg: msgjavascript.update.Des
    });
}
function errorMSG(){
    Lobibox.notify('error', {
        showClass: 'zoomInUp',
        hideClass: 'zoomOutDown',
        icon: false,
        msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
    });
}





