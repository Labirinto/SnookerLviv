
<?php
	require("/home/levko/snookerLviv/templates/admin/players/tournamentList.php");
	require("/home/levko/snookerLviv/templates/admin/players/tournamentBreaksList.php");
?>

	<div class="table_list">
		<div class="player_profile_section01">
			<div class="player_profile_photo">
				<figure>
					<img class="player_profile_img" src="<?=PLAYER_IMG.$img?>" alt="Фото гравця">
				</figure>
			</div>
			<div class="player_profile_personalInfo">
				<table>
					<th colspan="2">
						<div class="player_profile_playerName">
							<i class="fas fa-user"></i>
							<div class="player_profile_header">
								<?=$fName?> <span class="player_profile_surname"> <?=$lName?></span>
							</div>
						</div>
						
					</th>
					<tr>
						<td>
							<div class="player_profile_country">
								<div class="player_profile_tableHeader">країна</div>
								<div class="player_profile_tableMean">Україна</div>
							</div>
						</td>
						<td>
							<div class="player_profile_city">
								<div class="player_profile_tableHeader">місто</div>
								<div class="player_profile_tableMean">Львів</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="player_profile_age">
								<div class="player_profile_tableHeader">дата народження</div>
								<div class="player_profile_tableMean"><?=$birthday?></div>
							</div>
						</td>
						<td>
							<div class="player_profile_maxBreak">
								<div class="player_profile_tableHeader">найвищий турнірний<br>брейк</div>
								<div class="player_profile_tableMean max_break"><?=$highestBreak?></div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div> <br>

			<!-- SECTION 02 (CIRCLES) -->

		<div class="player_profile_section02">
			<div class="player_profile_circle highlight_anchor"
			onclick="player_profile(event, 'tournaments')">
				<div class="little_circle">
					<?=$tournamentCtr?>
				</div>
				<i class="fas fa-trophy"></i><br>
				<span class="circle_text">турніри</span>
			</div>
			<div class="player_profile_circle highlight_anchor"
			onclick="player_profile(event, 'tournaments_b')">
				<div class="little_circle">
					<?=$breakCtr?>
				</div>
				<i class="fas fa-trophy"></i> <br>
				<span class="circle_text">брейки</span>
			</div>
			<div class="player_profile_circle highlight_anchor">
				<div class="little_circle">
					x
				</div>
				<i class="fas fa-user-friends"></i><br>
				<span class="circle_text">спаринги</span>
			</div>
			<div class="player_profile_circle highlight_anchor">
				<div class="little_circle">
					x
				</div>
				<i class="fas fa-user-friends"></i> <br>
				<span class="circle_text">брейки</span>
			</div>
		</div>
	</div>
	<div class="player_profile_details">
        <div id="tournaments" class="details_anchor">
        	<?php tournamentList($playerID); ?>
		</div>

        <div id="tournaments_b" class="details_anchor">
			<?php tournamentBreaksList($playerID); ?>
        </div>
    </div>


    <script>
        function player_profile(evt, tabName) {
          var i, tabcontent, tablinks;
          tabcontent=document.getElementsByClassName("details_anchor");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks=document.getElementsByClassName("highlight_anchor");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" pl_pr_active", "");
          }

          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " pl_pr_active";
        }
    </script>

