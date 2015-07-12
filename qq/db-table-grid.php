<?php
// include db config
include_once("config.php");

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
$col["width"] = "5";
$col["editable"] = false; // this column is editable
$cols[] = $col;		

$col = array();
$col["title"] = "Titulo";
$col["name"] = "titulo"; 
$col["width"] = "300";
$col["editable"] = true; // this column is editable
$col["edittype"] = "textarea";
$cols[] = $col;

$col = array();
$col["title"] = "Autor";
$col["name"] = "autor"; 
$col["width"] = "150";
$col["editable"] = true; // this column is editable
$cols[] = $col;

$col = array();
$col["title"] = "Grupo";
$col["name"] = "grupo"; 
$col["width"] = "150";
$col["editable"] = true; // this column is editable
$cols[] = $col;


session_start();

// preserve selection for ajax call
if (!empty($_POST["tables"]))
{
	$_SESSION["tab"] = $_POST["tables"];
	$tab = $_SESSION["tab"];
}

// update on ajax call
if (!empty($_GET["grid_id"]))
	$tab = $_SESSION["tab"];

if (!empty($tab))
{
	$g = new jqgrid();

	// set few params
	$grid["caption"] = "Tabla para '$tab'";
	$grid["autowidth"] = true;
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
	<link rel="stylesheet" type="text/css" media="screen" href="./lib/js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="./lib/js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<script src="./lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="./lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="./lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="./lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>
<body>
	<style>* {font-family: "Open Sans", tahoma;}</style>
	<form method="post">
		<fieldset>
		<legend>Database Tables</legend>
		Select: <select name="tables">
		<?php
			$q = mysql_query('SHOW TABLES');
			while($rs = mysql_fetch_array($q))
			{ 
				$sel = (($rs[0] == $_POST["tables"])?"selected":"");
			?>
				<option <?php echo $sel?>><?php echo $rs[0]?></option>
			<?php
			}
		?>
		</select>
		<input type="submit" value="Load Table">
		</fieldset>
	</form>
	<?php if (!empty($out)) { ?>
	<br>
	<fieldset>
		<?php echo $out?>
	</fieldset>	
	<?php } ?>
</body>
</html>
