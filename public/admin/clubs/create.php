<?php

require("../../../includes/adminConfig.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	adminRender("clubs/form.php", ["title" => "Create club"]);
}	
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST["name"];
	$country = $_POST["country"];
	$city = $_POST["city"];
	$tables = $_POST["tables"];


	if( !nonEmpty($name, $country, $city, $tables) )
	{
		adminApology(INPUT_ERROR, "All fields required");
		exit;
	}

	if( !$_FILES["photo"]["size"] )
    {
        $photo = "default.png";
    }
    else
    {
        $photo = $name . ".jpg";
        $filepath = HOME_DIR . "public/img/club/" . $photo;

        if( !getimagesize($_FILES["photo"]["tmp_name"]) )
        {
            adminApology(INPUT_ERROR, "Upload actual photo");
            exit;
        }
        if( !move_uploaded_file($_FILES["photo"]["tmp_name"], $filepath) )
        {
            adminApology(INPUT_ERROR, "Photo error"." ".$filepath." ".$_FILES["photo"]["name"]);
            exit;
        }
    }




	
	$query = "INSERT INTO club(name, country, city, nrOfTables, photo) 
			VALUES(?,?,?,?,?)";
	
	query($query, $name, $country, $city, $tables, $photo);
	redirect("");
}

?>
