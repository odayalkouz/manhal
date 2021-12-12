/**
 * Created by Work on 6/08/2015.
 */
var timerARR=[];
var timeOut1=0;
var myVar233=0;
timerPause=true;
endGame=false;
pandTimerFirst=true;
function buildTimer(){
    if($('.obj9')){
        $('.obj9').remove();
    }
    str='<div class="obj9">'+
    //'<div class="timer-clock flaticon-timer"></div>'+
     '<span class="timer-clock floating-left"></span>'+
    '<div class="timer-clock-container"><span id="timerCount" class="floating-left"></span></div>'+
    '<div id="timer">'+
    ' <div class="bar">'+
    ' <div id="bar"></div>'+
    ' </div>'+
    ' </div>'+
    '</div>';
    $(str).appendTo(".timer-container");
    //if(pandTimerFirst)  {pandTimer();pandTimerFirst=false}
}



function timerStart(timeObj,ShowCounter) {
    clearOldTimer()
    var sec =60  ; // start sec
    buildTimer();
    timerPause=true;
    clearInterval(myVar233);
    if((timeObj.sec=="undefined") || (timeObj.sec == 0))
    {   sec=60
        timeObj.sec=0;}
    else{
        sec=timeObj.sec

    }

    StartTimerGame(timeObj)
    timerShowTime();
    function timerShowTime() {
        var date = new Date();

        if(timeObj.sec != 0) {var min = timeObj.min;}else{min = timeObj.min-1}
        // var min = 0;
        myVar233 = setInterval(function () {
            if(timerPause){
                sec--;
                if (min <= 0 && sec == 15) {
                    // $("#timerCount").effect("pulsate", {times: 20}, 15000);
                }
                if (min <= 0 && sec == 0) {

                    ///////////////////////////time finish
                    //TimeOutEnd();
                    if(ShowCounter){
                        document.getElementById("timerCount").innerHTML = "00:00";
                    }

                    clearInterval(myVar233);
                }
                else {
                    if (sec == 0) {
                        sec = 59;
                        min--;
                    }
                }
                time = (min < 10 ? "0" + min : min) + ":" + (sec < 10 ? "0" + sec : sec);
                if(ShowCounter){
                    document.getElementById("timerCount").innerHTML = time;
                }

            }
        }, 1000);
        /**
         * Created by ECCS on 10/07/2015.
         */
    }



}

function zxcAnimate(mde,obj,srt){
    this.to=null;
    this.obj=typeof(obj)=='object'?obj:document.getElementById(obj);
    this.mde=mde.replace(/\W/g,'');
    this.data=[srt||0];
    return this;
}

zxcAnimate.prototype.animate=function(srt,fin,ms,scale,c){
    clearTimeout(this.to);
    this.time=ms||this.time||0;
    this.neg=srt<0||fin<0;
    this.data=[srt,srt,fin];
    this.mS=this.time*(!scale?1:Math.abs((fin-srt)/(scale[1]-scale[0])));
    this.c=typeof(c)=='string'?c.charAt(0).toLowerCase():this.c?this.c:'';
    this.inc=Math.PI/(2*this.mS);
    this.srttime=new Date().getTime();
    this.cng();
}

zxcAnimate.prototype.cng=function(){
    var oop=this,ms=new Date().getTime()-this.srttime;
    this.data[0]=(this.c=='s')?(this.data[2]-this.data[1])*Math.sin(this.inc*ms)+this.data[1]:(this.c=='c')?this.data[2]-(this.data[2]-this.data[1])*Math.cos(this.inc*ms):(this.data[2]-this.data[1])/this.mS*ms+this.data[1];
    this.apply();
    if (ms<this.mS) this.to=setTimeout(function(){oop.cng()},10);
    else {
        this.data[0]=this.data[2];
        this.apply();
        if (this.Complete) this.Complete(this);
    }
}

