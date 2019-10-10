<?php

    require("../../../includes/adminConfig.php");


    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $playerID = $_GET["id"];
        if( !exists("player", $playerID) )
            redirect("");


        list($fName, $lName, $img) = getPlayer($playerID);
        adminRender("players/tournamentBreaks.php", ["title"=>$fName.' '.$lName." - Tournament Breaks", "playerID"=>$playerID]);
    }
    else
    {
        redirect("");
    }


function getPlayer($id)
{
    $query="SELECT firstName,lastName,photo
            FROM player WHERE id=?";

    $data = query($query, $id);
    return array($data[0][0],$data[0][1],$data[0][2]);
}

?>
