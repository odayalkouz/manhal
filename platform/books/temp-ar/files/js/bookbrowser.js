
$( window ).load(function() {
    setTimeout(function(){
        start();
    },700);
});

function deviceDetect() {
    var agent = window.navigator.userAgent;
    var d = document;
    var e = d.documentElement;
    var g = d.getElementsByTagName('body')[0];
    var deviceWidth = window.innerWidth || e.clientWidth || g.clientWidth;
    // Chrome
    IsChromeApp = window.chrome && chrome.app && chrome.app.runtime;
    // iPhone
    IsIPhone = agent.match(/iPhone/i) != null;
    // iPad up to IOS12
    IsIPad = (agent.match(/iPad/i) != null) || ((agent.match(/iPhone/i) != null) && (deviceWidth > 750)); // iPadPro when run with no launch screen can have error in userAgent reporting as an iPhone rather than an iPad. iPadPro width portrait 768, iPhone6 plus 414x736 but would probably always report 414 on app startup
    if (IsIPad) IsIPhone = false;
    // iPad from IOS13
    var macApp = agent.match(/Macintosh/i) != null;
    if (macApp) {
        // need to distinguish between Macbook and iPad
        var canvas = document.createElement("canvas");
        if (canvas != null) {
            var context = canvas.getContext("webgl") || canvas.getContext("experimental-webgl");
            if (context) {
                var info = context.getExtension("WEBGL_debug_renderer_info");
                if (info) {
                    var renderer = context.getParameter(info.UNMASKED_RENDERER_WEBGL);
                    if (renderer.indexOf("Apple") != -1) IsIPad = true;
                }
                ;
            }
            ;
        }
        ;
    }
    ;
    // IOS
    IsIOSApp = IsIPad || IsIPhone;
    // Android
    IsAndroid = agent.match(/Android/i) != null;
    IsAndroidPhone = IsAndroid && deviceWidth <= 960;
    IsAndroidTablet = IsAndroid && !IsAndroidPhone;
    message = "";
    if (IsIPhone) {
        message = "iphone"
    }
    else if (IsIPad) {
        message = "ipad"
    } else if (IsAndroidTablet || IsAndroidPhone || IsAndroid) {
        message = "android"
    } else {
        message = "desktop"
    }
    return message;
    // return {
    //     message: message,
    //     isTrue: IsIOSApp || IsAndroid || IsAndroidTablet || IsAndroidPhone
    // }
}
window.deviceType=deviceDetect();

