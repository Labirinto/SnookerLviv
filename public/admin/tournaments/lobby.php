<?php

require("../../../includes/adminConfig.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    $tournamentID = $_GET["id"];
	if( !exists("tournament", $tournamentID) )
		redirect(PATH_H."logout.php");

	if( nonEmpty($_GET["onClick"]) )
		$onClick = $_GET["onClick"];
	else
		$onClick = "default";
	
	lobbyGenerate($tournamentID, $onClick);
}
else
{
	redirect(PATH_H."logout.php");
}


function lobbyGenerate($tournamentID, $onClick)
{
	$query = "SELECT TV.tournament, TV.status FROM generalTournamentView TV 
			WHERE TV.tournamentID=?";
	$data = query($query, $tournamentID);
	$tournamentName = $data[0][0];
	$status = $data[0][1];

	if($status == "Live" || $status == "Finished")
	{
		redirect(PATH_H."tournaments/lobby.php?id=".$tournamentID);
	}
	else
	{
		adminRender("tournaments/lobby.php",
		["title"=>$tournamentName, "tournamentName"=>$tournamentName,
		"tournamentID"=>$tournamentID, "status"=>$status,
		"onClick"=>$onClick]);

	}
}
?>
