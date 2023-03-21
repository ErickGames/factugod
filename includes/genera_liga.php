<?php


include_once("../config/global_config_includes.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ./");
}
?>
<style>
    body {

        background: white;
    }
</style>
<script>
    $(document).ajaxStart(function() {
        $("#loading").show();
    });

    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

        $("#btnGeneraLiga").click(function() {

            generaLiga();

        });

        $("#loading").hide();

    });

    $(document).ajaxStop(function() {
        $("#loading").hide();
    });

    var x = <?php echo $_SESSION['id_usuario'] ?>;

    function generaLiga() {

        document.getElementById('modalito').classList.remove('ocultar123');
        $("#hrfLink").attr("href", './gui_ingresa_datos.php?d=' + x);
        $("#hrfLink").html("<h5>Liga para Colaboradores</h5>");

    }
</script>

<style>
    .resp1 {
        padding: 80px;
    }

    @media (max-width:520px) {
        .resp1 {
            padding: 5px;
        }
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


<div class="row">

    <div id="div1" class="col-md-3" style=" background: rgb(27, 15, 51); background: linear-gradient(90deg, rgba(27, 15, 51, 1) 0%, rgba(68, 42, 122, 1) 40%); ">
        <img src="../imagenes/infoicoblanco.png" alt="" style="display: block; margin:auto; margin-top:20px; width:100px">
        <h2 style="color: white;font-weight: 900; text-align:center; margin-top:20px; font-family:sources">CREAR LINK <br>EMPRESARIAL</h2>
        <h5 style="color: white;font-weight: 400; text-align:center; font-size:30px; font-family:sources"><?php echo $_SESSION['razonsocial'] ?></h5>
    </div>

    <div class="col-md-9 resp1">
        <div style="background-color:lightgrey ; border-radius:25px; padding:20px; box-shadow:0px 0px 10px 2px rgba(0, 0, 0, 0.5)">
            <h1 style="text-align:center; color:gray;">LINK EMPRESARIAL</h1>

            <div class="row">
                <div class="col-md-6">
                    <p style="color:black; margin-top:80px">El link empresarial facilitará el proceso de alta de datos de tus colaboradores.
                        <br><br>
                        factu.data creará de forma automática un link que dará acceso a la plataforma <span style="font-weight: bold;">sin necesidad de la cración de usuarios únicos.</span>
                    </p>
                </div>
                <div class="col-md-6 row">
                    <div class="col-3">
                        <img src="../imagenes/ico_link.png" alt="ico" style="width: 35px; height:35px; margin-top:70px; margin-left:35px">
                    </div>
                    <div class="col-9">
                        <p style="color:black; margin-top:70px"><b>Crea</b> el link</p>
                    </div>

                    <div class="col-3">
                        <img src="../imagenes/ico_red.png" alt="ico" style="width: 35px; height:35px; margin-top:15px; margin-left:35px">
                    </div>
                    <div class="col-9">
                        <p style="color:black; margin-top:14px"><b>Copia la liga</b> que aparece en la barra de navegación</p>
                    </div>

                    <div class="col-3">
                        <img src="../imagenes/ico_msg.png" alt="ico" style="width: 35px; height:35px; margin-top:15px; margin-left:35px">
                    </div>
                    <div class="col-9">
                        <p style="color:black; margin-top:14px"><b>Compártelo</b> con tus colaboradores via e-mail</p>
                    </div>

                    <div class="col-3">
                        <img src="../imagenes/ico_subir.png" alt="ico" style="width: 35px; height:35px; margin-top:15px; margin-left:35px">
                    </div>
                    <div class="col-9">
                        <p style="color:black; margin-top:14px"><b>Al dar click</b> podrán ingresar a factu.data en automático</p>
                    </div>
                    <br><br><br>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <input type="button" class="btn btn-info" value="Generar LINK" name="btnGeneraLiga" id="btnGeneraLiga" style="background-color:#442a7a; border-color:#442a7a; color:white" data-bs-toggle="modal" data-bs-target="#modalId" />
            <a name="" id="" class="btn btn-primary" href="../imagenes/guiarapidadmin.pdf" download role="button" style="background-color:aqua ; border-color:aqua; color:white; margin-left:15px">Descargar Guía de Uso</a>
        </div>
        <br>
        <div id="modalito" class="ocultar123">
            <!-- Modal -->
            <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!-- <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId" style="color:black">Liga para colaboradores</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> -->
                        <div class="modal-body">
                            <div class="container-fluid">
                                <br>
                                <img src="../imagenes/Logo_header2black.png" alt="asda" style="width:50%; display:block; margin:auto">
                                <br>
                                <h4 style="color:black; font-weight:bold; text-align:center">Copia y pega este link.</h4>
                                <br>
                                <p style="color:black;  text-align:center">Compartelo con tus colaboradores para que generen el registro de sus datos. <br>Este link es exclusivo para el uso del personal de tu empresa</p>
                                <br>
                                <a href="" id='hrfLink' style="margin-left: 50px; text-align:center"></a>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Listo</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                var modalId = document.getElementById('modalId');

                modalId.addEventListener('show.bs.modal', function(event) {
                    // Button that triggered the modal
                    let button = event.relatedTarget;
                    // Extract info from data-bs-* attributes
                    let recipient = button.getAttribute('data-bs-whatever');

                    // Use above variables to manipulate the DOM
                });
            </script>
        </div>

    </div>
</div>

<!-- <div style="background-color:aliceblue ;"">

    <h2 style="color: #482c7c;font-weight: 900; font-family:sans-serif; margin-top:20px">Generar Link para Usuarios:</h2>
    <br> <br>

    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <input style="margin-bottom:150px" type="button" class="btn btn-info" value="Generar LINK" name="btnGeneraLiga" id="btnGeneraLiga" />
            <br>
            <br>
            <a href="" id='hrfLink'></a>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div> -->