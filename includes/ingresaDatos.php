<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

ini_set('upload_max_filesize', '1000M');
ini_set('post_max_size', '1000M');
set_time_limit(0);

session_start();

if (isset($_GET['d']) && !isset($_SESSION['id_usuario'])) {

    $_SESSION['id_usuario'] = $_GET['d'];
} else {
    if (!isset($_SESSION['id_usuario'])) {
        $_SESSION['id_usuario'] = '1';
    }
}

extract($_POST);
if (isset($btnSubir)) {

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
    } else {
        echo "<script>alert('El tipo de archivo no es correcto.')</script>";
    }
}


?>
<script>
    $(document).ajaxStart(function() {
        $("#loading").show();
    });

    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

        $("#btnEscanera").click(function() {

            escanear();

        });

        $("#btnIngresar").click(function() {

            ingresar();

        });

        $("#btnSubirZIP").click(function() {

            subir();

        });

        $("#btnGuardar").click(function() {

            validar();

        });

        $("#divIngresarDatos").css("display", "none");
        $("#divSubirZIP").css("display", "none");

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

        rfc = $("#txtRFC").val();

        function validateRFC(rfc) {
            var re2 = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
            return re2.test(rfc);
        }

        if (validateRFC(rfc) == false) {
            msg += "El RFC es inválido.\n";

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

<style>
    body {
        background: white;
    }

    #div1 {
        min-height: 115vh;
    }

    @media (max-width:766px) {
        #div1 {
            min-height: auto;
        }
    }

    button {
        box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.7)
    }
</style>


<div class="row">

    <div id="div1" class="col-md-3" style=" background: rgb(27, 15, 51); background: linear-gradient(90deg, rgba(27, 15, 51, 1) 0%, rgba(68, 42, 122, 1) 40%); ">
        <img src="../imagenes/icocolabblanco.png" alt="" style="display: block; margin:auto; margin-top:20px; width:100px">
        <h5 style="color: white;font-weight: 400; text-align:center; font-size:30px">
            <?php echo $_SESSION['razonsocial'] ?></h5>
    </div>


    <div class="col-md-9 row">

        <div class="container text-center">

            <div class="row g-5">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <h3 class="blog-post-title mb-4" style="color:#442a7a; margin-top:50px">Hola Colaborador!</h3>
                    <h4 class="blog-post-title mb-4" style="color:#442a7a">Seleccione la opcion que desa usar:</h4>
                </div>
                <div class="col-md-2">
                </div>
            </div>

            <div class="row mt-3" role="group">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type='button' id="btnEscanera" class="btn btn-bd-secondary" style="width:60%; height:60px; background-color:orchid; border-color:orchid; color:white">Escanear codigo QR</button>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row mt-3" role="group">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type='button' id="btnIngresar" class="btn btn-bd-secondary" style="width:60%; height:60px; background-color:lightskyblue; border-color:lightskyblue; color:white">Ingresas datos</button>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row mt-3" role="group">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type='button' id="btnSubirZIP" class="btn btn-bd-secondary" style="width:60%; height:60px; background-color:plum; border-color:plum; color:white">Subir Archivo ZIP</button>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row mt-5" role="group">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <p style="background-color:#442a7a; color:#442a7a ; font-size:2px">a</p>
                </div>
                <div class="col-md-2"></div>
            </div>

            <div class="row g-5">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <div id="divIngresarDatos">
                        <table>
                            <tr>
                                <td>
                                    <strong style="color:#442a7a">RFC</strong>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="txtRFC" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong style="color:#442a7a">idCIF</strong>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="txtIdCIF" />
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
            </div>

            <div class="row g-5">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <div id="divSubirZIP">
                        <form method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td>
                                        <input type="file" class="form-control" id="filArchivo" name='filArchivo' />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" id="btnSubir" name='btnSubir' value="Subir" class="btn btn-success" />
                                    </td>
                                </tr>
                            </table>

                            <div>
                                <br>
                                <p style="color:black ; font-family:tit; font-size:18px">*El archivo .ZIP no debe de contener carpetas dentro ni los PDF deben de estar dentro de carpetas.
                                    <br> *El archivo debe de ser directo a todos los PDFs que se quieran procesar.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>

            <div>
                <br>
                <p style="color:#442a7a">Selecciona una opcion para dar de alta tus datos actualizados de la constancia
                    de situación fiscal del SAT.</p>
            </div>

            <div class="row mt-5 mb-5" role="group">
                <div class="col-md-4 col-xs-0"></div>
                <div class="col-md-4">
                    <button type='button' id="btnSubirZIP" class="btn btn-bd-secondary" style="width:100%; height:40px; background-color:#442a7a; border-color:#442a7a; color:white">Descargar guía de uso</button>
                </div>
                <div class="col-md-4 col-xs-0"></div>
            </div>


        </div>

    </div>

</div>