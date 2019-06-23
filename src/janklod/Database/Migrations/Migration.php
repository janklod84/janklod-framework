<?php 
namespace JK\Database\Migrations;


/**
 * Class Migration
 * @package JK\Database\Migrations\Migration 
*/ 
abstract class Migration 
{

/**
* Method up [ Run the migrations ]
* 
* @return void
*/
abstract public function up();

/**
* Method down [ Reverse the migrations ]
* 
* @return void
*/
abstract public function down();

}