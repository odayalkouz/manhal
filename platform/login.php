<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}

if(isset($_SESSION["user"])){
    header('Location: index.php');

}
include_once "config.php" ;


include_once "includes/language.php";
?>
<?php
include "includes/header.php";
?>
<div class="site-container">
    <div class="content-container floating-left">
        <div class="admin-login" style="display: ;">
            <div class="popup-main-container">
                <div class="popup-tabel">
                    <div class="popup-row">
                        <div class="popup-cell">
                            <div class="popup-container">
                                <div class="popup-content">
                                    <div class="container">
                                        <section id="content">
                                            <form  id="admin_login_form">
                                                <h1><?=$Lang->Login;?></h1>
                                                <div>
                                                    <input type="text" placeholder="Username" required="" id="username" name="username">
                                                </div>
                                                <div>
                                                    <input type="password" placeholder="Password" required="" id="password" name="password">
                                                </div>
                                                <div>
                                                    <input type="button" onclick="login();" class="btn-a" id="admin_login" value="<?=$Lang->Login;?>"/>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include "includes/footer.php";
?>