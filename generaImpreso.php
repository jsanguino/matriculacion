<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
header('Content-Type: text/html; charset=utf-8');
require('./src/fpdf.php');
include('./include/configuracion.php');
include('./class/funciones.php');
#$codigo='819y2q28m24q';
$codigo=$_GET['codigo'];

date_default_timezone_set("Europe/Madrid");
setlocale(LC_TIME, "es_ES.UTF-8");

$fecha=strftime("%d de %B de %Y");
$fecha="En Rivas-Vaciamadrid, a ".$fecha;
#El alumno solicita matrícula en las asignaturas troncales, específicas obligatorias y de libre configuración autonómica y en las opciones arriba
#indicadas; se respetarán sus preferencias teniendo en cuenta las posibilidades del Centro.


 try {
	$bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$bdd = new PDO($dsn, $user, $pass);
	} catch(Exception $e) {
	exit('Unable to connect to database.');
 }

$materiasComunesE1="- Lengua Cast. y Lit.;- Matemáticas;- Geografía e Historia;- Biología y Geología;- Inglés;- Educación Física;- E. Plástica visual y audiov.;- Tecnología, Prog. y Robótica\n";
$materiasComunesE2="- Lengua Cast. y Literatura;- Matemáticas;- Ciencias Sociales;- Inglés;- Ciencias de la Naturaleza;- Educación para la ciudadanía;- Educación Física;- Música\n";	
$materiasComunesE3="- Lengua Cast. y Lit.;- Geografía e Historia;- Biología y Geología;- Física  y Química;- Inglés;- Educación Física;- Música;- Tecnología, Prog. y Robótica";
$materiasComunesE4="- Lengua y Literatura;- Inglés;- Ciencias Sociales;- Matemáticas;- Educación Física";
$materiasComunesB1="- Lengua y Literatura;- Inglés;- Filosofía;- Educación Física";	

$materiasE1="E1FR, E1TMU,E1REL, E1VE";
$materiasE2="E2FR,E2IC,E2REL,E2HCR,E2MAE";
$materiasE3="E3MAP, E3MAC, E3AMT, E3CUC, E3FR, E3IAEE, E3REL, E3VE";
$materiasE4="E4MATB,E4TEC,E4EPV,E4INF,E4BYG,E4FYQ,E4FRA,E4LAT,E4MUS,E4MATA,E4AMT,E4AMB,E4AFQ,E4IEE,E4LITU,E4CUC,E4FR,E4IE,E4REL,E4HCR,E4MAE";
$materiasB1="B1LATI,B1HMC,B1MCSI,B1GRI,B1LITU,B1ECO,B1MATI,B1FYQ,B1BYG,B1DT,B1REL,B1TICI,B1FR,B1CC,B1TINI,B1APL,B1DAI";
$materiasB2="B2HART,B2GEO,B2EEM,B2LATII,B2GRII,B2MCSII,B2LITU,B2MATII,B2FIS,B2DTII,B2ELE,B2CTM,B2BIO,B2QUI,B2AINGII,B2PSI,B2GEOL,B2TINII,B2FGA,B2FRA";



$sql_personales="SELECT NMEXPEDIEN,ANOMBRE,SEXO,AAPELLIDOS,ADOMICILIO,ALOCALIDAD,APROVINCIA,CDPROV,CDMUNI,ACP,lug_nac,prov_nac,pais_nac,nacionalidad,TELEFONO1,TELEFONO2,CDGRUPO,SEXO,AFCNACIMIE,FNACIMIENTO,ADNI,ETAPA,CURSO,MODAL_PERF,MAPELLIDOS,MNOMBRE,MNIF,MNACIONALIDAD,MDOMICILIO,MLOCALIDAD,MPROVINCIA,MCP,MTELEFONO_F,MTELEFONO_M,MAUT_SMS,PAPELLIDOS,PNOMBRE,PNIF,PNACIONALIDAD,PDOMICILIO,PLOCALIDAD,PPROVINCIA,PCP,PTELEFONO_F,PTELEFONO_M,PAUT_SMS,PAUT_EMAIL,MAUT_EMAIL,AUT_PARACETAMOL,AUT_FOTOS,AUT_TRASLADO,EMAIL_ALUM,EMAIL_PADR,EMAIL_MADR,suspensos FROM $tabla where codigo='".$codigo."';";
$personales = $bdd->query($sql_personales);
foreach ($personales->fetchAll(PDO::FETCH_ASSOC) as $row);

###
$altoCelda=4;
$altoCeldaNombre=5;
$saltoPersonal=3;
$tam=10;
$firmaP="Firma del padre o tutor";
$firmaM="Firma de la madre o tutora";
$firmaA="Firma del alumno";

$interesado="EJEMPLAR PARA EL INTERESADO";
$administracion="EJEMPLAR PARA EL IES EUROPA";
$avisotelefono='Autorizo el envío de notificaciones por SMS';
$avisoemail='Autorizo el envío de notificaciones por email';

//$avisoFinal="Igualmente declaran que con su firma expresan su deseo de ".$recibir." comunicaciones mediante ".$medios;
$autorizacionReligion="En cumplimiento con lo dispuesto en el Decreto 23/2007, de 10 de mayo, por el que se establece para la Comunidad de Madrid el currículo de la Educación Secundaria Obligatoria, en el que se regula la enseñanza de la Religión, manifiesto el deseo de que mi hijo/a ".$datosAlumno." que durante el presente año escolar (2015/2016) cursará $CURSO de ESO, reciba durante este curso, las enseñanzas correspondientes.";
$autorizacionFotos="AUTORIZO a publicar en el Centro, internet o medios acreditados, reportajes, fotos o vídeos de las diversas actividades en las que pudiera participar (dentro del ámbito educativo), en el presente curso en el que se encuentra escolarizado en el IES EUROPA y en los términos que establece el Art. 13 del RD 1720 de 21 de diciembre de 2007 por el que se aprueba el Reglamento de desarrollo de la Ley Orgánica 15/1999 de 13 de diciembre, de protección de datos de carácter personal, para aquellos supuestos no previstos por las leyes.";
$autorizacionTraslado="AUTORIZO al personal del citado centro a trasladar a mi hijo/a a un Centro Sanitario en caso de urgencia, así como a que se lleven a cabo aquellas actuaciones que el personal sanitario considere necesario.";
$autorizacionParacetamol="AUTORIZO la administración de Paracetamol al alumno en caso necesario.";

