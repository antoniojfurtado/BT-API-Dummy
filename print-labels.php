<?php


require('PrintLabels.php');

const TOP_MARGIN = 15.068;
const SIDE_MARGIN = 7.188;
const VERTICAL_PITCH = 38.075;
const HORIZONTAL_PITCH = 65.964;
const LABEL_HEIGHT = 38.100;
const LABEL_WIDTH = 63.500;
const LABELS_ACROSS = 3;
const LABELS_ALONG = 7;



$print_labes = new PrintLabels();
$print_labes->setHorizontalPitch(HORIZONTAL_PITCH);
$print_labes->setVerticalPitch(VERTICAL_PITCH);
$print_labes->setTopMargin(TOP_MARGIN);
$print_labes->setSideMargin(SIDE_MARGIN);

$print_labes->setLabelHeight(LABEL_HEIGHT);
$print_labes->setLabelWidth(LABEL_WIDTH);
$print_labes->setLabelsAcross(LABELS_ACROSS);
$print_labes->setLabelsAlong(LABELS_ALONG);
$print_labes->setLabels(['ID : 1234', 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456'
,'ID : 1234', 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456',
    'ID : 1234', 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456',
    'ID : 1234', 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456',
    'ID : 1234', 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456',
    'ID : 1234', 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456'
]);

$print_labes->AddLabelsToPdf();