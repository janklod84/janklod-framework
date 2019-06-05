<h1><?php HTML::title(true) ?></h1>
<div class="row">
	<div class="col-md-6">
		<form action="/" method="POST">
		  <div class="form-group">
		   <input type="text" 
		          name="username" 
		          class="form-control" 
		          placeholder="Введите ваш логин">
		  </div>
		  <div class="form-group">
		   <input type="text" 
		          name="password" 
		          class="form-control" 
		          placeholder="Введите ваш пароль">
		  </div>
		  <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
	</div>
</div>