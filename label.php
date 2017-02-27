<?php

const TOP_MARGIN = 15.068;
const SIDE_MARGIN = 7.188;
const VERTICAL_PITCH = 38.075;
const HORIZONTAL_PITCH = 65.964;
const LABEL_HEIGHT = 38.100;
const LABEL_WIDTH = 63.500;
const LABELS_ACROSS = 3;
const LABELS_ALONG = 7;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('fpdf/fpdf.php');

function AddLabelsToPdf($x, $y, &$pdf, $text) {
    $x = SIDE_MARGIN + (HORIZONTAL_PITCH * $x);
    $y = TOP_MARGIN + (VERTICAL_PITCH * $y);
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(LABEL_WIDTH, LABEL_HEIGHT, $text, 1, 'C');
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->SetMargins(0, 0);
$pdf->SetAutoPageBreak(false);
$x = $y = $x_across = $y_across = 0;

$card = "";

for($i=0; $i < 200; $i ++) {

    $x = SIDE_MARGIN + (HORIZONTAL_PITCH * $x_across);
    $y = TOP_MARGIN + (VERTICAL_PITCH * $y_across);
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(LABEL_WIDTH, LABEL_HEIGHT, $card, 1, 'C');


    $y_across++; // next row
    if($y_across == LABELS_ALONG) { // end of page wrap to next column
        $x_across++;
        $y_across = 0;
        if($x_across == LABELS_ACROSS) { // end of page
            $x_across = 0;
            $y_across = 0;
            $pdf->AddPage();
        }
    }
}
$pdf->Output('Labels.pdf', 'D');