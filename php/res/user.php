<?php
	require("session.php");
	function createUser($login,$pass,$email,$fname,$lname,$ustatus)
	{
		global $artdb;
		return $artdb->insertValue("users",array(
			"user_login"=>$login,
			"user_pass"=>$pass,
			"user_email"=>$email
			"user_registered"=>date('Y-m-d H:i:s'),
			"first_name"=>$fname,
			"last_name"=>$lname,
			"user_status"=>$ustatus
			));		
	}

	function getUserMeta($uid)
	{
		global $artdb;
		$sql="select meta_key, meta_value from user_meta where user_id=$uid;";
		$result=$artdb->get_result($sql);
		if($result)
		{
			$retArr = array();
			foreach($result as $val)
				$retArr[$val["meta_key"]]=$val["meta_value"];
			return $retArr;
		}
		else
			return false;
	}
?>