<?php
/*
	Plugin Name: Social Network Username Getter
	Plugin URI: http://gearoidc.com
	Description: Gets URLs for usernames for different Social Networks
	Author: Gearoid Coughlan
	Author URI: http://gearoidc.com
	Version: 0.0.1
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
add_filter('the_content', 'generate_xref_urls', 5);
?>
