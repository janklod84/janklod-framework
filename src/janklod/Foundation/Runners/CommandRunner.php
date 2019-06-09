<?php 
namespace JK\Foundation\Runners;

use JK\Foundation\Configuration;

/**
 * @package JK\Foundation\Runners\CommandRunner 
*/ 
class CommandRunner extends CustomRunner 
{


/**
* Initialize functions
* 
* @return void
*/
public function init()
{
   if(!$this->app->request->is('cli'))
   {
       $this->app->console->addCommands(
        Configuration::SRC['commands'] ?: []
      );
      $this->app->file->call('routes/console.php');
   }
}


}