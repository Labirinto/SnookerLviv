<?php

    $query = "SELECT BV.points, BV.matchID,
        BV.opponentID, BV.opponentName 
        FROM breakView BV WHERE BV.playerID=? ORDER BY 1 DESC";
    $data = query($query, $playerID);

    if( count($data) < 1 ){
        print("<mark>No breaks available</mark>");
    }

    for($i = 0; $i<count($data); $i++)
    {
        $points = $data[$i][0]; $matchID = $data[$i][1];
        $oppID = $data[$i][2]; $oppName = $data[$i][3];
        print("<a href=\"/~levko/admin/tournaments/matchLobby.php?id=$matchID\">$points: VS $oppName</a></br>\n");
    }

?>

