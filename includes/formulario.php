<head>

</head>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Formulario</title>
</head>

<style>
    .form-control{
        margin-left:10px;
        width:90%;
    }

    .form-label{
        margin-left:10px;
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
            margin: 15px 30px 15px 30px;

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

        <form action="../includes/correo.php" method="POST">
            <div>
                <p style="color:gray; background-color:lightgray; text-align:center; font-size:3px; margin: 0 60px 0 60px"> a </p>
                <br>
            </div>

            <div>
                <h3 style="text-align:center; font-family:tit">Solicitar una demostración</h3>
                <h6 style="text-align:center; font-family:tit; margin-left:40px; margin-right:40px">Registra tus datos y un especialista se contactará
                    contigo para explicarte a detalle cómo funciona la
                    plataforma y los beneficios para tu negocio.</h6>
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

            <div class="row" style="text-align:left">
                <div class="col-md-3"></div>

                <div class="col-md-6">
                    <label class="form-label" style="font-size:15px ;" for="">APELLIDO:</label>
                    <input class="form-control" type="text" name="apellido" id="apellido">
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

            <div class="row" style="text-align:left">
                <div class="col-md-3"></div>

                <div class="col-md-6">
                    <label class="form-label" style="font-size:15px ;" for="">EMPLEADOS:</label>
                        <select class="form-select form-select-md" name="empleados" id="empleados">
                            <option value="1-100" selected>1 - 100</option>
                            <option value="101-500">101 - 500</option>
                            <option value="+500">más de 500</option>
                        </select>
                </div>

                <div class="col-md-3"></div>
            </div>

            <br>
            <div class="text-center">
                <button type="submit" target="_blank" class="btn btn-primary" style="background-color:#482c7c; border-color:#482c7c">ENVIAR</button>
            </div>

            <div style="padding: 40px ;">
                <a href="../" style="color:gray; font-size:20px">Regresar</a>
            </div>


        </form>

    </div>

    <p style="color:White; text-align:center; text-decoration:underline">2022 * factu.data. Todos los derechos reservados</p>


</body>

</html>