<?php 
/*
return [
 'test' => 'tes20', 
 'ak' => [
     'fileq1' => __DIR__.'/file1',
     'fileq2' => __DIR__.'/file2',
     'fileq3' => __DIR__.'/file3',
 ]
];
*/
$data = scandir(ROOT);
// debug($data);

foreach($data as $path)
{
    if(is_file($path))
    {
    	 echo 'File: '. $path, '<br>';
    }
    if(is_dir($path))
    {
    	echo 'Directory: '. $path, '<br>';
    }
}