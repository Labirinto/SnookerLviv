<?php list($name, $bracket) = getFullName($tournamentID);?>
<h1><?=$name?></h1>
<?php

if( !strcmp($status, "Announced") )
	announcedLobby($tournamentID, $onClick);

else if( !strcmp($status, "Registration") )
	registrationLobby($tournamentID, $onClick);

else if( !strcmp($status, "Standby") )
	standbyLobby($tournamentID, $onClick);

else if( !strcmp($status,"Live") )
	liveLobby($bracket, $tournamentID, $onClick);

else if( !strcmp($status,"Finished") )
	finishedLobby($bracket, $tournamentID, $onClick);

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

function liveLobby($bracket, $tournamentID, $onClick)
{
//lobby navigation
	if( !strcmp($bracket, "Group") )
		require("navigations/groupsLive.php");
	else if( !strcmp($bracket, "GroupKO") )
		require("navigations/groupsKOLive.php");
	else if( !strcmp($bracket, "K/O") || !strcmp($bracket, "D/E") )
		require("navigations/eliminationsLive.php");
	else
		redirect("");


//show appropriate data
	if( !strcmp($onClick, "default") || !strcmp($onClick, "bracket") )
	{
	?><div class="bracket_section"><?php
		require("lobbyDetails/bracket.php");
	}
	else
	{
	?><div class="sub-container"><?php
		if( !strcmp($onClick, "matches") )
			require("lobbyDetails/matches.php");
		else if( !strcmp($onClick, "players") )
			require("lobbyDetails/registeredPlayersList.php");
		else if( !strcmp($onClick, "live") )
			require("lobbyDetails/live.php");
		else if( !strcmp($onClick, "groups") ) 
			require("lobbyDetails/groups.php");
		else if( !strcmp($onClick, "groupStanding") ) 
			require("lobbyDetails/groupStanding.php");
		else if( !strcmp($onClick, "breaks") )
			require("lobbyDetails/breaks.php");
		else
			redirect("");
	}


//close lobby block
	?></div><?php
}

function finishedLobby($bracket, $tournamentID, $onClick)
{
//lobby navigation
	if( !strcmp($bracket, "Group") )
		require("navigations/groupsFinished.php");
	else if( !strcmp($bracket, "GroupKO") )
		require("navigations/groupsKOFinished.php");
	else if( !strcmp($bracket, "K/O") || !strcmp($bracket, "D/E") )
		require("navigations/eliminationsFinished.php");
	else
		redirect("");
	

//show appropriate data
	if( !strcmp($onClick, "default")||!strcmp($onClick, "standings") )
	{
	?><div class="sub-container"><?php
		require("lobbyDetails/standings.php");
	}
	else if( !strcmp($onClick, "bracket") )
	{
	?><div class="bracket_section"><?php
		require("lobbyDetails/bracket.php");
	}
	else
	{
	?><div class="sub-container"><?php
		if( !strcmp($onClick, "matches") )
			require("lobbyDetails/matches.php");
		else if( !strcmp($onClick, "groups") )
			require("lobbyDetails/groups.php");
		else if( !strcmp($onClick, "groupStanding") ) 
			require("lobbyDetails/groupStanding.php");
		else if( !strcmp($onClick, "breaks") ) 
			require("lobbyDetails/breaks.php");
		else
			redirect("");
	}

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
