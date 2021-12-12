/**
 * Created by osaid zalloum on 17/08/2021.
 */


var shafalList1=[];
var shafalList2=[];
var wordList=[];
var splitTextList=[];
var splitText='';
function drawItem() {
    wordList=[];
    var htmlDrag='';
    var htmlDrop1='';
    var htmlDrop2='';
    splitTextList=[];
    splitText='';
    shafalList1=[];
    shafalList2=[];
    $(".title span").html(titleText);
    shafalList1=randomarray(itemList.length);
    // if(itemList.length<4){
    //     var loop=itemList.length;
    // }else{
    //     var loop=4;
    // }
    for(var x=0;x<itemList.length;x++){
        // shafalList2.push(itemList[shafalList1[x]]);
        shafalList2.push(itemList[x]);
    }
    var temDrag={};
    for(var t=0;t<shafalList2.length;t++){
        for(var h=0;h<shafalList2[t].drag.length;h++){
            console.log("word<<<>>>"+shafalList2[t].drag[h])
            temDrag=shafalList2[t].drag[h];
            temDrag['class']=shafalList2[t].id;
            // temDrag['w']=(shafalList2[t].dropSiz[h].w).toString().replace('%','');
            // temDrag['r']=(shafalList2[t].dropSiz[h].r).toString().replace('%','');
            wordList.push(temDrag);
        }

    }
    $(".drop-main-container").html("");
    $(".drag-container").html("");
    // for (var i=0;i<shafalList2.length;i++){
    //     splitText=shafalList2[i].image.split(" ");
    //     splitTextList.push({text:splitText});
    // }
    for(var t=0;t<wordList.length;t++){
        htmlDrag+='<div class="drag-item jq_itemc_'+wordList[t].class+'" style="width: 46.8%; height: 10%; float: none;"><div class="drag-item-inner"><span data="'+wordList[t].type+'">'+wordList[t].word+'</span><div class="trueanswer" title="true answer"></div></div></div>'
                   // <div class="drag-item" data="" style="margin: 10.94% 1.7% 13.9% 2.3%; width: 46.8%; height: 10%; float: none;"><div class="drag-item-inner"><a class="jq_deleteanswer"><a/><span data="0" class="ui-draggable ui-draggable-handle jq_editable" contenteditable="true">اجابة</span></div></div>
    }

    if(wrongWordsList.length>0){
        for(var y=0;y<wrongWordsList.length;y++){
            htmlDrag+='<div class="drag-item"  style=" width: 46.8%; height: 10%; float: none;"><div class="drag-item-inner"><a class="jq_deleteanswer"><a/><span data="0" class="jq_editable" contenteditable="true">'+wrongWordsList[y].word+'</span></div></div>'
        }
    }
    // for (var i=0;i<splitTextList.length;i++){
    //     htmlDrop2='';
    //     htmlDrop1+='<div class="item-container item-'+(i+1)+'" temp-id="'+shafalList2[i].id+'"><div class="number-container"><span>'+(i+1)+'</span></div><div class="inner-item-container"><a class="jq_editi"></a><a class="jq_savei"></a><a class="jq_deletei"></a><div class="item-text"><div class="all-sentence"><span class="jq_itemc">'+shafalList2[i].image+'</span></div><div class="inner-item-text">';
    //     for(var x=0;x<splitTextList[i].text.length;x++){
    //         if(shuffleList2[i].drag==splitTextList[i].text[x]){
    //             htmlDrop2+='<div class="drop-item drag-'+(x+1)+' selected" type="'+shafalList2[i].drag[t].type+'"><div class="line-doted"></div><span>'+splitTextList[i].text[x]+'</span></div>'
    //         }else {
    //             htmlDrop2+='<div class="drop-item drag-'+(x+1)+'" type="'+shafalList2[i].drag[t].type+'"><div class="line-doted"></div><span>'+splitTextList[i].text[x]+'</span></div>'
    //         }
    //     }
    //     htmlDrop1+=htmlDrop2+'</div></div></div></div>'
    // }
    for (var i=0;i<shafalList2.length;i++){
        splitText=shafalList2[i].image.split(" ");
        splitTextList.push({text:splitText});
    }
    for(var i=0;i<shafalList2.length;i++){
        htmlDrop2='';
        htmlDrop1+='<div class="item-container item-'+(i+1)+'" temp-id="'+shafalList2[i].id+'"><div class="number-container"><span>'+(i+1)+'</span></div><div class="inner-item-container"><a class="jq_editi"></a><a class="jq_savei"></a><a class="jq_deletei"></a><div class="item-text"><div class="all-sentence"><span class="jq_itemc">'+shafalList2[i].image+'</span></div><div class="inner-item-text" temp-id="'+shafalList2[i].id+'">'
        for(var x=0;x<splitTextList[i].text.length;x++){
            // if(shafalList2[i].drag.length>1){
            //     for(var r=0;r<shafalList2[i].drag.length;r++){
            //         if(shafalList2[i].drag[r].word==splitTextList[i].text[x]){
            //             htmlDrop2+='<div class="drop-item drop-'+(x+1)+' selected"><div class="line-doted"></div><span>'+splitTextList[i].text[x]+'</span></div>';
            //         }else {
            //             htmlDrop2+='<div class="drop-item drop-'+(x+1)+'"><div class="line-doted"></div><span>'+splitTextList[i].text[x]+'</span></div>';
            //         }
            //     }
            //
            // }else {
            //     if(shafalList2[i].drag[0].word==splitTextList[i].text[x]){
            //         htmlDrop2+='<div class="drop-item drop-'+(x+1)+' selected"><div class="line-doted"></div><span>'+splitTextList[i].text[x]+'</span></div>';
            //     }else {
            //         htmlDrop2+='<div class="drop-item drop-'+(x+1)+'"><div class="line-doted"></div><span>'+splitTextList[i].text[x]+'</span></div>';
            //     }
            // }
            htmlDrop2+='<div class="drop-item drop-'+(x+1)+'"><div class="line-doted"></div><span>'+splitTextList[i].text[x]+'</span></div>';
        }
        htmlDrop1+=htmlDrop2+'</div></div></div></div>'
    }

    $(".drop-main-container").append(htmlDrop1);
    $(".drag-container").append(htmlDrag);
    for(var y=0;y<$(".item-container").length;y++){
        for(var i=0;i<shafalList2.length;i++){
            for(var t=0;t<shafalList2[i].drag.length;t++){
                for(var b=0;b<$(".item-"+(y+1)).find(".drop-item").length;b++){
                    if($(".item-"+(y+1)).find(".drop-"+(b+1)).find("span").html()==shafalList2[i].drag[t].word && $(".item-"+(y+1)).find('.inner-item-text').attr("temp-id")==shafalList2[i].id){
                        console.log("word<<<>>"+shafalList2[i].drag[t].word)
                        $(".item-"+(y+1)).find(".drop-"+(b+1)).addClass("selected");
                    }
                }
            }
        }
    }
    shuffleDivs(".drag-container");

}
