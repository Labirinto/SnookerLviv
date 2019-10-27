<!DOCTYPE html>
<html>
<head>
    <title><?=htmlspecialchars($title)?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/normalize.css">
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/navigation.css">
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/bracket.css">
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/styles.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/group.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/matches-list.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/lobby_list_styles.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/match_lobby_style.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/player_profile_style.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/participants.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/breaks.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/tournament_list.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/img_upload.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/results.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/group_results.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/club_list.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/available_tables.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/player_tournaments_list.css"> 
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/rating.css"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="<?=PATH_H?>img/balls01.png">
	
	<link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Merriweather:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<script type="text/javascript" src="/~levko/js/functions.js">
	</script>
</head>


<body>
     <header>
        <!-- LOGO -->
        <div class="logo_box">
        <img class="logo_img" src="<?=PATH_H?>img/sl_logo.png" alt="SnookerLviv">
        <span class="logo_text">billiard hub</span>
        </div>


        <!-- NAV MENU -->
         <nav class="navigation" id="myTopnav">

                <a href="<?=PATH_H?>admin/tournaments">Турніри</a>
                <a href="<?=PATH_H?>admin/players">Гравці</a>
                <a href="<?=PATH_H?>admin/clubs">Клуби</a>
                <a href="<?=PATH_H?>admin/leagues">Ліги</a>
                <a href="<?=PATH_H?>admin/rankings">Рейтинги</a>
                <a href="<?=PATH_H?>admin/matches">Матчі</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                 <i class="fa fa-bars"></i>
                 </a>

        </nav>

        <!-- BUTTONS -->
        <div class="header_buttons">
        <form action="<?=PATH_H?>logout.php" class="login" method="post">
            <i class="fas fa-sign-out-alt"></i>
			<input id="childOne" type="submit" value="Вийти">
        </form>
        <form action="<?=PATH_H?>playerHome.php" class="login" method="post">
            <i class="fas fa-home"></i>
			<input type="submit" value="Дім">
        </form>
        </div>

	</header>

	<div class="container">

