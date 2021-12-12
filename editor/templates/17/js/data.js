/**
 * Created by osaid zalloum on 14/02/2021.
 */

// var itemList=[
//     {img1:"images/im01.svg",img2:"صَباحُ الْخَيْر",type:"1"},
//     {img1:"images/im02.svg",img2:"خُطوطُ الْمُشاة",type:"2"},
//     {img1:"images/im03.svg",img2:"إِشارَةُ الْمُرور",type:"3"},
//     {img1:"images/im04.svg",img2:"حافِلَةُ الْمَدْرَسَة",type:"4"},
// ];
var itemList=[
    {
        card1:{imag:"images/im01.svg",title:"صَباحُ الْخَيْر",text:"",cat:'1'},
        card2:{imag:"",title:"",text:"صَباحُ الْخَيْر" ,cat:'0'},
        type:'1',
    },
    {
        card1:{imag:"images/im02.svg",title:"خُطوطُ الْمُشاة",text:"",cat:'1'},
        card2:{imag:"",title:"",text:"خُطوطُ الْمُشاة",cat:'0'},
        type:'2',
    },
    {
        card1:{imag:"images/im03.svg",title:"إِشارَةُ الْمُرور",text:"",cat:'1'},
        card2:{imag:"",title:"",text:"إِشارَةُ الْمُرور",cat:'0'},
        type:'3',
    },
    {
        card1:{imag:"images/im04.svg",title:"حافِلَةُ الْمَدْرَسَة",text:"",cat:'1'},
        card2:{imag:"",title:"",text:"حافِلَةُ الْمَدْرَسَة",cat:'0'},
        type:'4',
    }
];
// var itemList=[
//     {img1:"images/im01.png",img2:"images/im01.png",type:"1"},
//     {img1:"images/im02.png",img2:"images/im02.png",type:"2"},
//     {img1:"images/im03.png",img2:"images/im03.png",type:"3"},
//     {img1:"images/im04.png",img2:"images/im04.png",type:"4"},
// ]
var bkList=[
    {borderColor:"#FFA352",bkColor:'rgba(255,163,82,0.1)'},
    {borderColor:"#ff5555",bkColor:'rgba(255,85,85,0.1)'},
    {borderColor:"#92D0FF",bkColor:'rgba(146,208,255,0.1)'},
    {borderColor:"#9AA5E8",bkColor:'rgba(154,165,232,0.1)'},
];
var shuffleList1=[];
var shuffleList2=[];
var shuffleList3=[];
var shuffleList4=[];
function drawList() {
    shuffleList1=[];
    shuffleList2=[];
    shuffleList3=[];
    shuffleList4=[];
    shuffleList1=randomarray(itemList.length);
    if(itemList.length<4){
        var loop=itemList.length;
    }else{
        var loop=4;
    }
    for(var i=0;i<loop;i++){
        shuffleList2.push(itemList[shuffleList1[i]]);
    }
    shuffleList3=randomarray(bkList.length);
    for(var i=0;i<bkList.length;i++){
        shuffleList4.push(bkList[shuffleList3[i]]);
    }

}
function hasAnything(selector) {
    return document.querySelector(selector).innerHTML.trim().length > 0;
}

function drawItem() {
    $(".col").html("");
    var html1="";
    var html2="";
    for(var i=0;i<shuffleList2.length;i++){
        html1+='<div onclick="choseCorrect(this)" class="card cardClick" bk="'+shuffleList4[i].borderColor+'" bk2="'+shuffleList4[i].bkColor+'" data="'+shuffleList2[i].type+'"><div class="image-container" cat="'+shuffleList2[i].card1.cat+'"><img src="'+shuffleList2[i].card1.imag+'"></div>' +
               '<div class="img-title"><span>'+shuffleList2[i].card1.title+'</span></div><div class="inner-card" bk="'+shuffleList4[i].bkColor+'"><span class="textSpan">'+shuffleList2[i].card1.text+'</span></div></div>';
        html2+='<div onclick="choseCorrect(this)" class="card cardClick" bk="'+shuffleList4[i].borderColor+'" bk2="'+shuffleList4[i].bkColor+'" data="'+shuffleList2[i].type+'">' +
            '<div class="inner-card" bk="'+shuffleList4[i].bkColor+'"><span class="textSpan">'+shuffleList2[i].card2.text+'</span></div></div>';
    }
    $(".col1").append(html1);
    $(".col2").append(html2);
    $(".card").each(function () {
        if($(this).find(".image-container").attr("cat")=="1"){
            $(this).find(".image-container").css("height","76%");
        }else {
            $(this).find(".img-title").fadeOut();
        }
    })
    // if($(".image-container").attr("cat")=="1"){
    //     $(".image-container").css("height","76%");
    // }else {
    //     $(".image-container").css("height","100%");
    // }
    shuffleDivs(".col1");
    shuffleDivs(".col2");
}
