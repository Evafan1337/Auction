<section class="login-inner container">
	<form class="autorization autorization--registration" action="registration" method="post">
		<h2 class="autorization__header">Регистрация</h2>
		<div class="autorization-content">
			<label for="">
				<p class="autorization__label">E-mail <sup>*</sup></p>
				<input class="autorization__input" type="text" name="email">
			</label>

			<label for="">
				<p class="autorization__label">Имя/Логин<sup>*</sup></p>
				<input class="autorization__input" type="text" name="login">
			</label>

			<label for="">
				<p class="autorization__label">Пароль<sup>*</sup></p>
				<input class="autorization__input" type="password" name="password">
			</label>

			<label for="">
				<p class="autorization__label">Паспортные данные<sup>*</sup></p>
				<input class="autorization__input" type="text" name="data">
			</label>

			<input class="autorization__submit autorization__submit--register" type="submit" name="" value="Зарегистрироваться">
			<p class="autorization__error-label"><?= $data ?></p>
			<p class="autorization__text-redirect">Уже зарегистрированы?</p>
			<a class="autorization__login-redirect" href="login">Войдите под свой учетной записью.</a>
		</div>	
	</form>
</section>