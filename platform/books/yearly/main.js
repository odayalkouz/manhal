$(document).ready(function () {
    $(document).on("click",".doaction",function(event){
        if($(this).attr("actiontype")=="urltext"){
            callOS("img",$(this).attr("data_src"));
        }
    });

    $(document).on("click",".goto",function(event){
        callOS("page",getPagename($(this).attr("goto")));
    });


});

function callOS(type,src) {
    if(navigator.userAgent.match(/iPhone|iPad|iPod/i)) {
        if(window.webkit){
            window.webkit.messageHandlers.callbackHandler.postMessage(type+'@'+src);
        }
    }else {//Android
        Manhal_app.rotateScreenTo_LANDSCAPE();
    }
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