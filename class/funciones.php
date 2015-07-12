<?php
$optativasE1="E1RLC,E1RMT,E1FR,E1TMU";
$optativasE2="E2RLC,E2RMT,E2FR,E2IC";
$optativasE3="E3AMT,E3CUC,E3FR,E3IAEE";
$optativasE4="";
$optativasB1="";
$optativasB2="";

##Auxiliares

	function xnoMysql($date) {
		list($dia, $mes, $anno) = explode("/", $date);
		return $anno.'-'.$mes.'-'.$dia; 
	}
	
	function fechaXno($date) {
		list($anno, $mes, $dia) = explode("-", $date);
		return $dia.'-'.$mes.'-'.$anno; 
	}

#Asignar Optativas de los alumnos.

function conecction($dsn, $user, $pass){
	try {
	$bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	return $bdd;
	} catch(Exception $e) {
		exit('Unable to connect to database.');
		return false;
	}
}
	
function optativasPorNivel($nivel){ //REcoge las constantes definidas previamente y devuelve las necesarias para la tarea
	global $optativasE1,$optativasE2,$optativasE3,$optativasE4,$optativasB1,$optativasB2;
	if($nivel=='E1'){
		$optativas=$optativasE1;
	}else if($nivel=='E2'){
		$optativas=$optativasE2;
	}else if($nivel=='E3'){
		$optativas=$optativasE3;
	}else if($nivel=='E4'){
		$optativas=$optativasE4;
	}else if($nivel=='B1'){
		$optativas=$optativasB1;
	}else if($nivel=='B2'){
		$optativas=$optativasB2;
	}
	return $optativas;	
}

function averiguaGrupos($dsn, $user, $pass, $nivel){
	global $optativasE1,$optativasE2,$optativasE3,$optativasE4,$optativasB1,$optativasB2;

		$bdd=conecction($dsn, $user, $pass);
		$tabla='matriculacion';

		$optativas=optativasPorNivel($nivel);
		$optativas = explode(",", $optativas);
		$num=count($optativas);
		
		if($nivel=='E1'){
			$sql="SELECT CONCAT_WS( ',',AAPELLIDOS, ANOMBRE ) as ALUMNO, codigo, ".$optativasE1." from $tabla WHERE (E1VE='1' || E1REL='1');";
		}else if($nivel=='E2'){
			$sql="SELECT CONCAT_WS( ',',AAPELLIDOS, ANOMBRE ) as ALUMNO, codigo, ".$optativasE2." from $tabla WHERE (E2HCR='1' || E2REL='1' || E2MAE='1');";
		}else if($nivel=='E3'){
			$sql="SELECT CONCAT_WS( ',',AAPELLIDOS, ANOMBRE ) as ALUMNO, codigo, ".$optativasE3." from $tabla WHERE (E3VE='1' || E3REL='1');";
		}
		
		$stmt = $bdd->prepare($sql);
		$stmt->execute();
		$Out='';
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$Out.='<p>';
			$Out.='<div id="nombre">'.$row['ALUMNO'].'</div>';
			for ($i=0;$i<$num;$i++){
				$seleccion=($row[$optativas[$i]]=='1') ? 'class="seleccion"' : 'class="nada"';
				$Out.='<button id="'.$row['codigo'].'_'.$optativas[$i].'"'.$seleccion.' value="'.$row['codigo'].'_'.$optativas[$i].'">'.$optativas[$i].'</button>';
			}
			$Out.="</p>";
		}
		echo $Out;
}

function asignaOptativa($dsn, $user, $pass, $optativa){
	#$optativa es una cadena que contiene [0] el codigo y [1] la asignatura asignada
	global $optativasE1,$optativasE2,$optativasE3,$optativasE4,$optativasB1,$optativasB2;
	$tabla='matriculacion';
	$bdd=conecction($dsn, $user, $pass);
	$optativa=explode('_',$optativa);	


	$nivel=substr($optativa[1], 0, 2);

	$nombreOptativas=optativasPorNivel($nivel);

	$nombreOptativas=explode(',',$nombreOptativas);
	$num=count($nombreOptativas);
	
	$sql="UPDATE $tabla SET ".$nombreOptativas[0]."=''";
	for($i=1;$i<$num;$i++){
		$sql.=",".$nombreOptativas[$i]."=''";
	}
	$sql.=" WHERE codigo='".$optativa[0]."';";
	$bdd->query($sql);
	
	
	$sql="UPDATE $tabla SET ".$optativa[1]."='1' WHERE codigo='".$optativa[0]."'";
	echo $sql;
	$bdd->query($sql);
}



