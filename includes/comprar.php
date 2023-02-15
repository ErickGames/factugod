<?php


include_once("../config/global_config_includes.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ./");
}

?>
<script>
    $(document).ajaxStart(function() {
        $("#loading").show();
    });

    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

        $("#btnComprar").click(function() {

            validar();

        });

        $("#loading").hide();

    });

    $(document).ajaxStop(function() {
        $("#loading").hide();
    });

    function validar() {

        var msg = "";

        if ($("#txtMonto").val() == '') {

            msg += 'Favor de ingresar un monto.\n';
        } else {
            var RE = /^\d*(\.\d{1})?\d{0,1}$/;
            if (RE.test($("#txtMonto").val())) {
                msg = "";
            } else {
                msg += 'El formato del numero no es valido.\n'
            }
        }

        if (msg == "") {

            $.ajax({
                url: '../ajax/ajax_comprar.php',
                dataType: "text",
                data: {
                    'monto': $("#txtMonto").val()
                },
                type: 'post',
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function(data) {
                    //alert (data);
                    data = JSON.parse(data);
                    location.href = "../mercado pago/index.php?titulo=" + data['titulo'] + "&monto=" + data['monto'] + "&cliente=" + <?php echo $_SESSION['id_usuario']; ?>;
                },
                complete: function(data) {
                    $("#loading").hide();
                }
            });
        } else {
            alert(msg);
        }

    }

    function validar2() {

        var msg = "";

        if ($("#txtMonto2").val() == '') {

            msg += 'Favor de ingresar un monto.\n';
        } else {
            var RE = /^\d*(\.\d{1})?\d{0,1}$/;
            if (RE.test($("#txtMonto2").val())) {
                msg = "";
            } else {
                msg += 'El formato del numero no es valido.\n'
            }
        }

        if (msg == "") {

            $.ajax({
                url: '../ajax/ajax_comprar2.php',
                dataType: "text",
                data: {
                    'monto': $("#txtMonto2").val(),
                    'paquete': $("#sA").val(),
                    'tiempo': $("#sB").val(),
                    'rfcs' : $("#sA").val()
                },
                type: 'post',
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function(data) {
                    //alert (data);
                    data = JSON.parse(data);
                    location.href = "../mercado pago/index.php?titulo=" + data['titulo'] + "&monto=" + data['monto'] + "&cliente=" + <?php echo $_SESSION['id_usuario']; ?>;
                },
                complete: function(data) {
                    $("#loading").hide();
                }
            });
        } else {
            alert(msg);
        }

    }

    function validar3() {

        var msg = "";

        if ($("#txtMonto3").val() == '') {

            msg += 'Favor de ingresar un monto.\n';
        } else {
            var RE = /^\d*(\.\d{1})?\d{0,1}$/;
            if (RE.test($("#txtMonto3").val())) {
                msg = "";
            } else {
                msg += 'El formato del numero no es valido.\n'
            }
        }

        if (msg == "") {

            $.ajax({
                url: '../ajax/ajax_comprar3.php',
                dataType: "text",
                data: {
                    'monto': $("#txtMonto3").val(),
                    'paquete': $("#sA2").val(),
                    'tiempo': $("#sB2").val(),
                    'rfcs' : $("#sA2").val()
                },
                type: 'post',
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function(data) {
                    //alert (data);
                    data = JSON.parse(data);
                    location.href = "../mercado pago/index.php?titulo=" + data['titulo'] + "&monto=" + data['monto'] + "&cliente=" + <?php echo $_SESSION['id_usuario']; ?>;
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

        background-image: none;

    }

    #div1 {
        min-height: 130vh;
    }

    @media (max-width:766px) {
        #div1 {
            min-height: auto;
        }
    }
</style>




<div class="row">

    <div id="div1" class="col-md-3" style=" background: rgb(27, 15, 51); background: linear-gradient(90deg, rgba(27, 15, 51, 1) 0%, rgba(68, 42, 122, 1) 40%); ">
        <img src="../imagenes/paquetesicoblanco.png" alt="" style="display: block; margin:auto; margin-top:20px; width:100px">
        <h3 style="margin-top:10px; text-align:center">PLANES Y PAQUETES</h3>

        <div style="margin-top: 50px;">

            <h5 style="text-align: center; font-family:sources">DATOS DE TRANSFERENCIA</h5>


            <div style=" margin-top:30px; margin-left:70px">
                <h6 style="font-weight:bold;; font-family:sources">Razón Social:</h6>
                <h6>Tecnologías Evolutivas de México SA DE CV</h6> <br>

                <h6 style="font-weight:bold;; font-family:sources">Cuenta:</h6>
                <h6>CLABE: 072 078 01007748599 6 <br>
                    CUENTA: 1007748599
                </h6> <br>

                <h6 style="font-weight:bold;; font-family:sources">Institución Bancaria:</h6>
                <h6>Banorte</h6> <br>

                <h6 style="font-weight:bold;; font-family:sources">Dirección:</h6>
                <h6>Paseo de los Sauces #625 Col. Country Club 25207</h6> <br>

                <h6 style="font-weight:bold;; font-family:sources">*Enviar comprobante a:</h6>
                <h6>info@factudata.com.mx</h6>
            </div>

        </div>
        <br><br><br>
    </div>


    <div class="col-md-9 mt-2" style="text-align: center;">

        <div class="row">
            <div class="col-md-3 text-start ml-4">
                <h2 style="color:#442a7a">Plan <span style="font-weight:bold">Básico</span> </h2>
                <h6 style="color:black">por número de RFC's registrados</h6>
            </div>

            <div class="col-md-9">
                <div class="row mt-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <h5 style="text-align:center; color:#442a7a">Número de registros</h5>
                    </div>
                    <div class="col-md-4">
                        <input type="number" id="input" class="form-control" style="width: 100%;" oninput="multi()" min="0" max="1000">
                        <script>
                            function multi() {
                                if(document.getElementById('input').value >= 1000){
                                    document.getElementById('input').value = 1000;
                                }

                                var resultado = (document.getElementById('input').value * 19.25)
                                var resultado2 = resultado.toFixed(2);
                                document.getElementById('txtMonto').value = (resultado2)
                            }
                        </script>
                    </div>
                    <!-- <div class="col-md-2">
                        <label for="" id="resultado" style="color:#442a7a; font-size:20px">$0</label>
                    </div> -->
                </div>

                <div class="row mt-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <h5 style="text-align:center; color:#442a7a">Monto a pagar</h5>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="txtMonto" value="" disabled>
                        <button type="button" class="btn btn-success mt-3" id="btnComprar" onClick='validar();'>Comprar</button>
                        <h6 style="color:#442a7a; font-size:15px; margin-top:5px">*Se redireccionará a MercadoPago para proceder con el pago.</h6>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>

        <p class="mt-5 mb-1" style="background-color: #442a7a; color:#442a7a; font-size:2px; width:100%">a</p>

        <div class="row">
            <div class="col-md-3 text-start ml-4">
                <div class="mt-4">
                    <h2 style="color:#442a7a">Plan <span style="font-weight:bold">PYME</span> </h2>
                    <h6 style="color:black">Elige un paquete de registros de acuerdo al número de colaboradores de tu empresa</h6>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row mt-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <h5 style="text-align:center; color:#442a7a">Paquete de RFC's</h5>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <select class="form-select form-select-md" name="sA" id="sA" onchange="multi2()">
                                <option selected value="100">1 a 100</option>
                                <option value="500">101 a 500</option>
                                <option value="1000">501 a 1000</option>
                                <option value="3000">1001 a 3000</option>
                                <option value="100000">Más</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-2">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <h5 style="text-align:center; color:#442a7a">Tiempo de Contratación</h5>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select form-select-md" name="sB" id="sB" onchange="multi2()">
                            <option selected value="m">MENSUAL</option>
                            <option value="t">TRIMESTRAL</option>
                            <option value="s">SEMESTRAL</option>
                            <option value="a">ANUAL</option>
                        </select>
                        <script>
                            function multi2() {
                                if (document.getElementById('sA').value == "100") {
                                    if (document.getElementById('sB').value == "m") {
                                        document.getElementById('txtMonto2').value = 437.50
                                    }
                                    if (document.getElementById('sB').value == "t") {
                                        document.getElementById('txtMonto2').value = 1137.50
                                    }
                                    if (document.getElementById('sB').value == "s") {
                                        document.getElementById('txtMonto2').value = 2100.00
                                    }
                                    if (document.getElementById('sB').value == "a") {
                                        document.getElementById('txtMonto2').value = 3500.00
                                    }
                                }
                                if (document.getElementById('sA').value == "500") {
                                    if (document.getElementById('sB').value == "m") {
                                        document.getElementById('txtMonto2').value = 500.00
                                    }
                                    if (document.getElementById('sB').value == "t") {
                                        document.getElementById('txtMonto2').value = 1300.00
                                    }
                                    if (document.getElementById('sB').value == "s") {
                                        document.getElementById('txtMonto2').value = 2400.00
                                    }
                                    if (document.getElementById('sB').value == "a") {
                                        document.getElementById('txtMonto2').value = 4000.00
                                    }
                                }
                                if (document.getElementById('sA').value == "1000") {
                                    if (document.getElementById('sB').value == "m") {
                                        document.getElementById('txtMonto2').value = 562.50
                                    }
                                    if (document.getElementById('sB').value == "t") {
                                        document.getElementById('txtMonto2').value = 1462.50
                                    }
                                    if (document.getElementById('sB').value == "s") {
                                        document.getElementById('txtMonto2').value = 2700.00
                                    }
                                    if (document.getElementById('sB').value == "a") {
                                        document.getElementById('txtMonto2').value = 4500.00
                                    }
                                }
                                if (document.getElementById('sA').value == "3000") {
                                    if (document.getElementById('sB').value == "m") {
                                        document.getElementById('txtMonto2').value = 625.00
                                    }
                                    if (document.getElementById('sB').value == "t") {
                                        document.getElementById('txtMonto2').value = 1625.00
                                    }
                                    if (document.getElementById('sB').value == "s") {
                                        document.getElementById('txtMonto2').value = 3000.00
                                    }
                                    if (document.getElementById('sB').value == "a") {
                                        document.getElementById('txtMonto2').value = 5000.00
                                    }
                                }
                                if (document.getElementById('sA').value == "100000") {
                                    if (document.getElementById('sB').value == "m") {
                                        document.getElementById('txtMonto2').value = 750.00
                                    }
                                    if (document.getElementById('sB').value == "t") {
                                        document.getElementById('txtMonto2').value = 1950.00
                                    }
                                    if (document.getElementById('sB').value == "s") {
                                        document.getElementById('txtMonto2').value = 3600.00
                                    }
                                    if (document.getElementById('sB').value == "a") {
                                        document.getElementById('txtMonto2').value = 6000.00
                                    }
                                }
                            }
                        </script>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <h5 style="text-align:center; color:#442a7a">Monto a pagar</h5>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="txtMonto2" value="" disabled style="color:#442a7a ; font-weight:bold">
                        <button type="button" class="btn btn-success mt-3" id="btnComprar2" onClick='validar2();'>Comprar</button>
                        <h6 style="color:#442a7a; font-size:15px; margin-top:5px">*Se redireccionará a MercadoPago para proceder con el pago.</h6>
                    </div>
                    <div class="col-md-4"></div>
                </div>

            </div>
        </div>


        <p class="mt-5 mb-1" style="background-color: #442a7a; color:#442a7a; font-size:2px; width:100%">a</p>

        <div class="row">
            <div class="col-md-3 text-start ml-4">
                <div class="mt-4">
                    <h2 style="color:#442a7a">Plan <span style="font-weight:bold">ERP</span> </h2>
                    <h6 style="color:black">Elige un paquete de registros de acuerdo al número de colaboradores de tu empresa</h6>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row mt-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <h5 style="text-align:center; color:#442a7a">Paquete de RFC's</h5>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <select class="form-select form-select-md" name="sA2" id="sA2" onchange="multi3()">
                                <option selected value="100">1 a 100</option>
                                <option value="500">101 a 500</option>
                                <option value="1000">501 a 1000</option>
                                <option value="3000">1001 a 3000</option>
                                <option value="100000">Más</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-2">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <h5 style="text-align:center; color:#442a7a">Tiempo de Contratación</h5>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select form-select-md" name="sB2" id="sB2" onchange="multi3()">
                            <option selected value="m">MENSUAL</option>
                            <option value="t">TRIMESTRAL</option>
                            <option value="s">SEMESTRAL</option>
                            <option value="a">ANUAL</option>
                        </select>
                        <script>
                            function multi3() {
                                if (document.getElementById('sA2').value == "100") {
                                    if (document.getElementById('sB2').value == "m") {
                                        document.getElementById('txtMonto3').value = 437.50 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "t") {
                                        document.getElementById('txtMonto3').value = 1137.50 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "s") {
                                        document.getElementById('txtMonto3').value = 2100.00 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "a") {
                                        document.getElementById('txtMonto3').value = 3500.00 + 2100.50
                                    }
                                }
                                if (document.getElementById('sA2').value == "500") {
                                    if (document.getElementById('sB2').value == "m") {
                                        document.getElementById('txtMonto3').value = 500.00 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "t") {
                                        document.getElementById('txtMonto3').value = 1300.00 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "s") {
                                        document.getElementById('txtMonto3').value = 2400.00 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "a") {
                                        document.getElementById('txtMonto3').value = 4000.00 + 2100.50
                                    }
                                }
                                if (document.getElementById('sA2').value == "1000") {
                                    if (document.getElementById('sB2').value == "m") {
                                        document.getElementById('txtMonto3').value = 562.50 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "t") {
                                        document.getElementById('txtMonto3').value = 1462.50 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "s") {
                                        document.getElementById('txtMonto3').value = 2700.00 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "a") {
                                        document.getElementById('txtMonto3').value = 4500.00 + 2100.50
                                    }
                                }
                                if (document.getElementById('sA2').value == "3000") {
                                    if (document.getElementById('sB2').value == "m") {
                                        document.getElementById('txtMonto3').value = 625.00 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "t") {
                                        document.getElementById('txtMonto3').value = 1625.00 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "s") {
                                        document.getElementById('txtMonto3').value = 3000.00 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "a") {
                                        document.getElementById('txtMonto3').value = 5000.00 + 2100.50
                                    }
                                }
                                if (document.getElementById('sA2').value == "100000") {
                                    if (document.getElementById('sB2').value == "m") {
                                        document.getElementById('txtMonto3').value = 750.00 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "t") {
                                        document.getElementById('txtMonto3').value = 1950.00 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "s") {
                                        document.getElementById('txtMonto3').value = 3600.00 + 2100.50
                                    }
                                    if (document.getElementById('sB2').value == "a") {
                                        document.getElementById('txtMonto3').value = 6000.00 + 2100.50
                                    }
                                }
                            }
                        </script>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <h5 style="text-align:center; color:#442a7a">Conexión</h5>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="" value="$2,100.50" disabled style="color:#442a7a ; ">
                    </div>
                    <div class="col-md-4"></div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <h5 style="text-align:center; color:#442a7a">Monto a pagar</h5>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="txtMonto3" value="" disabled style="color:#442a7a ; font-weight:bold">
                        <button type="button" class="btn btn-success mt-3" id="btnComprar2" onClick='validar3();'>Comprar</button>
                        <h6 style="color:#442a7a; font-size:15px; margin-top:5px">*Se redireccionará a MercadoPago para proceder con el pago.</h6>
                    </div>
                    <div class="col-md-4"></div>
                </div>

            </div>
        </div>

    </div>

</div>