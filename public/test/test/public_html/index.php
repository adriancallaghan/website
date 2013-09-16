<?php 

class bootInit{
	
	// url array
	public $urlArray;
	public $view;
	
	function __construct() {
		
		// set up the url array
	    $this->urlArray = explode('/',rtrim($_GET['__url'],'/'));

	    
	    // requested page
	    $pageRequest = end($this->urlArray);

	    $this->view->header = 'assigned will have this value';
	    
		if (function_exists($pageRequest)) $this->view = call_user_func($pageRequest,$this->view);
		else echo 'Missing controller';
		}


	// accessors
	function returnUrl(){
		// returns array of url
		return $this->urlArray;	
		}
		
	function getView(){
		return $this->view;
		}
	}

	
// init 	
$cms = new bootInit();	
$view = $cms->getView();







/////////////////////////////////////////////////////////////////////////////////
// controller is a class, action is a method belonging to the class, name is the name of the variable and value is its value
//
//  /controller/action/name/value
//
// mod_rewrite can always point these values to the url


//include file for controller starts here

// Controllers
function test($view){
	
	
	$view->header = 'test content on page 1';
	$view->stuff = array('a'=>'1','b'=>'2','c'=>'3');
	
	return $view;
	}
	
function test2($view){
	
	
	$view->header = 'test2';
	$view->stuff = array('a'=>'12','b'=>'22','c'=>'32');
	
	return $view;
	}	
	

//////////////////////////////////////////////////////////////////////////////////

// include a html file with same extension from folder views	

?>
<h1><?php echo $view->header; ?></h1>
<hr>
<ul><?php foreach ($view->stuff AS $item)	echo '<li>'.$item.'</li>'; ?></ul>











