<!DOCTYPE html>
<html>
<head>
    <title><?=htmlspecialchars($title)?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/public/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/public/css/navigation.css">
    <link rel="stylesheet" type="text/css" href="/public/css/bracket.css">
    <link rel="stylesheet" type="text/css" href="/public/css/styles.css"> 
    <link rel="stylesheet" type="text/css" href="/public/css/group.css"> 
    <link rel="stylesheet" type="text/css" href="/public/css/matches-list.css"> 
    <link rel="stylesheet" type="text/css" href="/public/css/lobby_list_styles.css"> 
    <link rel="stylesheet" type="text/css" href="/public/css/match_lobby_style.css"> 
    <link rel="stylesheet" type="text/css" href="/public/css/tournament_list_style.css"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="/public/img/balls01.png">
</head>


<body>
     <header>
        <div class="container">
            <div class="logologin clearfix">
                <img src="/public/img/balls01.png" alt="SnookerLviv">
                <form action="/public/logout.php" class="login" method="post">
                    <input type="submit" value="Logout">
                </form>
                <form action="/public/playerHome.php" class="login" method="post">
                    <input type="submit" value="Home">
                </form>
                <nav class="navigation">
                    <ul>
                        <li><a href="/public/admin/tournaments">Tournaments</a></li>
                        <li><a href="/public/admin/players">Players</a></li>
                        <li><a href="/public/admin/clubs">Clubs</a></li>
                        <li><a href="/public/admin/leagues">Leagues</a></li>
                        <li><a href="/public/admin/rankings">Rankings</a></li>
                        <li><a href="/public/admin/matches">Matches</a></li>
                    </ul>
                </nav>
            </div>
        </div>
     </header>

	<div class="container">

