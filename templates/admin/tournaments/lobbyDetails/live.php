<?php
//bracket, tournamentID

$query = "SELECT TV.counter, TV.player1Name, TV.player2Name,  
	TV.bestOF, TV.player1Score, TV.player2Score,
	TV.points1, TV.points2, TV.break1, TV.break2, TV.photo1, TV.photo2 
	FROM matchesTournamentView TV  
	WHERE TV.tournamentID=? AND TV.status=?
	ORDER BY TV.counter";

$data = query($query, $tournamentID, "Live");

//live matches exist
if(count($data) > 0)
{
	//print all of them
	for($i = 0; $i < count($data); $i++)
	{
		$counter = $data[$i][0];
		$player1 = $data[$i][1]; $player2 = $data[$i][2];
		$bestOf = $data[$i][3];

		$score1 = $data[$i][4]; $score2 = $data[$i][5];
		$points1 = $data[$i][6]; $points2 = $data[$i][7];
		$break1 = $data[$i][8]; $break2 = $data[$i][9];
		$img1 = $data[$i][10]; $img2 = $data[$i][11];

		printLiveMatch($counter, $player1, $score1, $points1, $break1, $img1, $player2, $score2, $points2, $break2, $img2, $bestOf);
	}
}
else
{
	?><mark>No Live matches available</mark><?php
}


function printPlayer($name, $img)
{ ?>

<div class="list-match-lobby-player">
	<span class="list-match-lobby-player-name"><?=$name?></span>
	<p>
		<img class="list-match-lobby-player-img" alt="img" src="<?=PLAYER_IMG.$img?>">
	</p>
</div>

<?php }


function printLiveMatch($matchNum, $player1, $score1, $points1, $break1, $img1, $player2, $score2, $points2, $break2, $img2, $bestOf)
{ ?>

   <div class="list-match-lobby-table">
		<h3 class="list-match-lobby-info">Раунд 1 - Зустріч <?=$matchNum?></h3>
		<div class="list-match-lobby-player-table">
			<?php printPlayer($player1, $img1); ?>
			<div class="list-match-lobby-frame-section">
				<table class="list-match-lobby-frame-table">
					<tbody>
						<tr>
							<td><?=$score1?></td>
							<th>Frames</th>
							<td><?=$score2?></td>
						</tr>
						<tr class="list-match-lobby-frame-details">
							<td colspan="3">Best of <?=$bestOf?></td>
						</tr>
						<tr>
							<td><?=$points1?></td>
							<th>Points</th>
							<td><?=$points2?></td>
 						</tr>
						<tr class="list-match-lobby-frame-details">
							<td colspan="3"></td>
						</tr>
						<tr>
							<td><?=$break1?></td>
							<th>Break</th>
							<td><?=$break2?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php printPlayer($player2, $img2); ?>
		</div>
	</div>
	</br>

<?php } ?>
