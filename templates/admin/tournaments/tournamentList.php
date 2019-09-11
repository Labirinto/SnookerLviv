
<h2><mark><?=$status?></mark></h2>

<?php

$data = query("SELECT TV.tournamentID, TV.tournament, TV.billiard, 
            TV.age, TV.sex
            FROM generalTournamentView TV WHERE TV.status=?
            ORDER BY 2, 3 DESC, 4, 5", $status);


for($i=0; $i<count($data); $i++)
{
	$id = $data[$i][0];
	$name = $data[$i][1];
	$billiard = $data[$i][2];
	$age = $data[$i][3];
	$sex = $data[$i][4];
?>    
	<a href="lobby.php?id=<?=$id?>"><?=$name?> (<?=$billiard?>)
    <?php if( strcmp($age, "") || strcmp($sex, "") )
    { ?>
        (<?=$age?> <?=$sex?>)
    <?php } ?>
    </a>
    </br>
<?php
}
?>
