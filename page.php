<?php global $ainext_opt;
/**
 * The template for displaying all pages
 */

get_header();

/**
 * Page Control
 */
if( function_exists('acf_add_options_page') ) {
	$hide_banner 		= get_field( 'enable_page_banner' );
	$hide_breadcrumb 	= get_field( 'hide_breadcrumb' );
	$custom_title 	    = get_field( 'enable_cus_pagetitle' );
}else {
	$hide_banner 		= false;
	$hide_breadcrumb 	= false;
	$custom_title 	    = false;
}

$tag = !empty($ainext_opt['page_title_tag']) ? $ainext_opt['page_title_tag'] : 'h1';
?>
	<?php if( $hide_banner == false ) { ?>
		<div class="section-banner">
            <div class="container">
            	<div class="section-banner-title">
					<?php if( $custom_title == true && get_field( 'cus_pagetitle' ) != '' ) { ?>
						<<?php echo esc_attr( $tag ); ?>><?php echo esc_html( get_field( 'cus_pagetitle' ) ); ?> </<?php echo esc_attr( $tag ); ?>>
					<?php } else { ?>
						<<?php echo esc_attr( $tag ); ?>><?php the_title(); ?> </<?php echo esc_attr( $tag ); ?>>
					<?php } ?>

					<?php if( $hide_breadcrumb == false ) : ?>
						<?php if ( function_exists('yoast_breadcrumb') ) {
							yoast_breadcrumb( '<p class="ainext-seo-breadcrumbs" id="breadcrumbs">','</p>' );
						} else { ?>
						<nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ainext' ); ?></a></li>
								<li class="breadcrumb-item active"><?php the_title(); ?></li>
							</ol>
						</nav>
					<?php } endif; ?>
                </div>
            </div>
        </div>
	<?php } ?>

	<?php if( !ainext_is_elementor() && 'product' != get_post_type() ): ?><div class="page-main-content"><?php endif; ?>
		<div class="page-area">
			<?php if( !ainext_is_elementor() && 'product' != get_post_type() ): ?><div class="container"><?php endif; ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php $thecontent = get_the_content(); // If no content ?>
					<?php if(empty( $thecontent )) { ?> <div class="ainext-single-blank-page"></div><?php } ?>
					<?php get_template_part( 'template-parts/content', 'page' ); ?>
					<?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; // If comments are open or we have at least one comment, load up the comment template. ?>
				<?php endwhile; // End of the loop. ?>
			<?php if( !ainext_is_elementor() && 'product' != get_post_type() ): ?></div><?php endif; ?>
		</div>
	<?php if( !ainext_is_elementor() && 'product' != get_post_type() ): ?></div><?php endif; ?>

<?php get_footer();