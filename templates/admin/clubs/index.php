<a href="create.php">Create Club</a>

</br></br>
<h3><mark>TODO (maybe) delete club</mark></h3>
</br>

<h1>List of Clubs:</h1>
<?php

$data =query("SELECT C.id,C.name,C.country,C.city,C.nrOfTables FROM club C ORDER BY 2");

for($i = 0; $i<count($data); $i++)
{
	$clubID = $data[$i][0]; $clubName = $data[$i][1];
	$country = $data[$i][2]; $city = $data[$i][3];
	$nrOfTables = $data[$i][4];

    print("<a href=\"lobby.php?id=$clubID\">");
    print("$clubName - $city, $country");
    print("($nrOfTables)</a></br>\n");
}

?>

