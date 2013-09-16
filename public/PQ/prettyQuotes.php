<?php
/*
Plugin Name: PrettyQuotes
Description: Pretty formatting of quotes
Author: Adrian Callaghan

*/


function pQ_setFilter($text){
	
	$openingTag = '<div id="prettyQuote_box">';
	$closingTag = '<img src="http://www.bmb.uk.com/wp-content/themes/bmb/rightQuote.jpg" style="border:none; width:23px height:16px; paddding:0; margin:0; display:inline;"/>';
	$authorTag = '<div id="prettyQuote_authorname">';



	// check to see if prettyquotes is being used
	if(strpos($text, '(prettyquote)')){

		// opening main quote tag
		$text = str_replace('(prettyquote)', $openingTag, $text);
		
		// if the quote has an authorname
		if(strpos($text, '(authorname)')){
			
			// opening author tag
			$text = str_replace('(authorname)', $closingTag.$authorTag, $text);
			// closing author tag
			$text = str_replace('(/authorname)', '</div>', $text);
			
			// kill the closing tag as it has already been used to close the quotation
			$closingTag='';
			
			}
		
		
		// closing main quote tag
		$text = str_replace('(/prettyquote)', $closingTag.'</div>', $text);
	
	
		}
	
	
	return $text;

	}


// register the view
add_filter('the_content','pQ_setFilter');

?>