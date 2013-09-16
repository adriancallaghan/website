<?php include ('wp-config.php'); ?>
<?php
session_start();
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
	$content = "here you can browse sites that I have created";
	$url = "http://adriancallaghan.co.uk";
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
	
	
	<div id="left_column" style="width:200px; float:left; display:block; background:#cccccc; padding:100px;">
		<?php 
		// display a list of the websites within each type
		
		
		// for each type of site
		$x=0; foreach ($wpdb->get_results('SELECT * FROM pf_types', ARRAY_A) as $type){
			$x++;
			if ($x=1) echo '<h2>'.$type['name'].'</h2>';
			
			// list the websites for each type
			foreach ($wpdb->get_results('SELECT id, site_name FROM pf_data WHERE type_no='.intval($type['type_no']), ARRAY_A) as $website){
				echo '<a href="?site='.$website['id'].'" target="blank">'.$website['site_name'].'</a><br />';
				}
			}
		?>
	</div>
	
	<div id="right_column" style="width:500px; float:left; display:block; background:#eeeeee; padding:100px;">

		<?php 
		// display the additional content, whether it be site info, or default content
		echo '<h1>'.$title.'</h1>';
		echo 'URL: <a href="'.$url.'">'.$url.'</a><br />';
		echo $image.'<br />';
		echo $content;
		
		?>
	</div>
	
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
<?php } ?>