/**
 * Created by Hussam Abu Khadijeh - Dar Almanhal on 1/5/2016.
 */

$(document).on("change","select",function(){
    conID = $(this).attr("id");
    $("#lbl" + conID).html($("#" + conID + " option:selected").text());
});

$(document).on("change","input[type=file]",function(){
    conID = $(this).attr("id");
    $("#lbl" + conID).html($("#" + conID).val());
});

function UpdateUser() {
    var data = {
        user_id: $("#Edituserid").val(),
        user_name: $("#Edituser_name").val(),
        user_password: $("#Edituser_password").val(),
        user_email: $("#Edituser_email").val(),
        user_permession: $("#Edituser_permession").prop("selectedIndex") + 1,
        user_fullname: $("#Edituser_fullname").val(),
        user_status: $("#Edituser_status").prop("selectedIndex"),
        TypeProcesses: 'updateuser'
    };

    setdatafunction('updateuser', data);
}
function login(){
    var data = {
        user_name: $("#username").val(),
        user_password: $("#password").val(),
        TypeProcesses: 'login'
    };

    setdatafunction('login', data);
}
function deleteuser(userid) {
    swal({
        title: window.Lang['Areyousure'],
        text: window.Lang['Youwillnotbeabletorecoverthisuser'],
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: window.Lang['Yesdeleteit'],
        cancelButtonText: window.Lang['Nocancel'],
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            setdatafunction('deleteuser', userid);
            swal(window.Lang['Deleted'],window.Lang['userhasbeendeleted'],'success');
        } else {
            swal(window.Lang['Cancelled'],window.Lang['Youruserissafe'],'error');
        }
    });

    //
}
function deletebooks(bookid){
    swal({
        title: window.Lang['Areyousure'],
        text: window.Lang['Youwillnotbeabletorecoverthisbook'],
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: window.Lang['Yesdeleteit'],
        cancelButtonText: window.Lang['Nocancel'],
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            setdatafunction('deletebook', bookid);
            swal(window.Lang['Deleted'],window.Lang['bookhasbeendeleted'],'success');
        } else {
            swal(window.Lang['Cancelled'],window.Lang['Youruserissafe'],'error');
        }
    });
}
function deletemedia(id){
    swal({
        title: window.Lang['Areyousure'],
        text: window.Lang['Youwillnotbeabletorecoverthismedia'],
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: window.Lang['Yesdeleteit'],
        cancelButtonText: window.Lang['Nocancel'],
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            setdatafunction('deletemedia', id);
            swal(window.Lang['Deleted'],window.Lang['mediahasbeendeleted'],'success');
        } else {
            swal(window.Lang['Cancelled'],window.Lang['Youruserissafe'],'error');
        }
    });
}
function deleteproduct(id){
    swal({
        title: window.Lang['Areyousure'],
        text: window.Lang['Youwillnotbeabletorecoverthismedia'],
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: window.Lang['Yesdeleteit'],
        cancelButtonText: window.Lang['Nocancel'],
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            setdatafunction('deleteproduct', id);
            swal(window.Lang['Deleted'],window.Lang['mediahasbeendeleted'],'success');
        } else {
            swal(window.Lang['Cancelled'],window.Lang['Youruserissafe'],'error');
        }
    });
}




function deleteinvoice(id){

    swal({

        title: window.Lang['Areyousure'],

        text: window.Lang['Youwillnotbeabletorecoverthismedia'],

        type: 'warning',

        showCancelButton: true,

        confirmButtonColor: "#DD6B55",

        confirmButtonText: window.Lang['Yesdeleteit'],

        cancelButtonText: window.Lang['Nocancel'],

        closeOnConfirm: false,

        closeOnCancel: false

    }, function (isConfirm) {

        if (isConfirm) {

            setdatafunction('deleteInvoices', id);
            swal(window.Lang['Deleted'],window.Lang['mediahasbeendeleted'],'success');
        } else {
            swal(window.Lang['Cancelled'],window.Lang['Youruserissafe'],'error');

        }

    });

}

