<?php

require "../functions/database.php";
$DB = new database();

$data = $DB->query("SELECT * FROM `tb_car` INNER JOIN `tb_user` ON `tb_car`.user_id = `tb_user`.user_id WHERE `tb_car`.car_location LIKE '%".$_GET['q']."%' OR `tb_car`.car_area LIKE '%".$_GET['q']."%'");

print_r(count($data));

?>

