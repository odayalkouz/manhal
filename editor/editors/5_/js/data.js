/**
 * Created by osaid zalloum on 02/12/2020.
 */
// var itemList=[
//     {
//         image:"أَنْ تَنْصَحَ أَخاكَ مُتَأَخِّرًا خَيْرٌ مِنْ تَرْكِهِ عَلى الْخَطَأ.",
//         drag:[{word:"تَنْصَحَ",type:'1.1'},{word:"تَرْكِهِ",type:'1.2'}],
//         dropSiz:[{w:'9.1%',h:'42%',t:'33%',r:'12.8%',type:'1.1'},{w:'9.1%',h:'42%',t:'33%',r:'12.8%',type:'1.2'}]
//     },
//     {
//         image:"احْرِصْ عَلى أَنْ تَقْتَصِدَ في اسْتِعمالِ الْماءِ.",
//         drag:[{word:"تَقْتَصِدَ",type:'2.1'}],
//         dropSiz:[{w:'9.3%',h:'42.9%',t:'35.2%',r:'32%',type:'2.1'}]
//     },
//     {
//         image:"عَلَى الْمَرْءِ أَنْ يُحافِظَ عَلى بيئَتهِ.",
//         drag:[{word:"يُحافِظَ",type:'1.1'}],
//         dropSiz:[{w:'9.6%',h:'46%',t:'31%',r:'29.2%',type:'3.1'}]
//     },
//     {
//         image:"عَلَيْكَ أَنْ تُصاحِبَ الأَخْيارِ.",
//         drag:[{word:"تُصاحِبَ",type:'4.1'}],
//         dropSiz:[{w:'12.8%',h:'50%',t:'31.9%',r:'20.9%',type:'4.1'}]
//     },
// ];
// var wrongWordsList=[
//     {word:'الأَخْيارِ',type:'0'},
//     {word:'بيئَتهِ',type:'0'},
//     {word:'اسْتِعمالِ',type:'0'},
//     {word:'الْمَرْءِ',type:'0'},
//     {word:'الْمَرْءِ',type:'0'},
//     {word:'الأَخْيارِ',type:'0'},
//     {word:'بيئَتهِ',type:'0'},
//     {word:'اسْتِعمالِ',type:'0'},
// ];
// var titleText='أَمْلَأُ الْفَراغَ بِالكَلِمَةِ الْمُناسِبَةِ، وَأُلاحِظُ حَرَكَةَ الْفَتْحَةِ عَلى آخِرِها';
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
    var temDrag={};
    for(var t=0;t<shafalList2.length;t++){
        for(var h=0;h<shafalList2[t].drag.length;h++){
            console.log("word<<<>>>"+shafalList2[t].drag[h])
            temDrag=shafalList2[t].drag[h];
            temDrag['class']=shafalList2[t].id;
            wordList.push(temDrag);
        }
    }
    $(".drop-main-container").html("");
    $(".drag-container").html("");
    for(var t=0;t<wordList.length;t++){
        htmlDrag+='<div class="drag-item jq_itemc_'+wordList[t].class+'" style="margin: 10.94% 1.7% 13.9% 2.3%; width: 46.8%; height: 10%; float: none;"><span data="'+wordList[t].type+'">'+wordList[t].word+'</span><div class="trueanswer" title="true answer"></div></div>'
    }

    if(wrongWordsList.length>0){
        for(var y=0;y<wrongWordsList.length;y++){
            htmlDrag+='<div class="drag-item"  style="margin: 10.94% 1.7% 13.9% 2.3%; width: 46.8%; height: 10%; float: none;"><a class="jq_deleteanswer"><a/><span data="0" class="jq_editable" contenteditable="true">'+wrongWordsList[y].word+'</span></div>'
        }
    }

    for(var i=0;i<shafalList2.length;i++){
        htmlDrop+='<div class="item-container" temp-id="'+shafalList2[i].id+'"><a class="jq_editi"></a><a class="jq_savei"></a><a class="jq_deletei"></a><div class="item-text"><span class="jq_itemc">'+shafalList2[i].image+'</span></div> <div class="number-container"><span>'+(i+1)+'</span></div> '
            for(var x=0;x<shafalList2[i].drag.length;x++){
                htmlDrop+='<div class="drop-item" data="'+shafalList2[i].drag[x].type+'" style="width: '+shafalList2[i].dropSiz[x].w+';height: '+shafalList2[i].dropSiz[x].h+';top: '+shafalList2[i].dropSiz[x].t+';left: '+shafalList2[i].dropSiz[x].r+'"><span></span></div>'
            }
        htmlDrop+='</div>';
    }

    $(".drop-main-container").append(htmlDrop);
    $(".drag-container").append(htmlDrag);
    shuffleDivs(".drag-container");
    // if($(".drag-item").length<=6){
    //     $(".drag-item").css({"margin":"0 0 3.8% 0",width:'64.8%',height:'13.8%',float:'none'});
    //     $(".drag-item:nth-child(1)").css("margin-top","13.94%");
    //     $(".drag-item:nth-child(2)").css("margin-top","0");
    //
    //     $(".drag-item span").css({"line-height":"2.5em"});
    // }else if($(".drag-item").length==8 || $(".drag-item").length==7){
    //     console.log("length<<<>>"+$(".drag-item").length);
    //     // $(".drag-item").css({width:'46.8%',height:'10%',float:'left'});
    //     $(".drag-item:nth-child(1)").css({"margin":"45.94% 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(2)").css({"margin":"45.94% 0 13.9% 0",width:'46.8%',height:'10%',float:'none'});
    //
    //     $(".drag-item:nth-child(3)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(5)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(7)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(9)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(11)").css({"margin": "0 1.7% 0 2.3%",width:'46.8%',height:'10%',float:'none'});
    //
    //     $(".drag-item:nth-child(4)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(6)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(8)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(10)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(12)").css({"margin": "0 0 0 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item span").css({"line-height":"1.8em !important"});
    // }if($(".drag-item").length==9 || $(".drag-item").length==10){
    //     console.log("length<<<>>"+$(".drag-item").length);
    //     // $(".drag-item").css({width:'46.8%',height:'10%',float:'left'});
    //     $(".drag-item:nth-child(1)").css({"margin":"25.94% 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(2)").css({"margin":"25.94% 0 13.9% 0",width:'46.8%',height:'10%',float:'none'});
    //
    //     $(".drag-item:nth-child(3)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(5)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(7)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(9)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(11)").css({"margin": "0 1.7% 0 2.3%",width:'46.8%',height:'10%',float:'none'});
    //
    //     $(".drag-item:nth-child(4)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(6)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(8)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(10)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(12)").css({"margin": "0 0 0 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item span").css({"line-height":"1.8em !important"});
    // }if($(".drag-item").length>10){
    //     console.log("length<<<>>"+$(".drag-item").length);
    //     // $(".drag-item").css({width:'46.8%',height:'10%',float:'left'});
    //     // $(".drag-item:nth-child(1)").css({"margin":"10.94% 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     // $(".drag-item:nth-child(2)").css({"margin":"10.94% 0 13.9% 0",width:'46.8%',height:'10%',float:'none'});
    //
    //     $(".drag-item:nth-child(3)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(5)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(7)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(9)").css({"margin": "0 1.7% 13.9% 2.3%",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(11)").css({"margin": "0 1.7% 0 2.3%",width:'46.8%',height:'10%',float:'none'});
    //
    //     $(".drag-item:nth-child(4)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(6)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(8)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(10)").css({"margin": "0 0 13.9% 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item:nth-child(12)").css({"margin": "0 0 0 0 !important",width:'46.8%',height:'10%',float:'none'});
    //     $(".drag-item span").css({"line-height":"1.8em !important"});
    // }

    // drag()
}
