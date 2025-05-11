<?php global $ainext_opt;
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ainext
*/

get_header();

$tag = !empty($ainext_opt['page_title_tag']) ? $ainext_opt['page_title_tag'] : 'h2';

?>
	<div class="section-banner error-page-banner">
		<div class="container">
			<div class="section-banner-title">
				<<?php echo esc_attr( $tag ); ?>><?php echo esc_html_e('404 Error', 'ainext') ?></<?php echo esc_attr( $tag ); ?>>
				
				<nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ainext' ); ?></a></li>
						<li class="breadcrumb-item active"><?php echo esc_html_e('404 Error', 'ainext') ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<div class="not-found-area ptb-100">
		<div class="container">
			<div class="not-found-content text-center">
				<?php if ( isset( $ainext_opt['img-404']['url'] ) && $ainext_opt['img-404']['url'] !='' ) : ?>
					<img src="<?php echo esc_url( $ainext_opt['img-404']['url'] ); ?> " alt="<?php esc_attr_e( '404 Image', 'ainext' ); ?>">
				<?php else: ?>
					<img src="<?php echo esc_url(get_template_directory_uri() .'/assets/img/error.png' ); ?>" alt="<?php esc_attr_e( '404 Image', 'ainext' ); ?>">
				<?php endif; ?>

				<?php if( isset( $ainext_opt['content_not_found'] ) ): ?>
					<h3><?php echo esc_html( $ainext_opt['content_not_found'] ); ?></h3>
				<?php else: ?>
					<h3><?php esc_html_e('Oops! Page not found', 'ainext'); ?></h3>
				<?php endif; ?>

				<?php if( isset( $ainext_opt['button_not_found'] ) ): ?>
					<?php if( $ainext_opt['button_not_found'] != '' ): ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="default-btn"><?php echo esc_html( $ainext_opt['button_not_found'] ); ?> <i class="ri-arrow-go-back-line"></i></a>
					<?php endif; ?>
				<?php else: ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="default-btn"><?php esc_html_e( 'Back to Home', 'ainext' ); ?> <i class="ri-arrow-go-back-line"></i></a>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php get_footer();