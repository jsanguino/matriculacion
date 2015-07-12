<?php 

  //--------------------------------------------------------------------------
  // Datos de conexión
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "root";
  $pass = "nada";
  $databaseName = "matriculacion";
  $host="localhost";
  $tableName = "matriculacion";

  $dsn = 'mysql:host='.$localhost.';dbname='.$databaseName;



 	function pin($numCaracteres = 11){
	$valores = array(1,2,3,4,5,6,7,8,9,"a","b","c","d","e","f","g","h","i","j","k","m","n","o","p","q","r","s","t","u","v","w","y","z",1,2,3,4,5,6,7,8,9,);
	$valoresNum = count($valores) - 1; // -1 porque se empieza a contar por el 0.
	
	for ($i=0;$i<=$numCaracteres;$i++){
	    $aleatorio = rand(0,$valoresNum);
	    $resultado .= $valores[$aleatorio];
	}
	
	return $resultado;  
	}


// List of events
 $json = array();
 $columna="NMEXPEDIEN";
 $tabla="matriculacion";

 // connection to the database
 try {
	$bdd = new PDO($dsn, $user, $pass);
	} catch(Exception $e) {
	exit('Unable to connect to database.');
 }



 $id=1387;
 $sentencia = $bdd->prepare("UPDATE matriculacion SET codigo = :codigo WHERE  NMEXPEDIEN= :NMEXPEDIEN and id = :id and codigo is NULL");
 
 $query = "SELECT $columna,id FROM matriculacion";
 $results = $bdd->query($query) or die(print_r($bdd->errorInfo()));
 foreach($results as $row) {
	 $i=0;
	 //$query = "SELECT codigo FROM $tabla where codigo=".$pin;
	while($i==0){
		$pin=pin();
		$query = "SELECT codigo FROM $tabla where $columna='".$pin."'";
		$codigo = $bdd->query($query) or die(print_r($bdd->errorInfo()));
		//echo $row['NMEXPEDIEN']."<br>";
		if ($codigo->rowCount()>0){
			echo "++ ";
		}else{
			//echo $codigo->rowCount().' No está ';
			$sentencia->bindParam(':codigo', $pin);
			$sentencia->bindParam(':NMEXPEDIEN', $row['NMEXPEDIEN']);
			$sentencia->bindParam(':id', $row['id']);
			$sentencia->execute();
			$i=1;
//			echo $pin."<br/> N0 REPE ".$row['id']."<br>";
			
		}
		echo $pin."<br/>";
	 }
	$id++;
}
?>


