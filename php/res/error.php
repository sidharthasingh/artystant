<?php
	function getErrorMessage($code)
	{
		switch($code)
		{
			case 1: return "all Good";
			default: return false; 
		}
	}
	
	class artError
	{
		var $code;
		var $message;

		function __construct($CODE,$MESS="")
		{
			$this->code = $CODE;
			if($MESS)		
				$this->message = $MESS;
			else
				$this->message = getErrorMessage($CODE);
			if(!$this->message)
				$this->message = "error code not defined";
		}

		function isError($para)
		{

		}

		function setMessage($msg)
		{
			$this->message = $msg;
		}

		function getMessage()
		{
			return $this->message;
		}

		function toArray()
		{
			return (array)$this;
		}

		function toJSON()
		{
			return json_encode($this->toArray());
		}
	}
	$temp = new artError(1,"11");
	var_dump($temp);
	echo gettype($temp);

?>