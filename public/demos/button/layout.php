<div id="container">
For example:

<form method="post" action="" name="mainForm">
<noscript><input type="submit" name="submit"></noscript>
<script type="text/javascript">				
function submitform(){
document.mainForm.submit();
}
document.write('<a href="javascript:submitform();" style="text-decoration:none; color:#fff; font-weight:bold;">');
document.write('<div id="buyButtonMid">');
document.write('<div id="buyButtonLeft"></div>');
document.write('submit');
document.write('<div id="buyButtonRight"></div>');
document.write('</div>');
document.write('</a>');
</script>
</form>

</div>
<style>
#container {
	width:200px;
	height:40px;
	padding:10px;
	color:#323232;
	display:block;
	background:#E4E4E4;
	border:4px solid #C8C8C8;
	}

/* buy button */
#buyButtonRight{
	width:16px;
	height:44px;
	display:block;
	position:absolute;
	top:0;
	right:0;
	cursor:pointer;
	}
 
#buyButtonLeft{
	width:16px;
	height:44px;
	display:block;
	position:absolute;
	top:0;
	left:0;
	cursor:pointer;
	}
 
#buyButtonMid{
	height:24px;
	min-width:20px;
	/*max-width:300px;*/
	padding:13px 20px 7px 20px;
	display:block;
	position:relative;
	float:left;
	cursor:pointer;
	color:#ffffff; 
	font-size:13px; 
	text-decoration:none;
	}
 
 
/* normal */
#buyButtonLeft{background:url('http://adriancallaghan.co.uk/demos/button/add2bas_left.jpg');}	
#buyButtonMid{background:url('http://adriancallaghan.co.uk/demos/button/add2bas_mid.jpg');}	
#buyButtonRight{background:url('http://adriancallaghan.co.uk/demos/button/add2bas_right.jpg');}
 
/* hover */
#buyButtonMid:hover #buyButtonLeft{background:url('http://adriancallaghan.co.uk/demos/button/add2bas_left_hover.jpg');}
#buyButtonMid:hover {background:url('http://adriancallaghan.co.uk/demos/button/add2bas_mid_hover.jpg');}
#buyButtonMid:hover #buyButtonRight{background:url('http://adriancallaghan.co.uk/demos/button/add2bas_right_hover.jpg');}
 
/* click */
#buyButtonMid:active #buyButtonLeft{background:url('http://adriancallaghan.co.uk/demos/button/add2bas_left_click.jpg') no-repeat;}
#buyButtonMid:active {background:url('http://adriancallaghan.co.uk/demos/button/add2bas_mid_click.jpg');}
#buyButtonMid:active #buyButtonRight{background:url('http://adriancallaghan.co.uk/demos/button/add2bas_right_click.jpg');}
</style>