<?php 

/*
  |------------------------------------------------------------------
  |                  ADD COMMANDS 
  |------------------------------------------------------------------
*/

Shell::command('hello' , function () {
    echo 'Hello command runned!';
});


Shell::command('--test' , function () {
    echo '--test command is run!';
});