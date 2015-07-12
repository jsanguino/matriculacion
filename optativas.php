<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

  $localhost = "localhost";
  $user = "root";
  $pass = "nada";
  $databaseName = "matr_test";
  $host="localhost";
  $tableName = "matriculacion";
  $tabla='matriculacion';

  $dsn = 'mysql:host='.$localhost.';dbname='.$databaseName;
  
$sql="SELECT AAPELLIDOS, ANOMBRE, `B1REL`, `B1TICI`, `B1FR`, `B1CC`, `B1TINI`, `B1APL`, `B1DAI`  FROM `matriculacion` where B1TICI!=''";
#echo $sql;

#`B1TICI`, `B1FR`, `B1CC`, `B1TINI`, `B1APL`, `B1DAI`
$opt1=array('B1TICI','B1TINI','B1APL');
$opt2=array('B1FR','B1CC');

$opt1=array('B1TICI','B1FR','B1APL');
$opt2=array('B1TINI','B1CC');

 try {
	$bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$bdd = new PDO($dsn, $user, $pass);
	} catch(Exception $e) {
	exit('Unable to connect to database.');
 }
 
  $result = $bdd->query($sql);

  // Parse returned data, and displays them
  $total=0;
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
#	  $opt_a=$opt1[0];
#	  $opt_b=$opt1[1];
#	  $opt_c=$opt1[2];
	  
	  if($row[$opt1[0]]==1 ||$row[$opt1[0]]==2){$valor1=pow(2, $row[$opt1[0]]);}else if($row[$opt1[1]]==1 ||$row[$opt1[1]]==2){$valor1=pow(2, $row[$opt1[1]]);}else if($row[$opt1[2]]==1 ||$row[$opt1[2]]==2){$valor1=pow(2, $row[$opt1[2]]);}else{$valor1=50;}
	        
	  if($row[$opt2[0]]==1 ||$row[$opt2[0]]==2){$valor1=pow(2, $row[$opt2[1]]);}else if($row[$opt2[1]]==1 ||$row[$opt2[0]]==2){$valor1=pow(2, $row[$opt2[0]]);}else{$valor2=50;}
	  #$valor=$valor1+$valor2;
	  $valor=$valor1;
	  
	  echo $row['ANOMBRE']. ','. $row['AAPELLIDOS'].':'.$valor.'<br/>';
	  $total=$total+$valor;
	}
	echo "<br><br><br>El TOTAL ES: ".$total;
;
?>