#Impresión

function ordenarOptativasE1($materia){
	if($materia=='E1FR'){
		return "Francés";
	}else if($materia=='E1TMU'){
		return "Taller de Música";
	}		
}

function ordenarOptativasE2($materia){
	if($materia=='E2FR'){
		return "Francés";
	}else if($materia=='E2IC'){
		return "Imagen y Comunicación";
	}
}


#Traducción de nombres
function ordenarOptativasE3($materia){
		if($materia=='E3AMT'){
			return "Ampliación de Matemáticas";
		}else if($materia=='E3IAEE'){
			return "Inic.Emprendedora y Empr.";
		}else if($materia=='E3CUC'){
			return "Cultura Clásica";			
		}else if($materia=='E3FR'){
			return "Francés";
		}
}

function ordenarOptativasE4($materia){
	if($materia=='E4AMT'){
		return "Ampliación de Matemáticas";
	}else if($materia=='E4IE'){
		return "Iniciativa Emprendedora";
	}else if($materia=='E4CUC'){
		return "Cultura Clásica";			
	}else if($materia=='E4LITU'){
		return "Literatura Universal";
	}else if($materia=='E4IEE'){
		return "Inici. a la Elect. y Electrónica";
	}else if($materia=='E4FR'){
		return "Francés";
	}else if($materia=='E4AMB'){
		return "Ampliación de Biología";
	}else if($materia=='E4AFQ'){
		return "Ampliación de Fís. y Quími.";
	}
}

function optativasB1($filas){
	$fila['B1REL']=$filas['B1REL'];
	$fila['B1TICI']=$filas['B1TICI'];
	$fila['B1FR']=$filas['B1FR'];
	$fila['B1CC']=$filas['B1CC'];
	$fila['B1DAI']=$filas['B1DAI'];
	$fila['B1APL']=$filas['B1APL'];
	
	#Comprobar que está vacía y no poner aquí.
	if($filas['B1TINI']!=''){
		$fila['B1TINI']=$filas['B1TINI'];	
	}
	return $fila;
}
function ordenarOptativasB1($materia){

	if($materia=='B1REL'){
		return "Religión";
	}else if($materia=='B1TICI'){
		return "Tecn. Inform. y Comunic. I";
	}else if($materia=='B1FR'){
		return "Francés I";			
	}else if($materia=='B1CC'){
		return "Cultura Científica";
	}else if($materia=='B1TINI'){
		return "Tecn. Industrial I";
	}else if($materia=='B1APL'){
		return "Anatomía Aplicada";
	}else if($materia=='B1DAI'){
		return "Dibujo Artístico I";
	}
}

function ordenarOptativasB2($materia){
	
	if($materia=='B2TINII'){
		return "Tecn. Industrial II";
	}else if($materia=='B2QUI'){
		return "Química";
	}else if($materia=='B2PSI'){
		return "Psicología";			
	}else if($materia=='B2AINGII'){
		return "Ampliación de Inglés";
	}else if($materia=='B2FRA'){
		return "Francés";
	}else if($materia=='B2FGA'){
		return "Fundam. de Admón y Gestión";
	}else if($materia=='B2GEOL'){
		return "Geología";
	}
}

