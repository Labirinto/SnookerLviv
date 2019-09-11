<?php

require("../../../includes/adminConfig.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	redirect("");
}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$tableID = $_POST["tableID"];	
	$matchID = $_POST["matchID"];	

	if( !exists("_table", $tableID) || !exists("_match", $matchID) )
		redirect("");

	$matchHeader = getHeader($tableID);

	$youtube = "-zZbkPnBtS8";
	
	query("UPDATE _match M SET M.youtube=? WHERE M.id=?", $youtube, $matchID);

	redirect("tableLobby.php?id=$tableID");	
}


function getHeader($tableID)
{
	$query = "SELECT TV.Player1, TV.player2, TV.tournamentName
		FROM tableView TV WHERE TV.tableID=?";
	$data = query($query, $tableID);
	$player1 = $data[0][0]; $player2 = $data[0][1];
	$tournament = $data[0][2];

	$header = $player1." v ".$player2." ".$tournament;

	return $header;
}

?>
