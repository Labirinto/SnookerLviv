<?php $header = "lobby.php?id=$tournamentID"; ?>


<div class="tour_menu_box">
	<nav class="tour_menu">
		<a href="<?=$header?>&onClick=players">Гравці</a>
		<a href="<?=$header?>&onClick=register">Зареєструвати</a>
	</nav>
</div>

<div class="tournamentNavigation">
	<form action="registration/stop.php" method="post">
		<input type="hidden" name="id" value="<?=$tournamentID?>"/>
		<button type="submit">Закінчити реєстрацію</button>
	</form>
</div>

