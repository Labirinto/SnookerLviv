
<h3><mark>TODO playerLobby with href</mark></h3>

<a href="create.php">Create Player</a>
<h1>List of ALL Players:</h1>

<?php 

$data = query("SELECT P.id, P.lastName, P.firstName, P.photo
			FROM player P 
			WHERE P.id NOT IN(-1,-2) ORDER BY 2");

if(count($data) > 0)
{
	generateHeader();

	for($i = 0; $i<count($data); $i++)
	{
		$id = $data[$i][0];
		$fName = $data[$i][1];
		$lName = $data[$i][2];
		$img = $data[$i][3];

		printPlayer($id, $fName, $lName, $img);
		//print("<a href=\"lobby.php?id=".$id."\">".$fName." ".$lName."</a></br>\n");
	}
}


function generateHeader()
{ ?>
     <header>
		<i class="fas fa-user"></i>
		<h1 class="players_list_header">Гравці</h1>
	</header>

	<section>
		<div class="players_list_search_field">
			<form class="centered_search_div" action="#">
			  <input id="myInput" onkeyup="myFunction()" type="text" placeholder="Пошук.." name="search">
			</form>
		</div>
		<div class="players_list_box">
			<ul class="players_u-list_item" id="myUL">
<?php }

function printPlayer($playerID, $fName, $lName, $img)
{ ?>

				<li>
					<a href="lobby.php?id=<?=$playerID?>">
					<div class="players_list_item_box">
						<figure>
							<img class="players_list_item_photo" alt="фото_гравця" src="<?=PLAYER_IMG.$img?>">
						</figure>
						<div class="players_list_item_details">
							<div class="players_list_item_name">
								<h4 class="players_list_item_name">
									<?=$fName?> <span class="surname"><?=$lName?></span>
								</h4>
							</div>
								<p class="players_list_item_location">
									Львів, Україна
								</p>
						</div>
					</div>
					</a>
				</li>

<?php
}
?>
