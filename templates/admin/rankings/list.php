<a href="">Select other league</a>

<?php
	$query = "SELECT R.player, R.points, R.playerID, R.photo
			FROM ranking R WHERE R.leagueID=?
			ORDER BY 2 DESC, 1";
	$data = query($query, $leagueID);
	$data_count = count($data);

	rankingHeader($rankName);

	for($i = 0; $i < $data_count; $i++)
	{
		$player = $data[$i][0]; $id = $data[$i][2];
		$pts = $data[$i][1]; $img = $data[$i][3];
		$isLast = ($i+1 == $data_count);

		displayPlayer($i+1, $id, $player, $img, $isLast, $pts);
	}

	rankingFooter();


function displayPlayer($i, $id, $name, $img, $isLast, $pts)
{
    $e_o = ($i%2) ? "odd" : "even";
?>
            <tr onclick="openPlayerLobby(<?=$id?>);"
            class="tbody_<?=$e_o?> pointer">
                <td class="<?=$e_o?>_num<?=($isLast)?" radius_bl":""?> rating_table_number">
                    <?=$i?>
                </td>
                <td class="rating_table_name">
					<img class="circle_img" src="<?=PLAYER_IMG.$img?>" alt="img">
                    <span><?=$name?></span>
                </td>
                <td class="<?=($isLast)?"radius_br":""?>">
                    <?=$pts?>
                </td>
            </tr>
<?php
}


function rankingHeader($hdr)
{ ?>
    <div class="sub-container">
        <div class="rating_header">
            <h1 class="rating_sign"><?=$hdr?></h1>
        </div>
        <div class="rating_table_container">
        <table class="rating_table">
            <colgroup>
                <col class="col-1">
                <col class="col-2">
                <col class="col-3">
                <col class="col-4">
            </colgroup>
            <thead class="rating_table_thead">
                <tr>
                    <th>#</th>
                    <th>
                        <span>Ім'я</span>
                    </th>
                    <th>
                        <span>Очки</span>
                    </th>
                </tr>
			</thead>
            <tbody class="rating_table_tbody">
<?php
}
function rankingFooter()
{ ?>
            </tbody>
        </table>
        </div>
    </div>
<?php
}
?>

