<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

#$E3_opt1="Franc�s;Inic.Emprendedora y Empr.;Ampliaci�n de Matem.;Cultura Cl�sica";
#$E4_opt1="Ampl.Matem�ticas;Ampl.Biolog�a y Geolog�a;Ampl.F�sica y Qu�m.;Iniciaci�n a la Elect. y Electr�nica;Literatura Universal;Cultura Cl�sica;Franc�s;Iniciativa Emprendedora";
#$B1_opt="Franc�s I;Tecn.Inform.Comun;Cultura Cient�fica;Religi�n";
#$B1_HCS="Econom�a;Griego I;Literatura Universal";
#$B1_C="Biolog�a y Geolog�a;Dibujo T�cnico";
function ordenarOptativasE1($materia){
	if($materia=='E1FR'){
		return "Franc�s";
	}else if($materia=='E1TMU'){
		return "Taller de M�sica";
	}		
}

function ordenarOptativasE2($materia){
	if($materia=='E2FR'){
		return "Franc�s";
	}else if($materia=='E2IC'){
		return "Imagen y Comunicaci�n";
	}
}

function ordenarOptativasE3($materia){
		if($materia=='E3AMT'){
			return "Ampliaci�n de Matem�ticas";
		}else if($materia=='E3IEE'){
			return "Inic.Emprendedora y Empr.";
		}else if($materia=='E3CUC'){
			return "Cultura Cl�sica";			
		}else if($materia=='E3FR'){
			return "Franc�s";
		}
}

function ordenarOptativasE4($materia){
	if($materia=='E4AMT'){
		return "Ampliaci�n de Matem�ticas";
	}else if($materia=='E4IE'){
		return "Iniciativa Emprendedora";
	}else if($materia=='E4CUC'){
		return "Cultura Cl�sica";			
	}else if($materia=='E4LITU'){
		return "Literatura Universal";
	}else if($materia=='E4IEE'){
		return "Inici. a la Elect. y Electr�nica";
	}else if($materia=='E4FR'){
		return "Franc�s";
	}else if($materia=='E4AMB'){
		return "Ampliaci�n de Biolog�a";
	}else if($materia=='E4AFQ'){
		return "Ampliaci�n de F�s. y Qu�m.";
	}
}

/*
$fila['E4AMT']='1';
$fila['E4IE']='4';
$fila['E4CUC']='3';
$fila['E4LITU']='2';
$fila['E4IEE']='7';
$fila['E4FR']='8';
$fila['E4AMB']='5';
$fila['E4AFQ']='6';

asort($fila);
print_r($fila);
echo "<br>\n<br>";
$optativas=array_flip($fila);
print_r($optativas);
$num=count($optativas);

for ($i=0;$i<$num;$i++){
	$n=$i+1;
	echo ordenarOptativasE4($optativas[$n]);
}
*/
?>
