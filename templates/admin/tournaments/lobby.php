<?php list($name, $bracket) = getFullName($tournamentID);?>
<h1><?=$name?></h1>
<?php

if( !strcmp($status, "Announced") )
	announcedLobby($tournamentID, $onClick);

else if( !strcmp($status, "Registration") )
	registrationLobby($tournamentID, $onClick);

else if( !strcmp($status, "Standby") )
	standbyLobby($tournamentID, $onClick);

else
	redirect("");

function announcedLobby($tournamentID, $onClick)
{
//lobby navigation
	require("navigations/announced.php");


//lobby block to show data
	?><div class="sub-container"><?php


//close lobby block
	?></div><?php
}

function registrationLobby($tournamentID, $onClick)
{
//lobby navigation
	require("navigations/registration.php");


//lobby block to show data
	?><div class="sub-container"><?php


//show appropriate data
	if( !strcmp($onClick, "players") )
		require("lobbyDetails/registeredPlayersListSmall.php");
	else if( !strcmp($onClick, "default") || !strcmp($onClick, "register") ) {
		require("lobbyDetails/playerRegisterForm.php");
		require("lobbyDetails/registeredPlayersListSmall.php");
	}	
	else
		redirect("");


//close lobby block
	?></div><?php
}

function standbyLobby($tournamentID, $onClick)
{
//lobby navigation
	require("navigations/standby.php");


//lobby block to show data
	?><div class="sub-container"><?php


//show appropriate data
	if( !strcmp($onClick, "default") || !strcmp($onClick, "players") )
		require("lobbyDetails/registeredPlayersListSmall.php");
	else if( !strcmp($onClick, "KO") )
		require("forms/KO.php");
	else if( !strcmp($onClick, "DE") )
		require("forms/DE.php");
	else if( !strcmp($onClick, "GR-KO") )
		require("forms/GR-KO.php");
	else
		redirect("");


//close lobby block
	?></div><?php
}


function getFullName($tournamentID)
{
	$query = "SELECT TV.bracket, TV.billiard, TV.age, TV.sex, TV.tournament  
    FROM generalTournamentView TV WHERE tournamentID=?"; 
	$data = query($query, $tournamentID); 
 
	$name = $data[0][4]." (".$data[0][1]." ".$data[0][2]." ".$data[0][3].")"; 
	$bracket = $data[0][0];
	return array($name, $bracket);
}
