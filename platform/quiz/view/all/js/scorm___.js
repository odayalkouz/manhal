//scorm
var nFindAPITries = 0;
var API = null;
var maxTries = 10;

function ScanForAPI(win)
{
   // return null;

    while ((win.API_1484_11 == null) && (win.parent != null) && (win.parent != win))
    {
        nFindAPITries++;
        if (nFindAPITries > maxTries)
        {
            return null;
        }
        win = win.parent;
    }

    return win.API_1484_11;
}


function GetAPI(win)
{

    if ((win.parent != null) && (win.parent != win))
    {
        API = ScanForAPI(win.parent);
    }
    if ((API == null) && (win.opener != null))
    {
        API = ScanForAPI(win.opener);
    }

}
function disconnetLMS() {
    if(LMSStatus){
        API.Terminate("");
    }
}
var LMSStatus=false;
var SetTimerScorm=0;
var TimeScorm=0;
//ensd scorm