$(document).ready(function(){

    window.xDoc = '#daralmanhal_xml_data#';
    window.pageID = 1;
    window.xmlDoc = $.parseXML( xDoc );
    window.$xml = $( xmlDoc );
    window.SITE_URL="https://www.manhal.com/";

//window.SITE_URL="/manhal/";
    window.Lang={
        "SignUp":"تسجيل الدخول",
        "InvalidEmail":"البريد الإلكتروني غير صحيح",
        "PassTooShort":"كلمة المرور قصيرة جداً",
        "PassNotMatch":"كلمتا المرور غير متطابقتين",
        "InvalidActCode":"رمز التفعيل غير صحيح",
        "EmailExisit":"البريد الإإلكتروني مستخدم مسبقاً , يرجى إدخال بريد إلكتروني آخر , أو اضغط على نسيت كلمة المرور اذا كنت مسجل مسبقاً",
        "Unexpected":"حدث خطأ غير متوقع",
        "LogIn":"تسجيل الدخول",
        "InvalidUserOrPass":"كلمة المرور أو البريد الإلكتروني غير صحيح",
        "InvalidPermession":"لا تملك الصلاحيات لرؤية هذا المحتوى , يرجى الإشتراك  <a target='_blank' href='https://www.manhal.com/ar/subscribe'>هنا</a> للتمكن من تصفح جميع كتب دار المنهل",
        "error":"خطأ",
        "password":"كلمة المرور",
        "msgSent":"لقد تم إرسال تعليمات استعادة كلمة المرور إلى بريدك الإلكتروني , يرجى إتباع التعليمات لإعادة تعيين كلمة المرور",
        "cannotSendMsg":"حدث خطأ غير متوقع, تعذر إرسال رسالة",
        "emailNotRegi":"خطأ في البريد الإلكتروني , هذا البريد الإلكتروني لم يتطابق مع أي حساب",
        "ZoomIn":"تكبير",
        "ZoomOut":"تصغير",
        "Activation":"التفعيل"
    };
    window.lastPage = $xml.find("pagesearch").length+1;
    window.bookid=$xml.find("bookid").first().text();
    window.BookTitle= $xml.find("booktitle").text();
    window.pageWidth=$xml.find("width").text();
    window.pageHeight=$xml.find("height").text();
    window.LesssonsPages={};
    window.lesson_index={};
    window.sound=true;
    window.zoomed=0;
    window.fullScreen=false;
    window.MobileWidth=400;
    window.isMobile=false;
    window.isDraging=false;
    window.language="ar";
    window.DeviceHeight=$(window).height();
    window.DeviceWidth=$(window).height();
    window.isPaused=false;
    window.bookSize="#manhal#booksize#";
    window.userData={};
    window.demoBook={};
    window.platform="manhal";
    if((window.location.href).indexOf("platform=imanhal")!=-1){
        window.platform="imanhal";
        tempuser={};
        tempuser["permession"]=10;
        tempuser["uname"]="imanhal";
        tempuser["userid"]=1;
        userData.user=tempuser;
        saveUserData();
    }
    if(deviceType!="desktop"){
        window.isMobile=true;
    }
    if((window.location.href).indexOf("secret")!=-1){
        if(window.platform!="imanhal"){
        if(typeof localStorage.userData !="undefined" && typeof localStorage.userData !=null && typeof localStorage.userData !="" && localStorage.userData!="undefined" && localStorage.userData!=""){
            userData=JSON.parse(localStorage.userData);
            if(typeof userData.user=="undefined"){
                getUserInfo();
            }else if(userData.user["userid"]!=getUrlParameter("userid")){
                getUserInfo();
            }
        }else{
            getUserInfo();
        }
        }

        //if(!(/^((?!chrome|android).)*safari/i.test(navigator.userAgent)))
        //if(!!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/))

     //   if(navigator.userAgent.match(/iPhone|iPad|iPod/i))
        if(deviceType=="iphone" || deviceType=="ipad")
        {
            if(window.bookSize=="width"){
                if(window.platform=="manhal"){
                    window.webkit.messageHandles.landscapeRotate.postMessage('rotateToLandscape');
                }else{
                    window.webkit.messageHandlers.landscapeRotate.postMessage("");
                }

                if($(window).width()<$(window).height()){
                    window.location.reload();
                }
            }else{
                if(window.platform=="manhal"){
                window.webkit.messageHandlers.portrateRotate.postMessage('rotateToPortrate');
                }else{
                    window.webkit.messageHandlers.portrateRotate.postMessage("");
                }
                if($(window).width()>$(window).height()){
                    window.location.reload();
                }
            }
            ShowBackLandscape();
        }else {//Android
            if(deviceType=="android") {
                if(window.bookSize=="width"){
                if(window.platform=="manhal"){
                    Manhal_app.rotateScreenTo_LANDSCAPE();
                }else{
                    ManhalLMS_android.rotateScreenTo_LANDSCAPE();
                }

                    if($(window).width()<$(window).height()){
                        window.location.reload();
                    }
                }else{
                if(window.platform=="manhal"){
                    Manhal_app.rotateScreenTo_Portrait();
                }else{
                    ManhalLMS_android.rotateScreenTo_Portrait();
                }
                    if($(window).width()>$(window).height()){
                        window.location.reload();
                    }
                }

            }

        }
    }else{
        HideBackLandscape();
    }
    if(typeof localStorage.userData !="undefined" && typeof localStorage.userData !=null && typeof localStorage.userData !="" && localStorage.userData!="undefined" && localStorage.userData!=""){
        userData=JSON.parse(localStorage.userData);
        if(typeof userData.user=="undefined"){
            getUserInfo();
        }
    }else{
        getUserInfo();
    }

    //run save paint
    $(document).on("click", ".save-Paint, .header-pens a.save", function (e) {
        savePaint();
    });




    $(".back-landscape").click(function(){
        if(window.platform=="manhal"){
        window.webkit.messageHandlers.exitToBack.postMessage('back');
        }else{
            window.webkit.messageHandlers.exitToBack.postMessage("");
        }
    });

    $(".book__left").css("background-color","#"+$xml.find("color").first().text());

    $.ajaxSetup
    ({
        // Disable or Enable caching of AJAX
        cache: true // or true
    });

    $(".book__cover").css("background-image","url(p0000_thumb.jpg);");

    $("#signup_button").click(function(){
        if(!isEmail($("#signup_email").val())){
            showMsg("error",Lang.SignUp,Lang.InvalidEmail);
        }else if($("#signup_pass").val().trim().length<3){
            showMsg("error",Lang.SignUp,Lang.PassTooShort);
        }else if($("#signup_pass").val().trim()!=$("#signup_cpass").val().trim()){
            showMsg("error",Lang.SignUp,Lang.PassNotMatch);
        }else if($("#signup_code").val().trim().length<3){
            showMsg("error",Lang.SignUp,Lang.InvalidActCode);
        }else{
            showLoader();
            var data={};
            data["secret"]=getSecret();
            data["process"]="signup";
            data["lang"]=window.language;
            data["email"]=$("#signup_email").val().trim();
            data["pass"]=$("#signup_pass").val().trim();
            data["code"]=$("#signup_code").val().trim();
            data["bookid"]=window.bookid;
            $.ajax({
                url: window.SITE_URL+window.language+"/api/books",
                type: "POST",
                data: data,
                cache: false,
                dataType:'json',
                success: function(jsonResult){
                    // console.log("signup",jsonResult);
                    hideLoader();
                    if(jsonResult.result==1){//success
                       // localStorage.userData=JSON.stringify(jsonResult.userData);
                        window.location.reload();
                    }else if(jsonResult.result==-1){//invalide Code
                        showMsg("error",Lang.SignUp,Lang.InvalidActCode);
                    }else if(jsonResult.result==-2){//email already exisit
                        showMsg("error",Lang.SignUp,Lang.EmailExisit);
                    }else{//unexpected
                        showMsg("error",Lang.SignUp,jsonResult.msg);
                    }
                }
            });
        }
    });
    $("#activate").click(function(){
       if($("#activate_code").val().trim().length<3){
            showMsg("error",Lang.SignUp,Lang.InvalidActCode);
        }else{
            showLoader();
            var data={};
            data["secret"]=getSecret();
            data["process"]="activateuser";
            data["lang"]=window.language;
            data["code"]=$("#activate_code").val().trim();
            data["bookid"]=window.bookid;
            $.ajax({
                url: window.SITE_URL+window.language+"/api/books",
                type: "POST",
                data: data,
                cache: false,
                dataType:'json',
                success: function(jsonResult){
                     //console.log("activation",jsonResult);
                    hideLoader();
                    if(jsonResult.result==1){//success
                        window.location.reload();
                    }else{//unexpected
                        showMsg("error",Lang.Activation,jsonResult.msg);
                    }
                }
            });
        }
    });
    $("#login_button").click(function(){
        if($("#login_email").val()=="root"){
            userData.user='{"userid":"2","uname":"user1","email":"khalidalomire2@gmail.com","permession":"1","avatar":"users/images/580f30a0936e2.jpg","activation_code":""}';
            window.location.reload();
        }
        if($("#login_pass").val().trim().length<3){
            showMsg("error",Lang.LogIn,Lang.PassTooShort);
        }else{
            showLoader();
            var data={};
            data["secret"]=getSecret();
            data["process"]="login";
            data["lang"]=window.language;
            data["email"]=$("#login_email").val().trim();
            data["pass"]=$("#login_pass").val().trim();
            data["bookid"]=window.bookid;
            $.ajax({
                url: window.SITE_URL+window.language+"/api/books",
                type: "POST",
                data: data,
                cache: false,
                dataType:'json',
                success: function(jsonResult){
                    // console.log("login",jsonResult);
                    hideLoader();
                    if(jsonResult.result==1){//success
                        userData.user=jsonResult.user;
                        localStorage.userData=JSON.stringify(userData);
                        window.location.reload();
                    }else if(jsonResult.result==-1){//invalide Code
                        showMsg("error",Lang.LogIn,Lang.InvalidUserOrPass);
                    }else if(jsonResult.result==-2){//invalide Code
                        showMsg("error",Lang.LogIn,Lang.InvalidPermession);
                    }else{//unexpected
                        showMsg("error",Lang.SignUp,jsonResult.msg);
                    }
                }
            });
        }
    });
    $("#forget_button").click(function(){
        if(!isEmail($("#forget_email").val())){
            showMsg("error",Lang.error,Lang.InvalidEmail);
        }else{
            showLoader();
            var data={};
            data["secret"]=getSecret();
            data["process"]="forgetpass";
            data["lang"]=window.language;
            data["email"]=$("#forget_email").val().trim();
            $.ajax({
                url: window.SITE_URL+window.language+"/api/books",
                type: "POST",
                data: data,
                cache: false,
                dataType:'json',
                success: function(jsonResult){
                    // console.log("forget",jsonResult);
                    hideLoader();
                    if(jsonResult.result==1){//success
                        showMsg("success",Lang.password,Lang.msgSent);
                    }else if(jsonResult.result==-1){//invalide Code
                        showMsg("error",Lang.password,Lang.cannotSendMsg);
                    }else if(jsonResult.result==0){//invalide Code
                        showMsg("error",Lang.password,Lang.emailNotRegi);
                    }else{//unexpected
                        showMsg("error",Lang.password,jsonResult.msg);
                    }
                }
            });
        }
    });

    $("#magazine-viewport").touchwipe({
        wipeLeft: function() {
            // console.log("wipping");
            if(!window.isDraging){
                $('.magazine').turn('previous');
            }
        },
        wipeRight: function() {
            if(!window.isDraging){
                $('.magazine').turn('next');
            }
        },
        min_move_x: 300,
        min_move_y: 300,
        preventDefaultEvents: true
    });

    //if($(window).width()<=1024) {
    //    $(document).on('click', function(e){
    //            if(typeof $(e.target).closest(".mobile_noclose")[0]=='undefined' && typeof $(e.target).closest(".element")[0]=='undefined'){
    //                if($(".footer-icons-mobile").hasClass("jq_hidden")) {
    //                    $(".footer-icons-mobile").show();
    //                    $("header").show();
    //                    $(".goto-full-container-footer").show();
    //                    $(".footer-icons-mobile").removeClass("jq_hidden");
    //                    $("header").removeClass("jq_hidden");
    //                    $(".goto-full-container-footer").removeClass("jq_hidden");
    //                }else{
    //                    $(".footer-icons-mobile").hide();
    //                    $("header").hide();
    //                    $(".goto-full-container-footer").hide();
    //                    $(".footer-icons-mobile").addClass("jq_hidden");
    //                    $("header").addClass("jq_hidden");
    //                    $(".goto-full-container-footer").addClass("jq_hidden");
    //                }
    //            }
    //    });
    //}
    $(document).on("click",".jq_closepen",function(){
        if($(".pen").hasClass("pen1")){
            $(".pen").click();
        }
    });
    $(".jq_numberofpages").html("<span class='floating-right'>من</span><div class='num floating-right'>"+(window.lastPage-3).toString()+"</div>");
    calcBookDimentions();




    $('.zoom-icon').bind('mouseover', function() {
        if ($(this).hasClass('zoom-icon-in'))
            $(this).addClass('zoom-icon-in-hover');
        if ($(this).hasClass('zoom-icon-out'))
            $(this).addClass('zoom-icon-out-hover');
    }).bind('mouseout', function() {
        if ($(this).hasClass('zoom-icon-in'))
            $(this).removeClass('zoom-icon-in-hover');
        if ($(this).hasClass('zoom-icon-out'))
            $(this).removeClass('zoom-icon-out-hover');
    }).bind('click', function() {
        if ($(this).hasClass('zoom-icon-in'))
        {$('.magazine-viewport').zoom('zoomIn');
            $(".third-section-viewer .book-viewer-container footer .zoom-popup").removeClass("fade-bottom");
            $(".third-section-viewer .book-viewer-container footer .zoom-popup").addClass("fade-top");
            $(".third-section-viewer .book-viewer-container footer .view-page-popup a.zoom").addClass("zoom1");}

        else if ($(this).hasClass('zoom-icon-out'))
        {$('.magazine-viewport').zoom('zoomOut');
            $(".third-section-viewer .book-viewer-container footer .zoom-popup").addClass("fade-bottom");
            $(".third-section-viewer .book-viewer-container footer .zoom-popup").removeClass("fade-top");
            $(".third-section-viewer .book-viewer-container footer .view-page-popup a.zoom").removeClass("zoom1");
        }

    });
    $('#canvas').hide();



    $(document).on("click",".close",function(){
        if(window.sound){
            $("#sound_close")[0].play();
        }
    });


    $(".print_canvas").click(function () {
        if(window.drawingMod=="erease"){
            var img=window.canvasFront.toDataURL("image/png");
        }else{
            var img=window.canvas.toDataURL("image/png");
        }


        if($('.magazine').turn("display")=="double"){
            iheight=$('.magazine').height();
            iwidth=$('.magazine').width();

            hh=iheight+2
            //var printWindow = window.open('', '', 'height='+iheight+',width='+iwidth);
            var printWindow = window.open('', '', 'height='+iheight+',width='+iwidth);
            html='<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title></title>';
            html+="<style>";
            html+="@page { size: landscape;}.right-page-print{float:right;} .body{position:inherit !important; }@media print{";
            html+="*{-webkit-print-color-adjust:exact;border:0px !important;";
            html+="}.page,.main-img{transform-origin: left top !important;transform: scale(0.65)!important;}";
            html+=".background-icon,.aicon{display:none!important;}.real-content{margin:23px 0px 0px 15px !important;}}";
            html+="</style>";
            pageWidth=$('.magazine').width()/2;
            pageWidth2=pageWidth;

            if($(".magazine").turn("page")%2==0){
                cpage=$(".magazine").turn("page")+1;
                leftContent=$('.p'+cpage).closest("div").html();
                cpage=$(".magazine").turn("page");
                rightContent=$('.p'+cpage).closest("div").html();
            }else{
                cpage=$(".magazine").turn("page");
                leftContent=$('.p'+cpage).closest("div").html();
                cpage=$(".magazine").turn("page")-1;
                rightContent=$('.p'+cpage).closest("div").html();
            }



            html+='</head><body style="height:'+iheight+'px;width:'+iwidth+';margin:0px;padding:0px;text-align: left;">';
            html+='<div style="text-align:left;position:relative;top:0px;left:0px;right:0px;bottom: 0px ;margin:0 auto;display:inline-block;overflow:hidden;width:'+iwidth+';height:'+iheight+'px;">';
            html+='<img class="" style="position: absolute;z-index:99999999;width: '+iwidth+'px;height: '+iheight+'px;top :0px;left: 0px;" src="'+img+'">';
            html+='<div class="left-page-print" style="display:inline-block;overflow:hidden;width:50%;height:'+iheight+'">'+leftContent+'</div>';
            html+='<div class="right-page-print" style="display:inline-block;overflow:hidden;width:50%;height:'+iheight+'">'+rightContent+'</div>';
            html+="</div>";
            html+="</body></html>";
            printWindow.document.write(html);
            printWindow.document.close();
            setTimeout(function(){
                printWindow.print();
            },150);


        }else{
            iheight=$('.magazine').height();
            iwidth=$('.magazine').width();

            iheight=1235;
            iwidth=800;
            var printWindow = window.open('', '', 'height='+iheight+',width='+iwidth);
            printWindow.document.write('<html><head><title></title>');
            printWindow.document.write( "<style>" );
            printWindow.document.write( "@page { size: portrait; }@media print {");
            printWindow.document.write( "* {-webkit-print-color-adjust:exact;border:0px !important;");
            printWindow.document.write("}.background-icon,.aicon{display:none!important;}.real-content{margin:23px 0px 0px 0px !important;}.page_container{transform: scale(1)!important;}");
            printWindow.document.write("}");
            printWindow.document.write("</style>");
            printWindow.document.write('</head><body><img style="position: absolute;z-index:99999999;width: 100%;height: 100%;top :0px;left: 0px;" src="'+img+'">');
            cpage=$(".magazine").turn("page");
            var Content=$('.p'+cpage).closest("div").html();
            printWindow.document.write(Content);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            setTimeout(function(){
                printWindow.print();
            },150);
        }
    });


    //start print page//
    var leftContent="";
    var rightContent="";
    $('.print').click(function(){
        if($('.magazine').turn("display")=="double"){
            iheight=$('.magazine').height();
            iwidth=$('.magazine').width();
            var printWindow = window.open('', '', 'height='+iheight+',width='+iwidth);
            html='<html><head><title></title>';
            html+="<style>";
            html+="@page { size: landscape; }@media print{";
            html+="*{-webkit-print-color-adjust:exact;border:0px !important;";
            html+="}.page{transform-origin: left top !important;transform: scale(0.670925)!important;}";
            html+=".background-icon,.aicon{display:none!important;}.real-content{margin:23px 0px 0px 15px !important;}}";
            html+="</style>";
            pageWidth=$('.magazine').width()/2;
            pageWidth2=pageWidth;

            if($(".magazine").turn("page")%2==0){
                cpage=$(".magazine").turn("page")+1;
                leftContent=$('.p'+cpage).closest("div").html();
                cpage=$(".magazine").turn("page");
                rightContent=$('.p'+cpage).closest("div").html();
            }else{
                cpage=$(".magazine").turn("page");
                leftContent=$('.p'+cpage).closest("div").html();
                cpage=$(".magazine").turn("page")-1;
                rightContent=$('.p'+cpage).closest("div").html();
            }


            html+='</head><body style="height:100%;width:'+iwidth+';margin:0px;padding:0px;text-align: left;">';
            html+='<div style="text-align:left;position:absolute;top:0px;left:0px;right:0px;bottom: 0px ;margin:0 auto;display:inline-block;overflow:hidden;width:'+iwidth+';height:'+iheight+'px;">';
            html+='<div class="left-page-print" style="display:inline-block;overflow:hidden;width:50%;height:'+iheight+'">'+leftContent+'</div>';
            html+='<div class="right-page-print" style="display:inline-block;overflow:hidden;width:50%;height:'+iheight+'">'+rightContent+'</div>';
            html+="</div>";
            html+="</body></html>";
            printWindow.document.write(html);
            printWindow.document.close();
            printWindow.print();
        }else{
            iheight=$('.magazine').height();
            iwidth=$('.magazine').width();

            iheight=1235;
            iwidth=800;

            var printWindow = window.open('', '', 'height='+iheight+',width='+iwidth);
            printWindow.document.write('<html><head><title></title>');
            printWindow.document.write( "<style>" );
            printWindow.document.write( "@page { size: portrait; }@media print {");
            printWindow.document.write( "* {-webkit-print-color-adjust:exact;border:0px !important;");
            printWindow.document.write("}.background-icon,.aicon{display:none!important;}.real-content{margin:23px 0px 0px 0px !important;}.page_container{transform: scale(1)!important;}");
            printWindow.document.write("}");
            printWindow.document.write("</style>");
            printWindow.document.write('</head><body>');
            cpage=$(".magazine").turn("page");
            var Content=$('.p'+cpage).closest("div").html();
            printWindow.document.write(Content);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    });
    //end print page//

    $('#page-number').keydown(function(e){
        if (e.keyCode==13){
            if($('#page-number').val()==''){
                $('#page-number').val('0');
            }
            if(parseInt($('#page-number').val())==0){
                openPage(1,e);
            }else{
                openPage(parseInt($('#page-number').val())+2,e);
            }

        }
    });
    $(".next").click(function(){
            $('.magazine').turn('next');
    });
    $(".prev").click(function(){
            $('.magazine').turn('previous');
    });
    $(".one-page-icon").click(function(){
        if($(".magazine").turn("display")=="double"){
            if(window.zoomed){
                footerzoom();
                timeOut=750;
            }else{
                timeOut=0;
            }
            setTimeout(function(){
                //if (window.bookWidth > window.pageWidth) {
                //    newWidth = window.bookWidth / 2;
                //} else {
                //    newWidth = window.bookWidth;
                //}
                    newWidth=window.bookWidth/2;
                $(".magazine").width(newWidth);
                $(".magazine").turn("display", "single");
                $(".magazine").css("left",($(window).width()-$(".magazine").width())/2-$(".container").offset().left);
                setTimeout(function(){
                    reScale();
                },500);
            },timeOut);
        }
    });
    $(".Tow-page-icon").click(function(){
        if(window.zoomed){
            footerzoom();
            timeOut=750;
        }else{
            timeOut=0;
        }
        setTimeout(function(){
            if($(".magazine").turn("display")=="single"){
                $(".magazine").width(window.bookWidth);
                $(".magazine").turn("display", "double");
                //$(".magazine").css("left",($(window).width()-$(".magazine").width())/2-$(".container").offset().left);
                resizeViewport();
                setTimeout(function(){
                    reScale();
                },500);
            }
        },timeOut);

    });
    $("#bookmark").click(function(){
        if($(".magazine").turn("display")=="double"){
            if($(".magazine").turn("page")%2==0){
                pageid=$(".magazine").turn("page")-1;
            }else{
                pageid=$(".magazine").turn("page")-2
            }
        }else{
            pageid=$(".magazine").turn("page")-2;
            openpage=$(".magazine").turn("page");
        }
        openpage=$(".magazine").turn("page");

        bookmarks= BookMark_array[window.bookid];
        id ='menuMark_'+pageid;
        if(objectSearch(bookmarks,pageid)){
            delete  bookmarks[id];
            $("#menuMark_"+pageid).remove();
            if(window.sound){
                $("#sound_delete")[0].play();
            }
        }else{
            if(window.sound){
                $("#sound_addnote")[0].play();
            }
            bookmarks[id]=pageid;
            arr=getPagename(pageid+1).split(".");
            pageName=arr[0];
            var title=$xml.find("pagetitle")[pageid].textContent;
            DtaBookmark='<div class="item-container animated fadeInRight jq_noclose mobile_noclose" id="menuMark_'+pageid+'"><a class="thumb-item" openpage="'+openpage+'" onclick="openPage('+openpage+',this)" style="background: url('+pageName+'_thumb.jpg)"><div class="mark"></div></a>' +
                '<div class="thumb-number-page"><label class="floating-right">'+pageid+'</label>' +
                '<a onclick="deleteiconlocal('+String.fromCharCode(39)+'mark'+String.fromCharCode(39)+','+pageid+')" class="delete-note floating-left button-animation"></a></div></div>';

            $(".bookmark-content").append(DtaBookmark);
        }
        BookMark_array[window.bookid]=bookmarks;
        //userData.bookmark=JSON.stringify(BookMark_array);
        userData.bookmark=BookMark_array;
        saveUserData();
        BookMark_array=getBookmarkArray();
    });
    $(document).on("click",".openpage",function(){
        var page=parseInt(getPageNumber($(this).attr("pagename"))+1);
        if(page>=lastPage-1){
            if(typeof userData.user=="undefined" || userData.user=="null" || userData.user=="" || userData.user['permession']==-1){
                OpenSignIn();
            }else if(userData.user['permession']==0){
                OpenActivation();
            }
        }else{
            $('.magazine').turn('page',page);
            setTimeout(function(){
                reScale();
            },50);
        }
    });
    $(document).on("click",".goto",function(){
        var page=$(this).attr("goto");
        if(page>=lastPage-1){
            if(typeof userData.user=="undefined" || userData.user=="null" || userData.user=="" || userData.user['permession']==-1){
                OpenSignIn();
            }else if(userData.user['permession']==0){
                OpenActivation();
            }
        }else{
            $('.magazine').turn('page',page);
            setTimeout(function(){
                reScale();
            },50);
        }
    });
    $("#searchtext").keypress(function(e){
        var key = e.which;
        if(key == 13)  // the enter key code
        {
            $("#searchbutton").trigger("click");
        }
    });
    $(document).keydown(function(e) {
        switch(e.which) {
            case 39:
                swal.close();
                break;
            case 37:
                swal.close();
                break;
            default: return;
        }
        e.preventDefault();
    });
    $("#searchbutton").click(function(){
        var searchtext=$("#searchtext").val().toLowerCase().trim();
        if(searchtext==""){
            $(".content-search").html("");
            return;
        }

        var result="";
        var resultArr=[];
        $xml.find("pagesearch").each(function(){
            txt=$(this).find("pagetitle").text();
            resultindex=txt.search(searchtext);

            if(resultindex!=-1 && resultArr.indexOf($(this).find("pagename").text())==-1){
                result+="<a class='openpage thumb-item' pagename='"+$(this).find("pagename").text()+"' style='background: url("+$(this).find("pagename").text()+"_thumb.jpg)'></a>";
                resultArr.push($(this).find("pagename").text());
            }

            txt=$(this).find("pagedata").text().toLowerCase();
            resultindex=txt.search(searchtext);

            while(resultindex!=-1){
                last=true;
                if(resultindex>30){
                    firstchar=resultindex-30;
                }else{
                    firstchar=0;
                }

                if(txt.length>resultindex+30){
                    lastchar=resultindex+30;
                }else{
                    lastchar=txt.length;
                    last=false;
                }
                linktext=txt.substring(firstchar,lastchar);
                lastOrginalChar=lastchar;

                firstchar=linktext.search(" ");
                if(last){
                    lastchar=linktext.lastIndexOf(" ");
                }
                linktext=linktext.substring(firstchar,lastchar);
                if(resultArr.indexOf($(this).find("pagename").text())==-1) {
                    result += "<a class='openpage thumb-item' pagename='" + $(this).find("pagename").text() + "' style='background: url(" + $(this).find("pagename").text() + "_thumb.jpg)' ></a>";
                    resultArr.push($(this).find("pagename").text());
                }
                txt=txt.substring(lastOrginalChar);
                resultindex=txt.search(searchtext);
            }
        });
        $(".content-search").html(result);
    });
    $(document).on("click","#AddNote",function() {
        id = "note_" + randomString(4);
        html = '<a class="doaction mobile_noclose note-icon-a jq_noclose" id="' + id + '" actiontype="note" data_src="write note" status="0" style="position: absolute;left:200px;top:300px;"><i class="flaticon-editing aicon"></i></a>';
        pagen = $(".magazine").turn("page");
        $(".p" + pagen + " .page_container").append(html);
        refreshElements();
        if(window.sound){
            $("#sound_addnote")[0].play();
        }

        setTimeout(function () {
            $(".notebook-content").append('<div class="item-container animated fadeInRight jq_noclose mobile_noclose" id="menuNote_' + pagen + id + '"><div class="icon-content opennote floating-right"  note_id="' + id + '" pageid="' + pagen + '"><i class="floating-right"></i><label class="floating-right">' + (parseInt(pagen)-2).toString() + '</label></div><p class="text-content floating-right">اكتب ملاحظتك</p><a class="delete-content mobile_noclose jq_noclose delete-note floating-right button-animation" onclick="deleteiconlocal(' + String.fromCharCode(39) + 'note' + String.fromCharCode(39) + ',' + String.fromCharCode(39) + id + String.fromCharCode(39) + ',' + String.fromCharCode(39) + pagen + String.fromCharCode(39) + ')"></a></div>');
        }, 300);
    });
    $(document).on("click",".opennote",function(){
        pageid=$(".magazine").turn("page");
        if($(this).attr("pageid")==pageid){
            openNote($(this).attr("note_id"));
            if(window.sound){
                $("#sound_opennote")[0].play();
            }
        }else{
            $(".magazine").turn("page");
            openPage($(this).attr("pageid"),this);
            id=$(this).attr("note_id");
            setTimeout(function(){
                openNote(id);
            },250);
        }
    });
    $(document).on("click",".jq_click",function(){
        $(this).attr("class","animated jq_click");
        clickedAnchor=$(this);
        setTimeout(function(){
            animations=clickedAnchor.attr("data-animation").split(",");
            for (i = 0; i < animations.length; i++) {
                if(animations[i]!="" && animations[i]!=undefined) {
                    options = animations[i].split("@");
                    if (options[1] == "true") {
                        clickedAnchor.addClass("infinite");
                    }else{
                        clickedAnchor.removeClass("infinite");
                    }

                    if (options[2] !="" && options[2]!=undefined && typeof options[2]!= 'undefined' && options[2]!= 'undefined'){
                        // alert(options[2]);
                        soundID=getSoundID(options[2]);
                        $('audio').each(function(){
                            this.pause(); // Stop playing
                            this.currentTime = 0; // Reset time
                        });
                        $("#"+soundID)[0].play();
                    }
                    clickedAnchor.addClass(options[0]);
                }
            }
        },5);
    });
    $(document).on("click",".doaction,.jq_enrichment",function(event){
        $("#container-popup").removeClass("image-case");
        $(".close-index-popup1").hide();
        html="";
        $(".title-enrichments").html($(this).attr("title"));
        switch ($(this).attr("actiontype")){
            case "youtube":
                html='<iframe id="iframe" width="100%" height="100%" src="https://www.youtube.com/embed/'+$(this).attr("data_src")+'?rel=0\" frameborder="0"></iframe>';
                $(".popup-content-a .inner-content").html(html);
                popupenrishmentscontainer();
                removeElementIcons($(".category-enrishments"));
                $(".category-enrishments").addClass("youtube");
                launchFullscreenEnrishments();
                $(".loader-inpopup").hide();
                break;
            case "sound":
                id=$(this).closest(".element").attr("id");
                if(id==undefined || id=="" || id==null){
                    id=$(this).attr("element_id");
                    selector="audio_"+id;
                }else{
                    selector="audio_"+id;
                }
                if(selector_!=null){
                    alphabetSounds[selector_].pause();
                }
                if(selector_!=selector){
                selector_=selector;
                if(alphabetSounds[selector]==undefined || $(selector)[0]==""){
                    alphabetSounds[selector] = new manhalsound($(this).attr("data_src"));
                    alphabetSounds[selector].Play();
                }else{
                    alphabetSounds[selector].Play();
                }
                }else{
                    // console.log("pause",window.isPaused);
                    if(window.isPaused){
                        window.isPaused=false;
                        alphabetSounds[selector].Play();
                    }else{
                        window.isPaused=true;
                        alphabetSounds[selector].pause();
                    }
                }

                break;
            case "image":
                $("#container-popup").addClass("image-case");
                $(".close-index-popup1").show();
                $('.exit-full-screen-container').hide();

                html='<img id="img" src="'+$(this).attr("data_src")+'">';
                $(".popup-content-a .inner-content").html(html);
                popupenrishmentscontainer();
                removeElementIcons($(".category-enrishments"));
                $(".category-enrishments").addClass("image");
                break;
            case "douknow":
                $("#douknow_title").html("");
                $("#douknow_p").html("");
                $("#douknow_img").attr("src","");
                $("#douknow_title").html($(this).attr("title"));
                $("#douknow_p").html($(this).find(".enr-data").html());
                $("#douknow_img").attr("src", $(this).attr("data_src"));
                openinformation();
                break;
            case "urlimage":
            case "urltext":
                $("#container-popup").addClass("image-case");
                $(".close-index-popup1").show();
                $('.exit-full-screen-container').hide();
                var url=$(this).attr("data_src");
                if(url.indexOf(".mp4")!=-1 || url.indexOf(".MP4")!=-1){
                    $("#container-popup").removeClass("image-case");
                    $('.exit-full-screen-container').show();

                    $(".close-index-popup1").hide();
                    html='<video controls crossorigin width="100%" height="100%" id="manhal_video" controls=""  name="media"><source src="'+url+'" type="video/mp4"></video> ';
                    $(".popup-content-a .inner-content").html(html);
                    player = new Plyr('#manhal_video');
                    $(".loader-inpopup").hide();
                    if ($(".popup-enrishments-container").is(":visible")) {
                        if (typeof $(e.target).closest("#iframe").contents().find("img")[0] == "undefined" && typeof $(e.target).closest(".doaction,.plyr__control,.popup-content-a")[0] == "undefined") {
                            Closefooterindex();
                            Closepopupenrishmentscontainer();
                        }
                    }
                }else{
                    $(".loader-inpopup").show();
                if(isMobile){
                    if(url.indexOf(".pdf")!=-1 && url.indexOf("manhal.com")!=-1){
                        url=url.replace(".pdf","image_larg.jpg");
                            html='<iframe id="iframe" onload="onloadIframepdf();" scrolling="yes" width="100%" height="100%" src="'+url+'" frameborder="0"></iframe>';
                    }else{
                        html='<iframe style="display: none" id="iframe" onload="onloadIframe();" width="100%" height="100%" src="'+url+'" frameborder="0"></iframe>';
                    }
                    }else{
                    html='<iframe id="iframe" style="display: none" onload="onloadIframe();" width="100%" height="100%" src="'+url+'" frameborder="0"></iframe>';
                    }

                $(".popup-content-a .inner-content").html(html);

                }
                popupenrishmentscontainer();
                removeElementIcons($(".category-enrishments"));
                $(".category-enrishments").addClass("url");

                if(url.indexOf(".JPG")!=-1 || url.indexOf(".JPEG")!=-1 || url.indexOf(".jpg")!=-1 || url.indexOf(".jpeg")!=-1 || url.indexOf(".png")!=-1 || url.indexOf(".gif")!=-1 || url.indexOf(".GIF")!=-1 || url.indexOf(".PNG")!=-1){

                }else{
                    launchFullscreenEnrishments();
                }
                break;
            case "url":
                $("#container-popup").addClass("image-case");
                $(".close-index-popup1").show();
                if(deviceType!="desktop")
                {
                    $('.exit-full-screen-container').hide();
                }
                else {
                    $('.exit-full-screen-container').show();
                }
                var url=$(this).attr("data_src");
                if(url.indexOf(".mp4")!=-1 || url.indexOf(".MP4")!=-1){
                    $("#container-popup").removeClass("image-case");
                    $('.exit-full-screen-container').show();
                    $(".close-index-popup1").hide();
                    html='<video controls crossorigin width="100%" height="100%" id="manhal_video" controls=""  name="media"><source src="'+url+'" type="video/mp4"></video> ';
                    $(".popup-content-a .inner-content").html(html);
                    player = new Plyr('#manhal_video');
                    $(".loader-inpopup").hide();
                    if ($(".popup-enrishments-container").is(":visible")) {
                        if (typeof $(e.target).closest("#iframe").contents().find("img")[0] == "undefined" && typeof $(e.target).closest(".doaction,.plyr__control,.popup-content-a")[0] == "undefined") {
                            Closefooterindex();
                            Closepopupenrishmentscontainer();
                        }
                    }
                }else{
                    $(".loader-inpopup").show();
                if(isMobile){
                    if(url.indexOf(".pdf")!=-1 && url.indexOf("manhal.com")!=-1){
                        url=url.replace(".pdf","image_larg.jpg");
                        html='<iframe id="iframe" onload="onloadIframepdf();" scrolling="yes" width="100%" height="100%" src="'+url+'" frameborder="0"></iframe>';
                    }else{
                        html='<iframe id="iframe" style="display: none" onload="onloadIframe();" width="100%" height="100%" src="'+url+'" frameborder="0"></iframe>';
                    }
                }
                else{
                    html='<iframe id="iframe" style="display: none" onload="onloadIframe();" width="100%" height="100%" src="'+url+'" frameborder="0"></iframe>';
                }
                $(".popup-content-a .inner-content").html(html);

                }



                popupenrishmentscontainer();
                removeElementIcons($(".category-enrishments"));
                $(".category-enrishments").addClass("url");

                if(url.indexOf(".JPG")!=-1 || url.indexOf(".JPEG")!=-1 || url.indexOf(".jpg")!=-1 || url.indexOf(".jpeg")!=-1 || url.indexOf(".png")!=-1 || url.indexOf(".gif")!=-1 || url.indexOf(".GIF")!=-1 || url.indexOf(".PNG")!=-1){

                }else{
                    launchFullscreenEnrishments();
                }
                break;
            case "quiz":
                $(".popup-content-a .inner-content").html('<iframe id="iframe" class="main-widgets-iframe-container" onload="onloadIframe();" frameborder="0" src="'+$(this).attr("quiz_path")+'"></iframe>');
                popupenrishmentscontainer();
                removeElementIcons($(".category-enrishments"));
                $(".category-enrishments").addClass("quiz");
                launchFullscreenEnrishments();
                break;
            case "game":
                $(".popup-content-a .inner-content").html('<iframe id="iframe" class="main-widgets-iframe-container" onload="onloadIframe();" frameborder="0" src="'+$(this).attr("game_path")+'"></iframe>');
                popupenrishmentscontainer();
                removeElementIcons($(".category-enrishments"));
                $(".category-enrishments").addClass("game");
                launchFullscreenEnrishments();
                break;
            case "note":
                $(".popup-add-note").remove();
                scales=getScale();
                UnScale=getUnScale();
                Whalf=window.pageWidth/2*scales;
                Hhalf=window.pageHeight/2*scales;
                iwidth=window.pageWidth*0.32*scales;
                iheight=window.pageHeight*0.23*scales;

                iclass="top";
                notePosition=$(this).position();

                if(notePosition.left>Whalf){//Left Icon
                    ileft=(notePosition.left-(iwidth/2-15))*UnScale;

                }else{//Right Icon
                    ileft=(notePosition.left-(iwidth/2-15))*UnScale;
                }

                if(notePosition.top>Hhalf){//Top Icon
                    itop=(notePosition.top-iheight)*UnScale;
                    iclass="bottom";
                }else{//Right Icon
                    itop=(notePosition.top+60)*UnScale;
                }

                if(notePosition.left<iwidth){
                    ileft=(notePosition.left+35)*UnScale;
                    itop=(notePosition.top-iheight/2+35)*UnScale;
                    iclass="left";
                    if(notePosition.top<iheight/2){
                        itop=(notePosition.top)*UnScale;
                        iclass="top-left";
                    }else if(pageHeight*scales-notePosition.top<iheight){
                        itop=(notePosition.top-iheight+30)*UnScale;
                        iclass="bottom-left";
                    }
                }else if(pageWidth*scales-notePosition.left<iwidth){
                    ileft=(notePosition.left-iwidth)*UnScale;
                    itop=(notePosition.top-iheight/2+35)*UnScale;
                    iclass="right";
                    if(notePosition.top<iheight/2){
                        itop=(notePosition.top)*UnScale;
                        iclass="top-right";
                    }else if(pageHeight*scales-notePosition.top<iheight){
                        itop=(notePosition.top-iheight+30)*UnScale;
                        iclass="bottom-right";
                    }
                }

                if(isMobile){
                    itop-=$("header").height();
                }

                ifor=$(this).attr("id");



                html='<div for="'+ifor+'" style="top:'+itop+'px;left:'+ileft+'px;" class="popup-add-note mobile_noclose '+iclass+'">';
                html+='<div class="inner-container">';
                html+='<div class="head">';
                html+='<a class="close jq_close_notebaloon floating-right flaticon-closed69">X</a>';
                html+='<a class="delete jq_delete_note floating-right"></a>';
                html+='<a class="save jq_save_note floating-right"></a>';
                html+='</div>';
                html+='<div class="content">';
                html+='<textarea>'+$(this).attr("data_src")+'</textarea>';
                html+='</div> </div> </div>';

                $(this).closest(".page_container").append(html);
                if(window.sound){
                    $("#sound_opennote")[0].play();
                }
                break;
        }
    });
    $(document).on("click",".jq_close_notebaloon",function(){
        $(this).closest(".popup-add-note").remove();
    });
    $(document).on("click",".jq_save_note",function(){

        window.notes_array=getNotesArray();
        id=$(this).closest(".popup-add-note").attr("for");
        txt=$(this).closest(".popup-add-note").find("textarea").val();
        $("#"+id).attr("data_src",txt);
        if(typeof window.notes_array[window.bookid][$(".magazine").turn("page")]=="undefined"){
            window.notes_array[window.bookid][$(".magazine").turn("page")]={};
        }
        window.notes_array[window.bookid][$(".magazine").turn("page")][id]='<a class="doaction mobile_noclose jq_noclose note-icon-a ui-draggable ui-draggable-handle"  data_src="'+txt+'" id="' + id + '" actiontype="note" data_src="write note" status="0" style="'+$("#"+id).attr("style")+'"><i class="flaticon-editing aicon"></i></a>';

        //userData.notes=JSON.stringify(window.notes_array);
        userData.notes=window.notes_array;
        saveUserData();
        $(this).closest(".popup-add-note").hide();
        pageid=$(".magazine").turn("page");
        $("#menuNote_"+pageid+id).find("p").html(txt);
        if(window.sound){
            $("#sound_save")[0].play();
        }
    });
    $(document).on("click",".jq_delete_note",function(){
        pageid=$(".magazine").turn("page");
        window.notes_array[window.bookid] = ( typeof window.notes_array[window.bookid] != 'undefined' && window.notes_array[window.bookid] instanceof Object ) ? window.notes_array[window.bookid]: {};
        window.notes_array[window.bookid][pageid] = ( typeof window.notes_array[window.bookid][pageid] != 'undefined' && window.notes_array[window.bookid][pageid] instanceof Object ) ? window.notes_array[window.bookid][pageid]: {};
        id=$(this).closest(".popup-add-note").attr("for");
        delete window.notes_array[window.bookid][pageid][id];
        //userData.notes=JSON.stringify(window.notes_array);
        userData.notes=window.notes_array;
        saveUserData();
        $(this).closest(".popup-add-note").remove();
        $("#"+id).remove();
        selector="#menuNote_"+pageid+id;
        $(selector).remove();

        selector="#menuNote_"+pageid+(parseInt(id)+1).toString();
        $(selector).remove();

        selector="#menuNote_"+pageid+(parseInt(id)-1).toString();
        $(selector).remove();

        // console.log("menunote","#menuNote_"+pageid+id);
        if(window.sound){
            $("#sound_delete")[0].play();
        }
    });

});
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
}
function getUserInfo(){
    //  var url = new URL(window.location.href);
    var data={};
    data["userid"]=getUrlParameter("userid");
    data["app_secret"]=getUrlParameter("secret");
    data["secret"]=getSecret();
    data["process"]="checklogin";
    data["lang"]=window.language;
    data["bookid"]=window.bookid;
    $.ajax({
        url: window.SITE_URL+window.language+"/api/books",
        type: "POST",
        data: data,
        cache: false,
        dataType:'json',
        success: function(jsonResult){
            //console.log("login",jsonResult);
            if(jsonResult.result==1){//success
                userData.user=jsonResult.user;
                localStorage.userData=JSON.stringify(userData);
                userData=JSON.parse(localStorage.userData);
                //window.location.reload();
            }else{
                tempuser={};
                tempuser["permession"]=-1;
                userData.user=tempuser;
            }
        }
    });
}
function canRead(){
    //  var url = new URL(window.location.href);
    var data={};
    data["userid"]=getUrlParameter("userid");
    data["app_secret"]=getUrlParameter("secret");
    data["secret"]=getSecret();
    data["process"]="canread";
    data["lang"]=window.language;
    data["bookid"]=window.bookid;
    data["type"]="book";
    $.ajax({
        url: window.SITE_URL+window.language+"/api/books",
        type: "POST",
        data: data,
        cache: false,
        dataType:'html',
        success: function(Result){
            //alert(Result);
            //console.log("canreadhere",Result);
            if(Result=="1"){
                lunchBook("full");
            }else{
                lunchBook("demo");
            }
        }
    });
}

