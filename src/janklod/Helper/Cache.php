<?php 
namespace JK\Helper;


class Cache
{
     
     const CACHE = 'temp/cache';
     
     private $dir;

     private $file;

     public function __construct($file='')
     {
          $this->file = new \JK\FileSystem\File($file);
     }
     
     
     public function set($key, $data, $seconds = 3600) // 1h
     {
           $content['data'] = $data;
           $content['end_time'] = time() + $seconds;
           
           $process = file_put_contents(
                      $this->getPath($key), 
                      serialize($content)
                    );

           return ($process) ? true : false;
     }

     public function get($key)
     {    
     	    $file = $this->getPath($key);
          if($this->file->to($file)) 
          {
          	 $content = unserialize(file_get_contents($file));
          	 if(time() <= $content['end_time'])
             { // cache actif
                
                return $content['data'];

          	 }
          	 // cas contraire cache caduque! non actuel
             unlink($file);
          }

          return false;
     }


     public function delete($key)
     { 
     	    $file = $this->getPath($key);

          if($this->file->to($file)) 
          {
          	  unlink($file);
             
          }

          return false;

     }
     
     public function getPath($key)
     {
        $crypt = md5($key);
        $this->dir = self::CACHE.'/'.$crypt;
        return $this->file->to($this->dir.'txt');
     }
}