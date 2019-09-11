<?php

require("../includes/config.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	render("registerForm.php", ["title" => "Registration"]);
}
else if($_SERVER["REQUEST METHOD"] = "POST")
{
    if(!nonEmpty($_POST["username"], $_POST["first"], $_POST["last"], 
				$_POST["pwd"], $_POST["pwd2"], $_POST["email"]))
	{
        apology(INPUT_ERROR, "All fields are required");
        exit;
    }
    if( $_POST["pwd"] != $_POST["pwd2"] )
    {
        apology(INPUT_ERROR, "Passwords don't match");
        exit;
    }
	$email = mailCheck($_POST["email"]);
	if($email === false)
	{
		apology(INPUT_ERROR, "Provide proper email: john.doe@example.com");
		exit;
	}
	//sanitize, filter
	if( !loginAvailable($_POST["username"]) )
	{
		apology(INPUT_ERROR, "This username is already taken");
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
