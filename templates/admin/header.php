<!DOCTYPE html>
<html>
<head>
    <title><?=htmlspecialchars($title)?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/normalize.css">
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/navigation.css">
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/bracket.css">
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/styles.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/group.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/matches-list.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/lobby_list_styles.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/match_lobby_style.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/tournament_list_style.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/player_profile_style.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/players_list_style.css"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="<?=PATH_H?>img/balls01.png">
	<link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>


<body>
     <header>
        <div class="container">
            <div class="logologin clearfix">
                <img src="<?=PATH_H?>img/balls01.png" alt="SnookerLviv">
                <form action="<?=PATH_H?>logout.php" class="login" method="post">
                    <input type="submit" value="Logout">
                </form>
                <form action="<?=PATH_H?>playerHome.php" class="login" method="post">
                    <input type="submit" value="Home">
                </form>
                <nav class="navigation">
                    <ul>
                        <li><a href="<?=PATH_H?>admin/tournaments">Tournaments</a></li>
                        <li><a href="<?=PATH_H?>admin/players">Players</a></li>
                        <li><a href="<?=PATH_H?>admin/clubs">Clubs</a></li>
                        <li><a href="<?=PATH_H?>admin/leagues">Leagues</a></li>
                        <li><a href="<?=PATH_H?>admin/rankings">Rankings</a></li>
                        <li><a href="<?=PATH_H?>admin/matches">Matches</a></li>
                    </ul>
                </nav>
            </div>
        </div>
     </header>

	<div class="container">

