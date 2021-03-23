<?php

class Kirim {
	private $email = "qolbu.dzikru30@gmail.com";
	private $_send;

	public function __construct(sendmail $send) {
		$this->_send = $send;
	}

	public function kirim() {
		$this->_send->subject = "Thank you for your registration as vendor";
		$this->_send->to = $this->email;
		$this->_send->type = "html";
		$this->_send->body = str_replace(array("{{link}}", "{{password}}"), array('vendor/confirm?key=', 'sdfs'), file_get_contents("../assets/email/vendor_signup.html"));
		$this->_send->send();
	}
}

require "sendmail.php";
 
$mail = new sendmail();

$email = new Kirim($mail);

echo $email->kirim();
