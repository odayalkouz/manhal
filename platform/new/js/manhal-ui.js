/**
 * Created by PhpStorm.
 * User: oday alkouz
 * Date: 17/06/2020
 * Time: 09:00 ص
 */
$( document ).ready(function() {

    //Start Exportable table print and CSV
    var table = $('.js-exportable').DataTable( {
        buttons: [
            {
                tag: 'a ',
                text:'<i class="icon-print float-left"></i><span class="float-left">Print</span>',
                className:'waves-effect waves-block hide-last-col dropdown-item',
                extend:'print'
            },
            {
                tag: 'a',
                className:'waves-effect waves-block hide-last-col dropdown-item',
                extend:'excelHtml5',
                footer: true,
                text:'<i style="" class="icon-execlfile float-left"></i><span class="float-left">Excel</span>'
            },
            {
                tag: 'a',
                className:'waves-effect waves-block hide-last-col dropdown-item',
                extend:'csv',
                footer: true,
                text:'<i style="" class="icon-csvfile float-left"></i><span class="float-left">CSV</span>'
            },
            {
                tag: 'a',
                className:'waves-effect waves-block hide-last-col dropdown-item',
                extend:'pdfHtml5',
                text:'<i class="icon-pdffile float-left"></i><span class="float-left">pdf</span>'
            },
        ],
        buttonLiner: {
            tag: null
        },
        searching: false,
        paging:   false,
        ordering: false,
        info:     false
    } );
    table.buttons()
        .container()
        .appendTo( '.append_printins');
    //End Exportable table print and CSV

    //Start multiple select
    $('#Outcomes_multiple_select').multiselect({
        includeSelectAllOption: true,
        buttonWidth: '100%',
    });
    //End multiple select

    //Start open media in iframe
    $(".media-items-sortable-container#sortable .item-container-a").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $(".iframe-media-container").attr("src",$(this).attr("data-src"))

    });
    //End open media in iframe


    $("#current-year").html(new Date().getFullYear());

    //Start pagination active
    $(".pagination li").click(function () {
        $(this).addClass("active").siblings().removeClass("active")
    });
    //End pagination active

//Start messages functions
function infomessage(){
    Lobibox.notify('info', {
        showClass: 'fadeInDown',
        hideClass: 'fadeUpDown',
        icon: false,
        msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
    });
}
function warningmessage(){
    Lobibox.notify('warning', {
        showClass: 'bounceIn',
        hideClass: 'bounceOut',
        icon: false,
        msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
    });
}
function errormessage(){
    Lobibox.notify('error', {
        showClass: 'zoomInUp',
        hideClass: 'zoomOutDown',
        icon: false,
        msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
    });
}
function successmessage(){

    Lobibox.notify('success', {
        showClass: 'rollIn',
        hideClass: 'rollOut',
        icon: false,
        msg: 'success'
    });
}
function confirmmessage(){
    Lobibox.confirm({
        title: 'Confirm',
        msg: "Are you sure you want to delete this user?",
    });
}
    $('#basicInfoAnimation').click(function () {
        infomessage();
    });
    $('#basicWarningAnimation').click(function () {
        warningmessage();
    });
    $('#basicErrorAnimation').click(function () {
        errormessage();
    });
    $('#basicSuccessAnimation').click(function () {
        successmessage()
    });
    $('#confirmAnimation').click(function () {
        confirmmessage()
    });
});
//end messages functions



//start loaders functions
function showLoader() {
    $(".loader-main-container").show();
}
function hideLoader() {
    $(".loader-main-container").hide();

}
//end loaders functions