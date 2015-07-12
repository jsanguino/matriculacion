<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require('fpdf.php');

class PDF extends FPDF
{
//Cabecera de página
   function Header()
   {
/*	   
    //Logo
    $this->Image("kk.png" , 10 ,8, 35 , 38 , "PNG" ,"http://www.mipagina.com");
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Movernos a la derecha
    $this->Cell(80);
    //Título
    $this->Cell(60,10,'Titulo del archivo',1,0,'C');
    //Salto de línea
    $this->Ln(20);
*/      
	$this->SetFont('Arial','B',11);
   }
   
   //Pie de página
   function Footer()
   {
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
   }
   //Tabla simple
   function TablaSimple($header)
   {
    //Cabecera
    foreach($header as $col)
    $this->Cell(40,7,$col,1);
    $this->Ln();
   
      $this->Cell(40,5,"hola",1);
      $this->Cell(40,5,"hola2",1);
      $this->Cell(40,5,"hola3",1);
      $this->Cell(40,5,"hola4",1);
      $this->Ln();
      $this->Cell(40,5,"linea ",1);
      $this->Cell(40,5,"linea 2",1);
      $this->Cell(40,5,"linea 3",1);
      $this->Cell(40,5,"linea 4",1);
   }
   
   //Tabla coloreada
function TablaColores($header)
{


while($row = mysql_fetch_array($result))
{
	/*
    $this->id= $row["id"];
    $this->pregunta = $row["pregunta";
    $this->respuesta= $row["correcta"];
    $this->falsa1='';
    */ 
}


//Colores, ancho de línea y fuente en negrita
$this->SetFillColor(255,0,0);
$this->SetTextColor(255);
$this->SetDrawColor(128,0,0);
$this->SetLineWidth(.3);
$this->SetFont('','B');
//Cabecera

//for($i=0;$i<count($header);$i++)
//$this->Cell(40,7,$header[$i],1,0,'C',1);
//$this->Ln();
//Restauración de colores y fuentes
$this->SetFillColor(224,235,255);
$this->SetTextColor(0);
$this->SetFont('');


//Datos
   $fill=false;
$this->Cell(40,6,"hola",'LR',0,'L',$fill);
$this->Cell(40,6,"hola2",'LR',0,'L',$fill);
$this->Cell(40,6,"hola3",'LR',0,'R',$fill);
$this->Cell(40,6,"hola4",'LR',0,'R',$fill);
$this->Ln();
      $fill=!$fill;
      $this->Cell(40,6,"col",'LR',0,'L',$fill);
$this->Cell(40,6,"col2",'LR',0,'L',$fill);
$this->Cell(40,6,"col3",'LR',0,'R',$fill);
$this->Cell(40,6,"col4",'LR',0,'R',$fill);
$fill=true;
   $this->Ln();
   $this->Cell(160,0,'','T');
}

   
   
}

/*
// set up DB
mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

//Select the Products you want to show in your PDF file
$sql="select id,pregunta,correcta from castellano ORDER BY tema";

$result=mysql_query($sql);
$numero = mysql_numrows($result);
*/

//For each row, add the field to the corresponding column

/*
while($row = mysql_fetch_array($result))
{
    $id[]= $row["id"];
    $pregunta[] = $row["pregunta";
    $respuesta[] = $row["correcta"];

}
*/

$pdf=new PDF();
//Títulos de las columnas
$header=array('Id','Pregunta','Correcta','Falsa 1');
$pdf->AliasNbPages();
//Primera página
$pdf->AddPage();
$pdf->SetY(15);
//$pdf->AddPage();
//$pdf->TablaSimple($header);
//Segunda página
$pdf->SetY(65);
$pdf->TablaColores($header);
$pdf->Output();
?>
