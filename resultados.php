<?php
#error_reporting(E_ALL);
#ini_set("display_errors", 1);
include('./include/configuracion.php');
include('./class/funciones.php');
 try {
	$bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	} catch(Exception $e) {
	exit('Unable to connect to database.');
 }
     
#header('Content-Type: text/html; charset=utf-8');
if ($_GET) {
#   echo '<pre>';
#   echo htmlspecialchars(print_r($_GET, true));
#   echo '</pre>';
}

$curso=$_GET['curso'];
$codigo=$_GET['codigo'];


if($curso=='N'){
	$plazoMatricula='25 y 26 de junio';
}else if($curso=='E1'){
	$plazoMatricula='29 y 30 de junio';
}else if($curso=='E2'){
	$plazoMatricula='1 y 2 de julio';
}else if($curso=='E3'){
	$plazoMatricula='3 y 6 de julio';
}else if($curso=='E4'){
	$plazoMatricula='7 y 8 de julio';
}else if($curso=='B1'){
	$plazoMatricula='9 y 10 de julio';
}

/*
*/ 
#####
	##
#$codigo='819y2q28m24q';
	##
#####













if($_GET['modalidad']){$modalidad=$_GET['modalidad'];}
if($_GET['opcion']){$opcion=$_GET['opcion'];}


$reiniciarB1="UPDATE $tabla SET B1LATI='',B1HMC='',B1MCSI='',B1GRI='',B1LITU='',B1ECO='',B1MATI='',B1FYQ='',B1BYG='',B1DT='',B1REL='',B1TICI='',B1FR='',B1CC='', B1TINI='', B1APL='', B1DAI='' WHERE codigo='$codigo';";	
$reiniciarB2="UPDATE $tabla SET B2AINGII='',B2DTII='',B2FGA='', B2GEO='', B2HART='',B2MATII='',B2QUI='',B2BIO='', B2EEM='', B2FIS='', B2GEOL='',B2LATII='',B2MCSII='',B2TINII='',B2CTM='', B2ELE='', B2FRA='', B2GRII='',B2LITU='',B2PSI='' WHERE codigo='$codigo';";
$reiniciarE4="UPDATE $tabla SET E4A1='',E4A2='',E4A3='',E4A4='',E4B1='',E4B2='',E4C1='',E4C2='',E4DIV='',E4AFQ='', E4AMT='',E4CUC='',E4FR='',E4FYQ='',E4IE='',E4INF='',E4LITU='',E4MATA='',E4MUS='',E4TEC='',E4AMB='',E4BYG='', E4EPV='',E4FRA='',E4HCR='',E4IEE='',E4LAT='',E4MAE='',E4MATB='',E4REL='' where codigo='$codigo';";	
$reiniciarE3="UPDATE $tabla SET E3REL='',E3VE='',E3MAC='',E3MAP='',E3FR='',E3IAEE='',E3AMT='',E3CUC='' WHERE codigo='$codigo'";
$reiniciarE2="UPDATE $tabla SET E2FR='',E2IC='',E2RMT='',E2RLC='',E2REL='',E2HCR='',E2MAE=''  WHERE codigo='$codigo';";
$reiniciarE1="UPDATE $tabla SET E1FR='',E1TMU='',E1REL='',E1VE='',E1RMT='',E1RLC='' WHERE codigo='$codigo';";

$reiniciarAutorizaciones="UPDATE $tabla SET AUT_PARACETAMOL='',AUT_TRASLADO='',AUT_FOTOS='' where codigo='$codigo'";
$autorizaciones="UPDATE $tabla SET AUT_TRASLADO='$_GET[auth_sanitaria]',AUT_PARACETAMOL='$_GET[auth_paracetamol]',AUT_FOTOS='$_GET[auth_fotos]' WHERE codigo='$codigo'";

$optativas=explode('#',$_GET['orden_optativas']);

