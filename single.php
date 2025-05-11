<?php global $ainext_opt;
/**
 * The single template file
 * @package AiNext
*/

get_header();

// Blog sidebar
if( isset( $ainext_opt['ainext_single_blog_sidebar'] ) ) {
    if( $ainext_opt['ainext_single_blog_sidebar'] == 'ainext_without_sidebar_center' ) :
        $ainext_sidebar_class = 'col-lg-8 col-md-12 offset-lg-2';
    elseif( $ainext_opt['ainext_single_blog_sidebar'] == 'ainext_without_sidebar' ) :
        $ainext_sidebar_class = 'col-lg-12 col-md-12';
    else:
        if( is_active_sidebar( 'article-sidebar' ) ):
            $ainext_sidebar_class = 'col-lg-8 col-md-12';
        else:
            $ainext_sidebar_class = 'col-lg-8 col-md-12 offset-lg-2';
        endif;
    endif;
    $sidebar_hide = $ainext_opt['ainext_single_blog_sidebar'];
} else {
    if( is_active_sidebar( 'article-sidebar' ) ):
        $ainext_sidebar_class = 'col-lg-8 col-md-12';
        $sidebar_hide = 'ainext_with_sidebar_right';
    else:
        $ainext_sidebar_class = 'col-lg-8 col-md-12 offset-lg-2';
        $sidebar_hide = 'ainext_without_sidebar';
    endif;
} 

// Blog breadcrumb
$post_page_id       = get_option( 'page_for_posts' );
if( function_exists('acf_add_options_page') ) {
	$hide_blog_banner 	= get_field( 'enable_page_banner');
	$hide_breadcrumb 	= get_field( 'hide_breadcrumb');
	$custom_title 	    = get_field( 'enable_cus_pagetitle');
}else {
	$hide_blog_banner 	= false;
	$hide_breadcrumb 	= false;
	$custom_title 	    = false;
}

// Blog page link
if ( $post_page_id ) {
	$blog_link = get_permalink( $post_page_id );
}else{
	$blog_link = home_url( '/' );
}
$is_post_date   = isset( $ainext_opt['is_post_date']) ? $ainext_opt['is_post_date'] : true;
$tag = !empty($ainext_opt['page_title_tag']) ? $ainext_opt['page_title_tag'] : 'h1';
?>
	<!-- Start Banner Area -->
    <?php if( $hide_blog_banner == false ) : ?>
        <div class="section-banner">
            <div class="container">
                <div class="section-banner-title">
					<?php if( $custom_title ): ?>
						<<?php echo esc_attr( $tag); ?>><?php esc_html(get_field('cus_pagetitle')); ?></<?php echo esc_attr( $tag); ?>>
					<?php elseif( get_the_title() ): ?>
						<<?php echo esc_attr( $tag); ?>><?php the_title(); ?></<?php echo esc_attr( $tag); ?>>
					<?php else: ?>
						<<?php echo esc_attr( $tag); ?>><?php esc_html_e('No Title', 'ainext'); ?></<?php echo esc_attr( $tag); ?>>
					<?php endif; ?>

                    <?php if( $hide_breadcrumb == false ) : ?>
                        <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ainext' ); ?></a></li>

								<?php if( $custom_title ): ?>
									<li class="breadcrumb-item active"><?php esc_html(get_field('cus_pagetitle')); ?></li>
								<?php elseif( get_the_title() ): ?>
									<li class="breadcrumb-item active"><?php the_title(); ?></li>
								<?php else: ?>
									<li class="breadcrumb-item active"><?php esc_html_e('No Title', 'ainext'); ?></li>
								<?php endif; ?>
                            </ol>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- End Banner Area -->

	<!-- Start Blog Area -->
	<div class="blog-details-area ptb-100">
		<div class="container">
			<div class="row">
				<?php if( $sidebar_hide == 'ainext_with_sidebar_left' ): ?>
                    <?php get_sidebar(); ?>
                <?php endif; ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<div class="<?php echo esc_attr( $ainext_sidebar_class ); ?>">
						<div class="blog-details"> 
							<?php if( has_post_thumbnail() ) { ?>
								<div class="article-image">
									<img src="<?php the_post_thumbnail_url('full') ?>" alt="<?php the_title_attribute(); ?>">
								</div>
							<?php } ?>

							<ul class="entry-meta">
								<li>
									<span><i class="ri-user-line"></i></span>
									<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ) ?>">
										<?php the_author() ?>
									</a>
								</li>
								<li>
									<span><i class="ri-calendar-line"></i></span>
									<?php echo esc_html(get_the_date()) ?>
								</li>
								<li>
									<span><i class="ri-chat-3-line"></i></span>
									<?php comments_number(); ?>
								</li>
							</ul>

							<div class="blog-details-content">
								<?php the_content(); ?>
								
								<?php wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ainext' ),
									'after'  => '</div>',
								) );
								?>
							</div>

							<?php if ( get_the_tags() ) :  ?>
								<ul class="metatag">
									<?php $tags = get_the_tags();
									foreach ($tags as $tag ) {  ?>
										<?php $tag_names[] = '<li><a href="' . esc_url(get_tag_link( $tag->term_id )) . '">' . $tag->name  . '</a></li>'; ?>
									<?php } echo wp_kses_post( implode( ' ', $tag_names )); ?>
								</ul>
							<?php endif; ?>
						</div>
					
						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>
					</div> <?php 
				endwhile; // End of the loop.
				?>
				
				<?php if( $sidebar_hide == 'ainext_with_sidebar_right' ): ?>
					<?php get_sidebar(); ?>
				<?php endif; ?>

			</div>
		</div>
	</div>
<?php
get_footer();