/**
 * Created by Dar Al-manhal - Hussam Abu khadijeh on 5/24/2016.
 */


window.Lang=new Array();
window.SITE_URL="https://www.manhal.com/";
//window.SITE_URL="http://localhost/Manhal/";
window.Freez=false;

//$.ajax({
//    url: window.SITE_URL+"language/getVariable.php",
//    type: "POST",
//    cache: false,
//    dataType:'html',
//    async:false,
//    success: function(html) {
//        window.Lang=JSON.parse(html);
//    }
//});
function hidePopLoader(){
    setTimeout(function(){
        hideloader()
    },2000);
}
function viewMedia(id){
    showloader();
    var setdata={process: 'ViewMediaFullscreen', id: id};
    $.ajax({
        url: SITE_URL+"platform/ajax/platform.php",
        type: "GET",
        data:setdata,
        cache: false,
        dataType: 'json',
        success: function (html) {
            console.log("result",html);
            hideloader();
            if(html.href==0 || html==''){
                $(".Game-play-iframe").attr("src",'');
            }else{
                if(html.newtab==1){
                    window.open(html.href, '_blank');
                }else{
                    $(".Game-play-iframe").attr("src",html.href);
                }
            }
        }
    });
}
function getCreditCardType(accountNumber){
    //start without knowing the credit card type
    var result = "unknown";

    //first check for MasterCard
    if (/^5[1-5]/.test(accountNumber))
    {
        result = "MASTERCARD";
    } else if (/^4/.test(accountNumber)) {
        result = "VISA";
    } else if (/^3[47]/.test(accountNumber)){
        result = "AMEX";
    }else{
        result="false";
    }
    return result;
}

function checkOut(){
    showloader();
    data={};
    data["weight"]=window.productsWeight;
    data["contents"]="docs";
    data["tax"]=window.TaxValue;
    data["pieces"]=window.pieces;
    data["total"]=window.total;
    data["GrandTotal"]=window.GrandTotal;
    data["Shipping"]=window.Shipping;
    data["cod"]=window.cod;
    data["cart_country_code"]=$("#cart_country option:selected").attr("id").replace("aramex_country_","");
    data["cart_fullname"]=$("#cart_fullname").val();
    data["cart_email"]=$("#cart_email").val();
    data["cart_phone"]=$("#cart_phone").val();
    data["cart_mobile"]=$("#cart_mobile").val();
    data["cart_country"]=$("#cart_country").val();
    data["cart_city"]=$("#cart_city").val();
    data["cart_state"]=$("#state").val();
    data["cart_post"]=$("#post").val();
    data["cart_address1"]=$("#cart_address1").val();
    data["cart_address2"]=$("#cart_address2").val();
    if($("#donate").prop("checked")){
        data["donate"]=1;
    }else{
        data["donate"]=0;
    }
    if($("#ship_same_address").prop("checked")){
        data["shipping_country_code"]=$("#cart_country option:selected").attr("id").replace("aramex_country_","");
        data["shipping_fullname"]=$("#cart_fullname").val();
        data["shipping_email"]=$("#cart_email").val();
        data["shipping_phone"]=$("#cart_phone").val();
        data["shipping_mobile"]=$("#cart_mobile").val();
        data["shipping_country"]=$("#cart_country").val();
        data["shipping_city"]=$("#cart_city").val();
        data["shipping_state"]=$("#state").val();
        data["shipping_post"]=$("#post").val();
        data["shipping_address1"]=$("#cart_address1").val();
        data["shipping_address2"]=$("#cart_address2").val();
    }else{
        data["shipping_country_code"]=$("#shipping_country option:selected").attr("id").replace("aramex_country_","");
        data["shipping_fullname"]=$("#shipping_fullname").val();
        data["shipping_email"]=$("#shipping_email").val();
        data["shipping_phone"]=$("#shipping_phone").val();
        data["shipping_mobile"]=$("#shipping_mobile").val();
        data["shipping_fax"]=$("#shipping_fax").val();
        data["shipping_country"]=$("#shipping_country").val();
        data["shipping_city"]=$("#shipping_city").val();
        data["shipping_state"]=$("#shipping_state").val();
        data["shipping_post"]=$("#shipping_post").val();
        data["shipping_address1"]=$("#shipping_address1").val();
        data["shipping_address2"]=$("#shipping_address2").val();
    }


    data["shipping"]=window.Shipping;
    data["grand_total"]=window.GrandTotal;
    data["items"]=collectItems();

    if($("#cart_paymentmethod_credit").prop("checked")){
        data["device_fingerprint"]=$("#device_fingerprint").val();
        data["payment_option"]=getCreditCardType($("#card_number").val());

        if(data["payment_option"]=="false"){
            hideloader();
            Lobibox.notify('error', {
                title: window.Lang.WrongInfo,
                msg: window.Lang.InvalidCreditCard
            });
            $("#card_number").focus();
            return false;
        }else if(!checkCreditCard($("#card_number").val(),data["payment_option"])){
            hideloader();
            Lobibox.notify('error', {
                title: window.Lang.WrongInfo,
                msg: window.Lang.InvalidCreditCard
            });
            $("#card_number").focus();
            return false;
        }


        if(!$("#cart_cvv").val().match(/^[0-9]{3,4}$/)){
            hideloader();
            Lobibox.notify('error', {
                title: window.Lang.WrongInfo,
                msg: window.Lang.InvalidSecurityCode
            });
            $("#cart_cvv").focus();
            return false;
        }


        $("#paymentmethod").val("creditcard");
        console.log("begin",data);
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=payfort_tokenization",
            type: "POST",
            cache: false,
            data:{"data":JSON.stringify(data)},
            dataType:'json',
            success: function(jsonData){
                console.log("aaa",jsonData);
                $("#service_command").val(jsonData.service_command);
                $("#access_code").val(jsonData.access_code);
                $("#merchant_identifier").val(jsonData.merchant_identifier);
                $("#merchant_reference").val(jsonData.merchant_reference);
                $("#language").val(jsonData.language);
                $("#signature").val(jsonData.signature);
                $("#expiry_date").val(String($("#cart_exp_year").val())+String($("#cart_exp_month").val()));
                $("#token_name").val(jsonData.token_name);
                $("#return_url").val(jsonData.return_url);
                $("#card_form").submit();
            }
        });
    }else if($("#cart_paymentmethod_paypal").prop("checked")){
        $("#paymentmethod").val("paypal");
        data["payment_option"]="paypal";
        $("#cart_data").val(JSON.stringify(data));
        $("#cart_form").submit();
    }else if($("#cart_paymentmethod_CashOnDelivery").prop("checked")){
        $("#paymentmethod").val("cod");
        data["payment_option"]="cod";
        $("#cart_data").val(JSON.stringify(data));
        $("#cart_form").submit();
    }
}
function collectItems(){
    $("#cart_weight").val(window.productsWeight);
    $("#cart_country_val").val($("#cart_country option:selected").text());
    if($("#cart_country option:selected").attr("id") !=undefined){
        $("#country_code").val($("#cart_country option:selected").attr("id").replace("aramex_country_",""));
    }
    items = {};
    items["book"] = {};
    items["toy"] = {};
    items["story"] = {};
    items["worksheet"] = {};
    items["audio"] = {};
    items["video"] = {};
    items["game"] = {};
    items["interactive-worksheet"] = {};
    items["lesson"] = {};

    $(".cart_row").each(function (){
        items[$(this).attr("data-type")][$(this).attr("data-id")]={};
        items[$(this).attr("data-type")][$(this).attr("data-id")]["qty"] = $(this).find(".book_qty").val();
        type = 1;
        // if ($(this).find("input[data-type='paper']").prop("checked")) {
        //     type += 1;
        // }
        if ($(this).find("input[data-type='electronic']").prop("checked")) {
            type += 2;
        }
        if ($(this).find("input[data-type='enrichment']").prop("checked")) {
            type += 4;
        }

        items[$(this).attr("data-type")][$(this).attr("data-id")]["type"] = type;
    });
    return JSON.stringify(items);
}

