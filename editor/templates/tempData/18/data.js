/**
 * Created by osaid zalloum on 27/01/2021.
 */
//#Manhal#data#
var correct = 0;
var allCorrect = 0;
var incorrect = 0;


var shuffleList1=[];
var shuffleList2=[];
function drawList() {
    shuffleList1=[];
    shuffleList2=[];
    $(".true-false-container").html(" ");
    shuffleList1=randomarray(itemList.length);
    if(itemList.length<4){
        var loop=itemList.length;
    }else{
        var loop=4;
    }
    for(var i=0;i<loop;i++){
        shuffleList2.push(itemList[shuffleList1[i]]);
    }
    var qusHtml='';
    for(var x=0;x<loop;x++){
        qusHtml+='<span class="question-item item-'+(x+1)+'"></span>'
    }
    $(".true-false-container").append(qusHtml);
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
    $(".ans-container").html('');
    var splitText=shuffleList2[a].text.split(" ");
    for(var i=0;i<splitText.length;i++){
        html+='<div class="drag-item"><span>'+splitText[i]+'</span></div>'
    }
    for(var i=0;i<shuffleList2[a].ans.length;i++){
        html2+='<div class="ans-box" data="'+shuffleList2[a].ans[i]+'">' +
               '<div class="qus-mark"></div>' +
               '<div class="dot-container"></div>' +
               '<div class="ans-text"><span></span></div>' +
               '</div>'
    }

    $(".qus-item").html('<div class="dot"><span>'+(a+1)+'</span></div><div class="qus-item-text"><span>'+shuffleList2[a].qus+'</span></div>');
    $(".ans-container").append(html2);
    $(".text-container").html(html);
    if(shuffleList2[a].imgShow==true){
        $(".img-container").addClass("show");
        $(".img-container img").attr("src",shuffleList2[a].img);
        $(".text-container").css("width","65.238%");
    }else {
        $(".text-container").css("width","100%");
    }

    drag();
}
