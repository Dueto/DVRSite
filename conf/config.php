<?php
date_default_timezone_set('Etc/UTC');


$PROJECT_NAME = "DVR";
$MAILER_LANGUAGE = "ru";

$DB = array
(
	"host" => "localhost",
	"port" => 3306,
	"database" => "clients",
	"user" => "inserter",
	"password" => "inserter"
);


$MAILING_LIST = 
	array
	(
		"smtpServer" => "smtp.gmail.com",
		"port" => 587,
		"smtpAuth" => true,
		"smtpSecure" => "tls",
		"user" => "dvrholder@gmail.com",
		"password" => "Dvrholder123",
		"from" => "dvrholder@gmail.com",
		"fromName" => "DVR sender",
		"address" => "dvrholder@gmail.com",
		"subject" => "New appointment from "
	);


?>