function calcShippingPrice(weight){//Needed
    if($("#cart_paymentmethod_CashOnDelivery").prop("checked") || $('option:selected', $("#cart_country")[0]).attr('id').replace("aramex_country_","")=="JO"){
        type="aramex";
    }else{
        type="DHL";
    }
    data={};
    if($("#ship_same_address").prop("checked")){
        dest_city=$("#cart_city").val();
        dest_country=$('option:selected', $("#cart_country")[0]).attr('id').replace("aramex_country_","");
        post=$("#post").val();
        state=$("#state").val();
    }else{
        dest_city=$("#shipping_city").val();
        dest_country=$('option:selected', $("#shipping_country")[0]).attr('id').replace("aramex_country_","");
        post=$("#shipping_post").val();
        state=$("#shipping_state").val();
    }

    data["pieces"]=window.pieces;
    data["dest_city"]=dest_city;
    data["dest_country"]=dest_country;
    data["post"]=post;
    data["state"]=state;
    data["total_price"]=window.total;

    if($("#cart_paymentmethod_CashOnDelivery").prop("checked")){
        data["is_cod"]=1;
    }else{
        data["is_cod"]=0;
    }

    if($("#donate").prop("checked")){
        data["donate"]=1;
    }else{
        data["donate"]=0;
    }

    //console.log("ddd", data);
    $.ajax({
        url: window.SITE_URL+"platform/ajax/platform.php?process=calcShippingPrice&type="+type+"&weight="+weight,
        type: "POST",
        cache: false,
        data:data,
        dataType:'json',
        success: function(jsonData) {
            console.log("hhh",jsonData);
            window.cod=parseFloat((jsonData.cod).toFixed(2));
            window.Shipping=parseFloat((jsonData.shipping).toFixed(2));
            window.TaxValue=parseFloat(((window.Shipping+parseFloat(window.total)+ window.cod)*parseFloat(window.Tax)).toFixed(2));
            window.GrandTotal=parseFloat((parseFloat(window.total)+window.TaxValue+window.Shipping+window.cod+parseFloat(data["donate"])).toFixed(2));
            setTimeout(function(){
                $(".cash_cost").html( window.cod);
                $(".order_shipping").html(window.Shipping);
                $(".cart_grand_total").html(window.GrandTotal);
                $(".cart_tax").html(window.TaxValue);
                hideloader();
            },50);
        }
    });
}

