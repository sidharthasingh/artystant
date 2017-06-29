<?php
	require("redirect.php");

	$url = $_SERVER['PHP_SELF'];
	$url = str_replace("\\","/" ,$url);
	$url = str_replace("//","/",$url);
	$url = trim($url);

	$vars = explode("/", $url);
	
	if($url[strlen($url)-1] == '/')
		unset($vars[count($vars)-1]);

	if($vars[0]=="")
		$d=1;
	
	switch($vars[1+$d])
	{
		case 'home':
				include('abc.txt');
				break;
		case 'user':
				break;
		default: 
				pageNotFound();
				break;
	}
	exit;
?>