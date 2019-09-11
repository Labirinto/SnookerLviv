<?php
require("../../../includes/adminConfig.php");


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $tournament = $_POST["tournament"];
    $player = $_POST["player"];

    if(!nonEmpty($tournament, $player))
    {
        adminApology(INPUT_ERROR, "All field required");
        exit;
    }
    $query="select 1 from playerTournament where playerID=? AND tournamentID=?";
    if(count(query($query, $player, $tournament)) > 0)
    {
        adminApology(INPUT_ERROR, "Already registered");
        exit;
    }

    $query = "INSERT INTO playerTournament(tournamentID, playerID) VALUES(?,?)";
    query($query, $tournament, $player);
    redirect("lobby.php?id=$tournament");
}
else if($_SERVER["REQUEST_METHOD"] == "GET")
{
	redirect("");
}

?>

