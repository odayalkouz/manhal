<?php
/**
 * Created by PhpStorm.
 * User: khalid
 * Date: 15/07/2020
 * Time: 03:34 م
 */
$URL = $_SERVER['DOCUMENT_ROOT'].'/manhal/medialibrary';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["username"])) {
    header('Location:'.$URL.'/index.php');
    exit();

}
include_once $URL."/function.php";

?>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Media</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" type="image/png" sizes="96x96" href="themes/en/img/favicon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="themes/en/img/favicon.png">
    <link rel="stylesheet" href="themes/all/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="themes/all/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="themes/all/vendor/linearicons/style.css">
    <link rel="stylesheet" href="themes/en/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
</head>
<body>
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="themes/en/img/logo.svg" alt="Klorofil Logo"></div>
								<p class="lead"><?=$prosses->lang('Login_to_your_account');?></p>
							</div>
							<form method="post" action="api.php" target="_self" class="form-auth-small" >
                                <input type="hidden"   name="process" value="signin">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only"><?=$prosses->lang('Email');?></label>
									<input type="text" class="form-control" id="username"  name="username" value="" placeholder="<?=$prosses->lang('Email');?>">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only"><?=$prosses->lang('Edit_Type');?>Password</label>
									<input type="password" class="form-control" id="pass" name="pass" value="" placeholder="<?=$prosses->lang('Password');?>">
								</div>
								<div class="form-group clearfix">
									<label class="fancy-checkbox element-left">
										<input type="checkbox">
										<span><?=$prosses->lang('Remember_me');?></span>
									</label>
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block" href="index.php"><?=$prosses->lang('LOGIN');?></button>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay">
                            <img src="themes/en/img/loginpage.jpg" class="loginpage">
                        </div>
						<div class="content text"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
</html>
