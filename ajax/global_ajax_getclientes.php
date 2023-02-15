<?php

include_once ("../config/global_config_includes.php"); 
	$nom = new SAT();
	$res = $nom->getClientes();
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