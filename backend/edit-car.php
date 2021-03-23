<?php

require "../functions/database.php";
require "../functions/url_helper.php";

session_start();
$DB = new database();

$id = $_POST['car_id'];

function uploadImage($file, $id, $index) {
	global $url;
	$dir  = '../assets/images/user/'.$_SESSION['user_id'].'/car-'.$id.'/';
	if(!is_dir($dir)) {
		mkdir($dir);
	}
	$ext  = strtolower(pathinfo($file["name"][$index], PATHINFO_EXTENSION));
	$name = 'user_car_'.$index.'.'.$ext;
	$path = $dir.$name;
	move_uploaded_file($file['tmp_name'][$index], $path);
	return $name;
}

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

$data = [
	"user_id" 		  => $_SESSION['user_id'],
	"car_name" 		  => $_POST['car_name'],
	"car_door" 		  => $_POST['car_door'],
	"car_seat" 		  => $_POST['car_seat'],
	"car_transmision" => $_POST['car_transmision'],
	"car_age" 		  => $_POST['car_age'],
	"car_location"    => $_POST['car_location'],
	"car_area"		  => $_POST['car_area'],
	"car_lat"		  => $_POST['car_lat'],
	"car_long"		  => $_POST['car_long'],
	"car_price"       => $_POST['car_price']
];

$DB->update('tb_car', $data, ['car_id' => $id]);

if(!empty($_FILES['car_photo']['name'][0] ?? '')) {
	$DB->delete('tb_photo', ['car_id' => $id ]);
	$dir  = '../assets/images/user/'.$_SESSION['user_id'].'/car-'.$id.'/';
	if(is_dir($dir)) {
		deleteDir($dir);
	}
	$length = count($_FILES['car_photo']['name']);
	$photo = $_FILES['car_photo'];
	for($i = 0; $i < $length; $i++) {
		$name = uploadImage($photo, $id, $i);
		$data = [
			"car_id" => $id,
			"car_photo" => $name 
		];
		$DB->insert('tb_photo', $data);
	}
}

echo '<script>window.location = "'.$url->this('/account/owner/clientarea').'"</script>';

?>