function encontrarMateriasOpcion_ca($filas,$variable){
	$materias='';
	if ($variable=='E4'){
		
		if($filas['E4EPV']=='1'){
			$materias.='** Edu. Plástica y Visual;';
		}
		if($filas['E4TEC']=='1'){
			$materias.='** Tecnologías;';
		}
		if($filas['E4MUS']=='1'){
			$materias.='** Música;';
		}
		if($filas['E4LAT']=='1'){
			$materias.='** Latín;';
		}
		if($filas['E4FRA']=='1'){
			$materias.='** Francés;';
		}
		if($filas['E4INF']=='1'){
			$materias.='** Informática;';
		}
		if($filas['E4BYG']=='1'){
			$materias.='** Biología y Geología;';
		}
		if($filas['E4FYQ']=='1'){
			$materias.='** Fisica y Química;';
		}
		
	}else if ($variable=='B1'){
		if($filas['B1MCSI']=='1'){
			$materias.='** Matem. C. Sociales I;';
		}
		if($filas['B1LATI']=='1'){
			$materias.='** Latín I;';
		}
		if($filas['B1HMC']=='1'){
			$materias.='** H. Mundo Contemporáneo;';
		}
		if($filas['B1LITU']=='1'){
			$materias.='** Literat. Universal;';
		}
		if($filas['B1GRI']=='1'){
			$materias.='** Griego I;';
		}
		if($filas['B1ECO']=='1'){
			$materias.='** Economía;';
		}
		if($filas['B1MATI']=='1'){
			$materias.='** Matemáticas I;';
		}
		if($filas['B1FYQ']=='1'){
			$materias.='** Fisica y Química;';
		}
		if($filas['B1BYG']=='1'){
			$materias.='** Biología y Geología;';
		}
		if($filas['B1DT']=='1'){
			$materias.='** Dibujo Técnico I;';
		}
	}else if ($variable=='B2'){
		if($filas['B2HART']=='1'){
			$materias.='** Historia del Arte;';
		}
		if($filas['B2GEO']=='1'){
			$materias.='** Geografía;';
		}
		if($filas['B2EEM']=='1'){
			$materias.='** Economía y Admón. Empresas;';
		}
		if($filas['B2LATII']=='1'){
			$materias.='** LATÍN II;';
		}
		if($filas['B2GRII']=='1'){
			$materias.='** Griego II;';
		}
		if($filas['B2LITU']=='1'){
			$materias.='** Literat. Universal;';
		}
		if($filas['B2MCSII']=='1'){
			$materias.='** Matemáticas C.Sociales II;';
		}
		if($filas['B2MATII']=='1'){
			$materias.='** Matemáticas II;';
		}
		if($filas['B2BIO']=='1'){
			$materias.='** Biología;';
		}
		if($filas['B2FIS']=='1'){
			$materias.='** Física;';
		}
		if($filas['B2GEOL']=='1'){
			$materias.='** Geología;';
		}
		if($filas['B2DTII']=='1'){
			$materias.='** Dibujo Técnico II;';
		}	
		if($filas['B2CTME']=='1'){
			$materias.='** C.Tierra y del Medioambiente;';
		}
	}
	return $materias;
}

