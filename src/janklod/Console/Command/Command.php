<?php 
namespace JK\Console;


/**
 * php console app:create-user
 * @package JK\Console\Command 
*/ 
class Command 
{
     
  /**
   * @var array $commands
   * @var string $configPath
  */
  private static $commands = [];
  private static $output   = [];
  private $requiredPassword;
  /**
   * @var \PDO
  */
  protected $name = 'app:create-user';

  

  public function __construct(bool $requiredPassword = false)
  {
        $this->requiredPassword = $requiredPassword;
        parent::__construct();
  }


  /**
  * Execute command
  * @return mixed
  */
  protected function setDescription($description='')
  {
        $this->output[$this->name]['description'] = $description;
        return $this;
  }
  
  


  /**
  * Execute command
  * @return mixed
  */
  protected function setHelp($help='')
  {
        $this->output[$this->name]['help'] = $help;
        return $this;
  }
  
 
  protected function configure()
  {
       $this->addArgument(
           'password',  
           $this->requiredPassword ? InputArgument::REQUIRED : InputArgument::OPTIONAL,  
           'User Password'
       );
  }


  public function execute(InputInterface $input, OutputInterface $output)
  {
        $output->writeln([
            'User Creator', 
            '=============',
            '';
        ]);


        $output->writeln($this->someMethod());

        $output->writeln('Whoa!');

        $output->writeln('You are about to !');
        $output->writeln('create a user.');
        $output->writeln('Whoa!');



  }
  
  //
  /**
  * Execute command
  * @return mixed
  */
  abstract protected function configure();
  

  /**
  * Execute command
  * @return mixed
  */
  abstract public function execute();

  /**
  * Roolback command
  * @return void
  */
  abstract public function undo();

  
  /**
   * Execute command
   * @return mixed
  */
  public function run()
  {
	   foreach(self::$commands as $command)
	   {
          // put here condition, but all commands will be executed
	   	    $command->execute();
	   }
  }

  
}

/**
 * php bin/console app:create-user
User Creator
============

Whoa!
You are about to create a user.
*/