//window.pageTurning=false;
function  calcBookDimentions(){

    if(deviceType!="desktop") {
        isMobile=true;
        if($(window).width()>$(window).height()){

            //window.bookHeight=$(window).width();
            //window.bookWidth=$(window).height();
            //window.bookHeight=$(window).height()-$("header").height()-$("footer").height()-50;
            //window.bookWidth=window.bookHeight*1.507;
            if(window.bookSize=="width"){
                window.bookWidth=$(window).width();
                p=window.bookWidth/1300;
                window.bookHeight=$(window).height()-($("header").height()+$(".footer-icons-mobile").height());

            }else{
                window.bookWidth=$(window).height();
                p=window.bookWidth/980;
                window.bookHeight=$(window).width()-($("header").height()+$(".footer-icons-mobile").height());
                if(window.bookHeight>$(window).width()){
                    p=window.bookHeight/1300;
                    window.bookHeight=$(window).width()-($("header").height()+$(".footer-icons-mobile").height());
                    window.bookWidth=980*p;
                }
            }

        }else{
            if(window.bookSize=="width"){
                window.bookWidth=$(window).width();
                p=window.bookWidth/1300;
                window.bookHeight=980*p;
                if(window.bookHeight>($(window).height()-($("header").height()+$(".footer-icons-mobile").height()))){
                    p=window.bookHeight/980;
                    window.bookHeight=$(window).height()-($("header").height()+$(".footer-icons-mobile").height());
                    window.bookWidth=1300*p;
                }

        }else{
            window.bookWidth=$(window).width();
            p=window.bookWidth/980;
            //alert(p);
            //window.bookHeight=$(window).height()-($("header").height()+$(".footer-icons-mobile").height());
            window.bookHeight=1300*p;
            if(window.bookHeight>($(window).height()-($("header").height()+$(".footer-icons-mobile").height()))){
                p=window.bookHeight/1300;
                window.bookHeight=$(window).height()-($("header").height()+$(".footer-icons-mobile").height());
                window.bookWidth=980*p;
            }
        }
        }
    }else{
        window.bookHeight=$(window).height()-$("header").height()-$("footer").height()-50;
        if(window.bookSize=="width"){
            p= window.bookHeight/980;
            window.bookWidth=1300*p;
        }else{
            window.bookWidth=window.bookHeight*1.507;
        }

        //if(window.bookSize=="width"){
        //    window.bookWidth=window.bookHeight;
        //    window.bookHeight=x;
        //}

    }



}