zxcAnimate.prototype.apply=function(){
    if (isFinite(this.data[0])){
        if (this.data[0]<0&&!this.neg) this.data[0]=0;
        if (this.mde!='opacity') this.obj.style[this.mde]=Math.floor(this.data[0])+'px';
        else zxcOpacity(this.obj,this.data[0]);
    }
}

function zxcOpacity(obj,opc){
    if (opc<0||opc>100) return;
    obj.style.filter='alpha(opacity='+opc+')';
    obj.style.opacity=obj.style.MozOpacity=obj.style.WebkitOpacity=obj.style.KhtmlOpacity=opc/100-.001;
}


function Bar(o){
    var obj=document.getElementById(o.ID);
    this.oop=new zxcAnimate('width',obj,0);
    this.max=obj.parentNode.offsetWidth;
    this.to=null;
}
arr=[]
pu=false
Bar.prototype={
    remaining:0,
    allTime:0,
    Start:function(sec){
        this.allTime=sec
        clearTimeout(this.to);
        this.oop.animate(0,this.max,sec*1000);
        pu=this.max
        console.log(pu)
        this.srt=new Date();
        this.sec=sec;
        this.Time();
    },

    Time:function(sec){
        var oop=this,sec=this.sec-Math.floor((new Date()-this.srt)/1000);
      //  this.oop.obj.innerHTML=sec+' seconds';
        this.remaining=sec

        if (sec>0){

            this.to=setTimeout(function(){ oop.Time(); },1000);
            arr.push(this.to)
        }
        else{


                TimeOut()


        }

    }
    ,
    pause:function(){
        clearTimeout(this.to);
        value=parseInt(document.getElementById('bar').style.width)
        this.oop.animate(value,value,1);
    }

    ,
    playAgain:function(sec){
        clearTimeout(this.to);
        value=parseInt(document.getElementById('bar').style.width)
        this.oop.animate(value,this.max,this.remaining*1000);
        pu=this.max
        console.log(pu)
        this.srt=new Date();
        this.sec=this.remaining;
        this.Time();

    }
}

var B1=""


function StartTimerGame(x){
    checkMouseOver()
    buildTimer()
     B1=new Bar({
        ID:'bar'
    });
    s_time_one =  ((x.min)*60)+((x.sec*1));
    B1.Start(s_time_one);
}


function helpMSG(){

    timerPause=false
    puaseTimer();
    endGame=true

    //swal({   title: "لقد استخدمت كل الفرص",   text: "",
    //        showCancelButton: false,   confirmButtonColor: "#DD6B55",
    //        confirmButtonText: "جرّب مرّة أخرى",
    //        cancelButtonText: "لا",
    //        imageUrl: "images/s1.png",
    //        closeOnConfirm: true },
    //    function(isConfirm){
    //        location.reload()
    //    });



}
function newtimequize(){


}
function TimeOut(){
    timerPause=false;
    puaseTimer();
    endGame=true;
    callfunctionCorrection();
    $(".message-main-container-timeOut").fadeIn();
}


function puaseTimer(){

    B1.pause();
}

function playTimer(){
    B1.playAgain()
}




function checkMouseOver(){
    //$(document).mouseenter(function(){
    //
    //
    //    if(!endGame){
    //        timerPause=true
    //        playTimer();
    //     //   resumeAll();
    //
    //        }
    //    clearTimeout($(this).data('timeoutId'));
    //    if($("#GameSection").is(':visible')){
    //    }
    //
    //}).mouseleave(function(){
    //
    //    var someElement = $(this),
    //        timeoutId = setTimeout(function(){
    //            timerPause=false
    //            puaseTimer();
    //
    //
    //        }, 1);
    //    //set the timeoutId, allowing us to clear this trigger if the mouse comes back over
    //    someElement.data('timeoutId', 1);
    //});
}




function clearOldTimer(){
    for (var i = 1; i < arr.length; i++) {
        clearTimeout(arr[i])

    }

}