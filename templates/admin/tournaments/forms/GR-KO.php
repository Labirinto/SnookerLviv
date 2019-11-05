
<style>#divisor{height:20px}</style>
<form action="start/GR-KO.php" method="post">
    <mark><b>GROUPS-KNOCKOUT FORM</b></mark>
    <div id="divisor"></div>
    
	Seeding type:<select name="seeding">
        <option value="Standart">Standart</option>
        <option value="Random">Random</option>
    </select></br>
    Seeded players: <input type="number" name="playersSeeded"/>
    <div id="divisor"></div>
    
	Min in a single group:<input type="number" name="groupMin"/></br>
    Players proceeding(min/2 by default):<input type="number" name="proceed"/>
    <div id="divisor"></div>
    
	<input type="hidden" name="id" value="<?=$tournamentID?>"/>
    <input type="submit" value="START"/>
</form>
