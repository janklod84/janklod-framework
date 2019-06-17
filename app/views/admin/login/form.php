<h1><?php HTML::title(true) ?></h1>
<?php // partial('test', 'login'); ?>
<div class="row">
<div class="col-md-6">
<?php 
	$form = new \JK\Library\Forms\BootstrapForm();
	$form->open(['action' => '/', 'method' => 'POST', 'class'  => 'sign-in']);
	$form->input(['class' => 'form-control', 'name'=> 'username',
	'placeholder' => 'Введите ваш логин']);
	$form->input(['class' => 'form-control', 'name'=> 'password',
	'placeholder' => 'Введите ваш пароль'], 'password');
	 $form->button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Отправить');
	 // $form->close();
?>
</div>
</div>