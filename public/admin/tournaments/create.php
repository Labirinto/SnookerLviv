<?php

require("../../../includes/adminConfig.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	adminRender("tournaments/form.php", ["title" => "Create tournament"]);
}	
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST["name"];
	$leagueID = $_POST["league"];
	$clubID = $_POST["club"];
	$date = $_POST["date"];
	
	if(!nonEmpty($name, $leagueID, $clubID))
	{
		adminApology(INPUT_ERROR, "All fields are required");
		exit;
	}
	if( !exists("league", $leagueID) || !exists("club", $clubID) )
	{
		redirect("");
	}

	if(count(query("select 1 from tournament where name=? and leagueID=? LIMIT 1", $name, $leagueID)))
	{
		adminApology(INPUT_ERROR, "Cannot create this tournament. Try to change one of its fields");
		exit;
	}

	$query = "INSERT INTO tournament(name, leagueID, clubID) VALUES(?,?,?)";
	
	query($query, $name, $leagueID, $clubID);
	redirect("");
}

?>
