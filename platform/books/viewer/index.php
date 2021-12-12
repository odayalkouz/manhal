<?php
$sql = "SELECT `books`.*,`categories`.* FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`bookid`=".$_GET['bookid'];
$result=$con->query($sql);
$book=mysqli_fetch_assoc($result);


if($book["width"]>980){
    $bookSize="width";
}else{
    $bookSize="height";
}

if(strtolower($book['language'])=="en"){
    $bookType="Student's Book";
    $bookDesc="Dar Almanhal E-book,E-Book,Online Book,interactive book";
}elseif(strtolower($book['language'])=='fr'){
    $bookType="Student's Book";
    $bookDesc="Dar Almanhal E-book,E-Book,Online Book,interactive book";
}else{//ar
    $bookType="كتاب الطالب";
    $bookDesc="كتاب الكتروني,كتب الكترونية,كتاب تفاعلي,دار المنهل";
}

$BookURL=SITE_URL.$lang_code."/books/view/".$_GET["bookid"].urlencode($book['name']);


if($book['language']=="Ar"){
    $bookLang="اللغة العربية";
}elseif($book['language']=="En"){
    $bookLang="English";
}else{
    $bookLang="French";
}

$bookThumb=SITE_URL."platform/books/".$book['bookid']."/cover.jpg";
$Cfirst=ucfirst($book['language']);
?>
<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<title><?=$book['name'];?></title>
    <BASE href="<?=SITE_URL;?>/platform/books/<?=$_GET['bookid'];?>/index.html">
    <meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no,shrink-to-fit=no">
	<meta name="description" class="meta_description" content="<?=$book['name'];?>,<?=$bookDesc;?>">
	<meta name="keywords" class="meta_keywords" content="<?=$book['name'];?>,<?=$bookDesc;?>">
	<meta property="og:site_name" class="meta_title" content="<?=$book['name'];?>,<?=$bookDesc;?>">
	<meta http-equiv="content-language" content="en">
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<!-- Title -->
	<meta id="metaOgTitle" class="meta_title" content="<?=$book['name'];?>">
	<meta name="title" class="meta_title" content="<?=$book['name'];?>">
	<meta property="og:title" class="meta_title" content="<?=$book['name'];?>">
	<meta name="DC.title" class="meta_title" content="<?=$book['name'];?>">
	<meta name="twitter:label1" class="meta_title" content="<?=$book['name'];?>">
	<meta name="twitter:title" class="meta_title" content="<?=$book['name'];?>">
	<!-- Description -->
	<meta id="metaOgDescription" class="meta_description" content="<?=$book['name'];?>,<?=$bookDesc;?>">
	<meta itemprop="description" class="meta_description" content="<?=$book['name'];?>,<?=$bookDesc;?>">
	<meta property="og:description" class="meta_description" content="<?=$book['name'];?>,<?=$bookDesc;?>">
	<meta name="twitter:description" class="meta_description" content="<?=$book['name'];?>,<?=$bookDesc;?>">
	<meta name="twitter:label2" class="meta_description" content="<?=$book['name'];?>,<?=$bookDesc;?>">
	<meta property="og:type"  content="website">
	<!-- Image -->
	<meta id="metaOgImage" class="meta_thumb" content="<?=$bookThumb;?>">
	<meta itemprop="image" class="meta_thumb" content="<?=$bookThumb;?>">
	<meta name="image" class="meta_thumb" content="<?=$bookThumb;?>">
	<meta property="og:image" class="meta_thumb" content="<?=$bookThumb;?>">
	<meta name="twitter:image:src" class="meta_thumb" content="<?=$bookThumb;?>">
	<meta name="twitter:image" class="meta_thumb" content="<?=$bookThumb;?>">
	<link rel="image_src" class="meta_thumb_href" href="<?=$bookThumb;?>">
	<meta name="thumbnail" class="meta_thumb" content="<?=$bookThumb;?>">
	<!-- Url -->
	<meta id="metaOgUrl" class="meta_url" content="<?=$BookURL;?>">
	<meta name="url" class="meta_url" content="<?=$BookURL;?>">
	<meta property="og:url" class="meta_url" content="<?=$BookURL;?>">
	<meta name="twitter:url" class="meta_url" content="<?=$BookURL;?>">
	<!-- Keywords -->
	<meta name="keywords" class="meta_keyword" content="<?=$book['name'];?>,<?=$bookDesc;?>">
	<meta name="news_keywords" content="<?=$book['name'];?>,<?=$bookDesc;?>">
	<meta name="DC.keywords" content="<?=$book['name'];?>,<?=$bookDesc;?>">
	<link data-type="favicon" href="<?=SITE_URL;?>platform/books/viewer/themes/Brown-<?=$Cfirst;?>/images/favicon.ico" type="image/x-icon" rel="icon"/>
	<link href="<?=SITE_URL;?>platform/books/viewer/themes/Brown-<?=$Cfirst;?>/css/style.css?temp=23" rel="Stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>platform/books/viewer/themes/Brown-<?=$Cfirst;?>/css/slick.css"/>
	<link rel="stylesheet" type="text/css"  href="<?=SITE_URL;?>platform/books/viewer/themes/Brown-<?=$Cfirst;?>/css/slick-theme.css"/>
	<!--<link href="themes/Brown-En/css/size.css?temp=19" rel="Stylesheet" media="screen and (max-width:1366px)" type="text/css"/>-->
	<link href="<?=SITE_URL;?>platform/books/viewer/themes/Brown-<?=$Cfirst;?>/css/size.css?temp=23" rel="Stylesheet" type="text/css"/>
	<script>
        window.bookSize="<?=$bookSize;?>";
        window.bookid="<?=$_GET["bookid"];?>";
		// if ('serviceWorker' in navigator) {
		// 	navigator.serviceWorker.register('sw.js').then(function(reg) {
		// 		if(reg.installing) {
		// 			console.log('Service worker installing');
		// 		} else if(reg.waiting) {
		// 			console.log('Service worker installed');
		// 		} else if(reg.active) {
		// 			console.log('Service worker active');
		// 		}
        //
		// 	}).catch(function(error) {
		// 		// registration failed
		// 		console.log('Registration failed with ' + error);
		// 	});
		// }
	</script>
    <script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/js/jquery.js"></script>
    <script async src="<?=SITE_URL;?>platform/books/<?=$_GET["bookid"];?>/js/data.js"></script>

