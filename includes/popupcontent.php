
<div class="popup-container">
    <div class="popup-content sign-in-container Popup">
        <div class="left-container floating-left">
            <div class="welcome-manhal text-left"><?= $Lang->WelcometoDarAlManhalPlatform; ?></div>
            <p class="text-left"><?= $Lang->WelcometoDarAlManhalP1; ?></p>
            <p class="text-left"><?= $Lang->WelcometoDarAlManhalP2; ?></p>
        </div>
        <div class="right-container floating-left">
            <div class="close-container">
                <a class="close floating-right"><i></i></a>
            </div>
            <div class="main-title"><?= $Lang->Login; ?></div>
            <div class="sub-title"><?= $Lang->WelcomeLogin; ?></div>
            <div class="social-btns">
                <a href="javascript:fb_login('social-facebook');" class="facebook"><i></i><span><?= $Lang->Facebook?></span></a>
                <a href="<?= SITE_URL; ?>regsocial/google/getUser.php" class="google"><i></i><span><?= $Lang->Google;?></span></a>
                <a href="<?= SITE_URL; ?>twitter/callBack.php" class="twitter"><i></i><span><?= $Lang->Twitter;?></span></a>
            </div>
            <div class="or-container">
                <div class="line"></div>
                <div class="text"><?= $Lang->Or;?></div>
                <div class="line"></div>
            </div>
            <input type="text" name="login_email" id="login_email" placeholder="<?= $Lang->EmailAddress;?>">
            <input type="password" name="login_pass" id="login_pass" placeholder="<?= $Lang->Password;?>">
            <div class="display-block">
                <div class="sign-confirm">
                    <input id="keep-login" type="checkbox" name="keepLogin" class="floating-left">
                    <label for="keep-login" class="floating-left"><?=$Lang->Keepmesignin;?></label>
                </div>
                <input type="button" value="<?= $Lang->Login; ?>" id="login" class="loginbtn clear-both"/>
            </div>
            <a class="buttom-link btn-popup"  id="forgett_pass" data-type="ContainerB"><?= $Lang->ForgetMyPass;?></a>
            <div class="bottom-container">
                <a data-type="ContainerA" class="btn-popup">
                    <div class="btn-a floating-left"></div>
                    <div class="display-inline-block">
                        <label><b><?= $Lang->Createnewaccount;?></b><br/><?= $Lang->Donthaveanaccount;?><b class="btn-popup" data-type="ContainerB"><?=$Lang->Signupnow;?></b></label>
                    </div>
                </a>
            </div>
            <a class="btn-popup signupmobile" data-type="ContainerA"><?= $Lang->Signupnow;?></a>
        </div>
    </div>
    <div class="popup-content sign-up-container PopupA">
        <div class="left-container floating-left">
            <div class="welcome-manhal text-left"><?= $Lang->WelcometoDarAlManhalPlatform; ?></div>
            <p class="text-left"><?= $Lang->WelcometoDarAlManhalP1; ?></p>
            <p class="text-left"><?= $Lang->WelcometoDarAlManhalP2; ?></p>
        </div>
        <div class="right-container floating-left">
            <div class="close-container">
                <a class="close floating-right"><i></i></a>
            </div>
            <div class="main-title"><?= $Lang->Createnewaccount ?></div>
            <div class="sub-title"></div>
            <input type="text" placeholder="<?= $Lang->EmailAddress; ?>" id="reg_email"
                   name="reg_email">
            <input type="text" placeholder="<?= $Lang->UserName; ?>" id="reg_username"
                   name="reg_username">
            <input type="password" placeholder="<?= $Lang->Password; ?>" id="reg_pass" name="reg_pass">
            <input type="password" placeholder="<?= $Lang->Cpassword; ?>" id="reg_cpass"
                   name="reg_cpass">
            <div class="display-block">
                <input type="button" value="<?= $Lang->SignUp ?>" id="reg_submit" class="clear-both"/>
            </div>
            <div class="buttom-link-container"><?= $Lang->Bycreatingaccountyouagree ?>
                <a
                    href="<?= SITE_URL . $lang_code; ?>/terms-and-conditions" class="buttom-link"><?= $Lang->TermsofUse ?></a>
                <a data-type="Container" class="btn-popup siginpmobile"><?= $Lang->Signinhere ?></a>
            </div>
            <div class="bottom-container">
                <a>
                    <div class="btn-a"></div>
                    <label><b><?= $Lang->signintoyouraccount;?></b><br/><?= $Lang->Alreadyhaveanaccount;?><b class="btn-popup" data-type="Container"><?=$Lang->SigninhereA;?></b></label>
                </a>
            </div>
        </div>
    </div>
    <div class="popup-content change-password-container">
        <div class="left-container floating-left"></div>
        <div class="right-container floating-left">
            <div class="close-container">
                <a class="close floating-right"><i></i></a>
            </div>
            <div class="main-title"><?= $Lang->ChangePassword ?></div>
            <div class="sub-title"><?= $Lang->Enteryourpasswordbelow ?></div>
            <input type="password" placeholder="<?= $Lang->OldPassword ?>" name="oldpass" id="oldpass">
            <input type="password" placeholder="<?= $Lang->NewPassword ?>" name="newpass" id="newpass">
            <input type="password" placeholder="<?= $Lang->RetypeNewPassword ?>" name="cpass"
                   id="cpass">
            <input type="button" value="<?= $Lang->Update ?>" id="changepass">
            <a class="buttom-link"><?= $Lang->gobacktoLogin ?></a>
        </div>
    </div>
    <div class="popup-content reset-password-container PopupB">
        <div class="left-container floating-left"></div>
        <div class="right-container floating-left">
            <div class="close-container">
                <a class="close floating-right"><i></i></a>
            </div>
            <div class="main-title"><?= $Lang->ResetYourPassword ?></div>
            <div class="sub-title"><?= $Lang->resetyourpasswordtitle ?></div>
            <input type="text" name="forget_email" id="forget_email"  placeholder="<?= $Lang->EmailAddress ?>">
            <input type="button" id="forget_send" value="<?= $Lang->Send; ?>">
            <a class="buttom-link btn-popup" data-type="Container"><?= $Lang->gobacktoLoginpage ?></a>
        </div>
    </div>
</div>