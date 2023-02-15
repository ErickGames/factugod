<?php

include_once ("../config/global_config_includes.php"); 
	$nom = new SAT();
	$res = $nom->getArchivosProcesar($_GET['id_cliente']);
	$array = array();
	$i=0;
	if (count($res)>0){
		foreach ($res as $row){
			$array[$i] = 
				array(
					"id"=>$row['id'],
					"nombre"=>$row['nombre']
				);
			$i++;
		}
	}else{
		$array[0] = array(
					"id"=>'',
					"nombre"=>''
				);
	}
echo json_encode($array);
?>