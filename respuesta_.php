<?php
include('./include/configuracion.php');
header('Content-type: text/html; charset=UTF-8');
$codigo='52eo4nm8udrr';
$tabla='matriculacion';
#$codigo=$_POST['codigo'];


#E1RLC;E1RMT;E1FR;E1TMU;
#E1REL;E1VE
#E2RLC;E2RMT;E2FR;#E2IC
#E2REL;E2VE
#E3FR;E3IE;E3AMT;E3DPC;E3CUC
#E3REL;E3VE


 try {
	$bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	} catch(Exception $e) {
	exit('Unable to connect to database.');
 }
 

$sql="SELECT entregado,NMEXPEDIEN,ANOMBRE,AAPELLIDOS,SEXO,ADOMICILIO,FNACIMIENTO,ADNI,ETAPA,CURSO,suspensos,ALOCALIDAD,APROVINCIA,ACP,lug_nac,prov_nac,pais_nac,nacionalidad,MAPELLIDOS,MNOMBRE,MNIF,MDOMICILIO,MLOCALIDAD,MPROVINCIA,MCP,MTELEFONO_F,MTELEFONO_M, EMAIL_MADR,PAPELLIDOS,PNOMBRE,PNIF,PDOMICILIO,PLOCALIDAD,PPROVINCIA,PCP,PTELEFONO_F,PTELEFONO_M, EMAIL_PADR FROM $tabla where codigo='".$codigo."'";
$resultado = $bdd->query($sql);
$count = $resultado->rowCount();
if($count==1){

	foreach ($resultado->fetchAll(PDO::FETCH_ASSOC) as $row);

	if ($row['ETAPA']=='13'){
		$variable='E'.$row['CURSO'];
	}else if($row['ETAPA']=='05'){
		//if($row['MODAL_PERF']=='BHCS'){$variable='BHCS'.$row['CURSO'];}else{$variable='BCT'.$row['CURSO'];}
		$variable='B'.$row['CURSO'];		
	}else if($row['ETAPA']=='14'){
		$variable='FPB'.$row['CURSO'];
	}else if($row['ETAPA']=='N'){$variable='N';}

	$E1_opt1="Francés;Taller de Música";
	$E2_opt1="Francés;Imagen y Comunicación";
	$E3_opt1="Francés;Inic.Emprendedora y Empr.;Ampliación de Matem.;Cultura Clásica";
	$E4_opt1="Ampl.Matemáticas;Ampl.Biología y Geología;Ampl.Física y Quím.;Iniciación a la Elect. y Electrónica;Literatura Universal;Cultura Clásica;Francés;Iniciativa Emprendedora";
	$B1_opt="Cultura Científica;Francés I;Dibujo Artístico I;Anatomía Aplicada;Tec. Inform. Comunicación I;Religión";
	$B1_HCS="Economía;Griego I;Literatura Universal";
	$B1_C="Biología y Geología;Dibujo Técnico";
	$B2_opt1="Francés;Psicología;Ampliación Inglés";



	#####
	###
	#				PARA BORRAR
	###
	#####

	#include('./backend/curso.php');

	#####
	  ###
		#
	  ###
	#####
	if($row['variable']){
	
	}else if($row['variable']){
		
	}
	
	$repetidor=($row['suspensos']>2) ? $repetidor='S' : $repetidor='N';
	$entregado=($row['entregado']==1) ? $entregado='S' : $entregado='N';
	if ($variable=="B2"){$variable="B1";$repetidor="N";}

	if ($variable=="N"){
		$religion="Religión;Valores Éticos";
	}
	if ($variable=="E1" || $variable=="E3"){
		$religion="Religión;H. y C. de las Religiones;Medidas de Atención Educativa";
		$rel_ca="Religión;Valores Éticos";
	}
	if ($variable=="E2" || $variable=="E4"){
		$religion="Religión;Valores Éticos";
		$rel_ca="Religión;H. y C. de las Religiones;Medidas de Atención Educativa";
	}
	if ($variable=='N'){
	$arr = array(
			"success" => true,
			"curso" => $variable,
			"nexpediente" => $row["NMEXPEDIEN"],
			"anombre" => $row["ANOMBRE"],
			"aapellidos" => $row["AAPELLIDOS"],
			"sexo" => $row["SEXO"],
			"fnacimiento" => $row["FNACIMIENTO"],
			"adni" => $row["ADNI"],
			"adomicilio" => $row["ADOMICILIO"],
			"alocalidad" => $row['ALOCALIDAD'],
			"aprovincia" => $row['APROVINCIA'],
			"acp" => $row['ACP'],
			"lug_nac" => $row['lug_nac'],
			"prov_nac" => $row['prov_nac'],
			"pais_nac" => $row['pais_nac'],
			"nacionalidad" => $row['nacionalidad'],
			"telefono1" => $row['TELEFONO1'],
			"telefono2" => $row['TELEFONO2'],
			"mapellidos" => $row['EMAIL_ALUMNO'],
			"mapellidos" => $row['MAPELLIDOS'],
			"mnombre" => $row['MNOMBRE'],
			"mnif" => $row['MNIF'],
			"mdomicilio" => $row['MDOMICILIO'],
			"mlocalidad" => $row['MLOCALIDAD'],
			"mprovincia" => $row['MPROVINCIA'],
			"mcp" => $row['MCP'],
			"mtelefono_f" => $row['MTELEFONO_F'],
			"mtelefono_m" => $row['MTELEFONO_M'],
			"memail" => $row['EMAIL_MADR'],
			"pnombre" => $row['PNOMBRE'],
			"papellidos" => $row['PAPELLIDOS'],
			"pnif" => $row['PNIF'],
			"pdomicilio" => $row['PDOMICILIO'],
			"plocalidad" => $row['PLOCALIDAD'],
			"provincia" => $row['PPROVINCIA'],
			"pcp" => $row['PCP'],
			"ptelefono_f" => $row['PTELEFONO_F'],
			"ptelefono_m" => $row['PTELEFONO_M'],
			"pemail" => $row['EMAIL_PADR'],
			"codigo" => $codigo,
			"optativas1" => $E1_opt1,
			"repetidor" => "N",
			"rel" => $religion,
			"entregado" => $entregado
			);
	}else if($variable=='E1'){
	$arr = array(
			"success" => true,
			"curso" => $variable,
			"nexpediente" => $row["NMEXPEDIEN"],
			"anombre" => $row["ANOMBRE"],
			"aapellidos" => $row["AAPELLIDOS"],
			"sexo" => $row["SEXO"],
			"fnacimiento" => $row["FNACIMIENTO"],
			"adni" => $row["ADNI"],
			"adomicilio" => $row["ADOMICILIO"],
			"alocalidad" => $row['ALOCALIDAD'],
			"aprovincia" => $row['APROVINCIA'],
			"acp" => $row['ACP'],
			"lug_nac" => $row['lug_nac'],
			"prov_nac" => $row['prov_nac'],
			"pais_nac" => $row['pais_nac'],
			"nacionalidad" => $row['nacionalidad'],
			"telefono1" => $row['TELEFONO1'],
			"telefono2" => $row['TELEFONO2'],
			"mapellidos" => $row['EMAIL_ALUMNO'],
			"mapellidos" => $row['MAPELLIDOS'],
			"mnombre" => $row['MNOMBRE'],
			"mnif" => $row['MNIF'],
			"mdomicilio" => $row['MDOMICILIO'],
			"mlocalidad" => $row['MLOCALIDAD'],
			"mprovincia" => $row['MPROVINCIA'],
			"mcp" => $row['MCP'],
			"mtelefono_f" => $row['MTELEFONO_F'],
			"mtelefono_m" => $row['MTELEFONO_M'],
			"memail" => $row['EMAIL_MADR'],
			"papellidos" => $row['PAPELLIDOS'],
			"pnombre" => $row['PNOMBRE'],
			"pnif" => $row['PNIF'],
			"pdomicilio" => $row['PDOMICILIO'],
			"plocalidad" => $row['PLOCALIDAD'],
			"provincia" => $row['PPROVINCIA'],
			"pcp" => $row['PCP'],
			"ptelefono_f" => $row['PTELEFONO_F'],
			"ptelefono_m" => $row['PTELEFONO_M'],
			"pemail" => $row['EMAIL_PADR'],
			"codigo" => $codigo,
			"repetidor" => $repetidor,
			"optativas1" => $E2_opt1,
			"rel" => $religion,
			"optativas1_ca" => $E1_opt1,
			"rel_ca" => $rel_ca,
			"entregado" => $entregado
			);
	}
	else if($variable=='E2'){
	$arr = array(
			"success" => true,
			"curso" => $variable,
			"nexpediente" => $row["NMEXPEDIEN"],
			"anombre" => $row["ANOMBRE"],
			"aapellidos" => $row["AAPELLIDOS"],
			"sexo" => $row["SEXO"],
			"fnacimiento" => $row["FNACIMIENTO"],
			"adni" => $row["ADNI"],
			"adomicilio" => $row["ADOMICILIO"],
			"alocalidad" => $row['ALOCALIDAD'],
			"aprovincia" => $row['APROVINCIA'],
			"acp" => $row['ACP'],
			"lug_nac" => $row['lug_nac'],
			"prov_nac" => $row['prov_nac'],
			"pais_nac" => $row['pais_nac'],
			"nacionalidad" => $row['nacionalidad'],
			"telefono1" => $row['TELEFONO1'],
			"telefono2" => $row['TELEFONO2'],
			"mapellidos" => $row['EMAIL_ALUMNO'],
			"mapellidos" => $row['MAPELLIDOS'],
			"mnombre" => $row['MNOMBRE'],
			"mnif" => $row['MNIF'],
			"mdomicilio" => $row['MDOMICILIO'],
			"mlocalidad" => $row['MLOCALIDAD'],
			"mprovincia" => $row['MPROVINCIA'],
			"mcp" => $row['MCP'],
			"mtelefono_f" => $row['MTELEFONO_F'],
			"mtelefono_m" => $row['MTELEFONO_M'],
			"memail" => $row['EMAIL_MADR'],
			"papellidos" => $row['PAPELLIDOS'],
			"pnombre" => $row['PNOMBRE'],
			"pnif" => $row['PNIF'],
			"pdomicilio" => $row['PDOMICILIO'],
			"plocalidad" => $row['PLOCALIDAD'],
			"provincia" => $row['PPROVINCIA'],
			"pcp" => $row['PCP'],
			"ptelefono_f" => $row['PTELEFONO_F'],
			"ptelefono_m" => $row['PTELEFONO_M'],
			"pemail" => $row['EMAIL_PADR'],
			"codigo" => $codigo,
			"repetidor" => $repetidor,
			"optativas1" => $E3_opt1,
			"rel" => $religion,
			"optativas1_ca" => $E2_opt1,
			"rel_ca" => $rel_ca,
			"entregado" => $entregado
			);
	}	
	else if($variable=='E3'){
	$arr = array(
			"success" => true,
			"curso" => $variable,
			"nexpediente" => $row["NMEXPEDIEN"],
			"anombre" => $row["ANOMBRE"],
			"aapellidos" => $row["AAPELLIDOS"],
			"sexo" => $row["SEXO"],
			"fnacimiento" => $row["FNACIMIENTO"],
			"adni" => $row["ADNI"],
			"adomicilio" => $row["ADOMICILIO"],
			"alocalidad" => $row['ALOCALIDAD'],
			"aprovincia" => $row['APROVINCIA'],
			"acp" => $row['ACP'],
			"lug_nac" => $row['lug_nac'],
			"prov_nac" => $row['prov_nac'],
			"pais_nac" => $row['pais_nac'],
			"nacionalidad" => $row['nacionalidad'],
			"telefono1" => $row['TELEFONO1'],
			"telefono2" => $row['TELEFONO2'],
			"mapellidos" => $row['EMAIL_ALUMNO'],
			"mapellidos" => $row['MAPELLIDOS'],
			"mnombre" => $row['MNOMBRE'],
			"mnif" => $row['MNIF'],
			"mdomicilio" => $row['MDOMICILIO'],
			"mlocalidad" => $row['MLOCALIDAD'],
			"mprovincia" => $row['MPROVINCIA'],
			"mcp" => $row['MCP'],
			"mtelefono_f" => $row['MTELEFONO_F'],
			"mtelefono_m" => $row['MTELEFONO_M'],
			"memail" => $row['EMAIL_MADR'],
			"papellidos" => $row['PAPELLIDOS'],
			"pnombre" => $row['PNOMBRE'],
			"pnif" => $row['PNIF'],
			"pdomicilio" => $row['PDOMICILIO'],
			"plocalidad" => $row['PLOCALIDAD'],
			"provincia" => $row['PPROVINCIA'],
			"pcp" => $row['PCP'],
			"ptelefono_f" => $row['PTELEFONO_F'],
			"ptelefono_m" => $row['PTELEFONO_M'],
			"pemail" => $row['EMAIL_PADR'],
			"codigo" => $codigo,
			"repetidor" => $repetidor,
			"optativas1" => $E4_opt1,
			"rel" => $religion,
			"optativas1_ca" => $E3_opt1,
			"rel_ca" => $rel_ca,
			"entregado" => $entregado
			);
	}	
	else if($variable=='E4'){
	$arr = array(
			"success" => true,
			"curso" => $variable,
			"nexpediente" => $row["NMEXPEDIEN"],
			"anombre" => $row["ANOMBRE"],
			"aapellidos" => $row["AAPELLIDOS"],
			"sexo" => $row["SEXO"],
			"fnacimiento" => $row["FNACIMIENTO"],
			"adni" => $row["ADNI"],
			"adomicilio" => $row["ADOMICILIO"],
			"alocalidad" => $row['ALOCALIDAD'],
			"aprovincia" => $row['APROVINCIA'],
			"acp" => $row['ACP'],
			"lug_nac" => $row['lug_nac'],
			"prov_nac" => $row['prov_nac'],
			"pais_nac" => $row['pais_nac'],
			"nacionalidad" => $row['nacionalidad'],
			"telefono1" => $row['TELEFONO1'],
			"telefono2" => $row['TELEFONO2'],
			"mapellidos" => $row['EMAIL_ALUMNO'],
			"mapellidos" => $row['MAPELLIDOS'],
			"mnombre" => $row['MNOMBRE'],
			"mnif" => $row['MNIF'],
			"mdomicilio" => $row['MDOMICILIO'],
			"mlocalidad" => $row['MLOCALIDAD'],
			"mprovincia" => $row['MPROVINCIA'],
			"mcp" => $row['MCP'],
			"mtelefono_f" => $row['MTELEFONO_F'],
			"mtelefono_m" => $row['MTELEFONO_M'],
			"memail" => $row['EMAIL_MADR'],
			"papellidos" => $row['PAPELLIDOS'],
			"pnombre" => $row['PNOMBRE'],
			"pnif" => $row['PNIF'],
			"pdomicilio" => $row['PDOMICILIO'],
			"plocalidad" => $row['PLOCALIDAD'],
			"provincia" => $row['PPROVINCIA'],
			"pcp" => $row['PCP'],
			"ptelefono_f" => $row['PTELEFONO_F'],
			"ptelefono_m" => $row['PTELEFONO_M'],
			"pemail" => $row['EMAIL_PADR'],
			"codigo" => $codigo,
			"repetidor" => $repetidor,
			"optativas1" => $B1_opt,
			"rel" => '',
			"optativas1_ca" => $E4_opt1,
			"rel_ca" => $rel_ca,
			"entregado" => $entregado
			);
	}else if($variable=='B1'){
	$arr = array(
			"success" => true,
			"curso" => $variable,
			"nexpediente" => $row["NMEXPEDIEN"],
			"anombre" => $row["ANOMBRE"],
			"aapellidos" => $row["AAPELLIDOS"],
			"sexo" => $row["SEXO"],
			"fnacimiento" => $row["FNACIMIENTO"],
			"adni" => $row["ADNI"],
			"adomicilio" => $row["ADOMICILIO"],
			"alocalidad" => $row['ALOCALIDAD'],
			"aprovincia" => $row['APROVINCIA'],
			"acp" => $row['ACP'],
			"lug_nac" => $row['lug_nac'],
			"prov_nac" => $row['prov_nac'],
			"pais_nac" => $row['pais_nac'],
			"nacionalidad" => $row['nacionalidad'],
			"telefono1" => $row['TELEFONO1'],
			"telefono2" => $row['TELEFONO2'],
			"mapellidos" => $row['EMAIL_ALUMNO'],
			"mapellidos" => $row['MAPELLIDOS'],
			"mnombre" => $row['MNOMBRE'],
			"mdni" => $row['MNIF'],
			"mdomicilio" => $row['MDOMICILIO'],
			"mlocalidad" => $row['MLOCALIDAD'],
			"mprovincia" => $row['MPROVINCIA'],
			"mcp" => $row['MCP'],
			"mtelefono_f" => $row['MTELEFONO_F'],
			"mtelefono_m" => $row['MTELEFONO_M'],
			"memail" => $row['EMAIL_MADR'],
			"papellidos" => $row['PAPELLIDOS'],
			"pnombre" => $row['PNOMBRE'],
			"pdni" => $row['PNIF'],
			"pdomicilio" => $row['PDOMICILIO'],
			"plocalidad" => $row['PLOCALIDAD'],
			"provincia" => $row['PPROVINCIA'],
			"pcp" => $row['PCP'],
			"ptelefono_f" => $row['PTELEFONO_F'],
			"ptelefono_m" => $row['PTELEFONO_M'],
			"pemail" => $row['EMAIL_PADR'],
			"codigo" => $codigo,
			"repetidor" => $repetidor,
			"optativas1" => $B2_opt1,
			"optativas1_ca" => $B1_opt,
			"entregado" => $entregado
			);
	}	
echo '{"alumno":['.json_encode($arr).']}';
}else{
	
$arr['success'] = false;
echo '{"alumno":['.json_encode($arr).']}';	
}

?>
