<?php

$fname='/tmp/localidades.txt';

if (($gestor = fopen("/tmp/localidades.txt", "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
        $numero = count($datos);
        $apellidos=strtoupper($datos[0]);
        $nombre=strtoupper($datos[1]);
		echo $datos[1].'='.$datos[0]."<br/>";

    }
    fclose($gestor);
}

?>
