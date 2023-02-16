<?php

class DB
{
	var $conn;

	function __construct()
	{

		include("../config/global_config_conexionbdmysql.php");
		$this->conn = mysqli_connect($dbserver, $dbuser, $passwd);

		mysqli_select_db($this->conn, $dbname);
	}

	function &Ejecuta($query)
	{

		$result = $this->conn->query($query);
		$error = $this->conn->connect_errno;

		if ($error != "")
			$err = $error;
		$rr = "";

		//$nrow = count($result);

		if ($result <> '') {
			$rr = array();
			for ($i = 0; $row = $result->fetch_array(MYSQLI_ASSOC); $i++) {
				foreach ($row as $key => $value)
					$rr[$i][$key] = utf8_encode($value);
			}
		} else {
			$rr = 0;
		}
		if ($error != "") {
			$rr = $error;
		}
		return ($rr);
	}

	function &Ejecuta2($query, &$err = "")
	{
		$result = $this->conn->query($query);
		$error = $this->conn->connect_errno;
		if ($error != "")
			$err = $error;
		$rr = "";
		if (is_resource($result)) {
			$nrow = mysqli_num_rows($result);
			if ($nrow > 0) {
				for ($i = 0; $row = mysqli_fetch_array($result, MYSQLI_ASSOC); $i++) {
					foreach ($row as $key => $value)
						$rr[$i][$key] = $value;
				}
			} else {
				$rr = 0;
			}
		} else {
			$rr = 0;
		}
		return ($rr);
	}

	function &Insert($query)
	{

		$result = $this->conn->query($query);
		$error = $this->conn->connect_errno;

		$rr = "";

		if ($error != "") {
			$rr = $error;
		}

		return ($rr);
	}

	function &InsertGetId()
	{

		$error = $this->conn->connect_errno;

		$rr = $this->conn->insert_id;

		if ($error != "") {
			$rr = $error;
		}

		return ($rr);
	}

	function &EjecutaJSON($query)
	{
		$result = mysqli_query($this->conn, $query);
		$error = mysqli_error($this->conn);
		if ($error != "")
			$err = $error;
		$rr = "";
		if ($result instanceof mysqli_result) {
			$nrow = mysqli_num_rows($result);
			if ($nrow > 0) {
				$rr = array();
				while ($row = mysqli_fetch_assoc($result)) {
					$data[] = $row;
				}
				$rr = json_encode($data);
			} else {
				$rr = 0;
			}
		} else {
			$rr = 0;
		}
		return ($rr);
	}
	function close()
	{
		mysqli_close($this->conn);
	}


}
