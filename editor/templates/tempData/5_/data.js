/**
 * Created by osaid zalloum on 02/12/2020.
 */

//#Manhal#data#

var shafalList1=[];
var shafalList2=[];
var wordList=[];
function drawItem() {
    wordList=[];
    var htmlDrag='';
    var htmlDrop='';
    var htmlDrop2='';
    shafalList1=[];
    shafalList2=[];
    $(".title span").html(titleText);
    shafalList1=randomarray(itemList.length);
    if(itemList.length<4){
        var loop=itemList.length;
    }else{
        var loop=4;
    }
    for(var x=0;x<loop;x++){
        shafalList2.push(itemList[shafalList1[x]]);
    }
    for(var t=0;t<shafalList2.length;t++){
        for(var h=0;h<shafalList2[t].drag.length;h++){
            console.log("word<<<>>>"+shafalList2[t].drag[h])
            wordList.push(shafalList2[t].drag[h])
        }

    }
    $(".drop-main-container").html("");
    $(".drag-container").html("");
    for(var t=0;t<wordList.length;t++){
        htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><span data="'+wordList[t].type+'">'+wordList[t].word+'</span></div>'
    }
    if(wrongWordsList.length>0){
        for(var y=0;y<wrongWordsList.length;y++){
            htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><span data="'+wrongWordsList[y].type+'">'+wrongWordsList[y].word+'</span></div>'
        }
    }
    for(var i=0;i<shafalList2.length;i++){
        htmlDrop+='<div class="item-container"><div class="item-text"><span>'+shafalList2[i].image+'</span></div> <div class="number-container"><span>'+(i+1)+'</span></div> '
        for(var x=0;x<shafalList2[i].drag.length;x++){
            htmlDrop+='<div class="drop-item" data="'+shafalList2[i].drag[x].type+'" style="width: '+shafalList2[i].dropSiz[x].w+';height: '+shafalList2[i].dropSiz[x].h+';top: '+shafalList2[i].dropSiz[x].t+';left: '+shafalList2[i].dropSiz[x].r+'"><span></span></div>'
        }
         htmlDrop+='</div>';
    }

    $(".drop-main-container").append(htmlDrop);
    $(".drag-container").append(htmlDrag);
    shuffleDivs(".drag-container");
    if($(".drag-item").length<=6){
        $(".drag-item").css({"margin":"0 0 3.8% 0",width:'64.8%',height:'13.8%',float:'none'});
        $(".drag-item:nth-child(1)").css("margin-top","13.94%");
        $(".drag-item:nth-child(2)").css("margin-top","0");

        $(".drag-item span").css({"line-height":"2.5em"});
    }else if($(".drag-item").length==8 || $(".drag-item").length==7){
        console.log("length<<<>>"+$(".drag-item").length);
        // $(".drag-item").css({width:'46.8%',height:'10%',float:'left'});
        $(".drag-item:nth-child(1)").css({"margin":"45.94% 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(2)").css({"margin":"45.94% 0 13.9% 0",width:'46.8%',height:'10%',float:'none'});

        $(".drag-item:nth-child(3)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(5)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(7)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(9)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(11)").css({"margin": "0 1.7% 0 2.3%",width:'46.8%',height:'10%',float:'none'});

        $(".drag-item:nth-child(4)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(6)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(8)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(10)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(12)").css({"margin": "0 0 0 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item span").css({"line-height":"1.8em !important"});
    }if($(".drag-item").length==9 || $(".drag-item").length==10){
        console.log("length<<<>>"+$(".drag-item").length);
        // $(".drag-item").css({width:'46.8%',height:'10%',float:'left'});
        $(".drag-item:nth-child(1)").css({"margin":"25.94% 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(2)").css({"margin":"25.94% 0 13.9% 0",width:'46.8%',height:'10%',float:'none'});

        $(".drag-item:nth-child(3)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(5)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(7)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(9)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(11)").css({"margin": "0 1.7% 0 2.3%",width:'46.8%',height:'10%',float:'none'});

        $(".drag-item:nth-child(4)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(6)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(8)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(10)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(12)").css({"margin": "0 0 0 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item span").css({"line-height":"1.8em !important"});
    }if($(".drag-item").length>10){
        console.log("length<<<>>"+$(".drag-item").length);
        // $(".drag-item").css({width:'46.8%',height:'10%',float:'left'});
        $(".drag-item:nth-child(1)").css({"margin":"10.94% 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(2)").css({"margin":"10.94% 0 13.9% 0",width:'46.8%',height:'10%',float:'none'});

        $(".drag-item:nth-child(3)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(5)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(7)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(9)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(11)").css({"margin": "0 1.7% 0 2.3%",width:'46.8%',height:'10%',float:'none'});

        $(".drag-item:nth-child(4)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(6)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(8)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(10)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item:nth-child(12)").css({"margin": "0 0 0 0 !important",width:'46.8%',height:'10%',float:'none'});
        $(".drag-item span").css({"line-height":"1.8em !important"});
    }
    drag()
}
