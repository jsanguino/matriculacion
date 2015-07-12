<?php
include ('database.php');
class cpr extends database{


	function fechaXno($date) {
		list($dia, $mes, $anno) = explode("/", $date);
		return $anno.'-'.$mes.'-'.$dia; 
	}
	
	function xnoMysql($date) {
		list($anno, $mes, $dia) = explode("/", $date);
		return $dia.'-'.$mes.'-'.$anno; 
	}

	function averiguaAlumno($codigo){
		$sql="SELECT inscripcion FROM ggtt_grupotrabajo WHERE pin ='".$pin."'";
		$reg=$this->ejecutarConsulta($sql);
		if (mysql_num_rows($reg) > 0) {
		$obj = mysql_fetch_object($reg);
		echo '{success: true, data:'.json_encode($obj).'}';
		}else{
		echo '{success: false}';
		}	
		mysql_free_result($reg);  	
	}
	
	function cargarDatosServidor($pin){
		$id=$this->averiguaID($pin);
		$sql="SELECT pin,id,tipo,titulo,planteamiento,objetivos,contenidos,metodologia,bibliografia,presupuesto,materiales_elab,evaluacion,asesoramiento,observaciones,
		email,telefono as c_telefono,dni as c_dni,apellidos as c_apellidos,nombre as c_nombre,centro as c_centro
		FROM ggtt_grupotrabajo,ggtt_usuariosgrupos 
		WHERE cargo='C'
		AND id ='".$id."'
		AND id=grupotrabajo_id
		LIMIT 1";
		
		$reg=$this->ejecutarConsulta($sql);
		if (mysql_num_rows($reg) > 0) {
	   $obj = mysql_fetch_object($reg);
   	echo '{success: true, data:'.json_encode($obj).'}';
		}else{
   	echo '{success: false}';
   	}	
		mysql_free_result($reg);  	
  	}	
  	
