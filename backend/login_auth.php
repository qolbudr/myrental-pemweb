<?php
require "../functions/database.php";
require "../functions/url_helper.php";

$DB = new database();

$where = [
	"user_email" => $_POST['user_email'],
	"user_password" => $_POST['user_pass']
];

$row = $DB->get('tb_user', $where);

if(count($row) > 0) {
	session_start();
	$_SESSION['user_name'] 		= $row["0"]["user_name"];
	$_SESSION['user_email'] 	= $row["0"]["user_email"];
	$_SESSION['user_id'] 		= $row["0"]["user_id"];
	$_SESSION['user_type'] 		= $row["0"]["user_type"];
	$_SESSION['user_status'] 	= 'authorized';
	header("location: ".$url->myurl);
} else {
	header("location: ".$url->this("/login?status=".base64_encode('login_failed')));
}


?>