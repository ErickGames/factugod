<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

ini_set('upload_max_filesize', '1000M');
ini_set('post_max_size', '1000M');
set_time_limit(0);

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ./");
}

/*if(isset($_GET['d']) && !isset($_SESSION['id_usuario'])){

    $_SESSION['id_usuario'] = $_GET['d'];
}else{
    if(!isset($_SESSION['id_usuario'])){
        $_SESSION['id_usuario'] = '1';
    }
}*/

extract($_POST);
if (isset($btnSubir)) {

    $zip = zip_open($_FILES['filArchivo']['type']);
    $name = ($_FILES['filArchivo']['name']);

    if ($_FILES['filArchivo']['type'] == "application/x-zip-compressed") {

        $nombre = date('d m Y G i s');

        $nombre_archivo = '../archivos/' . $_SESSION['id_usuario'] . '/' . $nombre . '.zip';

        if (!is_dir('../archivos')) {

            mkdir('../archivos', 0777);
        }

        if (!is_dir('../archivos/' . $_SESSION['id_usuario'])) {

            mkdir('../archivos/' . $_SESSION['id_usuario'], 0777);
        }

        if (move_uploaded_file($_FILES['filArchivo']['tmp_name'],  $nombre_archivo)) {

            $s = new SAT();

            $s->guardaArchivo($nombre, $nombre_archivo, $_FILES['filArchivo']['size'], $_FILES['filArchivo']['type'], $_FILES['filArchivo']['name'], '../archivos/' . $_SESSION['id_usuario'] . '/');
            echo "<script>alert('El archivo ha sido cargado correctamente.')</script>";

            unset($_FILES);
        } else {
            echo "<script>alert('Ocurrió algún error al subir el fichero. No pudo guardarse.')</script>";
        }
    } elseif (is_resource($zip)) {


        $nombre = date('d m Y G i s');

        $nombre_archivo = '../archivos/' . $_SESSION['id_usuario'] . '/' . $nombre . '.zip';

        if (!is_dir('../archivos')) {

            mkdir('../archivos', 0777);
        }

        if (!is_dir('../archivos/' . $_SESSION['id_usuario'])) {

            mkdir('../archivos/' . $_SESSION['id_usuario'], 0777);
        }

        if (move_uploaded_file($_FILES['filArchivo']['tmp_name'],  $nombre_archivo)) {

            $s = new SAT();

            $s->guardaArchivo($nombre, $nombre_archivo, $_FILES['filArchivo']['size'], $_FILES['filArchivo']['type'], $_FILES['filArchivo']['name'], '../archivos/' . $_SESSION['id_usuario'] . '/');
            echo "<script>alert('El archivo ha sido cargado correctamente.')</script>";

            unset($_FILES);
        } else {
            echo "<script>alert('Ocurrió algún error al subir el fichero. No pudo guardarse.')</script>";
        }

    } elseif (substr($name, -3) == "zip") {

        $nombre = date('d m Y G i s');

        $nombre_archivo = '../archivos/' . $_SESSION['id_usuario'] . '/' . $nombre . '.zip';

        if (!is_dir('../archivos')) {

            mkdir('../archivos', 0777);
        }

        if (!is_dir('../archivos/' . $_SESSION['id_usuario'])) {

            mkdir('../archivos/' . $_SESSION['id_usuario'], 0777);
        }

        if (move_uploaded_file($_FILES['filArchivo']['tmp_name'],  $nombre_archivo)) {

            $s = new SAT();

            $s->guardaArchivo($nombre, $nombre_archivo, $_FILES['filArchivo']['size'], $_FILES['filArchivo']['type'], $_FILES['filArchivo']['name'], '../archivos/' . $_SESSION['id_usuario'] . '/');
            echo "<script>alert('El archivo ha sido cargado correctamente.')</script>";

            unset($_FILES);
        } else {
            echo "<script>alert('Ocurrió algún error al subir el fichero. No pudo guardarse.')</script>";
        }
        
    }  elseif ($_FILES['filArchivo']['type'] == "application/pdf") {

        $nombre = date('d m Y G i s');

        $nombre_archivo = '../archivos/' . $_SESSION['id_usuario'] . '/' . $nombre . '.pdf';

        if (!is_dir('../archivos')) {

            mkdir('../archivos', 0777);
        }

        if (!is_dir('../archivos/' . $_SESSION['id_usuario'])) {

            mkdir('../archivos/' . $_SESSION['id_usuario'], 0777);
        }

        if (move_uploaded_file($_FILES['filArchivo']['tmp_name'],  $nombre_archivo)) {

            $s = new SAT();

            $s->guardaArchivo($nombre, $nombre_archivo, $_FILES['filArchivo']['size'], $_FILES['filArchivo']['type'], $_FILES['filArchivo']['name'], '../archivos/' . $_SESSION['id_usuario'] . '/');
            echo "<script>alert('El archivo ha sido cargado correctamente.')</script>";

            unset($_FILES);
        } else {
            echo "<script>alert('Ocurrió algún error al subir el fichero. No pudo guardarse.')</script>";
        }

    }else {
        echo "<script>alert('El tipo de archivo no es correcto.')</script>";
        echo $_FILES['filArchivo'];
        echo $_FILES['filArchivo']['type'];
        echo $_FILES['filArchivo']['name'];
    }

}

