<?php $header = "lobby.php?id=$tournamentID"; ?>

<nav class="navigation navigation-down">
    <ul>
        <li><a href="<?=$header?>&onClick=players">Players</a></li>
        <li><a href="<?=$header?>&onClick=register">Register</a></li>
    </ul>
</nav>

<div class="tournamentNavigation">
	<div id="divisor">
		<style>#divisor{width:20px}</style>
	</div>
	
	<form action="registration/stop.php" method="post">
		<input type="hidden" name="id" value="<?=$tournamentID?>"/>
		<button type="submit">Stop Registration</button>
	</form>
</div>

