<?php

class DB2
{
	private $servicio;
	private $dsn;
	private $username;
	private $password;
	var $conn;

	function __construct()
	{
		$this->servicio = array();
		$this->dsn = 'firebird:dbname=localhost/3050:C:/Users/Lenovo/Documents/greasemonkey.fdb'; //ubicacion en el disco c:
		$this->username = 'SYSDBA';
		$this->password = '12345';

		// Connect to database
		$this->dbh = new PDO(
			$this->dsn,
			$this->username,
			$this->password,
			[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
		);

		// var_dump($this->dbh) ;

		// $sql = "SELECT * FROM DIRS_CLIENTES";

		// $res2 = $this->dbh->prepare($sql);
		// $res2->execute();

		// $clientes = $res2->fetchAll();

		// var_dump($this->dbh);

		// $user = "SYSDBA"; 
		// $password = "12345";
		// $ODBCConnection = odbc_connect("DRIVER={Devart ODBC Driver for Firebird};Database=grasamono;Server=localhost;Port=3050", $user, $password);

		// $SQLQuery = "SELECT * FROM grasamono.DIRS_CLIENTES";
		// $RecordSet = odbc_exec($ODBCConnection, $SQLQuery);

		// while (odbc_fetch_row($RecordSet)) {
		// 	$result = odbc_result($RecordSet, "border=1");
		// }
		// odbc_close($ODBCConnection);
		// var_dump($result);
		// die;         
	}

	function &Ejecuta($query)
	{

		$result = $this->dbh->query($query);
		$error = $this->dbh->connect_errno;

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
		$result = $this->dbh->query($query);
		$error = $this->dbh->connect_errno;
		if ($error != "")
			$err = $error;
		$rr = "";
		if (is_resource($result) == true) {
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

		$result = $this->dbh->query($query);
		// $error = mysqli_error($this->dbh);

		$rr = "";

		// if ($error != "") {
		// 	$rr = $error;
		// }

		return ($rr);
	}

	function &InsertGetId($query)
	{

		$result = $this->dbh->query($query);
		$error = $this->dbh->connect_errno;

		$rr = $this->dbh->insert_id;

		if ($error != "") {
			$rr = $error;
		}

		return ($rr);
	}

	function &EjecutaJSON($query)
	{
		$result = mysqli_query($this->dbh, $query);
		$error = mysqli_error($this->dbh);
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
		// mysqli_close($this->dbh);
		$this->dbh = null;
	}
}