?>


<script>
    $(document).ajaxStart(function() {
        $("#loading").show();
    });

    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

        /*$("#btnEscanera").click(function() {
            
            escanear();
            
        });

        $("#btnIngresar").click(function() {
            
            ingresar();
            
        });*/

        $("#btnSubirZIP").click(function() {

            subir();

        });

        /*$("#btnGuardar").click(function() {
            
            validar();
            
        });
        
        $("#divIngresarDatos").css("display","none");
        $("#divSubirZIP").css("display","none");*/

        $("#loading").hide();
    });

    $(document).ajaxStop(function() {
        $("#loading").hide();
    });

    function escanear() {

        document.location.href = '../gui/qr.php';

    }

    function ingresar() {

        $("#divIngresarDatos").css("display", "block");
        $("#divSubirZIP").css("display", "none");
    }

    function subir() {
        $("#divIngresarDatos").css("display", "none");
        $("#divSubirZIP").css("display", "block");
    }

    function validar() {
        var msg = '';

        if ($("#txtRFC").val() == '') {
            msg = msg + 'Favor de ingresar el RFC\n';
        }

        if ($("#txtIdCIF").val() == '') {
            msg = msg + 'favor de ingresar el idCIF\n';
        }

        if (msg == '') {
            $.ajax({
                url: '../ajax/alta_datos_sat.php',
                dataType: "text",
                data: {
                    'rfc': $("#txtRFC").val(),
                    'idCIF': $("#txtIdCIF").val()
                },
                type: 'post',
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function(data) {
                    alert(data);
                    //location.reload();
                },
                complete: function(data) {
                    $("#loading").hide();
                }
            });
        } else {
            alert(msg);
        }

    }
</script>
<!--<div class="row g-5">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
        <h4 class="blog-post-title mb-4">Seleccione la opcion que desa usar:</h4>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    
    <div class="btn-group-vertical col-md-6" role="group">
        <button type='button' id="btnEscanera" class="btn btn-bd-secondary">Escanear codigo QR</button>
   
        <button type='button' id="btnIngresar" class="btn btn-bd-secondary">Ingresas datos</button>
        
        <button type='button' id="btnSubirZIP" class="btn btn-bd-secondary">Subir Archivo ZIP</button>
        
    </div>

    <div class="row g-5">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div id="divIngresarDatos">
                <table>
                    <tr>
                        <td>
                        <strong>RFC</strong>
                        </td>
                        <td>
                            <input type="text"  class="form-control" id="txtRFC"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <strong>idCIF</strong>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="txtIdCIF"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <button type='button' id="btnGuardar" class="btn btn-success">Guardar</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>-->

<style>
    body {
        overflow-x: hidden;
        background-color: white;
        background: white;
    }

    #div1 {
        min-height: 100vh;
    }

    @media (max-width:766px) {
        #div1 {
            min-height: auto;
        }
    }
</style>

<div class="row" id="div1">

    <div id="div1" class="col-md-3" style=" background: rgb(27, 15, 51); background: linear-gradient(90deg, rgba(27, 15, 51, 1) 0%, rgba(68, 42, 122, 1) 40%); ">
        <img src="../imagenes/infoicoblanco.png" alt="" style="display: block; margin:auto; margin-top:20px;">
        <h2 style="color: white;font-weight: 900; text-align:center; margin-top:20px; font-family:sources">Subir Archivo <br> .ZIP</h2>
        <h5 style="color: white;font-weight: 400; text-align:center; font-size:30px; font-family:sources">
            <?php echo $_SESSION['razonsocial'] ?></h5>
    </div>

    <div class="col-md-9 resp1">
        <!-- <h2 style="color: #482c7c;font-weight: 900; font-family:sans-serif; margin-top:20px">Selecciona un archivo para subir:</h2> -->
        <br> <br>

        <div class="row g-5">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div id="divSubirZIP">
                    <p style="color:black ; font-family:tit; font-size:25px">Selecciona un archivo .ZIP</p>
                    <form method="post" enctype="multipart/form-data">

                        <input type="file" class="form-control" id="filArchivo" name='filArchivo' />
                        <br>
                        <input style="margin-bottom:150px" type="submit" id="btnSubir" name='btnSubir' value="Subir" class="btn btn-success" />

                    </form>
                </div>

                <div>
                    <p style="color:black ; font-family:tit; font-size:18px">*El archivo .ZIP no debe de contener carpetas dentro ni los PDF deben de estar dentro de carpetas.
                        <br> *El archivo debe de ser directo a todos los PDFs que se quieran procesar.
                    </p>
                </div>

            </div>
            <div class="col-md-2">
            </div>
        </div>

    </div>
</div>