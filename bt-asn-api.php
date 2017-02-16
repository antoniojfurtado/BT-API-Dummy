<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$type = isset($_GET['type']) ? $_GET['type'] : 'res';
$api = $_GET['api'];

$apis = [
'createASN' => 'POST',
'addProducttoExistingASN' => 'POST',

'listASNs' => 'GET',
'getASNLineItems' => 'GET',

'updateASN' => 'POST',
'addBoxestoASN' => 'POST',


];

if(!in_array($_GET['api'],array_keys($apis))) {
    return print 'Pass api parameter as '.implode(' | ',array_keys($apis));
}

$file_content = file_get_contents('./'.$type.'/'.$api.'.json');

function is_json($string,$return_data = false) {
    $data = json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : json_encode(["Invalid Json"]);
}

if($apis[$_GET['api']] == 'POST' || $type == 'res'){
    header('Content-Type: application/json');
    if(is_json($file_content)){
        print $file_content;
    }
} else {
    print $file_content;
}