</head>
<body id="bodys">
	<div class="loader-start-browsing">
		<div class="logo-loader"></div>
		<div class="logo-text" style="display: none"></div>
		<div class="logo-text1" style="display: none"></div>
	</div>
	<div class="exit-full-screen-container1">
		<a class="exit-full-screen" title="minimize"></a>
	</div>
	<div  class="viewport-image"></div>
	<audio muted="muted" autoplay="" class="jq_audio" controls style="display: none;" id="slide" status="play"><source src="<?=SITE_URL;?>platform/books/viewer/sounds/page-flip-02.mp3" type="audio/mpeg"></audio>
	<audio muted="muted" autoplay="" class="jq_audio" controls style="display: none;" id="sound_over" status="play"><source src="<?=SITE_URL;?>platform/books/viewer/sounds/over.mp3" type="audio/mpeg"></audio>
	<audio muted="muted" autoplay="" class="jq_audio" controls style="display: none;" id="sound_menu" status="play"><source src="<?=SITE_URL;?>platform/books/viewer/sounds/menu.mp3" type="audio/mpeg"></audio>
	<audio muted="muted" autoplay="" class="jq_audio" controls style="display: none;" id="sound_addnote" status="play"><source src="<?=SITE_URL;?>platform/books/viewer/sounds/addnote.mp3" type="audio/mpeg"></audio>
	<audio muted="muted" autoplay="" class="jq_audio" controls style="display: none;" id="sound_delete" status="play"><source src="<?=SITE_URL;?>platform/books/viewer/sounds/delete.mp3" type="audio/mpeg"></audio>
	<audio muted="muted" autoplay="" class="jq_audio" controls style="display: none;" id="sound_opennote" status="play"><source src="<?=SITE_URL;?>platform/books/viewer/sounds/opennote.mp3" type="audio/mpeg"></audio>
	<audio muted="muted" autoplay="" class="jq_audio" controls style="display: none;" id="sound_save" status="play"><source src="<?=SITE_URL;?>platform/books/viewer/sounds/save.mp3" type="audio/mpeg"></audio>
	<audio muted="muted" autoplay="" class="jq_audio" controls style="display: none;" id="sound_close" status="play"><source src="<?=SITE_URL;?>platform/books/viewer/sounds/close.mp3" type="audio/mpeg"></audio>
	<div class="loader-main-container" style="display:none">
		<div class="loader-container">
			<div class="book__pages">
				<div class="book__page book__page--left"></div>
				<div class="book__page book__page--right"></div>
				<div class="book__page book__page--right book__page--animated"></div>
				<div class="book__page book__page--right book__page--animated"></div>
				<div class="book__page book__page--right book__page--animated"></div>
				<div class="book__page book__page--right book__page--animated"></div>
				<div class="book__page book__page--right book__page--animated"></div>
				<div class="book__page book__page--right book__page--animated"></div>
				<div class="book__page book__page--right book__page--animated"></div>
				<div class="book__page book__page--right book__page--animated"></div>
				<div class="book__page book__page--right book__page--animated"></div>
				<div class="book__page book__page--right book__page--animated"></div>
			</div>
		</div>
	</div>
	<div class="activation-popup-main-container" style="display: none;">
		<div class="popup-tabel">
			<div class="popup-row">
				<div class="popup-cell">
		<div class="activation-popup-content" id="activation" style="display: block">
			<div class="head">
				<a class="close-info-popup floating-left" onclick="cloaseActivation();"> </a>
				<div class="title"><?=$Lang->ActivateAccount;?></div>
			</div>
			<div class="input-content">
				<p><?=$Lang->Youfinishedbrowsingfreepages;?></p>
				<p><a href="https://www.manhal.com/<?=$Cfirst;?>/subscribe" class="activation-link"><?=$Lang->Subscribenow;?></a><?=$Lang->orenteractivationcode;?></p>
			</div>
			<div class="activation-code">
				<label class="floating-left"><?=$Lang->ActivationCode;?></label>
				<input id="activate_code" class="floating-left" type="text" placeholder="<?=$Lang->ActivationCode;?>">
			</div>
			<div class="button-container">
				<div class="line-left floating-right"></div>
				<a id="activate"  class="button floating-right"><?=$Lang->GO;?></a>
				<div class="line-right floating-right"></div>
			</div>
		</div>
	</div>
			</div>
		</div>
	</div>
	<div class="popup-information-main-container">
		<div class="popup-information-white-content">
			<div class="head">
				<h3 class="floating-right"><?=$Lang->Informationcard;?></h3>
				<a class="close-info-popup floating-left"></a>
			</div>
			<div class="content">
				<div class="line-row">
					<div class="lbl-data-a floating-right"><?=$Lang->BookTitle;?> :</div>
					<div id="book_name" class="text-data-a floating-right"><?=$book['name'];?></div>
				</div>
				<div class="line-row">
					<div class="lbl-data-a floating-right"><?=$Lang->BookType;?> :</div>
					<div class="text-data-a floating-right"><?=$bookType;?></div>
				</div>
				<div class="line-row">
					<div class="lbl-data-a floating-right"><?=$Lang->Category;?> :</div>
					<div id="book_category" class="text-data-a floating-right"><?=$book['name_' . strtolower($book['language'])];?></div>
				</div>
				<div class="line-row">
					<div class="lbl-data-a floating-right left"><?=$Lang->Author;?> :</div>
					<div id="book_author" class="right floating-right">
						<div class="text-data-a floating-right"><?=$book['author_'.strtolower($book['language'])];?></div>
					</div>
				</div>
				<div class="line-row">
					<div class="lbl-data-a floating-right"><?=$Lang->PublishYear;?> :</div>
					<div id="book_publishyear" class="text-data-a floating-right"><?=$book['year'];?></div>
				</div>
				<div class="line-row">
					<div class="lbl-data-a floating-right"><?=$Lang->Language;?> :</div>
					<div id="book_language" class="text-data-a floating-right"><?=$bookLang;?></div>
				</div>
			</div>
		</div>
	</div>
	<div class="do-you-know-popup-container" style="display:none;">
		<div class="popup-tabel">
			<div class="popup-row">
				<div class="popup-cell">
		<div class="do-you-know-content">
			<div class="letter">
				<div class="head-container">
					<div id="douknow_title" class="title floating-right"><?=$Lang->information;?></div>
					<div class="close left"></div>
				</div>
				<div class="last-content">
					<div class="text-container floating-right tow-a">
						<div id="douknow_p"></div>
					</div>
					<div class="image-container floating-right tow-b">
						<img id="douknow_img" src="" alt="cover">
					</div>
				</div>
			</div>
		</div>
	</div>
			</div>
		</div>
	</div>
	<div class="sign-popup-container" style="display: none;">
		<div class="popup-tabel">
			<div class="popup-row">
				<div class="popup-cell">
		<div class="signin-popup-content" id="SignIn" style="display: block">
			<div class="head">
				<div class="title">Sign In</div>
				<a class="close-info-popup floating-left"></a>
			</div>
			<div class="input-content">
				<div class="row-content">
					<div class="icon-email floating-left"></div>
					<div class="split floating-left"></div>
					<input class="floating-left" id="login_email" type="email" placeholder="E-mail">
				</div>
				<div class="row-content">
					<div class="icon-pass floating-left"></div>
					<div class="split floating-left"></div>
					<input class="floating-left" id="login_pass" type="password" placeholder="Password">
				</div>
				<a class="forget-pass-btn" onclick="Openforgetpass();"><?=$Lang->ForgetMyPass;?></a>
			</div>
			<div class="button-container">
				<div class="line-left floating-left"></div>
				<a id="login_button" class="button floating-left"><?=$Lang->signin;?></a>
				<div class="line-right floating-left"></div>
			</div>
			<div class="bottom-content">
				<div class="inner-center">
					<label class="floating-left"><?=$Lang->Alreadyhaveanaccount;?></label>
					<a class="floating-left" onclick="OpenSignUp();"><?=$Lang->SignUp;?></a>
				</div>
			</div>
		</div>
		<div class="signin-popup-content sign-up" id="SignUp" style="display:none">
			<div class="head">
				<div class="title"><?=$Lang->SignUp;?></div>
				<a class="close-info-popup floating-left"></a>
			</div>
			<div class="input-content">
				<div class="row-content">
					<div class="icon-email floating-left"></div>
					<div class="split floating-left"></div>
					<input class="floating-left" id="signup_email" type="email" placeholder="E-mail">
				</div>
				<div class="row-content">
					<div class="icon-pass floating-left"></div>
					<div class="split floating-left"></div>
					<input class="floating-left" id="signup_pass" type="password" placeholder="Password" >
				</div>
				<div class="row-content">
					<div class="icon-pass floating-left"></div>
					<div class="split floating-left"></div>
					<input class="floating-left" id="signup_cpass" type="password" placeholder="Confirm Password" >
				</div>
			</div>
			<div class="activation-code">
				<label class="floating-left"><?=$Lang->ActivationCode;?></label>
				<input class="floating-left" id="signup_code" type="text" placeholder="Activation Code">
			</div>
			<a href="https://www.manhal.com/<?=$Cfirst;?>/subscribe" target="_blank" class="activation-link"><?=$Lang->Subscribenowgetactivation;?></a>
			<div class="button-container">
				<div class="line-left floating-left"></div>
				<a id="signup_button" class="button floating-left"><?=$Lang->SignUp;?></a>
				<div class="line-right floating-left"></div>
			</div>
			<div class="bottom-content">
				<div class="inner-center">
					<label class="floating-left"><?=$Lang->Alreadyhaveanaccount;?></label>
					<a class="floating-left" onclick="OpenSignIn();"><?=$Lang->SigninhereA;?></a>
				</div>
			</div>
		</div>
		<div class="forget-password-content" id="ForgetPass" style="display: none">
			<div class="head">
				<a class="close-info-popup floating-left"></a>
				<div class="title"><?=$Lang->ResetYourPassword;?></div>
			</div>
			<div class="paragraph"><?=$Lang->resetyourpasswordtitle;?></div>
			<div class="input-content">
				<div class="row-content">
					<div class="icon-email floating-left"></div>
					<div class="split floating-left"></div>
					<input class="floating-left" id="forget_email" type="email" placeholder="E-mail">
				</div>
				<a class="back-btn" onclick="OpenSignIn();"><?=$Lang->gobacktoLoginpage;?></a>
			</div>
			<div class="bottom-content">
				<a id="forget_button" class="button"><?=$Lang->Send;?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="popup-enrishments-container" style="display:none">
		<div class="after-close-full" style="display: none">
			<a class="close-index-popup1"></a>
			<a class="full-screen-index-popup1" onclick="launchFullscreenEnrishments()"></a>
		</div>
		<div class="container-popup" id="container-popup">
			<div class="exit-full-screen-container">
				<a class="exit-full-screen button-animation" title="Exit fullscreen"></a>
				<a class="exit-exit button-animation" title="Exit"></a>
			</div>
			<div class="popup-header">
				<a class="close-index-popup button-animation"></a>
				<a class="fullscreen-popup button-animation" onclick="launchFullscreenEnrishments()"></a>
				<i class="category-enrishments floating-right image"></i>
				<div class="title-enrichments floating-right"></div>
			</div>
			<div id="popup-content-a" class="popup-content-a">
				<div class="loader-inpopup">
					<div class="loader-in">
						<svg class="circular" viewBox="25 25 50 50">
							<circle class="path" cx="50" cy="50" stroke="red" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
						</svg>
					</div>
				</div>
				<div class="inner-content">
				</div>
			</div>
			<!--add enrichment here (audio,video,img,iframe)-->
		</div>
	</div>
	<button onclick="closetab();" class="exit-tab"></button>
	<section class="viewer-container">
		<div class="vertical-center slider thump-slider" style="display: none" id="thumb_container">
		</div>
		<div class="exit-full-screen" title="Exit fullscreen"></div>
		<div class="third-section-viewer">
			<!--tow-page-->
			<div class="book-viewer-container" id="book-viewer-container">
				<div class="content-setting-mobile">
					<div class="content-mobile"></div>
				</div>
				<section id="content">
					<div id="canvas">
						<div class="magazine-viewport" id="magazine-viewport">
							<div class="bookmark-ribbon" style="display: none;"></div>
							<div class="container">
								<div class="magazine">
								</div>
							</div>
						</div>
					</div>
				</section>
				<div class="absolute-enrichmentsbook-page-popup" style="display: none">
					<div class="popup-tabel">
						<div class="popup-row">
							<div class="popup-cell">
								<div class="enrichmentsbook-page-popup jq_noclose fade-bottom">
									<div class="head">
										<div class="title floating-left"><?=$Lang->BookEnrichments;?></div>
										<a class="close floating-right"></a>
									</div>
									<div class="enrichmentbook-container" id="enrichments-book">
										<div class="accordion js-accordion" id="js-accordion">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="absolute-index-page-popup" style="display: none">
					<div class="popup-tabel">
						<div class="popup-row">
							<div class="popup-cell">
								<div class="index-page-popup jq_noclose fade-bottom">
									<div class="head">
										<div class="title floating-left"><?=$Lang->BookIndex;?></div>
										<a class="close floating-right"></a>
									</div>
									<div class="index-container" id="index-book">
										<div class="accordion js-accordion" id="js-accordion2">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="new-footer-design" id="footer-main-icons">
					<div class="enrichments-page-popup jq_noclose fade-bottom">
						<div class="head">
							<div class="title floating-left"><?=$Lang->Enrichments;?></div>
							<a class="close floating-right"></a>
						</div>
						<div class="enrichment-container" id="enrichments">
                            <?=$Lang->Enrichments;?>
						</div>
					</div>
					<div class="qrcode-page-popup jq_noclose fade-bottom" >
						<div class="head">
							<div class="title"><?=$Lang->QRCode;?></div>
							<a class="close floating-right"></a>
						</div>
						<div class="inner" id="qrcode"></div>
					</div>
					<div class="search-content-page-popup jq_noclose fade-bottom" >
						<div class="head">
							<a class="close floating-right"></a>
							<div class="title floating-left">
								<input class="floating-left" type="text" id="searchtext" placeholder="<?=$Lang->search;?>">
								<a class="go-search floating-right" id="searchbutton"><i></i></a>
							</div>
						</div>
						<div class="content-search">
							<div class="vertical-center slider search-slider" style="display: none" id="search_container">
							</div>
						</div>
					</div>
					<div class="bookmark-content-page-popup jq_noclose fade-bottom" >
						<div class="head">
							<a class="close floating-right"></a>
							<div class="title floating-left">
                                <?=$Lang->Bookmarks;?>
							</div>
						</div>
						<div class="content-bookmark">
							<div class="vertical-center slider bookmark-slider" style="display: none" id="bookmark_container">

							</div>
						</div>
					</div>
					<div class="note-content-page-popup jq_noclose fade-bottom" >
						<div class="head">
							<a class="close floating-right"></a>
							<div class="title"><?=$Lang->Notes;?></div>
						</div>
						<div class="inner notebook-content"></div>
					</div>
					<div class="pen-page-popup jq_noclose fade-bottom">
						<div class="row-head"><a class="floating-right minmize"></a></div>
						<div class="row-a">
							<a class="floating-left jq_color color-1 active" color="#000000"><i></i></a>
							<a class="floating-left jq_color color-2" color="#ec008c"><i></i></a>
							<a class="floating-left jq_color color-3" color="#f7941d"><i></i></a>
							<a class="floating-left jq_color color-4" color="#28abe2"><i></i></a>
							<a class="floating-left jq_color color-5" color="#33b451"><i></i></a>
							<a class="floating-left jq_color color-6" color="#ed1e25"><i></i></a>
						</div>
						<div class="row-b">
							<a class="floating-left jq_canvas_width bg-a active" line-width="5"><i></i></a>
							<a class="floating-left jq_canvas_width bg-b" line-width="10"><i></i></a>
							<a class="floating-left jq_canvas_width bg-c" line-width="15"><i></i></a>
							<a class="floating-left jq_canvas_width bg-d" line-width="20"><i></i></a>
							<a class="floating-left jq_canvas_width bg-e" line-width="25"><i></i></a>
							<a class="floating-left jq_canvas_width bg-f" line-width="30"><i></i></a>
						</div>
						<div class="row-c">
							<a class="floating-left save-Paint"><i></i></a>
							<a class="floating-left clear-all "><i></i></a>
							<a class="floating-left erazer"><i></i></a>
							<a class="floating-left print_canvas active"><i></i></a>
						</div>
					</div>
					<div class="more-page-popup jq_noclose fade-bottom">
						<ul>
							<li class="moresearch"><a><label class="floating-left"><?=$Lang->search;?></label><i class="floating-right"></i></a></li>
							<li class="morenotes"><a><label class="floating-left"><?=$Lang->Notes;?></label><i class="floating-right"></i></a></li>
							<li class="morebookmark"><a><label class="floating-left"><?=$Lang->Bookmarks;?></label><i class="floating-right"></i></a></li>
							<li class="separate"></li>
							<li class="moreindex"><a><label class="floating-left"><?=$Lang->Index;?></label><i class="floating-right"></i></a></li>
							<li class="moreenrishment"><a><label class="floating-left"><?=$Lang->Pageenrichments;?></label><i class="floating-right"></i></a></li>
							<li class="moreenrishmentbook"><a><label class="floating-left"><?=$Lang->BookEnrichments;?></label><i class="floating-right"></i></a></li>
							<li class="separate"></li>
							<li class="moreprint"><a class="print" title="Print"><label class="floating-left"><?=$Lang->Print;?></label><i class="floating-right"></i></a></li>
							<li class="moresound"><a><label class="floating-left"><?=$Lang->sound;?></label><i class="floating-right"></i></a></li>
							<li class="separate"></li>
							<li class="moreinformation"><a class="info-popup"><label class="floating-left"><?=$Lang->information;?></label><i class="floating-right"></i></a></li>
							<li class="moreshare button-animation" title="Sharing">
								<div class="a2a_dd share" style="display: none"></div>
								<a>
									<script async src="https://static.addtoany.com/menu/page.js"></script>
										<script>
											var a2a_config = a2a_config || {};
											a2a_config.show_menu = {
												position: "static",
												top: "0px",
												left: "0px"
											};
										</script>
									<label class="floating-left"><?=$Lang->Share;?></label>
									<i class="floating-right"></i>
								</a>
							</li>
							<li class="moreqrcode"><a><label class="floating-left"><?=$Lang->QRCode;?></label><i class="floating-right"></i></a></li>
						</ul>
					</div>
					<a class="footer-icons back-landscape floating-right"><i></i></a>
					<a class="footer-icons pen floating-right"><i></i></a>
					<a class="footer-icons thumbs floating-right"><i></i></a>
					<a id="zoom_label" class="footer-icons morezoomin floating-right" title="Zoom In"><i class="floating-right"></i></a>
					<a class="footer-icons morefullscreen floating-right" onclick="launchFullscreen();" title="Full screen"><i class="floating-right"></i></a>
					<div class="goto-full-container-footer jq_closepen mobile_noclose">
						<div class="goto-with-next-prev">
							<a class="footer-icons next button-animation floating-right" title="Next"><i></i></a>
							<div class="footer-go-to-page">
								<label class="right-text floating-right jq_numberofpages"></label>
								<input placeholder="1" id="page-number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="text" class="left-input-text floating-left"/>
							</div>
							<a class="footer-icons prev button-animation floating-left" ><i></i></a>
						</div>
					</div>
					<a class="footer-icons more floating-left"><i></i></a>
					<a class="footer-icons bookmark floating-left" id="bookmark" title="<?=$Lang->EditorsEBookViewer4;?>"><i></i></a>
					<a class="footer-icons note floating-left" id="AddNote" title="<?=$Lang->EditorsEBookViewer5;?>"><i></i></a>
					<a class="footer-icons moreonepage floating-left" title="<?=$Lang->Onepage;?>"><label class="floating-left"></label><i class="floating-right"></i></a>
					<a class="footer-icons moretowpage floating-left" title="<?=$Lang->Towpage;?>"><label class="floating-left"></label><i class="floating-right"></i></a>
				</div>
			</div>
		</div>
		<div class="forth-section-viewer to-be-deleted">
			<div class="timeline-section-viewer">
				<div class="timeline-container-white mobile_noclose">
					<h1 class="book-title">
						<span><?=$Lang->BookEnrichments;?></span>
						<a class="back floating-left button-animation"></a>
					</h1>
					<div class="box-container-timeline">
						<section id="cd-timeline" class="cd-container">
							<div class="unit-number">Unit One</div>
							<div class="cd-timeline-block">
								<div class="cd-timeline-img pic">
								</div>
								<div class="cd-timeline-content">
									<span class="cd-date">Lesson One</span>
									<div class="icons-container">
										<a class="image"></a>
										<a class="exercise"></a>
										<a class="game"></a>
										<a class="gift"></a>
										<a class="url"></a>
										<a class="quiz"></a>
										<a class="sound"></a>
										<a class="youtube"></a>
										<a class="worksheet"></a>
									</div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
			<div class="logo"></div>
		</div>
	</section>
	<input id="textQR" type="text" value="" style="display:none;"/>
	<div id="tempdiv"></div>
<script src="<?=SITE_URL;?>platform/books/viewer/js/manhal-ui.js?temp=20" type="text/javascript"></script>
<script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/js/jquery-ui.js" defer></script>
<script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/js/qrcode.js" defer></script>
<script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/js/jquery.touchwipe.min.js" defer></script>
<script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/js/jquery.ui.touch-punch.min.js" defer></script>
<script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/js/sweetalert.min.js" defer></script>
<script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/js/bookbrowser.js?temp=20"></script>
<script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/js/jquery.magnific-popup.min.js" defer></script>
<script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/js/modernizr.2.5.3.min.js" defer></script>
<script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/js/hash.js" defer></script>
<script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/viedoplayer/dist/plyr.js" defer></script>
<script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/js/slick.min.js"></script>
<script type="text/javascript" src="<?=SITE_URL;?>platform/books/viewer/js/iBounce.js"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.defer=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-74397962-2', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>