if($_GET['orden_optativas_ca']){
	$optativas_ca=explode('#',$_GET['orden_optativas_ca']);
}

	if($curso=='N'){

		//$sql="UPDATE matriculacion SET E1FR='',E1TMU='',E1REL='',E1VE='',E1RMT='',E1RLC='' WHERE codigo='$codigo';";
		$sql=$reiniciarE1;
	#	echo "<br/>REINICIAR EL CURSO<br/>";
		$bdd->query($sql);
	#	echo $sql;
			
		$E1FR=array_search('Francés', $optativas);	
		$E1TMU=array_search('Taller de Música', $optativas);

	#	echo "<br/>OPTATIVAS DEL CURSO ANTERIOR<br/>";
		
		$sql="UPDATE matriculacion SET E1FR='$E1FR',E1TMU='$E1TMU' WHERE codigo='$codigo';";	
		$bdd->query($sql);
			
		#RELIGIÓN
		if($_GET['religion']=='0'){		//RELIGIÓN
				$sql="UPDATE matriculacion SET E1REL='1',E1VE='0' WHERE codigo='$codigo';";
			}else if($_GET['religion']=='1'){	//VE
				$sql="UPDATE matriculacion SET E1REL='',E1VE='1'  WHERE codigo='$codigo';";
			}
	#	echo "<br/>RELIGION<br/>";
		$bdd->query($sql);
	#	echo $sql;

	}else if($curso=='E1'){
		#OPTATIVAS 2º
		$sql="UPDATE matriculacion SET E2FR='',E2IC='',E2RMT='',E2RLC='',E2REL='',E2HCR='',E2MAE=''  WHERE codigo='$codigo';";
	#	echo "<br/>REINICIAR EL CURSO ANTERIOR<br/>";
		$bdd->query($sql);
	#	echo $sql;

		$E2IC=array_search('Imagen y Comunicación', $optativas);
		$E2FR=array_search('Francés', $optativas);
		$sql="UPDATE $tabla SET E2FR='$E2FR',E2IC='$E2IC' WHERE codigo='$codigo';";
	#	echo "<br/>OPTATIVAS CURSO<br/>";
		$bdd->query($sql);
	#	echo $sql;
		
		
		if($_GET['religion']=='0'){				//Religion
				$sql="UPDATE matriculacion SET E2REL='1',E2HCR='',E2MAE=''  WHERE codigo='$codigo';";
			}else if($_GET['religion']=='1'){	//HCR
				$sql="UPDATE matriculacion SET E2REL='',E2HCR='1',E2MAE=''  WHERE codigo='$codigo';";
			}else if($_GET['religion']=='2'){	//MAE
				$sql="UPDATE matriculacion SET E2REL='',E2HCR='',E2MAE='1'  WHERE codigo='$codigo';";
		}
	#	echo "<br/>RELIGION<br/>";
		$bdd->query($sql);
	#	echo $sql;
		#########
		#CURSO ANTERIOR
		
		$sql="UPDATE matriculacion SET E1FR='',E1TMU='',E1REL='',E1VE='',E1RMT='',E1RLC='' WHERE codigo='$codigo';";
	#	echo "<br/>REINICIAR EL CURSO<br/><br/>";
		$bdd->query($sql);
	#	echo $sql;
			
		$E1FR=array_search('Francés', $optativas_ca);	
		$E1TMU=array_search('Taller de Música', $optativas_ca);

	#	echo "<br/>OPTATIVAS DEL CURSO ANTERIOR<br/><br/>";
		$sql="UPDATE matriculacion SET E1FR='$E1FR',E1TMU='$E1TMU' WHERE codigo='$codigo';";
		$bdd->query($sql);
	#	echo $sql;	

		#RELIGIÓN
		if($_GET['religion_ca']=='0'){		//RELIGIÓN
				$sql="UPDATE matriculacion SET E1REL='1',E1VE='0' WHERE codigo='$codigo';";
			}else if($_GET['religion_ca']=='1'){	//VE
				$sql="UPDATE matriculacion SET E1REL='',E1VE='1'  WHERE codigo='$codigo';";
			}
	#	echo "<br/>RELIGION del CURSO ANTERIOR<br/><br/>";
		$bdd->query($sql);
	#	echo $sql;

	
	}else if($curso=='E2'){

		#REINICIAMOS EL CURSO POR COMPLETO
	#	echo "<br/>REINICIAMOS<br/><br/>";
		$sql="UPDATE matriculacion SET E3REL='',E3VE='',E3MAC='',E3MAP='',E3FR='',E3IAEE='',E3AMT='',E3CUC='' WHERE codigo='$codigo'";
		$bdd->query($sql);
	#	echo $sql;

		#OPCIÓN
		if($_GET['modalidad']=='MAP'){			//Matemáticas Aplicadas
				$sql="UPDATE matriculacion SET E3MAC='',E3MAP='1' WHERE codigo='$codigo';";
			}else if($_GET['modalidad']=='MAC'){	//Matemáticas Académicas
				$sql="UPDATE matriculacion SET E3MAC='1',E3MAP=''  WHERE codigo='$codigo';";
			}
	#	echo "<br/>OPCION DE MATES 3º<br/>";
		$bdd->query($sql);
	#	echo $sql;

		#OPTATIVAS 3º

		$E3FR=array_search('Francés', $optativas);
		$E3IAEE=array_search('Inic.Emprendedora y Empr.', $optativas);
		$E3AMT=array_search('Ampliación de Matem.', $optativas);
		$E3CUC=array_search('Cultura Clásica', $optativas);
		$sql="UPDATE matriculacion SET E3FR='$E3FR',E3IAEE='$E3IAEE',E3AMT='$E3AMT',E3CUC='$E3CUC' WHERE codigo='$codigo';";
		
	#	echo "<br/>OPTATIVAS DE 3º<br/>";
		$bdd->query($sql);
	#	echo $sql;
		
		#RELIGIÓN
		if($_GET['religion']=='1'){		//RELIGIÓN
				$sql="UPDATE matriculacion SET E3REL='1',E3VE='0' WHERE codigo='$codigo';";
			}else{	//VE
				$sql="UPDATE matriculacion SET E3REL='',E3VE='1'  WHERE codigo='$codigo';";
			}
	#	echo "<br/>RELIGION 3º<br/>";
		$bdd->query($sql);
	#	echo $sql;
	
	
		#REINICIAR EL CURSO ANTERIOR
		
		//$sql="UPDATE matriculacion SET E2FR='',E2IC='',E2RMT='',E2RLC='',E2REL='',E2HCR='',E2MAE='' WHERE codigo='$codigo';";
		$sql=$reiniciarE2;
	#	echo "<br/>REINICIAR EL CURSO ANTERIOR<br/>";
		$bdd->query($sql);
	#	echo $sql;
		
		#OPTATIVAS CURSO ANTERIOR

		$E2IC=array_search('Imagen y Comunicación', $optativas_ca);
		$E2FR=array_search('Francés', $optativas_ca);
		$sql="UPDATE matriculacion SET E2FR='$E2FR',E2IC='$E2IC' WHERE codigo='$codigo';";
	#	echo "<br/>OPTATIVAS CURSO ANTERIOR<br/>";
		$bdd->query($sql);
	#	echo $sql;
		
		if($_GET['religion_ca']=='1'){				//Religion
				$sql="UPDATE matriculacion SET E2REL='1',E2HCR='',E2MAE=''  WHERE codigo='$codigo';";
			}else if($_GET['religion_ca']=='1'){	//HCR
				$sql="UPDATE matriculacion SET E2REL='',E2HCR='1',E2MAE=''  WHERE codigo='$codigo';";
			}else if($_GET['religion_ca']=='2'){	//MAE
				$sql="UPDATE matriculacion SET E2REL='',E2HCR='',E2MAE='1'  WHERE codigo='$codigo';";
		}
	#	echo "<br/>RELIGION CURSO ANTERIOR<br/>";
		$bdd->query($sql);
	#	echo $sql;


	}else if($curso=='E3'){
 
		#REINICIAMOS EL CURSO POR COMPLETO
	#	echo "<br/>REINICIAMOS EL CURSO<br/>";
		$sql=$reiniciarE4;
		//$sql="UPDATE matriculacion SET E4AFQ='', E4AMT='',E4CUC='',E4FR='',E4FYQ='',E4IE='',E4INF='',E4LITU='',E4MATA='',E4MUS='',E4TEC='',E4AMB='',E4BYG='', E4EPV='',E4FRA='',E4HCR='',E4IEE='',E4LAT='',E4MAE='',E4MATB='',E4REL='' where codigo='$codigo';";	
		$bdd->query($sql);
	#	echo $sql;
		#MATERIAS DE OPCIÓN 4º
		
		if ($_GET['modalidad']=='A1'){
			$sql="UPDATE matriculacion SET E4A1='1',E4MATB='1',E4BYG='1',E4FYQ='1',E4FRA='1' WHERE codigo='$codigo';";			
		}else if ($_GET['modalidad']=='A2'){
			$sql="UPDATE matriculacion SET E4A2='1',E4MATB='1',E4BYG='1',E4FYQ='1',E4INF='1' WHERE codigo='$codigo';";			
		}else if ($_GET['modalidad']=='A3'){
			$sql="UPDATE matriculacion SET E4A3='1',E4MATB='1',E4BYG='1',E4FYQ='1',E4TEC='1' WHERE codigo='$codigo';";			
		}else if ($_GET['modalidad']=='A4'){
			$sql="UPDATE matriculacion SET E4A4='1',E4MATB='1',E4FYQ='1',E4INF='1',E4TEC='1' WHERE codigo='$codigo';";			
		}else if ($_GET['modalidad']=='B1'){
			if($_GET['MAT4']=='MATA'){
			$sql="UPDATE matriculacion SET E4B1='1',E4MATA='1',E4LAT='1',E4FRA='1',E4INF='1' WHERE codigo='$codigo';";
			}else if($_GET['MAT4']=='MATB'){
			$sql="UPDATE matriculacion SET E4B1='1',E4MATB='1',E4LAT='1',E4FRA='1',E4INF='1' WHERE codigo='$codigo';";
			}			
		}else if ($_GET['modalidad']=='B2'){

			if($_GET['MAT4']=='MATA'){
				$sql="UPDATE matriculacion SET E4B2='1',E4MATA='1',E4LAT='1',E4MUS='1',E4INF='1' WHERE codigo='$codigo';";
			}else if($_GET['MAT4']=='MATB'){
				$sql="UPDATE matriculacion SET E4B2='1',E4MATB='1',E4LAT='1',E4MUS='1',E4INF='1' WHERE codigo='$codigo';";
			}						
		}else if ($_GET['modalidad']=='C1'){
			$sql="UPDATE matriculacion SET E4C1='1',E4MATA='1',E4TEC='1',E4EPV='1',E4MUS='1' WHERE codigo='$codigo';";			
		}else if ($_GET['modalidad']=='C2'){
			$sql="UPDATE matriculacion SET E4C2='1',E4MATA='1',E4TEC='1',E4EPV='1',E4INF='1' WHERE codigo='$codigo';";			
		}
	#	echo "<br/>Materias de OPCIÓN<br/>";
		$bdd->query($sql);
	#	echo $sql;
		
	#OPTATIVAS 4º
		$E4IEE=array_search('Iniciación a la Elect. y Electrónica', $optativas);
		$E4LITU=array_search('Literatura Universal', $optativas);
		$E4CUC=array_search('Cultura Clásica', $optativas);
		$E4FR=array_search('Francés', $optativas);
		$E4IE=array_search('Iniciativa Emprendedora', $optativas);
		$E4AMT=array_search('Ampl.Matemáticas', $optativas);
		$E4AMB=array_search('Ampl.Biología y Geología', $optativas);
		$E4AFQ=array_search('Ampl.Física y Quím.', $optativas);
		
	#	echo "<br/>Las optativas<br/>";
		$sql="UPDATE matriculacion SET E4IEE='$E4IEE',E4LITU='$E4LITU',E4CUC='$E4CUC',E4FR='$E4FR',E4IE='$E4IE',E4AMT='$E4AMT',E4AMB='$E4AMB',E4AFQ='$E4AFQ' WHERE codigo='$codigo';";
		$bdd->query($sql);
	#	echo $sql;
		
	#RELIGION
		if($_GET['religion']=='0'){		//REligion
				$sql="UPDATE matriculacion SET E4REL='1',E4HCR='',E4MAE=''  WHERE codigo='$codigo';";
			}else if($_GET['religion']=='1'){	//HCR
				$sql="UPDATE matriculacion SET E4REL='',E4HCR='1',E4MAE=''  WHERE codigo='$codigo';";
			}else if($_GET['religion']=='2'){	//MAE
				$sql="UPDATE matriculacion SET E4REL='',E4HCR='',E4MAE='1'  WHERE codigo='$codigo';";
			}
	#	echo "<br/>La RELIGION de 4º  <br/>";
		$bdd->query($sql);
	#	echo $sql;

		#Reiniciamos los datos para el CURSO ANTERIOR:
	#	echo "<br/>REINICIAMOS EL CURSO ANTERIOR<br/>";
		$sql="UPDATE matriculacion SET E3REL='',E3VE='',E3MAC='',E3MAP='',E3FR='',E3IAEE='',E3AMT='',E3CUC='' WHERE codigo='$codigo';";
		$bdd->query($sql);
	#	echo $sql;
		
		#OPCIÓN
		if($_GET['modalidad_ca']=='MAP'){			//Matemáticas Aplicadas
				$sql="UPDATE matriculacion SET E3MAC='',E3MAP='1' WHERE codigo='$codigo';";
			}else if($_GET['modalidad_ca']=='MAC'){	//Matemáticas Académicas
				$sql="UPDATE matriculacion SET E3MAC='1',E3MAP=''  WHERE codigo='$codigo';";
			}
	#	echo "<br/>OPCION DE MATES 3º<br/>";
		$bdd->query($sql);
	#	echo $sql;

		$E3FR=array_search('Francés', $optativas_ca);
		$E3IAEE=array_search('Inic.Emprendedora y Empr.', $optativas_ca);
		$E3AMT=array_search('Ampliación de Matem.', $optativas_ca);
		$E3CUC=array_search('Cultura Clásica', $optativas_ca);
		$sql="UPDATE matriculacion SET E3FR='$E3FR',E3IAEE='$E3IAEE',E3AMT='$E3AMT',E3CUC='$E3CUC' WHERE codigo='$codigo';";
		
	#	echo "<br/>OPTATIVAS DE 3º<br/>";
		$bdd->query($sql);
	#	echo $sql;

		if($_GET['religion_ca']=='0'){		//REligion
				$sql="UPDATE matriculacion SET E3REL='1',E3VE='' WHERE codigo='$codigo';";
			}else if($_GET['religion_ca']=='1'){	//VE
				$sql="UPDATE matriculacion SET E3REL='',E3VE='1'  WHERE codigo='$codigo';";
			}
	#	echo "<br/>RELIGION 3º<br/>";
		$bdd->query($sql);
	#	echo $sql;

	}else if($curso=='E4'){
		#REINICIAMOS EL CURSO POR COMPLETO
	#	echo "<br/>REINICIAMOS EL CURSO<br/>";
		$sql=$reiniciarB1;
		$bdd->query($sql);
	#	echo $sql;
		
		#$modalidad=$_GET['modalidad'];
		#$opcion=$_GET['opcion'];
		if($modalidad=='C'){ //Ciencias
			if($opcion=='1'){  //DT
				$sql="UPDATE matriculacion SET B1MATI='1',B1FYQ='1',B1DT='1' WHERE codigo='$codigo';";
			}else{ 				// BIO
				$sql="UPDATE matriculacion SET B1MATI='1',B1FYQ='1',B1BYG='1' WHERE codigo='$codigo';";
			}
		}else if($modalidad=='H'){ //Humanidades
			if($opcion=='0'){		//Eco
				$sql="UPDATE matriculacion SET B1LATI='1',B1HMC='1',B1ECO='1'  WHERE codigo='$codigo';";
			}else if($opcion=='1'){	//GRIEGO
				$sql="UPDATE matriculacion SET B1LATI='1',B1HMC='1',B1GRI='1' WHERE codigo='$codigo';";
			}else if($opcion=='2'){	//LITU
				$sql="UPDATE matriculacion SET B1LATI='1',B1HMC='1',B1LITU='1' WHERE codigo='$codigo';";
			}	
		}else if($modalidad=='S'){ 	//Ciencias Sociales
			if($opcion=='0'){		//ECO
				$sql="UPDATE matriculacion SET B1MCSI='1',B1HMC='1',B1ECO='1'  WHERE codigo='$codigo';";
			}else if($opcion=='1'){ //GRIEGO
				$sql="UPDATE matriculacion SET B1MCSI='1',B1HMC='1',B1GRI='1' WHERE codigo='$codigo';";
			}else if($opcion=='2'){	//LITU
				$sql="UPDATE matriculacion SET B1MCSI='1',B1HMC='1',B1LITU='1' WHERE codigo='$codigo';";
			}	
		}
	#	echo $sql; // Materias de Opción
		$bdd->query($sql);
	
		
		$B1TICI=array_search('Tec. Inform. Comunicación I', $optativas);
		$B1REL=array_search('Religión', $optativas);
		$B1CC=array_search('Cultura Científica', $optativas);
		$B1FR=array_search('Francés I', $optativas);
		$B1APL=array_search('Anatomía Aplicada', $optativas);
		$B1DAI=array_search('Dibujo Artístico I', $optativas);
		
		
		if($modalidad=='C'){ //Ciencias
			$B1TINI=array_search('Tecn. Industrial I', $optativas);
			$sql="UPDATE matriculacion SET B1TINI='$B1TINI', B1FR='$B1FR',B1CC='$B1CC',B1TICI='$B1TICI',B1REL='$B1REL',B1APL='$B1APL',B1DAI='$B1DAI' WHERE codigo='$codigo';";
		}else{
			$sql="UPDATE matriculacion SET B1FR='$B1FR',B1CC='$B1CC',B1TICI='$B1TICI',B1REL='$B1REL',B1APL='$B1APL',B1DAI='$B1DAI' WHERE codigo='$codigo';";		
		}
	#	echo $sql;
		$bdd->query($sql);// LAS OPTATIVAS
		
		#REINICIAMOS EL CURSO ANTERIOR
	#	echo "<br/>REINICIAMOS EL CURSO ANTERIOR<br/>";
		
		//$sql="UPDATE matriculacion SET E4A1='',E4A2='',E4A3='',E4A4='',E4B1='',E4B2='',E4BC1='',E4C2='',E4AFQ='', E4AMT='',E4CUC='',E4FR='',E4FYQ='',E4IE='',E4INF='',E4LITU='',E4MATA='',E4MUS='',E4TEC='',E4AMB='',E4BYG='', E4EPV='',E4FRA='',E4HCR='',E4IEE='',E4LAT='',E4MAE='',E4MATB='',E4REL='' where codigo='$codigo';";	
		$sql=$reiniciarE4;
		$bdd->query($sql);
	#	echo $sql;
		#MATERIAS DE OPCIÓN 4º
		
		if ($_GET['modalidad_ca']=='A1'){
			$sql="UPDATE matriculacion SET E4A1='1',E4MATB='1',E4BYG='1',E4FYQ='1',E4FRA='1' WHERE codigo='$codigo';";			
		}else if ($_GET['modalidad_ca']=='A2'){
			$sql="UPDATE matriculacion SET E4A2='1',E4MATB='1',E4BYG='1',E4FYQ='1',E4INF='1' WHERE codigo='$codigo';";			
		}else if ($_GET['modalidad_ca']=='A3'){
			$sql="UPDATE matriculacion SET E4A3='1',E4MATB='1',E4BYG='1',E4FYQ='1',E4TEC='1' WHERE codigo='$codigo';";			
		}else if ($_GET['modalidad_ca']=='A4'){
			$sql="UPDATE matriculacion SET E4A4='1',E4MATB='1',E4FYQ='1',E4INF='1',E4TEC='1' WHERE codigo='$codigo';";			
		}else if ($_GET['modalidad_ca']=='B1'){
			if($_GET['MAT4']=='MATA'){
			$sql="UPDATE matriculacion SET E4B1='1',E4MATA='1',E4LAT='1',E4FRA='1',E4INF='1' WHERE codigo='$codigo';";
			}else if($_GET['MAT4']=='MATB'){
			$sql="UPDATE matriculacion SET E4B1='1',E4MATB='1',E4LAT='1',E4FRA='1',E4INF='1' WHERE codigo='$codigo';";
			}			
		}else if ($_GET['modalidad_ca']=='B2'){
			if($_GET['MAT4']=='MATA'){
				$sql="UPDATE matriculacion SET E4B2='1',E4MATA='1',E4LAT='1',E4MUS='1',E4INF='1' WHERE codigo='$codigo';";
			}else if($_GET['MAT4']=='MATB'){
				$sql="UPDATE matriculacion SET E4B2='1',E4MATB='1',E4LAT='1',E4MUS='1',E4INF='1' WHERE codigo='$codigo';";
			}						
		}else if ($_GET['modalidad_ca']=='C1'){
			$sql="UPDATE matriculacion SET E4C1='1',E4MATA='1',E4TEC='1',E4EPV='1',E4MUS='1' WHERE codigo='$codigo';";			
		}else if ($_GET['modalidad_ca']=='C2'){
			$sql="UPDATE matriculacion SET E4C2='1',E4MATA='1',E4TEC='1',E4EPV='1',E4INF='1' WHERE codigo='$codigo';";			
		}
	#	echo "<br/>Materias de OPCIÓN<br/>";
		$bdd->query($sql);
	#	echo $sql;
	

		#OPTATIVAS 4º
		$E4IEE=array_search('Iniciación a la Elect. y Electrónica', $optativas_ca);
		$E4LITU=array_search('Literatura Universal', $optativas_ca);
		$E4CUC=array_search('Cultura Clásica', $optativas_ca);
		$E4FR=array_search('Francés', $optativas_ca);
		$E4IE=array_search('Iniciativa Emprendedora', $optativas_ca);
		$E4AMT=array_search('Ampl.Matemáticas', $optativas_ca);
		$E4AMB=array_search('Ampl.Biología y Geología', $optativas_ca);
		$E4AFQ=array_search('Ampl.Física y Quím.', $optativas_ca);
		
	#	echo "<br/><br/>Las optativas<br/>";
		$sql="UPDATE matriculacion SET E4IEE='$E4IEE',E4LITU='$E4LITU',E4CUC='$E4CUC',E4FR='$E4FR',E4IE='$E4IE', E4AMT='$E4AMT',E4AMB='$E4AMB',E4AFQ='$E4AFQ' WHERE codigo='$codigo';";
		$bdd->query($sql);
	#	echo $sql;
		
	#RELIGION
		if(isset($_GET['religion'])){
			if($_GET['religion']=='0'){		//Religion
					$sql="UPDATE matriculacion SET E4REL='1',E4HCR='',E4MAE=''  WHERE codigo='$codigo';";
				}else if($_GET['religion']=='1'){	//HCR
					$sql="UPDATE matriculacion SET E4REL='',E4HCR='1',E4MAE=''  WHERE codigo='$codigo';";
				}else if($_GET['religion']=='2'){	//MAE
					$sql="UPDATE matriculacion SET E4REL='',E4HCR='',E4MAE='1'  WHERE codigo='$codigo';";
				}
			echo "<br/>La RELIGION de 4º  <br/>";
			$bdd->query($sql);
			echo $sql;
		}
	}else if($curso=='B1'){
	#PONEMOS A CERO 2º DE Bachillerato
		#echo "PONER A CERO 2B<BR>";
		//$sql="UPDATE matriculacion SET B2HART='',B2EEM='',B2LATII='',B2GRII='',B2MCSII='',B2LITU='',B2MATII='',B2FIS='',B2DTII='',B2ELE='',B2CTM='',B2BIO ='',B2QUI='',B2AINGII='',B2PSI='',B2GEOL='',B2TINII='',B2FGA='' WHERE codigo='$codigo';";
		
		$sql=$reiniciarB2;
	#	echo $sql;
		$bdd->query($sql);
		
		$modalidad=$_GET['modalidad'];
		$opcion=$_GET['modalidadct'];
		if($modalidad=='B2TC'){ //Ciencias
			if($opcion=='B2_A'){
				$sql="UPDATE matriculacion SET B2MATII='1',B2FIS='1',B2DTII='1' WHERE codigo='$codigo';";
			}else if($opcion=='B2_B'){	
				$sql="UPDATE matriculacion SET B2MATII='1',B2FIS='1',B2ELE='1' WHERE codigo='$codigo';";
			}else if($opcion=='B2_C'){	
				$sql="UPDATE matriculacion SET B2MATII='1',B2BIO='1',B2CTM='1' WHERE codigo='$codigo';";
			}else if($opcion=='B2_D'){	
				$sql="UPDATE matriculacion SET B2MATII='1',B2BIO='1',B2FIS='1' WHERE codigo='$codigo';";
			}
		}else if($modalidad=='B2HCS'){ 
		$opcion=$_GET['modalidadhcs'];
			if($opcion=='B2_1'){
					$sql="UPDATE matriculacion SET B2LATII='1',B2LITU='1',B2GRII='1'  WHERE codigo='$codigo';";
				}else if($opcion=='B2_2'){	
					$sql="UPDATE matriculacion SET B2HART='1',B2LATII='1',B2LITU='1' WHERE codigo='$codigo';";
				}else if($opcion=='B2_3'){	
					$sql="UPDATE matriculacion SET B2MCSII='1',B2LATII='1',B2LITU='1' WHERE codigo='$codigo';";
				}else if($opcion=='B2_4'){	
					$sql="UPDATE matriculacion SET B2HART='1',B2EEM='1',B2LITU='1' WHERE codigo='$codigo';";
				}else if($opcion=='B2_5'){	
					$sql="UPDATE matriculacion SET B2GRII='1',B2EEM='1',B2LITU='1' WHERE codigo='$codigo';";
				}else if($opcion=='B2_6'){	
					$sql="UPDATE matriculacion SET B2GEO='1',B2EEM='1',B2MCSII='1' WHERE codigo='$codigo';";
					
				}else if($opcion=='B2_7'){	
					$sql="UPDATE matriculacion SET B2GEO='1',B2LATII='1',B2GRII='1' WHERE codigo='$codigo';";
				}else if($opcion=='B2_8'){	
					$sql="UPDATE matriculacion SET B2HART='1',B2GEO='1',B2EEM='1' WHERE codigo='$codigo';";
				}else if($opcion=='B2_9'){	
					$sql="UPDATE matriculacion SET B2GRII='1',B2GEO='1',B2EEM='1' WHERE codigo='$codigo';";		
				}else if($opcion=='B2_10'){
					$sql="UPDATE matriculacion SET B2HART='1',B2LATII='1',B2GEO='1' WHERE codigo='$codigo';";			
				}else if($opcion=='B2_11'){
					$sql="UPDATE matriculacion SET B2MCSII='1',B2LATII='1',B2GEO='1' WHERE codigo='$codigo';";
				}else if($opcion=='B2_12'){
					$sql="UPDATE matriculacion SET B2LITU='1',B2EEM='1',B2MCSII='1' WHERE codigo='$codigo';";
			}
		}
		
	#	echo $sql; // Materias de Opción
		$bdd->query($sql);
	
		#Las optativas comunes
		$B2PSI=array_search('Psicología', $optativas);
		$B2AINGII=array_search('Ampliación Inglés', $optativas);
		$B2FRA=array_search('Francés', $optativas);
		
	#	echo "<br/>Las optativas<br/>";

		if($modalidad=='B2TC'){
			$B2TINII=array_search('Tecn. Industrial II', $optativas);
			$B2QUI=array_search('Química', $optativas);
			$B2GEOL=array_search('Geología', $optativas);
			$sql="UPDATE matriculacion SET B2TINII='$B2TINII',B2QUI='$B2QUI',B2PSI='$B2PSI',B2AINGII='$B2AINGII', B2FRA='$B2FRA',B2GEOL='$B2GEOL' WHERE codigo='$codigo';";
		}else{
			$B2FGA=array_search('Fundam. Admón y Gestión', $optativas);
			$sql="UPDATE matriculacion SET B2PSI='$B2PSI', B2AINGII='$B2AINGII', B2FRA='$B2FRA',B2FGA='$B2FGA' WHERE codigo='$codigo';";
		
		}
		
	#	echo $sql;
		$bdd->query($sql);// LAS OPTATIVAS
		
		#REINICIAMOS EL CURSO ANTERIOR
		#echo "<br/>REINICIAMOS EL CURSO ANTERIOR<br/>";
	
		$sql=$reiniciarB1;
		//"UPDATE matriculacion SET B1LATI='',B1HMC='',B1MCSI='',B1GRI='',B1LITU='',B1ECO='',B1MATI='',B1FYQ='',B1BYG='',B1DT='',B1REL='',B1TICI='',B1FR='',B1CC='', B1TINI='' WHERE codigo='$codigo';";	
		$bdd->query($sql);
	#	echo $sql;
		
		$modalidad=$_GET['modalidadB1'];
		$opcion_ca=$_GET['opcion'];
		
		if($modalidad=='C'){ 	//Ciencias
			if($opcion_ca=='1'){  	//DT
				$sql="UPDATE matriculacion SET B1MATI='1',B1FYQ='1',B1DT='1' WHERE codigo='$codigo';";
			}else{ 				// BIO
				$sql="UPDATE matriculacion SET B1MATI='1',B1FYQ='1',B1BYG='1' WHERE codigo='$codigo';";
			}
		}else if($modalidad=='H'){ //Humanidades
			if($opcion_ca=='0'){		//Eco
				$sql="UPDATE matriculacion SET B1LATI='1',B1HMC='1',B1ECO='1'  WHERE codigo='$codigo';";
			}else if($opcion_ca=='1'){	//GRIEGO
				$sql="UPDATE matriculacion SET B1LATI='1',B1HMC='1',B1GRI='1' WHERE codigo='$codigo';";
			}else if($opcion_ca=='2'){	//LITU
				$sql="UPDATE matriculacion SET B1LATI='1',B1HMC='1',B1LITU='1' WHERE codigo='$codigo';";
			}	
		}else if($modalidad=='S'){ 	//Ciencias Sociales
			if($opcion_ca=='0'){		//ECO
				$sql="UPDATE matriculacion SET B1MCSI='1',B1HMC='1',B1ECO='1'  WHERE codigo='$codigo';";
			}else if($opcion_ca=='1'){ //GRIEGO
				$sql="UPDATE matriculacion SET B1MCSI='1',B1HMC='1',B1GRI='1' WHERE codigo='$codigo';";
			}else if($opcion_ca=='2'){	//LITU
				$sql="UPDATE matriculacion SET B1MCSI='1',B1HMC='1',B1LITU='1' WHERE codigo='$codigo';";
			}	
		}
	#	echo $sql; // Materias de Opción
		$bdd->query($sql);

		$B1TICI=array_search('Tec. Inform. Comunicación I', $optativas_ca);
		$B1REL=array_search('Religión', $optativas_ca);
		$B1CC=array_search('Cultura Científica', $optativas_ca);
		$B1FR=array_search('Francés I', $optativas_ca);
		$B1APL=array_search('Anatomía Aplicada', $optativas_ca);
		$B1DAI=array_search('Dibujo Artístico I', $optativas_ca);		
		
		if($modalidad=='C'){ //Ciencias
			$B1TINI=array_search('Tecn. Industrial I', $optativas_ca);
			$sql="UPDATE $tabla SET B1DAI='$B1DAI', B1APL='$B1APL',B1FR='$B1FR',B1CC='$B1CC',B1TICI='$B1TICI',B1REL='$B1REL',B1TINI='$B1TINI' WHERE codigo='$codigo';";
		}else{
			$sql="UPDATE $tabla SET B1DAI='$B1DAI', B1APL='$B1APL', B1FR='$B1FR',B1CC='$B1CC',B1TICI='$B1TICI',B1REL='$B1REL' WHERE codigo='$codigo';";		
		}
	#	echo $sql;
		$bdd->query($sql);// LAS OPTATIVAS
	}

