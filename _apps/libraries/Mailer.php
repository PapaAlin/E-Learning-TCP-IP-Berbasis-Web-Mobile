<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailer {
    public function Mailer() {
        require_once('mailer/class.smtp.php'); //menginclude librari phpmailer
		require_once('mailer/class.phpmailer.php'); //menginclude librari phpmailer
    }
}