function showMsg(type, title, message) {
    //sweetAlert(title, message, type);
    swal({ html:true, title:title, type:type, text:message});
}
function isEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function getSecret(){
    return "asdjh787AJH23djHFGB6672399GUJHGBnkjgh123fghgasd67HJKV8asbqlga345Fyhasd2343";
}


function hideLoader(){
    $(".loader-main-container").hide();
}
function showLoader(){
    $(".loader-main-container").show();
}
function saveUserData(){
    // console.log("start saving note");
    userData.bookid=window.bookid;
    localStorage.userData=JSON.stringify(userData);
    if(typeof userData.user!="undefined" && typeof userData.user["userid"]!="undefined"){
        // console.log("saving note");
        var data={};
        data["secret"]=getSecret();
        data["process"]="saveuserdata";
        data["lang"]=window.language;
        data["data"]= localStorage.userData;
        data["bookid"]= localStorage.userData;
        $.ajax({
            url: window.SITE_URL+window.language+"/api/books",
            type: "POST",
            data: data,
            cache: false,
            dataType:'json',
            success: function(jsonResult){
                // console.log("jsonResult",jsonResult);
            }
        });
    }

}
function onloadIframe(){
    $('#iframe').hide();
    setTimeout(function () {
        if ($("#iframe").contents().find("img").length==1) {
            if($(window).width()<=1024) {
                $("#iframe").contents().find("img").first().css({
                    "width": "80%",
                    "object-fit": "cover",
                    "left": "0",
                    "right": "0",
                    "top": "0",
                    "bottom": "0",
                    "position": "absolute",
                    "margin": "auto",
                    "border-radius": "15px"
                });
                $("#iframe").contents().find("body").css({"overflow": "hidden"});
            }
            else {
                $("#iframe").contents().find("img").first().css({
                    "width": "90%",
                    "object-fit": "cover",
                    "left": "0",
                    "right": "0",
                    "top": "0",
                    "bottom": "0",
                    "position": "absolute",
                    "margin": "auto",
                    "border-radius": "15px"
                });
                $("#iframe").contents().find("body").css({"overflow": "hidden"});
            }
        }
        $('#iframe').show();
        $(".loader-inpopup").hide();
    },1100);

}
function onloadIframepdf(){
    if ($("#iframe").contents().find("img").length==1) {
        $("#iframe").contents().find("body").first().children("img").first().css({
            "width": "60%",
            "object-fit": "cover",
            "left": "0",
            "right": "0",
            "top": "0",
            "bottom": "0",
            "position": "absolute",
            "margin": "auto"
        });
    }
    $(".loader-inpopup").hide();
}

