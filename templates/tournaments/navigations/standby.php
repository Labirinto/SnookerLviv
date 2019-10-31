<?php $header = "lobby.php?id=$tournamentID"; ?>

<div class="tour_menu_box">
	<nav class="tour_menu">
		<a href="<?=$header?>&onClick=KO">KNOCKOUT</a>
		<a href="<?=$header?>&onClick=DE">DOUBLE ELIMINATION</a>
		<a href="<?=$header?>&onClick=GR-KO">GROUPS - KNOCKOUT</a>
		
		<a href="<?=$header?>&onClick=players">Гравці</a>
	</nav>
</div>
