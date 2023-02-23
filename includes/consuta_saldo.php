<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once("../config/global_config_includes.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ./");
}

$datos = new SAT();

$datos->actualizaPago();
$saldo = $datos->saldo();
$recargas = $datos->recargas();
$saber = $datos->saberPaquete();

$paquete = $datos->datosPaquete();
?>
<script>
    $(document).ajaxStart(function() {
        $("#loading").show();
    });

    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

        $("#btnRecarga").click(function() {

            location.href = "./gui_comprar.php";

        });

        $("#loading").hide();

    });

    $(document).ajaxStop(function() {
        $("#loading").hide();
    });
</script>

<style>
    body {

        background-image: none;

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

<!-- <script type="text/javascript">

$(document).ready(function(){

      var height = $(window).height();

      $('#div1').height(height);
}); -->

</script>


<div class="row">

    <div id="div1" class="col-md-3" style=" background: rgb(27, 15, 51); background: linear-gradient(90deg, rgba(27, 15, 51, 1) 0%, rgba(68, 42, 122, 1) 40%); ">
        <img src="../imagenes/saldosicoblanco.png" alt="" style="display: block; margin:auto; margin-top:20px; width:100px">
        <h2 style="color: white;font-weight: 900; text-align:center; margin-top:20px; font-family:sources">SALDOS & PLANES</h2>
        <h5 style="color: white;font-weight: 400; text-align:center; font-size:30px; font-family:sources"><?php echo $_SESSION['razonsocial'] ?></h5>
    </div>



    <div class="col-md-9">

        <h3 style="text-align:left; margin-left:40px; margin-top:60px; color: #442a7a">Plan Actual:</h3>

        <div style="border-style: solid; border-color:#442a7a; border-width:1px; margin:20px">
            <h5 style="color: black; text-align:center; margin-top:50px">Información:</h5>

            <h1 style="color: #0FE834; text-align:center;"><?php echo $saber ?></h1>

            <h1 style="color: #0FE834; text-align:center;"><?php if ($saber == "Sin paquete") { ?>$<?php echo number_format($saldo, 2, '.', ',');} ?> </h1>
            <h5 style="color: black; text-align:center;"><?php if ($saber == "Sin paquete") { ?>Equivalente a <?php echo intval($saldo / $GLOBALS['valor']); ?> Registros Para Procesar <?php } ?></h5>

            <?php if ($saber !== "Sin paquete") { ?>

                <div class="row">
                    <div class="col-md-6 px-5">
                        <h5 style="color:#442a7a; font-weight:bold; text-align:left; margin-top:50px">Tipo de Actualización: <span style="color:black"><?php echo $paquete[0]['tip_actualizacion'] ?></span></h5>

                        <h5 style="color:#442a7a; font-weight:bold; text-align:left; margin-top:50px">Próxima Actualización: <span style="color:black"><?php echo date('d / M / Y', strtotime( $paquete[0]['prox_actu']))  ?></span></h5>

                        <h5 style="color:#442a7a; font-weight:bold; text-align:left; margin-top:50px">Contratación: <span style="color:black"><?php echo date('d / M / Y', strtotime( $paquete[0]['contratacion']))  ?></span></h5>

                    </div>
                    <div class="col-md-6 px-5">
                        <h5 style="color:#442a7a; font-weight:bold; text-align:left; margin-top:50px">RFCs Mensuales: <span style="color:black"><?php echo $paquete[0]['rfcs_mensuales'] ?></span></h5>
                        
                        <h5 style="color:#442a7a; font-weight:bold; text-align:left; margin-top:50px">RFCs Restantes: <span style="color:black"><?php echo $paquete[0]['rfcs_restantes'] ?></span></h5>

                        <h5 style="color:#442a7a; font-weight:bold; text-align:left; margin-top:50px">Vigencia: <span style="color:black"><?php echo date('d / M / Y', strtotime( $paquete[0]['vigencia']))  ?></span></h5>
                    </div>
                </div>

            <?php } ?>

            <div class="row g-5 mt-4">
                <div class="col-md-2">
                </div>
                <div class="col-md-8" style='text-align:left;'>
                    <h5 style="color: black;font-weight: 900; margin-top:40px">Historial de Recargas</h5>

                </div>
                <div class="col-md-2">
                </div>
            </div>

            <div class="row g-5">
                <div class="col-md-2">
                </div>
                <div class="col-md-4" style='background-color: #6E33FF;color:white;'>
                    FECHA

                </div>
                <div class="col-md-4" style='background-color: #6E33FF;color:white;'>
                    MONTO

                </div>
                <div class="col-md-2">
                </div>
            </div>

            <?php

            if (count($recargas) > 0) {

                for ($i = 0; $i < count($recargas); $i++) {

                    if (fmod($i + 1, 2) == 0) {
            ?>
                        <div class="row g-5">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-4" style='background-color: #9EC4F7;color:black;'>
                                <?php echo $recargas[$i]['fecha']; ?>

                            </div>
                            <div class="col-md-4" style='background-color: #9EC4F7;color:black;'>
                                <?php echo number_format($recargas[$i]['monto'], 2, '.', ','); ?>

                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
                    <?php

                    } else {
                    ?>
                        <div class="row g-5">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-4" style='background-color: #DDD5EC;color:black;'>
                                <?php echo $recargas[$i]['fecha']; ?>

                            </div>
                            <div class="col-md-4" style='background-color: #DDD5EC;color:black;'>
                                <?php echo number_format($recargas[$i]['monto'], 2, '.', ','); ?>

                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
            <?php

                    }
                }
            }
            ?>

            <div class="row g-5 mb-5">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <br>
                    <br>
                    <button type="button" class="btn btn-success" id="btnRecarga" style='width: 100%; background-color:#442a7a; border-color:#442a7a'>Recarga Saldo</button>

                </div>
                <div class="col-md-2 mb-5">
                </div>
            </div>

        </div>
    </div>



</div>