    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>


	<div class="sub-container">
		Дані клубу:
		<form action="create.php" method="post" enctype="multipart/form-data">
            <div class="avatar-upload">
                <div class="avatar-preview">
                    <div id="imgPreview"
					style="background-image: url(http://localhost/~levko/img/club/default.png);">
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
			
			Назва: <input autofocus name="name" type="text"/>
			</br></br>
			Країна: <input name="country" type="text"/>
			</br>
			Місто: <input name="city" type="text"/>
			</br></br>
			Кількість столів:
			</br>
			<input name="tables" type="number"/>
			</br></br>
			<button type="submit">
				Створити
			</button>
        </form>
	</div>

    <script type="text/javascript" src="/~levko/js/img_upload.js">
    </script>

