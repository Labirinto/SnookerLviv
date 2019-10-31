
<style>#divisor{height:20px}</style>
<form action="start/KO.php" method="post">
	<mark><b>KNOCKOUT FORM</b></mark>
    <div id="divisor"></div>
    
	Seeding type:<select name="seeding">
        <option value="Standart">Standart</option>
        <option value="Random">Random</option>
    </select></br>

	Seeded players: <input type="number" name="playersSeeded"/>
    <div id="divisor"></div>
    
	<input type="hidden" name="id" value="<?=$tournamentID?>"/>
    <input type="submit" value="START"/>
</form>

