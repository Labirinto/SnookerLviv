<a href="create.php">Create Club</a>

</br></br>
<h3><mark>TODO (maybe) delete club</mark></h3>
</br>

<?php

	$query =  "SELECT C.id,C.name,C.country,C.city,C.nrOfTables
				FROM club C ORDER BY 2";
	$data = query($query);
	$data_count = count($data);

	displayHeader();

	for($i = 0; $i < $data_count; $i++)
	{
		$id = $data[$i][0]; $name = $data[$i][1];
		$country = $data[$i][2]; $city = $data[$i][3];
		$tables = $data[$i][4];
		$BR = ($i+1 == $data_count) ? " radius_br" : "";
		$BL = ($i+1 == $data_count) ? " radius_bl" : "";

		displayClub($i+1, $id, $name, $city, $country,$tables,$BR,$BL);
	}

	displayFooter();


function displayClub($i, $id, $name, $city, $country, $tables,$BR,$BL)
{
	$e_o = ($i%2) ? "odd" : "even";
?>
			<tr class="tbody_<?=$e_o?> pointer"
			onclick="window.location.href=
			'/~levko/admin/clubs/lobby.php?id=<?=$id?>';">
				<td class="<?=$e_o?>_num<?=$BL?> club_list_number"><?=$i?></td>
				<td><?=$name?></td>
				<td><?=$city?>, <?=$country?></td>
				<td class="<?=$BR?>"><?=$tables?></td>
			</tr>
<?php }


function displayHeader()
{ ?>
	<div class="sub-container">
		<div class="club_list_header">
			<h1 class="club_list_sign">клуби</h1>
		</div>
		<div class="club_list_table_container">
		<table class="club_list_table">
			<colgroup>
				<col class="col-1">
				<col class="col-2">
				<col class="col-3">
				<col class="col-4">
			</colgroup>
			<thead>
				<th>#</th>
				<th>
					назва
				</th>
				<th>
					локація
				</th>
				<th>
					столи
				</th>
			</thead>
			<tbody>
<?php }


function displayFooter()
{ ?>
			</tbody>
		</table>
		</div>
	</div>
<?php }

?>

