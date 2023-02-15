<?php

$cuentaFactu = 'delabra32@gmail.com';
$nombre = $_POST['nombre'];
$empresa = $_POST['empresa'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

$apellido = $_POST['apellido'];
$empleados = $_POST['empleados'];
$asunto = 'Solicitud de Demo';

$header =  'MIME-Version: 1.0' . "\r\n";
$header .= "From:  david.adame@evotek.com.mx" . "\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$mensajeCompleto = "<body>¡Hola " . $nombre . "!<br>  Agradecemos tu interés en factu.data, en breve uno de nuestros ejecutivos se pondrá en contacto,para poder agendar una cita en el horario y modalidad que se ajuste a tus necesidades.
    <br> <br> Si tienes algúna pregunta o comentario, no dudes en contactarnos.
    <br> <br>¡Saludos!
    <br>
    <div class='d-flex'>
    <img src='./imagenes/iconoblack.png'>  
    <b>David Adame</b> | Co-Fundador
     </body>
     </div>";

$mensajeParaFactu = "(Demo)El siguiente usuario ha solicitado una demo: <br>  <br>  Nombre: " . $nombre . " ". $apellido ."<br> Empresa: " . $empresa . " con ".$empleados." empleados" . "<br> Correo: " . $correo . "<br> Telefono: " . $telefono . "<br> Favor de ponerse en contacto.";


//enviar a destinatario
mail($correo, $asunto, $mensajeCompleto, $header);

//enviar a cuenta factu.data
mail($cuentaFactu, $asunto, $mensajeParaFactu, $header);


?>

<script>
    alert("Demo solicitada correctamente. \nRevisa tu bandeja de correos para mas información.");
    history.back();
</script>


