<?php 
namespace JK\Database\Migrations\Commands;


/**
 * @package JK\Database\Migrations\Commands\DeleteCommand
*/ 
class DeleteCommand extends CustomCommand
{

   /**
     * Execute command
     * @return mixed
   */
   public function execute()
   {
   	   echo __METHOD__."\n";
   }

   /**
     * Execute command
     * @return mixed
   */
   public function undo()
   {
   	   echo __METHOD__."\n";
   }
}