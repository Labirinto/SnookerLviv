<a href="create.php">Create Tournament</a>
</br>

<h4><mark>TODO: </br>1.Unregister player</br>2.(maybe) delete tournament</mark></h4>

<?php

generalHeader();

printList("Live");

printList("Registration");

printList("Announced");

printList("Standby");

printList("Finished");



function castHeader($header)
{
	if($header == "Live")
		return "Наживо";
	else if($header == "Registration")
		return "Триває Реєстрація";
	else if($header == "Announced")
		return "Оголошені";
	else if($header == "Standby")
		return "Очікують на початок";
	else if($header == "Finished")
		return "Завершені";
}

function printList($status)
{
	$data = query("SELECT TV.tournamentID, TV.tournament, TV.billiard, 
				TV.age, TV.sex, TV.clubName
				FROM generalTournamentView TV WHERE TV.status=?
				ORDER BY 2, 3 DESC, 4, 5", $status);

	$data_count = count($data);
	
	listHeader( castHeader($status) );

	for($i=0; $i < $data_count; $i++)
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
		$isLast = ($i+1==$data_count);

		printTournament($i+1, $id, $e_o, $name, $clubName, $isLast);
	}

	listFooter();
}

function printTournament($i, $id, $e_o, $name, $clubName, $isLast)
{ ?>
			<tr onclick="window.location.href='lobby.php?id=<?=$id?>';"
			class="calendar_table_tbody_<?=$e_o?> calendar_table_pointer">
				<td class="calendar_table_points <?=$e_o?>_num<?=($isLast)?" radius_bl":""?>">
					<?=$i?>
				</td>
				<td>
					<?=$name?>
				</td>
				<td>
					<?=$clubName?>
				</td>
				<td class="<?=($isLast)?"radius_br":""?>">
					DATE TMP
				</td>
			</tr>
<?php
}

function generalHeader()
{ ?>
	<div class="sub-container">
		<div class="calendar_header">
			<img class="header_icon" alt="calendar" src="<?=PATH_H?>img/web/calendar.png"> 
			<h1 class="calendar_sign">Каледар</h1>
		</div>
<?php
}

function generalFooter()
{ ?>
	</div>
<?php
}

function listHeader($status)
{
?>
	<div class="calendar_header">
		<h3 class="calendar_sign"><?=$status?></h3>
	</div>

	<div class="calendar_table_container">
	<table class="calendar_table">
		<colgroup>
			<col class="col-1">
			<col class="col-2">
			<col class="col-3">
			<col class="col-4">
		</colgroup>
		<thead class="calendar_table_thead">
			<tr>
				<th>#</th>
				<th>
					<img class="thead_icon" alt="trophy_image" src="<?=PATH_H?>img/web/trophy.png"> 
					<span>Турнір</span>
				</th>
				<th>
					<img class="thead_icon" alt="trophy_image" width="9" src="<?=PATH_H?>img/web/location.png"> 
					<span>Місце</span>
				</th>
				<th>
					<img class="thead_icon" alt="trophy_image" src="<?=PATH_H?>img/web/calendar.png"> 
					<span>Дата</span>
				</th>
			</tr>
		</thead>
		<tbody class="calendar_table_tbody">
<?php
}

function listFooter()
{
?>
		</tbody>	
	</table>
	</div>
<?php
}
?>
