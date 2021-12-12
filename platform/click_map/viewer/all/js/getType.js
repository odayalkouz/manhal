/**
 * Created by Design4 on 29/01/2017.
 */



function gameType() {

    switch (game[0].typeEdit) {
        case "WithSound":
           setTimeout(getQustion, 1000)

            break;
        case "justText":
            setTimeout(getQustion, 1000)


            break;
        case "correctChoose":

            break;
        default:

    }
}





function checkAnswerTypeCorrect(object) {
    $('.allElem').css({
        'pointer-events': 'none',

    });
    idImage = object.id;
    console.log(object)
    idSound = $(".playSoundQustion").attr('idAttr');
    text = $(".playSoundQustion").attr('text');
    image = $(object).attr('name');


    if (qustionSoundArray[qustionIndex] == true) {
        qustionIndex++
        correctCounterAnswer++;
        correctCounter += 5;
        alert('good,next qustion .')
        $('.allElem').css({
            'pointer-events': 'auto',

        });

        $('#score').html(correctCounter)



    }
    else {


        if ($(".hintContainer").length) $(".hintContainer").remove()
        str = '<div class="hintContainer"><div class="hint" >' +
            '<label class="checkAnswerLabel">خطأ , حاول مرة أخرى</label>' +


            '<img class="closeImg" src="images/close.png" onclick="closeBox()">' +

            '</div>' +
            '</div>'

        $(str).appendTo("body")
    }


}