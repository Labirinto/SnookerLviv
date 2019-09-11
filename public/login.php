<?php

require("../includes/config.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    render("loginForm.php", ["title" => "Log In"]);
}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if( !nonEmpty($_POST["username"],$_POST["password"]) )
    {
        apology(INPUT_ERROR, "Provide username AND password");
        exit;
    }   
        
    $query = "SELECT hash, login, userType FROM _user WHERE login=?";
	$login = $_POST["username"];
    $data = query($query, $login);

    if(count($data) == 1)
    {
        if(password_verify($_POST["password"], $data[0][0]))
        {
			$login = $data[0][1]; $type = $data[0][2];
            $_SESSION["id"] = ["login"=>$login, "type"=>$type];

			if($_SESSION["id"]["type"] == "admin")
        		redirect("/public/admin");
			else if($_SESSION["id"]["type"] == "regular")
				redirect("playerHome.php");
		}
    }

   	apology(INPUT_ERROR, "Wrong username OR password");
}

?>
