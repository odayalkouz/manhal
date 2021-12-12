/**
 * Created by PhpStorm.
 * User: oday alkouz
 * Date: 22/11/2020
 * Time: 11:00 ص
 */

function printinvoice(id){
    const urlParams = new URLSearchParams(window.location.search);
    var  lang = urlParams.get('lang');
    if(lang==null){
        lang="En";
    }

    $("#viewinfo_container").load(SiteURL+"/printinfopayment.php?id="+id);
    setTimeout(function (){
        var contents = $("#viewinfo_container").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        frameDoc.document.write('<html><head><title></title>');
        frameDoc.document.write('</head><body>');
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
       setTimeout(function () {
           window.frames["frame1"].focus();
           window.frames["frame1"].print();
           frame1.remove();
        }, 200);
    },700)
}

function IndexingSortingItems() {
    var i=1;
    $("#sortable .col-md-3").each(function (){
        $(this).find(".slider-number").html(i);
        $(this).find(".main-card").attr("att",i)
        i++;
        $(".saveestting").show();
    });
}

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};



function imagePreview(){
    xOffset = 10;
    yOffset = 30;
    $(".preview").hover(function(e){
            var c = ($(this).attr('alt') != "") ? "<br/>" + $(this).attr('alt') : "";
            $("body").append("<p id='preview'><img src='"+ $(this).attr("src") +"' alt='Image preview' />"+ c +"</p>");
            $("#preview")
                .css("top",(e.pageY - xOffset) + "px")
                .css("left",(e.pageX + yOffset) + "px")
                .fadeIn("fast");
        },
        function(){
            $("#preview").remove();
        });
    $(".preview").mousemove(function(e){
        $("#preview")
            .css("top",(e.pageY - xOffset) + "px")
            .css("left",(e.pageX + yOffset) + "px");
    });
};

$( document ).ready(function() {
    // $('select').selectpicker();
    imagePreview();
    $(".vertical-nav-menu .mm-active").each(function () {
        $(this).closest("ul").parent("li").addClass("mm-active");
        $(this).closest("ul").parent("li").find("a:nth-child(1)").attr("aria-expanded","true");
    });

    $("#sortable").sortable();
    $("#sortable").sortable({
        stop: function( event, ui ) {
            setTimeout(function () {
                IndexingSortingItems();
            },100)
        }
    });
    $(document).on("click",".card-settings .disable",function(){
        var form = new FormData();
        form.append("process", "disableslider");
        form.append("id", $(this).attr('att_id'));
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

    });
    $(document).on("click",".card-settings .delete",function(){
        var form = new FormData();
        form.append("process", "deleteslider");
        form.append("id", $(this).attr('att_id'));
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
    });


    $(document).on("click",".btnmore-completed",function(){
        $(".modal-body").html('');
        var id=$(this).attr('att');
        $(".modal-body").load(SiteURL+"/completed/more.php?id="+id);
    });
    $(document).on("click",".btn-add-image",function(){
        $(".modal-body").html('');
        $(".modal-body").load(SiteURL+"/settings/add.php?id=1");
        $("#exampleModalLabel").html('Add');

    });
    $(document).on("click",".btn-view-slider",function(){
        $(".modal-body").html('');
        $(".modal-body").load(SiteURL+"/settings/view.php?id=1");
        $("#exampleModalLabel").html('View');

    });
    $(document).on("click",".btnmore-cancelled",function(){
        $(".modal-body").html('');
        var id=$(this).attr('att');
        $(".modal-body").load(SiteURL+"/cancelled/more.php?id="+id);
    });
    $(document).on("click",".btnmore-inprogress",function(){
        $(".modal-body").html('');
        var id=$(this).attr('att');
        $(".modal-body").load(SiteURL+"/inprogress/more.php?id="+id);
    });
    $(document).on("click",".btnprintrow",function(){
        var id=$(this).attr('att');
        printinvoice(id);
    });

    let date_str = getUrlParameter('date');
    var start_date = '2016-01-01';
    var end_date = moment();

    if (date_str != undefined) {
        let date_array = date_str.split("+-+");
        start_date = date_array[0];
        end_date = date_array[1]
    }
    ////////////start datepicker/////////////////

    $('#daterange').daterangepicker({
        autoUpdateInput: true,
         startDate: start_date,
         endDate:end_date,
        opens: 'left',
        locale: {
            cancelLabel: 'Cancel',
            applyLabel: 'apply',
            format: 'YYYY-MM-DD',
        },
    });
    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        $("#date").val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));

        $('#date').val($("#daterange").val());
        $("input[name='page']").val(0);
        $('#exampleModal').submit();
    });




    // $('#daterange').daterangepicker({
    //     autoUpdateInput: true,
    //     startDate: moment(),
    //     endDate: moment(),
    //     locale: {
    //         format: 'M/DD/YYYY'
    //     }
    // });
    // $('#daterange').on('apply.daterangepicker',function(event,obj)    {
    //     $(this).val($("#date").val());
    //
    //     $("#exampleModal").submit();
    //
    //
    //
    // });
    ////////////end datepicker///////////////////


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