function deletepage(bookid,pageid){
    swal({
        title: window.Lang['Areyousure'],
        text: window.Lang['Youwillnotbeabletorecoverthisbook'],
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: window.Lang['Yesdeleteit'],
        cancelButtonText: window.Lang['Nocancel'],
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            var data={
                book_id:bookid,
                page_id:pageid,
                TypeProcesses:'deletepage'
            };
            setdatafunction('deletepage',data);

            swal(window.Lang['Deleted'],window.Lang['bookhasbeendeleted'],'success');
        } else {
            swal(window.Lang['Cancelled'],window.Lang['Youruserissafe'],'error');
        }
    });
}
function deletecategory(categoryid){

    swal({
        title: window.Lang['Areyousure'],
        text: window.Lang['Youwillnotbeabletorecoverthisbook'],
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: window.Lang['Yesdeleteit'],
        cancelButtonText: window.Lang['Nocancel'],
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            setdatafunction('deletecategory', categoryid);
            swal(window.Lang['Deleted'],window.Lang['categoryhasbeendeleted'],'success');
        }
    });
}
//start khalid [000001-7-9-2016]
function deletecategorystory(categoryid){
    swal({
        title: window.Lang['Areyousure'],
        text: window.Lang['Youwillnotbeabletorecoverthisstory'],
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: window.Lang['Yesdeleteit'],
        cancelButtonText: window.Lang['Nocancel'],
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            setdatafunction('deletecategorystory', categoryid);
            swal(window.Lang['Deleted'],window.Lang['categoryhasbeendeleted'],'success');
        }
    });
}
function deletedepartment(categoryid){
    swal({
        title: window.Lang['Areyousure'],
        text: window.Lang['Youwillnotbeabletorecoverthisstory'],
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: window.Lang['Yesdeleteit'],
        cancelButtonText: window.Lang['Nocancel'],
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            setdatafunction('deletedepartment', categoryid);
            swal(window.Lang['Deleted'],window.Lang['categoryhasbeendeleted'],'success');
        }
    });
}

function savesortstorypage(id){
    var arry=[];
    $("#sortable li").each(function( index ) {
        arry.push($(this).attr('cid'))
    });

    var data={
        id:id,
        pages:arry,
        TypeProcesses:'sortstorypages'
    };
    setdatafunction('sortstorypages',data);
    //console.log(arry)
}
//end khalid [000001-7-9-2016]
function savesortpage(bookid){
var arry=[];
    $("#sortable li").each(function( index ) {
        arry.push($(this).attr('sort'))
    });

    var data={
        book_id:bookid,
        pages:arry,
        TypeProcesses:'sortpages'
    };
    setdatafunction('sortpages',data);
    //console.log(arry)
}
function searchBook(){
window.location="index.php?category="+$("#Category").val()+"&keywords="+$("#book_search").val();
}
function searchBookb(){
window.location="searchbook.php?category="+$("#Category_b").val()+"&keywords="+$("#book_search").val();
}
function searchmedia(){
    window.location="media.php?category="+$("#Category_media").val()+"&keywords="+$("#media_search").val();
}
function searchQuiz(){
    window.location="quiz.php?category="+$("#Category_quiz").val()+"&keywords="+$("#quiz_search").val();
}
function searchwaerhouse(){
    window.location="warehouse.php?status="+$("#warehouseStatus").val()+"&company="+$("#shippingCompany").val()+"&keywords="+$("#warehouse_search").val();
}
function searchshippingwarehouse(){
    window.location="shippingwarehouse.php?status="+$("#shippingwarehouseStatus").val()+"&company="+$("#shippingwarehouseCompany").val()+"&keywords="+$("#shippingwarehouse_search").val();
}


