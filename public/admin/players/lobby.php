<?php

	require("../../../includes/adminConfig.php");

	
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$playerID = $_GET["id"];
		if( !exists("player", $playerID) )
			redirect("");


		list($fName, $lName, $img, $birthday, $highestBreak) = getPlayer($playerID); 
		adminRender("players/lobby.php", ["title"=>"Player lobby", "fName"=>$fName, "lName"=>$lName, "img"=>$img, "playerID"=>$playerID, "birthday"=>$birthday, "highestBreak"=>$highestBreak]);
	}
	else
	{
		redirect("");
	}


function getPlayer($id)
{
	$query="SELECT firstName,lastName,photo,birthday,highestBreak
			FROM player WHERE id=?";

	$data = query($query, $id);
	$birthday = date('Y-m-d', strtotime($data[0][3]));
	return array($data[0][0],$data[0][1],$data[0][2],$birthday,$data[0][4]);
}

?>
