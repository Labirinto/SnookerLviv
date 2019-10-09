<?php

require("../../../includes/adminConfig.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	adminRender("players/form.php", ["title" => "Create player"]);
}
else if($_SERVER["REQUEST METHOD"] = "POST")
{
	$fName = $_POST["first"];
    $lName = $_POST["last"];

	$birthday = date('Y-m-d', strtotime($_POST["birthday"]) );
	if( !$birthday)
	{
        adminApology(INPUT_ERROR, "Date error");
        exit;
	}

    if( !nonEmpty($fName, $lName) )
	{
        adminApology(INPUT_ERROR, "All fields are required");
        exit;
    }
	if( !$_FILES["photo"]["size"] )
	{
		$photo = "default.png";
	}
	else
	{
		//$filename = basename($_FILES["photo"]["name"]);
		$photo = $fName . "_" . $lName . ".png";
		$filepath = HOME_DIR . "public/img/player/" . $photo;
   
		if( !getimagesize($_FILES["photo"]["tmp_name"]) ) 
		{
			adminApology(INPUT_ERROR, "Upload actual photo");
			exit;
		}
		if( !move_uploaded_file($_FILES["photo"]["tmp_name"], $filepath) )
		{
			adminApology(INPUT_ERROR, "Photo error"." ".$filepath);
			exit;
		}
	}
 
	$query = "INSERT INTO player(firstName, lastName, photo, birthday) VALUES(?,?,?,?)";
    
	query($query, $fName, $lName, $photo, $birthday);
    redirect("");
}

?>