function setdatafunction() {
    casetype = arguments[0];
    par1 = arguments[1];
    switch (arguments[0]) {
        case "deleteuser":

            setdata = {TypeProcesses: 'deleteuser', userId: arguments[1]};
            break;
        case "deletebook":
            setdata = {TypeProcesses: 'deletebook', bookId: arguments[1]};
            break;
        case "deletemedia":
            setdata = {TypeProcesses: 'deletemedia',mediaId: arguments[1]};
            break;
            case "deleteproduct":
            setdata = {TypeProcesses: 'deleteproduct',productId: arguments[1]};
            break;
            case "deleteInvoices":

            setdata = {TypeProcesses: 'deleteInvoices',InvoicesId: arguments[1]};

            break;

        case "deletecategory":


            setdata = {TypeProcesses: 'deletecategory', categoryid: arguments[1]};
            break;
            //start khalid [000001-7-9-2016]
        case "deletecategorystory":
            setdata = {TypeProcesses: 'deletecategorystory', categoryid: arguments[1]};
            break;
        case "deletedepartment":
            setdata = {TypeProcesses: 'deletedepartment', categoryid: arguments[1]};
            break;
        case "createuser":
        case "updateuser":
        case "updatebook":
        case "updatemedia":
            case "updateproduct":
       case "updateproducts":
        case "updatequiz":
        case "createbook":
        case "createcategory":
        case "createdepartment":
        case "createbrand":

        case "createcategorystories":
        case "updatedepartments":
        case "updatecategory":
            case "updatebrand":

        case "login":
        case "deletepage":
        case "deletequistion":
        case "sortpages":


        case "sortstorypages":




        case "sortquistion":
        case "updateinvoice":
            setdata = arguments[1];
            break;
    }
    showLoading();
    $.ajax({
        url: "ajax/function.php",
        type: "POST",
        data: setdata,
        cache: false,
        dataType: 'html',
        casetype: casetype,
        par1: par1,
        success: function (html) {
            hideLoading();
            //console.clear();
            console.log("html",html);
            switch (casetype) {
                case "login":
                    if (html == 3) {
                        window.location = 'warehouse.php';
                    }else if(html == 4){
                        window.location = 'shippingwarehouse.php';
                    }else if(html >-1 && html<7){
                        window.location = 'index.php';
                    }else{
                        //console.log("aaa="+html);
                        swal(window.Lang['SignInError'],window.Lang['SignInErrorMsg'],'error');
                    }
                    break;
                case "deleteuser":
                    $("#useridd_" + par1).remove();
                    break;
                case "deletecategory":
                case "deletecategorystory":
                    case "deletedepartment":
                    $("#categoryidd_" + par1).remove();
                    break;
                case "deletebook":
                case "deletemedia":
                case "deleteproduct":
                case "deleteInvoices":
                case "deletepage":
                case "deletequistion":
                case "sortpages":
                //start khalid [000001-7-9-2016]
                case "sortstorypages":
                //end khalid [000001-7-9-2016]
                case "sortquistion":
                case "updateinvoice":
                 window.location=window.location;
                    break;
                case "updateuser":

                     if (html == 1) {
                        swal(window.Lang['Modifiedsuccessfully']);
                    } else {
                         swal(window.Lang['Usernamealreadyexists']);
                    }
                    break;
                case "updatebook":
                case "updatemedia":

                case "updatecategory":
                case "updatequiz":
                    if (html == 1) {
                        swal(window.Lang['Modifiedsuccessfully']);

                    }
                    break;
                case "createbook":

                    arr=html.split("#manhal#seperator#");
                    if (arr[0] == 1) {
                        $("#screenshots_form").attr("action","ajax/platform.php?process=screenshots&bookid="+arr[1]);
                        $("#screenshots_form").submit();

                        swal(window.Lang['Thebookcreatedsuccessfully']);
                        $("#book_id").val('');
                         $("#book_name").val('');
                         $("#book_width").val('');
                        $("#book_height").val('');
                    }
                    break;
                case "createcategory":
                case "createcategorystories":
                 case "createdepartment":
                     case "createbrand":

                    if (html == 1) {
                        swal(window.Lang['Thecategorycreatedsuccessfully']);
                        $("#categoryname_ar").val('');
                        $("#categoryname_en").val('');
                    }else if(html == 2){
                        swal(window.Lang['Categorynamealreadyexists']);
                    }
                    break;


                case "createuser":
                    if (html == 0) {
                    } else if (html == 1) {
                        swal(window.Lang['Usernamealreadyexists']);
                    } else {
                        $("#maintabel").append(html);
                        swal(window.Lang['TheuserwascreatedsuccessfullyThe']);
                    }
                    break;
            }
        }
    });
}

