<?php

include_once("../config/global_config_includes.php");

$s = new SAT();

$sinProcesar = $s->sinProcesar();
$saldo = $s->saldo();

$paraProcesar = intval($saldo/$GLOBALS['valor']);
$registrosSinProcesar = $sinProcesar;

$datos = array('paraProcesar' => $paraProcesar, 'registrosSinProcesar' => $registrosSinProcesar);

echo json_encode($datos);
?>