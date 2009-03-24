<?php
/*
	Plugin Name: Social Network Username Getter
	Plugin URI: http://gearoidc.com
	Description: Gets URLs for usernames for different Social Networks
	Author: Gearoid Coughlan
	Author URI: http://gearoidc.com
	Version: 0.2
*/

/*  Copyright 2009  Gearoid Coughlan

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

function twitter_callback( $matches) {
	return "<a href='http://twitter.com/".$matches[1]."'>@".$matches[1]."</a>";
}

function plurk_callback( $matches ) {
	return "<a href='http://plurk.com/".$matches[1]."'>@".$matches[1]."</a>";
}

function generate_xref_urls( $text ) {
  $rules = array ( 
    'plurk' => array ("/@([\w]*)\(plurk\)/i", 'plurk_callback'),
    'twitter' => array ("/@([\w]*)\(twitter\)/i", 'twitter_callback')
  );
	foreach ($rules as $rule) {
		$pattern = $rule[0];
		$callback = $rule[1];
		$text = preg_replace_callback($pattern, $callback, $text);
	}
	return $text;
}
add_filter('the_content', 'generate_xref_urls', 1);
add_filter('the_content_rss', 'generate_xref_urls',1);
add_filter('comment_text', 'generate_xref_urls');
?>
