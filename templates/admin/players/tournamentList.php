<?php

	$query = "select tournamentName,tournamentID,clubName,place,points
			from playerTournamentView where playerID=?
			order by 5 DESC, 4;";

	$data = query($query, $playerID);
	$data_count = count($data);
	

	listHeader();

    for($i = 0; $i < $data_count; $i++)
    {
        $name = $data[$i][0]; $id = $data[$i][1];
		$clubName = $data[$i][2]; $place = $data[$i][3];
		$pts = $data[$i][4]; $isLast = ($i+1==$data_count);
	 	displayTournament($i+1,$id,$name,$clubName,$isLast,$place);
	}

	listFooter();


function displayTournament($i, $id, $name, $clubName, $isLast, $place)
{
    $e_o = ($i%2) ? "odd" : "even";
?>
            <tr onclick="openTournamentLobby(<?=$id?>);"
            class="tbody_<?=$e_o?> pointer">
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
                    <?=$place?>
                </td>
            </tr>
<?php
}


function listHeader()
{ ?>
    <div class="sub-container">
        <div class="calendar_header">
            <h1 class="calendar_sign">Турніри</h1>
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
						<span>Клуб</span>
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
{ ?>
			</tbody>
		</table>
		</div>
    </div>
<?php
}

?>

