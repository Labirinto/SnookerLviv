<a href="create.php">Create Tournament</a>
</br>

<h4><mark>TODO: </br>1.Unregister player</br>2.(maybe) delete tournament</mark></h4>

<h1>List of Tournaments:</h1>

<?php
$status = "Announced";
require("tournamentList.php");

$status = "Registration";
require("tournamentList.php");

$status = "Standby";
require("tournamentList.php");

$status = "Live";
require("tournamentList.php");

$status = "Finished";
require("tournamentList.php");
?>

