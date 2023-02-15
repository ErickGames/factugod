<?php
if (session_status() === PHP_SESSION_ACTIVE)
    session_destroy();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Ingresar</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<script>
    $(document).ajaxStart(function() {
        $("#loading").show();
    });

    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

        $("#btnEntrar").click(function() {

            validar();

        });

        $("#btnRegistro").click(function() {

            location.href = "./gui_registro.php";

        });

        $("#loading").hide();
    });

    $(document).ajaxStop(function() {
        $("#loading").hide();
    });


    async function validar() {
        var msg = '';

        if ($("#txtCorreo").val() == '') {
            msg = msg + 'Favor de ingresar el correo\n';
        }

        if ($("#txtRFC").val() == '') {
            msg = msg + 'Favor de ingresar el RFC\n';
        }

        if (msg == "") {
            const url = "../ajax/login_datos_sat.php";
            const formData = new FormData();
            formData.append("RFC", $("#txtRFC").val());
            formData.append("correo", $("#txtCorreo").val());
            const init = {
                method: "POST",
                body: formData,
                headers: {
                    accept: "application/json"
                }
            };
            const req = await fetch(url, init);
            const res = await req.json();
            if (req.ok) {
                location.href = './inicio.php';
            }
        } else {
            alert(msg);
        }

        // if (msg == '') {
        //     $.ajax({
        //         url: '../ajax/login_datos_sat.php',
        //         dataType: "text",
        //         data: {
        //             'RFC': $("#txtRFC").val(),
        //             'correo': $("#txtCorreo").val()

        //         },
        //         type: 'post',
        //         beforeSend: function() {
        //             $("#loading").show();
        //         },
        //         success: function(data, status) {

        //             data = JSON.parse(data);
        //             if (data !== "No se encontraron datos, favor de revisar la información") {

        //                 location.href = './inicio.php';
        //             } else {

        //                 alert(data);

        //             }
        //         },
        //         complete: function(data) {
        //             $("#loading").hide();
        //         }
        //     });
        // } else {
        //     alert(msg);
        // }

    }
</script>

<style>
    @font-face {
        font-family: "tit";
        src: url("../imagenes/TitilliumWeb-Regular.ttf");
    }

    body {
        font-family: tit;
        overflow-x: hidden;
        background: rgb(27, 15, 51);
        background: linear-gradient(90deg, rgba(27, 15, 51, 1) 0%, rgba(68, 42, 122, 1) 40%);
        /* background-image: none; */
    }

    .au {
        text-align: left;
        font-size: 21px;
        font-weight: bold;
        color: black;
        margin-left: 1px;
        margin-right:1px
    }

    .circle {
        height: 300px;
        width: 300px;
        display: table-cell;
        text-align: center;
        vertical-align: middle;
        border-radius: 50%;
        background: white;
        box-shadow: 0 0 15px 5px rgba(0, 0, 0, 0.7);

    }

    .sombra {
        box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.5);
        margin-left: 10px;
            margin-right:10px !important;
            width:90%;

    }

    .formresp {
        background-color: white;
        box-shadow: 0 0 5px 2px black;
        margin: 25px 300px 25px 300px;
    }

    @media (min-width:2200px) {
        .formresp {
            margin: 25px 600px 25px 600px;

        }
    }

    @media (max-width:1280px) {
        .formresp {
            margin: 25px 150px 25px 150px;

        }
    }

    @media (max-width:900px) {
        .formresp {
            margin: 15px 50px 15px 50px;

        }

        .au{
            margin-left: 10px;
            margin-right:10px
        }

        .sombra {

            margin-left: 10px;
            margin-right:10px !important;
            width:90%;


        }
    }

    @media (max-width:420px) {
        .formresp {
            margin: 10px 10px 10px 10px;

        }
    }

</style>

<div class="formresp">


    <img src="../imagenes/Logoblack.png" alt="logo" style="margin:30px; width:18%">

    <div>
        <p style="color:gray; background-color:lightgray; text-align:center; font-size:3px; margin: 0 60px 0 60px"> a </p>
        <br>
    </div>

    <div class="mt-4">
        <h3 style="text-align:center; color:black; font-weight:bold">Entrar a tu cuenta</h3>

        <br>
        <div class="mb-3 row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <label for="staticEmail" class="au">Correo:</label>

                <input type="text" class="form-control sombra" id="txtCorreo" value="">
                <br>
                <label for="inputPassword" class="au">RFC:</label>

                <input type="password" class="form-control sombra" id="txtRFC">
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="d-grid gap-2 col-3 mx-auto mt-5">
            <button type="submit" style="box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.5); background-color:#482c7c; border-color:#482c7c;" class="btn btn-success " id='btnEntrar'>Entrar</button>
            <button type="button" style="background-color:transparent ; color:#482c7c; border:0px; box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.5);" class="btn btn-warning mt-1 mb-5" id="btnRegistro">Crear Cuenta</button>
            <a href="" style="text-decoration: none; text-align:left; color:#482c7c; text-decoration:underline;">¿Olvdaste tu contraseña?</a> <br>
        </div>
    </div>
</div>

<p style="color:White; text-align:center; text-decoration:underline">2022 * factu.data. Todos los derechos reservados</p>

<div style="margin-left: 80px; margin-bottom:30px">
    <img src="../imagenes/back.png" alt="back" width="30px">
    <a href="../" style="color:White; text-align:center; text-decoration:underline; margin-left:10px">Regresar</a>
</div>

