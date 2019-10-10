<?php

	$query = "select tournamentName, tournamentID 
			from playerTournamentView where playerID=?;";

	$data = query($query, $playerID);
	
    if( count($data) < 1 ){
        print("<mark>No tournaments available</mark>");
    }

    for($i = 0; $i<count($data); $i++)
    {
        $name = $data[$i][0]; $id = $data[$i][1];
        print("<a href=\"/~levko/admin/tournaments/lobby.php?id=$id\">$name</a></br>\n");
    }

?>

