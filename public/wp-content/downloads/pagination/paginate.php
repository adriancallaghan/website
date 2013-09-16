<?php 
	
function pagenate($array, $queryString="page", $rules=0, $limit_per_page=5,$range=PAGINATE) {
	
	
	
	// rules is an array of arguments each containing 2 arguments
	
	/*
	
	$rules['key']=> call	= name of key that executes the function for the layout
					call	= name of the function to be called automatically, the current value is passed
	
	// I.E many arguments can be passed within one function call providing the key is unique
	
	
	$range = 	the scope of the pagenation displayed, if no argument passed it looks for a global
				PAGINATE, if that is not present it switches off (zero)
	
	*/
	


	
	
	
	
	// output
	
	// catch bad thangs
	if (intval($limit_per_page)<1 || empty($array)) return;
		
	// pagination internal settings
	$result = $array;
	$limit = intval($limit_per_page);
	$pagelink = $_SERVER['PHP_SELF']; 

	

	$listing = intval($_GET[$queryString]);
	$start = $listing * $limit;

	$all = count($result);
	$all_pages = ceil($all/$limit);
	
	// this forwards any criteria associated with the search by adding it onto the end of the hyperlink
	$args="";
	foreach ($_GET as $key=>$val) $args.= $key!=$queryString ? "&".$key."=".$val : "" ;

	
	if($all>0){
		if(($listing+1) > $all_pages){$listing=0;}
		$of = 0;
		
	////////////////////////////////////////// navigation starts ?>
	<?php
	
	// below shows where in the pagination the results are
	
	$current_loc 	= ($listing+1)*$limit_per_page;
	if ($current_loc>$all) $current_loc=$all;
	
	$previous_loc = $listing*$limit_per_page;
	
	?>
	<h2 style="float:right; margin:0; padding:0; font-size:12px;"><?php echo 'Displaying '.$previous_loc.'-'.$current_loc.' of '.$all; ?></h2>
	<form method="post" action="">
		<div class="tablenav">
		
			<div class='tablenav-pages'>		
				<?php
								
				if(($listing+1) > 1 && ($listing+1) <= $all_pages){
					// up
					echo '<a class="prev page-numbers" href="'.$pagelink.'?'.$queryString.'='.($listing-1).$args.'" title="previous" alt="previous">&laquo;</a>';
					}
	
				
				if ($all_pages>1){
									
					$startpoint	= $listing-$range>0 ? $listing-$range : 0;
					$endpoint 	= $listing+$range<$all_pages ? $listing+$range+1: $all_pages;
					
					// if range is set to zero, it does not set a range, I.E it prints out as normal
					if ($range==0) {$endpoint=$all_pages;$startpoint=0;}
					
					// holds the min page tab number that will display the first page tab 
					elseif ($startpoint>0) echo '<a href="'.$pagelink.'?'.$queryString.'=0'.$args.'" class="page-numbers" title="page '.($all_pages).'" alt="page '.($all_pages).'">First</a>  ... ';

					// goto page
					for($i=$startpoint;$i<$endpoint;$i++){
						// echo`s the number also checks to see if this is the current page
						echo $listing==$i ? '<span class="page-numbers current">'.($i+1).'</span>' : '<a href="'.$pagelink.'?'.$queryString.'='.$i.$args.'" class="page-numbers" title="page '.($i+1).'" alt="page '.($i+1).'">'.($i+1).'</a>';
						}
					// holds the min page tab number that will display the last page tab 
					if ($endpoint<$all_pages) echo ' ... <a href="'.$pagelink.'?'.$queryString.'='.($all_pages-1).$args.'" class="page-numbers" title="page '.($all_pages).'" alt="page '.($all_pages).'">Last</a>';
					}

				if(($listing+1) < $all_pages){
					// down
					echo ' <a href="'.$pagelink.'?'.$queryString.'='.($listing+1).$args.'" class="next page-numbers" title="next" alt="next">&raquo;</a>';
					}

				?>
			</div>

			<br class="clear">
			
		</div>
		
		<br class="clear">
		
		<?php ///////////////////////////////////////// navigation ends	?>
		
		<table class="widefat">
			<thead>
				<tr>
					<?php foreach(array_keys($array[0]) as $title) if ($title!==$del_key) echo '<th scope="col">'.$title.'</th>'; else echo '<th scope="col">&nbsp;</th>'; ?>		
				</tr>
			</thead>
			<tbody>
			
			<?php for($i=$start;$i<($start+$limit);$i++){ ?>
				<?php if (empty($result[$i])) break;	?>
				<tr>
					<?php 
			
					foreach ($result[$i] as $key=>$data) {
													
						// check to see if the rule exists, which is defined by its key name
						if (is_array($rules) && array_key_exists($key, $rules)){
							// if it is maintain layout and call function
							
							echo '<td class="tableContents" valign="top">';
							call_user_func($rules[$key], stripslashes($data));
							echo '</td>';
							}
							
						elseif ($key==$del_key){ ?>
							<th scope="row" class="check-column">
								<input name="delete[]" value="<?php echo $result[$i][$del_key];?>" type="checkbox">
							</th>
						<?php }

						else echo '<td class="tableContents" valign="top">'.stripslashes($data).'</td>'; 
						}
					?>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		
		<?php ////////////////////////////////////////// navigation starts ?>
					
			<div class="tablenav">
				<?php
				if (array_key_exists($del_key, $array[0])) {?>
					<div class="alignleft">
						<input value="Delete" class="button-secondary delete" type="submit">
					</div> 
				<?php } ?>
			
				<div class='tablenav-pages'>
					<?php
					
					
					if(($listing+1) > 1 && ($listing+1) <= $all_pages){
						// up
						echo '<a class="prev page-numbers" href="'.$pagelink.'?'.$queryString.'='.($listing-1).$args.'" title="previous" alt="previous">&laquo;</a>';
						}
		
					
					if ($all_pages>1){

						
						$startpoint	= $listing-$range>0 ? $listing-$range : 0;
						$endpoint 	= $listing+$range<$all_pages ? $listing+$range+1: $all_pages;
						
						// if range is set to zero, it does not set a range, I.E it prints out as normal
						if ($range==0) {$endpoint=$all_pages;$startpoint=0;}
						
						// holds the min page tab number that will display the first page tab 
						elseif ($startpoint>0) echo '<a href="'.$pagelink.'?'.$queryString.'=0'.$args.'" class="page-numbers" title="page '.($all_pages).'" alt="page '.($all_pages).'">First</a>  ... ';
						
						// goto page
						for($i=$startpoint;$i<$endpoint;$i++){
							// echo`s the number also checks to see if this is the current page
							echo $listing==$i ? '<span class="page-numbers current">'.($i+1).'</span>' : '<a href="'.$pagelink.'?'.$queryString.'='.$i.$args.'" class="page-numbers" title="page '.($i+1).'" alt="page '.($i+1).'">'.($i+1).'</a>';
							}
						// holds the min page tab number that will display the last page tab 
						if ($endpoint<$all_pages) echo ' ... <a href="'.$pagelink.'?'.$queryString.'='.($all_pages-1).$args.'" class="page-numbers" title="page '.($all_pages).'" alt="page '.($all_pages).'">Last</a>';
						}

					if(($listing+1) < $all_pages){
						// down
						echo ' <a href="'.$pagelink.'?'.$queryString.'='.($listing+1).$args.'" class="next page-numbers" title="next" alt="next">&raquo;</a>';
						}

					?>	
				</div>

				<br class="clear">
				
			</div>
			
		<br class="clear">	
			
		<?php ///////////////////////////////////////// navigation ends	?>
	</form>
	<?php
		}
	} ?>