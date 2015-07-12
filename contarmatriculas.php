<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
header('Content-Type: text/html; charset=utf-8');
include('./include/configuracion.php');

 try {
	$bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$bdd = new PDO($dsn, $user, $pass);
	} catch(Exception $e) {
	exit('Unable to connect to database.');
 } 
echo '<html><head>
<style>
#contarMaterias {
	margin:0px;padding:0px;
	width:90%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
	
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
	
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
	
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
#contarMaterias table{
    border-collapse: collapse;
    border-spacing: 0;
	width:100%;
	height:15%;
	margin:0px;padding:0px;
}#contarMaterias tr:last-child td:last-child {
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
}
#contarMaterias table tr:first-child td:first-child {
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
#contarMaterias table tr:first-child td:last-child {
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
}#contarMaterias tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}#contarMaterias tr:hover td{
	
}
#contarMaterias tr:nth-child(odd){ background-color:#aad4ff; }
#contarMaterias tr:nth-child(even){ background-color:#ffffff; }
#contarMaterias td{
	vertical-align:middle;
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:7px;
	font-size:10px;
	font-family:Arial;
	font-weight:normal;
	color:#000000;
}#contarMaterias tr:last-child td{
	border-width:0px 1px 0px 0px;
}#contarMaterias tr td:last-child{
	border-width:0px 0px 1px 0px;
}#contarMaterias tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
#contarMaterias tr:first-child td{
		background:-o-linear-gradient(bottom, #005fbf 5%, #003f7f 90%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #003f7f) );
	background:-moz-linear-gradient( center top, #005fbf 5%, #003f7f 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#005fbf", endColorstr="#003f7f");	background: -o-linear-gradient(top,#005fbf,003f7f);

	background-color:#005fbf;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}
#contarMaterias tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #005fbf 5%, #003f7f 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #003f7f) );
	background:-moz-linear-gradient( center top, #005fbf 5%, #003f7f 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#005fbf", endColorstr="#003f7f");	background: -o-linear-gradient(top,#005fbf,003f7f);

	background-color:#005fbf;
}
#contarMaterias tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
#contarMaterias tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
</style>
</head><body>';

 
 
#1ºESO
$sql="SELECT SUM(IF(`E1RLC` = 1, 1, 0)) as E1RLC,SUM(if(`E1RMT` = 1, 1, 0)) as E1RMT,SUM(if(`E1FR` = 1, 1, 0)) as E1FR,SUM(if(`E1TMU` = 1, 1, 0)) as E1TMU,SUM(if(`E1REL` = 1, 1, 0)) as E1REL,SUM(if(`E1VE` = 1, 1, 0)) as E1VE FROM matriculacion;";
$bdd->query($sql);
$mat_1ESO = $bdd->query($sql);
foreach ($mat_1ESO->fetchAll(PDO::FETCH_ASSOC) as $filas);

echo "<div><br>1ºESO</div>";
echo "<div id='contarMaterias'><table><tr>";
echo "<td id='materia'>E1RLC</td>";
echo "<td id='materia'>E1RMT</td>";
echo "<td id='materia'>E1FR</td>";
echo "<td id='materia'>E1TMU</td>";
echo "<td id='materia'>E1REL</td>";
echo "<td id='materia'>E1VE</td>";
echo "</tr><tr>";
echo "<td id='dato'>".$filas['E1RLC']."</td>";
echo "<td id='dato'>".$filas['E1RMT']."</td>";
echo "<td id='dato'>".$filas['E1FR']."</td>";
echo "<td id='dato'>".$filas['E1TMU']."</td>";
echo "<td id='dato'>".$filas['E1REL']."</td>";
echo "<td id='dato'>".$filas['E1VE']."</td>";
echo "</tr></table></div>";

#2ºESO
unset($filas);
$sql="SELECT SUM(IF(`E2RLC` = 1, 1, 0))as E2RLC,SUM(IF(`E2RMT` = 1, 1, 0)) as E2RMT,SUM(IF(`E2FR` = 1, 1, 0)) as E2FR,SUM(IF(`E2IC` = 1, 1, 0)) as E2IC,SUM(IF(`E2REL` = 1, 1, 0)) as E2REL,SUM(IF(`E2HCR` = 1, 1, 0)) as E2HCR,SUM(IF(`E2MAE` = 1, 1, 0)) as E2MAE from matriculacion;";
$mat_2ESO = $bdd->query($sql);
foreach ($mat_2ESO->fetchAll(PDO::FETCH_ASSOC) as $filas);
echo "<div><br>2ºESO</div>";

echo "<div id='contarMaterias'><table><tr>";
echo "<td id='dato'>E2RLC</td>";
echo "<td id='dato'>E2RMT</td>";
echo "<td id='dato'>E2FR</td>";
echo "<td id='dato'>E2IC</td>";
echo "<td id='dato'>E2REL</td>";
echo "<td id='dato'>E2HCR</td>";
echo "<td id='dato'>E2MAE</td>";
echo "</tr><tr>";
echo "<td id='dato'>".$filas['E2RLC']."</td>";
echo "<td id='dato'>".$filas['E2RMT']."</td>";
echo "<td id='dato'>".$filas['E2FR']."</td>";
echo "<td id='dato'>".$filas['E2IC']."</td>";
echo "<td id='dato'>".$filas['E2REL']."</td>";
echo "<td id='dato'>".$filas['E2HCR']."</td>";
echo "<td id='dato'>".$filas['E2MAE']."</td>";
echo "</tr></table></div>";

#3ºESO
unset($filas);
$sql="SELECT SUM(IF(`E3CUC` = 1, 1, 0)) as E3CUC,SUM(IF(`E3AMT` = 1, 1, 0)) as E3AMT,SUM(IF(`E3IAEE` = 1, 1, 0)) as E3IAEE,SUM(IF(`E3FR` = 1, 1, 0)) as E3FR,SUM(IF(`E3MAP` = 1, 1, 0)) as E3MAP,SUM(IF(`E3MAC` = 1, 1, 0)) as E3MAC,SUM(IF(`E3VE` = 1, 1, 0)) as E3VE,SUM(IF(`E3REL` = 1, 1, 0)) as E3REL from matriculacion;";
$mat_3ESO = $bdd->query($sql);
foreach ($mat_3ESO->fetchAll(PDO::FETCH_ASSOC) as $filas);
echo "<div><br>3ºESO</div>";


echo "<div id='contarMaterias'><table><tr>";

echo "<td id='materia'>E3MAP</td>";
echo "<td id='materia'>E3MAC</td>";
echo "<td id='materia'>E3CUC</td>";
echo "<td id='materia'>E3AMT</td>";
echo "<td id='materia'>E3IAEE</td>";
echo "<td id='materia'>E3FR</td>";
echo "<td id='materia'>E3VE</td>";
echo "<td id='materia'>E3REL</td>";
echo "</tr><tr>";
echo "<td id='dato'>".$filas['E3MAP']."</td>";
echo "<td id='dato'>".$filas['E3MAC']."</td>";
echo "<td id='dato'>".$filas['E3CUC']."</td>";
echo "<td id='dato'>".$filas['E3AMT']."</td>";
echo "<td id='dato'>".$filas['E3IAEE']."</td>";
echo "<td id='dato'>".$filas['E3FR']."</td>";
echo "<td id='dato'>".$filas['E3VE']."</td>";
echo "<td id='dato'>".$filas['E3REL']."</td>";
echo "</tr></table></div>";
#4ºESO
unset($filas);
$sql="SELECT SUM(IF(`E4A1` = 1, 1, 0)) as E4A1,SUM(IF(`E4A2` = 1, 1, 0)) as E4A2,SUM(IF(`E4A3` = 1, 1, 0)) as E4A3, SUM(IF(`E4A4` = 1, 1, 0)) as E4A4,SUM(IF(`E4B1` = 1, 1, 0)) as E4B1,SUM(IF(`E4B2` = 1, 1, 0)) as E4B2,SUM(IF(`E4C1` = 1, 1, 0)) as E4C1,SUM(IF(`E4C2` = 1, 1, 0)) as E4C2,SUM(IF(`E4DIV` = 1, 1, 0)) as E4DIV FROM $tabla;";
$mat_4ESO = $bdd->query($sql);
foreach ($mat_4ESO->fetchAll(PDO::FETCH_ASSOC) as $filas);
echo "<div><br>4ºESO --   OPCIONES</div>";
#Modalidades
echo "<div id='contarMaterias'><table><tr>";
echo "<td id='materia'>E4A1</td>";
echo "<td id='materia'>E4MA2</td>";
echo "<td id='materia'>E4A3</td>";
echo "<td id='materia'>E4A4</td>";
echo "<td id='materia'>E4B1</td>";
echo "<td id='materia'>E4B2</td>";
echo "<td id='materia'>E4C1</td>";
echo "<td id='materia'>E4C2</td>";
echo "<td id='materia'>E4DIV</td>";

echo "</tr><tr>";
echo "<td id='dato'>".$filas['E4A1']."</td>";
echo "<td id='dato'>".$filas['E4A2']."</td>";
echo "<td id='dato'>".$filas['E4A3']."</td>";
echo "<td id='dato'>".$filas['E4A4']."</td>";
echo "<td id='dato'>".$filas['E4B1']."</td>";
echo "<td id='dato'>".$filas['E4B2']."</td>";
echo "<td id='dato'>".$filas['E4C1']."</td>";
echo "<td id='dato'>".$filas['E4C2']."</td>";
echo "<td id='dato'>".$filas['E4DIV']."</td>";
echo "</tr></table></div>";

#Asignaturas
unset($filas);
$sql="SELECT SUM(IF(`E4MATB` = 1, 1, 0)) as E4MATB,SUM(IF(`E4TEC` = 1, 1, 0)) as E4TEC,SUM(IF(`E4EPV` = 1, 1, 0)) as E4EPV, SUM(IF(`E4INF` = 1, 1, 0)) as E4INF,SUM(IF(`E4BYG` = 1, 1, 0)) as E4BYG,SUM(IF(`E4FYQ` = 1, 1, 0)) as E4FYQ,SUM(IF(`E4FRA` = 1, 1, 0)) as E4FRA,SUM(IF(`E4LAT` = 1, 1, 0)) as E4LAT,SUM(IF(`E4MUS` = 1, 1, 0)) as E4MUS, SUM(IF(`E4MATA` = 1, 1, 0)) as E4MATA,SUM(IF(`E4REL` = 1, 1, 0)) as E1REL,SUM(IF(`E4HCR` = 1, 1, 0)) as E4HCR,SUM(IF(`E4MAE` = 1, 1, 0)) as E4MAE,SUM(IF(`E4AMT` = 1, 1, 0)) as E4AMT,SUM(IF(`E4AMB` = 1, 1, 0)) as E1E4AMB, SUM(IF(`E4AFQ` = 1, 1, 0)) as E4FQ,SUM(IF(`E4IEE` = 1, 1, 0)) as E4IEE,SUM(IF(`E4LITU` = 1, 1, 0)) as E4LITU,SUM(IF(`E4CUC` = 1, 1, 0)) as E4CUC,SUM(IF(`E4FR` = 1, 1, 0)) as E4FR,SUM(IF(`E4IE` = 1, 1, 0)) as E4IE FROM matriculacion;";
$mat_4ESO = $bdd->query($sql);
foreach ($mat_4ESO->fetchAll(PDO::FETCH_ASSOC) as $filas);
echo "<div><br>4ºESO -- ASIGNATURAS</div>";

echo "<div id='contarMaterias'><table><tr>";
echo "<td id='materia'>E4MATA</td>";
echo "<td id='materia'>E4MATB</td>";
echo "<td id='materia'>E4TEC</td>";
echo "<td id='materia'>E4EPV</td>";
echo "<td id='materia'>E4INF</td>";
echo "<td id='materia'>E4BYG</td>";
echo "<td id='materia'>E4FYQ</td>";
echo "<td id='materia'>E4FRA</td>";
echo "<td id='materia'>E4LAT</td>";
echo "<td id='materia'>E4MUS</td>";
echo "<td id='materia'>E1REL</td>";
echo "<td id='materia'>E4HCR</td>";
echo "<td id='materia'>E4MAE</td>";
echo "<td id='materia'>E4AMT</td>";
echo "<td id='materia'>E1E4AMB</td>";
echo "<td id='materia'>E4FQ</td>";
echo "<td id='materia'>E4IEE</td>";
echo "<td id='materia'>E4LITU</td>";
echo "<td id='materia'>E4CUC</td>";
echo "<td id='materia'>E4FR</td>";
echo "<td id='materia'>E4IE</td>";
echo "</tr><tr>";
echo "<td id='dato'>".$filas['E4MATA']."</td>";
echo "<td id='dato'>".$filas['E4MATB']."</td>";
echo "<td id='dato'>".$filas['E4TEC']."</td>";
echo "<td id='dato'>".$filas['E4EPV']."</td>";
echo "<td id='dato'>".$filas['E4INF']."</td>";
echo "<td id='dato'>".$filas['E4BYG']."</td>";
echo "<td id='dato'>".$filas['E4FYQ']."</td>";
echo "<td id='dato'>".$filas['E4FRA']."</td>";
echo "<td id='dato'>".$filas['E4LAT']."</td>";
echo "<td id='dato'>".$filas['E4MUS']."</td>";
echo "<td id='dato'>".$filas['E1REL']."</td>";
echo "<td id='dato'>".$filas['E4HCR']."</td>";
echo "<td id='dato'>".$filas['E4MAE']."</td>";
echo "<td id='dato'>".$filas['E4AMT']."</td>";
echo "<td id='dato'>".$filas['E1E4AMB']."</td>";
echo "<td id='dato'>".$filas['E4FQ']."</td>";
echo "<td id='dato'>".$filas['E4IEE']."</td>";
echo "<td id='dato'>".$filas['E4LITU']."</td>";
echo "<td id='dato'>".$filas['E4CUC']."</td>";
echo "<td id='dato'>".$filas['E4FR']."</td>";
echo "<td id='dato'>".$filas['E4IE']."</td>";
echo "</tr></table></div>";

#1ºBACH
unset($filas);
$sql="SELECT SUM(IF(`B1LATI` = 1, 1, 0)) as B1LATI,SUM(IF(`B1HMC` = 1, 1, 0)) as B1HMC,SUM(IF(`B1MCSI` = 1, 1, 0)) as B1MCSI,SUM(IF(`B1GRI` = 1, 1, 0)) as B1GRI,SUM(IF(`B1LITU` = 1, 1, 0)) as B1LITU,SUM(IF(`B1ECO` = 1, 1, 0)) as B1ECO,SUM(IF(`B1MATI` = 1, 1, 0)) as B1MATI,SUM(IF(`B1FYQ` = 1, 1, 0)) as B1FYQ,SUM(IF(`B1BYG` = 1, 1, 0)) as B1BYG,SUM(IF(`B1DT` = 1, 1, 0)) as B1DT,SUM(IF(`B1REL` = 1, 1, 0)) as B1REL,SUM(IF(`B1TICI` = 1, 1, 0)) as B1TICI,SUM(IF(`B1FR` = 1, 1, 0)) as B1FR,SUM(IF(`B1CC` = 1, 1, 0)) as B1CC,SUM(IF(`B1TINI` = 1, 1, 0)) as B1TINI,SUM(IF(`B1APL` = 1, 1, 0)) as B1APL,SUM(IF(`B1DAI` = 1, 1, 0)) as B1DAI FROM matriculacion;";
$mat_1BAC = $bdd->query($sql);
foreach ($mat_1BAC->fetchAll(PDO::FETCH_ASSOC) as $filas);
echo "<div><br>1ºBACH</div>";

echo "<div id='contarMaterias'><table><tr>";
echo "<td id='materia'>B1LATI</td>";
echo "<td id='materia'>B1HMC</td>";
echo "<td id='materia'>B1MCSI</td>";
echo "<td id='materia'>B1GRI</td>";
echo "<td id='materia'>B1LITU</td>";
echo "<td id='materia'>B1ECO</td>";
echo "<td id='materia'>B1MATI</td>";
echo "<td id='materia'>B1FYQ</td>";
echo "<td id='materia'>B1BYG</td>";
echo "<td id='materia'>B1DT</td>";
echo "<td id='materia'>B1REL</td>";
echo "<td id='materia'>B1TICI</td>";
echo "<td id='materia'>B1FR</td>";
echo "<td id='materia'>B1CC</td>";
echo "<td id='materia'>B1TINI</td>";
echo "<td id='materia'>B1APL</td>";
echo "<td id='materia'>B1DAI</td>";
echo "</tr><tr>";
echo "<td id='dato'>".$filas['B1LATI']."</td>";
echo "<td id='dato'>".$filas['B1HMC']."</td>";
echo "<td id='dato'>".$filas['B1MCSI']."</td>";
echo "<td id='dato'>".$filas['B1GRI']."</td>";
echo "<td id='dato'>".$filas['B1LITU']."</td>";
echo "<td id='dato'>".$filas['B1ECO']."</td>";
echo "<td id='dato'>".$filas['B1MATI']."</td>";
echo "<td id='dato'>".$filas['B1FYQ']."</td>";
echo "<td id='dato'>".$filas['B1BYG']."</td>";
echo "<td id='dato'>".$filas['B1DT']."</td>";
echo "<td id='dato'>".$filas['B1REL']."</td>";
echo "<td id='dato'>".$filas['B1TICI']."</td>";
echo "<td id='dato'>".$filas['B1FR']."</td>";
echo "<td id='dato'>".$filas['B1CC']."</td>";
echo "<td id='dato'>".$filas['B1TINI']."</td>";
echo "<td id='dato'>".$filas['B1APL']."</td>";
echo "<td id='dato'>".$filas['B1DAI']."</td>";
echo "</tr></table></div>";

#2ºBACH

		$sql="SELECT COUNT( id ) AS OPCION1 FROM matriculacion WHERE B2MATII='1' AND B2FIS='1' AND B2DTII='1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcionC01=$opcion['OPCION1'];
		unset($opcion);
			
		$sql="SELECT COUNT( id ) AS OPCION2 FROM matriculacion WHERE B2MATII='1' AND B2FIS='1' AND B2ELE='1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcionC02=$opcion['OPCION2'];
		unset($opcion);
			
		$sql="SELECT COUNT( id ) AS OPCION3 FROM matriculacion WHERE B2MATII='1' AND B2BIO='1' AND B2CTM='1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcionC03=$opcion['OPCION3'];
		unset($opcion);

		$sql="SELECT COUNT( id ) AS OPCION4 FROM matriculacion WHERE B2MATII='1' AND B2BIO='1' AND B2FIS='1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcionC04=$opcion['OPCION4'];
		unset($opcion);



		$sql="SELECT COUNT( id ) AS OPCION1 FROM matriculacion WHERE B2LATII = '1' AND B2LITU = '1' AND B2GRII = '1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcion01=$opcion['OPCION1'];
		unset($opcion);
		$sql="SELECT COUNT( id ) AS OPCION2 FROM matriculacion WHERE B2HART='1'AND B2LATII='1' AND B2LITU='1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcion02=$opcion['OPCION2'];
		unset($opcion);
		
		$sql="SELECT COUNT( id ) AS OPCION3 FROM matriculacion WHERE B2MCSII='1' AND B2LATII='1' AND B2LITU='1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcion03=$opcion['OPCION3'];
		unset($opcion);		
		$sql="SELECT COUNT( id ) AS OPCION4 FROM matriculacion WHERE B2HART='1' AND B2EEM='1' AND B2LITU='1';";
		$opt_2B = $bdd->query($sql);	
		
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcion04=$opcion['OPCION4'];
		unset($opcion);
			
		$sql="SELECT COUNT( id ) AS OPCION5 FROM matriculacion WHERE B2GRII='1' AND B2EEM='1' AND B2LITU='1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcion05=$opcion['OPCION5'];
		unset($opcion);			
			
		$sql="SELECT COUNT( id ) AS OPCION6 FROM matriculacion WHERE B2GEO='1' AND B2EEM='1' AND B2MCSII='1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcion06=$opcion['OPCION6'];
		unset($opcion);			
		$sql="SELECT COUNT( id ) AS OPCION7 FROM matriculacion WHERE B2GEO='1' AND B2LATII='1' AND B2GRII='1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcion07=$opcion['OPCION7'];
		unset($opcion);				
		$sql="SELECT COUNT( id ) AS OPCION8 FROM matriculacion WHERE B2HART='1'AND B2GEO='1' AND B2EEM='1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcion08=$opcion['OPCION8'];
		unset($opcion);			
		$sql="SELECT COUNT( id ) AS OPCION9 FROM matriculacion WHERE B2GRII='1' AND B2GEO='1' AND B2EEM='1';";		
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcion09=$opcion['OPCION9'];
		unset($opcion);			
		$sql="SELECT COUNT( id ) AS OPCION10 FROM matriculacion WHERE B2HART='1' AND B2LATII='1' AND B2GEO='1';";			
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcion10=$opcion['OPCION10'];
		unset($opcion);			
		$sql="SELECT COUNT( id ) AS OPCION11 FROM matriculacion WHERE B2MCSII='1' AND B2LATII='1' AND B2GEO='1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcion11=$opcion['OPCION11'];
		unset($opcion);			
					
		$sql="SELECT COUNT( id ) AS OPCION12 FROM matriculacion WHERE B2LITU='1' AND B2EEM='1' AND B2MCSII='1';";
		$opt_2B = $bdd->query($sql);	
		foreach ($opt_2B->fetchAll(PDO::FETCH_ASSOC) as $opcion);
		$opcion12=$opcion['OPCION12'];
		unset($opcion);			
		

unset($filas);
$sql="SELECT SUM(IF(`B2HART` = 1, 1, 0)) as B2HART,SUM(IF(`B2GEO` = 1, 1, 0)) as B2GEO,SUM(IF(`B2EEM` = 1, 1, 0)) as B2EEM,SUM(IF(`B2LATII` = 1, 1, 0)) as B2LATII,SUM(IF(`B2GRII` = 1, 1, 0)) as B2GRII,SUM(IF(`B2MCSII` = 1, 1, 0)) as B2MCSII,SUM(IF(`B2LITU` = 1, 1, 0)) as B2LITU,SUM(IF(`B2MATII` = 1, 1, 0)) as B2MATII,SUM(IF(`B2FIS` = 1, 1, 0)) as B2FIS,SUM(IF(`B2DTII` = 1, 1, 0)) as B2DTII,SUM(IF(`B2ELE` = 1, 1, 0)) as B2ELE,SUM(IF(`B2CTM` = 1, 1, 0)) as B2CTM,SUM(IF(`B2BIO` = 1, 1, 0)) as B2BIO,SUM(IF(`B2QUI` = 1, 1, 0)) as B2QUI,SUM(IF(`B2AINGII` = 1, 1, 0)) as B2AINGII,SUM(IF(`B2FRA` = 1, 1, 0)) as B2FRA,SUM(IF(`B2PSI` = 1, 1, 0)) as B2PSI,SUM(IF(`B2GEOL` = 1, 1, 0)) as B2GEOL,SUM(IF(`B2TINII` = 1, 1, 0)) as B2TINII,SUM(IF(`B2FGA` = 1, 1, 0)) as B2FGA FROM matriculacion;";
$mat_2BAC = $bdd->query($sql);



foreach ($mat_2BAC->fetchAll(PDO::FETCH_ASSOC) as $filas);

echo "<div><br>2º BACH CT</div>";

echo "<div id='contarMaterias'><table><tr>";
echo "<td id='materia'>OPCION 1<br>M|F|DT</td>";
echo "<td id='materia'>OPCION 2<br>M|F|EL</td>";
echo "<td id='materia'>OPCION 3<br>M|B|CTM</td>";
echo "<td id='materia'>OPCION 4<br>M|F|B</td>";
echo "</tr><tr>";
echo "<td id='datos'>".$opcionC01."</td>";
echo "<td id='datos'>".$opcionC02."</td>";
echo "<td id='datos'>".$opcionC03."</td>";
echo "<td id='datos'>".$opcionC04."</td>";
echo "</tr></table></div>";

echo "<div><br>2º BACH HCS</div>";

echo "<div id='contarMaterias'><table><tr>";
echo "<td id='materia'>OPCION 1<br>L|G|LI</td>";
echo "<td id='materia'>OPCION 2<br>L|HA|LI</td>";
echo "<td id='materia'>OPCION 3<br>M|L|LI</td>";
echo "<td id='materia'>OPCION 4<br>HA|EC|LI</td>";
echo "<td id='materia'>OPCION 5<br>G|EC|LI</td>";
echo "<td id='materia'>OPCION 6<br>M|GE|EC</td>";
echo "<td id='materia'>OPCION 7<br>GE|L|G</td>";
echo "<td id='materia'>OPCION 8<br>HA|GE|EC</td>";
echo "<td id='materia'>OPCION 9<br>G|GE|EC</td>";
echo "<td id='materia'>OPCION 10<br>L|HA|GE</td>";
echo "<td id='materia'>OPCION 11<br>M|L|GE</td>";
echo "<td id='materia'>OPCION 12<br>M|EC|LI</td>";

echo "</tr><tr>";
echo "<td id='datos'>".$opcion01."</td>";
echo "<td id='datos'>".$opcion02."</td>";
echo "<td id='datos'>".$opcion03."</td>";
echo "<td id='datos'>".$opcion04."</td>";
echo "<td id='datos'>".$opcion05."</td>";
echo "<td id='datos'>".$opcion06."</td>";
echo "<td id='datos'>".$opcion07."</td>";
echo "<td id='datos'>".$opcion08."</td>";
echo "<td id='datos'>".$opcion09."</td>";
echo "<td id='datos'>".$opcion10."</td>";
echo "<td id='datos'>".$opcion11."</td>";
echo "<td id='datos'>".$opcion12."</td>";
echo "</tr></table></div>";


echo "<div><br>2º BACH</div>";
echo "<div id='contarMaterias'><table><tr>";
echo "<td id='materia'>B2HART</td>";
echo "<td id='materia'>B2GEO</td>";
echo "<td id='materia'>B2EEM</td>";
echo "<td id='materia'>B2LATII</td>";
echo "<td id='materia'>B2GRII</td>";
echo "<td id='materia'>B2MCSII</td>";
echo "<td id='materia'>B2LITU</td>";
echo "<td id='materia'>B2MATII]</td>";
echo "<td id='materia'>B2FIS]</td>";
echo "<td id='materia'>B2DTII</td>";
echo "<td id='materia'>B2ELE</td>";
echo "<td id='materia'>B2CTM</td>";
echo "<td id='materia'>B2BIO]</td>";
echo "<td id='materia'>B2QUI</td>";
echo "<td id='materia'>B2AINGII</td>";
echo "<td id='materia'>B2PSI]</td>";
echo "<td id='materia'>B2GEOL</td>";
echo "<td id='materia'>B2TINII</td>";
echo "<td id='materia'>B2FGA</td>";
echo "<td id='materia'>B2FRA</td>";
echo "</tr><tr>";
echo "<td id='datos'>".$filas['B2HART']."</td>";
echo "<td id='datos'>".$filas['B2GEO']."</td>";
echo "<td id='datos'>".$filas['B2EEM']."</td>";
echo "<td id='datos'>".$filas['B2LATII']."</td>";
echo "<td id='datos'>".$filas['B2GRII']."</td>";
echo "<td id='datos'>".$filas['B2MCSII']."</td>";
echo "<td id='datos'>".$filas['B2LITU']."</td>";
echo "<td id='datos'>".$filas['B2MATII']."</td>";
echo "<td id='datos'>".$filas['B2FIS']."</td>";
echo "<td id='datos'>".$filas['B2DTII']."</td>";
echo "<td id='datos'>".$filas['B2ELE']."</td>";
echo "<td id='datos'>".$filas['B2CTM']."</td>";
echo "<td id='datos'>".$filas['B2BIO']."</td>";
echo "<td id='datos'>".$filas['B2QUI']."</td>";
echo "<td id='datos'>".$filas['B2AINGII']."</td>";
echo "<td id='datos'>".$filas['B2PSI']."</td>";
echo "<td id='datos'>".$filas['B2GEOL']."</td>";
echo "<td id='datos'>".$filas['B2TINII']."</td>";
echo "<td id='datos'>".$filas['B2FGA']."</td>";
echo "<td id='datos'>".$filas['B2FRA']."</td>";

echo "</tr></table></div>";

echo "</body></html>";

?>
