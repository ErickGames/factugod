<?php

include_once("../config/global_config_includes.php");

$idcliente = $_GET['cliente'];

$db = new DB();
$sql = "select id_datosSAT, id_cliente, id_archivosSAT, fecha, rfc, idCIF, liga, curp, nombre, apellido_materno, apellido_paterno, fecha_nacimiento, fecha_inicio_operaciones, situacion_contribuyente, fecha_ultimo_cambio, entidad_federativa, municipio, colonia, tipo_vialidad, numero_exterior, numero_interior, codigo_postal, correo_electronico, AL, regimen, clave_regimen, isempleado from datosSAT where id_cliente='". $idcliente ."'";
// where id_archivosSAT={$post['id_archivosSAT']} order by 1
$datos = $db->Ejecuta($sql);
$db->close();

// $emparray = array();

//     while($row = mysqli_fetch_assoc($datos))
//     {
//         $emparray[] = $row;
//     }

echo json_encode($datos);



?>