/**
 * Created by osaid zalloum on 02/12/2020.
 */
var itemList=[
    {
        image:"أَنْ تَنْصَحَ أَخاكَ مُتَأَخِّرًا خَيْرٌ مِنْ تَرْكِهِ عَلى الْخَطَأ.",
        type:"1",
        size:[{w:'7.7%',h:'42%',t:'33%',r:'12.6%'}]
    },
    {
        image:"احْرِصْ عَلى أَنْ تَقْتَصِدَ في اسْتِعمالِ الْماءِ.",
        type:"2",
        size:[{w:'9.3%',h:'42.9%',t:'31.6%',r:'28.6%'}]
    },
    {
        image:"عَلَى الْمَرْءِ أَنْ يُحافِظَ عَلى بيئَتهِ.",
        type:"3",
        size:[{w:'8.9%',h:'46%',t:'31%',r:'26.8%'}]
    },
    {
        image:"عَلَيْكَ أَنْ تُصاحِبَ الأَخْيارِ.",
        type:"4",
        size:[{w:'11.8%',h:'50%',t:'31.9%',r:'20.9%'}]
    },
];
var wordList=[
    {word:'تَنْصَحَ',type:'1'},
    {word:'تَقْتَصِدَ',type:'2'},
    {word:'يُحافِظَ',type:'3'},
    {word:'تُصاحِبَ',type:'4'},
];
var titleText='أَمْلَأُ الْفَراغَ بِالكَلِمَةِ الْمُناسِبَةِ، وَأُلاحِظُ حَرَكَةَ الْفَتْحَةِ عَلى آخِرِها';


var shafalList1=[];
var shafalList2=[];

function drawItem() {
    var htmlDrag='';
    var htmlDrop='';
    shafalList1=[];
    shafalList2=[];
    $(".title span").html(titleText);
    shafalList1=randomarray(itemList.length);
    for(var x=0;x<itemList.length;x++){
        shafalList2.push(itemList[shafalList1[x]]);
    }
    $(".drop-main-container").html("");
    $(".drag-container").html("");
    for(var t=0;t<wordList.length;t++){
        htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><div class="drag-item-inner"> <span data="'+wordList[t].type+'">'+wordList[t].word+'</span></div></div>'
    }
    for(var i=0;i<shafalList2.length;i++){
        htmlDrop+='<div class="item-container" ><div class="inner-item-container">' +
            '<div class="item-text"><span>'+shafalList2[i].image+'</span></div> </div> <div class="number-container"><span>'+(i+1)+'</span></div>'+
            '<div class="drop-item" data="'+shafalList2[i].type+'" style="width: '+shafalList2[i].size[0].w+';height: '+shafalList2[i].size[0].h+';top: '+shafalList2[i].size[0].t+';right: '+shafalList2[i].size[0].r+'"><span></span></div></div>';
        // htmlDrop+='';
    }

    $(".drop-main-container").append(htmlDrop);
    $(".drag-container").append(htmlDrag);
    shuffleDivs(".drag-container");
    if($(".drag-item").length==3) {
        $(".drag-item").css({"margin":"0 0 3.8% 0",width:'64.8%',height:'13.8%',float:'none'});
        $(".drag-item:nth-child(1)").css("margin-top","57.94%");
        $(".drag-item:nth-child(2)").css("margin-top","0");
        $(".drag-item span").css({"line-height":"2.1em"});
    }else if($(".drag-item").length==4) {
        $(".drag-item").css({"margin":"0 0 3.8% 0",width:'64.8%',height:'13.8%',float:'none'});
        $(".drag-item:nth-child(1)").css("margin-top","43.94%");
        $(".drag-item:nth-child(2)").css("margin-top","0");
        $(".drag-item span").css({"line-height":"2.1em"});
    }else if($(".drag-item").length==5) {
        $(".drag-item").css({"margin":"0 0 3.8% 0",width:'64.8%',height:'13.8%',float:'none'});
        $(".drag-item:nth-child(1)").css("margin-top","26.94%");
        $(".drag-item:nth-child(2)").css("margin-top","0");
        $(".drag-item span").css({"line-height":"2.1em"});
    }else if($(".drag-item").length==6){
        $(".drag-item").css({"margin":"0 0 3.8% 0",width:'64.8%',height:'13.8%',float:'none'});
        $(".drag-item:nth-child(1)").css("margin-top","11.04%");
        $(".drag-item:nth-child(2)").css("margin-top","0");

        $(".drag-item span").css({"line-height":"2.1em"});
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
