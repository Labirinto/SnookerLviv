<?php $header = "lobby.php?id=$tournamentID"; ?>

<nav class="navigation navigation-down">
    <ul>
        <li><a href="<?=$header?>&onClick=KO">Knockout</a></li>
        <li><a href="<?=$header?>&onClick=DE">Double Elimination</a></li>
        <li><a href="<?=$header?>&onClick=GR-KO">Groups-Knockout</a></li>
		
		<div id="divisor">
			<style>#divisor{width:20px}</style>
		</div>
        
		<li><a href="<?=$header?>&onClick=players">Players</a></li>
    </ul>
</nav>
