<?php

    $query="SELECT BV.points,BV.matchID,BV.playerID,BV.playerName, 
		BV.opponentID,BV.opponentName,BV.playerPhoto,BV.opponentPhoto 
		FROM breakView BV WHERE BV.playerID=? ORDER BY 1 DESC, 4";
    $data = query($query, $playerID);
	$data_count = count($data);
  
	printHeader(); 

	for($i = 0; $i < $data_count; $i++)
	{
		$points = $data[$i][0]; $matchID = $data[$i][1];
		$plrID = $data[$i][2]; $plrName = $data[$i][3];
		$oppID = $data[$i][4]; $oppName = $data[$i][5];
		$plrPhoto = $data[$i][6]; $oppPhoto = $data[$i][7];
	
		printBreak($points, $i+1, $matchID, $plrName, $plrPhoto, $oppName, $oppPhoto, ($i+1==$data_count));
	}

	printFooter();



function printBreak($pts,$i,$mID,$plrName,$plrPhoto,$oppName,$oppPhoto,$isLast)
{
    $e_o = ($i%2) ? "odd" : "even";
 ?>
            <tr onclick="window.location.href='/~levko/admin/tournaments/matchLobby.php?id=<?=$mID?>';"
                class="breaks_table_tbody_<?=$e_o?> pointer">
                <td class="breaks_table_name<?=($isLast)?" radius_bl":""?>">
                    <img class="circle_img" src="<?=PLAYER_IMG.$plrPhoto?>" alt="img">
                    <span><?=$plrName?></span>
                </td>
                <td class="breaks_table_points <?=$e_o?>_num">
					<?=$pts?>
				</td>
                <td>
                </td>
                <td>
                </td>
                <td class="breaks_table_name<?=($isLast)?" radius_br":""?>">
                    <img class="circle_img" src="<?=PLAYER_IMG.$oppPhoto?>" alt="img">
                    <span><?=$oppName?></span>
                </td>
            </tr>
<?php
}

function printHeader()
{ ?>
	<div class="sub-container">
	<div class="breaks_header">
		<h3 class="breaks_sign">Брейки</h3>
	</div>
	<div class="breaks_table_container">
	<table class="breaks_table">
		<colgroup>
			<col class="col-1">
			<col class="col-2">
			<col class="col-3">
			<col class="col-4">
			<col class="col-5">
		</colgroup>
		<thead class="breaks_table_thead">
			<tr>
				<th>Ім'я</th>
				<th>Очки</th>
				<th>Раунд</th>
				<th>...</th>
				<th>Суперник</th>
			</tr>
		</thead>
		<tbody class="breaks_table_tbody">
<?php
}

function printFooter()
{ ?>
		</tbody>
	</table>
	</div>
	</div>
<?php
} ?>
