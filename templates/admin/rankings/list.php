<a href="">Select other league</a>

<h1><?=$rankName?>:</h1>

<?php

//$i-position in ranking, 0-firstName, 1-lastName, 2-points
$query = "select R.player, R.points from ranking R where R.leagueID=? order by 2 DESC";

// get all players for this leagueID
$data = query($query, $leagueID);
for($i = 0; $i<count($data); $i++)
{
	$player = $data[$i][0];
	$points = $data[$i][1];
    print(($i+1).": $player $points</br>\n");
}

?>
