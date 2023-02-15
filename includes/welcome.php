<?php
if (session_status() === PHP_SESSION_ACTIVE)
    session_destroy();

?>


<style>
    body {
        background: rgb(27, 15, 51);
        background: linear-gradient(90deg, rgba(27, 15, 51, 1) 0%, rgba(68, 42, 122, 1) 40%);
        /* background-image: none; */
        overflow-x: hidden;
        width: 100%;

    }

    html {
        /* overflow-x: hidden; */
        width: 100%;

    }

    .alignb {
        display: flex;
        align-items: center;
    }

    .displaynone {
        display: block;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p {
        word-wrap: break-word;
    }

    .ocultar{
        display: none;
    }

    body{
        overflow-x: hidden;
    }

    @media (max-width:750px) {
        .displaynone {
            display: none;
        }
    }
    
</style>

<body>
    <div class="container">


        <div class="text-center">
            <h4 style="font-family:arialr">¡Da de alta tus datos sin errores en un click!</h4>
            <h6>Alta de datos de Constancia de Situación Fiscal</h6>
        </div>

        <div class="row">
            <div class="col-md-7">
                <h1 style="font-size:60px ; margin-left:30px ; font-family:arialr">¡En minutos!</h1>
                <h3 style="color:00ffff ; margin-left:30px ; font-family:arialr">fácil, seguro y en un click.</h3>
                <br><br>
                <p style="margin-left:30px;font-family:sources">
                    Factu.Data es un servicio de registro de datos totalmente seguro, el cuál será tu aliado en la actualización de los datos de facturación de tu nómina.
                </p>
                <p style="margin-left:30px; font-family:sources">
                    Con la garantía de cero errores en capturas de información y alta directa y automática en tu sistema de ERP.
                </p>

                <br><br>


                <div class="row">
                    <div class="col-md-7 d-flex">
                        <h2 style="font-size:30px ; margin-left:30px ; margin-right:20px; font-family:arialr"> Comienza tu registro aquí </h2>
                        <img src="../imagenes/flecha.png" alt="flecha" width="40px" height="40px">
                    </div>
                    <div class="col-md-5">
                        <button class="btn btn-primary m-2" style="background-color: #6fccdd; border-color:#6fccdd; color:WHITE; width:90%; height:90%; border-radius:20px; font-family:arialr; font-weight:bolder" id="btnRegistro2">¡CREA TU CUENTA!</button>
                        <script>
                            $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
                                $("#btnRegistro2").click(function() {

                                    location.href = "./gui_registro.php";
                                });
                            });
                        </script>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-md-5">
                <img src="../imagenes/senorm.png" alt="señor" width="99%">
            </div>
        </div>

        <br><br><br>
        <div class="text-center" id="ComoFunciona">

            <div class="row">
                <div class="col-1 displaynone">
                    <img src="../imagenes/msjs.png" alt="msjs" style="width: 100%;">
                </div>
                <div class="col-11">
                    <h1 style="margin-left:20px; font-size:50px; text-align:left; font-family:arialr"> ¿Cómo funciona?</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 row mt-5">
                    <div class="col-md-7">
                        <img src="../imagenes/paso1.png" alt="pasos" style="width:100% ;">
                    </div>
                    <div class="col-md-5">
                        <p style="text-align:left; font-size: 25px; font-weight:bold; font-family:arialr">Crea tu cuenta <br><span style="text-align:left; font-size: 15px; font-weight:normal; font-family:sources">Registrate con solo dos datos personales a factu.data</span></p>
                    </div>
                </div>
                <div class="col-md-6 row mt-5">
                    <div class="col-md-6">
                        <img src="../imagenes/paso2.png" alt="pasos" style="width:100% ; ">
                    </div>
                    <div class="col-md-6">
                        <p style="text-align:left; font-size: 25px; font-weight:bold; font-family:arialr">Elige tu plan <br><span style="text-align:left; font-size: 15px; font-weight:normal; font-family:sources">Tenemos tres planes que se ajustan a tus necesidades. Da click, elige y abona saldo. </span></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 row mt-5">
                    <div class="col-md-7">
                        <img src="../imagenes/paso3.png" alt="pasos" style="width:100% ;">
                    </div>
                    <div class="col-md-5">
                        <p style="text-align:left; font-size: 25px; font-weight:bold; font-family:arialr">Da click para alta de colabroadores <br><span style="text-align:left; font-size: 15px; font-weight:normal; font-family:sources">Elige la opción con la cual darás de alta a tus colaboradores: escanéo de QR o alta de .PDF</span></p>
                    </div>
                </div>
                <div class="col-md-6 row mt-5">
                    <div class="col-md-6">
                        <img src="../imagenes/paso4.png" alt="pasos" style="width:100% ;">
                    </div>
                    <div class="col-md-6">
                        <p style="text-align:left; font-size: 25px; font-weight:bold; font-family:arialr">Descarga o actualiza <br><span style="text-align:left; font-size: 15px; font-weight:normal; font-family:sources">Después de que la plataforma procese la información, descarga la base de datos con la información completa y correcta o bien revisa la actualización de tu ERP. </span></p>
                    </div>
                </div>
            </div>



            <br><br><br>
            <div>
                <div class="text-center" id="Beneficios">
                    <h1 style="font-family:arialr">Beneficios</h1>
                    <h4 style="font-family:sources">Actualiza de forma eficaz y automática los datos de tu personal.</h4>
                </div>

                <div class="row">
                    <div class="col-md-4 p-5">
                        <img src="../imagenes/ben1.png" alt="ben1" width="100%">
                        <p style="font-size:17px; text-align:center; font-family:sources"> <br> Todos los datos contenidos en cada constancia de situación fiscal se verán reflejados en tu base de datos, <span style="font-weight:bolder ;"> sin necesidad de captura*</span></p>
                        <p style="font-size:13px; text-align:center; font-family:sources"> *No se necesita la captura completa de datos, únicamente el escaneo de código QR, subida de archivo o bien los datos únicos emitidos por el SAT. </p>
                    </div>

                    <div class="col-md-4 p-5">
                        <img src="../imagenes/ben2.png" alt="ben1" width="100%">
                        <p style="font-size:17px; text-align:center; font-family:sources"> <br> Si cuentas con sistema ERP, <span style="font-weight:600 ;"> los datos se actualizarán de forma automática, </span> la alta de datos puede ser concentrada por RH ó realizada por cada colaborador.</p>
                    </div>

                    <div class="col-md-4 p-5">
                        <img src="../imagenes/ben3.png" alt="ben1" width="100%">
                        <p style="font-size:17px; text-align:center; font-family:sources"> <br> Te garantizamos que <span style="font-weight:600 ;"> los datos serán espejo de los ya existentes en el SAT, </span> de no ser así, el sistema se encargará de notificarte los "usuarios" con data errónea.</p>
                    </div>
                </div>

                <div class=" text-center">
                    <button class="btn btn-primary " style="background-color: #6fccdd; border-color:#6fccdd; color:WHITE; border-radius:20px; min-width:20%; min-height:50px; font-family:arialr; font-weight:bolder" id="btndemo">Solicita una Demo</button>
                </div>
                <script>
                    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
                        $("#btndemo").click(function() {

                            location.href = "./gui_formulario.php";

                        });
                    });
                </script>

            </div>
            <br><br>


            <style>
                .mujerresp {
                    display: block;
                    margin: auto;
                    width: 300px;
                }

                .altplanes {
                    min-height: 100% !important;
                }

                @media (max-width:780px) {
                    .mujerresp {
                        width: 219px;
                    }
                }

                @media (max-width:480px) {
                    .mujerresp {
                        width: 129px;
                    }
                }
            </style>

            <div id="Planes">
                <div class="row">
                    <!-- <div class="col-3 col-xs-0"></div> -->
                    <div class="col-3">
                        <img src="../imagenes/icoflechas.png" alt="arrows" style="display:block; margin:auto;" width="30%">

                    </div>
                    <div class="col-6">
                        <h1>Conóce el plan ideal</h1>
                        <h3>tenemos un esquema a tu medida</h3>
                    </div>
                    <div class="col-3">
                        <img src="../imagenes/icoperso.png" alt="perso" style="display:block; margin:auto" width="30%">

                    </div>
                    <!-- <div class="col-3 col-xs-0"></div> -->
                </div>

                <div class="row px-3 mt-4">
                    <div class="col-md-3 p-3">
                        <div class="bg-white altplanes p-3" style="border-radius:15px; color:black; box-shadow: 0px 0px 12px 2px rgba(0, 0, 0, 0.8)">
                            <h1 style="text-align: center; color:black; font-weight:bold">BÁSICO</h1>
                            <h6 style="color:black">por número de RFC's registrados</h6>

                            <br>

                            <p style="color:black">Si tu número de colaboradores es pequeño o bien solo relaizas validaciones y opreciones esporádicas, esta opcion es para ti.</p>
                            <br>
                            <p style="color:black">Sn contrato, sólo pagas por los registros utilizados deacuerdo al saldo que abones.</p>
                            <br>
                            <div class="text-center p-2" style="color:black; background-color:#AFDEAF; border-radius:15px">
                                <h2 style="color:black; font-weight:bold">$19.25</h2>
                                <h6>por RFC registrado</h6>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3 p-3">
                        <div class="bg-white p-3 altplanes " style="border-radius:15px; color:black; box-shadow: 0px 0px 12px 2px rgba(0, 0, 0, 0.8)">
                            <h1 style="text-align: center; color:black; font-weight:bold">PYME</h1>
                            <h6 style="color:black">Elige un paquete de registros de acuerdo al número de colaboradores de tu empresa.</h6>

                            <br>

                            <p style="color:black">Ideal para Pymes. Puedes elegir paquete de registros de acuerdo a los requerimentos de tu empresa, con la flexibilidad de selección
                                de vigencia y cantidad de RFC's a registrar.</p>
                            <br>
                            <p style="color:black">Toda tu información actualizada durante el tiempo de vigencia de tu plan, sin límite de actualizaciones.</p>
                            <br>
                            <div class="text-center p-2" style="color:black; background-color:#AFDEAF; border-radius:15px">
                                <h2 style="color:black; font-weight:bold">$1,137.50</h2>
                                <h6>consulta planes y vigencias</h6>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3 p-3">
                        <div class="bg-white p-3 altplanes" style="border-radius:15px; color:black; border-style:solid; border-width:5px; border-color:#6fccdd; box-shadow: 0px 0px 12px 2px rgba(111, 204, 221, 0.8)">
                            <h3 style="background-color: #6fccdd; text-align:center; color:white; border-radius:20px; box-shadow: 0px 0px 12px 2px rgba(0, 0, 0, 0.3)">RECOMENDADO</h3>
                            <h1 style="text-align: center; color:black; font-weight:bold">ERP</h1>
                            <h6 style="color:black">Integra factu.data a tu sistema de ERPP Microsip, actualización automatizada.</h6>

                            <br>

                            <p style="color:black">La version mas completa y poderosa de factu.data. <br> Con integración a tu sistema de ERP Microsip para un proceso automático de actualización
                                de datos en segundos.</p>
                            <br>
                            <!-- <p style="color:black">Toda tu información actualizada durante el tiempo de vigencia de tu plan, sin límite de actualizaciones.</p> -->
                            <br>
                            <div class="text-center p-2" style="color:black; background-color:#AFDEAF; border-radius:15px">
                                <h2 style="color:black; font-weight:bold">$2,100.50</h2>
                                <h6>con anexo al paquete contratado</h6>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3 p-3">
                        <div class="bg-white p-3 altplanes" style="border-radius:15px; color:black; box-shadow: 0px 0px 12px 2px rgba(0, 0, 0, 0.8)">
                            <h1 style="text-align: center; color:black; font-weight:bold">ÚNICO</h1>
                            <h6 style="color:black">Por número de RFC's registrados.</h6>

                            <br>

                            <p style="color:black">Si lo que necesitas es un plan hecho a la medida, con especificaciones o condiciones especiales. Contacta a uno de
                                nuestros especialistas comerciales. <br> Tenemos una opción para tu empresa.</p>
                            <br>
                            <!-- <p style="color:black">Toda tu información actualizada durante el tiempo de vigencia de tu plan, sin límite de actualizaciones.</p> -->
                            <br>
                            <div class="text-center p-2" style="color:black; background-color:#C7B0DE; border-radius:15px">
                                <h3 style="color:black; font-weight:bold">PERSONALIZADO</h3>
                                <h6>vía analisis de especificaciones</h6>
                            </div>

                        </div>
                    </div>

                </div>


                <button class="btn btn-primary m-2" style="background-color:#6fccdd; border-color:#6fccdd; color:WHITE; border-radius:15px; font-family:arialr; font-size:22px; height:70px" id="btndemo2">Mas Información</button>
                <script>
                    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
                        $("#btndemo2").click(function() {

                            document.getElementById('descripcionprecios').classList.remove('ocultar');
                        });
                    });
                </script>

                <div id="descripcionprecios" class="ocultar">
                    <div class="row bg-white p-4 mt-4" style="border-radius:20px; box-shadow: 0px 0px 12px 2px rgba(0, 0, 0, 0.8)">
                        <div class="col-md-2 text-start">
                            <h1 style="color:black">BÁSICO</h1>
                            <h2 style="color:black">$19.25 M.N.</h2>
                            <p style="color: black;">Precio por cada RFC registrado</p>
                        </div>
                        <div class="col-md-3 text-start">
                            <p style="color:black;">El plan básico consiste en únicamente pagar por los registros que usas, esto por medio de un sistema de prepago a través de Mercado Pago.
                                <br> <br>
                                Con este plan podrás abonar saldo a tu cuenta y procesar los registros para los que abones saldo, con una vigencia de operación de 60 dias naturales.
                                <br> <br>
                                factu.data mantendrá la actualización de los datos procesados durante el tiempo de la vigencia.
                            </p>
                        </div>
                        <div class="col-md-3 text-start">
                            <h5 style="color:blueviolet;">COBERTURA</h5>
                            <p style="color:black;">Durante los 60 dias de vigencia de tu saldo, además del procesamiento y actualización de datos tendrás acceso a:
                                <br> <br>
                                -Asesoría vía WhatsApp <br>
                                -Asesría vía telefónica <br>
                                -Acceso a tutoriales disponibles en la plataforma <br>
                                -90 min en asesoría virtual con un especialista factu.data <br>
                                -Cero perdidas de saldo al abonar saldo antes de su vigencia.
                            </p>
                        </div>
                        <div class="col-md-4 text-start" style="background-color:gainsboro; border-radius:15px;">
                            <h5 style="color:blueviolet; text-align:right">EJEMPLO</h5>

                            <p style="color: black;">Soy una pequeña empresa con 20 empleados y me es importante la verificación de los datos correctos de mis colaboradores para el correcto firmado de nómina.</p>

                            <div class="row">
                                <div class="col-6">
                                    <p style="color: black; font-weight:bold">20 empleados <br> $19.25 costo por registro</p>
                                </div>
                                <div class="col-6">
                                    <h5 style="color: black; font-weight:bold">$385.00 M.N.</h5>
                                </div>
                            </div>

                            <p style="color: black;">Esto es lo que pagarás por 20 RFC's registrados. <br>Los cuales tendrán datos actualizados al dia de la vigencia de vencimiento de tu saldo contratado.</p>

                        </div>
                    </div>


                    <div class="row bg-white p-4 mt-4" style="border-radius:20px; box-shadow: 0px 0px 12px 2px rgba(0, 0, 0, 0.8)">
                        <div class="col-md-2 text-start">
                            <h1 style="color:black">PYME</h1>
                            <h2 style="color:black">$437.50* M.N.</h2>
                            <p style="color: black;">Precio de contratacion por paquete mensual de 0 - 100 regsitros</p>
                        </div>
                        <div class="col-md-4 text-start">
                            <p style="color:black;">Un plan ideal para medianas empresas en el cuál puedes elegir un plan deacuerdo a tu número de colaboradores y el tiempo o vigencia de actualización de datos que requieras según tu volumen y ritmo de operación.
                                <br> <br>
                                factu.data mantendrá los datos actualizados de todos los colaboradores que des de alta en este periodo de tiempo, todos los cambios y actualizaciones serán del dia de proceso.
                            </p>
                        </div>
                        <div class="col-md-6 text-start">
                            <h5 style="color:blueviolet;">COBERTURA</h5>
                            <p style="color:black;">Durante la vigencia de tu plan, además del procesamiento y actualización de datos tendrás acceso a:
                                <br>
                                -Asesoría vía WhatsApp <br>
                                -Asesría vía telefónica <br>
                                -Acceso a tutoriales disponibles en la plataforma <br>
                                -De 2 a 8hrs en asesoría virtual con un especialista factu.data <br>
                                -Materiales de implementación para tus colaboradores <br>
                                -Implementación remota con asesoría uno a uno
                            </p>

                            <div style="background-color:gainsboro; border-radius:15px">
                                <h5 style="color:blueviolet; text-align:right">EJEMPLO</h5>
                                <img src="../imagenes/tabla1.png" alt="a" style="width: 100%; padding:10px; border-radius:25px">
                            </div>
                        </div>
                    </div>



                    <div class="row bg-white p-4 mt-4" style="border-radius:20px; box-shadow: 0px 0px 12px 2px rgba(0, 0, 0, 0.8)">
                        <div class="col-md-2 text-start">
                            <h1 style="color:black">ERP</h1>
                            <h2 style="color:black">$2,100.50* M.N.</h2>
                            <p style="color: black;">Costo anexo al paquete de registros y vigencia contratados</p>
                        </div>
                        <div class="col-md-3 text-start">
                            <p style="color:black;">Un plan ideal para medianas y grandes empresas en el cual además de tener la libertad de elegir un plan de acuerdo a tu número de colaboradores
                                y el tiempo o vigencia de actualización de datos, factu.data se integra a tu sistema ERP Microsip.
                                <br> <br>
                                factu.data mantendrá los datos actualizados de todos los colaboradores que des de alta en este periodo de tiempo, todos los cambios y actualizaciones se verán reflejadosen tiempo real sin importar el número de actualizaciones o cambios que ocurran.
                            </p>
                        </div>
                        <div class="col-md-3 text-start">
                            <h5 style="color:blueviolet;">COBERTURA</h5>
                            <p style="color:black;">Sumada a la cobertura del plan PYME, el plan ERP integra factu.data a tu sistema microsip, esta integración abarca:
                                <br> <br>
                                -Conexión de tu ERP via remota o presencial* <br>
                                -Asesría técnica durante la vigencia de contratación <br>
                                -Habilitación de alertas de actualización <br>
                                -Capacitación presencial <br>
                                -Tutorial exclusivo Microsip.
                            </p>
                        </div>
                        <div class="col-md-4 text-start" style="background-color:gainsboro; border-radius:15px">
                            <h5 style="color:blueviolet; text-align:right">EJEMPLO</h5>

                            <p style="color: black;">Soy una empresa con 210 empleados y la verificación de los datos de mis colaboradores consume mucho tiempo de los procesos mensuales y pone en riesgo el timbrado correcto de
                                nómina, asi como el pago de esta dentro del esquema fiscal.</p>

                            <div class="row">
                                <div class="col-6">
                                    <p style="color: black; font-weight:bold">210 empleados <br> $1,300 del plan trimestral <br> $2100 Cuota única de conexión</p>
                                </div>
                                <div class="col-6">
                                    <h5 style="color: black; font-weight:bold">$3400.00 M.N.</h5>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="row bg-white p-4 mt-4" style="border-radius:20px; box-shadow: 0px 0px 12px 2px rgba(0, 0, 0, 0.8)">
                        <div class="col-md-2 text-start">
                            <h1 style="color:black">ÚNICO</h1>
                            <h3 style="color:black">PERSONALIZADO</h3>
                            <p style="color: black;">El precio del plan se define a través de un análisis detallado de requerimentos técnicos y de volumen de operación</p>
                        </div>
                        <div class="col-md-6 text-start">
                            <p style="color:black;">Si tu empresa tiene requerimientos especiales referentes a número de registros, vigencias únicas de contratación o de conexión a otros sistemas ERP, contamos con un equipo técnico y comercial capacitado para crear un lan alienado a tus necesidades.
                                <br> <br>
                                Comunícate con nosotros.

                            </p>
                        </div>
                        <div class="col-md-4 text-start" style="background-color:gainsboro; border-radius:15px">
                            <h5 style="color:blueviolet; text-align:right">EJEMPLO</h5>

                            <p style="color: black;">Soy una empresa con más de 2 mil empleados, necesito la validación de datos de mis colaboradores el día 13 de cada mes, sin riesgo de errores, operó con SAP y necesito realizar la actualización de mi sistema de forma manual y controlada.
                                <br> <br>
                                Además de contar con varios perfiles de administrador de la plataforma y carga uno a uno a través de mis colaboradores.
                            </p>

                        </div>
                    </div>

                </div>


            </div>

        </div>
    </div>
    </div>
</body>