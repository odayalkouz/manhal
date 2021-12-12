/**
 * Created by osaid zalloum on 27/01/2021.
 */

var correct = 0;
var allCorrect = 0;
var incorrect = 0;

var shuffleList1=[];
var shuffleList2=[];
function drawItem(){
    shuffleList1=[];
    shuffleList2=[];
    var html1='';
    var html2='';
    var dropHtml1='';
    var dropHtml2='';
    var tableTitle=''
    $(".title span").html(mainTitle);
    $(".sub-title-container span").html(subTitle);
    for(var x=0;x<cloumnsList.length;x++){
        tableTitle+='<div class="table-title title-'+(x+1)+'"><a class="jq_deletei_col" no="'+(x+1)+'"></a><span class="jq_editable">'+cloumnsList[x].title+'</span></div>';
    }
    $(".table-header").append(tableTitle);

    // $(".table-title.title-1 span").html(cloumnsList[0].title);
    // $(".table-title.title-2 span").html(cloumnsList[1]);
    $(".right-drop").html("");
    $(".left-drop").html("");
    $(".drag-container").html("");
    $(".item-main-container").html("");
    $(".qusMark").fadeIn();
    $(".text-container span").css("opacity","0");
    shuffleList1=randomarray(itemList.length);
    // for(var i=0;i<itemList.length;i++){
    //     shuffleList2.push(itemList[shuffleList1[i]])
    // }
    shuffleList2=itemList
    for(var i=0;i<shuffleList2.length;i++){
        html2="";
        html1+='<div class="text-item item-'+(i+1)+'"><a class="jq_deletei"></a><div class="text-container"><div class="dot"></div>' +
            '<a class="jq_editi"></a><a class="jq_savei"></a><div class="all-text"><span class="jq_editable">'+shuffleList2[i].text+'</span></div>' +
            '<div class="text-inner-item" data="'+(i+1)+'">';
        var sentence=shuffleList2[i].text.split(" ");
        for(var x=0;x<sentence.length;x++){
            html2+='<div class="drag-item drag-'+(x+1)+'" data=""><span data="'+sentence[x]+'">'+sentence[x]+'</span></div>';
        }
        html1+=html2+'</div></div></div>';
    }
    var htmldrop='';

    $(".text-main-container").append(html1);
    if(cloumnsList.length==1){
        for(var i=0;i<shuffleList2.length;i++){
            htmldrop='';
            htmldrop='<div class="drop-container">';
            htmldrop+='<div class="drop-item drop-1" no="1" data="'+answer[0].word+'"><span>'+shuffleList2[i].answer[0].word+'</span></div></div>';
            $(".item-"+(i+1)).append(htmldrop);
        }
    }else if(cloumnsList.length==2){
        for(var i=0;i<shuffleList2.length;i++){
            htmldrop='';
            htmldrop='<div class="drop-container">';
            htmldrop+='<div class="drop-item drop-1" no="1" data="'+answer[0].word+'"><span>'+answer[0].word+'</span></div>' +
                      '<div class="drop-item drop-2" no="2" data="'+answer[1].word+'"><span>'+answer[1].word+'</span></div></div>';
            $(".item-"+(i+1)).append(htmldrop);
        }
    }else if(cloumnsList.length==3){
        for(var i=0;i<shuffleList2.length;i++){
            htmldrop='';
            htmldrop='<div class="drop-container">';
            htmldrop+='<div class="drop-item drop-1" no="1" data="'+answer[0].word+'"><span>'+answer[0].word+'</span></div>' +
                      '<div class="drop-item drop-2" no="2" data="'+answer[1].word+'"><span>'+answer[1].word+'</span></div>'+
                      '<div class="drop-item drop-3" no="3" data="'+answer[2].word+'"><span>'+answer[2].word+'</span></div></div>';
            $(".item-"+(i+1)).append(htmldrop);
        }
    }

    $(".right-drop").append(dropHtml1);
    $(".left-drop").append(dropHtml2);
    switch (cloumnsList.length) {
        case 1:
            $(".main-drop-container").css({"width":"21.2%","left":"2.59%"});
            $(".sub-title-container").css("width","73.9%");
            $(".table-title").css({"width":"100%"});
            $(".text-container").css("width","77.8%");
            $(".drop-container").css("width","22.2%");
            $(".drop-item").css("width","100%");
            break;
        case 2:
            $(".main-drop-container").css({"width":"42.2%","left":"2.69%"});
            $(".sub-title-container").css("width","52.8%");
            $(".table-title").css({"width":"50%"});
            $(".text-container").css("width","55.3%");
            $(".drop-container").css("width","44.4%");
            $(".drop-item").css("width","50%");
            break;
        case 3:
            $(".main-drop-container").css({"width":"54.7%","left":"2.59%"});
            $(".sub-title-container").css("width","40.4%");
            $(".table-title").css({"width":"33.3%"});
            $(".text-container").css("width","42.6%");
            $(".drop-container").css("width","57.4%");
            $(".drop-item").css("width","33.33%");
            $(".drop-item span").css("font-size","3.3vmin");
            $(".table-title:nth-child(2)").css("border-left","0.5px solid #ffffff");
            break;
    }
    drag();
    // shuffleDivs(".drag-container");
}
