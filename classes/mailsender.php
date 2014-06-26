<?php
require("../conf/config.php");
require 'PHPMailerAutoload.php';


class mailSender
{
	var $mailer;

	var $user; 
	var $password;

	var $smtpServer; 
	var $port;
	var $smtpAuth; 
	var $smtpSecure; 

	var $from;
	var $fromName;

	var $address;
	var $subject;
	var $messageBody;

	function __construct()
	{
		global $MAILING_LIST;
		global $MAILER_LANGUAGE;

		$this->mailer = new PHPMailer();

		$this->user = $MAILING_LIST["user"];
		$this->password = $MAILING_LIST["password"];

		$this->smtpServer = $MAILING_LIST["smtpServer"];
		$this->port = $MAILING_LIST["port"];
		$this->smtpAuth = $MAILING_LIST["smtpAuth"];
		$this->smtpSecure = $MAILING_LIST["smtpSecure"];

		$this->from = $MAILING_LIST["from"];
		$this->fromName = $MAILING_LIST["fromName"];

		$this->address = $MAILING_LIST["address"];
		$this->subject = $MAILING_LIST["subject"];

		$this->mailer->isSMTP();
		$this->mailer->Host = $this->smtpServer;
		$this->mailer->Port = $this->port;
		$this->mailer->SMTPAuth = $this->smtpAuth;		
		$this->mailer->Username = $this->user;
		$this->mailer->Password = $this->password;
		$this->mailer->SMTPSecure = $this->smtpSecure;

		$this->mailer->From = $this->from;
		$this->mailer->FromName = $this->fromName;
		$this->mailer->addAddress($this->address);
		$this->mailer->isHTML(false);		
	}

	function sendMail($name, $telephone)
	{
		$this->mailer->Subject = $this->subject . $name;
		$this->mailer->Body = "Новая заявка от: " . $name . " с.т. " . $telephone;
		if(!$this->mailer->send())
		{
			echo 'Unsuccess.';
		}
		else
		{
			echo 'Success.';
		}
	}

}



?>