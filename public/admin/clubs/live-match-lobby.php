<?php

require("../../../includes/adminConfig.php");

$tableID = isset($_GET["tableID"]) ? htmlspecialchars($_GET["tableID"]) : null;
if( !exists("_table", $tableID) ) {
	redirect("");
}

$query = "SELECT TV._number, TV.clubName, TV.tableStatus, TV.matchStatus, TV.matchCounter,
		TV.Player1, TV.Player2, TV.player1Score, TV.player2Score, TV.bestOf, TV.tournamentName,
		TV.points1, TV.points2, TV.break1, TV.break2,
		TV.roundType, TV.roundNo, TV.groupID
		FROM tableView TV WHERE TV.tableID = ?";
$data = query($query, $tableID);
$tableNum = $data[0][0]; $clubName = $data[0][1];

$tableStatus = $data[0][2]; $matchStatus = $data[0][3]; $matchNum = $data[0][4];
$player1 = $data[0][5]; $player2 = $data[0][6]; $bestOf = $data[0][9];
$score1 = $data[0][7]; $score2 = $data[0][8]; 
$points1 = $data[0][11]; $points2 = $data[0][12]; $break1 = $data[0][13]; $break2 = $data[0][14];
$roundType = $data[0][15]; $roundNo = $data[0][16]; $groupID = $data[0][17];

$player1class = "live-match-lobby-player"; $player2class = "live-match-lobby-player";
( nonEmpty($break1) ) ? ($player1class .= " highlight") : ($player2class .= " highlight");

$matchInfo = matchInfo($roundType, $roundNo, $groupID);

if( !strcmp($tableStatus, "Occupied") ) { 
	if( !strcmp($matchStatus, "Live") ){
		require("live_match.html");
	}
	else if( !strcmp($matchStatus, "Finished") ){
		require("finished_match.html");
	}
}
else {
	redirect("tableLobby.php?id=$tableID");
}

//liveSparringLobby finishedSparringLobby
//if tableStatus="available" -> availableSparringLobby

function matchInfo($roundType, $roundNo, $groupID){
	if( !strcmp($roundType, "Group") ){
		$data = query("SELECT G.groupNum FROM groupTournament G WHERE G.id=?", $groupID);
		$info = $roundType . " " . $data[0][0];
	}
	else {
		$info = $roundType . " " . $roundNo;
	}

	return $info;
}

?>
