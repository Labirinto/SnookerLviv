<?php
//tournamentID

$data = query("select nrOfGroups from tournament where id=?", $tournamentID);
$G_R = $data[0][0];


for($i = 1; $i <= $G_R; $i++)
{?>
	<div class="group">
		<div class="round_num_div"><h3 class="matches_list_table_round_num">група <?=$i?></h3></div>
		<div class="group_border_radius">
		<table class="group-table">	
			<?php printGroup($tournamentID, $i); ?>
		</table>
		</div>
	</div>
<?php }

?></div><?php

function printMatches($id, $groupNum, $playerNum, $nrOfPlayers, $isBottom)
{
	$query = "SELECT PG.id, PG.mWon, PG.mLost, PG.fWon, PG.fLost 
		FROM playerGroup PG JOIN groupTournament GT ON PG.groupID = GT.id
		WHERE GT.tournamentID=? AND PG.playerNum=? AND GT.groupNum=?";
	$data = query($query, $id, $playerNum, $groupNum);
	$playerGroupID = $data[0][0]; 
	$mWon = $data[0][1]; $mLost = $data[0][2];	
	$fWon = $data[0][3]; $fLost = $data[0][4];	

	$query = "SELECT GM.matchID, GM.status, 
	IF(GM.player1Num=?, GM.player2Num, GM.player1Num) AS enemyNum,
	IF(GM.player1Num=?, GM.player1Score,GM.player2Score) AS myScore, 
	IF(GM.player1Num=?, GM.player2Score,GM.player1Score) AS enemyScore
	FROM groupMatchesView GM 
	WHERE GM.tournamentID=? AND GM.groupNum=?
	AND (GM.player1Num=? OR GM.player2Num=?) ORDER BY enemyNum";

	$data = query($query,$playerNum,$playerNum,$playerNum,$id,$groupNum,$playerNum,$playerNum);
	
	$k = 0;
	$matches = $mWon + $mLost;
	for($i=1; $i<=$nrOfPlayers; $i++)
	{
		if($i === $playerNum){
			print("<td>X</td>");
		}
		else{
			$mID = $data[$k][0]; $mStatus = $data[$k][1];
			$score1 = $data[$k][3]; $score2 = $data[$k][4];
			?><td><a href="matchLobby.php?id=<?=$mID?>"><?=$score1?>:<?=$score2?></a></td><?php 
			$k++;
		}
	}
	$dMatches = ($matches !== 0) ? $mWon/$matches : 0;
	$dFrames = ($fWon+$fLost !== 0) ? $fWon/($fWon+$fLost) : 0;
	$res = ( (4/3)*$dMatches + (2/3)*$dFrames ) / 2;
	$res = round($res*100, 2);
?>
			<td><?=$matches?></td>
			<td><?=$mWon?></td>
			<td><?=$mLost?></td>
			<td><?=($mWon-$mLost)?></td>
			<td><?=$fWon?></td>
			<td><?=$fLost?></td> 
			<td><?=($fWon-$fLost)?></td>
			<td class="<?=$isBottom?>"><?=$res?>%</td>
<?php
}

function firstRow($nrOfPlrs)
{ ?>
		<tr>
			<th>#</th>
			<th>Гравець</th>
			<?php for($i=1;$i<=$nrOfPlrs;$i++) print("<th>$i</th>"); ?>
			<th>m</th>
			<th>+m</th>
			<th>-m</th>
			<th>Δm</th>
			<th>+f</th>
			<th>-f</th>
			<th>Δf</th>
			<th>%</th>
		</tr>
<?php }

function playerRow($e_o,$last,$playerName, $playerNum, $playerID, $seed, $nrOfPlayers, $groupNum, $id)
{ 
	if($last)
		$isBottom = "radius_br";
	else
		$isBottom = "";
?>
	<tr class="group_row_<?=$e_o?>">
		<td class="group_<?=$e_o?>_num<?=($last)?" radius_bl":""?>"><?=$playerNum?></td>
		<td><?=$playerName?>(<?=$seed?>)</td>
		<?php
			
			printMatches($id, $groupNum, $playerNum, $nrOfPlayers, $isBottom);

		?>
	</tr>
<?php }

function printGroup($tournID, $groupNo)
{
    $query = "SELECT PG.playerNum, PG.playerName, PG.playerID, PG.playerSeed
        FROM playerGroupView PG
        WHERE PG.tournamentID=? AND PG.groupNum=?
        ORDER BY PG.playerNum";

    $data = query($query, $tournID, $groupNo);
	$nrOfPlayers = count($data);
	
	?><thead><?php
	firstRow($nrOfPlayers);
	?></thead>
	<tbody><?php

	for($i = 0; $i < $nrOfPlayers; $i++)
    {
        $playerNum = $data[$i][0];
        $playerName = $data[$i][1]; $playerID = $data[$i][2];
        $seed = $data[$i][3];
		$e_o = ($i%2) ? "even" : "odd";
		$last = ($i+1 < $nrOfPlayers) ? false : true;

		playerRow($e_o,$last,$playerName, $playerNum, $playerID, $seed, $nrOfPlayers, $groupNo, $tournID);
    }
	?></tbody><?php
}
?>

