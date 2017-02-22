<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('fpdf/fpdf.php');

function ProductLabel($x, $y, &$pdf, $text) {
    $left = 4.826; // 0.19" in mm
    $top = 12.7; // 0.5" in mm
    $width = 76.802; // 2.63" in mm
    $height = 25.4; // 1.0" in mm
    $hgap = 3.048; // 0.12" in mm
    $vgap = 0.0;

    $x = $left + (($width + $hgap) * $x);
    $y = $top + (($height + $vgap) * $y);
    $pdf->SetXY($x, $y);
    $pdf->MultiCell($width, 5, $text, 1, 'C');
}

function BoxLabel($x, $y, &$pdf, $text) {
    $left = 4.826; // 0.19" in mm
    $top = 12.7; // 0.5" in mm
    $width = 76.802; // 2.63" in mm
    $height = 25.4; // 1.0" in mm
    $hgap = 3.048; // 0.12" in mm
    $vgap = 0.0;

    $x = $left + (($width + $hgap) * $x);
    $y = $top + (($height + $vgap) * $y);
    $pdf->SetXY($x, $y);
    $pdf->MultiCell($width, 5, $text, 1, 'C');
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->SetMargins(0, 0);
$pdf->SetAutoPageBreak(false);
$x = $y = 0;

$arr = ['CVool', 'sdfsdfsdf'];

foreach($arr as $text) {
    ProductLabel($x, $y, $pdf, $text);

    $y++; // next row
    if($y == 10) { // end of page wrap to next column
        $x++;
        $y = 0;
        if($x == 3) { // end of page
            $x = 0;
            $y = 0;
            $pdf->AddPage();
        }
    }
}
$pdf->Output('Labels.pdf', 'D');