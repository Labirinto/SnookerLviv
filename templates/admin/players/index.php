
<h3><mark>TODO playerLobby with href</mark></h3>

<a href="create.php">Create Player</a>
<h1>List of ALL Players:</h1>

<?php 

$data = query("SELECT P.id, CONCAT(P.lastName, ' ', P.firstName) FROM player P 
			WHERE P.id NOT IN(-1,-2) ORDER BY 2");
    
for($i = 0; $i<count($data); $i++)
{
	$player = $data[$i][1];
    print("$player</br>\n");
}

