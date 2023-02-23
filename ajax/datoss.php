<?php
include_once("../config/global_config_includes.php");
// require($_SERVER['DOCUMENT_ROOT'] . '/factugod/vendor/autoload.php');
require($_SERVER['DOCUMENT_ROOT'] . '/factu/vendor/autoload.php');


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Crear una instancia de la base de datos
$db = new DB();
// Obtener idcliente del request
$idcliente = $_GET['cliente'];

// Decodificar el token
try {
    // Obtener headers de la peticion, se busca obtener el Authorization header
    $headers = apache_request_headers();
    // Obtener el Bearer Token, y remover la palabra 'Bearer ', ya que nos viene en el header como 'Bearer $.43s24...'
    $token = str_ireplace("Bearer ", "", $headers['Authorization']);
    // Obtener la pwd del usuario por medio del idcliente, para despues verificar si este coincide con el token desencriptado
    $pwdQuery = "SELECT rfc FROM clientes WHERE id_cliente = {$idcliente}";
    $pwd = $db->Ejecuta($pwdQuery);

    $decoded = JWT::decode($token, new Key($pwd[0]['rfc'], 'HS256'));
} catch (Exception $e) {
    http_response_code(403);
    echo json_encode("No autorizado");
    exit;
}

$sql = "select id_datosSAT, id_cliente, id_archivosSAT, fecha, rfc, idCIF, liga, curp, nombre, apellido_materno, apellido_paterno, fecha_nacimiento, fecha_inicio_operaciones, situacion_contribuyente, fecha_ultimo_cambio, entidad_federativa, municipio, colonia, tipo_vialidad, numero_exterior, numero_interior, codigo_postal, correo_electronico, AL, regimen, clave_regimen, isempleado from datossat where id_cliente='" . $idcliente . "'";
$datos = $db->Ejecuta($sql);
$db->close();

echo json_encode($datos);
