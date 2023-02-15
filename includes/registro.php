<?php

include_once("../config/global_config_includes.php");



?>
<style>
    body {
        background: rgb(27, 15, 51);
        background: linear-gradient(90deg, rgba(27, 15, 51, 1) 0%, rgba(68, 42, 122, 1) 40%);
        /* background-image: none; */
        overflow-x: hidden;
        width: 100%;
    }
</style>

<style>
    input[type="text"],
    input[type="text"]:focus {
        background: transparent;
        border: none;
        border-style: solid;
        border-top: 2px;
        border-left: 2px;
        border-right: 2px;

        border-color: white;
    }

    input[type="email"],
    input[type="email"]:focus {
        background: transparent;
        border: none;
        border-style: solid;
        border-top: 2px;
        border-left: 2px;
        border-right: 2px;

        border-color: white;
    }

    input::placeholder {
        color: rgba(255, 255, 255, 0.5) !important;
    }

    @font-face {
        font-family: "tit";
        src: url("../imagenes/TitilliumWeb-Regular.ttf");
    }

    body {
        font-family: tit;
    }

    .btnR {
        background-color: transparent;
        color: white;
        border-color: white;
        border-style: solid;
        border-width: 3px;
        border-radius: 15px;
    }

    .btnR:hover {
        background-color: white;
        color: black;
        transition: 1s;
    }
</style>

<h1 style="text-align: center; margin-bottom:20px;font-weight: 900;">Crear Cuenta</h1>

<div class="container text-left">


    <label for="txtRazonSocial" class="form-label" style="margin-top:20px; font-size:25px; text-align:left;">Nombre o Raz&oacute;n Social:</label>

    <input type="text" class="form-control" id="txtRazonSocial" placeholder="Nombre o Razón Social" style="color:white">



    <label for="txtRFC" class="form-label" style="margin-top:20px; font-size:25px; text-align:left;">RFC:</label>

    <input type="text" class="form-control" id="txtRFC" placeholder="RFC" style="color:white">




    <label for="txtEmail" class="form-label" style="margin-top:20px; font-size:25px; text-align:left;">Email:</label>

    <input type="email" class="form-control" id="txtEmail" placeholder="email@example.com" style="color:white">


    <div class="mb-3 mt-5 row">
        <div class="d-grid gap-2">
            <button type="button" class="btn btn-success btnR" id="btnGuardar">Registrarse</button>
        </div>

    </div>
</div>

<script>
    $(document).ajaxStart(function() {
        $("#loading").show();
    });

    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

        $("#btnGuardar").click(function() {

            validar();

        });

        $("#loading").hide();
    });

    $(document).ajaxStop(function() {
        $("#loading").hide();
    });

    function validar() {

        msg = "";

        if ($("#txtRFC").val() == '' || $("#txtRFC").val() == ' ') {
            msg += "Favor de ingresar un RFC.\n";
        }

        if ($("#txtRazonSocial").val() == '' || $("#txtRazonSocial").val() == ' ') {
            msg += "Favor de ingresar la Razón Social.\n";
        }

        if ($("#txtEmail").val() == '' || $("#txtEmail").val() == ' ') {
            msg += "Favor de ingresar su email.\n";
        }

        email = $("#txtEmail").val();
        rfc = $("#txtRFC").val();


        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        if (validateEmail(email) == false) {
            msg += "El Email inválido.\n";
        }

        function validateRFC(rfc) {
            var re2 = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
            return re2.test(rfc);
        }

        if (validateRFC(rfc) == false) {
            msg += "El RFC es inválido.\n";

        }



        if (msg == '') {
            $.ajax({
                url: '../ajax/registrar_datos_sat.php',
                dataType: "text",
                data: {
                    'RFC': $("#txtRFC").val(),
                    'razonSocial': $("#txtRazonSocial").val(),
                    'correo': $("#txtEmail").val()
                },
                type: 'post',
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function(data) {

                    if (data == ' 1') {
                        alert("La información se guardo correctamente.");
                        location.reload();
                    } else {
                        alert(data);
                    }
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