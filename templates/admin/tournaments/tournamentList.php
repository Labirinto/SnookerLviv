<?php

$data = query("SELECT TV.tournamentID, TV.tournament, TV.billiard, 
            TV.age, TV.sex, TV.clubName
            FROM generalTournamentView TV WHERE TV.status=?
            ORDER BY 2, 3 DESC, 4, 5", $status);

if(count($data) > 0)
{
	printHeader($status);

	for($i=0; $i<count($data); $i++)
	{
		$id = $data[$i][0];
		$billiard = $data[$i][2];
		$age = $data[$i][3];
		$sex = $data[$i][4];
		$clubName = $data[$i][5];
		$name = $data[$i][1] . "(" . $billiard . ")";
		if( strcmp($age, "") || strcmp($sex, "") )
			$name = $name . "(" . $age . " " . $sex . ")";
		$e_o = ($i%2) ? "even" : "odd";

	?>    
		<a href="lobby.php?id=<?=$id?>">
		<tr onclick="window.location.href='lobby.php?id=<?=$id?>';"
			class="tournament_list_table_tbody_<?=$e_o?> tournament_list_table_pointer">
			<td class="tournament_list_table_number_<?=$e_o?>"><?=($i+1)?></td>
			<td class="tournament_list_table_date_right"><?=$name?></td>
			<td class="tournament_list_table_date_center"><?=$clubName?></td>
			<td class="tournament_list_table_date_left">DATE TMP</td>
		</tr>
		</a>
	<?php
	}

	printFooter();
}