###
##	
#	AUTORIZACIONES
##
###	
	$sql=$reiniciarAutorizaciones;
	$bdd->query($sql);
	
	$sql=$autorizaciones;
	$bdd->query($sql);
	
	
	
$anombre=$_GET['anombre'];
$aapellidos=$_GET['aapellidos'];
$fnacimiento=$_GET['anno']."-".$_GET['mes']."-".$_GET['dia'];
$adni=$_GET['aDNI'];
$adomicilio=$_GET['adomicilio'];
$alocalidad=$_GET['alocalidad'];
$aprovincia=$_GET['aprovincia'];
$acp=$_GET['aCP'];
$lug_nac=$_GET['lug_nac'];
$prov_nac=$_GET['prov_nac'];
$pais_nac=$_GET['pais_nac'];
$nacionalidad=$_GET['nacionalidad'];
$mnombre=$_GET['mnombre'];
$mapellidos=$_GET['mapellidos'];
$mdni=$_GET['mDNI'];
$mdomicilio=$_GET['mdomicilio'];
$mlocalidad=$_GET['mlocalidad'];
$mprovincia=$_GET['mprovincia'];
$mcp=$_GET['mCP'];
$mtelefono_m=$_GET['MTELEFONO_M'];
$mtelefono_f=$_GET['MTELEFONO_F'];
$memail=$_GET['memail'];
$mestudios=$_GET['mestudios'];


