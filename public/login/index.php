<?php
/** Loads the WordPress Environment and Template */
require('../wp-blog-header.php');
?>
<?php get_header() ?>
	<div id="container">
		<div id="content">
				
				 <!-- a href="http://adriancallaghan.co.uk/secure-zone/main.php">Main</a -->
				 <style>
         #Form {width:250px; margin:0 auto;}
         #set {padding:10px;}
         #title {font-size:20px; font-weight:bold;}
         #button {float:right;}
				 .strut {margin-top:10px;}
				 .spacer {margin:15px 0;}
				 .field {margin:0 auto; padding:5px;}
         .Label {margin:0 auto; padding:10px; font-size:15px;}
         </style>
				
				<h2 class="entry-title">Secure Zone</h2>
				<div class="entry-content">
						 
						 <form method="post" action="" id="Form">
						 			 <fieldset id="set">
									 					 <legend id="title">Login</legend>
														 <br class="strut" />
														 <label for="user" class="Label">
														 				Username<br />
																		<input type="text" size="30" name="user" class="field" />
														 </label>
														 <br class="spacer" />
														 <label for="pass" class="Label">
														 				Password<br />
														 				<input type="password" size="30" name="pass" class="field" />
														 </label>
														 <br class="spacer" />
														 <input type="Submit" value="submit" class="button" />
														 <br class="spacer" />
									</fieldset>
						</form>
						<? //print_r($_POST); ?>
										
				</div>
		</div><!-- #content -->
	</div><!-- #container -->
<?php get_sidebar() ?>
<?php get_footer() ?>