$avisoReglamento="ACEPTAN las normas de obligado cumplimiento en el IES Europa recogidas en su Plan de Convivencia que puede consultarse en la página web del Centro y (un resumen) en la agenda del alumno.";

$k=10;
$a1l=27;
$a2l=$a1l+$k;
$a3l=$a2l+$k;
$a4l=$a3l+$k;
$altAsignaturas=125;
$altAutorizaciones=190;
$interlineadoOpt=3;
$interlineadoOptPromociona=4;
$materiasOpcionPromociona=91;
$altAvisoAsignaturas=180;
$altRectangulo=55;


if ($row['ETAPA']=='13'){
	$variable='E'.$row['CURSO'];
}else if($row['ETAPA']=='05'){
	//if($row['MODAL_PERF']=='BHCS'){$variable='BHCS'.$row['CURSO'];}else{$variable='BCT'.$row['CURSO'];}
	$variable='B'.$row['CURSO'];		
}else if($row['ETAPA']=='14'){
	$variable='FPB'.$row['CURSO'];
}else if($row['ETAPA']=='N'){$variable='N';}
//include('./backend/curso.php');
$suspensas=$row['suspensos'];

if($variable=='N'){$suspensas='0';}
if($variable=='B2'){$suspensas='0';$variable='B1';}

#Es repetidor?
$repetidor=($suspensas>2) ? $repetidor='S' : $repetidor='N';

