function GenrateID() {
    var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
    var uniqid = randLetter + Date.now();
    return uniqid;
}

manhalsound = function (sound,loop) {
    this.soundplay = false;
    this.soundObject = new Audio((sound + "?" + GenrateID()));
    this.soundObject.loop =loop;
    this.soundObject.addEventListener('error', this.errorSound, false);
    this.soundObject.addEventListener('loadeddata', this.loadsound, true);
    this.soundObject.addEventListener('ended', this.CompleteSound, false);
}

manhalsound.prototype.Play = function () {

    if (this.soundObject != null) {
        this.Stop();
        setTimeout(function (sound) {
            sound.soundObject.play();
            sound.soundplay = true;
        }, 150,this);
    }
}
manhalsound.prototype.soundvolume=function(v){
    this.soundObject.volume =v;
}
manhalsound.prototype.getsoundvolume=function(){
    return this.soundObject.volume ;
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
    if (target != null ) {
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

