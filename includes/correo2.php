<?php

$cuentaFactu = 'delabra32@gmail.com';
$nombre = $_POST['nombre'];
$empresa = $_POST['empresa'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$asunto = 'Planes';

$header =  'MIME-Version: 1.0' . "\r\n";
$header .= "From:  david.adame@evotek.com.mx" . "\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$mensajeCompleto = "<body>¡Hola " . $nombre . "!<br>  Agradecemos tu interés en factu.data, en breve uno de nuestros ejecutivos se pondrá en contacto,para poder agendar una cita en el horario y modalidad que se ajuste a tus necesidades.
    <br> <br> Mientras tanto te enviamos la información detallada de nuestros planes de contratación, 
    esto con el fin de que puedas analizar cuál se adapta mejor a tu proceso administrativo y 
    al tamaño de tu empresa..

    <b>Plan Starter</b> (Recomendado de 1 a 100 colaboradores) <br><br>
    Con el Plan Starter únicamente pagas por los registros generados, es decir realizarás un prepago por el número
    de registro de colaboradores que realices en la plataforma, se realizará un corte mensual y si no utilizaste todo tu saldo
    a corte del mes este se sumará al saldo del siguiente. <br> <br>

    -Tu saldo tendrá vigencia de 60 días naturales a partir del día de la contratación. <br>
    -En este plan el costo es por registro, el costo del registro es de $21.90 . <br>
    -Puedes contratar de 1 hasta 100 registros* <br>
    -Podrás descargar una base de datos con la información completa de las constancias de situación fiscal compatible para alta manual en tu ERP <br>
    -No incluye integración automática con tu ERP <br>
    -El ingreso de datos es através del escaneo del código QR o ingresando un archivo .pdf <br>
    -Acceso desde plataforma web y móviles. <br>
    -Asesoría y soporte técnico vía whats app durante 30 días hábiles a partir del día de la contratación <br> <br>

    <b>Plan Unique</b> (Recomendado más de 100 colaboradores) <br><br>

    Con el Plan Unique, estás cubierto durante 365 días de forma ilimitada* ya que sólo pagas
    una cuota anual de $2,279.90 la cual te dará acceso a la carga de registros ilimitados durante este periodo de tiempo. <br><br>

    -Tu saldo tendrá vigencia de 365 días naturales a partir del día de la contratación. <br>
    -En este plan ahorras hasta un 90% en el costo por registro <br>
    -Podrás descargar una base de datos con la información completa de las constancias de situación fiscal compatible para alta manual en tu ERP <br>
    -No incluye integración automática con tu ERP <br>
    -El ingreso de datos es a través del escaneo del código QR o ingresando un archivo .pdf <br>
    -Acceso desde plataforma web y móviles. <br>
    -Asesoría y soporte técnico vía whats app, telefónica y presencial * durante 90 días hábiles a partir del día de la contratación <br> <br>

    <b>Plan ERP</b> ( recomendado para empresas que ya utilizan un ERP en sus procesos administrativos) <br> <br>

    Con el Plan ERP, puedes personalizar tu plan, tu eliges número de usuarios, periodo de contratación y el tipo
    de implementación dentro de tu empresa, además de que contarás con materiales para la
    implementación dentro de tu empresa y capacitación personalizada paso a paso. <br><br>

    -En este plan ahorras hasta un 90% en el costo por registro <br>
    -Toda la información registrada se actualiza de forma automática en tu ERP <br>
    -El ingreso de datos es a través del escaneo del código QR o ingresando un archivo .pdf <br>
    -Acceso desde plataforma web y móviles. br  
    -Asesoría y soporte técnico vía whats app, telefónica y presencial * durante el periodo de contratación <br>
    -Capacitación presencial <br>
    -Materiales gráficos personalizados para tu implementación interna.

    <br> <br>¡Saludos!
    <br>
    <div class='d-flex'>
    <img src='./imagenes/iconoblack.png'>  
    <b>David Adame</b> | Co-Fundador
     </body>
     </div>";

$mensajeParaFactu = "(Costos y Planes) El siguiente usuario ha solicitado Costos y Planes: <br>  <br>  Nombre: " . $nombre . "<br> Empresa: " . $empresa . "<br> Correo: " . $correo . "<br> Telefono: " . $telefono . "<br> Favor de ponerse en contacto.";


//enviar a destinatario
mail($correo, $asunto, $mensajeCompleto, $header);

//enviar a cuenta factu.data
mail($cuentaFactu, $asunto, $mensajeParaFactu, $header);


?>

<script>
    alert("Información Solicitada Correctamente. \nRevisa tu bandeja de correos para mas información.");
    history.back();
</script>