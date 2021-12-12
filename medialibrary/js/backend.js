$(document).ready(function () {

    $("#change_lang").click(function () {
        $.ajax({
            url: "api.php?process=lang",
            type: "GET",
            cache: false,
            dataType: 'html',
            data: '',
            success: function (html) {
                $("#filter_lan").val(html.toLowerCase());
                locationReload();
            }
        });
    });
    setTimeout(function () {
        $(".jscolor").css("background-color", "#" + $('#filter_color').val());
        $(".jscolor").val($('#filter_color').val());
        $('#More_Filters').addClass($('#filter_open').val())
    }, 200);

    $('.item-container').click(function () {
        var id = $(this).attr('att');
        $.ajax({
            url: "api.php",
            type: "GET",
            cache: false,
            dataType: "json",
            data: {process: 'tagsmediaid', id: id},
            success: function (results) {
                var getdata = '';
                for (var i = 0; i < results['data'].length; i++) {
                    getdata += '<a onclick="GetMediaTages(this)" att="' + results['data'][i].Tags + '" class="label label-default active">' + results['data'][i].Tags + '</a>';
                }
                $(".tags-container").html(getdata);
            }
            ,
            error: function (response) {

                console.log(response);
            }
        });
    });
    $(".btn-search").click(function () {
        locationReload();
    });
    $(".search-input").on('keypress', function (e) {
        if (e.which == 13) {
            locationReload();
        }
    });
    document.addEventListener('mousedown', function () {



        if ($('#More_Filters').hasClass('active')) {
            $('#filter_open').val('active');
            if ($('#filter_type').val() == '2') {
                if (!$('.jscolor').hasClass('jscolor-active')) {
                    if ($('.jscolor').val() != $('#filter_color').val()) {
                        $('#filter_color').val($('.jscolor').val());
                        locationReload();
                    }
                }
            }
        } else {
            $('#filter_open').val('non');
        }
    }, false);


});

function GetMediaTages(This){

    var keyword=$(This).attr('att');
    $('.search-container').val(keyword);
   locationReload();

        }
function CallAjaxGetMedia() {



    var Filter_Cat = '';


    if ($("#LevelAll").prop("checked")) {
        Filter_Cat = 'all,';
    } else {
        Filter_Cat = '';
        $('.caregoies-checkboxes input[type="checkbox"]').each(function () {
            if ($(this).prop("checked")) {
                Filter_Cat += $(this).attr('att') + ",";
            }
        });

    }

    Filter_Cat = Filter_Cat.substring(0, Filter_Cat.length - 1)
    $('#filter_cat').val(Filter_Cat);
    locationReload();
}

function ClearColor() {
    $('#filter_color').val('');
    $('.jscolor').val('');
    $(".jscolor").css("background-color", "rgb(255, 255, 255)");

    CallAjaxGetMedia()
}

function ClearFilter(This) {
    // $('#filter_cat').val('');
    $(This).parent().remove();
    $("#LevelAll").prop("checked", '');
    $("#Level" + $(This).attr('att')).prop("checked", '');

    CallAjaxGetMedia();

}
function GotoPage(currentpage,allpage,pages){
    if(currentpage<0||currentpage>allpage){
      // return ;
    }

    $('#pages').val(pages);
    $('#page').val(currentpage);
    locationReload();

}
function ClearAllFilter() {
    $('#buttonfilterindex').html('');
    $('.caregoies-checkboxes input[type="checkbox"]').each(function () {
        $(this).prop("checked", '');
    });
    ClearColor();

}

function calltype() {
    alert('calltype')
}

function selectedtype() {
    $("#multiple_select_menu option:selected").each(function () {
        $('#filter_type').val($(this).attr('att'))
    });



    if ($('#filter_type').val() == '6') {
        $('#filter_open').val('non');


    }

    CallAjaxGetMedia()
}

function callLang() {
    var lan = 0;
    if ($('#filter_lan').val() == 'en') {
        lan = 1;
    }
    return lan;
}

function locationReload() {


            $('#filter_keyword').val($('.search-container').val().toLowerCase());


    var queryParams = new URLSearchParams(window.location.search);
    // Set new or modify existing parameter value.

    queryParams.set("filter_type", $('#filter_type').val());
    queryParams.set("filter_keyword", $('#filter_keyword').val());
    queryParams.set("filter_lan", callLang());
    queryParams.set("filter_cat", $('#filter_cat').val());
    queryParams.set("page", $('#page').val());
    queryParams.set("pages", $('#pages').val());
    queryParams.set("filter_open", $('#filter_open').val());
    if ($('#filter_type').val() != 2) {
        queryParams.delete("filter_color");
    } else {
        queryParams.set("filter_color", $('#filter_color').val());
    }


    // Replace current querystring with the new one.
    history.replaceState(null, null, "?" + queryParams.toString());
    window.location.reload();

}


function success_MSG() {
    Lobibox.notify(msgjavascript.update.Title, {
        showClass: 'rollIn',
        hideClass: 'rollOut',
        icon: false,
        msg: msgjavascript.update.Des
    });
}

function errorMSG() {
    Lobibox.notify('error', {
        showClass: 'zoomInUp',
        hideClass: 'zoomOutDown',
        icon: false,
        msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
    });
}





