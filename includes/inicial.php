<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();


$datos = new SAT();

$datos->actualizaPago();

?>
<style>
    body {
        overflow-x: hidden;
        background-image: none;

    }

    .texto-borde {
        font-family: tit;
        /* -webkit-text-stroke: 1px black; */
        color: transparent;
        font-size: 25px;
    }

    .texto-borde2 {
        -webkit-text-stroke: 0px black;
        font-size: 18px;
        color: transparent;
    }

    /* @font-face {
        font-family: "tit";
        src: url("../imagenes/TitilliumWeb-Regular.ttf");
    } */

    body {
        font-family: tit;
    }
</style>
<script>
    $(document).ajaxStart(function() {
        $("#loading").show();
    });

    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

        $("#btnEscanera").click(function() {

            escanear();

        });

        // $("#btnIngresar").click(function() {

        //     ingresar();

        // });

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
    .botones {
        background-color: transparent;
        border-color: #442a7a;
        border-width: 3px;
        border-style: solid;
        color: #442a7a;
        width: 100%;
        height: auto;
        min-height: 110px;
        border-radius: 20px
    }

    .botones2 {
        background-color: #442a7a;
        border-color: #442a7a;
        border-width: 3px;
        border-style: solid;
        color: #442a7a;
        width: 100%;
        height: auto;
        min-height: 110px;
        color: white;
        border-radius: 20px
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active,
    .btn-primary.active,
    .open>.dropdown-toggle.btn-primary {
        transition: 0.5s;
        box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.7);
        background-color: transparent;
        color: #442a7a;
        transform: scale(1.03);
        border-color: #442a7a !important;


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


<div id="div1" class="row">

    <div class="col-md-3" style=" background: rgb(27, 15, 51); background: linear-gradient(90deg, rgba(27, 15, 51, 1) 0%, rgba(68, 42, 122, 1) 40%); ">
        <h1 style="color: white;font-weight: 900; margin-left:20px; text-align:left; margin-top:20px; font-family:sources">¡Bienvenido!</h1>
        <h5 style="color: white;font-weight: 400; margin-left:20px; text-align:left; font-size:30px; font-family:sources"><?php echo $_SESSION['razonsocial'] ?></h5>
    </div>


    <div class="col-md-9 mt-2">

        <div class="row" style="margin-top:30px">
            <div class="col-md-1"></div>
            <div class="col-md-5 mt-3">
                <a class="btn btn-primary botones" href="./gui_comprar.php" role="button">
                    <div class="row">
                        <div class="col-9">
                            <h5 style="font-weight:bold;">PLANES Y PAQUETES</h5>
                            <h6 style="color:black; font-size:14px; font-weight:bold">Elige tu plan o número de registros a dar de alta.</h6>
                        </div>
                        <div class="col-3">
                            <img src="../imagenes/paquetesico.png" alt="ico" width="50px">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-5 mt-3">
                <a class="btn btn-primary botones" href="./gui_consultar_saldo.php" role="button">
                    <div class="row">
                        <div class="col-9">
                            <h5 style="font-weight:bold;">SALDOS Y MÉTODOS DE PAGO</h5>
                            <h6 style="color:black; font-size:14px; font-weight:bold">Consulta tu saldo y registros disponibles, asi como los métodos de pago y activación.</h6>
                        </div>
                        <div class="col-3">
                            <img src="../imagenes/saldosico.png" alt="ico" width="50px">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-1"></div>
        </div>

        <div class="row" style="margin-top:30px">
            <div class="col-md-1"></div>
            <div class="col-md-5 mt-2">
                <a class="btn btn-primary botones" href="./gui_alta_colab.php" role="button">
                    <div class="row">
                        <div class="col-9">
                            <h5 style="font-weight:bold;">ALTA A COLABORADOR</h5>
                            <h6 style="color:black; font-size:14px; font-weight:bold">Dar de alta datos de tus colaboradores eligiendo entre 2 tipos de métodos.</h6>
                        </div>
                        <div class="col-3">
                            <img src="../imagenes/usuarios.png" alt="ico" width="50px">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-5 mt-2">
                <a class="btn btn-primary botones" href="./gui_genera_liga.php" role="button">
                    <div class="row">
                        <div class="col-9">
                            <h5 style="font-weight:bold;">CREAR LINK EMPRESARIAL</h5>
                            <h6 style="color:black; font-size:14px; font-weight:bold">Crear un link exclusivo para tu empresa, el cuál permitirá el registro individual de tus colaboradores.</h6>
                        </div>
                        <div class="col-3">
                            <img src="../imagenes/infoico.png" alt="ico" width="50px">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-1"></div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId" style="color:black">Liga para colaboradores</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> -->
                    <div class="modal-body">
                        <div class="container-fluid p-4">
                            <img src="../imagenes/Logo_header2black.png" alt="asda" style="width:50%; display:block; margin:auto">
                            <br>
                            <h4 style="color:black; font-weight:bold; text-align:center">Descarga el manual que sea necesario para realizar tu proceso.</h4>
                            <br>
                            <p style="color:black;  text-align:center; font-weight:bold">Manual de Administrador <br> <span style="font-weight:initial">carga de múltiples datos o volumen.</span></p>

                            <a href="../imagenes/ManualDeUso.pdf" download="" class="btn btn-bd-secondary" style="width:100%; height:40px; background-color:#2cc1d1; border-color:#2cc1d1; color:white">ADMINISTRADOR</a>
                            <br>
                            <br>
                            <br>
                            <p style="color:black;  text-align:center; font-weight:bold">Manual del Colaborador <br> <span style="font-weight:initial">Instrucciones para la carga de información por cada persona.</span></p>
                            <a href="../imagenes/ManualDeColaborador.pdf" download="" class="btn btn-bd-secondary" style="width:100%; height:40px; background-color:#442a7a; border-color:#442a7a; color:white">COLABORADOR</a>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var modalId = document.getElementById('modalId');

            modalId.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                let button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                let recipient = button.getAttribute('data-bs-whatever');

                // Use above variables to manipulate the DOM
            });
        </script>



        <div class="row" style="margin-top:30px">
            <div class="col-md-1"></div>
            <div class="col-md-5 mt-2">
                <a class="btn btn-primary botones" data-bs-toggle="modal" data-bs-target="#modalId" role="button">
                    <div class="row">
                        <div class="col-9">
                            <h5 style="font-weight:bold;">MANUAL DE USO</h5>
                            <h6 style="color:black; font-size:14px; font-weight:bold">Guía práctica paso a paso para administrador y colaborador</h6>
                        </div>
                        <div class="col-3">
                            <img src="../imagenes/manualico.png" alt="ico" width="50px">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-5 mt-2">
                <a class="btn btn-primary botones2" href="./gui_descargas.php" role="button">
                    <div class="row">
                        <div class="col-md-9">
                            <h5>DESCARGAR INFOMACIÓN</h5>
                            <h6 style="font-size:14px; ">Descarga la base de datos con toda la información actualizada de tus colaboradores.</h6>
                        </div>
                        <div class="col-md-3">
                            <img src="../imagenes/descargarico.png" alt="ico" width="50px">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-1"></div>
        </div>

        <br><br><br>

        <p style="text-align:center; color:#442a7a"><span style="text-decoration:underline">2022 factu.data.</span> Todos los derechos reservados.</p>

        <br><br>
        <!-- <div class="text-center" style='width: 100%;max-width: 2200px;'>

            <div class="row g-8" style="width: 100%;max-width: 2200px; color: black;">
                <div class="col-md-2">

                </div>
                <div class="col-md-4 mt-2">
                    <a href="./gui_comprar.php"><img src="../imagenes/Carrito de compras 2.png" /></a>
                    <h5 style="color: #6E33FF;font-weight: 900;" class="texto-borde">COMPRAR PAQUETE</h5>
                    <h5 style="color: #22A0CF;font-weight: 900;" class="texto-borde2">Actualiza los datos de facturaci&oacute;n</h5>
                </div>
                <div class="col-md-4 mt-2">
                    <a href="./gui_consultar_saldo.php"><img src="../imagenes/Consultar Saldo 2.png" /></a>
                    <h5 style="color: #6E33FF;font-weight: 900;" class="texto-borde">CONSULTAR SALDO</h5>
                    <h5 style="color: #22A0CF;font-weight: 900;" class="texto-borde2">Consulta tu saldo y recarga mas saldo</h5>
                </div>
                <div class="col-md-2">
                </div>
            </div>

            <div class="row g-10" style="width: 100%;max-width: 2200px; color: black;">
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <a href="./gui_subir_archivo.php"><img src="../imagenes/Subir Pdf 2.png" /></a>
                    <h5 style="color: #6E33FF;font-weight: 900;" class="texto-borde">SUBIR PDF</h5>
                    <h5 style="color: #22A0CF;font-weight: 900;" class="texto-borde2">Subir archivo con las constancias de situaci&oacute;n f&iacute;scal en formato ZIP</h5>
                </div>
                <div class="col-md-4">
                    <a href="./qr2.php"><img src="../imagenes/Escanear QR 2.png" /></a>
                    <h5 style="color: #6E33FF;font-weight: 900;" class="texto-borde">ESCANEAR QR</h5>
                    <h5 style="color: #22A0CF;font-weight: 900;" class="texto-borde2">Escanear codigo QR de la constancias de situaci&oacute;n f&iacute;scal</h5>
                </div>
                <div class="col-md-2">
                </div>
            </div>

            <div class="row g-10" style="width: 100%;max-width: 2200px; color: black;">
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <br>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-2">
                </div>
            </div>

            <div class="row g-10" style="width: 100%;max-width: 2200px; color: black; margin-bottom:50px">
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <a href="./gui_genera_liga.php"><img src="../imagenes/Generar Link 2.png" /></a>
                    <h5 style="color: #6E33FF;font-weight: 900;" class="texto-borde">GENERAR LINK</h5>
                    <h5 style="color: #22A0CF;font-weight: 900;" class="texto-borde2">Genera el link para los usuarios</h5>
                </div>
                <div class="col-md-4">
                    <a href="./gui_descargas.php"><img src="../imagenes/Descargar 2.png" /></a>
                    <h5 style="color: #6E33FF;font-weight: 900;" class="texto-borde">DESCARGAR INFORMACION</h5>
                    <h5 style="color: #22A0CF;font-weight: 900;" class="texto-borde2">Descarga la información procesada</h5>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div> -->

    </div>

</div>