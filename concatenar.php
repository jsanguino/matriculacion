<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require('fpdf_merge.php');

$merge = new FPDF_Merge();
$merge->add('doc.pdf');
$merge->add('doc-1.pdf');
$merge->output();
?>
