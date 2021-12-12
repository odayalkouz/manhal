/**
 * Created by osaid zalloum on 30/08/2020.
 */

//#Manhal#data#


for(var i=1;i<=itemList.length;i++){
    $(".true-false-container").append('<span class="question-item item-'+(i).toString()+'"></span>');
}
var wrongItem=[
    "images/wrong/01.svg",
    "images/wrong/02.svg",
    "images/wrong/03.svg",
    "images/wrong/04.svg",
    "images/wrong/05.svg",
    "images/wrong/06.svg",
    "images/wrong/07.svg",
    "images/wrong/08.svg"
];
var shuffleList3=[];
var shuffleList4=[];
function drawList() {
    shuffleList3=[];
    shuffleList4=[];
    shuffleList3=randomarray(itemList.length);
    for(var i=0;i<itemList.length;i++){
        shuffleList4.push(itemList[shuffleList3[i]]);
    }
}
function drawItem(a) {
    var draghtml='';
    var drophtml='';
    var shuffleList1=[];
    var shuffleList2=[];
    var wrongDrag='';
    correct=0;
    shuffleList1=randomarray(shuffleList4[a].wrongItem.length);
    for(var c=0;c<shuffleList4[a].wrongItem.length;c++){
        shuffleList2.push(shuffleList4[a].wrongItem[shuffleList1[c]])
    }
    $(".jq_title").html(shuffleList4[a].question);
    // console.log("shuffleList2<<<>>>"+shuffleList2)
    $(".drag-container").html(" ");
    $(".drop-item-container").html(" ");
    $(".word-container").css({"width":shuffleList4[a].dropStyle[0].w,"height":shuffleList4[a].dropStyle[0].h}).attr("data",shuffleList4[a].drag.length);
    $(".drop-item-container").css({"width":shuffleList4[a].dropStyle[0].dropW,"height":shuffleList4[a].dropStyle[0].dropH})
    $(".word").css({"width":shuffleList4[a].dropStyle[0].wordW,"height":shuffleList4[a].dropStyle[0].wordH}).find("span").html(shuffleList4[a].word)
    $(".arrow").css({"width":shuffleList4[a].dropStyle[0].arrow,"height":shuffleList4[a].dropStyle[0].arrowH,"right":shuffleList4[a].dropStyle[0].arrowR})
    for(var i=0;i<shuffleList4[a].drag.length;i++){
        if(shuffleList4[a].drag.length>5){
            drophtml+='<div data="'+(i+1)+'" class="drop-item" ' +
                'style="width: 15%;margin-right: 2%">' +
                '<span style="opacity: 0"  data="'+shuffleList4[a].drag[i].type+'">'+shuffleList4[a].drag[i].img+'</span></div>';
        }else {
            drophtml+='<div data="'+(i+1)+'" class="drop-item" ' +
                'style="width: '+shuffleList4[a].dropStyle[0].dropItemW+';margin-right: '+shuffleList4[a].dropStyle[0].dropItemL+'">' +
                '<span style="opacity: 0"  data="'+shuffleList4[a].drag[i].type+'">'+shuffleList4[a].drag[i].img+'</span></div>';
        }

        draghtml+='<div class="drag-item" onmousedown="choseCorrect(this)" onclick="choseCorrect(this)"><span data="'+shuffleList4[a].drag[i].type+'">'+shuffleList4[a].drag[i].img+'</span></div>';
    }
    $(".drop-item-container").append(drophtml);
    $(".drag-container").append(draghtml);

    if(shuffleList4[a].drag.length==3){
        for(var t=0;t<5;t++){
            wrongDrag+='<div class="drag-item" onmousedown="choseCorrect(this)" onclick="choseCorrect(this)"><span data="0">'+shuffleList2[t]+'</span></div>';
        }
    }else if(shuffleList4[a].drag.length==4){
        for(var t=0;t<4;t++){
            wrongDrag+='<div class="drag-item" onmousedown="choseCorrect(this)" onclick="choseCorrect(this)"><span data="0">'+shuffleList2[t]+'</span></div>';
        }
    }else if(shuffleList4[a].drag.length==5){
        for(var t=0;t<3;t++){
            wrongDrag+='<div class="drag-item" onmousedown="choseCorrect(this)" onclick="choseCorrect(this)"><span data="0">'+shuffleList2[t]+'</span></div>';
        }
    }else if(shuffleList4[a].drag.length==2){
        for(var t=0;t<6;t++){
            wrongDrag+='<div class="drag-item" onmousedown="choseCorrect(this)" onclick="choseCorrect(this)"><span data="0">'+shuffleList2[t]+'</span></div>';
        }
    }else if(shuffleList4[a].drag.length==6){
        for(var t=0;t<2;t++){
            wrongDrag+='<div class="drag-item" onmousedown="choseCorrect(this)" onclick="choseCorrect(this)"><span data="0">'+shuffleList2[t]+'</span></div>';
        }
    }
    $(".drag-container").append(wrongDrag);
    $(".drop-item:nth-child(2)").addClass("selected")
    $(".drop-item:first-child span").css("opacity","1");
    shuffleDivs(".drag-container");
    // drag();
}
