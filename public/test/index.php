<?php


// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../../application'));

	
// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));


	
// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));


//echo 'Application path is: '.APPLICATION_PATH;


//require_once 'test.php'; 


/** Zend_Application */
require_once 'Zend/Application.php';  
 

//echo 'ok';



// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV, 
    APPLICATION_PATH.'/configs/application.ini'
);


/*

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV
);
*/


// session start
Zend_Registry::set('session', new Zend_Session_Namespace('user'));

//echo 'ok';
//var_dump($application);
$application->bootstrap()->run();

//echo 'ok';