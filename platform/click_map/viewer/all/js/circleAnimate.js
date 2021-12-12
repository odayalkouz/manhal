(function () {
    var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
        window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    window.requestAnimationFrame = requestAnimationFrame;
})();


function CircleAnimate(object, correct) {
    this.id = object.id;

    this.checkCorrect = correct
    this.canvas = document.createElement('canvas');
    this.context = this.canvas.getContext('2d');
    if ($(object).attr("srcimage") == "") {
        this.canvas.width = object.offsetWidth * 1.15
        this.canvas.height = object.offsetHeight * 1.15
    } else {

        this.canvas.width = object.offsetWidth * 1.3
        this.canvas.height = object.offsetHeight * 1.3
    }


    var self = this; //cache this here
    document.getElementById(this.id).appendChild(this.canvas)

    $(this.canvas).css({
        'top': '50%',
        'left': '50%',
        'margin': '-' + ($(this.canvas).height() / 2) + 'px 0 0 -' + ($(this.canvas).width() / 2) + 'px',
        "position": "absolute"
    });


    this.x = (this.canvas.width / 2);
    this.y = (this.canvas.height / 2);

    if ($(object).attr("srcimage") == "") {
        this.radius = this.canvas.width / 2.1;
    } else {

        this.radius = this.canvas.width / 2.1;
    }

    this.endPercent = 105;
    this.curPerc = 0;
    this.counterClockwise = false;
    this.circ = Math.PI * 2;
    this.quart = Math.PI / 2;
    this.context.strokeStyle = '#ad2323';
    this.context.lineWidth = 2;
    if (this.checkCorrect) {
        this.context.strokeStyle = '#1dad11';
    }

    // this.context.shadowOffsetX = 0;
    // this.context.shadowOffsetY = 0;
    // this.context.shadowBlur = 5;
    // this.context.shadowColor = '#656565';


    this.animate = function (current) {
        self.context.clearRect(0, 0, self.canvas.width * 2, self.canvas.height * 2);
        // self.context.beginPath();
        // self.context.arc(self.x,self.y, self.radius, -(self.quart), ((self.circ) * current) - self.quart, false);
        // self.context.stroke();

        // drawEllipseByCenter(self.context, self.x, self.y, self.canvas.width, self.canvas.height)


        self.context.save();
        self.context.scale(1, self.canvas.height / self.canvas.width);
        self.context.beginPath();
        self.context.arc(self.x, self.y / (self.canvas.height / self.canvas.width), self.radius, -(self.quart), ((self.circ) * current) - self.quart, false);
        self.context.restore();

        self.context.stroke();

        self.curPerc++;
        if (self.curPerc < self.endPercent) {
            requestAnimationFrame(function () {

                // console.log("draw" + self.curPerc)
                self.animate(self.curPerc / 100)
            });
        } else {

            if (self.checkCorrect) {
                animiteTrue(self.id)
            } else {
                var path = '../all/failed.json'
            }

        }


    }


}