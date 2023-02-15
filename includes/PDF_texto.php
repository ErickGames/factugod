<?php


include_once("../config/global_config_includes.php");


?>
<style>
body {
  background-image: url("../imagenes/Background-09.png");
}
</style>
<script>
    
    $(document).ajaxStart(function() {
        $("#loading").show();
    });

    $(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
				
        $("#btnProcesar").click(function() {
            
            procesar();
            
        });

        $("#sltCliente").change(function() {
            
            LlenaArchivos();
            
        });

		var items="";
        $.getJSON("../ajax/global_ajax_getclientes.php",function(data){
            $.each(data,function(index,item){
                if ($("#sltCliente").val() == item.id){
                    items+="<option selected='selected' value='"+item.id+"'>"+item.nombre+"</option>";
                }else{
                    items+="<option value='"+item.id+"'>"+item.nombre+"</option>";
                }
            });
            $("#sltCliente").html(items); 
            LlenaArchivos();
        });

        $("#loading").hide();

    });

    $(document).ajaxStop(function() {
      $("#loading").hide();
    });

    function procesar(){
        var msg = '';

        if($("#sltArchivo").val() == '0'){

            msg = 'Favor de seleccionar un archivo.';
        }

        if(msg==''){
            $.ajax({
                url: '../ajax/procesar_PDFS_texto.php',
                dataType: "text",
                data: {
                    'id_cliente': $("#sltCliente").val(),
					'id_archivosSAT': $("#sltArchivo").val()
                },
                type: 'post',
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function(data) { 
                    alert (data);
                    location.reload();
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

    function LlenaArchivos(){
        
        var items2="";
        $.getJSON("../ajax/global_ajax_getArchivosProcesar.php?id_cliente=" + $("#sltCliente").val(),function(data){
            $.each(data,function(index,item){
                items2+="<option value='0'></option>";
                if ($("#sltArchivo").val() == item.id){
                    items2+="<option selected='selected' value='"+item.id+"'>"+item.nombre+"</option>";
                }else{
                    items2+="<option value='"+item.id+"'>"+item.nombre+"</option>";
                }
            });
            $("#sltArchivo").html(items2); 
        });
    }
</script>
<div class="container text-center">

    <div class="row g-5">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
        <form method="post" enctype="multipart/form-data">
            Cliente:
            <select id='sltCliente' class="form-control">
            </select>
            <br>
            Archivos:
            <select id='sltArchivo' class="form-control">
            </select>
            <br>
            <input type="button" class="btn btn-info" value="Procesar" name="btnProcesar" id="btnProcesar" />
        </form>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
