<?php

require '../vendor/autoload.php';
require 'database.php';

session_start();

$car_id = $_POST['car_id'];
$day = $_POST['day'];

$DB = new database();

$car = $DB->query('SELECT * FROM `tb_car` INNER JOIN `tb_user` ON `tb_car`.user_id = `tb_user`.user_id WHERE `tb_car`.car_id = "'.$car_id.'"')[0];
$user = $DB->get('tb_user', ["user_id" => $_SESSION['user_id']])[0];

Midtrans\Config::$serverKey = 'SB-Mid-server-254q-pnbte_aGGLkpzE9LgAQ';
Midtrans\Config::$isProduction = false;
Midtrans\Config::$isSanitized = true;
Midtrans\Config::$is3ds = true;

$transaction_details = array(
  'order_id'    => time(),
  'gross_amount'  => $car['car_price']
);

$items = array(
    array(
        'id'       => time(),
        'price'    => $car['car_price'] * (int)$day,
        'quantity' => 1,
        'name'     => $car['car_name']
    )
);

// Populate customer's billing address
$billing_address = array(
    'first_name'   => $user['user_name'],
    'address'      => $user['user_address'],
    'phone'        => $user['user_phone'],
    'country_code' => 'IDN'
);

// Populate customer's info
$customer_details = array(
    'first_name'       => $user['user_name'],
    'email'            => $user['user_email'],
    'phone'            => $user['user_phone'],
    'billing_address'  => $billing_address
);

$transaction_data = array(
    'transaction_details'   => $transaction_details,
    'item_details'          => $items,
    'customer_details'      => $customer_details
);

$snapToken = Midtrans\Snap::getSnapToken($transaction_data);
echo $snapToken;

?>