<?php

require "../functions/url_helper.php";

session_start();
session_destroy();

header("location: ".$url->myurl);

?>