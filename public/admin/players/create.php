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
    if( !nonEmpty($fName, $lName) )
	{
        adminApology(INPUT_ERROR, "All fields are required");
        exit;
    }
    
	$query = "INSERT INTO player(firstName, lastName) VALUES(?,?)";
    
	query($query, $fName, $lName);
    redirect("");
}

?>
