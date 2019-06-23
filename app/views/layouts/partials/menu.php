<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">
    <?= Config::get('app.name') ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
     <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">
              главная<span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
             <?php if(Auth::isLogged()): ?>
              <a href="/profile" class="nav-link" title="к профилию ?">
               Привет, Александр
              </a>
            <?php endif; ?>
          </li>
        </ul>
        <ul class="navbar-nav">
           <?php if(!Auth::isLogged()): ?>
            <li class="nav-item">
              <a class="nav-link" href="/login">Вход</a>
            </li>
           <li class="nav-item">
             <a class="nav-link" href="/register">Регистрация</a>
           </li>
           <?php endif; ?>
           <?php if(Auth::isLogged()): ?>
            <li class="nav-item">
             <a class="nav-link" href="/logout">Выход</a>
            </li>
           <?php endif; ?>
        </ul>
    </div>
</nav>