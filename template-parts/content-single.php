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
		<?php the_content(); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'responsiveblogily' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
    
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
	<?php
	endif; ?>
    
</article><!-- #post-<?php the_ID(); ?> -->
