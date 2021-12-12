function logout(){
    var settings = {
        "url":SiteURL+ "/includes/store.php?process=logout",
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Cookie": "PHPSESSID=v0pk9jhltgo717eab4tcrjil47"
        },
    };
    $.ajax(settings).done(function (response) {
        window.location.assign(SiteURL+'/login.php')
    });
}
function changeshippingorder(_this){
    var shippingorder=$(_this).val();
    $('#shipping').val(shippingorder);
    $("input[name='page']").val(0);
    $('#date').val($("#daterange").val());
    $("#exampleModal").submit();
}
function changegroub(_this){
    var groub=$(_this).val();
    $('#groub').val(groub);
    $("input[name='page']").val(0);
    $('#date').val($("#daterange").val());
    $("#exampleModal").submit();
}


function Funsearch(){

    if($(".search-wrapper").hasClass('active')){
        $('#search').val($("#header_keyword").val());
        $('#page').val(0);

        $('#date').val($("#daterange").val());
        $('#shipping').val($("#shipping_order").val());
        $("#exampleModal").submit();
    }
}
function saveImageSlider(){
    var Action=$("#action_url").val();
    var form = new FormData();
    form.append("process", "insertslider");
    form.append("action", Action);
    form.append("slider",$('#exampleFile').prop('files')[0],$("#exampleFile").val());

    var settings = {
        "url": SiteURL+ "/includes/store.php",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };

    $.ajax(settings).done(function (response) {

        window.location.assign(SiteURL+'/settings/index.php')
    });
}
function SaveSortImageSlider(){
    var _array=[];
    $("#sortable .col-md-3").each(function (){
        _array.push({id:$(this).find(".main-card").attr("att_id"),sort:$(this).find(".main-card").attr("att")})
    });

    console.log(_array)

    var form = new FormData();
    form.append("process", "updatesortslider");
    form.append("data", JSON.stringify(_array));
    var settings = {
        "url": SiteURL+ "/includes/store.php",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
    };
    $.ajax(settings).done(function (response) {
        console.log(response);
        window.location.assign(SiteURL+'/settings/index.php')
    });


}

function changelanguage(_this){
    $("input[name='lang']").val($(_this).attr('att'));
    $('#date').val($("#daterange").val())
    $('#shipping').val($("#shipping_order").val());
    $("#exampleModal").submit();
}

function GotoPage(_this) {
    $("input[name='page']").val($(_this).attr('att'));
    $('#date').val($("#daterange").val());
    $('#shipping').val($("#shipping_order").val());

    $("#exampleModal").submit();
}
function changeOfStatusRequest(_this){
   var idpayment=$(_this).attr('att');
   var statuse=$(_this).val();
    var Page=$(_this).attr('att_page');

    Lobibox.confirm({
        title: lang_getmassage.changeOfStatusRequest.Title,
        msg: lang_getmassage.changeOfStatusRequest.Des,
        buttons: {
            yes: {
                'class': 'btn btn-success',
                closeOnClick: true
            },
            no: {
                'class': 'btn btn-warning',
                closeOnClick: true
            }
        },
        callback: function(lobibox, type){
            if (type === 'no'){
                $(_this)[0].selectedIndex=0;
            }else if (type === 'yes'){
                var form = new FormData();
                form.append("process", "changeOfStatusRequest");
                form.append("status", statuse);
                form.append("id", idpayment);
                var settings = {
                    "url": SiteURL+ "/includes/store.php",
                    "method": "POST",
                    "timeout": 0,
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": form
                };
                $.ajax(settings).done(function (response) {
                    console.log(response);
                    window.location.assign(SiteURL+'/'+Page+'/index.php')
                });
            }
        }
    });

}