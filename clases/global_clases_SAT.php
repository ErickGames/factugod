<?php
require($_SERVER['DOCUMENT_ROOT'] . '/factugod/vendor/autoload.php');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
session_start();
class SAT
{

    function login($post)
    {
        $db = new DB();
        $sql = "call sp_login('" . strtoupper($post['RFC']) . "','" . $post['correo'] . "')";
        $rfc =  mysqli_real_escape_string($db->conn, strtoupper(strtoupper($post['RFC'])));
        $correo =  mysqli_real_escape_string($db->conn, $post['correo']);
        $sql = "SELECT *
                FROM clientes
                WHERE upper(rfc) = '$rfc' and correo='$correo'";
        $datos = $db->Ejecuta($sql);
        $db->close();
        $msg = '';
        if (count($datos) > 0) {
            $_SESSION['id_usuario'] = $datos[0]['id_cliente'];
            $_SESSION['rfc'] = $datos[0]['rfc'];
            $_SESSION['razonsocial'] = $datos[0]['razonsocial'];
            $_SESSION['correo'] = $datos[0]['correo'];
            $user_id = $datos[0]['id_cliente'];
            $pwd = $datos[0]['rfc'];
            // Generar api token para posteriormente proteger las rutas de constancias, entre otras necesarias
            $jwt = $this->generar_api_token($user_id, $pwd);
            $msg = $jwt;
        } else {
            http_response_code(500);
            $msg = 'No se encontraron datos, favor de revisar la información';
        }

        return $msg;
    }
    
    function generar_api_token($user_id, $pwd)
    {
        try {
            // Establecer lo que nos va a regresar como respuesta al generar el api token
            $payload = [
                'iss' => 'https://factudata.com.mx/', // Quien lo genera
                'aud' => 'https://factudata.com.mx/', // Ruta de la pagina
                'iat' => time(), // Hora en la que fue generado (Con esto podemos validar si el token todavia sigue vigente haciendo la diferencia entre (exp - iat))
                'exp' => time() * 3600, // Tiempo de expiracion
                'user_id' => $user_id // Usuario que lo genero
            ];
            /* Encriptar nuestra key, si queremos hacer una peticion a una ruta protegida tendremos que mandar este token como Authorization header, si se desencripta
            y hace match con la contraseña del usuario nos dejara acceder a la data, de lo contario nos regresara un 403 - Not authorized */
            $jwt = [
                'userId' => $user_id,
                'token' => JWT::encode($payload, $pwd, 'HS256')
            ];
        } catch (PDOException $e) {
            $jwt = $e->getMessage();
        }
        return $jwt;
    }

    function registrar_datos_SAT($post)
    {

        $db = new DB();
        $sql = "select * from clientes where rfc='" . strtoupper($post['RFC']) . "'";
        $datos = $db->Ejecuta($sql);

        $msg = '';

        if (isset($datos[0]['rfc'])) {

            $msg = "El rfc " . strtoupper($post['RFC']) . " ya esta registrado con razón social: {$datos[0]['razonsocial']} y correo: {$datos[0]['correo']}.";
        }

        if ($msg == '') {

            $sql = "insert into clientes(rfc,razonsocial,correo) values('" . strtoupper($post['RFC']) . "','{$post['razonSocial']}','{$post['correo']}')";
            $db->Insert($sql);

            $sql5 = "select id_cliente from clientes ORDER BY id_cliente DESC LIMIT 1";
            $datos2 = $db->Ejecuta($sql5);
            $ultimoid = $datos2[0]['id_cliente'];
            var_dump($ultimoid);
            strval($ultimoid);

            $sql2 = "insert into paquete(id_cliente, paquete) values ('" . $ultimoid . "', '1' )";
            var_dump($sql2);
            $db->Insert($sql2);
            $db->close();
            return "1";
        } else {
            $db->close();
            return $msg;
        }
    }

    function guardaDatos($post)
    {

        $id_cliente = $_SESSION['id_usuario'];

        if (isset($post['id_cliente'])) {
            $id_cliente = $post['id_cliente'];
        }

        if (!isset($post['id_archivosSAT'])) {
            $post['id_archivosSAT'] = 0;
        }

        $db = new DB();
        $sql = "insert into datosSAT(id_cliente,rfc,idCIF,liga,fecha,id_archivosSAT) values($id_cliente,'{$post['rfc']}','{$post['idCIF']}','https://siat.sat.gob.mx/app/qr/faces/pages/mobile/validadorqr.jsf?D1=10&D2=1&D3={$post['idCIF']}_{$post['rfc']}',now(),{$post['id_archivosSAT']})";
        $db->Insert($sql);
        $db->close();

        return "Los datos se guardaron correctamente";
    }

