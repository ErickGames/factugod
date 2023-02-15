<?php

include_once("../config/global_config_includes.php");

$rfc = $_GET['rfc'];
$nombre = $_GET['nombre'];
$paterno = $_GET['paterno'];
$materno = $_GET['materno'];
$cp = $_GET['cp'];

$db = new DB();
$sql = "update datossat set nombre = '".$nombre."', apellido_materno = '".$materno."', apellido_paterno = '".$paterno."', codigo_postal = '".$cp."' where rfc = '".$rfc."'";

$db->Insert($sql);
$db->close();

echo "amogus";



?>