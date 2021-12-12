/**
 * Created by osaid zalloum on 14/02/2021.
 */

var itemList=[
    {img1:"Why do I have to wear a hat?",img2:"So that you don’t get cold.",type:"1"},
    {img1:"Why do I have to wear sunglasses?",img2:"So that the sun doesn’t hurt your eyes.",type:"2"},
    {img1:"Why do I have to wear boots?",img2:"So that your feet don’t get wet.",type:"3"},
    {img1:"Why do I have to wear a uniform?",img2:"So that you fit in.",type:"4"},
    {img1:"Why do I have to wear a helmet?",img2:"So that you don’t get hurt.",type:"5"},
]
var bkList=[
    {border:"#ea9836",bg:"#fff6ee"},
    {border:"#f28cbd",bg:"#fff3f9"},
    {border:"#d098ea",bg:"#fbf5ff"},
    {border:"#9aa5e8",bg:"#f3f5ff"},
];
var mainTitle='Main Title';
var supTitle='Choose each of the vocabulary and what is close to it in the meaning:';
var shuffleList1=[];
var shuffleList2=[];
var shuffleList3=[];
var shuffleList4=[];
var wordLength=0;
function drawList() {
    shuffleList1=[];
    shuffleList2=[];
    shuffleList3=[];
    shuffleList4=[];
    shuffleList1=randomarray(itemList.length);
    for(var i=0;i<itemList.length;i++){
        shuffleList2.push(itemList[shuffleList1[i]]);
    }
    shuffleList3=randomarray(bkList.length);
    for(var i=0;i<bkList.length;i++){
        shuffleList4.push(bkList[shuffleList3[i]]);
    }

}
function drawItem() {
    $(".title span").html(mainTitle);
    $(".inner-sup-title span").html(supTitle);
    $(".col").html("");
    var html1="";
    var html2="";
    if(shuffleList2.length>4){
        for(var i=0;i<4;i++){
            html1+='<div onclick="choseCorrect(this)" class="card" borderbg="'+shuffleList4[i].border+'" bk="'+shuffleList4[i].bg+'" data="'+shuffleList2[i].type+'"><span>'+shuffleList2[i].img1+'</span></div>';
            html2+='<div onclick="choseCorrect(this)" class="card" borderbg="'+shuffleList4[i].border+'" bk="'+shuffleList4[i].bg+'" data="'+shuffleList2[i].type+'"><span>'+shuffleList2[i].img2+'</span></div>';
            wordLength++;
        }
    }else {
        for(var i=0;i<shuffleList2.length;i++){
            html1+='<div onclick="choseCorrect(this)" class="card" borderbg="'+shuffleList4[i].border+'" bk="'+shuffleList4[i].bg+'" data="'+shuffleList2[i].type+'"><span>'+shuffleList2[i].img1+'</span></div>';
            html2+='<div onclick="choseCorrect(this)" class="card" borderbg="'+shuffleList4[i].border+'" bk="'+shuffleList4[i].bg+'" data="'+shuffleList2[i].type+'"><span>'+shuffleList2[i].img2+'</span></div>';
            wordLength++;
        }
    }
    if(shuffleList2.length==3){
        $(".inner-card-container").css("top","26.431%");
    }
    $(".col1").append(html1);
    $(".col2").append(html2);
    shuffleDivs(".col1");
    shuffleDivs(".col2");
}
