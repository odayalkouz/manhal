/**
 * Created by osaid zalloum on 14/02/2021.
 */

// var itemList=[
//     {img1:"تَهْتَزُّ بِشِدَّةٍ",img2:"تَمورُ",type:"1"},
//     {img1:"حِجارَةً صَغيْرَةً",img2:"حاصِبًا",type:"2"},
//     {img1:"طُرُقِها",img2:"مَناكِبِها",type:"3"},
//     {img1:"عَذابٍ",img2:"نَكيْرِ",type:"4"},
//     {img1:"يَسَّرَها لَكُمْ لِلِانْتِفاعِ بِها",img2:"جَعَلَ لَكُمُ الْأَرْضَ ذَلولًا",type:"5"},
// ]
var bkList=[
    {border:"#ea9836",bg:"#fff6ee"},
    {border:"#f28cbd",bg:"#fff3f9"},
    {border:"#d098ea",bg:"#fbf5ff"},
    {border:"#9aa5e8",bg:"#f3f5ff"},
];

var shuffleList1=[];
var shuffleList2=[];
var shuffleList3=[];
var shuffleList4=[];
function drawList() {
    shuffleList1=[];
    shuffleList2=[];
    shuffleList3=[];
    shuffleList4=[];
    // shuffleList1=randomarray(itemList.length);
    for(var i=0;i<itemList.length;i++){
        shuffleList2.push(itemList[i]);
    }
    // shuffleList3=randomarray(bkList.length);
    for(var i=0;i<bkList.length;i++){
        shuffleList4.push(bkList[i]);
    }

}
function drawItem() {
    $("#maintitle").html(mainTitle);
    $("#suptitle").html(supTitle);
    $(".col").html("");
    var html1="";
    var html2="";
    for(var i=0;i<shuffleList2.length;i++){
        html1+='<div onclick="choseCorrect(this)" class="card card-row'+(i+1)+'" data="'+shuffleList2[i].type+'"><span>'+shuffleList2[i].img1+'</span></div>';
        html2+='<div onclick="choseCorrect(this)" class="card card card-row'+(i+1)+'" data="'+shuffleList2[i].type+'"><a class="jq_remove_row"></a><span>'+shuffleList2[i].img2+'</span></div>';
    }
    $(".col1").append(html1);
    $(".col2").append(html2);
    // shuffleDivs(".col1");
    // shuffleDivs(".col2");
    $(".card span").each(function(){
        var len=$(this).text().length;
        if(len>=10) {
            $(".card span").addClass("small-font");
        }
    });
}
