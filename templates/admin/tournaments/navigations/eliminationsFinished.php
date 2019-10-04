
<?php $header = "lobby.php?id=$tournamentID"; ?>

<nav class="navigation navigation-down">
    <ul>
        <li><a href="<?=$header?>&onClick=standings">Standings</a></li>
        <li><a href="<?=$header?>&onClick=bracket">Bracket</a></li>
        <li><a href="<?=$header?>&onClick=matches">Matches</a></li>
        <li><a href="<?=$header?>&onClick=breaks">Breaks</a></li>
    </ul>
</nav>

