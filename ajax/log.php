<?php

include_once("../config/global_config_includes.php");

$id = $_GET['id'];
$tipo = $_GET['tipo'];
$desc = $_GET['desc'];
$fecha = date('Y-m-d H:i:s');


$db = new DB();
$sql = "insert into log(id_cliente, tipo, descripcion, fecha) values (".$id.", '".$tipo."', '".$desc."', '".$fecha."')";

$db->Insert($sql);
$db->close();

echo "amogus";
// echo $sql;




?>