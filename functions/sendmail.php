<?php

class sendmail {
	public $to;
	public $body;
	public $type;
	public $subject;
	private $from = "Laundry Gans";

	public function send() {
		$headers = "From: ".$this->from."\r\n";

		if($this->type == "html") {
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
			return mail($this->to, $this->subject, $this->body, $headers);
		} else {
			return mail($this->to, $this->subject, $this->body, $headers);
		}
	}

}

$mail = new sendmail();