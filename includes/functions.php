<?php

function dump($variable)
{
	require(HOME_DIR."/templates/dump.php");
}


function apology($error, $message="contact admin")
{
	render("apology.php", ["title" => "Oops", "message" => $message, "errorType" => $error]);
}


function render($file, $values=[])
{
	if(file_exists(HOME_DIR."/templates/$file")) 
	{
		extract($values);

		require(HOME_DIR."/templates/default/header.php");
		
		require(HOME_DIR."/templates/$file");
		
		require(HOME_DIR."/templates/default/footer.php");
	}
	else
	{
		$msg = "File ".$file." does not exist";
		apology(OTHER_ERROR, $msg);
		exit;
	}
}


function adminApology($error, $message="contact admin")
{
	adminRender("apology.php", ["title" => "Oops", "message" => $message, "errorType" => $error]);
}


function adminRender($file, $values=[])
{
	if(file_exists(HOME_DIR."/templates/admin/$file")) 
	{
		extract($values);

		require(HOME_DIR."/templates/admin/header.php");
		
		require(HOME_DIR."/templates/admin/$file");
		
		require(HOME_DIR."/templates/admin/footer.php");
	}
	else
	{
		$msg = "File ".$file." does not exist";
		adminApology(OTHER_ERROR, $msg);
		exit;
	}
}

function firstGreaterPowerOf2($n)
{
	$N = 2;
	while($N < $n)
	{
		$N = $N * 2;
	}
	return $N;
}

function getSeedingArrayMy($currRound, $standart, $N)
{
    if( $currRound > 1 ){
		if( $standart % 2 == 0 ){
            $arr = array_merge(
                getSeedingArrayMy($currRound-1, $N/POW(2,$currRound-1)-$standart+1, $N), 
                getSeedingArrayMy($currRound-1, $standart, $N) 
            );
        }
        else{
            $arr = array_merge( 
                getSeedingArrayMy($currRound-1, $standart, $N), 
                getSeedingArrayMy($currRound-1, $N/POW(2,$currRound-1)-$standart+1, $N) 
            );
        }
    }
    else if( $currRound = 1 ) {
        return array($standart, $N-$standart+1);
    }
    return $arr;
}


function getSeedingArray( $currRound, $standart, $N )
{
	if( $currRound > 1 )
	{
		if( $standart % 2 == 0 ){
            $arr = array_merge(
				getSeedingArray($currRound-1, $N/POW(2,$currRound-1)-$standart+1, $N), 
				getSeedingArray($currRound-1, $standart, $N) 
			);
        }
		else{
            $arr = array_merge( 
				getSeedingArray($currRound-1, $standart, $N), 
				getSeedingArray($currRound-1, $N/POW(2,$currRound-1)-$standart+1, $N) 
			);
    	}
	}
    else if( $currRound = 1 )
    {
        if( $standart % 2 == 0 )
            return array($N-$standart+1, $standart);
        else
            return array($standart, $N-$standart+1);
	}

    return $arr;
}


function getTypes($params)
{
	$types = "";
	for($i = 0; $i<count($params); $i++)
	{
		if(gettype($params[$i]) == "string")
			$types .= 's';
		else if(gettype($params[$i]) == "integer")
			$types .= 'i';
		else if(gettype($params[$i]) == "double")
			$types .= 'd';
	}
	
	$a_params = array();
	$a_params[] = & $types;
	for($i=0; $i<count($params); $i++)
	{
		$a_params[] = & $params[$i];
	}
	return $a_params;
}

function JSquery()
{
	$query = func_get_arg(0);
	$params = array_slice(func_get_args(), 1);

	$mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	if($mysqli->connect_errno)
		return false;
	
	if( !empty($params) )
	{
		$a_params = getTypes($params);

		$stmt = $mysqli->prepare($query);
		if($stmt === false)
			return false;

		if(!call_user_func_array(array($stmt,'bind_param'),$a_params))
			return false;
		if( !$stmt->execute() )
			return false;
	}
	else
	{
		if(!$mysqli->query($query))
			return false;
	}

	$mysqli->close();
	return true;
}


function query()
{
	$query = func_get_arg(0);
	$params = array_slice(func_get_args(), 1);

	$mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	if($mysqli->connect_errno)
	{
		adminApology(OTHER_ERROR, "Failed to connect to MySQL: (".$mysqli->connect_errno.") ".$mysqli->connect_error);
		exit;
	}
	
	if( !empty($params) )
	{

		$a_params = getTypes($params);

		$stmt = $mysqli->prepare($query);
		if($stmt === false)
		{
			adminApology(OTHER_ERROR, "Query error: ".$query);
			exit;
		}

		if(!call_user_func_array(array($stmt,'bind_param'),$a_params))
		{
			adminApology(OTHER_ERROR, "Query error: ".$query);
			exit;
		}
		if( !$stmt->execute() )
		{
			adminApology(OTHER_ERROR, "Query error: ".$query);
			exit;
		}

		if(strcasecmp(substr($query, 0, 6), "select") !== 0)
		{
			return;
		}
		$result = $stmt->get_result();
	}
	else
	{
		if(strcasecmp(substr($query, 0, 6), "select") !== 0)
		{
			if(!$mysqli->query($query))
			{
				adminApology(OTHER_ERROR, "Query error ".$query);
				exit;
			}
			return;
		}

		$result = $mysqli->query($query);
	}

	if($result === false)
	{
		adminApology(OTHER_ERROR, "Query error: $query $params");
		exit;
	}
	$mysqli->close();
	return $result->fetch_all();
}



function nonEmpty()
{
	foreach(func_get_args() as $arg)
	{
		if(!isset($arg) || $arg === "")
			return false;
	}
	return true;
}

function exists($table, $id)
{
	$query = "SELECT 1 FROM $table WHERE id=? LIMIT 1";
	if(count(query($query, $id)) !== 1)
	{
		return false;
	}
	else
	{
		return true;
	}
}
	
function mailCheck($email)
{
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if(filter_var($email, FITLER_VALIDATE_EMAIL) === false )
	{
		return false;
	}
	else
	{
		return $email;
	}
}

function loginAvailable($login)
{
	$data = query("SELECT 1 from _user WHERE login=? LIMIT 1", $login);
	
	if(count($data) > 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function logout()
{
	$_SESSION = [];

	if(!empty($_COOKIE[session_name()]))
	{
		setcookie(session_name(), "", time()-42000);
	}

	session_destroy();
}

function redirect($destination)
{
	//$destination = HOME_DIR . $destination;
	// handle URL
	if (preg_match("/^https?:\/\//", $destination))
	{
		header("Location: " . $destination);
	}

	// handle absolute path
	else if (preg_match("/^\//", $destination))
	{
		$protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
		$host = $_SERVER["HTTP_HOST"];
		header("Location: $protocol://$host$destination");
	}

	// handle relative path
	else
	{
		// adapted from http://www.php.net/header
		$protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
		$host = $_SERVER["HTTP_HOST"];
		$path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: $protocol://$host$path/$destination");
	}

	// exit immediately since we're redirecting anyway
	exit;
}


function adminCheck()
{
	if($_SESSION["id"]["type"] == "admin")
	{
		return true;
	}
	else
	{
		return false;
	}
}

?>
