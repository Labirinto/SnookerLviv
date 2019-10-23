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
	$data = query("select nrOfGroups, KO_Rounds from tournament where id=?", $tournamentID);
	$G_R = $data[0][0];
	$KO_R = $data[0][1];
	
	prepareRound("Group", $G_R, $tournamentID);
	prepareRound("K/O", $KO_R, $tournamentID);
}

printScript();


//  TODO print for GROUP only


function prepareRound($roundType, $R, $tournamentID)
{
	for($i = 1; $i <= $R; $i++)
	{
		roundDetails(castHeader($roundType), $i);

		roundHeader();
		
		displayRound($tournamentID, $roundType, $i);

		roundFooter();
	}
}

function castHeader($hdr)
{
	if($hdr == "Group")
		return "Група";

	if($hdr == "K/O")
		return "Knockout, раунд";

	if($hdr == "UP")
		return "Верхня сітка, раунд";

	if($hdr == "LOW")
		return "Нижня сітка, раунд";
}

function roundDetails($type, $n)
{ ?>
		<div class="round_num">
			<h3 class="matches_list_table_round_num">
				<?=$type?> <?=$n?>
			</h3>
		</div>
<?php }

function roundHeader()
{ ?>
	<div class="matches_list_table_borRad_div">
	<table class="matches_list_table">
		<colgroup>
			<col class="col-1">
			<col class="col-2">
			<col class="col-3">
			<col class="col-4">
			<col class="col-5">
			<col class="col-6">
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

function roundFooter()
{ ?>
		</tbody>
	</table>
	</div>
<?php }



function displayMatch($counter, $last,$matchID, $player1, $score1, $player2, $score2, $bestOf, $youtube)
{ ?>
	<tr onclick='matchClick(<?=$matchID?>);'
		class="matches_list_table_tbody_<?=($counter%2)?odd:even?> pointer">
		<td class="matches_list_table_number <?=($counter%2)?"odd_num":""?><?=($last)?" radius_bl":""?>">
			<?=$counter?>
		</td>
		<td class="matches_list_table_name_right">
			<?=$player1?>
		</td>
		<td class="matches_list_table_score">
			<table class="matches_list_table_score_row">
			<tr>
				<td>
					<span class="matches_list_table_score01">
						<?=$score1?>
					</span>
				</td>
				<td>
					<span class="matches_list_table_best_of">
						(<?=$bestOf?>)
					</span>
				</td>
				<td>
					<span class="matches_list_table_score02">
						<?=$score2?>
					</span>
				</td>
			</tr>
			</table>
		</td>
		<td class="matches_list_table_name_left">
			<?=$player2?>
		</td>
		<td class="matches_list_table_youtube 
		 <?=($counter%2)?"":"even_youtube"?>
		 <?=($last)?" radius_br":""?>"
		<?php if(isset($youtube)){ ?>
			onclick="ytClick(event,<?=("'".YT_HEADER.$youtube."'")?>);"
		<?php } ?>>
			<?php if(isset($youtube)){ ?>
				<img src="/~levko/img/youtube.png">
			<?php } ?>
		</td>
	</tr>


<?php }



function displayRound($tournID, $rType, $rNo) 
{
	$grpORround = ($rType=="Group") ? "groupNum=?" : "roundNo=?"; 
    $query = "SELECT TV.counter, TV.matchID,
		TV.player1Name, TV.player2Name,  
        TV.bestOf, TV.player1Score, TV.player2Score, TV.youtube 
        FROM matchesTournamentView TV  
        WHERE TV.tournamentID=? AND TV.roundType=? AND "
		.$grpORround.
        " ORDER BY TV.counter";

    $data = query($query, $tournID, $rType, $rNo);
	
	$data_counter = count($data);
    for($i = 0; $i < $data_counter; $i++)
    {
        $counter = $data[$i][0]; $matchID = $data[$i][1];
        $player1 = $data[$i][2]; $player2 = $data[$i][3];
		$bestOf = $data[$i][4];
        $score1 = $data[$i][5]; $score2 = $data[$i][6];
		$youtube = $data[$i][7];
		$last = ($i+1 < $data_counter) ? false : true;
	
		displayMatch($counter,$last,$matchID, $player1, $score1, $player2, $score2, $bestOf, $youtube);
	}
}



function printScript()
{ ?>
		<script>
function matchClick(matchID) {
	window.location.href=('matchLobby.php?id=' + matchID);

}
function ytClick(event, youtube) {
	event.stopPropagation();

	window.location.href=(youtube);

}
		</script>
<?php } ?>
