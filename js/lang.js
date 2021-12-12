/**
 * Created by Hussam Abu Khaijeh on 1/5/2016.
 */
$(document).ready(function(){
    window.SITE_URL="http://localhost/Manhal/";
    //window.SITE_URL="https://www.manhal.com/";
    window.Lang=new Array();
    $.ajax({
        url: window.SITE_URL+"language/getVariable.php",
        type: "POST",
        cache: false,
        dataType:'html',
        async:false,
        success: function(html) {
            window.Lang=JSON.parse(html);
        }
    });

});