//HIA Hussam Update
$(document).ready(function(){
    $(".jq")

    $("#update_story_page_sort").click(function(){
        showLoading();
        pages={};
        i=0;
        $(".display-table-row").each(function(){
            i++;
            pages[$(this).attr("data-id")]=i;
        });
        $.ajax({
            url: "ajax/editor.php?process=updatestorypagesort",
            type: "POST",
            cache: false,
            dataType: 'html',
            data:{"pages":JSON.stringify(pages)},
            success: function (html) {
                if(html==1){
                    hideLoading();
                }else{
                    //console.log("html=",html);
                    swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                }
            }
        });
    });
    $(".jq_publishstory").click(function(){
        showLoading();
        a=$(this);
        $.ajax({
            url: a.attr("data-href"),
            type: "POST",
            cache: false,
            dataType: 'html',
            success: function (html) {
                if(html==1){
                    hideLoading();
                }else{
                    //console.log("html=",html);
                    swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                }
            }
        });
    });
    $(".jq_publishseries").click(function(){
        showLoading();
        a=$(this);
        $.ajax({
            url: a.attr("data-href"),
            type: "POST",
            cache: false,
            dataType: 'html',
            success: function (html) {
                hideLoading();
                if(html==1){
                   // window.location.href=a.attr("data-download");
                }else{
                    //console.log("html=",html);
                    swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                }
            }
        });
    });
    //$("#sound_aligner").click(function(){
    //    $("#viewquistion_container").load("waveSurf/index.php");
    //    $('#popup').show();
    //});
    $("#update_story_page").click(function(){
        showLoading();
        var msg="";
        if($("#text").val().trim()==""){
            msg+=window.Lang.PleaseInsertText;
        }

        if(msg==""){
            $("#editstorypage").submit();
            var data={
                seriesid:$("#seriesid").val(),
                storyid:$("#storyid").val(),
                pageid:$("#pageid").val(),
                text:$("#text").val(),
                thumbnail:$("#page_thumb").attr("src"),
                jsontext:''
            };
            $.ajax({
                url: "ajax/editor.php?process=updatestorypage",
                type: "POST",
                cache: false,
                data:data,
                dataType: 'html',
                success: function (html) {
                    ///console.log("html=",html);
                    hideLoading();
                    if(html==1){

                    }else{
                        swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                    }
                }
            });

            $("#series_form").submit();
        }else{
            swal(window.Lang['Error'],msg,'error');
        }
    });


    $(".submit_form").on("change",function(){

        $(this).closest("form").submit();
    });


//first khalid [000001-7-9-2016]
    $("#update_pagestory").click(function(){
        showLoading();

        var data={
            pageid:$("#pageid").val(),
            idstory:$("#idstory").val(),
            seriesid:$("#seriesid").val(),
            text:$("#description").val(),
            sound:"../platform/stories/"+$("#seriesid").val()+"/story/"+$("#idstory").val()+"/sound/"+$("#pageid").val()+'.mp3',
            image:"../platform/stories/"+$("#seriesid").val()+"/story/"+$("#idstory").val()+"/images/"+$("#pageid").val()+'.jpg',
        };
        $.ajax({
            url: "ajax/editor.php?process=updatepagestory",
            type: "POST",
            cache: false,
            data:data,
            dataType: 'html',
            success: function (html) {
                hideLoading();
                if(html==1){

                }else{

                    swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                }
            }
        });
        $("#pagestory_form").submit();
    });


    $("#update_game_editor").click(function(){
        showLoading();
        if($("#ispublished").prop("checked")){
            isPublished=1;
        }else{
            isPublished=0;
        }
            var data={
                gameid:$("#game_id").val(),
                title_ar:$("#title_ar").val(),
                title_en:$("#title_en").val(),
                game_age:$("#game_age").val(),
                price:$("#game_price").val(),
                category:$("#category").val(),
                editor:$("#gametype").val(),
                language:$("#language").val(),
                refbook:$("#book").val(),
                descriptionar:$("#descriptionar").val(),
                descriptionen:$("#descriptionen").val(),
                thumb:$("#thumb_img").attr("src"),
                largethumb:$("#image_larg_img").attr("src"),
                Coloring_image:$("#Coloring_img").attr("src"),
                ispublished:isPublished
            };
            $.ajax({
                url: "ajax/editor.php?process=updategame&gameid="+$("#game_id").val(),
                type: "POST",
                cache: false,
                data:data,
                dataType: 'html',
                success: function (html) {
                    console.log(html);
                    hideLoading();
                    if(html!=1){
                        //console.log("html",html);
                        swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                    }
                }
            });

            $("#screenshots_form").submit();

    });
    $("#update_platlist").click(function(){
        showLoading();
        if($("#ispublished").prop("checked")){
            isPublished=1;
        }else{
            isPublished=0;
        }
            var data={
                id:$("#playlist_id").val(),
                title_ar:$("#title_ar").val(),
                title_en:$("#title_en").val(),
                playlist_age:$("#playlist_age").val(),
                price:$("#playlist_price").val(),
                category:$("#category").val(),
                type:$("#type").val(),
                language:$("#language").val(),
                descriptionar:$("#descriptionar").val(),
                descriptionen:$("#descriptionen").val(),
                thumb:$("#thumb_img").attr("src"),
                largethumb:$("#image_larg_img").attr("src"),
                ispublished:isPublished
            };
            $.ajax({
                url: "ajax/editor.php?process=updateplaylist&id="+$("#playlist_id").val(),
                type: "POST",
                cache: false,
                data:data,
                dataType: 'html',
                success: function (html) {
                    console.log(html);
                    hideLoading();
                    if(html!=1){
                        //console.log("html",html);
                        swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                    }
                }
            });
    });

    $("#update_story").click(function(){
        showLoading();

        var msg="";
        if($("#title").val().trim()==""){
            msg+=window.Lang.PleaseInsertTitle;
        }
        btype=0;
        valpackage=0;
        if($("#package")[0].checked){
            valpackage=1;
        }
        if($("#paper")[0].checked){
            btype+=1;
        }
        if($("#estory")[0].checked){
            btype+=2;
        }
        if($("#interactive")[0].checked){
            btype+=4;
        }
        if($("#ispublished").prop("checked")){
            isPublished=1;
        }else{
            isPublished=0;
        }
        if($("#Store").prop("checked")){
            store=1;
        }else{
            store=0;
        }

        if(msg==""){
            var data={
                storyid:$("#story_id").val(),
                package:valpackage,
                oldseriesid:$("#series_id").val(),
                title:$("#title").val(),
                front_cover:$("#book_cover_img").attr("src"),
                language:$("#language").val(),
                category:$("#category").val(),
                descriptionar:$("#descriptionar").html(),
                descriptionen:$("#descriptionen").html (),
                seodescription_en:$("#seodescription_en").val(),
                seodescription_ar:$("#seodescription_ar").val(),
                awidth:$("#actual_width").val(),
                aheight:$("#actual_height").val(),
                weight:$("#story_weight").val(),
                author_en:$("#story_author_en").val(),
                author_ar:$("#story_author_ar").val(),
                isbn:$("#story_isbn").val(),
                binding:$("#book_binding").val(),
                age:$("#book_age").val(),
                year:$("#publish_year").val(),

                price:$("#book_price").val(),
                oldprice:$("#oldbook_price").val(),

                iprice:$("#book_iprice").val(),
                eprice:$("#book_eprice").val(),
                parenttext:$("#parenttext").val(),
                kidstext:$("#kidstext").val(),
                story_register:$("#story_register").val(),
                story_pagescount:$("#story_pagescount").val(),
                firstpage:$("#firstpage").val(),
                lastpage:$("#lastpage").val(),
                back_cover:$("#back_cover_img").attr("src"),
                demo_cover:$("#demo_cover_img").attr("src"),
                booktype:btype,
                seriesid:$("#series").val(),
                publisher:$("#Publishers").val(),
                store:store,
                ispublished:isPublished
            };
            if(data["story_register"]=="" || data["story_register"]==undefined){
                data["story_register"]=0;
            }
            $.ajax({
                url: "ajax/editor.php?process=updatestory&storyid="+$("#story_id").val()+"&seriesid="+$("#series").val(),
                type: "POST",
                cache: false,
                data:data,
                dataType: 'html',
                success: function (html) {
                    //console.log(html);
                    if(html==1){
                        $("#series_id").val($("#series").val());
                    }else{
                        hideLoading();
                        swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                    }
                }
            });

            $("#screenshots_form").submit();
        }else{
            hideLoading();
            swal(window.Lang['Error'],msg,'error');
        }
    });
    $("#update_series").click(function(){
        showLoading();
        var msg="";
        if($("#title").val().trim()==""){
            msg+=window.Lang.PleaseInsertTitle;
        }
        if(msg==""){
            var data={
                seriesid:$("#seriesid").val(),
                title:$("#title").val(),
                thumbnail:$("#book_cover_img").attr("src"),
                category:$("#category").val(),
                description:$("#description").val(),
                advice:$("#parenttext").val(),
            };
            $.ajax({
                url: "ajax/editor.php?process=updateseries&seriesid="+$("#seriesid").val(),
                type: "POST",
                cache: false,
                data:data,
                dataType: 'html',
                success: function (html) {
                    //console.log(html);
                    if(html==1){

                    }else{
                        swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                    }
                }
            });

            $("#series_form").submit();
        }else{
            swal(window.Lang['Error'],msg,'error');
        }
    });

    $(".popup-container").mouseenter(function () {
        popupMouseMain = 1;
    });
    $(".popup-container").mouseleave(function () {
        popupMouseMain = 0;
    });
    $(".popup-main-container").click(function () {
        if (popupMouseMain == 0) {
            $("#viewquistion_container").html("");
            $("#popup").fadeOut();


        }
    });
    $(".close").click(function () {
        document.body.onmousemove =null;
        document.body.ontouchmove =null;
        document.body.ontouchend =null;
        document.body.onmouseup =null;
        $("#viewquistion_container").html("");
        $("#popup").fadeOut();
    });


    $(".deletestory").click(function(){
        a=$(this);
        storyid=$(this).attr("storyid");
        seriesid=$(this).attr("seriesid");
        swal({
            title: window.Lang['Youwillnotbeabletorecoverthisstory'],
            text: window.Lang['Youwillnotbeabletorecoverthisuser'],
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: window.Lang['Yesdeleteit'],
            cancelButtonText: window.Lang['Nocancel'],
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url: "ajax/editor.php?process=deletestory&storyid="+storyid+"&seriesid="+seriesid,
                    type: "POST",
                    cache: false,
                    dataType: 'html',
                    success: function (html) {
                        //console.log(html);
                        if(html==1){
                            a.closest(".display-table-row").remove();
                        }else{
                            swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                        }
                    }
                });
            }
        });

    });
    $(".deletegame").click(function(){
        a=$(this);
        gameid=$(this).attr("gameid");
        swal({
            title: window.Lang['Youwillnotbeabletorecoverthisstory'],
            text: window.Lang['Youwillnotbeabletorecoverthisuser'],
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: window.Lang['Yesdeleteit'],
            cancelButtonText: window.Lang['Nocancel'],
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url: "ajax/editor.php?process=deletegame&gameid="+gameid,
                    type: "POST",
                    cache: false,
                    dataType: 'html',
                    success: function (html) {
                        //console.log(html);
                        if(html==1){
                            a.closest(".display-table-row").remove();
                        }else{
                            swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                        }
                    }
                });
            }
        });

    });
    $(".delete_story_page").click(function(){
        a=$(this);
        pageid=$(this).attr("pageid");
        storyid=$(this).attr("storyid");
        seriesid=$(this).attr("seriesid");
        swal({
            title: window.Lang['Youwillnotbeabletorecoverthispage'],
            text: window.Lang['Youwillnotbeabletorecoverthisuser'],
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: window.Lang['Yesdeleteit'],
            cancelButtonText: window.Lang['Nocancel'],
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "ajax/editor.php?process=deletestorypage&storyid="+storyid+"&seriesid="+seriesid+"&pageid="+pageid ,
                    type: "POST",
                    cache: false,
                    dataType: 'html',
                    success: function (html) {
                        //console.log(html);
                        if(html==1){
                            a.closest(".display-table-row").remove();
                        }else{
                            swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                        }
                    }
                });
            }
        });
    });
    $(".deleteseries").click(function(){
        a=$(this);
        seriesid=$(this).attr("seriesid");
        swal({
            title: window.Lang['Youwillnotbeabletorecoverthisseries'],
            text: window.Lang['Youwillnotbeabletorecoverthisuser'],
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: window.Lang['Yesdeleteit'],
            cancelButtonText: window.Lang['Nocancel'],
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url: "ajax/editor.php?process=deleteseries&seriesid="+seriesid,
                    type: "POST",
                    cache: false,
                    dataType: 'html',
                    success: function (html) {
                        //console.log(html);
                        if(html==1){
                            a.closest(".display-table-row").remove();
                        }else{
                            swal(window.Lang['error'],window.Lang['donthavepermession'],'error');
                        }
                    }
                });
            }
        });

    });
    $(".publish").click(function(){
        bookid=$(this).attr("bookid");
        $.ajax({
            url: "ajax/editor.php?process=publish&bookid="+bookid,
            type: "POST",
            cache: false,
            dataType: 'html',
            success: function (html) {
                //console.log("html",html);
                swal(window.Lang['bookPublished']);
            }
        });
    });
    $(".download").click(function(){
        bookid=$(this).attr("bookid");
        $.ajax({
            url: "ajax/editor.php?process=publish&bookid="+bookid,
            type: "POST",
            cache: false,
            dataType: 'html',
            success: function (html) {
               window.location.href="ajax/download.php?bookId="+bookid;
            }
        });
    });
    $(".download_story").click(function(){
        storyid=$(this).attr("storyid");
        $.ajax({
            url: "ajax/editor.php?process=publish&storyid="+storyid,
            type: "POST",
            cache: false,
            dataType: 'html',
            success: function (html) {
                window.location.href="ajax/download.php?bookId="+bookid;
            }
        });
    });

    $("#save_new_quiz").click(function(){
        var object_aar=[$("#quiz_title"),$("#quiz_Introduction"),$("#quiz_passing_rate"),$("#question_Passed"),$("#question_Failed"),$("#quiz_Pass"),$("#quiz_Failed")]
        for (var a in object_aar){
            //console.log(object_aar[a].val())
            if(object_aar[a].val()=='' || object_aar[a].val()==null){
                swal(window.Lang['error'],window.Lang['Youmustfillinallfields'],'error');
                return;
            }
        }




        $.ajax({
            url: "ajax/editor.php?process=savenewquiz",
            type: "POST",
            data:$("#editquiz").serialize(),
            cache: false,
            dataType: 'html',
            success: function (html) {
               // alert(html);
                if(html==1){
                    window.location.href="quiz.php";
                }else{
                    swal(window.Lang['error'],window.Lang['Youmustfillinallfields'],'error');
                }
            }
        });
    });

    $(".books-container").on("change","#Category",function(){
        searchBook();
    });
    $(".books-container").on("change","#Category_b",function(){
        searchBookb();
    });


    $(".books-container").on("change","#Category_media",function(){
        searchmedia();
    });

    $(".books-container").on("change","#Category_quiz",function(){
        searchQuiz();
    });
    $(".books-container").on("change","#shippingCompany",function(){
        searchwaerhouse();
    });
    $(".books-container").on("change","#warehouseStatus",function(){
        searchwaerhouse();
    });
    $(".books-container").on("change","#shippingwarehouseCompany",function(){
        searchshippingwarehouse();
    });
    $(".books-container").on("change","#shippingwarehouseStatus",function(){
        searchshippingwarehouse();
    });


});

