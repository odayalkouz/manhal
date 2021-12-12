/**
 * Created by osaid zalloum on 02/12/2020.
 */
var itemList=[
    {
        image:"مَعْنى (نَقَموا) في قَولِهِ تَعالى : (وَمَا نَقَمُوا مِنْهُمْ إِلَّا أَنْ يُؤْمِنُوا بِاللَّهِ الْعَزِيزِ الْحَمِيدِ)",
        correct:[{word:"كَرِهوا",type:"1"}],
        incorrect:[{word:"شاهَدوا",type:"0"},{word:"أَحَبّوا",type:"0"}],
        title:"السؤال الأول",
    },
    {
        image:"مَعْنى (فَتَنوا) في قَولِهِ تَعالى : (إِنَّ الَّذِينَ فَتَنُوا الْمُؤْمِنِينَ وَالْمُؤْمِنَاتِ ثُمَّ لَمْ يَتُوبُوا)",
        correct:[{word:"عَذَّبوا",type:"1"}],
        incorrect:[{word:"أَعْجَبوا",type:"0"},{word:"سَحروا",type:"0"}],
        title:"السؤال الثاني",
    },
    {
        image:"(اليَومِ الْمَوعودِ) يَعْني يَومُ:",
        correct:[{word:"القيامَةِ",type:"1"}],
        incorrect:[{word:"الْعيدِ",type:"0"},{word:"الرُّجوعِ",type:"0"}],
        title:"السؤال الثالث",
    }
]
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

function drawItem(a) {
    shuffleList3=[];
    shuffleList4=[];
    $(".question-text span").html(shuffleList2[a].title);
    $(".text-question span").html(shuffleList2[a].image);
    $(".drag-container").html("");
    var htmlDrag='';
    for(var i=0;i<shuffleList2[a].correct.length;i++){
        htmlDrag+='<div class="drag-item jq_editable" onclick="selectItem(this)"><span data="'+shuffleList2[a].correct[i].type+'">'+shuffleList2[a].correct[i].word+'</span></div>'
    }
    for(var t=0;t<shuffleList2[a].incorrect.length;t++){
        htmlDrag+='<div class="drag-item jq_editable" onclick="selectItem(this)"><span data="'+shuffleList2[a].incorrect[t].type+'">'+shuffleList2[a].incorrect[t].word+'</span></div>'
    }
    $(".drag-container").append(htmlDrag);
    shuffleDivs(".drag-container");
    $(".drop-item").fadeIn();
}
