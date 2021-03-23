<?php
require "../functions/database.php";
require "../functions/url_helper.php";

$DB = new database();

$data = [
	"user_name" 	=> $_POST['user_name'],
	"user_password" => $_POST['user_pass'],
	"user_email" => $_POST['user_email'],	
	"user_type" => $_POST['user_type'],
	"user_address" => '',
	"user_phone" => '',
	"user_photo" => '',
];

$DB->insert('tb_user', $data);
header('Location: '.$url->this('/login?status='.base64_encode('register_success')));

?>