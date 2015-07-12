<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once("config.php");


require('mc_table.php');

function GenerateWord()
{
    //Get a random word
    $nb=rand(3,10);
    $w='';
    for($i=1;$i<=$nb;$i++)
        $w.=chr(rand(ord('a'),ord('z')));
    return $w;
}

function GenerateSentence()
{
    //Get a random sentence
    $nb=rand(1,10);
    $s='';
    for($i=1;$i<=$nb;$i++)
        $s.=GenerateWord().' ';
    return substr($s,0,-1);
}



$pdf=new PDF_MC_Table();
$pdf->addPage('L');
$pdf->SetFont('Arial','',10);

//Table with 20 rows and 4 columns
$pdf->SetWidths(array(20,110,50,50,50));
srand(microtime()*1000000);


mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

//Select the Products you want to show in your PDF file
$sql="select tema,pregunta,correcta,falsa1,falsa2 from castellano ORDER BY tema";
$n=0;
$result=mysql_query($sql);
$numero = mysql_numrows($result);

$pdf->SetFont('Arial','B',11);
$pdf->Row(array('Tema','Pregunta','Correcta','Falsa1','Falsa2'));
$pdf->SetFont('Arial','',10);
while($row = mysql_fetch_array($result))
{
    //$id = $row["id"];
    $pregunta = $row["pregunta"];
    $respuesta = $row["correcta"];
    $respuesta = $row["falsa1"];
    $respuesta = $row["falsa2"];
	$pdf->Row(array($row['tema'],$row["pregunta"],$row["correcta"],$row["falsa1"],$row["falsa2"]));
}
mysql_close();
$pdf->Output();
?>
