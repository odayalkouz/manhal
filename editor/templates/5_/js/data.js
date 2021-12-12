/**
 * Created by osaid zalloum on 02/12/2020.
 */
var itemList=[
    {
        image:"أَنْ تَنْصَحَ أَخاكَ مُتَأَخِّرًا خَيْرٌ مِنْ تَرْكِهِ عَلى الْخَطَأ.",
        type:"1",
        size:[{w:'9.1%',h:'42%',t:'33%',r:'12.8%'}]
    },
    {
        image:"احْرِصْ عَلى أَنْ تَقْتَصِدَ في اسْتِعمالِ الْماءِ.",
        type:"2",
        size:[{w:'9.3%',h:'42.9%',t:'35.2%',r:'32%'}]
    },
    {
        image:"عَلَى الْمَرْءِ أَنْ يُحافِظَ عَلى بيئَتهِ.",
        type:"3",
        size:[{w:'9.6%',h:'46%',t:'31%',r:'29.2%'}]
    },
    {
        image:"عَلَيْكَ أَنْ تُصاحِبَ الأَخْيارِ.",
        type:"4",
        size:[{w:'12.8%',h:'50%',t:'31.9%',r:'20.9%'}]
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
        htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><span data="'+wordList[t].type+'">'+wordList[t].word+'</span></div>'
    }
    for(var i=0;i<shafalList2.length;i++){
        htmlDrop+='<div class="item-container" data="'+shafalList2[i].type+'"><div class="item-text"><span>'+shafalList2[i].image+'</span></div> <div class="number-container"><span>'+(i+1)+'</span></div> ' +
            '<div class="drop-item" style="width: '+shafalList2[i].size[0].w+';height: '+shafalList2[i].size[0].h+';top: '+shafalList2[i].size[0].t+';right: '+shafalList2[i].size[0].r+'"><span></span></div></div>';
    }
    $(".drop-main-container").append(htmlDrop);
    $(".drag-container").append(htmlDrag);
    shuffleDivs(".drag-container");
    drag()
}
