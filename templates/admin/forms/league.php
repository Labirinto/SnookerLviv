
</br></br>

	<form action="league.php" method="post">
		Ліга:
</br></br>
		Назва: <input name="name" type="text"/> 
		</br></br>
		
		Вид більярду: <select name="billiard">
			<?php 
			$data = query("SELECT id, name FROM billiard ORDER BY id");
			for($i=0; $i<count($data); $i++)
			{
				$billiardID = $data[$i][0]; $billiard = $data[$i][1];
				print("<option value=\"$billiardID\">$billiard</option>\n");
			} 
			?>
		</select>
		Вік: <select name="age">
			<?php
			$data = query("SELECT id, name FROM age ORDER BY id");
			for($i=0; $i<count($data); $i++)
			{
				$ageID = $data[$i][0]; $age = $data[$i][1];
				print("<option value=\"$ageID\">$age</option>\n");
			}
			?>
		</select>
		</br></br>

		Організація: <select name="organisation">
			<?php 
			$data = query("SELECT id, name FROM organisation ORDER BY id");
			for($i=0; $i<count($data); $i++)
			{
				$orgID = $data[$i][0]; $org = $data[$i][1];
				print("<option value=\"$orgID\">$org</option>\n");
			} 
			?>
		</select>
		</br></br>	
		Стать:  
			Ч <input name="sex" type="radio" value="Men"/>
			Ж <input name="sex" type="radio" value="Women"/>
			Всі <input name="sex" type="radio" checked="checked" value=""/>
		</br></br>
		<button type="submit">Створити</button>
	</form>
