<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
    $cash = "?7";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Quiz Time</title>
    <meta content="utf-8" http-equiv="encoding">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <meta http-equiv="Cache-Control" content="no-cache">
    <script src="../all/js/jquery.js" type="text/javascript"></script>
    <script src="../all/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="js/manhal-ui.js<?= $cash; ?>" type="text/javascript"></script>
    <script src="js/manhalLoader1.js" type="text/javascript"></script>
    <script src="../all/js/timerN.js" type="text/javascript"></script>
    <script src="../../../../js/howler.core.js" type="text/javascript"></script>

    <script src="../all/js/quiz.js<?= $cash; ?>" type="text/javascript"></script>
    <script src="../all/js/jquery.ui.touch-punch.min.js"></script>
    <link rel="icon" data-type="favicon" sizes="24" href="../all/thems/en/images/favicon(1).ico" type="image/x-icon">
    <link href="../all/thems/en/css/style.css<?= $cash; ?>" rel="Stylesheet" type="text/css"/>
    <link href="../all/thems/en/css/manhalloader1.css" rel="Stylesheet" type="text/css"/>
    <link href="../all/thems/en/css/animate.css" rel="Stylesheet" type="text/css"/>
    <link href="../all/thems/en/css/size.css<?= $cash; ?>" rel="Stylesheet" type="text/css"/>
    <link href="../all/thems/en/css/swiper.min.css" rel="Stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../all/thems/en/css/magnific-popup.css">

    <script src="https://manhal.com/js/scorm.js"></script>
    <script src="../all/js/jquery.magnific-popup.min.js"></script>


    <script>
        language='en';
        <?php if(isset($_SESSION['user'])) {
            echo 'usernameflag=false';

        }else{
            echo 'usernameflag=true';
        } ?>

        quizid=<?=$_GET["id"]?>;
        path='../../<?=$_GET["id"]?>/';


        $(document).ready(function() {
            $('.image-link-popup').magnificPopup({
                type:'image',
                removalDelay: 500,
                callbacks: {
                    beforeOpen: function() {
                        this.st.mainClass = this.st.el.attr('data-effect');
                    }
                },
                midClick: true
            });
        });
    </script>
