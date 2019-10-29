<?php

function tournamentList($playerID)
{
	$query = "SELECT tournamentName,tournamentID,clubName,place,points
			FROM playerTournamentView
			WHERE playerID=? AND place IS NOT NULL
			ORDER BY 5 DESC, 4;";

	$data = query($query, $playerID);
	$data_count = count($data);
	

	listHeader();

    for($i = 0; $i < $data_count; $i++)
    {
        $name = $data[$i][0]; $id = $data[$i][1];
		$clubName = $data[$i][2]; $place = $data[$i][3];
		$pts = $data[$i][4]; $isLast = ($i+1==$data_count);
	 	displayTournament($i+1,$id,$name,$clubName,$isLast,$place,$pts);
	}

	listFooter();
}


function displayTournament($i, $id, $name, $clubName, $isLast, $place,$pts)
{
    $e_o = ($i%2) ? "odd" : "even";
?>
            <tr onclick="openTournamentLobby(<?=$id?>);"
            class="tbody_<?=$e_o?> pointer">
                <td class="bold <?=$e_o?>_num<?=($isLast)?" radius_bl":""?>">
                    <?=$i?>
                </td>
                <td>
                    <?=$name?>
                </td>
                <td>
                    <?=$clubName?>
                </td>
                <td>
                    ДАТА
                </td>
                <td>
                    <?=$place?>
                </td>
                <td class="<?=($isLast)?"radius_br":""?>">
                    <?=$pts?>
                </td>
            </tr>
<?php
}


function listHeader()
{ ?>
    <div class="sub-container">
        <div class="section_header">
            <div class="header_sign">
				Турніри
			</div>
        </div>
		<div class="list_container">
		<table class="list_table player_tournaments_table">
			<colgroup>
				<col class="col-1">
				<col class="col-2">
				<col class="col-3">
				<col class="col-4">
				<col class="col-5">
				<col class="col-6">
			</colgroup>
			<thead>
				<tr>
					<th>#</th>
					<th>
						<img class="thead_icon" alt="trophy_img" src="<?=PATH_H?>img/web/trophy.png">
						<span>Турнір</span>
					</th>
					<th>
						<img class="thead_icon" alt="location_img" width="9" src="<?=PATH_H?>img/web/location.png">
						<span>Клуб</span>
					</th>
					<th>
						<img class="thead_icon" alt="calendar_img" src="<?=PATH_H?>img/web/calendar.png">
						<span>Дата</span>
					</th>
					<th>
						Місце
					</th>
					<th>
						Очки
					</th>
				</tr>
			</thead>
			<tbody>
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

