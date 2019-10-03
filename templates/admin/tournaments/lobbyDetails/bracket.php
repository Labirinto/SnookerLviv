<?php
//bracket, tournamentID

if(!strcmp($bracket, "K/O"))
{
?>
<section>
	<div class="bracket">
<?php    
	
	$data = query("select KO_Rounds, seeded_Round from tournament where id=?", $tournamentID);
    
	$KO_R = $data[0][0]; $seeded_R = $data[0][1];
	prepareRound("K/O", 0, $KO_R, $seeded_R, $tournamentID);
}
?>
	</div>
</section>
<?php

if(!strcmp($bracket, "D/E"))
{
?>
<section>
	<div class="bracket">
<?php	
	
	$data = query("select UP_Rounds,LOW_Rounds,KO_Rounds,seeded_Round from tournament where id=?", $tournamentID);
   
	$LOW_R = $data[0][1]; $KO_R = $data[0][2];
	$UP_R = $data[0][0]; $seeded_R = $data[0][3];

	prepareRound("LOW", 0, $LOW_R, $seeded_R, $tournamentID);
	prepareRound("UP", 0, $UP_R, $seeded_R, $tournamentID);
	prepareRound("K/O", $UP_R-1, $KO_R, $seeded_R, $tournamentID);
}
?>
	</div>
</section>
<?php

if(!strcmp($bracket, "GroupKO"))
{
?>
<section>
	<div class="bracket">
<?php	
	
	$data = query("select KO_Rounds, seeded_Round from tournament where id=?", $tournamentID);
    
	$KO_R = $data[0][0]; $seeded_R = $data[0][1];
	prepareRound("K/O", 0, $KO_R, $seeded_R, $tournamentID);
}
?>
	</div>
</section>
<?php


function prepareRound($roundType, $offset, $R, $seeded_R, $tournamentID)
{
	if( !strcmp($roundType,"LOW") )
	{
		for($i = $R; $i >= 1; $i--)
		{ ?>
			<div class="split <?=$roundType?>-<?=$i?>">
			<?php printRound($tournamentID, $i, $roundType, ($i==$R)?true:false);?>
			</div>
		<?php
		}
	}
	else
	{
		for($i = 1; $i < $seeded_R; $i++)
		{ ?>
			<div class="split <?=$roundType?>-1">
			<?php printRound($tournamentID, $i, $roundType, false);?>
			</div>
		<?php 
		} 

		for($i = $seeded_R; $i <= $R; $i++)
		{ ?>
			<div class="split <?=$roundType?>-<?=$i+$offset-$seeded_R+1?>">
			<?php printRound($tournamentID, $i, $roundType, false);?>
			</div>
		<?php 
		}
	}
}

function printRound($tournID, $Rno, $Rtype, $lowFlag) 
{ 
    $query = "SELECT TV.counter, TV.matchID, TV.player1Name, TV.player2Name,  
        TV.bestOf, TV.winnerMatchID, TV.loserPlaces, TV.loserMatchID, 
        TV.player1Score, TV.player2Score, TV.status, TV.youtube, 
		TV.player1Seed, TV.player2Seed
        FROM matchesTournamentView TV  
        WHERE TV.tournamentID=? AND TV.roundNo=? AND TV.roundType=? 
        ORDER BY TV.counter";

    $data = query($query, $tournID, $Rno, $Rtype);

    for($i = 0; $i < count($data); $i++)
    {
        $counter = $data[$i][0]; $matchID = $data[$i][1];
        $player1 = $data[$i][2]; $player2 = $data[$i][3];
		$seed1 = $data[$i][12]; $seed2 = $data[$i][13];
        $bestOf = $data[$i][4];
        $winnerMatch = $data[$i][5]; $loserMatch = $data[$i][7];
        $loserPlaces = $data[$i][6];

        $player1Score = $data[$i][8]; $player2Score = $data[$i][9];
        $status = $data[$i][10]; $youtube = $data[$i][11];

		if( !strcmp($Rtype, "UP") && $Rno > 1 )
			$upFlag = true;
		else
			$upFlag = false;
	
		//if( (!strcmp($Rtype,"UP") || !strcmp($Rtype,"K/O")) && $Rno === 1 )
		//{
			//if( strcmp($player1, "WALK OVER") )
			//	$player1 = "($seed1)$player1";
			//if( strcmp($player2, "WALK OVER") )
			//	$player2 = "($seed2)$player2";
		//}

		printBracketMatch($i, $matchID, $counter, $player1, $player1Score, $seed1, $player2, $player2Score, $seed2, $lowFlag, $upFlag, $loserMatch, $winnerMatch, $youtube);
    }
}

function printBracketMatch($i, $matchID, $matchNum, $player1, $score1, $seed1, $player2, $score2, $seed2, $lowFlag, $upFlag, $loserID, $winnerID, $youtube)
{ ?>
	<div class="bracket_item">
		<div class="match-number"> <?=$matchNum?> </div>
		<table class="brackets_match_table">
			<thead>
				<tr>
					<td>
						<i class="pre_numbers01"><?=$seed1?></i>
						<i class="pre_numbers02"><?=$seed2?></i>
					</td>
					<td>
						<i class="fab fa-youtube"></i>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div class="player_name"><?=$player1?></div>
					</td>
					<td>
						<div class="player_points"><?=$score1?></div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="player_name"><?=$player2?></div>
					</td>
					<td>
						<div class="player_points"><?=$score2?></div>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2">
<?php if($upFlag){ ?> <i>переможець на <?=$loserID?></i> <?php } ?>
<?php if($lowFlag){ ?> <i>переможений на <?=$winnerID?></i> <?php } ?>
<?php } ?>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
