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
        });

       $("#loading").hide();
    });

    $(document).ajaxStop(function() {
      $("#loading").hide();
    });

    function procesar(){

        $.ajax({
            url: '../ajax/procesar_datos_sat.php',
            dataType: "text",
            data: {
                'id_cliente': $("#sltCliente").val()
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
</script>

<div class="container text-center">

    <div class="row g-5">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
        <table>
            <tr>
                <td>
                    Cliente:
                </td>
                <td>
                    <select id='sltCliente' class="form-control">
                    </select>
                </td>
                <td colspand='2'>
                    <button type='button'  class="btn btn-info" id="btnProcesar">procesar</button>
                </td>
            </tr>
        </table>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>



