<?php require("/home/levko/snookerLviv/templates/admin/clubs/index.php"); ?>
<link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/admin_panel.css">
<link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/club_list.css">
<script type="text/javascript" src="<?=PATH_H?>js/admin_functions.js">
</script>

        <div class="admin_header">
            <span>Панель адміністратора</span>
        </div>
        <div class="admin_buttons">
            <div class="buttons button_tour">
                <span><i class="fas fa-trophy"></i>
					 Створити турнір
				</span>
				<a href="<?=PATH_H?>admin/create/tournament.php">
                	<button>
						<i class="fas fa-trophy"></i> +
					</button>
				</a>
            </div>
            <div class="buttons button_player">
                <span><i class="fas fa-user"></i>
					 Створити гравця
				</span>
				<a href="<?=PATH_H?>admin/create/player.php">
					<button>
						<i class="fas fa-user"></i> +
					</button>
				</a>
            </div>
            <div class="buttons button_club">
                <span>
					<i class="fas fa-shield-alt"></i>
						 Створити клуб
				</span>
				<a href="<?=PATH_H?>admin/create/club.php">
					<button>
						<i class="fas fa-shield-alt"></i> +
					</button>
				</a>
            </div>
            <div class="buttons button_league">
                <span>
					<i class="fas fa-globe-americas"></i>
						 Створити лігу
				</span>
                <a href="<?=PATH_H?>admin/create/league.php">
					<button>
						<i class="fas fa-globe-americas"></i> +
					</button>
				</a>
            </div>
        </div>

<?php displayClubs(); ?>

