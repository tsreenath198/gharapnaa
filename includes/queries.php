<?php
	class Queries 
	{
		var $dblink, $dbhost, $dbuser, $dbpass, $dbname, $link, $Errno, $Error;
		var $affected_rows; 
		
		function setConnection($dbVars)
		{
			$this->dbhost = $dbVars["dbhost"];
			$this->dbuser = $dbVars["dbuser"];
			$this->dbpass = $dbVars["dbpass"];
			$this->dbname = $dbVars["dbname"];
		}
		
		function openConnection()
		{
			$conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
			if(!$conn)
			{
				$this->Errno = mysqli_errno();
				$this->Error = mysqli_error();
				$this->error("Unable to Connect the Server".$this->dbhost);
			}
			return $conn;
		}
		
		function getErrorMsg()
		{  
			return $this->Error;
		}
		function get($query)
		{  
			$this->link = $this->openConnection();
			$qid  = mysqli_query($this->link,$query);
			if(!$qid)
			{
				$this->Errno = mysqli_errno($this->link);
				$this->error("Problem In Executing the Query:" . $query);
			}
			$this->closeConnection($this->link);
			return $qid;
		}

		function insertUpdateRecord($query)
		{
			$this->link = $this->openConnection();
			$qid  = mysqli_query($this->link,$query);
			$iid  = mysqli_insert_id($this->link);
			$this->closeConnection($this->link);
			
			if(!$qid){
				$this->Errno = mysqli_errno();
				$this->Error = mysqli_error();
				$this->error("Problem In Executing the Query:" . $query);
			}
			return $iid;
		}
		function getCount($query)
		{
			// returns the count value.
			$this->link = $this->openConnection();
			$qid  = mysqli_query ( $this->link,$query);
			if(!$qid){
				$this->Errno = mysqli_errno();
				$this->Error = mysqli_error();
				$this->error("Problem In Executing the Query:" . $query);
			}
			$rows = mysqli_affected_rows($this->link);
			$this->closeConnection($this->link);
			return $rows;
		}
		
		function getSingleRow($result)
		{
			$row = mysqli_fetch_object($result);
			if(isset($row))
			{
				return $row;
			}
			return (object)array();
		}
		function getSingleRowArray($query)
		{
			$result = $this->get($query);
			return (array)$this->getSingleRow($result);
		}
		function getSingleRowObject($result) 
		{
			return $this->getSingleRow($result);
		}
	
	
		function getRecordsArray($query) 
		{
			$results = $this->get($query);
			$recordsList = array();
			if($results) {
				while($record = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
					array_push($recordsList, $record);
				}
			}
			return $recordsList;
		}
		function escString($value)
		{
			$this->link = $this->openConnection();
			$str = mysqli_real_escape_string($this->link, $value);
			$this->closeConnection($this->link);
			return $str;
		}
		
		function fetchArray($qid) 
		{
			return @mysqli_fetch_array($qid);
		}

		function fetchRow($qid) 
		{
			return mysqli_fetch_row($qid);
		}
		
		function fetchObject($qid) 
		{
			return @mysqli_fetch_object($qid);
		}

		function numRows($qid) 
		{
			return @mysqli_num_rows($qid);
		}

		function affectedRows() 
		{
			// for insert, update, delete reasons.
			return $this->affected_rows;
		}
		
		function fetchAssoc($qid) 
		{
			// for insert, update, delete reasons.
			return mysqli_fetch_assoc($qid);
		}
		

		function freeResult($qid) 
		{
			mysqli_free_result($qid);
		}

		function numFields($qid) 
		{
			return mysqli_num_fields($qid);
		}
		function closeConnection($conn) 
		{
			mysqli_close($conn);
		}
		
		function error($msg) 
		{
			print "<b>Error in Query Execution.</b>";
			DB_DEBUG AND printf("<b>Error : </b> %s<br>\n", $msg);
			DB_DEBUG AND printf("<b>MySQL Error</b>: %s (%s)<br>\n", $this->Errno, $this->Error);
		}
		
	}
	/* function getRecordsArray($conn, $query) {
		$recordsList = array();
		if($query!='') {
			$results = mysqli_query($conn, $query);
			while($record = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
				array_push($recordsList, $record);
			}
		}
		return $recordsList;
	}
	function getRecordsAssoc($conn, $query) {
		$results = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($results);
	}
	function insertUpdateRecord($conn, $query) {
		if(mysqli_query($conn, $query)) {
			return true;
		} else {
			return false;
		}
	} */
?>