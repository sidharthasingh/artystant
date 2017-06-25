<?php
	require("mysql_connection.php");
	function startSession($user_id)
	{
		global $artdb;
		$sess_id;
		if(!is_numeric($user_id))
			return false;
		if($artdb->insertValue("session",array("user_id"=>$user_id)))
		{
			$sess_id=$artdb->last_id();
			$artdb->insertBatch("session_meta",array(
				array("session_id"=>$sess_id,"user_id"=>$user_id,"meta_key"=>"session_status","meta_value"=>"active"),
				array("session_id"=>$sess_id,"user_id"=>$user_id,"meta_key"=>"start_datetime","meta_value"=>date('Y-m-d H:i:s')),
				array("session_id"=>$sess_id,"user_id"=>$user_id,"meta_key"=>"end_datetime","meta_value"=>date('Y-m-d H:i:s',time()+36*3600))
				));
			return $sess_id;
		}
		else
			return false;
	}

	function stopAllSessions($uid)
	{
		global $artdb;
		if(is_numeric($uid))
		{
			$sql="update session_meta set meta_value='inactive' where meta_key='session_status' and user_id=$uid and meta_value='active';";
			$dateTime=date('Y-m-d H:i:s');
			$sql1 = "update session_meta set meta_value='$dateTime' where meta_key='end_datetime' and user_id=$sessId;";
			if($artdb->query($sql) && $artdb->query($sql1))
				return true;
			else
				return false;
		}
		else
			return false;
	}

	function getSessionData($sessId)
	{
		global $artdb;
		if(is_numeric($sessId))
		{
			$result = $artdb->get_result("select meta_key, meta_value from session_meta where session_id=$sessId;");
			if($result)
			{
				$retArr = array();
				foreach($result as $val)
					$retArr[$val["meta_key"]] = $val["meta_value"];
				return $retArr;
			}
			else
				return false;
		}
		else
			return false;
	}

	function validateSession($sessId)
	{
		global $artdb;
		if(!is_numeric($sessId))
			return false;
		$data = getSessionData($sessId);
		if(!$data)
			return false;
		$currentTime = time();
		if($currentTime>strtotime($data["start_datetime"]) && $currentTime<strtotime($data["end_datetime"]) && $data["session_status"]=="active")
			return true;
		else
			return false;
	}

	function stopSession($sessId)
	{
		global $artdb;
		if(!is_numeric($sessId))
			return false;
		$sql = "update session_meta set meta_value='inactive' where meta_key='session_status' and session_id=$sessId;";
		$dateTime=date('Y-m-d H:i:s');
		$sql1 = "update session_meta set meta_value='$dateTime' where meta_key='end_datetime' and session_id=$sessId;";
		if($artdb->query($sql) && $artdb->query($sql1))
			return true;
		else
			return false;
	}
?>