<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
header('Content-Type: text/html; charset=utf-8');
include('./include/configuracion.php');
#$codigo='819y2q28m24q';
#$codigo=$_GET['codigo'];
$codigo='986gjh7uk955';

if(isset($_GET['id'])){

	 try {
		$bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$bdd = new PDO($dsn, $user, $pass);
		} catch(Exception $e) {
		exit('Unable to connect to database.');
	 }


	function averiguaColumnasDatos($materias,$codigo,$tabla,$dsn, $user, $pass){
		try {
			$bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$bdd = new PDO($dsn, $user, $pass);
		} catch(Exception $e) {
			exit('Unable to connect to database.');
		}
		
		$sql="SELECT $materias FROM $tabla where codigo='$codigo'";
		$matricula=$bdd->query($sql);
		foreach ($matricula->fetchAll(PDO::FETCH_ASSOC) as $filas);
		
		$materias="<pre>".print_r($filas)."</pre>";


		
	}



	$materiasE1="E1FR, E1TMU,E1REL, E1VE";
	$materiasE2="E2FR,E2IC,E2REL,E2HCR,E2MAE";
	$materiasE3="E3MAP, E3MAC, E3AMT, E3CUC, E3FR, E3IAEE, E3REL, E3VE";
	$materiasE4="E4MATB,E4TEC,E4EPV,E4INF,E4BYG,E4FYQ,E4FRA,E4LAT,E4MUS,E4MATA,E4AMT,E4AMB,E4AFQ,E4IEE,E4LITU,E4CUC,E4FR,E4IE,E4REL,E4HCR,E4MAE";
	$materiasB1="B1LATI,B1HMC,B1MCSI,B1GRI,B1LITU,B1ECO,B1MATI,B1FYQ,B1BYG,B1DT,B1REL,B1TICI,B1FR,B1CC,B1TINI,B1APL,B1DAI";
	$materiasB2="B2HART,B2GEO,B2EEM,B2LATII,B2GRII,B2MCSII,B2LITU,B2MATII,B2FIS,B2DTII,B2ELE,B2CTM,B2BIO,B2QUI,B2AINGII,B2PSI,B2GEOL,B2TINII,B2FGA,B2FRA";

	$sql="SELECT ETAPA,CURSO,suspensos FROM $tabla where codigo='$codigo';";
	$curso = $bdd->query($sql);
	foreach ($curso->fetchAll(PDO::FETCH_ASSOC) as $row);


	if ($row['ETAPA']=='13'){
		$variable='E'.$row['CURSO'];
	}else if($row['ETAPA']=='05'){
		//if($row['MODAL_PERF']=='BHCS'){$variable='BHCS'.$row['CURSO'];}else{$variable='BCT'.$row['CURSO'];}
		$variable='B'.$row['CURSO'];		
	}else if($row['ETAPA']=='14'){
		$variable='FPB'.$row['CURSO'];
	}else if($row['ETAPA']=='N'){$variable='N';}

	$suspensos=$row['suspensos'];

	if($variable=='N'){$suspensos='0';}
	if($variable=='B2'){$suspensos='0';$variable='B1';}

	#Es repetidor?
	$repetidor=($suspensos>2) ? $repetidor='S' : $repetidor='N';

	#De qué curso es?
	if($variable=='N'){
		$materias='aapellidos,anombre,'.$materiasE1;
		$sql="SELECT $materias from $tabla where codigo='$codigo'";
		averiguaColumnasDatos($materias,$codigo,$tabla,$dsn, $user, $pass);
	}else if($variable=='E1'){
		($suspensos<3) ? $materias='aapellidos,anombre,'.$materiasE2 : $materias='aapellidos,anombre,'.$materiasE1.','.$materiasE2;
		$sql="SELECT $materias from $tabla where codigo='$codigo'";
		averiguaColumnasDatos($materias,$codigo,$tabla,$dsn, $user, $pass);

	}else if($variable=='E2'){
		($suspensos<3) ? $materias='aapellidos,anombre,'.$materiasE3 : $materias='aapellidos,anombre,'.$materiasE2.','.$materiasE3;
		$sql="SELECT $materias from $tabla where codigo='$codigo'";
		averiguaColumnasDatos($materias,$codigo,$tabla,$dsn, $user, $pass);

	}else if($variable=='E3'){
		($suspensos<3) ? $materias='aapellidos,anombre,'.$materiasE4 : $materias='aapellidos,anombre,'.$materiasE3.','.$materiasE4;
		$sql="SELECT $materias from $tabla where codigo='$codigo'";
		averiguaColumnasDatos($materias,$codigo,$tabla,$dsn, $user, $pass);

	}else if($variable=='E4'){
		($suspensos<3) ? $materias='aapellidos,anombre,'.$materiasE4 : $materias='aapellidos,anombre,'.$materiasE4.','.$materiasB1;
		$sql="SELECT $materias from $tabla where codigo='$codigo'";
		averiguaColumnasDatos($materias,$codigo,$tabla,$dsn, $user, $pass);
		
	}else if($variable=='B1'){
		($suspensos<3) ? $materias='aapellidos,anombre,'.$materiasB2 : $materias='aapellidos,anombre,'.$materiasB1.','.$materiasB2;
		$sql="SELECT $materias from $tabla where codigo='$codigo'";
		averiguaColumnasDatos($materias,$codigo,$tabla,$dsn, $user, $pass);
	}
}else{

echo '
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
  <title>Matrícula IES EUROPA :: CURSO 2015-2016</title>
  <link rel="stylesheet" href="./css/example.css">
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script>
	$.getJSON( "autocompletar.php", function( data ) {
		var items = [];
		$.each( data, function( key, val ) {
		items.push( "<li id='" + key + "'>" + val + "</li>" );
		});
 
	$( "<ul/>", {
		"class": "my-new-list",
		html: items.join( "" )
		}).appendTo( "body" );
	});
	</script>
</head>
<body>
<div id="recomendacion"></div>
<body>
<form method="post" id="FanDetail">
  <div class="ui-widget">
     <label for="zip">Zip: </label>
     <input id="id" name="id" value="Nombre" onFocus="clearText(this)" /><br />
  </div>
</form>
</body>
</html>';
}
?>
