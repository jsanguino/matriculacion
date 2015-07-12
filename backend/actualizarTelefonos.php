<?php 

  //--------------------------------------------------------------------------
  // Datos de conexión
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "root";
  $pass = "nada";
  $databaseName = "matriculacion";
  $host="localhost";
  $tabla = "matriculacion";

  $dsn = 'mysql:host='.$localhost.';dbname='.$databaseName;


 // connection to the database
 try {
	$bdd = new PDO($dsn, $user, $pass);
	} catch(Exception $e) {
	exit('Unable to connect to database.');
 }


 $sentencia = $bdd->prepare("UPDATE $tabla SET PTELEFONO_M = :TELEFONOF WHERE  codigo= :codigo");
 $query = "SELECT codigo,TELEFONO1,TELEFONO2 FROM $tabla";
 
 $results = $bdd->query($query) or die(print_r($bdd->errorInfo()));
 foreach($results as $row) {
		$sentencia->bindParam(':TELEFONOF', $row['TELEFONO2']);
		$sentencia->bindParam(':codigo', $row['codigo']);
		$sentencia->execute();
 
//echo $row['NMEXPEDIEN']."-->".fechaXno($row['NMEXPEDIEN'])."<br/>";
}
 
?>
