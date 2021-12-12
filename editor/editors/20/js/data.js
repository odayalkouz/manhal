/**
 * Created by osaid zalloum on 30/08/2020.
 */


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
    //shuffleList1=randomarray(itemList.length);
    for(var i=0;i<itemList.length;i++){
        shuffleList2.push(itemList[i]);
    }
    // shuffleList3=randomarray(bkList.length);
    for(var i=0;i<bkList.length;i++){
        shuffleList4.push(bkList[i]);
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
    // shuffleDivs(".row1");
    // shuffleDivs(".row2");
    $(".card span").each(function(){
        var len=$(this).text().length;
        if(len>=10) {
            $(".card span").addClass("small-font");
        }
    });
}
