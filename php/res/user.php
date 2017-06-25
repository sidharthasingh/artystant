<?php
	require("session.php");
	require("pass.php");

	function createUser($login,$pass,$email,$fname,$lname,$ustatus)
	{
		global $artdb;
		return $artdb->insertValue("users",array(
			"user_login"=>$login,
			"user_pass"=>md5($pass),
			"user_email"=>$email,
			"user_registered"=>date('Y-m-d H:i:s'),
			"first_name"=>$fname,
			"last_name"=>$lname,
			"user_status"=>$ustatus
			));		
	}

	function getUserMeta($uid,$meta_key="")
	{
		global $artdb;
		if(!is_numeric($uid) || strpos("$meta_key",";"))
			return false;
		if($meta_key=="")
		{
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
		else
		{
			$sql = "select meta_value from user_meta where user_id=$uid and meta_key='$meta_key';";
			$result = $artdb->get_row($sql);
			if($result)
				return $result["meta_value"];
			else
				return false;
		}
	}

	function getUserData($uid,$ch)
	{
		global $artdb;
		if(!is_numeric($uid) || strpos("$ch",";"))
			return false;
		$result = $artdb->get_row("select $ch from users where ID=$uid;");
		if($result)
			return $result[$ch];
		else
			return false;
	}

	function setUserData($uid,$key,$val)
	{
		global $artdb;
		if(!is_numeric($uid) || strpos("$key",";") || strpos("$val",";"))
			return false;
		if($key == "user_pass")
			$val=md5($val);
		return $artdb->query("update users set user_pass='$val' where id=$uid;");
	}

	function setUserMeta($uid,$key,$val)
	{
		global $artdb;
		$arr = array(
				"user_id"=>$uid,
				"meta_key"=>$key,
				"meta_value"=>$val
			);
		return $artdb->insertValue("user_meta",$arr);
	}

	function setUserMetaBulk($uid,$arr)
	{
		global $artdb;
		for($i=0;$i<count($arr);$i++)
			$arr[$i]["user_id"] = $uid;
		return $artdb->insertBatch("user_meta",$arr);
	}

	function getUser($uid)
	{
		global $artdb;
		$sql = "select * from users where ID=$uid;";
		$user = $artdb->get_row($sql);
		$meta = getUserMeta($uid);
		if($user && $meta)
			return array_merge($user,$meta);
		else
			return false;
	}

	function getUserId($email)
	{
		global $artdb;
		if(strpos($email,";"))
			return false;
		$result = $artdb->get_row("select ID from users where user_email='$email';");
		if($result)
			return $result["ID"];
		else
			return false;
	}

	var_dump(getUserId("a@b.c"));
	// createUser("hotshot","thebest","a@b.c","bumble","bee","inactive");
	var_dump(setUserData(3,"user_pass","thebst"));
	echo "\n";
	var_dump(validateUserPass(3,"thbst"));
?>