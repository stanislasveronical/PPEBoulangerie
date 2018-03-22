<?php
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->SetTextColor(107,50,39);
$pdf->Cell(10,40,'Salambo : 2.50 euros');
$pdf->Image('./IMAGES/Salambo.jpeg',20,35,40);


$pdf->Cell(180,40,'Religieuse : 2.00 euros',0,1,'C');
$pdf->Image('./IMAGES/Religieuse.jpeg',90,35,40);

$pdf->Output();
?>