<?php
/*

Plugin Name: SemCodeFix
Plugin URI: http://www.sematopia.com/?p=
Description: A plugin to display preformatted code in WordPress
Version: 1.0
Author: George A. Papayiannis
Author URI: http://www.sematopia.com

Description:

To activate/use this plugin, do the following:

1. Place this file in the plugin directory of your WordPress installation and activate it.
2. Copy and paste the CSS into your local.css file in your theme's directory.
3. Depending on your theme, your might want to change the 'width' value in the div.code_child css style.
4. Any code you have, just wrap it in a <code> tag from within the editor.

Note: 

I've tested this on WordPress 2.0.4 and 2.0.1. 
I have the rich text editor disabled and the option which has Wordpress auto-correct the syntax in your post.

Copyright (C) 2006 George A. Papayiannis

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
The license is also available at http://www.gnu.org/copyleft/gpl.html

*/

add_filter('the_content','sem_fix_code','1');

function sem_fix_code($content) {
	return preg_replace_callback('!<code([^>]*)>(?:\r\n|\n|\r|)(.*?)(?:\r\n|\n|\r|)</code>!ims', 'sem_fix_code_callback', $content);
}

function sem_fix_code_callback($matches) {
	$escapedContent = $matches[2];
	$escapedContent = str_replace("<","&#60;",$escapedContent);
	$result = "<div class='code_parent'><div class='code_title'>Code:</div>";
	$result = $result."<div class='code_child'><code><div class='pre_container'><pre>";
	$result = $result.$escapedContent."</pre></div></code></div></div>";
	return $result;
}

?>