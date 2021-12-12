var scorm = {
    date: "",
    loginTime: {
        string: "",
        value: ""
    },
    logOutTime: {
        string: "",
        value: ""
    },
    spentTime: "",
    score: "",
    failAnswers:0,
    correctAnswers:0,

};


var monthNames = [
    "January", "February", "March",
    "April", "May", "June", "July",
    "August", "September", "October",
    "November", "December"
];


function setDateScorm() {
    var date = new Date();
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
    scorm.date = day + ' ' + monthNames[monthIndex] + ' ' + year
}

function setLoginTime() {
    var d = new Date();
    var datestring = d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear() + " " +
        d.getHours() + ":" + d.getMinutes();

    scorm.loginTime.string = datestring
    scorm.loginTime.value = d.getTime()
}

function setLogOutTime() {
    var d = new Date();
    var datestring = d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear() + " " +
        d.getHours() + ":" + d.getMinutes();

    scorm.logOutTime.string = datestring
    scorm.logOutTime.value = d.getTime()

}

function setSpentTime() {
    start = scorm.loginTime.value;
    end = scorm.logOutTime.value;

    timeSpent = end - start;
    scorm.spentTime=timeSpent;

    // $.ajax({
    //     url: "log.php",
    //     data: {'timeSpent': end - start}
    // })
}


function setScore() {

    scorm.score =""
}


function beforeunload(){
    setLogOutTime();
    setSpentTime();


}


function StartScorm() {
    $(window).on('beforeunload ',function() {
        beforeunload()
    });

    setDateScorm()
    setLoginTime()
}



