<?php include ('wp-config.php'); ?>
<?php
//session_start();
//print_r($_POST);
//print_r($_SESSION);

// handle a login request
if (!empty($_POST['login'])){
	// login is only for me, so no need for database provision here :)
	
	$msg="Access Denied";
	if ($_POST['username']=='adrian' && $_POST['password']=='TsD24313') {
		echo "granted";
		$msg = "Access Granted";
		$_SESSION['editor']='adrian';	
		}
	}

// if logged in display the admin panel
if ($_SESSION['editor']=='adrian'){
	//	DISPLAY ADMIN PANEL HERE ?>

	<?php
	if (!empty($_POST['Edit'])){
		echo "Edit";
		}
	
	if (!empty($_POST['Add'])){
		echo "Add";
		}	
	?>
	
	<form method="post" action="">
		<?php
		foreach ($wpdb->get_results('SELECT * FROM pf_types', ARRAY_A) as $type){
			echo '<input type="text" name="'.$type['id'].'" value="'.$type['name'].'">';
			echo '<input type="Submit" value="Edit" name="Edit"><br />';
			}
		?>
		<input type="text" name="newCategory">
		<input type="Submit" value="Add" name="Add">
	</form>


	
	
	<?php/*
	// for each type of site
		$x=0; foreach ($wpdb->get_results('SELECT * FROM pf_types', ARRAY_A) as $type){
			$x++;
			if ($x=1) echo '<h2>'.$type['name'].'</h2>';
			
			// list the websites for each type
			foreach ($wpdb->get_results('SELECT id, site_name FROM pf_data WHERE type_no='.intval($type['type_no']), ARRAY_A) as $website){
				echo '<a href="?site='.$website['id'].'" target="blank">'.$website['site_name'].'</a><br />';
				}
			}*/
	?>



	
<?php } else { 

	// default values
	$title = "Welcome to my portfolio";
	$content = "Here you can browse sites I have created by clicking the names in the panel below<br />";
	$content.= "<br /><br />There are more sites, im just trying to remember them<br />";
	$content.= "so this page is very much a 'work in progress' area.<br />";
	$url = "";
	$image = "";

	// if the request is empty or not found, the new values will not be assigned
	if (!empty($_GET['site'])){ 

		$SQL = 'SELECT * FROM pf_data where id='.intval($_GET['site']);
		$details = $wpdb->get_results($SQL, ARRAY_A);
		
		if (!empty($details)){
			$title = $details[0]['site_name'];
			$content = $details[0]['site_info'];
			$url = $details[0]['site_url'];
			$image = $details[0]['site_img'];
			}	
		}
	?>
	
	<?php 	// main content is displayed here 	?>
	
	<style>
	a.navigation {color:#cc0000;text-decoration:underline; font-weight:lighter;}
	</style>
	
	<div id="right_column" style="border:solid 1px #cccccc; padding:10px; margin:40px 0; background:#ededed; min-height:250px;">

		<?php 
		// display the additional content, whether it be site info, or default content
		echo '<h1 style="padding:20px 0;">'.$title.'</h1>';
		echo empty($url) ? '' : 'URL: <a href="'.$url.'" target="blank" class="navigation">'.$url.'</a><br />';
		echo $image.'<br />';
		echo $content;
		
		?>
	</div>
	
	
	<div id="left_column" style="border:solid 1px #cccccc; padding:10px;">
		<h1 style="text-decoration:underline;">Navigation Panel</h1>
		<?php 
		// display a list of the websites within each type
		
		
		// for each type of site
		$x=0; foreach ($wpdb->get_results('SELECT * FROM pf_types', ARRAY_A) as $type){
			$x++;
			if ($x=1) echo '<h2>'.$type['name'].'</h2>';
			
			// list the websites for each type
			foreach ($wpdb->get_results('SELECT id, site_name FROM pf_data WHERE type_no='.intval($type['type_no']), ARRAY_A) as $website){
				echo '<a href="?site='.$website['id'].'" class="navigation">'.$website['site_name'].'</a><br />';
				}
			}
		?>
	</div>
		
	<?php /*
	<div id="bottom_column" style="clear:both; display:block; background:#555555; width:300px;">
		<?php // login box ?>
		<form method="post" action="">
			<fieldset>
				<legend>Login</legend>
				<?php if (!empty($msg)) echo '<div id="message">'.$msg.'</div>'; // status of login req ?>
				<input type="text" name="username" value="<?php echo $_POST['username']; ?>"><br />	
				<input type="password" name="password" value="<?php echo $_POST['password']; ?>"><br />	
				<input type="submit" name="login" value="Login">
			</fieldset>
		</form>
		
	</div>
	*/?>
<?php } ?>