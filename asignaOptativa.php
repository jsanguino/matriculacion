<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require_once('include/configuracion.php');
require_once('class/funciones.php');


?>
<!doctype html>
<html lang="es">
<head>	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Utilidades</title>
<script src="./js/jquery-1.11.1.min.js"></script>
<script src="./js/jquery-ui.js"></script>
<script>
$(document).ready(function(){
	
	$( '.nivel').click(function() {
		var nivel=$(this).html();
		//if(nivel=='E1'){nivel='N';}else if(nivel=='E2'){nivel='E1';}
		
		$.ajax({
			url: "asignarOptativa.php",
			type: 'POST',
			data: {nivel: nivel},
			cache: false
		})
		.done(function( data, textStatus, jqXHR ) {
			$('#alumnos').html(data);			
			if ( console && console.log ) {
				console.log( "La solicitud se ha hecho con éxito: " +  textStatus);
			}
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			if ( console && console.log ) {
			console.log( "La solicitud ha fallado: " +  textStatus);
			}
		});	
	$('#alumnos').show();
	});
});

	$( document ).on( "click", "button", function() {
		var optativasE1="E1RLC,E1RMT,E1FR,E1TMU";
		var optativasE2="E2RLC,E2RMT,E2FR,E2IC";
		var optativasE3="E3AMT,E3CUC,E3FR,E3IAEE";
		var optativasE4="";
		var optativasB1="";
		var optativasB2="";
		
		var codigo = $( this ).attr("value");
		var elid= '#'+codigo;

		var id=codigo.split("_");
		var nivel=id[1].substring(0,2);
		if(nivel=='E1'){str=optativasE1;}else if(nivel=='E2'){str=optativasE2;}else if(nivel=='E3'){str=optativasE3;}else if(nivel=='E4'){str=optativasE4;}else if(nivel=='B1'){str=optativasB1;}else if(nivel=='B2'){str=optativasB2;}
		var str = str.split(',');

		$.ajax({
			url: "asignarOptativa.php",
			type: 'POST',
			data: {codigo: codigo},
			cache: false
		})
		.done(function( data, textStatus, jqXHR ) {
			for (i = 0; i < codigo.length; i++) {
				materia='#'+id[0]+'_'+str[i];
				$(materia).removeClass( "nada seleccion" );
			}
			
			$(elid).addClass('seleccion');			
			if ( console && console.log ) {
				console.log( "La solicitud se ha hecho con éxito: " +  textStatus);
			}
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
				if ( console && console.log ) {
					console.log( "La solicitud ha fallado: " +  textStatus);
				}
			});
		});		
</script>
	<style type="text/css">
		button {margin-top: 1px;width: 10%;}
		.seleccion{border:2px dashed #FFA500;}
		#alumnos{display: block;}
		.nivel{float: left;width: 10%;background: #7F7F7F; padding: 3px; margin: 2px;color: #fff;text-shadow: 0 1px 0 #000;}
		#nombre {display: block; float: left; width: 315px; font-size: .75em;}
        #grupos {float: left; width:50%;}
        #grupo {float: left;width:88%;margin-top:50px;padding-top:5px;}
        .salida{position: absolute;top:5px;right:10px;}
        body {
			background: #fafafa url(http://jackrugile.com/images/misc/noise-diagonal.png);
			color: #444;
			font: 100%/30px 'Helvetica Neue', helvetica, arial, sans-serif;
			text-shadow: 0 1px 0 #fff;
		}

		strong {
			font-weight: bold; 
		}

		em {
			font-style: italic; 
		}
       <!--
		table, th, td {border: 0px;}
        .cabecera{background: #7F7F7F; color:#ffffff;}
		.azul{background: #D1DAE1;font-size: 13px;text-align: left;}
		.gris{background: #BFBFBF;font-size: 13px;text-align: left;}
		-->
		table {
		background: #f5f5f5;
		border-collapse: separate;
		box-shadow: inset 0 1px 0 #fff;
		font-size: 12px;
		line-height: 24px;
		margin: 10px auto;
		text-align: left;
		width: 800px;
		}	

		th {
		background: url(http://jackrugile.com/images/misc/noise-diagonal.png), linear-gradient(#777, #444);
		border-left: 1px solid #555;
		border-right: 1px solid #777;
		border-top: 1px solid #555;
		border-bottom: 1px solid #333;
		box-shadow: inset 0 1px 0 #999;
		color: #fff;
		font-weight: bold;
		padding: 5px 5px;
		position: relative;
		text-shadow: 0 1px 0 #000;	
		}

		th:after {
		background: linear-gradient(rgba(255,255,255,0), rgba(255,255,255,.08));
		content: '';
		display: block;
		height: 25%;
		left: 0;
		margin: 1px 0 0 0;
		position: absolute;
		top: 25%;
		width: 100%;
		}

		th:first-child {
		border-left: 1px solid #777;	
		box-shadow: inset 1px 1px 0 #999;
		}

		th:last-child {
		box-shadow: inset -1px 1px 0 #999;
		}

		td {
		border-right: 1px solid #fff;
		border-left: 1px solid #e8e8e8;
		border-top: 1px solid #fff;
		border-bottom: 1px solid #e8e8e8;
		padding: 5px 5px;
		position: relative;
		transition: all 300ms;
		}

		td:first-child {
		box-shadow: inset 1px 0 0 #fff;
		}	

		td:last-child {
		border-right: 1px solid #e8e8e8;
		box-shadow: inset -1px 0 0 #fff;
		}	

		tr {
		background: url(http://jackrugile.com/images/misc/noise-diagonal.png);	
		}

		tr:nth-child(odd) td {
		background: #f1f1f1 url(http://jackrugile.com/images/misc/noise-diagonal.png);	
		}

		tr:last-of-type td {
		box-shadow: inset 0 -1px 0 #fff; 
		}

		tr:last-of-type td:first-child {
		box-shadow: inset 1px -1px 0 #fff;
		}	

		tr:last-of-type td:last-child {
		box-shadow: inset -1px -1px 0 #fff;
		}	

		tbody:hover td {
		color: transparent;
		text-shadow: 0 0 3px #aaa;
		}

		tbody:hover tr:hover td {
		color: #444;
		text-shadow: 0 1px 0 #fff;
		}
	</style>
</head>
	<body>
		<div class='nivel'>E1</div><div class='nivel'>E2</div><div class='nivel'>E3</div><div class='nivel'>E4</div><br/>
		<div id="alumnos"></div>
	</body>
</html>
