/**
 * Created by osaid zalloum on 27/01/2021.
 */

var correct = 0;
var allCorrect = 0;
var incorrect = 0;
var itemList=[
    {
        qus:"ضِدَّ كَلِمَةِ <font>(عامٌّ)</font>:",
        ans:'images/word/q01/c.svg',
        type:'خاصٍّ',
        text:'أَنْتُمْ يا شَبابَنا الْأُرْدَنيُّ تواجِهونَ مَسْؤوليّاتٍ وَتَحَدياتٍ مِنْ نَوْعٍ خاصٍّ، فَأَنْتُمْ ابْتِداءً الْقِطاعُ الْأَوْسَعُ في الْمُجْتَمَعِ، وَأَنْتُمْ ثانيًا مَنْ سَيَجْني عَوائِدَ الْعَمَليَّةِ التَّنْمِويَّةِ الَّتي يَمُرُّ بِها الْأُرْدُنُّ الْيَوْمَ، وَالَّتي نُؤَمِّلُ وَنَعْمَلُ لِتَكونَ مُخْرَجاتُها إيجابيَّةً بِعَوْنِ اللهِ تَعالى.'

    },
    {
        qus:"ضِدَّ كَلِمَةِ <font>(السَّلْبيَّةُ)</font>:",
        ans:'images/word/q02/c.svg',
        type:'إيجابيَّةً',
        text:'أَنْتُمْ يا شَبابَنا الْأُرْدَنيُّ تواجِهونَ مَسْؤوليّاتٍ وَتَحَدياتٍ مِنْ نَوْعٍ خاصٍّ، فَأَنْتُمْ ابْتِداءً الْقِطاعُ الْأَوْسَعُ في الْمُجْتَمَعِ، وَأَنْتُمْ ثانيًا مَنْ سَيَجْني عَوائِدَ الْعَمَليَّةِ التَّنْمِويَّةِ الَّتي يَمُرُّ بِها الْأُرْدُنُّ الْيَوْمَ، وَالَّتي نُؤَمِّلُ وَنَعْمَلُ لِتَكونَ مُخْرَجاتُها إيجابيَّةً بِعَوْنِ اللهِ تَعالى.'
    },
    {
        qus:"ضِدَّ كَلِمَةِ <font>(مُدْخَلاتُها)</font>:",
        ans:'مُخْرَجاتُها',
        type:'مُخْرَجاتُها',
        text:'أَنْتُمْ يا شَبابَنا الْأُرْدَنيُّ تواجِهونَ مَسْؤوليّاتٍ وَتَحَدياتٍ مِنْ نَوْعٍ خاصٍّ، فَأَنْتُمْ ابْتِداءً الْقِطاعُ الْأَوْسَعُ في الْمُجْتَمَعِ، وَأَنْتُمْ ثانيًا مَنْ سَيَجْني عَوائِدَ الْعَمَليَّةِ التَّنْمِويَّةِ الَّتي يَمُرُّ بِها الْأُرْدُنُّ الْيَوْمَ، وَالَّتي نُؤَمِّلُ وَنَعْمَلُ لِتَكونَ مُخْرَجاتُها إيجابيَّةً بِعَوْنِ اللهِ تَعالى.'
    },
];
var title='الأَضْدادُ';
var mainQus='أَسْتَخْرِجُ مِنَ الْفَقَرَةِ ما يَلي:';
var shuffleList1=[];
var shuffleList2=[];
function drawList() {
    shuffleList1=[];
    shuffleList2=[];
    shuffleList1=randomarray(itemList.length);
    for(var i=0;i<itemList.length;i++){
        shuffleList2.push(itemList[shuffleList1[i]]);
    }
}
function drawItem(a){
    var html='';
    var html2='';
    $(".qus-mark").fadeIn();
    $(".dot-container").fadeIn();
    $(".ans-text span").html("");
    $(".title span").html(title);
    $(".qus-text span").html(mainQus)
    $(".text-container").html('');
    var splitText=shuffleList2[a].text.split(" ");
    for(var i=0;i<splitText.length;i++){
        html+='<div class="drag-item"><span>'+splitText[i]+'</span></div>'
    }
    $(".qus-item").html('<div class="dot"><span>'+(a+1)+'</span></div><div class="qus-item-text"><span>'+shuffleList2[a].qus+'</span></div>');
    $(".ans-box").attr({"data":shuffleList2[a].type});
    $(".text-container").html(html);
    drag();
}
