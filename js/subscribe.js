/**
 * Created by khalid alomiri on 21/08/2017.
 */


window.Lang=new Array();
//window.SITE_URL="https://www.manhal.com/";
window.SITE_URL="http://localhost/Manhal/";
window.Freez=false;
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



var rangenumber=1000;
function calcMonthFamily(){
    if ($("#sum_typeuser0").val() > 3) {
        $("#sum_typeuser0").val(3)
    } else if ($("#sum_typeuser0").val() < 1) {
        $("#sum_typeuser0").val(1)
    }
    $("#cost_month_0").html(parseFloat(cost[0][0])* $("#sum_typeuser0").val());
    $("#total_0").html(parseFloat(cost[0][0])* $("#sum_typeuser0").val()*$("#sum_month0").val());
}

function calcYearFamily(){
    if ($("#sum_typeuser01").val() > 3) {
        $("#sum_typeuser01").val(3)
    } else if ($("#sum_typeuser01").val() < 1) {
        $("#sum_typeuser01").val(1)
    }
    $("#cost_year_01").html(parseFloat(cost[0][1]) * $("#sum_typeuser01").val());
    $("#total_01").html(parseFloat(cost[0][1]) * $("#sum_typeuser01").val()*$("#sum_year01").val());
}

function calcMonthSchool(){
    if ($("#sum_typeuser10").val() < 10) {
        $("#sum_typeuser10").val(10)
    }

    $("#cost_month_10").html(parseFloat(cost[1][0]) * $("#sum_typeuser10").val());
    $("#total_10").html(parseFloat(cost[1][0]) * $("#sum_typeuser10").val()*$("#sum_month10").val());
    $("#teacher_0").html(Math.floor($("#sum_typeuser10").val()/10));
}

function calcYearSchool(){
    if ($("#sum_typeuser11").val() < 10) {
        $("#sum_typeuser11").val(10)
    }
    $("#cost_year_11").html(parseFloat(cost[1][1])* $("#sum_typeuser11").val());
    $("#total_11").html(parseFloat(cost[1][1])* $("#sum_typeuser11").val()*$("#sum_year11").val());
    $("#teacher_1").html(Math.floor($("#sum_typeuser11").val()/10));
}

$(document).ready(function () {
    $("#sum_typeuser0").on('keyup mouseup', function () {
        calcMonthFamily();
    }).trigger('mouseup');

    $("#sum_month0").on('keyup mouseup', function () {
        calcMonthFamily();
    }).trigger('mouseup');


    $("#sum_typeuser01").on('keyup mouseup', function () {
        calcYearFamily();
    }).trigger('mouseup');

    $("#sum_year01").on('keyup mouseup', function () {
        calcYearFamily();
    }).trigger('mouseup');


    $("#sum_typeuser10").on('keyup mouseup', function () {
        calcMonthSchool();
    }).trigger('mouseup');

    $("#sum_month10").on('keyup mouseup', function () {
        calcMonthSchool();
    }).trigger('mouseup');


    $("#sum_typeuser11").on('keyup mouseup', function () {
        calcYearSchool()
    }).trigger('mouseup');

    $("#sum_year11").on('keyup mouseup', function () {
        calcYearSchool()
    }).trigger('mouseup');


    $(".button-join").click(function () {
       console.log($(this));
      if( $(this).hasClass('btn-popup')){
          return
      }
var type,usersAccounts,total,cost,subscribe,my_count;
      if($(this).attr('t')=='Parents' && $(this).attr('p')=='Monthly'){
          usersAccounts=$("#sum_typeuser0").val();
          total=$("#total_0").html();
          cost=$("#cost_0").html();
          subscribe='Monthly';
          my_count=$("#sum_month0").val();
          type='Parents';
      }else  if($(this).attr('t')=='Parents' && $(this).attr('p')=='Annual') {
          usersAccounts = $("#sum_typeuser01").val();
          total=$("#total_01").html();
          cost=$("#cost_01").html();
          subscribe='Annual';
          my_count=$("#sum_year01").val();
          type='Parents';
      }else  if($(this).attr('t')=='Schools' && $(this).attr('p')=='Monthly') {
          usersAccounts = $("#sum_typeuser10").val();
          total=$("#total_10").html();
          cost=$("#cost_10").html();
          subscribe='Monthly';
          my_count=$("#sum_month10").val();
          type='Schools';
      }else  if($(this).attr('t')=='Schools' && $(this).attr('p')=='Annual') {
          usersAccounts = $("#sum_typeuser11").val();
          total=$("#total_11").html();
          cost=$("#cost_11").html();
          subscribe='Annual';
          my_count=$("#sum_year11").val();
          type='Schools';
      }

        $.ajax({
            url: window.SITE_URL+"platform/ajax/platform.php?process=subscribepay",
            type: "POST",
            data:{"type":type,"usersAccounts":usersAccounts,"cost":cost,"total":total,'subscribe':subscribe,'months_years':my_count,'renew':window.renew,'upgrade':window.upgrade},
            cache: false,
            dataType:'json',
            success: function(jsonData) {
                console.log("jsonData",jsonData);
                if(jsonData.result==1){
                    window.location.href=SITE_URL+window.Lang.Lang+"/pay";
                }else if(jsonData.result==-2){
                    Lobibox.notify('warning', {
                        title: window.Lang.Error,
                        msg: window.Lang.minimumusersacc+" "+jsonData.minimumuser
                    });
                }

            }
        });

    })


});

