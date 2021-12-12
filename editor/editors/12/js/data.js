
/**
 * Created by osaid zalloum on 14/12/2020.
 */
// var itemList=[
//     {word:"شَهِدَ سَميرٌ بِشَيءٍ لا يَعْرِفُهُ إِرْضاءً لِصَديقِهِ سَعيدٍ.",type:"0"}
// ];
// var title='صفات المنافق';
var itemList2=[];
var shuffleList1=[];
var shuffleList2=[];
var itemSelct=[];
function drawlistArray() {
    itemList2=[]
    shuffleList1=[];
    shuffleList2=[];
    shuffleList1=randomarray(itemList.length);
    itemList2=itemList;
    // for(var i=0;i<itemList.length;i++){
    //     itemList2.push(itemList[shuffleList1[i]])
    // }
    // if(itemList2.length<=4){
    //     itemSelct=itemList2;
    // }else if(itemList2.length>4){
    //     for (var x=0;x<0;x++){
    //         itemSelct.push(itemList2[x]);
    //     }
    // }
    itemSelct=itemList2
    $(".text-inner-container").css("top","6.047%");
    // if(itemSelct.length==4){
    //     $(".text-inner-container").css("top","19.047%");
    // }else if(itemSelct.length==3){
    //     $(".text-inner-container").css("top","29.047%");
    // }else if(itemSelct.length==2){
    //     $(".text-inner-container").css("top","37.047%");
    // }

}

function drawItem(){
    $(".title span").html(title);
    drawlistArray()
    $(".text-inner-container").html("");
    var html="";
    var selected_true='';
    var selected_false='';
    for(var i=0;i<itemSelct.length;i++){
        if(itemSelct[i].type=="1"){
            selected_true='selected';
            selected_false='';
        }else{
            selected_true='';
            selected_false='selected';
        }
        html+='<div class="text-container" data="'+itemSelct[i].type+'">' +
              '<a class="jq_deletei"></a>' +
              '<div class="number-question"><span>'+(i+1)+'</span></div> ' +
              '<div class="text-bg-container"><p class="jq_editable" contenteditable="true">'+itemSelct[i].word+'</p></div> ' +
              '<div class="trueFalse">' +
              '<a class="true-btn jq_true-btn '+selected_true+'" data="1" onclick="choseCorrect(this)"><span contenteditable="true">'+itemSelct[i].true+'</span></a>' +
              '<a class="false-btn jq_false-btn '+selected_false+'" data="0" onclick="choseCorrect(this)"><span contenteditable="true">'+itemSelct[i].false+'</span></a>' +
              '</div>' +
              '</div>'
    }
    $(".text-inner-container").append(html);
    // shuffleDivs(".text-inner-container");
}
