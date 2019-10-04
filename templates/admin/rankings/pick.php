
<h3><mark>TODO show leagues for specific(picked) organisation</mark></h3>
</br>

<fieldset>
	<legend>Ranking:</legend>
	<form action="" method="post">
		Select League: <select name="league">
	<?php
		$data = query("SELECT LV.leagueID, LV.league, LV.billiard, LV.age, 
			LV.sex, LV.tournaments 
			FROM leagueView LV WHERE LV.tournaments > 0
			ORDER BY 2, 3 DESC, 4, 5");

		for($i=0; $i<count($data); $i++)
		{
			$leagueID = $data[$i][0]; $leagueName = $data[$i][1];
			$billiard = $data[$i][2];
			$age = $data[$i][3]; $sex = $data[$i][4];
			$nrOfTournaments = $data[$i][5];

			$leagueText = "$leagueName ($billiard ";
			if( strcmp($age,"") || strcmp($sex,"") )
			{
				$leagueText .= " $age $sex";
			}
		   
			$leagueText.= ") ($nrOfTournaments)";

			print("<option value=\"$leagueID|$leagueText\">$leagueText</option>\n");
		}
		?>
        </select>
		</br></br>
		<button type="submit">Generate</button>
	</form>
</fieldset>


