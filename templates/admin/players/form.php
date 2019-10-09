<fieldset>
	<legend>Credentials:</legend>
	<form action="create.php" method="post" enctype="multipart/form-data">
		First name: <input autofocus name="first" type="text"/></br>
		Last name: <input name="last" type="text"/></br>
		</br>
		<input name="photo" type="file"/></br></br>

		<input type="date" name="birthday" value="<?=date('Y-m-d')?>"/></br></br>
		<button type="submit">Create</button>
	</form>
</fieldset>