    function guardaEscaneo($post)
    {
        $db = new DB();
        $sql = "insert into datosSAT(id_cliente,liga,fecha) values({$_SESSION['id_usuario']},'{$post['liga']}',now())";
        $db->Insert($sql);

        ////////////////////////
        ///INSERT AL ESCANEAR///
        ////////////////////////

        $lastid = $db->InsertGetId();

        $sql2 = "select * from datosSAT where codigo_postal is null and id_datosSAT=" . $lastid;
        $datos = $db->Ejecuta($sql2);

        if (count($datos) > 0) {

            for ($i = 0; $i < count($datos); $i++) {

                $row = $datos[$i];

                $html = file_get_contents($row['liga']);

                $rfc =  substr($html, strlen('El RFC: ') + strpos($html, 'El RFC: '), (strlen($html) - strpos($html, ", tiene asociada la siguiente informac")) * (-1));
                $rfc = str_replace("'", "''", $rfc);

                if ($rfc != '') {

                    if (strlen($rfc) == 12) {
                        $curp = '';
                        $nombre = substr($html, strpos($html, 'n Social:') + 66, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'n Social:')) - strpos($html, 'n Social:') - 66);
                        $apellido_paterno = substr($html, strpos($html, 'de capital:') + 68, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'de capital:')) - strpos($html, 'de capital:') - 68);
                        $apellido_materno = '';
                        $fecha_nacimiento = substr($html, strpos($html, 'Fecha de constitución:') + 80, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Fecha de constitución:')) - strpos($html, 'Fecha de constitución:') - 80);
                        $isempleado = "0"; //false

                    }

                    if (strlen($rfc) == 13) {
                        $curp = substr($html, strpos($html, 'CURP:') + 62, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'CURP:')) - strpos($html, 'CURP:') - 62);
                        $nombre = substr($html, strpos($html, 'Nombre:') + 64, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Nombre:')) - strpos($html, 'Nombre:') - 64);
                        $apellido_paterno = substr($html, strpos($html, 'Apellido Paterno:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Apellido Paterno:')) - strpos($html, 'Apellido Paterno:') - 74);
                        $apellido_materno = substr($html, strpos($html, 'Apellido Materno:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Apellido Materno:')) - strpos($html, 'Apellido Materno:') - 74);
                        $fecha_nacimiento = substr($html, strpos($html, 'Fecha Nacimiento:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Fecha Nacimiento:')) - strpos($html, 'Fecha Nacimiento:') - 74);
                        $isempleado = "1"; //true  

                    }

                    $fecha_inicio_operaciones = substr($html, strpos($html, 'Fecha de Inicio de operaciones:') + 88, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Fecha de Inicio de operaciones:')) - strpos($html, 'Fecha de Inicio de operaciones:') - 88);
                    $situacion_contribuyente = substr($html, strpos($html, 'Situación del contribuyente:') + 86, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Situación del contribuyente:')) - strpos($html, 'Situación del contribuyente:') - 86);
                    $fecha_ultimo_cambio = substr($html, strpos($html, 'Fecha del último cambio de situación:') + 96, strpos($html, '</td></tr></tbody>', strpos($html, 'Fecha del último cambio de situación:')) - strpos($html, 'Fecha del último cambio de situación:') - 96);
                    $entidad_federativa = substr($html, strpos($html, 'Entidad Federativa:') + 76, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Entidad Federativa:')) - strpos($html, 'Entidad Federativa:') - 76);
                    $municipio = substr($html, strpos($html, 'Municipio o delegación:') + 81, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Municipio o delegación:')) - strpos($html, 'Municipio o delegación:') - 81);
                    $colonia = substr($html, strpos($html, 'Colonia:') + 65, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Colonia:')) - strpos($html, 'Colonia:') - 65);
                    $tipo_vialidad = substr($html, strpos($html, 'Tipo de vialidad:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Tipo de vialidad:')) - strpos($html, 'Tipo de vialidad:') - 74);
                    $nombre_vialidad = substr($html, strpos($html, 'Nombre de la vialidad:') + 79, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Nombre de la vialidad:')) - strpos($html, 'Nombre de la vialidad:') - 79);
                    $numero_exterior = substr($html, strpos($html, 'Número exterior:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Número exterior:')) - strpos($html, 'Número exterior:') - 74);
                    $numero_interior = substr($html, strpos($html, 'Número interior:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Número interior:')) - strpos($html, 'Número interior:') - 74);
                    $codigo_postal = substr($html, strpos($html, 'CP:') + 60, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'CP:')) - strpos($html, 'CP:') - 60);
                    $correo_electronico = substr($html, strpos($html, 'Correo electrónico:') + 77, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Correo electrónico:')) - strpos($html, 'Correo electrónico:') - 77);
                    $AL = substr($html, strpos($html, 'AL:') + 60, strpos($html, '</td></tr></tbody>', strpos($html, 'AL:')) - strpos($html, 'AL:') - 60);

                    $clave_regimen = '';
                    $t = '';
                    $inicio = strpos($html, 'Régimen:');
                    $regimen = substr($html, strpos($html, 'Régimen:') + 66, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Régimen:')) - strpos($html, 'Régimen:') - 66);

                    $sql = "select clave from cat_regimen where nombre like '%" . str_replace("á", "a", str_replace("é", "e", str_replace("í", "i", str_replace("ó", "o", str_replace("ú", "u", str_replace("Régimen ", "", str_replace("Régimen de ", "", str_replace("Régimen de las ", "", $regimen)))))))) . "%'";
                    $re = $db->Ejecuta($sql);

                    if (isset($re[0]['clave'])) {

                        $clave_regimen = $re[0]['clave'];
                    }

                    while (strpos($html, 'Régimen:', $inicio + 5) !== false) {

                        $inicio = strpos($html, 'Régimen:', $inicio + 5);

                        $t = ': ' . substr($html, strpos($html, 'Régimen:', $inicio) + 66, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Régimen:', $inicio)) - strpos($html, 'Régimen:', $inicio) - 66);

                        $sql = "select clave from cat_regimen where nombre like '%" . str_replace("á", "a", str_replace("é", "e", str_replace("í", "i", str_replace("ó", "o", str_replace("ú", "u", str_replace(": Régimen ", "", str_replace(": Régimen de ", "", str_replace(": Régimen de las ", "", $t)))))))) . "%'";
                        $re = $db->Ejecuta($sql);

                        if (isset($re[0]['clave'])) {

                            $clave_regimen .= ': ' . $re[0]['clave'];
                        }

                        $regimen .= $t;
                    }

                    $idcif2 = strval($row['liga']);
                    $idcif22 = substr($idcif2, strlen('D3=') + strpos($idcif2, 'D3='), (strlen($idcif2) - strpos($idcif2, "_")) * (-1));

                    $sql = "update datosSAT set html='" . str_replace("'", "''", $html) . "', rfc='" . str_replace("'", "''", $rfc) . "', curp='" . str_replace("'", "''", $curp) . "', nombre='" . str_replace("'", "''", $nombre) . "', apellido_paterno='" . str_replace("'", "''", $apellido_paterno) . "', apellido_materno='" . str_replace("'", "''", $apellido_materno) . "'
                                , fecha_nacimiento='" . str_replace("'", "''", $fecha_nacimiento) . "', fecha_inicio_operaciones='" . str_replace("'", "''", $fecha_inicio_operaciones) . "', situacion_contribuyente='" . str_replace("'", "''", $situacion_contribuyente) . "'
                                , fecha_ultimo_cambio='" . str_replace("'", "''", $fecha_ultimo_cambio) . "', entidad_federativa='" . str_replace("'", "''", $entidad_federativa) . "', municipio='" . str_replace("'", "''", $municipio) . "', colonia='" . str_replace("'", "''", $colonia) . "'
                                , tipo_vialidad='" . str_replace("'", "''", $tipo_vialidad) . "', nombre_vialidad='" . str_replace("'", "''", $nombre_vialidad) . "', numero_exterior='" . str_replace("'", "''", $numero_exterior) . "', numero_interior='" . str_replace("'", "''", $numero_interior) . "'
                                , codigo_postal='" . str_replace("'", "''", $codigo_postal) . "', correo_electronico='" . str_replace("'", "''", $correo_electronico) . "', AL='" . str_replace("'", "''", $AL) . "', regimen='" . str_replace("'", "''", $regimen) . "'
                                , clave_regimen='" . str_replace("'", "''", $clave_regimen) . "', isempleado='" . str_replace("'", "''", $isempleado) . "'
                                , idCIF='" . str_replace("'", "''", $idcif22) . "'
                                where id_datosSAT=" . $row['id_datosSAT'];
                    $db->Insert($sql);
                } else {

                    $sql = "update datosSAT set html='" . str_replace("'", "''", $html) . "' where id_datosSAT=" . $row['id_datosSAT'];
                    $db->Insert($sql);
                }
            }
        }


        $db->close();

        return "Los datos se guardaron correctamente";
    }


    function guardaEscaneo2($post)
    {
        $db = new DB();
        $sql = "insert into datosSAT(id_cliente,liga,fecha) values({$_SESSION['id_usuario']},'{$post['liga']}',now())";
        $db->Insert($sql);


        if (!isset($_SESSION['contador'])) {
            $_SESSION['contador'] = 0;
        }

        $_SESSION['contador']++;

        ////////////////////////
        ///INSERT AL ESCANEAR///
        ////////////////////////

        $lastid = $db->InsertGetId();

        $sql2 = "select * from datosSAT where codigo_postal is null and id_datosSAT=" . $lastid;
        $datos = $db->Ejecuta($sql2);

        if (count($datos) > 0) {

            for ($i = 0; $i < count($datos); $i++) {

                $row = $datos[$i];

                $html = file_get_contents($row['liga']);

                $rfc =  substr($html, strlen('El RFC: ') + strpos($html, 'El RFC: '), (strlen($html) - strpos($html, ", tiene asociada la siguiente informac")) * (-1));
                $rfc = str_replace("'", "''", $rfc);

                if ($rfc != '') {

                    if (strlen($rfc) == 12) {
                        $curp = '';
                        $nombre = substr($html, strpos($html, 'n Social:') + 66, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'n Social:')) - strpos($html, 'n Social:') - 66);
                        $apellido_paterno = substr($html, strpos($html, 'de capital:') + 68, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'de capital:')) - strpos($html, 'de capital:') - 68);
                        $apellido_materno = '';
                        $fecha_nacimiento = substr($html, strpos($html, 'Fecha de constitución:') + 80, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Fecha de constitución:')) - strpos($html, 'Fecha de constitución:') - 80);
                        $isempleado = "0"; //false

                    }

                    if (strlen($rfc) == 13) {
                        $curp = substr($html, strpos($html, 'CURP:') + 62, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'CURP:')) - strpos($html, 'CURP:') - 62);
                        $nombre = substr($html, strpos($html, 'Nombre:') + 64, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Nombre:')) - strpos($html, 'Nombre:') - 64);
                        $apellido_paterno = substr($html, strpos($html, 'Apellido Paterno:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Apellido Paterno:')) - strpos($html, 'Apellido Paterno:') - 74);
                        $apellido_materno = substr($html, strpos($html, 'Apellido Materno:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Apellido Materno:')) - strpos($html, 'Apellido Materno:') - 74);
                        $fecha_nacimiento = substr($html, strpos($html, 'Fecha Nacimiento:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Fecha Nacimiento:')) - strpos($html, 'Fecha Nacimiento:') - 74);
                        $isempleado = "1"; //true  

                    }

                    $fecha_inicio_operaciones = substr($html, strpos($html, 'Fecha de Inicio de operaciones:') + 88, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Fecha de Inicio de operaciones:')) - strpos($html, 'Fecha de Inicio de operaciones:') - 88);
                    $situacion_contribuyente = substr($html, strpos($html, 'Situación del contribuyente:') + 86, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Situación del contribuyente:')) - strpos($html, 'Situación del contribuyente:') - 86);
                    $fecha_ultimo_cambio = substr($html, strpos($html, 'Fecha del último cambio de situación:') + 96, strpos($html, '</td></tr></tbody>', strpos($html, 'Fecha del último cambio de situación:')) - strpos($html, 'Fecha del último cambio de situación:') - 96);
                    $entidad_federativa = substr($html, strpos($html, 'Entidad Federativa:') + 76, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Entidad Federativa:')) - strpos($html, 'Entidad Federativa:') - 76);
                    $municipio = substr($html, strpos($html, 'Municipio o delegación:') + 81, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Municipio o delegación:')) - strpos($html, 'Municipio o delegación:') - 81);
                    $colonia = substr($html, strpos($html, 'Colonia:') + 65, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Colonia:')) - strpos($html, 'Colonia:') - 65);
                    $tipo_vialidad = substr($html, strpos($html, 'Tipo de vialidad:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Tipo de vialidad:')) - strpos($html, 'Tipo de vialidad:') - 74);
                    $nombre_vialidad = substr($html, strpos($html, 'Nombre de la vialidad:') + 79, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Nombre de la vialidad:')) - strpos($html, 'Nombre de la vialidad:') - 79);
                    $numero_exterior = substr($html, strpos($html, 'Número exterior:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Número exterior:')) - strpos($html, 'Número exterior:') - 74);
                    $numero_interior = substr($html, strpos($html, 'Número interior:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Número interior:')) - strpos($html, 'Número interior:') - 74);
                    $codigo_postal = substr($html, strpos($html, 'CP:') + 60, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'CP:')) - strpos($html, 'CP:') - 60);
                    $correo_electronico = substr($html, strpos($html, 'Correo electrónico:') + 77, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Correo electrónico:')) - strpos($html, 'Correo electrónico:') - 77);
                    $AL = substr($html, strpos($html, 'AL:') + 60, strpos($html, '</td></tr></tbody>', strpos($html, 'AL:')) - strpos($html, 'AL:') - 60);

                    $clave_regimen = '';
                    $t = '';
                    $inicio = strpos($html, 'Régimen:');
                    $regimen = substr($html, strpos($html, 'Régimen:') + 66, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Régimen:')) - strpos($html, 'Régimen:') - 66);

                    $sql = "select clave from cat_regimen where nombre like '%" . str_replace("á", "a", str_replace("é", "e", str_replace("í", "i", str_replace("ó", "o", str_replace("ú", "u", str_replace("Régimen ", "", str_replace("Régimen de ", "", str_replace("Régimen de las ", "", $regimen)))))))) . "%'";
                    $re = $db->Ejecuta($sql);

                    if (isset($re[0]['clave'])) {

                        $clave_regimen = $re[0]['clave'];
                    }

                    while (strpos($html, 'Régimen:', $inicio + 5) !== false) {

                        $inicio = strpos($html, 'Régimen:', $inicio + 5);

                        $t = ': ' . substr($html, strpos($html, 'Régimen:', $inicio) + 66, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Régimen:', $inicio)) - strpos($html, 'Régimen:', $inicio) - 66);

                        $sql = "select clave from cat_regimen where nombre like '%" . str_replace("á", "a", str_replace("é", "e", str_replace("í", "i", str_replace("ó", "o", str_replace("ú", "u", str_replace(": Régimen ", "", str_replace(": Régimen de ", "", str_replace(": Régimen de las ", "", $t)))))))) . "%'";
                        $re = $db->Ejecuta($sql);

                        if (isset($re[0]['clave'])) {

                            $clave_regimen .= ': ' . $re[0]['clave'];
                        }

                        $regimen .= $t;
                    }

                    $idcif2 = strval($row['liga']);
                    $idcif22 = substr($idcif2, strlen('D3=') + strpos($idcif2, 'D3='), (strlen($idcif2) - strpos($idcif2, "_")) * (-1));

                    $sql = "update datosSAT set html='" . str_replace("'", "''", $html) . "', rfc='" . str_replace("'", "''", $rfc) . "', curp='" . str_replace("'", "''", $curp) . "', nombre='" . str_replace("'", "''", $nombre) . "', apellido_paterno='" . str_replace("'", "''", $apellido_paterno) . "', apellido_materno='" . str_replace("'", "''", $apellido_materno) . "'
                                , fecha_nacimiento='" . str_replace("'", "''", $fecha_nacimiento) . "', fecha_inicio_operaciones='" . str_replace("'", "''", $fecha_inicio_operaciones) . "', situacion_contribuyente='" . str_replace("'", "''", $situacion_contribuyente) . "'
                                , fecha_ultimo_cambio='" . str_replace("'", "''", $fecha_ultimo_cambio) . "', entidad_federativa='" . str_replace("'", "''", $entidad_federativa) . "', municipio='" . str_replace("'", "''", $municipio) . "', colonia='" . str_replace("'", "''", $colonia) . "'
                                , tipo_vialidad='" . str_replace("'", "''", $tipo_vialidad) . "', nombre_vialidad='" . str_replace("'", "''", $nombre_vialidad) . "', numero_exterior='" . str_replace("'", "''", $numero_exterior) . "', numero_interior='" . str_replace("'", "''", $numero_interior) . "'
                                , codigo_postal='" . str_replace("'", "''", $codigo_postal) . "', correo_electronico='" . str_replace("'", "''", $correo_electronico) . "', AL='" . str_replace("'", "''", $AL) . "', regimen='" . str_replace("'", "''", $regimen) . "'
                                , clave_regimen='" . str_replace("'", "''", $clave_regimen) . "', isempleado='" . str_replace("'", "''", $isempleado) . "'
                                , idCIF='" . str_replace("'", "''", $idcif22) . "'
                                where id_datosSAT=" . $row['id_datosSAT'];
                    $db->Insert($sql);
                } else {

                    $sql = "update datosSAT set html='" . str_replace("'", "''", $html) . "' where id_datosSAT=" . $row['id_datosSAT'];
                    $db->Insert($sql);
                }
            }
        }


        $db->close();
        return array("msg" => "Los datos se guardaron correctamente", 'contador' => $_SESSION['contador']);
    }

    function getClientes()
    {
        $db = new DB();
        $sql = "select id_cliente id, razonsocial nombre from clientes order by 1";
        $datos = $db->Ejecuta($sql);
        $db->close();

        return $datos;
    }

    function getArchivosProcesar($id_cliente)
    {
        $db = new DB();
        $sql = "select id_archivosSAT id, concat(nombre,': ', fecha) nombre from archivosSAT where ifnull(procesado,'0')='0' and id_cliente=$id_cliente order by 1";
        $datos = $db->Ejecuta($sql);
        $db->close();

        return $datos;
    }

    function guardaArchivo($nombre, $liga, $tamaño, $tipo, $nombreOriginal, $directorio)
    {

        $db = new DB();


        if ($tipo == "application/pdf") {
            $sql = "insert into archivosSAT(id_cliente,archivo,liga,tamanio,tipo,nombre,carpeta,fecha) values({$_SESSION['id_usuario']},'$nombre','$liga','$tamaño','$tipo','$nombreOriginal','" . $directorio . "',now())";
            $db->Insert($sql);

            $sql = 'SELECT LAST_INSERT_ID() x';
            $datos = $db->Ejecuta($sql);
            $db->close();
        } else {
            $sql = "insert into archivosSAT(id_cliente,archivo,liga,tamanio,tipo,nombre,carpeta,fecha) values({$_SESSION['id_usuario']},'$nombre','$liga','$tamaño','$tipo','$nombreOriginal','" . $directorio . $nombre . "',now())";
            $db->Insert($sql);

            $sql = 'SELECT LAST_INSERT_ID() x';
            $datos = $db->Ejecuta($sql);
            $db->close();
        }

        mkdir($directorio . $nombre, 0777);

        if ($tipo == "application/x-zip-compressed") {

            $zip = new ZipArchive;

            $comprimido = $zip->open($liga);

            if ($comprimido === TRUE) {
                $zip->extractTo($directorio . $nombre);
                $zip->close();
            }
            $this->procesarPDFS_texto(array('id_archivosSAT' => $datos[0]['x'], "id_cliente" => $_SESSION['id_usuario']));
        } elseif ($tipo == "application/pdf") {

            $this->procesarPDFS_texto(array('id_archivosSAT' => $datos[0]['x'], "id_cliente" => $_SESSION['id_usuario']));
        } else {
            echo "<script> alert('EL PDF NO ES VALIDO') </script>";
        }
    }

    function procesarInformacion($id_cliente)
    {

        set_time_limit(0);
        $db = new DB();
        $sql = "select * from datosSAT where html is null";
        $datos = $db->Ejecuta($sql);

        if (count($datos) > 0) {

            for ($i = 0; $i < count($datos); $i++) {

                $row = $datos[$i];

                $html = file_get_contents($row['liga']);

                $rfc = substr($html, strpos($html, 'El RFC: ') + 8, strpos($html, ', tiene asociada la siguiente informac') - strpos($html, 'El RFC: ') - 8);

                if ($rfc != '') {
                    $curp = substr($html, strpos($html, 'CURP:') + 62, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'CURP:')) - strpos($html, 'CURP:') - 62);
                    $nombre = substr($html, strpos($html, 'Nombre:') + 64, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Nombre:')) - strpos($html, 'Nombre:') - 64);
                    $apellido_paterno = substr($html, strpos($html, 'Apellido Paterno:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Apellido Paterno:')) - strpos($html, 'Apellido Paterno:') - 74);
                    $apellido_materno = substr($html, strpos($html, 'Apellido Materno:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Apellido Materno:')) - strpos($html, 'Apellido Materno:') - 74);
                    $fecha_nacimiento = substr($html, strpos($html, 'Fecha Nacimiento:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Fecha Nacimiento:')) - strpos($html, 'Fecha Nacimiento:') - 74);
                    $fecha_inicio_operaciones = substr($html, strpos($html, 'Fecha de Inicio de operaciones:') + 88, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Fecha de Inicio de operaciones:')) - strpos($html, 'Fecha de Inicio de operaciones:') - 88);
                    $situacion_contribuyente = substr($html, strpos($html, 'Situación del contribuyente:') + 86, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Situación del contribuyente:')) - strpos($html, 'Situación del contribuyente:') - 86);
                    $fecha_ultimo_cambio = substr($html, strpos($html, 'Fecha del último cambio de situación:') + 96, strpos($html, '</td></tr></tbody>', strpos($html, 'Fecha del último cambio de situación:')) - strpos($html, 'Fecha del último cambio de situación:') - 96);
                    $entidad_federativa = substr($html, strpos($html, 'Entidad Federativa:') + 76, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Entidad Federativa:')) - strpos($html, 'Entidad Federativa:') - 76);
                    $municipio = substr($html, strpos($html, 'Municipio o delegación:') + 81, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Municipio o delegación:')) - strpos($html, 'Municipio o delegación:') - 81);
                    $colonia = substr($html, strpos($html, 'Colonia:') + 65, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Colonia:')) - strpos($html, 'Colonia:') - 65);
                    $tipo_vialidad = substr($html, strpos($html, 'Tipo de vialidad:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Tipo de vialidad:')) - strpos($html, 'Tipo de vialidad:') - 74);
                    $nombre_vialidad = substr($html, strpos($html, 'Nombre de la vialidad:') + 79, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Nombre de la vialidad:')) - strpos($html, 'Nombre de la vialidad:') - 79);
                    $numero_exterior = substr($html, strpos($html, 'Número exterior:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Número exterior:')) - strpos($html, 'Número exterior:') - 74);
                    $numero_interior = substr($html, strpos($html, 'Número interior:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Número interior:')) - strpos($html, 'Número interior:') - 74);
                    $codigo_postal = substr($html, strpos($html, 'CP:') + 60, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'CP:')) - strpos($html, 'CP:') - 60);
                    $correo_electronico = substr($html, strpos($html, 'Correo electrónico:') + 77, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Correo electrónico:')) - strpos($html, 'Correo electrónico:') - 77);
                    $AL = substr($html, strpos($html, 'AL:') + 60, strpos($html, '</td></tr></tbody>', strpos($html, 'AL:')) - strpos($html, 'AL:') - 60);

                    $sql = "update datosSAT set html='" . str_replace("'", "''", $html) . "',  rfc='" . str_replace("'", "''", $rfc) . "', curp='" . str_replace("'", "''", $curp) . "', nombre='" . str_replace("'", "''", $nombre) . "', apellido_paterno='" . str_replace("'", "''", $apellido_paterno) . "', apellido_materno='" . str_replace("'", "''", $apellido_materno) . "'
                                , fecha_nacimiento='" . str_replace("'", "''", $fecha_nacimiento) . "', fecha_inicio_operaciones='" . str_replace("'", "''", $fecha_inicio_operaciones) . "', situacion_contribuyente='" . str_replace("'", "''", $situacion_contribuyente) . "'
                                , fecha_ultimo_cambio='" . str_replace("'", "''", $fecha_ultimo_cambio) . "', entidad_federativa='" . str_replace("'", "''", $entidad_federativa) . "', municipio='" . str_replace("'", "''", $municipio) . "', colonia='" . str_replace("'", "''", $colonia) . "'
                                , tipo_vialidad='" . str_replace("'", "''", $tipo_vialidad) . "', nombre_vialidad='" . str_replace("'", "''", $nombre_vialidad) . "', numero_exterior='" . str_replace("'", "''", $numero_exterior) . "', numero_interior='" . str_replace("'", "''", $numero_interior) . "'
                                , codigo_postal='" . str_replace("'", "''", $codigo_postal) . "', correo_electronico='" . str_replace("'", "''", $correo_electronico) . "', AL='" . str_replace("'", "''", $AL) . "'
                            where id_datosSAT=" . $row['id_datosSAT'];
                    $db->Insert($sql);
                } else {

                    $sql = "update datosSAT set html='" . str_replace("'", "''", $html) . "' where id_datosSAT=" . $row['id_datosSAT'];
                    $db->Insert($sql);
                }
            }
        }

        $db->close();
        return 'La información se proceso correctamente.';
    }


    function procesarInformacionRegistros($post)
    {

        set_time_limit(0);

        $db = new DB();
        // $db2 = new DB2();
        $sql = "select * from datosSAT where codigo_postal is null and id_cliente=" . $post['id_cliente'] . "  order by 1 limit 0," . $post['registros'];
        $datos = $db->Ejecuta($sql);


        if (count($datos) > 0) {

            for ($i = 0; $i < count($datos); $i++) {

                $row = $datos[$i];

                $html = file_get_contents($row['liga']);

                $rfc = substr($html, strpos($html, 'El RFC: ') + 8, strpos($html, ', tiene asociada la siguiente informac') - strpos($html, 'El RFC: ') - 8);


                if ($rfc != '') {
                    if (strlen($rfc) == 12) {

                        $curp = '';
                        $nombre = substr($html, strpos($html, 'n Social:') + 66, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'n Social:')) - strpos($html, 'n Social:') - 66);
                        $apellido_paterno = substr($html, strpos($html, 'de capital:') + 68, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'de capital:')) - strpos($html, 'de capital:') - 68);
                        $apellido_materno = '';
                        $fecha_nacimiento = substr($html, strpos($html, 'Fecha de constitución:') + 80, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Fecha de constitución:')) - strpos($html, 'Fecha de constitución:') - 80);
                        $isempleado = "0"; //false
                    }

                    if (strlen($rfc) == 13) {
                        $curp = substr($html, strpos($html, 'CURP:') + 62, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'CURP:')) - strpos($html, 'CURP:') - 62);
                        $nombre = substr($html, strpos($html, 'Nombre:') + 64, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Nombre:')) - strpos($html, 'Nombre:') - 64);
                        $apellido_paterno = substr($html, strpos($html, 'Apellido Paterno:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Apellido Paterno:')) - strpos($html, 'Apellido Paterno:') - 74);
                        $apellido_materno = substr($html, strpos($html, 'Apellido Materno:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Apellido Materno:')) - strpos($html, 'Apellido Materno:') - 74);
                        $fecha_nacimiento = substr($html, strpos($html, 'Fecha Nacimiento:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Fecha Nacimiento:')) - strpos($html, 'Fecha Nacimiento:') - 74);
                        $isempleado = "1"; //true  
                    }

                    $fecha_inicio_operaciones = substr($html, strpos($html, 'Fecha de Inicio de operaciones:') + 88, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Fecha de Inicio de operaciones:')) - strpos($html, 'Fecha de Inicio de operaciones:') - 88);
                    $situacion_contribuyente = substr($html, strpos($html, 'Situación del contribuyente:') + 86, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Situación del contribuyente:')) - strpos($html, 'Situación del contribuyente:') - 86);
                    $fecha_ultimo_cambio = substr($html, strpos($html, 'Fecha del último cambio de situación:') + 96, strpos($html, '</td></tr></tbody>', strpos($html, 'Fecha del último cambio de situación:')) - strpos($html, 'Fecha del último cambio de situación:') - 96);
                    $entidad_federativa = substr($html, strpos($html, 'Entidad Federativa:') + 76, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Entidad Federativa:')) - strpos($html, 'Entidad Federativa:') - 76);
                    $municipio = substr($html, strpos($html, 'Municipio o delegación:') + 81, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Municipio o delegación:')) - strpos($html, 'Municipio o delegación:') - 81);
                    $colonia = substr($html, strpos($html, 'Colonia:') + 65, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Colonia:')) - strpos($html, 'Colonia:') - 65);
                    $tipo_vialidad = substr($html, strpos($html, 'Tipo de vialidad:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Tipo de vialidad:')) - strpos($html, 'Tipo de vialidad:') - 74);
                    $nombre_vialidad = substr($html, strpos($html, 'Nombre de la vialidad:') + 79, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Nombre de la vialidad:')) - strpos($html, 'Nombre de la vialidad:') - 79);
                    $numero_exterior = substr($html, strpos($html, 'Número exterior:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Número exterior:')) - strpos($html, 'Número exterior:') - 74);
                    $numero_interior = substr($html, strpos($html, 'Número interior:') + 74, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Número interior:')) - strpos($html, 'Número interior:') - 74);
                    $codigo_postal = substr($html, strpos($html, 'CP:') + 60, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'CP:')) - strpos($html, 'CP:') - 60);
                    $correo_electronico = substr($html, strpos($html, 'Correo electrónico:') + 77, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Correo electrónico:')) - strpos($html, 'Correo electrónico:') - 77);
                    $AL = substr($html, strpos($html, 'AL:') + 60, strpos($html, '</td></tr></tbody>', strpos($html, 'AL:')) - strpos($html, 'AL:') - 60);

                    $clave_regimen = '';
                    $t = '';
                    $inicio = strpos($html, 'Régimen:');
                    $regimen = substr($html, strpos($html, 'Régimen:') + 66, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Régimen:')) - strpos($html, 'Régimen:') - 66);

                    $sql = "select clave from cat_regimen where nombre like '%" . str_replace("á", "a", str_replace("é", "e", str_replace("í", "i", str_replace("ó", "o", str_replace("ú", "u", str_replace("Régimen ", "", str_replace("Régimen de ", "", str_replace("Régimen de las ", "", $regimen)))))))) . "%'";
                    $re = $db->Ejecuta($sql);

                    if (isset($re[0]['clave'])) {

                        $clave_regimen = $re[0]['clave'];
                    }

                    while (strpos($html, 'Régimen:', $inicio + 5) !== false) {

                        $inicio = strpos($html, 'Régimen:', $inicio + 5);

                        $t = ': ' . substr($html, strpos($html, 'Régimen:', $inicio) + 66, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Régimen:', $inicio)) - strpos($html, 'Régimen:', $inicio) - 66);

                        $sql = "select clave from cat_regimen where nombre like '%" . str_replace("á", "a", str_replace("é", "e", str_replace("í", "i", str_replace("ó", "o", str_replace("ú", "u", str_replace(": Régimen ", "", str_replace(": Régimen de ", "", str_replace(": Régimen de las ", "", $t)))))))) . "%'";
                        $re = $db->Ejecuta($sql);

                        if (isset($re[0]['clave'])) {

                            $clave_regimen .= ': ' . $re[0]['clave'];
                        }

                        $regimen .= $t;
                    }

                    $idcif2 = strval($row['liga']);
                    $idcif22 = substr($idcif2, strlen('D3=') + strpos($idcif2, 'D3='), (strlen($idcif2) - strpos($idcif2, "_")) * (-1));
                    $idcif222 = strval($idcif22);;


                    $sql = "update datosSAT set html='" . str_replace("'", "''", $html) . "', rfc='" . str_replace("'", "''", $rfc) . "', curp='" . str_replace("'", "''", $curp) . "', nombre='" . str_replace("'", "''", $nombre) . "', apellido_paterno='" . str_replace("'", "''", $apellido_paterno) . "', apellido_materno='" . str_replace("'", "''", $apellido_materno) . "'
                                , fecha_nacimiento='" . str_replace("'", "''", $fecha_nacimiento) . "', fecha_inicio_operaciones='" . str_replace("'", "''", $fecha_inicio_operaciones) . "', situacion_contribuyente='" . str_replace("'", "''", $situacion_contribuyente) . "'
                                , fecha_ultimo_cambio='" . str_replace("'", "''", $fecha_ultimo_cambio) . "', entidad_federativa='" . str_replace("'", "''", $entidad_federativa) . "', municipio='" . str_replace("'", "''", $municipio) . "', colonia='" . str_replace("'", "''", $colonia) . "'
                                , tipo_vialidad='" . str_replace("'", "''", $tipo_vialidad) . "', nombre_vialidad='" . str_replace("'", "''", $nombre_vialidad) . "', numero_exterior='" . str_replace("'", "''", $numero_exterior) . "', numero_interior='" . str_replace("'", "''", $numero_interior) . "'
                                , codigo_postal='" . str_replace("'", "''", $codigo_postal) . "', correo_electronico='" . str_replace("'", "''", $correo_electronico) . "', AL='" . str_replace("'", "''", $AL) . "', regimen='" . str_replace("'", "''", $regimen) . "'
                                , clave_regimen='" . str_replace("'", "''", $clave_regimen) . "', isempleado='" . str_replace("'", "''", $isempleado) . "'
                                , idCIF='" . str_replace("'", "''", $idcif222) . "'
                                where id_datosSAT=" . $row['id_datosSAT'];
                    $db->Insert($sql);
                } else {

                    $sql = "update datosSAT set html='" . str_replace("'", "''", $html) . "' where id_datosSAT=" . $row['id_datosSAT'];
                    $db->Insert($sql);
                }
            }
        }

        $sql = "insert into compras (id_cliente,fecha,registros,precio) values(" . $post['id_cliente'] . ",now()," . $post['registros'] . "," . $GLOBALS['valor'] . ");";
        $db->Insert($sql);

        // $db2->close();
        $db->close();
        return 'La información se proceso correctamente.';
    }

    function procesarPDFS_texto($post)
    {

        $db = new DB();
        $sql = "select carpeta from archivosSAT where id_archivosSAT={$post['id_archivosSAT']} order by 1";
        $datos = $db->Ejecuta($sql);
        $db->close();

        $ruta = $datos[0]['carpeta'];
        $texto = "";
        $mensaje = "";
        $i = 0;

        if ($handler = opendir($ruta)) {
            while (false !== ($file = readdir($handler))) {
                if (substr(strtolower($file), strlen($file) - 4, 4) == '.pdf') {

                    $idCIF = "";
                    // $a = new PDF2Text();
                    // $a->setFilename($ruta . "/" . $file);
                    require '../vendor/autoload.php';
                    $parser = new \Smalot\PdfParser\Parser();

                    $pdf = $parser->parseFile($ruta . "/" . $file);
                    $texto = $pdf->getText();

                    // $texto = utf8_encode($texto);

                    if (strpos($texto, 'CONSTANCIA DE SITUACIÓN FISCAL') !== false) {
                        $idCIF = substr($texto, strpos($texto, 'idCIF: ') + 7, strpos($texto, 'VALIDA TU', strpos($texto, 'idCIF: ')) - strpos($texto, 'idCIF: ') - 8);
                        $idCIF = preg_replace('/\s+/', '', $idCIF);

                        if (strpos($texto, 'CURP') !== false) {
                            $rfc = substr($texto, strpos($texto, 'RFC:') + 5, strpos($texto, 'CURP:', strpos($texto, 'RFC:')) - strpos($texto, 'RFC:') - 6);
                            $rfc = preg_replace('/\s+/', '', $rfc);
                        } else {
                            $rfc = substr($texto, strpos($texto, 'RFC:') + 5, strpos($texto, 'Denominación/Razón', strpos($texto, 'RFC:')) - strpos($texto, 'RFC:') - 6);
                            $rfc = preg_replace('/\s+/', '', $rfc);
                        }


                        $this->guardaDatos(array("id_cliente" => $post['id_cliente'], "rfc" => $rfc, "idCIF" => $idCIF, "id_archivosSAT" => $post['id_archivosSAT']));
                        $i++;
                    }
                }
            }
            closedir($handler);
        } else {
            $mensaje = "Hay un error en la ruta.";
        }

        if ($i == 0) {

            $mensaje = "No se encontraron archivos PDFs de contancias de situación fiscal en la ruta.";
        } else {

            $mensaje = "Se procesaron $i archivos PDF";
            $db = new DB();
            $sql = "update archivosSAT set procesado = '1' where id_archivosSAT={$post['id_archivosSAT']}";
            $db->Insert($sql);
            $db->close();
        }
        return $mensaje;
    }

    function guardaPago($cliente, $titulo, $monto, $id, $obj)
    {

        $monto = str_replace(",", "", $monto);
        $titulo = str_replace("'", "''", $titulo);
        $obj = str_replace("'", "''", $obj);

        $db = new DB();
        $sql = "insert into pagos(id_cliente,id_pago_MP,fecha,titulo,monto,objeto) values($cliente,'$id',now(),'$titulo',$monto,'$obj')";
        $db->Insert($sql);

        $sql = 'SELECT LAST_INSERT_ID() x';
        $datos = $db->Ejecuta($sql);
        $db->close();

        return $datos[0]['x'];
    }

    function actualizaPago()
    {

        $url = 'https://api.mercadopago.com/v1/payments/search?access_token=' . $GLOBALS['acces_token'] . '&begin_date=NOW-20HOURS&end_date=NOW#json';
        // $url = 'https://api.mercadopago.com/v1/payments/search?access_token=' . $GLOBALS['acces_token'];


        $ch = curl_init($url);

        // Configuring curl options
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
            CURLOPT_HTTPHEADER => array('Accept: application/json'),
            CURLOPT_SSL_VERIFYPEER => false,
        );
        // Setting curl options
        curl_setopt_array($ch, $options);
        // Getting results
        $response = curl_exec($ch); // Getting jSON result string  
        // Cerrar el recurso cURL y liberar recursos del sistema
        curl_close($ch);
        $data = json_decode($response);
        $resultado = $data->results;

        $db = new DB();

        if (count($resultado) > 0) {

            for ($i = 0; $i < count($resultado); $i++) {
                if (isset($resultado[$i]->id)) {
                    $x = serialize($resultado[$i]);
                    $sql = "update pagos set id_pago_MP='" . $resultado[$i]->id . "', status='" . $resultado[$i]->status . "',objeto='" . str_replace("'", "''", $x) . "' where concat(replace(titulo,'/',''),' id ', id_pago)='" . $resultado[$i]->description . "' and status='inicido'";

                    $db->Insert($sql);
                }
            }
        }

        $sqlconsulta = "select status from pagos where `id_cliente`='" . $_SESSION['id_usuario'] . "'";
        $res1 = $db->Ejecuta($sqlconsulta);

        $sqlconsulta2 = "select paquete from paquete where `id_cliente`='" . $_SESSION['id_usuario'] . "'";
        $res2 = $db->Ejecuta($sqlconsulta2);


        if ($res2[0]['paquete'] == '1') {

            for ($x = 0; $x < count($res1); $x++) {

                if ($res1[$x]['status'] == "approved") {

                    $sqlc2 = "select titulo from pagos where `id_cliente`='" . $_SESSION['id_usuario'] . "' and `status`='approved'";
                    $tit = $db->Ejecuta($sqlc2);

                    if (strpos($tit[0]['titulo'], 'PYME')) {

                        $date = date("Y/m/d");

                        if ($_SESSION['tiempo'] == "MENSUAL") {
                            $mod_date = strtotime($date . "+ 1 months");
                            $vigencia2 = date("Y/m/d", $mod_date);
                        }
                        if ($_SESSION['tiempo'] == "TRIMESTRAL") {
                            $mod_date = strtotime($date . "+ 3 months");
                            $vigencia2 = date("Y/m/d", $mod_date);
                        }
                        if ($_SESSION['tiempo'] == "SEMESTRAL") {
                            $mod_date = strtotime($date . "+ 6 months");
                            $vigencia2 = date("Y/m/d", $mod_date);
                        }
                        if ($_SESSION['tiempo'] == "ANUAL") {
                            $mod_date = strtotime($date . "+ 1 year");
                            $vigencia2 = date("Y/m/d", $mod_date);
                        }

                        $mod_date2 = strtotime($date . "+ 1 month");
                        $proxactu = date("Y/m/d", $mod_date2);

                        $sql2 = "update paquete set paquete='2', tip_actualizacion='" . $_SESSION['tiempo'] . "', prox_actu='" . $proxactu . "', rfcs_mensuales='" . $_SESSION['rfcs'] . "', rfcs_restantes='" . $_SESSION['rfcs'] . "', contratacion='" . date('Y/m/d') . "', vigencia='" . $vigencia2 . "' where id_cliente='" . $_SESSION['id_usuario'] . "'";
                        // var_dump($sql2);
                        $db->Insert($sql2);
                    } elseif (strpos($tit[0]['titulo'], 'ERP')) {

                        $date = date("Y/m/d");

                        if ($_SESSION['tiempo'] == "MENSUAL") {
                            $mod_date = strtotime($date . "+ 1 months");
                            $vigencia2 = date("Y/m/d", $mod_date);
                        }
                        if ($_SESSION['tiempo'] == "TRIMESTRAL") {
                            $mod_date = strtotime($date . "+ 3 months");
                            $vigencia2 = date("Y/m/d", $mod_date);
                        }
                        if ($_SESSION['tiempo'] == "SEMESTRAL") {
                            $mod_date = strtotime($date . "+ 6 months");
                            $vigencia2 = date("Y/m/d", $mod_date);
                        }
                        if ($_SESSION['tiempo'] == "ANUAL") {
                            $mod_date = strtotime($date . "+ 1 year");
                            $vigencia2 = date("Y/m/d", $mod_date);
                        }

                        $mod_date2 = strtotime($date . "+ 1 month");
                        $proxactu = date("Y/m/d", $mod_date2);

                        $sql2 = "update paquete set paquete='3', tip_actualizacion='" . $_SESSION['tiempo'] . "', prox_actu='" . $proxactu . "', rfcs_mensuales='" . $_SESSION['rfcs'] . "', rfcs_restantes='" . $_SESSION['rfcs'] . "', contratacion='" . date('Y/m/d') . "', vigencia='" . $vigencia2 . "' where id_cliente='" . $_SESSION['id_usuario'] . "'";
                        // var_dump($sql2);
                        $db->Insert($sql2);
                    }
                }
            }
        }

        $sqlconsulta3 = "select vigencia from paquete where `id_cliente`='" . $_SESSION['id_usuario'] . "'";
        $res3 = $db->Ejecuta($sqlconsulta3);

        $today = date("Y-m-d");

        if ($today > $res3[0]['vigencia']) {
            $sqlconsulta4 = "update paquete set paquete='1', tip_actualizacion=NULL, prox_actu=NULL, rfcs_mensuales=NULL, rfcs_restantes=NULL, contratacion=NULL, vigencia=NULL";
            $db->Insert($sqlconsulta4);
        }

        $db->close();
    }

    function saldo()
    {

        $db = new DB();
        $sql = "select ifnull(sum(monto) - (select count(*)*" . $GLOBALS['valor'] . " from datosSAT where id_cliente=" . $_SESSION['id_usuario'] . " and codigo_postal is not null),0)monto
                from pagos
                where id_cliente=" . $_SESSION['id_usuario'] . "
                        and status='approved'";
        $datos = $db->Ejecuta($sql);
        $db->close();

        if (!isset($datos[0]['monto'])) {

            return 0;
        }

        return $datos[0]['monto'];
    }


    function compras()
    {

        $db = new DB();
        $sql = "select * from compras where id_cliente=" . $_SESSION['id_usuario'] . " order by fecha desc";
        $datos = $db->Ejecuta($sql);
        $db->close();

        return $datos;
    }

    function sinProcesar()
    {

        $db = new DB();
        $sql = "select count(*) x from datosSAT where id_cliente=" . $_SESSION['id_usuario'] . " and codigo_postal is null";
        $datos = $db->Ejecuta($sql);
        $db->close();

        return $datos[0]['x'];
    }

    function procesados()
    {

        $db = new DB();
        $sql = "select count(*) x from datosSAT where id_cliente=" . $_SESSION['id_usuario'] . " and codigo_postal is not null";
        $datos = $db->Ejecuta($sql);
        $db->close();

        return $datos[0]['x'];
    }


    function recargas()
    {

        $db = new DB();
        $sql = "select * from pagos where id_cliente=" . $_SESSION['id_usuario'] . " and status='approved' order by 1 desc";
        $datos = $db->Ejecuta($sql);
        $db->close();

        return $datos;
    }


    function getReporteDescarga($get)
    {
        ob_clean();
        $db = new DB();
        $sql = "select fecha,rfc,curp,nombre,apellido_paterno,apellido_materno,fecha_nacimiento,fecha_inicio_operaciones,situacion_contribuyente, fecha_ultimo_cambio
                    , entidad_federativa,municipio,colonia,tipo_vialidad,nombre_vialidad,numero_exterior,numero_interior,codigo_postal,correo_electronico,al, regimen, clave_regimen
            from datosSAT where id_cliente=" . $get['id_cliente'] . " and codigo_postal is not null";
        $result = $db->Ejecuta($sql);
        $db->close();

        $html = "";

        if (count($result) > 0) {

            $html = "<table border='1'><thead class='encabezado'><tr>";

            $renglon = $result[0];

            foreach ($renglon as $llave => $valor) {

                $html .= "<th>$llave</th>";
            }

            $html .= "</tr></thead><tbody>";

            for ($i = 0; $i < count($result); $i++) {

                $html .= "<tr>";

                $renglon = $result[$i];
                $cal = 0;

                foreach ($renglon as $llave => $valor) {

                    $cal++;

                    /*if($cal >=6){
						$html .= "<td>$" . number_format($valor,2,'.',',') . "</td>";
					}
					else{*/
                    $html .= "<td>$valor</td>";
                    //}

                }

                $html .= "</tr>";
            }

            $html .= "</tbody></table>";
        }

        return utf8_decode($html);
    }

    function guardaTransferencia($post)
    {

        $cliente = $post['id_cliente'];
        $monto = str_replace(",", "", $post['monto']);
        $titulo = str_replace("'", "''", $post['titulo']);

        $db = new DB();
        $sql = "insert into pagos(id_cliente,id_pago_MP,fecha,titulo,monto,status) values($cliente,'-1',now(),'$titulo',$monto,'approved')";
        $db->Insert($sql);

        $sql = 'SELECT LAST_INSERT_ID() x';
        $datos = $db->Ejecuta($sql);
        $db->close();

        return 'La información se guardo correctamente, con el registro con id=' . $datos[0]['x'];
    }

    function saberPaquete()
    {
        $db = new DB();
        $sql = "select paquete from paquete where id_clinete=" . $_SESSION['id_usuario'] . "";
        $datos = $db->Ejecuta($sql);
        $db->close();

        if ($datos == "1") {
            $paquete = "Sin paquete";
        }

        if ($datos == "2") {
            $db = new DB();
            $sql = "select paquete from paquete where id_cliente=" . $_SESSION['id_usuario'] . "";
            $datos = $db->Ejecuta($sql);
            $db->close();

            $paquete = "PYME";
        }

        if ($datos == "3") {
            $paquete = "ERP";
        }

        return $paquete;
    }

    function rfc_rest()
    {

        $db = new DB();
        $sql = "select paquete from paquete where id_cliente=" . $_SESSION['id_usuario'] . "";
        $datos = $db->Ejecuta($sql);
        $db->close();

        if ($datos[0]['paquete'] == 1) {

            $db = new DB();
            $sql = "select ifnull(sum(monto) - (select count(*)*" . $GLOBALS['valor'] . " from datosSAT where id_cliente=" . $_SESSION['id_usuario'] . " and codigo_postal is not null),0)monto
                from pagos
                where id_cliente=" . $_SESSION['id_usuario'] . "
                        and status='approved'";
            $datos = $db->Ejecuta($sql);
            $db->close();

            if (!isset($datos[0]['monto'])) {

                return 0;
            }

            return "Sin paquete <br>  $" . $datos[0]['monto'];
        } else {
            $db = new DB();
            $sql = "select rfcs_restantes from paquete where id_cliente=" . $_SESSION['id_usuario'] . "";
            $datos2 = $db->Ejecuta($sql);
            $db->close();

            return $datos2[0]['rfcs_restantes'];
        }
    }
}
