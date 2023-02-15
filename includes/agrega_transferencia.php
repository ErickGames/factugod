<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once("../config/global_config_includes.php");

if (!isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == 1) {
    header("Location: ./");
}

if ($_SESSION['id_usuario'] <> 1) {
    die();
}
?>
<style>
    body {
        background: rgb(27, 15, 51);
        background: linear-gradient(90deg, rgba(27, 15, 51, 1) 0%, rgba(68, 42, 122, 1) 40%);
    }
</style>
<script>
    $(document).ajaxStart(function() {
        $("#loading").show();
    });

    $(document).ready(function() { // Esta parte del código se ejecutará automáticamente cuando la página esté lista.

        $("#btnGuardar").click(function() {

            procesar();

        });

        var items = "";
        $.getJSON("../ajax/global_ajax_getclientes.php", function(data) {
            $.each(data, function(index, item) {
                if ($("#sltCliente").val() == item.id) {
                    items += "<option selected='selected' value='" + item.id + "'>" + item.nombre + "</option>";
                } else {
                    //if(item.id != 1){
                    items += "<option value='" + item.id + "'>" + item.nombre + "</option>";
                    //}
                }
            });
            $("#sltCliente").html(items);
        });

        $("#loading").hide();
    });

    $(document).ajaxStop(function() {
        $("#loading").hide();
    });

    function procesar() {

        var msg = '';

        if ($("#txtTitulo").val() == '' || $("#txtTitulo").val() == ' ') {
            msg += 'Favor de ingresar una descripcion.\n';
        }

        if ($("#txtMonto").val() == '' || $("#txtMonto").val() == ' ') {
            msg += 'Favor de ingresar un monto.\n';
        }

        if (msg == '') {
            $.ajax({
                url: '../ajax/guarda_transferencia.php',
                dataType: "text",
                data: {
                    'id_cliente': $("#sltCliente").val(),
                    'titulo': $("#txtTitulo").val(),
                    'monto': $("#txtMonto").val()
                },
                type: 'post',
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function(data) {
                    alert(data);
                    location.reload();
                },
                complete: function(data) {
                    $("#loading").hide();
                }
            });
        }
    }
</script>

<div class="container text-center">

    <div class="p-5 mt-5" style="background-color:whitesmoke; border-radius:15px">

        <h3 style="color:black; font-family:arialr">Agregar transferencia:</h3>

        <div class="mb-3">
            <label for="sltCliente" class="form-label" style="color:#442a7a">Cliente</label>
            <select id='sltCliente' class="form-select">
            </select>
        </div>
        <div class="mb-3">
            <label for="txtTitulo" class="form-label" style="color:#442a7a">Descripci&oacute;n</label>
            <input type="text" class="form-control" id="txtTitulo">
        </div>
        <div class="mb-3">
            <label for="txtMonto" class="form-label" style="color:#442a7a">Monto</label>
            <input type="text" class="form-control" id="txtMonto">
        </div>

        <div class="mb-3">
            <button type='button' class="btn btn-info" id="btnGuardar">Guardar</button>
        </div>

    </div>

</div>