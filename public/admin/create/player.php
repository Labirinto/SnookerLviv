<?php

require("../../../includes/adminConfig.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	adminRender("forms/player.php", ["title" => "Додати гравця"]);
}
else if($_SERVER["REQUEST METHOD"] = "POST")
{
	$fName = $_POST["first"];
    $lName = $_POST["last"];

	$birthday = date('Y-m-d', strtotime($_POST["birthday"]) );
	if( !$birthday)
	{
        adminApology(INPUT_ERROR, "Помилка дати");
        exit;
	}

    if( !nonEmpty($fName, $lName) )
	{
        adminApology(INPUT_ERROR, "Необхідно заповнити всі поля");
        exit;
    }
	if( !$_FILES["photo"]["size"] )
	{
		$photo = "default.png";
	}
	else
	{
		$photo = $fName . "_" . $lName . ".jpg";
		$filepath = HOME_DIR . "public/img/player/" . $photo;
   
		if( !getimagesize($_FILES["photo"]["tmp_name"]) ) 
		{
			adminApology(INPUT_ERROR, "Завантажте фото");
			exit;
		}
		if( !move_uploaded_file($_FILES["photo"]["tmp_name"], $filepath) )
		{
			adminApology(INPUT_ERROR, "Помилка фотографії "." ".$filepath." ".$_FILES["photo"]["name"]);
			exit;
		}
	}
 
	$query = "INSERT INTO player(firstName, lastName, photo, birthday) VALUES(?,?,?,?)";
    
	query($query, $fName, $lName, $photo, $birthday);
    redirect(PATH_H."admin/");
}

?>
