<?php
require("../classes/mailsender.php");


if(isset($_GET['name']) && isset($_GET['telephone']))
{
	$sender = new mailSender();
	$telephone = $_GET['telephone'];
	$name = $_GET['name'];
	$sender->sendMail($name, $telephone);
}
else
{
	echo "wronginput";
}



?>