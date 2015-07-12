<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./src/fpdf.php');
require_once('./src/fpdi.php');

$pdf = new FPDI();

$pageCount = $pdf->setSourceFile("/tmp/concat.pdf");
$tplIdx = $pdf->importPage(1, '/tmp/');

$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 90);

$pdf->Output();

?>
