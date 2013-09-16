<?php

if (!empty($_POST)) {
	// process the request here
	
	print_r($_POST);

	// you must end here to stop the displaying of the html below
	exit (0);
	}	
?>

<script>
function submit_this(){
	
	// the fields that are to be processed
	var field1 = $("input[@name=field1]").val();
	var field2 = $("input[@name=field2]").val();

	// ajax call to itself 
	$.post("form.php", {input1: field1, input2: field2}, function(data){$("#message").text(data);});

	
	return false;
	}

</script>

<style>
#message {margin:20px; padding:20px; display:block; background:#cccccc; color:#cc0000;}
</style>

<div id="message">Please enter your password</div>

<div style="text-align:center ">
	<table border="0" cellpadding="3" cellspacing="3" style="margin:0 auto;" >
	  <tr>
		<td><label>Username</label>
		  :</td>
		<td><input name="field1" type="text" size="20"></td>
	  </tr>
	  <tr>
		<td><label>Password</label>
		  :</td>
		<td><input name="field2" type="text" size="20"></td>
	  </tr>
	  <tr align="right">
		<td colspan="2">
		<input type="submit" id="go" value="&nbsp;&nbsp;Login&nbsp;&nbsp;" onclick="submit_this()">
		&nbsp;
		<input type="submit" id="Login" value="&nbsp;&nbsp;Cancel&nbsp;&nbsp;" onclick="tb_remove()"></td>
		</tr>
	</table>
</div>