</head>
<body  onunload="disconnetLMS();">
    <main class="site-container " id="full-screen-container" >
        <a class="image-link-popup mfp-zoom-in" data-effect="mfp-zoom-in" style="display: none" href="https://www.manhal.com/platform/quiz/199/widget_BsGomsQ.jpg?774851750"></a>
        <section class="quiz-container">
            <div class="popup-delete-container noclose" style="display: none;">
                <div class="delete-container" style="display: none;">
                    <h1>Confirmation</h1>
                    <p>Do you want to submit the quiz?</p>
                    <div class="row">
                        <a id="delete_question" class="yes floating-right">Yes</a>
                        <a class="no floating-right">Cancel</a>
                    </div>
                </div>
            </div>
            <div class="popup-login-container noclose" style="display: none;">
                <div class="login-container" style="display: none;">
                    <div class="display-block">
                        <h1>Login</h1>
                        <div class="close floating-right" ></div>
                    </div>
                    <label>Username</label>
                    <input id="login"  type="text" value="" class="floating-right" placeholder="Username">
                    <a class="login-button floating-right">Login</a>
                </div>
            </div>
            <section class="silver-container" style="display:none;">
                <div class="content-container">
                    <div class="top-content">
                        <article>
                            <div class="shine"></div>
                        </article>
                    </div>
                    <div class="square-quiz-container">
                        <div class="boxes"></div>
                        <div class="box-a"></div>
                        <div class="box-b"></div>
                        <div class="box-c"></div>
                        <div class="box-d"></div>
                        <div class="box-e"></div>
                    </div>
                    <div class="btn-start-container">
                        <a><label class="floating-left" id="starts"></label><span class="floating-left"></span><i class="floating-right"></i></a>
                    </div>
                    <div class="copywrite"><label class="floating-right"><i class="copyrights">All Rights Reserved for Dar Al-Manhal Publishers ©</i> <i class="year"></i></label><span class="floating-left"></span></div>
                </div>
            </section>
            <section class="result-page-container" id="print-result-a">
                <div class="content-container">
                    <div class="header">
                        <div class="logo-header floating-left"></div>
                        <div id="username" class="user floating-right">
                            <div class="image floating-left"></div>
                            <div class="username floating-left"><?php if((isset($_SESSION['user']))){

                                    echo($_SESSION['user']['uname']);
                                } ?> </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="top-content">
                            <div class="title floating-left">
                                <label  class="floating-left titlelang">Title :</label>
                                <span id="QuizTitle" class="floating-left"></span>
                            </div>
                            <div class="num-of-question floating-right">
                                <div class="image floating-left"></div>
                                <div class="num floating-left"><b id="qustionnum">10</b> <b id="qustiontext"></b></div>
                            </div>
                        </div>
                        <div class="bottom-content">
                            <aside id="resultmsg" class="right-container floating-right">
                                <div  class="box-white">
                                    <div class="top">
                                        <i class="floating-left first"></i>
                                        <label id="elapsed" class="floating-left">Elapsed</label>
                                    </div>
                                    <div id="elapsedTim" class="bottom opacity">00:00:00</div>
                                </div>
                                <div class="box-white">
                                    <div class="top">
                                        <i class="floating-left last"></i>
                                        <label id="yourscore" class="floating-left">Your Score</label>
                                    </div>
                                    <div id="yourscorenum" class="bottom opacity"></div>
                                </div>
                            </aside>
                            <aside class="feedback-info">
                                <div class="left floating-left">
                                    <div class="point floating-left"></div>
                                    <div class="text floating-left">Feedback</div>
                                </div>
                                <div id="feedbackquiz" class="aria"></div>
                            </aside>
                            <aside class="left-container floating-left">
                                <div class="line-row">
                                    <div class="left floating-left">
                                        <div class="point floating-left"></div>
                                        <div id="fullscore" class="text floating-left"></div>
                                    </div>
                                    <div id="fullscorenum" class="right floating-right"></div>
                                </div>
                                <div class="line-row">
                                    <div class="left floating-left">
                                        <div class="point floating-left"></div>
                                        <div id="passingrate" class="text floating-left">Pass Rate</div>
                                    </div>
                                    <div id="passingRatenum" class="right floating-right">100%</div>
                                </div>
                                <div class="line-row">
                                    <div class="left floating-left">
                                        <div class="point floating-left"></div>
                                        <div id="passingscore" class="text floating-left">Pass Score</div>
                                    </div>
                                    <div id="PassingScorenum" class="right floating-right">50</div>
                                </div>
                            </aside>

                            <div class="btn-start-container" style="display: none">
                                <a><label class="floating-left" id="Takethequiz">Back</label><span class="floating-left"></span><i class="floating-right"></i></a>
                            </div>
                            <div class="btn-again-container" style="display: none">
                                <a><label class="floating-left" id="Takethequizagain">Take the quiz again</label><span class="floating-left"></span><i class="floating-right"></i></a>
                            </div>
                            <div id="viewquiz" class="btn-again-container2 btn-takequiz-container" style="display: none">
                                <a><label class="floating-left" id="Takethequizview">Take the quiz view</label><span class="floating-left"></span><i class="floating-right"></i></a>
                            </div>
                            <div class="btn-print-container">
                                <a href="" target="_blank"><label class="floating-left" id="print_result">Print</label><span class="floating-left"></span><i class="floating-right"></i></a>
                            </div>
                            <div class="copywrite"><label class="floating-right"><i class="copyrights">All Rights Reserved for Dar Al-Manhal Publishers ©</i> <i class="year"></i></label><span class="floating-left"></span></div>
                        </div>
                    </div>
                </div>
            </section>
            <div id="printing-container" style="display:block;overflow: hidden;width: 100%;height: 100%">
                <section class="questions-main-container">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="content-container">
                        <div class="top-content">
<!--                            <div class="odddd" id="print_result">dsds</div>-->
                            <div class="correction-btn floating-right" onclick="correction();"></div>
                            <div class="fullscreen-buttons floating-right"></div>
                            <div class="fullscreen-buttons-min floating-right"></div>
                            <div class="information floating-right"></div>
                            <div class="question-title floating-left">
                                <label class="floating-left titlelang"></label>
                                <span id="title" class="floating-left">The Five Senses</span>
                            </div>
                            <div class="goto-container floating-right">
                                <div class="swiper-pagination1"></div>
                            </div>
                            <div class="time-of-question floating-right">
                                <div class="image floating-left"></div>
                                <div class="num floating-left timer-container"></div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="slider-main-container">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                </div>
                                <div class="feedback-question-container active" style="display: none">
                                    <div class="hamburger hamburger--spring js-hamburger">
                                        <div class="hamburger-box">
                                            <div class="hamburger-inner"></div>
                                        </div>
                                    </div>
                                    <div class="feedback-question-container-inner">
                                        <div class="left floating-left">
                                            <div class="point floating-left"></div>
                                            <div class="text floating-left">Feedback</div>
                                        </div>
                                        <textarea id="feedbackquestion" disabled class="aria"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        <div class="copywrite"><label class="floating-right"><i class="copyrights">All Rights Reserved for Dar Al-Manhal Publishers ©</i> <i class="year"></i></label><span class="floating-left"></span></div>                </div>-->
                </section>
            </div>
        </section>
    </main>
    <script src="../all/js/swiper.min.js" type="text/javascript"></script>
</body>
</html>
