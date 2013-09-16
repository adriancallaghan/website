<?php 
class DB{
/* 
DESCRIPTION:	Object class, Handles all database requests and returns content accordingly

WRITER:			Adrian Callaghan 120808
INSTANIATION:	new DB()                    requires HOST,NAME,USER,PASS,ERRS,MESSAGE values to be set prior (config)


API:

	MODIFIERS:
				setStateClose()				// sets the mySql connection to close
				setQuery($arg)				// executes a query without returning any results, used for insert, create etc,  
											// returns the ID of the last auto-increment
				setErrMessage($err)			// displays and emails, the sql error
				setDataBase($database)		// sets dataBase, leave arg blank to set back to the default 
	ACCESSORS:
				getQuery($arg)				// executes sql query from $arg and returns result as a '2d assoc array'
				getStateOpen()				// returns details about the currently open connection
				*/

	

	
	var $mySqlHost;
	var $dataBase;

	
	
	
	function __construct() {
		$this->mySqlHost = @mysql_connect(HOST, USER, PASS);
		if (!$this->mySqlHost) {
			$this->setErrMessage('Access Error','Error',mysql_error(),$SQL);
			}
		$this->setDataBase();
		}

		
		
	// Accesors	
	function getQuery($SQL){
		// executes a query
		$result = @mysql_query($SQL);
		if (!$result) {
			$this->setErrMessage('Sql Error','Invalid query',mysql_error(),$SQL);
			}
		// create a 2D array of results
		$return = array();
		while ($row = mysql_fetch_assoc($result)) $return[] = $row;
		return $return;
		}
	

	
	function getStateOpen(){
		// returns an array of details about the open connection
		$return['DB']['host']=$this->mySqlHost;
		$return['DB']['database']=$this->dataBase;
		}
	
	
	
	// Modifiers
	function setDataBase($dataBaseName=NAME){
		$this->dataBase = @mysql_select_db($dataBaseName,$this->mySqlHost);
		if (!$this->dataBase) {
			$this->setErrMessage('I/O Error','Error',mysql_error(),$SQL);
			}
		}
	
	
	function setStateClose() {
		// closes current connection
		mysql_close($mySqlHost);
		}
	
	
	
	
	function setQuery($SQL){
		// executes a query without returning any results, used for insert, create etc, returns the ID of the last auto-increment
		$result = @mysql_query($SQL);
		if (!$result) {
			$this->setErrMessage('Sql Error','Invalid query',mysql_error(),$SQL);
			}
		$return = mysql_insert_id();
		return $return;
		}
	
	
	
	
	function setErrMessage($message, $errName, $err, $SQL){
		// displays and emails, the sql error
	
		if (ERRS){
			?>
			<h1 style='color="#444444;'><?php echo $message; ?></h1>
			<hr>
			<p>
				<font color="#ff0000"><b><?php echo $errName; ?>: </b></font><?php echo $err; ?>
				<br />
				<font color="#ff0000"><b>Whole query: </b></font><?php echo $SQL; ?>
			</p>
			<hr>
		<?php }
		else { ?>
			<h1 style='color="#444444;"'><?php echo MESSAGE; ?></h1>
			<hr>
		<?php } 
				
		// email message
		$Name = $_SERVER['SERVER_NAME']; //senders name 
		$email = "noreply@".$_SERVER['SERVER_NAME']; //senders e-mail adress 
		
		//mail body 
		$mail_body = 
		'<h2>'.$_SERVER['SERVER_NAME'].' error</h2>'.
		$err.'<br/>'. 
		'<h2>Request details</h2>'.
		'<b>Script filename and query string: </b>'.$_SERVER['SCRIPT_FILENAME'].'?'.$_SERVER['QUERY_STRING'].'<br/>'.
		'<b>Server name: </b>'.$_SERVER['SERVER_NAME'].'<br/>'.
		'<h2>User details</h2>'.
		'<b>IP ADDRESS: </b>'.$_SERVER['REMOTE_ADDR'].' : '.$_SERVER['REMOTE_PORT'].'<br/>'.
		'<b>Time: </b>'.date("D dS M,Y h:i a").'<br/>'
		;
		
		$subject = $_SERVER['SERVER_NAME']." Error"; //subject 
		
		$header = 'MIME-Version: 1.0' . "\r\n";
		$header.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";		
		$header.= "From: ". $Name . " <" . $email . ">\r\n"; 


		// send mail, and die
		if (admin_email!=="") $sent = @mail(admin_email, $subject, $mail_body, $header) ;
		
		if ($sent) $display.='<h2>The administrator has been notified</h2>';
		else $display.='<h2>Please notify the administrator '.admin_email.'</h2>';
		
		$display.='<p>Please call back again later</p>';
		die($display);
		}	
	} ?>