function deletequiz(quizid){


    swal({
        title: window.Lang['AreyousureDeleteQuiz'],
        text: window.Lang['Youwillnotbeabletorecoverthisuser'],
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: window.Lang['Yesdeleteit'],
        cancelButtonText: window.Lang['Nocancel'],
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: "ajax/editor.php?process=deletequiz&quizid="+quizid,
                type: "POST",
                cache: false,
                dataType: 'html',
                success: function (html) {
                    if(html==1){
                        $("#quizidd_"+quizid).remove();
                    }else if(html==0){
                        swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                    }else{
                        swal(window.Lang['error'],html,'error');
                    }
                }
            });
        }
    });




}

function deletequistion(quizid,questionid){
    swal({
        title: window.Lang['AreyousureDeleteQuestion'],
        text: window.Lang['Youwillnotbeabletorecoverthisuser'],
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: window.Lang['Yesdeleteit'],
        cancelButtonText: window.Lang['Nocancel'],
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: "ajax/editor.php?process=deletequistion&quizid="+quizid+"&questionid="+questionid,
                type: "POST",
                cache: false,
                dataType: 'html',
                success: function (html){
                    if(html==1){
                        $("#quizidd_"+quizid).remove();

                        window.location.reload();


                    }else{
                        swal(window.Lang['error'],window.Lang['UnexpectedError'],'error');
                    }
                }
            });
        }
    });

}

function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function viewquiz(){
    $("#viewquistion_container").load("quistionview.php?id="+arguments[0]+"&qid="+arguments[1]);
    $('#popup').show();
}

function savesortquistion(Quizid){
    var arry=[];
    $("#sortable li").each(function( index ) {
        arry.push($(this).attr('sort'))
    });

    var data={
        Quizid:Quizid,
        quistions:arry,
        TypeProcesses:'sortquistion'
    };
    setdatafunction('sortquistion',data);

}

function publishquiz(quizid){
    $.ajax({
        url: "ajax/editor.php?process=publishquiz&quizid="+quizid,
        type: "POST",
        cache: false,
        dataType: 'html',
        success: function (html) {
            //window.location.href="ajax/download.php?bookId="+bookid;
        }
    });
}
function readImg(input,img) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#"+img).attr('src',e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}