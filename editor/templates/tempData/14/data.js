/**
 * Created by osaid zalloum on 13/09/2020.
 */
// var title="أُكْمِلُ النَّمَطَ,ثُمَّ أَقْرَأُ";
// var itemList=[
//     {img1:'ساحَةُ الْمَدْرَسَةِ',indexType:'0',answer:'الْمَدْرَسَةِ'},
//     {img1:'سورُ الْحِديقَةِ',indexType:'1',answer:'الْحِديقَةِ'},
//     {img1:'مِفْتاحُ الْبابِ',indexType:'2',answer:'الْبابِ'},
//     {img1:'شاشَةُ الْحاسوبِ',indexType:'3',answer:'الْحاسوبِ'},
//     {img1:'نورُ الشَّمْسِ',indexType:'4',answer:'الشَّمْسِ'},
//     {img1:'عَلَمُ بِلادي',indexType:'5',answer:'بِلادي'},
//     {img1:'وَسائِلُ الْمواصَلاتِ',indexType:'6',answer:'الْمواصَلاتِ'},
//     {img1:'مِنَصَّةُ الْمَسْرَحِ',indexType:'7',answer:'الْمَسْرَحِ'},
//     {img1:'طاعَةُ الْوالِدَينِ',indexType:'8',answer:'الْوالِدَينِ'},
//     {img1:'صَفَحاتُ الْكِتابِ',indexType:'9',answer:'الْكِتابِ'},
// ];
    //#Manhal#data#
var shuffleList1=[];
var shuffleList2=[];
var shuffleList3=[];
var shuffleList4=[];
var wordList2=[];
var wordLength=0;
var loop=0;
function drawList() {
    shuffleList1=[];
    shuffleList2=[];
    wordList2=[];
    shuffleList1=randomarray(itemList.length);
    // for(var i=0; i<itemList.length;i++){
    //     shuffleList2.push(itemList[shuffleList1[i]]);
    // }
    if(itemList.length<4){
         loop=itemList.length;
    }else{
        loop=4;
    }
    for(var i=0; i<loop;i++){
        shuffleList2.push(itemList[shuffleList1[i]]);
    }
}

function drawItem() {
    $(".title span").html(title);
    $(".sup-title span").html(supTitle);
    $(".drag-container").html("");
    $(".drop-inner-container").html("");
    var htmlDrag='';
    var htmlDrop='';
    var htmlDropInner='';
    var splitTextList=[];
    var splitText='';

    for (var i=0;i<loop;i++){
        splitText=shuffleList2[i].img1.split(" ");
        splitTextList.push({text:splitText});
    }
    for(var r=0;r<splitTextList.length;r++){
        htmlDropInner='';
        for (var t=0;t<splitTextList[r].text.length;t++){
            if(shuffleList2[r].answer==splitTextList[r].text[t]){
                htmlDrag+='<div class="drag-item"><div class="inner-drag-item"><span data="'+splitTextList[r].text[t]+'">'+splitTextList[r].text[t]+'</span></div></div>'
                htmlDropInner+='<div class="word-container" data="'+splitTextList[r].text[t]+'"><div class="dott"><span></span></div><div class="inner-word"><span>'+splitTextList[r].text[t]+'</span></div></div>'
            }else {
                htmlDropInner+='<div class="word-container"><div class="inner-word"><span>'+splitTextList[r].text[t]+'</span></div></div>'
            }
        }
        htmlDrop+='<div class="drop-item drop-'+(r+1)+'"><div class="inner-drop-item">'+htmlDropInner+'</div></div>';
    }
    // htmlDrag+='<div class="drag-item"><div class="inner-drag-item"><span data="'+shuffleList2[5].answer+'">'+shuffleList2[5].answer+'</span></div></div>';
    // htmlDrag+='<div class="drag-item"><div class="inner-drag-item"><span data="'+shuffleList2[6].answer+'">'+shuffleList2[6].answer+'</span></div></div>';

    $(".drop-inner-container").append(htmlDrop);
    $(".drag-container").append(htmlDrag);
    if(wrongAnswer.length !=0){
        var wrongCount=6-($(".drag-item").length);
        console.log("wrongCount<<>>"+wrongCount)
        if(wrongAnswer.length>=wrongCount){
            for(var h=0;h<wrongCount;h++){
                console.log("condetion1")
                $('<div class="drag-item " data="0"><div class="inner-drag-item"><span data="'+wrongAnswer[h]+'">'+wrongAnswer[h]+'</span></div></div>').appendTo(".drag-container");
            }
        }else {
            for(var h=0;h<wrongAnswer.length;h++){
                console.log("condetion2")
                $('<div class="drag-item " data="0"><div class="inner-drag-item"><span data="'+wrongAnswer[h]+'">'+wrongAnswer[h]+'</span></div></div>').appendTo(".drag-container");
            }
        }
        wordLength++;

    }
    shuffleDivs(".drag-container");
    drag();
}
