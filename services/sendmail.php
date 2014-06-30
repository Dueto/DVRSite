<?php
require("../classes/request.php");


if(isset($_GET['name']) && isset($_GET['telephone']))
{
	$request = new Request($_GET);
	$request->processRequest();
}
else
{
	echo "wronginput";
}



?>