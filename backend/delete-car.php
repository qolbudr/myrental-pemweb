<?php

require "../functions/database.php";
require "../functions/url_helper.php";

$DB = new database();

session_start();

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

$DB->delete('tb_car', [ "car_id" => $_GET['car_id']]);
$DB->delete('tb_photo', [ "car_id" => $_GET['car_id']]);

$dir  = '../assets/images/user/'.$_SESSION['user_id'].'/car-'.$_GET['car_id'].'/';
if(is_dir($dir)) {
	deleteDir($dir);
}

echo '<script>window.location = "'.$url->this('/account/user/clientarea').'"</script>';