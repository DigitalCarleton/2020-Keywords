<?php 
add_action( 'wp_enqueue_scripts', '2020_keywords_enqueue_styles' );
function 2020_keywords_enqueue_styles() {
	wp_enqueue_style( '2020_keywords-style', get_template_directory_uri() . '/style.css' ); 
} 