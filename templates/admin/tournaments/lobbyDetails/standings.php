<?php


    $query = "SELECT ST.player, ST.seed, ST.place, ST.points, ST.photo 
		FROM standingsTournamentView ST
        WHERE tournamentID=? ORDER BY 4 DESC, 1";
    $data = query($query, $tournamentID);
	$data_count = count($data);   
 
	displayHeader();
	
	for($i = 0; $i < $data_count; $i++)
    {
		$player = $data[$i][0]; $seed = $data[$i][1];
		$place = $data[$i][2]; $pts = $data[$i][3];
		$img = $data[$i][4];
		$isLast = ($i+1==$data_count) ? true : false;
    	displayPlayer($i+1, $player, $seed, $img, $place, $pts, $isLast);
	}

	displayFooter();

function displayPlayer($i, $name, $seed, $plrPhoto, $place, $pts, $isLast)
{
	$e_o = ($i%2) ? "odd" : "even";
?>
            <tr class="results_table_tbody_<?=$e_o?> results_table_pointer">
                <td class="results_table_points <?=$e_o?>_num<?=($isLast)?" radius_bl":""?>">
                	<?=$seed?>
				</td>
                <td class="results_table_name">
                    <img class="circle_img" src="<?=PLAYER_IMG.$plrPhoto?>" alt="img">
                    <span><?=$name?></span>
                </td>
                <td>
                </td>
                <td>
					<?=$place?>
                </td>
                <td class="<?=($isLast)?" radius_br":""?>">
                	<?=$pts?>
				</td>
            </tr>
<?php }

function displayHeader()
{ ?>
    <div class="results_header">
        <h3 class="results_sign">Результати</h3>
    </div>
    <div class="results_table_container">
    <table class="results_table">
        <colgroup>
            <col class="col-1">
            <col class="col-2">
            <col class="col-3">
            <col class="col-4">
            <col class="col-5">
        </colgroup>
        <thead class="results_table_thead">
            <tr>
				<th>Жереб</th>
                <th>Ім'я</th>
                <th>...</th>
                <th>Місце</th>
                <th>Очки</th>
            </tr>
        </thead>
        <tbody class="results_table_tbody">
<?php
}

function displayFooter()
{ ?>
        </tbody>
    </table>
    </div>

<?php } ?>

