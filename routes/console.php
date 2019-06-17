<?php 

/*
  |------------------------------------------------------------------
  |                  ADD COMMANDS 
  |------------------------------------------------------------------
*/

Shell::command('hello' , function () {
    echo 'Hello command runned!<br>';
    echo 'Iam from file: '. __FILE__.' !';
});


Shell::command('--test' , function () {
    echo '--test command is run!<br>';
    echo 'Iam from file: '. __FILE__.' !';
});