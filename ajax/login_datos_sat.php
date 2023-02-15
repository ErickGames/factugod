
<?php

include_once("../config/global_config_includes.php");

$s = new SAT();

echo json_encode($s->login($_POST));
?>