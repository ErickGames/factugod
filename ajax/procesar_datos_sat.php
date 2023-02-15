<?php

include_once("../config/global_config_includes.php");

$s = new SAT();

echo $s->procesarInformacion($_POST['id_cliente']);
?>