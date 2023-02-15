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
</style>





<!-- <div class="offcanvas-body">
    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
        <li class="nav-item mt-2 d-grid gap-2">
            <button type="button" class="btn btn-primary" id="btnInicio">Inicio</button>
        </li>
        <li class="nav-item mt-2 d-grid gap-2">
            <button type="button" class="btn btn-success" id="btnComprar">Comprar Paquete</button>
        </li>
        <li class="nav-item mt-2 d-grid gap-2">
            <button type="button" class="btn btn-success" id="btnSaldo">Consulta Saldo</button>
        </li>
        <li class="nav-item mt-2 d-grid gap-2">
            <button type="button" class="btn btn-success" id="btnSubirArchivos">Subir Archivos</button>
        </li>
        <li class="nav-item mt-2 d-grid gap-2">
            <button type="button" class="btn btn-success" id="btnEscanearQR">Escanear QR</button>
        </li>
        <li class="nav-item mt-2 d-grid gap-2">
            <button type="button" class="btn btn-success" id="btnGeneraLink">Genera LINK</button>
        </li>
        <li class="nav-item mt-2 d-grid gap-2">
            <button type="button" class="btn btn-success" id="btnDescarga">Descarga Informaci&oacute;n</button>
        </li>
        <?php
        if ($_SESSION['id_usuario'] == 1) {

        ?>
            <li class="nav-item mt-2 d-grid gap-2">
                <button type="button" class="btn btn-success" id="btnAgregarTransferencia">Agregar transferencia</button>
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
</div> -->

<!-- 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        body {
            margin: 0;
        }

        #barraInferior {
            overflow: hidden;
            width: 100%;
        }

        #barraInferior ul {
            list-style-type: none;
            margin: 0 auto;
            overflow: hidden;
            background-color: black;
            position: fixed;
            bottom: 0;
            width: 100%;
            padding-left: 32%;

        }

        @media screen and (max-width:780px){
            #barraInferior ul {
            padding-left: 20%;

        }
        }

        @media screen and (max-width:550px){
            #barraInferior ul {
            padding-left: 10%;

        }
        }

        #barraInferior li {
            float:left;

        }

        #barraInferior li a {
            display: block;
            color: white;
            font-size: 15px;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        #barraInferior li a:hover {
            background-color: #111;
        }

        #barraInferior li a:active {
            background-color: #3B1D79;
        }
    </style>
</head>

<body>
    <div id="barraInferior" style="display: none;">
        <ul>
            <li id="aboutu" ><a href="./gui_masinfo.php">Acerca de...</a></li>
            <li id="politicau"><a href="./gui_aviso.php">Politica de Privacidad</a></li>
            <li id="preguntasu"> <a href="./gui_preguntas.php">Preguntas frecuentes</a></li>
        </ul>
    </div>
</body> -->