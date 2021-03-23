<?php
require '../functions/database.php';
require '../functions/url_helper.php';

session_start();

$DB = new database();
$status = $_GET['status'];

if(empty($_GET['change'])) {
	$car_id = $_GET['car_id'];
	$car = $DB->query('SELECT * FROM `tb_car` INNER JOIN `tb_user` ON `tb_car`.user_id = `tb_user`.user_id WHERE `tb_car`.car_id = "'.$car_id.'"')[0];
	$user = $DB->get('tb_user', ['user_id' => $_SESSION['user_id']])[0];
	$day = $_GET['day'];

	$data = [
		"car_id" => $car['car_id'],
		"user_id" => $user['user_id'],
		"book_start" => date('Y-m-d'),
		"book_end" => date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$day.' days')),
	];

	if($status == 'success') {
		$data['book_status'] = 1;
	} else if($status == 'pending') {
		$data['book_status'] = 4;
		$data['book_snap'] = $_GET['token'];
	} else {
		$data['book_status'] = 0;
	}

	$DB->insert('tb_book', $data);
	echo '<script>window.location = "'.$url->this('/account/user/clientarea#book-box').'"</script>';
} else {
	$book_id = $_GET['book_id'];
	if($status == 'success') {
		$DB->update('tb_book', ['book_status' => 1], ['book_id' => $book_id]);
	} else if($status == 'approve') {
		$DB->update('tb_book', ['book_status' => 2], ['book_id' => $book_id]);
	} else {
		$DB->update('tb_book', ['book_status' => 0], ['book_id' => $book_id]);
	}
	echo '<script>window.location = "'.$url->this('/account/user/clientarea').'"</script>';
}

?>