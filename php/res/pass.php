<?php
	/*

	password rules : 'a-zA-z . , ! @ # $ % ^ & * ( ) - _ + = ` | \ '

	*/

	function validPassword($pass)
	{
		$validPasswordArray = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.,!@#$%^&*()-_+=`|"\'';
		for($i=0;$i<strlen($pass);$i++)
			if(!strpos($validPasswordArray, $pass[$i]))
				return false;
		return true;
	}

	function validateUserPass($uid,$pass)
	{
		$pass1 = getUserData($uid,"user_pass");
		if($pass1 == md5($pass))
			return true;
		return false;
	}
?>