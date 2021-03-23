<?php
	require "../functions/database.php";
	require "../functions/url_helper.php";

	session_start();

	$DB = new database();

	function uploadImage($file) {
		global $url;
		$dir  = '../assets/images/user/'.$_SESSION['user_id'].'/';
		if(!is_dir($dir)) {
			mkdir($dir);
		}
		$ext  = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
		$name = 'user_photo.'.$ext;
		$path = $dir.$name;
		move_uploaded_file($file['tmp_name'], $path);
		return $name;
	}

	$data = [
		"user_name" => $_POST["user_name"],
		"user_password" => $_POST["user_password"],
		"user_email" => $_POST["user_email"],
		"user_phone" => $_POST["user_phone"],
		"user_address" => $_POST["user_address"],
	]; 


	if($_POST['isUpload'] == 1) {
		if(!empty($_FILES['user_photo']['name'])) {
			$name = uploadImage($_FILES['user_photo']);
			$data['user_photo'] = $name;
		} else {
			$data['user_photo'] = '';
		}
	}

	$DB->update('tb_user', $data, ["user_id" => $_SESSION["user_id"]]);
	echo '<script>window.location = "'.$url->this('/account/user/clientarea').'"</script>';
?>