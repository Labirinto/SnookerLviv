<?php
    $query = "SELECT PTV.playerName FROM playerTournamentView PTV
        WHERE PTV.tournamentID=?";
    $data = query($query, $tournamentID);

    for($i = 0; $i<count($data); $i++)
    {
		$player = $data[$i][0];
        ?><?=$i+1?>: <?=$player?></br><?php
    }
?>
