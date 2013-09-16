<style>
.nav_arrow {color:#222222; text-decoration:none;}
.nav_number{color:#777777; text-decoration:none;}
.nav_number_current{color:#222222; text-decoration:underline;}
</style>

<div style="width:80%; margin:0 auto;">
	
	<?php  
	// do your database query here and store it within array	

	// test content (just fills array with test content)
	$contentLimit=50;
	for ($x=0; $x<$contentLimit; $x++){
		$array[$x]['Thing_1'] = $x.'a';
		$array[$x]['Thing_2'] = $x.'b';
		$array[$x]['Thing_3'] = $x.'c';
		$array[$x]['Thing_3'] = $x.'d';
		$array[$x]['Thing_3'] = $x.'e';
		}
	?>

	
	<?php // output

	// pagination loop begins
	$result = $array;
	$limit = intval(20);
	$pagelink = 'index.php';
	$queryString = 'stat';
	
	// pagenation begins, KUDOS to andrew for his considerable help here
	$listing = intval($_GET[$queryString]);
	$start = $listing * $limit;

	$all = count($result);
	$all_pages = ceil($all / $limit);

	// this forwards any criteria associated with the search by adding it onto the end of the hyperlink
	$args=""; foreach ($_GET as $key=>$val){
		$args.= $key!=$queryString ? "&".$key."=".$val : "" ;
		}
	
	if($all>0){
		if(($listing+1) > $all_pages){$listing=0;}
		$of = 0;
		
		////////////////////////////////////////// navigation starts
		
		if(($listing+1) > 1 && ($listing+1) <= $all_pages){
			// up
			echo '<a href="'.$pagelink.'?'.$queryString.'='.($listing-1).$args.'" class="nav_arrow" title="previous" alt="previous">&#171;</a>';
			}
			
		if ($all_pages>1){
			// goto page
			for($i=0;$i<$all_pages;$i++){
			
				// echo`s the number also checks to see if this is the current page
				echo $listing==$i ? '<a href="'.$pagelink.'?'.$queryString.'='.$i.$args.'" class="nav_number_current" title="current" alt="current">'.($i+1).'</a>' : '<a href="'.$pagelink.'?'.$queryString.'='.$i.$args.'" class="nav_number" title="page '.($i+1).'" alt="page '.($i+1).'">'.($i+1).'</a>';
				if($i < ($all_pages-1)) echo ' | ';
				}
			}
			
		if(($listing+1) < $all_pages){
			// down
			echo ' <a href="'.$pagelink.'?'.$queryString.'='.($listing+1).$args.'" class="nav_arrow" title="next" alt="next">&#187;</a>';
			}
		
		///////////////////////////////////////// navigation ends
	?>
	<br />
	<table border="1" cellpadding="2" cellspacing="1"  width="100%">
		<tr>
			<th class='tableHeader'>Thing 1</th>
			<th class='tableHeader'>Thing 2</th>
			<th class='tableHeader'>Thing 3</th>
		</tr>
		<?php
		// pagenation resumes
		
		for($i=$start;$i<($start+$limit);$i++){		
			if (empty($result[$i])) break; // break if complete
			// format results
			?>
			<tr>
				<td class='tableContents'><?php echo $result[$i]['Thing_1']; ?></td>
				<td class='tableContents'><?php echo $result[$i]['Thing_2']; ?></td>
				<td class='tableContents'><?php echo $result[$i]['Thing_3']; ?></td>
			</tr>
		<?php }	?>
	</table>
	<?php
	}
	else{
		// zero results found
		echo '<h1>No results found</h1>';
		}
	?>	
</div>