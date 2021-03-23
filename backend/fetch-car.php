<?php

require "../functions/database.php";
$DB = new database();

$data = $DB->get('tb_car', ["car_id" => $_POST['car_id']]);
header('Content-Type: application/json');
return print_r(json_encode($data[0]));

?>