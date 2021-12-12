var audio;
var playlist;
var tracks;
var current;
createPlaylist();
$(window).on("resize", function () {
    resizeGame();
})

function createPlaylist() {
    if ($('#playlist li').length)$('#playlist li').remove()
    var str = ""

    for (i = 0; i < parent.StoryPages.length; i++) {
        if (parent.StoryPages[i].sound == "") {

        } else {



            str += '<li ><a href="' + parent.applicationPath + parent.storyArray[0].folderName + "/sound/" + parent.StoryPages[i].sound + '">' + parent.applicationPath + parent.storyArray[0].folderName + "/sound/" + parent.StoryPages[i].sound + '</a></li>'
        }
    }
    $(str).appendTo('#playlist');
    first = $('li').first()
    first.addClass('active')
    init();
}


function init() {
    current = 0;
    audio = $('audio');
    playlist = $('#playlist');
    tracks = playlist.find('li a');
    len = tracks.length - 1;
    //  audio[0].volume = .10;
    audio[0].play();
    playlist.find('a').click(function (e) {
        e.preventDefault();
        link = $(this);
        current = link.parent().index();
        run(link, audio[0]);
    });
    audio[0].addEventListener('ended', function (e) {
        current++;
        if (current == len) {
            current = 0;
            link = playlist.find('a')[0];
        } else {
            link = playlist.find('a')[current];
        }
        run($(link), audio[0]);
    });
}
function run(link, player) {
    player.src = link.attr('href');
    par = link.parent();
    par.addClass('active').siblings().removeClass('active');
    audio[0].load();
    audio[0].play();
}
$(document).ready(function () {
    parent.onLoadIframeShow()
    $('.play-stop-sleep').click(function () {


        if (!$('#audio')[0].paused) {
            $(this).removeClass("play")
            $(this).addClass("stop")
            $('#audio').trigger('pause')
        } else {
            $(this).removeClass("stop")
            $(this).addClass("play")


            PlayMode = 1;

            $('#audio').trigger('play')
        }


    });


    $('.back-btn-sleep').click(function () {
        parent.showContainer()
        parent.closeIframe();

    })
    resizeGame()

})

function resizeGame() {
    var gameArea = document.getElementById('main-title');
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

    var gameCanvas = document.getElementById('innertitle');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
}
