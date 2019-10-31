<?php

require("../../includes/config.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    $tournamentID = $_GET["id"];
	if( !exists("tournament", $tournamentID) )
		redirect("");

	if( nonEmpty($_GET["onClick"]) )
		$onClick = $_GET["onClick"];
	else
		$onClick = "default";
	
	lobbyGenerate($tournamentID, $onClick);
}
else
{
	redirect("");
}


function lobbyGenerate($tournamentID, $onClick)
{
	$query = "SELECT TV.tournament, TV.status FROM generalTournamentView TV 
			WHERE TV.tournamentID=?";
	$data = query($query, $tournamentID);
	$tournamentName = $data[0][0];
	$status = $data[0][1];

	render("tournaments/lobby.php", ["title"=>$tournamentName, 
		"tournamentName"=>$tournamentName, "tournamentID"=>$tournamentID, "status"=>$status, "onClick"=>$onClick]);

}
?>