#De qué curso es?
if($variable=='N'){
	$cursoActual_="";
	$curso="1º ESO";
	
	$sql_materias="SELECT ".$materiasE1." FROM $tabla where codigo='$codigo';";
	$materiasComunesCurso_=$materiasComunesE1;
	$materias = $bdd->query($sql_materias);
	foreach ($materias->fetchAll(PDO::FETCH_ASSOC) as $filas);

	# 
	#OPTATIVAS CURSO AL QUE PROMOCIONA
	$optativa['E1FR']=$filas['E1FR'];
	$optativa['E1TMU']=$filas['E1TMU'];

	asort($optativa);
	$optativas=array_flip($optativa);

	$num=count($optativas);
	$materiasOptativasCurso_='';
	for ($i=0;$i<$num;$i++){
		$n=$i+1;
		$materiasOptativasCurso_.=$n." - ".ordenarOptativasE1($optativas[$n]).";";
	}
	if($filas['E1REL']=='1'){$religion='Religión';}else{$religion='Valores Éticos';}

	
}else if($variable=='E1'){
	$cursoActual="1º ESO";
	$curso="2º ESO";
	
	if($repetidor=='N'){
		$sql_materias="SELECT ".$materiasE2." FROM $tabla where codigo='$codigo';";
	}else{
		$sql_materias="SELECT ".$materiasE1.",".$materiasE2." FROM $tabla where codigo='$codigo';";
	}
	$materias = $bdd->query($sql_materias);
	foreach ($materias->fetchAll(PDO::FETCH_ASSOC) as $filas);
	
	
	$materiasComunesCursoActual_=$materiasComunesE1;
	$materiasComunesCurso_=$materiasComunesE2;
	
	if($repetidor=='S'){
		#OPTATIVAS CURSO ACTUAL
		$optativa_ca['E1FR']=$filas['E1FR'];
		$optativa_ca['E1TMU']=$filas['E1TMU'];

		asort($optativa_ca);
		$optativas_ca=array_flip($optativa_ca);

		$num=count($optativas_ca);
		$materiasOptativasCursoActual_='';
		for ($i=0;$i<$num;$i++){
			$n=$i+1;
			$materiasOptativasCursoActual_.=$n." - ".ordenarOptativasE1($optativas_ca[$n]).";";
		}
		#RELIGIÓN del CURSO ACTUAL
		if($filas['E1REL']=='1'){$religion_ca='Religión';}else{$religion_ca='Valores Éticos';}
	
	}
	
	unset($optativa);
	#OPTATIVAS CURSO AL QUE PROMOCIONA
	$optativa['E2FR']=$filas['E2FR'];
	$optativa['E2IC']=$filas['E2IC'];

	asort($optativa);
	$optativas=array_flip($optativa);

	$num=count($optativas);
	$materiasOptativasCurso_='';
	for ($i=0;$i<$num;$i++){
		$n=$i+1;
		$materiasOptativasCurso_.=$n." - ".ordenarOptativasE2($optativas[$n]).";";
	}
	
	if($filas['E2REL']=='1'){$religion='Religión';}else if($filas['E2HCR']=='1'){$religion='Hist.Cult. de las Religiones';}else{$religion='Medidas Atención Educativa';}

}else if($variable=='E2'){
	$cursoActual="2º ESO";
	$curso="3º ESO";
	if($repetidor=='N'){
		$sql_materias="SELECT ".$materiasE3." FROM $tabla where codigo='$codigo';";
	}else{
		$sql_materias="SELECT ".$materiasE2.",".$materiasE3." FROM $tabla where codigo='$codigo';";
	}
	$materias = $bdd->query($sql_materias);
	foreach ($materias->fetchAll(PDO::FETCH_ASSOC) as $filas);
		
	$materiasComunesCursoActual_="- Lengua Cast. y Literatura;- Matemáticas;- Ciencias Sociales;- Inglés;- Ciencias de la Naturaleza;- Educación para la ciudadanía;- Educación Física;- Música\n";
	$materiasComunesCurso_="- Lengua Cast. y Lit.;- Geografía e Historia;- Biología y Geología;- Física  y Química;- Inglés;- Educación Física;- Música;- Tecnología, Prog. y Robótica\n";

	if($repetidor=='S'){
	#OPTATIVAS CURSO ACTUAL
		$fila_ca['E2FR']=$filas['E2FR'];
		$fila_ca['E2IC']=$filas['E2IC'];

		asort($fila_ca);
		$optativas_ca=array_flip($fila_ca);

		$num=count($optativas_ca);
		$materiasOptativasCursoActual_='';
		for ($i=0;$i<$num;$i++){
			$n=$i+1;
			$materiasOptativasCursoActual_.=$n." - ".ordenarOptativasE2($optativas_ca[$n]).";";
		}
	#RELIGIÓN del CURSO ACTUAL
	if($filas['E2REL']=='1'){$religion_ca='Religión';}else if($filas['E2HCR']=='1'){$religion_ca='Hist.Cult. de las Religiones';}else{$religion_ca='Medidas Atención Educativa';}
	}

	#OPTATIVAS CURSO AL QUE PROMOCIONA
	$fila['E3AMT']=$filas['E3AMT'];
	$fila['E3IAEE']=$filas['E3IAEE'];
	$fila['E3CUC']=$filas['E3CUC'];
	$fila['E3FR']=$filas['E3FR'];
	
	asort($fila);
	$optativas=array_flip($fila);

	$num=count($optativas);
	$materiasOptativasCurso_='';
	for ($i=0;$i<$num;$i++){
		$n=$i+1;
		$materiasOptativasCurso_.=$n." - ".ordenarOptativasE3($optativas[$n]).";";
	}
	#OPCIÓN DEL CURSO AL QUE PROMOCIONA
	if($filas['E3MAP']=='1'){$matematicas='Matemáticas Aplicadas';}else{$matematicas='Matemáticas Académicas';}

	#RELIGIÓN CURSO AL QUE PROMOCIONA
	if($filas['E3REL']=='1'){$religion='Religión';}else{$religion='Valores Éticos';}


}else if($variable=='E3'){
	$cursoActual="3º ESO";
	$curso="4º ESO";


	if($repetidor=='N'){
		$sql_materias="SELECT ".$materiasE4." FROM $tabla where codigo='$codigo';";
	}else{
		$sql_materias="SELECT ".$materiasE3.",".$materiasE4." FROM $tabla where codigo='$codigo';";
	}
	
	$materias = $bdd->query($sql_materias);
	foreach ($materias->fetchAll(PDO::FETCH_ASSOC) as $filas);
	
	//$materiasOpcion_='** Biología y Geología;** Física y Química;** Tecnología';
	$materiasOpcion_=encontrarMateriasOpcion($filas,$variable);
	$materiasComunesCursoActual_=$materiasComunesE3;
	$materiasComunesCurso_=$materiasComunesE4;
	if($repetidor=='S'){
		#Preguntamos si las mates aplicadas están seleccionadas	
		if($filas['E3MAP']=='1'){$matematicas_ca='Matemáticas Aplicadas';}else{$matematicas_ca='Matemáticas Académicas';}

		#Preguntamos si la religion está seleccionada
		if($filas['E3REL']=='1'){$religion_ca='** Religión';}else{$religion_ca='** Valores Éticos';}

		#OPTATIVAS CURSO ACTUAL
		$fila_ca['E3AMT']=$filas['E3AMT'];
		$fila_ca['E3IAEE']=$filas['E3IAEE'];
		$fila_ca['E3CUC']=$filas['E3CUC'];
		$fila_ca['E3FR']=$filas['E3FR'];

		asort($fila_ca);
		$optativas_ca=array_flip($fila_ca);

		$num=count($optativas_ca);
		$materiasOptativasCursoActual_='';
		for ($i=0;$i<$num;$i++){
			$n=$i+1;
			$materiasOptativasCursoActual_.=$n." - ".ordenarOptativasE3($optativas_ca[$n]).";";
		}
	
	}
	#OPTATIVAS CURSO AL QUE PROMOCIONA
	$fila['E4AMT']=$filas['E4AMT'];
	$fila['E4IE']=$filas['E4IE'];
	$fila['E4CUC']=$filas['E4CUC'];
	$fila['E4LITU']=$filas['E4LITU'];
	$fila['E4IEE']=$filas['E4IEE'];
	$fila['E4FR']=$filas['E4FR'];
	$fila['E4AMB']=$filas['E4AMB'];
	$fila['E4AFQ']=$filas['E4AFQ'];

	asort($fila);
	$optativas=array_flip($fila);

	$num=count($optativas);
	$materiasOptativasCurso_='';
	for ($i=0;$i<$num;$i++){
		$n=$i+1;
		$materiasOptativasCurso_.=$n." - ".ordenarOptativasE4($optativas[$n]).";";
	}
	#Preguntamos si las mates A de 4º están seleccionadas.
	if($filas['E4MATA']){$matematicas='** Matemáticas A';}else{$matematicas='** Matemáticas B';}

	#Preguntamos si la religion está seleccionada
	if($filas['E4REL']=='1'){$religion='** Religión';}else if($filas['E4HCR']=='1'){$religion='** Hist. y Cult. Religiones';}else{$religion='** Medidas de Atención Edu.';}

}else if($variable=='E4'){
	$cursoActual="4º ESO";
	$curso="1º BAC";
	
	if($repetidor=='N'){
		$sql_materias="SELECT ".$materiasB1." FROM $tabla where codigo='$codigo';";
	}else{
		$sql_materias="SELECT ".$materiasE4.",".$materiasB1." FROM $tabla where codigo='$codigo';";
	}

	$materias = $bdd->query($sql_materias);
	foreach ($materias->fetchAll(PDO::FETCH_ASSOC) as $filas);

	#Buscamos las materias de Opción
	$materiasOpcion_=encontrarMateriasOpcion($filas,$variable);
	
	#Las Comunes las ponemos ya.
	$materiasComunesCursoActual_=$materiasComunesE4;
	$materiasComunesCurso_=$materiasComunesB1;
	
	if($repetidor=='S'){
		#OPTATIVAS CURSO ANTERIOR
		$fila['E4AMT']=$filas['E4AMT'];
		$fila['E4IE']=$filas['E4IE'];
		$fila['E4CUC']=$filas['E4CUC'];
		$fila['E4LITU']=$filas['E4LITU'];
		$fila['E4IEE']=$filas['E4IEE'];
		$fila['E4FR']=$filas['E4FR'];
		$fila['E4AMB']=$filas['E4AMB'];
		$fila['E4AFQ']=$filas['E4AFQ'];

		asort($fila);
		$optativas_ca=array_flip($fila);
		$materiasOpcion_ca=encontrarMateriasOpcion_ca($filas,$variable);

		$num=count($optativas_ca);
		$materiasOptativasCursoActual_='';
		for ($i=0;$i<$num;$i++){
			$n=$i+1;
			$materiasOptativasCursoActual_.=$n." - ".ordenarOptativasE4($optativas_ca[$n]).";";
		}
		
		#Preguntamos si las mates A de 4º están seleccionadas.
		if($filas['E4MATA']){$matematicas_ca='** Matemáticas A';}else{$matematicas_ca='** Matemáticas B';}

		#Preguntamos si la religion está seleccionada
		if($filas['E4REL']=='1'){$religion_ca='** Religión';}else if($filas['E4HCR']=='1'){$religion_ca='** Hist. y Cult. Religiones';}else{$religion_ca='** Medidas de Atención Edu.';}
	}
	unset($fila);
	
	#OPTATIVAS CURSO AL QUE PROMOCIONA
	$fila['B1REL']=$filas['B1REL'];
	$fila['B1TICI']=$filas['B1TICI'];
	$fila['B1FR']=$filas['B1FR'];
	$fila['B1CC']=$filas['B1CC'];
	$fila['B1APL']=$filas['B1APL'];
	$fila['B1DAI']=$filas['B1DAI'];
	
	#Comprobar que está vacía y no poner aquí.
	if($filas['B1TINI']!=''){
		$fila['B1TINI']=$filas['B1TINI'];	
	}
	asort($fila);
	$optativas=array_flip($fila);

	$num=count($optativas);
	$materiasOptativasCurso_='';
	for ($i=0;$i<$num;$i++){
		$n=$i+1;
		$materiasOptativasCurso_.=$n." - ".ordenarOptativasB1($optativas[$n]).";";
	}
}else if($variable=='B1'){
	$cursoActual="1º BAC";
	$curso="2º BAC";
	
	if($repetidor=='N'){
		$sql_materias="SELECT ".$materiasB2." FROM $tabla where codigo='$codigo';";
	}else{
		$sql_materias="SELECT ".$materiasB1.",".$materiasB2." FROM $tabla where codigo='$codigo';";	
	}
	
	$materias = $bdd->query($sql_materias);
	foreach ($materias->fetchAll(PDO::FETCH_ASSOC) as $filas);	
	
	#Buscamos las materias de Opción
	$materiasOpcion_=encontrarMateriasOpcion($filas,$variable);
	
	
	#Las Comunes las ponemos ya.
	$materiasComunesCursoActual_=$materiasComunesB1;
	$materiasComunesCurso_="- Lengua y Literatura;- Inglés;- Hª de la Filosofía;- Historia";

	if($repetidor=='S'){
		unset($fila);
		#OPTATIVAS CURSO QUE REPITE

		$fila=optativasB1($filas);
		asort($fila);
		$optativas_ca=array_flip($fila);
		$materiasOpcion_ca=encontrarMateriasOpcion_ca($filas,$variable);
				
		$num=count($optativas_ca);
		$materiasOptativasCursoActual_='';
		for ($i=0;$i<$num;$i++){
			$n=$i+1;
			$materiasOptativasCursoActual_.=$n." - ".ordenarOptativasB1($optativas_ca[$n]).";";
		}
	}
	unset($fila);
	#OPTATIVAS CURSO AL QUE PROMOCIONA
	$fila['B2AINGII']=$filas['B2AINGII'];
	$fila['B2PSI']=$filas['B2PSI'];
	$fila['B2FRA']=$filas['B2FRA'];
	
	#Comprobar que está vacía y no poner aquí.
	if($filas['B2TINII']!=''){
		$fila['B2TINII']=$filas['B2TINII'];
	}
	if($filas['B2ELE']!=''){	
		$fila['B2ELE']=$filas['B2ELE'];
	}	
	if($filas['B2GEOL']!=''){
		$fila['B2GEOL']=$filas['B2GEOL'];
	}	
	if($filas['B2FGA']!=''){
		$fila['B2FGA']=$filas['B2FGA'];
	}
	if($filas['B2QUI']!=''){
		$fila['B2QUI']=$filas['B2QUI'];
	}
	
	asort($fila);
	$optativas=array_flip($fila);

	$num=count($optativas);
	$materiasOptativasCurso_='';
	for ($i=0;$i<$num;$i++){
		$n=$i+1;
		$materiasOptativasCurso_.=$n." - ".ordenarOptativasB2($optativas[$n]).";";
	}
}


