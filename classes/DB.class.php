<?php
//DB.class.php

class DB {
	
	protected $db_name = 'php_web_app';
	protected $db_user = 'web_app_user';
	protected $db_pass = 'webapppass!';
	protected $db_host = 'localhost';

	public function connect() {
		
		$connection = mysql_connect($this->db_host, $this->db_user, $this->db_pass);
		mysql_select_db($this->db_name);

		return true;


		// PDO connection

		/*try {
			$DBH = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}

		catch {
			(PDOException, $e) {
				echo $e->getMessage();
			}
		}*/
	}

	public function processsRowSet($rowSet, $singleRow=false) {
		
		$resultArray = array();
		
		while ($row = mysql_fetch_assoc($rowSet)) {
			array_push($resultArray, $row);
		}

		if ($single_row === true)
			return $resultArray[0];
		

		return $resultArray;
	}

	public function select($table, $where) {
		$sql = "SELECT * FROM $table WHERE $where";
		$result = mysql_query($sql);

		if (mysql_num_rows($result) == 1)
			return $this->processRowSet($result, true);

		return $this->processRowSet($result);
	}

	public function update($data, $table, $where) {
		foreach ($data as $column => $value) {
			$sql = "UPDATE $table SET $column = $value WHERE $where";
			mysql_query($sql) or die(mysql_error());
		}

		return true;
	}

	public function insert($data, $table) {

		$columns = "";
		$values = "";

		foreach ($data as $column => $value) {
			$columns .= ($columns == "") ? "" : ", ";
			$columns .= $column;
			$values .= ($values == "") ? "" : ", ";
			$values .= $value;
		}

		$sql = "INSERT INTO $table ($columns) VALUES ($values)";

		mysql_query($sql) or die(mysql_error());

		return mysql_insert_id();
	}


} // end of DB Class

?>