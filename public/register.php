<?php

require("../includes/config.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	render("registerForm.php", ["title" => "Реєстрація"]);
}
else if($_SERVER["REQUEST METHOD"] = "POST")
{
    if(!nonEmpty($_POST["username"], $_POST["first"], $_POST["last"], 
				$_POST["pwd"], $_POST["pwd2"], $_POST["email"]))
	{
        apology(INPUT_ERROR, "Необхідно заповнити всі поля");
        exit;
    }
    if( $_POST["pwd"] != $_POST["pwd2"] )
    {
        apology(INPUT_ERROR, "Паролі не співпадають");
        exit;
    }
	$email = mailCheck($_POST["email"]);
	if($email === false)
	{
		apology(INPUT_ERROR, "Введіть правильний email: john.doe@example.com");
		exit;
	}
	//sanitize, filter
	if( !loginAvailable($_POST["username"]) )
	{
		apology(INPUT_ERROR, "Це ім'я користувача недоступне");
		exit;
	}

    $fName = $_POST["first"];
    $lName = $_POST["last"];
    $login = $_POST["username"];
    $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

    $query1 = "INSERT INTO _user(login, hash, email, userType) VALUES(?,?,?,?)";
    $query2 = "INSERT INTO player(firstName, lastName) VALUES(?,?)";
    
	query($query1, $login, $pwd, $email, "regular");
	query($query2, $fName, $lName);
    redirect("login.php");
}

?>
