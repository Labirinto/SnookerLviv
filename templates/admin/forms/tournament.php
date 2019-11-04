
<link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/tournament_form.css">

	<div class="sub-container">
		<div class="margin-b_30"></div>
        <div class="login_box">
            <div class="login_img">
                <img src="<?=PATH_H?>img/sl_logo.png" alt="BilliardHub Logo">
            </div>
            <div class="login_header">
                <span>Додати турнір</span>
            </div>
            <form class="login_form" action="tournament.php" method="post">
            	<input type="text" name="name"
					autofocus placeholder="Назва">
            	<div class="tour_select">
              		<select name="league">
						<option selected disabled> Оберіть лігу</option>
                 		<?php printLeagues(); ?>
					</select>
              	</div>
            	<div class="tour_select">
                  	<select name="club">
                    	<option selected disabled> Оберіть клуб</option>
                  		<?php printClubs(); ?>
					</select>
              	</div>
              	<input type="date" name="date">
             	<span class="date_format">
                	*Дата проведення
              	</span>
				<div class="margin-b_30"></div>
				
				<button>Додати</button>
			</form>
		</div>
	</div>

<?php
function printLeagues()
{
	$data = query("SELECT LV.leagueID, LV.league, LV.billiard, 
		LV.age, LV.sex FROM leagueView LV
		ORDER BY 2, 3 DESC, 4, 5");
	$data_count = count($data);
	
	for($i=0; $i < $data_count; $i++)
	{
		$leagueID = $data[$i][0]; $leagueName = $data[$i][1];
		$billiard = $data[$i][2]; $age = $data[$i][3];
		$sex = $data[$i][4];
		
		$leagueText = $leagueName."(".$billiard;
		if( strcmp($age,"") || strcmp($sex,"") )
		{
			$leagueName .= $age." ".$sex;
		}
		$leagueText .= ")";

		displayLeague($leagueID, $leagueText);
	}
}
function displayLeague($id, $name)
{ ?>
	<option value="<?=$id?>"><?=$name?></option>
<?php }


function printClubs()
{
	$data = query("SELECT id, name, city FROM club 
		ORDER by 2, 1");
	for($i=0; $i<count($data); $i++)
	{
		$clubID = $data[$i][0]; $clubName = $data[$i][1];
		$clubCity = $data[$i][2];
		
		displayClub($clubID, $clubName, $clubCity);
	}
}
function displayClub($id, $name, $city)
{ ?>
	<option value="<?=$id?>"><?=$name?>, <?=$city?></option>
<?php } ?>

