
<h1><a href="lobby.php?id=<?=$clubID?>"><?=$clubName?></a></h1>
<h4><mark>TODO: </br>1.start sparring(with players selection)</mark></h4>

<h3>Table <?=$tableNum."(<mark>".$tableStatus."</mark>)"?></h3>

<?php

if( !strcmp($tableStatus, "Available") )
{
	showAvailable($tableID, $clubID);
}
else if( !strcmp($tableStatus, "Occupied") )
{
	showOccupied($tableID, $clubID);
}


function showAvailable($tableID, $clubID)
{ 
	sparringForm($tableID);
	
	$query="SELECT MV.matchID, MV.counter, MV.Player1, MV.Player2
		FROM matchView MV
		WHERE MV.status=? AND MV.clubID=?
		AND MV.player1ID != -2 AND MV.player2ID != -2 ORDER BY 2";
	
	$data = query($query, "Announced", $clubID);
	if(count($data)>0)
	{
		?><select name="matchID"><?php
		for($i=0; $i<count($data); $i++)
		{
			$matchID = $data[$i][0]; $counter = $data[$i][1];
			$player1 = $data[$i][2]; $player2 = $data[$i][3];
		?><option value="<?=$matchID?>"><?=$counter?>: <?=$player1?>-<?=$player2?></option><?php
		}
		?><input type="submit" name="match" value="start match"/><?php
	}
	?></form><?php 
}

function sparringForm($tableID)
{ ?>
	<form action="tableLobby.php" method="post">
		<input type="hidden" name="id" value="<?=$tableID?>"/>
		<input type="submit" name="sparring" value="start sparring(todo)"/> </br></br>
<?php }


function showOccupied($tableID, $clubID)
{
	$query = "SELECT TV.matchCounter, TV.matchStatus, 
		TV.Player1, TV.Player2, 
        TV.bestOf, TV.player1Score, TV.player2Score, 
		TV.tournamentName, TV.tournamentID, TV.youtube, TV.matchID
        FROM tableView TV WHERE TV.tableID=?";

    $data = query($query, $tableID);
	$tournamentName = $data[0][7]; $tournamentID = $data[0][8];
	$matchCounter = $data[0][0]; $matchStatus = $data[0][1];
	$player1 = $data[0][2]; $player2 = $data[0][3];
	$score1 = $data[0][5]; $score2 = $data[0][6];
	$bestOf = $data[0][4]; $youtube = $data[0][9];
	$matchID = $data[0][10];
?>
	
	<a href="../tournaments/lobby.php?id=<?=$tournamentID?>"><h4><?=$tournamentName?></h4></a>
</br><?php
	
	if( isset($youtube) ){ ?>
		<a href=<?=(YT_HEADER.$youtube)?>>YOUTUBE</a>
	<?php }
	else{ ?>
		<form action="YTstart.php" method="post">
			<input type="hidden" name="matchID" value="<?=$matchID?>"/>
			<input type="hidden" name="tableID" value="<?=$tableID?>"/>
			<button type="submit">START BROADCASTING</button>
		</form>
	<?php } ?>
	
	</br></br>
	<a href="live-match-lobby.php?tableID=<?=$tableID?>&matchID=<?=$matchID?>">LIVE TABLE</a>
	</br></br>

	<mark><?=$matchStatus?></mark>
</br>
    <?=$matchCounter?>: <?=$player1?> - <?=$player2?>
</br>
    Score: <?=$score1?>-<?=$score2?>
</br>
    Best of(<?=$bestOf?>)
</br></br>

<?php	
	if(!strcmp($matchStatus, "Live"))
		liveForm($tableID);
	else if(!strcmp($matchStatus, "Finished"))
		finishedForm($tableID, $tournamentID);
}

function liveForm($tableID)
{ ?>

	<form action="tableLobby.php" method="post">
		<input type="hidden" name="id" value="<?=$tableID?>"/>
		<input type="submit" name="first" value="1x"/>
		<input type="submit" name="second" value="2x"/> </br></br>
		DELETE ALL MATCH DATA <input type="submit" name="reset" value="STOP MATCH"> WATCH OUT
	</form>

<?php }

function finishedForm($tableID, $tournamentID)
{ ?>

	<form action="tableLobby.php" method="post">
		<input type="hidden" name="id" value="<?=$tableID?>"/>
		<input type="hidden" name="tournament" value="<?=$tournamentID?>"/>	
		<input type="submit" name="exit" value="exit"/>
		<input type="submit" name="next" value="next match"/>
	</form>

<?php }

?>

