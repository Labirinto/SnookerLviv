<?php

require("../../../includes/adminConfig.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	adminRender("forms/tournament.php", ["title" => "Створити турнір"]);
}	
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST["name"];
	$leagueID = $_POST["league"];
	$clubID = $_POST["club"];
	$date = $_POST["date"];
	
	if(!nonEmpty($name, $leagueID, $clubID))
	{
		adminApology(INPUT_ERROR, "Необхідно заповнити всі поля");
		exit;
	}
	if( !exists("league", $leagueID) || !exists("club", $clubID) )
	{
		redirect(PATH_H."admin/");
	}

	if(count(query("select 1 from tournament where name=? and leagueID=? LIMIT 1", $name, $leagueID)))
	{
		adminApology(INPUT_ERROR, "Неможливо створити турнір. Спробуйте змінити одне з полів.");
		exit;
	}

	$query = "INSERT INTO tournament(name, leagueID, clubID) VALUES(?,?,?)";
	
	query($query, $name, $leagueID, $clubID);
	redirect(PATH_H."admin/");
}

?>
