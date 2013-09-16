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
	//print_r($_POST);
	$days = (strtotime(date("Y-m-d")) - strtotime(intval($_POST['year1'])."-".intval($_POST['month1'])."-".intval($_POST['day1'])) ) / (60 * 60 * 24);
	echo '<div class="result">You are<br />'.round($days).' days old!</div>';
	}

// months
$months = array(
	'January',
	'February',
	'March',
	'April',
	'May',
	'June',
	'July',
	'August',
	'September',
	'October',
	'November',
	'December'
	);


if (empty($_POST['day1'])) $_POST['day1']= date('d');
if (empty($_POST['month1'])) $_POST['month1'] = date('n');
if (empty($_POST['year1'])) $_POST['year1'] = date('Y');

?>	
<form method="post" action="http://adriancallaghan.co.uk/how-many-days-old-am-i/">
	<select id="day1" name="day1">
		<?php
		for($x=1; $x<32; $x++){
			switch ($x){
				case 1: $affix="st";break;
				case 2: $affix="nd";break;
				case 3: $affix="rd";break;
				case 21: $affix="st";break;
				case 22: $affix="nd";break;
				case 23: $affix="rd";break;
				case 31: $affix="st";break;
				default: $affix="th";
				}	

			$selected = intval($_POST['day1'])==$x ? 'SELECTED' : '';
			echo '<option '.$selected.' value="'.$x.'">'.$x.$affix.'</option>';
			
			}
		?>
	</select>	
	
	<select id="month1" name="month1">
		<?php
		$x=0;foreach($months as $month) {
			$x++;
			$selected = intval($_POST['month1'])==$x ? 'SELECTED' : '';
			echo '<option '.$selected.' value="'.$x.'">'.$month.'</option>';
			}
		?>
	</select>
	
	<select id="year1" name="year1">
		<?php
		for($x=1900; $x<date('Y')+1; $x++) {
			
			$date = empty($_POST['year1']) ? date('Y') : $x ;
			$selected = $_POST['year1']==$date ? 'SELECTED' : '';	
			
			echo '<option '.$selected.' value="'.$x.'">'.$x.'</option>';
			}
		?>
	</select>

	<input type="Submit" value="Calculate">

	<input type="hidden" name="origin" value="<?php echo md5('current_min');?>">
</form>
