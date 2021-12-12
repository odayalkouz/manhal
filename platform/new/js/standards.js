window.SITE_URL="http://localhost/Manhal/";
$(document).ready(function () {
    $("#header_search").click(function () {
        if($(this).closest(".search-wrapper").hasClass("active")){
            $("#search_keyword").val($("#header_keyword").val());
            setTimeout(function () {
                $("#search_form")[0].submit();
            },1)
        }
    });

    $(".change_submit").change(function () {
        $(this).closest("form")[0].submit();
    });

    $(".jq_delete_domain").click(function () {
        a=$(this);
        Lobibox.confirm({
            title:  'Delete Domian',
            msg: "This will delete all pivotes, standards, outcomes, unites and lessons in this domain , Are you sure ? ",
            callback: function ($this, type, ev) {
                if(type=="yes"){
                    showLoader();
                    $.ajax({
                        url: window.SITE_URL+"platform/new/standards/ajax.php?process=deletedomain",
                        type: "POST",
                        data:{"domainid":a.attr("data-id")},
                        cache: false,
                        dataType:'json',
                        success: function(jsonData) {
                            hideLoader();
                            if(jsonData.result==1){
                                a.closest("tr").remove();
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
});