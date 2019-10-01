<a href="create.php">Create Tournament</a>
</br>

<h4><mark>TODO: </br>1.Unregister player</br>2.(maybe) delete tournament</mark></h4>

<div class="page_header">
	<img class="header_icon" alt="calendar" src="/public/img/web/calendar.png"> 
	<h1 class="tournament_list_table_header">Каледар</h1>
</div>

<?php
$status = "Live";
require("tournamentList.php");

$status = "Registration";
require("tournamentList.php");

$status = "Announced";
require("tournamentList.php");

$status = "Standby";
require("tournamentList.php");

$status = "Finished";
require("tournamentList.php");

function printHeader($status)
{
?>
	<div class="month_container">
		<div>
			<h3 class="tournament_list_table_month"><?=$status?></h3>
		</div>
		
		<table class="tournament_list_table">
			<colgroup>
				<col class="col-1">
				<col class="col-2">
				<col class="col-3">
				<col class="col-4">
			</colgroup>
			<thead class="tournament_list_table_thead">
				<tr>
					<th>#</th>
					<th>
						<img class="thead_icon" alt="trophy_image" src="/public/img/web/trophy.png"> 
						<span>Турнір</span>
					</th>
					<th>
						<img class="thead_icon" alt="trophy_image" width="9" src="/public/img/web/location.png"> 
						<span>Місце</span>
					</th>
					<th>
						<img class="thead_icon" alt="trophy_image" src="/public/img/web/calendar.png"> 
						<span>Дата</span>
					</th>
				</tr>
			</thead>
			
			<tbody class="tournament_list_table_tbody">
<?php
}

function printFooter()
{
?>
			</tbody>	
		</table>
	</div>
<?php
}
?>
