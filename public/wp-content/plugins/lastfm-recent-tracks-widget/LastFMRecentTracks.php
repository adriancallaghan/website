<?php

/*
Plugin Name: Recently on Last.fm
Plugin URI: http://gregorytomlinson.com/encoded/recent-tracks-lastfm-widget/
Description: Let's you display the Last FM Recent Tracks in the sidebar of your blog, useful if you use WP-Cache / Super Cache and want the feed to be fresh
Author: Gregory Tomlinson
Author URI: http://www.gregorytomlinson.com/encoded/
Version: 0.9.5

Copyright Gregory Tomlinson (email : gregory.tomlinson [at] gmail [dot] com | http://gregorytomlinson.com/encoded/)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


class LastFMRecentTracksWidget {

	var $name = 'Recently on Last.fm';
	var $safe_name = 'recently_on_last_fm_widget';
	var $last_fm_base_url = 'http://www.last.fm/user/';
	var $user_db_options = 'recent_track_last_fm_user';	
	var $user_db_option_count = 'recent_track_last_fm_count';
	var $pluginURL;		

	function LastFMRecentTracksWidget() { $this->__construct(); }

	function __construct() {
	
		$this->pluginURL = WP_CONTENT_URL . "/plugins/" . plugin_basename(dirname(__FILE__));	
	
		add_action("wp_head", array(&$this,"serveHeader"));
//		$widget_ops = array('description' => __('Arbitrary text or HTML'));		
		register_sidebar_widget($this->name, array( &$this, 'widget_lastfmrecentracks' ));
		register_widget_control($this->name, array( &$this, 'widget_lastfmrecentracks_controls'));			
		// make sure it has jquery -- 2.7
		wp_enqueue_script("jquery", false, false, "1.3.2");	
	}

	function activate() {
	}

	function deactivate() {
	}

	function widget_lastfmrecentracks( $args ) {
		extract( $args );
		$db_data = get_option($this->safe_name);
		//print_r($args);
		$user = ( isset( $db_data['user_id'] ) ) ? $db_data['user_id'] : 'gregory80';
		$count = ( isset( $db_data['count'] ) ) ? $db_data['count'] : '5';		
        $widget_body = <<<EOD
        $before_widget
        <style type="text/css">
        	<!--
				.sp_list_itm_span { display:block; }
			-->
        </style>
        $before_title 
        	<a href="$this->last_fm_base_url$user" target="_blank">$this->name</a>
        $after_title
        <ul id='recent_on_last_fm_itm_list'></ul>
        <script type="text/javascript">
        	jQuery('#recent_on_last_fm_itm_list').lastfm( { params : { limit : "$count", user : "$user"  } } );
        </script>
        $after_widget
EOD;

        if( $user != '' ) { echo $widget_body; }
	}

	function widget_lastfmrecentracks_controls() {
		//
		
		$count_nums = array('1', '5', '10', '15', '20');
		
		$db_data = get_option($this->safe_name);
		$image_url = $this->pluginURL . '/images/lastfm.png';
		$user = $db_data['user_id'];
		$count = $db_data['count'];		
		
		$options_string = '';
		for( $i=0; $i<count( $count_nums ); $i++ ) {
			$options_string .= '<option value="'. $count_nums[$i] . '" ';
			
			if( $count_nums[$i] == $count ) { $options_string .= ' selected="selected"'; }
			
			$options_string .= "> " . $count_nums[$i] . " </option>";
		}
		
		
		$data = <<<EOD
		<p><label><img src="$image_url" border="0" /> Last.fm username<input type="text" name="$this->user_db_options" value="$user" /> </label></p>
		<p><label>Count <select name="$this->user_db_option_count">
			$options_string
		</select> </label></p>		
EOD;

		echo $data;

		if (isset($_POST[$this->user_db_options])){
		
			$db_data['user_id'] = attribute_escape($_POST[$this->user_db_options]);
			$db_data['count'] = attribute_escape($_POST[$this->user_db_option_count]);			

			update_option( $this->safe_name, $db_data );
		}		
	}

	
	function serveHeader() {
		$siteurl = get_option('siteurl');
	  $async = <<<EOT
	  <script type="text/javascript" src="$this->pluginURL/js/jquery.lastfm.js"></script>
	  
EOT;
		echo $async;	
	
	}

}


add_action('plugins_loaded', 'lastfmrecentrackswidget_loadplugin');
function lastfmrecentrackswidget_loadplugin() {
	
if (class_exists('LastFMRecentTracksWidget')) {
     $LastFMRecentTracksWidget = new LastFMRecentTracksWidget();
		
		if( function_exists("register_activation_hook") ) {		
			register_activation_hook( __FILE__, array(&$LastFMRecentTracksWidget, 'activate'));

		}
		if( function_exists("register_deactivation_hook") ) {		
			register_deactivation_hook( __FILE__, array(&$LastFMRecentTracksWidget, 'deactivate'));
		}

		
	}
}



?>