/**
 * Created by osaid zalloum on 27/01/2021.
 */

var correct = 0;
var allCorrect = 0;
var incorrect = 0;
var itemList=[
    {text:'الصِّدْقُ فَضيلَةٌ',anser1:'الصِّدْقُ',anser2:'فَضيلَةٌ'},
    {text:'الْبَحْرُ هادِئٌ',anser1:'الْبَحْرُ',anser2:'هادِئٌ'},
    {text:'الْفَلّاحُ نَشيطٌ في عَمَلِهِ',anser1:'الْفَلّاحُ',anser2:'نَشيطٌ'},
    {text:'عُصْفورٌ في الْيَدِ خَيْرٌ مِنْ عَشْرَةٍ عَلى الشَّجَرَةِ',anser1:'عُصْفورٌ',anser2:'خَيْرٌ'},
    {text:'اللَّوحَةُ التي رَسَمَها أَخي جَميلَةٌ',anser1:'اللَّوحَةُ',anser2:'جَميلَةٌ'},
];
var shuffleList1=[];
var shuffleList2=[];
var mainTitle="أُعَيِّنُ الْمُبْتَدَأَ وَالْخَبَرَ في الْجُمَلِ التّاليَةِ:";
var titleA="الْمُبْتَدَأُ";
var titleB="الْخَبَرُ";


function drawItem(){
    shuffleList1=[];
    shuffleList2=[];
    var html1='';
    var html2='';
    var dropHtml1='';
    var dropHtml2='';
    $(".title span").html(mainTitle);
    $(".left-header span").html(titleB);
    $(".right-header span").html(titleA);
    $(".right-drop").html("");
    $(".left-drop").html("");
    $(".drag-container").html("");
    $(".item-main-container").html("");
    $(".qusMark").fadeIn();
    $(".text-container span").css("opacity","0");
    shuffleList1=randomarray(itemList.length);
    for(var i=0;i<itemList.length;i++){
        shuffleList2.push(itemList[shuffleList1[i]])
    }

    for(var i=0;i<shuffleList2.length;i++){
        html2="";
        html1+='<div class="text-item item-'+(i+1)+'"><div class="text-container"><div class="dot"></div><div class="text-inner-item" data="'+(i+1)+'">';
        var sentence=shuffleList2[i].text.split(" ");
        for(var x=0;x<sentence.length;x++){
            html2+='<div class="drag-item drag-'+(x+1)+'" data=""><span data="'+sentence[x]+'">'+sentence[x]+'</span></div>';
        }
        html1+=html2+'</div></div></div>';
    }
    var htmldrop='';

    $(".text-main-container").append(html1);
    for(var i=0;i<shuffleList2.length;i++){
        htmldrop='';
        htmldrop='<div class="drop-container">';
        htmldrop+='<div class="drop-item drop-1" data="'+shuffleList2[i].anser1+'"><span></span></div>' +
                  '<div class="drop-item drop-2" data="'+shuffleList2[i].anser2+'"><span></span></div></div>'
        // htmldrop+='</div>'
        $(".item-"+(i+1)).append(htmldrop);
    }
    $(".right-drop").append(dropHtml1);
    $(".left-drop").append(dropHtml2);
    drag();
    // shuffleDivs(".drag-container");
}
