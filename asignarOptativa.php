<?php
include('./include/configuracion.php');
header('Content-type: text/html; charset=UTF-8');
include('./include/configuracion.php');
include('./class/funciones.php');
$tabla='matriculacion';
$codigo=$_POST['codigo'];
$nivel=$_POST['nivel'];

#E1RLC;E1RMT;E1FR;E1TMU;
#E1REL;E1VE
#E2RLC;E2RMT;E2FR;#E2IC
#E2REL;E2VE
#E3FR;E3IE;E3AMT;E3DPC;E3CUC
#E3REL;E3VE
if(isset($codigo)){
	asignaOptativa($dsn, $user, $pass, $codigo);
}else if(isset($nivel)){
	averiguaGrupos($dsn, $user, $pass, $nivel);	
}
?>
