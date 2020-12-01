<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package responsiveblogily
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('posts-entry fbox'); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured-thumbnail">
			<?php the_post_thumbnail('responsiveblogily-slider'); ?>
		</div>
	<?php endif; ?>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

        ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
        <?php 
        /*  2020Keywords: adding part of speech form field data
            Print the part of speech value if exists
        */
        $pos = get_post_meta( $post->ID, 'part_of_speech__optional_', true );
        if ( ! empty ( $pos ) && $pos != -1 ) :
        ?>
        <div class="custom-fields cf-pos">
            <?php printf( '%s.', $pos ); ?>
        </div>
        <?php endif; ?>

		<?php the_content(); ?>
        
        <?php 
        /*  2020Keywords: adding usage form field data
            Print the usage value if exists
        */
        $usage = get_post_meta( $post->ID, 'usage__optional_', true );
        if ( ! empty ( $usage ) ) : 
        ?>
        <div class="custom-fields cf-usage">
            <?php printf( '"%s"', $usage ); ?>
        </div>
        <?php endif; ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'responsiveblogily' ),
				'after'  => '</div>',
			) );
		?>
    
        <!-- 2020Keywords: moving post meta below content -->
    	<?php
        if ( 'post' === get_post_type() ) : ?>
    	<div class="entry-meta">
    		<div class="blog-data-wrapper">
    			<div class="post-data-divider"></div>
    			<div class="post-data-positioning">
    				<div class="post-data-text">
    					<?php responsiveblogily_posted_on(); ?>
    				</div>
    			</div>
    		</div>
    	</div><!-- .entry-meta -->

        <!-- 2020Keywords: adding like/dislike buttons  -->
    	<div>
            <?php echo do_shortcode('[posts_like_dislike]');?>
    	</div>

	</div><!-- .entry-content -->

	<?php
	endif; ?>
    
</article><!-- #post-<?php the_ID(); ?> -->
