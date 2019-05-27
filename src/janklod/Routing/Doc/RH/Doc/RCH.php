<?php 

/**
 * Je dois remplacer dans $path = $this->replacePattern($path);
 * 
*/

/**
 * Determine if parsed url match current route
 * @param string $url 
 * @return bool
*/
public function match($url='')
{
     $url   = $url ?: $this->url;
     $path  = $this->replacePattern();
     $regex = "#^$path$#i";

     if(!preg_match($regex, $url, $matches))
     {
          return false;
     }
    
     array_shift($matches);
     $this->set('matches', $matches);
     return true;
}



/**
  * Return match param
  * @param string $match 
  * @return string 
*/
public function paramMatch($match)
{
     if(isset($this->regex[$match[1]]))
     {
          return '('. $this->regex[$match[1]] . ')';
     }
     return '([^/]+)';
}


/**
  * Replace param in path
  * 
  * Ex: $path = ([0-9]+)-([a-z\-0-9]+)
  * 
  * @param string $replace 
  * @param callable $callback 
  * @return string
*/
 private function replacePattern()
 {
      return preg_replace_callback(
                     '#:([\w]+)#', 
                     [$this, 'paramMatch'], 
                     $this->get('path')
            );
 }
