
<link rel="stylesheet" type="text/css" href="<?=PATH_H?>css/login_form.css"> 
	    <div class="margin-b_30"></div>
		<div class="login_box">
            <div class="login_img">
                <img src="img/sl_logo.png" alt="BilliardHub Logo">
            </div>
            <div class="login_header">
                <span>Реєстрація</span>
            </div>
            <form class="login_form" action="<?=PATH_H?>register.php" method="post">
            	<input type="text" placeholder="Ім'я" name="first">
            	<input type="text" placeholder="Прізвище" name="last">
	    		
				<div class="margin-b_30"></div>
            	<input type="text" placeholder="Ім'я користувача" name="username">
            	<input type="email" placeholder="E-mail" name="email">
            	
	    		<div class="margin-b_30"></div>
				<input type="password" placeholder="Пароль" name="pwd">
            	<input type="password" placeholder="Підтвердіть пароль" name="pwd2">
              <button>Зареєструватись</button>
            </form>
			<a href="<?=PATH_H?>login.php">
				<div class="login_register">
					<span>Увійти</span>
				</div>
			</a>
        </div>

