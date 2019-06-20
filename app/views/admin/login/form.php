<h1><?php HTML::title(true) ?></h1>
<?php // partial('test', 'login'); ?>
<div class="row">
<div class="col-md-6">
<?= Form::displayErrors(['Login is required', 'Password is required'],
['class' => 'alert alert-danger', 
'style'=> 'list-style: none;'
]
) ?>
<?= Form::open('/', 'POST', ['class'  => 'sign-in']) ?>
<?= Form::input(['class' => 'form-control', 'name'=> 'username',
	'placeholder' => 'Введите ваш логин']) ?>
<div class="">Salut les amis</div>
<?= Form::input(['class' => 'form-control', 'name'=> 'password',
'placeholder' => 'Введите ваш пароль'], 'password') ?>
<?= Form::button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Отправить') ?>
<?= Form::close() ?>
</div>
</div>