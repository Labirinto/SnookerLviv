<?php

    $query = "SELECT BV.points, BV.matchID, BV.playerID, BV.playerName, 
		BV.opponentID, BV.opponentName 
		FROM breakView BV WHERE tournamentID=? ORDER BY 1 DESC, 4";
    $data = query($query, $tournamentID);
   
	if( count($data) < 1 ){
		print("<mark>No breaks available</mark>");
	}
 
	for($i = 0; $i<count($data); $i++)
    {
		$points = $data[$i][0]; $matchID = $data[$i][1];
		$playerID = $data[$i][2]; $playerName = $data[$i][3];
		$oppID = $data[$i][4]; $oppName = $data[$i][5];
        print("<a href=\"matchLobby.php?id=$matchID\">$points: $playerName</a></br>\n");
    }

?>
