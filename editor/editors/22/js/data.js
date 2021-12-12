/**
 * Created by osaid zalloum on 02/12/2020.
 */
// var itemList=[
//     {
//         image:"إِقْرارُ النَّبِيِّ صلى الله عليه وسلم أَصْحابَهُ عَلى قِراءَةِ سورَةِ الْفاتِحَةِ عَلى المَلْدوغِ.",
//         correct:[{word:'سُنَّةٌ تَقْريريَّةٌ',type:'1'}],
//         incorrect:[{word:'سُنَّةٌ قَوليَّةٌ',type:"0"},{word:'صفة خُلُقيَّةٌ',type:"0"},{word:'سُنَّةٌ فِعْليَّةٌ',type:"0"}],
//         title:"",
//     },
//     {
//         image:"قالَ النَّبِيُّ صلى الله عليه وسلم : لا يُؤْمِنُ أَحَدُكُمْ حَتّى يُحِبَّ لِأَخيهِ ما يُحِبُّ لِنَفْسِهِ.",
//         correct:[{word:'سُنَّةٌ قَوليَّةٌ',type:"1"}],
//         incorrect:[{word:'سُنَّةٌ تَقْريريَّةٌ',type:"0"},{word:'صفة خُلُقيَّةٌ',type:"0"},{word:'سُنَّةٌ فِعْليَّةٌ',type:"0"}],
//         title:"السؤال الثاني",
//     },
//     {
//         image:"كانَ النَّبِيُّ صلى الله عليه وسلم أَشْجَعَ النّاسِ",
//         correct:[{word:'صفة خُلُقيَّةٌ',type:"1"}],
//         incorrect:[{word:'سُنَّةٌ تَقْريريَّةٌ',type:"0"},{word:'سُنَّةٌ تَقْريريَّةٌ',type:"0"},{word:'سُنَّةٌ فِعْليَّةٌ',type:"0"}],
//         title:"السؤال الثالث",
//     }
// ]
// var mainTitle='أَخْتارُ الإِجابَةَ الصَّحيحَةَ فيما يَأْتي:';
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

}

function drawItem(a) {
    shuffleList3=[];
    shuffleList4=[];
    $(".title span").html(shuffleList2[a].mainTitle);
    $(".drag-container").html("")
    $(".question-text p").html(shuffleList2[a].image);
    $(".question-text").attr("data",shuffleList2[a].type);
    var htmlDrag='';
    for(var i=0;i<shuffleList2[a].correct.length;i++){
        htmlDrag+='<div class="drag-item" onclick=""><span data="'+shuffleList2[a].correct[i].type+'">'+shuffleList2[a].correct[i].word+'</span></div>'
    }
    for(var t=0;t<shuffleList2[a].incorrect.length;t++){
        htmlDrag+='<div class="drag-item" onclick=""><span data="'+shuffleList2[a].incorrect[t].type+'">'+shuffleList2[a].incorrect[t].word+'</span></div>'
    }
    $(".drag-container").append(htmlDrag);
    shuffleDivs(".drag-container");
    $(".drop-item").fadeIn();
}
