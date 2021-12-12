/**
 * Created by osaid zalloum on 27/01/2021.
 */

var correct = 0;
var allCorrect = 0;
var incorrect = 0;


var shuffleList1=[];
var shuffleList2=[];
function drawList() {
    shuffleList1=[];
    shuffleList2=[];
    shuffleList1=randomarray(itemList.length);
    for(var i=0;i<itemList.length;i++){
        shuffleList2.push(itemList[shuffleList1[i]]);
    }
}
function drawItem(a){
    var html='';
    var html2='';
    $(".qus-mark").fadeIn();
    $(".dot-container").fadeIn();
    $(".ans-text span").html("");
    $(".title span").html(title);
    $(".qus-text span").html(shuffleList2[a].question)
    $(".text-container").html('');
    $(".all-text p").html('');
    $(".ans-container").html('');
    var splitText=shuffleList2[a].text.split(" ");
    for(var i=0;i<splitText.length;i++){
        html+='<div class="drag-item"><span>'+splitText[i]+'</span></div>'
    }
    $(".qus-item").html('<div class="dot"><span>'+(a+1)+'</span></div><div class="qus-item-text jq_editable"><span>'+shuffleList2[a].qus+'</span></div>');

    for(var i=0;i<shuffleList2[a].ans.length;i++){
        html2+='<div class="ans-box" data="'+shuffleList2[a].ans+'"><a class="jq_removesquare" title="Delete"></a>' +
               '<div class="ans-text"><span>'+shuffleList2[a].ans+'</span></div></div>'
    }
    $(".ans-container").append(html2);
    $(".text-container").html(html);
    $(".all-text p").html(shuffleList2[a].text);
    if(shuffleList2[a].imgShow==true){
        $(".img-container").addClass("show");
        $(".img-container img").attr("src",shuffleList2[a].img);
        $(".text-container").css("width","65.238%");
    }else {
        $(".text-container").css("width","100%");
        $(".all-text").css("width","100%");
        $(".jq_editi").css("left","1%");
        $(".jq_savei").css("left","1%");
        $(".jq_addImage").show();
    }

    drag();
}
