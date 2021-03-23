<?php

require "../functions/database.php";
require "../functions/url_helper.php";

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

$user_id = $_SESSION['user_id'];

$dir  = '../assets/images/user/'.$_SESSION['user_id'].'/';

if(is_dir($dir)) {
	deleteDir($dir);
}

$DB->delete('tb_user', [ "user_id" => $_SESSION['user_id']]);

echo '<script>window.location = "'.$url->this('/backend/logout.php').'"</script>';

?>