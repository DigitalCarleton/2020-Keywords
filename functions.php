<?php 
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_template_directory_uri() . '/style.css' ); 
}

// 2020Keywords: overriding this function from inc/template-tags.php to:
// 1) remove byline so authors are not displayed
// 2) add comments link 
// 3) add tags display
if ( ! function_exists( 'responsiveblogily_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function responsiveblogily_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'responsiveblogily' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = "";
        // $byline = sprintf(
        //     /* translators: %s: post author. */
        //     esc_html_x( 'by %s', 'post author', 'responsiveblogily' ),
        //     '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        // );

		// Tags link — modified from twentytwenty theme's get_post_meta() function
		if ( has_tag() ) {
			?>
			<div class="tagcloud tag-right">
					<?php the_tags( 'Tags: ', ', ', '' ); ?>
			</div>
			<?php

		}

        echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		// Comments link — modified from twentytwenty theme's get_post_meta() function
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			?>
			<div class="post-comment-link">
					<?php comments_popup_link(); ?>
			</div>
			<?php

		}

	}
endif;
