
<!--<div class="tournamentNavigation">
    <form action="lobby.php" method="get">
        <input type="hidden" name="id" value="<=$tournamentID?>"/>
        <button type="submit" name="onClick" value="standings">Standings</button>
        <button type="submit" name="onClick" value="groups">Groups</button>
        <button type="submit" name="onClick" value="matches">Matches</button>
        <button type="submit" name="onClick" value="breaks">Breaks</button>
    </form>
</div>
-->

<?php $header = "lobby.php?id=$tournamentID"; ?>

<nav class="navigation">
	<ul>
		<li><a href="<?=$header?>&onClick=standings">Standings</a></li>
		<li><a href="<?=$header?>&onClick=groups">Groups</a></li>
		<li><a href="<?=$header?>&onClick=matches">Matches</a></li>
		<li><a href="<?=$header?>&onClick=breaks">Breaks</a></li>
	</ul>
</nav>

