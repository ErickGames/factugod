<?php
/*
*********************************************************************************
* EVOTEK
* Todos los derechos reservados. 2019
* DESARROLLADOR: MONICA SOFIA RODRIGUEZ GARCIA
* Includes de los css y librerias
*********************************************************************************
*/
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
    }

    .principal {
        min-height: 88%;
        height: 88%;
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
        overflow-x: hidden;
        width: 100%;

    }

    html {
        width: 100%;

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
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Datos SAT</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>

    <div id="loading" style="display:none">
        <img id="loading-image" src="../imagenes/global_imagenes_loading.gif" />
    </div>
    <header>

        <nav class="navbar navbar-expand-lg navbar-black bg-black">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php"><img src="../imagenes/Logo_header2.png" alt="" width="200px" style="margin-bottom:20px ;margin-top:20px; margin-left:20px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar" style="background-color:#6fccdd">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" style="color:white; font-family:tit; margin-top:12px; text-align:center " href="#ComoFunciona">¿Como Funciona?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:white; font-family:tit; margin-top:12px; text-align:center " href="#Beneficios">Beneficios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:white; font-family:tit; margin-top:12px; text-align:center " href="#Planes">Planes y Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)"><img src="../imagenes/contacto.png" alt="flecha" width="25px" style="  display: block; margin-left: auto; margin-right: auto;"></a>
                            <a class="nav-link" style="color:#6fccdd; font-family:tit; text-align:center" target="_blank" href="https://wa.me/message/GH3AF67UGDMAI1">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../gui/gui_login.php"><img src="../imagenes/ingresar.png" alt="flecha" width="20px" style="  display: block; margin-left: auto; margin-right: auto;"></a>
                            <a class="nav-link" style="color:#6fccdd; font-family:tit; text-align:center;" href="../gui/gui_login.php">Ingresar</a>
                        </li>


                    </ul>
                    <div class="align-right">
                        <button class="btn btn-primary m-2" style="background-color: #00ffff; border-color:#00ffff; color:black" id="btnMasInfo">Más Información</button>
                    </div>
                    <div class="align-right">
                        <button class="btn btn-primary m-2" style="background-color: #00ffff; border-color:#00ffff; color:black" id="btnPreg">Preguntas Fecuentes</button>
                    </div>
                    <div class="align-right">
                        <button class="btn btn-primary m-2" style="background-color: #442a7a; border-color:#442a7a; color:white" id="btnRegistro">Crear Cuenta</button>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="principal">
        <div class="album" style="margin-top:48px">

            <script>
                $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

                    $("#btnRegistro").click(function() {

                        location.href = "./gui_registro.php";

                    });
                });

                $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

                    $("#btnMasInfo").click(function() {

                        location.href = "./gui_formulario_masinfo.php";

                    });
                });

                $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

                    $("#btnPreg").click(function() {

                        location.href = "./gui_preguntas2.php";

                    });
                });
            </script>