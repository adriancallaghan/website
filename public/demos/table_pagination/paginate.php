<?php // below is the css used for formatting ?>
<style>
.widefat {width:100%;background:#aaaaaa; border:1px solid #000000;}
.page-numbers {
	border:1px solid #000000; 
	background:#777777; 
	margin:0 4px; 
	padding:2px 4px; 
	text-decoration:none; 
	color:#ffffff;
	font-size:7pt;
	}
.current {background:#cccccc; font-size:8pt;}
.prev, .next {font-size:6pt;}
.tbc_odd {background:#dedede; text-indent:5px;}
.tbc_even {background:#ededed; text-indent:5px;}
.widefat thead{font-size:12pt; background:#333333; color:#ffffff; text-align:left;}
.widefat th{padding:10px;}
.widefat td{padding:5px;}
.tablenav-pages {float:right; margin:0; padding:10px 0; clear:both;}
h2.displaying{font-size:10pt; float:right; font-style:italic; margin:0; padding:0; margin-bottom:6px;}
</style>
<?php 
	
function paginate($array, $rules=0, $queryString="page", $limit_per_page=10, $range=2) {
		
	
	// rules is an array of arguments each containing 2 arguments
	
	/*
	
	$rules['key']=> call	= name of key that executes the function for the layout
					call	= name of the function to be called automatically, the current value is passed
	
	// I.E many arguments can be passed within one function call providing the key is unique
	
	
	$range = 	the scope of the pagenation displayed, if no argument passed it looks for a global
				PAGINATE, if that is not present it switches off (zero)
	
	
	
	specials (reserved formatting for special tasks, you set the value it responds to below)
	
	$new_key = 	displays an icon in the top of the list, which passes the 'add' action in $_GET, 
				the icon source is its value	
	
	*/
	
	$new_key = "_NEW";

	
	
	// output
	
	// catch bad thangs
	if (intval($limit_per_page)<1) return;
		
	
	
	// pagination internal settings
	$result = $array;
	$limit = intval($limit_per_page);
	$pagelink = $_SERVER['PHP_SELF']; 



	
	// if the array is empty add the option to start a new whatever	and return
	if (empty($array)){
		if (is_array($rules) && array_key_exists($new_key, $rules)) {?>
			<a href="<?php echo $pagelink;?>?action=add">
				<img src="<?php echo $rules[$new_key]; ?>" style="border:none;" />
			</a>
			<?php }
		return;
		}
	
	
			

	

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
	<form method="post" action="">
		<h2 class="displaying"><?php echo 'Displaying '.($previous_loc+1).'-'.$current_loc.' of '.$all; ?></h2>
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
		
		<?php ///////////////////////////////////////// navigation ends	?>
		
		<table class="widefat">
			<thead>
				<tr>
					<?php foreach(array_keys($array[0]) as $title) if ($title!==$del_key) echo '<th scope="col">'.$title.'</th>'; else echo '<th scope="col">&nbsp;</th>'; ?>		
				</tr>
			</thead>
			<tbody>
			
			<?php 
			
			// this creates the add button
			if (is_array($rules) && array_key_exists($new_key,$rules)) { ?>
				<tr>
					<?php for ($x=0; $x!==count(array_keys($array[0]))-1; $x++) echo '<td class="tbc_odd">';?>
					<td class="tbc_odd" valign="top">
						<a href="<?php echo $pagelink;?>?action=add&<?php echo $queryString.'='.intval($_GET[$queryString]);?>">
							<img src="<?php echo $rules[$new_key]; ?>" style="border:none;" />
						</a>
					</td>
				</tr>
			<?php 
				$CLASS=2;
				} 
			
			
			for($i=$start;$i<($start+$limit);$i++){ ?>
				<?php if (empty($result[$i])) break;	
				$CLASS++; $class = $CLASS%2>0 ? 'class="tbc_even"' : 'class="tbc_odd"';
				?>
				<tr>
					<?php 
			
					foreach ($result[$i] as $key=>$data) {						
						
						// check to see if the rule exists, which is defined by its key name
						if (is_array($rules) && array_key_exists($key, $rules)){
							// if it is maintain layout and call function
							
							echo '<td '.$class.' valign="top">';
							call_user_func($rules[$key], stripslashes($data));
							echo '</td>';
							}
							
						else echo '<td '.$class.' valign="top">'.stripslashes($data).'</td>'; 
						}
					?>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		
		<?php ////////////////////////////////////////// navigation starts ?>
			
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
			
		<?php ///////////////////////////////////////// navigation ends	?>
	</form>
	<?php
		}
	} ?>