$pnombre=$_GET['pnombre'];
$papellidos=$_GET['papellidos'];
$pdni=$_GET['pDNI'];
$pdomicilio=$_GET['pdomicilio'];
$plocalidad=$_GET['plocalidad'];
$pprovincia=$_GET['pprovincia'];
$pcp=$_GET['pCP'];
$ptelefono_m=$_GET['PTELEFONO_M'];
$ptelefono_f=$_GET['PTELEFONO_F'];
$pemail=$_GET['pemail'];
$pestudios=$_GET['pestudios'];

($_GET['MAUT_SMS']=='on') ? $maut_sms='1' : $maut_sms='';
($_GET['MAUT_EMAIL']=='on') ? $maut_email='1' : $maut_email='';
($_GET['PAUT_SMS']=='on') ? $paut_sms='1' : $paut_sms='';
($_GET['PAUT_EMAIL']=='on') ? $paut_email='1' : $paut_email='';
	
	#echo $personales."<br>";
	$sql="UPDATE $tabla SET ANOMBRE='$anombre',AAPELLIDOS='$aapellidos',ADOMICILIO='$adomicilio',ALOCALIDAD='$alocalidad',APROVINCIA='$aprovincia',ACP='$acp',lug_nac='$lug_nac',prov_nac='$prov_nac',pais_nac='$pais_nac',nacionalidad='$nacionalidad',FNACIMIENTO='$fnacimiento',ADNI='$adni',MAUT_EMAIL='$maut_email',MAUT_SMS='$maut_sms',MAPELLIDOS='$mapellidos',MNOMBRE='$mnombre',MNIF='$mdni',MDOMICILIO='$mdomicilio',MLOCALIDAD='$mlocalidad',MPROVINCIA='$mprovincia',MCP='$mcp',MTELEFONO_F='$mtelefono_f',MTELEFONO_M='$mtelefono_m',EMAIL_MADR='$memail',PAPELLIDOS='$papellidos',PNOMBRE='$pnombre',PNIF='$pdni',PDOMICILIO='$pdomicilio',PLOCALIDAD='$plocalidad',PPROVINCIA='$pprovincia',PCP='$pcp',PTELEFONO_F='$ptelefono_f',PTELEFONO_M='$ptelefono_m',EMAIL_PADR='$pemail',PAUT_SMS='$paut_sms',PAUT_EMAIL='$paut_email' WHERE codigo='$codigo';";
	#echo $sql;     
	$bdd->query($sql);