function encontrarMateriasOpcion($filas,$variable){
	$materias='';
	if ($variable=='E3'){	
		if($filas['E4EPV']=='1'){
			$materias.='** Edu. Plástica y Visual;';
		}
		if($filas['E4TEC']=='1'){
			$materias.='** Tecnologías;';
		}
		if($filas['E4MUS']=='1'){
			$materias.='** Música;';
		}
		if($filas['E4LAT']=='1'){
			$materias.='** Latín;';
		}
		if($filas['E4FRA']=='1'){
			$materias.='** Francés;';
		}
		if($filas['E4INF']=='1'){
			$materias.='** Informática;';
		}
		if($filas['E4BYG']=='1'){
			$materias.='** Biología y Geología;';
		}
		if($filas['E4FYQ']=='1'){
			$materias.='** Fisica y Química;';
		}
	}else if ($variable=='E4'){
		if($filas['B1MCSI']=='1'){
			$materias.='** Matem. C. Sociales I;';
		}
		if($filas['B1LATI']=='1'){
			$materias.='** Latín I;';
		}
		if($filas['B1HMC']=='1'){
			$materias.='** H. Mundo Contemporáneo;';
		}
		if($filas['B1LITU']=='1'){
			$materias.='** Literat. Universal;';
		}
		if($filas['B1GRI']=='1'){
			$materias.='** Griego I;';
		}
		if($filas['B1ECO']=='1'){
			$materias.='** Economía;';
		}
		if($filas['B1MATI']=='1'){
			$materias.='** Matemáticas I;';
		}
		if($filas['B1FYQ']=='1'){
			$materias.='** Fisica y Química;';
		}
		if($filas['B1BYG']=='1'){
			$materias.='** Biología y Geología;';
		}
		if($filas['B1DT']=='1'){
			$materias.='** Dibujo Técnico I;';
		}
	}else if ($variable=='B1'){
		if($filas['B2MCSII']=='1'){
			$materias.='** Matemáticas C.Sociales II;';
		}
		if($filas['B2LATII']=='1'){
			$materias.='** LATÍN II;';
		}
		if($filas['B2GEO']=='1'){
			$materias.='** Geografía;';
		}
		if($filas['B2GRII']=='1'){
			$materias.='** Griego II;';
		}
		if($filas['B2LITU']=='1'){
			$materias.='** Literat. Universal;';
		}
		if($filas['B2MATII']=='1'){
			$materias.='** Matemáticas II;';
		}
		if($filas['B2BIO']=='1'){
			$materias.='** Biología;';
		}
		if($filas['B2FIS']=='1'){
			$materias.='** Física;';
		}
		if($filas['B2GEOL']=='1'){
			$materias.='** Geología;';
		}
		if($filas['B2DTII']=='1'){
			$materias.='** Dibujo Técnico II;';
		}	
		if($filas['B2HART']=='1'){
			$materias.='** Historia del Arte;';
		}
		if($filas['B2ELE']=='1'){
			$materias.='** Elect. y Electrotecnia;';
		}
		if($filas['B2EEM']=='1'){
			$materias.='** Economía y Admón. Empresas;';
		}

		if($filas['B2CTM']=='1'){
			$materias.='** C.Tierra y del Medioambiente;';
		}
	}
	return $materias;		
}


