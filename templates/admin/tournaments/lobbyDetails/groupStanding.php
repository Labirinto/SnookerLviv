
<?php
	$query1 = "SELECT T.groupDone FROM tournament T WHERE T.id=?";
	$query2 = "SELECT EXISTS(SELECT 1 FROM matchView mv 
		WHERE mv.tournamentID=? AND mv.roundType=? 
		AND mv.status != ?)";

	$groupDone = query($query1, $tournamentID);
	$matchesLeft = query($query2, $tournamentID, "Group", "Finished");
	
	if( !$groupDone[0][0] && !$matchesLeft[0][0] )
	{
		displayProceedButton($tournamentID);
	}


    $query = "SELECT GS.player, GS.points, GS.seed, GS.photo,
		GS.groupPlace, GS.groupNum
		FROM groupStandingsView GS
        WHERE GS.tournamentID=? ORDER BY 2 DESC, 5, 1";
    $data = query($query, $tournamentID);
	$data_count = count($data);

	displayHeader();
 
	for($i = 0; $i < $data_count; $i++)
    {
		$player = $data[$i][0]; $pts = $data[$i][1];
		$seed = $data[$i][2]; $photo = $data[$i][3];
		$grpPlace = $data[$i][4]; $grpNum = $data[$i][5];
     	$isLast = ($i+1 == $data_count) ? true : false;
		
		displayPlayer($i+1, $player, $seed, $photo, $grpPlace, $grpNum, $pts, $isLast); 
    }

	displayFooter();


function displayPlayer($i, $name, $seed, $plrPhoto, $grpPlace, $grpNum, $pts, $isLast)
{
    $e_o = ($i%2) ? "odd" : "even";
?>
            <tr class="group_results_table_tbody_<?=$e_o?> group_results_table_pointer">
                <td class="group_results_table_points <?=$e_o?>_num<?=($isLast)?" radius_bl":""?>">
                    <?=$seed?>
                </td>
                <td class="group_results_table_name">
                    <img class="circle_img" src="<?=PLAYER_IMG.$plrPhoto?>" alt="img">
                    <span><?=$name?></span>
                </td>
                <td>
					<?=$grpNum?>
                </td>
                <td>
                    <?=$grpPlace?>
                </td>
                <td class="<?=($isLast)?" radius_br":""?>">
                    <?=$pts?>%
                </td>
            </tr>
<?php }



function displayProceedButton($id)
{ ?>
	<form action="proceedGroup.php" method="post">
		<input type="hidden" name="id" value="<?=$id?>"/>
		<button type="submit" name="clicked" value="proceed">СІЯТИ ГРАВЦІВ</button>
	</form>
	<div id="divisor"><style>#divisor{height:20px}</style></div>

<?php }


function displayHeader()
{ ?>
    <div class="group_results_header">
        <h3 class="group_results_sign">Результати груп</h3>
    </div>
    <div class="group_results_table_container">
    <table class="group_results_table">
        <colgroup>
            <col class="col-1">
            <col class="col-2">
            <col class="col-3">
            <col class="col-4">
            <col class="col-5">
        </colgroup>
        <thead class="group_results_table_thead">
            <tr>
                <th>Жереб</th>
                <th>Ім'я</th>
                <th>Група</th>
                <th>Місце в групі</th>
                <th>%</th>
            </tr>
        </thead>
        <tbody class="group_results_table_tbody">
<?php
}

function displayFooter()
{ ?>
        </tbody>
    </table>
    </div>

<?php } ?>

