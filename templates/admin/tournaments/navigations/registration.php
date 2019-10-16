<?php $header = "lobby.php?id=$tournamentID"; ?>

<nav class="navigation navigation-down">
    <ul>
        <li><a href="<?=$header?>&onClick=players">Гравці</a></li>
        <li><a href="<?=$header?>&onClick=register">Зареєструвати</a></li>
    </ul>
</nav>

<div class="tournamentNavigation">
	<div id="divisor">
		<style>#divisor{width:20px}</style>
	</div>
	
	<form action="registration/stop.php" method="post">
		<input type="hidden" name="id" value="<?=$tournamentID?>"/>
		<button type="submit">Закінчити реєстрацію</button>
	</form>
</div>