?>
<!doctype html>

<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
  <title>Matrícula IES EUROPA :: CURSO 2015-2016</title>
  <link rel="stylesheet" href="./css/example.css">
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="./js/sweetalert.min.js"></script>
  <link rel="stylesheet" href="./css/sweetalert.css">
  <style>
  #recomendacion {
    background-color: #FFF;
    font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
    width: 478px;
    padding: 17px;
    border-radius: 5px;
    text-align: center;
    position: fixed;
    left: 50%;
    top: 50%;
    margin-left: -256px;
    margin-top: -200px;
    overflow: hidden;
    display: none;
}
h1{
	background-image: url("images/logo_big.png");
	width: 385px;
	height: 41px;
	text-indent: 1px;
	white-space: nowrap;
	margin: 5px auto;
	color: #1E90FF
		
}
ul, li{
text-align: left;	
}

.sweetalert p{
text-align: left;
}
body{
text-align: left;
}
	#boton {
    border-radius: 5px;
    padding: 10px;
    height: 15px;
	display: inline-block;
	background-color: #3085D6;
	border-left-color: #3085D6;
	border-right-color: #3085D6;
	}	
	a:link {
    color: #ffffff;
    text-decoration:none;
    font-size: .9em;
	}

	a:visited {
    color: #ffffff;
    text-decoration:none;
    font-size: .9em;
	}
	a:hover {
    color: #ffffff;
    text-decoration:none;
	}
