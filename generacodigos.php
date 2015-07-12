<?php
#generacion de valores únicos

	function pin($numCaracteres = 11){
	$valores = array(1,2,3,4,5,6,7,8,9,"a","b","c","d","e","f","g","h","i","j","k","m","n","o","p","q","r","s","t","u","v","w","y","z",1,2,3,4,5,6,7,8,9,);
	$valoresNum = count($valores) - 1; // -1 porque se empieza a contar por el 0.
	
	for ($i=0;$i<=$numCaracteres;$i++){
	    $aleatorio = rand(0,$valoresNum);
	    $resultado .= $valores[$aleatorio];
	}
	
	return $resultado;  
	}



?>
