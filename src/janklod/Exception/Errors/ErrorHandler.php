<?php
namespace JK\Exception\Errors;

/*
SetUp
error_reporting(E_ALL);
set_error_handler('JK\Exception\ErrorHandler::errorHandler');
set_exception_handler('JK\Exception\ErrorHandler::exceptionHandler');
*/

/**
 * Simple Error and exception handler, it's for moment
 * Later will be more advanced ErrorHandler ...
 * 
 * @package \JK\Exception\Errors\ErrorHandler
*/
class ErrorHandler
{



/**
 * Error handler. Convert all errors to Exceptions by throwing an ErrorException.
 *
 * @param int $level  Error level
 * @param string $message  Error message
 * @param string $file  Filename the error was raised in
 * @param int $line  Line number in the file
 *
 * @return void
*/
public static function errorHandler($level, $message, $file, $line)
{
    if(error_reporting() !== 0)
    { 
        throw new \ErrorException($message, 0, $level, $file, $line);
    }
}


/**
 * Set Handlers
 * 
 * @return void
*/
public static function setHandlers()
{
    error_reporting(E_ALL);
    set_error_handler(__CLASS__.'::errorHandler');
    set_exception_handler(__CLASS__.'::exceptionHandler');
}



/**
 * Exception handler.
 *
 * @param Exception $exception  The exception
 *
 * @return void
*/
public static function exceptionHandler($exception)
{
    // Code is 404 (not found) or 500 (general error)
    $code = $exception->getCode();

    if($code != 404){
        $code = 500;
    }

    http_response_code($code);

    if(DEV)
    { 
        echo "<h1>Fatal error</h1>";
        echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
        echo "<p>Message: '" . $exception->getMessage() . "'</p>";
        echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
        echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";

    }else{
    
            $log = ROOT . '/temp/log/janklod-' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);
            $message = "Uncaught exception: '" . get_class($exception) . "'";
            $message .= " with message '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();
            error_log($message);
            view('errors/404');
            exit;
    }
}


}