</style>
</head>
<body>
<div id="recomendacion"></div>
<script>
$(function(){
	var curso='<?php echo $curso;?>';
				
	var txt1="<div id='resumen'><p>Compruebe los datos en su impreso</p><p>Debe entregar junto con la matrícula impresa y firmada</p>";
	var txt3="<p>Las fechas para la entrega del impreso en el IES Europa son los días <b><?php echo $plazoMatricula;?></b></p></div>";
	if(curso=='N'){
		var txt2="<ul><li>Fotocopia DNI de alumnos y padres</li><li>El justificante de ingreso de 15€ en la cuenta<p><b>   ES15 2038 2828 0560 0015 7764</b></p></li><li>Dos fotografías tamaño carnet del alumno (una pegada en el impreso, la otra con el nombre en la parte posterior)</li><li>Certificado de empadronamiento</li><li>Certificado de traslado</li></ul>";
	}else if(curso=='E1' || curso=='E4' || curso=='B1'){
		var txt2="<ul><li>Fotocopia del DNI del alumno/a</li><li>El justificante de ingreso de 15€ en la cuenta<p><b>   ES15 2038 2828 0560 0015 7764</b></p></li><li>Dos fotografías tamaño carnet del alumno (una pegada en el impreso, la otra con el nombre en la parte posterior)</li></ul>";
	}else if(curso=='E2' || curso=='E3'){
		var txt2="<ul><li>Fotocopia DNI del alumno/a</li><li>El justificante de ingreso de 15€ en la cuenta<p><b>   ES15 2038 2828 0560 0015 7764</b></p></li><li>Dos fotografías tamaño carnet del alumno (una pegada en el impreso, la otra con el nombre en la parte posterior)</li></ul>";		
	}

	//var txt="Debe entregar el impreso en el IES Europa los días <?php echo $plazoMatricula;?>\nCompruebe los datos en su impreso</p><p>Debe entregar junto con la matrícula impresa</p>	<ul><li>El justificante de ingreso de 15€ en la cuenta<p><b>   ES15 2038 2828 0560 0015 7764</b></p></li><li>Dos fotografías tamaño carnet del alumno (una pegada en el impreso, la otra con el nombre en la parte posterior)</li></ul></div>";
	var txt=txt1+txt2+txt3;
	var codigo="<?php echo $codigo;?>";
	swal({
	title: "Recuerde",
	text: txt,
	html: true
	});
	$('.confirm').click(function() {
			var final = "Gracias. Si no lo ha hecho aún puede ahora hacer la encuesta de satisfacción con el IES Europa, no le llevará más que unos minutos.<br/><div id='boton' class='dcha'><a href='http://ies.europa.rivas.educa.madrid.org/encuesta2/index.php/859912/lang-es' title='Si su hijo/a a cursado estudios en el IES Europa durante del curso 2014-2015, puede realizar la encuesta con el mismo código de matrícula'>Realizar la encuesta</a></div>";
			$('#recomendacion').show();
			window.open('generaImpreso.php?codigo='+codigo,'_blank');
			$('#recomendacion').html(final);
	});
});
</script>
</body>
</html>
