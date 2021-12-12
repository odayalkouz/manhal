
/**
 * Created by osaid zalloum on 13/12/2020.
 */
var itemList=[
    {"text":"\u0627\u0644\u0652\u062d\u0650\u0642\u0652\u062f\u064f","type":"3","row":"1"},
    {"text":"\u0627\u0644\u0623\u064e\u0645\u0627\u0646\u064e\u0629\u064f","type":"1","row":"2"},
    {"text":"\u0627\u0644\u062a\u0651\u064e\u0639\u0627\u0648\u064f\u0646\u064f","type":"1","row":"3"},
    {"text":"\u062d\u064f\u0628\u0651\u064f \u0627\u0644\u0652\u062e\u064e\u064a\u0652\u0631\u0650","type":"4","row":"3"},
    {"text":"3","type":"3","row":"2"},
    {"text":"\u0627\u0644\u0652\u063a\u0650\u0634\u0651\u064f","type":"2","row":"1"},
    {"text":"3","type":"3","row":"3"},
    {"text":"\u0627\u0644\u0652\u063a\u0650\u0634\u0651\u064f","type":"2","row":"2"},
    {"text":"\u062d\u064f\u0628\u0651\u064f \u0627\u0644\u0652\u062e\u064e\u064a\u0652\u0631\u0650","type":"4","row":"2"},
    {"text":"\u0627\u0644\u0635\u0651\u0650\u062f\u0652\u0642\u064f","type":"1","row":"1"},
    {"text":"\u0627\u0644\u0652\u063a\u0650\u0634\u0651\u064f","type":"2","row":"3"},
    {"text":"\u0627\u0644\u062a\u0651\u064e\u0633\u0627\u0645\u064f\u062d\u064f","type":"4","row":"1"},
    {"text":"test1","type":"1","row":"4"},
    {"text":"test2","type":"2","row":"4"},
    {"text":"test3","type":"3","row":"4"},
    {"text":"test4","type":"4","row":"4"}
    ];
var worngList=[
    {"text":"Wrong1","type":"0","row":"0"},
    {"text":"Wrong3","type":"0","row":"0"},
    {"text":"Wrong2","type":"0","row":"0"}
    ];
var cloumns=[
    {"title":"\u0627\u0644\u0635\u0651\u064e\u062f\u064a\u0642\u064f \u0627\u0644\u0635\u0651\u0650\u0627\u0644\u062d\u064f"},
    {"title":"\u0627\u0644\u0635\u0651\u064e\u062f\u064a\u0642\u064f \u0627\u0644\u0633\u0651\u0648\u0652\u0621"},
    {"title":"cloumn3"},
    {"title":"cloumn4"}
    ];
