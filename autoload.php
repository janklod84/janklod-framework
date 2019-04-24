<?php 

// http://dof.in.ua/blog/php-application-class-autoloading
class Autoloader
{
    /**
     * @var         Autoloader instance
     */
    protected static $instance;

    /**
     * @var array   Namespace mapping
     */
    protected static $ns_map = [];

    /**
     * Autoloader constructor.
     */
    protected function __construct(){
        spl_autoload_register([$this, 'load']);
    }

    /**
     * Register namespace root path
     *
     * @param $namespace    Root namespace
     * @param $root_path    Namespace root path
     */
    public function addNamspacePath($namespace, $root_path){
        self::$ns_map[$namespace] = $root_path;
    }

    /**
     * Load class
     *
     * @param $classname    Loader method
     */
    public function load($classname){
        if($path = $this->getClassPath($classname) ){
            require_once $path;
        }
    }

    /**
     * Get realpath to the class definition file
     */
    protected function getClassPath($classname){
        $class_path = $classname . '.php';
        if( !empty(self::$ns_map) ){
            foreach(self::$ns_map as $ns => $path){
                $lookup_pattern = sprintf('/^%s/', $ns);
                if(preg_match($lookup_pattern, $classname)){
                    $class_path = preg_replace($lookup_pattern, $path, $class_path);
                    break;
                }
            }
        }

        return realpath(str_replace('\\', '/', $class_path));
    }

    /**
     * Get loader instance
     */
    public static function getInstance(){
        if(null === self::$instance){
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __clone(){}
    private function __wakeup(){}
}

return Autoloader::getInstance();


/* ...
$loader = require_once '../classes/Autoloader.php';
$loader->addNamspacePath('MyClasses', __DIR__ . '/../vendor/dimmask/myclasses/');
...
$my = new \MyClasses\Utilities\MyClass();
// Этот класс будет загружен автоматически
...*/

