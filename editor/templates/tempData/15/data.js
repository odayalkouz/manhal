/**
 * Created by osaid zalloum on 02/12/2020.
 */

//#Manhal#data#

var shafalList1=[];
var shafalList2=[];
var wordList=[];
var splitTextList=[];
var splitText='';
var wordLength=0;
var word=[];
var uniqueNames = [];
var repetDrag=0;
function drawItem() {
    wordList=[];
    var htmlDrag='';
    var htmlDrop1='';
    var htmlDrop2='';
    splitTextList=[];
    splitText='';
    shafalList1=[];
    shafalList2=[];
    wordLength=0;
    uniqueNames = [];
    $(".title span").html(titleText);
    shafalList1=randomarray(itemList.length);
    if(itemList.length<4){
        var loop=itemList.length;
    }else{
        var loop=4;
    }
    for(var x=0;x<loop;x++){
        shafalList2.push(itemList[shafalList1[x]]);
        // shafalList2.push(itemList[x]);
    }
    var temDrag={};
    for(var t=0;t<shafalList2.length;t++){
        for(var h=0;h<shafalList2[t].drag.length;h++){
            temDrag=shafalList2[t].drag[h];
            temDrag['class']=shafalList2[t].id;
            // temDrag['w']=(shafalList2[t].dropSiz[h].w).toString().replace('%','');
            // temDrag['r']=(shafalList2[t].dropSiz[h].r).toString().replace('%','');
            wordList.push(temDrag);
        }

    }
    $(".drop-main-container").html("");
    $(".drag-container").html("");
    uniqueNames=getUnique(wordList,'word');
    if(uniqueNames.length<wordList.length){
        repetDrag=1;
    }else {
        repetDrag=0;
    }

    for(var t=0;t<uniqueNames.length;t++){
        htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><div class="drag-item-inner"> <span data="'+uniqueNames[t].type+'">'+uniqueNames[t].word+'</span></div></div>'
    }
    if(wrongWordsList.length>0){
        for(var y=0;y<wrongWordsList.length;y++){
            htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><div class="drag-item-inner"><span data="'+wrongWordsList[y].type+'">'+wrongWordsList[y].word+'</span></div></div>'
        }
    }

    for (var i=0;i<shafalList2.length;i++){
        splitText=shafalList2[i].image.split(" ");
        splitTextList.push({text:splitText});
    }
    for(var i=0;i<shafalList2.length;i++){
        htmlDrop2='';
        htmlDrop1+='<div class="item-container item-'+(i+1)+'"><div class="number-container"><span>'+(i+1)+'</span></div><div class="inner-item-container"><div class="item-text"><div class="inner-item-text" temp-id="'+shafalList2[i].id+'">'
        for(var x=0;x<splitTextList[i].text.length;x++){
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
                    if($(".item-"+(y+1)).find(".drop-"+(b+1)).find("span").html()==shafalList2[i].drag[t].word && $(".item-"+(y+1)).find('.inner-item-text').attr('temp-id')==shafalList2[i].id){
                        word.push($(".drop-"+(b+1)).find("span").html());
                        console.log("word<<<>>"+shafalList2[i].drag[t].word);

                        $(".item-"+(y+1)).find(".drop-"+(b+1)).addClass("selected");
                    }
                }
            }
        }
    }
    // for(var y=0;y<$(".item-container").length;y++){
    //     for(var b=0;b<$(".item-"+(y+1)).find(".drop-item").length;b++){
    //         if($(".item-"+(y+1)).find(".drop-"+(b+1)).hasClass("selected")){
    //             wordLength++;
    //         }
    //     }
    // }

    $(".drop-item").each(function () {
        if($(this).hasClass("selected")){
            $(this).addClass("osaid")
            wordLength++;
        }
    })
    console.log("word<<<<>>>>"+word);
    shuffleDivs(".drag-container");
    // shuffleDivs(".drop-main-container");
    if($(".drag-item").length<=3){
        $(".drag-item").css({"margin":"0 0 3.8% 0",width:'64.8%',height:'13.8%',float:'none'});
        $(".drag-item:nth-child(1)").css("margin-top","50.94%");
        $(".drag-item:nth-child(2)").css("margin-top","0");

        $(".drag-item span").css({"line-height":"2.1em"});
    }else if($(".drag-item").length<=4){
        $(".drag-item").css({"margin":"0 0 3.8% 0",width:'64.8%',height:'13.8%',float:'none'});
        $(".drag-item:nth-child(1)").css("margin-top","41.34%");
        $(".drag-item:nth-child(2)").css("margin-top","0");

        $(".drag-item span").css({"line-height":"2.1em"});
    }else if($(".drag-item").length==6 || $(".drag-item").length==5 ){
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
function getUnique(arr, comp) {

    // store the comparison  values in array
    const unique =  arr.map(e => e[comp])

    // store the indexes of the unique objects
        .map((e, i, final) => final.indexOf(e) === i && i)

        // eliminate the false indexes & return unique objects
        .filter((e) => arr[e]).map(e => arr[e]);

    return unique;
}