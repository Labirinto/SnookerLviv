<?php

require("../../../includes/adminConfig.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	adminRender("clubs/form.php", ["title" => "Create club"]);
}	
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST["name"];
	$country = $_POST["country"];
	$city = $_POST["city"];
	$tables = $_POST["tables"];


	if( !nonEmpty($name, $country, $city, $tables) )
	{
		adminApology(INPUT_ERROR, "All fields required");
		exit;
	}
	
	$query = "INSERT INTO club(name, country, city, nrOfTables) 
			VALUES(?,?,?,?)";
	
	query($query, $name, $country, $city, $tables);
	redirect("");
}

?>