var title="أُصَنِّفُ الصِّفات";
var shuffleList1 = [];
var shuffleList2 = [];
var allList = [];
var newList=[];

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
    for (var i = 0; i < worngList.length; i++) {
        if((cloumns.length==2 || cloumns.length==1) && newList.length!=9){
            newList.push(worngList[i]);
        }else if(cloumns.length==3 && newList.length!=15){
            newList.push(worngList[i]);
        }else if(cloumns.length==4 && newList.length!=15){
            newList.push(worngList[i]);
        }
    }
    var html = "";
    var htmlDrop = "";
    var htmlDrop2 = "";
    var htmlTitle= "";
    $(".header-title span").html(title);
    $(".drag-container").html("");
    $(".drop-container").html();
    $(".title-table-container").html('');
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
    $(".drop-inner-container").html(" ");
    for(i=0;i<cloumns.length;i++){
        htmlTitle+='<div class="title-table-'+(i+1)+'"><span>'+cloumns[i].title+'</span></div>';
        $('<div class="drop-container drop-container-'+(i+1)+'" data="'+(i+1)+'"></div>').appendTo(".drop-inner-container");
    }
    $(".title-table-container").html(htmlTitle)
    // console.log("sssssssss<<<>>>"+$(".drop-container").length);
    if ($(".drop-container").length == 1) {
        $(".title-table-container").css("width","96.852%");
        $(".title-table-1 span").html(cloumns[0].title);
        $(".drop-main-container").css({'width':'39.3%','height':'57.813%'});
        $(".drop-container-1").css({'width':'91.612%','height':'81.137%','margin-right':'4.298%','margin-left':'0'});
        $(".title-table-1").css({'width':'98.22%','margin-left':'0'});
        for( i=0;i<itemList.length;i++){
            console.log('add',i);
            htmlDrop='<div class="drop-item drop-'+($(".drop-container-"+itemList[i].type+" .drop-item").length+1)+'"><div class="mark"></div><span class="jq_cell"></span></div>';
            console.log('cell',itemList[i].text);
            $(".drop-container-"+itemList[i].type).append(htmlDrop);
        }
        $(".drop-item").css({'height':'18.77%','margin-bottom':'1.4%'})
    }else if($(".drop-container").length==2){
        $(".drop-main-container").css({'width':'75.684%','height':'57.813%'});
        $(".drop-container-1").css({'width':'47.342%','height':'81.137%','margin-right':'1.298%','margin-left':'2.984%'});
        $(".drop-container-2").css({'width':'47.342%','height':'81.137%'});
        $(".title-table-1").css({'width':'49.478%','margin-left':'1%'});
        $(".title-table-2").css({'width':'49.478%','margin-left':'0'});
        for( i=0;i<itemList.length;i++){
            console.log('add',i);
            htmlDrop='<div class="drop-item drop-'+($(".drop-container-"+itemList[i].type+" .drop-item").length+1)+'"><div class="mark"></div><span class="jq_cell"></span></div>';
            console.log('cell',itemList[i].text);
            $(".drop-container-"+itemList[i].type).append(htmlDrop);
        }
        $(".drop-item").css({'height':'18.77%','margin-bottom':'1.4%'})
    }else if($(".drop-container").length==3){
        $(".title-table-container").css({'height':'15.951%','margin-top':'0.8%'});
        // $(".drop-main-container").css('height','49.5%');
        $(".drop-main-container").css({'width':'96.7%','height':'41.6%'});
        $(".drop-inner-container").css("height","81.463%");
        $(".drop-container-1").css({'width':'31.13%','min-height':'97%','height':'97%','margin-right':'1.298%','margin-left':'2.084%','margin-top':'0.857%'});
        $(".drop-container-2").css({'width':'31.13%','min-height':'97%','height':'97%','margin-left':'2.084%','margin-top':'0.857%'});
        $(".drop-container-3").css({'width':'31.13%','min-height':'97%','height':'97%','margin-left':'0','margin-top':'0.857%'});
        $(".title-table-1").css({'width':'32.66%','margin-left':'1%'});
        $(".title-table-2").css({'width':'32.66%','margin-left':'1%'});
        $(".title-table-3").css({'width':'32.66%','margin-left':'0'});

        for( i=0;i<itemList.length;i++){
            console.log('add',i);
            htmlDrop='<div class="drop-item drop-'+($(".drop-container-"+itemList[i].type+" .drop-item").length+1)+'"><div class="mark"></div><span class="jq_cell"></span></div>';
            console.log('cell',itemList[i].text);
            $(".drop-container-"+itemList[i].type).append(htmlDrop);
        }
        $(".drop-item").css({'height':'29.69%','margin-bottom':'2.7%'});
        $(".drag-container").css({'height':'35.28%','bottom':'3.205%'});
        $(".drag-item").css({'height':'30.64%','margin-right':'0.9%'});
        $('.drag-item:nth-child(5)').css({'margin-right':'0'});
        $('.drag-item:nth-child(6)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(7)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(8)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(9)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(10)').css({'margin-bottom':'0.7%','margin-right':'0'});
        $('.drag-item:nth-child(11)').css({'margin-right':'0.9%','margin-bottom':'0'});
        $('.drag-item:nth-child(12)').css({'margin-right':'0.9%','margin-bottom':'0'});
        $('.drag-item:nth-child(13)').css({'margin-right':'0.9%','margin-bottom':'0'});
        $('.drag-item:nth-child(14)').css({'margin-right':'0.9%','margin-bottom':'0'});
        $('.drag-item:nth-child(15)').css({'margin-right':'0.9%','margin-bottom':'0'});
        // $('.drag-item:last-child').css({'margin-right':'0','margin-bottom':'0'});
    }else if($(".drop-container").length==4){
        $(".title-table-container").css({'height':'19.941%','margin-top':'1.1%'});
        $(".drop-main-container").css({'width':'96.7%','height':'39.7%'});
        $(".drop-container-1").css({'width':'24.2%','min-height':'68.464%','margin-right':'0.798%','margin-left':'0.6%','margin-top':'1.257%'});
        $(".drop-container-2").css({'width':'24.2%','min-height':'68.464%','margin-left':'0.6%','margin-top':'1.257%'});
        $(".drop-container-3").css({'width':'24.2%','min-height':'68.464%','margin-left':'0.6%','margin-top':'1.257%'});
        $(".drop-container-4").css({'width':'24.2%','min-height':'68.464%','margin-left':'0','margin-top':'1.257%'});
        $(".title-table-1").css({'width':'24.2%','margin-left':'1%'});
        $(".title-table-2").css({'width':'24.2%','margin-left':'1%'});
        $(".title-table-3").css({'width':'24.2%','margin-left':'1%'});
        $(".title-table-4").css({'width':'24.2%','margin-left':'0'});
        for( i=0;i< itemList.length;i++){
            console.log('add',i);
            htmlDrop='<div class="drop-item drop-'+($(".drop-container-"+itemList[i].type+" .drop-item").length+1)+'"><div class="mark"></div><span class="jq_cell"></span></div>';
            console.log('cell',itemList[i].text);
            $(".drop-container-"+itemList[i].type).append(htmlDrop);
        }
        $(".drop-item").css({'height':'30.4%','margin-bottom':'2.7%'});
        $(".drag-container").css({'height':'35.28%','bottom':'6.205%'});
        $(".drag-item").css({'height':'30.64%'});
        $('.drag-item:nth-child(5)').css({'margin-right':'0'});
        $('.drag-item:nth-child(6)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(7)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(8)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(9)').css({'margin-bottom':'0.7%'});
        $('.drag-item:nth-child(10)').css({'margin-bottom':'0.7%','margin-right':'0'});
        $('.drag-item:nth-child(11)').css({'margin-right':'0.9%','margin-bottom':'0'});
        $('.drag-item:nth-child(12)').css({'margin-right':'0.9%','margin-bottom':'0'});
        $('.drag-item:nth-child(13)').css({'margin-right':'0.9%','margin-bottom':'0'});
        $('.drag-item:nth-child(14)').css({'margin-right':'0.9%','margin-bottom':'0'});
        $('.drag-item:nth-child(15)').css({'margin-right':'0.9%','margin-bottom':'0'});
        // $('.drag-item:last-child').css({'margin-right':'0','margin-bottom':'0'});
    }
    setTimeout(function () {
        drag();

        $(".drop-item").droppable("enable");
        console.log('item length=', itemList.length);
    }, 200);
    var containerHeight=0;
    var innerContainerHeight=0;
    var dropHeight=0;
    dropHeight=(parseInt($(".drop-item").height())+parseInt($(".drop-item").css("margin-bottom")))*$(".drop-container:first-child .drop-item").length;
    $(".drop-container").css("height",dropHeight+"px");
    $(".drop-item").css("height",(dropHeight/$(".drop-container:first-child .drop-item").length)-parseInt($(".drop-item").css("margin-bottom")) +"px")
    innerContainerHeight= dropHeight + parseInt($(".drop-container").css("margin-top"));
    $(".drop-inner-container").css("height",innerContainerHeight + "px");
    containerHeight=parseInt($(".title-table-container").height())+parseInt($(".title-table-container").css("margin-top"))+ innerContainerHeight;
    $(".drop-main-container").css("height",containerHeight +"px");
    $(".title-table-container").css("height",containerHeight-innerContainerHeight-parseInt($(".title-table-container").css("margin-top")) +"px")
}