function start(){
    console.log('in start');
    if(getUrlParameter("tog")=="1")
    {
        $(".logo-manhal.floating-right").addClass("together");
    }
    if(getUrlParameter("o")=="qr" || window.platform=="imanhal"){
        console.log('in if start');
        lunchBook("full");
    }else if(getUrlParameter("o")=="demo"){
        var today = new Date();
        today.setHours(0,0,0,0);
        if(typeof localStorage.demoBook !="undefined" && typeof localStorage.demoBook !=null && typeof localStorage.demoBook !="" && localStorage.demoBook!="undefined" && localStorage.demoBook!="") {
            demoBook=JSON.parse(localStorage.demoBook);
            if(typeof demoBook[window.bookid] !="undefined" && typeof  demoBook[window.bookid] !=null){
                var demoDate=new Date(demoBook[window.bookid]);
                demoDate.setDate(demoDate.getDate() + 7);
                if(demoDate>today){
                    lunchBook("full");
                    console.log('a1')
                }else{
                    lunchBook("demo");
                    console.log('a2')
                }
            }else{
                demoBook[window.bookid]=today;
                localStorage.demoBook=JSON.stringify(demoBook);
                lunchBook("full");
                console.log('a3')
            }
        }else{
            demoBook[window.bookid]=today;
            localStorage.demoBook=JSON.stringify(demoBook);
            lunchBook("full");
            console.log('a4')
        }
    }else{
        if(typeof userData.user=="undefined" || userData.user=="" || userData.user['permession']==-1 || userData.user['permession']==0){
            //if(userData.user['permession']==0){
            //if(window.location.hostname=="manhal.com"){
            if((window.location.href).indexOf("secret")!=-1){
                canRead();
            }else{

                //console.log("canread","4");
                $.ajax({
                    url: window.SITE_URL+"platform/ajax/platform.php?process=canread&type=book&bookid="+window.bookid,
                    type: "POST",
                    cache: false,
                    dataType:'html',
                    success: function(html){
                        //console.log("canread",html);
                        if(html==0){
                            lunchBook("demo");
                        }else{
                            lunchBook("full");
                        }
                    }
                });
            }
        }else{
            var user=userData.user;
            if (user.permession > 0 && user.permession < 12) {
                lunchBook("full");
            }else{
                lunchBook("demo");
            }
        }
    }
}
function lunchBook(type){
    if(type=="demo"){
        window.lastPage=13;
    }
    yepnope({
        test : Modernizr.csstransforms,
        yep: ['js/turn.js'],
        nope: ['js/turn.html4.min.js'],
        both: ['js/zoom.min.js', 'js/magazine.js?v=1', 'css/magazine.css'],
        complete: loadApp
    });

    drawThumbs();
    drawNotes();
    drawUnits();
    makeCode();
    $(".jq_numberofpages").html("<span class='floating-right'>من</span><div class='num floating-right'>"+(window.lastPage-3).toString()+"</div>");
    window.BookMark_array=getBookmarkArray();
    drawBookmarks();
    drawTimeline();
    if(typeof userData.showEnrichment=="undefined"){
        userData.showEnrichment=true;
    }
    if(userData.showEnrichment=="true" || userData.showEnrichment==true || typeof userData.showEnrichment=='undefined' || typeof userData.showEnrichment==undefined  || window.DeviceWidth<=1024){
        $(".page_container .doaction").fadeIn();
    }else{
        $("footer .setting-page-popup a.Enrichment").addClass("Enrichment1");
        $("footer .setting-page-popup a.Enrichment").removeClass("Enrichment");
        $(".page_container .doaction").fadeOut();
    }
}
function openPage(page,target){

        if(window.zoomed){
            footerzoom();
            timeOut=900;
        }else{
            timeOut=0;
        }
        setTimeout(function(){
            if($(target).closest(".box-container-index").hasClass("jq_play")){
                play();
                setTimeout(function () {
                    $('.magazine').turn('page', page);
                    setTimeout(function(){
                        reScale();
                    },50);
                },50);
            }else{
                $('.magazine').turn('page', page);
                setTimeout(function(){
                    reScale();
                },50);
            }
        },timeOut);


    pagenumber=parseInt(page)-2;
    if(pagenumber<0){
        pagenumber=0;
    }
    $('#page-number').val(pagenumber);

}
function getPagename(page){
    if(parseInt(page)<0){
        return "p0000.html";
    }
    if(!isNaN(page)){
        if(page>window.lastPage){
            return "last.html";
        }else if(page<0){
            return "first.html";
        }
    }
    switch(page.toString().length){
        case 1:
            pageName="p000"+page;
            break;
        case 2:
            pageName="p00"+page;
            break;
        case 3:
            pageName="p0"+page;
            break;
        case 4:
            pageName="p"+page;
            break;
        default:
            pageName=page.toString();
            break;
    }

    pageName+=".html";
    return pageName;
}
function getScale(){
    if($('.magazine').turn("display")=="single"){
        return window.bookHeight/1300;
        // return $('.page_container').first().width()/window.pageWidth;
    }else{
        return $('.magazine').width()/2/window.pageWidth;
    }
}
function getUnScale(){
    if($('.magazine').turn("display")=="single"){
        return window.pageWidth/$('.magazine').width();
    }else{
        return window.pageWidth*2/$('.magazine').width();
    }
}
Object.defineProperty(Array.prototype, "itemarray_remove", {
    enumerable: false,
    value: function (itemToRemove) {
        var removeCounter = 0;
        for (var index = 0; index < this.length; index++) {
            if (this[index] === itemToRemove) {
                this.splice(index, 1);
                removeCounter++;
                index--;
            }
        }
        return removeCounter;
    }
});
function getNotesArray(){
    pageid=$(".magazine").turn("page");
    if(userData.notes==undefined||userData.notes==""||userData.notes==null){
        notes_array= {};
        notes_array[window.bookid] = {};
        notes_array[window.bookid][pageid] = {};
    }else {
        //notes_array = JSON.parse(userData.notes);
        notes_array =userData.notes;
        if(notes_array[window.bookid]==undefined||notes_array[window.bookid]==""||notes_array[window.bookid]==null) {
            notes_array[window.bookid] = {};
            notes_array[window.bookid][pageid] = {};
        }else{
            if(notes_array[window.bookid][pageid]==undefined||notes_array[window.bookid][pageid]==""||notes_array[window.bookid][pageid]==null) {
                notes_array[window.bookid][pageid] = {};
            }
        }
    }
    return notes_array;
}
function getBookmarkArray(){
    if(userData.bookmark==undefined||userData.bookmark==""||userData.bookmark==null) {
        BookMark_array ={};
        BookMark_array[window.bookid]={};
    }else{
        //BookMark_array = JSON.parse(userData.bookmark);
        BookMark_array =userData.bookmark;
        if(BookMark_array[window.bookid]==undefined||BookMark_array[window.bookid]==""||BookMark_array[window.bookid]==null) {
            BookMark_array[window.bookid]={};
        }
    }
    return BookMark_array;
}
function drawNotes(){
    $(".notebook-content").html("");

    if(userData.notes==undefined||userData.notes==""||userData.notes==null){
        notes_array= {};
        notes_array[window.bookid] = {};
    }else {
        //notes_array = JSON.parse(userData.notes);
        notes_array = userData.notes;
        if(notes_array[window.bookid]==undefined||notes_array[window.bookid]==""||notes_array[window.bookid]==null) {
            notes_array[window.bookid] = {};
        }
    }
    pages= window.notes_array[window.bookid];
    for (var notes in pages) {
        for (var note in pages[notes]) {
            $("#tempdiv").html(pages[notes][note]);
            txt=$("#tempdiv").find(".doaction").first().attr("data_src");
            $("#tempdiv").html("");
            $(".notebook-content").append('<div class="item-container" id="menuNote_'+notes+note+'"><div class="icon-content opennote floating-right"  note_id="'+note+'" pageid="'+notes+'"><i class="floating-right"></i><label class="floating-right">'+(parseInt(notes)-2).toString()+'</label></div><p class="text-content floating-right">'+txt+'</p><a class="delete-content mobile_noclose jq_noclose delete-note floating-right button-animation" onclick="deleteiconlocal('+String.fromCharCode(39)+'note'+String.fromCharCode(39)+','+String.fromCharCode(39)+note+String.fromCharCode(39)+','+String.fromCharCode(39)+notes+String.fromCharCode(39)+')"></a></div>');
        }
    }
}
function launchFullscreen() {
    $(".viewer-container .exit-full-screen").hide();
    if(window.zoomed==1){
        return;
    }
    element = document.getElementById("bodys");
    element.style.display="";
    if (element.requestFullscreen) {
        element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if (element.webkitRequestFullscreen) {
        element.webkitRequestFullscreen();
    } else if (element.msRequestFullscreen) {
        element.msRequestFullscreen();
    }
    //setTimeout(function(){
    //    $(".frame-content").height($(window).height());
    //    $(".panzoom").height($(window).height());
    //},300);
    window.fullScreen=true;
    if($(".magazine").turn("display")=="double"){
        setTimeout(function () {
            oldHeight=$(".magazine").height();
            newHeight=$(window).height()-50;
            p=newHeight/oldHeight;
            newWidth=$(".magazine").width()*p;

            $('.magazine-viewport').css({
                width: newWidth,
                height: newHeight
            });
            $(".magazine").turn("size", newWidth,newHeight);
            setTimeout(function () {
                reScale();
                setTimeout(function () {
                    $(".magazine").turn("center");
                },150);
            },150);
        },150);
    }else{
        setTimeout(function () {
            oldHeight=$(".magazine").height();
            newHeight=$(window).height()-50;
            p=newHeight/oldHeight;
            newWidth=$(".magazine").width()*p;

            $('.magazine-viewport').css({
                width: newWidth,
                height: newHeight
            });
            $(".magazine").turn("size", newWidth,newHeight);
            setTimeout(function () {
                reScale();
                setTimeout(function () {
                    $(".magazine").turn("center");
                },150);
            },150);
        },150);

    }

}
function cancelFullScreen() {

}
document.addEventListener("fullscreenchange", cancelFullScreen, false);
document.addEventListener("webkitfullscreenchange", cancelFullScreen, false);
document.addEventListener("mozfullscreenchange", cancelFullScreen, false);
$(document).bind('webkitfullscreenchange mozfullscreenchange fullscreenchange', function(e) {
    var state = document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen;
    var event = state ? 'FullscreenOn' : 'FullscreenOff';
    if(event=="FullscreenOff" && window.fullScreen){
        window.fullScreen=false;
            setTimeout(function () {
                newHeight= window.bookHeight;
                newWidth= window.bookWidth;
                if($(".magazine").turn("display")=="single"){
                    newWidth=newWidth/2;
                }

                $('.magazine-viewport').css({
                    width: newWidth,
                    height: newHeight
                });
                $(".magazine").turn("size", newWidth,newHeight);
                setTimeout(function () {
                    reScale();
                    setTimeout(function () {
                        $(".magazine").turn("center");
                    },100);
                },100);
            },100);
            exitFullscreen();
    }
});
function exitFullscreen() {

    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    }

    setTimeout(function(){
        resizeViewport();

        if($(".magazine").turn("display")=="single" && window.fullScreen){
            //if (window.bookWidth > window.pageWidth) {
            //    newWidth = window.bookWidth / 2;
            //} else {
            //    newWidth = window.bookWidth;
            //}
            newHeight=$(window).height()-50;
            p=newHeight/bookHeight;
            newWidth=(bookWidth*p)/2;
            $(".magazine").width(newWidth);
            $(".magazine").css("left",($(window).width()-$(".magazine").width())/2-$(".container").offset().left);
        }
        setTimeout(function(){
            reScale();
        },500);
    },150);

}
function getPageNumber(page){
    if(isNaN(page)){
        page=page.replace("p","");
        page=page.replace(/^[0]+/g, '');
        page.replace(".html","");
        if(isNaN(parseInt(page))){
            return 0;
        }else{
            return parseInt(page);
        }
    }else{
        return 0;
    }
}
function randomString(len){
    charSet ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var randomString = '';
    for (var i = 0; i < len; i++) {
        var randomPoz = Math.floor(Math.random() * charSet.length);
        randomString += charSet.substring(randomPoz,randomPoz+1);
    }
    return randomString;
}
function loadEnrichments(){
    $(".enrichment-container").html("");
    class1="p"+$(".magazine").turn("page");
    getEnrichments(class1);
    if($(".magazine").turn("display")=="double"){
        if($(".magazine").turn("page")%2==0){
            class2="p"+($(".magazine").turn("page")+1).toString();
        }else{
            class2="p"+($(".magazine").turn("page")-1).toString();
        }

        getEnrichments(class2);
    }
}
function getEnrichments(cls){
    result="";
    $("."+cls+" .doaction").each(function(){
        temp="";
        switch ($(this).attr("actiontype")){
            case "youtube":
                temp='<div class="jq_enrichment item-container" title="'+$(this).attr("title")+'" actiontype="'+$(this).attr("actiontype")+'" data_src="'+$(this).attr("data_src")+'">';
                temp+='<div class="icon-content floating-right"><i class="floating-right youtube"></i></div>';
                temp+='<p class="text-content floating-right">'+$(this).attr("title")+'</p></div>';
                result+=temp;
                $(".enrichment-container").append(result);
                break;
            case "image":
                temp='<div class="jq_enrichment item-container" title="'+$(this).attr("title")+'" actiontype="'+$(this).attr("actiontype")+'" data_src="'+$(this).attr("data_src")+'">';
                temp+='<div class="icon-content floating-right"><i class="floating-right image"></i></div>';
                temp+='<p class="text-content floating-right">'+$(this).attr("title")+'</p></div>';
                result+=temp;
                $(".enrichment-container").append(result);
                break;
            case "url":
                temp='<div class="jq_enrichment item-container" title="'+$(this).attr("title")+'" actiontype="'+$(this).attr("actiontype")+'" data_src="'+$(this).attr("data_src")+'">';
                temp+='<div class="icon-content floating-right"><i class="floating-right url"></i></div>';
                temp+='<p class="text-content floating-righ">'+$(this).attr("title")+'</p></div>';
                result+=temp;
                $(".enrichment-container").append(result);
                break;
            case "game":
                temp='<div class="jq_enrichment item-container" title="'+$(this).attr("title")+'" actiontype="'+$(this).attr("actiontype")+'" data_src="'+$(this).attr("data_src")+'" game_path="'+$(this).attr("game_path")+'">';
                temp+='<div class="icon-content floating-right"><i class="floating-right game"></i></div>';
                temp+='<p class="text-content floating-right">'+$(this).attr("title")+'</p></div>';
                result+=temp;
                $(".enrichment-container").append(result);
                break;
            case "douknow":
                temp = '<div class="jq_enrichment item-container" title="' + $(this).attr("title") + '" actiontype="' + $(this).attr("actiontype") + '" data_src="' + $(this).attr("data_src") +'"  desc="' + $(this).attr("desc") +'" >';
                temp += '<div class="icon-content floating-right"><i class="floating-right info"></i><label style="display:none;" class="enr-data">'+$(this).find(".enr-data").html()+'</label></div>';
                temp += '<p class="text-content floating-right">' + $(this).attr("title") + '</p></div>';
                result += temp;
                $(".enrichment-container").append(result);


                break;
            case "quiz":
                temp='<div class="jq_enrichment item-container" title="'+$(this).attr("title")+'" actiontype="'+$(this).attr("actiontype")+'" data_src="'+$(this).attr("data_src")+'">';
                temp+='<div class="icon-content floating-right"><i class="floating-right quiz"></i></div>';
                temp+='<p class="text-content floating-right">'+$(this).attr("title")+'</p></div>';
                result+=temp;
                $(".enrichment-container").append(result);
                break;
            case "note":
                temp='<div class="jq_enrichment item-container" title="'+$(this).attr("title")+'" actiontype="'+$(this).attr("actiontype")+'" data_src="'+$(this).attr("data_src")+'">';
                temp+='<div class="icon-content floating-right"><i class="floating-right worksheet"></i></div>';
                temp+='<p class="text-content floating-right">'+$(this).attr("title")+'</p></div>';
                break;
            case "circle":
                temp='<div class="jq_enrichment item-container" title="'+$(this).attr("title")+'" actiontype="'+$(this).attr("actiontype")+'" data-word="'+$(this).attr("data-word")+'" data-thumb1="'+$(this).attr("data-thumb1")+'" data-thumb2="'+$(this).attr("data-thumb2")+'" data-thumb3="'+$(this).attr("data-thumb3")+'" data-thumb4="'+$(this).attr("data-thumb4")+'" data-true="'+$(this).attr("data-true")+'" data_src="'+$(this).attr("data_src")+'">';
                temp+='<div class="icon-content floating-right"><i class="floating-right game"></i></div>';
                temp+='<p class="text-content floating-right">'+$(this).attr("title")+'</p></div>';
                result+=temp;
                $(".enrichment-container").append(result);
                break;
        }
    });


}
function deleteiconlocal(type,id,page) {
    switch(type){
        case "mark":
            $("#menuMark_"+id).remove();
            delete BookMark_array[window.bookid]["menuMark_"+id];
            //userData.bookmark=JSON.stringify(BookMark_array);
            userData.bookmark=BookMark_array;
            BookMark_array=getBookmarkArray();
            saveUserData();
            break;
        case "note":
            $('div[for="'+id+'"]').remove();
            $("#"+id).remove();
            $("#menuNote_"+page+id).remove();

            delete  window.notes_array[bookid][page][id];
             $(".note-container[for='"+id+"']").remove();
           // userData.notes=JSON.stringify(window.notes_array);
            userData.notes=window.notes_array;
            saveUserData();
            break;
    }

    if(window.sound){
        $("#sound_delete")[0].play();
    }
}
function drawBookmarks(){
    DtaBookmark="";
    bookmarks= BookMark_array[window.bookid];
    for (var key in bookmarks) {
        pkey=bookmarks[key]+1;
        openpage=bookmarks[key]+2;

        arr=getPagename(pkey).split(".");
        pageName=arr[0];
        pageName=pageName;
        var title=$xml.find("pagetitle")[bookmarks[key]].textContent;
        DtaBookmark+='<div class="item-container animated fadeInRight jq_noclose mobile_noclose" id="menuMark_'+bookmarks[key]+'"><a class="thumb-item" onclick="openPage('+openpage+',this)" style="background: url('+pageName+'_thumb.jpg)"><div class="mark"></div></a>' +
            '<div class="thumb-number-page"><label class="floating-right">'+bookmarks[key]+'</label>' +
            '<a onclick="deleteiconlocal('+String.fromCharCode(39)+'mark'+String.fromCharCode(39)+','+bookmarks[key]+')" class="delete-note floating-left button-animation"></a></div></div>';
    }
    $(".bookmark-content").html(DtaBookmark);
}
function objectSearch(objects,toSearch){
    for (var k in objects) {
        if (objects[k]==toSearch) {
            return true;
        }
    }
    return false;
}
function makeCode(){
    $("#textQR").val(window.location.href);
    var qrcode = new QRCode("qrcode");
    var elText = document.getElementById("textQR");
    qrcode.makeCode(elText.value);
}
function drawUnits(){
    var i=0;
    var lessoni=1;
    html='';
    $xml.find("unit").each(function(){
        i++;
        html+='<div class="item-box-container"><div class="inner-item-box-container"><div class="box-right"><div class="number-section"><span>'+i+'</span></div><div class="book-shape"></div></div> <div class="box-left">'+
            '<div class="title"><span onclick="openPage('+(parseInt($(this).find("pagenumber").first().text())+2).toString()+',this)">'+$(this).find("unitname").text()+'</span></div>'+
        '<div class="bottom-container-index"><div class="inner-right floating-right">';
        $(this).find("lesson").each(function () {
            lesson_index[lessoni]=$(this).find("pagenumber").text();
            lessoni++;
            html+='<div class="floating-right item-row-container" onclick="openPage('+(parseInt($(this).find("pagenumber").text())+2).toString()+',this)"><div class="item-blue floating-right">'+
                '<div class="word floating-right"><span>'+$(this).find("lessonname").text()+'</span></div>'+
                '<div class="number-pages floating-right"><span>'+$(this).find("pagenumber").text()+'</span></div></div></div>';
        });
           html+='</div><div class="inner-left floating-right"></div></div></div></div> <div class="item-effect"></div> </div>';
    });
    $(".box-container-index").html(html);
}
function drawTimeline(){
    var user=userData.user;
    var i=0;
    html='';
    var lessoni=1;

    last=0;
    enr_lesson={};
    for (var lesson in lesson_index) {
        enr_lesson[lesson]="";
        for(var i=parseInt(last)+1;i<=lesson_index[(parseInt(lesson)+1).toString()];i++){
            if(typeof window.enrichments[i]!="undefined"){
                enr_lesson[lesson]+=window.enrichments[i];
                // console.log("lesson = ",lesson+" --- "+i);
            }

        }
        last=lesson_index[(parseInt(lesson)+1).toString()];

    }

    i=0;
    if($(window).width()<=768 || $(window).width()==1024) {
        playJS="";
    }else{
        playJS="play();";
    }
    $xml.find("unit").each(function(){
        i++;
        html+='<div class="level"><div class="unit-number">' +
                    $(this).find("unitname").text()+'</div>';

        $(this).find("lesson").each(function (){

                    html+='<div class="cd-timeline-block"><div class="cd-timeline-img pic"><i></i></div>' +
                        '<div class="cd-timeline-content" onclick="openPage('+(parseInt($(this).find("pagenumber").text())+2).toString()+',this)"><span onclick="'+playJS+'" class="cd-date">'+$(this).find("lessonname").text()+'</span>'+
                    '<div class="icons-container">';
            if(user.permession==10 || user.permession==11 || user.permession==1 || user.permession==2 || lessoni<=2){
                    html+=enr_lesson[lessoni]+"</div></div></div>";
            }else{
                html+="</div></div></div>";
            }

            lessoni++;
        });
        html+='</div></div>';
    });
    $("#cd-timeline").html(html);

}
function showValue(newValue) {
    newValue=newValue/10+1;
    $(".magazine").turn("zoom", newValue);
}
function drawThumbs(){
    htmlThumbs="";
    var flag=false;
    window.enrichments={};
    $xml.find("pagesearch").each(function(){
        thumbpage=$(this).find("pagename").text();
        thumbpage=$(this).find("pagename").text();
        aTitle=$(this).find("pagetitle").text();
        htmlThumbs+='<a class="openpage thumb-item" pagename="'+thumbpage+'" style="background: url('+thumbpage+'_thumb.jpg)" title="'+aTitle+'" ></a>';
        pagen=getPageNumber(thumbpage);
        window.enrichments[pagen]='';
        flag=false;
        $(this).find("enrichment").each(function(){
            flag=true;
            attributes='';
            $.each(this.attributes, function(i, attrib){
                var name = attrib.name;
                var value = attrib.value;
                if(name=="class"){
                    value+=" jq_enrichment";
                }
                attributes+=' '+name+'="'+value+'"';
            });
            iconTitle=$(this).attr("title");
            window.enrichments[pagen]+='<a '+attributes+'>'+iconTitle+'</a>';
        });
        if(!flag){
            window.enrichments[pagen]+='';
        }
    });
    $("#thumb_container").html(htmlThumbs);
}
function getNotes(page){
    if(typeof window.notes_array != 'undefined'){
        if(typeof window.notes_array[window.bookid][page] != 'undefined' && window.notes_array[window.bookid][page]!=undefined && window.notes_array[window.bookid][page]!=null ){
            notes= window.notes_array[window.bookid][page];
            for (var key in notes) {
                $(".p"+page+" .page_container").append(notes[key]);
            }
        }
    }
}
function refreshElements(){
    //$(".doaction[actiontype='note']").draggable("destroy");
    $(".doaction[actiontype='note']").draggable({
        start :function( event, ui){
            isDraging=true;
            id=$(this).attr("id");
            page=$(".magazine").turn("page");
            txt=$(this).attr("data_src");
            if(typeof window.notes_array[window.bookid][page]=="undefined"){
                window.notes_array[window.bookid][page]={};
            }
            $(".popup-add-note").remove();
            ui.position.left = 0;
            ui.position.top = 0;
        },
        containment: $(this).closest(".page_container"),
        drag: function(event, ui) {
            scales=getScale();
            var changeLeft = ui.position.left - ui.originalPosition.left; // find change in left
            //var newLeft = ui.originalPosition.left + changeLeft / (scales['zoom']); // adjust new left by our zoomScale
            var newLeft = ui.originalPosition.left + changeLeft / scales; // adjust new left by our zoomScale

            var changeTop = ui.position.top - ui.originalPosition.top; // find change in top
            //var newTop = ui.originalPosition.top + changeTop / scales['zoom']; // adjust new top by our zoomScale
            var newTop = ui.originalPosition.top + changeTop / scales; // adjust new top by our zoomScale
            if($(".magazine").turn("display")=="double"){
                if(newLeft<0){
                    if($(".p"+page).hasClass("even")){

                        delete  window.notes_array[window.bookid][page][id];
                        newPage=parseInt(page)+1;
                        if(typeof window.notes_array[window.bookid][newPage]=="undefined"){
                            window.notes_array[window.bookid][newPage]={};
                        }
                        window.notes_array[window.bookid][newPage][id]='<a id="'+id+'" class="doaction mobile_noclose jq_noclose note-icon-a ui-draggable ui-draggable-handle" actiontype="note" data_src="'+txt+'" status="0" style="'+$("#"+id).attr("style")+'"><i class="flaticon-editing aicon"></i></a>';
                        $(this).draggable("disable");
                        if(isMobile){
                            newLeft=parseInt($(this).closest(".page_container").width())-40;
                        }else{
                            newLeft=parseInt($(this).closest(".page_container").width())-40;
                        }

                        $(this).remove();
                        $(".p"+newPage).find(".page_container").append('<a id="'+id+'" class="doaction mobile_noclose jq_noclose note-icon-a ui-draggable ui-draggable-handle" actiontype="note" data_src="'+txt+'" status="0" style="position: absolute;left:'+newLeft+'px;top:'+newTop+'px;"><i class="flaticon-editing aicon"></i></a>');
                        refreshElements();
                    }
                }else if(newLeft>980){
                    page++;
                    if($(".p"+page).hasClass("odd")){
                        delete  window.notes_array[window.bookid][page][id];
                        newPage=parseInt(page)-1;
                        if(typeof window.notes_array[window.bookid][newPage]=="undefined"){
                            window.notes_array[window.bookid][newPage]={};
                        }
                        window.notes_array[window.bookid][newPage][id]='<a id="'+id+'" class="doaction mobile_noclose jq_noclose note-icon-a ui-draggable ui-draggable-handle" actiontype="note" data_src="'+txt+'" status="0" style="'+$("#"+id).attr("style")+'"><i class="flaticon-editing aicon"></i></a>';
                        $(this).draggable("disable");
                        newLeft=15;
                        $(this).remove();
                        $(".p"+newPage).find(".page_container").append('<a id="'+id+'" class="doaction mobile_noclose jq_noclose note-icon-a ui-draggable ui-draggable-handle" actiontype="note" data_src="'+txt+'" status="0" style="position: absolute;left:'+newLeft+'px;top:'+newTop+'px;"><i class="flaticon-editing aicon"></i></a>');
                        refreshElements();
                    }
                }
            }
            ui.position.left = newLeft;
            ui.position.top = newTop;

        },
        stop: function( event, ui ) {
            p=$(this).position();
            if(p.left<15){
                $(this).css("left","15px");
            }
            if(p.left>$(this).closest(".page_container").width()*scale-$(this).width()-15){
                $(this).css("left",$(this).closest(".page_container").width()*scale-$(this).width()-15+"px");
            }
            if(p.top<15){
                $(this).css("top","15px");
            }
            if(p.top>$(this).closest(".page_container").height()*scale-$(this).height()-15){
                $(this).css("top",$(this).closest(".page_container").height()*scale-$(this).height()-15+"px");
            }

            window.notes_array[window.bookid][page][id]='<a id="'+id+'" class="doaction mobile_noclose jq_noclose note-icon-a ui-draggable ui-draggable-handle" actiontype="note" data_src="'+txt+'" status="0" style="'+$("#"+id).attr("style")+'"><i class="flaticon-editing aicon"></i></a>';
            //userData.notes=JSON.stringify(window.notes_array);
            userData.notes=window.notes_array;
            saveUserData();
            isDraging=false;
        }
    });
}
function openNote(id){

    $('.doaction[id="'+id+'"]').click();
}
function removeElementIcons(e){
    e.removeClass("image").removeClass("youtube").removeClass("url").removeClass("exercise").removeClass("game").removeClass("gift").removeClass("sound").removeClass("worksheet");
}
function getSoundID(path){
    exp=path.split("/");
    names=exp[exp.length-1];
    nameArr=names.split(".");
    return nameArr[0];
}
function loadApp() {
    $('#canvas').fadeIn(1000);
    var flipbook = $('.magazine');
    // Check if the CSS was already loaded
    if (flipbook.width()==0 || flipbook.height()==0) {
        setTimeout(loadApp, 10);
        return;
    }

    if(isMobile){
        duration=0;
        elevation=0;
        gradients=false;
        displayType="single";
    }else{
        elevation=1500;
        duration=1800;
        gradients=true;
        if(window.bookSize=="width"){
            displayType="single";
            $(".view-page-popup").addClass("hide-option");
        }else{
        displayType="double";
            $(".view-page-popup").removeClass("hide-option");
    }

    }

    // Create the flipbook
    flipbook.turn({
        // Magazine width
        width:  window.bookWidth,
        // Magazine height
        height:  window.bookHeight,
        // Duration in millisecond
        duration: duration,
        // Hardware acceleration
        acceleration:true,
        // Enables gradients
        gradients: gradients,
        // Auto center this flipbook
        autoCenter: true,
        // Elevation from the edge of the flipbook when turning a page
        elevation: elevation,
        direction:"rtl",
        Boolean	:true,
        display:displayType,
        // The number of pages
        pages: window.lastPage-1,
        // Events
        when: {
            start: function (event, pageObject, corner) {
                if (corner == 'tl' || corner == 'tr')
                {
                    event.preventDefault();
                }
            },
            turning: function(event, page, view) {
                $('textarea').blur();
                $("#slide")[0].play();
                if(!isMobile){
                   var book = $(this),
                       currentPage = book.turn('page'),
                       pages = book.turn('pages');
                   // Update the current URI

                   // Show and hide navigation buttons
                   disableControls(page);
               }
                Hash.go('page/' + page).update();
            },
            turned: function(event, page, view) {
                    reScale();
                    var book = $(this);
                    pagenumber=page-2;
                    if(pagenumber<0){
                        pagenumber=0;
                    }
                    $('#page-number').val(pagenumber);

                loadEnrichments();
                if(userData.showEnrichment=="true" || userData.showEnrichment==true || typeof userData.showEnrichment=='undefined' || typeof userData.showEnrichment==undefined || window.DeviceWidth<=1024){
                    $(".page_container .doaction").show();
                }else{
                    $(".page_container .doaction").hide();
                }
                refreshElements();
                if(page>=lastPage-1){
                    if(typeof userData.user=="undefined" || userData.user=="null" || userData.user=="" || userData.user['permession']==-1){
                        OpenSignIn();
                    }else if(userData.user['permession']==0){
                        OpenActivation();
                    }
                }
                var rp=page-2;
                if($("#menuMark_"+rp).length>0){
                    $(".icon-header-mobile .bookmark").addClass("active");
                }else{
                    $(".icon-header-mobile .bookmark").removeClass("active");
                }
            },
            end: function(e, pageObj) {

            },
            missing: function (event, pages) {
                // Add pages that aren't in the magazine
                //setTimeout(function(){

                    for (var i = 0; i < pages.length; i++)
                        addPage(pages[i], $(this));
                //},500);

            }
        }
    });


        // Zoom.js
        $('.magazine-viewport').zoom({
            flipbook: $('.magazine'),
            max: function() {
                return largeMagazineWidth()/$('.magazine').width();
            },
            when: {
                swipeLeft: function() {
                    //flipbook.turn('previous');
                },
                swipeRight: function() {
                    //flipbook.turn('next');
                },
                resize: function(event, scale, page, pageElement) {

                    reScale();

                },
                zoomIn: function () {
                    window.zoomed=1;
                    $('.made').hide();
                    $('.magazine').removeClass('animated').addClass('zoom-in');
                    $('.zoom-icon').removeClass('zoom-icon-in').addClass('zoom-icon-out');

                    if (!window.escTip && !$.isTouch) {
                        escTip = true;

                        $('<div />', {'class': 'exit-message'}).
                        html('<div>Press ESC to exit</div>').
                        appendTo($('body')).
                        delay(2000).
                        animate({opacity:0}, 500, function() {
                            $(this).remove();

                        });
                    }
                    $(".body").css("right","auto");
                    $(".goto-full-container-footer").hide();
                    setTimeout(function(){
                        reScale();
                    },50);
                },
                zoomOut: function () {
                    $('.exit-message').hide();
                    $('.made').fadeIn();
                    $('.zoom-icon').removeClass('zoom-icon-out').addClass('zoom-icon-in');
                    $(".body").css("right","0px");
                    $(".goto-full-container-footer").show();
                    setTimeout(function(){
                        $('.magazine').addClass('animated').removeClass('zoom-in');
                        reScale();
                        setTimeout(function(){
                            // resizeViewport();
                        },500);
                        window.zoomed=0;

                    }, 50);
                }
            }
        });




    // Zoom event
    //if ($.isTouch) {
    //   // $('.magazine-viewport').bind('zoom.tap', zoomTo);
    //    $('.magazine-viewport').bind('doubleTap', zoomTo);
    //}
    //else {
    //    $('.magazine-viewport').bind('doubleTap', zoomTo);
    //}

    // Using arrow keys to turn the page
    $(document).keydown(function(e){
        var previous = 37, next = 39, esc = 27;
        switch (e.keyCode) {
            case previous:
                // left arrow
                $('.magazine').turn('next');
                e.preventDefault();
                break;
            case next:
                //right arrow
                $('.magazine').turn('previous');
                e.preventDefault();
                break;
            case esc:
                $('.magazine-viewport').zoom('zoomOut');
                e.preventDefault();
                $(".magazine-viewport").css("top","-10px");

                if(window.sound){
                    $("#sound_close")[0].play();
                }
                $('.magazine-viewport').zoom('zoomOut');
                $(".third-section-viewer .book-viewer-container footer .zoom-popup").addClass("fade-bottom");
                $(".third-section-viewer .book-viewer-container footer .zoom-popup").removeClass("fade-top");
                $(".third-section-viewer .book-viewer-container footer .view-page-popup a.zoom").removeClass("zoom1");
                viewzoom=1;
                break;
        }
    });


    // URIs - Format #/page/1
    Hash.on('^page\/([0-9]*)$', {
        yep: function(path, parts) {
            var page = parts[1];

            if (page!==undefined) {
                if ($('.magazine').turn('is'))
                    $('.magazine').turn('page', page);
            }

        },
        nop: function(path) {

            if ($('.magazine').turn('is'))
                $('.magazine').turn('page', 1);
        }
    });


    $(window).resize(function() {
        //if($(window).height()!=DeviceHeight && $(window).width()!=DeviceWidth){
        //    $(".viewport-image").addClass("viewport");
        //}else{
        //    $(".viewport-image").removeClass("viewport")
        //}
        //
        //resizeViewport();
    }).bind('orientationchange', function() {

        setTimeout(function(){
            if(window.bookSize !=="width")
            {
                if($(window).width()>$(window).height() && isMobile){
                    $(".viewport-image").addClass("viewport");
                }else
                {
                    window.location.reload();
                }
            }
            else {
                $(".viewport-image").removeClass("viewport");
            }
            //alert("w = "+$(window).width()+" | h="+$(window).height()+"  | M="+isMobile);
        },200);


    });

    // Regions
    if ($.isTouch) {
        $('.magazine').bind('touchstart', regionClick);
    } else {
        $('.magazine').click(regionClick);
    }

    // Events for the next button
    $('.next-button').bind($.mouseEvents.over, function() {
        $(this).addClass('next-button-hover');
    }).bind($.mouseEvents.out, function() {
        $(this).removeClass('next-button-hover');
    }).bind($.mouseEvents.down, function() {
        $(this).addClass('next-button-down');
    }).bind($.mouseEvents.up, function() {
        $(this).removeClass('next-button-down');
    }).click(function() {
        $('.magazine').turn('next');
    });

    resizeViewport();

    $('.magazine').addClass('animated');

    setTimeout(function(){
        if(window.bookSize !=="width")
        {
            if($(window).width()>$(window).height() && isMobile){
                $(".viewport-image").addClass("viewport");
            }
        }
        else {
            $(".viewport-image").removeClass("viewport");
        }
        reScale();
    },1500);

}
function drawing(){
    if($(".magazine").turn("display")=="single"){
        var transition=scale;
        var left=($(".page_container").first().css("left")).replace("px","");
        var widtht=($(".page_container").first().css("width")).replace("px","");
        var height=($(".page_container").first().css("height")).replace("px","");
    }else{
        var left=0;
        var widtht=$(".magazine").width();
        var height=$(".magazine").height();
        var transition=1;
    }

    $(".magazine").append('<canvas id="canvasback" width="'+widtht*transition+'" height="'+height*transition+'" style="position: absolute;left: 0px;top:0px;right: 0;bottom:0;margin:auto;z-index:997!important;"></canvas><canvas id="ccanvas" width="'+widtht*transition+'" height="'+height*transition+'" style="position: absolute;left: 0px;top:0px;right: 0;bottom:0;margin:auto;z-index:998!important;"></canvas>');
    var el = document.getElementById('ccanvas');
    var el2 = document.getElementById('canvasback');
    var ctx = el.getContext('2d');
    var ctxBack = el2.getContext('2d');
    var isDrawing, points = [ ];
    window.canvas=el2;
    window.canvasFront=el;
    window.drawingMod="pen";

    // Set up touch events for mobile, etc
    el.addEventListener("touchstart", function (e) {
        mousePos = getTouchPos(canvas, e);
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousedown", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        el.dispatchEvent(mouseEvent);
    }, false);
    el.addEventListener("touchend", function (e) {
        var mouseEvent = new MouseEvent("mouseup", {});
        el.dispatchEvent(mouseEvent);
    }, false);
    el.addEventListener("touchmove", function (e) {
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousemove", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        el.dispatchEvent(mouseEvent);
    }, false);





    ctx.lineWidth = 2;
    ctx.lineJoin = ctx.lineCap = 'round';

    offset=$("#ccanvas").offset();
    rescal=1;
    el.onmousedown = function(e) {
        isDrawing = true;
        points.push({ x:(e.pageX-offset.left)*rescal, y: (e.pageY-offset.top)*rescal });
        //ctx.moveTo((e.pageX-offset.left)*rescal, (e.pageY-offset.top)*rescal);
    };
    el.onmousemove = function(e) {
        if (isDrawing) {
            //ctx.lineTo((e.pageX-offset.left)*rescal, (e.pageY-offset.top)*rescal);
            //ctx.stroke();




            points.push({ x: (e.pageX-offset.left)*rescal, y: (e.pageY-offset.top)*rescal });

            if(ctx.globalCompositeOperation=="destination-out"){
                //ctxBack.globalCompositeOperation = 'destination-out';
                //ctxBack.drawImage(ccanvas, 0, 0);
            }else{
                ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
            }


            var p1 = points[0];
            var p2 = points[1];

            ctx.beginPath();
            ctx.moveTo(p1.x, p1.y);

            for (var i = 1, len = points.length; i < len; i++) {
                var midPoint = midPointBtw(p1, p2);
                ctx.quadraticCurveTo(p1.x, p1.y, midPoint.x, midPoint.y);
                p1 = points[i];
                p2 = points[i+1];
            }
            ctx.lineTo(p1.x, p1.y);
            ctx.stroke();
        }



    };
    el.onmouseup = function() {
        ctxBack.globalCompositeOperation = 'source-over';
        ctxBack.drawImage(ccanvas, 0, 0);
        isDrawing = false;
        points.length = 0;

        if(window.drawingMod=="erease"){
            ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
            ctx.globalCompositeOperation = 'source-over';
            ctx.drawImage(canvasback, 0, 0);

            ctxBack.clearRect(0, 0, ctxBack.canvas.width, ctxBack.canvas.height);


            ctx.globalCompositeOperation = "destination-out";
            ctx.strokeStyle = "rgba(0,0,0,1)";
            ctx.beginPath();
        }
    };


    $(".jq_color").click(function(){
        window.drawingMod="pen";

        ctxBack.globalCompositeOperation = 'source-over';
        ctxBack.drawImage(ccanvas, 0, 0);

        ctx.globalCompositeOperation="source-over";
        ctx.strokeStyle = $(this).attr("color");
        ctx.beginPath();


    });
    $(".jq_canvas_width").click(function(){
        ctx.lineWidth = $(this).attr("line-width");
        ctx.beginPath();
    });

    $(".erazer").click(function(){
        if(window.drawingMod=="erease"){
            return false;
        }
        window.drawingMod="erease";
        //$('.jq_canvas_width.active').addClass(".");
        //$('.jq_canvas_width[line-width="10"]').click();

        ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
        ctx.globalCompositeOperation = 'source-over';
        ctx.drawImage(canvasback, 0, 0);

        ctxBack.clearRect(0, 0, ctxBack.canvas.width, ctxBack.canvas.height);


        ctx.globalCompositeOperation = "destination-out";
        ctx.strokeStyle = "rgba(0,0,0,1)";
        ctx.beginPath();
    });


    $(".clear-all").click(function () {
        window.drawingMod="pen";
        ctxBack.clearRect(0, 0, el.width, el  .height);
        ctxBack.globalCompositeOperation="source-over";


        ctx.clearRect(0, 0, el.width, el  .height);
        ctx.globalCompositeOperation="source-over";
        ctx.strokeStyle = $(".jq_color.active").attr("color");
        ctx.beginPath();
        $(".jq_color.active").click();

    });

    if(typeof $(".jq_color.active")[0]!="undefined"){
        $(".jq_color.active").click();
    }
    loadPaint();
}
function midPointBtw(p1, p2) {
    return {
        x: p1.x + (p2.x - p1.x) / 2,
        y: p1.y + (p2.y - p1.y) / 2
    };
}



