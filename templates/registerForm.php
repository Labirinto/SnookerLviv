<fieldset>
	<legend>Registration:</legend>
	<form action="<?=PATH_H?>register.php" method="post">
		First name: <input autofocus name="first" type="text"/></br>
		Last name: <input name="last" type="text"/></br>
		</br></br>
		Username: <input name="username" type="text"/></br>
		
		Email: <input name="email" type="email"/></br>
		Password:  <input name="pwd" type="password"/></br>
		Confirm password: <input name="pwd2" type="password"/>
		</br>
		<button type="submit">Register</button>
	</form>
</fieldset>
