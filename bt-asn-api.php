<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$type = isset($_GET['type']) ? $_GET['type'] : 'res';
$api = $_GET['api'];

$dir    = './res';
$files1 = scandir($dir);
$apis = array_diff($files1, array('.', '..'));

if(!in_array($_GET['api'],$apis)) {
    return print 'Pass api parameter as '.implode(' | ',$apis);
}

$file_content = file_get_contents('./'.$type.'/'.$api);

function is_json($string,$return_data = false) {
    $data = json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : json_encode(["Invalid Json"]);
}

if (0 === strpos($file_content, '?')) {
    print $file_content;
} else {
    header('Content-Type: application/json');
    if(is_json($file_content)){
        print $file_content;
    }
}