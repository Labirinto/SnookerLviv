
<h1><?=$clubName?></h1>
<h4><mark>1.add table=>increments nrOfTables and adds entry into _table</br>2.remove table=>decrements nrOfTables(if>0) and removes entry from _table</mark></h4>
</br>

<?php
$query = "SELECT TV.tournamentID, TV.tournament FROM generalTournamentView TV
		WHERE TV.clubID=? AND TV.status=?";
$data = query($query, $clubID, "Live");
if(count($data) > 0)
{ ?>

<form action="lobby.php" method="post">
	<input type="hidden" name="club" value="<?=$clubID?>"/>
	Tournament <select name="tournament">
	<?php for($i=0; $i<count($data); $i++)
	{
		$tournamentID = $data[$i][0]; $tournamentName = $data[$i][1];?>
		<option value="<?=$tournamentID?>"><?=$tournamentName?></option>
	<?php } ?>
	<input type="submit" name="occupy" value="Occupy tables"/>
</form>

<?php }

$query = "SELECT TV.tableID, TV._number, TV.tableStatus, TV.Player1, TV.Player2, TV.matchStatus, TV.matchCounter
		FROM tableView TV WHERE clubID=? ORDER BY 2";
$data = query($query, $clubID);

for($i=0; $i<count($data); $i++)
{
	$tableID = $data[$i][0];$tableNum = $data[$i][1];
	$status = $data[$i][2];
	
	$player1 = $data[$i][3]; $player2 = $data[$i][4];
	$matchStatus = $data[$i][5]; $matchCounter = $data[$i][6];
	?>	

	<a href="tableLobby.php?id=<?=$tableID?>">
	<h2>Table <?=$tableNum?>(<mark><?=$status?></mark>)</h2>
	</a>
	<?php if( !strcmp($status,"Occupied") )
	{?>
		<p><?=$matchCounter?>: <?=$player1?>-<?=$player2?> (<mark><?=$matchStatus?></mark>)</p>
	<?php }
}
?>
