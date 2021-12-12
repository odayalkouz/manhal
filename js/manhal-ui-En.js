$(document).ready(function()
{
    $(document).on("click",".editor-main-menu-container .nav-content .header .close-menu",function()
    {
        $("#page-content").fadeOut();
        $("#action-content").fadeOut();
        $("#widget-content").fadeOut();
        $("#trace-content").fadeOut();
        $("#animation-content").fadeOut();
        $(".editor-main-menu-container .nav a").removeClass("active");
        $(".editor-main-menu-container").width(65);
    });

    $(document).on("click",".editor-main-menu-container .nav a",function()
    {
        var conID=$(this).attr("id");
        $(this).siblings().removeClass("active");
        $(".editor-main-menu-container").width(395);
        switch(conID)
         {
            case "Page_menu":
                $(this).addClass("active");
                $("#page-content").fadeIn();
                $("#action-content").fadeOut();
                $("#widget-content").fadeOut();
                $("#trace-content").fadeOut();
                $("#layar-content").fadeOut();
                break;
            case "Action_menu":
                $(this).addClass("active");
                $("#action-content").fadeIn();
                $("#page-content").fadeOut();
                $("#widget-content").fadeOut();
                $("#trace-content").fadeOut();
                $("#layar-content").fadeOut();
                break;
            case "Widget_menu":
                $(this).addClass("active");
                $("#widget-content").fadeIn();
                $("#action-content").fadeOut();
                $("#page-content").fadeOut();
                $("#trace-content").fadeOut();
                $("#layar-content").fadeOut();
                break;
            case "Trace_menu":
                $(this).addClass("active");
                $("#trace-content").fadeIn();
                $("#action-content").fadeOut();
                $("#page-content").fadeOut();
                $("#widget-content").fadeOut();
                $("#layar-content").fadeOut();
                break;
                case "Layer_menu":
                $(this).addClass("active");
                $("#layar-content").fadeIn();
                $("#trace-content").fadeOut();
                $("#action-content").fadeOut();
                $("#page-content").fadeOut();
                $("#widget-content").fadeOut();

                    html="";
                    i=0;
                    $(".element").each(function(){

                        if($(this).find("font").length > 0){
                            title=$(this).find("font").first().html();
                        }else{
                            i++;
                            title="Layer "+i;
                        }
                        if($(this).css("display")=="none"){
                            checked="";
                        }else{
                            checked='checked="checked"';
                        }
                        html+='<div class="row-layer" data-id="'+$(this).attr("id")+'">';
                        html+='<a class="floating-left checkbox"><input type="checkbox" class="jq_layer" data-id="'+$(this).attr("id")+'" '+checked+'></a>';
                        html+='<a class="floating-left title">'+title+'</a>';
                        html+=' </div>';
                    });

                    $(".content.layers").html(html);
                break;
        }
    });
    $(document).on("click",".editor-main-menu-container .nav-content .content .row-layer",function(){
        $(this).addClass("active");
        $(this).siblings().removeClass("active");
    });

});













