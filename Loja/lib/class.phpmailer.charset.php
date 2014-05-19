<?php
require $_SERVER['DOCUMENT_ROOT'] .'/lib/phpmailer/class.phpmailer.php';

class PHPMailer_charset extends PHPMailer{
	
	function __construct(){
		parent::__construct();
		$this->CharSet = 'utf-8';
	}
	
}