<?php

$query = "SELECT P.id, P.playerName FROM (SELECT @getVal:=?) d,
            remainingPlayersForTournament P ORDER BY 2";

$data = query($query, $tournamentID);
if(count($data))
{
?>
	<div class="margin-b_30"></div>
	<form action="playerRegister.php" method="post">
		<select name="player">
			<?php
				
			for($i=0; $i<count($data); $i++)
			{
				$playerID = $data[$i][0];
				$playerName = $data[$i][1];
?>
				<option value="<?=$playerID?>"><?=$playerName?></option>
	  <?php } ?>
		</select>
		<input type="hidden" name="tournament" value="<?=$tournamentID?>"/>
		<button type="submit">Зареєструвати гравця</button>
		<div class="margin-b_30"></div>
	</form>
<?php
} ?>


<div class="tournamentNavigation">
	<form action="registration/stop.php" method="post">
		<input type="hidden" name="id" value="<?=$tournamentID?>"/>
		<button type="submit">Закінчити реєстрацію</button>
	</form>
</div>

