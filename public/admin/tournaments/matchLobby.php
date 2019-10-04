<?php 

require("../../../includes/adminConfig.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	$matchID = isset($_GET["id"]) ? $_GET["id"] : null;
	if( exists("_match", $matchID) )
	{
		adminRender("tournaments/matchLobby.php", ["title"=>"match", "matchID"=>$matchID]);
	}
	else
	{
		redirect("");
	}
}
else
{
	redirect("");
}

?>
