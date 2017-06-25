<?php
	require("config.php");
	class artystantDB
	{
		var $conn;
		function __construct()
		{
			$this->conn = new mysqli(DATABASE_HOST,DATABASE_USER,DATABASE_PASS,DATABASE_DB,DATABASE_PORT);
			if(!$this->conn)
				$this->conn=null;
		}

		function insertValue($table,$arr)
		{
			if($this->conn)
			{
				$sql="insert into $table(";
				$keys=array();
				$vals=array();
				foreach($arr as $key => $val)
				{
					$val=str_replace("\\", "\\\\", $val);
					$val=str_replace("'", "\'", $val);
					$keys[]="$key";
					$vals[]="'$val'";
				}
				$sql.=implode(",",$keys).") values(".implode(",",$vals).");";
				if($this->conn->query($sql))
					return mysqli_insert_id($this->conn);
				else
					return false;
			}
			else
				return false;
		}

		function insertBatch($table,$arr)
		{
			$count=0;
			foreach($arr as $ar)
				if($this->insertValue($table,$ar))
					$count++;
			if($count==0)
				return false;
			else
				return $count;
		}

		function query($sql)
		{
			if($this->conn)
			{
				$result = $this->conn->query($sql);
				if($result)
					return $result;
				else
					return false;
			}
			else
				return false;
		}

		function last_id()
		{
			return mysqli_insert_id($this->conn);
		}

		function get_row($sql)
		{
			$result = $this->query($sql);
			if($result->num_rows>0)
				return $result->fetch_assoc();
			return false;
		}

		function get_result($sql)
		{
			$result = $this->query($sql);
			if($result->num_rows>0)
			{
				$retArr = array();
				while($row = $result->fetch_assoc())
					$retArr[] = $row;
				return $retArr;
			}
			else
				return false;
		}

	}

	$artdb = new artystantDB;
?>