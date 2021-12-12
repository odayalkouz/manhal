
//strText=parent.StoryPages[parent.Current].text
soundData=StoryPages;
doReload=false;
console.log("StoryPages=",StoryPages);
var urlSound =soundData.sound;
//strText="كانَ الْقَمَرُ يُضيءُ غُرْفَةَ رَنُّوشٍ. وَمَعَ مُرورِ الْوَقْتِ اخْتَفى ضَوْءُ الْقَمَرِ، وَاشْتَدَّ الظَّلامُ، وَخافَ رَنُّوشُ مِنْ صَوْتِ الرِّياحِ. أَمْسَكَ جَيِّداً بِغِطاءِ السَّريرِ، وَقَدْ شَعَرَ بِالْبَرْدِ يَسْري في يَدَيْهِ وَقَدَمَيْهِ."
strText=soundData["text"];
var arrayOftext="";
function uniqueid(){
    // always start with a letter (for DOM friendlyness)
    var idstr=String.fromCharCode(Math.floor((Math.random()*25)+65));
    do {
        // between numbers and characters (48 is 0 and 90 is Z (42-48 = 90)
        var ascicode=Math.floor((Math.random()*42)+48);
        if (ascicode<58 || ascicode>64){
            // exclude all chars between : (58) and @ (64)
            idstr+=String.fromCharCode(ascicode);
        }
    } while (idstr.length<6);
    return (idstr);
}



function createSubtitle() {
    var syncData = strText.split(" ");
    var arrayOftext = strText.split(" ");
    var element;





    for (var i = 0; i < syncData.length; i++) {
        element = document.createElement('span');
        id=uniqueid()
        element.setAttribute("id", id);
        element.setAttribute("class", "textAll" );
        element.innerText = syncData[i] + " ";
        document.getElementById('textContainer').appendChild(element);

       element.onclick=function(){
           $(".textAll").css('color',"black")
           $(this).css('color',"#00AB67")
           Region=$(this).attr('Region')
           value=$(this).html()

          arrays= JSON.parse(localStorage.regions);

           for (i = 0; i < arrays.length; i++) {

               if (arrays[i].data.note == value) {

               }

           }
       }
    }



    $( ".textAll" ).draggable({
        revert:true,
        zIndex:9999
    });
    $( "#note" ).droppable({
        drop: function( event, ui ) {
            $( this )

                .val(  $(ui.draggable).html() );
        }
    });

}




function ExportToCurrentStory(){
    console.log("s=",StoryPages.textAligner);
    StoryPages.textAligner=(
        Object.keys(wavesurfer.regions.list).map(function (id) {
            var region = wavesurfer.regions.list[id];
            return {
                start: region.start,
                end: region.end,
                attributes: region.attributes,
                data: region.data,
                color:randomColor(0.5),
                id:id
            };
        })
    );
    console.log("s2=",StoryPages.textAligner);
   //saveSound(StoryPages);

    //console.log(parent.StoryPages[parent.Current].textAligner)
  //  parent.uploadToServer()
}
function ExportToCurrentStory2(){
    console.log("s=",StoryPages.textAligner);
    StoryPages.textAligner=(
        Object.keys(wavesurfer.regions.list).map(function (id) {
            var region = wavesurfer.regions.list[id];
            return {
                start: region.start,
                end: region.end,
                attributes: region.attributes,
                data: region.data,
                color:randomColor(0.5),
                id:id
            };
        })
    );
    console.log("s2=",StoryPages.textAligner);
    saveSound(StoryPages);

    //console.log(parent.StoryPages[parent.Current].textAligner)
    //  parent.uploadToServer()
}

