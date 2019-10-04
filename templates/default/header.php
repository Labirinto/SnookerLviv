<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/normalize.css">
    <link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/styles.css"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="<?=PATH_H?>img/balls01.png">
</head>

<body>
<style>
body { background-image: url("/~levko/img/default.png"); }
</style>
 
	<header>
        <div class="container">
            <div class="logologin clearfix">
                <img src="<?=PATH_H?>img/balls01.png" alt="SnookerLviv">
                <form action="<?=PATH_H?>login.php" class="login">
					<input type="submit" value="Login">
				</form>
				<form action="<?=PATH_H?>register.php" class="login">
                    <input type="submit" value="Register">
                </form>

            </div>
        </div>
     </header>

	<div class="container">
