
<style>#divisor{height:20px}</style>
<form action="start/DE.php" method="post">
    <mark><b>DOUBLE ELIMINATION FORM</b></mark>
    <div id="divisor"></div>
    
	Seeding type:<select name="seeding">
        <option value="Standart">Standart</option>
        <option value="Random">Random</option>
    </select>
    <div id="divisor"></div>
    
	Matches in K/O:<input type="number" name="matches"/>
    <div id="divisor"></div>
    
	<input type="hidden" name="id" value="<?=$tournamentID?>"/>
    <input type="submit" value="START"/>
</form>
