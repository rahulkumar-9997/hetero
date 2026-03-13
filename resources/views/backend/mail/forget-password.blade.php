<!-- <h1>Forget Password Email</h1> -->
<!-- <p>You can reset your password using the link below:</p> -->
<h1>Письмо для сброса пароля</h1>
<p>Вы можете сбросить свой пароль, используя ссылку ниже:</p>
<a href="{{ route('reset.password.get', $data['token']) }}">Сбросить пароль</a>
<p>Эта ссылка истечет через 10 минут.</p>
<!-- <p>This link will expire in 10 minutes.</p> -->

