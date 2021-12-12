//scorm

var nFindAPITries = 0;

var API = null;

var maxTries = 10;

var Origin=getUrlParameter("origin");



function GetAPI(win) {

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("scorm");

    if (c=="true") {
        API=new manhalScorm();
    }else{
        API=null;
    }
}

function disconnetLMS() {

    if(LMSStatus){

        API.Terminate("");

    }

}

function manhalScorm(){
    this.Initialize = function(emptyVal) {
        return true;
    };

    this.Terminate = function(emptyVal) {
        return true;
    };

    this.GetLastError = function() {
        return "0";//integer in the range from 0 to 65536 inclusive, 0=no errors
    };

    this.GetDiagnostic = function(ErrCode) {
        return "error description and how to solve it";//maximum length of 255
    };

    this.Commit = function(emptyVal) {
        return true;
    };

    this.GetErrorString = function(ErrCode) {
        return "error description";//maximum length of 255
    };

    this.GetValue = function(cmi) {
        return "0";
    };

    this.SetValue = function(cmi,val) {
        window.parent.postMessage(cmi+'#'+val, Origin);
        return true;
    };
}


var LMSStatus=false;

var SetTimerScorm=0;

var TimeScorm=0;


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

//end scorm