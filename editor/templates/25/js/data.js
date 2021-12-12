/**
 * Created by osaid zalloum on 30/09/2021.
 */

var itemList=[
    {img1:"Order",img2:"Chaos",type:"1"},
    {img1:"Health",img2:"Disease",type:"2"},
    {img1:"Loved",img2:"Hate",type:"3"},
    {img1:"New",img2:"Old",type:"4"},
]
var bkList=[
    "images/click01.svg",
    "images/click02.svg",
    "images/click03.svg",
    "images/click04.svg"
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
    for(var i=0;i<itemList.length;i++){
        shuffleList2.push(itemList[shuffleList1[i]]);
    }
    shuffleList3=randomarray(bkList.length);
    for(var i=0;i<bkList.length;i++){
        shuffleList4.push(bkList[shuffleList3[i]]);
    }

}
function drawItem() {
    $(".row").html("");
    var html1="";
    var html2="";
    for(var i=0;i<shuffleList2.length;i++){
        html1+='<div onclick="choseCorrect(this)" class="card" bk="'+shuffleList4[i]+'" data="'+shuffleList2[i].type+'"><span>'+shuffleList2[i].img1+'</span></div>';
        html2+='<div onclick="choseCorrect(this)" class="card" bk="'+shuffleList4[i]+'" data="'+shuffleList2[i].type+'"><span>'+shuffleList2[i].img2+'</span></div>';
    }
    $(".row1").append(html1);
    $(".row2").append(html2);
    shuffleDivs(".row1");
    shuffleDivs(".row2");
    $(".card span").each(function(){
        var len=$(this).text().length;
        if(len>=10) {
            $(".card span").addClass("small-font");
        }
    });
}
