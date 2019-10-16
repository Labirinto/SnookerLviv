<?php
	printHeader();

	$query = "SELECT PTV.seed, PTV.playerName, PTV.playerID, PTV.photo,
		PTV.birthday
		FROM playerTournamentView PTV
        WHERE PTV.tournamentID=? ORDER BY 1";
    $data = query($query, $tournamentID);
    
	for($i = 0; $i<count($data); $i++)
    {
		$seed = $data[$i][0]; $player = $data[$i][1];
		$id = $data[$i][2]; $img = $data[$i][3];
		$birthday = $data[$i][4];
        printPlayer($i+1, $id, $player, $img, $birthday, $seed);
    }

	printFooter();


function printHeader()
{ ?>
	<div class="participants_header">
		<h3>Список гравців</h3>
	</div>
	<div class="participants_table_container">
	<table class="participants_table">
		<colgroup>
			<col class="col-1">
			<col class="col-2">
			<col class="col-3">
			<col class="col-4">
			<col class="col-5">
			<col class="col-6">
		</colgroup>
		<thead class="participants_table_thead">
			<tr>
				<th>#</th>
				<th>Ім'я</th>
                <th>Дата народження</th>
                <th>Звання</th>
                <th>Локація</th>
                <th>Жереб</th>
            </tr>
        </thead>
        <tbody class="participants_table_tbody">
<?php
}


function printPlayer($i, $id, $name, $img, $birthday, $seed)
{
	$e_o = ($i%2) ? "odd" : "even";
 ?>
			<tr onclick="window.location.href='/~levko/admin/players/lobby.php?id=<?=$id?>';"
				class="participants_table_tbody_<?=$e_o?> participants_table_pointer">
				<td class="participants_table_number <?=$e_o?>_num"><?=$i?></td>
				<td class="participants_table_name">
					<img class="circle_img" src="<?=PLAYER_IMG.$img?>" alt="img">
					<span><?=$name?></span>
				</td>
				<td>
					<span><?=$birthday?></span>
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
					<span><?=$seed?></span>
				</td>
			</tr>
<?php
}


function printFooter()
{ ?>
		</tbody>
	</table>
	</div>
<?php
}
?>
