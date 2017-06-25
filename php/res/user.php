<?php
	require("session.php");
	function createUser($login,$pass,$email,$fname,$lname,$ustatus)
	{
		global $artdb;
		return $artdb->insertValue("users",array(
			"user_login"=>$login,
			"user_pass"=>$pass,
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
		$newArr=array();
		foreach($arr as $key => $val)
		{
			$newArr[] = array(
					"user_id"=>$uid,
					"meta_key"=>$key,
					"meta_value"=>$val
				);
		}
		return $artdb->insertBatch("user_meta",$newArr);
	}
?>