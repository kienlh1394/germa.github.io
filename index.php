<?php
/**
 * The archive file
 * @package ainext
 */
get_header();

// Blog Sidebar
if( isset( $ainext_opt['ainext_blog_sidebar'] ) ) {
    if( $ainext_opt['ainext_blog_sidebar'] == 'ainext_without_sidebar_center' ) :
        $ainext_sidebar_class = 'col-lg-8 col-md-12 offset-lg-2';
    elseif( $ainext_opt['ainext_blog_sidebar'] == 'ainext_without_sidebar' ) :
        $ainext_sidebar_class = 'col-lg-12 col-md-12';
    else:
        if( is_active_sidebar( 'article-sidebar' ) ):
            $ainext_sidebar_class = 'col-lg-8 col-md-12';
        else:
            $ainext_sidebar_class = 'col-lg-8 col-md-12 offset-lg-2';
        endif;
    endif;
    $sidebar_hide = $ainext_opt['ainext_blog_sidebar'];
} else {
    if( is_active_sidebar( 'article-sidebar' ) ):
        $ainext_sidebar_class = 'col-lg-8 col-md-12';
        $sidebar_hide = 'ainext_with_sidebar_right';
    else:
        $ainext_sidebar_class = 'col-lg-8 col-md-12 offset-lg-2';
        $sidebar_hide = 'ainext_without_sidebar';
    endif;
}

$post_page_id       = get_option( 'page_for_posts' );
if( function_exists('acf_add_options_page') ) {
	$hide_blog_banner 	= get_field( 'enable_page_banner', $post_page_id);
	$hide_breadcrumb 	= get_field( 'hide_breadcrumb' , $post_page_id);
	$custom_title 	    = get_field( 'enable_cus_pagetitle' , $post_page_id);
} else {
	$hide_blog_banner 	= false;
	$hide_breadcrumb 	= false;
	$custom_title 	    = false;
}

$tag = !empty($ainext_opt['page_title_tag']) ? $ainext_opt['page_title_tag'] : 'h1';
?>

    <!-- Start Banner Area -->
    <?php if( $hide_blog_banner == false ) : ?>
        <div class="section-banner">
            <div class="container">
                <div class="section-banner-title">
                    <?php if( $custom_title == true && get_field( 'cus_pagetitle' , $post_page_id) != '' ) { ?>
                        <<?php echo esc_attr( $tag ); ?>><?php echo esc_html( get_field( 'cus_pagetitle' , $post_page_id ) ); ?></<?php echo esc_attr( $tag ); ?>>
                    <?php } else { ?>
                        <<?php echo esc_attr( $tag ); ?>> <?php esc_html_e( 'Blog', 'ainext' ); ?> </<?php echo esc_attr( $tag ); ?>>
                    <?php } ?>

                    <?php if( $hide_breadcrumb == false ) : ?>
                        <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ainext' ); ?></a></li>
                                <?php if( $custom_title == true && get_field( 'cus_pagetitle' , $post_page_id) != '' ) { ?>
                                    <li class="breadcrumb-item active"><?php echo esc_html( get_field( 'cus_pagetitle' , $post_page_id ) ); ?></li>
                                <?php } else { ?>
                                    <li class="breadcrumb-item active"><?php esc_html_e( 'Blog', 'ainext' ); ?></li>
                                <?php } ?>
                            </ol>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- End Banner Area -->

    <!-- Start Blog Area -->
    <div class="blog-area article-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <?php if( $sidebar_hide == 'ainext_with_sidebar_left' ): ?>
                    <?php get_sidebar(); ?>
                <?php endif; ?>
                <!-- Start Blog Content -->
                <div class="<?php echo esc_attr( $ainext_sidebar_class ); ?>">
                    <div class="row">
                        <?php
                        if ( have_posts() ) :
                            while ( have_posts() ) :
                                the_post();
                                get_template_part( 'template-parts/content', get_post_format());
                            endwhile;
                        else :
                            get_template_part( 'template-parts/content', 'none' );
                        endif;
                        ?>
                
                        <!-- Stat Pagination -->
                        <?php ainext_pagination(); ?>
                        <!-- End Pagination -->
                    </div>
                </div>
                <!-- End Blog Content -->
                
                <?php if( $sidebar_hide == 'ainext_with_sidebar_right' ): ?>
                    <?php get_sidebar(); ?>
                <?php endif; ?>
            </div>   
        </div>
    </div>
    <!-- End Blog Area -->

<?php
get_footer();