<?php

$cuentaFactu = 'delabra32@gmail.com';
$nombre = $_POST['nombre'];
$empresa = $_POST['empresa'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$asunto = 'Más información';

$header =  'MIME-Version: 1.0' . "\r\n";
$header .= "From:  david.adame@evotek.com.mx" . "\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$mensajeCompleto = "<body>¡Hola " . $nombre . "!<br>  Agradecemos tu interés en factu.data, en breve uno de nuestros ejecutivos se pondrá en contacto,para poder agendar una cita en el horario y modalidad que se ajuste a tus necesidades.
    <br> <br> Mientras tanto te enviamos la información detallada de nuestros planes de contratación, 
    esto con el fin de que puedas analizar cuál se adapta mejor a tu proceso administrativo y 
    al tamaño de tu empresa..
    <br> <br>

    <img src='./imagenes/caracteristicas_mf.png' >  

    <br> <br>¡Saludos!
    <br>
    <div class='d-flex'>
    <img src='./imagenes/iconoblack.png'>  
    <b>David Adame</b> | Co-Fundador
     </body>
     </div>";

$mensajeParaFactu = "(Más Información) El siguiente usuario ha solicitado Más inforamción sobre Costos y Planes: <br>  <br>  Nombre: " . $nombre . "<br> Empresa: " . $empresa . "<br> Correo: " . $correo . "<br> Telefono: " . $telefono . "<br> Favor de ponerse en contacto.";

$mail->AddAttachment('pdf_files/', 'reservation.pdf');

//enviar a destinatario
mail($correo, $asunto, $mensajeCompleto, $header);

//enviar a cuenta factu.data
mail($cuentaFactu, $asunto, $mensajeParaFactu, $header);


?>

<script>
    alert("Información Solicitada Correctamente. \nRevisa tu bandeja de correos para mas información.");
    history.back();
</script>