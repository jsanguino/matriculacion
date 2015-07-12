<?php
header('Content-Type: text/html; charset=utf-8');
include('./include/configuracion.php');
include('./class/funciones.php');
$tabla='matriculacion';
	try {
		$bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$bdd = new PDO($dsn, $user, $pass);
		} catch(Exception $e) {
	exit('Unable to connect to database.');
	}

	$sql="SELECT aapellidos,anombre,id FROM $tabla order by aapellidos";
	$matricula=$bdd->query($sql);
	while ($matricula->fetch(PDO::FETCH_ASSOC)) {
        foreach($matricula as $column=>$val) {
            $res[$i][$column] = $val;
        }
        $i++;
        }   
    print json_encode($res);

?>
