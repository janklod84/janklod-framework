<?php 

/*
  |------------------------------------------------------------------
  |                  ADD COMMANDS 
  |------------------------------------------------------------------
*/

use JK\Console\Command;
use JK\Console\Commands\TestCommand;
use JK\Console\Commands\CreateCommand;

Command::add(new TestCommand(), '--test', []);
Command::add(new CreateCommand(), '--create', []);