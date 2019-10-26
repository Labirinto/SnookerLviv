	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
	</script>

	<div class="sub-container">
		Дані гравця:
		<form action="create.php" method="post" enctype="multipart/form-data">
			<div class="avatar-upload">
				<div class="avatar-preview">
					<div id="imgPreview"
					style="background-image: url(http://localhost/~levko/img/player/default.png);">
					</div>
				</div>
				<div class="avatar-edit">
					<input type='file' id="imgUpload" accept=".png, .jpg, .jpeg" name="photo"/>
					<label for="imgUpload">
						<i class="fas fa-upload"></i>
						Завантажити
					</label>
				</div>
			</div>


			Ім'я: <input autofocus name="first" type="text"/></br>
			Прізвище: <input name="last" type="text"/></br>
			</br></br>

			Дата народження:</br><input type="date" name="birthday" value="<?=date('Y-m-d')?>"/></br></br>
			<button type="submit">Створити</button>
		</form>
	</div>

	<script type="text/javascript" src="/~levko/js/img_upload.js">
	</script>

