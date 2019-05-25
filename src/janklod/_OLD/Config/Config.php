<?php 

$app = Config::get('app'); // Load group
$alias = Config::get('app.timezone'); // Load item
debug($app);
debug($alias);

Config::store([
  'salut' => 'les amis', 
  'pdo' => [
      'dsn' => 'sqlite:/path/to/database.sqlite',
      'user' => 'root',
      'password' => 'Qwerty',
      'options' => [
        'salut les amis'
      ]
  ]
]);

debug(Config::get('pdo'));
debug(Config::get('pdo.options'));
debug(Config::get('pdo.user'));
debug(Config::get('pdo.password'));
debug(Config::get('pdo.dsn'));