function calcCartTotalPriceT(c){//Needed
        window.total=0;
        window.productsWeight=0;
        window.pieces=0;

        $(".book_qty").each(function(){
            window.total+=parseFloat($(this).val()*$(this).attr("item_price"));
            q=parseInt($(this).val());
            window.productsWeight+=$(this).closest(".cart_row").attr("data-weight")*parseInt(q);
            window.pieces+=q;
        });

        setTimeout(function (){
            window.productsWeight=window.productsWeight/1000;
            window.TaxValue=parseFloat(((parseFloat(window.Shipping)+parseFloat(window.total)+parseFloat(window.cod))*parseFloat(window.Tax)).toFixed(2));
            window.GrandTotal=parseFloat((window.total+window.Shipping+window.TaxValue+window.cod).toFixed(2));
            $(".cart_total_price").html('$'+((window.total).toFixed(2)).toString());
            $(".cart_tax").html(window.TaxValue);

            $(".cart_grand_total").html(window.GrandTotal);
            $(".cart_grand_total1").html((window.total).toFixed(2));
            },150
        );
}
function calcbookPrice(){
    var total=0.0;
    if($("#typeBook").prop("checked")){
        total=parseFloat($("#typeBook").attr("price"));
    }

     if($("#typeInteractive").prop("checked")){
        total+=parseFloat($("#typeInteractive").attr("price"));
     }
     console.log(total);

     $("#grand_price").html(parseFloat(total*parseInt($("#book_quantity").val())).toFixed(2));
}
downloadTeacher="pdf";
$(document).ready(function(){
    $("#donate").change(function () {
        setTimeout(function () {
            if($("#donate").prop("checked")){
                $(".cart_grand_total").html(parseFloat($(".cart_grand_total").html())+1);
            }else{
                $(".cart_grand_total").html(parseFloat($(".cart_grand_total").html())-1);
            }
        },2);

    });

    $("#book_quantity").on("change",function () {
       if($(this).val()<$(this).attr("default-val"))
       {
           $(this).val($(this).attr("default-val"));
       }
        calcbookPrice();
    });

    $('.regular1').on('swipe', function (event) {
        $(event.target).addClass("stop-href");
    });
    $('.regular1').on('afterChange', function (event) {
        $(event.target).removeClass("stop-href");
    });
    $(".jq_viewplaylist").click(function(){
        if ($('.regular1').hasClass('stop-href'))return;
        if($(this).hasClass("jq_subscribe")){
            window.location.href=SITE_URL+window.Lang.Lang+"/subscribe";
        }else{

            launchFullscreen();
            playlisthref=$(this).attr("data-href");
            setTimeout(function () {
                $(".Game-play-iframe").attr("src",playlisthref);
            },70);

            // setTimeout(function () {
            //     $(".lesson-viewer .vertical-slider-viewer").animate({scrollTop: parseInt($(".vertical-slider-viewer ul li.selected").offset().top - 103)});
            // });
        }
    });

    $(".jq_showlms_subscribe").click(function(){
        Lobibox.notify('warning', {
            title: window.Lang.noPermession,
            msg: window.Lang.MustSubscribeAsSchoolLMS
        });
    });

    $(".jq_showlms_contactadmin").click(function(){
        Lobibox.notify('warning', {
            title: window.Lang.LMSNotConfigured,
            msg: window.Lang.ContactAdminToSetLMS
        });
    });
    $("#create-lms").click(function(){
        showloader(1);
        var data={};
        data["title_ar"]=$("#title_ar").val();
        data["title_en"]=$("#title_en").val();
        data["subdomain"]=$("#subdomain").val();
        data["logo"]=$("#default-image").attr("src");
        $.ajax({
            url: window.SITE_URL+"platform/ajax/lms.php?process=creatSchoolLMS",
            type: "POST",
            data:data,
            cache: false,
            dataType:'json',
            success: function(jsonData) {
                hideloader();
                console.log("lms ",jsonData);
                if(jsonData.status==1){
                    Lobibox.notify('success',{
                        title: window.Lang.YourLMSLink,
                        msg: jsonData.url
                    });
                    window.location.href=jsonData.url;
                }else{
                    Lobibox.notify('error', {
                        title: window.Lang.error,
                        msg: jsonData.message
                    });
                }
            }
        });
    });


    $(".jq_deletequiz").click(function(){
        a=$(this);

        Lobibox.confirm({
            title: Lang.DeleteQuiz,
            msg: Lang.AreyousureDeleteQuiz,
            callback: function ($this, type, ev) {
                if(type=="yes"){
                    $.ajax({
                        url: window.SITE_URL+"platform/ajax/platform.php?process=deletequiz",
                        type: "POST",
                        data:{"quizid":a.attr("data-id")},
                        cache: false,
                        dataType:'json',
                        success: function(jsonData) {
                            if(jsonData.result==1){
                                a.closest(".jq_item_container").remove();
                            }else{
                                Lobibox.notify('warning', {
                                    title: window.Lang.error,
                                    msg: jsonData.msg
                                });
                            }
                        }
                    });
                }
            }
        });
    });

    $(".jq_deletestory").click(function(){
        a=$(this);

        Lobibox.confirm({
            title: Lang.DeleteStory,
            msg: Lang.AreyousureDeleteStory,
            callback: function ($this, type, ev) {
                if(type=="yes"){
                    $.ajax({
                        url: window.SITE_URL+"platform/ajax/storyeditor.php?process=deletestory",
                        type: "POST",
                        data:{"storyid":a.attr("data-id")},
                        cache: false,
                        dataType:'json',
                        success: function(jsonData) {
                            if(jsonData.result==1){
                                a.closest(".jq_item_container").remove();
                            }else{
                                Lobibox.notify('warning', {
                                    title: window.Lang.error,
                                    msg: jsonData.msg
                                });
                            }
                        }
                    });
                }
            }
        });
    });

    $(".jq_deletemedia").click(function(){
        a=$(this);

        Lobibox.confirm({
            title: Lang.DeleteMedia,
            msg: Lang.AreyousureDeleteMedia,
            callback: function ($this, type, ev) {
                if(type=="yes"){
                    $.ajax({
                        url: window.SITE_URL+"platform/ajax/template_editor.php?process=deletemedia",
                        type: "POST",
                        data:{"mediaid":a.attr("data-id")},
                        cache: false,
                        dataType:'json',
                        success: function(jsonData) {
                            if(jsonData.result==1){
                                a.closest(".jq_item_container").remove();
                            }else{
                                Lobibox.notify('warning', {
                                    title: window.Lang.error,
                                    msg: jsonData.msg
                                });
                            }
                        }
                    });
                }
            }
        });
    });

    $(".jq_logout").click(function () {
        localStorage.userData="";
    });

    $("#activate_user").click(function(){
        if($("#activation_code").val().trim()==""){
            Lobibox.notify('warning', {
                title: window.Lang.ActivationCode,
                msg: window.Lang.PleaseEnterActCo
            });
            return;
        }
        showloader();
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=activateuser",
            type: "POST",
            data:{"code":$("#activation_code").val().trim()},
            cache: false,
            dataType:'json',
            success: function(jsonData) {
                console.log(jsonData);
                hideloader();
                if(jsonData.result==1){
                    Lobibox.notify('success',{
                        title: window.Lang.Activation,
                        msg: window.Lang.ActivationSuccess
                    });
                    setTimeout(function(){
                        window.location.reload();
                    },3500);
                }else{
                    Lobibox.notify('warning', {
                        title: window.Lang.ActivationCode,
                        msg: jsonData.msg
                    });
                }
            }
        });
    });

    $(document).on("keypress",".error-feild",function(){
        $(this).removeClass("error-feild");
    });
    $(".jq_downloadteacherbook").click(function () {
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=downloadteacherbook",
            type: "POST",
            data:{"bookid":$(".jq_downloadteacherbook").attr('data-id'),"type":downloadTeacher,"code":$("#activation_code").val()},
            cache: false,
            dataType:'html',
            success: function(html) {
                if(html==-1){
                    Lobibox.notify('warning', {
                        title: window.Lang.Login,
                        msg: window.Lang.LoginToDownload
                    });
                    $(".popup-main-container-b").fadeOut();
                    $(".login-btn").click();
                }else if(html==0){
                    Lobibox.notify('warning', {
                        title: window.Lang.error,
                        msg: window.Lang.InvalidActivationCode
                    });
                }else if(html==1){
                    window.location.href=SITE_URL+window.Lang.Lang+"/download?downloadtype=teacherbook&bookid="+$(".jq_downloadteacherbook").attr('data-id')+"&type="+downloadTeacher;
                }else{
                    Lobibox.notify('error',{
                        title: window.Lang.Error,
                        msg: window.Lang.UnexpectedError
                    });
                }
                console.log(html);

            }
        });
    });

    $("#view_buy_now1").click(function(){
        $("#view_buy_now").click();
    });

    $("#download_teacher_bookpdf").click(function(){
        downloadTeacher="pdf";
        $(".popup-main-container-b").fadeIn();
        $(".popup-main-container-b .popup-content").addClass("fadeInDownBig animated1");
    });
    $("#download_teacher_bookexe").click(function(){
        downloadTeacher="exe";
        $(".popup-main-container-b").fadeIn();
        $(".popup-main-container-b .popup-content").addClass("fadeInDownBig animated1");
    });

    $(".jq_close_download").click(function(){
        $(".popup-main-container-b").fadeOut();
    });




    $("#view_buy_now").click(function(){
        a=$(this);
        bookType=0;
        if($("#typeBook").prop("checked")){
            bookType=1;
        }
        if($("#typeEBook").prop("checked")){
            bookType+=2;
        }
        if($("#typeInteractive").prop("checked")){
            bookType+=4;
        }
        if(bookType>0){
            $.ajax({
                url: window.SITE_URL+"platform/ajax/platform.php?process=addtocart&extra=clearall",
                type: "POST",
                data:{"bookid":a.attr('data-id'),"type":a.attr('data-type'),"quantity":$("#book_quantity").val(),"booktype":bookType},
                cache: false,
                dataType:'html',
                success: function(html) {
                    //console.log(html);
                    window.location.href=SITE_URL+window.Lang.Lang+"/check-out";
                }
            });
        }else{
            Lobibox.notify('warning', {
                title: window.Lang.ChoseType,
                msg: window.Lang.PleaseSelectItemType
            });
        }
    });

    $("#buy_now").click(function(){
        $("#cart_weight").val(window.productsWeight);
        $("#cart_country_val").val($("#cart_country option:selected").text());
        if($("#cart_country option:selected").attr("id") !=undefined){
            $("#country_code").val($("#cart_country option:selected").attr("id").replace("aramex_country_",""));
        }

        if($(".order_shipping").first().html()!=0 && $(".order_shipping").first().html()!=""){//need validate shipping info
            msg=validateShipping();
            //console.log("msg=",msg);
            if(msg==""){
                payPal();
            }else{
                Lobibox.notify('warning', {
                    title: window.Lang.Warning,
                    msg: msg
                });
            }
        }else{// no validation needed
            payPal();
        }
    });

    $("#cart_country").on("change",function(){//Needed
        // if($("#cart_country").val()=="Jordan"){
        //     $("#cod_option").show();
        //     setTimeout(function () {
        //         $("#cart_paymentmethod_CashOnDelivery").click();
        //     },100);
        //
        //     $("#dhl_option").hide();
        //     $("#paypal_option").hide();
        // }else{
        //     $("#dhl_option").show();
        //     $("#paypal_option").show();
        //     $("#cart_paymentmethod_credit").click();
        //     $(".credit-card-inner").show();
        // }

        countryCode= $('option:selected', this).attr('id').replace("aramex_country_","");
        if( $('option:selected', this).attr('state_requier')==1){
            $("#state").show();
        }else{
            $("#state").hide();
        }
        if( $('option:selected', this).attr('poste_requier')==1){
            $("#post").show();
        }else{
            $("#post").hide();
        }
        if($('option:selected', this).attr('cod')==1){
            $("#cod_option").show();
        }else{
            $("#cod_option").hide();
            $("#cart_paymentmethod_credit").click();
        }




    });
    $("#shipping_country").on("change",function(){//Needed
        countryCode= $('option:selected', this).attr('id').replace("aramex_country_","");
        if( $('option:selected', this).attr('state_requier')==1){
            $("#shipping_state").show();
        }else{
            $("#shipping_state").hide();
        }
        if( $('option:selected', this).attr('poste_requier')==1){
            $("#shipping_post").show();
        }else{
            $("#shipping_post").hide();
        }
        if($('option:selected', this).attr('cod')==1){
            $("#cod_option").show();
        }else{
            $("#cod_option").hide();
            $("#cart_paymentmethod_credit").click();
        }
    });

    $("#cart_paymentmethod_paypal").click(function(){//Needed
        $("#cart_paymentmethod_credit").prop("checked",false);
        showloader();
        calcShippingPrice(window.productsWeight);
    });
    $("#cart_paymentmethod_CashOnDelivery").click(function(){//Needed
        $("#cart_paymentmethod_credit").prop("checked",false);
        showloader();
        calcShippingPrice(window.productsWeight);
    });

    $("#cart_paymentmethod_credit").click(function () {//Needed
        $("#cart_paymentmethod_CashOnDelivery").prop("checked",false);
        $("#cart_paymentmethod_paypal").prop("checked",false);
        showloader();
        calcShippingPrice(window.productsWeight);
    });

    //$(document).on("click", ".checkout", function (){//Needed
    //    if(window.GrandTotal==0){
    //        Lobibox.notify('warning',{
    //            title: window.Lang.CartIsEmpty,
    //            msg: window.Lang.PleaseSelectItems
    //        });
    //        return false;
    //    }
    //});


    $(".addto-card-fixed-container .cart1").click(function(){
        if(window.Freez){
            return false;
        }
        window.Freez=true;
        type=1;


        if($("#qty-2").val()!==undefined && $("#qty-2").val()!=="undefined" && $("#qty-2").val()!="" && $("#qty-2").val()!=null && parseInt($("#qty-2").val())>1){
            qty=$("#qty-2").val();
        }else{
            qty=1;
        }

        data={
            bookid:$(this).attr("data-id"),
            type:$(this).attr("data-type"),
            booktype:type,
            quantity:qty
        };

        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=addtocart",
            type: "POST",
            cache: false,
            dataType:'html',
            data:data,
            success: function(html) {
                window.Freez=false;
                console.log("cart",html);
                console.log("data",data);
                if(html==1){
                    Lobibox.notify('success',{
                        title: window.Lang.Cart,
                        msg: window.Lang.ItemAddSuccess
                    });
                    //$("#add_to_cart").html(window.Lang.RemoveFromCart);
                    $(".shoppercount").html(parseInt($(".shoppercount").first().html())+1);
                    $(".buy-button").trigger('click');
                }else if(html==0){
                    $("#add_to_cart").html(window.Lang.AddCart);
                    $(".shoppercount").html(parseInt($(".shoppercount").first().html())-1);
                }else{
                    Lobibox.notify('error',{
                        title: window.Lang.Error,
                        msg: window.Lang.UnexpectedError
                    });
                }
                window.Freez=false;
            }
        });
    });

    $("#add_to_cart").click(function(){
        if(window.Freez){
            return false;
        }
        window.Freez=true;
        type=0;
        if($("#typeBook").prop("checked")){
            type=1;
        }
        if($("#typeEBook").prop("checked")){
            type+=2;
        }
        if($("#typeInteractive").prop("checked")){
            type+=4;
        }

        if($("#book_quantity").val()!==undefined && $("#book_quantity").val()!=="undefined" && $("#book_quantity").val()!="" && $("#book_quantity").val()!=null){
            qty=$("#book_quantity").val();
        }else{
            if($("#qty-1").val()!==undefined && $("#qty-1").val()!=="undefined" && $("#qty-1").val()!="" && $("#qty-1").val()!=null){
                qty=$("#qty-1").val();
                type=1;
            }else{
                qty=1;
            }
        }

        data={
            bookid:$(this).attr("data-id"),
            type:$(this).attr("data-type"),
            booktype:type,
            quantity:qty
        };

        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=addtocart",
            type: "POST",
            cache: false,
            dataType:'html',
            data:data,
            success: function(html) {
                console.log("cart",html);
                console.log("data",data);
                if(html==1){
                    Lobibox.notify('success',{
                        title: window.Lang.Cart,
                        msg: window.Lang.ItemAddSuccess
                    });
                    //$("#add_to_cart").html(window.Lang.RemoveFromCart);
                    $(".shoppercount").html(parseInt($(".shoppercount").first().html())+1);
                    $(".buy-button").trigger('click');
                }else if(html==0){
                    $("#add_to_cart").html(window.Lang.AddCart);
                    $(".shoppercount").html(parseInt($(".shoppercount").first().html())-1);
                }else{
                    Lobibox.notify('error',{
                        title: window.Lang.Error,
                        msg: window.Lang.UnexpectedError
                    });
                }
                window.Freez=false;

            }
        });

    });

    $(".jq_addcart_upsell").click(function(){

        if(window.Freez){
            return false;
        }

        window.Freez=true;
        $(".buy-content-container").hide();
        data={
            bookid:$(this).attr("data-id"),
            type:$(this).attr("data-type"),
            booktype:1,
            quantity:1
        };

        a=$(this);
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=addtocart",
            type: "POST",
            cache: false,
            dataType:'html',
            data:data,
            success: function(html) {
                console.log("upsell",html);
                console.log("upsell data",data);
                if(html==1){

                    a.parent().parent().parent().fadeOut();
                    Lobibox.notify('success',{
                        title: window.Lang.Cart,
                        msg: window.Lang.ItemAddSuccess
                    });
                    //$("#add_to_cart").html(window.Lang.RemoveFromCart);
                    $(".shoppercount").html(parseInt($(".shoppercount").first().html())+1);

                    $(".buy-button").trigger('click');
                }else{
                    Lobibox.notify('error',{
                        title: window.Lang.Error,
                        msg: window.Lang.UnexpectedError
                    });
                }
                window.Freez=false;
            }
        });

    });

    $(".show_comment").click(function(){
        $("#comment_tab").trigger("click");
    });
    $(".add_favorite").click(function(){
        a=$(this);
        data={
          TypeProcesses:"settofavorit",
            id: a.attr("data-id"),
            type: a.attr("data-type")
        };
        $.ajax({
            url: window.SITE_URL+"platform/ajax/process.php",
            type: "POST",
            cache: false,
            dataType:'html',
            data:data,
            success: function(html) {
                //console.log("fav",html);
                if(html==-1){
                    Lobibox.notify('error',{
                        title: window.Lang.Error,
                        msg: window.Lang.youMustLogin
                    });
                }else if(html=="deletefavorit"){
                    a.removeClass("active");
                }else if(html=="addfavorit"){
                    a.addClass("active");
                }else{
                    Lobibox.notify('error',{
                        title: window.Lang.Error,
                        msg: window.Lang.UnexpectedError
                    });
                }
            }
        });
    });
    $(document).on("click",".jq_comments_page",function(){
        showloader();
        page=$(this).attr("page");
        type=$(this).closest(".content").attr("data-type");
        id=$(this).closest(".content").attr("data-id");
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=getviewcomment&type="+type+"&page="+page+"&id="+id ,
            type: "POST",
            cache: false,
            dataType:'html',
            async:false,
            success: function(html) {
                data= $.parseJSON(html);
                $(".post-comment-container").html(data[0]);
                $(".pagination-container .paging .content").html(data[1]);
                hideloader();
            }
        });
    });
    $(document).on("click","#addqustionanswer",function(){

        if($("#Qustion").val().trim()==""){
            Lobibox.notify('error',{
                title: window.Lang.Error,
                msg: window.Lang.PLeaseWriteComment
                //delay:900000
            });
        }else{
            showloader();

            type=$(this).attr("data-type");
            id=$(this).attr("data-id");
            $.ajax({
                url: window.SITE_URL+"platform/ajax/platform.php?process=addqustionanswer&id="+id,
                type: "POST",
                cache: false,
                dataType:'html',
                data:{"qustion":$("#Qustion").val()},
                async:false,
                success: function(html) {

                    if(html==0){
                        Lobibox.notify('error',{
                            title: window.Lang.Error,
                            msg: window.Lang.UnexpectedError
                            //delay:900000
                        });
                    }else{
                        window.location= window.location;

                    }

                    hideloader();
                }
            });
        }
    });
    $(document).on("click",".post-setting-btn",function(){
        var id=$(this).attr('id').split('control_').join('');
        var event='none';
       if($('#controlsetting_'+id).css('display')=='none') {
           event='block';
       }
        $('.post-setting-container').css('display','none');
        $('#controlsetting_'+id).css('display',event);
    })
    $(document).on("click","#addqustion",function(){
        if($("#Qustion").val().trim()==""||$("#textariatitle").val().trim()==""){
            Lobibox.notify('error',{
                title: window.Lang.Error,
                msg: window.Lang.PLeaseWriteComment
                //delay:900000
            });
        }else{
            showloader();

            type=$(this).attr("data-type");
            id=$(this).attr("data-id");
            $.ajax({
                url: window.SITE_URL+"platform/ajax/platform.php?process=addqustion&type="+type+"&id="+id,
                type: "POST",
                cache: false,
                dataType:'html',
                data:{"qustion":$("#Qustion").val(),"title":$("#textariatitle").val(),"category":$("#hidden_category_discussions").val(),"page":$("#hidden_page_discussions").val(),"keywords":$("#keywords").val()},
                async:false,
                success: function(html) {

                    if(html==0){
                        Lobibox.notify('error',{
                            title: window.Lang.Error,
                            msg: window.Lang.UnexpectedError
                            //delay:900000
                        });
                    }else{
                        data= $.parseJSON(html);

                        $(".post-comment-container").html(data[0]);
                        $(".pagination-container .paging .content").html(data[1]);
                        $(".jq_comments_count").html("("+data[2]+")");
                        $("#Qustion").val(""); $("#textariatitle").val("");
                        $(".jq_comments_page.last").trigger("click");


                    }

                    hideloader();
                }
            });
        }
    });


    $(document).on("click","#addcomment",function(){
        if($(".textaria").val().trim()==""){
            Lobibox.notify('error',{
                title: window.Lang.Error,
                msg: window.Lang.PLeaseWriteComment
                //delay:900000
            });
        }else{
            showloader();
            type=$(this).attr("data-type");
            id=$(this).attr("data-id");
            $.ajax({
                url: window.SITE_URL+"platform/ajax/platform.php?process=addcomment&type="+type+"&id="+id,
                type: "POST",
                cache: false,
                dataType:'html',
                data:{"comment":$(".textaria").val()},
                async:false,
                success: function(html) {
                    //console.log("data",html);
                    if(html==0){
                        Lobibox.notify('error',{
                            title: window.Lang.Error,
                            msg: window.Lang.UnexpectedError
                            //delay:900000
                        });
                    }else{
                        data= $.parseJSON(html);
                        $(".post-comment-container").html(data[0]);
                        $(".pagination-container .paging .content").html(data[1]);
                        $(".jq_comments_count").html("("+data[2]+")");
                        $(".textaria").val("");
                        $(".jq_comments_page.last").trigger("click");

                    }

                    hideloader();
                }
            });
        }
    });

    $(".jq_cart_type").on("change",function(){
        if($(this).closest("ul").find(".jq_cart_type:disabled").size()>=2){
            $(this).prop("checked",true);
            return false;
        }
        // if($(this).attr("data-type")=="paper"){
        //     p=parseFloat($(this).closest("li").attr("price"))*parseFloat($(this).closest(".cart_row").find(".book_qty").val());
        // }else{
        //     p=parseFloat($(this).closest("li").attr("price"));
        // }
        item_p=parseFloat($(this).closest("li").attr("price"));
        p=item_p*parseFloat($(this).closest(".cart_row").find(".book_qty").val());

        if($(this).prop("checked")==true){
            $(this).closest(".cart_row").find(".carts_row_sum").html((parseFloat($(this).closest(".cart_row").find(".carts_row_sum").html())+p).toFixed(2));
            $(this).closest(".cart_row").find(".row_price").html((parseFloat($(this).closest(".cart_row").find(".row_price").html())+item_p).toFixed(2));
            // if($(this).attr("data-type")=="enrichment"){
            //     if($(this).closest("ul").find(".jq_cart_type[data-type='electronic']").prop("checked")==false){
            //         $(this).closest("ul").find(".jq_cart_type[data-type='electronic']").trigger("click");
            //     }
            // }
        }else{
            $(this).closest(".cart_row").find(".carts_row_sum").html((parseFloat($(this).closest(".cart_row").find(".carts_row_sum").html())-p).toFixed(2));
            $(this).closest(".cart_row").find(".row_price").html((parseFloat($(this).closest(".cart_row").find(".row_price").html())-item_p).toFixed(2));
            // if($(this).attr("data-type")=="electronic"){
            //     if($(this).closest("ul").find(".jq_cart_type[data-type='enrichment']").prop("checked")==true){
            //         $(this).closest("ul").find(".jq_cart_type[data-type='enrichment']").trigger("click");
            //     }
            // }
        }


        calcCartTotalPriceT(false);
    });

    $(".submit_advanced_search").on("click",function(){
        $(this).closest("form").submit();
    });

    $("#shipping").on("change",function(){
        //to do calculate shipping cost
    });
    $("#facebook_Position").click(function () {
        if($("#facebook_continer").attr("loaded")==0){
            $("#facebook_continer").attr("loaded","1");
            $("#facebook_continer").html(' <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdaralmanhalpublishers%2F&tabs=timeline&width=300&height=500&small_header=false&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=1577273975898420" width="300" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>');
        }
    });
    $("#twitter_Position").click(function () {
        if($("#twitter_container").attr("loaded")==0){
            $("#twitter_container").attr("loaded","1");
            $("#twitter_container").html('<a class="twitter-timeline"  href="https://twitter.com/dar_manhal" data-widget-id="739450926948360192">تغريدات بواسطة @dar_manhal</a>'+"<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"+'"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>');
        }
    });
    $("#youtube_Position").click(function () {
        if($("#youtube_container").attr("loaded")==0){
            $("#youtube_container").attr("loaded","1");
            $("#youtube_container").html('<iframe width="500" height="350" src="https://www.youtube.com/embed/tIAsOeh7frc" frameborder="0" allowfullscreen>');
        }
    });

    $("#forget_send").click(function(){
        if($("#forget_email").val().trim()==""){
            Lobibox.notify('error',{
                title: window.Lang.RequiredField,
                msg: window.Lang.PleaseEnterEmailAddress
            });
            return false;
        }
        if(isEmail($("#forget_email").val())){
            showloader();
            $.ajax({
                url: window.SITE_URL+"platform/ajax/platform.php?process=forgetpass",
                data:{"email":$("#forget_email").val()},
                type: "POST",
                cache: false,
                dataType:'html',
                success: function(html){
                    hideloader();
                    //console.log("aa",html);
                    if(html==1) {
                        Lobibox.notify('success',
                            {
                                msg: window.Lang.ForgetSuccess
                            });
                    }else if(html==-1){
                        Lobibox.notify('error',
                            {
                                msg: window.Lang.InvalidEmailaddress
                            });
                    }else{
                        Lobibox.notify('error',
                            {
                                msg: window.Lang.UnexpectedError
                            });
                        console.log(html);
                    }
                }
            });
        }else{
            Lobibox.notify('error',{
                title: window.Lang.WrongEmail,
                msg: window.Lang.WrongEmailMsg
            });
        }


    });
    $("#update_password").click(function(){
        showloader();
        info={
            "old_password":$("#old_password").val(),
            "new_password":$("#new_password").val(),
            "cpassword":$("#cpassword").val()
        };
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=changepassword",
            data:info,
            type: "POST",
            cache: false,
            dataType:'html',
            success: function(html){
                hideloader();
                if(html==1){
                    Lobibox.notify('success',
                        {
                            msg: window.Lang.passwordUpdated
                        });
                }else if(html==-1) {
                    Lobibox.notify('error',
                        {
                            msg: window.Lang.incorrectPassword
                        });
                }else if(html==-2){
                    Lobibox.notify('error',
                        {
                            msg: window.Lang.PasswordNotMatch
                        });
                }
                else{
                    Lobibox.notify('error',
                        {
                            msg: window.Lang.UnexpectedError
                        });
                }
            }
        });
    });
    $("#reset_password").click(function(){
        showloader();
        info={
            "token":$("#token").val(),
            "new_password":$("#new_password").val(),
            "cpassword":$("#cpassword").val()
        };
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=resetpassword",
            data:info,
            type: "POST",
            cache: false,
            dataType:'html',
            success: function(html){
                hideloader();
                if(html==1){
                    Lobibox.notify('success',
                        {
                            msg: window.Lang.passwordResetSuccess
                        });
                    setTimeout(function(){
                        window.location.href=SITE_URL;
                    },2000);
                }else if(html==-1) {
                    Lobibox.notify('error',
                        {
                            msg: window.Lang.CannotPasswordEmpty
                        });
                }else if(html==-2){
                    Lobibox.notify('error',
                        {
                            msg: window.Lang.PasswordNotMatch
                        });
                }
                else{
                    Lobibox.notify('error',
                        {
                            msg: window.Lang.UnexpectedError
                        });
                }
            }
        });
    });
    $("#update_account").click(function(){
        if(!isEmail($("#profile_email").val().trim())){
            Lobibox.notify('error',
                {
                    msg: window.Lang.InvalidEmailAddress
                });
            $("#profile_email").focus();
        }else{
            showloader();
            if($("#image_avatar").attr("updated")==0){
                img="";
            }else{
                img=$("#image_avatar").attr("src");
            }
            console.log("img",img);
            info={
              "fullname":$("#profile_fullname").val().trim(),
              "country":$("#ddlCountry").val().trim(),
              "phone":$("#profile_phone").val().trim(),
              "gender":$("#ddlGender").val().trim(),
              "email":$("#profile_email").val().trim(),
              "address":$("#profile_address").val().trim(),
              "birthdate":$("#profile_birthdate").val().trim(),
              "avatar":img
            };
            $.ajax({
                url: window.SITE_URL+"platform/ajax/platform.php?process=updateprofile",
                data:info,
                type: "POST",
                cache: false,
                dataType:'html',
                success: function(html){
                    hideloader();
                    if(html==1){
                        Lobibox.notify('success',
                            {
                                msg: window.Lang.ProfileUpdated
                            });
                    }else{
                        Lobibox.notify('error',
                            {
                                msg: window.Lang.UnexpectedError
                            });
                    }
                }
            });
        }
    });

    $(".book_qty").on("input",function(){
        if($(this).attr("item_type")=='book' && !$(this).hasClass("store")){
            if(parseInt($(this).val())<parseInt($(this).attr("default-val"))){
                $(this).val($(this).attr("default-val"));
            }
        }else{
            if($(this).val()<1){
                $(this).val(1);
            }
        }


        p=0;
           p=parseFloat($(this).attr("item_price")*$(this).val());
           //$(this).closest(".cart_row").find(".carts_row_sum").html(p.toFixed(2));
        calcCartTotalPriceT(false);
    });

    $(".jq_delete_carts_item").click(function(){
        if(window.Freez){
            return false;
        }
        window.Freez=true;
        a=$(this).closest(".cart_row");
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=deletefromcart",
            data:{"bookid": a.attr("data-id"),"type": a.attr("data-type")},
            type: "POST",
            cache: false,
            dataType:'html',
            success: function(html)
            {
                x=parseInt($(".shoppercount").last().html())-1;
                $(".shoppercount").html(x);
                window.Freez=false;
            }
        });
        a.remove();
        calcCartTotalPriceT(false);
    });

    $(".submit_form").on("change",function(){
        $(this).closest("form").submit();
    });

    $("#subscribe_email").click(function(){
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=sendsubscrimemail",
            data:$("#contact_form").serialize(),
            type: "POST",
            cache: false,
            dataType:'html',
            success: function(html){
                hideloader();
                if(html==1){
                    $("#contact_form")[0].reset();
                    Lobibox.notify('success',
                        {
                            msg: window.Lang.msgsent
                        });
                }else{
                    Lobibox.notify('error',
                        {
                            msg: window.Lang.UnexpectedError
                        });
                }
            }
        });
    });
    ///////send btn///////
    $('.btnsend').on('click',function() {
        showloader();
        msg="";
        if($('#name').val().trim()=='')
        {
            msg=window.Lang.Pleaseenteryourname;
            $('#name').focus();
        }
        if($('#email').val().trim()=='')
        {
            msg+="<br>"+window.Lang.PleaseenteryourEmail;
            $('#email').focus();
        }
        else if(!validateEmail($('#email').val().trim())){
            msg+="<br>"+window.Lang.InvalidEmailaddress;
            $('#email').focus();
        }
        if($('#subject').val().trim()=='')
        {
            msg+="<br>"+window.Lang.PleaseenterSubject;
            $('#subject').focus();
        }
        if($('#message').val().trim()=='')
        {
            msg+="<br>"+window.Lang.Pleaseentermessage;
            $('#message').focus();
        }

        if(msg!=""){
            hideloader();
            Lobibox.notify('warning',
                {
                    msg: msg
                });
        }else{
            $.ajax({
                url: window.SITE_URL+"platform/ajax/platform.php?process=sendContact",
                data:$("#contact_form").serialize(),
                type: "POST",
                cache: false,
                dataType:'html',
                success: function(html){
                    hideloader();
                   if(html==1){
                       $("#contact_form")[0].reset();
                       Lobibox.notify('success',
                           {
                               msg: window.Lang.msgsent
                           });
                   }else{
                       console.log("msg",html);
                       Lobibox.notify('error',
                           {
                               msg: window.Lang.UnexpectedError
                           });
                   }
                }
            });
        }

    });

    $('.feedback-main-container .buttons-container input[type="button"]').on('click',function()
    {
        showloader();
        msg="";
        if($('#feedback_name').val().trim()=='')
        {
            msg=window.Lang.Pleaseenteryourname;
            $('#feedback_name').focus();
        }
        if($('#feedback_email').val().trim()=='')
        {
            msg+="<br>"+window.Lang.PleaseenteryourEmail;
            $('#feedback_email').focus();
        }
        else if(!validateEmail($('#feedback_email').val().trim())){
            msg+="<br>"+window.Lang.InvalidEmailaddress;
            $('#feedback_email').focus();
        }
        if($('#feedback_subject').val().trim()=='')
        {
            msg+="<br>"+window.Lang.PleaseenterSubject;
            $('#feedback_subject').focus();
        }
        if($('#feedback_message').val().trim()=='')
        {
            msg+="<br>"+window.Lang.Pleaseentermessage;
            $('#feedback_message').focus();
        }
        if(msg!="")  {
            hideloader();
            Lobibox.notify('warning',
                {
                    msg: msg
                });
        }else{
            $.ajax({
                url: window.SITE_URL+"platform/ajax/platform.php?process=sendfeedback",
                type: "POST",
                data:{"username":$('#feedback_name').val(),"email":$('#feedback_email').val(),"subject":$('#feedback_subject').val(),"message":$('#feedback_message').val(),"idea":$('#feedback_message').val()},
                cache: false,
                dataType:'html',
                async:false,
                success: function(html) {
                    hideloader();
                    if(html==1){
                        Lobibox.notify('success',
                            {
                                msg: window.Lang["feedbackSent"]
                            });
                    }else{
                        Lobibox.notify('warning',
                            {
                                msg: html
                            });
                    }
                }
            });
        }
    });

    $(document).on("click",".delete_item_cart",function(){

        a=$(this);
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=deletefromcart",
            data:{"bookid": a.attr("bookid"),"type": a.attr("type")},
            type: "POST",
            cache: false,
            dataType:'html',
            success: function(html)
            {
                x=parseInt($(".shoppercount").last().html())-1;
                $(".shoppercount").html(x);
                $(".cart_total_price").html(((parseFloat($(".cart_total_price").html())-parseFloat(a.attr("price"))).toFixed(2)).toString());
                console.log("ASdasd",html);
                a.closest(".item-container").removeClass("fadeInRight").addClass("fadeOutRight");
                setTimeout(function(){
                    a.closest(".item-container").remove();

                },800);

            }
        });
    });
    //setTimeout(function(){
    //    html='<div class="item-container reveal-zoom transition-time">';
    //    html+='<div class="twitter">Twitter</div>';
    //    html+='<a class="twitter-timeline"  href="https://twitter.com/dar_manhal" data-widget-id="739450926948360192">تغريدات بواسطة @dar_manhal</a>';
    //    html+='<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.'+"test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js."+'src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
    //    html+='</div>';
    //    html+='<div class="item-container reveal-zoom transition-time">';
    //    html+='<div class="facebook">Facebook</div>';
    //    html+='<div class="display-block">';
    //    html+='<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdaralmanhalpublishers%2F&tabs=timeline&width=370&height=500&small_header=false&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=1577273975898420" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>';
    //    html+='</div>';
    //    html+='</div>';
    //    html+='<div class="item-container reveal-zoom transition-time">';
    //    html+='<div class="google">Youtube</div>';
    //    html+='<script src="https://apis.google.com/js/platform.js"></script>';
    //    html+='<div class="g-ytsubscribe" data-channelid="UCHQkQ8ZFdArwWFRE8hmQ6Bg" data-layout="full" data-count="default"></div>';
    //    html+='<iframe width="315" height="315" src="https://www.youtube.com/embed/tIAsOeh7frc" frameborder="0" allowfullscreen></iframe>';
    //    html+='</div>';
    //   $("#social_content_container").append(html);
    //},7000);
    $(document).on("click",".buy-button",function(){
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=getcartinfo",
            type: "POST",
            cache: false,
            dataType:'html',
            async:false,
            success: function(html) {
                console.log("asdasdasda",html);
                $(".buy-content-container").html(html);
            }
        });
    });
   // var addToCart = function(type){
   //    alert("a");
    //    a=$(this);
        //$(this).off("click");
        //window.imgtodrag;
        //window.cart;
        //window.dragImg;
        //$.ajax({
        //    url: "platform/ajax/platform.php?process=addtocart",
        //    type: "POST",
        //    data:{"bookid":a.attr('bookid'),"type":type},
        //    cache: false,
        //    dataType:'html',
        //    success: function(html) {
        //        if(html==1){
        //            x=parseInt($(".shoppercount").last().html())+1;
        //            $(".shoppercount").html(x);
        //            $(".notification-a").html(x);
        //            $(".shopperprice").html(parseFloat($(".shopperprice").last().html())+parseFloat(a.attr('price')));
        //            a.html(window.Lang['RemoveFromCart']);
        //            window.cart = $('.movable-header .shop_container');
        //            window.imgtodrag = a.closest(".item-container").find(".libro").first();
        //            window.dragImg= window.imgtodrag;
        //        }else if(html==0){
        //            x=parseInt($(".shoppercount").last().html())-1;
        //            $(".shoppercount").html(x);
        //            $(".notification-a").html(x);
        //            $(".shopperprice").html(parseFloat($(".shopperprice").html())-parseFloat(a.attr('price')));
        //           // a.html(window.Lang['AddToCart']);
        //            window.cart =  a.closest(".item-container").find(".libro").first();
        //            window.imgtodrag =  $('.movable-header .shop_container');
        //            window.dragImg=a.closest(".item-container").find(".libro").first();
        //        }
        //        if (window.imgtodrag)
        //        {
        //            var imgclone = window.dragImg.clone()
        //                .offset({
        //                    top: $(window.imgtodrag).offset().top,
        //                    left: $(window.imgtodrag).offset().left
        //                })
        //                .css({
        //                    'opacity': '0.7',
        //                    'position': 'absolute',
        //                    'width': '222px',
        //                    'height': '252px',
        //                    'z-index': '999',
        //                    'perspective': '100px',
        //                    'perspective-origin': 'right center',
        //                    'transform-style': 'preserve-3d',
        //                    'transform': 'scaleX(0.88) scaleY(0.95) rotateY(-4deg)'
        //                })
        //                .appendTo($('body'))
        //                .animate({
        //                    'top': $(window.cart).offset().top + 12,
        //                    'left': $(window.cart).offset().left + 12,
        //                    'width': 80,
        //                    'height': 100
        //                }, 1000, 'easeInOutExpo');
        //            imgclone.animate({
        //                'width': 0,
        //                'height': 0
        //            }, function () {
        //                $(this).detach()
        //            });
        //        }
        //    }
        //});

  //  };
    $(document).on("click",".worksheet_addtocart ",function(){
        addToCart("worksheet",$(this));
    });
    $(document).on("click",".book_addtocart",function(){
        addToCart("book",$(this));
    });
    $(document).on("click",".toy_addtocart",function(){
        addToCart("toy",$(this));
    });
    $(document).on("click",".story_addtocart",function(){
        addToCart("story",$(this));
    });


    $("#changepass").click(function(){
        changePassword();
    });
    $(document).on("click",".loginbtn",function(){
        signIn();
    });
    $(document).on("click","#reg_submit",function(){
        signUp();
    });
    $(document).on("keypress","#reg_email,#reg_username,#reg_pass,#reg_cpass",function(e){
        var key = e.which;
        if(key == 13)
        {
            signUp();
            return false;
        }
    });
    $(document).on("keypress","#login_email,#login_pass",function(e){
        var key = e.which;
        if(key == 13)
        {
            signIn();
            return false;
        }
    });
    //firstkhalid 4-9-2016

    $(document).on("click","label.msgerrorlogin",function(e){
                Lobibox.notify('error',{
                    title: window.Lang.Error,
                    msg: window.Lang.youMustLogin
                });
    });
    $(document).on("click","input.star",function(e){
        prodect=$(this).attr("prodect");
        bookid=$(this).attr("bookid");
        rate=$(this).attr("rate");
        that=$(this);
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=rate",
            type: "POST",
            data:{"bookid":bookid,"rate":rate,"type":prodect},
            cache: false,
            dataType: 'html',
            success: function (html) {
                if(html!=0){

                    arr=html.split("@manhal@seperator@");
                    console.log(arr)
                    that.removeProp("checked");

                   // start khalid [000002-17-9-2016]
                    that.closest("form").find("input").attr('disabled', 'disabled');
                    // end khalid [000002-17-9-2016]
                    cls= that.closest("form").find("input.star-"+arr[0]).addClass("checked");
                    cls= that.closest(".rating-container").find(".number").html("("+arr[1]+")");
                }
            }
        });
    });

});
//endkhalid 4-9-2016
window.imgtodrag;
window.cart;
window.dragImg;
function addToCart(type,a){
    if(window.Freez){
        return false;
    }
    window.Freez=true;
    q=1;
    if(a.hasClass("store")){
        q=1;
    }
    $(".buy-content-container").removeClass("fade-bottom-buy").removeClass("fade-top-buy").addClass("fade-top-buy");
    $.ajax({
        url: window.SITE_URL+"platform/ajax/platform.php?process=addtocart",
        type: "POST",
        data:{"bookid":a.attr('bookid'),"type":type,"quantity":q,"booktype": a.attr("booktype")},
        cache: false,
        dataType:'html',
        success: function(html) {
            console.log("asdasd",html);
            if(html==1){
                x=parseInt($(".shoppercount").last().html())+1;
                $(".shoppercount").html(x);
                $(".notification-a").html(x);
                $(".shopperprice").html(parseFloat($(".shopperprice").last().html())+parseFloat(a.attr('price')));
                if($(window).width()>768) {
                    window.cart = $('.static-header .shop_container');
                    window.imgtodrag = a.closest(".jq_item_container").find(".libro").first();
                    window.dragImg = window.imgtodrag;
                }
            }else if(html==0){
                x=parseInt($(".shoppercount").last().html())-1;
                $(".shoppercount").html(x);
                $(".notification-a").html(x);
                $(".shopperprice").html(parseFloat($(".shopperprice").html())-parseFloat(a.attr('price')));
               // a.html(window.Lang['AddToCart']);
                if($(window).width()>768) {
                    window.cart = a.closest(".jq_item_container").find(".libro").first();
                    window.imgtodrag = $('.static-header .shop_container');
                    window.dragImg = a.closest(".jq_item_container").find(".libro").first();
                }
            }
            if($(window).width()>768)
            {
                if (window.imgtodrag)
                {
                    var imgclone = window.dragImg.clone()
                        .offset({
                            top: $(window.imgtodrag).offset().top,
                            left: $(window.imgtodrag).offset().left
                        })
                        .css({
                            'opacity': '0.7',
                            'position': 'absolute',
                            'width': '222px',
                            'height': '252px',
                            'z-index': '999',
                            'perspective': '100px',
                            'perspective-origin': 'right center',
                            'transform-style': 'preserve-3d',
                            'transform': 'scaleX(0.88) scaleY(0.95) rotateY(-4deg)'
                        })
                        .appendTo($('body'))
                        .animate({
                            'top': $(window.cart).offset().top + 12,
                            'left': $(window.cart).offset().left + 12,
                            'width': 80,
                            'height': 100
                        }, 1000, 'easeInOutExpo');
                    imgclone.animate({
                        'width': 0,
                        'height': 0
                    }, function () {
                        $(this).detach()
                    });
                }
            }
            window.Freez=false;
        }
    });

}

