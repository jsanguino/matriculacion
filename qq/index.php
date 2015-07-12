<?php
// include db config
include_once("config.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

// set up DB
mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

// include and create object
//include(PHPGRID_LIBPATH."lib/inc/jqgrid_dist.php");
include("./lib/inc/jqgrid_dist.php");

$col = array();
$col["title"] = "Id";
$col["name"] = "id"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["viewable"] = false;
$col["hidden"] = true;
$col["editable"] = false; // this column is editable
$cols[] = $col;		

$col = array();
$col["title"] = "Apellidos";
$col["name"] = "AAPELLIDOS"; 
$col["width"] = "50";
$col["editable"] = false; // this column is editable
$col["edittype"] = "textarea";
$col["editoptions"] = array("rows"=>4, "cols"=>35);
$cols[] = $col;

$col = array();
$col["title"] = "Nombre";
$col["name"] = "ANOMBRE"; 
$col["width"] = "50";
$col["editable"] = false;
$cols[] = $col;


$col = array();
$col["title"] = "Grupo";
$col["name"] = "CDGRUPO"; 
$col["width"] = "7";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["title"] = "Etapa";
$col["name"] = "etapa"; 
$col["width"] = "5";
$col["editable"] = false;
$cols[] = $col;
	
$col = array();
$col["title"] = "Entrega";
$col["name"] = "entregado"; 
$col["width"] = "9";
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = array("value"=>'0:No Entregado;1:Entregado');

$cols[] = $col;
session_start();

// preserve selection for ajax call

/*
 * if (!empty($_POST["tables"]))
{
	$_SESSION["tab"] = $_POST["tables"];
	$tab = $_SESSION["tab"];
}
*/

// update on ajax call
if (!empty($_GET["grid_id"]))
	$tab = $_SESSION["tab"];

$_SESSION["tab"] = "matriculacion";
	$tab = $_SESSION["tab"];
	
if (!empty($tab))
{
	$g = new jqgrid();

	// set few params
	$grid["caption"] = "Tabla para '$tab'";
	$grid["autowidth"] = true;
	$grid["rowNum"] = 30;
	$g->set_options($grid);

	// set database table for CRUD operations
	$g->table = $tab;

	// pass the cooked columns to grid
	$g->set_columns($cols);
	// render grid
	$out = $g->render("list1");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Control de alumnos Matriculados</title>
	<link rel="stylesheet" type="text/css" media="screen" href="./lib/js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="./lib/js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<script src="./lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="./lib/js/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="./lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="./lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
	

	<style type="text/css">   
		#container{
			width: 99%;
		}
		#resumen1{        
			width:38%;
			display: block;       
			float: left;
			font-size: 9.5px;
			border: 1px;
			background-color: #73AAD3;
			padding: 10px;
		}
		#printer{        
			width:50px;
			display: block;       
			float: left;
			padding-left: 10px;
		}
		.tema{        
			width:32%;
			display: block;       
			float: left;
			font-size: 9.5px;
			border: 1px;
			color: #fff;
		}
		.num{        
			width:15%;
			display: block;       
			float: left;
			color: #fff;
		}
		#up{        
			width:50%;
			display: block;       
			float: left;
		}
		.up{        
			width:50%;
			display: block;       
			float: left;
		}      
    </style>  

</head>
<body>
	<style>* {font-family: "Open Sans", tahoma;}</style>

	<?php if (!empty($out)) { ?>
	<br>
	<fieldset>
		<?php echo $out?>
	</fieldset>	
	<?php } ?>
	</div>
</body>
</html>
