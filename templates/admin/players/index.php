</br>
<a href="create.php">Create Player</a>

<?php 

	generalHeader();

	$data = query("SELECT P.id, P.firstName, P.lastName, P.photo, P.birthday
				FROM player P 
				WHERE P.id NOT IN(-1,-2) ORDER BY 2");
	$data_count = count($data);

	listHeader();
    for($i = 0; $i < $data_count; $i++)
    {
        $id = $data[$i][0]; $fName = $data[$i][1];
        $lName = $data[$i][2]; $img = $data[$i][3];
		$birthday = $data[$i][4];
        printListPlayer($i+1, $id, $fName." ".$lName, $img, $birthday, ($i+1==$data_count));
    }
    listFooter();

    barsHeader();
    for($i = 0; $i < $data_count; $i++)
    {
        $id = $data[$i][0]; $fName = $data[$i][1];
        $lName = $data[$i][2]; $img = $data[$i][3];
        printBarsPlayer($id, $fName, $lName, $img);
    }
    barsFooter();

	generalFooter();


function generalHeader()
{ ?>
	<script type="text/javascript" src="/~levko/js/player_search.js"></script>
    <div class="sub-container">
	<div class="header_search">
        <div class="participants_header">
            <h3>Список гравців</h3>
            <div class="tab">
                <button class="tablinks active" onclick="openTab(event, 'list')"> <i class="fas fa-bars"></i></button>
                <button class="tablinks" onclick="openTab(event, 'bars')"><i class="fas fa-th-large"></i></button>
            </div>
        </div>
        <div class="players_list_search_field">
            <form class="centered_search_div" action="#">
                <input id="myInput" onkeyup="player_search()" type="text" placeholder="Пошук.." name="search">
            </form>
        </div>
    </div>
<?php }
function generalFooter()
{ ?>
    </div>
	</div>
<?php
}

function listHeader()
{ ?>
    <div id="list" class="sub-container tabcontent">
        <div class="participants_table_container">
        <table id="myTable" class="participants_table">
            <colgroup>
                <col class="col-1">
                <col class="col-2">
                <col class="col-3">
                <col class="col-4">
                <col class="col-5">
                <col class="col-6">
            </colgroup>
            <thead class="participants_table_thead">
                <tr>
                    <th>#</th>
                    <th>Ім'я</th>
                    <th>Дата народження</th>
                    <th>Звання</th>
                    <th>Локація</th>
                    <th>Жереб</th>
                </tr>
            </thead>
            <tbody class="participants_table_tbody">
<?php
}

function listFooter()
{ ?>
                </tbody>
            </table>
            </div>
        </div>
<?php
}

function printListPlayer($i, $id, $name, $img, $birthday, $isLast)
{
    $e_o = ($i%2) ? "odd" : "even";
 ?>
            <tr onclick="openPlayerLobby(<?=$id?>);"
                class="tbody_<?=$e_o?> pointer">
                <td class="participants_table_number <?=$e_o?>_num<?=($isLast)?" radius_bl":""?>">
					<?=$i?>
				</td>
                <td class="participants_table_name">
                    <img class="circle_img" src="<?=PLAYER_IMG.$img?>" alt="img">
                    <span><?=$name?></span>
                </td>
                <td>
                    <span><?=$birthday?></span>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td class="<?=($isLast)?"radius_br":""?>">
                    <span><?=$seed?></span>
                </td>
            </tr>
<?php
}

function barsHeader()
{ ?>
        <div id="bars" class="players_list_box tabcontent">
            <ul class="players_u-list_item" id="myUL">
<?php
}

function barsFooter()
{ ?>
            </ul>
        </div>
<?php
}


function printBarsPlayer($id, $fName, $lName, $img)
{ ?>
            <li class="pointer"
			onclick="openPlayerLobby(<?=$id?>);">
                <div class="players_list_item_box">
                    <figure>
                        <img class="players_list_item_photo" src="<?=PLAYER_IMG.$img?>" alt="img">
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
            </li>
<?php
}
?>
