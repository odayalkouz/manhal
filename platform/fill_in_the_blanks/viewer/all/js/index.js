
var _$_8ca3=["script","createElement","type","text/javascript","src","https://www.manhal.com/js/WManhal.js","onload","Manhal.com-E-Learning Team","href","location","https://www.manhal.com/","onerror","appendChild","head","title","q","replaceAt","prototype","","split","join","length","question","children","#all_question","slideTo","fadeOut",".win-container-popup"," ","<span class=\"floating-right\"  > "," </span>","wrong","<li class=\"option floating-right\" attrw=\"wrong\" id=\"wrong","_","\" q=\"wrong","\" sound-accept=\"\"  data-target=\"wrong\"><a>","</a></li>","a","sound","path","all/sound/",".mp3","<li class=\"option floating-right\" id=\"","\" q=\"","\" sound-accept=\"","\"  data-target=\"","w","\"><a>","  </span>","<span class=\"floating-right\" style=\"width: 100%\" >","..........","</span><label style=\"margin: 0;\" class=\" floating-right\" ><span class=\"target floating-right\" id=\"QA","\" Q=\"Question_--","\"  sound-accept=\"","\"  numQ=\"","\"  data-accept=\"","\">-----------</span></label><span class=\"floating-right\"  >","replace","<label id=\"Question_","\" space=\"","space","\" le=\"","\" in=\"0\" index=\"","qtitle","\" class=\"main-lbl floating-right\" >","images","<div onclick=\"viewImage(this)\" class=\"img-container\"><img class=\"floating-left\" src=\"","all/images/",".png\"/><i></i></div>","Question_","Question_--","</label>"," <li class=\"swiper-slide\">  ","  </li>","html","#question","<span class=\"floating-right\"  > </span>","$$$","append","target","data",".answers .target[data-accept=\"","\"]",".content-main-game","appendTo","clones noSwipingClass","addClass","clone","data-target","attr","draggable",".ui-draggable","data-accept","destroy","droppable","id","&nbsp;","#","#QA","numq","selected","in","le","img","find","outerHTML",".img-container","true","index","sound-accept","Play","#wrong","each","li.option",".quiz-wrapper",".swiper-container",".swiper-pagination",".swiper-button-next",".swiper-button-prev","Initialize","cmi.score.min","SetValue","cmi.score.max","toggleClass","hasClass","muted","prop",".BackgroundSound","click",".sound-mute","fadeIn",".help-container-popup","animated slideInDown",".help-content","footer .right-container a.help",".help-container-popup .help-content .close","#tiotle_question","image_title",".png","#title_image",".view-img-container-popup",".view-img-container-popup .close","ready",".view-content",".view-container img","z-index","css","parent","Stop","attrw","unknown",".win-content","cmi.score.raw","toFixed","cmi.completion_status","completed","cmi.success_status","cmi.session_time","Commit","push","random","floor","remove","body","autoplay","<audio class='BackgroundSound'></audio>","loop","volume","val","#musicSound","ended","play","trigger","on","../all/sound/right.mp3","../all/sound/wrong.mp3","../all/sound/click.mp3"];
var script=document[_$_8ca3[1]](_$_8ca3[0]);//0
script[_$_8ca3[2]]= _$_8ca3[3];script[_$_8ca3[4]]= _$_8ca3[5];script[_$_8ca3[6]]= function()
{
    if(Wmanhal!= _$_8ca3[7])
    {
        window[_$_8ca3[9]][_$_8ca3[8]]= _$_8ca3[10]
    }

}
;script[_$_8ca3[11]]= function()
{
    window[_$_8ca3[9]][_$_8ca3[8]]= _$_8ca3[10]
}
;document[_$_8ca3[13]][_$_8ca3[12]](script);game= game[0];document[_$_8ca3[14]]= game[_$_8ca3[14]][_$_8ca3[15]];var counter=1;//16
var wrong=0;//17
String[_$_8ca3[17]][_$_8ca3[16]]= function(c,b)
{
    var a=this[_$_8ca3[19]](_$_8ca3[18]);//19
    a[c]= b;return a[_$_8ca3[20]](_$_8ca3[18])
}
;var random_question=randomarray(game[_$_8ca3[22]][_$_8ca3[21]]);//23
function Funreload()
{
    if($(_$_8ca3[24])[_$_8ca3[23]]()[_$_8ca3[21]]> 0)
    {
        myswiper[_$_8ca3[25]](0,1000)
    }
    //25
    $(_$_8ca3[27])[_$_8ca3[26]]();counter= 1;wrong= 0;var j=_$_8ca3[18];//34
    var k=_$_8ca3[18];//35
    for(var f=0;f< game[_$_8ca3[22]][_$_8ca3[21]];f++)
    {
        var r=game[_$_8ca3[22]][random_question[f]][_$_8ca3[15]];//38
        r= r[_$_8ca3[19]](_$_8ca3[28]);var n=_$_8ca3[18];//41
        for(var m=0;m< r[_$_8ca3[21]];m++)
        {
            n+= _$_8ca3[29]+ r[m]+ _$_8ca3[30]
        }
        //42
        r= n;if(game[_$_8ca3[22]][random_question[f]][_$_8ca3[31]]!= undefined&& game[_$_8ca3[22]][random_question[f]][_$_8ca3[31]]!= _$_8ca3[18])
    {
        var s=game[_$_8ca3[22]][random_question[f]][_$_8ca3[31]][_$_8ca3[19]](_$_8ca3[28]);//52
        for(var l=0;l< s[_$_8ca3[21]];l++)
        {
            j+= _$_8ca3[32]+ random_question[f]+ _$_8ca3[33]+ l+ _$_8ca3[34]+ random_question[f]+ _$_8ca3[33]+ l+ _$_8ca3[35]+ s[l]+ _$_8ca3[36]
        }

    }
        //51
        var p=_$_8ca3[18];//59
        for(var l=0;l< game[_$_8ca3[22]][f][_$_8ca3[37]][_$_8ca3[21]];l++)
        {
            var q=_$_8ca3[18];//62
            if(game[_$_8ca3[22]][random_question[f]][_$_8ca3[38]]!= _$_8ca3[18]&& game[_$_8ca3[22]][random_question[f]][_$_8ca3[38]]!= undefined)
            {
                q= config[_$_8ca3[39]]+ _$_8ca3[40]+ game[_$_8ca3[22]][random_question[f]][_$_8ca3[38]]+ _$_8ca3[41]
            }
            //64
            j+= _$_8ca3[42]+ random_question[f]+ _$_8ca3[33]+ l+ _$_8ca3[43]+ random_question[f]+ _$_8ca3[33]+ l+ _$_8ca3[44]+ q+ _$_8ca3[45]+ game[_$_8ca3[22]][f][_$_8ca3[37]][l][_$_8ca3[46]]+ _$_8ca3[47]+ game[_$_8ca3[22]][f][_$_8ca3[37]][l][_$_8ca3[46]]+ _$_8ca3[36]
        }
        //61
        for(var l=0;l< game[_$_8ca3[22]][random_question[f]][_$_8ca3[37]][_$_8ca3[21]];l++)
        {
            var g=_$_8ca3[18];//75
            if(l!= 0)
            {
                g= _$_8ca3[48]
            }
            //77
            r= g+ _$_8ca3[49]+ r[_$_8ca3[57]](_$_8ca3[50],_$_8ca3[51]+ f+ _$_8ca3[33]+ l+ _$_8ca3[52]+ _$_8ca3[53]+ q+ _$_8ca3[54]+ f+ _$_8ca3[33]+ l+ _$_8ca3[55]+ game[_$_8ca3[22]][random_question[f]][_$_8ca3[37]][l][_$_8ca3[46]]+ _$_8ca3[56]);if(l== parseInt(game[_$_8ca3[22]][random_question[f]][_$_8ca3[37]][_$_8ca3[21]])- 1)
        {
            p+= _$_8ca3[58]+ random_question[f]+ _$_8ca3[33]+ l+ _$_8ca3[59]+ game[_$_8ca3[22]][random_question[f]][_$_8ca3[60]]+ _$_8ca3[61]+ game[_$_8ca3[22]][random_question[f]][_$_8ca3[37]][_$_8ca3[21]]+ _$_8ca3[62]+ game[_$_8ca3[22]][random_question[f]][_$_8ca3[63]]+ _$_8ca3[64];if(game[_$_8ca3[22]][random_question[f]][_$_8ca3[65]]!= _$_8ca3[18]&& game[_$_8ca3[22]][random_question[f]][_$_8ca3[65]]!= undefined)
        {
            p+= _$_8ca3[66]+ config[_$_8ca3[39]]+ _$_8ca3[67]+ game[_$_8ca3[22]][random_question[f]][_$_8ca3[65]]+ _$_8ca3[68]
        }
            //85
            r= r[_$_8ca3[19]](_$_8ca3[70])[_$_8ca3[20]](_$_8ca3[69]+ random_question[f]+ _$_8ca3[33]+ l);p+= r;p+= _$_8ca3[71]
        }

        }
        //73
        if(p== _$_8ca3[18])
        {
            p+= r
        }
        //98
        k+= _$_8ca3[72]+ p+ _$_8ca3[73]
    }
    //37
    $(_$_8ca3[75])[_$_8ca3[74]](j);k= k[_$_8ca3[19]](_$_8ca3[77])[_$_8ca3[20]](_$_8ca3[76]);$(_$_8ca3[24])[_$_8ca3[74]](k);var o=randomarray($(_$_8ca3[75])[_$_8ca3[23]]()[_$_8ca3[21]]);//112
    for(var l=0;l< $(_$_8ca3[75])[_$_8ca3[23]]()[_$_8ca3[21]];l++)
    {
        $(_$_8ca3[75])[_$_8ca3[78]]($(_$_8ca3[75])[_$_8ca3[23]]()[o[l]])
    }
    //113
    counter++;var h=[];//120
    $(_$_8ca3[114])[_$_8ca3[104]](_$_8ca3[113])[_$_8ca3[112]](function(f)
        {
            var $this=$(this);//122
            var v=$this[_$_8ca3[80]](_$_8ca3[79]);//125
            var $target=$(_$_8ca3[81]+ v+ _$_8ca3[82]);//126
            var w=$this[_$_8ca3[74]]();//127
            $this[_$_8ca3[90]]({stack:$target,revert:true,helper:function()
                {
                    return $($this[_$_8ca3[87]]())[_$_8ca3[86]](_$_8ca3[85])[_$_8ca3[84]](_$_8ca3[83])
                }
                ,drag:function(x,y)
                {
                    objectMain= $(this);object= $(this)[_$_8ca3[89]](_$_8ca3[88])
                }
                ,start:function(x,y)
                {
                    startDrag(x)
                }
            });if($target[_$_8ca3[21]]> 0)
        {
            $target[_$_8ca3[94]]({accept:_$_8ca3[91],drop:function(x,y)
                {
                    if($(this)[_$_8ca3[89]](_$_8ca3[92])!= undefined&& $(this)[_$_8ca3[89]](_$_8ca3[92])== object)
                    {
                        $($(y[_$_8ca3[90]])[_$_8ca3[89]](_$_8ca3[95]))[_$_8ca3[94]](_$_8ca3[93]);$(_$_8ca3[97]+ $(y[_$_8ca3[90]])[_$_8ca3[89]](_$_8ca3[95]))[_$_8ca3[74]](_$_8ca3[96]);$(_$_8ca3[98]+ $(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[99]))[_$_8ca3[74]]($(_$_8ca3[97]+ $(y[_$_8ca3[90]])[_$_8ca3[89]](_$_8ca3[95]))[_$_8ca3[89]](_$_8ca3[88]));$(_$_8ca3[97]+ $(y[_$_8ca3[90]])[_$_8ca3[89]](_$_8ca3[95]))[_$_8ca3[86]](_$_8ca3[100]);var C=$(_$_8ca3[97]+ $(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[15]))[_$_8ca3[89]](_$_8ca3[101]);//160
                        C++;$(_$_8ca3[97]+ $(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[15]))[_$_8ca3[89]](_$_8ca3[101],C);if(C== $(_$_8ca3[97]+ $(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[15]))[_$_8ca3[89]](_$_8ca3[102]))
                    {
                        var z=_$_8ca3[18];//165
                        if($(_$_8ca3[97]+ $(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[15]))[_$_8ca3[104]](_$_8ca3[103])[0]!= undefined)
                        {
                            var z=$(_$_8ca3[97]+ $(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[15]))[_$_8ca3[104]](_$_8ca3[106])[0][_$_8ca3[105]]
                        }
                        //166
                        if($(_$_8ca3[97]+ $(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[15]))[_$_8ca3[89]](_$_8ca3[60])== _$_8ca3[107])
                        {
                            $(_$_8ca3[97]+ $(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[15]))[_$_8ca3[74]](z+ $(_$_8ca3[97]+ $(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[15]))[_$_8ca3[89]](_$_8ca3[108])[_$_8ca3[19]](_$_8ca3[28])[_$_8ca3[20]](_$_8ca3[18]))
                        }
                        else
                        {
                            $(_$_8ca3[97]+ $(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[15]))[_$_8ca3[74]](z+ $(_$_8ca3[97]+ $(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[15]))[_$_8ca3[89]](_$_8ca3[108]))
                        }
                        //170
                        if($(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[109])!= _$_8ca3[18]&& $(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[109])!= undefined)
                        {
                            quastion_sound=  new manhalsound($(x[_$_8ca3[79]])[_$_8ca3[89]](_$_8ca3[109]),false);quastion_sound[_$_8ca3[110]]()
                        }

                    }
                        //164
                        Right_sound[_$_8ca3[110]]();var B=$($(x[_$_8ca3[79]]))[_$_8ca3[89]](_$_8ca3[15]);//181
                        checkFinished()
                    }
                    else
                    {
                        Wrong_sound[_$_8ca3[110]]();wrong++;$(_$_8ca3[111])[_$_8ca3[74]](wrong)
                    }

                }
            })
        }
        else
        {

        }

        }
    );if($(_$_8ca3[24])[_$_8ca3[23]]()[_$_8ca3[21]]> 0)
{
    myswiper=  new Swiper(_$_8ca3[115],{pagination:_$_8ca3[116],paginationClickable:true,nextButton:_$_8ca3[117],prevButton:_$_8ca3[118],spaceBetween:30})
}

}
$(document)[_$_8ca3[142]](function()
    {
        GetAPI(window);if(API!= null)
    {
        if(API[_$_8ca3[119]](_$_8ca3[18]))
        {
            LMSStatus= true;API[_$_8ca3[121]](_$_8ca3[120],0);API[_$_8ca3[121]](_$_8ca3[122],100)
        }

    }
        //213
        $(_$_8ca3[129])[_$_8ca3[128]](function()
            {
                $(this)[_$_8ca3[123]](_$_8ca3[100]);if($(this)[_$_8ca3[124]](_$_8ca3[100]))
            {
                $(_$_8ca3[127])[_$_8ca3[126]](_$_8ca3[125],true)
            }
            else
            {
                $(_$_8ca3[127])[_$_8ca3[126]](_$_8ca3[125],false)
            }

            }
        );$(_$_8ca3[134])[_$_8ca3[128]](function()
        {
            $(_$_8ca3[131])[_$_8ca3[130]]();$(_$_8ca3[133])[_$_8ca3[86]](_$_8ca3[132])
        }
    );$(_$_8ca3[135])[_$_8ca3[128]](function()
        {
            $(_$_8ca3[131])[_$_8ca3[26]]()
        }
    );$(_$_8ca3[136])[_$_8ca3[74]](game[_$_8ca3[14]][_$_8ca3[15]]);$(_$_8ca3[139])[_$_8ca3[89]](_$_8ca3[4],config[_$_8ca3[39]]+ _$_8ca3[67]+ game[_$_8ca3[14]][_$_8ca3[137]]+ _$_8ca3[138]);Funreload();$(_$_8ca3[141])[_$_8ca3[128]](function()
        {
            $(_$_8ca3[140])[_$_8ca3[26]]()
        }
    )
    }
);function viewImage(H)
{
    $(_$_8ca3[140])[_$_8ca3[130]]();$(_$_8ca3[143])[_$_8ca3[86]](_$_8ca3[132]);$(_$_8ca3[144])[_$_8ca3[89]](_$_8ca3[4],$(H)[_$_8ca3[104]](_$_8ca3[103])[_$_8ca3[89]](_$_8ca3[4]))
}
function startDrag(x)
{
    $(x[_$_8ca3[79]])[_$_8ca3[147]]()[_$_8ca3[146]](_$_8ca3[145],999);if(quastion_sound!= undefined)
{
    quastion_sound[_$_8ca3[148]]()
}
    //256
    Click_sound[_$_8ca3[110]]()
}
function stopDrag(x,y)
{
    $(x[_$_8ca3[79]])[_$_8ca3[146]](_$_8ca3[145],1)
}
function checkFinished()
{
    var e=false;//268
    for(var f=0;f< $(_$_8ca3[75])[_$_8ca3[23]]()[_$_8ca3[21]];f++)
    {
        if($($(_$_8ca3[75])[_$_8ca3[23]]()[f])[_$_8ca3[124]](_$_8ca3[100])== false&& $($(_$_8ca3[75])[_$_8ca3[23]]()[f])[_$_8ca3[89]](_$_8ca3[149])!= _$_8ca3[31])
        {
            e= true
        }

    }
    //269
    if(!e)
    {
        clearInterval(SetTimerScorm);SetTimerScorm= null;Result= _$_8ca3[150];per= 100;setTimeout(function()
        {
            $(_$_8ca3[27])[_$_8ca3[130]]();$(_$_8ca3[151])[_$_8ca3[86]](_$_8ca3[132])
        }
        ,5000);if(LMSStatus)
    {
        API[_$_8ca3[121]](_$_8ca3[152],per[_$_8ca3[153]](2));API[_$_8ca3[121]](_$_8ca3[154],_$_8ca3[155]);API[_$_8ca3[121]](_$_8ca3[156],Result);API[_$_8ca3[121]](_$_8ca3[157],TimeScorm);API[_$_8ca3[158]](_$_8ca3[18])
    }
        //285
        TimeScorm= 0
    }

}
function randomarray(D)
{
    var E=[];//298
    for($x= 0;$x< D;$x++)
    {
        E[_$_8ca3[159]]($x)
    }
    //299
    return shuffleArray(E)
}
function shuffleArray(F)
{
    for(var f=F[_$_8ca3[21]]- 1;f> 0;f--)
    {
        var l=Math[_$_8ca3[161]](Math[_$_8ca3[160]]()* (f+ 1));//306
        var G=F[f];//307
        F[f]= F[l];F[l]= G
    }
    //305
    return F
}
function BackgroundSound(d)
{
    if($(_$_8ca3[127])[_$_8ca3[21]])
    {
        $(_$_8ca3[127])[_$_8ca3[162]]()
    }
    //315
    $(_$_8ca3[165])[_$_8ca3[89]]({"src":d,"autoplay":_$_8ca3[164]})[_$_8ca3[84]](_$_8ca3[163]);$(_$_8ca3[127])[_$_8ca3[126]](_$_8ca3[166],false);$(_$_8ca3[127])[_$_8ca3[126]](_$_8ca3[167],$(_$_8ca3[169])[_$_8ca3[168]]());$(_$_8ca3[127])[_$_8ca3[173]](_$_8ca3[170],function()
    {
        $(this)[_$_8ca3[172]](_$_8ca3[171])
    }
)
}
var quastion_sound;//332
var Right_sound= new manhalsound(_$_8ca3[174],false);//333
var Wrong_sound= new manhalsound(_$_8ca3[175],false);//334
var Click_sound= new manhalsound(_$_8ca3[176],false)