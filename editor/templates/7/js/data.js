
/**
 * Created by osaid zalloum on 14/12/2020.
 */
var itemList=[
    {word:"أَنْجَزَتْ جَنى واجِباتِها الْمَدْرَسِيَّةِ بِإِتْقانٍ في الْوَقْتِ الذي وَعَدَتْ بِهِ مُعَلِّمَتَها.",type:"1"},
    {word:"اشْتَرَكَ قَيْسٌ في إِحْداثِ الْفَوْضى في الصَّفِّ، ثُمَّ أَنْكَرَ ذلِكَ.",type:"0"},
    {word:"اسْتَوْدَعَتْ مَها أُخْتَها سِرًا، فَأَذاعَتْهُ.",type:"0"},
    {word:"شَهِدَ سَميرٌ بِشَيءٍ لا يَعْرِفُهُ إِرْضاءً لِصَديقِهِ سَعيدٍ.",type:"0"}
];
var title='صفات المنافق';
var itemList2=[];
var shuffleList1=[];
var shuffleList2=[];
var itemSelct=[];
function drawlistArray() {
    itemList2=[]
    shuffleList1=[];
    shuffleList2=[];
    shuffleList1=randomarray(itemList.length);
    for(var i=0;i<itemList.length;i++){
        itemList2.push(itemList[shuffleList1[i]])
    }
    if(itemList2.length<=4){
        itemSelct=itemList2;
    }else if(itemList2.length>4){
        for (var x=0;x<4;x++){
            itemSelct.push(itemList2[x]);
        }
    }
    if(itemSelct.length==4){
        $(".text-inner-container").css("top","19.047%");
    }else if(itemSelct.length==3){
        $(".text-inner-container").css("top","29.047%");
    }else if(itemSelct.length==2){
        $(".text-inner-container").css("top","37.047%");
    }

}

function drawItem(){
    $(".title span").html(title);
    drawlistArray()
    $(".text-inner-container").html("");
    var html="";
    for(var i=0;i<itemSelct.length;i++){
        html+='<div class="text-container" data="'+itemSelct[i].type+'">' +
              '<div class="number-question"><span>'+(i+1)+'</span></div> ' +
              '<div class="text-bg-container"><p>'+itemSelct[i].word+'</p></div> ' +
              '<div class="trueFalse">' +
              '<a class="true-btn" data="1" onclick="choseCorrect(this)"></a>' +
              '<a class="false-btn" data="0" onclick="choseCorrect(this)"></a>' +
              '</div>' +
              '</div>'
    }
    $(".text-inner-container").append(html);
    // shuffleDivs(".text-inner-container");
}
