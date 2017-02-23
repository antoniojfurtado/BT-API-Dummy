<?php

const A4_width = 210;
const A4_height = 297;
const A4_cols = 2;
const A4_rows = 12;

const is_percent = false;

/*const padding_vertical = 0.01;
const padding_horizontal = 0.05;
const padding_vertical_mid = 0.03;
const padding_horizontal_mid = 0.03;*/

const padding_vertical = 20;
const padding_horizontal = 10.5;
const padding_vertical_mid = 8.91;
const padding_horizontal_mid = 6.3;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('fpdf/fpdf.php');

function AddLabelsToPdf($x, $y, &$pdf, $text) {

    $debug = false;

    $padding_horizontal_mm = is_percent ? padding_horizontal * A4_width:  padding_horizontal;
    $padding_vertical_mm = is_percent ? padding_vertical * A4_height:  padding_vertical;;
    $padding_horizontal_mid_mm = is_percent ? padding_horizontal_mid * A4_width:  padding_horizontal_mid;;
    $padding_vertical_mid_mm = is_percent ? padding_vertical_mid * A4_height:  padding_vertical_mid;;

    if(is_percent) {

        $content_width_mm = ((1 - ((padding_horizontal * 2) + (padding_horizontal_mid * (A4_cols - 1)))) * A4_width)/A4_cols;
        $content_height_mm = ((1 - ((padding_vertical * 2) + (padding_vertical_mid * (A4_rows - 1)))) * A4_height)/A4_rows;

    } else {

        $content_width_mm = (A4_width - ((padding_horizontal * 2) + (padding_horizontal_mid * (A4_cols - 1))))/A4_cols;
        $content_height_mm = (A4_height - ((padding_vertical * 2) + (padding_vertical_mid * (A4_rows - 1))))/A4_rows;
    }

    if($debug){
        print "<pre>";

        print "Cool" . A4_width. "<br>";
        print "Cool" . ((padding_horizontal * 2) + (padding_horizontal_mid * (A4_cols - 1))). "<br>";


        print $content_width_mm." -- content_width_mm<br>";
        print $content_height_mm." -- content_height_mm<br>";
        print $padding_horizontal_mm." -- padding_horizontal_mm<br>";
        print $padding_vertical_mm." -- padding_vertical_mm<br>";
        print $padding_horizontal_mid_mm." -- padding_horizontal_mid_mm<br>";
        print $padding_vertical_mid_mm." -- padding_vertical_mid_mm<br>";
        print $text . " -- T<br>";
        print $x . " -- X<br>";
        print $y . " -- Y<br>";
    }


/*    $content_height = ($box_height * (1 - (padding_vertical + padding_vertical_mid * (A4_rows - 1))));
    $content_width = ($box_width * (1 - ((padding_horizontal * 2) + (padding_horizontal_mid * (A4_cols - 1)))));*/

    $x = $padding_horizontal_mm + (($content_width_mm + $padding_horizontal_mid_mm) * $x);

    $y = $padding_vertical_mm + (($content_height_mm + $padding_vertical_mid_mm) * $y);


    if($debug){
        print $x . " -- X<br>";
        print $y . " -- Y<br>";
    }
    $pdf->SetXY($x, $y);
    $pdf->MultiCell($content_width_mm, $content_height_mm, $text, 1, 'C');
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->SetMargins(0, 0);
$pdf->SetAutoPageBreak(false);
$x = $y = 0;

$card = "";

for($i=0; $i < 200; $i ++) {
    AddLabelsToPdf($x, $y, $pdf, $card);

    $y++; // next row
    if($y == A4_rows) { // end of page wrap to next column
        $x++;
        $y = 0;
        if($x == A4_cols) { // end of page
            $x = 0;
            $y = 0;
            $pdf->AddPage();
        }
    }
}
$pdf->Output('Labels.pdf', 'D');