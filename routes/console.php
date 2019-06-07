<?php 

/*
  |------------------------------------------------------------------
  |                  ADD COMMANDS 
  |------------------------------------------------------------------
*/

use JK\Console\Console;
use JK\Console\Commands\TestCommand;
use JK\Console\Commands\CreateCommand;

Console::add(new TestCommand(), '--test', []);
Console::add(new CreateCommand(), '--create', []);