function devuelveLocalidad($dato){
	if($dato=="1230"){$datoLocalidad="Rivas-Vaciamadrid";}
	else if($dato=="0014"){$datoLocalidad="Acebeda (La)";}
	else if($dato=="0029"){$datoLocalidad="Ajalvir";}
	else if($dato=="0035"){$datoLocalidad="Alameda del Valle";}
	else if($dato=="0040"){$datoLocalidad="Alamo (El)";}
	else if($dato=="0053"){$datoLocalidad="Alcalá de Henares";}
	else if($dato=="0066"){$datoLocalidad="Alcobendas";}
	else if($dato=="0072"){$datoLocalidad="Alcorcón";}
	else if($dato=="0088"){$datoLocalidad="Aldea del Fresno";}
	else if($dato=="0091"){$datoLocalidad="Algete";}
	else if($dato=="0105"){$datoLocalidad="Alpedrete";}
	else if($dato=="0112"){$datoLocalidad="Ambite";}
	else if($dato=="0127"){$datoLocalidad="Anchuelo";}
	else if($dato=="0133"){$datoLocalidad="Aranjuez";}
	else if($dato=="0148"){$datoLocalidad="Arganda del Rey";}
	else if($dato=="0151"){$datoLocalidad="Arroyomolinos";}
	else if($dato=="0164"){$datoLocalidad="Atazar (El)";}
	else if($dato=="0170"){$datoLocalidad="Batres";}
	else if($dato=="0186"){$datoLocalidad="Becerril de la Sierra";}
	else if($dato=="0199"){$datoLocalidad="Belmonte de Tajo";}
	else if($dato=="0210"){$datoLocalidad="Berrueco (El)";}
	else if($dato=="0203"){$datoLocalidad="Berzosa del Lozoya";}
	else if($dato=="0225"){$datoLocalidad="Boadilla del Monte";}
	else if($dato=="0231"){$datoLocalidad="Boalo (El)";}
	else if($dato=="0246"){$datoLocalidad="Braojos";}
	else if($dato=="0259"){$datoLocalidad="Brea de Tajo";}
	else if($dato=="0262"){$datoLocalidad="Brunete";}
	else if($dato=="0278"){$datoLocalidad="Buitrago del Lozoya";}
	else if($dato=="0284"){$datoLocalidad="Bustarviejo";}
	else if($dato=="0297"){$datoLocalidad="Cabanillas de la Sierra";}
	else if($dato=="0301"){$datoLocalidad="Cabrera (La)";}
	else if($dato=="0318"){$datoLocalidad="Cadalso de los Vidrios";}
	else if($dato=="0323"){$datoLocalidad="Camarma de Esteruelas";}
	else if($dato=="0339"){$datoLocalidad="Campo Real";}
	else if($dato=="0344"){$datoLocalidad="Canencia";}
	else if($dato=="0357"){$datoLocalidad="Carabaña";}
	else if($dato=="0360"){$datoLocalidad="Casarrubuelos";}
	else if($dato=="0376"){$datoLocalidad="Cenicientos";}
	else if($dato=="0382"){$datoLocalidad="Cercedilla";}
	else if($dato=="0395"){$datoLocalidad="Cervera de Buitrago";}
	else if($dato=="0513"){$datoLocalidad="Chapinería";}
	else if($dato=="0528"){$datoLocalidad="Chinchón";}
	else if($dato=="0409"){$datoLocalidad="Ciempozuelos";}
	else if($dato=="0416"){$datoLocalidad="Cobeña";}
	else if($dato=="0468"){$datoLocalidad="Collado Mediano";}
	else if($dato=="0474"){$datoLocalidad="Collado Villalba";}
	else if($dato=="0455"){$datoLocalidad="Colmenar Viejo";}
	else if($dato=="0437"){$datoLocalidad="Colmenar de Oreja";}
	else if($dato=="0421"){$datoLocalidad="Colmenar del Arroyo";}
	else if($dato=="0442"){$datoLocalidad="Colmenarejo";}
	else if($dato=="0480"){$datoLocalidad="Corpa";}
	else if($dato=="0493"){$datoLocalidad="Coslada";}
	else if($dato=="0506"){$datoLocalidad="Cubas de la Sagra";}
	else if($dato=="0534"){$datoLocalidad="Daganzo de Arriba";}
	else if($dato=="0549"){$datoLocalidad="Escorial (El)";}
	else if($dato=="0552"){$datoLocalidad="Estremera";}
	else if($dato=="0565"){$datoLocalidad="Fresnedillas de la Oliva";}
	else if($dato=="0571"){$datoLocalidad="Fresno de Torote";}
	else if($dato=="0587"){$datoLocalidad="Fuenlabrada";}
	else if($dato=="0590"){$datoLocalidad="Fuente el Saz de Jarama";}
	else if($dato=="0604"){$datoLocalidad="Fuentidueña de Tajo";}
	else if($dato=="0611"){$datoLocalidad="Galapagar";}
	else if($dato=="0626"){$datoLocalidad="Garganta de los Montes";}
	else if($dato=="0632"){$datoLocalidad="Gargantilla del Lozoya y Pinilla de Buitrago";}
	else if($dato=="0647"){$datoLocalidad="Gascones";}
	else if($dato=="0650"){$datoLocalidad="Getafe";}
	else if($dato=="0663"){$datoLocalidad="Griñón";}
	else if($dato=="0679"){$datoLocalidad="Guadalix de la Sierra";}
	else if($dato=="0685"){$datoLocalidad="Guadarrama";}
	else if($dato=="0698"){$datoLocalidad="Hiruela (La)";}
	else if($dato=="0702"){$datoLocalidad="Horcajo de la Sierra-Aoslos";}
	else if($dato=="0719"){$datoLocalidad="Horcajuelo de la Sierra";}
	else if($dato=="0724"){$datoLocalidad="Hoyo de Manzanares";}
	else if($dato=="0730"){$datoLocalidad="Humanes de Madrid";}
	else if($dato=="0745"){$datoLocalidad="Leganés";}
	else if($dato=="0758"){$datoLocalidad="Loeches";}
	else if($dato=="0761"){$datoLocalidad="Lozoya";}
	else if($dato=="9015"){$datoLocalidad="Lozoyuela-Navas-Sieteiglesias";}
	else if($dato=="0783"){$datoLocalidad="Madarcos";}
	else if($dato=="0796"){$datoLocalidad="Madrid";}
	else if($dato=="0800"){$datoLocalidad="Majadahonda";}
	else if($dato=="0822"){$datoLocalidad="Manzanares el Real";}
	else if($dato=="0838"){$datoLocalidad="Meco";}
	else if($dato=="0843"){$datoLocalidad="Mejorada del Campo";}
	else if($dato=="0856"){$datoLocalidad="Miraflores de la Sierra";}
	else if($dato=="0869"){$datoLocalidad="Molar (El)";}
	else if($dato=="0875"){$datoLocalidad="Molinos (Los)";}
	else if($dato=="0881"){$datoLocalidad="Montejo de la Sierra";}
	else if($dato=="0894"){$datoLocalidad="Moraleja de Enmedio";}
	else if($dato=="0908"){$datoLocalidad="Moralzarzal";}
	else if($dato=="0915"){$datoLocalidad="Morata de Tajuña";}
	else if($dato=="0920"){$datoLocalidad="Móstoles";}
	else if($dato=="0936"){$datoLocalidad="Navacerrada";}
	else if($dato=="0941"){$datoLocalidad="Navalafuente";}
	else if($dato=="0954"){$datoLocalidad="Navalagamella";}
	else if($dato=="0967"){$datoLocalidad="Navalcarnero";}
	else if($dato=="0973"){$datoLocalidad="Navarredonda y San Mamés";}
	else if($dato=="0992"){$datoLocalidad="Navas del Rey";}
	else if($dato=="1006"){$datoLocalidad="Nuevo Baztán";}
	else if($dato=="1013"){$datoLocalidad="Olmeda de las Fuentes";}
	else if($dato=="1028"){$datoLocalidad="Orusco de Tajuña";}
	else if($dato=="1049"){$datoLocalidad="Paracuellos de Jarama";}
	else if($dato=="1065"){$datoLocalidad="Parla";}
	else if($dato=="1071"){$datoLocalidad="Patones";}
	else if($dato=="1087"){$datoLocalidad="Pedrezuela";}
	else if($dato=="1090"){$datoLocalidad="Pelayos de la Presa";}
	else if($dato=="1104"){$datoLocalidad="Perales de Tajuña";}
	else if($dato=="1111"){$datoLocalidad="Pezuela de las Torres";}
	else if($dato=="1126"){$datoLocalidad="Pinilla del Valle";}
	else if($dato=="1132"){$datoLocalidad="Pinto";}
	else if($dato=="1147"){$datoLocalidad="Piñuecar-Gandullas";}
	else if($dato=="1150"){$datoLocalidad="Pozuelo de Alarcón";}
	else if($dato=="1163"){$datoLocalidad="Pozuelo del Rey";}
	else if($dato=="1179"){$datoLocalidad="Prádena del Rincón";}
	else if($dato=="1185"){$datoLocalidad="Puebla de la Sierra";}
	else if($dato=="9020"){$datoLocalidad="Puentes Viejas";}
	else if($dato=="1198"){$datoLocalidad="Quijorna";}
	else if($dato=="1202"){$datoLocalidad="Rascafría";}
	else if($dato=="1219"){$datoLocalidad="Redueña";}
	else if($dato=="1224"){$datoLocalidad="Ribatejada";}
	else if($dato=="1245"){$datoLocalidad="Robledillo de la Jara";}
	else if($dato=="1258"){$datoLocalidad="Robledo de Chavela";}
	else if($dato=="1261"){$datoLocalidad="Robregordo";}
	else if($dato=="1277"){$datoLocalidad="Rozas de Madrid (Las)";}
	else if($dato=="1283"){$datoLocalidad="Rozas de Puerto Real";}
	else if($dato=="1296"){$datoLocalidad="San Agustín del Guadalix";}
	else if($dato=="1300"){$datoLocalidad="San Fernando de Henares";}
	else if($dato=="1317"){$datoLocalidad="San Lorenzo de El Escorial";}
	else if($dato=="1338"){$datoLocalidad="San Martín de Valdeiglesias";}
	else if($dato=="1322"){$datoLocalidad="San Martín de la Vega";}
	else if($dato=="1343"){$datoLocalidad="San Sebastián de los Reyes";}
	else if($dato=="1356"){$datoLocalidad="Santa María de la Alameda";}
	else if($dato=="1369"){$datoLocalidad="Santorcaz";}
	else if($dato=="1375"){$datoLocalidad="Santos de la Humosa (Los)";}
	else if($dato=="1381"){$datoLocalidad="Serna del Monte (La)";}
	else if($dato=="1408"){$datoLocalidad="Serranillos del Valle";}
	else if($dato=="1415"){$datoLocalidad="Sevilla la Nueva";}
	else if($dato=="1436"){$datoLocalidad="Somosierra";}
	else if($dato=="1441"){$datoLocalidad="Soto del Real";}
	else if($dato=="1454"){$datoLocalidad="Talamanca de Jarama";}
	else if($dato=="1467"){$datoLocalidad="Tielmes";}
	else if($dato=="1473"){$datoLocalidad="Titulcia";}
	else if($dato=="1489"){$datoLocalidad="Torrejón de Ardoz";}
	else if($dato=="1505"){$datoLocalidad="Torrejón de Velasco";}
	else if($dato=="1492"){$datoLocalidad="Torrejón de la Calzada";}
	else if($dato=="1512"){$datoLocalidad="Torrelaguna";}
	else if($dato=="1527"){$datoLocalidad="Torrelodones";}
	else if($dato=="1533"){$datoLocalidad="Torremocha de Jarama";}
	else if($dato=="1548"){$datoLocalidad="Torres de la Alameda";}
	else if($dato=="9036"){$datoLocalidad="Tres Cantos";}
	else if($dato=="1551"){$datoLocalidad="Valdaracete";}
	else if($dato=="1564"){$datoLocalidad="Valdeavero";}
	else if($dato=="1570"){$datoLocalidad="Valdelaguna";}
	else if($dato=="1586"){$datoLocalidad="Valdemanco";}
	else if($dato=="1599"){$datoLocalidad="Valdemaqueda";}
	else if($dato=="1603"){$datoLocalidad="Valdemorillo";}
	else if($dato=="1610"){$datoLocalidad="Valdemoro";}
	else if($dato=="1625"){$datoLocalidad="Valdeolmos-Alalpardo";}
	else if($dato=="1631"){$datoLocalidad="Valdepiélagos";}
	else if($dato=="1646"){$datoLocalidad="Valdetorres de Jarama";}
	else if($dato=="1659"){$datoLocalidad="Valdilecha";}
	else if($dato=="1662"){$datoLocalidad="Valverde de Alcalá";}
	else if($dato=="1678"){$datoLocalidad="Velilla de San Antonio";}
	else if($dato=="1684"){$datoLocalidad="Vellón (El)";}
	else if($dato=="1697"){$datoLocalidad="Venturada";}
	else if($dato=="1718"){$datoLocalidad="Villa del Prado";}
	else if($dato=="1701"){$datoLocalidad="Villaconejos";}
	else if($dato=="1723"){$datoLocalidad="Villalbilla";}
	else if($dato=="1739"){$datoLocalidad="Villamanrique de Tajo";}
	else if($dato=="1744"){$datoLocalidad="Villamanta";}
	else if($dato=="1757"){$datoLocalidad="Villamantilla";}
	else if($dato=="1782"){$datoLocalidad="Villanueva de Perales";}
	else if($dato=="1760"){$datoLocalidad="Villanueva de la Cañada";}
	else if($dato=="1776"){$datoLocalidad="Villanueva del Pardillo";}
	else if($dato=="1795"){$datoLocalidad="Villar del Olmo";}
	else if($dato=="1809"){$datoLocalidad="Villarejo de Salvanés";}
	else if($dato=="1816"){$datoLocalidad="Villaviciosa de Odón";}
	else if($dato=="1821"){$datoLocalidad="Villavieja del Lozoya";}
	else if($dato=="1837"){$datoLocalidad="Zarzalejo";}
	else if($dato=="9999"){$datoLocalidad="Sin municipio asignado";}
	return $datoLocalidad;
}

