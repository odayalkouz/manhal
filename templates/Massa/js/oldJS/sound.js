// Audio player
//
var my_media = null;
var mediaTimer = null;

// Play audio
//
function playAudio(src) {
    // Create Media object from src

    my_media = new Media(src, onSuccess, onError,status_change);

    // Play audio
    my_media.play();

    // Update my_media position every second
    if (mediaTimer == null) {
        mediaTimer = setInterval(function() {
            // get my_media position
            my_media.getCurrentPosition(
                // success callback
                function(position) {
                    if (position > -1) {
                        setAudioPosition((position) + " sec");
                    }
                    else{
                        alert('end')
                    }
                },
                // error callback
                function(e) {
                    console.log("Error getting pos=" + e);
                    setAudioPosition("Error: " + e);
                }
            );
        }, 1000);
    }
}
function status_change(code) {
   // alert(code)
    switch (code) {
        case Media.MEDIA_STOPPED :
            $(".swiper-button-next").addClass('animated shake');
            //nextPage()
        ; break;
    }
}

// Pause audio
//
function pauseAudio() {
    if (my_media) {
        my_media.pause();
    }
}

// Stop audio
//
function stopAudio() {
    if (my_media) {
        my_media.pause();
    }
    clearInterval(mediaTimer);
    mediaTimer = null;
}

// onSuccess Callback
//
function onSuccess() {
    console.log("playAudio():Audio Success");
}

// onError Callback
//
function onError(error) {
   // alert('code: '    + error.code    + '\n' +
    //    'message: ' + error.message + '\n');
}

// Set audio position
//
function setAudioPosition(position) {
   // document.getElementById('audio_position').innerHTML = position;
}

var pageFlip=""
function flipPageSound(){

   // pageFlip = new Media(getBaseUrl()+'sound/pageflipsound.mp3',onSuccess, onError);

    // Play audio
 //   pageFlip.play();

    function onSuccess() {

        console.log("playAudio():Audio Success");
    }

// onError Callback
//
    function onError(error) {
        // alert('code: '    + error.code    + '\n' +
        //    'message: ' + error.message + '\n');
    }
}


