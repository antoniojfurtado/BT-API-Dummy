<?php
require('PrintLabels.php');
$print_labes = new PrintLabels();

$config = [
    'TOP_MARGIN' => 15.068,
    'SIDE_MARGIN' => 7.188,
    'VERTICAL_PITCH' => 38.075,
    'HORIZONTAL_PITCH' => 65.964,
    'LABEL_HEIGHT' => 38.100,
    'LABEL_WIDTH' => 63.500,
    'LABELS_ACROSS' => 3,
    'LABELS_ALONG' => 7,
]; // 'L-7160' config

$print_labes->setConfig($config);
$print_labes->setLabels(['ID : 1234', 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456'
,'ID : 1234', 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456',
    'ID : 1234', 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456',
    'ID : 1234', 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456',
    'ID : 1234', 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456',
    'ID : 1234', 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456' , 'ID : 123456'
]);
$print_labes->AddLabelsToPdf();
$print_labes->Output('Labels.pdf', 'D');