#####
##
#	Datos Variables
##
#####

$sexo=$row['SEXO'];
if($sexo=='M'){$datosAlumno='Datos de la alumna';}else if($sexo=='H'){$datosAlumno='Datos del alumno';}else{$datosAlumno='Datos del alumno';}	
$aapellidos=$row['AAPELLIDOS'];
$anombre=$row['ANOMBRE'];
$adni=$row['ADNI'];
$fecha_nac=fechaXno($row['FNACIMIENTO']);
$aDomicilio=$row['ADOMICILIO'];
$atelefono=$row['ATELEFONO'];
$aemail=$row['EMAIL_ALUM'];
$expediente=$row['NMEXPEDIEN'];

#2ª Línea.
$provNac=$row['lug_nac'];
$paisNac=$row['pais_nac'];
$anacionalidad=$row['nacionalidad'];

$alocalidad=$row['ALOCALIDAD'];
$aprovincia=$row['APROVINCIA'];
$apais=$row['APAIS'];
$aCP=$row['ACP'];

$aCalle=$row['ADOMICILIO'];
$atelefono=$row['ATELEFONO'];;

#$atelefono2="777 666 666";
$lugarNacimiento='Madrid';

$mapellidos=$row['MAPELLIDOS'];
$mnombre=$row['MNOMBRE'];

