
<?php $header = "lobby.php?id=$tournamentID"; ?>

<div class="tour_menu_box">
	<nav class="tour_menu">
		<a href="<?=$header?>&onClick=standings">Результати</a>
		<a href="<?=$header?>&onClick=bracket">Сітка</a>
		<a href="<?=$header?>&onClick=matches">Матчі</a>
		<a href="<?=$header?>&onClick=breaks">Брейки</a>
	</nav>
</div>
