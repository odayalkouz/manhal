/**
 * Created by osaid zalloum on 02/12/2020.
 */

//#Manhal#data#

var titleText='أَخْتارُ الإِجابَةَ الصَّحيحَةَ فيما يَأْتي:';
var shuffleList1=[];
var shuffleList2=[];
var shuffleList3=[];
var shuffleList4=[];
function drawList() {
    shuffleList1=[];
    shuffleList2=[];
    shuffleList2=itemList
}
$(document).ready(function () {
    for(var x=1;x<=itemList.length;x++){
        $(".true-false-container").append('<span class="question-item item-'+(x).toString()+'"></span>');
    }
});


function drawItem(a) {
    shuffleList3=[];
    shuffleList4=[];
    $(".title-text span").html(shuffleList2[a].mainTitle);
    $(".question-text span").html(shuffleList2[a].title);
    $(".text-question span").html(shuffleList2[a].image);
    $(".drag-container").html("");
    var htmlDrag='';
    var cc=1;
    for(var i=0;i<shuffleList2[a].correct.length;i++){
        htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><span data="'+shuffleList2[a].correct[i].type+'">'+shuffleList2[a].correct[i].word+'</span></div>'

    }
    for(var t=0;t<shuffleList2[a].incorrect.length;t++){
        htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><span data="'+shuffleList2[a].incorrect[t].type+'">'+shuffleList2[a].incorrect[t].word+'</span></div>'

    }
    $(".drag-container").append(htmlDrag);
    shuffleDivs(".drag-container");
    $(".drop-item").fadeIn();
}
