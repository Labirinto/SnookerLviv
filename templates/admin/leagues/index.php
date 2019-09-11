
<mark>TODO delete league (only with 0 tournaments)</mark>
</br>

<a href="create.php">Create League</a>
</br>
<h1>List of Leagues:</h1>
<?php

$data = query("SELECT L.leagueID, L.league, L.billiard, 
        L.age, L.sex, L.tournaments FROM leagueView L ORDER BY 2, 3 DESC, 4, 5");

for($i=0; $i<count($data); $i++)
{
    $name = $data[$i][1];
    $billiard = $data[$i][2];
    $age = $data[$i][3]; $sex = $data[$i][4];
	$tournaments = $data[$i][5];

    print("$name ($billiard");

    if( strcmp($age,"") || strcmp($sex,"") )
    {
        print(" $age $sex");
    }
    print(") ($tournaments)</br>\n");
}
