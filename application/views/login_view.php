<section class="login-inner container">
	<form class="autorization" action="login" method="post">
		<h2 class="autorization__header">Вход на сайт</h2>
		<div class="autorization-content">
			<label for="">
				<p class="autorization__label">E-mail <sup>*</sup></p>
				<input class="autorization__input" type="text" name="email">
			</label>

			<label for="">
				<p class="autorization__label">Пароль<sup>*</sup></p>
				<input class="autorization__input" type="password" name="password">
			</label>

			<input class="autorization__submit" type="submit" name="" value="Войти">
			<p class="autorization__error-label"><?= $data ?></p>
			<p class="autorization__text-redirect">Не зарегистрированы?</p>
			<a class="autorization__login-redirect" href="registration">Зарегистрируйте аккаунт за 2 минуты.</a>
		</div>		
	</form>
</section>