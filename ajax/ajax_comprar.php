<?php

include_once("../config/global_config_includes.php");

$_SESSION['titulo'] = "Paquete de " . $_POST['monto'] . " para " . $_SESSION['razonsocial'] . " " . $_SESSION['id_usuario'] . ' fecha: ' . date('d/m/Y g:i:s');
$_SESSION['monto'] = $_POST['monto'];

$x = array('titulo' => "Paquete de " . $_POST['monto'] . " para " . $_SESSION['razonsocial'] . " " . $_SESSION['id_usuario'] . ' fecha: ' . date('d/m/Y g:i:s'), 'monto'=>$_POST['monto']);

echo json_encode($x);
?>