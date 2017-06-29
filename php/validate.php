<?php
	require("./res/user.php");
	/*
	error codes for password validation
	1 : all good
	0 : invalid email format
	2 : invalid password format
	3 : user not found
	*/
	function validEmail($email)
	{
		return true;
	}

	if($_REQUEST["email"] && $_REQUEST["password"] && $_REQUEST["validate"]=="true")
	{
		$email = $_REQUEST["email"];
		$pass = $_REQUEST["password"];
		if(validPassword($pass))
		{
			if(validEmail($email))
			{
				$uid = getUserId($email);
				if($uid)
				{
					if(validateUserPass($uid,$pass))
						echo "1";
					else
						echo "2";
				}
				else
					echo "3";
			}
			else
				echo "0";
		}
		else
			echo "2";
	}
?>