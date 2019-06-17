<?php 


// OPEN FORM IS REQUIRED 
// CLOE FORM IS VERY REQUIRED [ IF YOU DONT CLOSE NOTHING WILL BE SHOWED]

$form = new Form();
$form->open(['action' => '/login','class'  => 'login']);
$form->input(['class' => 'form-control', 'id' => 'login'], 'text', 'Login');
$form->input(['class' => 'form-control', 'id'=> 'password'], 'password', 'Password');
$form->hidden();
$form->textarea(['class' => 'form-control', 'id'=> 'password']);
$form->button(['class' => 'btn btn-primary'], 'Submit');
$form->close();

# WILL BE GENERATE
/*
<!DOCTYPE html>
<form  action="/login" class="login">
<label for="login">Login</label>
<input type="text" class="form-control" id="login">
<label for="password">Password</label>
<input type="password" class="form-control" id="password">
<input type="hidden">
<textarea  class="form-control" id="password"></textarea>
<button type="button" class="btn btn-primary">Submit</button>
</form>
*/