  	function actualizarDatos($matriz){
  	
		$consultas=1; //Ponemos a 1 el contador de consultas para descontar ya la primera que se va  a hacer.  	
  		/*
  		require_once ('HTMLPurifier.auto.php');
		$config = HTMLPurifier_Config::createDefault();
		$config->set('HTML.Allowed', 'b,i,br,p,div,a[target|href],font[style|face|color],ol,ul,li');
		$purifier = new HTMLPurifier($config);
		
		$restrictivo = HTMLPurifier_Config::createDefault();
		$restrictivo->set('HTML.Allowed', 'br');
		$purifier_rest = new HTMLPurifier($restrictivo);
		*/
		  	
  		$id=$this->averiguaID($matriz['pin']);

/*  	$apellidos = $purifier_rest->purify($matriz['c_apellidos']);
  		$nombre = $purifier_rest->purify($matriz['c_nombre']);
  		$dni = $purifier_rest->purify($matriz['c_dni']);
  		$centro = $purifier_rest->purify($matriz['c_centro']);
  		$telefono = $purifier->purify($matriz['c_telefono']);
  		
  		
  		$tipo = $matriz['tipo'];
  		$contenidos = $purifier->purify($matriz['contenidos']);
  		$email = $purifier_rest->purify($matriz['email']);
  		$metodologia = $purifier->purify($matriz['metodologia']);
  		$objetivos = $purifier->purify($matriz['objetivos']);
  		$titulo = $purifier_rest->purify($matriz['titulo']);
  		$bibliografia = $purifier->purify($matriz['bibliografia']);
  		$presupuesto = $purifier->purify($matriz['presupuesto']);
  		$asesoramiento = $purifier->purify($matriz['asesoramiento']);
*/
  		$apellidos = $matriz['c_apellidos'];
  		$nombre = $matriz['c_nombre'];
  		$dni = $matriz['c_dni'];
  		$centro = $matriz['c_centro'];
  		$telefono = $matriz['c_telefono'];
  		
  		
  		$tipo = $matriz['tipo'];
  		$contenidos = $matriz['contenidos'];
  		$email = $matriz['email'];
  		$metodologia = $matriz['metodologia'];
  		$objetivos = $matriz['objetivos'];
  		$titulo = $matriz['titulo'];
  		$bibliografia = $matriz['bibliografia'];
  		$presupuesto = $matriz['presupuesto'];
  		$asesoramiento = $matriz['asesoramiento'];


		$sql="UPDATE ggtt_usuariosgrupos 
		SET apellidos='".$apellidos."',
		nombre='".$nombre."',
		dni='".$dni."',
		centro='".$centro."'
		WHERE grupotrabajo_id ='".$id."'
		AND cargo='C'";
		$reg1=$this->ejecutarConsulta($sql);
		$regn=$reg1; // Si se ha hecho la consulta regn=1 y a partir de ahí seguimos con el contador.
		
		if ($titulo!=''){
			$sql="UPDATE ggtt_grupotrabajo SET titulo='".$titulo."' WHERE id ='".$id."' LIMIT 1";
			$reg=$this->ejecutarConsulta($sql);
			$consultas++;
		}

		if ($contenidos!=''){
			$sql="UPDATE ggtt_grupotrabajo SET contenidos='".$contenidos."' WHERE id ='".$id."' LIMIT 1";
			$reg=$this->ejecutarConsulta($sql);
			$consultas++;
		}

		if ($metodologia!=''){
			$sql="UPDATE ggtt_grupotrabajo SET metodologia='".$metodologia."' WHERE id ='".$id."' LIMIT 1";
			$reg=$this->ejecutarConsulta($sql);
			$consultas++;
		}

		if ($objetivos!=''){
			$sql="UPDATE ggtt_grupotrabajo SET objetivos='".$objetivos."' WHERE id ='".$id."' LIMIT 1";
			$reg=$this->ejecutarConsulta($sql);
			$consultas++;
		}
		if ($email!=''){
			$sql="UPDATE ggtt_grupotrabajo SET email='".$email."' WHERE id ='".$id."' LIMIT 1";
			$reg=$this->ejecutarConsulta($sql);
			$consultas++;
		}
		if ($telefono!=''){
			$sql="UPDATE ggtt_grupotrabajo SET telefono='".$telefono."' WHERE id ='".$id."' LIMIT 1";
			$reg=$this->ejecutarConsulta($sql);
			$consultas++;
		}

		if ($bibliografia!=''){
			$sql="UPDATE ggtt_grupotrabajo SET bibliografia='".$bibliografia."' WHERE id ='".$id."' LIMIT 1";
			$reg=$this->ejecutarConsulta($sql);
			$consultas++;
		}
		if ($presupuesto!=''){
			$sql="UPDATE ggtt_grupotrabajo SET presupuesto='".$presupuesto."' WHERE id ='".$id."' LIMIT 1";
			$reg=$this->ejecutarConsulta($sql);
			$consultas++;
		}
		if ($asesoramiento!=''){
			$sql="UPDATE ggtt_grupotrabajo SET asesoramiento='".$asesoramiento."' WHERE id ='".$id."' LIMIT 1";
			$reg=$this->ejecutarConsulta($sql);
			$consultas++;
		}

		if ($tipo!=''){
			$sql="UPDATE ggtt_grupotrabajo SET tipo='".$tipo."' WHERE id ='".$id."' LIMIT 1";
			$reg=$this->ejecutarConsulta($sql);
			$consultas++;
		}

		//$reg=$regn+$consultas; //Aquí hacemos el resumen. Si no ha fallado ninguna consulta debe devolver 1+contador.
		
		if($reg==$consultas){
			echo '{success: true}';
		}else{
			echo '{success: false}';
		}	
  	}
 	
/*****
******
****** FUNCIONES ESPECÍFICAS PARA EL CPR 
******
******
*****/  	
	function listarSolicitudes(){
		$anno=$this->anno();
		$i=0;
//		$sql="SELECT id, CONCAT(apellidos,', ', nombre) as n_completo,titulo, centro FROM ggtt_grupotrabajo,ggtt_usuariosgrupos WHERE cargo='C' AND grupotrabajo_id=id AND apellidos != '' AND titulo !=''";
		$sql="SELECT id, pin,CONCAT(apellidos,', ', nombre) as n_completo,titulo,ggtt_grupotrabajo.usuario,ggtt_grupotrabajo.clave, centro,asesor_responsable as asesor FROM ggtt_grupotrabajo,ggtt_usuariosgrupos WHERE cargo='C' AND grupotrabajo_id=id AND apellidos != '' AND titulo !='' order by usuario,centro";

		$reg=$this->ejecutarConsulta($sql);
		$num = mysql_num_rows($reg); 
		if (mysql_num_rows($reg) > 0) {	
			$miembrosData = array("count" => $num, "data" => array());
			while ($row = mysql_fetch_assoc($reg)) {    
				$miembrosData["data"][$i] = $row;    
				$i++;  
			}   
		echo json_encode($miembrosData); 		
		}else{
   	echo '{success: false}';
   	}	
		mysql_free_result($reg);
  	}	
  	
  	function datosProtocolo($id){
  		$sql="SELECT pin,id,tipo,titulo,planteamiento,objetivos,contenidos,metodologia,bibliografia,presupuesto,materiales_elab,evaluacion,asesoramiento,observaciones,
		email,telefono as c_telefono,dni as c_dni,apellidos as c_apellidos,nombre as c_nombre,centro as c_centro
		FROM ggtt_grupotrabajo,ggtt_usuariosgrupos 
		WHERE cargo='C'
		AND id ='".$id."'
		AND id=grupotrabajo_id
		LIMIT 1";
		
		$reg=$this->leerBD($sql);
		$row=mysql_fetch_row($reg);
		return($row);
  	}
  	
  	function miembrosGrupo($id){
  		//$Out='';
  		$sql="SELECT CONCAT(nombre,' ', apellidos) as n_completo,dni,centro
		FROM ggtt_usuariosgrupos 
		WHERE grupotrabajo_id ='".$id."'
		AND cargo='P'
		AND apellidos !=''
		ORDER BY apellidos";
		$reg=$this->leerBD($sql);
		while ($row=mysql_fetch_row($reg)){
			$Out[]=$row;
		}
		return $Out;		
  	}

	function sesionesGrupo($id){
  		$sql="SELECT fecha,comienzo,final
		FROM ggtt_fechas 
		WHERE grupotrabajo_id ='".$id."' 
		AND fecha !='0000-00-00'
		ORDER BY fecha";
		$reg=$this->leerBD($sql);
		while ($row=mysql_fetch_row($reg)){
			$Out[]=$row;
		}
		return $Out;		
  	}
  	

}// Fin de la clase

?>
