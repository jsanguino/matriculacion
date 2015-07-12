<?php
 
//conexiones, conexiones everywhere
include('../include/configuracion.php');

 try {
	$bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	} catch(Exception $e) {
	exit('Unable to connect to database.');
 }
header('Content-Type: text/html; charset=utf-8');
$fname='/tmp/nuevos.csv';

if (($gestor = fopen("/tmp/nuevos.csv", "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos);
        $apellidos=strtoupper($datos[0]);
        $nombre=strtoupper($datos[1]);
		$centro=strtoupper($datos[4]);
		$curso=strtoupper($datos[3]);
		$etapa=strtoupper($datos[2]);
        
        $sql = "INSERT into matriculacion(AAPELLIDOS, ANOMBRE,Centro_origen,CURSO,ETAPA) values('".$apellidos."','".$nombre."','".$centro."','".$curso."','".$etapa."');";
		echo $sql."<br/>";
        //mysql_query($sql) or die(mysql_error());
		$bdd->query($sql);
        $fila++;

    }
    fclose($gestor);
}

        

     
?>