// Get the position of a touch relative to the canvas
function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
        x: touchEvent.touches[0].clientX - rect.left,
        y: touchEvent.touches[0].clientY - rect.top
    };
}



manhalsound = function (sound) {
    this.soundplay = false;
    this.soundObject = new Audio((sound + "?" + GenrateID()));
    this.soundObject.addEventListener('error', this.errorSound, false);
    this.soundObject.addEventListener('loadeddata', this.loadsound, true);
    this.soundObject.addEventListener('ended', this.CompleteSound, false);
}

manhalsound.prototype.Play = function () {
    if (this.soundObject != null) {
        this.soundObject.play();
        this.soundplay = true;
    }
}
manhalsound.prototype.loadsound = function (e) {
    var target = e.target;
    target.removeEventListener('loadeddata', target.loadsound);
    target.removeEventListener('errorSound', target.loadsound);

}
manhalsound.prototype.errorSound = function (e) {
    var target = e.target;
    target = null;
}
selector_=null;
manhalsound.prototype.CompleteSound = function (e) {
    if(window.autoPlay){
        window.audioIndex++;
        BookAutoPlay(audioIndex);
    }
    window.isPaused=false;

    //var target = e.target;
    //if (target != null) {
    //    target = null;
    //    this.soundplay = false;
    //    selector_=null;
    //}
}
manhalsound.prototype.Stop = function () {
    if (this.soundObject != null) {
        this.soundObject.pause();
        this.soundObject.currentTime = 0;
        this.soundplay = false;
    }
}
manhalsound.prototype.pause = function () {
    if (this.soundObject != null) {
        this.soundObject.pause();
        this.soundplay = false;
    }
}

