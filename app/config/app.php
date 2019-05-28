<?php 

return [
   
/*
|------------------------------------------------------------------
|   Application starting time
|------------------------------------------------------------------
*/
'microtime' => microtime(true),



/*
|------------------------------------------------------------------
|   Application Timezone
|------------------------------------------------------------------
*/
'timezone' => 'UTC', // Asia/Yekaterinburg


/*
|------------------------------------------------------------------
|   Application Name
|------------------------------------------------------------------
*/
'name' => 'JK',


/*
|------------------------------------------------------------------
|   Current language of Application
|------------------------------------------------------------------
*/
'language' => 'ru',


/*
|------------------------------------------------------------------
|   Application base URL 
|   Set base_url to false if you don't need it
|   If base_url is false we'll not used base url 
|    But if base_url contain value it's will be base url
|   like this : http://project.loc/ [ http://project.loc/css/app.css ]
|   But if you assign value like '/' so it'll be base url [ /css/app.css ]
|------------------------------------------------------------------
*/

'base_url' => '', // false


/*
|------------------------------------------------------------------
|  Add alias
|------------------------------------------------------------------
*/

'alias' => [
 // 'Test' => 'app\\controllers\\Test',
 // 'Form' => 'app\\library\\Bootstrap'
],

/*
|------------------------------------------------------------------
|  Add services providers
|------------------------------------------------------------------
*/

'providers' => [
	/*
	\app\controllers\Test::class,
	\app\modules\Blog::class
	*/
]


];