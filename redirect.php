<?php
	require("site.php");

	/*
		STATUS CODE
		300 : request has more than one possible response
		301 : Permanent Redirect
		302 : URI of the requested resource has been changed temporarily.
		304 : Used for caching purposes. Tells the client to use a cached copy
		305 : Requested response must be accessed by a proxy
		307 : Temporary Redirect. BUT, no change in call method
		308 : Permanent Redirect. BUT, no change in call method
	*/

	function redirect($url,$code=307)
	{
		header("Location : $url",true,$code);
		exit;
	}

	function pageNotFound()
	{
		redirect(site_url()."page_not_found/",302);
	}
?>