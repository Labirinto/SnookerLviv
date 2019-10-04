<?php
    $query = "SELECT PTV.seed, PTV.playerName FROM playerTournamentView PTV
        WHERE PTV.tournamentID=? ORDER BY 1";
    $data = query($query, $tournamentID);

    ?> <h2>Registered players:</h2> <?php
    
	for($i = 0; $i<count($data); $i++)
    {
		$count = $i+1;
		$seed = $data[$i][0]; $player = $data[$i][1];
        print("$count: ($seed)$player</br>\n");
    }
?>
