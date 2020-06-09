<?php
// Class : SQLManager
// Version : 1.2
// Create By : GoGermany
// Date Time : 27/10/2009 9:39 PM

// Update SQLi : xBlacKLisTz (SE.TON)
// Update SQLi Date Time : 9/8/2016 8:27 AM

if(class_exists('SQLiManager') === false)
{
	// ADD Var sql
	class SQLiManager{

		var $table;
		var $field;
		var $value;
		var $condition;
		var $sql;
		var $deleteAlias;
		public function SQLiManager()
		{
			$this->connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
			if(!$this->connect)
			{
				die('Could not connect: ' . mysqli_connect_errno());
			}

			$cs1 = "SET character_set_results=utf8";
			mysqli_query($this->connect,$cs1) or die('Error query: ' . mysqli_error($this->connect));
			$cs2 = "SET character_set_client = utf8";
			mysqli_query($this->connect,$cs2) or die('Error query: ' . mysqli_error($this->connect));
			$cs3 = "SET character_set_connection = utf8";
			mysqli_query($this->connect,$cs3) or die('Error query: ' . mysqli_error($this->connect));

			date_default_timezone_set('Asia/Bangkok');

			$this->field="*";
		}

		//====================INSERT======================
		public function insert()
		{
			$this->sql = "INSERT INTO $this->table ($this->field) VALUES ($this->value)";
			$result=mysqli_query($this->connect,$this->sql) or trigger_error(mysqli_error($this->connect),E_USER_ERROR);
			return $result;
		}

		//====================DELETE======================
		public function delete()
		{
			$this->sql = "DELETE $this->deleteAlias from $this->table $this->condition";
			$result=mysqli_query($this->connect,$this->sql) or trigger_error(mysqli_error($this->connect),E_USER_ERROR);
			return $result;
		}

		//=====================UPDATE=====================
		public function update()
		{
			$this->sql = "UPDATE $this->table SET $this->value $this->condition";
			$result=mysqli_query($this->connect,$this->sql) or trigger_error(mysqli_error($this->connect),E_USER_ERROR);
			return $result;
		}

		//=====================SELECT=====================
		public function select()
		{
			$this->sql="SELECT $this->field FROM $this->table $this->condition";
			$result=mysqli_query($this->connect,$this->sql) or trigger_error(mysqli_error($this->connect),E_USER_ERROR);
			return $result;
		}

		//=====================MAX=====================
		public function selectMax()
		{
			$this->sql = "SELECT max($this->field) FROM $this->table";
			$result=mysqli_query($this->connect,$this->sql) or trigger_error(mysqli_error($this->connect),E_USER_ERROR);
			$row=mysqli_fetch_array($result);
			$id_max=$row[0];
			return $id_max;
		}

		//=====================COUNTROW=====================
		public function countRow()
		{
			$this->sql = "SELECT COUNT($this->field) FROM $this->table $this->condition";
			$result=mysqli_query($this->connect,$this->sql) or trigger_error(mysqli_error($this->connect),E_USER_ERROR);
			$row=mysqli_fetch_array($result);
			$countrow=$row[0];
			return $countrow;
		}
	}
}
?>