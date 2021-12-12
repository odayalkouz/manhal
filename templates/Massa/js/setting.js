/**
 * Created by osaid zalloum Manhal on 27/09/2016.
 */
if (typeof localStorage['fontType'] == "undefined")localStorage['fontType'] = "Droid Arabic Naskh"
if (typeof localStorage['readerSound'] == "undefined")localStorage['readerSound'] = "1"
if (typeof localStorage['musicSound'] == "undefined")localStorage['musicSound'] = "1"
if (typeof localStorage['readMode'] == "undefined")localStorage['readMode'] = "normal"
if (typeof localStorage['PlayMode'] == "undefined")localStorage['PlayMode'] = "1"
if (typeof localStorage['autoFlip'] == "undefined")localStorage['autoFlip'] = false
if (typeof localStorage['selectStory'] == "undefined")localStorage['selectStory'] = 1
if (typeof localStorage['applicationPath'] == "undefined")localStorage['applicationPath'] = "story/"
if (typeof localStorage['folderName'] == "undefined")localStorage['folderName'] = "st1"
if (typeof localStorage['fillingSrcImage'] == "undefined")localStorage['fillingSrcImage'] = ""
if (typeof localStorage['pageRangeFirst'] == "undefined")localStorage['pageRangeFirst'] = 3
if (typeof localStorage['pageRangeEnd'] == "undefined")localStorage['pageRangeEnd'] = 11
if (typeof localStorage['storyStatus'] == "undefined")localStorage['storyStatus'] = "free"

$(window).on("resize", function () {
    resizeGame();
    resizeSetting()
})

$(document).ready(function () {

    resizeGame();
    resizeSetting();

    $(".nightToggleInput").click(function () {
        if( $(".nightToggleInput").is(':checked')){
            $(".nightRead").click()
            localStorage['readMode'] = 'nightRead'
        }else{
            $(".IamRead").click()
            localStorage['readMode'] ='normal'
        }

    });


    $(".setting-popup").click(function(e){
        if(e.target == this){
            $(".setting-popup").hide();
        }
    });

    $(".close-setting").click(function () {
        $(".setting-popup").hide();
    })
    $(".fount-btn").click(function () {
        soundEffect('sound/click.mp3');
        localStorage['fontType'] = $(this).attr("fonttype"); // only strings
        $(".fount-btn span label").css("background-image", "none");
        $(this).find("span label").css("background-image", "url('images/True.svg')")
        $('.scroller').css({
            'font-family': "'" + localStorage['fontType'] + "' !important"
        });
        $('.text-containerSlide').css({
            'font-family': "'" + localStorage['fontType']+ "'"
        });
    });
    $(".view-btn-a").click(function () {

        soundEffect('sound/click.mp3');
        if($(".view-btn-a span label").attr("data")==0){
            $(this).find("span label").css("background-image", "url('images/True.svg')")
            $(this).find("span label").attr("data","1");
            localStorage['autoFlip']=true
        }
        else {
            $(this).find("span label").css("background-image", "none");
            $(this).find("span label").attr("data","0");
            localStorage['autoFlip']=false
        }

    });
    $('#readerSound').on("change input", function () {
        soundEffect('sound/click.mp3')
        changeAllVolumeSoundOFReader(this)
    });

    $('#musicSound').on("change input", function () {
        soundEffect('sound/click.mp3')
        changeAllVolumeSoundOFbg(this)
    });

    $('#musicSound').val(localStorage['musicSound']).change()
    $('#readerSound').val(localStorage['readerSound']).change()

})

function showSettingOption(id,bt) {
    $(".inner-setting-option-container").hide()
    $(id).show()
    $(".setting-btn").find(".setting-image").removeClass("border-bottom");
    $(bt).find(".setting-image").addClass("border-bottom");
}

function resizeSetting() {
    var gameArea = document.getElementById('main-setting');
    var widthToHeight = 4 / 3;
    var newWidth = window.innerWidth;
    var newHeight = window.innerHeight;
    var newWidthToHeight = newWidth / newHeight;

    if (newWidthToHeight > widthToHeight) {
        newWidth = newHeight * widthToHeight;
        gameArea.style.height = newHeight + 'px';
        gameArea.style.width = newWidth + 'px';
    } else {
        newHeight = newWidth / widthToHeight;
        gameArea.style.width = newWidth + 'px';
        gameArea.style.height = newHeight + 'px';
    }

    //gameArea.style.marginTop = (-newHeight / 2) + 'px';
    //gameArea.style.marginLeft = (-newWidth / 2) + 'px';

    var gameCanvas = document.getElementById('inner-setting');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
    autoSizeText
}