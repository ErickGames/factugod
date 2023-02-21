<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once("../config/global_config_includes.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ./");
}

$datos = new SAT();

$datos->actualizaPago();
$saldo = $datos->saldo();
$restantes = $datos->rfc_rest();
$sinProcesar = $datos->sinProcesar();
$procesados = $datos->procesados();
$compras = $datos->compras();

$saldoPorocesar = intval($saldo / $GLOBALS['valor']);

$valor = $saldoPorocesar;

if ($saldoPorocesar > $sinProcesar) {

    $valor = $sinProcesar;
}
?>
<script>
    $(document).ajaxStart(function() {
        $("#loading").show();
    });

    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

        $("#btnProcesar").click(function() {

            $.ajax({
                url: '../ajax/ajax_get_registros_procesar.php',
                dataType: "text",
                data: {
                    'id_cliente': <?php echo $_SESSION['id_usuario']; ?>
                },
                type: 'post',
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function(data) {
                    //alert (data);
                    data = JSON.parse(data);
                    //alert('paraProcesar:' + paraProcesar + ' registrosSinProcesar:' + registrosSinProcesar);
                    paraProcesar = data['paraProcesar'];
                    registrosSinProcesar = data['registrosSinProcesar'];
                    //alert('paraProcesar:' + paraProcesar + ' registrosSinProcesar:' + registrosSinProcesar);
                    validar();
                },
                complete: function(data) {
                    //$("#loading").hide();
                }
            });

        });

        $("#btnDescargar").click(function() {

            descargar();

        });

        $("#loading").hide();

    });

    $(document).ajaxStop(function() {
        $("#loading").hide();
    });

    var paraProcesar = '<?php echo $saldoPorocesar; ?>';
    var registrosSinProcesar = '<?php echo $sinProcesar; ?>';
    var restantes = '<?php echo $restantes; ?>';

    function validar() {

        var msg = "";

        if ($("#txtRegistros").val() == '') {

            msg += 'Favor de ingresar el numero de registros a procesar.\n';
        }

        if ($("#txtRegistros").val() > paraProcesar * 1) {

            msg += 'La cantidad maxima de registros que puede procesar son ' + paraProcesar + '.\n';
        }

        if (registrosSinProcesar == '0') {

            msg += 'No hay datos para procesar.\n';

        }

        if (msg == "") {

            $.ajax({
                url: '../ajax/ajax_procesar_datos_registros.php',
                dataType: "text",
                data: {
                    'id_cliente': <?php echo $_SESSION['id_usuario']; ?>,
                    'registros': $("#txtRegistros").val()
                },
                type: 'post',
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function(data) {
                    alert(data);
                    //data = JSON.parse(data);
                    location.reload();
                },
                complete: function(data) {
                    $("#loading").hide();
                }
            });
        } else {
            alert(msg);
        }

    }

    function descargar() {

        var page = "../ajax/global_ajax_descarga.php?id_cliente=<?php echo $_SESSION['id_usuario']; ?>";
        window.open(page, "excel", "width=500, height=300")
    }
</script>

<style>
    body {

        background-image: none;

    }

    #div1 {
        min-height: 150vh;
    }

    @media (max-width:766px) {
        #div1 {
            min-height: auto;
        }
    }
</style>




<div class="row">

    <div id="div1" class="col-md-3" style=" background: rgb(27, 15, 51); background: linear-gradient(90deg, rgba(27, 15, 51, 1) 0%, rgba(68, 42, 122, 1) 40%); ">
        <img src="../imagenes/dwscaragricoblanco.png" alt="" style="display: block; margin:auto; margin-top:20px; width:100px">
        <h2 style="color: white;font-weight: 900; text-align:center; margin-top:20px; font-family:sources">DESCARGAR INFORMACIÓN</h2>
        <h5 style="color: white;font-weight: 400; text-align:center; font-size:30px; font-family:sources"><?php echo $_SESSION['razonsocial'] ?></h5>
    </div>

    <div class="col-md-9">

        <div class="container text-center">
            <div class="mb-3 row mt-5">
                <h5 style="color:#442a7a; font-weight:bolder">RFCS disponibles: <span style="color:green"><?php echo $restantes ?></span></h5>

                <!-- <h5 style="color:#442a7a; font-weight:bolder">Saldo disponible <span style="color:green">$<?php echo number_format($saldo, 2, '.', ','); ?></span></h5> -->
                <div class="col-sm-12">
                    <!-- <h5 style="color: #442a7a;font-weight: 400;">Equivalente a <?php echo $saldoPorocesar; ?> Registros Para Procesar</h5> -->
                </div>
            </div>


            <div class="mb-3 row">
                <div class="col-sm-2">
                </div>
                <label class="col-sm-2 col-form-label" style="color: #442a7a; font-weight:bold;">Registros Sin Procesar:</label>
                <div class="col-sm-1">
                    <label class="col-sm-2 col-form-label" style="color: black;"><?php echo $sinProcesar; ?></label>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-2">
                </div>
                <label for="txtRegistros" class="col-sm-2 col-form-label" style="color: #442a7a; font-weight:bold;">Registros para procesar</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="txtRegistros" value="<?php echo $valor; ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary" id='btnProcesar' style="background-color:#442a7a; border-color: #442a7a ;">Procesar</button>
                </div>
            </div>
            <br>
            <div class="mb-3 row">
                <div class="col-sm-2">
                </div>
                <label class="col-sm-2 col-form-label" style="color: #442a7a; font-weight:bold;">Registros para descargar:</label>
                <div class="col-sm-1">
                    <label class="col-sm-2 col-form-label" style="color: black;"><?php echo $procesados; ?></label>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-info" id='btnDescargar' style="background-color:#442a7a; border-color: #442a7a; color:white;">Descargar</button>
                </div>
            </div>

        </div>

        <div class="row g-5">
            <div class="col-md-2">
            </div>
            <div class="col-md-8" style='text-align:left;'>
                <h5 style="color: black;font-weight: 900;">Historial de Operaciones</h5>

            </div>
            <div class="col-md-2">
            </div>
        </div>
        <div class="row g-5">
            <div class="col-md-2 col-xs-0">
            </div>
            <div class="col" style='background-color: #6E33FF;color:white;'>
                FECHA

            </div>
            <div class="col" style='background-color: #6E33FF;color:white;'>
                REGISTROS

            </div>
            <div class="col-md-2 col-xs-0">
            </div>
        </div>


        <?php

        if (count($compras) > 0) {

            for ($i = 0; $i < count($compras); $i++) {

                if (fmod($i + 1, 2) == 0) {
        ?>
                    <div class="row">
                        <div class="col-md-2 col-xs-0">
                        </div>
                        <div class="col" style='background-color: #9EC4F7;color:black;'>
                            <?php echo $compras[$i]['fecha']; ?>

                        </div>
                        <div class="col" style='background-color: #9EC4F7;color:black;'>
                            <?php echo $compras[$i]['registros']; ?>

                        </div>
                        <div class="col-md-2 col-xs-0">
                        </div>
                    </div>
                <?php

                } else {
                ?>
                    <div class="row">
                        <div class="col-md-2 col-xs-0">
                        </div>
                        <div class="col" style='background-color: #DDD5EC;color:black;'>
                            <?php echo $compras[$i]['fecha']; ?>

                        </div>
                        <div class="col" style='background-color: #DDD5EC;color:black;'>
                            <?php echo $compras[$i]['registros']; ?>

                        </div>
                        <div class="col-md-2 col-xs-0">
                        </div>
                    </div>
        <?php

                }
            }
        }
        ?>
    </div>


</div>

</div>