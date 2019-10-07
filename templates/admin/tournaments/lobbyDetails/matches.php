<?php
//bracket, tournamentID

if( !strcmp($bracket, "K/O") )
{
	$data = query("select KO_Rounds from tournament where id=?", $tournamentID);
    
	$KO_R = $data[0][0];
	prepareRound("K/O", $KO_R, $tournamentID);
}
else if( !strcmp($bracket, "D/E") )
{
	$data = query("select UP_Rounds,LOW_Rounds,KO_Rounds from tournament where id=?", $tournamentID);
   
	$LOW_R = $data[0][1]; 
	$KO_R = $data[0][2];
	$UP_R = $data[0][0];

	prepareRound("UP", $UP_R, $tournamentID);
	prepareRound("LOW", $LOW_R, $tournamentID);
	prepareRound("K/O", $KO_R, $tournamentID);
}
else if( !strcmp($bracket, "GroupKO") )
{
	$data = query("select nrOfGroups from tournament where id=?", $tournamentID);
	$G_R = $data[0][0];
	for($i = 1; $i <= $G_R; $i++)
	{
		printGroup($tournamentID, $i);
	}

	$data = query("select KO_Rounds from tournament where id=?", $tournamentID);
    
	$KO_R = $data[0][0];
	prepareRound("K/O", $KO_R, $tournamentID);
}
// else if( !strcmp($bracket, "Group") )
// {
// <!-- <b>Groups</b> --><?php	
// 
// 	$data = query("select nrOfGroups from tournament where id=?", $tournamentID);
// 	$G_R = $data[0][0];
// 	for($i = 1; $i <= $G_R; $i++)
// 	{
// 		print("<p><mark>Group $i<mark>:</p>\n");
// 		printGroup($tournamentID, $i);
// 	}
// }


function printGroup($tournID, $groupNo)
{
    $query = "SELECT TV.counter, TV.matchID, 
		TV.player1Name, TV.player2Name,  
        TV.bestOF, TV.player1Score, TV.player2Score, TV.youtube
        FROM matchesTournamentView TV  
        WHERE TV.tournamentID=? AND TV.roundType=? AND groupNum=?
        ORDER BY TV.counter";

    $data = query($query, $tournID, "Group", $groupNo);
    
	?><div class="round_num"><h3 class="matches_list_table_round_num">GROUP <?=$groupNo?></h3></div><?php

	printHeader();

	for($i = 0; $i < count($data); $i++)
    {
        $counter = $data[$i][0]; $matchID = $data[$i][1];
        $player1 = $data[$i][2]; $player2 = $data[$i][3];
        $bestOf = $data[$i][4];
        $score1 = $data[$i][5]; $score2 = $data[$i][6];
		$youtube = $data[$i][7];

		printMatch($counter, $matchID, $player1, $score1, $player2, $score2, $bestOf, $youtube);
    }

	print("</tbody>\n");
	print("</table>\n");
}

function printHeader()
{ ?>
	<table class="matches_list_table">
		<colgroup>
			<col class="col-1">
			<col class="col-2">
			<col class="col-3">
			<col class="col-4">
			<col class="col-5">
		</colgroup>
		<thead class="matches_list_table_thead">
			<tr>
				<th>#</th>
				<th>Гравець 1</th>
				<th>v</th>
				<th>Гравець 2</th>
				<th>TV</th>
			</tr>
		</thead>
		<tbody class="matches_list_table_tbody">
<?php }


function printMatch($counter, $matchID, $player1, $score1, $player2, $score2, $bestOf, $youtube)
{ ?>
	<tr onclick="window.location.href='matchLobby.php?id=<?=$matchID?>';"
		class="matches_list_table_tbody_<?=($counter%2)?odd:even?> matches_list_table_pointer">
		<td class="matches_list_table_number <?=($counter%2)?"odd_num":""?>"><?=$counter?></td>
		<td class="matches_list_table_name_right"><?=$player1?></td>
		<td class="matches_list_table_score">
			<table class="matches_list_table_score_row">
			<tr>
				<td><span class="matches_list_table_score01"><?=$score1?></span></td>
				<td><span class="matches_list_table_best_of">(<?=$bestOf?>)</span></td>
				<td><span class="matches_list_table_score02"><?=$score2?></span></td>
			</tr>
			</table>
		</td>
		<td class="matches_list_table_name_left"><?=$player2?></td>
		<td class="matches_list_table_youtube <?=($counter%2)?"":"even_youtube"?>">
			<?php if(isset($youtube)){ ?>
			<a href="<?=(YT_HEADER.$youtube)?>">
				<img src="../../img/youtube.png" alt="Youtube">
			</a>
			<?php } ?>
		</td>
	</tr>

<?php }

function prepareRound($roundType, $R, $tournamentID)
{
	for($i = 1; $i <= $R; $i++)
	{ ?>
		<div class="round_num"><h3 class="matches_list_table_round_num"><?=$roundType?> <?=$i?></h3></div><?php

		printHeader();
		
		printRound($tournamentID, $i, $roundType);

		print("</tbody>\n");
		print("</table>\n");
	}
}


function printRound($tournID, $Rno, $Rtype) 
{ 
    $query = "SELECT TV.counter, TV.matchID,
		TV.player1Name, TV.player2Name,  
        TV.bestOf, TV.player1Score, TV.player2Score, TV.youtube 
        FROM matchesTournamentView TV  
        WHERE TV.tournamentID=? AND TV.roundNo=? AND TV.roundType=? 
        ORDER BY TV.counter";

    $data = query($query, $tournID, $Rno, $Rtype);

    for($i = 0; $i < count($data); $i++)
    {
        $counter = $data[$i][0]; $matchID = $data[$i][1];
		$bestOf = $data[$i][4];
        $player1 = $data[$i][2]; $player2 = $data[$i][3];
        $score1 = $data[$i][5]; $score2 = $data[$i][6];
		$youtube = $data[$i][7];    
	
		printMatch($counter, $matchID, $player1, $score1, $player2, $score2, $bestOf, $youtube);
	}
}

?>
