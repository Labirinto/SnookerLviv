
<form action="create.php" method="post">
	<fieldset>
		<legend>League:</legend>
		Name: <input name="name" type="text"/> 
		</br></br>
		
		Billiard type: <select name="billiard">
			<?php 
			$data = query("SELECT id, name FROM billiard ORDER BY id");
			for($i=0; $i<count($data); $i++)
			{
				$billiardID = $data[$i][0]; $billiard = $data[$i][1];
				print("<option value=\"$billiardID\">$billiard</option>\n");
			} 
			?>
		</select>
		Age: <select name="age">
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

		Organisation: <select name="organisation">
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
		Sex:  
			M <input name="sex" type="radio" value="Men"/>
			F <input name="sex" type="radio" value="Women"/>
			All <input name="sex" type="radio" checked="checked" value=""/>
		</br></br>
		<button type="submit">Create</button>
	</fieldset>
</form>
