<?php
/**
 * Created by Dar Al-Manhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 9/19/2016
 * Time: 9:41 AM
 */
?>
</main>
<footer>
    <div class="top-footer">
        <div class="center-piece footer-ipad-pro">
            <?php
            if(!$detect->isMobile() || $detect->isTablet())
            {
            ?>
            <div class="delivery-is-avalabel floating-left"><?= $Lang->Deliveryisavailableinallcountriesoftheworld?></div>
                <?php
            }
            ?>
            <div class="buy-container floating-right">
                <a class="floating-left"><div class="shine"></div> </a>
                <a class="floating-left"><div class="shine"></div></a>
                <a class="floating-left"><div class="shine"></div></a>
                <a class="floating-left"><div class="shine"></div></a>
            </div>
            <div class="payment-method floating-right"><?= $Lang->PayWith?></div>
        </div>
    </div>
    <div class="center-a-footer">
        <div class="center-piece">
            <?php
            if(!$detect->isMobile() || $detect->isTablet())
            {
            ?>
            <div class="left-footer floating-left display-inline-block">
                <div class="askOur-button floating-right">
                    <div class="floating-left icon-ask"></div>
                    <div class="floating-left">
                        <span class="text-left"><?= $Lang->EDUCATIONALADVISOR?></span>
                        <span class="text-left"><?= $Lang->Askouredcationaladvisornow?></span>
                    </div>
                    <div class="floating-right">
                        <a class="floating-right ask-button" style="display: none" href="<?=SITE_URL.$lang_code;?>/educationalinquiries"><?= $Lang->Ask?></a>
                    </div>
                </div>
                <div class="center-b-footer">
                    <a href="http://twitter.com/minimalmonkey" class="icon-button twitter"><i class="icon-twitter"></i><span></span></a>
                    <a href="http://facebook.com" class="icon-button facebook"><i class="icon-facebook"></i><span></span></a>
                    <a href="http://plus.google.com" class="icon-button google-plus"><i class="icon-google-plus"></i><span></span></a>
                    <div class="center-piece">
                        <div class="right-side floating-left">
                            <div class="floating-left newsletter"></div>
                            <label class="floating-left"><?= $Lang->NEWSLETTER ?></label>
                            <div class="relative-subscripe">
                                <input class="floating-left" type="text" id="txtMailSubscribe" placeholder="<?= $Lang->Enteryouremailaddress ?>">
                                <span class="floating-left"></span>
                                <a class="floating-right" onclick="addSubscribing();"><?= $Lang->Subscribe ?></a>
                            </div>
                        </div>
                        <div class="left-side floating-left">
                            <label class="floating-left"><?= $Lang->FOLLOWUS ?></label>
                            <div class="social-container floating-left">
                                <a title="<?=$Lang->Facebook;?>" class="facebook" target="_blank" href="https://www.facebook.com/daralmanhalpublishers/"><i></i><span></span></a>
                                <a title="<?=$Lang->Twitter;?>" class="twitter" target="_blank" href="https://twitter.com/dar_manhal"><i></i><span></span></a>
                                <a title="<?=$Lang->LinkedIn;?>" class="linkedin" target="_blank" href="https://www.linkedin.com/in/dar-almanhal-5016ba113?trk=hp-identity-name"><i></i><span></span></a>
                                <a title="<?=$Lang->Googleplus;?>" class="google" target="_blank" href="https://plus.google.com/112142188100849560488"><i></i><span></span></a>
                                <a title="<?=$Lang->Pinterest;?>" class="pinterest" target="_blank" href="https://www.pinterest.com/daralmanhal"><i></i><span></span></a>
                                <a title="<?=$Lang->Flickr;?>" class="flickr" target="_blank" href="https://www.flickr.com/photos/138422983@N05/"><i></i><span></span></a>
                                <a title="<?=$Lang->Vimeo;?>" class="vimeo" target="_blank" href="https://vimeo.com/user50812788"><i></i><span></span></a>
                                <a title="<?=$Lang->Youtube;?>" class="youtube" target="_blank" href="https://www.youtube.com/channel/UCHQkQ8ZFdArwWFRE8hmQ6Bg"><i></i><span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="floating-left display-inline-block right-footer">
            <label class="floating-left"><?= $Lang->USEFULLINKS?></label>
            <div class="right-links first floating-left">
                <ul>
                    <?php
                    if(!$detect->isMobile() || $detect->isTablet()) {
                        if ($lang_code == "en") {
                            ?>
                            <li><span class="floating-left"></span><a href="<?= SITE_URL; ?>"
                                                                      class="floating-left"><?= $Lang->Home ?></a></li>
                            <?php
                        } else {
                            ?>
                            <li><span class="floating-left"></span><a href="<?= SITE_URL . $lang_code; ?>"
                                                                      class="floating-left"><?= $Lang->Home ?></a></li>
                            <?php
                        }

                        ?>
                        <li><span class="floating-left"></span><a href="<?= SITE_URL . $lang_code; ?>/stories"
                                                                  class="floating-left"><?= $Lang->Stories ?></a></li>
                        <li><span class="floating-left"></span><a href="<?= SITE_URL . $lang_code; ?>/books"
                                                                  class="floating-left"><?= $Lang->Books ?></a></li>

                    <li><span class="floating-left"></span><a href="<?=SITE_URL.$lang_code;?>/features" class="floating-left"><?= $Lang->Features?></a></li>
                    <?php
                    }
                    ?>
                    <li><span class="floating-left"></span><a href="<?=SITE_URL.$lang_code;?>/galleries" class="floating-left"><?= $Lang->Galleries?></a></li>
                </ul>
            </div>
            <div class="right-links secound floating-left">
                <ul>
                    <?php
                    if(!$detect->isMobile() || $detect->isTablet())
                    {
                    ?>
                    <li><span class="floating-left"></span><a href="<?=SITE_URL.$lang_code;?>/applications" class="floating-left"><?=$Lang->Application?></a></li>
                    <li><span class="floating-left"></span><a href="<?=SITE_URL.$lang_code;?>/our-partners" class="floating-left"><?=$Lang->Partners?></a> </li>
                    <?php
                    }
                    ?>
                    <li><span class="floating-left"></span><a href="<?=SITE_URL.$lang_code;?>/news" class="floating-left"><?= $Lang->News?></a> </li>
                    <li><span class="floating-left"></span><a href="<?=SITE_URL.$lang_code;?>/events" class="floating-left"><?= $Lang->Events?></a> </li>
                    <?php
                    if(!$detect->isMobile() || $detect->isTablet())
                    {
                    ?>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="right-links third floating-left">
                <ul>
                    <li><span class="floating-left"></span><a href="<?=SITE_URL.$lang_code;?>/subscribe" class="floating-left"><?= $Lang->Subscribe?></a></li>
                    <li style="display: none"><span class="floating-left"></span><a href="<?=SITE_URL.$lang_code;?>/faq" class="floating-left"><?= $Lang->FAQ?></a></li>
                    <li><span class="floating-left"></span><a href="<?=SITE_URL.$lang_code;?>/contact-us" class="floating-left"><?= $Lang->ContectUs?></a></li>
                    <li><span class="floating-left"></span><a href="<?=SITE_URL.$lang_code;?>/about-us" class="floating-left"><?= $Lang->AboutUs ?></a></li>
                    <li><span class="floating-left"></span><a href="<?=SITE_URL.$lang_code;?>/sitemap" class="floating-left"><?= $Lang->Sitemap?></a> </li>
                    <li><span class="floating-left"></span><a href="<?=SITE_URL.$lang_code;?>/careers" class="floating-left"><?= $Lang->careers?></a> </li>
                </ul>
            </div>
            </div>
        </div>
    </div>
    <?php
    if(!$detect->isMobile() || $detect->isTablet())
    {
    ?>
    <div class="bottom-footer floating-right">
        <div class="center-piece">
            <div class="img-a floating-left"></div>
            <span class="floating-left" id="lblCopyRight"><?= $Lang->Copyrite ?> © <?php echo date("Y") ?></a></span>
            <ul class="floating-right">
                <li class="floating-left"><a href="<?=SITE_URL.$lang_code;?>/privacy-policy"><?= $Lang->privacyPolicy?></a></li>
                <i class="floating-left">|</i>
                <li class="floating-left"><a href="<?=SITE_URL.$lang_code;?>/terms-and-conditions"><?= $Lang->TermsConditions?></a></li>
                <i class="floating-left">|</i>
                <li class="floating-left"><a href="<?=SITE_URL.$lang_code;?>/return-policy"><?= $Lang->Return_Policy?></a></li>
            </ul>
        </div>
        </div>
        <?php
    }
    ?>
    <div class="back-to-top">
        <a href="#section05">
            <span></span>
        </a>
    </div>
    <?php
    if(!$detect->isMobile() || $detect->isTablet())
    {
    ?>
    <form id="feedback_form">
        <div class="feedback-main-container fade-top-feedback">
            <div class="title"><?= $Lang->GetInTouch ?></div>
            <div class="close-container floating-right">
                <a class="close floating-right"><i></i></a>
            </div>
            <input name="name" id="feedback_name" class="txt-a" type="text" placeholder="<?= $Lang->Name?>">
            <input name="email" id="feedback_email" class="txt-a" type="email" placeholder="<?= $Lang->EMail?>">
            <div class="ddl-container-a">
                <label id="lblfeedbackddlCountry"><?= $Lang->Idea ?></label>
                <select id="feedbackddlCountry" name="feedback_idea">
                    <option><?= $Lang->Idea ?></option>
                    <option><?= $Lang->Error ?></option>
                    <option><?= $Lang->Sugestion ?></option>
                    <option><?= $Lang->Note ?></option>
                    <option><?= $Lang->Others ?></option>
                </select>
            </div>
            <input class="txt-a" name="subject" id="feedback_subject" type="text" placeholder="<?= $Lang->Subject?>">
            <textarea name="message" id="feedback_message" placeholder="<?= $Lang->Message;?>"></textarea>
            <div class="buttons-container">
                <input type="reset" class="floating-left" value="<?= $Lang->Reset?>">
                <input type="button" class="floating-left" value="<?= $Lang->Send?>">
            </div>
        </div>
        <a class="feedback-button-container">
            <label class="feedback-button floating-right"><?= $Lang->Feedback?></label>
            <label class="arrow-feedback floating-right"></label>
        </a>
    </form>
        <?php
    }
    ?>
</footer>
</body>
</html>
