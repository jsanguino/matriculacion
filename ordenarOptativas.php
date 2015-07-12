<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

#$E3_opt1="Francés;Inic.Emprendedora y Empr.;Ampliación de Matem.;Cultura Clásica";
#$E4_opt1="Ampl.Matemáticas;Ampl.Biología y Geología;Ampl.Física y Quím.;Iniciación a la Elect. y Electrónica;Literatura Universal;Cultura Clásica;Francés;Iniciativa Emprendedora";
#$B1_opt="Francés I;Tecn.Inform.Comun;Cultura Científica;Religión";
#$B1_HCS="Economía;Griego I;Literatura Universal";
#$B1_C="Biología y Geología;Dibujo Técnico";
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

function ordenarOptativasE3($materia){
		if($materia=='E3AMT'){
			return "Ampliación de Matemáticas";
		}else if($materia=='E3IEE'){
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
		return "Ampliación de Fís. y Quím.";
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
