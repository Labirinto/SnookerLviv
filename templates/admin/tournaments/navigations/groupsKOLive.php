
<?php $header = "lobby.php?id=$tournamentID"; ?>

<nav class="navigation navigation-down">
    <ul>
        <li><a href="<?=$header?>&onClick=live">Наживо</a></li>
        <li><a href="<?=$header?>&onClick=groups">Групи</a></li>
        <li><a href="<?=$header?>&onClick=groupStanding">Результати груп</a></li>
        <li><a href="<?=$header?>&onClick=bracket">Сітка</a></li>
        <li><a href="<?=$header?>&onClick=matches">Матчі</a></li>
        <li><a href="<?=$header?>&onClick=players">Гравці</a></li>
        <li><a href="<?=$header?>&onClick=breaks">Брейки</a></li>
    </ul>
</nav>


