<?php

require "../functions/database.php";
require "../functions/url_helper.php";

$DB = new database();

$where = ["book_id" => $_POST['book_id']];
$data = $DB->get('tb_book', $where)[0];

echo $data['book_snap'];

?>