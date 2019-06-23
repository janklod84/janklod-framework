<h1><?= $title ?></h1>
<div class="row">
<div class="col-md-6">
<?= Form::displayErrors($errors, 
['class' => 'alert alert-danger', 'style'=> 'list-style: none;']); ?>
<?= Form::open('/login', 'POST', ['class'  => 'sign-in']) ?>
<?= Form::input(['class' => 'form-control', 'name'=> 'username',
	'placeholder' => 'Введите ваш логин']) ?>
<?= Form::input(['class' => 'form-control', 'name'=> 'password',
'placeholder' => 'Введите ваш пароль'], 'password') ?>
<?= Form::button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Отправить') ?>
<?= Form::close() ?>
</div>
</div>