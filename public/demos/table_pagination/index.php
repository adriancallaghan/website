<?php

//////////////// CONFIGURATION  ///////////////////


// database
define ('HOST',		'localhost');
define ('NAME',		'adriancallaghan_co_uk');
define ('USER',		'adriancallaghan');
define ('PASS',		'ad831426Gyhv');

// Error messages
define ('ERRS',		true); // Meaningfull error messages on or off (mainly SQL related)
// Default message
define ('MESSAGE',		'<h1><font color="#444444">The server encountered an internal error</font></h1>');
// email errors to
define ('admin_email', ''); // leave blank to switch off





/*

NOT FOR DOWNLOAD

*/



$or = '<br /><br /><span style="color:#003300;">---- Or you could simply say ----</span><br /><br />';


////////////////////////////////////////////////// ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head><title>Table Pagination with database object</title></head>
<body>
	<style>
	body {margin:0;background:#330000;}
	#wrap {width:1000px; background:#aaaaaa; margin:0 auto;}
	h1 {font-size:22pt;padding:20px; text-align:center;text-decoration:underline;}
	div.example {background:#aaaaaa; width:920px; margin:10px auto; font-size:12pt;}
	.example h2{font-size:15pt; color:#330000; font-style:italic;text-decoration:underline;}
		
	p.code {
		background:#bad8f1;
		color:#0000cc;
		padding:10px;
		margin:10px auto;
		border:2px solid #0000cc;
		font-weight:bold;
		font-size:10pt;
		}
		
	div.output {
		background:#ffffff;
		padding:10px;
		margin:10px auto;
		border:2px solid #000000;
		width:90%;
		}
	.highlight {
		color:#902068;
		}
	</style>
	<div id="wrap">

		<?php
		include ('DB.php');
		include ('paginate.php');
		
		$dataBase = new DB();
		$array = $dataBase->getQuery("SELECT * FROM testdata"); 
		?>

		<h1>Table Pagination example</h1>
		
		<div class="example">
			<h2>The basics</h2>
			The following examples demonstrate the usage of the pagination function <br />
			The examples are used in conjunction with the dataBase object to generate information for the array<br />
			The dataBase object can be downloaded and information found <a href="http://adriancallaghan.co.uk/database-class-for-php/">here</a>
			Step one is to instaniate the dataBase object in the conventional way<br />
			<p class="code">$dataBase = new DB();</p>
			but however any multi-dimensional (associative) array can be used.<br />
			<b>Each example builds upon the previous code, as to not cause any confusion and area`s of intrest are highlighted</b>
			
			<br />
			<br style="clear:both;" />
		</div>
		
		<div class="example">
			<h2>Example 1</h2>
			Make a basic database request and paginate the result
			<p class="code">
			$array = $dataBase->getQuery("SELECT * FROM testtable");<br />
			paginate($array);
			<?php echo $or; ?>
			paginate($dataBase->getQuery("SELECT * FROM testtable"));
			</p>
			output:
			<div class="output"><?php paginate($array);?></div>
			<br style="clear:both;" />
		</div>

		<div class="example">
			<h2>Example 2</h2>
			Giving the fields a title, this is done within the MySql using 'AS'
			<p class="code">
			$SQL = "SELECT <span class="highlight">mem_id AS Id, mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No'</span> FROM testtable";<br />
			$array = $dataBase->getQuery($SQL);<br />
			paginate($array);
			<?php echo $or; ?>
			paginate($dataBase->getQuery("SELECT <span class="highlight">mem_id AS Id, mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No'</span> FROM testtable"));
			</p>
			output:
			<div class="output">
				<?php 
				paginate($dataBase->getQuery("SELECT mem_id AS Id, mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testdata"));
				?>
			</div>
			<br style="clear:both;" />
		</div>
		
		<div class="example">
			<h2>Example 3</h2>	
			Special formatting or functions, can be achieved using callback functions.<br />
			The callback function is declared by hooking the field name to the function in the argument.<br />
			For example, firstly declare the function or functions.
			<p class="code">
			function removeUnderscoreAndMakeRed($val){<br />
				echo '&lt;font color="red"&gt;'.str_replace ("_", " ", $val).'&lt;/font&gt;';<br />
				}<br /><br />
			function delId($id){<br />
				echo '&lt;a href="delete.php?id='.$id.'"&gt;Delete&lt;a&gt;';<br />
				}<br />	
			</p>
			And secondly, the argument or arguments are passed in an associative array that then hooks the field values to the functions
			<p class="code">
			$SQL = "SELECT mem_id AS 'Option', mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testtable";<br />
			$array = $dataBase->getQuery($SQL);<br />
			<span class="highlight">$args = array('Option'=>'delId', 'Name'=>'removeUnderscoreAndMakeRed');</span><br />
			paginate($array,<span class="highlight">$args</span>);
			<?php echo $or; ?>
			paginate($dataBase->getQuery("SELECT mem_id AS 'Option', mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testtable"),<span class="highlight"> array('Option'=>'delId','Name'=>'removeUnderscoreAndMakeRed')</span>);
			</p>
			output:
			<div class="output">
			<?php
				function removeUnderscoreAndMakeRed($val){
					echo '<font color="red">'.str_replace ("_", " ", $val).'</font>';
					}
				function delId($id){
					echo '<a href="#">Delete<a>';
					}
				
				paginate($dataBase->getQuery("SELECT mem_id AS 'Option', mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testdata"), array('Option'=>'delId','Name'=>'removeUnderscoreAndMakeRed')); 
			?>
			</div>
			<br style="clear:both;" />
		
		</div>
		
		
		
		<div class="example">
			<h2>Example 4</h2>
			However you will notice in the above examples when you click to change the page, all the tables move to that page.<br />
			This is because they all share the same link.<br />
			This can be fixed by passing a link argument, which is then a unique link to this pagination.<br />
						
			<p class="code">
			function removeUnderscoreAndMakeRed($val){<br />
				echo '&lt;font color="red"&gt;'.str_replace ("_", " ", $val).'&lt;/font&gt;';<br />
				}<br /><br />
			function delId($id){<br />
				echo '&lt;a href="delete.php?id='.$id.'"&gt;Delete&lt;a&gt;';<br />
				}<br />	<br />
				<br />
			$SQL = "SELECT mem_id AS 'Option', mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testtable";<br />
			$array = $dataBase->getQuery($SQL);<br />
			$args = array('Option'=>'delId', 'Name'=>'removeUnderscoreAndMakeRed');<br />
			paginate($array,$args,<span class="highlight">'uniqueLink'</span>);
			<?php echo $or; ?>
			function removeUnderscoreAndMakeRed($val){echo '&lt;font color="red"&gt;'.str_replace ("_", " ", $val).'&lt;/font&gt;';}<br />
			function delId($id){echo '&lt;a href="delete.php?id='.$id.'"&gt;Delete&lt;a&gt;';}<br />
			<br />
			paginate($dataBase->getQuery("SELECT mem_id AS 'Option', mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testtable"),array('Option'=>'delId','Name'=>'removeUnderscoreAndMakeRed'),<span class="highlight">'uniqueLink'</span>);
			</p>
			output:
			<div class="output">
			<?php
				paginate($dataBase->getQuery("SELECT mem_id AS 'Option', mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testdata"), array('Option'=>'delId','Name'=>'removeUnderscoreAndMakeRed'),'uniqueLink');
			?>
			</div>
			<br style="clear:both;" />
		</div>
		
		
		<div class="example">
			<h2>Example 5</h2>
			By default the pagination will display 10 results per page, but this can implicitly set<br />
			For example<br />
						
			<p class="code">
			function removeUnderscoreAndMakeRed($val){<br />
				echo '&lt;font color="red"&gt;'.str_replace ("_", " ", $val).'&lt;/font&gt;';<br />
				}<br /><br />
			function delId($id){<br />
				echo '&lt;a href="delete.php?id='.$id.'"&gt;Delete&lt;a&gt;';<br />
				}<br />	<br /><br />
				

			$SQL = "SELECT mem_id AS 'Option', mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testtable";<br />
			$array = $dataBase->getQuery($SQL);<br />
			$args = array('Option'=>'delId', 'Name'=>'removeUnderscoreAndMakeRed');<br />
			paginate($array,$args,'uniqueLink1',<span class="highlight">3</span>);
			<?php echo $or; ?>
			function removeUnderscoreAndMakeRed($val){echo '&lt;font color="red"&gt;'.str_replace ("_", " ", $val).'&lt;/font&gt;';}<br />			
			function delId($id){echo '&lt;a href="delete.php?id='.$id.'"&gt;Delete&lt;a&gt;';}<br /><br />
			paginate($dataBase->getQuery("SELECT mem_id AS 'Option', mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testtable"),array('Option'=>'delId','Name'=>'removeUnderscoreAndMakeRed'),'uniqueLink1',<span class="highlight">3</span>);
			</p>
			output:
			<div class="output">
			<?php
				paginate($dataBase->getQuery("SELECT mem_id AS 'Option', mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testdata"), array('Option'=>'delId','Name'=>'removeUnderscoreAndMakeRed'),'uniqueLink1',3);
			?>
			</div>
			<br style="clear:both;" />
		</div>
		
		
		<div class="example">
			<h2>Example 6</h2>
			Finally the scope of how much pagination can be set<br />
			For example<br />						
			<p class="code">
			function removeUnderscoreAndMakeRed($val){<br />
				echo '&lt;font color="red"&gt;'.str_replace ("_", " ", $val).'&lt;/font&gt;';<br />
				}<br /><br />
			function delId($id){<br />
				echo '&lt;a href="delete.php?id='.$id.'"&gt;Delete&lt;a&gt;';<br />
				}<br />	<br /><br />
				
			$SQL = "SELECT mem_id AS 'Option', mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testtable";<br />
			$array = $dataBase->getQuery($SQL);<br />
			$args = array('Option'=>'delId', 'Name'=>'removeUnderscoreAndMakeRed');<br />
			paginate($array,$args,'uniqueLink2',3,<span class="highlight">1</span>);
			<?php echo $or; ?>
			function removeUnderscoreAndMakeRed($val){echo '&lt;font color="red"&gt;'.str_replace ("_", " ", $val).'&lt;/font&gt;';}<br />			
			function delId($id){echo '&lt;a href="delete.php?id='.$id.'"&gt;Delete&lt;a&gt;';}<br /><br />
			paginate($dataBase->getQuery("SELECT mem_id AS 'Option', mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testtable"),array('Option'=>'delId','Name'=>'removeUnderscoreAndMakeRed'),'uniqueLink2',3,<span class="highlight">1</span>);
			</p>
			output:
			<div class="output">
			<?php
				paginate($dataBase->getQuery("SELECT mem_id AS 'Option', mem_user AS Name, mem_pass AS Password, mem_address AS Address, mem_tel AS 'Tel No' FROM testdata"), array('Option'=>'delId','Name'=>'removeUnderscoreAndMakeRed'),'uniqueLink2',3,1);
			?>
			</div>
			At this point the code may look pretty large but bare in mind, that each example has built upon the previous, and at this point this example has a large amount of arguments associated with its output
			<br style="clear:both;" />
		</div>
		
		<div class="example">
			<h2>Questions / Comments</h2>
			I will be happy to answer any questions<br />
			But, If you have no questions instead, please take a min to leave a comment, it shows that this guide was or was`nt some use to you, this in turn shapes the internet overall for the future, cause at the end of the day you will end up with more things that ya want!
			<div class="output">
				<B>Please</b> leave any questions or comments <a href="http://adriancallaghan.co.uk/pagination-php/">here</a>
				<br style="clear:both;" />
			</div>
		</div>
	</div>
</body>
