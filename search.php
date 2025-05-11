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
    $sidebar_hide           = $ainext_opt['ainext_blog_sidebar'];
    $hide_blog_banner       = $ainext_opt['hide_blog_banner'];
    $hide_breadcrumb        = $ainext_opt['hide_breadcrumb'];
} else {
    if( is_active_sidebar( 'article-sidebar' ) ):
        $ainext_sidebar_class         = 'col-lg-8 col-md-12';
        $sidebar_hide = 'ainext_with_sidebar_right';
    else:
        $ainext_sidebar_class         = 'col-lg-8 col-md-12 offset-lg-2';
        $sidebar_hide                = 'ainext_without_sidebar';
    endif;
    $hide_blog_banner = false;
    $hide_breadcrumb  = false;
}
$blog_link = get_permalink( get_option( 'page_for_posts' ));
$tag = !empty($ainext_opt['page_title_tag']) ? $ainext_opt['page_title_tag'] : 'h1';
?>

    <!-- Start Banner Area -->
    <?php if( $hide_blog_banner == false ) : ?>
        <div class="section-banner">
            <div class="container">
                <div class="section-banner-title">
                <<?php echo esc_attr( $tag ); ?>><?php printf( esc_html__( 'Search Results for: %s', 'ainext' ), '<span>' . get_search_query() . '</span>' ); ?> </<?php echo esc_attr( $tag ); ?>>

                    <?php if( $hide_breadcrumb == false ) : ?>
                        <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ainext' ); ?></a></li>
                                <li class="breadcrumb-item active"><?php printf( esc_html__( 'Search Results for: %s', 'ainext' ), '<span>' . get_search_query() . '</span>' ); ?></</li>
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
