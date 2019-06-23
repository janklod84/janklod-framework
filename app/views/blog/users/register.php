<h1><?= $title ?></h1>
<div class="row">
<div class="col-md-6">
<?= Form::displayErrors($errors, 
['class' => 'alert alert-danger', 'style'=> 'list-style: none;']); ?>
<?= Form::open('/', 'POST', ['class'  => 'sign-in']) ?>
<?= Form::input(['class' => 'form-control', 'name'=> 'username',
	'placeholder' => 'например: Александр']) ?>
<?= Form::input(['class' => 'form-control', 'name'=> 'email',
	'placeholder' => 'например: aleksandr@nethammer.com']) ?>
<?= Form::input(['class' => 'form-control', 'name'=> 'password',
'placeholder' => 'например: Qwer4Pety!'], 'password') ?>
<?= Form::input(['class' => 'form-control', 'name'=> 'confirm',
'placeholder' => 'Потвердить пароль'], 'password') ?>
<?= Form::button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Отправить') ?>
<?= Form::close() ?>
</div>
</div>