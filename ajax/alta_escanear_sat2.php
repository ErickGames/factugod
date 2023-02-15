<?php

include_once("../config/global_config_includes.php");

$s = new SAT();

$resultado = $s->guardaEscaneo2($_POST);

echo json_encode($resultado ); 
?>