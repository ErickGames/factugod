<?php


include_once("../config/global_config_includes.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ./");
}
?>


<style>
    body {
        color: black;
    }

    .form-label, .form-control{
        margin-left:10px;
        width:90%;
    }

    .texto-borde {
        text-shadow: 2px 0 0 #000, -2px 0 0 #000, 0 2px 0 #000, 0 -2px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
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
    }

    @media (max-width:420px) {
        .formresp {
            margin: 10px 10px 10px 10px;

        }
    }
</style>

<body style="background: rgb(156,154,154); background: linear-gradient(0deg, rgba(156,154,154,1) 30%, rgba(44,27,79,1) 30%, rgba(44,27,79,1) 94%, rgba(34,18,61,1) 100%); overflow-x: hidden; ">

    <div class="formresp">

        <div>
            <img src="../imagenes/Logoblack.png" alt="logo" style="margin:30px; width:18%">
        </div>

        <form id="form1" name="form1" method="POST">
            <div>
                <p style="color:gray; background-color:lightgray; text-align:center; font-size:3px; margin: 0 60px 0 60px"> a </p>
                <br>
            </div>

            <div>
                <h3 style="text-align:center; font-family:tit">MÁS INFORMACIÓN</h3>
                <!-- <h6 style="text-align:center; font-family:tit; margin-left:40px; margin-right:40px">Registra tus datos y un especialista se contactará
                    contigo para explicarte a detalle cómo funciona la
                    plataforma y los beneficios para tu negocio.</h6> -->
                <br>
            </div>

            <div class="row" style="text-align:left">
                <div class="col-md-3"></div>

                <div class="col-md-6">
                    <label class="form-label" style="font-size:15px ;" for="">NOMBRE:</label>
                    <input class="form-control" type="text" name="nombre" id="nombre">
                </div>

                <div class="col-md-3"></div>
            </div>

            <div class="row" style="text-align:left; margin-top:15px">
                <div class="col-md-3"></div>

                <div class="col-md-6">
                    <label class="form-label" style="font-size:15px ;" for="">EMPRESA<span style="color:red">*</span></label>
                    <input class="form-control" type="text" name="empresa" id="empresa" required>
                </div>

                <div class="col-md-3"></div>
            </div>

            <div class="row" style="text-align:left; margin-top:15px">
                <div class="col-md-3"></div>

                <div class="col-md-6">
                    <label class="form-label" style="font-size:15px ;" for="">CORREO ELECTRONICO<span style="color:red">*</span></label>
                    <input class="form-control" type="email" name="correo" id="correo" required>
                </div>

                <div class="col-md-3"></div>
            </div>

            <div class="row" style="text-align:left; margin-top:15px">
                <div class="col-md-3"></div>

                <div class="col-md-6">
                    <label class="form-label" style="font-size:15px ;" for="">TELÉFONO:</label>
                    <input class="form-control" type="tel" name="telefono" id="telefono">
                </div>

                <div class="col-md-3"></div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center">
                    <div class="text-center">
                        <input type="button" target="_blank" class="btn btn-primary m-2" style="background-color:#482c7c; border-color:#482c7c" value="Solicitar Demo" onclick="document.form1.action = '../includes/correo.php'; document.form1.submit()">
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <div class="text-center">
                        <input type="button" target="_blank" class="btn btn-primary m-2" style="background-color:#482c7c; border-color:#482c7c" value="Costos y Planes" onclick="document.form1.action = '../includes/correo2.php'; document.form1.submit()">
                    </div>
                </div>
            </div>
            
            <p style="color:gray; background-color:lightgray; text-align:center; font-size:3px; margin: 10px 60px 20px 60px"> a </p>


            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <a class="btn btn-primary m-2" href="../imagenes/guarapidaadmin.pdf" download="GuiaRápida.pdf" style="background-color:#2cc1d1; border-color:#2cc1d1; color:black">Descargar PDF Informativo</a>
                </div>
            </div>
            
            <div style="padding: 30px ;">
                <a onclick="history.back()" style="color:gray; font-size:20px" href="javascript:void(0)">Regresar</a>
            </div>

        </form>

    </div>

    <p style="color:White; text-align:center; text-decoration:underline">2022 * factu.data. Todos los derechos reservados</p>

</body>

