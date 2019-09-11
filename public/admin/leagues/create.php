<?php

require("../../../includes/adminConfig.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	adminRender("leagues/form.php", ["title" => "Create league"]);
}	
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST["name"];
	$billiard = $_POST["billiard"];
	$age = $_POST["age"];
	$org = $_POST["organisation"];
	$sex = $_POST["sex"];

	if( !nonEmpty($name, $billiard, $org, $age) )
	{
		adminApology(INPUT_ERROR, "All fields required");
		exit;
	}
	
	if( !exists("billiard", $billiard) )
	{
		adminApology(INPUT_ERROR, "Inappropriate billiard");
		exit;
	}
	if( !exists("organisation", $org) )
	{
		apology(INPUT_ERROR, "Inappropriate organisation");
		exit;
	}
	if( !exists("age", $age) )
	{
		apology(INPUT_ERROR, "Inappropriate age");
		exit;
	}


	$q = "SELECT 1 FROM league WHERE name=? AND billiardID=? 
		  AND ageID=? AND organisationID=? AND sex=?";
    $data = query($q, $name, $billiard, $age, $org, $sex);
	if(count($data) > 0)
	{
		adminApology(INPUT_ERROR, "Such league exists for this organisation");
		exit;
	}
	
	
	$query = "INSERT INTO league(name, ageID, sex, billiardID, organisationID) VALUES(?,?,?,?,?)";
	query($query, $name, $age, $sex, $billiard, $org);
	redirect("");
}

?>
