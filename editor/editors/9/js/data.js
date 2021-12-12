
/**
 * Created by osaid zalloum on 13/12/2020.
 */

var shuffleList1=[];
var shuffleList2=[];
var allList=[];
var uniqueList = [];
var uniqueList2 = [];


function drawItem(){
    uniqueList = [];
    uniqueList2 = [];
    var html2="";
    for(var i=0;i<itemList.length;i++){
        uniqueList.push(itemList[i].type);
    }
    $.each(uniqueList, function(i, el){
        if($.inArray(el, uniqueList2) === -1) uniqueList2.push(el);
    });
    $(".drop-main-container").html(" ");
    $(".drop-main-container").append('<div class="title-table-container"></div>');
    uniqueList2.sort(function(a, b){return a-b});
    for(var t=0;t<uniqueList2.length;t++){
        html2+='<div class="drop-container drop-container-'+uniqueList2[t]+'" data="'+uniqueList2[t]+'"></div>';
    }

    $(".drop-main-container").append(html2);
    shuffleList1=[];
    shuffleList2=[];
    allList=[];
    allList=Array.from(itemList);
    for(var i=0;i<worngList.length;i++){
        allList.push(worngList[i]);
    }
    var html="";

    var htmlDrop="";
    var htmlDrop2="";
    $(".header-container span").html(title);
    $(".drag-container").html("");
    $(".drop-container").html()
    $(".mark").fadeIn();
    shuffleList1=randomarray(allList.length);
    for(var i=0;i<allList.length;i++){
        shuffleList2.push(allList[shuffleList1[i]])
    }
    for(var i=0;i<shuffleList2.length;i++){
        tempid='drag'+(shuffleList2[i].type).toString()+'_'+(shuffleList2[i].row).toString();
        if(shuffleList2[i].type==0){
            html+='<div class="drag-item" id="'+tempid+'" data="'+shuffleList2[i].type+'" row="'+shuffleList2[i].row+'"><a class="jq_removewanswer"></a><div class="inner-drag-item"><span>'+shuffleList2[i].text+'</span></div></div>'
        }else{
            html+='<div class="drag-item" id="'+tempid+'" data="'+shuffleList2[i].type+'" row="'+shuffleList2[i].row+'"><div class="inner-drag-item"><span>'+shuffleList2[i].text+'</span></div></div>'
        }
    }
    html+='<a class="jq_add_wanswer"></a>';
    $(".drag-container").append(html)
    $(".drag-item[data='0'] span").attr("contenteditable",'true');



    // $(".title-table-container").css({'height':'19.941%','margin-top':'1.1%'});
    for(i=0;i<cloumns.length;i++){
        if(i==0){
         $(' <div class="title-table-1"><span contenteditable="true">'+cloumns[i].title+'</span></div>').appendTo(".title-table-container");
        }else {
            $('<div class="title-table-2"><a class="jq_remove_column" no="'+(i+1)+'"></a><span contenteditable="true">'+cloumns[i].title+'</span></div>').appendTo(".title-table-container");
        }
        // $(".title-table-"+(i+1)).css("display","block");
        // $(".title-table-"+(i+1).toString()+" span").html(cloumns[i].title);
    }

    // console.log('itemList',itemList);
    for( i=0;i<itemList.length;i++){
        // console.log('add',i);
        tempid='drag'+(itemList[i].type).toString()+'_'+($(".drop-container-"+itemList[i].type+" .drop-item").length+1).toString();
        if(itemList[i].type=='1'){
            htmlDrop='<div class="drop-item drop-'+($(".drop-container-"+itemList[i].type+" .drop-item").length+1)+'"  rel-id="'+tempid+'" ><a class="jq_remove_row" data-row="'+($(".drop-container-"+itemList[i].type+" .drop-item").length+1)+'"></a><div class="mark"></div><span contenteditable="true"  class="jq_cell">'+itemList[i].text+'</span></div>';
        }else{
            htmlDrop='<div class="drop-item drop-'+($(".drop-container-"+itemList[i].type+" .drop-item").length+1)+'"  rel-id="'+tempid+'" ><div class="mark"></div><span contenteditable="true" class="jq_cell">'+itemList[i].text+'</span></div>';
        }
        // console.log('cell',itemList[i].text);
        $(".drop-container-"+itemList[i].type).append(htmlDrop);
    }

    $(".drag-container").css({'height':'35.28%','bottom':'6.205%'});
    // $(".drag-item").css({'height':'30.64%'});
    // $('.drag-item:nth-child(5)').css({'margin-right':'0'});
    // $('.drag-item:nth-child(10)').css({'margin-right':'0'});
    // $('.drag-item:nth-child(11)').css({'margin-right':'0.9%'});
    // $('.drag-item:nth-child(12)').css({'margin-right':'0.9%'});
    // $('.drag-item:nth-child(13)').css({'margin-right':'0.9%'});
    // $('.drag-item:nth-child(14)').css({'margin-right':'0.9%'});
    // $('.drag-item:nth-child(15)').css({'margin-right':'0.9%'});
    // $('.drag-item:last-child').css({'margin-right':'0'});

    setTimeout(function () {
        drag();

        $(".drop-item").droppable( "enable" );
        // console.log('item length=',itemList.length);
    },200);

}
