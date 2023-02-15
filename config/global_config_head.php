<?php
/*
*********************************************************************************
* EVOTEK
* Todos los derechos reservados. 2019
* DESARROLLADOR: MONICA SOFIA RODRIGUEZ GARCIA
* Includes de los css y librerias
*********************************************************************************
*/

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ./");
}
?>

<link href="../lib/bootstrap-5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        font-family: "TitilliumWeb-Black";
        color: white;
        background-image: url("../imagenes/Background_GRADIENT 2.png");
        background-position: center;
        /* Center the image */
        background-size: cover;
        overflow-x: hidden;

    }

    .principal {
        min-height: 85%;
        height: 85%;
    }

    #loading {
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        position: fixed;
        z-index: 9999;
        background-color: #fff;
        opacity: 0.8;
    }

    .btn-bd-secondary {
        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-yellow);
        --bs-btn-bg: purple;
        --bs-btn-border-color: black;
        --bs-btn-border-radius: .5rem;
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: blue;
        --bs-btn-hover-border-color: white;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: black;
        --bs-btn-active-border-color: #{shade-color($bd-violet, 20%)};
    }

    @font-face {
        font-family: "tit";
        src: url("../imagenes/TitilliumWeb-Regular.ttf");
    }

    body {
        font-family: tit;
        /* overflow-x: hidden; */
    }
</style>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Factu-Data</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../lib/bootstrap-5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>


</head>

<script>
    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

        /*$("#btnEscanera").click(function() {
                
                escanear();
                
            });
    
            $("#btnIngresar").click(function() {
                
                ingresar();
                
            });*/

        $("#btnInicio").click(function() {

            location.href = "./inicio.php";

        });

        $("#btnSalir").click(function() {

            location.href = "./index.php";

        });

        $("#btnSubirArchivos").click(function() {

            location.href = "./gui_subir_archivo.php";

        });

        $("#btnEscanearQR").click(function() {

            location.href = "./qr2.php";

        });

        $("#btnGeneraLink").click(function() {

            location.href = "./gui_genera_liga.php";

        });

        $("#btnComprar").click(function() {

            location.href = "./gui_comprar.php";

        });

        $("#btnSaldo").click(function() {

            location.href = "./gui_consultar_saldo.php";

        });

        $("#btnDescarga").click(function() {

            location.href = "./gui_descargas.php";

        });

        <?php
        if ($_SESSION['id_usuario'] == 1) {

        ?>
            $("#btnAgregarTransferencia").click(function() {

                location.href = "./gui_agrega_transferencia.php";

            });
        <?php
        }
        ?>


        $("#btnPreguntas").click(function() {

            location.href = "./gui_preguntas.php";

        });

        $("#btnAviso").click(function() {

            location.href = "./gui_aviso.php";

        });

        $("#btnInfo").click(function() {

            location.href = "./gui_masinfo.php";

        });

    });
</script>

<style>
    .btn-success,
    .btn-success:hover,
    .btn-success:active,
    .btn-success:visited {
        background-color: #6C00B8 !important;
        border: none;
    }

    .respheader{
        width: 220px;
        padding: 15px;
    }

    @media (max-width:555px) {
        .respheader{
        width: 150px;
        padding: 5px;
        }

    }

    @font-face {
        font-family: 'sources';
        src: url('../imagenes/source-sans-pro-light.ttf');
    }

    @font-face {
        font-family: 'arialr';
        src: url('../imagenes/arial-rounded.ttf');
    }

</style>


<body>
    <div id="loading" style="display:none">
        <img id="loading-image" src="../imagenes/global_imagenes_loading.gif" />
    </div>
    <nav class="navbar navbar-dark bg-black " style="padding-bottom: 0;">
        <div class="container-fluid" >
            <a class="navbar-brand" href="./inicio.php"> <img src="../imagenes/Logo_header2.png" alt="" class="respheader"> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menú</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item mt-2 d-grid gap-2">
                            <button type="button" class="btn btn-primary" id="btnInicio">Inicio</button>
                        </li>
                        <li class="nav-item mt-2 d-grid gap-2">
                            <button type="button" class="btn btn-success" id="btnComprar">Planes & Paquetes</button>
                        </li>
                        <li class="nav-item mt-2 d-grid gap-2">
                            <button type="button" class="btn btn-success" id="btnSaldo">Consultar Saldo</button>
                        </li>
                        <li class="nav-item mt-2 d-grid gap-2">
                            <button type="button" class="btn btn-success" id="btnSubirArchivos">Subir Archivo .ZIP</button>
                        </li>
                        <li class="nav-item mt-2 d-grid gap-2">
                            <button type="button" class="btn btn-success" id="btnEscanearQR">Escanear QR</button>
                        </li>
                        <li class="nav-item mt-2 d-grid gap-2">
                            <button type="button" class="btn btn-success" id="btnGeneraLink">LINK para colaboradores</button>
                        </li>
                        <li class="nav-item mt-2 d-grid gap-2">
                            <button type="button" class="btn btn-success" id="btnDescarga">Descarga Informaci&oacute;n</button>
                        </li>
                        <?php
                        if ($_SESSION['id_usuario'] == 1) {

                        ?>
                            <li class="nav-item mt-2 d-grid gap-2">
                                <button type="button" class="btn btn-success" id="btnAgregarTransferencia" style="color:aqua">Agregar transferencia</button>
                            </li>
                        <?php
                        }
                        ?>

                        <li class="nav-item mt-2 d-grid gap-2">
                            <button type="button" class="btn btn-success" id="btnAviso">Aviso de Privacidad</button>
                        </li>

                        <li class="nav-item mt-2 d-grid gap-2">
                            <button type="button" class="btn btn-success" id="btnPreguntas">Preguntas Frecuentes</button>
                        </li>

                        <li class="nav-item mt-2 d-grid gap-2">
                            <button type="button" class="btn btn-success" id="btnInfo">M&aacute;s Informaci&oacute;n</button>
                        </li>

                        <li class="nav-item mt-2 d-grid gap-2">
                            <button type="button" class="btn btn-danger" id="btnSalir">Salir</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <p style="background-color:#2cc1d1; color:#2cc1d1 ; font-size:3px; width:100%; margin:0">a</p>
    </nav>
    <main class="principal">
        <div class="album">