$papellidos=$row['PAPELLIDOS'];
$pnombre=$row['PNOMBRE'];

#Segunda Línea: Documento de indentidad, Nacionalidad
$mDNI=$row['MNIF'];
$mNacionalidad=$row['MNACIONALIDAD'];

$pDNI=$row['PNIF'];
$pNacionalidad=$row['PNACIONALIDAD'];

#Tercera Línea: Domicilio
$mDomicilio=$row['MDOMICILIO'];
$mCP=$row['MCP'];

$pDomicilio=$row['PDOMICILIO'];
$pCP=$row['PCP'];

#Cuarta línea: email 
$memail=$row['EMAIL_MADR'];
$pemail=$row['EMAIL_PADR'];

#Quinta Línea: Teléfonofijo Teléfono Móvil, Autorización sm y Email
$mtelefono1=$row['MTELEFONO_F'];
$mtelefono2=$row['MTELEFONO_M'];

$ptelefono1=$row['PTELEFONO_F'];
$ptelefono2=$row['PTELEFONO_M'];

#Avisos de telefono y mail
$mAvisoTelefono=($row['MAUT_SMS']==1) ? $mAvisoTelefono = 'X' : $mAvisoTelefono = '';
$mAvisoEmail=($row['MAUT_EMAIL']==1) ? $mAvisoEmail = 'X' : $mAvisoEmail = '';

$pAvisoTelefono=($row['PAUT_SMS']==1) ? $pAvisoTelefono = 'X' : $pAvisoTelefono = '';
$pAvisoEmail=($row['PAUT_EMAIL']==1) ? $pAvisoEmail = 'X' : $pAvisoEmail = '';

#Autorizaciones
//$mAutorizacionTraslado=0;
//$mAutorizacionFotos=1;
$mAutorizacionTraslado = ($row['AUT_TRASLADO']==1) ? $mAutorizacionTraslado = 'X' : $mAutorizacionTraslado = '';
$mAutorizacionFotos = ($row['AUT_FOTOS']==1) ? $mAutorizacionFotos = 'X' : $mAutorizacionFotos = '';
$mAutorizacionParacetamol = ($row['AUT_PARACETAMOL']==1) ? $mAutorizacionParacetamol = 'X' : $mAutorizacionParacetamol = '';

#
$alumno= strtoupper($datosAlumno);

$pdf = new FPDF();

