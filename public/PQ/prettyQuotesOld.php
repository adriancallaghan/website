<?php
/*
Plugin Name: PrettyQuotes
Description: Pretty formatting of quotes
Author: Adrian Callaghan

*/


function pQ_setFilter($text){
	
	// opening quote tags
	$text = str_replace('(prettyquote)', '<div id="prettyQuote_box"><span class="prettyQuote_QuoteMark">&#147;</span>', $text);
	
	// closing quote tags
	$text = str_replace('(/prettyquote)', '<span class="prettyQuote_QuoteMark">&#148;</span></div>', $text);
	
	// opening author tags
	$text = str_replace('(authorname)', '<div id="prettyQuote_authorname">', $text);
	
	// closing author tags
	$text = str_replace('(/authorname)', '</div>', $text);
	
	
	
	return $text;

	}


// register the view
add_filter('the_content','pQ_setFilter');

?>