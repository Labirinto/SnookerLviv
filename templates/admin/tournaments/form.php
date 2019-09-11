
</br><mark>TODO age, billiard, name for NONE league</mark></br>
</br></br>
<fieldset>
	<legend>Tournament:</legend>
	<form action="create.php" method="post">
		Name: <input autofocus name="name" type="text"/>
		</br></br>

		League: <select name="league">
            <?php
			$data = query("SELECT LV.leagueID, LV.league, LV.billiard, 
				LV.age, LV.sex FROM leagueView LV
				ORDER BY 2, 3 DESC, 4, 5");
            for($i=0; $i<count($data); $i++)
            {
				$leagueID = $data[$i][0];
				$leagueName = $data[$i][1];
				$billiard = $data[$i][2];
				$age = $data[$i][3];
				$sex = $data[$i][4];
                
				print("<option value=\"$leagueID\">$leagueName ($billiard");
				if( strcmp($age,"") || strcmp($sex,"") )
				{
					print(" $age $sex");
				}
				print(")</option>\n");
            }
            ?>
        </select>
		</br></br>
	
		Club: <select name="club">
			<?php
			$data = query("SELECT id, name, city FROM club ORDER by id");
			for($i=0; $i<count($data); $i++)
			{
				$clubID = $data[$i][0];
				$clubName = $data[$i][1];
				$clubCity = $data[$i][2];
				print("<option value=\"$clubID\">$clubName, $clubCity</option>\n");
			}
			?>
		</select>
		</br></br>
	
		Begin date: <input name="date" type="date"/>
		</br></br>
		<button type="submit">Create</button>
	</form>
</fieldset>

<!-- TODO
Opens for NONE league 
(custom non ranking tournament with its own billiard, age, sex)
(no ranking only standings after tourney)
(for qualifications)

Billiard type: <select name="billiard">
            ?php
            $data = query("SELECT id, name FROM billiard order by id");
            for($i=0; $i<count($data); $i++)
            {
                print("<option value=\"".$data[$i][0]."\">".$data[$i][1]."</option>\n");
            }
            ?
        </select>
-->
