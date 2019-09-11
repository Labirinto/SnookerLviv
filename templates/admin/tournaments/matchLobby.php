<?php list($tournamentName, $tournamentID, $status) = getMainData($matchID);?>

<div class="lobbyBlock">
	<a href="lobby.php?id=<?=$tournamentID?>"><h1><?=$tournamentName?></h1></a>

<?php

lobby($matchID);


function lobby($matchID)
{
	list($counter,$roundType,$roundNo,$bestOF,$id1,$name1,$score1,$id2,$name2,$score2) = getMatchData($matchID);
	printLobby($counter,$roundType,$roundNo,$bestOF,$id1,$name1,$score1,$id2,$name2,$score2);
	printFrames($matchID);
}


function printLobby($counter, $roundType, $roundNo, $bestOF, $id1, $name1, $score1, $id2, $name2, $score2)
{ ?>

	<table class="lobby">
		<tbody class="lobby-tbody">
			<tr>
				<td class="match-info" colspan="3"><i>Зустріч №<?=$counter?> | Раунд <?=$roundNo?>(<?=$roundType?>)</i></td>
			</tr>
			<tr class="versus">
				<td class="player01">
					<div><h3 class="lobby3"><?=$name1?></h3></div>
					<div><img alt="player01" height="100px" width="100px" src="../../img/brain.png"></div>
				</td>
				<td class="versus-info">
					<h4 class="lobby4"><?=$score1?> &nbsp &nbsp &nbsp <span class="versus-symbol">v</span> &nbsp &nbsp &nbsp <?=$score2?></h4> <h5 class="lobby5">best of <?=$bestOF?></h5>
				</td>
				<td class="player02">
					<div><h3 class="lobby3"><?=$name2?></h3></div>
					<div><img alt="player02" height="100px" width="100px" src="../../img/brain.png"></div>
				</td>
			</tr>
		</tbody>
	</table>

<?php }


function framesHeader()
{ ?>

<div class="frames-info">
	<table class="frames-table">
		<tfoot class="frames-tfoot">
		<tr>
			<th>breaks</th>
			<th>points</th>
			<th>frames</th>
			<th>points</th>
			<th>breaks</th>
		</tr>

<?php }


function printFrame($counter, $score1, $score2, $breaks1, $breaks2)
{ ?>

	<tr>
		<td><?=$breaks1?></td>
		<td><?=$score1?></td>
		<td><?=$counter?></td>
		<td><?=$score2?></td>
		<td><?=$breaks2?></td>
	</tr>

<?php }

function framesFooter()
{ ?>

		</tfoot>
	</table>
</div>

<?php }

function printFrames($matchID)
{
	$query = "SELECT F.counter, F.points1, F.points2 
		FROM frame F WHERE F.matchID=? ORDER BY F.counter";
	$data = query($query, $matchID);
	if( count($data) > 0 )
		framesHeader();

	for($i = 0; $i < count($data); $i++)
	{
		$frame = $data[$i][0];
		$points1 = $data[$i][1]; $points2 = $data[$i][2];
		
		$query = "SELECT B.XorY, B.points FROM break B
			WHERE B.frameCounter=? AND B.matchID=? ORDER BY 1, 2 DESC";
		$breaks = query($query, $frame, $matchID);
		$breaks1 = ""; $breaks2 = "";
		for($j = 0; $j < count($breaks); $j++)
		{
			$xORy = $breaks[$j][0]; $points = $breaks[$j][1];
			if($xORy) $breaks1 .= ($points.", ");
			else $breaks2 .= ($points.", ");
		}
		$breaks1 = substr($breaks1, 0, -2);
		$breaks2 = substr($breaks2, 0, -2);

		printFrame($i+1, $points1, $points2, $breaks1, $breaks2);
	}
	
	if( count($data) > 0 )
		framesFooter();
}


function getMatchData($matchID)
{
	$query = "SELECT MV.counter, MV.roundType, MV.roundNo, MV.bestOF,
		MV.player1ID, MV.Player1, MV.player1Score,
		MV.player2ID, MV.Player2, MV.player2Score
		FROM matchView MV WHERE matchID = ?"; 
	$data = query($query, $matchID);

	return array($data[0][0],$data[0][1],$data[0][2],$data[0][3],$data[0][4],$data[0][5],$data[0][6],$data[0][7],$data[0][8],$data[0][9]);
	
}

function getMainData($matchID)
{
	$query = "SELECT MV.tournamentID, MV.tournamentName, MV.status
    FROM matchView MV WHERE matchID = ?"; 
	$data = query($query, $matchID);

	$tournamentName = $data[0][1]; $tournamentID = $data[0][0];
	$status = $data[0][2];
	return array($tournamentName, $tournamentID, $status);
}

?> </div>
