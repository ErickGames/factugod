                <style>
                    footer {
                        bottom: 0;
                        left: 0;
                        width: 100%;
                    }

                    html {
                        width: 100%;

                    }

                    body {
                        width: 100%;
                        overflow-x: hidden;
                    }

                    .img1 {
                        position: absolute;
                        left: 50px;
                        width: 250px;
                        margin-top: 60px
                    }

                    .chicaf {
                        position: relative;
                        bottom: 100px;
                        left: 150px;
                        width: 350px;


                    }

                    .v-line {
                        border-left: thick solid #fff;
                        height: 30%;
                        left: 50%;
                        position: absolute;
                        margin-top: 80px
                    }

                    .testo {
                        text-align: justify;
                        padding: 50px;
                        margin-top: 60px
                    }

                    .redes {
                        /* display: block; */
                        margin: auto;
                    }

                    .estredes{
                        text-align:center; 
                        margin-top:-90px;
                    }

                    @media (max-width:780px) {
                        .img1 {
                            width: 200px;
                            left: 20px;
                        }

                        .v-line {
                            border-left: thick solid #fff;
                            height: 0%;
                            left: 50%;
                            position: absolute;
                        }

                        .chicaf {
                            position: inherit;
                            width: 250px;
                            display: block;
                            margin: auto;
                        }

                        .testo {
                            text-align: justify;
                            padding: 20px;
                            font-size: 15px;
                        }

                        .redes {
                            width: 15%;
                        }

                        .fb {
                            width: 10%;
                        }
                        .estredes{
                        text-align:center; 
                        margin-top:0px;
                    }
                    }

                    @media (max-width:480px) {
                        .img1 {
                            width: 110px;
                            left: 10px;

                        }

                        .v-line {
                            border-left: thick solid #fff;
                            height: 0%;
                            left: 50%;
                            position: absolute;
                        }

                        .chicaf {
                            position:inherit;
                            width: 175px;
                            display: block;
                            margin: auto;
                        }

                        .testo {
                            margin-top: 10px;
                            text-align: justify;
                            padding: 8px;
                            font-size: 12px;
                        }

                        .redes {
                            width: 20%;
                        }

                        .fb {
                            width: 12%;
                        }
                    }
                </style>

                <div>

                    <img src="../imagenes/Logo_header2.png" alt="logo" class="img1">

                </div>

                <footer style="background-color: black; margin-top:150px">

                    <div class="row">

                        <div class="col-md-6">
                            <p class="testo">
                                <span style="font-weight:bold;">Factu.Data</span> es una plataforma de automatización de datos, fácil de usar y creada para ser la herramienta clave ideal de pequeñas
                                y medianas empresas, en la actualización de la constancia de situación fiscal de sus colaboradores. <br> <br>
                                Factu.data integra los datos de forma clara, segura,sin engorrosas capturas y con la garantía de ser espejo de la información existente en el sistema administrativo tributario. Optimiza tu tiempo.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="v-line"></div>
                            <img src="../imagenes/chicafooter.png" alt="img" class="chicaf">
                            <h4 class="estredes">Encuentranos en:</h4>

                            <div class="d-flex" style=" width:50%; margin-left:25%">
                                <a href="" class="redes" target="_blank"><img src="../imagenes/whats.png" alt="redes"></a>
                                <a href="https://www.instagram.com/factu.data/" class="redes" target="_blank"><img src="../imagenes/insta.png" alt="redes"></a>
                                <a href="https://www.facebook.com/factudata.mx" class="redes fb" target="_blank"><img src="../imagenes/fb.png" alt="redes"></a>
                            </div>

                            <div class="text-center mb-3">
                                <div class="d-flex justify-content-center p-2">
                                   <img src="../imagenes/logocuadritoscyan.png" alt="logo" style="width:20px ; height:20px">
                                   <a href="../gui/gui_aviso2.php" style="color:white; ">&nbsp  Aviso de Privacidad</a>
                                </div>

                                <br>
                                <h5 style="font-size:20px">2022 factu.data. Todos los derechos reservados</h5>
                            </div>
                        </div>

                    </div>

                    <!-- <div class="row " style="text-align:center; margin-top:150px">
                        <div class="col-md-2 p-4"></div>
                        <div class="col-md-2  p-4">
                            <a href="https://www.facebook.com" target="_blank" style=" text-decoration:none; color:white;"> <img src="../imagenes/fb.png" alt="logo" width="20px"> </a> <br>
                        </div>
                        <div class="col-md-2  p-4">
                            <a href="https://www.instagram.com" target="_blank" style=" text-decoration:none; color:white;"> <img src="../imagenes/insta.png" alt="logo" width="30px"> </a> <br>
                        </div>
                        <div class="col-md-2  p-4">
                            <a href="https://www.twitter.com" target="_blank" style=" text-decoration:none; color:white;"> <img src="../imagenes/whats.png" alt="logo" width="30px"> </a> <br>
                        </div>
                        <div class="col-md-2  p-4">
                            <a href="https://www.youtube.com" target="_blank" style=" text-decoration:none; color:white;"> <img src="../imagenes/preg.png" alt="logo" width="30px"> </a> <br>
                        </div>
                        <div class="col-md-2 p-4"></div>
                    </div>

                    <p style="width:200% ; background-color:white;font-size:1px; color:white">a</p>

                    <div class="row" style="text-align:center;">
                        <div class="col-md-4  mb-4">
                            <a href="./gui_masinfo.php" style=" text-decoration:none; color:white;">Acerca de la Empresa</a>
                        </div>
                        <div class="col-md-4  mb-4">
                            <a href="./gui_aviso.php" style=" text-decoration:none; color:white;">Politica de Privacidad</a>
                        </div>
                        <div class="col-md-4  mb-4">
                            <a href="./gui_preguntas.php" style=" text-decoration:none; color:white;">Contacto</a>
                        </div>
                    </div> -->
                </footer>

                </div>
                </main>

                <!--<footer class="text-muted text-center ">
        <div class="navbar-dark bg-dark shadow-sm">
            <div class="container py-2" style='color: white;'>
                <p class="mb-1"><a href="/" style='color: white;'>Acerca de la empresa</a> | <a href="/" style='color: white;'>Política de privacidad</a> | <a href="/" style='color: white;'>Contacto</a></p>
            </div>
        </div>
        </footer>-->


                <script src="../lib/bootstrap-5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
                </body>

                </html>