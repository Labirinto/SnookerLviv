<?php

require("functions.php");
require("constants.php");

session_start();

if(!adminCheck())
{
	redirect("/public/logout.php");
}

?>