function getSoundID(path){
    exp=path.split("/");
    names=exp[exp.length-1];
    nameArr=names.split(".");
    return nameArr[0];
}

function winSound(){
    $("#win1")[0].play();
    $("#win2")[0].play();
}
function faildSound(){
    $("#error2")[0].play();
    $("#error1")[0].play();
}
alphabetSounds=[];
function loadSounds(container){
    if(container!="page2"){
        alphabetSounds=[];
    }

    $("#"+container+" .doaction[actiontype='sound']").each(function(){
        id=$(this).closest(".element").attr("id");
        if(id==undefined || id=="" || id==null){
            id=$(this).attr("element_id");
        }
        selector="audio_"+id;


        //Xid="'"+selector+"'";
        //html='<audio class="jq_audio" controls style="display: none;" id="audio_'+id+'" onended="removeAudioClass('+Xid+')" status="play"><source src="'+$(this).attr("data_src")+'" type="audio/mpeg"></audio>';
        //$("#"+container+" .body").append(html);
        //$(selector)[0].load();

        alphabetSounds[selector] = new manhalsound($(this).attr("data_src"));


    });
}


function GenrateID() {
    var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
    var uniqid = randLetter + Date.now();
    return uniqid;
}
function showBookMsg(title,msg,iframeID){
    swal({
        title:title,
        text: msg,
        html: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: 'Ok',
        closeOnConfirm: true,
        closeOnCancel: false
    }, function (isConfirm) {
        $("#"+iframeID).find("iframe")[0].contentWindow.replyGame();
    });
}