for($p=0;$p<2;$p++){
$ejemplar=($p==0) ? $ejemplar=$administracion : $ejemplar=$interesado;
$pdf->AddPage();
$pdf->Image('./images/logo.png');
$pdf->Rect(168,8,30,35);
$pdf->SetFont('Arial','B',14);
$pdf->SetXY(116,18);
$pdf->Write($altoCelda+3,'EXPEDIENTE');
$pdf->SetX($pdf->GetX()+4);
$pdf->Cell(15,$altoCelda+2,$expediente,1,0);
$pdf->SetXY(113,10);
$pdf->SetFont('Arial','B',16);
$pdf->Write($altoCelda,'CURSO 2015 - 2016');
$pdf->Ln();

$pdf->SetX(10);
$pdf->SetY(40);

#Primera línea: Apellidos, nombre, dni y fecha de nac.
$pdf->SetY($a1l);
$pdf->SetFont('Arial','',11);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(80,$altoCeldaNombre,$aapellidos,1);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(50,$altoCeldaNombre,$anombre,1);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(21,$altoCeldaNombre,$fecha_nac,1,0);
$pdf->Ln(4);
#Segunda línea: Lugar de nacimiento, Provincia, País, Nacionalidad

$pdf->SetFont('Arial','',8);
$pdf->SetX($pdf->GetX()+4);
$pdf->Write($altoCeldaNombre,'Apellidos');
$pdf->SetX($pdf->GetX()+80);
$pdf->Write($altoCeldaNombre,'Nombre');
$pdf->SetX($pdf->GetX()+30);
$pdf->Write($altoCeldaNombre,'F.Nacimiento');

$pdf->SetY($a2l);
$pdf->SetFont('Arial','',10);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(40,$altoCeldaNombre,$lugarNacimiento,1);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(32,$altoCeldaNombre,$provNac,1);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(27,$altoCeldaNombre,$paisNac,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(27,$altoCeldaNombre,$anacionalidad,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(21,$altoCeldaNombre,$adni,1,0);
$pdf->Ln(4);

$pdf->SetFont('Arial','',8);
$pdf->SetX($pdf->GetX()+4);
$pdf->Write($altoCeldaNombre,'Lugar Nac.');
$pdf->SetX($pdf->GetX()+29);
$pdf->Write($altoCeldaNombre,'Provicia');
$pdf->SetX($pdf->GetX()+22);
$pdf->Write($altoCeldaNombre,'País');
$pdf->SetX($pdf->GetX()+24);
$pdf->Write($altoCeldaNombre,'Nacionalidad');
$pdf->SetX($pdf->GetX()+18);
$pdf->Write($altoCeldaNombre,'DNI');

#Tercera línea: Domicilio, localidad, provincia, CP. Teléfono, email

$pdf->SetFont('Arial','',8);
$pdf->Write($altoCeldaNombre,'');
$pdf->SetY($a3l);
$pdf->SetFont('Arial','',10);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(75,$altoCeldaNombre,$aDomicilio,1);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(55,$altoCeldaNombre,$alocalidad,1);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(35,$altoCeldaNombre,$aprovincia,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(15,$altoCeldaNombre,$aCP,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Ln(4);

#Cuarta línea: Teléfono, email, $sexo
$pdf->SetFont('Arial','',8);
$pdf->SetX($pdf->GetX()+4);
$pdf->Write($altoCeldaNombre,'Domicilio');
$pdf->SetX($pdf->GetX()+66);
$pdf->Write($altoCeldaNombre,'Localidad');
$pdf->SetX($pdf->GetX()+44);
$pdf->Write($altoCeldaNombre,'Provincia');
$pdf->SetX($pdf->GetX()+24);
$pdf->Write($altoCeldaNombre,'C.P.');

$pdf->SetY($a4l);
$pdf->SetFont('Arial','',10);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(25,$altoCeldaNombre,$atelefono,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(55,$altoCeldaNombre,$aemail,1,0);
$pdf->Ln(4);
$pdf->SetFont('Arial','',8);
$pdf->SetX($pdf->GetX()+4);
$pdf->Write($altoCeldaNombre,'Teléfono');
$pdf->SetX($pdf->GetX()+16);
$pdf->Write($altoCeldaNombre,'Correo Electrónico');
#$pdf->SetX($pdf->GetX()+2);
#$pdf->SetX($pdf->GetX()+2);
#

#Madre y Padre
#Primera Línea: Nombre y apellidos
$pdf->Rect(9,$altAsignaturas-58,94,$altRectangulo);
$pdf->Rect(105,$altAsignaturas-58,94,$altRectangulo);
$pdf->SetFont('Arial','B',11);
$pdf->SetXY(11,67);
$pdf->Write($altoCeldaNombre+2,'MADRE o TUTORA');
$pdf->SetXY(107,67);
$pdf->Write($altoCeldaNombre+2,'PADRE o TUTOR');
$pdf->SetY(74);
$pdf->SetFont('Arial','',10);
$pdf->SetX($pdf->GetX());
$pdf->Cell(55,$altoCelda,$mapellidos,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(35,$altoCelda,$mnombre,1,0);
$pdf->SetX($pdf->GetX()+4);
$pdf->Cell(55,$altoCelda,$papellidos,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(35,$altoCelda,$pnombre,1,0);

$pdf->Ln(7);
#Segunda Línea: Documento de indentidad, Nacionalidad
$pdf->SetX($pdf->GetX());
$pdf->Cell(20,$altoCelda,$mDNI,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(70,$altoCelda,$mNacionalidad,1,0);
$pdf->SetX($pdf->GetX()+4);
$pdf->Cell(20,$altoCelda,$pDNI,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(70,$altoCelda,$pNacionalidad,1,0);
$pdf->Ln(7);

#Tercera Línea: Domicilio

$pdf->SetX($pdf->GetX());
$pdf->Cell(75,$altoCelda,$mDomicilio,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(15,$altoCelda,$mCP,1,0);
$pdf->SetX($pdf->GetX()+4);
$pdf->Cell(75,$altoCelda,$pDomicilio,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(15,$altoCelda,$pCP,1,0);
$pdf->Ln(7);

#Cuarta línea: email 
$pdf->SetX($pdf->GetX());
$pdf->Cell(20,$altoCelda,$mtelefono1,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(20,$altoCelda,$mtelefono2,1,0);

$pdf->SetX($pdf->GetX()+54);
$pdf->Cell(20,$altoCelda,$ptelefono1,1,0);
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(20,$altoCelda,$ptelefono2,1,0);

$pdf->Ln(6);

#Quinta Línea: email
$pdf->SetX($pdf->GetX());
$pdf->Cell(92,$altoCeldaNombre,$memail,1,0);
$pdf->SetX($pdf->GetX()+4);
$pdf->Cell(90,$altoCeldaNombre,$pemail,1,0);
$pdf->Ln(7);

#Sexta Línea. Avisos Teléfono y mail
$pdf->SetX($pdf->GetX());
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(5,$altoCelda,$mAvisoTelefono,1,0);
$pdf->SetX($pdf->GetX()+3);
$pdf->Cell(85,$altoCelda,$avisotelefono,0,0);

$pdf->SetX($pdf->GetX()+4);
$pdf->Cell(5,$altoCelda,$pAvisoTelefono,1,0);
$pdf->SetX($pdf->GetX()+3);
$pdf->Cell(85,$altoCelda,$avisotelefono,0,0);
$pdf->Ln(5);
$pdf->SetX($pdf->GetX());
$pdf->SetX($pdf->GetX()+2);
$pdf->Cell(5,$altoCelda,$mAvisoEmail,1,0,'C');
$pdf->SetX($pdf->GetX()+3);
$pdf->Cell(85,$altoCelda,$avisoemail,0,0);

$pdf->SetX($pdf->GetX()+4);
$pdf->Cell(5,$altoCelda,$pAvisoEmail,1,0,'C');
$pdf->SetX($pdf->GetX()+3);
$pdf->Cell(85,$altoCelda,$avisoemail,0,0);


$y=$pdf->GetY()+2;
//$pdf->Line(10,$y,195,$y);
$pdf->Ln();

#########################
#		Asignaturas		#
#########################
if($repetidor=='S'){	
	$pdf->Rect(9,$altAsignaturas,94,$altRectangulo);
	$pdf->Rect(105,$altAsignaturas,94,$altRectangulo);
	$pdf->SetXY(11,$altAsignaturas+2);
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(30,6,$cursoActual,1,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','B',8);
	$pdf->SetX($pdf->GetX()+4);
	$pdf->Cell(19,5,'Materias Comunes',0,0,'C');
	$pdf->SetFont('Arial','',8);
	$pdf->Ln();

	#Ponemos las materias comunes del curso que repite
	$materiasComunesCursoActual=explode(";",$materiasComunesCursoActual_);
	$num=count($materiasComunesCursoActual);
	for($i=0;$i<$num;$i++){
		$pdf->Cell(19,$interlineadoOpt,$materiasComunesCursoActual[$i],0,1,'L');
	}
	
	#Las materias de Opción para 3º y 4º

	if($variable=='E3' || $variable=='E4' ||$variable=='B1'){
		$pdf->SetFont('Arial','B',9);
		$pdf->Ln(2);
		$pdf->SetX($pdf->GetX()+10);
		$pdf->Cell(15,3,'Materias de Opción',0,0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',8);
		#Hay Matemáticas?
		$pdf->Cell(19,3,$matematicas_ca,0,1,'L');
		#echo $materiasOpcion_ca;
		$materiasOpcion=explode(";",$materiasOpcion_ca);
		$num=count($materiasOpcion);
		for($i=0;$i<$num;$i++){
			//$pdf->setX($pdf->GetX()+102);
			$pdf->Cell(19,$interlineadoOpt,$materiasOpcion[$i],0,1,'L');
		}
	}
	$pdf->SetY($altAvisoAsignaturas+1);
	$pdf->SetFont('Arial','B',8);
	$pdf->MultiCell(95,4,'En caso de repetir curso HA SOLICITADO matricularse en estas materias',0,'L');
	$pdf->SetFont('Arial','',9);
	$pdf->SetXY(11,$altAsignaturas+2);
	
	#Ponemos las optativas del curso que repite
	$pdf->SetFont('Arial','B',8);
	$pdf->SetX($pdf->GetX()+51);
	$pdf->Cell(19,4,'Materias Optativas',0,0,'C');
	$pdf->Ln();
	$pdf->SetX($pdf->GetX()+51);
	$pdf->Cell(19,4,'Por orden de selección',0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','',8);
	$materiasOptativasCursoActual=explode(";",$materiasOptativasCursoActual_);
	$num=count($materiasOptativasCursoActual);
	
	for($i=0;$i<$num;$i++){
		$pdf->setX(51);
		$pdf->Cell(19,$interlineadoOpt,$materiasOptativasCursoActual[$i],0,1,'L');
	}

	$pdf->Ln();
	#Por último, RELIGIÓN
	if ($variable!='B1'){
		$pdf->SetFont('Arial','B',9);
		$pdf->SetX($pdf->GetX()+51);
		$pdf->Cell(19,4,'Religión u otras',0,0,'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);

		$pdf->setX(51);
		$pdf->Cell(19,3,$religion_ca,0,1,'L');
	}
	#Comenzamos el curso al que promociona
	$pdf->SetXY(107,$altAsignaturas+2);
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(30,6,$curso,1,0,'C');
	
	$pdf->Ln();
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(107,$altAsignaturas+2);
	$pdf->Ln();

	#Ponemos las materias comunes del curso que promociona
	$materiasComunesCurso=explode(";",$materiasComunesCurso_);
	$pdf->SetX($pdf->GetX()+102);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(19,5,'Materias Comunes',0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','',8);
	$num=count($materiasComunesCurso);
	for($i=0;$i<$num;$i++){
		$pdf->SetX(107);
		$pdf->Cell(19,$interlineadoOpt,$materiasComunesCurso[$i],0,1,'L');	
	}
	$pdf->Ln();
	if($variable=='E2' || $variable=='E3' || $variable=='E4' || $variable=='B1'){
		$pdf->SetFont('Arial','B',9);
		$pdf->SetX($pdf->GetX()+102);
		$pdf->Cell(19,4,'Materias de Opción',0,0,'C');
		$pdf->Ln(5);
			$pdf->SetFont('Arial','',8);
			$pdf->SetX($pdf->GetX()+102);
			$pdf->Cell(19,3,$matematicas,0,1,'L');
	//	
		$materiasOpcion=explode(";",$materiasOpcion_);
		$num=count($materiasOpcion);
		for($i=0;$i<$num;$i++){
			$pdf->setX($pdf->GetX()+102);
			$pdf->Cell(19,$interlineadoOpt,$materiasOpcion[$i],0,1,'L');
		}
	}
	#Ponemos optativas del curso al que promociona
	$pdf->SetXY(11,$altAsignaturas+2);
	$pdf->SetFont('Arial','B',8);
	$pdf->SetX($pdf->GetX()+151);
	$pdf->Cell(19,4,'Materias Optativas',0,0,'C');
	$pdf->Ln();
	$pdf->SetX($pdf->GetX()+151);
	$pdf->Cell(19,4,'Por orden de selección',0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','',8);
	$materiasOptativasCurso=explode(";",$materiasOptativasCurso_);
	$num=count($materiasOptativasCurso);
	for($i=0;$i<$num;$i++){
		$pdf->setX(151);
		$pdf->Cell(19,$interlineadoOpt,$materiasOptativasCurso[$i],0,1,'L');
	}
	$pdf->Ln(5);

	if ($variable=='E1' || $variable=='E2'|| $variable=='E3'){
		$pdf->SetFont('Arial','B',9);
		$pdf->SetX($pdf->GetX()+151);
		$pdf->Cell(19,4,'Religión u otras',0,0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',8);
		$pdf->setX(151);
		$pdf->Cell(19,3,$religion,0,1,'L');
	}

		$pdf->SetY($altAvisoAsignaturas+1);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetX(107);
		$pdf->MultiCell(95,4,'En caso de promocionar al siguiente curso HA SOLICITADO matricularse en estas materias',0,'L');
		$pdf->SetFont('Arial','',8);
		$y_aut=$pdf->GetY()+13;
		$pdf->SetXY(107,$altAsignaturas+2);

}else{ //Vamos con los alumnos que no repiten

	$pdf->Rect(9,$altAsignaturas,190,$altRectangulo);
	$pdf->SetXY(20,$altAsignaturas+2);
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(30,6,$curso,1,0,'C');
	
	$pdf->Ln();
	$pdf->SetFont('Arial','',10);
	$pdf->SetXY(107,$altAsignaturas+2);
	$pdf->Ln();

	#Ponemos las materias comunes del curso que promociona
	$materiasComunesCurso=explode(";",$materiasComunesCurso_);
	$pdf->SetX($pdf->GetX()+10);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(19,5,'Materias Comunes',0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','',10);
	$num=count($materiasComunesCurso);
	for($i=0;$i<$num;$i++){
		$pdf->SetX(20);
		$pdf->Cell(19,$interlineadoOptPromociona,$materiasComunesCurso[$i],0,1,'L');	
	}
	
	#Ponemos optativas del curso al que promociona
	$pdf->SetXY(11,$altAsignaturas+2);
	$pdf->SetFont('Arial','B',9);
	$pdf->SetX($pdf->GetX()+151);
	$pdf->Cell(19,4,'Materias Optativas',0,0,'C');
	$pdf->Ln();
	$pdf->SetX($pdf->GetX()+151);
	$pdf->Cell(19,4,'Por orden de selección',0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','',8);
	$materiasOptativasCurso=explode(";",$materiasOptativasCurso_);
	$num=count($materiasOptativasCurso);
	for($i=0;$i<$num;$i++){
		$pdf->setX(151);
		$pdf->Cell(19,$interlineadoOpt,$materiasOptativasCurso[$i],0,1,'L');
	}
	$pdf->SetXY(11,$altAsignaturas+2);
	//if($variable=='E2'){ 
		//if($variable=='E3'){ 
			if($variable=='E2' || $variable=='E3' || $variable=='E4' || $variable=='B1'){
				#Las materias de OPCIÓN
				$pdf->SetFont('Arial','B',9);
				$pdf->SetX($materiasOpcionPromociona);
				$pdf->Cell(19,4,'Materias de Opción',0,0,'C');
				$pdf->Ln(5);
				$pdf->SetFont('Arial','',9);
				#Si se eligen Matemáticas aquí.	
				$pdf->setX($materiasOpcionPromociona);
				if($variable=='E2' || $variable=='E3'){
					$pdf->Cell(19,3,$matematicas,0,1,'L');
					$pdf->Ln(3);
				}
				$materiasOpcion=explode(";",$materiasOpcion_);
				$num=count($materiasOpcion);
				for($i=0;$i<$num;$i++){
					$pdf->setX($materiasOpcionPromociona);
					$pdf->Cell(19,$interlineadoOptPromociona,$materiasOpcion[$i],0,1,'L');
				}
				$pdf->Ln(5);
			}
		//}
	//}

	if($variable!='B1'){
		if($variable!='E4'){
			$pdf->SetFont('Arial','B',9);
			$pdf->setX($materiasOpcionPromociona);
			$pdf->Cell(19,4,'Religión u Otras',0,0,'C');
			$pdf->Ln(5);
		}
	}
	$pdf->SetFont('Arial','',9);
	$pdf->setX($materiasOpcionPromociona);

	$pdf->Cell(19,3,$religion,0,1,'L');

	$pdf->SetY($altAvisoAsignaturas+1);
	$pdf->SetFont('Arial','B',11);
	$pdf->SetX(15);
	$pdf->MultiCell(95,4,'HA SOLICITADO matricularse en estas materias',0,'L');
	$pdf->SetFont('Arial','',8);
	$y_aut=$pdf->GetY()+13;
	$pdf->SetXY(107,$altAsignaturas+2);
}

$pdf->SetXY(13,$altAutorizaciones-2);

//Autorizaciones
$pdf->SetFont('Times','',10);
$pdf->MultiCell(0,3.5,$autorizacionReligion,0);
$pdf->Ln();
$pdf->SetX(9);
$pdf->Cell(4,$altoCelda,$mAutorizacionTraslado,1,0);
$pdf->MultiCell(0,3.5,$autorizacionTraslado,0);
$pdf->Ln();
$pdf->SetX(9);
$pdf->Cell(4,$altoCelda,$mAutorizacionFotos,1,0);
$pdf->MultiCell(0,3.5,$autorizacionFotos,0);
$pdf->Ln();

$pdf->SetX(9);
$pdf->Cell(4,$altoCelda,$mAutorizacionParacetamol,1,0);
$pdf->MultiCell(0,3.5,$autorizacionParacetamol,0);
$pdf->Ln();
$pdf->SetX(9);
$pdf->Cell(4,$altoCelda,'X',1,0);
$pdf->MultiCell(0,3.5,$avisoReglamento,0);

$pdf->Ln();
$pdf->SetX(180);
$pdf->Cell(20, $altoCelda, $fecha , 0, 0, "R");

$pdf->SetXY(13,266);
$pdf->SetFont('Times','',10);
$pdf->Cell(35, $altoCelda, $firmaM , 0, 0, "L");
$pdf->SetX($pdf->GetX()+33);
$pdf->Cell(35, $altoCelda, $firmaP , 0, 0, "L");
$pdf->SetX($pdf->GetX()+33);
$pdf->Cell(35, $altoCelda, $firmaA , 0, 0, "L");
$pdf->SetXY(160,272);
$pdf->SetFont('Times','',12);
$pdf->Cell(40, $altoCelda, $ejemplar, 0, 0, "R");
}

$pdf->AddPage();
$pdf->Image('./images/ampa.png');
$fichero=$pdf->Output();

/*require('fpdf_merge.php');

$merge = new FPDF_Merge();
$merge->add('doc.pdf');
$merge->add('ampa.pdf');
$merge->output();
*/ 
?>
