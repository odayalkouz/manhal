/**
 * Created by osaid zalloum on 30/11/2020.
 */
var itemList=[
    {
        image:"Why do I have to wear sunglasses?",
        correct:[{word:'So that the sun doesn’t hurt your eyes.',type:'1'}],
        incorrect:[{word:'So that you don’t get hurt.',type:"0"},{word:'So that you fit in.',type:"0"},{word:'So that you don’t get cold.',type:"0"}],
        title:"",
    },
    {
        image:"Why do I have to wear a hat?",
        correct:[{word:'So that you don’t get hurt.',type:"1"}],
        incorrect:[{word:'So that you fit in.',type:"0"},{word:'So that you don’t get cold.',type:"0"},{word:'So that your feet don’t get wet.',type:"0"}],
        title:"السؤال الثاني",
    },
    {
        image:"Why do I have to wear boots?",
        correct:[{word:'So that your feet don’t get wet.',type:"1"}],
        incorrect:[{word:'So that you don’t get cold.',type:"0"},{word:'So that you don’t get hurt.',type:"0"},{word:'So that the sun doesn’t hurt your eyes.',type:"0"}],
        title:"السؤال الثالث",
    }
]
var titleText='Choose the correct answer in the following:';
var shuffleList1=[];
var shuffleList2=[];
var shuffleList3=[];
var shuffleList4=[];
function drawList() {
    shuffleList1=[];
    shuffleList2=[];
    shuffleList1=randomarray(itemList.length);
    for(var i=0;i<itemList.length;i++){
        shuffleList2.push(itemList[shuffleList1[i]]);
    }
    $(".title span").html(titleText);
}

function drawItem(a) {
    shuffleList3=[];
    shuffleList4=[];
    $(".drag-container").html("")
    $(".question-text p").html(shuffleList2[a].image);
    $(".question-text").attr("data",shuffleList2[a].type);
    var htmlDrag='';
    for(var i=0;i<shuffleList2[a].correct.length;i++){
        htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><div class="correct-Icon"><i></i></div><span data="'+shuffleList2[a].correct[i].type+'">'+shuffleList2[a].correct[i].word+'</span></div>'
    }
    for(var t=0;t<shuffleList2[a].incorrect.length;t++){
        htmlDrag+='<div class="drag-item" onclick="selectItem(this)"><div class="wrong-Icon"><i></i></div><span data="'+shuffleList2[a].incorrect[t].type+'">'+shuffleList2[a].incorrect[t].word+'</span></div>'
    }
    $(".drag-container").append(htmlDrag);
    shuffleDivs(".drag-container");
    $(".drop-item").fadeIn();
}
