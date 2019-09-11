<?php
//bracket, tournamentID

if(!strcmp($bracket, "K/O"))
{
?> <section id="bracket"> <?php    
	
	$data = query("select KO_Rounds, seeded_Round from tournament where id=?", $tournamentID);
    
	$KO_R = $data[0][0]; $seeded_R = $data[0][1];
	prepareRound("K/O", 0, $KO_R, $seeded_R, $tournamentID);
}
else if(!strcmp($bracket, "D/E"))
{
?> <section id="bracket"> <?php	
	
	$data = query("select UP_Rounds,LOW_Rounds,KO_Rounds,seeded_Round from tournament where id=?", $tournamentID);
   
	$LOW_R = $data[0][1]; $KO_R = $data[0][2];
	$UP_R = $data[0][0]; $seeded_R = $data[0][3];

	prepareRound("LOW", 0, $LOW_R, $seeded_R, $tournamentID);
	prepareRound("UP", 0, $UP_R, $seeded_R, $tournamentID);
	prepareRound("K/O", $UP_R-1, $KO_R, $seeded_R, $tournamentID);
}
else if(!strcmp($bracket, "GroupKO"))
{
?> <section id="bracket"> <?php	
	
	$data = query("select KO_Rounds, seeded_Round from tournament where id=?", $tournamentID);
    
	$KO_R = $data[0][0]; $seeded_R = $data[0][1];
	prepareRound("K/O", 0, $KO_R, $seeded_R, $tournamentID);
}
?> </section> <?php


function prepareRound($roundType, $offset, $R, $seeded_R, $tournamentID)
{
	if( !strcmp($roundType,"LOW") )
	{
		for($i = $R; $i >= 1; $i--)
		{ ?>
			<div class="round <?=$roundType?>-<?=$i?>">
			<?php printRound($tournamentID, $i, $roundType, ($i==$R)?true:false);?>
			</div>
		<?php
		}
	}
	else
	{
		for($i = 1; $i < $seeded_R; $i++)
		{ ?>
			<div class="round <?=$roundType?>-1">
			<?php printRound($tournamentID, $i, $roundType, false);?>
			</div>
		<?php 
		} 

		for($i = $seeded_R; $i <= $R; $i++)
		{ ?>
			<div class="round <?=$roundType?>-<?=$i+$offset-$seeded_R+1?>">
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
			if( strcmp($player1, "WALK OVER") )
				$player1 = "($seed1)$player1";
			if( strcmp($player2, "WALK OVER") )
				$player2 = "($seed2)$player2";
		//}

		printBracketMatch($i, $matchID, $counter, $player1, $player1Score, $player2, $player2Score, $lowFlag, $upFlag, $loserMatch, $winnerMatch, $youtube);
    }
}

function printBracketMatch($i, $matchID, $matchNum, $player1, $score1, $player2, $score2, $lowFlag, $upFlag, $loserID, $winnerID, $youtube)
{ ?>
	<div class="<?php 
		if($i==0) print("first-match");
		else print("match-details"); ?>
	">
		<div class="match-number"> <?=$matchNum?> </div>
		<div class="youtube-logo">
			<?php if(isset($youtube)) { ?>
			<a href="<?=YT_HEADER.$youtube?>">
				<img src="../../img/youtube.png" alt="Youtube">
			</a>
			<?php } ?>
		</div>
	</div>

	<a href="matchLobby.php?id=<?=$matchID?>">
		<ul class="matchup">
			<li class="team team-top">
				<?=$player1?><span class="score"><?=$score1?></span>
			</li>
			<li class="team team-bottom">
				<?=$player2?><span class="score"><?=$score2?></span>
			</li>
		</ul>
	</a>
	<style>.sokol-loh{padding-top:2px;margin-top:-5px; margin-bottom:-5px; height:10px;font-size:10px;} </style>
	<?php if($upFlag){ ?> <h6 class="sokol-loh">Loser goes to <?=$loserID?></h6> <?php } ?>
	<?php if($lowFlag){ ?> <h6 class="sokol-loh">Winner goes to <?=$winnerID?></h6> <?php } ?>
<?php } ?>
