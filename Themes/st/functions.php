<?php

function st_recent_posts_function($atts, $content = null) {
	extract(shortcode_atts(array(
		'posts' => 1,
	), $atts));

	$return_string = '<h3>'.$content.'</h3>';
	query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => $posts));
	if (have_posts()) :
		while (have_posts()) : the_post();
			$return_string .= '<div><a href="'.get_permalink().'">'.get_the_title().'</a></div><div>'.nl2br(get_the_excerpt()).'</div><div>&nbsp;</div>';
		endwhile;
	endif;

	wp_reset_query();
	return $return_string;
}

function st_register_shortcodes(){
	add_shortcode('st-recent-posts', 'st_recent_posts_function');
}

add_action( 'init', 'st_register_shortcodes');

?>
