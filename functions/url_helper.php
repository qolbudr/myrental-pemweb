<?php

class url {
  var $myurl;

  public function this($param) {
    return $this->myurl.$param;
  }

  public function segment($number) {
    $segment = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    return $segment[$number+1];
  }

}

$url = new url();
$web = "";
$url->myurl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$url->myurl .= "://" . $_SERVER['HTTP_HOST'];
$url->myurl .= $web;