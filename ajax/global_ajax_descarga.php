<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
include_once ("../config/global_config_includes.php") ?>
<?php 
$bloque = date("ymdHis")."-".rand(10000,99999);

//Guarda Formulario
$nomina = new SAT();
$html = $nomina->getReporteDescarga($_GET);


$file="descarga_" . $bloque . ".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");

echo utf8_decode($html);
?>