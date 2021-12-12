/**
 * Created by osaid zalloum on 13/09/2020.
 */

var shuffleList1=[];
var shuffleList2=[];
var shuffleList3=[];
var shuffleList4=[];
var wordList2=[];
function drawList() {
    shuffleList1=[];
    shuffleList2=[];
    wordList2=[];
    // shuffleList1=randomarray(itemList.length);
    // for(var i=0; i<itemList.length;i++){
    //     shuffleList2.push(itemList[shuffleList1[i]]);
    // }
    shuffleList2=itemList;
}

function drawItem() {
    $(".title span").html(title);
    $(".sup-title span").html(supTitle);
    console.log("supTitle>>>>>>"+supTitle)
    $(".drag-container").html("");
    $(".drop-inner-container").html("");
    var htmlDrag='';
    var htmlDrop='';
    var htmlDropInner='';
    var splitTextList=[];
    var splitText='';

    for (var i=0;i<itemList.length;i++){
        splitText=shuffleList2[i].img1.split(" ");
        splitTextList.push({text:splitText});
    }

    for(var r=0;r<splitTextList.length;r++){
        htmlDropInner='';
        for (var t=0;t<splitTextList[r].text.length;t++){
            if(shuffleList2[r].answer==splitTextList[r].text[t]){
                var iclass='jq_itemc_'+shuffleList2[r].id;
                htmlDrag+='<div class="drag-item '+iclass+'"><div class="inner-drag-item"><span data="'+splitTextList[r].text[t]+'">'+splitTextList[r].text[t]+'</span></div></div>'

                htmlDropInner+='<div class="word-container selected"  data="'+splitTextList[r].text[t]+'"><div class="dott"><span></span></div><div class="inner-word"><span>'+splitTextList[r].text[t]+'</span></div></div>'
            }else {
                // htmlDropInner+='<div class="word-container"><div class="inner-word"><span>'+splitTextList[r].text[t]+'</span></div></div>'
                htmlDropInner+='<div class="word-container" data="'+splitTextList[r].text[t]+'"><div class="dott"><span></span></div><div class="inner-word"><span>'+splitTextList[r].text[t]+'</span></div></div>'
            }
        }
        htmlDrop+='<div class="drop-item drop-'+(r+1)+'" temp-id="'+shuffleList2[r].id+'"><a class="jq_editi"></a><a class="jq_savei"></a><a class="jq_deletei"></a><div class="all-sentence"><span contenteditable="true">'+shuffleList2[r].img1+'</span></div><div class="inner-drop-item">'+htmlDropInner+'</div></div>';
    }
    $(".drop-inner-container").append(htmlDrop);
    $(".drag-container").append(htmlDrag);

    if(wrongAnswer.length !=0){
        for(var h=0;h<wrongAnswer.length;h++){
            $('<div class="drag-item " data="0"><a class="jq_deleteanswer"></a><div class="inner-drag-item"><span data="'+wrongAnswer[h]+'" contenteditable="true">'+wrongAnswer[h]+'</span></div></div>').appendTo(".drag-container");
        }
        // var wrongCount=$(".drag-item").length-8;
        // if(wrongAnswer>=wrongCount){
        //     for(var h=0;h<wrongCount;h++){
        //         $('<div class="drag-item " data="0"><div class="inner-drag-item"><span data="'+wrongAnswer[h]+'">'+wrongAnswer[h]+'</span></div></div>').appendTo(".drag-container");
        //     }
        // }else {
        //     for(var h=0;h<wrongAnswer.length;h++){
        //         $('<div class="drag-item " data="0"><div class="inner-drag-item"><span data="'+wrongAnswer[h]+'">'+wrongAnswer[h]+'</span></div></div>').appendTo(".drag-container");
        //     }
        // }

    }


    // shuffleDivs(".drag-container");
    // drag();
}
