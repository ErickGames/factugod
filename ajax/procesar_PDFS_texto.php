<?php

include_once("../config/global_config_includes.php");

$s = new SAT();

echo $s->procesarPDFS_texto($_POST);
?>