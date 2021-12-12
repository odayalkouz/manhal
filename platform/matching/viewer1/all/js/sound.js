function GenrateID() {
    var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
    var uniqid = randLetter + Date.now();
    return uniqid;
}

manhalsound = function (sound) {
    this.soundplay = false;
    this.soundObject = new Audio((sound + "?" + GenrateID()));
    this.soundObject.addEventListener('error', this.errorSound, false);
    this.soundObject.addEventListener('loadeddata', this.loadsound, true);
    this.soundObject.addEventListener('ended', this.CompleteSound, false);
}

manhalsound.prototype.Play = function () {

    if (this.soundObject != null || typeof this.soundObject!== 'undefined') {
        this.Stop();

        setTimeout(function (sound) {
	        console.log(sound.soundObject.src)
            sound.soundObject.play();
            sound.soundplay = true;
        }, 150,this);
    }
}
manhalsound.prototype.loadsound = function (e) {
    var target = e.target;
    target.removeEventListener('loadeddata', target.loadsound);
    target.removeEventListener('error', target.errorSound);
}
manhalsound.prototype.errorSound = function (e) {
    var target = e.target;
    target = null;
}
manhalsound.prototype.CompleteSound = function (e) {
    var target = e.target;
    if (target != null) {
        target = null;
        this.soundplay = false;
    }
}
manhalsound.prototype.Stop = function () {
    if (this.soundObject != null) {
        this.soundObject.pause();
        this.soundObject.currentTime = 0;
        this.soundplay = false;
    }
}

