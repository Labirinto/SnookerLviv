
<?php
		
	$data = query("SELECT T.groupDone FROM tournament T WHERE T.id=?", $tournamentID);
	$flag1 = $data[0][0];
	$data = query("SELECT EXISTS(SELECT 1 FROM matchView mv WHERE mv.tournamentID=? AND mv.roundType=?
		AND mv.status != ?)", $tournamentID, "Group", "Finished");
	$flag2 = $data[0][0];
	if( !$flag1 && !$flag2 )
	{
		printButton($tournamentID);
	}


    $query = "SELECT GS.player, GS.groupPlace, GS.points, GS.seed FROM groupStandingsView GS
        WHERE GS.tournamentID=? ORDER BY 2, 3 DESC, 4";
    $data = query($query, $tournamentID);
    
	for($i = 0; $i<count($data); $i++)
    {
		$player = $data[$i][0];
		$place = $data[$i][1]; $points = $data[$i][2];
		$seed = $data[$i][3];
        print("($seed)$player&emsp;[$place]: $points%</br>\n");
    }

	function printButton($id)
	{ ?>
		<form action="proceedGroup.php" method="post">
			<input type="hidden" name="id" value="<?=$id?>"/>
			<button type="submit" name="clicked" value="proceed">PROCEED PLAYERS</button>
		</form>
		<div id="divisor"><style>#divisor{height:20px}</style></div>

	<?php }
?>
