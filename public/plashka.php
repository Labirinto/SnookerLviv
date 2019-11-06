<?php

require("../includes/config.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	$tableID = $_GET["id"];

	if( exists("_table", $tableID) )
	{
		lobbyGenerate($tableID);
	}
	else
	{
		redirect(PATH_H);
	}
}
else
{
	redirect(PATH_H);
}


function lobbyGenerate($tableID)
{
	$query = "SELECT TV.Player1, TV.Player2,
		TV.player1Score, TV.player2Score, TV.bestOf,
        TV.points1, TV.points2, TV.break1, TV.break2,
		TV.tournamentName, TV.clubName, TV._number
        FROM tableView TV WHERE TV.tableID = ?";

	$data = query($query, $tableID);

	$player1 = $data[0][0]; $player2 = $data[0][1];
	$frames1 = $data[0][2]; $frames2 = $data[0][3];
	$bestOf = $data[0][4];

	$points1 = $data[0][5]; $points2 = $data[0][6];
	$break1 = $data[0][7]; $break2 = $data[0][8];

	$clubName = $data[0][10]; $tableNum = $data[0][11];

	
	$highlight1 = ""; $highlight2 = "";
	nonEmpty($break1) ? $highlight1.=" highlight" : $highlight2.=" highlight";


	require("plashka.html");
}
?>
