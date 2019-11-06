
<?php 


list($name, $billiard, $details, $league, $bracket) = 
	getFullName($tournamentID);

tournamentHeader($name, $billiard, $details, $league);


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


function tournamentHeader($name, $billiard, $details, $league)
{ ?>
	<div class="tour_menu_box">
        <div class="tournament_header">
            <div class="nameOf_tour">
                <i class="fas fa-trophy"></i>
                <span style="margin-left:5px;"><?=$name?></span>
            </div>
            <div class="second_row">
                <div class="typeOf_tour">
                    <span><?=$billiard?> &nbsp;</span>
                    <span><?=$details?></span>
                </div>
                <div class="organOf_tour">
                    <span><?=$league?></span>
                </div>
            </div>
        </div>

<?php }


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
	if( !strcmp($onClick, "players") || !strcmp($onClick, "default") )
		require("lobbyDetails/registeredPlayersListSmall.php");
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
	?>
		<div class="margin-b_30"></div>
		<div class="bracket_section">
	<?php
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
	?>
		<div class="margin-b_30"></div>
		<div class="bracket_section">
	<?php
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
	$query = "SELECT TV.bracket, TV.billiard, TV.age, TV.sex,
		TV.tournament, TV.league 
    	FROM generalTournamentView TV WHERE tournamentID=?"; 
	$data = query($query, $tournamentID); 
	
	$bracket = $data[0][0]; $billiard = $data[0][1];
	$name = $data[0][4]; $league = $data[0][5];

	$details = castDetails($data[0][2], $data[0][3]);
	
	return array($name, $billiard, $details, $league, $bracket);
}

function castDetails($age, $sex)
{
	$details = "";
	if( $age != "" )
	{
		$details .= "(".$age;
		if( $sex != "" )
			$details .= " ".$sex.")";
		else
			$details .= ")";
	}
	else if( $sex != "" )
	{
		$details = "(".$sex.")";
	}

	return $details;
}

