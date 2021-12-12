
/**
 * Created by osaid zalloum on 13/12/2020.
 */

//#Manhal#data#

var shuffleList1 = [];
var shuffleList2 = [];
var allList = [];
var newList=[];
// if(cloumns.length==4){
//     console.log("cloumns4<<<>>>"+cloumns.length);
// }else if(cloumns.length==3){
//     console.log("cloumns3<<<>>>"+cloumns.length);
// }else if(cloumns.length==2){
//     console.log("cloumns2<<<>>>"+cloumns.length);
// }else if(cloumns.length==1){
//     console.log("cloumns1<<<>>>"+cloumns.length);
// }
function drawItem() {
    shuffleList1 = [];
    shuffleList2 = [];
    allList = [];
    newList=[];
    for(var i=0;i<itemList.length;i++){
        if (itemList[i].text != "") {
            allList.push(itemList[i]);
        }
    }
    //allList = Array.from(itemList);
    for(var x=0;x<allList.length;x++){
       newList.push(allList[x]);
    }
    var wrongList=0;
    for (var i = 0; i < worngList.length; i++) {

        switch (cloumns.length) {
            case 1:
                if(newList.length==5){
                    if(worngList.length>10){
                        wrongList=10;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==4){
                    if(worngList.length>11){
                        wrongList=11;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==3){
                    if(worngList.length>12){
                        wrongList=12;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==2){
                    if(worngList.length>13){
                        wrongList=13;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==1){
                    if(worngList.length>14){
                        wrongList=14;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }
                break;
            case 2:
                if(newList.length==10){
                    if(worngList.length>5){
                        wrongList=5;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==8){
                    if(worngList.length>7){
                        wrongList=7;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==6){
                    if(worngList.length>9){
                        wrongList=9;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==4){
                    if(worngList.length>11){
                        wrongList=11;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==2){
                    if(worngList.length>13){
                        wrongList=13;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }
                break;
            case 3:
                if(newList.length==12){
                    if(worngList.length>3){
                        wrongList=3;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==9){
                    if(worngList.length>6){
                        wrongList=6;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==6){
                    if(worngList.length>9){
                        wrongList=9;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==3){
                    if(worngList.length>12){
                        wrongList=12;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }
                break;
            case 4:
                if(newList.length==16){
                    if(worngList.length>4){
                        wrongList=4;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==12){
                    if(worngList.length>8){
                        wrongList=8;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==8){
                    if(worngList.length>12){
                        wrongList=12;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }else if(newList.length==4){
                    if(worngList.length>16){
                        wrongList=16;
                    }else {
                        wrongList=worngList.length
                    }
                    for(var i=0;i<wrongList;i++){
                        newList.push(worngList[i]);
                    }
                }
                break;
        }


        // if((cloumns.length==2 || cloumns.length==1) && newList.length!=9){
        //     newList.push(worngList[i]);
        // }else if(cloumns.length==3 && newList.length!=15){
        //     newList.push(worngList[i]);
        // }else if(cloumns.length==4 && newList.length!=15){
        //     newList.push(worngList[i]);
        // }
    }
    var html = "";
    var htmlDrop = "";
    var htmlDrop2 = "";
    $(".header-title span").html(title);
    $(".drag-container").html("");
    $(".drop-container").html()
    $(".mark").fadeIn();
    shuffleList1 = randomarray(newList.length);
    for (var i = 0; i < newList.length; i++) {
        shuffleList2.push(newList[shuffleList1[i]])
    }
    for (var i = 0; i < shuffleList2.length; i++) {
        if (shuffleList2[i].type == 0) {
            html += '<div class="drag-item" data="' + shuffleList2[i].type + '" row="'+shuffleList2[i].row+'"><div class="inner-drag-item"><span>'+shuffleList2[i].text+'</span></div></div>'
        } else {
            html += '<div class="drag-item" data="' + shuffleList2[i].type + '" row="'+shuffleList2[i].row+'"><div class="inner-drag-item"><span>'+shuffleList2[i].text+'</span></div></div>'
        }
    }
    $(".drag-container").append(html);
    // $(".drag-item[data='0'] span").attr("contenteditable",'true');
    // shuffleDivs(".drag-container");
    $(".drop-inner-container").html(" ");
    for(i=0;i<cloumns.length;i++){
        $(".title-table-"+(i+1).toString()+" span").html(cloumns[i].title);
        $('<div class="drop-container drop-container-'+(i+1)+'" data="'+(i+1)+'"></div>').appendTo(".drop-inner-container");
    }
    // console.log("sssssssss<<<>>>"+$(".drop-container").length);
    if ($(".drop-container").length == 1) {
        for( i=0;i<itemList.length;i++){
            console.log('add',i);
            htmlDrop='<div class="drop-item drop-'+($(".drop-container-"+itemList[i].type+" .drop-item").length+1)+'"><div class="mark"></div><span class="jq_cell"></span></div>';
            console.log('cell',itemList[i].text);
            $(".drop-container-"+itemList[i].type).append(htmlDrop);
        }
        if($(".drop-container-1").find(".drop-item").length==5){
            $(".drop-main-container").css({'width':'39.3%','height':'50.113%'});
            $(".title-table-container").css("width","96.852%");
            $(".title-table-1").css({'width':'98.22%','margin-left':'0'});
            $(".drop-inner-container").css("height","83.9%");
            $(".drop-container-1").css({'width':'93.112%','height':'99.137%','margin-right':'4.298%','margin-left':'0'});
            $(".drop-item").css({'height':'18.5%','margin-bottom':'1.4%'});
            $(".drag-container").css({'height':'35.28%','bottom':'1.505%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else if($(".drop-container-1").find(".drop-item").length==4){
            $(".drop-main-container").css({'width':'39.3%','height':'47.113%','top':'12.198%'});
            $(".title-table-container").css({"width":"96.852%",'height':'14.637%'});
            $(".title-table-1").css({'width':'98.22%','margin-left':'0'});
            $(".drop-inner-container").css("height","83.9%");
            $(".drop-container-1").css({'width':'93.112%','height':'99.137%','margin-right':'4.298%','margin-left':'0'});
            $(".drop-item").css({'height':'22.3%','margin-bottom':'2.2%'});
            $(".drag-container").css({'height':'35.28%','bottom':'1.505%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else if($(".drop-container-1").find(".drop-item").length==3){
            $(".drop-main-container").css({'width':'39.3%','height':'39.113%','top':'16.198%'});
            $(".title-table-container").css({"width":"96.852%",'height':'18.637%'});
            $(".title-table-1").css({'width':'98.22%','margin-left':'0'});
            $(".drop-inner-container").css({"height":"75.9%",'margin-top':'2%'});
            $(".drop-container-1").css({'width':'93.112%','height':'99.137%','margin-right':'4.298%','margin-left':'0'});
            $(".drop-item").css({'height':'29.77%','margin-bottom':'2.2%'});
            $(".drag-container").css({'height':'35.28%','bottom':'1.505%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else if($(".drop-container-1").find(".drop-item").length==2){
            $(".drop-main-container").css({'width':'39.3%','height':'33.113%','top':'19.198%'});
            $(".title-table-container").css({"width":"96.852%",'height':'22.637%'});
            $(".title-table-1").css({'width':'98.22%','margin-left':'0'});
            $(".drop-inner-container").css({"height":"68.9%",'margin-top':'2%'});
            $(".drop-container-1").css({'width':'93.112%','height':'99.137%','margin-right':'4.298%','margin-left':'0'});
            $(".drop-item").css({'height':'42.77%','margin-bottom':'3.9%'});
            $(".drag-container").css({'height':'35.28%','bottom':'1.505%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else if($(".drop-container-1").find(".drop-item").length==1){
            $(".drop-main-container").css({'width':'39.3%','height':'22.113%','top':'24.198%'});
            $(".title-table-container").css({"width":"96.852%",'height':'37.637%'});
            $(".title-table-1").css({'width':'98.22%','margin-left':'0'});
            $(".drop-inner-container").css({"height":"49.9%",'margin-top':'2%'});
            $(".drop-container-1").css({'width':'93.112%','height':'89.137%','margin-right':'4.298%','margin-left':'0'});
            $(".drop-item").css({'height':'100%','margin-bottom':'3.9%'});
            $(".drag-container").css({'height':'35.28%','bottom':'1.505%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }

    }else if($(".drop-container").length==2){
        for( i=0;i<itemList.length;i++){
            console.log('add',i);
            htmlDrop='<div class="drop-item drop-'+($(".drop-container-"+itemList[i].type+" .drop-item").length+1)+'"><div class="mark"></div><span class="jq_cell"></span></div>';
            console.log('cell',itemList[i].text);
            $(".drop-container-"+itemList[i].type).append(htmlDrop);
        }
        if($(".drop-container-1").find(".drop-item").length==5){
            $(".drop-main-container").css({'width':'75.684%','height':'49.813%'});
            $(".title-table-container").css({'height':'12.251%','margin-top':'0.8%'});
            $(".title-table-1").css({'width':'49.478%','margin-left':'1%'});
            $(".title-table-2").css({'width':'49.478%','margin-left':'0'});
            $(".drop-inner-container").css("height","85.063%");
            $(".drop-container-1").css({'width':'47.342%','height':'95.837%','margin-right':'1.298%','margin-left':'2.984%'});
            $(".drop-container-2").css({'width':'47.342%','height':'95.837%'});
            $(".drop-item").css({'height':'18.77%','margin-bottom':'1.4%'})
            $(".drag-container").css({'height':'35.28%','bottom':'1.505%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else if($(".drop-container-1").find(".drop-item").length==4){
            $(".drop-main-container").css({'width':'75.684%','height':'49.813%'});
            $(".title-table-container").css({'height':'15.251%','margin-top':'0.8%'});
            $(".title-table-1").css({'width':'49.478%','margin-left':'1%'});
            $(".title-table-2").css({'width':'49.478%','margin-left':'0'});
            $(".drop-inner-container").css("height","81.063%");
            $(".drop-container-1").css({'width':'47.342%','height':'95.837%','margin-right':'1.298%','margin-left':'2.984%'});
            $(".drop-container-2").css({'width':'47.342%','height':'95.837%'});
            $(".drop-item").css({'height':'23.37%','margin-bottom':'1.7%'});
            $(".drag-container").css({'height':'35.28%','bottom':'1.505%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else if($(".drop-container-1").find(".drop-item").length==3){
            $(".drop-main-container").css({'width':'75.684%','height':'43.813%','top':'15%'});
            $(".title-table-container").css({'height':'19.251%','margin-top':'0.8%'});
            $(".title-table-1").css({'width':'49.478%','margin-left':'1%'});
            $(".title-table-2").css({'width':'49.478%','margin-left':'0'});
            $(".drop-inner-container").css("height","78.063%");
            $(".drop-container-1").css({'width':'47.342%','height':'95.837%','margin-right':'1.298%','margin-left':'2.984%'});
            $(".drop-container-2").css({'width':'47.342%','height':'95.837%'});
            $(".drop-item").css({'height':'30.37%','margin-bottom':'1.7%'});
            $(".drag-container").css({'height':'35.28%','bottom':'1.505%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else if($(".drop-container-1").find(".drop-item").length==2){
            $(".drop-main-container").css({'width':'75.684%','height':'33.813%','top':'17%'});
            $(".title-table-container").css({'height':'24.251%','margin-top':'0.8%'});
            $(".title-table-1").css({'width':'49.478%','margin-left':'1%'});
            $(".title-table-2").css({'width':'49.478%','margin-left':'0'});
            $(".drop-inner-container").css("height","72.063%");
            $(".drop-container-1").css({'width':'47.342%','height':'95.837%','margin-right':'1.298%','margin-left':'2.984%'});
            $(".drop-container-2").css({'width':'47.342%','height':'95.837%'});
            $(".drop-item").css({'height':'43.37%','margin-bottom':'2.7%'});
            $(".drag-container").css({'height':'35.28%','bottom':'1.505%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else if($(".drop-container-1").find(".drop-item").length==1){
            $(".drop-main-container").css({'width':'75.684%','height':'19.813%','top':'25%'});
            $(".title-table-container").css({'height':'37.251%','margin-top':'0.8%'});
            $(".title-table-1").css({'width':'49.478%','margin-left':'1%'});
            $(".title-table-2").css({'width':'49.478%','margin-left':'0'});
            $(".drop-inner-container").css("height","55.063%");
            $(".drop-container-1").css({'width':'47.342%','height':'80.837%','margin-top':'2.257%','margin-right':'1.298%','margin-left':'2.984%'});
            $(".drop-container-2").css({'width':'47.342%','height':'80.837%','margin-top':'2.257%'});
            $(".drop-item").css({'height':'89.37%','margin-bottom':'2.7%'});
            $(".drag-container").css({'height':'35.28%','bottom':'1.505%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }






    }else if($(".drop-container").length==3){
        for( i=0;i<itemList.length;i++){
            console.log('add',i);
            htmlDrop='<div class="drop-item drop-'+($(".drop-container-"+itemList[i].type+" .drop-item").length+1)+'"><div class="mark"></div><span class="jq_cell"></span></div>';
            console.log('cell',itemList[i].text);
            $(".drop-container-"+itemList[i].type).append(htmlDrop);
        }
        if($(".drop-container-1").find(".drop-item").length==5){
            $(".drop-main-container").css({'width':'96.7%','height':'48.6%'});
            $(".title-table-container").css({'height':'12.251%','margin-top':'0.8%'});
            $(".title-table-1").css({'width':'32.66%','margin-left':'1%'});
            $(".title-table-2").css({'width':'32.66%','margin-left':'1%'});
            $(".title-table-3").css({'width':'32.66%','margin-left':'0'});
            $(".drop-inner-container").css("height","84.063%");
            $(".drop-container-1").css({'width':'31.13%','min-height':'97%','height':'97%','margin-right':'1.298%','margin-left':'2.084%','margin-top':'0.857%'});
            $(".drop-container-2").css({'width':'31.13%','min-height':'97%','height':'97%','margin-left':'2.084%','margin-top':'0.857%'});
            $(".drop-container-3").css({'width':'31.13%','min-height':'97%','height':'97%','margin-left':'0','margin-top':'0.857%'});
            $(".drop-item").css({'height':'17.7%','margin-bottom':'2.7%'});
            $(".drag-container").css({'height':'35.28%','bottom':'3.205%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else  if($(".drop-container-1").find(".drop-item").length==4){
            $(".drop-main-container").css({'width':'96.7%','height':'48.6%'});
            $(".title-table-container").css({'height':'15.251%','margin-top':'0.8%'});
            $(".title-table-1").css({'width':'32.66%','margin-left':'1%'});
            $(".title-table-2").css({'width':'32.66%','margin-left':'1%'});
            $(".title-table-3").css({'width':'32.66%','margin-left':'0'});
            $(".drop-inner-container").css("height","82.063%");
            $(".drop-container-1").css({'width':'31.13%','min-height':'97%','height':'97%','margin-right':'1.298%','margin-left':'2.084%','margin-top':'0.857%'});
            $(".drop-container-2").css({'width':'31.13%','min-height':'97%','height':'97%','margin-left':'2.084%','margin-top':'0.857%'});
            $(".drop-container-3").css({'width':'31.13%','min-height':'97%','height':'97%','margin-left':'0','margin-top':'0.857%'});
            $(".drop-item").css({'height':'22.5%','margin-bottom':'2.7%'});
            $(".drag-container").css({'height':'35.28%','bottom':'3.205%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else  if($(".drop-container-1").find(".drop-item").length==3){
            $(".drop-main-container").css({'width':'96.7%','height':'44.6%'});
            $(".title-table-container").css({'height':'16.251%','margin-top':'0.8%'});
            $(".title-table-1").css({'width':'32.66%','margin-left':'1%'});
            $(".title-table-2").css({'width':'32.66%','margin-left':'1%'});
            $(".title-table-3").css({'width':'32.66%','margin-left':'0'});
            $(".drop-inner-container").css("height","81.063%");
            $(".drop-container-1").css({'width':'31.13%','min-height':'97%','height':'97%','margin-right':'1.298%','margin-left':'2.084%','margin-top':'0.857%'});
            $(".drop-container-2").css({'width':'31.13%','min-height':'97%','height':'97%','margin-left':'2.084%','margin-top':'0.857%'});
            $(".drop-container-3").css({'width':'31.13%','min-height':'97%','height':'97%','margin-left':'0','margin-top':'0.857%'});
            $(".drop-item").css({'height':'29.5%','margin-bottom':'2.7%'});
            $(".drag-container").css({'height':'35.28%','bottom':'3.205%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else  if($(".drop-container-1").find(".drop-item").length==2){
            $(".drop-main-container").css({'width':'96.7%','height':'32.6%','top': '19%'});
            $(".title-table-container").css({'height':'23.251%','margin-top':'0.8%'});
            $(".title-table-1").css({'width':'32.66%','margin-left':'1%'});
            $(".title-table-2").css({'width':'32.66%','margin-left':'1%'});
            $(".title-table-3").css({'width':'32.66%','margin-left':'0'});
            $(".drop-inner-container").css("height","72.063%");
            $(".drop-container-1").css({'width':'31.13%','min-height':'97%','height':'97%','margin-right':'1.298%','margin-left':'2.084%','margin-top':'0.857%'});
            $(".drop-container-2").css({'width':'31.13%','min-height':'97%','height':'97%','margin-left':'2.084%','margin-top':'0.857%'});
            $(".drop-container-3").css({'width':'31.13%','min-height':'97%','height':'97%','margin-left':'0','margin-top':'0.857%'});
            $(".drop-item").css({'height':'43.5%','margin-bottom':'2.7%'});
            $(".drag-container").css({'height':'35.28%','bottom':'6.205%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else  if($(".drop-container-1").find(".drop-item").length==1){
            $(".drop-main-container").css({'width':'96.7%','height':'21.6%','top': '22%'});
            $(".title-table-container").css({'height':'39.251%','margin-top':'0.8%'});
            $(".title-table-1").css({'width':'32.66%','margin-left':'1%'});
            $(".title-table-2").css({'width':'32.66%','margin-left':'1%'});
            $(".title-table-3").css({'width':'32.66%','margin-left':'0'});
            $(".drop-inner-container").css("height","54.063%");
            $(".drop-container-1").css({'width':'31.13%','min-height':'97%','height':'97%','margin-right':'1.298%','margin-left':'2.084%','margin-top':'0.857%'});
            $(".drop-container-2").css({'width':'31.13%','min-height':'97%','height':'97%','margin-left':'2.084%','margin-top':'0.857%'});
            $(".drop-container-3").css({'width':'31.13%','min-height':'97%','height':'97%','margin-left':'0','margin-top':'0.857%'});
            $(".drop-item").css({'height':'81.5%','margin-bottom':'2.7%'});
            $(".drag-container").css({'height':'35.28%','bottom':'10.205%'});
            $(".drag-item").css({'height':'28.44%','margin-right':'0.9%','margin-bottom':'1.1%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }

        // $('.drag-item:last-child').css({'margin-right':'0','margin-bottom':'0'});
    }else if($(".drop-container").length==4){
        for( i=0;i< itemList.length;i++){
            console.log('add',i);
            htmlDrop='<div class="drop-item drop-'+($(".drop-container-"+itemList[i].type+" .drop-item").length+1)+'"><div class="mark"></div><span class="jq_cell"></span></div>';
            console.log('cell',itemList[i].text);
            $(".drop-container-"+itemList[i].type).append(htmlDrop);
        }
        if($(".drop-container-1").find(".drop-item").length==5){
            $(".drop-main-container").css({'height':'54.7%','width':'96.7%'});
            $(".title-table-container").css({'height':'11.537%','margin-top':'1.1%'});
            $(".title-table-1").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-2").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-3").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-4").css({'width':'24.2%','margin-left':'0'});
            $(".drop-inner-container").css({'height': '84.7%'});
            $(".drop-container-1").css({'width':'24.2%','height':'96.737%','margin-right':'0.798%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-2").css({'width':'24.2%','height':'96.737%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-3").css({'width':'24.2%','height':'96.737%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-4").css({'width':'24.2%','height':'96.737%','margin-left':'0','margin-top':'1.257%'});
            $(".drop-item").css({'height':'18.3%','margin-bottom':'2.7%'});
            $(".drag-container").css({'height':'33.58%','bottom':'0'});
            $(".drag-item").css({'height':'21.8%'});
            $('.drag-item:nth-child(5)').css({'margin-right':'0'});
            $('.drag-item:nth-child(10)').css({'margin-right':'0'});
            $('.drag-item:nth-child(15)').css({'margin-right':'0'});
            $('.drag-item:nth-child(20)').css({'margin-right':'0'});
        }else  if($(".drop-container-1").find(".drop-item").length==4){
            $(".drop-main-container").css({'height':'50.7%','width':'96.7%'});
            $(".title-table-container").css({'height':'14.537%','margin-top':'1.1%'});
            $(".title-table-1").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-2").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-3").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-4").css({'width':'24.2%','margin-left':'0'});
            $(".drop-inner-container").css({'height': '80.7%'});
            $(".drop-container-1").css({'width':'24.2%','height':'96.737%','margin-right':'0.798%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-2").css({'width':'24.2%','height':'96.737%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-3").css({'width':'24.2%','height':'96.737%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-4").css({'width':'24.2%','height':'96.737%','margin-left':'0','margin-top':'1.257%'});
            $(".drop-item").css({'height':'23%','margin-bottom':'2.7%'});
            $(".drag-container").css({'height':'33.58%','bottom':'2%'});
            $(".drag-item").css({'height':'21.8%'});

        }else  if($(".drop-container-1").find(".drop-item").length==3){
            $(".drop-main-container").css({'height':'41.5%','width':'96.7%','top':'14.198%'});
            $(".title-table-container").css({'height':'18.9%','margin-top':'1.1%'});
            $(".title-table-1").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-2").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-3").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-4").css({'width':'24.2%','margin-left':'0'});
            $(".drop-inner-container").css({'height': '77%'});
            $(".drop-container-1").css({'width':'24.2%','height':'95.237%','margin-right':'0.798%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-2").css({'width':'24.2%','height':'95.237%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-3").css({'width':'24.2%','height':'95.237%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-4").css({'width':'24.2%','height':'95.237%','margin-left':'0','margin-top':'1.257%'});
            $(".drop-item").css({'height':'30.5%','margin-bottom':'2.7%'});
            $(".drag-container").css({'height':'33.58%','bottom':'2%'});
            $(".drag-item").css({'height':'21.8%'});
        }else  if($(".drop-container-1").find(".drop-item").length==2){
            $(".drop-main-container").css({'height':'31.5%','width':'96.7%','top':'16.198%'});
            $(".title-table-container").css({'height':'25%','margin-top':'1.1%'});
            $(".title-table-1").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-2").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-3").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-4").css({'width':'24.2%','margin-left':'0'});
            $(".drop-inner-container").css({'height': '67%'});
            $(".drop-container-1").css({'width':'24.2%','height':'95.237%','margin-right':'0.798%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-2").css({'width':'24.2%','height':'95.237%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-3").css({'width':'24.2%','height':'95.237%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-4").css({'width':'24.2%','height':'95.237%','margin-left':'0','margin-top':'1.257%'});
            $(".drop-item").css({'height':'46.3%','margin-bottom':'2.7%'});
            $(".drag-container").css({'height':'33.58%','bottom':'2%'});
            $(".drag-item").css({'height':'21.8%'});
        }else  if($(".drop-container-1").find(".drop-item").length==1){
            $(".drop-main-container").css({'height':'23.5%','width':'96.7%','top':'18.198%'});
            $(".title-table-container").css({'height':'36%','margin-top':'1.1%'});
            $(".title-table-1").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-2").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-3").css({'width':'24.2%','margin-left':'1%'});
            $(".title-table-4").css({'width':'24.2%','margin-left':'0'});
            $(".drop-inner-container").css({'height': '56%'});
            $(".drop-container-1").css({'width':'24.2%','height':'88.237%','margin-right':'0.798%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-2").css({'width':'24.2%','height':'88.237%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-3").css({'width':'24.2%','height':'88.237%','margin-left':'0.6%','margin-top':'1.257%'});
            $(".drop-container-4").css({'width':'24.2%','height':'88.237%','margin-left':'0','margin-top':'1.257%'});
            $(".drop-item").css({'height':'79.3%','margin-bottom':'2.7%'});
            $(".drag-container").css({'height':'33.58%','bottom':'2%'});
            $(".drag-item").css({'height':'21.8%'});
        }

        $('.drag-item:nth-child(5)').css({'margin-right':'0'});
        $('.drag-item:nth-child(10)').css({'margin-right':'0'});
        $('.drag-item:nth-child(15)').css({'margin-right':'0'});
        $('.drag-item:nth-child(20)').css({'margin-right':'0'});

        $('.drag-item:nth-child(6)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(7)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(8)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(9)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(10)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(11)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(12)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(13)').css({'margin-bottom':'0.7%'});


        // drag();




        // $('.drag-item:nth-child(6)').css({'margin-bottom':'0.7%'});
        // $('.drag-item:nth-child(7)').css({'margin-bottom':'0.7%'});
        // $('.drag-item:nth-child(8)').css({'margin-bottom':'0.7%'});
        // $('.drag-item:nth-child(9)').css({'margin-bottom':'0.7%'});
        // $('.drag-item:nth-child(10)').css({'margin-bottom':'0.7%','margin-right':'0'});
        // $('.drag-item:nth-child(11)').css({'margin-right':'0.9%','margin-bottom':'0'});
        // $('.drag-item:nth-child(12)').css({'margin-right':'0.9%','margin-bottom':'0'});
        // $('.drag-item:nth-child(13)').css({'margin-right':'0.9%','margin-bottom':'0'});
        // $('.drag-item:nth-child(14)').css({'margin-right':'0.9%','margin-bottom':'0'});
        // $('.drag-item:nth-child(15)').css({'margin-right':'0.9%','margin-bottom':'0'});
        // $('.drag-item:last-child').css({'margin-right':'0','margin-bottom':'0'});
    }
    // setTimeout(function () {
        drag();
    //
    //     $(".drop-item").droppable("enable");
    //     console.log('item length=', itemList.length);
    // }, 200);
    // var containerHeight=0;
    // var innerContainerHeight=0;
    // var dropHeight=0;
    // dropHeight=(parseInt($(".drop-item").height())+parseInt($(".drop-item").css("margin-bottom")))*$(".drop-container:first-child .drop-item").length;
    // $(".drop-container").css("height",dropHeight+"px");
    // $(".drop-item").css("height",(dropHeight/$(".drop-container:first-child .drop-item").length)-parseInt($(".drop-item").css("margin-bottom")) +"px")
    // innerContainerHeight= dropHeight + parseInt($(".drop-container").css("margin-top"));
    // $(".drop-inner-container").css("height",innerContainerHeight + "px");
    // containerHeight=parseInt($(".title-table-container").height())+parseInt($(".title-table-container").css("margin-top"))+ innerContainerHeight;
    // $(".drop-main-container").css("height",containerHeight +"px");
    // $(".title-table-container").css("height",containerHeight-innerContainerHeight-parseInt($(".title-table-container").css("margin-top")) +"px")
}

