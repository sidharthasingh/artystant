<?php
	include("redirect.php");
	include("./php/functions.php");

	$url = $_SERVER['PHP_SELF'];
	$url = str_replace("\\","/" ,$url);
	$url = str_replace("//","/",$url);
	$url = str_replace(" ","",$url);
	$url = trim($url);

	$vars = explode("/", $url);
	
	if($url[strlen($url)-1] == '/')
		unset($vars[count($vars)-1]);

	($vars[0]=="")?$d=1:$d=0;
	$pass = array();
	for($i=2;$i<count($vars);$i++)
		$pass[] = $vars[$i];

	// switch($vars[1+$d])
	// {
	// 	case '':
	// 	case 'home':
	// 			include("./php/index.php");
	// 			break;
	// 	case 'cart':
	// 			include("./php/cart.php");
	// 			break;
	// 	case 'user':
	// 			include("./php/user.php");
	// 			break;
	// 	case 'page_not_found':
	// 			include("./php/404.php");
	// 			break;
	// 	default: 
	// 			pageNotFound();
	// 			break;
	// }
	// exit;
?>