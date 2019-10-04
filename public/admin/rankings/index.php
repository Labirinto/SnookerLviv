<?php

require("../../../includes/adminConfig.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	adminRender("rankings/pick.php",["title"=>"Admin Panel- Rankings"]);
}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$res = explode('|', $_POST["league"]);
	$leagueID = $res[0];
	$leagueText = $res[1];
	if( !nonempty($leagueID, $leagueText) )
	{
		adminApology(INPUT_ERROR, "Inappropriate league ".$leagueID);
		exit;
	}

	if( !exists("league", $leagueID) )
	{
		adminApology(INPUT_ERROR, "Inappropriate league");
		exit;
	}

	adminRender("rankings/list.php", ["leagueID"=>$leagueID, "rankName"=>$leagueText]);
}

?>
