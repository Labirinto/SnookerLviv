	<section>
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
							<div class="player_profile_header"><?=$fName?> <span class="player_profile_surname"> <?=$lName?></span>
							</div>
						</div>
						
					</th>
					<tr>
						<td>
							<div class="player_profile_country">
								<div class="player_profile_tableHeader">країна</div>
								<div class="player_profile_tabelMean">Україна</div>
							</div>
						</td>
						<td>
							<div class="player_profile_city">
								<div class="player_profile_tableHeader">місто</div>
								<div class="player_profile_tabelMean">Львів</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="player_profile_age">
								<div class="player_profile_tableHeader">дата народження</div>
								<div class="player_profile_tabelMean"><?=$birthday?></div>
							</div>
						</td>
						<td>
							<div class="player_profile_maxBreak">
								<div class="player_profile_tableHeader">найвищий турнірний<br>брейк</div>
								<div class="player_profile_tabelMean max_break"><?=$highestBreak?></div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div> <br>

			<!-- SECTION 02 (CIRCLES) -->

		<div class="player_profile_section02">
			<a class="circle_hover" href="tournamentList.php?id=<?=$playerID?>">
			<div class="player_profile_circle">
				<div class="little_circle">37</div>
				<i class="fas fa-trophy"></i><br>
				<span class="circle_text">турніри</span>
			</div>
			</a>
			<a class="circle_hover" href="tournamentBreaks.php?id=<?=$playerID?>">
			<div class="player_profile_circle">
				<div class="little_circle">19</div>
				<i class="fas fa-trophy"></i> <br>
				<span class="circle_text">брейки</span>
			</div>
			</a>
			<a class="circle_hover" href="#" >
			<div class="player_profile_circle">
				<div class="little_circle">80</div>
				<i class="fas fa-user-friends"></i><br>
				<span class="circle_text">спаринги</span>
			</div>
			</a>
			<a class="circle_hover" href="#">
			<div class="player_profile_circle">
				<div class="little_circle">44</div>
				<i class="fas fa-user-friends"></i> <br>
				<span class="circle_text">брейки</span>
			</div>
			</a>
		</div>
	</section>
