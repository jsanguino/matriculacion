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
 $columna="NMEXPEDIEN,CONCAT_WS(' ',AAPELLIDO1,AAPELLIDO2) as APELLIDOS";
 $tabla="test";

 // connection to the database
 try {
	$bdd = new PDO($dsn, $user, $pass);
	} catch(Exception $e) {
	exit('Unable to connect to database.');
 }


 $sentencia = $bdd->prepare("UPDATE test SET AAPELLIDOS = :AAPELLIDOS WHERE  NMEXPEDIEN= :NMEXPEDIEN");
 $query = "SELECT $columna FROM test";
 
 $results = $bdd->query($query) or die(print_r($bdd->errorInfo()));
 foreach($results as $row) {
		$sentencia->bindParam(':AAPELLIDOS', $row['APELLIDOS']);
		$sentencia->bindParam(':NMEXPEDIEN', $row['NMEXPEDIEN']);
		$sentencia->execute();
 
//echo $row['NMEXPEDIEN']."-->".fechaXno($row['NMEXPEDIEN'])."<br/>";
}
 
?>
