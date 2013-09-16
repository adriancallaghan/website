<?php

//////////////// CONFIGURATION  ///////////////////


// database
define ('HOST',		'localhost');
define ('NAME',		'testdata');
define ('USER',		'root');
define ('PASS',		'');

// Error messages
define ('ERRS',		true); // Meaningfull error messages on or off (mainly SQL related)
// Default message
define ('MESSAGE',		'<h1><font color="#444444">The server encountered an internal error</font></h1>');
// email errors to
define ('admin_email', ''); // leave blank to switch off

define	('PAGINATE',	0); // sitewide pagination scope unless implicity stated otherwise in the args

////////////////////////////////////////////////// ?>

<div style="width:500px; background:#cccccc;">

	<?php
	include ('DB.php');
	include ('paginate.php');

	$dataBase = new DB();
	$array = $dataBase->getQuery("SELECT * FROM testtable"); 
	?>

	<h3>Instaniate the database (make it ready for use)</h3>
	$dataBase = new DB();
	
	<h3>Basic database request</h3>
	$array = $dataBase->getQuery("SELECT * FROM testtable");

	<h3>Basic pagination</h3>
	pagenate($array);
	<?php pagenate($array);?>


	<h3>Using a unique link (enables multiple pagination on one page)</h3>
	pagenate($array,'linkName1');
	<?php pagenate($array,'linkName1');?>

		
	<h3>Using callback functions for special formatting</h3>
	function callBack($val){echo '<a href="'.$_SERVER['PHP_SELF'].'?value='.$val.'">'.$val.'</a>';	}
	$args = array('id'=>'callBack');
	pagenate($array,'linkName2',$args);	
	<?php
	function callBack($val){echo '<a href="'.$_SERVER['PHP_SELF'].'?value='.$val.'">'.$val.'</a>';	}
	$args = array('id'=>'callBack');
	pagenate($array,'linkName2',$args);	?>


	<h3>Using callback functions for special formatting with 3 max results</h3>
	function callBack($val){echo '<a href="'.$_SERVER['PHP_SELF'].'?value='.$val.'">'.$val.'</a>';	}
	$args = array('id'=>'callBack');
	pagenate($array,'linkName3',$args, 3);
	<?php pagenate($array,'linkName3',$args,3);	?>


	<h3>Using callback functions for special formatting with 3 max and pagination scope</h3>
	function callBack($val){echo '<a href="'.$_SERVER['PHP_SELF'].'?value='.$val.'">'.$val.'</a>';	}
	$args = array('id'=>'callBack');
	pagenate($array,'linkName4',$args, 3, 1);
	<?php pagenate($array,'linkName4',$args,3,1);?>
</div>