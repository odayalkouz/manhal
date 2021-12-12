<?php
/*
 * Created by Dar Almanhal - Hussam Abu Khadijeh .
 * User: Hussam Abu Khadijeh
 * Date: 2/10/2016
 * Time: 10:26 AM
 */
include_once "includes/language.php";
?>
<script>
    $(document).ready(function(){
      //  window.widgetID
        $("#animation_object").html('<div id="demoImageAnimation">'+$("#"+window.widgetID+" .real-content").html()+'</div>');

        animated=$("#"+window.widgetID).find(".animated");
        if(animated[0] !=undefined && animated[0].hasAttribute("default-animation")){
            $(".jq_animation").first().attr("data-animation-type","default");
            $(".jq_animation").first().attr("data-animation",animated.attr("default-animation"));
        }
        if(animated!=null && animated!=undefined){
            if(animated.attr("data-animation")!="" && animated.attr("data-animation")!=undefined){
                arr=animated.attr("data-animation").split("@");
                html='<a class="line-row-d jq_animation selected" data-animation-type="click" data-animation="'+arr[0]+'" data-time="1000" data-sound="'+arr[2].replace(",","")+'"> <div class="delete-animation"><i class="flaticon-delete96"></i></div> <label class="floating-left lbl-data-a">Animation</label> <select class="ddl-animation-action txt-a jq_animation_type"> <option value="default">Default</option> <option value="click" selected="selected">On Click</option> <option value="timer">Timer</option> </select> </a>';
                $("#animation_container").append(html);
                if(arr[1]=='ture'){
                    $("#jq_timer").slideDown();
                }
            }
        }
    });
</script>
<div class="animation-image-container-popup">
    <div class="display-table">
        <div class="display-row">
            <div class="display-cell" id="animation_object">