function changePassword(){
    if($("#newpass").val().trim()=="" || $("#newpass").val().trim()==null){
        Lobibox.notify('warning', {
            title: window.Lang.EmptyPassword,
            msg: window.Lang.NewPasswordCannotEmpty
        });
    }else if($("#newpass").val().trim()!=$("#cpass").val().trim()){
        Lobibox.notify('warning', {
            title: window.Lang.PasswordNotMatch,
            msg: window.Lang.newPasswordNotMatch
        });
    }else{
        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=changepassword",
            type: "POST",
            data:{"oldpass":$("#oldpass").val().trim(),"newpass":$("#newpass").val().trim()},
            cache: false,
            dataType: 'html',
            success: function (html) {
                if(html==-1){
                    Lobibox.notify('error', {
                        title: window.Lang.incorrectPassword,
                        msg: window.Lang.oldpasswordincorrect
                    });

                }else if(html==1){
                    $(".close").trigger("click");
                    Lobibox.notify('success', {
                        title: window.Lang.processComplete,
                        msg: window.Lang.passwordChanged
                    });
                }
            }
        });
    }


}
function signIn(){

    if($("#login_email").val().trim()==''||$("#login_pass").val()==''){
        Lobibox.notify('error',
            {
                title: window.Lang.loginFaild,
                msg: window.Lang.Incorrectuserorpass
                //delay:900000
            });
        return;
    }


        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=signin",
            type: "POST",
            data:{"email":$("#login_email").val().trim(),"pass":$("#login_pass").val(),"save_data":$("#keep-login").prop("checked"),"page":'"'+window.location+'"'},
            cache: false,
            dataType: 'html',
            success: function (html) {
                console.log("login",html);
                if(html==1){
                   window.location.reload();
                }
                else
                {
                    $("#login").addClass("error");
                    setTimeout(function(){
                        $("#login").removeClass("error");
                    },2000);
                    Lobibox.notify('error',
                        {
                        title: window.Lang.loginFaild,
                        msg: window.Lang.Incorrectuserorpass
                        //delay:900000
                    });
                }
            }
        });
}
function signUp(){
    if($("#reg_email").val().trim()==""){
        Lobibox.notify('error',{
            title: window.Lang.RequiredField,
            msg: window.Lang.PleaseEnterEmailAddress
        });
        return false;
    }
    if($("#reg_pass").val().trim()!=""){
        if(isEmail($("#reg_email").val().trim())){
            if($("#reg_pass").val()==$("#reg_cpass").val()){
                $.ajax({
                    url: window.SITE_URL+"platform/ajax/platform.php?process=signup",
                    type: "POST",
                    data:{"email":$("#reg_email").val().trim(),"pass":$("#reg_pass").val(),"username":$("#reg_username").val().trim(),"page":'"'+window.location+'"'},
                    cache: false,
                    dataType: 'html',
                    success: function (html) {
                        if(html==-1){
                            Lobibox.notify('error',{
                                title: window.Lang.EmailExist,
                                msg: window.Lang.YourEmailExist
                            });
                        }else if(html==1){
                            window.location.reload();
                        }else{
                            Lobibox.notify('error',{
                                title: window.Lang.Error,
                                msg: html
                            });
                        }
                    }
                });
            }else{
                Lobibox.notify('error',{
                    title: window.Lang.Error,
                    msg: window.Lang.newPasswordNotMatch
                });

            }
        }else{
            Lobibox.notify('error',{
                title: window.Lang.WrongEmail,
                msg: window.Lang.WrongEmailMsg
            });
        }
    }else{
        Lobibox.notify('error',{
            title: window.Lang.RequiredField,
            msg: window.Lang.CannotPasswordEmpty
        });
    }
}

function isEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}


var ccErrorNo = 0;
var ccErrors = new Array ()

ccErrors [0] = "Unknown card type";
ccErrors [1] = "No card number provided";
ccErrors [2] = "Credit card number is in invalid format";
ccErrors [3] = "Credit card number is invalid";
ccErrors [4] = "Credit card number has an inappropriate number of digits";
ccErrors [5] = "Warning! This credit card number is associated with a scam attempt";

function checkCreditCard (cardnumber, cardname) {

    // Array to hold the permitted card characteristics
    var cards = new Array();

    // Define the cards we support. You may add addtional card types as follows.

    //  Name:         As in the selection box of the form - must be same as user's
    //  Length:       List of possible valid lengths of the card number for the card
    //  prefixes:     List of possible prefixes for the card
    //  checkdigit:   Boolean to say whether there is a check digit

    cards [0] = {name: "VISA",
        length: "13,16",
        prefixes: "4",
        checkdigit: true};
    cards [1] = {name: "MASTERCARD",
        length: "16",
        prefixes: "51,52,53,54,55",
        checkdigit: true};
    cards [2] = {name: "DinersClub",
        length: "14,16",
        prefixes: "36,38,54,55",
        checkdigit: true};
    cards [3] = {name: "CarteBlanche",
        length: "14",
        prefixes: "300,301,302,303,304,305",
        checkdigit: true};
    cards [4] = {name: "AmEx",
        length: "15",
        prefixes: "34,37",
        checkdigit: true};
    cards [5] = {name: "Discover",
        length: "16",
        prefixes: "6011,622,64,65",
        checkdigit: true};
    cards [6] = {name: "JCB",
        length: "16",
        prefixes: "35",
        checkdigit: true};
    cards [7] = {name: "enRoute",
        length: "15",
        prefixes: "2014,2149",
        checkdigit: true};
    cards [8] = {name: "Solo",
        length: "16,18,19",
        prefixes: "6334,6767",
        checkdigit: true};
    cards [9] = {name: "Switch",
        length: "16,18,19",
        prefixes: "4903,4905,4911,4936,564182,633110,6333,6759",
        checkdigit: true};
    cards [10] = {name: "Maestro",
        length: "12,13,14,15,16,18,19",
        prefixes: "5018,5020,5038,6304,6759,6761,6762,6763",
        checkdigit: true};
    cards [11] = {name: "VisaElectron",
        length: "16",
        prefixes: "4026,417500,4508,4844,4913,4917",
        checkdigit: true};
    cards [12] = {name: "LaserCard",
        length: "16,17,18,19",
        prefixes: "6304,6706,6771,6709",
        checkdigit: true};

    // Establish card type
    var cardType = -1;
    for (var i=0; i<cards.length; i++) {

        // See if it is this card (ignoring the case of the string)
        if (cardname.toLowerCase () == cards[i].name.toLowerCase()) {
            cardType = i;
            break;
        }
    }

    // If card type not found, report an error
    if (cardType == -1) {
        ccErrorNo = 0;
        return false;
    }

    // Ensure that the user has provided a credit card number
    if (cardnumber.length == 0)  {
        ccErrorNo = 1;
        return false;
    }

    // Now remove any spaces from the credit card number
    cardnumber = cardnumber.replace (/\s/g, "");

    // Check that the number is numeric
    var cardNo = cardnumber
    var cardexp = /^[0-9]{13,19}$/;
    if (!cardexp.exec(cardNo))  {
        ccErrorNo = 2;
        return false;
    }

    // Now check the modulus 10 check digit - if required
    if (cards[cardType].checkdigit) {
        var checksum = 0;                                  // running checksum total
        var mychar = "";                                   // next char to process
        var j = 1;                                         // takes value of 1 or 2

        // Process each digit one by one starting at the right
        var calc;
        for (i = cardNo.length - 1; i >= 0; i--) {

            // Extract the next digit and multiply by 1 or 2 on alternative digits.
            calc = Number(cardNo.charAt(i)) * j;

            // If the result is in two digits add 1 to the checksum total
            if (calc > 9) {
                checksum = checksum + 1;
                calc = calc - 10;
            }

            // Add the units element to the checksum total
            checksum = checksum + calc;

            // Switch the value of j
            if (j ==1) {j = 2} else {j = 1};
        }

        // All done - if checksum is divisible by 10, it is a valid modulus 10.
        // If not, report an error.
        if (checksum % 10 != 0)  {
            ccErrorNo = 3;
            return false;
        }
    }

    // Check it's not a spam number
    if (cardNo == '5490997771092064') {
        ccErrorNo = 5;
        return false;
    }

    // The following are the card-specific checks we undertake.
    var LengthValid = false;
    var PrefixValid = false;
    var undefined;

    // We use these for holding the valid lengths and prefixes of a card type
    var prefix = new Array ();
    var lengths = new Array ();

    // Load an array with the valid prefixes for this card
    prefix = cards[cardType].prefixes.split(",");

    // Now see if any of them match what we have in the card number
    for (i=0; i<prefix.length; i++) {
        var exp = new RegExp ("^" + prefix[i]);
        if (exp.test (cardNo)) PrefixValid = true;
    }

    // If it isn't a valid prefix there's no point at looking at the length
    if (!PrefixValid) {
        ccErrorNo = 3;
        return false;
    }

    // See if the length is valid for this card
    lengths = cards[cardType].length.split(",");
    for (j=0; j<lengths.length; j++) {
        if (cardNo.length == lengths[j]) LengthValid = true;
    }

    // See if all is OK by seeing if the length was valid. We only check the length if all else was
    // hunky dory.
    if (!LengthValid) {
        ccErrorNo = 4;
        return false;
    };

    // The credit card is in the required format.
    return true;
}

$(document).on("click",".download-btn",function(){


    if($(this).hasClass( "btn-popup" )){
        return
    }

    var data = {
        'TypeProcesses': 'downloadworksheet',
        'id': $(this).attr("bookid")

    };
    sendprocess(data);
});
