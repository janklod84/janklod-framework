<?php 


// OPEN FORM IS REQUIRED 
// CLOE FORM IS VERY REQUIRED [ IF YOU DONT CLOSE NOTHING WILL BE SHOWED]

 $form = new Form();
echo '<h2>Form1</h2>';
$form->open(['action' => '/login','class'  => 'login']);
$form->input(['class' => 'form-control', 'id' => 'login'], 'text', 'Login');
$form->input(['class' => 'form-control', 'id'=> 'password'], 'password', 'Password');
$form->hidden();
$form->textarea(['class' => 'form-control', 'id'=> 'text'], 'Message', 'Admin?');
$form->file(['name' => 'photo']);
$form->button(['class' => 'btn btn-primary'], 'Submit');
$form->inputSubmit(['class' => 'btn btn-primary']);
$form->close();

echo '<h2>Form2</h2>';
$form->open(['action' => '/sign-in','class'  => 'sign-in']);
$form->input(['class' => 'form-control', 'id'=> 'password'], 'password', 'Password');
$form->textarea(['class' => 'form-control', 'id'=> 'text'], 'Message', 'Admin?');
$form->inputSubmit(['class' => 'btn btn-primary']);
$form->close();

# WILL BE GENERATE
/*
<h2>Form1</h2>
<form  action="/login" class="login">
<label for="login">Login</label>
<input type="text" class="form-control" id="login">
<label for="password">Password</label>
<input type="password" class="form-control" id="password">
<input type="hidden">
<label for="text">Message</label>
<textarea  class="form-control" id="text">Admin?</textarea>
<input type="file" name="photo">
<button type="button" class="btn btn-primary">Submit</button>
<input type="submit" class="btn btn-primary">
</form>

<h2>Form2</h2>
<form  action="/sign-in" class="sign-in">
<label for="password">Password</label>
<input type="password" class="form-control" id="password">
<label for="text">Message</label>
<textarea  class="form-control" id="text">Admin?</textarea>
<input type="submit" class="btn btn-primary">
</form>
*/