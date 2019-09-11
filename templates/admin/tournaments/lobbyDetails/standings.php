<?php

    print("<mark>player(seed)&emsp;place: points</mark></br>\n");
    $query = "SELECT ST.player, ST.seed, ST.place, ST.points FROM standingsTournamentView ST
        WHERE tournamentID=? ORDER BY 4 DESC, 1";
    $data = query($query, $tournamentID);
    
	for($i = 0; $i<count($data); $i++)
    {
		$player = $data[$i][0]; $seed = $data[$i][1];
		$place = $data[$i][2]; $points = $data[$i][3];
        print("($seed)$player&emsp;[$place]: $points</br>\n");
    }
?>