function animatePopOutImage(){
    $('.image-popup-no-margins').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });
}
function playTransVideo(){
    transparentVideos=[];
    var i=0;
    $(".jq_transparentvideo").each(function(){
        transparentVideos[i] = seeThru.create('#'+$(this).attr("id"),{ start: 'clicktoplay',width: $(this).closest(".element").width(), height: $(this).closest(".element").height()});
        i++;
    });
}
function ShowBackLandscape()
{
    $(".icon-header-mobile a.back-landscape").show()
}
function HideBackLandscape()
{
    $(".icon-header-mobile a.back-landscape").hide()
}

//save paint to server as image
function savePaint(){
    showLoader();
    var data={};
    data["secret"]=getSecret();
    data["process"]="savebookimg";
    data["lang"]=window.language;
    data["bookid"]=window.bookid;
    data["pageid"]= $('.magazine').turn('page');
    data["img"]= canvasback.toDataURL();
    $.ajax({
        url: window.SITE_URL+window.language+"/api/books",
        type: "POST",
        data: data,
        cache: false,
        dataType:'json',
        success: function(jsonResult){
            //console.log("paint",jsonResult);
            hideLoader();
            if(jsonResult.result==-1){
                OpenSignIn();
            }else if(jsonResult.result==1){//success

            }else{
                showMsg("error","unexpected error",jsonResult.msg)
            }
        }
    });
}

//load saved paint from server on current page
function loadPaint(){
    showLoader();
    var data={};
    data["secret"]=getSecret();
    data["process"]="getbookimg";
    data["lang"]=window.language;
    data["bookid"]=window.bookid;
    data["pageid"]= $('.magazine').turn('page');
    $.ajax({
        url: window.SITE_URL+window.language+"/api/books",
        type: "POST",
        data: data,
        cache: false,
        dataType:'json',
        success: function(jsonResult){
            //console.log("paint",jsonResult);
            hideLoader();
            if(jsonResult.result==1){
                var BackCanvas = document.getElementById('canvasback');
                var ctx = BackCanvas.getContext('2d');
                var img = new Image;
                img.onload = function(){
                    ctx.drawImage(img,0,0); // Or at whatever offset you like
                };
                img.src = jsonResult.imgData;
            }
        }
    });
}