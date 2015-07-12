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

</style>
</head>
<body>
<div id="recomendacion"></div>
<script>
	var txt="<div id='resumen'>	<h1>Recuerde</h1><p>Compruebe los datos en su impreso</p><p>Debe entregar junto con la matrícula impresa</p>	<ul><li>El justificante de ingreso de 15€ en la cuenta<p>ES15 2038 2828 0560 0015 7764</p></li><li>Dos fotografías tamaño carnet del alumno (una pegada en el impreso, la otra con el nombre en la parte posterior</li></ul></div>";
$(function(){
	var codigo="<?php $codigo='dfjasdjfkfj';echo $codigo;?>";
	swal("¡Enhorabuena!", "Pulse el botón para imprimir el impreso de matrícula ", "success");
	$('.confirm').click(function() {
			$('#recomendacion').show();
			window.open('generaImpreso.php?codigo='+codigo,'_parent');
			$('#recomendacion').html(txt);
	});
});
</script>
</body>
</html>