<!--                <img src="books/temp/files/css/12.png" id="demoImageAnimation">-->
            </div>
        </div>
    </div>
    <div class="left-container floating-left">
        <div class="content-container" id="animation_container">
            <a class="line-row-d jq_animation selected" data-animation-type="default" data-animation="bounce" data-time="1000">
                <div class="delete-animation"><i class="flaticon-delete96"></i></div>
                <label class="floating-left lbl-data-a">Animation</label>
                <select class="ddl-animation-action txt-a jq_animation_type floating-left">
                    <option value="default">Default</option>
                    <option value="click">On Click</option>
                    <option value="timer">Timer</option>
                </select>
            </a>
        </div>
        <a class="add-animation-btn floating-right">Add</a>
    </div>
    <div class="right-container floating-right">
        <div class="line-row-d">
            <label class="floating-left lbl-data-a">Animation Type</label>
            <select id="animation_action" class="ddl-animation-type txt-c floating-left">
            <optgroup label="Attention Seekers">
                <option value="none">-------</option>
                <option value="bounce">bounce</option>
                <option value="flash">flash</option>
                <option value="pulse">pulse</option>
                <option value="rubberBand">rubberBand</option>
                <option value="shake">shake</option>
                <option value="swing">swing</option>
                <option value="tada">tada</option>
                <option value="wobble">wobble</option>
                <option value="jello">jello</option>
                <option value="holeOut">holeOut</option>
                <option value="holeOutIn">holeOutIn</option>
                <option value="swap">swap</option>
                <option value="bigEntrance">bigEntrance</option>
                <option value="hatch">hatch</option>
                <option value="floating">floating</option>
                <option value="tossing">tossing</option>
                <option value="menagerie">menagerie</option>
            </optgroup>
            <optgroup label="Bouncing Entrances">
                <option value="bounceIn">bounceIn</option>
                <option value="bounceInDown">bounceInDown</option>
                <option value="bounceInLeft">bounceInLeft</option>
                <option value="bounceInRight">bounceInRight</option>
                <option value="bounceInUp">bounceInUp</option>
            </optgroup>
            <optgroup label="Bouncing Exits">
                <option value="bounceOut">bounceOut</option>
                <option value="bounceOutIn">bounceOutIn</option>
                <option value="bounceOutDown">bounceOutDown</option>
                <option value="bounceOutDownUp">bounceOutDownUp</option>
                <option value="bounceOutLeft">bounceOutLeft</option>
                <option value="bounceOutLeftCenter">bounceOutLeftCenter</option>
                <option value="bounceOutRight">bounceOutRight</option>
                <option value="bounceOutRightCenter">bounceOutRightCenter</option>
                <option value="bounceOutUp">bounceOutUp</option>
                <option value="bounceOutUpDown">bounceOutUpDown</option>
                <option value="bounceToLeftStartFromRight">bounceToLeftStartFromRight</option>
                <option value="bounceToRightStartFromleft">bounceToRightStartFromleft</option>
                <option value="bounceToTopStartFromBottom">bounceToTopStartFromBottom</option>
                <option value="bounceToBottomStartFromTop">bounceToBottomStartFromTop</option>
            </optgroup>
            <optgroup label="Fading Entrances">
                <option value="fadeIn">fadeIn</option>
                <option value="fadeInDown">fadeInDown</option>
                <option value="fadeInDownBig">fadeInDownBig</option>
                <option value="fadeInLeft">fadeInLeft</option>
                <option value="fadeInLeftBig">fadeInLeftBig</option>
                <option value="fadeInRight">fadeInRight</option>
                <option value="fadeInRightBig">fadeInRightBig</option>
                <option value="fadeInUp">fadeInUp</option>
                <option value="fadeInUpBig">fadeInUpBig</option>
            </optgroup>
            <optgroup label="Fading Exits">
                <option value="fadeOut">fadeOut</option>
                <option value="fadeOutDown">fadeOutDown</option>
                <option value="fadeOutDownUp">fadeOutDownUp</option>
                <option value="fadeOutDownBig">fadeOutDownBig</option>
                <option value="fadeOutDownUpBig">fadeOutDownUpBig</option>
                <option value="fadeOutLeft">fadeOutLeft</option>
                <option value="fadeOutLeftRight">fadeOutLeftRight</option>
                <option value="fadeOutLeftBig">fadeOutLeftBig</option>
                <option value="fadeOutLeftRightBig">fadeOutLeftRightBig</option>
                <option value="fadeOutRight">fadeOutRight</option>
                <option value="fadeOutRightLeft">fadeOutRightLeft</option>
                <option value="fadeOutRightBig">fadeOutRightBig</option>
                <option value="fadeOutRightLeftBig">fadeOutRightLeftBig</option>
                <option value="fadeOutUp">fadeOutUp</option>
                <option value="fadeOutUpDown">fadeOutUpDown</option>
                <option value="fadeOutUpBig">fadeOutUpBig</option>
                <option value="fadeOutUpDownBig">fadeOutUpDownBig</option>
            </optgroup>
            <optgroup label="Flippers">
                <option value="flip">flip</option>
                <option value="flipInX">flipInX</option>
                <option value="flipInY">flipInY</option>
                <option value="flipOutX">flipOutX</option>
                <option value="flipOutInX">flipOutInX</option>
                <option value="flipOutY">flipOutY</option>
            </optgroup>
            <optgroup label="open">
                <option value="openDownLeft">openDownLeft</option>
                <option value="openUpLeft">openUpLeft</option>
                <option value="openDownRight">openDownRight</option>
                <option value="openUpLeft">openUpLeft</option>
                <option value="openUpRight">openUpRight</option>
                <option value="openDownLeftRetourn">openDownLeftRetourn</option>
                <option value="openDownRightRetourn">openDownRightRetourn</option>
                <option value="openUpLeftRetourn">openUpLeftRetourn</option>
                <option value="openUpRightRetourn">openUpRightRetourn</option>
                <option value="openDownLeftOut">openDownLeftOut</option>
                <option value="openDownRightOut">openDownRightOut</option>
                <option value="openUpLeftOut">openUpLeftOut</option>
                <option value="openUpRightOut">openUpRightOut</option>
            </optgroup>
            <optgroup label="Lightspeed">
                <option value="lightSpeedIn">lightSpeedIn</option>
                <option value="lightSpeedOut">lightSpeedOut</option>
                <option value="lightSpeedOutIn">lightSpeedOutIn</option>
            </optgroup>
            <optgroup label="puff">
                <option value="puffIn">puffIn</option>
                <option value="puffOut">puffOut</option>
                <option value="puffOutIn">puffOutIn</option>
            </optgroup>
            <optgroup label="expand">
                <option value="expandUp">expandUp</option>
                <option value="expandOpen">expandOpen</option>
            </optgroup>
            <optgroup label="twister">
                <option value="twisterInDown">twisterInDown</option>
                <option value="twisterInUp">twisterInUp</option>
            </optgroup>
            <optgroup label="vanish">
                <option value="vanishIn">vanishIn</option>
                <option value="vanishOut">vanishOut</option>
                <option value="vanishOutIn">vanishOutIn</option>
            </optgroup>
            <optgroup label="swash">
                <option value="swashOut">swashOut</option>
                <option value="swashOutIn">swashOutIn</option>
                <option value="swashIn">swashIn</option>
            </optgroup>
            <optgroup label="bomb">
                <option value="bombRightOut">bombRightOut</option>
                <option value="bombRightOutIn">bombRightOutIn</option>
                <option value="bombLeftOut">bombLeftOut</option>
                <option value="bombLeftOutIn">bombLeftOutIn</option>
            </optgroup>
            <optgroup label="boing">
                <option value="boingInUp">boingInUp</option>
                <option value="boingOutDown">boingOutDown</option>
                <option value="boingOutInDown">boingOutInDown</option>
            </optgroup>
            <optgroup label="pull">
                <option value="pullUp">pullUp</option>
                <option value="pullDown">pullDown</option>
            </optgroup>
            <optgroup label="stretch">
                <option value="stretchLeft">stretchLeft</option>
                <option value="stretchRight">stretchRight</option>
            </optgroup>
            <optgroup label="Rotating Entrances">
                <option value="rotateIn">rotateIn</option>
                <option value="rotateFullWithOclock">rotateFullWithOclock</option>
                <option value="rotateFullreverceOclock">rotateFullreverceOclock</option>
                <option value="rotateFullWithOclockAlternate">rotateFullWithOclockAlternate</option>
                <option value="rotateFullreverceOclockAlternate">rotateFullreverceOclockAlternate</option>
                <option value="rotateInDownLeft">rotateInDownLeft</option>
                <option value="rotateInDownRight">rotateInDownRight</option>
                <option value="rotateInUpLeft">rotateInUpLeft</option>
                <option value="rotateInUpRight">rotateInUpRight</option>
                <option value="rotateDown">rotateDown</option>
                <option value="rotateDownUp">rotateDownUp</option>
                <option value="rotateLeft">rotateLeft</option>
                <option value="rotateLeftRight">rotateLeftRight</option>
                <option value="rotateRight">rotateRight</option>
                <option value="rotateRightLeft">rotateRightLeft</option>
                <option value="rotateUp">rotateUp</option>
                <option value="rotateUpDown">rotateUpDown</option>
            </optgroup>
            <optgroup label="Rotating Exits">
                <option value="rotateOut">rotateOut</option>
                <option value="rotateOutDownLeft">rotateOutDownLeft</option>
                <option value="rotateOutDownRight">rotateOutDownRight</option>
                <option value="rotateOutUpLeft">rotateOutUpLeft</option>
                <option value="rotateOutUpRight">rotateOutUpRight</option>
            </optgroup>
            <optgroup label="Sliding Entrances">
                <option value="slideInUp">slideInUp</option>
                <option value="slideInDown">slideInDown</option>
                <option value="slideInLeft">slideInLeft</option>
                <option value="slideInRight">slideInRight</option>
                <option value="slideDown">slideDown</option>
                <option value="slideDownUp">slideDownUp</option>
                <option value="slideLeft">slideLeft</option>
                <option value="slideLeftRight">slideLeftRight</option>
                <option value="slideRight">slideRight</option>
                <option value="slideRightLeft">slideRightLeft</option>
                <option value="slideUp">slideUp</option>
                <option value="slideUpDown">slideUpDown</option>
                <option value="slideLeftRetourn">slideLeftRetourn</option>
                <option value="slideRightRetourn">slideRightRetourn</option>
                <option value="slideUpRetourn">slideUpRetourn</option>
                <option value="slideExpandUp">slideExpandUp</option>
            </optgroup>
            <optgroup label="Sliding Exits">
                <option value="slideOutUp">slideOutUp</option>
                <option value="slideOutDown">slideOutDown</option>
                <option value="slideOutLeft">slideOutLeft</option>
                <option value="slideOutRight">slideOutRight</option>
            </optgroup>
            <optgroup label="Zoom Entrances">
                <option value="zoomIn">zoomIn</option>
                <option value="zoomInDown">zoomInDown</option>
                <option value="zoomInLeft">zoomInLeft</option>
                <option value="zoomInRight">zoomInRight</option>
                <option value="zoomInUp">zoomInUp</option>
            </optgroup>
            <optgroup label="perspective">
                <option value="perspectiveDown">perspectiveDown</option>
                <option value="perspectiveDownUp">perspectiveDownUp</option>
                <option value="perspectiveLeft">perspectiveLeft</option>
                <option value="perspectiveLeftRight">perspectiveLeftRight</option>
                <option value="perspectiveRight">perspectiveRight</option>
                <option value="perspectiveRightLeft">perspectiveRightLeft</option>
                <option value="perspectiveUp">perspectiveUp</option>
                <option value="perspectiveUpDown">perspectiveUpDown</option>
                <option value="perspectiveDownRetourn">perspectiveDownRetourn</option>
                <option value="perspectiveLeftRetourn">perspectiveLeftRetourn</option>
                <option value="perspectiveRightRetourn">perspectiveRightRetourn</option>
                <option value="perspectiveUpRetourn">perspectiveUpRetourn</option>
            </optgroup>
            <optgroup label="space">
                <option value="spaceOutUp">spaceOutUp</option>
                <option value="spaceOutUpDown">spaceOutUpDown</option>
                <option value="spaceOutRight">spaceOutRight</option>
                <option value="spaceOutRightLeft">spaceOutRightLeft</option>
                <option value="spaceOutDown">spaceOutDown</option>
                <option value="spaceOutDownUp">spaceOutDownUp</option>
                <option value="spaceOutLeft">spaceOutLeft</option>
                <option value="spaceOutLeftRight">spaceOutLeftRight</option>
                <option value="spaceInUp">spaceInUp</option>
                <option value="spaceInRight">spaceInRight</option>
                <option value="spaceInDown">spaceInDown</option>
                <option value="spaceInLeft">spaceInLeft</option>
            </optgroup>
            <optgroup label="tin">
                <option value="tinRightOut">tinRightOut</option>
                <option value="tinLeftOut">tinLeftOut</option>
                <option value="tinUpOut">tinUpOut</option>
                <option value="tinDownOut">tinDownOut</option>
                <option value="tinRightIn">tinRightIn</option>
                <option value="tinLeftIn">tinLeftIn</option>
                <option value="tinUpIn">tinUpIn</option>
                <option value="tinDownIn">tinDownIn</option>
            </optgroup>
            <optgroup label="Zoom Exits">
                <option value="zoomOut">zoomOut</option>
                <option value="zoomOutIn">zoomOutIn</option>
                <option value="zoomOutDown">zoomOutDown</option>
                <option value="zoomOutLeft">zoomOutLeft</option>
                <option value="zoomOutRight">zoomOutRight</option>
                <option value="zoomOutUp">zoomOutUp</option>
            </optgroup>
            <optgroup label="Specials">
                <option value="hinge">hinge</option>
                <option value="rollIn">rollIn</option>
                <option value="rollOut">rollOut</option>
                <option value="rollOutIn">rollOutIn</option>
                <option value="magic">magic</option>
                <option value="magicUp">magicUp</option>
            </optgroup>
                <optgroup label="shake">
                <option value="shake">shake</option>
                <option value="shake-little">shake-little</option>
                <option value="shake-slow">shake-slow</option>
                <option value="shake-horizontal">shake-horizontal</option>
                <option value="shake-vertical">shake-vertical</option>
                <option value="shake-crazy">shake-crazy</option>
                <option value="shake-hard">shake-hard</option>
                <option value="shake-rotate">shake-rotate</option>
                <option value="shake-opacity">shake-opacity</option>
                <option value="shake-chunk">shake-chunk</option>
            </optgroup>
        </select>
        </div>
        <div class="line-row-d">
            <form id="effect_sound_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
                <label class="floating-left lbl-data-a">Sound</label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label id="lblsound_effect" class="floating-left label-b"></label>
                    <input type="file" id="sound_effect" name="sound_effect" class="floating-left" onchange="uploadEffectSound()">
                </div>
            </form>
        </div>
        <div class="line-row-d" style="display: none;" id="jq_timer">
            <label class="lbl-data-a floating-left">Time</label>
            <input type="number" placeholder="Time" value="1000" class="txt-a number floating-left" id="animation_time" >
        </div>
        <div class="line-row-d">
            <label class="lbl-data-a floating-left" for="isindex">Infinite</label>
            <div class="section-check floating-left">
                <ul>
                    <li class="floating-left">
                        <label class="input-control checkbox floating-left">
                            <input type="checkbox" name="infinite" id="infinite" value="0">
                            <span class="check"></span>
                        </label>
                        <label for="infinite" class="text floating-left"></label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <a class="floating-right update-animation-btn " id="update_animation">Update</a>
</div>
