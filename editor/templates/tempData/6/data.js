/**
 * Created by osaid zalloum on 02/12/2020.
 */

//#Manhal#data#

// var title='أَخْتارُ الإِجابَةَ الصَّحيحَةَ فيما يَأْتي:';
var shuffleList1=[];
var shuffleList2=[];
var shuffleList3=[];
var shuffleList4=[];
$(document).ready(function () {
    for(var x=1;x<=itemList.length;x++){
        $(".true-false-container").append('<span class="question-item item-'+(x).toString()+'"></span>');
    }
});

function drawList() {
    shuffleList1=[];
    shuffleList2=[];
    shuffleList1=randomarray(itemList.length);
    for(var i=0;i<itemList.length;i++){
        shuffleList2.push(itemList[shuffleList1[i]]);
    }

}

function drawItem(a) {
    $(".title span").html(shuffleList2[a].mainTitle);
    $(".drag-container").html("")
    $(".question-text p").html(shuffleList2[a].image);
    $(".question-text").attr("data",shuffleList2[a].type);
    var htmlDrag='';
    for(var i=0;i<shuffleList2[a].correct.length;i++){
        htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><div class="correct-Icon"><i></i></div><span data="'+shuffleList2[a].correct[i].type+'">'+shuffleList2[a].correct[i].word+'</span></div>'
    }
    if(shuffleList2[a].incorrect.length>3){
        for(var t=0;t<3;t++){
            htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><div class="wrong-Icon"><i></i></div><span data="'+shuffleList2[a].incorrect[t].type+'">'+shuffleList2[a].incorrect[t].word+'</span></div>'
        }
    }else {
        for(var t=0;t<shuffleList2[a].incorrect.length;t++){
            htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><div class="wrong-Icon"><i></i></div><span data="'+shuffleList2[a].incorrect[t].type+'">'+shuffleList2[a].incorrect[t].word+'</span></div>'
        }
    }
    $(".drag-container").append(htmlDrag);
    shuffleDivs(".drag-container");
    $(".drop-item").fadeIn();
}
