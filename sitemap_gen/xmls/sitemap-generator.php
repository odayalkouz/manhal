<?php
/*************************************************************
 iProDev PHP XML Sitemap Generator
 Simple site crawler to create a search engine XML Sitemap.
 Version 1.0
 Free to use, without any warranty.
 Written by iProDev(Hemn Chawroka) http://iprodev.com 28/Mar/2016.

*************************************************************/
if(session_status()==PHP_SESSION_NONE){
	session_start();
}

require_once "simple_html_dom.php";

	// Set the output file name.
	$file = "sitemap.xml";

	// Set the start URL. Here is http used, use https:// for 
	// SSL websites.

	// Set true or false to define how the script is used.
	// true:  As CLI script.
	// false: As Website script.
	define ('CLI', false);

	// Define here the URLs to skip. All URLs that start with 
	// the defined URL will be skipped too.
	// Example: "http://iprodev.com/print" will also skip
	// http://iprodev.com/print/bootmanager.html


	// Define what file types should be scanned.


	// Scan frequency
	$freq = "weekly";

	// Page priority
	$priority = "1.0";
$status=1;

	// Init end ==========================

	define ('VERSION', "1.0");                                            
	define ('NL', CLI ? "\n" : "<br>");

	function rel2abs($rel, $base) {
		if(strpos($rel,"//") === 0) {
			return "http:".$rel;
		}
		/* return if  already absolute URL */
		if  (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;
		$first_char = substr ($rel, 0, 1);
		/* queries and  anchors */
		if ($first_char == '#'  || $first_char == '?') return $base.$rel;
		/* parse base URL  and convert to local variables:
		$scheme, $host,  $path */
		extract(parse_url($base));
		/* remove  non-directory element from path */
		$path = preg_replace('#/[^/]*$#',  '', $path);
		/* destroy path if  relative url points to root */
		if ($first_char ==  '/') $path = '';
		/* dirty absolute  URL */
		$abs =  "$host$path/$rel";
		/* replace '//' or  '/./' or '/foo/../' with '/' */
		$re =  array('#(/.?/)#', '#/(?!..)[^/]+/../#');
		for($n=1; $n>0;  $abs=preg_replace($re, '/', $abs, -1, $n)) {}
		/* absolute URL is  ready! */
		return  $scheme.'://'.$abs;
	}

	function GetUrl ($url) {
		$agent = "Mozilla/5.0 (compatible; iProDev PHP XML Sitemap Generator/" . VERSION . ", http://iprodev.com)";

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt ($ch, CURLOPT_VERBOSE, 1);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);

		$data = curl_exec($ch);

		curl_close($ch);

		return $data;
	}

	function Scan ($url) {

		global  $pf, $freq, $priority;

		echo $_SESSION["counter1"]."                   ".$url.NL;

		//$url = filter_var ($url, FILTER_SANITIZE_URL);

		if (in_array ($url, $_SESSION["scanned"])) {
			return;
		}

		array_push ($_SESSION["scanned"], $url);

		$html =GetUrl ($url);
		$dom = new DomDocument();
		@$dom->loadHTML($html);
		$urls = $dom->getElementsByTagName('a');


//		$dom = new DOMDocument();
//		libxml_use_internal_errors(true);
//		$dom->loadHTMLFile($url);
//		$urls = $dom->getElementsByTagName('a');


			foreach ($urls as $val) {
				$next_url = $val->getAttribute('href');

				if (substr ($next_url, 0, strlen ($_SESSION["main_url"])) == $_SESSION["main_url"]) {

					$ignore = false;
					if (in_array ($next_url, $_SESSION["scanned"])) {
						$ignore = true;
					}
					if (!$ignore) {
						if($next_url!=""){
							if($_SESSION["counter1"]-$_SESSION["start_counter"]>3000){
								echo "continue";
								$_SESSION["start_url"]=$next_url;
								$_SESSION["start_counter"]=$_SESSION["counter1"];
								$status=0;
								echo "start_counter = ".$_SESSION["start_counter"]."<br>";
								echo "counter1 = ".$_SESSION["counter1"]."<br>";
								echo "start_session = ".$_SESSION["start_url"]."<br>";
								exit();
							}
							$_SESSION["counter1"]++;
							$pr = number_format ( round ( $priority / count ( explode( "/", trim ( str_ireplace ( array ("http://", "https://"), "", $next_url ), "/" ) ) ) + 0.5, 3 ), 1 );
							fwrite ($pf, "  <url>\n" .
								"    <loc>" . htmlentities ($next_url) ."</loc>\n" .
								"    <changefreq>$freq</changefreq>\n" .
								"    <priority>$pr</priority>\n" .
								"  </url>\n");

							Scan ($next_url);
						}
					}
				}

			}
	}

	$pf = fopen ($file, "w");
	if (!$pf) {
		echo "Cannot create $file!" . NL;
		return;
	}

if($_SESSION["counter1"]==0){
	fwrite ($pf, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
		"<?xml-stylesheet type=\"text/xsl\" href=\"http://iprodev.github.io/PHP-XML-Sitemap-Generator/xml-sitemap.xsl\"?>\n" .
		"<!-- Created with iProDev PHP XML Sitemap Generator " . VERSION . " http://iprodev.com -->\n" .
		"<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n" .
		"        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n" .
		"        xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n" .
		"        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n" .
		"  <url>\n" .
		"    <loc>" . htmlentities ($_SESSION["start_url"]) ."</loc>\n" .
		"    <changefreq>$freq</changefreq>\n" .
		"    <priority>$priority</priority>\n" .
		"  </url>\n");
}

echo '<html lang="en"><head>
    <meta content="utf-8" http-equiv="encoding"></head>';
	Scan ($_SESSION["start_url"]);

if($status==0){
	fwrite ($pf, "</urlset>\n");
	echo "Done." . NL;
	echo "$file created." . NL;
}

	fclose ($pf);


?>