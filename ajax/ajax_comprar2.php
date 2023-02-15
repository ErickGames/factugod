<?php

include_once("../config/global_config_includes.php");

$_SESSION['titulo'] = "PLAN PYME para " . $_SESSION['razonsocial'] . " " . $_SESSION['id_usuario'] . ' fecha: ' . date('d/m/Y g:i:s');
$_SESSION['monto'] = $_POST['monto'];
$_SESSION['tiempo'] = $_POST['tiempo'];
$_SESSION['paquete'] = $_POST['paquete'];
$_SESSION['rfcs'] = $_POST['rfcs'];


if($_SESSION['tiempo'] == "m"){
    $_SESSION['tiempo'] = "MENSUAL";
}
if($_SESSION['tiempo'] == "t"){
    $_SESSION['tiempo'] = "TRIMESTRAL";
}
if($_SESSION['tiempo'] == "s"){
    $_SESSION['tiempo'] = "SEMESTRAL";
}
if($_SESSION['tiempo'] == "a"){
    $_SESSION['tiempo'] = "ANUAL";
}


$x = array('titulo' => "PLAN PYME ". $_SESSION['tiempo'] . " para ". $_SESSION['razonsocial'] . " " . $_SESSION['id_usuario'] . ' fecha: ' . date('d/m/Y g:i:s'), 'monto'=>$_POST['monto']);

echo json_encode($x);
