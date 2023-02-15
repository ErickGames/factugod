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
            <a class="navbar-brand" href="./index.php"> <img src="../imagenes/Logo_header2.png" alt="" class="respheader"> </a>
        
        </div>
        <p style="background-color:#2cc1d1; color:#2cc1d1 ; font-size:3px; width:100%; margin:0">a</p>
    </nav>
    <main class="principal">
        <div class="album">