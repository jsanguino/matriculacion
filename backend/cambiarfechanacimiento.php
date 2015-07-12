<?php 

  //--------------------------------------------------------------------------
  // Datos de conexión
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "root";
  $pass = "nada";
  $databaseName = "matriculacion";
  $host="localhost";
  $tableName = "test";

  $dsn = 'mysql:host='.$localhost.';dbname='.$databaseName;



	function fechaXno($date) {
		list($dia, $mes, $anno) = explode("/", $date);
		return $anno.'/'.$mes.'/'.$dia; 
	}
	
	function xnoMysql($date) {
		list($anno, $mes, $dia) = explode("/", $date);
		return $dia.'-'.$mes.'-'.$anno; 
	}

// List of events
 $columna="AFCNACIMIE";
 $tabla="test";

 // connection to the database
 try {
	$bdd = new PDO($dsn, $user, $pass);
	} catch(Exception $e) {
	exit('Unable to connect to database.');
 }




 $sentencia = $bdd->prepare("UPDATE test SET FNACIMIENTO = :fnacimiento WHERE  AFCNACIMIE= :AFCNACIMIE");

 $query = "SELECT $columna FROM test";
 
 $results = $bdd->query($query) or die(print_r($bdd->errorInfo()));
 foreach($results as $row) {
		$fecha=fechaXno($row['AFCNACIMIE']);
		$sentencia->bindParam(':fnacimiento', $fecha);
		$sentencia->bindParam(':AFCNACIMIE', $row['AFCNACIMIE']);
		$sentencia->execute();
 
//echo $row['AFCNACIMIE']."-->".fechaXno($row['AFCNACIMIE'])."<br/>";
}
?>
