<?php

ini_set('upload_max_filesize', '1000M');
ini_set('post_max_size', '1000M');
set_time_limit(0);

session_start();

if(isset($_GET['d']) && !isset($_SESSION['id_usuario'])){

    $_SESSION['id_usuario'] = $_GET['d'];
}else{
    if(!isset($_SESSION['id_usuario'])){
        $_SESSION['id_usuario'] = '1';
    }
}

extract($_POST);
if(isset($btnSubir)){
	
	if($_FILES['filArchivo']['type']=="application/x-zip-compressed") {

        $nombre = date('d m Y G i s');

        $nombre_archivo = '../archivos/' . $_SESSION['id_usuario'] . '/' . $nombre . '.zip';

        if (!is_dir('../archivos')){
			
			mkdir('../archivos', 0777);
				
		}

        if (!is_dir('../archivos/' . $_SESSION['id_usuario'])){
			
			mkdir('../archivos/' . $_SESSION['id_usuario'], 0777);
				
		}
        
		if (move_uploaded_file($_FILES['filArchivo']['tmp_name'],  $nombre_archivo)){

            $s = new SAT();

            $s->guardaArchivo($nombre,$nombre_archivo,$_FILES['filArchivo']['size'],$_FILES['filArchivo']['type'],$_FILES['filArchivo']['name'], '../archivos/' . $_SESSION['id_usuario'] . '/');
            echo "<script>alert('El archivo ha sido cargado correctamente.')</script>";

            unset($_FILES);

        }else{
            echo "<script>alert('Ocurrió algún error al subir el fichero. No pudo guardarse.')</script>";
        }
	}
	
	else {
		echo "<script>alert('El tipo de archivo no es correcto.')</script>";
	}
}	


?>
<script>
    
    $(document).ajaxStart(function() {
        $("#loading").show();
    });

    $(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
				
        $("#btnEscanera").click(function() {
            
            escanear();
            
        });

        $("#btnIngresar").click(function() {
            
            ingresar();
            
        });

        $("#btnSubirZIP").click(function() {
            
            subir();
            
        });
        
        $("#btnGuardar").click(function() {
            
            validar();
            
        });
        
        $("#divIngresarDatos").css("display","none");
        $("#divSubirZIP").css("display","none");

        $("#loading").hide();
    });

    $(document).ajaxStop(function() {
      $("#loading").hide();
    });

    function escanear(){

        document.location.href='../gui/qr2.php';

    }

    function  ingresar(){

        $("#divIngresarDatos").css("display","block");
        $("#divSubirZIP").css("display","none");
    }

    function subir(){
        $("#divIngresarDatos").css("display","none");
        $("#divSubirZIP").css("display","block");
    }

    function validar(){
        var msg = '';

        if($("#txtRFC").val() == ''){
            msg = msg + 'Favor de ingresar el RFC\n';
        }

        if($("#txtIdCIF").val() == ''){
            msg = msg + 'favor de ingresar el idCIF\n';
        }

        if(msg==''){
            $.ajax({
                url: '../ajax/alta_datos_sat.php',
                dataType: "text",
                data: {
                    'rfc': $("#txtRFC").val(),
                    'idCIF': $("#txtIdCIF").val()
                },
                type: 'post',
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function(data) { 
                    alert (data);
                    //location.reload();
                },
                complete: function(data) { 
                    $("#loading").hide();
                }
            });
        }
        else{
            alert(msg);
        }

    }
</script>



<div class="container text-center">

    <div class="row g-5">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
        <h4 class="blog-post-title mb-4">Seleccione la opcion que desa usar:</h4>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    
    <div class="btn-group-vertical col-md-6" role="group">
        <button type='button' id="btnEscanera" class="btn btn-bd-secondary">Escanear codigo QR</button>
   
        <button type='button' id="btnIngresar" class="btn btn-bd-secondary">Ingresas datos</button>
        
        <button type='button' id="btnSubirZIP" class="btn btn-bd-secondary">Subir Archivo ZIP</button>
        
    </div>

    <div class="row g-5">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div id="divIngresarDatos">
                <table>
                    <tr>
                        <td>
                        <strong>RFC</strong>
                        </td>
                        <td>
                            <input type="text"  class="form-control" id="txtRFC"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <strong>idCIF</strong>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="txtIdCIF"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <button type='button' id="btnGuardar" class="btn btn-success">Guardar</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>

    <div class="row g-5">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div id="divSubirZIP">
                <form method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>
                            <input type="file"  class="form-control" id="filArchivo" name='filArchivo'/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <input type="submit" id="btnSubir" name='btnSubir' value="Subir" class="btn btn-success"/>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>