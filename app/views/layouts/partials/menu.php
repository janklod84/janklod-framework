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
        </ul>
        <ul class="navbar-nav">
           <li class="nav-item">
             <a class="nav-link" href="/login">вход</a>
           </li>
        </ul>
    </div>
</nav>