function devuelveProvincia($dato){
	if($dato=="28"){$datoProvincia="Madrid";}
	else if($dato=="2"){$datoProvincia="Albacete";}
	else if($dato=="3"){$datoProvincia="Alicante/Alacant";}
	else if($dato=="4"){$datoProvincia="Almería";}
	else if($dato=="1"){$datoProvincia="Araba/Álava";}
	else if($dato=="33"){$datoProvincia="Asturias";}
	else if($dato=="5"){$datoProvincia="Ávila";}
	else if($dato=="6"){$datoProvincia="Badajoz";}
	else if($dato=="7"){$datoProvincia="Balears, Illes";}
	else if($dato=="8"){$datoProvincia="Barcelona";}
	else if($dato=="48"){$datoProvincia="Bizkaia";}
	else if($dato=="9"){$datoProvincia="Burgos";}
	else if($dato=="10"){$datoProvincia="Cáceres";}
	else if($dato=="11"){$datoProvincia="Cádiz";}
	else if($dato=="39"){$datoProvincia="Cantabria";}
	else if($dato=="12"){$datoProvincia="Castellón/Castelló";}
	else if($dato=="51"){$datoProvincia="Ceuta";}
	else if($dato=="13"){$datoProvincia="Ciudad Real";}
	else if($dato=="14"){$datoProvincia="Córdoba";}
	else if($dato=="15"){$datoProvincia="Coruña, A";}
	else if($dato=="16"){$datoProvincia="Cuenca";}
	else if($dato=="20"){$datoProvincia="Gipuzkoa";}
	else if($dato=="17"){$datoProvincia="Girona";}
	else if($dato=="18"){$datoProvincia="Granada";}
	else if($dato=="19"){$datoProvincia="Guadalajara";}
	else if($dato=="21"){$datoProvincia="Huelva";}
	else if($dato=="22"){$datoProvincia="Huesca";}
	else if($dato=="23"){$datoProvincia="Jaén";}
	else if($dato=="24"){$datoProvincia="León";}
	else if($dato=="27"){$datoProvincia="Lugo";}
	else if($dato=="25"){$datoProvincia="Lleida";}
	else if($dato=="29"){$datoProvincia="Málaga";}
	else if($dato=="52"){$datoProvincia="Melilla";}
	else if($dato=="30"){$datoProvincia="Murcia";}
	else if($dato=="31"){$datoProvincia="Navarra";}
	else if($dato=="32"){$datoProvincia="Ourense";}
	else if($dato=="34"){$datoProvincia="Palencia";}
	else if($dato=="35"){$datoProvincia="Palmas, Las";}
	else if($dato=="36"){$datoProvincia="Pontevedra";}
	else if($dato=="26"){$datoProvincia="Rioja, La";}
	else if($dato=="37"){$datoProvincia="Salamanca";}
	else if($dato=="38"){$datoProvincia="Santa Cruz de Tenerelse ife";}
	else if($dato=="40"){$datoProvincia="Segovia";}
	else if($dato=="41"){$datoProvincia="Sevilla";}
	else if($dato=="42"){$datoProvincia="Soria";}
	else if($dato=="43"){$datoProvincia="Tarragona";}
	else if($dato=="44"){$datoProvincia="Teruel";}
	else if($dato=="45"){$datoProvincia="Toledo";}
	else if($dato=="46"){$datoProvincia="Valencia/València";}
	else if($dato=="47"){$datoProvincia="Valladolid";}
	else if($dato=="49"){$datoProvincia="Zamora";}
	else if($dato=="50"){$datoProvincia="Zaragoza";}
return $datoProvincia;
}


function averiguaVariable($etapa,$curso){
	
	if ($etapa=='13'){
		$variable='E'.$curso;
	}else if($etapa=='05'){
		//if($row['MODAL_PERF']=='BHCS'){$variable='BHCS'.$row['CURSO'];}else{$variable='BCT'.$row['CURSO'];}
		$variable='B'.$curso;		
	}else if($etapa=='14'){
		$variable='FPB'.$curso;
	}else if($etapa=='N'){$variable='N';}
	return $variable;
}

?>
