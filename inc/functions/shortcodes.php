<?php

// [owr_title]Title[/owr_title]
function owr_title_shortcode( $atts, $content = null ) {
	$attributes = shortcode_atts( [
		'class' => '',
	], $atts );


	return '<div class="section-title ' . $attributes['class'] . '">' . $content . '</div>';
}

add_shortcode( 'owr_title', 'owr_title_shortcode' );