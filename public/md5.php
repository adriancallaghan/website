<style>
.result {
	color:#000000; 
	background:#677E64; 
	font-size:15px; 
	display:block; 
	width:250px; 
	height:40px; 
	text-align:center; 
	overflow:wrap;
	border:1px solid #94B89E;
	margin:20px 5px;
	padding:10px;
	}
</style>
<?php 


// processing
if ($_POST['origin']==md5('current_min')){
	echo '<div class="result"><font color="white"><b>MD5: '.$_POST['md5_field'].'</b></font><br />'.md5($_POST['md5_field']).'</div>';
	}



?>	
<form method="post" action="http://adriancallaghan.co.uk/online-md5-hasher/">
	
	<input type="text" value="<?php echo $_POST['md5_field']; ?>" name="md5_field" size="35px;">

	<input type="Submit" value="MD5">

	<input type="hidden" name="origin" value="<?php echo md5('current_min');?>">
</form>
